<script>
	//Reset all checkboxes and radio buttons
	jQuery('input[type=checkbox].menu_variation ').each(function(){
		jQuery(this).attr('checked', false);
	});
	
</script>
<?php 
	//echo '<pre>'; echo var_dump($orderdetails[0]['TempOrder']); echo '</pre>';
if($orderdetails[0]['TempOrder']['total'] != '0.00') { ?>
<div class="ordertotaldetails">
					<table>
						<tr>
							<td>Food/Beverage Total</td>
							<td>
							<input type="hidden" id="subtotalamount" value="<?php echo $orderdetails[0]['TempOrder']['sub_total']; ?>"/>
								<span class="total">$ <?php echo $orderdetails[0]['TempOrder']['sub_total']; ?></span>
							</td>
						</tr>	
						<?php if(!$logged_in && $_SESSION['deals']) {?>
						<tr class="red_font">
							<td>First Time Discount</td>
							<td id="discount">
								<?php 
											
									if(isset($_SESSION['deals'])) {
										$discount = $orderdetails[0]['TempOrder']['first_time_discount'];
										//$discount = .2 * $orderdetails[0]['TempOrder']['sub_total'];
										//$total = $orderdetails[0]['TempOrder']['total'] - $discount;
									} else {
										$discount = 0;
									}
									if(isset($discount) && $discount != '0') {
										echo '($ '. money_format('%i', $discount).')';
										echo '<input type="hidden" id="discountval" value="'.money_format('%i', $discount).'"/>';	
									}
								?>
							</td>
						</tr>
						<?php } ?>															
						<tr>
							<td>Sales Tax</td>
							<td class="tax">$ 
								<input type="hidden" id="tax" value="<?php echo $orderdetails[0]['TempOrder']['tax_total']; ?>"/>
									<?php //echo number_format($orderdetails[0]['TempOrder']['sub_total']*($orderdetails[0]['TempOrder']['tax']/100),2);  ?>
								<?php 
									//echo number_format($orderdetails[0]['TempOrder']['sub_total']*($orderdetails[0]['TempOrder']['tax']/100),2); 
									
									echo number_format($orderdetails[0]['TempOrder']['tax_total'],2);
								?>
							</td>
						</tr>							
						<?php 
							if(isset($_SESSION['deliverycharge']) && $_SESSION['deliverycharge'] != null && strtoupper(trim($_SESSION['ordertype'])) != 'PICKUP') {
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
								<?php 
									//if(!isset($total))
									$total = $orderdetails[0]['TempOrder']['total'];
									$total =  money_format('%i', $total);
								?>
								<span id="totalamount_text">$<?php echo $total; ?></span>
								<input type="hidden" id="totalamount" value="<?php echo $total; ?>"/>
								<input type="hidden" id="mem_totalamount" value="<?php echo $total; ?>"/>								
							</td>
						</tr>
					</table>
				</div>
				<div id="order_details">
				<br><br>
					<?php
						echo 'hasupsell='.$hasUpSell.'</br>';
						//echo 'minimum'.$deliveryminimum.'</br></br></br>';
						
					if(isset($hasUpSell) && $hasUpSell != '') { ?>
							<a href="#upsellmenu" class="red_button" onclick="return validateOrderItems('<?php echo $deliveryminimum; ?>',true, false);">Proceed to Checkout</a>
					<?php } 
					else if(!$logged_in) { ?>
							<a href="#login_screen" class="red_button" data-toggle="modal">Proceed to Checkout</a>
					<?php }
					else if (count($orderdetails[0]['TempItem']) > 0){ ?>
							<a  href="../../order/<?php echo $orderdetails[0]['TempOrder']['id'] ?>" class="red_button">Proceed to Checkout</a>
					<?php } 
					else { ?>
							<a class="red_button needtoadditems">Proceed to Checkout</a>
					<?php } ?>	
				<br/>
				<br>				
					<h2 class="blue_font">Order Details</h2><br/>
					<div id="order_details_allitems">

<?php 
	foreach($orderdetails[0]['TempItem'] as $orderitem):
	if ($orderitem['special_instructions'] != "upsell") {
		echo '<div class="order_details_itemslist">';
			echo '<button type="button" class="close" id="'.$orderitem['Item']['id'].'">×</button>';
			echo '<span class="order_details_price">'.$orderitem['quantity'].' '.$orderitem['Item']['name'].' - $'.$orderitem['Item']['price'].'</span>';
			//echo '<span class="order_details_edit"><a href="#" class="order_details_item_name blue_font">Edit/Delete</a></span>';
			if(!isset($IsOrderPage))
			echo '<span class="order_details_edit"><a href="#" class="order_details_item_name blue_font">Edit&raquo;</a></span>&nbsp;&nbsp;';	
			
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
			
			
			//Popup
				echo '<div class="item_variation modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Item Options" aria-hidden="true">';
				
				//Form				
				echo $this->Form->create('TempOrder',array('controller'=>'TempOrders','action'=>'updateitem'));
					echo $this->Form->hidden('TempOrder.id',array('value'=>$orderdetails[0]['TempOrder']['id'], 'class'=>'itemid'));
					echo $this->Form->hidden('TempOrder.tip',array('value'=>$orderdetails[0]['TempOrder']['tip'], 'class'=>'tip'));
					echo $this->Form->hidden('TempItem.0.temp_order_id',array('value'=>$orderdetails[0]['TempOrder']['id'], 'class'=>'itemid'));
					
					echo $this->Form->hidden('TempItem.0.id',array('value'=>$orderitem['id'], 'class'=>'itemid'));
					
					echo $this->Form->hidden('TempItem.0.item_id',array('value'=>$orderitem['Item']['id'], 'class'=>'itemid'));
					echo $this->Form->hidden('TempOrder.ItemPrice',array('value'=>$orderitem['Item']['price'], 'class'=>'itemprice'));
					
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
									echo '</div>';
								
				//echo $this->Form->button("Add", array('class' => 'btn btn-success','escape' => false )); 
//echo $this->Js->submit(__('Delete Item'), array('update'=>'#orderinfo', 'url'=>array('controller'=>'TempOrders','action'=>'deleteitem'), 'class'=>'red_button deleteitem','evalScripts'=>true));
									echo '<div class="modal-footer">';
										echo $this->Js->submit(__('Update Order'), array('update'=>'#orderinfo', 'url'=>array('controller'=>'TempOrders','action'=>'updateitem'), 'class'=>'btn btn-primary updateitem','evalScripts'=>true));
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
			echo '<span class="order_details_instructions">'.$orderitem['special_instructions'].'</span>';
		echo '</div>';
		}//End if upwell items in array
		else {
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
		}
	endforeach;



?>

	</div><!-- #order_details -->
</div><!-- .order_details -->

<?php 
	echo $this->Html->script('menu.js'); 
	echo $this->Js->writeBuffer();
?>
<?php if (isset($orderdetails) && $orderdetails[0]['TempOrder']['promo_discount'] == 0.00) { ?> 
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


<script>
	
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
	
		changeAddress(address_val, btnid, ordertype_val, restaurantid, 'modal');
		
	});
	
	//Change Address from typing in a new address in the box
	jQuery('#changeaddress').click(function() {
		var address_val = jQuery('#search_address').val();
		var btnid = $(this).attr('id');
		var ordertype_val = jQuery('#ordertype').val();
		var restaurantid = <?php echo $_SESSION['restaurant_id'];?>;
		ordertype_val.replace(/^\s+|\s+$/g,'');
		
		changeAddress(address_val, btnid, ordertype_val, restaurantid, 'textbox');
		
	});
	
	
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
		var temporderid_val = <?php echo $orderdetails[0]['TempOrder']['id']; ?>;
		var itemid_val = id;
		addUpsell(upsellitem, temporderid_val, itemid_val);
	}
	
	//Change Order type for today or tomorrow
	jQuery('#editordertype_for').change(function() {
		var ordertypefor = jQuery('#editordertype_for').val();
		changeOrderTypeFor(ordertypefor);

	});
	
	//Hides the validation message box
	jQuery('#promotioncode_valid').hide();
	
	//Validate Promotion Code*/
	jQuery('#validatepromo').click(function() {
		var ordertype_val = '<?php echo $orderdetails[0]['TempOrder']['order_type_id']; ?>';
		var promocode = jQuery('#promotioncode').val();
		var orderid_val = '<?php echo $orderdetails[0]['TempOrder']['id']; ?>';
		
		validatePromotionCode(ordertype_val, promocode, orderid_val);

	});
	
	//Removes Promotion Code
	jQuery('#removepromo').click(function() {
		var orderid_val = '<?php echo $orderdetails[0]['TempOrder']['id']; ?>';
		removePromotionCode(orderid_val);
	});
	
	jQuery('.restaurantmenu input').each(function() {
		jQuery(this).prop('checked', false);
		
	});
</script>


<?php }

