
<script>
	jQuery('.navlink').click( function(e) {
		e.preventDefault();
		if($(this).attr('id') == "howitworks_nav") {
			$('#ourservices').fadeOut(200);
			$('#howitworks').stop().slideToggle(1000, 'easeOutQuart', function() {
				
			});
			
		}
			
		else if($(this).attr('id') == "ourservices_nav") {
			$('#howitworks').fadeOut(200);
			$('#ourservices').stop().slideToggle(1000, 'easeOutQuart');
		}
			
	});
</script>


<footer>
	<div class="wrapper">
		<div id="footer_logo">
			<a href="/imeals"><div class="logo"></div></a>
		</div><!-- #footer_logo -->
		<div id="footer_nav">
			<table>
				<tr>
					<th>Company</th>
					<th>Servics</th>
					<th>Vendors</th>
				</tr>
				<tr>
					<td><a href="">Jobs</a></td>
					<td><a href="/pages/virtual_cafeteria">Virtual Cafeteria</a></td>
					<td><a href="/MyAccount">Vendor Login</a></td>								
				</tr>
				<tr>
					<td><a href="/pages/user_agreement">User Agreement</a></td>
					<td><a href="/pages/meetings_events">Meetings & Events</a></td>
					<td><a href="/pages/vendors">Vendor Services</a></td>								
				</tr>
				<tr>
					<td><a href="/pages/privacy">Privacy</a></td>
					<td><a href="/pages/personal_orders">Personal Orders</a></td>
					<td></td>								
				</tr>
				<tr>
					<td><a href="/contact">Contact Us</a></td>
					<td></td>
					<td></td>								
				</tr>									
			</table>
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="#">About</a></li>
				<li><a href="#">Our Services</a></li>						
				<li><a href="#">My Account</a></li>			
			</ul>
		</div><!-- #footer_nav -->
		<div id="footer_invite">
			Tell a friend about <br/>iMeals today!
			<br>
			<div class="lightblue_button"><a href="#">Invite Now</a></div>
		</div><!-- #footer_invite -->
		<div class="rights">
				2012 &copy; iMeals. All Rights Reserved.
		</div>
	</div><!-- .wrapper -->	
</footer>
