<?php 
	/*echo $_SESSION['ordertypeat'];
	echo '<br>';
	echo $_SESSION['ordertypeatasap'];
	echo '<br>';		
	echo $_SESSION['ordertypeatisasap']
	unset($_SESSION['ordertypeat']);
	unset($_SESSION['ordertypefor']);
	unset($_SESSION['ordertypedate']);*/
	
				/*if($_SESSION['ordertypeat'] == '00:00')
					$ordertypeatdefault = $_SESSION['ordertypeatasap'];
				else
					$ordertypeatdefault = $_SESSION['ordertypeat'];
	
				echo 'Order Type Default - '.$ordertypeatdefault;
				echo 'Order Type At - '.$_SESSION['ordertypeat'];
				echo 'Order Type ASAP - '.$_SESSION['ordertypeatasap'];	*/

?>
<div id="orderingsteps">
	<div class="wrapper">
		<ul>
			<li><a href="/">1. Enter Your Info</a></li>
			<li class="active"><span class="active_num">2.</span> Select a Restaurant</li>
			<li class="orderfrommenu">3. Order from the Menu</li>
			<li>4. Checkout</li>						
		</ul>
	</div><!-- .wrapper -->
</div><!-- #orderingsteps -->
<div id="restaurantfilter">
	<div class="wrapper">
		<ul>
			<li class="blue_font">Type</li>
			<li>
			<?php //echo $this->Js->input('order type',array('type'=>'select','label'=>false,'options'=>array('Delivery','Pickup'))); ?>
			
				<select id="ordertype">
					<option value="delivery" <?php if($ordertype == 'delivery') echo 'selected="selected"'; ?>>Delivery</option>
					<option value="pickup" <?php if($ordertype == 'pickup') echo 'selected="selected"'; ?>>Pickup</option>
				</select>
			 
			 
			</li>
			<li class="ordertype_to blue_font">To</li>
			<li>
			  <?php if(isset($_SESSION['address']) &&  trim($_SESSION['address']) != ""){
        			  $to_val= $_SESSION['address'].', '.$_SESSION['city'].' '.$_SESSION['state'];
        			  if(trim($_SESSION['streetnum']) != "")
        			  	$to_class= ''; 
        			  else 
        			  	$to_class = 'iszip';
        			  	
              } else { 
      			    $to_val= $_SESSION['zip']; 
      			    $to_class = 'iszip';
      			  }
      			  
      			  	if(isset($_SESSION['streetnum']) && $_SESSION['street'] != '')
						$address = $_SESSION['streetnum'].' '.$_SESSION['street'].',';
					else
						$address = '';
					if(isset($_SESSION['city']))
						$address .= $_SESSION['city'];
					if(isset($_SESSION['state']))
						$address .= ' '.$_SESSION['state'];
				
      			  ?>
      			  
      			  
				<select id="ordertype_to" class="ordertype_to <?php echo $to_class; ?>">
					<option><?php echo $address; ?></option>
					<option>Enter New Address</option>
				</select>
			</li>
			<li class="blue_font">For</li>
			<li>
				<!-- Set default order type for -->
				<?php //setcookie("search_orderfor", 'today', time()+3600, "/imeals"); //echo $searchorderat;//echo $local_date; ?>
				<!--<select id="ordertype_for">
					<option value="today">Today</option>
					<option value="tomorrow">Tomorrow</option>
				</select>	-->

				<?php
				/*echo '<pre>';
				var_dump($getcurrentfuturedays);
				echo '</pre>';	*/			
					echo $this->Form->input('time',array('type'=>'select','options'=>$getcurrentfuturedays,'id'=>'ordertype_for','label'=>false,'default'=> strtolower($_SESSION['ordertypefor']),'class'=>'today_select','div'=>'input select today_select'));
				?>
			</li>
			<li class="blue_font">At</li>
			<li>
				<?php 
				if($_SESSION['ordertypeat'] == '00:00')
					$ordertypeatdefault = $_SESSION['ordertypeatasap'];
				else
					$ordertypeatdefault = $_SESSION['ordertypeat'];
						
					echo $this->Form->input('time',array('type'=>'select','options'=>$gettodaytime,'id'=>'ordertype_at','label'=>false,'default'=> $ordertypeatdefault,'empty'=> array($_SESSION['ordertypeatasap']=>'ASAP'),'class'=>'today_select','div'=>'input select today_select'));
						
						
					$hour = new DateTime($_SESSION['ordertypeatasap']);
					$hour = $hour->format('H') ;
					$minute = date('i',$ordertypeatasap);
	
	
					if($minute < 15)
						$minute = 30;
					else if ($minute < 30)
						$minute = 45;
					else if ($minute < 45) {
						$minute = 00;
						$hour++;
					} 
					else {
						$minute = 15;
						$hour++;
					}
	
					$ordertypeatdefault = $hour.':'.str_pad($minute, 2, '0', STR_PAD_LEFT);
		
					echo $this->Form->input('time',array('type'=>'select','options'=>$gettomorrowtime,'id'=>'ordertype_at_tomorrow','label'=>false,'default'=> $ordertypeatdefault,'empty'=> array($_SESSION['ordertypeatasap']=>'ASAP'),'div'=>'input select tomorrow_select')); 	
					//echo $ordertypeatdefault;
				?>
				
			</li>
		</ul>				
	</div>
