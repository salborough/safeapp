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
	
	
	
	function get_view_record($id = FALSE)
	{
		if ($id === FALSE)
		{
			$query = $this->db->get('tbl_user');
			return $query->result_array();
		}
	
		$this->db->select('tbl_user.id, tbl_user.first_name, tbl_user.last_name, tbl_user.screen_name, tbl_user.username, tbl_user.pin, tbl_safenotification.user_id_from, tbl_safenotification.safe_notification_status, tbl_safenotification.gps, tbl_safenotification.create_time, tbl_safe_notification_status.safe_notification_status');
		
		$this->db->join('tbl_safenotification', 'tbl_safenotification.user_id_from = tbl_user.id');		
		$this->db->join('tbl_safe_notification_status', 'tbl_safe_notification_status.id = tbl_safenotification.safe_notification_status');	
		
		$this->db->order_by('tbl_safenotification.create_time desc'); //order by create time desc to get latest safe notification status and gps reading
		
		$query = $this->db->get_where('tbl_user', array('tbl_user.id' => $id));
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