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

	
	//original function (actioned off the contact profile page) through the safenotification/create page
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

	
	/*
	function send() {
		//this function need to add the safe notificationts the tbl_safenotifications
		
		
		//use the uri segment 3 function to get safe or unsafe status (safe or unsafe)
		//need to also pass the user_id_from  & user_id_to in to this function so know who to write to tbl_safenotification
		
		
		
		if ($this->uri->segment(4,0)== !NULL) {
			$user_id_to = $this->uri->segment(4,0); //need to get this passed in the URL from the create page
		
			$safe_notification_status = $this->uri->segment(3,0);				
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
						
			redirect('tracking/index/');
			
		}
		
		//below is the bulk safe notification coming from the group page
		else {
			$id = $this->session->userdata('id');		
			$data_array = $this->contact_model->get_records_bulk($id); //get all the contacts for this user to be looped through and used in the $user_id_to
																   // of the model insert query further down
		
				
			foreach ($data_array as $data) {							
									
				
									$safe_notification_status = $this->uri->segment(3,0);				
									//$user_id_from = $this->session->userdata('id');			
									//$safe_request_id = $this->uri->segment(5,0); //when on tracking page I need to reply to a safe request - we
																			// need to track to which safe request id it is in reposnse to --> using segment 5 to pass this safe request id
		
									$user_id_from = $id; 						
									$create_time = date('Y-m-d\TH:i:sP');						
									 
									
									//print_r(implode(',',$data));
									$data = implode(',',$data); //The implode() function returns a string from the elements of an array, so these can be looped through 
																// and used in the insert query model below
										
									
									$this->safenotification_model->add_record_bulk($data, $safe_notification_status, $user_id_from, $create_time);
								}	
								
			
			//redirect('user/contactprofile/' . $user_id_to); 
			redirect('group/view/' . $this->uri->segment(3,0));			
		}
		
		
		
	}	*/		
		
//-----------------------------------------------
//function for creating the page for the view for sending safe notification to bulk group members

	function createbulknotification() {
			
			if ($this->uri->segment(3,0) == !NULL) {
				$group_id['group_id'] = $this->uri->segment(3,0); //passed in the URL from the group/view page --> used for when sending notification to group
				
				//print_r($this->session->set_flashdata('refer', current_url()) ); 
				
				$page_title['title'] = 'Safe Notification';
				
				$this->load->view('templates/header', $page_title);
				$this->load->view('safenotification/createbulknotification', $group_id);
				$this->load->view('templates/menu');
				$this->load->view('templates/footer');	
			}

			else {
					
				if ($this->input->post('safe')) {
	            	            						
	            	$data_array = $this->input->post('contact');
	            	//print_r($data_array);
	            	
	            	foreach ($data_array as $data) {							
							
							//add group_id to array							
							
							$safe_notification_status = 1;	
							$user_id_from = $this->session->userdata('id');									
							$create_time = date('Y-m-d\TH:i:sP');														
									
									
							$this->safenotification_model->add_record_bulk($data, $safe_notification_status, $user_id_from, $create_time);
						
						}		
			
					redirect('tracking/index');	      	
	            	
	            	
				} 
				else {
            		            		
					$data_array = $this->input->post('contact');
					
					foreach ($data_array as $data) {							
							
							//add group_id to array							
							
							$safe_notification_status = 2;	
							$user_id_from = $this->session->userdata('id');									
							$create_time = date('Y-m-d\TH:i:sP');														
									
									
							$this->safenotification_model->add_record_bulk($data, $safe_notification_status, $user_id_from, $create_time);
						
						}		
			
					redirect('tracking/index');	  
					
        		}   
				
				
			}
			
		}	
		
	
	
	
//------------------------------------------------
//function for sending safe notification to all the members of a group --> actioned from the group page

	function sendbulknotification() {	
		
			
		if ($this->uri->segment(4,0) == !NULL) {
		
			$id = $this->uri->segment(4,0);	// this is the group_id passed from the create page
			$data_array = $this->group_model->get_member_records_bulk($id); //get all the contacts for this group to be looped through and used in the $user_id_to
																   // of the model insert query further down
		
				
			foreach ($data_array as $data) {							
									
				
									$safe_notification_status = $this->uri->segment(3,0);				
									//$user_id_from = $this->session->userdata('id');			
									//$safe_request_id = $this->uri->segment(5,0); //when on tracking page I need to reply to a safe request - we
																			// need to track to which safe request id it is in reposnse to --> using segment 5 to pass this safe request id
		
									$user_id_from = $this->session->userdata('id');						
									$create_time = date('Y-m-d\TH:i:sP');						
									 
									
									//print_r(implode(',',$data));
									$data = implode(',',$data); //The implode() function returns a string from the elements of an array, so these can be looped through 
																// and used in the insert query model below
										
									
									$this->safenotification_model->add_record_bulk($data, $safe_notification_status, $user_id_from, $create_time);
								}	
								
			
			
			redirect('group/view/' . $this->uri->segment(4,0));	

		}
		
		else {
			
			/*$id = $this->session->userdata('id');	
			$data_array = $this->contact_model->get_records_bulk($id);
			
			foreach ($data_array as $data) {							
									
				
									$safe_notification_status = $this->uri->segment(3,0);				
									//$user_id_from = $this->session->userdata('id');			
									//$safe_request_id = $this->uri->segment(5,0); //when on tracking page I need to reply to a safe request - we
																			// need to track to which safe request id it is in reposnse to --> using segment 5 to pass this safe request id
		
									$user_id_from = $this->session->userdata('id');						
									$create_time = date('Y-m-d\TH:i:sP');						
									 
									
									//print_r(implode(',',$data));
									$data = implode(',',$data); //The implode() function returns a string from the elements of an array, so these can be looped through 
																// and used in the insert query model below
										
									
									$this->safenotification_model->add_record_bulk($data, $safe_notification_status, $user_id_from, $create_time);
								}	*/
								
			$data_array = $this->input->post('contact');		
						//print_r($data_array);
											
						
						foreach ($data_array as $data) {							
							
							//add group_id to array							
							
							$groupid = $this->input->post('group_id'); 							
							$create_time = date('Y-m-d\TH:i:sP');						
							
							//print_r($data);
							
							$this->group_model->add_member_record($data, $groupid, $create_time);
						
						}		
			
			redirect('tracking/index');	
			
			
		}
		
		
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

		
// -----------------------------------------
// this function is used to send a unsafe braodcast notification to all your contacts
//actioned from the home page

	function helpbroadcast() {
		//this function need to add the safe notificationts the tbl_safenotifications to all your contacts with status of unsafe				
				
		$id = $this->session->userdata('id');
			
		//need to loop through all contacts  and enter in record for each contact
		
		$data_array = $this->contact_model->get_records_bulk($id);
		
		foreach ($data_array as $data) {							
							
							//add group_id to array							
							
							$safe_notification_status = 2;	
							$user_id_from = $this->session->userdata('id');									
							$create_time = date('Y-m-d\TH:i:sP');														
									
							$data = implode(',',$data);
									
							$this->safenotification_model->add_record_bulk($data, $safe_notification_status, $user_id_from, $create_time);
						
						}		
		
				
		redirect('dashboard/index');
	}	
	

	
	
}
