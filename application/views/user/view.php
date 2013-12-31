


<h4>Profile  <?php echo anchor('safenotification/tracklog/' . $user_record['id'], 'Track Log >'); ?>  </h4><!-- still to do -->

<hr/>


<p><label for="name">Name:</label> <?php echo $user_record['first_name'], ' ', $user_record['last_name'] ?> </p>
<p><label for="status">Status:</label> <?php echo $user_record['safe_notification_status']; ?></p>
<p><label for="gps">Last GPS:</label> <?php echo $user_record['gps']; ?></p>
<p><label for="username">Username (email):</label> <?php echo $user_record['username'] ?> </p>
<p><label for="screen_name">Screen Name:</label> <?php echo $user_record['screen_name'] ?> </p>
<p><label for="pin">Safe App Pin:</label> <?php echo $user_record['pin'] ?> </p>

<br /><br />
<p><label for="show_location">Show My Location:</label> still to do </p>
<p><label for="active_tracking">Active Tracking:</label> still to do </p>

<br /><br />
<p> <?php echo anchor('login/register', 'Set Reminder'); ?> </p> <!-- still need to build -->



<!-- still need to also addd in an edit action on this page -->
