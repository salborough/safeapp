<!-- on this page we list all the contacts and allow the user to do various actions -->

<?php //print_r($contact_record); ?>

<h2>My Contacts</h2>

<table>
	<tr>
		<td>Name (screen name)</td>
				
	</tr>
	<?php foreach ($contact_record as $row):?>	
	<tr>
		<td><?php echo $row->first_name . ' ' . $row->last_name .' (' . $row->screen_name . ')' ?></td> <!-- need to get user's name here with inner join -->	
	</tr>
	<?php endforeach;?>
	
</table>


