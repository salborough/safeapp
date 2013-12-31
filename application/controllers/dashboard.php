<?php


class Dashboard extends CI_Controller {
	
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
		
		$id = $this->session->userdata('id'); //called this function to get user id from the session
		print_r($id);
		
		$data['safenotification_record'] = $this->safenotification_model->get_all_safenotification_records($id);
			
			if (empty($data['safenotification_record']))
			{
				echo 'no records found';				
				
			}
			
		$page_title['title'] = 'Home';
		
		$this->load->view('templates/header', $page_title);
		$this->load->view('dashboard/index', $data);
		$this->load->view('templates/menu');
		$this->load->view('templates/footer');		
		
	}
	

	
	
}