</div><!-- #restaurantfilter -->
<div class="minheight_wrapper">
<div class="wrapper search_body" id="search_results_wrapper">
	<div id="restaurantsearch">
		<h3 class="blue_font">Cuisines</h3>
		<?php if(isset($allcuisines)): foreach($allcuisines as $cusinename => $cusinecount):
  		  echo $this->Form->input($cusinename, array('label'=>$cusinename . ' (' .$cusinecount .')','type'=>'checkbox','class'=>'allcuisines ' . $cusinename)); 
  		endforeach;
  		endif;
		?>
	</div>
	<div id="restaurantresults">	
		<?php 
	if(isset($isclosed)) {
		echo '<div class="isclosed alert alert-warning">To view more restaurants, simply change your order time.';
			echo $this->Html->image('imeals-arrow.png', array('class' => 'isclosedarrow'));
		echo '</div>';	
	}	
	//echo $ordertype;
	if(isset($restaurants) && $restaurants != null && trim($ordertype) == 'delivery') {
?>
		<table>
			<thead>
			<tr>
				<th></th>
				<th class="darkblue_font"><a href="#" onclick="sort('name')" class="name">Restaurant Name</a></th>
				<th class="darkblue_font"><a href="#" onclick="sort('price')" class="price">Price</a></th>
				<th class="darkblue_font"><a href="#" onclick="sort('delivery_estimate_max')" class="delivery_estimate">Delivery<br>Estimate</a></th>
				<th class="darkblue_font"><a href="#" onclick="sort('delivery_min')" class="delivery_min">Delivery<br>Minimum</a></th>
				<th class="darkblue_font"><a href="#" onclick="sort('delivery_charge')" class="delivery_charge">Delivery<br>Fee</a></th>
				<th class="darkblue_font"><a href="#" onclick="sort('deals')" class="deals">Discount</a></th>
			</tr>
			</thead>
			<?php 
			foreach ($restaurants as $restaurant): 
			//get cuisines to add as class
			$cusineclass = '';		
			foreach($restaurant['Restaurant']['Cuisine'] as $cuisine): $cusineclass .=  $cuisine['name'] . ' '; endforeach;?>	
            <?php 
            $opencloseclass = '';
            	/* Determines if restaurant is open or closed */
            	foreach($restaurant['Menu'] as $menu): 
            		foreach($menu['MenuHour'] as $menuhour):
            			if($dw == $menuhour['day'] && ($defaulttime > $menuhour['time_open'] && $defaulttime < $menuhour['time_closed'])) {
			            	/*echo 'Day-'.$menuhour['day'].'<br>';
			            	echo 'Open-'.$menuhour['time_open'].'<br>';
			            	echo 'Close-'.$menuhour['time_closed'].'<br><br>';		            			            	
			            	*/
			            	$openclosed = true;
		            	} else {
		            		//$openclosed = false;
		            	}
		         	endforeach;   
            	 endforeach;
            	 
            	 if(isset($openclosed) && $openclosed == true)
            	 	$opencloseclass = 'open';
            	 else
            	 	$opencloseclass = 'closed';
            	/* end open or closed */
           	?>				
			<tr class="allcuisines <?php echo $cusineclass; echo ' '.$opencloseclass; ?>" 
				<?php  if($opencloseclass == 'open') { ?>
					onclick="gotoMenu('<?php echo $restaurant['Restaurant']['id']; ?>',
					'<?php echo $restaurant['RestaurantOrderType']['id']; ?>');">
				<?php } else { ?>
					onclick="jQuery('#closed<?php echo $restaurant['Restaurant']['id']; ?>').modal('show');">
				<?php } ?>
				
				<td>
					<img width="85px" height="85px;" src="<?php echo Router::url('/',true) . 'files/' . $restaurant['Restaurant']['logo_url']; ?>"/>&nbsp;
				</td>
				<td class="rest_details">
            <?php echo $this->Html->link(
                '<span class="rest_name">'.$restaurant['Restaurant']['name'].'</span><span class="rest_address">'.$restaurant['Restaurant']['address']. '</span>'.$restaurant['Restaurant']['description'],
                array('controller' => 'restaurants', 'action' => 'menu', $restaurant['Restaurant']['id'],$restaurant['RestaurantOrderType']['id'], 'full_base' => true),array('escape'=>false)
            );
            
            ?>
            <br>
        		</td>
				<td><?php $price = str_split($restaurant['Restaurant']['price']); 
				          foreach($price as $dollar): 
				            echo '<span class="price_dollar">'.$dollar.'</span>';
				          endforeach;?></td>
				<td>
					<span class="ordertime">
					<?php 
					$date = date('m/d/Y', time());
					$orderat = strtotime($_SESSION['ordertypeat']);
					if($date == $_SESSION['ordertypefor']) {
						$orderat = date("H:i", strtotime('+'.h($restaurant['RestaurantOrderType']['delivery_estimate_max']).' minutes', $orderat));
						echo DATE("g:ia", STRTOTIME($orderat));
					}
					else {
						echo DATE("g:ia", strtotime($date.' '.$_SESSION['ordertypeat']));
						//echo DATE("g:ia", strtotime($date.' '.$_SESSION['ordertypeat'])).'-'.$_SESSION['ordertypeat'];
					}						
					?>
					</span>
					<span class="orderminutes">
					<?php
					$date = date('m/d/Y', time());
					if($date == $_SESSION['ordertypefor'])
						echo h($restaurant['RestaurantOrderType']['delivery_estimate_min']) . '-' . h($restaurant['RestaurantOrderType']['delivery_estimate_max']) . ' minutes'; 
					else
						echo DATE("g:ia", STRTOTIME($_SESSION['ordertypeat']));
					?>
					</span>

				</td>
				<td><?php echo h('$'.$restaurant['RestaurantOrderType']['delivery_min']); ?></td>
				<td><?php echo h('$'.$restaurant['RestaurantOrderType']['delivery_charge']); ?></td>
				<td><?php 
						
							echo '<span class="red_font">';
							if($restaurant['Restaurant']['deals'] != "") echo $restaurant['Restaurant']['deals'] . '%';
							echo '</span>';
					?>&nbsp;</td>
			</tr>
			<?php endforeach; ?>		
		</table>
		<?php } 
		else if (isset($restaurants) && $restaurants != null && trim($ordertype) == 'pickup') { ?>
		<table>
			<thead>
			<tr>
				<th></th>
				<th class="darkblue_font"><a onclick="sort('name')" class="name">Restaurant<br>Name</a></th>
				<th class="darkblue_font"><a onclick="sort('price')" class="price">Price</a></th>
				<th class="darkblue_font"><a onclick="sort('delivery_estimate_max')" class="pickup_estimate">Pickup<br>Estimate</a></th>
				<th class="darkblue_font"><a onclick="sort('distance')" class="distance">Distance</a></th>
				<th class="darkblue_font"><a onclick="sort('deals')" class="deals">Discount</a></th>
			</tr>
			</thead>
			<?php 
			foreach ($restaurants as $restaurant):		
			$cusineclass = '';
			foreach($restaurant['Restaurant']['Cuisine'] as $cuisine): $cusineclass .=  $cuisine['name'] . ' '; endforeach;?>		
			<tr class="allcuisines <?php echo $cusineclass; ?>" onclick="gotoMenu('<?php echo $restaurant['Restaurant']['id']; ?>',
			'<?php echo $restaurant['RestaurantOrderType']['id']; ?>');">
				<td>
					<img width="85px" height="85px;" src="<?php echo Router::url('/',true) . 'files/' . $restaurant['Restaurant']['logo_url']; ?>"/>&nbsp;
				</td>
				<td class="rest_details">
	          <?php echo $this->Html->link(
                '<span class="rest_name">'.$restaurant['Restaurant']['name'].'</span><span class="rest_address">'.$restaurant['Restaurant']['address']. '</span>'.$restaurant['Restaurant']['description'],
                array('controller' => 'restaurants', 'action' => 'menu', $restaurant['Restaurant']['id'],$restaurant['RestaurantOrderType']['id'], 'full_base' => true),array('escape'=>false)
            );?>
        		</td>
				<td><?php $price = str_split($restaurant['Restaurant']['price']); 
				          foreach($price as $dollar): 
				            echo '<span class="price_dollar">'.$dollar.'</span>';
				          endforeach;?></td>
				<td>
					<span class="ordertime">
					<?php 
					$orderat = strtotime($_SESSION['ordertypeat']);
					$orderat = date("H:i", strtotime('+'.h($restaurant['RestaurantOrderType']['delivery_estimate_max']).' minutes', $orderat));
					$orderat = $_SESSION['ordertypeat'];
					echo DATE("g:ia", STRTOTIME($orderat));
					?>
					</span>
					<span class="orderminutes">
					<?php
					//echo $_SESSION['ordertypefor'];
					$date = date('m/d/Y', time());
					
					if($date == $_SESSION['ordertypefor'])
						echo h($restaurant['RestaurantOrderType']['delivery_estimate_min']) . ' - ' . h($restaurant['RestaurantOrderType']['delivery_estimate_max']) . ' minutes'; 
					else
						echo DATE("g:ia", STRTOTIME($orderat));
				
					?>
					</span>
					
				</td>
				<td><?php echo $restaurant['RestaurantOrderType']['distance'].'mi.'; ?></td>
				<td><?php 
							echo '<span class="red_font">';
							if($restaurant['Restaurant']['deals'] != "") echo $restaurant['Restaurant']['deals'] . '%';
							echo '</span>';
					?>&nbsp;</td>
			</tr>
			<?php endforeach; ?>		
		</table>
		<?php } else { ?>
		<table>
			<thead>
			<tr>
				<th width="20%">&nbsp;</th>
				<th class="darkblue_font"><a onclick="sort('name')" class="name">Restaurant<br>Name</a></th>
				<th class="darkblue_font"><a onclick="sort('price')" class="price">Price</a></th>
				<th class="darkblue_font"><a onclick="sort('delivery_estimate_max')" class="pickup_estimate">Pickup<br>Estimate</a></th>
				<th class="darkblue_font"><a onclick="sort('distance')" class="distance">Distance</a></th>
				<th class="darkblue_font"><a onclick="sort('deals')" class="deals">Discount</a></th>
			</tr>
			</thead>
		</table> 
		<?php
		echo '<div class="no_rest_found">No Restaurant found for this address or zip.</div>'; } ?>	
	</div><!-- #restaurantresults -->
	 
