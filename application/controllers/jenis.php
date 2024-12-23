<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller {

	public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('download');
	$this->load->library('pagination');
	$this->load->helper('cookie');
	$this->load->model('jenis_model');
  }
	
	public function index()
	{
		$data['title'] = 'Jenis Barang';
		$data['jenis'] = $this->jenis_model->data()->result();

		$this->load->view('templates/header', $data);
		$this->load->view('jenis/index');
		$this->load->view('templates/footer');
	}

	public function proses_tambah()
	{
		$jenis = $this->input->post('jenis');
		$ket = 	$this->input->post('ket');
		
		$data=array(
			'nama_jenis'=> $jenis,
			'ket'=> $ket,
		);

		$this->jenis_model->tambah_data($data, 'jenis');
		 $this->session->set_flashdata('Pesan', '
				    <div style="background-color: #4CAF50; color: white; padding: 10px; margin-buttom: 10px">
				        <strong>Sukses!</strong> Data berhasil ditambah!
				    </div>');
    	redirect('jenis');
	}

	public function proses_ubah()
	{
        $kode = $this->input->post('idjenis');
		$jenis = $this->input->post('jenis');
		$ket = 	$this->input->post('ket');
		
		$data=array(
			'nama_jenis'=> $jenis,
			'ket'=> $ket
		);

		$where = array(
			'id_jenis'=>$kode
		);

		$this->jenis_model->ubah_data($where, $data, 'jenis');
		 $this->session->set_flashdata('Pesan', '
				    <div style="background-color: #4CAF50; color: white; padding: 10px; margin-buttom: 10px">
				        <strong>Sukses!</strong> Data berhasil diedit!
				    </div>');
    	redirect('jenis');
	}

	public function proses_hapus($id)
	{
		$where = array('id_jenis' => $id );
		$this->jenis_model->hapus_data($where, 'jenis');
		 $this->session->set_flashdata('Pesan', '
				    <div style="background-color: #4CAF50; color: white; padding: 10px; margin-buttom: 10px">
				        <strong>Sukses!</strong> Data berhasil dihapus!
				    </div>');
		redirect('jenis');
	}

	public function getData()
	{
		$id = $this->input->post('id');
    	$where = array('id_jenis' => $id );
    	$data = $this->jenis_model->detail_data($where, 'jenis')->result();
    	echo json_encode($data);
	}

}
