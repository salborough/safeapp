<?php
// this controller handles all the tracking of the safe notifications sent and safe requests received per user logged in


class Tracking extends CI_Controller {
	
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
	
	//accesing user id from the session function
	
	function index() {
		// this function will return all the safe request records for this particular user (got from session)
		$id = $this->session->userdata('id'); //called this function to get user id from the session
		//print_r($id);
		
		$data['safe_request_received_record'] = $this->tracking_model->get_safe_request_records($id);
			
			if (empty($data['safe_request_received_record']))
			{
				echo 'no records found';
			}
		
		//this function gets all the safe notification sent by this user (id from session)	
		$data['safe_notification_sent_record'] = $this->tracking_model->get_safe_notification_records($id);
			
			if (empty($data['safe_notification_sent_record']))
			{
				echo 'no records found';
			}
		
		$page_title['title'] = 'Tracking';
		
		$this->load->view('templates/header', $page_title);		
		$this->load->view('tracking/index', $data);
		$this->load->view('templates/menu');
		$this->load->view('templates/footer');
		
	}

// --------------------------------------------------------------------

	
}