<?php 
	/*echo 'ASAP-'.$_SESSION['ordertypeatasap'];
	echo '<br>Order at-'.$_SESSION['ordertypeat'];
	echo '<br>IS ASAP-'.$_SESSION['ordertypeatisasap'];*/
?>

<div id="orderingsteps">
	<div class="wrapper">
		<ul>
			<li><a href="/">1. Enter Your Info</a></li>
			<li><a href="../../search/<?php echo $_SESSION['city']; ?>">2. Select a Restaurant</a></li>
			<li class="active"><span class="active_num">3.</span> Order from the Menu</li>
			<li>4. Checkout</li>						
		</ul>		
		
	</div><!-- .wrapper -->
</div><!-- #orderingsteps -->
<input type="hidden" id="orderid" value="<?php echo $orderid; ?>"/>
<?php //echo $_SESSION['deliverycharge'];//echo $_SESSION['ordertypedate']; ?>
<div id="menu">
<div id="validation">
	<div class="validationerror alert alert-danger fade in">
	        <span class="errormsg"></span>
	        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
	</div>
</div>
	<div class="wrapper">
		<div id="restaurantmenuinfo"> 
			<?php 
    		foreach($menus[0]['RestaurantOrderType'] as $ordertype):
    		//If has menu
    		if(isset($ordertype['Menu']) && count($ordertype['Menu']) > 0):;
    		?>
      
    		<div id="restaurantinfo">
    		    <img src="<?php echo Router::url('/',true) . 'files/' . $menus[0]['Restaurant']['logo_url']; ?>"/>
    		    
    				<div class="heading">
    					<span class="blue_font"><?php echo $menus[0]['Restaurant']['name'] ?></span>
    				</div><!-- .heading -->
    				
    				<div class="rest_address">
    					<?php echo $menus[0]['Restaurant']['address'] . ', ' .
    					 $menus[0]['City']['name'] . ', ' . $menus[0]['City']['State']['abbreviation'];  ?>
    				</div><!-- .rest_address -->
            
            	<div class="rest_delivery">
            		<?php if(trim(strtoupper($_SESSION['ordertype'])) == 'DELIVERY') { ?>
    					DELIVERY Estimate: 
    						<span class="deliveryorderdate">
    						<?php
								if(date('m/d/Y', strtotime($_SESSION['ordertypefor'])) == $today)
									echo 'TODAY ';
								else if(date('m/d/Y', strtotime($_SESSION['ordertypefor'])) == $tomorrow)
									echo 'TOMORROW ';		
								else
									echo strtoupper(date('m/d/Y(D)', strtotime($_SESSION['ordertypefor']))).' ';
							?>  
							</span> 
    					    <span class="orderminutes">
	    						<?php    						
	    						echo '('.$ordertype['delivery_estimate_min'].' - '.$ordertype['delivery_estimate_max'].')';
	    						?>
    						</span>
    						<span class="deliveryordertime ordertime">
	    						<?php
	    						//echo $_SESSION['ordertypeatisasap'];
	    						if($_SESSION['ordertypeatisasap'] == 'N') {
		    						$orderat = strtotime($_SESSION['ordertypeat']);
									$orderat = date("H:i", strtotime('+'.h($ordertype['delivery_estimate_max']).' minutes', $orderat));
									$orderat = $_SESSION['ordertypeat'];
									
									echo '('.DATE("g:ia", STRTOTIME($orderat)).')';
								}
								else if ($_SESSION['ordertypeatisasap'] == 'Y') {
									echo '('.$ordertype['delivery_estimate_min'].' - '.$ordertype['delivery_estimate_max'].' minutes)';
								}
	    						?>
    						</span> 
    				<div class="rest_minimum">
    					Delivery Minimum: <?php
    						echo '$'.$ordertype['delivery_min'];
    				?>
    				</div><!-- .rest_minimum -->
    				<?php } ?>
            		<?php if(trim(strtoupper($_SESSION['ordertype'])) == 'PICKUP') { ?>
    					PICKUP Estimate: 
    						<span class="pickuporderdate">
    						<?php
								if(date('m/d/Y', strtotime($_SESSION['ordertypefor'])) == $today)
									echo 'TODAY ';
								else if(date('m/d/Y', strtotime($_SESSION['ordertypefor'])) == $tomorrow)
									echo 'TOMORROW ';		
								else
									echo strtoupper(date('m/d/Y(D)', strtotime($_SESSION['ordertypefor']))).' ';
							?>  
							</span>  					
    						<span class="orderminutes">
	    						<?php	    						
	    						echo '('.$ordertype['delivery_estimate_min'].' - '.$ordertype['delivery_estimate_max'].' minutes)';
	    						?>
    						</span>
    						<span class="pickupordertime ordertime">
	    						<?php		
	    						if($_SESSION['ordertypeatisasap'] == 'N') {
		    						$orderat = strtotime($_SESSION['ordertypeat']);
									$orderat = date("H:i", strtotime('+'.h($ordertype['delivery_estimate_max']).' minutes', $orderat));
									$orderat = $_SESSION['ordertypeat'];
									echo '('.DATE("g:ia", STRTOTIME($orderat)).')';
								}
								else if ($_SESSION['ordertypeatisasap'] == 'Y') {
									echo '('.$ordertype['delivery_estimate_min'].' - '.$ordertype['delivery_estimate_max'].' minutes'.')';
								}
	    						?>
    						</span>    					
    				<?php } ?>    				
    			</div><!-- .rest_delivery -->    				
				<div class="build_meal">
				  Build Your Meal Below
				</div><!-- .build_meal -->
            	<div class="clear"></div>
    			</div><!-- #restaurantinfo -->
    			<div class="restaurantmenu">
    					<?php
    						$hasupsell = false;
    						foreach($ordertype['Menu'] as $menu):
    							if($menu['upsell_y_n'] == 1)
    								$hasupsell = true;
    						endforeach;
    						
    						foreach($ordertype['Menu'] as $menu):
    						if($menu['upsell_y_n'] != 1 && $menu['MenuHour'] != null) {?>
    						<div class="skip_cat">
	            				<a href="#">Skip to Menu Category</a> 
	            				<ul class="go_to_cat">
	              				<?php foreach($menu['Category'] as $category):
	              				  echo '<li><a href="#'.str_replace(' ' , '', $menu['name']) . '-' . str_replace(' ' , '', $category['name']).'">' . $category['name'] . '</a></li>';
	              				endforeach; ?>
	            				</ul>
            				</div><!-- .skip_cat -->
            			<div class="pop_item">
            				<?php echo $this->Html->image('popular.png', array('alt' => 'Popluar Item')); ?> = Featured Item
            			</div><!-- .pop_item -->
            			<div class="clear"><br><br></div>
            			<?php
    							foreach($menu['Category'] as $category):
    								echo '<div class="category" id="'.str_replace(' ' , '', $menu['name']) . '-' . str_replace(' ' , '', $category['name']).'"><span class="subheading darkblue_font">'.$category['name'].
    								'<a class="category_showhide">-</a></span><br>'.
    								'<span class="categorydescription">'.$category['description'].'</span>';
    								
    									echo '<div class="menu_items">';
    									$i = 0;
    									$a = 0;
    									//Menu items
    									
    										while ($a <= 0):
    											//echo $a;
    											
    												
    											foreach($category['Item'] as $item):
    												if(is_int($i / 2)) {
	    												echo '<div class="item_left">';
	    											}
	    											else {
	    												echo '<div class="item_right">';
	    											}
    													echo '<div class="item">';
    													//Add popular star
    													if($item['popular'] == 1)
    														echo $this->Html->image('popular.png', array('alt' => 'Popluar Item', 'class'=> 'featureditem')); 
    														
    													echo '<a href="#" class="item_name blue_font" data-placement="right" data-toggle="tooltip"  data-dynamic="true">'.$item['name'].'</a>
    													<span class="item_price">$'.$item['price'].'</span>';
    													
    													//hover for item
    													echo '<div class="item_hover" style="display:none;">';
    															if(isset($item['photo_url']) && $item['photo_url'] != '') {
    																echo '<img align="left" src="'.Router::url('/',true) . 'files/'.$item['photo_url'].'" />';
    																
    																echo '<a href="#" class="heading">'.$item['name'].'</a>';
    															} else {
    																echo '<a href="#" class="heading full">'.$item['name'].'</a>';
    															}
    															
    															echo '<div class="desc">'.$item['description'].'</div>';
    													echo '</div>';//End item_hover
    													
    														//popup for item
    											    														
    								echo '<div class="item_variation modal hide fade">';
						  			echo '<div class="modal-dialog">';
						    			echo '<div class="modal-content">';
									//Form			
    								echo $this->Form->create('TempOrder',array('controller'=>'TempOrders','action'=>'additem'));
										echo $this->Form->hidden('TempOrder.DeliveryMinimum',array('value'=>$deliveryminimum, 'class'=>'deliverymin'));
										echo $this->Form->hidden('TempOrder.HasUpsell',array('value'=>$hasupsell, 'class'=>'hasupsell'));										
										echo $this->Form->hidden('TempOrder.id',array('value'=>$orderid, 'class'=>'itemid'));
										echo $this->Form->hidden('TempOrder.tip',array('value'=>'0.00', 'class'=>'tip'));
										echo $this->Form->hidden('TempItem.0.temp_order_id',array('value'=>$orderid, 'class'=>'itemid'));
										echo $this->Form->hidden('TempItem.0.item_id',array('value'=>$item['id'], 'class'=>'itemid'));
										echo $this->Form->hidden('TempOrder.ItemPrice',array('value'=>$item['price'], 'class'=>'itemprice'));						    			
									      echo '<div class="modal-header">';
									        echo '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
									        	
											echo $this->Form->input('TempItem.0.quantity', array('value'=>'1','class'=>'quantity', 'label'=>'QTY', 'div'=>false));
											
											echo '<span class="item_name_variation red_font">'.$item['name'].'</span>';
											echo '<span class="item_name_price red_font">$'.$item['price'].'</span>'; 											
									      echo '</div>';//modal-header
						          														
    										echo '<div class="modal-body">';
											echo '<div class="itemdescription">';
												echo $item['description'];
											echo '</div>';     										
    											
    														/*echo '<div class="item_variation_header">';
    															echo $this->Form->input('TempItem.0.quantity', array('value'=>'1','class'=>'quantity', 'label'=>'QTY', 'div'=>false));
    															echo '<span class="item_name_variation red_font">'.
    															
    															$item['name'].'</span><span class="item_name_price red_font">'.$item['price'].
    															'</span>';
    														echo '</div>';
    														echo '<div class="itemdescription">';
    															echo $item['description'];
    														echo '</div>';    														
    														*/
    															if(count($item['VariationGroup']) == 0)
    																echo '<div style="display: none;" class="item_variation_details">';
    															else
    																echo '<div class="item_variation_details">';
    															
    																$vcount = 0;
    																foreach($item['VariationGroup'] as $variationgroup):
    																
    																	echo '<span class="variationgroup_name">'.
    																	$variationgroup['group_name']."</span><br/>";
    																	
    																	//echo $this->Form->hidden('TempItem.0.VariationGroup.name',array('value'=>$variationgroup['group_name']));
    											
    																	$g = 0;			
    																	$variationlist = array();												
    	
    																	foreach($variationgroup['Variation'] as $variation):
    																	
    																	
    																	if($variation['amount'] == '0')
    																		$variationlist[$variation['id']] = $variation['name'];
    																	else
    																		$variationlist[$variation['id']] = $variation['name'].'&nbsp;($'.$variation['amount'].')';
    																	
    																	if($variation['amount'] == 0)
																			$amnt = '';
																		else
																			$amnt = '&nbsp;($'.$variation['amount'].')';
																			
    																		//Checkboxes
    																		if($variationgroup['num_choices'] != '1') {
    																			echo $this->Form->input('TempItem.0.TempVariationCheckbox.'.$vcount.'.Checkbox.'.$g.'.ischecked', array('label'=>$variation['name'].$amnt,'type'=>'checkbox','class'=>'menu_variation variation',
    																				'checked'=>false));
    																			
    																			echo $this->Form->hidden('TempItem.0.TempVariationCheckbox.'.$vcount.'.Checkbox.'.$g.'.variation_id', array('value'=>$variation['id']));
    																			
    																		}
    																		
    																		
    																		$g++;
    																		
    																	endforeach;
    																			
    																		if($variationgroup['num_choices'] == '1') {
    																			echo '<ul><li>';
    																			
    																				echo $this->Form->input('TempItem.0.TempVariation.'.$vcount.'.variation_id', array('type'=>'radio','options'=>$variationlist,'legend'=>false,'separator'=>'</li><li>','div'=>false,'value'=>'','class'=>'variation','hiddenField' => false));
    																				
    																				
    																			echo '</li></ul>';
    																		}
    																
    																$vcount++;
    																endforeach;	
    															echo '</div><!-- .item_variation_details -->';
    															echo '<div class="item_variation_instructions">';
    																echo '<b>Special Instructions</b><br/>
    																<span style="font-size: .8em">Please Note: Any price altering instructions entered below will be charged to your credit 																card after your order is
    																processed (extra cheese, side of sour cream, etc)</span>.<br/><br/>';
    																
    															echo $this->Form->input('TempItem.0.special_instructions',array('type'=>'textarea','class'=>'specialinstructions'));
    																
    															echo '</div>';
    															
    												echo '</div>';//modal-body

    												echo '<div class="modal-footer">';		
    										//echo $this->Form->button("Add", array('class' => 'btn btn-success','escape' => false )); 
      //echo '<a href="#" class="btn"  data-dismiss="modal">«&nbsp;Back to Menu</a>';
      echo '<button class="btn closeaddtoorder" data-dismiss="modal" aria-hidden="true">Close</button>';
      
      echo $this->Js->submit(__('Add to Order'), array('update'=>'#orderinfo', 'url'=>array('controller'=>'TempOrders','action'=>'additem'), 'class'=>'additem','evalScripts'=>true));
      
      echo $this->Form->end();
     
    													echo  '</div>';///modal-footer
    														//echo '<input type="button" class="red_button additem" value="Add to Order" />';
   										echo '</div><!-- /.modal-content -->';
  											echo '</div><!-- /.modal-dialog -->';
										echo '</div><!-- /.modal -->';    														
    														echo '</div><!-- .item_variation -->';
    														//End pop up for item
    													echo '</div><!-- .item -->';
    												
    													
    												//}
    												$i++;
    												
    												//echo '</div><!-- .item_left/right -->';
    											endforeach;
    											
    											echo '<div class="clear"></div>';
    											
    											$a++;
    										endwhile;
    									echo $this->Form->end(); 
    									echo '</div><!-- .menu_items -->';
    									echo '<div class="clear"></div>';
    								echo '</div><!-- .category -->';
    								$i++;
    							endforeach;			
    							}//End if upsell
    							else if ($menu['upsell_y_n'] == 1) {
    								$hasUpSell = true;
    							?>
    								<div id="upsellmenu" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									  <div class="modal-header">
									    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									    <h3 class="darkblue_font" id="myModalLabel">Don't forget sides and a drink!</h3>
									  </div>
									  <div class="modal-body">
            						<?php
    							foreach($menu['Category'] as $category):
    							echo '<div class="category">';
									echo '<div class="menu_items">';
										$r = 0;
										
										foreach($category['Item'] as $item):
												$upsellitems[$r] = $item['id'];
												 
												echo '<div class="item_variation">';
													
													echo '<input type="checkbox" onclick="addupsellitem(\''.$item['id'].'\')" class="'.$item['id'].'"/>';
													
													echo '<input type="hidden" id="upsell_tempitemid_'.$item['id'].'"/>';
													echo '<input type="hidden" id="'.$item['id'].'"/>';
													
													if(isset($item['photo_url']) && $item['photo_url'] != '') {
														echo '<img align="left" src="'.Router::url('/',true) . 'files/'.$item['photo_url'].'" />';
														
														//echo '<a href="#" class="heading">'.$item['name'].'</a>';
    												}													
													
													echo '<span class="item_name">'.$item['name'].'
														<span class="item_price">($'.$item['price'].')</span></span>';
													
													echo '<br/><span class="item_desc">'.$item['description'].'</span>';
														
    												echo $this->Form->hidden('TempOrder.id',array('value'=>$orderid, 'class'=>'itemid_upsell'));
    												
    												echo $this->Form->hidden('TempItem.0.temp_order_id',array('value'=>$orderid, 'class'=>'itemid_upsell'));
    												
    												echo $this->Form->hidden('TempItem.0.item_id',array('value'=>$item['id'], 'class'=>'itemid_upsell'));
    												
    												echo $this->Form->hidden('TempOrder.ItemPrice',array('value'=>$item['price'], 'class'=>'itemprice_upsell'));
    												
												echo '</div><!-- .item -->';
										endforeach;
									
										echo '</div><!-- .menu_items -->';
    								echo '</div><!-- .category -->';
    								
    							endforeach; ?>
    								</div><!-- .modal-body -->
		    							  <div class="modal-footer">
		    							    	<div class="wrapper">
										    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> -->
										    <?php
										    if(!$logged_in) {
												echo '<a href="#login_screen" class="nothanks btn" data-toggle="modal">No Thanks</a>';
												echo '<a href="#login_screen" id="finish_upsell" class="addupsellitem addupsellitembutton" data-toggle="modal">Add To My Order</a>';																							
											}			
											else {
												echo '<button class="btn cancelupsell" data-dismiss="modal" aria-hidden="true">No Thanks!</button>';																							
												echo '<a  href="../../order/'.$orderid.'" class="addupsellitem addupsellitembutton">Add To My Order!</a>';
												//echo '<a  href="#" class="addupsellitem addupsellitembutton">Add To My Order!</a>';
											}
											?>	
												</div><!-- .wrapper -->
										  </div><!-- .modal-footer -->
									</div>
    							<?php } //End upsell items
    						endforeach; ?>
    						<div class="clear"></div>
    					</div>
    				</div><!-- .restaurantmenu -->
    		<?php	endif; //end if RestaruantOrderType has a menu
					endforeach;//RestaurantOrderType				
				 ?>
			
		</div> <!-- #restaurantmenuinfo -->
		<div id="orderinformation">
			<!-- href="../order/<?php //echo $orderid ?>" -->
					<?php
					//echo 'hasupsell='.$hasUpSell.'</br>';
					//echo count($orderdetails[0]['TempItem']).'</br>';
					//echo 'minimum'.$deliveryminimum.'</br></br></br>';
					if(isset($hasUpSell)) { ?>
							<a href="#upsellmenu" onclick="return validateOrderItems('<?php echo $deliveryminimum; ?>',true, false);" class="red_button">Proceed to Checkout</a>
					<?php } 
					else if(!$logged_in) { ?>
							<a href="#login_screen" onclick="return validateOrderItems('<?php echo $deliveryminimum; ?>',false, false);" class="needtoadditems red_button">Proceed to Checkout</a>
					<?php }
					else { ?>
							<a  href="../../order/<?php echo $orderid ?>" onclick="return validateOrderItems('<?php echo $deliveryminimum; ?>',false, true);" class="needtoadditems red_button">Proceed to Checkout</a>
					<?php } ?>	
					
					<?php //else if(!$logged_in) { ?>
							<!-- <a href="#login_screen" onclick="return validateOrderItems('<?php //echo $deliveryminimum; ?>',false, false);" class="needtoadditems red_button">Proceed to Checkout</a> -->
					<?php //}	?>
			<br/>
			<h2 class="blue_font">Order Information</h2><br/>
			<div class="address">
				<div class="order_label">Address<a onclick="editAddress()" class="order_edit_link">Edit &raquo;</a></div>
				<div class="addressinfo"><?php 
					$address = '';
					if(isset($_SESSION['streetnum']) && trim($_SESSION['streetnum']) != '')
						$address = $_SESSION['streetnum'].' '.$_SESSION['street'].'<br>';
						
					echo $address.$_SESSION['city'].', '.$_SESSION['state']; 
					
					?></div>
			<a id="editorderaddress" data-container="body" data-toggle="bottom" data-placement="bottom" data-content="" data-original-title="Enter a new address"></a>					
			</div><!-- .address -->			
			<div class="editorderinfo editaddress" style="display:none;">
				<input type="text" id="search_address" value="<?php 
					$address = '';
					if(isset($_SESSION['streetnum']) && trim($_SESSION['streetnum']) != '')
						$address = $_SESSION['streetnum'].' '.$_SESSION['street'].', ';
						
					echo $address.$_SESSION['city'].', '.$_SESSION['state']; 
					?>" placeholder="Street Address, City, and State"/>
				<a id="changeaddress" onclick="changeAddressOnClick()" class="order_edit_link">Submit »</a>
				<a onclick="cancelOrderInfoChange('address')" class="cancellink order_edit_link">Cancel »</a>
				<br>
				<div class="changeorderaddressalert alert alert-danger fade in" style="display: none;">
				        <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
				        We are sorry, <?php echo ucfirst($_SESSION['ordertype']);?> is not available for this address.
				</div>				
			</div>	<!-- .editaddress -->		
			<br/>
			<br/>
				<div class="order_label orderat_label">			
					<?php echo ucfirst($_SESSION['ordertype']);?> Estimate
					<a onclick="editTime()" class="order_edit_link">Edit  &raquo;</a>
				</div>	
				
			<div class="time">
				<b>
					<span class="ordertype_for_text">
						<?php 
							
							if($_SESSION['ordertypeatisasap'] == 'Y')
								$orderat = '';
							else 
								$orderat = $_SESSION['ordertypeat'];
							
							if(date('m/d/Y', strtotime($_SESSION['ordertypefor'])) == $today)
								echo 'TODAY';
							else if(date('m/d/Y', strtotime($_SESSION['ordertypefor'])) == $tomorrow)
								echo 'TOMORROW';		
							else
								echo strtoupper(date('m/d/Y(D)', strtotime($_SESSION['ordertypefor'])));	
								

						?>						
						<?php 
						
							   if($_SESSION['ordertypeatisasap'] == 'N') {
		    						$orderat = strtotime($_SESSION['ordertypeat']);
									$orderat = date("H:i", strtotime('+'.h($ordertype['delivery_estimate_max']).' minutes', $orderat));
									$orderat = $_SESSION['ordertypeat'];
									
									echo '('.DATE("g:ia", STRTOTIME($orderat)).')';
								}
								else if ($_SESSION['ordertypeatisasap'] == 'Y') {
									echo '('.$ordertype['delivery_estimate_min'].' - '.$ordertype['delivery_estimate_max'].' minutes)';
								}
								
							/*if($_SESSION['ordertypeat'] != 'ASAP')
								echo DATE("g:ia", STRTOTIME($_SESSION['ordertypeat'].':00'));
							else
								echo 'ASAP';*/
						?>
						<input type="hidden" id="orderathiddenvalue" value="<?php 
							if($_SESSION['ordertypeat'] != '')
								echo strtoupper($_SESSION['ordertypeat']);
							else
								echo 'ASAP';
							?>" id="ordertype_at"/>
					
					</span>							
					<input type="hidden" value="<?php echo strtoupper($_SESSION['ordertypefor']);?>" id="ordertype_for">			
					<a id="editorderat" data-container="body" data-toggle="bottom" data-placement="bottom" data-content="" data-original-title="Select new day and time"></a>	
				</b>
				<br/>
			</div><!-- .time -->		
			<div class="editorderinfo edittime" style="display:none;">
			<?php 
				/*<select id="editordertype_for">
					<option value="today">TODAY</option>
					<option value="tomorrow">TOMORROW</option>
				</select>*/

					/*echo $this->Form->input('time',array('type'=>'select','options'=>array(
						'today'=>'TODAY',
						'tomorrow'=>'TOMORROW'
					),'id'=>'editordertype_for','label'=>'','default'=>$ordertypefortodaytomor)); 
					*/	
					echo $this->Form->input('time',array('type'=>'select','options'=>$getcurrentfuturedays,'id'=>'editordertype_for','label'=>false,'default'=> date('m/d/Y', strtotime($_SESSION['ordertypefor'])),'class'=>'today_select','onchange'=>'javascript: editordertype_forChange(this);','div'=>'input select today_select'));

					//echo $this->Form->input('time',array('type'=>'select','options'=>$gettodaytime,'empty'=>'Select Time','id'=>'editordertype_at','label'=>'','default'=>strtoupper($_SESSION['ordertypeat'])));
					echo $this->Form->input('time',array('type'=>'select','options'=>$gettodaytime,'id'=>'editordertype_at','label'=>'','default'=> $orderat,'empty'=>'ASAP','div'=>'input select today_select'));
					
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
	
					$orderat = $hour.':'.str_pad($minute, 2, '0', STR_PAD_LEFT);					
					
					echo $this->Form->input('time',array('type'=>'select','options'=>$gettomorrowtime,'id'=>'editordertype_at_tomorrow','label'=>'','default'=> $orderat,'div'=>'input select tomorrow_select'));  
						
				?>
				<br/>
				<a id="changeordertime" onclick="changeOrderTime()" class="order_edit_link">Submit »</a>				
				<a id="changeordertimecancel" onclick="cancelOrderInfoChange('time')" class="order_edit_link">Cancel »</a>
				<br>
				<div class="changeordertimealert alert alert-danger fade in" style="display: none;">
				        <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
				        We are sorry, this restaurant is not open for the time you have selected.
				</div>				
			</div><!-- .edittime -->
			<br/><br/>
			<div class="ordertype">
				<div class="order_label">Order Type<a id="changeordertype" class="ordertype_link order_edit_link">Change to 
					<?php if(trim(strtoupper($_SESSION['ordertype'])) == 'DELIVERY') { echo 'PICKUP'; } else { echo 'DELIVERY'; } ;?> 
				&raquo;</a></div>
				<b><span class="ordertype_val"><?php echo strtoupper($_SESSION['ordertype']);?></span></b>
				<input type="hidden" value="<?php echo strtoupper($_SESSION['ordertype']);?>" id="ordertype">
				<br/>
					
				<input type="hidden" value="<?php if(trim(strtoupper($_SESSION['ordertype'])) == 'DELIVERY') { echo 'PICKUP'; } else { echo 'DELIVERY'; } ;?> " id="ordertype_change">							
			</div>
			<br/><br/>
		<span id="orderinfo">
		
			<?php //echo $_SESSION['deals']; //if($total != '$0.00') { ?>
				<div class="ordertotaldetails">
					<table>
						<tr>
							<td>Food/Beverage Total</td>
							<td>
								<input type="hidden" id="subtotalamount" value="<?php echo $subtotal; ?>"/>
								<span class="total">$ <?php echo $subtotal; ?></span>
							</td>
						</tr>	
						<?php if($_SESSION['deals']) { ?>
						<tr class="red_font">
							<td>First Time Discount</td>
							<td id="discount">
								<?php 
									if(isset($discount) && $discount != '0') {
										echo '($ '. $discount.')';
										echo '<input type="hidden" id="discountval" value="'.$discount.'"/>';	
									}
								?>
							</td>
						</tr>
						<?php } ?>																
						<tr>
							<td>Sales Tax</td>
							<td class="tax">
								<input type="hidden" id="tax" value="<?php echo $salestax; ?>"/>
								$ <?php echo $salestax; ?>
							</td>
						</tr>						
						<?php 
							if(isset($menus[0]['RestaurantOrderType'][0]) && $menus[0]['RestaurantOrderType'][0]['delivery_charge'] != null && 
							strtoupper(trim($_SESSION['ordertype'])) != 'PICKUP') 
							{
						?>
								<tr id="deliverychargerow">
									<td>Delivery Charge</td>
									<td>
									<input type="hidden" id="deliverycharge" value="<?php echo $menus[0]['RestaurantOrderType'][0]['delivery_charge']; ?>"/>
										<span class="deliverycharge">
											
											$ <?php echo $_SESSION['deliverycharge'];
											//echo $menus[0]['RestaurantOrderType'][0]['delivery_charge']; 
											?>
										</span>
									</td>
								</tr>
						<?php 
							}
						?>							
						<tr>
							<td>Select Tip Amount</td>
							<td>
								<?php 	
									if(isset($orderdetails))										
									echo $this->Form->input('tip',array('type'=>'select','options'=>$tip,'empty'=>'Select Tip','id'=>'tipamount','label'=>'','default'=>$orderdetails[0]['TempOrder']['tip'])); 
								?>
							</td>
						</tr>
					</table>
				</div>
				<div class="orderpromo">
					<table>
						<tr>
							<td>
								<div id="enter_promotioncode" class="red_font">Promotion Code</div>
								<div class="promotioncode_valid red_font"></div>
								<div class="promotioncode_valid red_font">Promotion Discount</div>
							</td>
							<td>
								<div class="promotioncode_discount red_font"></div>
								<input type="text" id="promotioncode" value=""/>
								<div class="order_label promotioncode_btn">
									<a id="validatepromo" class="order_edit_link">Add Promo &raquo;</a>
								</div>
								<div class="promotioncode_msg red_font">
									<?php if(isset($orderdetails[0])) 
											echo '($'.$orderdetails[0]['TempOrder']['promo_discount'].')'; 
									?>
								</div>
								<div class="order_label promotioncode_btn">
									<a id="removepromo" class="order_edit_link">Remove &raquo;</a>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<div class="ordertotal">
					<table class="red_font">
						<tr>
							<td>Discounted Total</td>
							<td class="ordertotal">
							<span id="totalamount_text">
								<?php 
									echo '$'.$total; 
								?>	
							</span>
							<input type="hidden" id="totalamount" value="<?php echo $total; ?>"/>							
							</td>
						</tr>
					</table>
				</div>
				<div id="order_details">
						<br>
						<br>
					<?php
					if(isset($hasUpSell)) { ?>
							<a href="#upsellmenu" onclick="return validateOrderItems('<?php echo $deliveryminimum; ?>',true, false);" class="red_button">Proceed to Checkout</a>
					<?php } 
					else if(!$logged_in) { ?>
							<a href="#login_screen" onclick="return validateOrderItems('<?php echo $deliveryminimum; ?>',false, false);" class="needtoadditems red_button">Proceed to Checkout</a>
					<?php }
					else { ?>
							<a  href="../../order/<?php echo $orderid ?>" onclick="return validateOrderItems('<?php echo $deliveryminimum; ?>',false, true);" class="needtoadditems red_button">Proceed to Checkout</a>
					<?php } ?>	
					<br/>	
								
					<h2 class="blue_font">Order Details</h2><br/>
					<div id="order_details_allitems">
					
					<?php 
					if(isset($orderdetails)) {
					foreach($orderdetails[0]['TempItem'] as $orderitem):
					//if ((isset($upsellitems) && !in_array($orderitem['Item']['id'], $upsellitems)) || !isset($upsellitems)) {
					echo '<div class="order_details_itemslist">';
						echo '<button type="button" class="close" id="'.$orderitem['Item']['id'].'">×</button>';					
						echo '<span class="order_details_price">'.$orderitem['quantity'].' '.$orderitem['Item']['name'].' - $'.$orderitem['Item']['price'].'</span>';						
						if ((isset($upsellitems) && !in_array($orderitem['Item']['id'], $upsellitems)) || !isset($upsellitems)) {	
							echo '<span class="order_details_edit"><a href="#" class="order_details_item_name blue_font">Edit&raquo;</a></span>&nbsp;&nbsp;';						
							//echo '<span class="order_details_edit"><a href="#" class="red_font delete">Remove</a></span>';							
						}
						else {
							//echo '<span class="order_details_edit"><a id="'.$orderitem['id'].'" class="blue_font upsellitem">Delete</a></span>';
						}
						
						//Form				
						echo $this->Form->create('TempOrder',array('controller'=>'TempOrders','action'=>'deleteitem'));
						//Delete Popup
						echo '<div class="modal fade deleteitem" id="modal'.$orderitem['Item']['id'].'">';
						  echo '<div class="modal-dialog">';
						   echo '<div class="modal-content">';
						      echo '<div class="modal-header">';
						        echo '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
						        echo '<h4 class="modal-title">Delete Item</h4>';
						     echo '</div>';
						      echo '<div class="modal-body">';
								echo $this->Form->hidden('TempOrder.id',array('value'=>$orderdetails[0]['TempOrder']['id'], 'class'=>'itemid'));
								echo $this->Form->hidden('TempOrder.tip',array('value'=>$orderdetails[0]['TempOrder']['tip'], 'class'=>'tip'));
								echo $this->Form->hidden('TempItem.0.temp_order_id',array('value'=>$orderdetails[0]['TempOrder']['id'], 'class'=>'itemid'));
								
								echo $this->Form->hidden('TempItem.0.id',array('value'=>$orderitem['id'], 'class'=>'itemid'));
								
								echo $this->Form->hidden('TempItem.0.item_id',array('value'=>$orderitem['Item']['id'], 'class'=>'itemid'));
								echo $this->Form->hidden('TempOrder.ItemPrice',array('value'=>$orderitem['Item']['price'], 'class'=>'itemprice'));	
						        echo 'Are you sure you want to delete this item?';
						      echo '</div>';
						      echo '<div class="modal-footer">';
						        echo $this->Js->submit(__('Delete Item'), array('update'=>'#orderinfo', 'url'=>array('controller'=>'TempOrders','action'=>'deleteitem'), 'class'=>'btn deleteitem','evalScripts'=>true));
						        echo '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';			
						      echo '</div>';
						    echo '</div><!-- /.modal-content -->';
						  echo '</div><!-- /.modal-dialog -->';
						echo '</div><!-- /.modal -->';
						echo $this->Form->end();
											
							//Form				
							echo $this->Form->create('TempOrder',array('controller'=>'TempOrders','action'=>'updateitem'));
								echo $this->Form->hidden('TempOrder.id',array('value'=>$orderdetails[0]['TempOrder']['id'], 'class'=>'itemid'));
								echo $this->Form->hidden('TempOrder.tip',array('value'=>$orderdetails[0]['TempOrder']['tip'], 'class'=>'tip'));
								echo $this->Form->hidden('TempItem.0.temp_order_id',array('value'=>$orderdetails[0]['TempOrder']['id'], 'class'=>'itemid'));
								
								echo $this->Form->hidden('TempItem.0.id',array('value'=>$orderitem['id'], 'class'=>'itemid'));
								
								echo $this->Form->hidden('TempItem.0.item_id',array('value'=>$orderitem['Item']['id'], 'class'=>'itemid'));
								echo $this->Form->hidden('TempOrder.ItemPrice',array('value'=>$orderitem['Item']['price'], 'class'=>'itemprice'));	
						
						//End Delete Popup
						//Popup
							echo '<div id="edititem'.$orderitem['id'].'" class="item_variation modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Item Options" aria-hidden="true">';
							/*echo '<div class="modal-header">
    								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    								<h3 id="myModalLabel" class="darkblue_font enter_del_address">Update your order below:</h3>
 								</div>';*/
						  			echo '<div class="modal-dialog">';
						    			echo '<div class="modal-content">';
						    			
									      echo '<div class="modal-header">';
									        echo '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
									        	
											echo $this->Form->input('TempItem.0.quantity', array('value'=>'1','class'=>'quantity', 
												'label'=>'QTY','div' => false, 'value'=>$orderitem['quantity']));
											
											echo '<span class="item_name_variation red_font">'.$orderitem['Item']['name'].'</span>';
											echo '<span class="item_name_price red_font">$'.$orderitem['Item']['price'].'</span>'; 											
									      echo '</div>';//modal-header 								
 											echo '<div class="modal-body">';							
											echo '<div class="itemdescription">';
												echo $orderitem['Item']['description'];
											echo '</div>'; 
								
											/*echo '<div class="item_variation_header">';
												echo $this->Form->input('TempItem.0.quantity', array('value'=>'1','class'=>'quantity', 
												'label'=>'QTY','div' => false, 'value'=>$orderitem['quantity']));
												echo '<span class="item_name_variation red_font">'.
												
												$orderitem['Item']['name'].'</span><span class="item_name_price red_font">'.$orderitem['Item']['price'].
												'</span>';
											echo '</div>';
											*/											
											
												$variationval='';
												$tempvariationval = '';
												echo '<div class="item_variation_details">';
														$vcount = 0;
											foreach($orderitem['Item']['VariationGroup'] as $variationgroup):
											
												echo '<span class="variationgroup_name">'.
												$variationgroup['group_name']."</span><br/>";
												
												//echo $this->Form->hidden('TempItem.0.VariationGroup.name',array('value'=>$variationgroup['group_name']));
						
												$g = 0;			
												$variationlist = array();												

												foreach($variationgroup['Variation'] as $variation):
													//Loop through Temp Item Variation Group and get values
													foreach($orderitem['TempVariation'] as $tempvariation):
														if($variation['id'] == $tempvariation['variation_id']) {
															$variationval = $tempvariation['variation_id'];
															$tempvariationval = $tempvariation['id'];
															break;
														}
													endforeach;
													if($variation['amount'] == 0)
														$amnt = '';
													else
														$amnt = $variation['amount'];
													$variationlist[$variation['id']] = $variation['name'].'&nbsp;($'.$amnt.')';
												
													//Checkboxes
													if($variationgroup['num_choices'] != '1') {
															
														if($variation['id'] == $variationval) {
															echo $this->Form->input('TempItem.0.TempVariationCheckbox.'.$vcount.'.Checkbox.'.$g.'.ischecked', array('label'=>$variation['name'].'&nbsp;($'.$amnt.')','type'=>'checkbox','class'=>'variation','checked'=>true));
														}
														else {
															echo $this->Form->input('TempItem.0.TempVariationCheckbox.'.$vcount.'.Checkbox.'.$g.'.ischecked', array('label'=>$variation['name'].'&nbsp;($'.$amnt.')','type'=>'checkbox','class'=>'variation','checked'=>false));														
														}
														
														
														echo $this->Form->hidden('TempItem.0.TempVariationCheckbox.'.$vcount.'.Checkbox.'.$g.'.variation_id', array('value'=>$variation['id']));
														
														echo $this->Form->hidden('TempItem.0.TempVariationCheckbox.'.$vcount.'.Checkbox.'.$g.'.id', array('value'=>$tempvariationval));														
														
													}
													
													$g++;
													
												endforeach;
												//$orderitem['TempVariation'][0]['Variation']['id']
												
												//Radio buttons
													if($variationgroup['num_choices'] == '1') {
														echo '<ul><li>';
														
															echo $this->Form->input('TempItem.0.TempVariation.'.$vcount.'.variation_id', array('type'=>'radio','options'=>$variationlist,'legend'=>false,'separator'=>'</li><li>','div'=>false,
																'value'=>$variationval,'class'=>'variation'));
															
															
														echo '</li></ul>';
													}
											
											$vcount++;
											endforeach;	
										echo '</div><!-- .item_variation_details -->';
									echo '<div class="item_variation_instructions">';
										echo '<b>Special Instructions</b><br/>
										<span style="font-size: .8em">Please Note: Any price altering instructions entered below will be charged to your credit 																card after your order is
										processed (extra cheese, side of sour cream, etc)</span>.<br/><br/>';
										
									echo $this->Form->input('TempItem.0.special_instructions',array('value'=>$orderitem['special_instructions'], 'type'=>'textarea','class'=>'specialinstructions'));
										
									echo '</div>';
									echo '<div class="clear"></div>';
									echo '</div>';//.modal-body
									echo '<div class="modal-footer">';
									//echo $this->Form->button("Add", array('class' => 'btn btn-success','escape' => false )); 
									echo $this->Js->submit(__('Update Order'), array('update'=>'#orderinfo', 'url'=>array('controller'=>'TempOrders','action'=>'updateitem'), 'class'=>'btn btn-primary updateitem','evalScripts'=>true));
									
									echo '<button class="btn closeaddtoorder" data-dismiss="modal" aria-hidden="true">Close</button>';									
									
									//echo $this->Js->submit(__('Delete Item'), array('update'=>'#orderinfo', 'url'=>array('controller'=>'TempOrders','action'=>'deleteitem'), 'class'=>'btn deleteitem','evalScripts'=>true));
																		
									echo '</div>';
									echo '</div>';
									echo '</div>';
									echo $this->Form->end();
									
																	
																	//echo '<input type="button" class="red_button additem" value="Add to Order" />';
																	echo '</div><!-- .item_variation -->';
									
												
												//End Popup
												//echo '<span class="order_details_item">'.$orderitem['quantity'].' '.$orderitem['Item']['name'].'</span>';
												
												foreach($orderitem['TempVariation'] as $orderitemvariation):
													if($orderitemvariation['Variation']['amount'] != '0.00')
														echo '<span class="order_details_item_variation">+'.$orderitemvariation['Variation']['name'].' '.$orderitemvariation['Variation']['amount'].'</span>';
													else 
														echo '<span class="order_details_item_variation">+'.$orderitemvariation['Variation']['name'].'</span>';
												endforeach;
											if($orderitem['special_instructions'] != 'upsell')
											echo '<span class="order_details_instructions">'.$orderitem['special_instructions'].'</span>';
																						
											echo '</div>';
										//}//End if upwell items in array
										//else {
										?>
											<script>
												var tempitemid = <?php echo $orderitem['item_id']; ?>;
												var tempid = <?php echo $orderitem['id']; ?>;
												var upsellitem = "." + tempitemid + "upsell";
												var upsell_tempitemid = "#upsell_tempitemid_" + tempitemid;
												jQuery(upsell_tempitemid).val(tempid);
												jQuery(upsellitem).attr('checked','checked');
												
											</script>
										<?php
										//}
										endforeach;
									
									echo $this->Js->writeBuffer();
									}
