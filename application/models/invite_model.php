<?php


class Invite_model extends CI_Model {
	
		
	//this function is used to create the invite to become a contact. 
	//We need to pass the $user_id_to & $user_id_from to the junction table
	function add_record($data) {
		$this->db->insert('tbl_invite', $data);
		return;
	}
	
	
	
	//this function is used to get back the tbl_user info based on the pin passed in $data
	function get_user_to($data) {
		$query = $this->db->get_where('tbl_user', array('pin'=> $data));
		return $query ->row_array();
		//return $query->result();
	}
	
	
	
	//this function is used to get all the invite requests (invites received) for a particular user and return the result
	function get_records($id = FALSE)	{
		if ($id === FALSE)
		{
			//$query = $this->db->get('tbl_invite');
			//return $query->result_array();			
		}
		//might need to also pass invite status? so only get pending results?		
		//specifically stipulating colums to return, as the join means the create_time tables are the same 
		$this->db->select('tbl_invite.id, tbl_invite.user_id_from, tbl_invite.create_time, tbl_user.first_name, tbl_user.last_name, tbl_user.screen_name');
		
		
		$this->db->join('tbl_user', 'tbl_user.id = tbl_invite.user_id_from');
		//$this->db->join('tbl_invite', 'tbl_invite.invite_status_id = tbl_invite_status.id'); need to still add the join to the invite status tbl
		$query = $this->db->get_where('tbl_invite', array('user_id_to' => $id));		
		
		return $query->result();
		
	}
	
	
	//this function is used to get all the invites sent by a particular user and return the result
	function get_invites_sent($id = FALSE)	{
		if ($id === FALSE)
		{
			//$query = $this->db->get('tbl_invite');
			//return $query->result_array();			
		}
				
		//specifically stipulating colums to return, as the join means the create_time tables are the same 
		$this->db->select('tbl_invite.id, tbl_invite.user_id_to, tbl_invite.create_time, tbl_user.first_name, tbl_user.last_name, tbl_user.screen_name');
		
		
		$this->db->join('tbl_user', 'tbl_user.id = tbl_invite.user_id_to');
		//$this->db->join('tbl_invite', 'tbl_invite.invite_status_id = tbl_invite_status.id'); need to still add the join to the invite status tbl
		$query = $this->db->get_where('tbl_invite', array('user_id_from' => $id));		
		
		return $query->result();
		
	}
	

	
	
	//this function deletes an invite record from the tbl_invite table
	function delete_records($id) {
		$this->db->delete('tbl_invite', array('id' => $id)); 
		return;		
	}
	
	
	
	//this function updates the status of the invite on the tbl_invite
	function update_record($data, $id) {
		$this->db->update('tbl_invite', $data, array('id' => $id));
		return;			
	}
	
	
}