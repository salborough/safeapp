<?php

class User extends CI_Controller {
	
	
	//class used for checking for session		
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
		// still to put in code here - thinking it will be the safety tracking page and default home page
		$page_title['title'] = 'Home';
		
		$this->load->view('templates/header', $page_title);
		$this->load->view('user/index');
		$this->load->view('templates/footer');
		
	}

// --------------------------------------------------------------------

	function create() {
		$page_title['title'] = 'Register';
		
		$this->load->view('templates/header', $page_title);
		$this->load->view('user/create');
		$this->load->view('templates/footer');		
		
	}

// --------------------------------------------------------------------

	function registeruser() {
		//load string helper to generate the 8 char random string
		$this->load->helper('string'); 
		
		//load the form validation class
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		//set the validation rules per field on the submitted form
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|htmlspecialchars|required|max_length[100]');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|htmlspecialchars|required|max_length[100]');
		$this->form_validation->set_rules('screen_name', 'Screen Name', 'trim|required|min_length[3]|max_length[12]|is_unique[tbl_user.screen_name]');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|valid_email|is_unique[tbl_user.username]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]|matches[confirm_password]|md5');
		$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required');
		
	
		if ($this->form_validation->run() == FALSE) 
			{
				//$this->load->view('templates/header');
				//$this->load->view('user/create');
				//$this->load->view('templates/footer');
				$this->create();
			}
		else
			{
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'screen_name' => $this->input->post('screen_name'),
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password')		//might need to add the MD5 function: md5($this->input->post('password'))
				);
				
				
				//generate a random string for the pin & then add to the data array before inserting int the db
				//need to consider doing a unique check for duplicates before inserting to db
								
				$pin_data = random_string('alnum',8); 	
				$data = $data + array(pin=>$pin_data);
				//print_r($data);
				
				$this->user_model->add_record($data);
				//$this->index();
				redirect('user/registersuccess');
			}
			
		
	}
	
	
	

// --------------------------------------------------------------------
	
	function registersuccess() {
		$this->load->view('templates/header');
		$this->load->view('user/registersuccess');
		$this->load->view('templates/footer');		
		
	}
	
	
	
	
// --------------------------------------------------------------------
	
	function view()
	{
		//need to check if user is logged in before displaying this page
		$this->is_logged_in();
		
		$id = $this->session->userdata('id'); //called this function to get user id from the session
		print_r($id);
		
		$data['user_record'] = $this->user_model->get_records($id);
		
		if (empty($data['user_record']))
		{
			show_404();
		}

		$page_title['title'] = 'Profile';
	
		$this->load->view('templates/header', $page_title);
		$this->load->view('templates/menu');
		$this->load->view('user/view', $data);
		$this->load->view('templates/footer');
	}
	
	
}