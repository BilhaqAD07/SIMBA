<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_barang extends CI_Model {

	// Table name
	private $table = 'status_barang';

	// Constructor
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	// Get all status
	public function get_all_status() {
		$query = $this->db->get($this->table);
		return $query->result();
	}

	// Get status by ID
	public function get_status_by_id($id) {
		$query = $this->db->get_where($this->table, array('id' => $id));
		return $query->row();
	}

	// Insert new status
	public function insert_status($data) {
		return $this->db->insert($this->table, $data);
	}

	// Update status
	public function update_status($id, $data) {
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}

	// Delete status
	public function delete_status($id) {
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}

	// Get delivery status
	public function get_delivery_status($is_delivered) {
		$query = $this->db->get_where($this->table, array('is_delivered' => $is_delivered));
		return $query->result();
	}

	// Get active status
	public function get_active_status($is_active) {
		$query = $this->db->get_where($this->table, array('is_active' => $is_active));
		return $query->result();
	}
}
?>
