


<h4> <a href="javascript:history.back()">< back</a>  Group  </h4><!-- this gets the user id for the contact profile from the url -->

<hr/>

<h5><?php echo $group_record['group_name']; ?></h5>


<br /><br />
<p><label for="track_group">Track Group:</label> <?php echo $group_record['track_group']; ?> </p>
<p><label for="tracked_by_group">Tracked by Group:</label> <?php echo $group_record['tracked_by_group']; ?> </p>


<h6>Users in Group</h6>
<table>	
	<?php foreach ($group_member_record as $row):?>	
	<tr>
		<td> <?php echo $row->first_name . ' ' . $row->last_name .' (' . $row->screen_name . ')' ; ?>  </td>	
		<td> <?php echo anchor('group/deletemember/' . $row->id  . '/' . $row->group_id , 'Delete'); ?> </td>		
	</tr>
	
	<?php endforeach;?>
	
</table>

<br /><br />
<p> <?php echo anchor('group/deletegroup/' . $group_record['id'], 'Delete Group'); ?> </p> <!-- still need to build -->
<p> <?php echo anchor('contact/indexmodal/' . $group_record['id'], 'Add Contact to Group'); ?> </p>
<p> <?php echo anchor('saferequest/sendbulkrequest/' . $group_record['id'], 'Send Safe Request'); ?> </p> 
<p> <?php echo anchor('safenotification/createbulknotification/' . $group_record['id'] , 'Send Safe Notification');?>  </p>   
<p> <?php //echo anchor('saferequest/sendbulkrequest/' . $row->group_id, 'Send Safe Request'); ?> </p> 
<p> <?php //echo anchor('safenotification/createbulknotification/' . $row->group_id , 'Send Safe Notification');?>  </p>   
<!-- <p> --> <?php //echo anchor('login/register', 'Set Reminder'); ?> <!-- </p> still need to build -->




<!-- still need to also addd in an edit action on this page -->
