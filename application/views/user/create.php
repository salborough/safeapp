

	<h2>Create</h2>
	<?php //have commented this out as choosing to put error messages above fields
	//echo validation_errors(); ?>
	
	<?php echo form_open('user/registeruser');?>
		<?php echo form_error('first_name'); ?>
		<p><label for="first_name">First Name</label>
		<input type="input" name="first_name" id="first_name" value="<?php echo set_value('first_name'); ?>" /></p>
		
		<?php echo form_error('last_name'); ?>
		<p><label for="last_name">Last Name</label>
		<input type="input" name="last_name" id="last_name" value="<?php echo set_value('last_name'); ?>"  /></p>
		
		<?php echo form_error('screen_name'); ?>
		<p><label for="screen_name">Screen Name</label>
		<input type="input" name="screen_name" id="screen_name" value="<?php echo set_value('screen_name'); ?>"  /></p>
		
		<?php echo form_error('username'); ?>
		<p><label for="username">Username(email)</label>
		<input type="input" name="username" id="username" value="<?php echo set_value('username'); ?>"  /></p>
		
		<!--<p><label for="email">Email</label>
		<input type="input" name="email" id="email" /></p>-->
		
		<?php echo form_error('password'); ?>
		<p><label for="password">Password</label>
		<input type="input" name="password" id="password" value="<?php echo set_value('password'); ?>"  /></p>
		
		<?php echo form_error('confirm_password'); ?>
		<p><label for="confirm_password">Password Confirm</label>
		<input type="input" name="confirm_password" id="confirm_password" value="<?php echo set_value('confirm_password'); ?>"  /></p>
	
		
	
		<p><input type="submit" name="submit" value="Submit" /></p>
	
	<?php echo form_close();?>



<?php 
	//echo form_input('first_name', set_value('first_name', 'First Name')); laternative way to do the above - more clean
?>




