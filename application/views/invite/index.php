<!-- on this page we list all the invites received and allow the user to accept or decline
once the accept this user will be written to the tbl_contact table -->

<?php //print_r($invite_record); ?>



<h4>Invites <?php echo anchor('invite/create', '+Invite Contact'); ?></h4>

<h5>Invites Received</h5>
<table>
	<tr>
		<td>Requestor</td>
		<td>Date</td>
		<td>Status</td>
		<td>Action</td>
	</tr>
	<?php foreach ($invite_record as $row):?>	
	<tr>
		<td><?php echo $row->user_id_from . ' ' . $row->first_name . ' ' . $row->last_name .' ' . $row->screen_name ?></td> <!-- need to get user's name here with inner join -->
		<td><?php echo $row->create_time ?></td>
		<td><?php echo $row->invite_status ?></td> 
		<td><?php echo anchor('invite/reply/1/' . $row->user_id_from . '/' . $row->id, 'Accept') . '|'; 
				  echo anchor('invite/reply/2/' . $row->user_id_from . '/' . $row->id, 'Decline');?></td> 
	</tr>
	<?php endforeach;?>
	
</table>

<h5>Invites Sent</h5> <!-- still to do -->
<table>
	<tr>
		<td>Name</td>
		<td>Date</td>
		<td>Status</td>		
	</tr>
		<?php foreach ($invite_sent as $row):?>	
	<tr>
		<td><?php echo $row->user_id_to . ' ' . $row->first_name . ' ' . $row->last_name .' ' . $row->screen_name ?></td> <!-- need to get user's name here with inner join -->
		<td><?php echo $row->create_time ?></td>
		<td><?php echo $row->invite_status ?></td> <!-- still need to bring in the invite status in query-->		
	</tr>
	<?php endforeach;?>
</table>

