<!-- on this page we list all the safe request received and allow the user to respond as safe or unsafe
we also list all the safe notifications sent by the user-->

<?php //print_r($invite_record); ?>



<h4>Tracking</h4>

<h5>Safe Requests Received <?php echo anchor('saferequest/send', '+Send Safe Request'); ?></h5> <!-- will need to go via contacts page to select the user to id -->

<table>
	<tr>
		<td>Requestor</td>
		<td>Date</td>
		<!-- <td>Status</td> leave for now. Do we need this? -->
		<td>Action</td>
	</tr>
	<?php foreach ($safe_request_received_record as $row):?>	
	<tr>
		<td><?php echo $row->user_id_from . ' ' . $row->first_name . ' ' . $row->last_name .' (' . $row->screen_name . ')'?></td> <!-- need to get user's name here with inner join -->
		<td><?php echo $row->create_time .' ' . $row->id ?></td>
		<!-- <td><?php //echo 'Pending' ?></td>  leave for now. Do we need this?-->
		<td><?php echo anchor('safenotification/send/1/' . $row->user_id_from . '/' . $row->id . '/2', 'Safe') . '|'; 
				  echo anchor('safenotification/send/2/' . $row->user_id_from. '/' . $row->id . '/2', 'Unsafe');?></td> 
	</tr>
	<?php endforeach;?>
	
</table>

<br /> <br />
<h5>Safe Notifications Sent <?php echo anchor('safenotification/create/' , '+Send Safe Notification');?></h5> <!-- will need to go via contacts page to select the user to id -->

<table>
	<tr>
		<td>Name</td>
		<td>Date</td>
		<td>Status</td>		
	</tr>
		<?php foreach ($safe_notification_sent_record as $row):?>	
	<tr>
		<td><?php echo $row->user_id_to . ' ' . $row->first_name . ' ' . $row->last_name .' (' . $row->screen_name .')' ?></td> <!-- need to get user's name here with inner join -->
		<td><?php echo $row->safe_notification_status ?></td> 
		<td><?php echo $row->create_time ?></td>
	</tr>
	<?php endforeach;?>
</table>

