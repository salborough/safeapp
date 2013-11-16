

<h2>Login</h2>



<?php 
	//still need to add in validation on fields
	echo form_open('login/validate_credentials');
	echo form_error('username');
	echo form_input('username', 'Username');
	
	echo form_error('password');
	echo form_password('password', 'Password');
	
	echo form_submit('submit', 'Submit');
	echo anchor('login/register', 'Create Account');
	
	echo form_close();

?>