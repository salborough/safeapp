
<!--  this page I really need to complete - havent realy started yet -->
<h4> <?php echo anchor('user/view', 'Profile'); ?>  > Track Log</h4><!-- still to do need to work out how to make this dynamic-->

<hr/>
<?php echo $user_record['first_name'], ' ', $user_record['last_name'], ' (', $user_record['screen_name'], ')' ; ?> 
<hr />
<!-- list all the status updated and times below -->
<table>	
	<?php foreach ($tracklog_record as $row):?>	
	<tr>
		<td> <?php echo  $row->safe_notification_status .' '. $row->create_time;  ?> </td>	
		<td> GPS still to add</td>		
	</tr>	
	<?php endforeach;?>	
</table>
