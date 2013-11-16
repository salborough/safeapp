<?php

class User_model extends CI_Model {
	
	//function get_records() {
		//$query = $this->db->get('tbl_user');
		//return $query->result();
	//}
	
	
	
	function get_records($id = FALSE)
	{
		if ($id === FALSE)
		{
			$query = $this->db->get('tbl_user');
			return $query->result_array();
		}
	
		$query = $this->db->get_where('tbl_user', array('id' => $id));
		return $query->row_array();
	}
	
	
		
	
	
	function add_record($data) {
		$this->db->insert('tbl_user', $data);
		return;
	}
	
	
	function update_record($data) {
		$this->db->where('id', $id);
		$this->db->update('tbl_user', $data);
	}
	
	function delete_record() {
		$this->db->where('id', $this->uri->segment(3));
		$this->db->delete('tbl_user');
	}
	
}