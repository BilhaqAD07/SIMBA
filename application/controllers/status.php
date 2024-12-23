<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Status_model');
	}

	public function index() {
		$data['statuses'] = $this->Status_model->get_all_statuses();
		$this->load->view('status/index', $data);
	}

	public function update_delivery_status($id, $status) {
		$this->Status_model->update_delivery_status($id, $status);
		redirect('status');
	}

	public function update_active_status($id, $status) {
		$this->Status_model->update_active_status($id, $status);
		redirect('status');
	}
}
?>