</div><!-- .wrapper -->
</div><!-- .minheight_wrapper -->
<!-- Modal -->
<!-- Restaurant Closed Modals -->
<?php
foreach ($restaurants as $restaurant): 
            $opencloseclass = '';
            $openclosed = false;
            	/* Determines if restaurant is open or closed */
            	foreach($restaurant['Menu'] as $menu): 
            		foreach($menu['MenuHour'] as $menuhour):
            			if($dw == $menuhour['day'] && ($defaulttime > $menuhour['time_open'] && $defaulttime < $menuhour['time_closed'])) {
			            	/*echo 'Day-'.$menuhour['day'].'<br>';
			            	echo 'Open-'.$menuhour['time_open'].'<br>';
			            	echo 'Close-'.$menuhour['time_closed'].'<br><br>';		            			            	
			            	*/
			            	$openclosed = true;
		            	} else {
		            		//$openclosed = false;
		            	}
		         	endforeach;   
            	 endforeach;
            	 
            	 if(isset($openclosed) && $openclosed == true)
            	 	$opencloseclass = 'open';
            	 else
            	 	$opencloseclass = 'closed';
            	/* end open or closed */
				?>
					<?php if($opencloseclass == 'closed') { ?>
					<!-- <div id="closed<?php //echo $restaurant['Restaurant']['id']; ?>" class="modal fade">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h4 class="modal-title"><?php //echo $restaurant['Restaurant']['name']; ?></h4>
					      </div>
					      <div class="modal-body">
					        <h3 class="red_font">Currently Closed</h3>
					        <p>
					        Hours of Operation
					        <table>
					        <thead>
						        <tr>
						        	<td>Day</td>
						        	<td>Open</td>
						        	<td>Closed</td>
						        </tr>
					        </thead> -->
					        <?php 
					        /*foreach($restaurant['Menu'] as $menu):
			            		foreach($menu['MenuHour'] as $menuhour):
			            				echo '<tr>';
						            	echo '<td>'.$menuhour['day'].'</td>';
						            	echo '<td>'.date("h:i a", strtotime($menuhour['time_open'])).'</td>';
						            	echo '<td>'.date("h:i a", strtotime($menuhour['time_closed'])).'</td>';		            		       
			            				echo '</tr>';						            	
					         	endforeach;   
			            	 endforeach;*/
			            	 ?>
			            	<!-- </table>
					        </p>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default lightblue_button" data-dismiss="modal">Close</button>
					      </div>
					    </div><!-- /.modal-content -->
					  <!-- </div><!-- /.modal-dialog -->
					<!-- </div><!-- /.modal -->
					
					<?php } ?>
