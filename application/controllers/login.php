<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
    parent::__construct();
     $this->load->library('form_validation');
    $this->load->helper('url');
    $this->load->helper('download');
	$this->load->library('pagination');
	$this->load->helper('cookie');
	$this->load->model('login_model');
  }


	public function index()
	{
		
		$this->load->view('templates/header_login');
		$this->load->view('login/index');
		$this->load->view('templates/footer_login');
	}

	public function proses_login()
	{
		$username = $this->input->post('user');
    	$password = $this->input->post('pwd');

    	$where = array(
    		'username' => $username,
    		'password' => md5($password)
    	);

    	$cek = $this->login_model->cek_login($where, 'user')->num_rows();
    	$data = $this->login_model->cek_login($where, 'user')->row_array();
    	if ($cek > 0) {

			$userdata = [
				'id_user' => $data['id_user'],
    			'username' => $data['nama'],
    			'status' => $data['status'],
    			'level' => $data['level'],
    			'foto' => $data['foto']
			];

			$this->session->set_userdata('login_session',$userdata);
			
			$respon = array('respon' => 'success');
			echo json_encode($respon);
    	}
    	else{
			$respon = array('respon' => 'failed');
			echo json_encode($respon);
		}

	}
    public function changePassword(){

       if(!$this->session->userdata('reset_email')){
            redirect('login');
       }

       $this->form_validation->set_rules('password1', 'Password ', 'required|trim|min_length[4]|matches[password2]');
       $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|min_length[4]|matches[password1]');
        if ($this->form_validation->run() == false) {
        $data['title'] = 'Change Password';
        $this->load->view('login/change-password', $data);
        }else{
            $password = md5($this->input->post('password1'));
            $email = $this->session->userdata('reset_email');
            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');

            $respon = array('respon' => 'success');
            echo json_encode($respon);
            redirect('login');
        }

    }

	public function logout()
	{
		$this->session->unset_userdata('login_session');
		redirect('login');
		
	}
}
