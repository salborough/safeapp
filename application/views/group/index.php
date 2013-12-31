<!-- on this page we list all the groups and allow the user to do various actions -->

<?php //print_r($contact_record); ?>

<h4> <?php echo anchor('contact/index', '< Contacts'); ?> Groups <?php echo anchor('group/create', '+Add Group'); ?></h4>


<!-- still to do: put in search bar and sort options -->

<table>	
	<?php foreach ($group_record as $row):?>	
	<tr>
		<td> <?php echo anchor( 'group/view/' . $row->id, $row->group_name ) ; ?> </td>	
		<td> <?php echo $row->track_group .' ' . $row->tracked_by_group; ?> </td>		
	</tr>
	
	<?php endforeach;?>
	
</table>