<?php  endforeach; ?>
<!-- Enter New Address -->
<div id="changeaddressdialog" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-right: 9px;">×</button>
  <div class="modal-body">
	<div id="search-loader">
		<div class="loader_wrapper">
			<?php echo $this->Html->image('loader.gif', array('class' => 'loader_image')); ?>
		</div>
	</div>  
    <h3 id="myModalLabel" class="darkblue_font enter_del_address"><?php //echo $this->Html->image('delivery-truck.png', array('alt' => 'Delivery Truck','style'=>'width:41px;')); ?> Please enter a new <span id="ordertypeaddress"></span> address</h3>
    <p>
    	<?php //if($ordertype == 'pickup') { ?>
    	<a id="findMe" onclick="return findMe()">Find Me</a> 
    	<?php //} ?>
    	<input type="text" id="search_address" placeholder="Enter Your Address"/>
    </p>
   	<div class="user_message">Ex: 123 Sycamore Street, Baton Rouge, LA</div>
   	<br>
   	<div id="validation" class="alert alert-warning">
   	</div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true" id="close_modal">Close</button>
    <button id="changeaddress" class="btn btn-primary lightblue_button">Find My Food!</button>
  </div>
</div>
<!-- End Enter New Address -->
	
<?php echo $this->Html->script('functions.js'); ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="http://j.maxmind.com/app/geoip.js"></script><!-- For our fallback -->

