<?php

class Login extends CI_Controller {

	function index() {
		
		$page_title['title'] = 'Login';
		
		$this->load->view('templates/header', $page_title);
		$this->load->view('user/login');
		$this->load->view('templates/footer');
		
	}
	
	
	
	function validate_credentials() {
		
		$query = $this->login_model->validate();
		
		if($query) //if the user's credentials validated...
		{
			$id = $query['id']; //returned data from the validate model query --> getting the user id
			
			$data = array (
			'username' => $this->input->post('username'),
			'id' => $id, 			
			'is_logged_in' => true		
			);
			
							
			
			$this->session->set_userdata($data);
			redirect('invite/index');
		}
		
		else 
		{
			$this->index();
		}
		
	}
	
	
	
	function register() {
		$page_title['title'] = 'Register';
		
		$this->load->view('templates/header', $page_title);
		$this->load->view('user/create');
		$this->load->view('templates/footer');		
		
	}
	
	
	//this function destroys the session and logs a user out - this would need to redirect to the login page
	function logout()
	{
		$this->session->sess_destroy();
		redirect('login/index');
		
	}
	
	
	
}