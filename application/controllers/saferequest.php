<?php
// this controller handles sending users safe requests


class Saferequest extends CI_Controller {
	
	//class used for checking for session
	function __construct()
	{
		//parent::Controller();
		parent::__construct();
		$this->is_logged_in();
	}
	
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			//$this->login->index();
			redirect('login/index');
		}
	}
	
	
// --------------------------------------------------------------------	

	function send() {
		//this function need to add the safe request the tbl_saferequest
		

		//need to also pass the user_id_from  & user_id_to in to this function so know who to write to tbl_saferequest
		
		$user_id_to = $this->uri->segment(3,0); //need to get this passed in the URL from the contactprofile page
		$safe_request_status = $this->uri->segment(4,0);// need to set status to pending	
		$user_id_from = $this->session->userdata('id');
			
		
		$data = array(
					'user_id_to' => $user_id_to,
					'user_id_from' => $user_id_from,
					'safe_request_status' => $safe_request_status,					
					'create_time' => date('Y-m-d\TH:i:sP'),  			
				);
			
		$this->saferequest_model->add_record($data);
							
		
		redirect('user/contactprofile/' . $user_id_to); //might need to thnk of perhaps going to tracking page or
														//passing a success message back to contactprofile page
		
		
	}		
	
// --------------------------------------------------------------------	
// this function loops through all the contacts in contact model and then sends them all a safe request (ie. all contacts belonging to a user)
// this action is taken from the tracking page

	function sendbulkrequestall() {
		//this function need to add the safe request the tbl_saferequest but in bulk as being done from the
		//tracking page via the modal select page
		
		
		$id = $this->session->userdata('id'); //this is the $user_id_from to be used in the insert query furthr down and the contact get query below
		
		$data_array = $this->contact_model->get_records_bulk($id); //get all the contacts for this user to be looped through and used in the $user_id_to
																   // of the model insert query further down
		
		
		
		foreach ($data_array as $data) {							
								
								$safe_request_status = 1; 
								$user_id_from = $this->session->userdata('id'); 						
								$create_time = date('Y-m-d\TH:i:sP');						
								 
								
								//print_r(implode(',',$data));
								$data = implode(',',$data); //The implode() function returns a string from the elements of an array, so these can be looped through 
															// and used in the insert query model below
									
								
								$this->saferequest_model->add_record_bulk($data, $safe_request_status, $user_id_from, $create_time);
							
							}	
							
		
		redirect('tracking/index');
		
	}	

	
// --------------------------------------------------------------------	
// this function loops through all the contacts in the group and then sends them all a safe request (ie. all members in the group)

	function sendbulkrequest() {
		//this function need to add the safe request the tbl_saferequest but in bulk as being done from the
		//group/view page
		
		
		//$id = $this->session->userdata('id'); //this is the $user_id_from to be used in the insert query furthr down and the contact get query below
		$id = $this->uri->segment(3,0); //this is the group_id being passed in URL
		$data_array = $this->group_model->get_member_records_bulk($id); //get all the contacts for this user to be looped through and used in the $user_id_to
																   // of the model insert query further down
		
		
		
		foreach ($data_array as $data) {							
								
								$safe_request_status = 1; 
								$user_id_from = $this->session->userdata('id'); 						
								$create_time = date('Y-m-d\TH:i:sP');						
								 
								
								//print_r(implode(',',$data));
								$data = implode(',',$data); //The implode() function returns a string from the elements of an array, so these can be looped through 
															// and used in the insert query model below
									
								
								$this->saferequest_model->add_record_bulk($data, $safe_request_status, $user_id_from, $create_time);
							
							}	
							
		
		//redirect('user/contactprofile/' . $user_id_to); 
		redirect('group/view/' . $this->uri->segment(3,0));
		
	}	
	
	
	
	
	
// --------------------------------------------------------------------	
// this function loops through all the contacts in contact model and then sends them all a safe notification (all members in the group)

	function sendbulknotification() {
		//this function need to add the safe request the tbl_saferequest but in bulk as being done from the
		//tracking page and then onto the contactmodal select contacts page
		
		
		$id = $this->session->userdata('id'); //this is the $user_id_from to be used in the insert query furthr down and the contact get query below
		
		$data_array = $this->contact_model->get_records_bulk($id); //get all the contacts for this user to be looped through and used in the $user_id_to
																   // of the model insert query further down
		
		
		
		foreach ($data_array as $data) {							
								
								$safe_request_status = 1; 
								$user_id_from = $this->session->userdata('id'); 						
								$create_time = date('Y-m-d\TH:i:sP');						
								 
								
								//print_r(implode(',',$data));
								$data = implode(',',$data); //The implode() function returns a string from the elements of an array, so these can be looped through 
															// and used in the insert query model below
									
								
								$this->saferequest_model->add_record_bulk($data, $safe_request_status, $user_id_from, $create_time);
							
							}	
							
		
		//redirect('user/contactprofile/' . $user_id_to); 
		redirect('group/view/' . $this->uri->segment(3,0));
		
	}	
		
	
	
}