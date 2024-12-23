<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class SettingWeb extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function __construct()
	{
		 parent::__construct();

    $this->load->helper('url');
    $this->load->helper('download');
	$this->load->library('pagination');
	$this->load->helper('cookie');
		
		$this->load->model('Admin_model', 'admin');
		$this->load->library('form_validation');
		$data['logo'] =  $this->admin->getSetting();

	}

	private function _validasi()
	{
		$this->form_validation->set_rules('pemilik', 'Nama Pemilik', 'required|trim');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
		$this->form_validation->set_rules('kontak', 'Kontak', 'required|trim');
		$this->form_validation->set_rules('zona_waktu', 'Zona Waktu', 'required|trim');
		$this->form_validation->set_rules('header_background_color', 'Header', 'required|trim');
		$this->form_validation->set_rules('sidebar_background_color', 'Sidbar', 'required|trim');
	}

	private function _config()
	{
		$config['upload_path']      = "./assets/img/logo/";
		$config['allowed_types']    = 'gif|jpg|jpeg|png';
		$config['encrypt_name']     = TRUE;
		$config['max_size']         = '2048';

		$this->load->library('upload', $config);
	}
	public function index()
	{
		$data['title'] = "Setting App";
		$data['setting'] = $this->admin->getSetting();

		// $this->template->load('templates/dashboard', 'setting/data', $data);
		$this->load->view('templates/header', $data);
		$this->load->view('setting/data');
		$this->load->view('templates/footer');
	}

	public function edit($id)
	{
		$this->_validasi();
		$this->_config();

		if ($this->form_validation->run() == false) {
			$data['title'] = "Profile";
			$data['setting'] = $this->admin->getSetting();

			// $this->template->load('templates/dashboard', 'setting/edit', $data);
			$this->load->view('templates/header', $data);
			$this->load->view('setting/edit');
			$this->load->view('templates/footer');
		}else{
		   $input = $this->input->post(null, true);
            if (empty($_FILES['foto']['name'])) {
                $insert = $this->admin->update('setting_app', 'id', $input['id'], $input);
                if ($insert) {
                    $this->session->set_flashdata('Pesan', '
				    <div style="background-color: #4CAF50; color: white; padding: 10px; margin-buttom: 10px">
				        <strong>Sukses!</strong> Data berhasil diedit!
				    </div>');
                } else {
                    set_pesan('perubahan tidak disimpan.');
                }
                redirect('SettingWeb/index');
            } else {
                if ($this->upload->do_upload('foto') == false) {
                    echo $this->upload->display_errors();
                    die;
                } else {
                    if (userdata('foto') != null) {
                        $old_image = FCPATH . 'assets/img/logo/' . userdata('foto');
                        if(file_exists($old_image)){
	                        if (!unlink($old_image)) {
	                            set_pesan('gagal hapus foto lama.');
	                            redirect('SettingWeb/index');
	                        }
                        }
                    }

                    $input['logo'] = $this->upload->data('file_name');
                    $update = $this->admin->update('setting_app', 'id', $input['id'], $input);
                    if ($update) {
                       $this->session->set_flashdata('Pesan', '
					    <div style="background-color: #4CAF50; color: white; padding: 10px; margin-buttom: 10px">
					        <strong>Sukses!</strong> Data berhasil ditambah!
					    </div>');
                    } else {
                        set_pesan('gagal menyimpan perubahan');
                    }
				  redirect('SettingWeb/index');                }
            }
		}
	}
}
