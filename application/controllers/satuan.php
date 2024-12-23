<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan extends CI_Controller {

	public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('download');
	$this->load->library('pagination');
	$this->load->helper('cookie');
	$this->load->model('satuan_model');
  }
	
	public function index()
	{
		$data['title'] = 'Satuan Barang';
		$data['satuan'] = $this->satuan_model->data()->result();

		$this->load->view('templates/header', $data);
		$this->load->view('satuan/index');
		$this->load->view('templates/footer');
	}

	public function proses_tambah()
	{
		$satuan = $this->input->post('satuan');
		$ket = 	$this->input->post('ket');
		
		$data=array(
			'nama_satuan'=> $satuan,
			'ket'=> $ket,
		);

		$this->satuan_model->tambah_data($data, 'satuan');
		 $this->session->set_flashdata('Pesan', '
				    <div style="background-color: #4CAF50; color: white; padding: 10px; margin-buttom: 10px">
				        <strong>Sukses!</strong> Data berhasil ditambah!
				    </div>');
    	redirect('satuan');
	}

	public function proses_ubah()
	{
        $kode = $this->input->post('idsatuan');
		$satuan = $this->input->post('satuan');
		$ket = 	$this->input->post('ket');
		
		$data=array(
			'nama_satuan'=> $satuan,
			'ket'=> $ket
		);

		$where = array(
			'id_satuan'=>$kode
		);

		$this->satuan_model->ubah_data($where, $data, 'satuan');
		 $this->session->set_flashdata('Pesan', '
				    <div style="background-color: #4CAF50; color: white; padding: 10px; margin-buttom: 10px">
				        <strong>Sukses!</strong> Data berhasil diedit!
				    </div>');
    	redirect('satuan');
	}

	public function proses_hapus($id)
	{
		$where = array('id_satuan' => $id );
		$this->satuan_model->hapus_data($where, 'satuan');
		 $this->session->set_flashdata('Pesan', '
				    <div style="background-color: #4CAF50; color: white; padding: 10px; margin-buttom: 10px">
				        <strong>Sukses!</strong> Data berhasil dihapus!
				    </div>');
		redirect('satuan');
	}

	public function getData()
	{
		$id = $this->input->post('id');
    	$where = array('id_satuan' => $id );
    	$data = $this->satuan_model->detail_data($where, 'satuan')->result();
    	echo json_encode($data);
	}

}
