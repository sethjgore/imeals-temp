<!DOCTYPE HTML>
<html lang="en">
<head>
<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$strAction = $this->plugin.$this->name.$this->request->action;
$menus = array();
$menus['AuthAclAuthAclindex'] = 1;
$menus['Usersindex'] = 2; // User menu
$menus['Usersadd'] = 2;
$menus['Usersview'] = 2;
$menus['Groupsindex'] = 2;
$menus['AuthAclPermissionsindex'] = 2;
$menus['AuthAclPermissionsuser'] = 2;
$menus['AuthAclPermissionsuserPermission'] = 2;

$menus['ArticleArticlesindex'] = 3;
$menus['ArticleCategoriesindex'] = 3;

$menus['AuthAclSettingsindex'] = 4;
$menus['AuthAclSettingsemail'] = 4;
$menus['AuthAclUserseditAccount'] = 5;

$menus['Citiesadd'] = 6;
$menus['Citiesindex']=6;

$menus['Cuisinesindex']=7;
$menus['Cuisinesadd']=7;
//echo $strAction;
?>

	<?php echo $this->Html->charset(); ?>
	<title>
		iMeals | Order Food Online
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
		
		echo $this->Html->css('reset');
		?>
		<link href="<?php echo $this->request->webroot; ?>bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="<?php echo $this->request->webroot; ?>bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
		<link href="<?php echo $this->request->webroot; ?>bootstrap-modal/css/animate.min.css" rel="stylesheet">
		<link href="<?php echo $this->request->webroot; ?>css/validationEngine.jquery.css" rel="stylesheet">
		
		<!-- Custom Web Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Lobster+Two:400,700' rel='stylesheet' type='text/css'>
	
	<?php
  	
  	//Add Main Style CSS
    echo $this->Html->css('style');
    
    		
		//Add jQuery and jQuery UI

    echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
    echo $this->Html->script('jquery-migrate.js'); 
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js');	

		// Add jQuery Cookies
		echo $this->Html->script('jquery.cookie.js');
		// Add bootstrap js
		echo $this->Html->script('jquery.bootstrap.js');
		echo $this->Html->script('bootstrap.modal.js');
		//Add Custom JS Functions
    echo $this->Html->script('functions.js');
		
		//Add jQuery Validation engine localization file
    echo $this->Html->script('jquery.validationEngine-en.js');
    //Add jQuery validation engine
    echo $this->Html->script('jquery.validationEngine.js');
	
    //Call an JS functions needed on certain pages
    echo $this->fetch('css');
    echo $this->fetch('script');
		
		//Echo code created for Ajax Calls
		echo $this->Js->writeBuffer(array('cache'=>TRUE));

  ?>

	<script type="text/javascript">var imealsBaseUrl = '<?php echo $this->Html->url('/'); ?>';</script>

</head>
<body class="admin_page">
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
                        $account_text = 'Welcome ' . $current_user['first_name']; 
                      else:
                        $account_text = 'My Account';
                      endif;
                      echo $this->Html->link($account_text, array('controller' => 'MyAccount', 'action' => 'index'), array('class' => 'my_account_link')); 
                    ?>
                    </li>
                    
                </ul><!-- .website -->
		</div><!-- .wrapper -->
</header><!-- header -->
<div class="wrapper">
	<div class="info_slidedown" id="howitworks">  
	  <div class="dropdown_content">         
			<heading>
				The food you want, when you want it, <span class="red_font">in 3 easy steps</span>
			</heading>
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
				<span class="darkblue_font">3</span></td>
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
				<heading>Virtual Cafeteria</heading>
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
				<heading>Meetings and Events</heading>
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
				<heading>Personal Orders</heading>		
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

