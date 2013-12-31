<?php

class Contact_model extends CI_Model {
	
			
	function add_record($data) {
		$this->db->insert('tbl_contact', $data);
		return;
	}
	
	
	//this function is used to get all the contacts for a particular user and return the result plus there latest safe notification status
	/*NOTE this is the original function incase the rewrite below causes bugs/ problems
	 * 
	 * function get_records($id = FALSE)	{
		if ($id === FALSE)
		{
			//$query = $this->db->get('tbl_invite');
			//return $query->result_array();			
		}
		
		//specifically stipulating colums to return, as the join means the create_time tables are the same 
		$this->db->select('tbl_user.id, tbl_user.first_name, tbl_user.last_name, tbl_user.screen_name, tbl_contact.*'); //just added pulling tbl_contacts
				
		$this->db->join('tbl_user', 'tbl_user.id = tbl_contact.contact');		
		
		$query = $this->db->get_where('tbl_contact', array('user_id' => $id));		
		
		return $query->result();
		
	}*/
	
	function get_records($id = FALSE)	{
		if ($id === FALSE)
		{
			//$query = $this->db->get('tbl_invite');
			//return $query->result_array();			
		}
		
		//specifically stipulating colums to return, as the join means the create_time tables are the same 
		$this->db->select('tbl_user.id, tbl_user.first_name, tbl_user.last_name, tbl_user.screen_name, tbl_contact.*, tbl_safenotification.safe_notification_status, tbl_safenotification.gps, tbl_safenotification.create_time, tbl_safe_notification_status.safe_notification_status'); //just added pulling tbl_contacts
				
		$this->db->join('tbl_user', 'tbl_user.id = tbl_contact.contact');
		$this->db->join('tbl_safenotification', 'tbl_safenotification.user_id_from = tbl_user.id');		
		$this->db->join('tbl_safe_notification_status', 'tbl_safe_notification_status.id = tbl_safenotification.safe_notification_status');			
		
		$this->db->order_by('tbl_safenotification.create_time desc');
		$query = $this->db->get_where('tbl_contact', array('user_id' => $id));		
		
		return $query->result();
		
	}
	
	
	
	//this function is used when sending bulk safe requests to all contacts
	function get_records_bulk($id = FALSE)	{
		if ($id === FALSE)
		{
			//$query = $this->db->get('tbl_invite');
			//return $query->result_array();			
		}
		
		//specifically stipulating colums to return, as the join means the create_time tables are the same 
		$this->db->select('tbl_contact.contact'); //just added pulling tbl_contacts			
		
		$query = $this->db->get_where('tbl_contact', array('user_id' => $id));		
		
		//return $query->result();
		return $query->result_array();
		 
		
	}
	
	
	
	
}