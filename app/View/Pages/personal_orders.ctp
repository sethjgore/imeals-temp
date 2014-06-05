<div id="personal_orders">
	<div class="wrapper">
		<div class="personal_orders_content">
			<div class="heading">Have a Personal Order Delivered to <br/>Your Doorstep <span class="red_font"><i>in Minutes!</i></span></div><!-- heading -->
			<b>Enter your address on the right to get started.</b>
			<br/><br/>
			That's it, two easy paths to food happiness!  Think of all the delicious food that's waiting to<br/> 
			be delivered.  If you create an account you'll have access to your recent orders, bookmarks, and favorite meals.  Can we remind you
			how fantastic, fast, and easy iMeals is?
		</div><!-- .personal_orders_content -->
	</div><!-- .wrapper -->
	<div id="placeyourorder">
	    <div id="home-intro-start">
    			<div class="heading blue_font"> Place your order</div><!-- .heading -->
    			<div id="swoosh"></div>
    			<div class="session_message">
    				<?php if(isset($_GET['message']) && $_GET['message'] = 'invalid session') echo 'Sorry, your session has expired. Please enter your address below.<br>'; ?> 
    			</div><!-- .session_message -->    		
    			
    			<?php echo $this->Form->create(); ?>
    			<div id="delivery_pickup">
	    			<input type="hidden" name="option" value="pickup" id="btn-input" />
					<div class="btn-group" data-toggle="buttons-radio" style="width: 400px;">  
					  <button id="btn-one" style="width: 142px; padding-top: 10px; margin-left: -15px;" type="button" data-toggle="button" name="option" value="delivery" 
					  	class="btn btn-primary btn-delivery-pickup" onclick="hideshowZip('delivery')"><i class="icon-ok icon-white"></i>&nbsp;Delivery</button>
					  	<div class="or">OR</div>
					  <button id="btn-two" style="width: 142px; padding-top: 10px; margin-left: 3px;" type="button" data-toggle="button" name="option" value="pickup" 
					  	class="btn btn-primary btn-delivery-pickup active" onclick="hideshowZip('pickup')"><i class="icon-ok icon-white"></i>&nbsp;Pickup</button>
					</div>
    			</div>
          	<input type="text" id="search_address" name="data[Search][search_address]" placeholder="Enter Address"/>
            <input type="text" id="search_zipcode" name="data[Search][search_zipcode]" style="display:none;"/>
            <!-- <div class="user_message">Enter Address, City, State or Zip Code</div> -->
            
            <input type="submit" value="Find My Food!" onclick="return validate_order_search()"/>
            <div class="alert alert-error" style="display:none;">
			   <div id="validation"><?php if(isset($errors)) echo $errors; ?></div>            
			</div>            
          <?php echo $this->Form->end(); ?>
          
          <!--          

    			<input type="text" id="search_address" placeholder="Street Address, City, and State"/>
    			<input type="text" id="search_zipcode" placeholder="Zip Code"/>
    			<ul id="validation"></ul>
    			<input type="button" value="Find My Food!" onclick="searchRestaurants_HomePage()"/>   
    			 			    			
          -->

	    </div><!-- #home-intro-start -->	
	</div><!-- #placeyourorder -->
</div><!-- #personal_orders -->