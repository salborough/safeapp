

	
	<h4><a href="javascript:history.back()">< back</a> Add Group</h4>
	
	<?php echo form_open('group/add_group');?>
		<?php echo form_error('group_name'); ?>
		<p><label for="group_name">Group Name</label>
		<input type="input" name="group_name" id="group_name" value="<?php echo set_value('group_name'); ?>" /></p>
		
				
		<?php //echo form_radio('Track Group', '0', NULL, 'id="track_group" '.set_radio('Track Group', '0')); ?>
		
		
	<!-- http://stackoverflow.com/questions/13261536/codeigniter-form-radio-with-set-value	-->
		
		
	
		<p><input type="submit" name="submit" value="Submit" /></p>
	
	<?php echo form_close();?>






