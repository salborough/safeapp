<?php

class Safenotification_model extends CI_Model {
	
		
	//this function is used to add the safe notification to the tbl_safenotification table. 	
	function add_record($data) {
		$this->db->insert('tbl_safenotification', $data);
		return;
	}
	
	
//this function is used to get all the safe notification for a particular user and return the result
	function get_tracklog_records($id = FALSE)	{
		if ($id === FALSE)
		{
			$query = $this->db->get('tbl_safenotification');
			return $query->result_array();			
		}
		
		//specifically stipulating colums to return, as the join means the create_time tables are the same 
		$this->db->select('tbl_safenotification.*, tbl_safe_notification_status.*');			
		$this->db->join('tbl_safe_notification_status', 'tbl_safe_notification_status.id = tbl_safenotification.safe_notification_status');	
		//$this->db->join('tbl_user', 'tbl_user.id = tbl_safenotification.user_id_from');	
		
		
		$query = $this->db->get_where('tbl_safenotification', array('user_id_from' => $id));
		
		
		return $query->result();
		
	}
	
	
//------------------------------------------------	
//this function is used to add the safe notification to the tbl_safernotifcation table in bulk from the safenotification/createbulknotification page, via the group page

	function add_record_bulk($data, $safe_notification_status, $user_id_from, $create_time) {
		$this->db->insert('tbl_safenotification', array('user_id_to'=> $data, 'safe_notification_status'=> $safe_notification_status, 'user_id_from'=> $user_id_from, 'create_time'=> $create_time));
		return;
	}	
	

//------------------------------------------

//this function is used to get all the safe notification sent to a user (to be used on the dashboard page)
	function get_all_safenotification_records($id = FALSE)	{
		if ($id === FALSE)
		{
			$query = $this->db->get('tbl_safenotification');
			return $query->result_array();	
				
		}
		
		//specifically stipulating colums to return, as the join means the create_time tables are the same 
		$this->db->select('tbl_safenotification.*, tbl_safe_notification_status.*, tbl_user.first_name, tbl_user.last_name, tbl_user.screen_name');			
		$this->db->join('tbl_safe_notification_status', 'tbl_safe_notification_status.id = tbl_safenotification.safe_notification_status');	
		//$this->db->join('tbl_user', 'tbl_user.id = tbl_safenotification.user_id_from');	
		
		$this->db->join('tbl_user', 'tbl_user.id = tbl_safenotification.user_id_from');
		
		$this->db->order_by('tbl_safenotification.create_time desc');
		//$this->db->group_by(array('safe_notification_status')); 
		
		$query = $this->db->get_where('tbl_safenotification', array('user_id_to' => $id));
		
		
		return $query->result();
		
	}
	
		
	

}