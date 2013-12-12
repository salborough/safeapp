<?php

class Saferequest_model extends CI_Model {
	
	
	//this function is used to add the safe requests to the tbl_saferequest table. 	
	function add_record($data) {
		$this->db->insert('tbl_saferequest', $data);
		return;
	}
	

//------------------------------------------------
	//this function is used to update the safe request status once a person has replied with a safe notification
	function update_safe_request_status($id, $data) {
			$this->db->where('id', $id);
			$this->db->update('tbl_saferequest', array('safe_request_status'=> $data));
			return;
		}
	
	
	
	
}