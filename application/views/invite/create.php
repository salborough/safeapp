<!-- This view page is used to invite the other users to become contacts -->



	<h4><a href="javascript:history.back()">< back</a> Invite Contact</h4>
		
	<?php echo form_open('invite/inviteuser');?>
		<?php echo form_error('pin'); ?>
		<p><label for="pin">Safe App Pin</label>
		<input type="input" name="pin" id="pin" value="<?php echo set_value('pin'); ?>" /></p>
				
		<p><input type="submit" name="submit" value="Submit" /></p>
	
	<?php echo form_close();?>