<div class="wrapper" id="admin_wrapper">
	<?php if ($this->Acl->check('Dashboard','index') == true){?>
	<div class="navbar " id="mnu_admin_top">
		<div class="navbar-inner">
			<div class="container">
				<button type="button" class="btn btn-navbar" data-toggle="collapse"
					data-target=".nav-collapse">
					<span class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<div class="nav-collapse collapse">
					<ul class="nav">
						<?php if ($this->Acl->check('Dashboard','index') == true){?>
						<li	class="<?php if (isset($menus[$strAction]) && (int)$menus[$strAction] == 1){?> active <?php }?>">
							<?php echo $this->Html->link( __('Admin Dashboard'), array('plugin'=>false,'controller' => 'dashboard','action' => 'index')); ?>			
						</li>
						<?php } ?>
						<?php if ($this->Acl->check('Cities','index') == true){?>
						<li
							class="dropdown <?php if (isset($menus[$strAction]) && (int)$menus[$strAction] == 6){?> active <?php }?>"><a
							data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo __('Cities'); ?>
								<b class="caret"></b> </a>
							<ul class="dropdown-menu">
								<?php if ($this->Acl->check('Cities','view') == true){?>
									<li><?php echo $this->Html->link(__('View Cities'), array('plugin' => false,'controller' => 'cities','action' => 'index')); ?></li>
								<?php } ?>
								<?php if ($this->Acl->check('Cities','add') == true){?>
									<li><?php echo $this->Html->link(__('Add City'), array('plugin' => false,'controller' => 'cities','action' => 'add')); ?></li>
								<?php }?>
							</ul></li>
						<?php } ?>
						<?php if ($this->Acl->check('Cuisines','index') == true){?>
						<li
							class="dropdown <?php if (isset($menus[$strAction]) && (int)$menus[$strAction] == 7){?> active <?php }?>"><a
							data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo __('Cuisines'); ?>
								<b class="caret"></b> </a>
							<ul class="dropdown-menu">
								<?php if ($this->Acl->check('Cuisines','view') == true){?>
									<li><?php echo $this->Html->link(__('View Cuisines'), array('plugin' => false,'controller' => 'cuisines','action' => 'index')); ?></li>
								<?php } ?>
								<?php if ($this->Acl->check('Cuisines','add') == true){?>
									<li><?php echo $this->Html->link(__('Add Cuisines'), array('plugin' => false,'controller' => 'cuisines','action' => 'add')); ?></li>
								<?php }?>
							</ul></li>
						<?php } ?>
						<?php if ($this->Acl->check('Dashboard','index') == true){?>
						<li>
							<a href="http://imealsdev.com/contact/wp-admin">Jobs</a>			
						</li>
						<?php } ?>
						<?php if ($this->Acl->check('Users','index') == true || $this->Acl->check('Groups','index') == true || $this->Acl->check('Permissions','index','AuthAcl') == true){?>
						<li
							class="dropdown <?php if (isset($menus[$strAction]) && (int)$menus[$strAction] == 2){?> active <?php }?>"><a
							data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo __('Users'); ?>
								<b class="caret"></b> </a>
							<ul class="dropdown-menu">
								<?php if ($this->Acl->check('Users','index') == true){?>
									<li><?php echo $this->Html->link(__('User Manager'), array('plugin' => false,'controller' => 'users','action' => 'index')); ?></li>
								<?php } ?>
								<?php if ($this->Acl->check('Groups','index') == true){?>
									<li><?php echo $this->Html->link(__('Groups'), array('plugin' => false,'controller' => 'groups','action' => 'index')); ?></li>
								<?php }?>
								<?php if ($this->Acl->check('Permissions','index','AuthAcl') == true){?>
									<li><?php echo $this->Html->link(__('Permissions'), array('plugin' => 'auth_acl','controller' => 'permissions','action' => 'index')); ?></li>
								<?php } ?>
							</ul></li>
						<?php } ?>
						
						<?php if ($this->Acl->check('Settings','index','AuthAcl') == true || $this->Acl->check('Settings','email','AuthAcl') == true ){?>
						<li
							class="dropdown<?php if (isset($menus[$strAction]) && (int)$menus[$strAction] == 4){?> active <?php }?>"><a
							data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo __('Settings'); ?>
								<b class="caret"></b> </a>
							<ul class="dropdown-menu">
								<?php if ($this->Acl->check('Settings','index','AuthAcl') == true){?>
									<li><?php echo $this->Html->link(__('General'), array('plugin' => 'auth_acl','controller' => 'settings','action' => 'index')); ?></li>
								<?php }?>
								<?php if ($this->Acl->check('Settings','email','AuthAcl') == true){?>
									<li class="nav-header"><?php echo __('Email templates'); ?></li>
									<li><?php echo $this->Html->link(__('New User'), array('plugin' => 'auth_acl','controller' => 'settings','action' => 'email/new_user')); ?></li>
									<li><?php echo $this->Html->link(__('Reset Password'), array('plugin' => 'auth_acl','controller' => 'settings','action' => 'email/reset_password')); ?></li>
								<?php } ?>
							</ul></li>
						<?php }?>
					</ul>
				</div>
				<!--/.nav-collapse -->
			</div>
		</div>
	</div>
	<?php } ?>
	<!-- container -->
	<div class="container" id="container">
		<?php echo $this->Session->flash(); ?>
		<?php //echo $this->Session->flash('auth'); ?>
		<?php 
			if (method_exists($this, 'fetch')){
				echo $this->fetch('content'); 
			}else{
				echo $content_for_layout;
			}	
		?>
	</div>


</div><!-- .wrapper -->
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
					<td><a href="#">Jobs</a></td>
					<td><a href="#">Virtual Cafeteria</a></td>
					<td><a href="#">Vendor Login</a></td>								
				</tr>
				<tr>
					<td><a href="#">User Agreement</a></td>
					<td><a href="#">Meetings & Events</a></td>
					<td><a href="#">Vendor Services</a></td>								
				</tr>
				<tr>
					<td><a href="#">Privacy</a></td>
					<td><a href="#">Personal Orders</a></td>
					<td></td>								
				</tr>
				<tr>
					<td><a href="#">Contact Us</a></td>
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
		<rights>
				2012 &copy; iMeals. All Rights Reserved.
		</rights>
	</div><!-- .wrapper -->	
</footer>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
