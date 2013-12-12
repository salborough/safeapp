<?php


class Tracking_model extends CI_Model {
	
	
	//this function is used to get all the safe requests (received for a particular user and return the result
	function get_safe_request_records($id = FALSE)	{
		if ($id === FALSE)
		{
			$query = $this->db->get('tbl_saferequest');
			return $query->result_array();			
		}
		
		$safe_request_status = 1; //set the safe request id for the where query below. Only want to pull pending status
		
		//specifically stipulating colums to return, as the join means the create_time tables are the same 
		$this->db->select('tbl_saferequest.id, tbl_saferequest.user_id_from, tbl_saferequest.safe_request_status, tbl_saferequest.create_time, tbl_user.first_name, tbl_user.last_name, tbl_user.screen_name');
				
		$this->db->join('tbl_user', 'tbl_user.id = tbl_saferequest.user_id_from');		
		//only want to retrieve and display safe requests with status of pending and for this particular user. We will update the status on reply to "replied" = status = 2		
		$query = $this->db->get_where('tbl_saferequest', array('user_id_to' => $id, 'safe_request_status' => $safe_request_status ));
		
		return $query->result();
		
	}
	
	
	
	//this function is used to get all the invites sent by a particular user and return the result
	function get_safe_notification_records($id = FALSE)	{
		if ($id === FALSE)
		{
			$query = $this->db->get('tbl_safenotification');
			return $query->result_array();			
		}
				
		//specifically stipulating colums to return, as the join means the create_time tables are the same 
		$this->db->select('tbl_safenotification.id, tbl_safenotification.user_id_to, tbl_safenotification.safe_notification_status, tbl_safenotification.create_time, tbl_user.first_name, tbl_user.last_name, tbl_user.screen_name, tbl_safe_notification_status.*');
		
		
		$this->db->join('tbl_user', 'tbl_user.id = tbl_safenotification.user_id_to');
		$this->db->join('tbl_safe_notification_status', 'tbl_safe_notification_status.id = tbl_safenotification.safe_notification_status');	
		
		$query = $this->db->get_where('tbl_safenotification', array('user_id_from' => $id));		
		
		return $query->result();
		
	}
	

	
	
}