<!-- on this page we list all the contacts and allow selecting these users and submitting 
this page is used for sending bulk safe notifications from the tracking page-->

<?php //print_r($contact_record); ?>

<h4> <a href="javascript:history.back()">< back</a> Contacts </h4>


<?php echo form_open('safenotification/createbulknotification');?>
	<table>	
		<?php foreach ($contact_record as $row):?>	
		<tr>
			<td> <?php echo form_checkbox('contact[]', $row->contact, FALSE); ?></td>
			<td> <?php echo anchor( 'user/contactprofile/' . $row->id, $row->first_name . ' ' . $row->last_name .' (' . $row->screen_name . ')') ?> </td>	
		</tr>	
		<?php endforeach;?>	
		<tr>
			<td><?php 			
						
						//echo anchor('safenotification/sendbulknotification/1/', 'Safe') . '|'; 
				  		//echo anchor('safenotification/sendbulknotification/2/', 'Unsafe');
								
					?>
			</td> 
			<td></td>			
		</tr>
	</table>


<?php //echo form_submit('submit', 'Submit'); 
				echo form_submit('safe', 'Safe');
                echo form_submit('unsafe', 'Unsafe');
?>
	
<?php echo form_close();?>



