<?php
// this controller handles sending users safe notifications


class Safenotification extends CI_Controller {
	
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

	
	
function create() {
	
		$user_id_to['user_id_to'] = $this->uri->segment(3,0); //need to get this passed in the URL from the contact profile page	
	
		$page_title['title'] = 'Safe Notification';
		
		$this->load->view('templates/header', $page_title);
		$this->load->view('safenotification/create', $user_id_to);
		$this->load->view('templates/menu');
		$this->load->view('templates/footer');		
		
	}
	
// ---------------------------------------------------------------

	
	
	function send() {
		//this function need to add the safe notificationts the tbl_safenotifications
		
		
		//use the uri segment 3 function to get safe or unsafe status (safe or unsafe)
		//need to also pass the user_id_from  & user_id_to in to this function so know who to write to tbl_safenotification
		$safe_notification_status = $this->uri->segment(3,0);
		$user_id_to = $this->uri->segment(4,0); //need to get this passed in the URL from the create page
				
		$user_id_from = $this->session->userdata('id');
			
		$safe_request_id = $this->uri->segment(5,0); //when on tracking page I need to reply to a safe request - we
												// need to track to which safe request id it is in reposnse to --> using segment 5 to pass this safe request id
		
		$data = array(
					'user_id_to' => $user_id_to,
					'user_id_from' => $user_id_from,
					'safe_notification_status'	=> $safe_notification_status,
					'safe_request_id' => $safe_request_id,
					'create_time' => date('Y-m-d\TH:i:sP'),  			
				);
			
		$this->safenotification_model->add_record($data);

		//code to update the tbl_saferequest with a status of replied (thus coming from the tracking page as a reply)
		if ($safe_request_id =!NULL) {
						
			$id = $this->uri->segment(5,0); //passing the saferequest id in segment 5 of URL
			$data = $this->uri->segment(6,0); //passing the saferequest status in segment 6 of URL
			$this->saferequest_model->update_safe_request_status($id, $data);			
			
		}
		//redirect('user/contactprofile/' . $user_id_to); //might need to thnk of perhaps going to tracking page or
														//passing a success message back to contactprofile page
		
		redirect('tracking/index/');
	}			
		
		
// -----------------------------------------------
function tracklog() {
	
		//need to check if user is logged in before displaying this page
		$this->is_logged_in();
		
		$id = $this->uri->segment(3,0); //need to get this passed in the URL from the contact profile page	
	
		$data['tracklog_record'] = $this->safenotification_model->get_tracklog_records($id);
				
				if (empty($data['tracklog_record']))
				{
					//show_404();
					echo 'no data';
					
				}
		
		//$userdata['user_record'] = $this->user_model->get_records($id);
		
		//if (empty($userdata['user_record']))
		//{
			//show_404();
			//echo 'no user data';
		//}		
		
		
		$data['user_record'] = $this->user_model->get_records($id); //gets the users first name, last name and screen name
				
				
		$page_title['title'] = 'Track Log';
		
		$this->load->view('templates/header', $page_title);
		$this->load->view('safenotification/tracklog', $data);
		$this->load->view('templates/menu');
		$this->load->view('templates/footer');		
		
	}		

	
	
}
