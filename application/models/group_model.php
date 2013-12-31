<?php

class Group_model extends CI_Model {
	
	
//this function is used to get all the groups created by a particular user and return the results
	function get_records($id = FALSE)	{
		if ($id === FALSE)
		{
			$query = $this->db->get('tbl_group');
			return $query->result_array();			
		}
		
		
		//$this->db->select('tbl_user.id, tbl_user.first_name, tbl_user.last_name, tbl_user.screen_name');
		$this->db->select('tbl_group.*');
				
		//$this->db->join('tbl_user', 'tbl_user.id = tbl_group.created_by');		
		
		$query = $this->db->get_where('tbl_group', array('created_by' => $id));		
		
		return $query->result();
		
	}
	
	
// this function creates the group 	
	function add_record($data) {
			$this->db->insert('tbl_group', $data);
			return;
	}
	
	
	
// this function gets the record when viewing the group	
	function get_view_record($id = FALSE) {		
		if ($id === FALSE)
		{
			$query = $this->db->get('tbl_group');
			return $query->result_array();
		}
	
		$this->db->select('tbl_group.*');	
				
		$query = $this->db->get_where('tbl_group', array('tbl_group.id' => $id));
		return $query->row_array();
	}
	
	
// this function gets the group members for a specific group	
	function get_member_records($id = FALSE)	{
		if ($id === FALSE)
		{
			//$query = $this->db->get('tbl_invite');
			//return $query->result_array();			
		}
		
		//specifically stipulating colums to return, as the join means the create_time tables are the same 
		$this->db->select('tbl_group_member.*, tbl_user.first_name, tbl_user.last_name, tbl_user.screen_name');
				
		$this->db->join('tbl_user', 'tbl_user.id = tbl_group_member.user_id');		
		
		$query = $this->db->get_where('tbl_group_member', array('group_id' => $id));		
		
		return $query->result();
		
	}
	
	
// this function deletes the group members from a specific group	
	function delete_member_record()	{		
		
		$this->db->where('id', $this->uri->segment(3)); //pass tbl_group_member.id to this function
		$this->db->delete('tbl_group_member');		
		return;
		
	}
	
// this function deletes the group members from a specific group and then the group itself
	function delete_group_record()	{		
		
		$this->db->where('group_id', $this->uri->segment(3)); //pass tbl_group.id to this function
		$this->db->delete('tbl_group_member');	
		
		$this->db->where('id', $this->uri->segment(3)); //pass tbl_group.id to this function
		$this->db->delete('tbl_group');	
		return;
		
	}
	
// this function adds members to the group
	function add_member_record($data, $groupid, $create_time) {
		
			//$this->db->insert('tbl_group_member', $data);
			$this->db->insert('tbl_group_member', array('user_id'=> $data, 'group_id'=> $groupid, 'create_time'=> $create_time));
			
			//$this->db->insert_batch('tbl_group_member', $data);		
			return;
	}
	

//this function is used when sending bulk safe notifications to a group 
// selects all the members in a group
	function get_member_records_bulk($id = FALSE)	{
		if ($id === FALSE)
		{
			//$query = $this->db->get('tbl_invite');
			//return $query->result_array();			
		}
		
		//specifically stipulating colums to return, as the join means the create_time tables are the same 
		$this->db->select('tbl_group_member.user_id'); //just added pulling tbl_contacts			
		
		$query = $this->db->get_where('tbl_group_member', array('group_id' => $id));		
		
		//return $query->result();
		return $query->result_array();
		 
		
	}
	
	

}
	