<?php echo $this->Html->script('map.js'); ?>

<script>
	var mainurl = '<?php echo Configure::read('mainurl'); ?>';
	/*Get Order Type.  Delivery and Pickup options are different */
	var ordertype = '<?php echo($ordertype); ?>';
	
	var ordertypefor = jQuery('#ordertype_for option:selected').text();
	if(ordertypefor.toLowerCase() == 'today') {
	  jQuery('#ordertype_at_tomorrow').hide();
	  jQuery('#ordertype_at').show();
	}
	else {
	  jQuery('#ordertype_at_tomorrow').show();
	  jQuery('#ordertype_at').hide();
	  jQuery('.tomorrow_select').show();
	}	
	
	//If Order Type is changed
	jQuery('#ordertype').change(function() {
		var ordertypefor = jQuery('#ordertype_for').val();
		if(ordertypefor == 'today')
		  var ordertypeat = jQuery('#ordertype_at').val();
		else
		  var ordertypeat = jQuery('#ordertype_at_tomorrow').val();
		  
		var ordertype = jQuery('#ordertype').val();

		var city = '<?php echo $_SESSION['cityname'] ?>';

		<?php
			if(isset($_SESSION['streetnum']))
				$address = $_SESSION['streetnum'].' '.$_SESSION['street'];
			if(isset($_SESSION['city']))
				$address .= ','.$_SESSION['city'];
			if(isset($_SESSION['state']))
				$address .= ' '.$_SESSION['state'];
			
		?>
		var address = '<?php echo $address; ?>';
		debugger;
		getRestaurants(address, ordertype, city, ordertypeat, ordertypefor, '#search_results_wrapper', true, false);	
		  	
	});
	
	//If Order Type Address is changed
	jQuery('#changeaddress').click(function() {
		//var ordertypefor = jQuery('#ordertype_for').val();
		var ordertypefor = jQuery('#ordertype_for option:selected').text().toLowerCase();
		if(ordertypefor == 'today')
		  var ordertypeat = jQuery('#ordertype_at').val();
		else
		  var ordertypeat = jQuery('#ordertype_at_tomorrow').val();
		  
		var ordertype = jQuery('#ordertype').val();

		var city = '<?php echo $_SESSION['cityname'] ?>';
		
		var address = jQuery('#search_address').val();
		debugger;
		getRestaurants(address, ordertype, city, ordertypeat, ordertypefor, '#search_results_wrapper', true, true);
		
	});	
	
	/* Set on change of order type for today or tomorrow */
	jQuery('#ordertype_for').change(function() {
		var ordertypefor_text = jQuery('#ordertype_for option:selected').text();
		var ordertypefor = jQuery('#ordertype_for option:selected').val();
				
		if(ordertypefor_text.toLowerCase() == 'today'){
		  	//Sync time dropdowns
		  	jQuery('#ordertype_at').val(jQuery('#ordertype_at_tomorrow').val());
		  	//Show time dropdown for Today
  	  		jQuery('.today_select').show().next().hide();	
  	  		var ordertypeat = jQuery('#ordertype_at').val();
  	  		
  	  		jQuery('#ordertype_at_tomorrow').hide();
	  		jQuery('#ordertype_at').show();
		}
		else{
		  //Sync time dropdowns
		  jQuery('#ordertype_at_tomorrow').val('<?php echo $ordertypeatdefault; ?>');
		  jQuery('.tomorrow_select').show().prev().hide();
		  var ordertypeat = jQuery('#ordertype_at_tomorrow').val();
		  
		  jQuery('#ordertype_at_tomorrow').show();
	  	  jQuery('#ordertype_at').hide();
		}
		
		
		var ordertype = jQuery('#ordertype').val();
		/*var city = getCookie('search_city');
		
		//getRestaurantsPost('ordertypeat', ordertypeat, city, '#restaurantresults');*/
		var city = '<?php echo $_SESSION['cityname']; ?>';
		<?php
			if(isset($_SESSION['streetnum']))
				$address = $_SESSION['streetnum'].' '.$_SESSION['street'];
			if(isset($_SESSION['city']))
				$address .= ','.$_SESSION['city'];
			if(isset($_SESSION['state']))
				$address .= ' '.$_SESSION['state'];
			
		?>
		var address = '<?php echo $address; ?>';
		getRestaurants(address, ordertype, city, ordertypeat, ordertypefor, '#search_results_wrapper', true, false);
	});
	
	
	/* Set on change of order type for time selected */
	jQuery('#ordertype_at,#ordertype_at_tomorrow').change(function() {
		var ordertypefor_text = jQuery('#ordertype_for option:selected').text();
		var ordertypefor = jQuery('#ordertype_for option:selected').val();
				
		if(ordertypefor_text.toLowerCase() == 'today')
		  var ordertypeat = jQuery('#ordertype_at').val();
		else
		  var ordertypeat = jQuery('#ordertype_at_tomorrow').val();
		  
		var ordertype = jQuery('#ordertype').val();
		/*var city = getCookie('search_city');
		
		//getRestaurantsPost('ordertypeat', ordertypeat, city, '#restaurantresults');*/
		var city = '<?php echo $_SESSION['cityname'] ?>';
		<?php
			if(isset($_SESSION['streetnum']))
				$address = $_SESSION['streetnum'].' '.$_SESSION['street'];
			if(isset($_SESSION['city']))
				$address .= ','.$_SESSION['city'];
			if(isset($_SESSION['state']))
				$address .= ' '.$_SESSION['state'];
			
		?>
		var address = '<?php echo $address; ?>';
		debugger;
		getRestaurants(address, ordertype, city, ordertypeat, ordertypefor, '#search_results_wrapper', true, false);
		
	});
	
	var addressInfo = new Array();
	
	
	/* Search Restaurants based on address or zip entered */
	/*function searchRestaurants_SearchPage() {
		var address = jQuery('#search_address').val();
		var type = jQuery('#ordertype option:selected').val();

		//searchRestaurants(address, type, true);
		$.ajax({
		        type: 'POST',
		        url: mainurl+'/Restaurants/searchChangeToDelivery/',
		        data: {address: address},
		        dataType:"html",
		        success:function(data){
		          jQuery('#newAddress .modal-body p').prepend(data);
		        },
		        error:function(data){
			        jQuery('#newAddress .modal-body p').prepend('Please enter a valid address in the form of Street Number and Name, City, State<br><br>');
		        },
		        timeout: 5000
			});
	}*/
	
	//Change order type function
	/*jQuery('#changeordertype').click(function() {
		var ordertype_val = jQuery('#ordertype :selected').text();
		if(ordertype_val == "Pickup")
			ordertype_val = "Delivery";
		else
			ordertype_val = "Pickup"
			
		var address = jQuery('#search_address').val();
		var type = jQuery('#ordertype option:selected').val();
				
		//searchRestaurants(address, type, true);
		$.ajax({
		        type: 'POST',
		        url: mainurl+'/Restaurants/searchChangeToDelivery/',
		        data: {address: address, ordertype: ordertype_val},
		        dataType:"html",
		        success:function(data){
		          debugger;
		          jQuery('#newAddress .modal-body p').prepend(data);
		        },
		        error:function(data){
		            debugger;
			        jQuery('#newAddress .modal-body p').prepend('Please enter a valid address in the form of Street Number and Name, City, State<br><br>');
		        },
		        timeout: 5000
			});
		
	});*/
	
	/*function checkRestaurantOpen() {
		var ordertypefor = jQuery('#ordertype_for').val();
		if(ordertypefor == 'today'){
		  var ordertypeat = jQuery('#ordertype_at').val();
		  var ordertypeat_text = jQuery('#ordertype_at option:selected').text();
		}
		else{
		  var ordertypeat = jQuery('#ordertype_at_tomorrow').val();
		  var ordertypeat_text = jQuery('#ordertype_at_tomorrow option:selected').text();
		}
				
		var city = '<?php //echo $_SESSION['cityname'] ?>';
		
		checkRestaurantIsOpen(ordertypefor, ordertypeat, ordertypeat_text, city);
	}
	
	
	function hideshowZip(type) {
		if(type == 'delivery') 
			jQuery('#search_zipcode').fadeOut();
		else if(type == 'pickup')
			jQuery('#search_zipcode').fadeIn();
	}*/
	
	var sort_value = 'ASC';
	var mem_sort_field;
	
	function sort(field) {
		if(sort_value == 'ASC') {
			sort_value = 'DESC';
			
		}
		else if (sort_value == 'DESC') {
			sort_value = 'ASC';
			jQuery('.'+field).addClass('asc');	
		}
		else
			sort_value = 'ASC';
			
		mem_sort_field = field;
			
		sortdir = mem_sort_field + ' ' + sort_value;
		var results;
		var city = '<?php echo $_SESSION['cityname'] ?>';
		
		var chkdcuisines_val = getCuisines();
		$.ajax({
		        type: 'POST',
		        url: mainurl+'/Restaurants/search/' + city,
		        data: {sort_direction: sortdir, chkdcuisines: chkdcuisines_val},
		        success:function(data){
		            results = data;
		            	if(sort_value == 'ASC') {
							jQuery('.'+field).addClass('desc');
						}
						else if (sort_value == 'DESC') {
							jQuery('.'+field).addClass('asc');	
						}
		        },
		        error:function(data){
			        results = data;
		        },
		        timeout: 5000
			}).done(function(){
		        jQuery('#search_results_wrapper').html(results);
		});
	}

/* Find Me */
  function findMe() {
  	//$('#findMe').html('One moment....We are trying to find you.');
  	//$('#findMe').click(function () {
	    // test for presence of geolocation
		jQuery('#search_address').css('padding','9px 0px 9px 50px'); 
		jQuery('#search_address').css('width','472px');   
	    jQuery('#search_address').val('We are looking for you...');
	    jQuery('#changeaddressdialog #search-loader').show();
	    
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

	        //$("#findmeresults").fadeOut(function() {
	        	//$('#findMe').html('We found you!');
	        	debugger;
	        	var citystate = getCityState(results[0]['address_components']);
	        	
	          jQuery('#search_address').val(citystate);
	          jQuery('#changeaddressdialog #search-loader').fadeOut();
	          //$(this).html("<p><b>Abracadabra!</b> My guess is:</p><p><em>" + results[0].formatted_address + "</em></p>").fadeIn();
	        //});
	      } else {
	      	$('#findMe').html('Sorry we could not find you.  Try Again');
	        error("Google did not return any results.");
	      }
	    } else {
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

	
</script>



<?php echo $this->Html->script('search.js'); ?>

