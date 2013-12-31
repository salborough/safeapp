<!-- on this page we list:
 -all the safe notifications from your contacts
 -all alerts for people that have not checked in
 -all the reminders 
 
 we will also have a button/action to send a broadcast safe notification to ALL your contacts
 -->


<h4>Home</h4>

<h5><?php echo anchor('safenotification/helpbroadcast', 'HELP!'); ?></h5> <!-- to send a broadcast safe notification to ALL your contacts -->

<br /> <br />
<h6>Alerts & Notifications</h6>
<table>	
		<?php foreach ($safenotification_record as $row):?>	
	<tr>
		<!-- <td> --> <?php //echo $row->user_id_from . ' ' . $row->first_name . ' ' . $row->last_name .' (' . $row->screen_name .')' ?> <!-- </td>  need to get users name here with inner join -->
		<td> <?php echo $row->first_name . ' ' . $row->last_name .' (' . $row->screen_name .')' ?></td>
		<td><?php echo $row->safe_notification_status ?></td> 
		<td><?php echo $row->create_time ?></td>
	</tr>
	<?php endforeach;?>
</table>
<br /> <br />

<!-- still to be built
<br /> <br />
<h6>Alerts / Notifications</h6> -->
