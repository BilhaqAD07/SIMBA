<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Picqer\Barcode\BarcodeGeneratorPNG;
class Barang extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('download');
        $this->load->library('pagination');
        $this->load->helper('cookie');
        $this->load->model('barang_model');
        $this->load->model('jenis_model');
        $this->load->model('satuan_model');
        $this->load->model('barangMasuk_model');
        $this->load->library('ciqrcode'); // Load library CIQrcode
    }
    
	public function download_qr($id_barang) {
	    $this->load->library('ciqrcode');

	    // Get product details
	    $product = $this->barang_model->detail_data(['id_barang' => $id_barang], 'barang')->row();

	    // Generate QR code
	    $params['data'] = $id_barang;
	    $params['level'] = 'H';
	    $params['size'] = 10;
	    // $params['savename'] = FCPATH . 'assets/qrcode/' . $id_barang . '_' . $product->nama_barang . '.png';
	    $this->ciqrcode->generate($params);

	    // Set headers for file download
	    $file = FCPATH . 'assets/qrcode/' . $id_barang . '_' . $product->nama_barang . '.png';
	    header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($file));
	    readfile($file);
	    exit;
	}



	public function generate_qr($id_barang) {
	    $this->load->library('ciqrcode');

	    $params['data'] = $id_barang;
	    $params['level'] = 'H';
	    $params['size'] = 10;
	    $params['savename'] = FCPATH . 'assets/qrcode/' . $id_barang . '.png';
	    $this->ciqrcode->generate($params);
	       redirect('barang');
	}

	public function generate_barcode($id_barang) {
        $this->load->model('barang_model');

        // Ambil data barang berdasarkan id_barang
        $barang = $this->barang_model->detail_data(['id_barang' => $id_barang], 'barang')->row();

        // Jika data barang tidak ditemukan
        if (!$barang) {
            show_404();
        }

        // Generate barcode
        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($id_barang, $generator::TYPE_CODE_128);

        // Simpan barcode ke file
        $file = FCPATH . 'assets/barcode/' . $id_barang . '.png';
        file_put_contents($file, $barcode);

        // Redirect setelah barcode dibuat
        redirect('barang');
    }

    public function download_barcode($id_barang) {
	    $file = FCPATH . 'assets/barcode/' . $id_barang . '.png';
	    
	    if (file_exists($file)) {
	        header('Content-Description: File Transfer');
	        header('Content-Type: application/octet-stream');
	        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
	        header('Expires: 0');
	        header('Cache-Control: must-revalidate');
	        header('Pragma: public');
	        header('Content-Length: ' . filesize($file));
	        readfile($file);
	        exit;
	    } else {
	        show_404();
	    }
	}


   public function scan_code() {
    $data['title'] = 'Scan QR/Barcode';
    $this->load->view('templates/header', $data);
    $this->load->view('barang/scan_code');
    $this->load->view('templates/footer');
}

