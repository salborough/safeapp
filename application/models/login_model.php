<?php


class Login_model extends CI_Model {
	
	function validate() {
		
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', md5($this->input->post('password')));
		$query = $this->db->get('tbl_user');
		
		if($query->num_rows ==1)
		{
			//might need to pass back the user id value
			return $query->row_array();
			return true;
		}
		
	}
	
	
	
}