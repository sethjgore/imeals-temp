<?php 

?>
<div id="confirmation">
	<div class="thanks">
		<h1 class="red_font">Thank You For Your Order!</h1>
		<br/>
		
		<?php if(isset($isnew)) { ?> 
		<div class="new_user lightblue_background">
			<div class="smile"></div>
			We see that you’re new here, thanks for trying iMeals! We’ve created your accounting using your email address and password, so next time you order we will remember your address and favorite foods.  
			We’ve also sent you a confirmation email with all of the information you’ll need to make iMeals even easier next time.  Thanks again for trying iMeals!
		</div><!-- .new_user -->
		<?php } ?>
		<div class="orderdetails">
			Your order (<span class="blue_font">#<?php echo $order[0]['Order']['id']; ?></span>) for $<?php echo $order[0]['Order']['total']; ?> on 
			<?php echo date('l, F jS, Y \a\t g:i A', strtotime($order[0]['Order']['created'])); ?> has been sent over to the kitchen at <?php echo $restaurant['Restaurant']['name']; ?>. Expect an email soon to confirm that they’re cooking up your food and get ready to pick it up at the scheduled time.
		</div> <!--.orderdetails -->
		<?php if (trim($_SESSION['ordertype']) == 'pickup') { ?>
		<h2 class="red_font">What Happens Now?</h2>
		<div class="steps">
			<span class="num">1</span>The restaurant will confirm your order through our system.<br/><br/><br/>
			<span class="num">2</span>Our system will generate a confirmation email that is sent to your inbox, then:<br/><br/><br/>
			<span class="num">3</span>The restaurant prepares your meal for pickup<br/><br/><br/>
		</div><!-- .steps -->
		<h2><span class="red_font">Where and When Do I Pickup My Meal?</span></h2>
		<div class="orderdirections">
			<div class="details">
				<span class="restaurantname"><?php echo $restaurant['Restaurant']['name']; ?></span><br/>
				<?php echo $restaurant['Restaurant']['address']; ?> <br/>
				<?php echo $restaurant['City']['name'].', '.$restaurant['BillingState']['full_name'].' '.$restaurant['Restaurant']['zip'];; ?> <br/>
				<br/>
				<b>Order for Pickup</b> <br/>
				<?php echo $order[0]['User']['first_name'].' '.$order[0]['User']['last_name']; ?><br/>
				<?php echo $order[0]['User']['phone']; ?><br/>
				<br/>
				<?php if($order[0]['Order']['special_instructions'] != null) { ?>
				<b>Pickup Instructions</b><br/>
				<?php echo $order[0]['Order']['special_instructions']; ?>
				<?php } ?>
			</div>
			<div id="map">
			</div>
			<div class="car"></div>			
			<div class="time">
				Estimated Pickup Time: 
					<br>
					<span class="red_font"><?php echo date('l F jS \a\t g:i A', strtotime($order[0]['Order']['order_date'])); ?></span>
			</div>
		</div><!-- .orderdirections -->
	<?php } ?>
	<?php if(trim($_SESSION['ordertype']) == 'delivery') { ?>
		<h2 class="red_font">What Happens Now?</h2>
		<div class="steps">
			<span class="num">1</span>The restaurant will confirm your order through our system.<br/><br/><br/>
			<span class="num">2</span>Our system will generate a confirmation email that is sent to your inbox, then:<br/><br/><br/>
			<span class="num">3</span>The restaurant prepares your meal for pickup<br/><br/><br/>
		</div>
		<h2>We are on the way!</h2>
		<div class="orderdirections">
			<div class="details">
				<span class="restaurantname"><?php echo $restaurant['Restaurant']['name']; ?></span><br/>
				<?php echo $restaurant['Restaurant']['address']; ?> <br/>
				<?php echo $restaurant['City']['name'].', '.$restaurant['BillingState']['full_name'].' '.$restaurant['Restaurant']['zip'];; ?> <br/>
				<br/>
				<b>Order for Delivery</b> <br/>
				<?php echo $order[0]['User']['first_name'].' '.$order[0]['User']['last_name']; ?><br/>
				<?php echo $order[0]['User']['phone']; ?><br/>
				<br/>
				<?php if($order[0]['Order']['special_instructions'] != null) { ?>
				<b>Pickup Instructions</b><br/>
				<?php echo $order[0]['Order']['special_instructions']; ?>
				<?php } ?>
			</div>			
			<div class="time">
				Estimated Delivery Time: 
					<br>
					<span class="red_font"><?php echo date('l F jS \a\t g:i A', strtotime($order[0]['Order']['order_date'])); ?></span>
			</div>
		</div><!-- .orderdirections -->
	<?php } ?>	
	</div><!-- .thanks -->	
	<div class="social">
		<div id="follow-us">
			<h2 class="lightblue_font">Connect with iMeals</h2>
			<ul class="social-icons">
				<li><a class="twitter"></a></li>
				<li><a class="facebook"></a></li>
				<li><a class="google"></a></li>
				<li><a class="linkedin"></a></li>
				<li><a class="rss"></a></li>
			</ul>
		</div><!-- #follow-us" -->
		<div class="refer-friend"></div>
	</div><!-- .social -->		
</div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
	//Load Pickup Location 
  	initialize();
	function initialize() {

	var address = '<?php echo $restaurant['Restaurant']['address'].' '.$restaurant['City']['name'].', '.$restaurant['BillingState']['full_name']; ?>';
	
	var map = new google.maps.Map(document.getElementById('map'), { 
	   mapTypeId: google.maps.MapTypeId.TERRAIN,
	   zoom: 15,
	   scrollwheel: false
	});
	var geocoder = new google.maps.Geocoder();
	
	geocoder.geocode({
	  'address': address
	}, 
	function(results, status) {
	  if(status == google.maps.GeocoderStatus.OK) {
	     new google.maps.Marker({
	        position: results[0].geometry.location,
	        map: map
	     });
	     map.setCenter(results[0].geometry.location);
	  }
	});
	
	}

</script>