public function handle_scan($id_barang) {
    $data['title'] = 'Barang';

    // Fetch item details based on the scanned QR code or barcode (id_barang)
    $where = array('id_barang' => $id_barang);
    $data['barang'] = $this->barang_model->detail_data($where, 'barang')->result();

    // Check if the item exists
    if(empty($data['barang'])) {
        show_404();
    }

    $this->load->view('templates/header', $data);
    $this->load->view('barang/detail', $data);
    $this->load->view('templates/footer');
}

	
	public function index()
	{
		$data['title'] = 'Barang';
		$data['barang'] = $this->barang_model->dataJoin()->result();

		$this->load->view('templates/header', $data);
		$this->load->view('barang/index');
		$this->load->view('templates/footer');
    }

    public function tambah()
	{
    $data['title'] = 'Barang';
		$data['jenis'] = $this->jenis_model->data()->result();
    $data['satuan'] = $this->satuan_model->data()->result();

        //jml
		$data['jmlJenis'] = $this->satuan_model->data()->num_rows();
		$data['jmlSatuan'] = $this->satuan_model->data()->num_rows();

		$this->load->view('templates/header', $data);
		$this->load->view('barang/form_tambah');
		$this->load->view('templates/footer');
    }
    
    public function ubah($id)
	{
        $data['title'] = 'Barang';

        //menampilkan data berdasarkan id
		$where = array('id_barang'=>$id);
        $data['data'] = $this->barang_model->detail_data($where, 'barang')->result();
        
        //data untuk select
		$data['jenis'] = $this->jenis_model->data()->result();
        $data['satuan'] = $this->satuan_model->data()->result();

        //jml
		$data['jmlJenis'] = $this->satuan_model->data()->num_rows();
		$data['jmlSatuan'] = $this->satuan_model->data()->num_rows();

		$this->load->view('templates/header', $data);
		$this->load->view('barang/form_ubah');
		$this->load->view('templates/footer');
	}

	public function laporan()
	{
		$data['title'] = 'Laporan Barang';
		$data['jenis_barang'] = $this->jenis_model->data()->result();
		$this->load->view('templates/header', $data);
		$this->load->view('barang/laporan');
		$this->load->view('templates/footer');
	}

	public function filterBarang($tglawal, $tglakhir, $jenisFilter = null)
	{
	    $data = $this->barang_model->lapdata($tglawal, $tglakhir, $jenisFilter)->result();
	    echo json_encode($data);
	}


	public function getBarang()
	{
		$id = $this->input->post('id');
    	$where = array('id_barang' => $id );
    	// $data = $this->barang_model->dataJoin()->result();
    	// $data = $this->barang_model->detail_data($where, 'barang')->result();
    	$data = $this->barang_model->dataJoin($where, 'barang')->result();
    	echo json_encode($data);
	}

	public function getTotalStok()
	{
		$id = $this->input->post('id');
		$where = array('id_barang'=>$id);
    	$data = $this->db->select_sum('jumlah_masuk')->from('barang_masuk')->where($where)->get();
        $data2 = $this->db->select_sum('jumlah_keluar')->from('barang_keluar')->where($where)->get();
		$bm = $data->row();
		$bk = $data2->row();
		$hasil = intval($bm->jumlah_masuk) - intval($bk->jumlah_keluar);
		$total = array('total'=>$hasil);
		echo json_encode($total);
	}

	public function detail($id)
	{
		$data['title'] = 'Barang';

        //menampilkan data berdasarkan id
        $data['data'] = $this->barang_model->detail_join($id, 'barang')->result();

		$this->load->view('templates/header', $data);
		$this->load->view('barang/detail');
		$this->load->view('templates/footer');
	}


	public function detail2($id)
	{
		$data['title'] = 'List Barang FIFO';

        //menampilkan data berdasarkan id
        $data['data'] = $this->barang_model->detailJoin2($id)->result();
		$this->load->view('templates/header', $data);
		$this->load->view('barang/detail2');
		$this->load->view('templates/footer');
	}

	public function detail3($id)
	{
		$data['title'] = 'List Barang LIFO';

        //menampilkan data berdasarkan id
        $data['data'] = $this->barang_model->detailJoin3($id)->result();
		$this->load->view('templates/header', $data);
		$this->load->view('barang/detail3');
		$this->load->view('templates/footer');
	}

	public function proses_tambah()
	{

    $config['upload_path']   = './assets/upload/barang/';
		$config['allowed_types'] = 'png|jpg|JPG|jpeg|JPEG|gif|GIF|tif|TIF||tiff|TIFF';
	
		$namaFile = $_FILES['photo']['name'];
		$error = $_FILES['photo']['error'];

        $this->load->library('upload', $config);
        
		$kode 			= 	$this->barang_model->buat_kode();
		$barang 		= 	$this->input->post('barang');
		$warna 			= 	$this->input->post('warna');
		$stok 			= 	$this->input->post('stok');
		$hargabeli 	= 	$this->input->post('hargabeli');
		$hargajual 	= 	$this->input->post('hargajual');
		$jenis 			= 	$this->input->post('jenis');
    $satuan 		= 	$this->input->post('satuan');
  
        
        if ($namaFile == '') {
            $ganti = 'box.png';
        }else{
          if (! $this->upload->do_upload('photo')) {
            $error = $this->upload->display_errors();
            redirect('barang/tambah');
          }
          else{
  
            $data = array('photo' => $this->upload->data());
            $nama_file= $data['photo']['file_name'];
            $ganti = str_replace(" ", "_", $nama_file);
  
  
          }

      }
		
		$data=array(
			'id_barang'=> $kode,
			'nama_barang'=> $barang,
			'warna'=> $warna,
			'stok'=> $stok,
			'hargabeli'=> $hargabeli,
			'hargajual'=> $hargajual,
			'id_jenis'=> $jenis,
      'id_satuan'=> $satuan,
      'foto' => $ganti
		);

		$this->barang_model->tambah_data($data, 'barang');
		$this->session->set_flashdata('Pesan', '
	    <div style="background-color: #4CAF50; color: white; padding: 10px; margin-buttom: 10px">
	        <strong>Sukses!</strong> Data berhasil ditambah!
	    </div>');
    	redirect('barang');
	}

	public function proses_ubah()
	{
        $config['upload_path']   = './assets/upload/barang/';
		$config['allowed_types'] = 'png|jpg|JPG|jpeg|JPEG|gif|GIF|tif|TIF||tiff|TIFF';
	
		$namaFile = $_FILES['photo']['name'];
		$error = $_FILES['photo']['error'];

        $this->load->library('upload', $config);
        
		$kode 			=   $this->input->post('idbarang');
		$barang 		=  	$this->input->post('barang');
		$warna 			= 	$this->input->post('warna');
		$stok 			= 	$this->input->post('stok');
		$hargabeli 	= 	$this->input->post('hargabeli');
		$hargajual 	= 	$this->input->post('hargajual');
		$jenis 			= 	$this->input->post('jenis');
		$satuan 		= 	$this->input->post('satuan');
    
        
        $flama = $this->input->post('fotoLama');

        if ($namaFile == '') {
            $ganti = $flama;
        }else{
          if (! $this->upload->do_upload('photo')) {
            $error = $this->upload->display_errors();
            redirect('barang/ubah/'.$kode);
          }
          else{
  
            $data = array('photo' => $this->upload->data());
            $nama_file= $data['photo']['file_name'];
            $ganti = str_replace(" ", "_", $nama_file);
            if($flama == 'box.png'){

            }else{
              unlink('./assets/upload/barang/'.$flama.'');
            }
  
          }

      }
		
		$data=array(
			'nama_barang'=> $barang,
			'warna'=> $warna,
			'stok'=> $stok,
			'hargabeli'=> $hargabeli,
			'hargajual'=> $hargajual,
			'id_jenis'=> $jenis,
      'id_satuan'=> $satuan,
      'foto' => $ganti
		);

		$where = array(
			'id_barang'=>$kode
		);

		$this->barang_model->ubah_data($where, $data, 'barang');
		$this->session->set_flashdata('Pesan', '
    <div style="background-color: #4CAF50; color: white; padding: 10px; margin-buttom: 10px">
        <strong>Sukses!</strong> Data berhasil diubah!
    </div>');
    	redirect('barang');
	}

	public function proses_hapus($id)
	{
		$where = array('id_barang' => $id );
		$foto = $this->barang_model->ambilFoto($where);
		if($foto){
			if($foto == 'box.png'){

			}else{
				unlink('./assets/upload/barang/'.$foto.'');
			}
			
			$this->barang_model->hapus_data($where, 'barang');
		}

		$this->session->set_flashdata('Pesan', '
		    <div style="background-color: #4CAF50; color: white; padding: 10px;">
		        <strong>Sukses!</strong> Data berhasil hapus!
		    </div>');
		redirect('barang');
	}

	public function getData()
	{
		$id = $this->input->post('id');
    	$where = array('id_barang' => $id );
    	$data = $this->barang_model->detail_data($where, 'barang')->result();
    	echo json_encode($data);
	}

}
