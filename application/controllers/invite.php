<?php
// this controller handles inviting users to become contacts, tracking the status of the invite
// deleting the invite request


class Invite extends CI_Controller {
	
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
	//note I orginally was passing $id to the index($id) function but no longer needed do to accessing
	//id from the session function
	
	function index() {
		// this function will return all the invite records for this particular user (got from session)
		$id = $this->session->userdata('id'); //called this function to get user id from the session
		print_r($id);
		
		$data['invite_record'] = $this->invite_model->get_records($id);
			
			if (empty($data['invite_record']))
			{
				echo 'no records found';
			}
		
		//this function gets all the invites sent by this user (id from session)	
		$data['invite_sent'] = $this->invite_model->get_invites_sent($id);
			
			if (empty($data['invite_sent']))
			{
				echo 'no records found';
			}
		
		$page_title['title'] = 'Manage Invites';
		
		$this->load->view('templates/header', $page_title);
		$this->load->view('templates/menu');
		$this->load->view('invite/index', $data);
		$this->load->view('templates/footer');
		
	}

// --------------------------------------------------------------------
	
	
	
	function create() {
		$page_title['title'] = 'Invite Person';
		
		$this->load->view('templates/header', $page_title);
		$this->load->view('templates/menu');
		$this->load->view('invite/create');
		$this->load->view('templates/footer');		
		
	}

// --------------------------------------------------------------------
	
	
	
	function inviteuser() {
		//load string helper to generate the 8 char random string
		$this->load->helper('string'); 
		
		//load the form validation class
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		//set the validation rules per field on the submitted form
		$this->form_validation->set_rules('pin', 'Pin', 'trim|htmlspecialchars|required|max_length[8]');
		
		
	
		if ($this->form_validation->run() == FALSE) 
			{
				$this->create();
			}
		else
			{					
				//get unique pin sumitted from form
				$data = $this->input->post('pin');				
			
				
				
				//need to get the user id that we want to send invite to with the unique submitted pin (can check is unique & there are records)							
				//$this->invite_model->get_user_id($data);

				$result = $this->invite_model->get_user_to($data);
				
				//print_r($result['id']);
				$user_id_to = $result['id'];
				
				
				//then I need to get this user's id (requester) from the session 
								
				$user_id_from = $this->session->userdata('id');
				
				
				//then I need to call the add_record to invite a user to become a contact, using the user_id_from & user_id_to 
				//with am invite status of 1 = pending (invite_status_id)
				$invite_status_id = 1;
				
				
				$data = array(
					'user_id_to' => $user_id_to,
					'user_id_from' => $user_id_from,
					'invite_status_id'	=> $invite_status_id,
					'create_time' => date('Y-m-d'),					
				);
				
				$this->invite_model->add_record($data);
				
				//Then need to redirect to the contact index page where we 
				//then list all the people that have been invited (pending) below the actual contacts
				//redirect('contact/index');
				redirect('invite/index');
			}
			
		
	}
	
	
	
// --------------------------------------------------------------------
	
	
	
	function reply() {
		//this function need to add a person to the tbl_contacts if their invite is accepted
		//and delete the invite record, 
		//else if the invite is decline then dont write to contacts and update invite status

		//use the uri segment 3 function to get action (accept or decline)
		//need to also pass the user_id_from id in to this function so know who to write to tbl_contacts
		$reply = $this->uri->segment(3,0);
		$user_id_from = $this->uri->segment(4,0);
		$id = $this->uri->segment(5,0); //this is the tbl_invite.id value -to be used to delete the record after accepting
		$user_id = $this->session->userdata('id'); //this comes from the sessions
		
		//print_r($user_id_from .''. $reply);
		
		if($reply==1){
			//write record into tbl_contacts & delete from tbl_invite
			//note going to need the user's id from session as well as the user_id_from  as the contact
			
			$data['user_id']= $user_id; //this is the actual user who's contact this becomes
			$data['contact']= $user_id_from; //this is the person who is the contact
			
			$this->contact_model->add_record($data);
				//$this->index();
			//redirect('invite/index');
			
			//now need to reciprocally insert contact
			$data['user_id']= $user_id_from; //this is the actual user who's contact this becomes
			$data['contact']= $user_id; //this is the person who is the contact
			$this->contact_model->add_record($data);
			
			
			//remove record from tbl_invite
			$this->invite_model->delete_records($id);
			redirect('invite/index');			
			//return;
			
		}
		
		elseif($reply==2){
			//dont write the invite record into the tbl_contacts & dont delete the record from the tbl_invite
			//just update the status in the tbl_invite to delined
			//need to consider changing the actions based on the status being declined -> perhaps actions
			//should be accept and ignore/delete?
			
			
			$data['invite_status_id']= 3; //3= declined			
			
			$this->invite_model->update_record($data, $id); //pass the invite status and the id of the invite as from above
			redirect('invite/index');
			//return;			
			
		}
		
		
	}	
	
	
	
}