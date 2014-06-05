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

?>
<!DOCTYPE html>
<html>
<head>
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
		<link href="<?php echo $this->request->webroot; ?>bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet">		
		<!-- Custom Web Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Lobster+Two:400,700' rel='stylesheet' type='text/css'>
	
	<?php
  	
  	//Add Main Style CSS
    echo $this->Html->css('style');
    
    		
		//Add jQuery and jQuery UI
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js');
		// Add jQuery Cookies
		echo $this->Html->script('jquery.cookie.js');
		// Add bootstrap js
		echo $this->Html->script('jquery.bootstrap.js');
		// Add bootstrap editable js
		echo $this->Html->script('bootstrap-editable.js');	
		// Add bootstrap tooltip js
		echo $this->Html->script('bootstrap.tooltip.js');				
		//Add Custom JS Functions
    echo $this->Html->script('functions.js');
    echo $this->Html->script('jquery.browser.js');
		
    //Call an JS functions needed on certain pages
    echo $this->fetch('css');
    echo $this->fetch('script');
		
		//Echo code created for Ajax Calls
		echo $this->Js->writeBuffer(array('cache'=>TRUE));

  ?>
	
	<script type="text/javascript">var imealsBaseUrl = '<?php echo $this->Html->url('/'); ?>';</script>
	
</head>
<body class="public_page">

<?php /* 
       *  Get Header 
       */
?>
<?php include('header.php'); ?>

<?php /* 
       *  Get Content 
       */
?>

<!-- Content for Pages -->
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->fetch('content'); ?>
<!-- End Conent for Pages -->

<?php /* 
       *  Get Footer 
       */
?>
<?php include('footer.php'); ?>

	<?php 
		//echo $this->element('sql_dump'); ?>
</body>
</html>