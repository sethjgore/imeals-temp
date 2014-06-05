<?php 
	//echo $default;
	//echo $dw;	
	/*echo '<pre>';
		var_dump($restaurants);
	echo '</pre>';*/
?>
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
	//echo $ordertype;
	if(isset($isclosed)) {
		echo '<div class="isclosed alert alert-warning">To view more restaurants, simply change your order time.';
			echo $this->Html->image('imeals-arrow.png', array('class' => 'isclosedarrow'));
		echo '</div>';	
	}
	if($restaurants != null && $ordertype == 'delivery') {
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
					$date = date('m/d/Y', time());
					$orderat = strtotime($_SESSION['ordertypeat']);
					if($date == $_SESSION['ordertypefor']) {
						$orderat = date("H:i", strtotime('+'.h($restaurant['RestaurantOrderType']['delivery_estimate_max']).' minutes', $orderat));
						echo DATE("g:ia", STRTOTIME($orderat));
					}
					else
						echo DATE("g:ia", strtotime($date.' '.$_SESSION['ordertypeat']));
						//echo DATE("g:ia", STRTOTIME($orderat));
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
		else if ($restaurants != null && $ordertype == 'pickup') { ?>
		<table>
			<thead>
			<tr>
				<th></th>
				<th class="darkblue_font"><a onclick="sort('name')" class="name">Restaurant<br>Name</a></th>
				<th class="darkblue_font"><a onclick="sort('price')" class="price">Price</a></th>
				<th class="darkblue_font"><a onclick="sort('delivery_estimate_max')" class="delivery_max">Pickup<br>Estimate</a></th>
				<th class="darkblue_font"><a onclick="sort('distance')" class="distance">Distance</a></th>
				<th class="darkblue_font"><a onclick="sort('deals')" class="deals">Discount</a></th>
			</tr>
			</thead>
			<?php 
			foreach ($restaurants as $restaurant): //get cuisines to add as class
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
					$date = date('m/d/Y', time());
					if($date == $_SESSION['ordertypefor'])
						echo h($restaurant['RestaurantOrderType']['delivery_estimate_min']) . '-' . h($restaurant['RestaurantOrderType']['delivery_estimate_max']) . ' minutes'; 
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
				<th class="darkblue_font">Restaurant<br>Name</th>
				<th class="darkblue_font">Price</th>
				<th class="darkblue_font">Pickup<br>Estimate</th>
				<th class="darkblue_font">Distance</th>
				<th class="darkblue_font">Deals</th>
			</tr>
			</thead>
		</table> 
		<?php
		echo '<div class="no_rest_found">No Restaurant found for this address or zip.</div>'; } ?>	
	</div><!-- #restaurantresults -->
<script>
        var chkdcuisines = '<?php echo $_SESSION['chkdcuisines']; ?>';
		//Get checked cuisines
		if(chkdcuisines != '') {
        //Hide all rows
        jQuery('#restaurantresults .allcuisines').hide();
        		
			var chkdcuisinesArray = chkdcuisines.split(',');
			jQuery('#restaurantsearch .checkbox input.allcuisines').each(function(){
				for (var i = 0; i < chkdcuisinesArray.length; i++) {	
					var row = '#restaurantresults .allcuisines.' + jQuery(this).attr('id');
					
					console.log(jQuery(this).attr('id')+' == '+chkdcuisinesArray[i]);
					
					if(jQuery(this).attr('id') == chkdcuisinesArray[i]) {
						jQuery(this).prop('checked', true);
						jQuery(row).show();
					}
					else {
						//jQuery(row).hide();
					}
				}
			});  
		}    
        
	function sort(field) {
		var mainurl = '<?php echo Configure::read('mainurl'); ?>';
		debugger;
		if(sort_value == 'ASC') {
			sort_value = 'DESC';
			jQuery('.'+field).addClass('desc');
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
		
		//Get checked cuisines
		var chkdcuisines_val = '';
		jQuery('#restaurantsearch .checkbox input.allcuisines').each(function(){
			if(jQuery(this).is(':checked')) {
				chkdcuisines_val += ','+jQuery(this).attr('id');
			}
		});
		
		chkdcuisines_val = chkdcuisines_val.substring(1,chkdcuisines_val.length)
		console.log(chkdcuisines_val);
		
		$.ajax({
		        type: 'POST',
		        url: mainurl+'/Restaurants/search/' + city,
		        data: {sort_direction: sortdir, chkdcuisines: chkdcuisines_val},
		        success:function(data){
		            results = data;
		        },
		        error:function(data){
			        results = data;
		        },
		        timeout: 5000
			}).done(function(){
		        jQuery('#search_results_wrapper').html(results);
		           	if(sort_value == 'ASC') {
						jQuery('.'+field).addClass('asc');
					}
					else if (sort_value == 'DESC') {
						jQuery('.'+field).addClass('desc');	
					}		        
		});
	}
	
		/* Set on click Cuisine filter */
	jQuery('#restaurantsearch .checkbox input.allcuisines').each(function(){
	   jQuery(this).click(function(e){
	      $cusine_list = '';
	      jQuery('#restaurantsearch .checkbox input.allcuisines').each(function(){
  	      if(jQuery(this).is(':checked'))
  	        $cusine_list = $cusine_list + '#restaurantresults .allcuisines.' + jQuery(this).attr('id') + ',';
	      });
	      $cusine_list = $cusine_list.substring(0, $cusine_list.length - 1);
	      console.log($cusine_list);
        if($cusine_list == ''){
          jQuery('#restaurantresults .allcuisines').hide().fadeIn();
        } else {
          jQuery('#restaurantresults .allcuisines').hide();
          jQuery($cusine_list).fadeIn();
        }
	   });
	 });
	
	var ordertime = $('#ordertype_at').find(":selected").text();
	
	jQuery('.ordertime').each(function(){
		if(ordertime == 'ASAP') {
			jQuery('.ordertime').hide();
			jQuery('.orderminutes').show();			
		}
		else {
			jQuery('.ordertime').show();
			jQuery('.orderminutes').hide();
		}
	});	
	
</script>

