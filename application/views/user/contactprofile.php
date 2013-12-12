


<h4> <?php echo anchor('contact/index', ' < Contacts'); ?> Profile  <?php echo anchor('safenotification/tracklog/' . $user_record['id'], 'Track Log >'); ?> </h4><!-- this gets the user id for the contact profile from the url -->

<hr/>

<p><label for="name">Name:</label> <?php echo $user_record['first_name'], ' ', $user_record['last_name'] ?> </p>
<p><label for="status">Status:</label> still to come</p>
<p><label for="gps">Last GPS:</label> still to come</p>
<p><label for="screen_name">Screen Name:</label> <?php echo $user_record['screen_name'] ?> </p>
<p><label for="pin">Safe App Pin:</label> <?php echo $user_record['pin'] ?> </p>

<br /><br />
<p><label for="show_location">Track Contact:</label> still to do </p>
<p><label for="active_tracking">Be Tracked by Contact:</label> still to do </p>

<br /><br />
<p> <?php echo anchor('login/register', 'Delete Contact'); ?> </p> <!-- still need to build -->
<p> <?php echo anchor('login/register', 'Call Contact'); ?> </p> <!-- still need to build -->
<p> <?php echo anchor('saferequest/send/' . $user_record['id'] . '/1', 'Send Safe Request'); ?> </p> <!-- still need to build -->
<p> <?php echo anchor('safenotification/create/' . $user_record['id'] , 'Send Safe Notification');?> </p> 
<p> <?php echo anchor('login/register', 'Set Reminder'); ?> </p> <!-- still need to build -->



<!-- Google maps to go here -->

<!-- still need to also addd in an edit action on this page -->
