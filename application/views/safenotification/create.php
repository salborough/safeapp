<!-- This view page is used to send safe notifications to the other users -->



	<h4><a href="javascript:history.back()">< back</a> Safe Notification</h4>		
		
	<table>
		<tr>
			<td><?php echo anchor('safenotification/send/1/' . $user_id_to, 'Safe') . '|'; 
				  echo anchor('safenotification/send/2/' . $user_id_to, 'Unsafe');?>
			</td> 			
		</tr>
		<tr>
			<td>Cancel</td> <!-- still need to do -->
		</tr>
	
	
	</table>
			


<!-- 
1. need to pass user from id from the session - can do this in the controller
2. need to pass safe or unsafe status in URl segment
3. need to get the user_to_id from contact page coming from (in URL) and need to pass this in the URL to model

-->



