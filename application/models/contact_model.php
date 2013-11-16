<?php

class Contact_model extends CI_Model {
	
			
	function add_record($data) {
		$this->db->insert('tbl_contact', $data);
		return;
	}
	
	
	//this function is used to get all the contacts for a particular user and return the result
	function get_records($id = FALSE)	{
		if ($id === FALSE)
		{
			//$query = $this->db->get('tbl_invite');
			//return $query->result_array();			
		}
		
		//specifically stipulating colums to return, as the join means the create_time tables are the same 
		$this->db->select('tbl_user.first_name, tbl_user.last_name, tbl_user.screen_name');
		
		
		$this->db->join('tbl_user', 'tbl_user.id = tbl_contact.contact');		
		$query = $this->db->get_where('tbl_contact', array('user_id' => $id));		
		
		return $query->result();
		
	}
	
	
	
	
}