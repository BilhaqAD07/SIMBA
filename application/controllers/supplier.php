<?php
error_reporting(1);
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
class Supplier extends CI_Controller {

	public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('download');
	$this->load->library('pagination');
	$this->load->helper('cookie');
	$this->load->model('supplier_model');
  }
	
	public function index()
	{
		$data['title'] = 'Supplier';
		$data['supplier'] = $this->supplier_model->data()->result();

		$this->load->view('templates/header', $data);
		$this->load->view('supplier/index');
		$this->load->view('templates/footer');
	}

	public function ubah($id)
	{
		$data['title'] = 'Supplier';
		$where = array('id_supplier'=>$id);
		$data['supplier'] = $this->supplier_model->detail_data($where, 'supplier')->result();

		$this->load->view('templates/header', $data);
		$this->load->view('supplier/form_ubah');
		$this->load->view('templates/footer');
	}

	public function proses_tambah()
	{
		$config['upload_path']   = './assets/upload/supplier/';
		$config['allowed_types'] = 'png|jpg|JPG|jpeg|JPEG|gif|GIF|tif|TIF||tiff|TIFF';
	
		$namaFile = $_FILES['photo']['name'];
		$error = $_FILES['photo']['error'];

		$this->load->library('upload', $config);
		$kode = 	$this->supplier_model->buat_kode();
		$supplier = $this->input->post('supplier');
		$notelp = 	$this->input->post('notelp');
		$alamat = 	$this->input->post('alamat');
		
		if ($namaFile == '') {
		  	$ganti = 'user.png';
		}else{
			if (! $this->upload->do_upload('photo')) {
			  $error = $this->upload->display_errors();
		  	redirect('supplier/tambah');
			}
			else{
	
			  $data = array('photo' => $this->upload->data());
			  $nama_file= $data['photo']['file_name'];
			  $ganti = str_replace(" ", "_", $nama_file);
	
	
			}

		}

		$data=array(
			'id_supplier'=> $kode,
			'nama_supplier'=> $supplier,
			'notelp'=> $notelp,
			'alamat'=> $alamat,
			'foto'=>$ganti
		);

		$this->supplier_model->tambah_data($data, 'supplier');
		$this->session->set_flashdata('Pesan', '
	    <div style="background-color: #4CAF50; color: white; padding: 10px; margin-buttom: 10px">
	        <strong>Sukses!</strong> Data berhasil ditambah!
	    </div>');
    	redirect('supplier');
	}

	public function proses_ubah()
	{
		$config['upload_path']   = './assets/upload/supplier/';
		$config['allowed_types'] = 'png|jpg|JPG|jpeg|JPEG|gif|GIF|tif|TIF||tiff|TIFF';
	
		$namaFile = $_FILES['photo']['name'];
		$error = $_FILES['photo']['error'];

		$this->load->library('upload', $config);

		$kode 		= 	$this->input->post('idsupplier');
		$supplier 	= $this->input->post('supplier');
		$notelp 	= 	$this->input->post('notelp');
		$alamat 	= 	$this->input->post('alamat');
		$flama 		= $this->input->post('fotoLama');

		if ($namaFile == '') {
		  	$ganti = $flama;
		}else{
			if (! $this->upload->do_upload('photo')) {
			  $error = $this->upload->display_errors();
		  	redirect('supplier/ubah/'.$kode);
			}
			else{
			  $data = array('photo' => $this->upload->data());
			  $nama_file= $data['photo']['file_name'];
			  $ganti = str_replace(" ", "_", $nama_file);
			  if($flama !== 'user.png'){
				unlink('./assets/upload/supplier/'.$flama.'');
			  }
	
			}

		}
		$data=array(
			'nama_supplier'=> $supplier,
			'notelp'=> $notelp,
			'alamat'=> $alamat,
			'foto'=>$ganti
		);

		$where = array(
			'id_supplier'=>$kode
		);

		$this->supplier_model->ubah_data($where, $data, 'supplier');
		$this->session->set_flashdata('Pesan', '
	    <div style="background-color: #4CAF50; color: white; padding: 10px; margin-buttom: 10px">
	        <strong>Sukses!</strong> Data berhasil diubah!
	    </div>');
    	redirect('supplier');
	}

	public function proses_hapus($id)
	{
		$where = array('id_supplier' => $id );
		$foto = $this->supplier_model->ambilFoto($where);
		if($foto){
			if($foto == 'user.png'){

			}else{
				unlink('./assets/upload/supplier/'.$foto.'');
			}
			
			$this->supplier_model->hapus_data($where, 'supplier');
		}
		
		
		$this->session->set_flashdata('Pesan', '
	    <div style="background-color: #4CAF50; color: white; padding: 10px; margin-buttom: 10px">
	        <strong>Sukses!</strong> Data berhasil dihapus!
	    </div>');
		redirect('supplier');
	}

	public function getData()
	{
		$id = $this->input->post('id');
    	$where = array('id_supplier' => $id );
    	$data = $this->supplier_model->detail_data($where, 'supplier')->result();
    	echo json_encode($data);
	}

	public function import()
    {
        $data['title'] = 'Import Data Supplier';
        $this->load->view('templates/header', $data);
        $this->load->view('supplier/import');
        $this->load->view('templates/footer');
    }

	public function import_process()
    {
        $config['upload_path']   = './assets/upload/import/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['file_name'] = 'supplier_import_' . time();

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file')) {
            $file = $this->upload->data();

            $reader = new Xlsx();
            $spreadsheet = $reader->load($file['full_path']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            foreach ($sheetData as $key => $value) {
                if ($key == 1) continue; // Skip header row

                $data = array(
                    'id_supplier' => $this->supplier_model->buat_kode(),
                    'nama_supplier' => $value['A'],
                    'notelp' => $value['B'],
                    'alamat' => $value['C'],
                    'foto' => $value['D'],
                );

                $this->supplier_model->tambah_data($data, 'supplier');
            }

            $this->session->set_flashdata('Pesan', '
						    <div style="background-color: #4CAF50; color: white; padding: 10px;">
						        <strong>Sukses!</strong> Data berhasil diimport!
						    </div>
						');

            redirect('supplier');
        } else {
            $this->session->set_flashdata('Pesan', '
					    <div style="background-color: red; color: white; padding: 10px;">
					        <strong>Gagal!</strong> Data gagal diimport!
					    </div>
					');

            redirect('supplier/import');
        }
    }

}