?>
					</div><!-- #order_details_allitems -->
				</div><!-- .order_details -->
			<?php //} ?>
			</span><!-- #orderinfo -->
		</div><!-- #orderinformation -->
	</div><!-- .wrapper -->
</div><!-- restaurantmenu -->
<!-- Modal -->
<!-- Enter New Address -->
<div id="newAddress" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel" class="darkblue_font enter_del_address"><?php //echo $this->Html->image('delivery-truck.png', array('alt' => 'Delivery Truck','style'=>'width:41px;')); ?><br><span style="font-size: 14px;">Delivery from this restaurant is not available to your address.  <br>Please click <a href="../../search/<?php echo $_SESSION['city']; ?>" class="red_font">here</a> to select another restaurant or enter a new address below:</span></h3>
  </div>
  <div class="modal-body">
    <p>
    	<?php if(strtoupper(trim($_SESSION['ordertype'])) != 'PICKUP') { ?>
    		<a id="findMe" onclick="return findMe()">Find Me</a> 
    	<?php } ?>
    	
    	<input type="text" id="search_new_address"/>
    </p>
	   	<div class="user_message">Enter Address, City, State</div>
    <p>
    	<div id="addressinvalid" style="display: none;" class="alert alert-danger"></div>
    </p>
  </div>
  <div class="modal-footer">
	    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    	<button class="btn lightblue_button" id="changeaddress_modal">Find My Food!</button>
  </div>
