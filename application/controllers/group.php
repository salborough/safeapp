<?php
class Group extends CI_Controller {
	
	
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
		// this function will return all the group records created by this particular user (got from session)
		$id = $this->session->userdata('id'); //called this function to get user id from the session
		//print_r($id);
		
		$data['group_record'] = $this->group_model->get_records($id);
			
			if (empty($data['group_record']))
			{
				echo 'no records found';
			}
		
		
		$page_title['title'] = 'Groups';
		
		$this->load->view('templates/header', $page_title);		
		$this->load->view('group/index', $data);
		$this->load->view('templates/menu');
		$this->load->view('templates/footer');
		
	}
	

// --------------------------------------------------------------------

	function create() {
		//this function need to create new record in the tbl_group table
		
		$page_title['title'] = 'Add Group';
		
		$this->load->view('templates/header', $page_title);
		$this->load->view('group/create');
		$this->load->view('templates/menu');
		$this->load->view('templates/footer');	
		
	}

// --------------------------------------------------------------------

	function add_group() {
		
		//load string helper to generate the 8 char random string
		$this->load->helper('string'); 
		
		//load the form validation class
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//set the validation rules per field on the submitted form
		$this->form_validation->set_rules('group_name', 'Group Name', 'trim|htmlspecialchars|required|max_length[30]');
		
		if ($this->form_validation->run() == FALSE) 
			{
				$this->create();
			}
		else
			{	
			//need to also pass the user_id in to this function so know who to write to tbl_group as the created_by		
			$created_by = $this->session->userdata('id'); //called this function to get user id from the session
			
				
			
			$data = array(
						'group_name' => $this->input->post('group_name'),
						'created_by' => $created_by,	
						'track_group'=> 1,
						'tracked_by_group'=> 1,													
						'create_time' => date('Y-m-d\TH:i:sP'),  			
					);
					
				
			$this->group_model->add_record($data);
								
			//return;
			//redirect('group/index/' . $user_id_to); 
			redirect('group/index'); 
			
			}
		
		
	}		
	
// --------------------------------------------------------------------

	function view()
	{
		//need to check if user is logged in before displaying this page
		$this->is_logged_in();
		
		$id = $this->uri->segment(3); //this is the group id passed 
		
		//print_r($id);//get contact from user id posted in the URL
		
		//$data['user_record'] = $this->user_model->get_view_record($id);    //get_records($id); this was the old model used
		
		$data['group_record'] = $this->group_model->get_view_record($id); 
		
		
		if (empty($data['group_record']))
		{
			//show_404();
			echo 'no data';
			
		}
		
		//get group members by also passing group id
		$data['group_member_record'] = $this->group_model->get_member_records($id); 
		
		
		if (empty($data['group_member_record']))
		{
			//show_404();
			echo 'no data';
			
		}
		
		
		$page_title['title'] = 'Group';
	
		$this->load->view('templates/header', $page_title);		
		$this->load->view('group/view', $data);
		$this->load->view('templates/menu');
		$this->load->view('templates/footer');
	}
	
	
	// --------------------------------------------------------------------

	function deletemember() {
		//this function deletes the records in the tbl_group_member table --> action taken from group/view page
		
		$this->group_model->delete_member_record();			
		redirect('group/view/' . $this->uri->segment(4)); //passing group_id for redirect
		
	}
	
	
// --------------------------------------------------------------------

	function deletegroup() {
		//this function deletes all the records in the tbl_group_member table for that group-id & then 
		// also deletes the group in the tbl_group--> action taken from group/view page
		
		$this->group_model->delete_group_record();			
		redirect('group/index'); 
		
	}
	
// --------------------------------------------------------------------

	function addgroupmembers() {
		//load the form validation class
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		//set the validation rules per field on the submitted form
		//$this->form_validation->set_rules('pin', 'Pin', 'trim|htmlspecialchars|required|max_length[8]');
		
		
	
		//if ($this->form_validation->run() == FALSE) 
			//{
				//$this->create();
				//echo 'validation failed';
			//}
		//else
			//{			
					
						
						$data_array = $this->input->post('contact');		
						//print_r($data_array);
											
						
						foreach ($data_array as $data) {							
							
							//add group_id to array							
							
							$groupid = $this->input->post('group_id'); 							
							$create_time = date('Y-m-d\TH:i:sP');						
							
							//print_r($data);
							
							$this->group_model->add_member_record($data, $groupid, $create_time);
						
						}						
					
				
				redirect('group/view/' . $this->input->post('group_id')); //passing group_id for redirect
			//}
			
		
	}
	
	
}