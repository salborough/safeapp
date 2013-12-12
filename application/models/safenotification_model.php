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
	

}