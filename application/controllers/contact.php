<?php

class Contact extends CI_Controller {
	
	
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
	
	function index() {
		// this function will return all the contact records for this particular user (got from session)
		$id = $this->session->userdata('id'); //called this function to get user id from the session
		print_r($id);
		
		$data['contact_record'] = $this->contact_model->get_records($id);
			
			if (empty($data['contact_record']))
			{
				echo 'no records found';
			}
		
		
		$page_title['title'] = 'Contacts';
		
		$this->load->view('templates/header', $page_title);		
		$this->load->view('contact/index', $data);
		$this->load->view('templates/menu');
		$this->load->view('templates/footer');
		
	}
	
// --------------------------------------------------------------------		
	
	function indexmodal() {
		// this function will return all the contact records for this particular user (got from session)
		$id = $this->session->userdata('id'); //called this function to get user id from the session
		//print_r($id);
		
		$data['contact_record'] = $this->contact_model->get_records($id);
			
			if (empty($data['contact_record']))
			{
				echo 'no records found';
			}
		
		
		$page_title['title'] = 'Contacts Modal';
		
		$this->load->view('templates/header', $page_title);		
		$this->load->view('contact/indexmodal', $data);
		$this->load->view('templates/menu');
		$this->load->view('templates/footer');
		
	}
	
	
// --------------------------------------------------------------------		
// this fuction is used to list all the contacts for selection on bluk safe requests - via the tracking page
	
	function bulksaferequest() {
		// this function will return all the contact records for this particular user (got from session)
		$id = $this->session->userdata('id'); //called this function to get user id from the session
		//print_r($id);
		
		$data['contact_record'] = $this->contact_model->get_records($id);
			
			if (empty($data['contact_record']))
			{
				echo 'no records found';
			}
		
		
		$page_title['title'] = 'Contacts Modal';
		
		$this->load->view('templates/header', $page_title);		
		$this->load->view('contact/allcontacts', $data);
		$this->load->view('templates/menu');
		$this->load->view('templates/footer');
		
	}
		

	// --------------------------------------------------------------------		
// this fuction is used to list all the contacts for selection on bluk safe notification 
// via the tracking page
	
	function bulksafenotification() {
		// this function will return all the contact records for this particular user (got from session)
		$id = $this->session->userdata('id'); //called this function to get user id from the session
		//print_r($id);
		
		$data['contact_record'] = $this->contact_model->get_records($id);
			
			if (empty($data['contact_record']))
			{
				echo 'no records found';
			}
		
		
		$page_title['title'] = 'Contacts Modal';
		
		$this->load->view('templates/header', $page_title);		
		$this->load->view('contact/allcontactsnotification', $data);
		$this->load->view('templates/menu');
		$this->load->view('templates/footer');
		
	}
	
	
	
	
	
	
}