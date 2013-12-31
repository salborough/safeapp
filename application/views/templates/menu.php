<!-- this is a general menu -->

<hr />
<table>
  <tr>
    <td><?php echo anchor('dashboard/index', 'Home'); ?></td> <!-- still to come -->    
    <td><?php echo anchor('contact/index', 'Contacts'); ?></td>
    <td><?php echo anchor('tracking/index', 'Tracking'); ?></td> 
    <td><?php echo anchor('invite/index', 'Invites'); ?></td> <!-- note invites will probably be on the contacts page so will probably do away with this -->
    <td><?php echo anchor('user/view', 'My Profile'); ?></td>
    <td><?php echo anchor('login/logout', 'Logout'); ?></td> <!-- still to build -->
  </tr>
</table>


