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
	
	
	
	
}