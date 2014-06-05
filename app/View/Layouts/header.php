<header>
	<div class="wrapper">
		<a href="/"><div class="logo"></div></a>
      <ul class="website_nav">
          <li>
          	<a href="#" class="navlink" id="howitworks_nav">How It Works</a>
          </li>
          <li>
          	<a href="" class="navlink" id="ourservices_nav">Our Services</a>  
          </li>
          <li>
          <?php 
            if($logged_in):  
              
              //echo '<a href="/imeals/myaccount">My Account</a>';
              echo '<div class="myaccountlinks">';
             	echo '<a href="/users/logout">Logout</a>';
              	echo '<a href="/MyAccount">My Account</a>';
              echo '</div>';
              echo '<a id="myaccount">Welcome ' . $current_user['first_name'].'</a>';
              //echo '<div id="myaccountpopup" class="popover fade bottom in"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content">';
            	echo '<ul id="myaccountdropdown" class="dropdown-menu">
								<li><a href="/imeals/myaccount"><i class="icon-user"></i> My Account</a></li>
								<li class="divider"></li>
								<li><a href="/imeals/users/editAccount"><i class="icon-pencil"></i> Edit Account</a></li>
								<li class="divider"></li>
								<li><a href="/imeals/users/logout"><i class="icon-minus-sign"></i> Logout</a></li>
							</ul>';           
             // echo '</div></div>';
            else:
              echo $this->Html->link('My Account', array('controller' => 'MyAccount', 'action' => 'index'), array('class' => 'my_account_link')); 
            endif;
            //echo $this->Html->link($account_text, array('controller' => 'myaccount', 'action' => 'index'), array('class' => 'my_account_link')); 
          ?>
          </li>
          
      </ul><!-- .website -->
		</div><!-- .wrapper -->
</header><!-- header -->
<div class="wrapper">
	<div class="info_slidedown" id="howitworks">  
	  <div class="dropdown_content">         
			<div class="heading">
				The food you want, when you want it, <span class="red_font">in 3 easy steps</span>
			</div>
			<div id="howitworks_graphic"></div>
			<div class="howitworks_steps">
				<span class="blue_font">1</span>
				Simply order whatever you or your coworkers are hungry for at imeals.com from your computer or mobile device.
			</div>
			<div class="howitworks_steps">
				<span class="yellow_font">2</span>
				We beam your order to the restaurant and they send you a confirmation email with delivery or pickup time estimate.
			</div>
			<div class="howitworks_steps">
				<span class="darkblue_font">3</span>
				When your food's ready, the restaurant delivers it or you pick it up.  All you have to do is sign for it and enjoy it!
			</div>
		  	<div class="howitworks_button" style="margin-left: 270px;"><a class="lightblue_button" href="#">I'm Ready to Order</a></div>
		    <div class="howitworks_button"><a class="lightblue_button" href="/imeals/pages/services_summary">I Want to Learn More</a></div>
	  </div><!-- .dropdown_content -->
	  <div class="nav_border"></div>
	</div><!-- #howitworks -->  
		
	<div class="info_slidedown" id="ourservices">      
	  <div class="dropdown_content">       
		<div class="services virtualcafeteria vc">
			<span class="red_font">
				<div class="heading">Virtual Cafeteria</div>
				<div class="ourservices_content">
					Free Delivery at Work From Your Favorite Local Restaurants
				</div>
				<div class="ourservices_button red_button">
					<a href="/imeals/pages/virtual_cafeteria">Learn More & Enroll</a>
				</div>
			</span>
		</div><!-- .virtualcafeteria -->
		<div class="services meetingsevents me">
			<span class="darkblue_font">
				<div class="heading">Meetings and Events</div>
				<div class="ourservices_content">
					For Office Meetings and Corporate Events			
				</div>
				<div class="ourservices_button darkblue_button">
					<a href="/imeals/pages/meetings_events">Learn More & Enroll</a>
				</div>				
			</span>
		</div><!-- .meetingsevents -->
		<div class="services personalorders po">
			<span class="orange_font">
				<div class="heading">Personal Orders</div>		
				<div class="ourservices_content">
					Delivery and Carry Out from Dozens of Local Restaurants
				</div>
				<div class="ourservices_button orange_button">
					<a href="/imeals/pages/personal_orders">Learn More & Enroll</a>
				</div>				
			</span>
		</div><!-- .personalorders -->
	  </div> 
	  <div class="nav_border"></div>
	</div><!-- #ourservices -->  
</div>
<script>
	jQuery('#myaccountpopup').hide();
	jQuery('#myaccount').click(function(){
		jQuery('.dropdown-menu').toggle();
	});
</script>