</div>
<!-- End Enter New Address -->
<div id="login_screen" class="modal hide fade">
  <div class="modal-header">
  	<!-- <h3 class="darkblue_font">Existing or New User?</h3> -->
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
  </div>
  <div class="modal-body">
	<div id="existing_user">
			<?php if (!empty($error)) {?>
				<div style="margin-bottom:0px;" class="alert alert-error"><?php echo $error;?></div>
			<?php } ?>
			<?php 	echo $this->Form->create('User', array('action' => 'login_onpage','class'=>'form-signin'));
					echo $this->Form->hidden('temp_order_id',array('value'=>$orderid)); 
			?>
			<div style="display: none;">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Session->flash('auth'); ?>
			</div>
			<span class="darkblue_font">Returning customers, please log in below.</span>
			<br/><br/>
			<label><?php echo __('Email'); ?> </label>
			<div class="input-prepend">
				<span class="add-on"> <i class="icon-user"></i>
				</span>
				<?php echo $this->Form->input('user_email',array('div' => false,'label'=>false,'placeholder'=>__('Email address'))); ?>
			</div>
			<label><?php echo __('Password'); ?> </label>
			<div class="input-prepend">
				<span class="add-on">@</span>
				<?php echo $this->Form->password('user_password',array('div' => false,'label'=>false,'placeholder'=>__('Password'))); ?>
			</div>
			<label class="checkbox"> <?php echo $this->Form->checkbox('remember_me',array('div' => false,'label'=>false)); ?>
				<?php echo __('Remember me'); ?>
			</label>
			<label>
					<a href="#" onclick='resetPassword(); return false;'><?php echo __('Can\'t access your account?'); ?></a> 
			</label>			
			<div>
				<?php echo $this->Js->submit(__('Sign In'), array('update'=>'#loginmsg','url'=>array('controller'=>'users','action'=>'login_onpage'), 'class'=>'lightblue_button','evalScripts'=>true)); ?>
									
				<!--<button type="submit" class="btn btn-large btn-primary">
				 <a id="btnSignIn" class="btn btn-large btn-primary">
					<?php //echo __('Sign in'); ?>
				</a> -->
				</button>
				<div id="loginmsg" class="alert alert-error user_message"></div>
			</div>
			<?php if (isset($general['Setting']) && (int)$general['Setting']['disable_reset_password'] == 0){?>
				<label>
					<a href="#" onclick='resetPassword(); return false;'><?php echo __('Can\'t access your account?'); ?></a> 
				</label>
			<?php } ?>
			<?php if (isset($general['Setting']) && (int)$general['Setting']['disable_registration'] == 0){?>
				<label>
					<?php echo $this->Html->link(__('Create new an Account'), array('controller' => 'users','action' => 'signup')); ?>
				 </label>
			<?php }?>
			<?php echo $this->Form->end(); ?>
	</div><!-- #existing_user -->
	<div id="new_user">		
		<span class="darkblue_font">If you're new, click on the new user button below.</span>
		<br/><br/><br/>
		<a href="../../order/<?php echo $orderid ?>/new" class="lightblue_button">New User</a>
	</div>
  </div>
