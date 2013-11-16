
	<h2>You've created a Safe App Account!</h2>

	<p>An email has been sent to (email here) to confirm your account <br />
	- please click the link in the email to confirm your Safe App Account.</p>

	<p>Any future communications regarding your account will be sent to this email address.</p>

	<p><?php echo anchor('login/index', 'Login'); ?></p>
	
	<p><?php echo anchor('user/create', 'Try it again!'); ?></p>
	
	<p>
		<!-- http://www.technicalkeeda.com/php-codeigniter/how-to-generate-alphanumeric-unique-id-using-codeigniter
			https://github.com/EllisLab/CodeIgniter/wiki/Random-Password-Generator
			http://ellislab.com/codeigniter/user-guide/helpers/string_helper.html	-->
		<?php  
			//generate a random alpha numeric string 8 chars long
			//$this->load->helper('string'); 
			//$pin_data = random_string('alnum',8); 
			//echo random_string('alnum',8); 
			//echo $pin_data;
			//still need to check if this $pin_data value is unique before inserting into record
			//http://ellislab.com/codeigniter/user-guide/helpers/captcha_helper.html --> use sql queries and binds
			
			//insert random string into tbl_user.pin
			//$query = $this->db->insert_string($pin_data);
			//$this->db->query($query);
			
		?> 
	</p>
	
	
