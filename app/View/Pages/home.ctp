<?php $_SESSION['orderid'] = null; ?>
<section id="home-intro">
	<div class="wrapper">
	    <div id="home-intro-lead">
	      The <span class="blue_font">easiest</span>, <span class="yellow_font">smartest</span> and <span class="red_font">best</span> way to order food from your favorite local restaurants.
	    </div><!-- #home-intro-lead -->
	    <div id="home-intro-start">
	    		<div id="home-intro-heading">
	    			<div class="heading"> Place your order</div><!-- .heading -->
    				<div id="swoosh"></div>
    			</div><!-- #home-intro-heading -->
    			<div id="home-intro-form">
		    			<div class="session_message">
		    				<?php if(isset($_GET['message']) && $_GET['message'] = 'invalid session') echo 'Sorry, your session has expired. Please enter your address below.<br>'; ?> 
		    			</div><!-- .session_message -->    		
		    			<div id="home-loader">
		    				<div class="loader_wrapper">
				    			<?php echo $this->Html->image('loader.gif', array('class' => 'loader_image')); ?>
			    			</div>
			    		</div>
		    			<?php echo $this->Form->create(); ?>
		    			<div id="delivery_pickup">
			    			<input type="hidden" name="option" value="pickup" id="ordertype" />
			    			<!--
							<div class="btn-group" data-toggle="buttons-radio" style="width: 285px;">  
							  	
							  <button id="btn-two" style="width: 100px; padding-top: 10px; margin-left: 3px;" type="button" data-toggle="button" name="option" value="pickup" 
							  	class="btn btn-primary btn-delivery-pickup <?php if((isset($type) && strtolower($type) == 'pickup') || !isset($type)) { echo 'active'; } ?> " onclick="hideshowZip('pickup')"><i class="icon-ok icon-white"></i>&nbsp;Pickup</button>
							  	
							  <div class="or">OR</div>
							  						  	
							  <button id="btn-one" style="width: 140px; padding-top: 10px; margin-left: 0px;" type="button" data-toggle="button" name="option" value="delivery" 
							  	class="btn btn-primary btn-delivery-pickup <?php if(isset($type) && strtolower(trim($type)) == 'delivery') { echo 'active'; } ?>" onclick="hideshowZip('delivery')"><i class="icon-ok icon-white"></i>&nbsp;Delivery</button>	
							  				  	
							</div>-->
								<span class="choosepickupdelivery">
									<input type="radio" name="pickupdelivery" value="pickup" onclick="hideshowZip('pickup')" checked="checked">Pickup<span class="pickupordeliver">OR</span>
								</span>
															
								<span class="choosepickupdelivery">
									<input type="radio" name="pickupdelivery" value="delivery" onclick="hideshowZip('delivery')" >Delivery
								</span>							

		    			</div>
		    		<a id="findMe" onclick="return findMe()">Find Me</a> 
		          	<input type="text" id="search_address" name="data[Search][search_address]" placeholder="Enter Your Address"/>
		            <input type="text" id="search_zipcode" name="data[Search][search_zipcode]" style="display:none;"/>
		            <div class="user_message">Ex: 123 Sycamore Street, Baton Rouge, LA</div>
	   			  	
	   			  	<div style="min-height: 40px;">
		   			   <div id="validation" class="alert alert-error" style="clear: both;"><?php if(isset($errors)) echo $errors; ?>
		   			   </div> 		            
					</div>
		            <input id="findMyFood" type="submit" value="Find My Food!" onclick="return validate_order_search()"/>
		                          		            		            
		            <!-- <a id="findMe"  onclick="return findMe()">Find Me</a> -->
		            <div id="findmeresults"></div>
		            <?php if(isset($errors)) { ?>
		            	<style>
		            		#validation { display: block; }
		            	</style>
		            <?php } ?>
		          <?php echo $this->Form->end(); ?>
          
          <!--          

    			<input type="text" id="search_address" placeholder="Street Address, City, and State"/>
    			<input type="text" id="search_zipcode" placeholder="Zip Code"/>
    			<ul id="validation"></ul>
    			<input type="button" value="Find My Food!" onclick="searchRestaurants_HomePage()"/>   
    			 			    			
          -->
			</div><!-- #home-intro-form -->
	    </div><!-- #home-intro-start -->	
	    <div id="promo_star"></div>    
	</div><!-- .wrapper -->
	<div id="home-intro-photo"></div><!-- #home-intro-photo -->
