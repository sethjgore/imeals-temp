<?php 
	//echo $menus[0]['RestaurantOrderType'][0]['Menu'][0]['upsell_y_n'];
	//echo '<pre>';
		//var_dump($gettodaytime);
	//echo '</pre>';
	//echo $_SESSION['orderid'];  //$_SESSION['orderid'] = null; 

?>
<div id="orderingsteps">
	<div class="wrapper">
		<ul>
			<li><a href="#">1. Enter Your Info</a></li>
			<li><a href="../search/<?php echo $_SESSION['city']; ?>">2. Select a Restaurant</a></li>
			<li><a href="#" class="active">3. Order from the Menu</a></li>
			<li><a href="#">4. Checkout</a></li>						
		</ul>
	</div><!-- .wrapper -->
</div><!-- #orderingsteps -->
<input type="hidden" id="orderid" value="<?php echo $orderid ?>"/>
<?php //echo $_SESSION['deliverycharge'];//echo $_SESSION['ordertypedate']; ?>
<div id="menu">
<ul id="validation"></ul>
	<div class="wrapper">
		<div id="restaurantmenuinfo"> 
			<?php 
    		foreach($menus[0]['RestaurantOrderType'] as $ordertype):
    		//If has menu
    		if(isset($ordertype['Menu']) && count($ordertype['Menu']) > 0):
    		?>
      
    		<div id="restaurantinfo">
    				<img src="<?php echo $menus[0]['Restaurant']['logo_url'] ?>"/>
    		    
    				<div class="heading">
    					<span class="blue_font"><?php echo $menus[0]['Restaurant']['name'] ?></span>
    				</div><!-- .heading -->
    				
    				<div class="rest_address">
    					<?php echo $menus[0]['Restaurant']['address'] . ', ' .
    					 $menus[0]['City']['name'] . ', ' . $menus[0]['City']['State']['abbreviation'];  ?>
    				</div><!-- .rest_address -->
            
            <div class="rest_delivery">
    					Delivery Estimate: <?php
    						echo $ordertype['delivery_estimate_min'].' - '.$ordertype['delivery_estimate_max'];
    				?>
    				</div><!-- .rest_delivery -->
    				
    				<div class="rest_minimum">
    					Delivery Minimum: <?php
    						echo '$'.$ordertype['delivery_min'];
    				?>
    				</div><!-- .rest_minimum -->
    				<div class="build_meal">
    				  Build Your Meal Below
    				</div><!-- .build_meal -->
            <div class="clear"></div>
    			</div><!-- #restaurantinfo -->
    			<div class="restaurantmenu">
    				<?php
    						foreach($ordertype['Menu'] as $menu): 
    						if($menu['upsell_y_n'] != 1) {
    						
    							//echo $menu['name'].'<br/>';		?>
    							<div class="skip_cat">
            				<a href="#">Skip to Menu Category</a> 
            				<ul class="go_to_cat">
              				<?php foreach($menu['Category'] as $category):
              				  echo '<li><a href="#'.str_replace(' ' , '', $menu['name']) . '-' . str_replace(' ' , '', $category['name']).'">' . $category['name'] . '</a></li>';
              				endforeach; ?>
            				</ul>
            			</div><!-- .skip_cat -->
            			<div class="pop_item">
            				<?php echo $this->Html->image('popular.png', array('alt' => 'Popluar Item')); ?> = Popular Item
            			</div><!-- .pop_item -->
            			<div class="clear"><br><br></div>
            			<?php
    							foreach($menu['Category'] as $category):
    								echo '<div class="category" id="'.str_replace(' ' , '', $menu['name']) . '-' . str_replace(' ' , '', $category['name']).'"><span class="subheading darkblue_font">'.$category['name'].
    								'<a href="#" class="category_showhide">-</a></span>';
    								
    									echo '<div class="menu_items">';
    									$i = 0;
    									$a = 0;
    									//Menu items
    									
    										while ($a <= 1):
    											if($a == 0) {
    												echo '<div class="item_left">';
    											}
    											else {
    												echo '<div class="item_right">';
    											}
    												
    											foreach($category['Item'] as $item):
    												if(is_int($i / 2)) {
    													echo '<div class="item">';
    													echo '<a href="#" class="item_name blue_font">'.$item['name'].'</a>
    													<span class="item_price">$'.$item['price'].'</span>';
    													
    													//hover for item
    													echo '<div class="item_hover" style="display:none;">';
    															echo '<img src="'.$item['photo_url'].'" />';
    															echo '<a href="#" class="red_font">'.$item['name'].'</a>';
    															echo $item['description'];
    													echo '</div>';//End item_hover
    													
    														//popup for item
    														echo '<div class="item_variation modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Item Options" aria-hidden="true">';
    														
    										//Form				
    										echo $this->Form->create('TempOrder',array('controller'=>'TempOrders','action'=>'additem'));
    											echo $this->Form->hidden('TempOrder.id',array('value'=>$orderid, 'class'=>'itemid'));
    											echo $this->Form->hidden('TempOrder.tip',array('value'=>'0.00', 'class'=>'tip'));
    											echo $this->Form->hidden('TempItem.0.temp_order_id',array('value'=>$orderid, 'class'=>'itemid'));
    											echo $this->Form->hidden('TempItem.0.item_id',array('value'=>$item['id'], 'class'=>'itemid'));
    											echo $this->Form->hidden('TempOrder.ItemPrice',array('value'=>$item['price'], 'class'=>'itemprice'));
    											
    														echo '<div class="item_variation_header">';
    															echo $this->Form->input('TempItem.0.quantity', array('value'=>'1','class'=>'quantity', 'label'=>'QTY', 'div'=>false));
    															echo '<span class="item_name_variation red_font">'.
    															
    															$item['name'].'</span><span class="item_name_price red_font">'.$item['price'].
    															'</span>';
    														echo '</div>';
    														
    														
    															echo '<div class="item_variation_details">';
    																$vcount = 0;
    																foreach($item['VariationGroup'] as $variationgroup):
    																
    																	echo '<span class="variationgroup_name">'.
    																	$variationgroup['group_name']."</span><br/>";
    																	
    																	//echo $this->Form->hidden('TempItem.0.VariationGroup.name',array('value'=>$variationgroup['group_name']));
    											
    																	$g = 0;			
    																	$variationlist = array();												
    	
    																	foreach($variationgroup['Variation'] as $variation):
    																	
    																	
    																	$variationlist[$variation['id']] = $variation['name'].'&nbsp;($'.$variation['amount'].')';
    																	
    																	
    																		//Checkboxes
    																		if($variationgroup['num_choices'] != '1') {
    																			echo $this->Form->input('TempItem.0.TempVariationCheckbox.'.$vcount.'.Checkbox.'.$g.'.ischecked', array('label'=>$variation['name'].'&nbsp;($'.$variation['amount'].')','type'=>'checkbox','class'=>'menu_variation variation',
    																				'checked'=>false));
    																			
    																			echo $this->Form->hidden('TempItem.0.TempVariationCheckbox.'.$vcount.'.Checkbox.'.$g.'.variation_id', array('value'=>$variation['id']));
    																			
    																		}
    																		
    																		
    																		$g++;
    																		
    																	endforeach;
    																			
    																		if($variationgroup['num_choices'] == '1') {
    																			echo '<ul><li>';
    																			
    																				echo $this->Form->input('TempItem.0.TempVariation.'.$vcount.'.variation_id', array('type'=>'radio','options'=>$variationlist,'legend'=>false,'separator'=>'</li><li>','div'=>false,'value'=>$variationgroup['Variation'][0]['id'],'class'=>'variation'));
    																				
    																				
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
    														
    										//echo $this->Form->button("Add", array('class' => 'btn btn-success','escape' => false )); 
    
      echo $this->Js->submit(__('Add to Order'), array('update'=>'#orderinfo', 'url'=>array('controller'=>'TempOrders','action'=>'additem'), 'class'=>'red_button additem','evalScripts'=>true));
      
      echo $this->Form->end();
     
    														
    														//echo '<input type="button" class="red_button additem" value="Add to Order" />';
    														echo '</div><!-- .item_variation -->';
    														//End pop up for item
    													echo '</div><!-- .item -->';
    												}
    												$i++;
    											endforeach;
    											
    											echo '<div class="clear"></div></div><!-- .item_left/right -->';
    											
    											$a++;
    										endwhile;
    									
    									echo '</div><!-- .menu_items -->';
    									echo '<div class="clear"></div>';
    								echo '</div><!-- .category -->';
    								
    							endforeach;			
    							}//End if upsell
    							else { 
    								$hasUpSell = true;
    							?>
    								<div id="upsellmenu" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									  <div class="modal-header">
									    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									    <h3 id="myModalLabel">Can we offer you anything else?</h3>
									  </div>
									  <div class="modal-body">
            						<?php
    							foreach($menu['Category'] as $category):
									echo '<div class="menu_items">';
										$r = 0;
										
										foreach($category['Item'] as $item):
												$upsellitems[$r] = $item['id'];
												 
												echo '<div class="item_variation">';
													
													echo '<input type="checkbox" onclick="addupsellitem(\''.$item['id'].'\')" class="'.$item['id'].'upsell"/>';
													
													echo '<input type="hidden" id="upsell_tempitemid_'.$item['id'].'"/>';
													echo '<input type="hidden" id="'.$item['id'].'"/>';
													
													echo '<span class="item_name blue_font">'.$item['name'].'</span>
														<span class="item_price">$'.$item['price'].'</span>';

    												echo $this->Form->hidden('TempOrder.id',array('value'=>$orderid, 'class'=>'itemid_upsell'));
    												
    												echo $this->Form->hidden('TempItem.0.temp_order_id',array('value'=>$orderid, 'class'=>'itemid_upsell'));
    												
    												echo $this->Form->hidden('TempItem.0.item_id',array('value'=>$item['id'], 'class'=>'itemid_upsell'));
    												
    												echo $this->Form->hidden('TempOrder.ItemPrice',array('value'=>$item['price'], 'class'=>'itemprice_upsell'));
    												
												echo '</div><!-- .item -->';
										endforeach;
									
										echo '</div><!-- .menu_items -->';
    								echo '</div><!-- .category -->';
    								
    							endforeach; ?>
		    							  <div class="modal-footer">
										    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
										    <?php
										    if(!$logged_in) {
												echo '<a href="#login_screen" id="finish_upsell" class="red_button" data-toggle="modal">All Done!</a>';
											}			
											else {
												echo '<a  href="../order/"'.$orderid.'class="red_button">All Done!</a>';
														
											}
											?>	
											
										  </div>
    								  </div>
									</div>
    							<?php } //End upsell items
    						endforeach; ?>
    						<div class="clear"></div>
    						</div><!-- .restaurantmenu -->
    		<?php	endif; //end if RestaruantOrderType has a menu
					endforeach;//RestaurantOrderType				
				 ?>
			
		</div> <!-- #restaurantmenuinfo -->
		<div id="orderinformation">
			<!-- href="../order/<?php //echo $orderid ?>" -->
			<?php if(isset($hasUpSell)) { ?>
					<a href="#upsellmenu" class="red_button" data-toggle="modal">Proceed to Checkout</a>
			<?php } 
			else if(!$logged_in) { ?>
					<a href="#login_screen" class="red_button" data-toggle="modal">Proceed to Checkout</a>
			<?php }
			else { ?>
					<a  href="../order/<?php echo $orderid ?>" class="red_button">Proceed to Checkout</a>
			<?php } ?>	
			<br/>
			<h2 class="blue_font">Order Information</h2><br/>
			<div class="address">
				Address
				<br/>
				<div class="addressinfo"><?php echo $_SESSION['address'] ?></div>
				<a href="#" onclick="editAddress()">Edit</a>
			</div><!-- .address -->
			<div class="editorderinfo editaddress" style="display:none;">
				<input type="text" id="search_address" value="<?php echo $_SESSION['address'];?>" placeholder="Street Address, City, and State"/>
				<a href="#" onclick="checkRestaurantAddress()">Submit</a>
				<a href="#" onclick="cancelOrderInfoChange('address')">Cancel</a>
			</div>	<!-- .editaddress -->		
			<br/>
			<br/>
			<div class="time">
				Time
				<br/>
				<b>
					<span class="ordertype_for_text">
						<?php 
							$dw = date( "D", time());
							echo strtoupper($_SESSION['ordertypefor']);
							/*
							if(strrpos(strtolower($_SESSION['ordertypefor']), strtolower($dw)) >= 0)
								echo 'TODAY';
							else
								echo 'TOMORROW';
							*/
						?>
					<input type="hidden" value="<?php echo strtoupper($_SESSION['ordertypefor']);?>" id="ordertype_for">
					-
						<?php echo DATE("g:i a", STRTOTIME($_SESSION['ordertypeat'].':00'));?>
						<input type="hidden" value="<?php echo strtoupper($_SESSION['ordertypeat']);?>" id="ordertype_at"/>
					</span>
				</b>
				<br/>
				<a href="#" onclick="editTime()">Edit</a>				
			</div><!-- .time -->
			<div class="editorderinfo edittime" style="display:none;">
			<?php 
				/*<select id="editordertype_for">
					<option value="today">TODAY</option>
					<option value="tomorrow">TOMORROW</option>
				</select>*/
				
					echo $this->Form->input('time',array('type'=>'select','options'=>array(
						'today'=>'TODAY',
						'tomorrow'=>'TOMORROW'
					),'id'=>'editordertype_for','label'=>'','default'=>strtoupper($_SESSION['ordertypefor']))); 
				
				
					//echo $this->Form->input('time',array('type'=>'select','options'=>$gettodaytime,'empty'=>'Select Time','id'=>'editordertype_at','label'=>'','default'=>strtoupper($_SESSION['ordertypeat'])));
					
					echo $this->Form->input('time',array('type'=>'select','options'=>$gettodaytime,'empty'=>'ASAP','id'=>'editordertype_at','label'=>'','default'=> $_SESSION['ordertypeat'],'class'=>'today_select','div'=>'input select today_select'));
					
					echo $this->Form->input('time',array('type'=>'select','options'=>$gettomorrowtime,'id'=>'editordertype_at_tomorrow','label'=>'','default'=> $_SESSION['ordertypeat'],'div'=>'input select tomorrow_select'));  	
				?>
				<br/>
				<a href="#" onclick="checkRestaurantOpen()">Submit</a>
				<a href="#" onclick="cancelOrderInfoChange('time')">Cancel</a>
			</div><!-- .edittime -->
			<br/><br/>
			<div class="ordertype">
				Order Type
				<br/>
				<b><span class="ordertype_val"><?php echo strtoupper($_SESSION['ordertype']);?></span></b>
				<input type="hidden" value="<?php echo strtoupper($_SESSION['ordertype']);?>" id="ordertype">
				<br/>
				<a href="#" onclick="editOrderType()" class="ordertype_link">Change to 
					<?php if(strtoupper($_SESSION['ordertype']) == 'DELIVERY') { echo 'PICKUP'; } else { echo 'DELIVERY'; } ;?> 
				</a>	
				<input type="hidden" value="<?php if(strtoupper($_SESSION['ordertype']) == 'DELIVERY') { echo 'PICKUP'; } else { echo 'DELIVERY'; } ;?> " id="ordertype_change">							
			</div>
			<br/><br/>
		<span id="orderinfo">
		
			<?php if($total != '$0.00') { ?>
				<div class="ordertotaldetails">
					<table>
						<tr>
							<td>Food/Beverage Total</td>
							<td>
								<input type="hidden" id="subtotalamount" value="<?php echo $subtotal; ?>"/>
								<span class="total">$ <?php echo $subtotal; ?></span>
							</td>
						</tr>										
						<tr>
							<td>Sales Tax</td>
							<td class="tax">
								<input type="hidden" id="tax" value="<?php echo $salestax; ?>"/>
								$ <?php echo $salestax; ?>
							</td>
						</tr>
						<?php if(!$logged_in && $_SESSION['deals']) { ?>
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
						<?php 
							if($_SESSION['deliverycharge'] != null) {
								if(strtoupper($_SESSION['ordertype']) == 'PICKUP')
									echo '<style>#deliverychargerow {display: none; }</style>'
						?>
						<tr id="deliverychargerow">
							<td>Delivery Charge</td>
							<td>
							<input type="hidden" id="deliverycharge" value="<?php echo $_SESSION['deliverycharge']; ?>"/>
								<span class="deliverycharge">$ <?php echo $_SESSION['deliverycharge']; ?></span>
							</td>
						</tr>
						<?php 
							}
						?>							
						<tr>
							<td>Select Tip Amount</td>
							<td>
								<?php 											
									echo $this->Form->input('tip',array('type'=>'select','options'=>$tip,'empty'=>'Select Tip','id'=>'tipamount','label'=>'','default'=>$orderdetails[0]['TempOrder']['tip'])); 
								?>
							</td>
						</tr>
					</table>
				</div>
				<div class="ordertotal">
					<table class="red_font">
						<tr>
							<td>Discounted Total</td>
							<td class="ordertotal">$ 
							<span id="totalamount_text">
								<?php 
									echo $total; 
								?>	
							</span>
							<input type="hidden" id="totalamount" value="<?php echo $total; ?>"/>							
							</td>
						</tr>
					</table>
				</div>
				<div id="order_details">
					<h2 class="blue_font">Order Details</h2><br/>
					<div id="order_details_allitems">
					
					<?php 
					if(isset($orderdetails)) {
					foreach($orderdetails[0]['TempItem'] as $orderitem):
					//if ((isset($upsellitems) && !in_array($orderitem['Item']['id'], $upsellitems)) || !isset($upsellitems)) {
					echo '<div class="order_details_itemslist">';
						echo '<span class="order_details_price">$ '.$orderitem['Item']['price'].'</span>';
						
						if ((isset($upsellitems) && !in_array($orderitem['Item']['id'], $upsellitems)) || !isset($upsellitems)) {
							echo '<span class="order_details_edit"><a href="#" class="order_details_item_name blue_font">Edit/Delete</a></span>';
						}
						else {
							echo '<span class="order_details_edit">
									<a id="'.$orderitem['id'].'" class="blue_font upsellitem">Delete</a>
								</span>';
						}
						
						//Popup
							echo '<div id="edititem'.$orderitem['id'].'" class="item_variation modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Item Options" aria-hidden="true">';
							
							//Form				
							echo $this->Form->create('TempOrder',array('controller'=>'TempOrders','action'=>'updateitem'));
								echo $this->Form->hidden('TempOrder.id',array('value'=>$orderdetails[0]['TempOrder']['id'], 'class'=>'itemid'));
								echo $this->Form->hidden('TempOrder.tip',array('value'=>$orderdetails[0]['TempOrder']['tip'], 'class'=>'tip'));
								echo $this->Form->hidden('TempItem.0.temp_order_id',array('value'=>$orderdetails[0]['TempOrder']['id'], 'class'=>'itemid'));
								
								echo $this->Form->hidden('TempItem.0.id',array('value'=>$orderitem['id'], 'class'=>'itemid'));
								
								echo $this->Form->hidden('TempItem.0.item_id',array('value'=>$orderitem['Item']['id'], 'class'=>'itemid'));
								echo $this->Form->hidden('TempOrder.ItemPrice',array('value'=>$orderitem['Item']['price'], 'class'=>'itemprice'));
								
											echo '<div class="item_variation_header">';
												echo $this->Form->input('TempItem.0.quantity', array('value'=>'1','class'=>'quantity', 
												'label'=>'QTY','div' => false, 'value'=>$orderitem['quantity']));
												echo '<span class="item_name_variation red_font">'.
												
												$orderitem['Item']['name'].'</span><span class="item_name_price red_font">'.$orderitem['Item']['price'].
												'</span>';
											echo '</div>';
											
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
											
													$variationlist[$variation['id']] = $variation['name'].'&nbsp;($'.$variation['amount'].')';
												
													//Checkboxes
													if($variationgroup['num_choices'] != '1') {
														if($variation['id'] == $variationval) {
															echo $this->Form->input('TempItem.0.TempVariationCheckbox.'.$vcount.'.Checkbox.'.$g.'.ischecked', array('label'=>$variation['name'].'&nbsp;($'.$variation['amount'].')','type'=>'checkbox','class'=>'variation','checked'=>true));
														}
														else {
															echo $this->Form->input('TempItem.0.TempVariationCheckbox.'.$vcount.'.Checkbox.'.$g.'.ischecked', array('label'=>$variation['name'].'&nbsp;($'.$variation['amount'].')','type'=>'checkbox','class'=>'variation','checked'=>false));														
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
								
									//echo $this->Form->button("Add", array('class' => 'btn btn-success','escape' => false )); 
									echo $this->Js->submit(__('Delete Item'), array('update'=>'#orderinfo', 'url'=>array('controller'=>'TempOrders','action'=>'deleteitem'), 'class'=>'red_button deleteitem','evalScripts'=>true));
									
									echo $this->Js->submit(__('Update Order'), array('update'=>'#orderinfo', 'url'=>array('controller'=>'TempOrders','action'=>'updateitem'), 'class'=>'red_button updateitem','evalScripts'=>true));
									
									echo $this->Form->end();
									
																	
																	//echo '<input type="button" class="red_button additem" value="Add to Order" />';
																	echo '</div><!-- .item_variation -->';
									
												
												//End Popup
												echo '<span class="order_details_item">'.$orderitem['quantity'].' '.$orderitem['Item']['name'].'</span>';
												
												foreach($orderitem['TempVariation'] as $orderitemvariation):
													echo '<span class="order_details_item_variation">+'.$orderitemvariation['Variation']['name'].' '.$orderitemvariation['Variation']['amount'].'</span>';
												endforeach;
											echo '</div>';
										//}//End if upwell items in array
										//else {
										?>
											<script>
												debugger;
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
			<?php } ?>
			</span><!-- #orderinfo -->
		</div><!-- #orderinformation -->
	</div><!-- .wrapper -->
</div><!-- restaurantmenu -->
<!-- Modal -->
<!-- Enter New Address -->
<div id="newAddress" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Please enter a address below.</h3>
  </div>
  <div class="modal-body">
    <p>
    	<input type="text" id="search_new_address" placeholder="Street Address, City, and State"/>
    </p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" onclick="searchRestaurants_MenuPage()">Find My Food!</button>
  </div>
</div>
<!-- End Enter New Address -->
<div id="login_screen" class="modal hide fade">
	<div id="existing_user">
		<h3 class="red_font">Existing User Login</h3>
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
			<div>
				<button type="submit" class="btn btn-large btn-primary">
					<?php echo __('Sign in'); ?>
				</button>
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
		<h3 class="red_font">Don't Have an Account Yet?</h3>
		<a href="../order/<?php echo $orderid ?>/new" class="lightblue_button">New User Click Here</a>
	</div>
</div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<?php echo $this->Html->script('map.js'); ?>

<script>

  //Skip To Menu OnClick Function. Scrolls to Menu Category that is clicked
  jQuery(function(){
  	jQuery('.go_to_cat li a').click(function(e){
  		e.preventDefault();
  		jQuery('html,body').animate({scrollTop: jQuery(jQuery(this).attr('href')).offset().top -5}, 700, "swing");
  	});
  	    
    //Set hover for all item names
  	jQuery('.item_name').hover(function() {
  		jQuery(this).parent().children('.item_hover').toggle();
  	});
    
  });
	
	jQuery('#finish_upsell').click(function() {
		jQuery('#upsellmenu').modal('hide');
	});
	
	//Show and hide Menu Category (+) and (-)
	jQuery('a.category_showhide').click(function(e) {
		e.preventDefault();
		var category = jQuery(this);
		category.parent().parent().find('.item').slideToggle();
		if(category.html() == '+')
				category.html('-')
			else
				category.html('+');
	});
	
	
	jQuery('.item_name').click(function(e) {
	    e.preventDefault();
			jQuery(this).parent().find('.item_variation').modal('show');
	});
	
	function editAddress() {
		jQuery('.address').fadeOut(function() {
			jQuery('.editaddress').fadeIn();		
		});	
	}
	
	function editTime() {
		jQuery('.time').fadeOut(function() {
			jQuery('.edittime').fadeIn();		
		});	
	}


	/***** functions to search if restaurant exists in new address *******/
	var addressInfo = new Array();
	function checkRestaurantAddress() {
		$("#validation").empty();
		var address = jQuery('#search_address').val();
		var ordertype = jQuery('#ordertype').val().toLowerCase();
				
		codeAddress(address,ordertype, false);
	}

	function editOrderType() {
		var ordertype = jQuery('#ordertype_change').val();
		var city = '<?php echo $_SESSION['cityname'] ?>';
		var address = jQuery('#search_address').val();
		//checkRestaurantAddress();
		
		debugger;
		//$('#newAddress').modal('show');
		//$('#ordertype_to option:first-child').attr("selected", "selected");

		checkRestaurantDoesDeliveryPickup(ordertype, city,address);
		changeTotalsForDeliveryCharge();
	}
	
	function checkRestaurant() {
		//Search if restaurants exists for all new information
		if($("#validation").empty()) {
			checkRestaurantAddressInDatabase(addressInfo['lat'], addressInfo['lng'], addressInfo['city']);
			
			var streetnum = '';
			var street = '';
			var city = ''; 
			var state = '';
			
			if(addressInfo['streetnum'])
				streetnum = addressInfo['streetnum'];
				
			if(addressInfo['street'])
				street = addressInfo['street'] + ", ";
				
			$(".address").html("Address<br/>" + streetnum + " " + street + addressInfo['city'] +
			" " + addressInfo['state'] + "<br/>" + "<a href='#' onclick='editAddress()'>Edit</a>");
			
			
		} else {
			alert('Invalid Address');
		}
	}
	
	
	/***** function to search based on today/tomorrow, new time, pickup/delivery ******/
	function checkRestaurantOpen() {
		var ordertypefor = jQuery('#editordertype_for').val();
		var ordertypeat = jQuery('#editordertype_at').val();
		var ordertypeat_text = jQuery('#editordertype_at option:selected').text();
				
		var city = '<?php echo $_SESSION['cityname'] ?>';
		
		checkRestaurantIsOpen(ordertypefor, ordertypeat, ordertypeat_text, city);
	}
	
	
	function cancelOrderInfoChange(edit) {
		jQuery('.edit'+edit).fadeOut(function() {
			jQuery('.'+edit).fadeIn();		
		});	
	}
	
	//Set popup for item names	
	jQuery('.order_details_item_name').click(function() {
			jQuery(this).parent().parent().find('.item_variation').modal('show');
	});
	
	//On load if edit item then show edit item modal
	var edititem = getQueryString('edititem');
	
	if(edititem) {
		jQuery('#edititem'+edititem).modal('show');
	}
	
	jQuery('#tipamount').change(function() {
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
		debugger;
		jQuery('#totalamount').val(total);
		jQuery('#totalamount_text').html(total);
		
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
	
	function changeTotalsForDeliveryCharge() {
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
		debugger;
		total = (parseFloat(subtotal) + parseFloat(tip) + parseFloat(tax)) - parseFloat(discount) + deliverycharge;
		total = parseFloat(total, 10).toFixed(2);
		
		debugger;
		jQuery('#totalamount').val(total);
		jQuery('#totalamount_text').html(total);
		
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
	}
	
	/* Search Restaurants based on address or zip entered */
	var changeordertype = '';
	function searchRestaurants_MenuPage() {
		var address = jQuery('#search_new_address').val();
		var zip = jQuery('#search_zipcode').val();
		var type = jQuery('#ordertype option:selected').val();
		//var type = jQuery('.btn-group').find('.active').val();
		
		//if(zip != '')
			//address = zip;
		
		
		searchRestaurants(address, changeordertype, false);
	}
	
	function addupsellitem(id) {
		var upsellitem = '.' + id + 'upsell';
		var temporderid_val = <?php echo $orderid; ?>;
		var itemid_val = id;
		
		if(jQuery(upsellitem).is(':checked')) {
			//Add item
			var upsell_tempitemid = "#upsell_tempitemid_" + id;
			var tempitemid_val = jQuery(upsell_tempitemid).val();
			if(tempitemid_val == '') {
				$.ajax({
			        type: 'POST',
			        url: '/imeals/TempOrders/addupsellitem/',
			        data: {temporderid: temporderid_val, itemid: itemid_val},
			        success:function(data){
			            results = data;
			            var upsell_tempitemid = "#upsell_tempitemid_" + id;
			            jQuery(upsell_tempitemid).val(data);
						/*jQuery("#orderinfo").empty();
						jQuery("#orderinfo").html(data);*/
			        },
			        error:function(data){
				        results = data;
			        },
			        timeout: 5000
				}).done(function(){
					
				});
			}

		} else {
			//Delete item
			var upsell_tempitemid = "#upsell_tempitemid_" + id;
			var tempitemid_val = jQuery(upsell_tempitemid).val();
			if(tempitemid_val != "") {
				$.ajax({
			        type: 'POST',
			        url: '/imeals/TempOrders/deleteupsellitem/',
			        data: {tempitemid: tempitemid_val, temporderid: temporderid_val},
			        success:function(data){
			            results = data;
						jQuery(upsell_tempitemid).val('');
						/*jQuery("#orderinfo").empty();
						jQuery("#orderinfo").html(data);	*/					
			        },
			        error:function(data){
				        results = data;
			        },
			        timeout: 5000
				}).done(function(){
					
				});
			}

		}
	}
	
	jQuery(".upsellitem").click(function() {
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
	});
	
</script>