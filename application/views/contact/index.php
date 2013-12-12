<!-- on this page we list all the contacts and allow the user to do various actions -->

<?php //print_r($contact_record); ?>

<h4> <?php echo anchor('invite/create', '< Groups'); ?> Contacts <?php echo anchor('invite/create', '+Invite Contact'); ?></h4>


<!-- still to do: put in search bar and sort options -->

<table>
	<tr>
		<td>Name (screen name)</td>
				
	</tr>
	<?php foreach ($contact_record as $row):?>	
	<tr>
		<td> <?php echo anchor( 'user/contactprofile/' . $row->id, $row->first_name . ' ' . $row->last_name .' (' . $row->screen_name . ')') ?> </td>	
		<td> </td>
		
	</tr>
	<tr>
		<td>safe</td> <!-- still to add latest status-->
		<td>10-12-2013</td> <!-- still to add latest status date updated-->
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<?php endforeach;?>
	
</table>