</div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<?php echo $this->Html->script('bootstrap.modal.js'); ?>

<?php //echo $this->Html->script('map.js'); ?>

<script>
	var mainurl = '<?php echo Configure::read('mainurl'); ?>';
	jQuery('#btnSignIn').click(function() {
		SignInUser();
	});
	
	//Change Address from the modal - the modal "only" displays when order type has been changed
	jQuery('#changeaddress_modal').click(function() {
		var address_val = jQuery('#search_new_address').val();
		var btnid = $(this).attr('id');
		var ordertype_val = jQuery('#ordertype').val();
		var restaurantid = <?php echo $_SESSION['restaurant_id'];?>;
		ordertype_val.replace(/^\s+|\s+$/g,'');
					
		if(ordertype_val.toUpperCase() == 'DELIVERY')
			ordertype_val = 'PICKUP';
		else if (ordertype_val.toUpperCase() == 'PICKUP')
			ordertype_val = 'DELIVERY';			
		debugger;
		changeAddress(address_val, ordertype_val, restaurantid, 'modal');
		
	});
	
	//Change Address from typing in a new address in the box
	//jQuery('#changeaddress').click(function() {
	function changeAddressOnClick() {
		var address_val = jQuery('.popover-content #search_address').val();
		var ordertype_val = jQuery('#ordertype').val();
		var restaurantid = <?php echo $_SESSION['restaurant_id'];?>;
		ordertype_val.replace(/^\s+|\s+$/g,'');
		debugger;
		changeAddress(address_val, ordertype_val, restaurantid, 'textbox');
	}
	//});
	
	
	//Change Order Type
	jQuery('#changeordertype').click(function() {
		var ordertype_val = jQuery('#ordertype_change').val();
		var restaurantid = <?php echo $_SESSION['restaurant_id'];?>;
		var city = '<?php echo $_SESSION['city']; ?>';
		changeOrderType(ordertype_val, restaurantid, city);
		
	});
	
	//Add Upsell Item
	function addupsellitem(id) {
		var upsellitem = '.' + id + 'upsell';
		var temporderid_val = <?php echo $orderid; ?>;
		var itemid_val = id;
		addUpsell(upsellitem, temporderid_val, itemid_val, id);
	}
	

	//Change Order type for today or tomorrow
	/*jQuery('#editordertype_for').change(function() {
		alert('test');
		var ordertypefor = jQuery('#editordertype_for').val();
		changeOrderTypeFor(ordertypefor);

	});*/

	
	function editordertype_forChange(ordertype) {
		debugger;
		//var ordertypefor = jQuery('#editordertype_for option:selected').text().toLowerCase();
		var ordertypefor = jQuery(ordertype).find('option:selected').text().toLowerCase();
		changeOrderTypeFor(ordertypefor);
	}

	
	//Hides the validation message box
	jQuery('#promotioncode_valid').hide();
	
	//Validate Promotion Code*/
	jQuery('#validatepromo').click(function() {
		var ordertype_val = '<?php echo $orderdetails[0]['TempOrder']['order_type_id']; ?>';
		var promocode = jQuery('#promotioncode').val();
		var orderid_val = '<?php echo $orderid ?>';
		
		validatePromotionCode(ordertype_val, promocode, orderid_val);

	});
	
	//Removes Promotion Code
	jQuery('#removepromo').click(function() {
		var orderid_val = '<?php echo $orderid ?>';
		removePromotionCode(orderid_val);
	});
	
	/*jQuery(".upsellitem").click(function() {
		var temporderid_val = <?php echo $orderid; ?>;
		var tempitemid_val = jQuery(this).attr('id');

		if(tempitemid_val != "") {
			$.ajax({
		        type: 'POST',
		        url: '/imeals/TempOrders/deleteupsellitem/',
		        data: {tempitemid: tempitemid_val, temporderid: temporderid_val},
		        success:function(data){
		            results = data;
					jQuery(upsell_tempitemid).val('');
					jQuery("#orderinfo").empty();
					jQuery("#orderinfo").html(data);
		        },
		        error:function(data){
			        results = data;
		        },
		        timeout: 5000
			}).done(function(){
				
			});
		}
	});	*/

	/*jQuery('#tipamount').change(function() {
		var subtotal = jQuery('#subtotalamount').val();
		var tax = jQuery('#tax').val();	
		
		var deliverycharge = 0;
		if(jQuery('#deliverycharge').length > 0 && jQuery('#deliverycharge').val() != "") {
			deliverycharge = jQuery('#deliverycharge').val();
			deliverycharge = parseFloat(deliverycharge);
		}
		
		if(jQuery('#discountval').length)
			var discount = jQuery('#discountval').val();	
		else
			var discount = 0;
			
		var tip = jQuery(this).val();
		jQuery('.tip').val(tip);
		
		total = (parseFloat(subtotal) + parseFloat(tip) + parseFloat(tax)) - parseFloat(discount) + deliverycharge;
		total = parseFloat(total, 10).toFixed(2);
		
		jQuery('#totalamount').val(total);
		jQuery('#totalamount_text').html('$'+total);
		
		$.ajax({
		        type: 'POST',
		        url: '/imeals/Restaurants/updateTipAmount/',
		        data: {totalamnt: total, tipamnt: tip},
		        success:function(data){
		            results = data;
		        },
		        error:function(data){
			        results = data;
		        },
		        timeout: 5000
			}).done(function(){
					
			});
	});
	*/
	
	/* Find Me */
  function findMe() {
  	//$('#findMe').html('One moment....We are trying to find you.');
  	//$('#findMe').click(function () {
	    // test for presence of geolocation
	    jQuery('#search_new_address').val('We are looking for you...');
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
	        	
	          jQuery('#search_new_address').val(citystate);
	          //$(this).html("<p><b>Abracadabra!</b> My guess is:</p><p><em>" + results[0].formatted_address + "</em></p>").fadeIn();
	        });
	      } else {
	      	$('#search_new_address').val('Sorry we could not find you.  Try Again');
	        //error("Google did not return any results.");
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

function resetPassword() {
	jQuery('#login_screen').modal('hide');
	
	var step = 1;
    var mId = $.sModal({
    	header:'<?php echo __('<h3 class="darkblue_font">Reset Password</h3>'); ?>',
    	width:450,
        form:[
			{label:'<?php echo __('Email Address'); ?>',type:'text',name:'user_email',attr:{'placeholder':'Email address',style:'width:300px;'}}
              ],
        animate: 'fadeDown',
        buttons: [{
            text: ' <?php echo __('Submit'); ?> ',
            addClass: 'btn-primary lightblue_button',
            click: function(id, data) {
            	if (step == 1){
	            	var btnSubmit = $('#'+id).children('.modal-footer').children('button');
	            	btnSubmit.attr({disabled:'disabled'});
	            	btnSubmit.text('<?php echo __('Loading...'); ?>');
	            	$.post('<?php echo Router::url(array('controller' => 'users','action' => 'resetPassword')); ?>',{data:{User:{user_email:$('#'+id).find('#user_email').val()}}},function(o){
	            		if (o.send_link == 1){
		            		btnSubmit.attr({disabled:false});
		                	btnSubmit.text('<?php echo __('Done'); ?>');
		                	$('#'+id).children('.modal-body').children('div').html('<div class="alert alert-success" style="padding:8px;"><?php echo __('We have sent you an password reset instructions email. Please check your email.'); ?></div>');
		                	step =2;
	            		}else{
	            			btnSubmit.attr({disabled:false});
		                	btnSubmit.text(' <?php echo __('Submit'); ?> ');
	            			step =1;
	            			$('#'+id).find('.alert-error').remove();
	            			$('#'+id).children('.modal-body').children('div').prepend('<div class="alert alert-error" style="padding:8px;"><?php echo __('<strong>Error</strong> !, Please provide a correct email address.'); ?></div>');
	            		}
	            	},'json');
            	}else if (step == 2){
            		$.sModal('close', id);
            	}
            }
        }]
        });
    $('#'+mId).find('input[type="text"]').each(function(){
		$(this).keypress(function(event){
			 if ( event.which == 13 ) {
			 	event.preventDefault();
			 }
		});
	});
}

	//Show and hide Menu Category (+) and (-)
	jQuery('a.category_showhide').click(function(e) {
		e.preventDefault();
		var category = jQuery(this);
		category.parent().parent().find('.menu_items').slideToggle();
		if(category.html() == '+')
				category.html('-')
			else
				category.html('+');
		debugger;
	});
	
</script>
<style type="text/css">
.modal-backdrop {
	
}
</style>
<?php 

// Add bootstrap modal 3.2 js
echo $this->Html->script('menu.js'); ?>
	<?php 
	if (isset($orderdetails) && ($orderdetails[0]['TempOrder']['promo_discount'] == null || $orderdetails[0]['TempOrder'] ['promo_discount'] == 0.00)) { ?> 
		<script>
			jQuery('#enter_promotioncode').show();
			jQuery('#promotioncode').show();
			jQuery('#validatepromo').show();			
		</script>
	<?php  } else { ?>
		<script>
			jQuery('.promotioncode_msg').show();
			jQuery('#removepromo').show();
			jQuery('.promotioncode_valid').show();
		</script>			
	<?php } ?>

<!-- <link href="<?php //echo $this->request->webroot; ?>bootstrap/css/bootstrap.modal.css" rel="stylesheet"> -->
<?php //echo $this->Html->script('bootstrap-transition.js'); ?>
<?php //echo $this->Html->script('bootstrap.modal.3.2.js'); ?>