</section><!-- home-intro -->
<div id="content">
		<section id="home-section1">
			<div class="wrapper">
				<div class="sectioncaption">
					<div class="heading swoosh_sm">
						We know you’re busy. Why not have lunch delivered for free?
					</div><!-- .heading -->
					We offer delicious, hand-picked meals from the best 
					<br/>local restaurants.  Find fresh selections every day using <br/> 
					our <b>virtual cafeteria</b>.
					<br/>
					<a href="/pages/virtual_cafeteria" class="red_font arrow">Learn More</a>
				</div><!-- .sectioncaption -->
				<?php echo $this->Html->image('salmon_salad.png'); ?>
			</div>
		</section><!-- #home-section1 -->
		<section id="home-section2">
			<div class="wrapper">
				<?php echo $this->Html->image('me_people.png'); ?>
				<div class="sectioncaption">
					<div class="heading swoosh_sm">
						Have a Meeting?<br/>
						Let Us Bring the Entrees!
					</div><!-- .heading -->
					iMeals is perfect for your next meeting or event.  Our 
					<br/><b>Meetings and Events</b> service make ordering easy and cost effective.
					<br/>
					<a href="/pages/meetings_events" class="red_font arrow">Learn More</a>
				</div>
			</div>
		</section><!-- #home-section2 -->		
		<section id="home-section3">
			<div class="wrapper">
				<div class="heading">Connect With iMeals, Make Life a Little Easier</div><!-- .heading -->
				<div id="signup-company">
					<div class="heading">Sign Up Your Company</div><!-- .heading -->
					We help companies, too.  With a company account employees can order quickly and easily from restaurants
					, caterers and onsite dining facilities.
					<br/><br/>
					<a href="/pages/virtual_cafeteria" class="blue_font">Learn more about company accounts<span class="arrow_lightblue"></span></a>
					<div class="vendor-logos"></div>
					<br/>
					<div class="heading">Become a Restaurant Partner</div><!-- .heading -->
					Find out how we can help you grow your business and reach<br/>
					over a million individual and corporate members.
					<br/><br/>
					<a href="/pages/vendors" class="blue_font">Learn more about joining our network<span class="arrow_lightblue"></span></a>
				</div><!-- #signup-company -->
				<div id="follow-us">
					<div class="heading">Connect With Us</div><!-- .heading -->
					<ul class="social-icons">
						<li><a class="twitter"></a></li>
						<li><a class="facebook"></a></li>
						<li><a class="google"></a></li>
						<li><a class="linkedin"></a></li>
						<li><a class="rss"></a></li>
					</ul>
					<br/><br/>
					<?php echo $this->Html->image('hamburger_fries.png'); ?>
				</div><!-- #follow-us -->
			</div>
		</section><!-- #home-section3 -->
</div><!-- content -->

<?php echo $this->Html->script('jquery.anystretch.js'); ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="http://j.maxmind.com/app/geoip.js"></script><!-- For our fallback -->

<?php echo $this->Html->script('map.js'); ?>

<script type="text/javascript">
	jQuery(function() {		
		if( jQuery("#home-intro").length ){
    		jQuery("#home-intro-photo").anystretch('<?php echo Configure::read('mainurl'); ?>/img/slider1.png');
  		}
	});
	
	//Hide Zip Code
	jQuery('#search_zipcode').hide();
	
	function hideshowZip(type) {
	    jQuery('#validation').html('').hide();
		jQuery('#ordertype').val(type);	   

		if(type == 'delivery') {
			//jQuery('#search_zipcode').hide();
			//jQuery('.alert-error').fadeIn();
			//jQuery('.user_message').html('Enter Address, City, State');
			jQuery('#findMe').hide();
			jQuery('#search_address').css('padding','5px 10px 5px 10px');
			jQuery('#search_address').css('width','260px');
		}
		else if(type == 'pickup') {
			//jQuery('#search_zipcode').fadeIn();
			//jQuery('.alert-error').fadeIn();
			//jQuery('.user_message').html('Enter Address, City, State or Zip Code');
			jQuery('#findMe').show();
			jQuery('#findMe').css('margin-left','16px');
			jQuery('#search_address').css('padding','5px 10px 5px 50px');	
			jQuery('#search_address').css('width','220px');
		}
	}
	
	var addressInfo = new Array();
	
	function searchRestaurants_HomePage() {
		var address = jQuery('#search_address').val();
		var zip = jQuery('#search_zipcode').val();
		var type = jQuery('.btn-group').find('.active').val();
		
		if(zip != '')
			address = zip;

		searchRestaurants(address, type, true);
	}
	
	function validate_order_search() {
		jQuery('#home-loader').show();
		var errors = '';
		var address = jQuery('#search_address').val();
		var zip = jQuery('#search_zipcode').val();
		var type = jQuery('.btn-group').find('.active').val();
		console.log(zip + address);
		if(type == 'delivery'){
  		if(address==null || address==''){
    		jQuery('#validation').html('Please enter a valid address including street number & name, city, state.');
    		jQuery('#home-loader').hide();
    		return false;
  		}
		} else {
  		if((address==null || address=='')){
			jQuery('.alert-error').fadeIn();
    		jQuery('#validation').html('Please enter a valid address or zip code.');
    		jQuery('#home-loader').hide();
    		return false;
  		}
		}
		return true;
  }
  
  /* Find Me */
  function findMe() {
  	//$('#findMe').html('One moment....We are trying to find you.');
  	//$('#findMe').click(function () {
	    // test for presence of geolocation
	    jQuery('#search_address').val('We are looking for you...');
	    jQuery('#home-loader').show();
	    if(navigator && navigator.geolocation) {
	      // make the request for the user's position
	      navigator.geolocation.getCurrentPosition(geo_success, geo_error);
	    } else {
	      // use MaxMind IP to location API fallback
	      printAddress(geoip_latitude(), geoip_longitude(), true);
	    }
  	//});
  }
	 function geo_success(position) {
	  printAddress(position.coords.latitude, position.coords.longitude);
	}
 
	function geo_error(err) {
	  // instead of displaying an error, fall back to MaxMind IP to location library
	  printAddress(geoip_latitude(), geoip_longitude(), true);
	}
	 
	// use Google Maps API to reverse geocode our location
	function printAddress(latitude, longitude, isMaxMind) {
	  // set up the Geocoder object
	  var geocoder = new google.maps.Geocoder();
	 
	  // turn coordinates into an object
	  var yourLocation = new google.maps.LatLng(latitude, longitude);
	 
	  // find out info about our location
	  geocoder.geocode({ "latLng": yourLocation }, function (results, status) {
	    if(status == google.maps.GeocoderStatus.OK) {
	      if(results[0]) {
	      	
	        $("#findmeresults").fadeOut(function() {
	        	//$('#findMe').html('We found you!');
	        	debugger;
	        	var citystate = getCityState(results[0]['address_components']);
	          
	          //jQuery('#home-loader').fadeOut();
	          jQuery('#search_address').val(citystate);
	          jQuery('#findMyFood').click();
	          //$(this).html("<p><b>Abracadabra!</b> My guess is:</p><p><em>" + results[0].formatted_address + "</em></p>").fadeIn();
	        });
	      } else {
	      	jQuery('#home-loader').fadeOut();
	      	$('#findMe').html('Sorry we could not find you.  Try Again');
	        error("Google did not return any results.");
	      }
	    } else {
	      jQuery('#home-loader').fadeOut();
	      error("Reverse Geocoding failed due to: " + status);
	    }
	  });
	 
	  // if we used MaxMind for location, add attribution link
	  if(isMaxMind) {
	    //$("body").append('<p><a href="http://www.maxmind.com" target="_blank">IP to Location Service Provided by MaxMind</a></p>');
	  }
	}
	 
	function error(msg) {
	  alert(msg);
	}
	function getCityState(results) {
				var city, state, zip, streetnum, street;
				
	            $.each(results, function (i, address_component) {

                console.log('address_component:'+i);

                if (address_component.types[0] == "locality"){
                    city = address_component.long_name;
                }

                if (address_component.types[0] == "postal_code"){ 
                    zip = address_component.long_name;
                }

                if (address_component.types[0] == "street_number"){ 
                    streetnum = address_component.long_name;
                }
                
                if (address_component.types[0] == "route"){ 
                    street = address_component.long_name;
                }
                
                if (address_component.types[0] == "administrative_area_level_1"){ 
                    state = address_component.short_name;
                }
                
                //return false; // break the loop

            });
            
            if(city && state)
            	return city + ', ' + state;
            else
            	return false;
	}
  /* End findMe */
  
  //Set on click of order type buttons
  jQuery('.btn-group button').click(function(){
     jQuery('#btn-input').val(jQuery(this).val());
     jQuery('.alert-error').hide();
  });

</script>