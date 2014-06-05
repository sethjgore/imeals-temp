<link href="<?php echo $this->request->webroot; ?>css/validationEngine.jquery.css" rel="stylesheet">	

<?php 
	//echo '<pre>';echo var_dump($user); echo '</pre>';
	//Add jQuery Validation engine localization file
	echo $this->Html->script('jquery.validationEngine-en.js');
	//Add jQuery validation engine
	echo $this->Html->script('jquery.validationEngine.js');
?>
<div id="orderingsteps">
	<div class="wrapper">
		<ul>
			<li><a href="#">1. Enter Your Info</a></li>
			<li><a href="#">2. Select a Restaurant</a></li>
			<li><a href="#" class="active">3. Order from the Menu</a></li>
			<li><a href="#">4. Checkout</a></li>						
		</ul>
	</div><!-- .wrapper -->
</div><!-- #orderingsteps -->
<div id="order">
	<h2 class="blue_font">Delivery Information</h2>
	<?php echo $this->Form->create('Restaurant',array('controller'=>'Restaurant','action'=>'submitpayment')); ?>
	<?php 
		//echo $this->Form->create('Restaurant'); 
		echo $this->Form->hidden('TempOrder.0.id',array('value'=>$orderid, 'class'=>'itemid'));
		//echo $this->Form->hidden('TempOrder.0.total',array('class'=>'ordertotal'));
	?>
	<table id="delivery_order">
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
		</tr>
		<tr>
			<td>
				<?php 
				if(isset($user)) {
					$userfname = $user['first_name'];
					$userlname = $user['last_name'];
					$useremail = $user['user_email'];
				}
				else {
					$userfname = '';
					$userlname = '';
					$useremail = '';
				}
				
				if (!isset($isvalid)) {	
					echo $this->Form->input('User.first_name', array('value'=>$userfname, 'label'=>'','div' => false, 'class'=>'validate[required] text-input'));
				}
				else {
					echo $this->Form->input('User.first_name', array('label'=>'','div' => false, 'class'=>'validate[required] text-input'));
				}
				
				?>
				
			</td>
			<td>
				<?php 
				if (!isset($isvalid)) {	
					echo $this->Form->input('User.last_name', array('value'=>$userlname, 'label'=>'','div' => false, 'class'=>'validate[required] text-input'));
				} else {
					echo $this->Form->input('User.last_name', array('label'=>'','div' => false, 'class'=>'validate[required] text-input'));				
				}
				?>
			</td>
		</tr>
		<tr>
			<th colspan="2">Phone</th>
		</tr>
		<tr>
			<td colspan="2">
				<?php 
				if (!isset($isvalid)) {						
					echo $this->Form->input('User.phone', array('value'=>'', 'label'=>false,'div' => false, 'class'=>'validate[required] text-input'));
				} else {
					echo $this->Form->input('User.phone', array('label'=>false,'div' => false, 'class'=>'validate[required] text-input'));				
				}
				?>			
			</td>
		</tr>		
		<tr>
			<th colspan="2">Email/User Name</th>
		</tr>
		<tr>
			<td colspan="2">
				<?php 
					if(!isset($user)) {
						if (!isset($isvalid)) {	
							echo $this->Form->input('User.user_email', array('value'=>'', 'label'=>false,'div' => false, 'id'=>'email', 'class'=>'validate[required,custom[email]] text-input'));
						} else {
							echo $this->Form->input('User.user_email', array('label'=>false,'div' => false, 'id'=>'email', 'class'=>'validate[required,custom[email]] text-input'));						
						}
					
					}
					else
						echo $useremail;
				?>
			</td>
		</tr>	
		<?php if(empty($user)) { ?>
		<tr>
			<th>Password</th>
			<th>Confirm Password</th>
		</tr>
		<tr>
			<td>
				<?php 
					echo $this->Form->password('User.user_password',array('div' => false,'label'=>false,'placeholder'=>__('Password'),'error'=>false, 'id'=>'password', 'class'=>'validate[required],minSize[7]] text-input'));
				?>	
			</td>
			<td>
				<?php 
					echo $this->Form->password('User.user_confirm_password',array('div' => false,'label'=>false,'placeholder'=>__('Confirm Password'),'error'=>false, 'class'=>'validate[required],equals[password],minSize[7]] text-input'));
				?>	
			</td>
		</tr>	
		<?php } 
		//Hide or show address if delivery or pickup
		if(strtolower($_SESSION['ordertype']) == 'none') {
		?>
		<tr>
			<th>Street Address</th>
			<th>Apartment or Suite No.</th>
		</tr>
		<tr>
			<td>
				<?php 
					echo $this->Form->input('TempOrder.0.address', array('value'=>$_SESSION['streetnum'].' '.$_SESSION['street'], 'label'=>'','div' => false)) 
				?>	
			</td>
			<td>
				<?php 
					if (!isset($isvalid)) {						
						echo $this->Form->input('TempOrder.0.address', array('label'=>false,'div' => false));
					} else {
						echo $this->Form->input('TempOrder.0.address', array('value'=>'', 'label'=>'','div' => false));
					}
				?>	
			</td>			
		</tr>			
		<tr>
			<th>City</th>
			<th>State</th>			
		</tr>
		<tr>
			<td>
				<?php 
					if (!isset($isvalid)) {										
						echo $this->Form->input('TempOrder.0.city', array('value'=>$_SESSION['city'], 'label'=>'','div' => false));
					}
					else {
						echo $this->Form->input('TempOrder.0.city', array('label'=>'','div' => false));			
					}
				?>	
			</td>
			<td><select></select>
			</td>
		</tr>
		<tr>
			<th colspan="2">Zip</th>
		</tr>	
		<tr>
			<td colspan="2">
				<?php 
					if (!isset($isvalid)) {	
						echo $this->Form->input('TempOrder.0.zip', array('label'=>false,'div' => false));
					} else {
						echo $this->Form->input('TempOrder.0.zip', array('value'=>$_SESSION['zip'], 'label'=>false,'div' => false));	
					}
				?>				
			</td>
		</tr>
		<?php  
			} //End hide/show if delivery or pickup
		?>
		<tr>
			<th colspan="2">Special Instructions</th>
		</tr>	
		<tr>
			<th colspan="2">
				<?php 
					echo $this->Form->input('TempOrder.0.special_instructions', array('type'=>'textarea', 'label'=>false,'div' => false)) 
				?>
			</th>
		</tr>
	</table>
	
	<br/>
	<h2>Billing Information</h2>
	<table id="cc_info">
		<tr>
			<th>Credit Card</th>
			<th>Card Number</th>
		</tr>
		<tr>
			<td>
				<?php 
					echo $this->Form->input('PaymentInfo.0.payment_type',array('type'=>'select','label'=>false, 'options'=>array('Visa','Mastercard','Discover'),'empty'=>'Credit Card Type','class'=>'validate[required]')); 
				?>
			</td>
			<td>
				<?php 
					echo $this->Form->input('PaymentInfo.0.cc_number', array('value'=>'', 'label'=>false,'div' => false,'class'=>'validate[required]'));
				?>				
			</td>
		</tr>
		<tr>
			<th>Expiration Date</th>
			<th>Billing Zip Code</th>
		</tr>
		<tr>
			<td>
				<?php 
					echo $this->Form->input('PaymentInfo.0.cc_expiration_month',array('type'=>'select','label'=>false,'id'=>'cc_month',
					'div' => false,'class'=>'validate[required]'));
					echo $this->Form->input('PaymentInfo.0.cc_expiration_year',array('type'=>'select','label'=>false,'id'=>'cc_year',
					'div' => false,'class'=>'validate[required]')); 
                ?>
                <script>
	                var date = new Date().getFullYear();
					var length = date + 16;
					
					for(var i = date; i < length; i++){
					  //jQuery
					  $("#cc_year").append('<option value="' + i + '">' + i + '</option>');
					}
					length = 13;
					for(var i = 1; i < length; i++){
					  //jQuery
					  $("#cc_month").append('<option value="' + i + '">' + i + '</option>');
					}
                </script>
			</td>
			<td>
				<?php 
					echo $this->Form->input('PaymentInfo.0.billing_zip', array('value'=>'', 'label'=>false,'div' => false,'class'=>'validate[required]'));
				?>							
			</td>
		</tr>	
		<tr>
			<th colspan="2">Security Code</th>
		</tr>	
		<tr>
			<td colspan="2">
				<?php 
					echo $this->Form->input('PaymentInfo.0.cc_security_code', array('value'=>'', 'label'=>false,'div' => false,'class'=>'validate[required]','id'=>'cc_code'));
				?>							
			</td>
		</tr>
		<tr>
			<td colspan="2"><input type="checkbox" id="savecc">&nbsp;Save Billing Information</td>
		</tr>
	</table>
<?php 
	//echo $this->Form->button("Submit Order", array('class' => 'submit_order red_button btn','escape' => false )); 
	//echo $this->Form->end(); 
?>

      
      
  <?php echo $this->Form->submit(__('Send')); ?>
 
</div>
<div id="orderinformation">
			<!--<a href="../order" class="red_button">Proceed to Checkout</a><br/>-->
			<h2 class="blue_font">Order Information</h2><br/>
			<div class="address">
				Address
				<br/>
				<?php echo $_SESSION['address'] ?>
				<br/>
				<a href="#" onclick="editAddress()">Edit</a>
			</div><!-- .address -->
			<div class="editorderinfo editaddress">
				<input type="text" id="search_address" value="<?php echo $_COOKIE['search'];?>" placeholder="Street Address, City, and State"/>
				<a href="#" id="changeaddress">Submit</a>
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
							
							if(strrpos(strtolower($_SESSION['ordertypefor']), strtolower($dw)) >= 0)
								echo 'Today';
							else
								echo 'Tomorrow';
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
			<div class="editorderinfo edittime">
				<select id="editordertype_for">
					<option value="today">Today</option>
					<option value="tomorrow">Tomorrow</option>
				</select>
				<!-- <select id="editordertype_at">-->
				<?php 
					echo $this->Form->input('time',array('type'=>'select','options'=>$gettodaytime,'empty'=>'ASAP','id'=>'editordertype_at','label'=>'','default'=> $_SESSION['ordertypeat'],'class'=>'today_select','div'=>'input select today_select'));
					
					echo $this->Form->input('time',array('type'=>'select','options'=>$gettomorrowtime,'id'=>'editordertype_at_tomorrow','label'=>'','default'=> $_SESSION['ordertypeat'],'div'=>'input select tomorrow_select'));  		
				?>
				<br/>
				<a href="#" id="changeordertime">Submit</a>
				<a href="#" onclick="cancelOrderInfoChange('time')">Cancel</a>
			</div><!-- .edittime -->
			<br/><br/>
			<div class="ordertype">
				Order Type
				<br/>
				<b><span class="ordertype_val"><?php echo strtoupper($_SESSION['ordertype']);?></span></b>
				<input type="hidden" value="<?php echo strtoupper($_SESSION['ordertype']);?>" id="ordertype">
				<br/>
				<a href="#" id="changeordertype" class="ordertype_link">Change to 
					<?php if(trim(strtoupper($_SESSION['ordertype'])) == 'DELIVERY') { echo 'PICKUP'; } else { echo 'DELIVERY'; } ;?> 
				</a>	
				<input type="hidden" value="<?php if(trim(strtoupper($_SESSION['ordertype'])) == 'DELIVERY') { echo 'PICKUP'; } else { echo 'DELIVERY'; } ;?> " id="ordertype_change">							
			</div>
			<br/><br/>
		<span id="orderinfo">
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
							if(isset($_SESSION['deliverycharge']) && $_SESSION['deliverycharge'] != null) {
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
								<span id="totalamount_text"><?php echo $orderdetails[0]['TempOrder']['total']; ?></span>
								<input type="hidden" id="totalamount" value="<?php echo $orderdetails[0]['TempOrder']['total']; ?>"/>
							</td>
						</tr>
					</table>
				</div>
				<div id="order_details">
					<h2 class="blue_font">Order Details</h2><br/>
					<div id="order_details_allitems">
	<?php 
	foreach($orderdetails[0]['TempItem'] as $orderitem):
		echo '<div class="order_details_itemslist">';
			echo '<span class="order_details_price">'.$orderitem['Item']['price'].'</span>';
			echo '<span class="order_details_edit"><a href="../../menu/'.$orderdetails[0]['TempOrder']['restaurant_id'].'?edititem='.$orderitem['id'].'" class="order_details_item_name blue_font">Edit/Delete</a></span>';
			//Popup
				echo '<div class="item_variation modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Item Options" aria-hidden="true">';
				
				//Form				
				echo $this->Form->create('TempOrder',array('controller'=>'TempOrders','action'=>'updateitem'));
					echo $this->Form->hidden('TempOrder.id',array('value'=>$orderdetails[0]['TempOrder']['id'], 'class'=>'itemid'));
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
										
									echo $this->Form->input('TempItem.0.special_instructions',array('type'=>'textarea','class'=>'specialinstructions'));
										
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
	endforeach;

echo $this->Js->writeBuffer();

?>
					</div><!-- #order_details -->
				</div><!-- .order_details -->
			</span><!-- #orderinfo -->
		</div><!-- #orderinformation -->
		
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<?php echo $this->Html->script('map.js'); ?>

<script>
	//Hides all edit order information 
	jQuery('.editorderinfo').each(function(){
		jQuery(this).hide();
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
	
	function editOrderType() {
		var ordertype = jQuery('#ordertype_change').val();
		var city = '<?php echo $_SESSION['cityname'] ?>';
		checkRestaurantDoesDeliveryPickup(ordertype, city);
	}	

	/***** functions to search if restaurant exists in new address *******/
	var addressInfo = new Array();
	function checkRestaurantAddress() {
		$("#validation").empty();
		var address = jQuery('#search_address').val();
		var ordertype = jQuery('#ordertype').val().toLowerCase();
				
		codeAddress(address,ordertype, false);
	}
	
	function checkRestaurant() {
		//Search if restaurants exists for all new information
		if($("#validation").empty()) {
			checkRestaurantAddressInDatabase(addressInfo['lat'], addressInfo['lng'], addressInfo['city']);
			
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
	
	jQuery('#tipamount').change(function() {
		var subtotal = jQuery('#subtotalamount').val();
		var tax = jQuery('#tax').val();	
		if(jQuery('#discountval').length)
			var discount = jQuery('#discountval').val();	
		else
			var discount = 0;
			
		var tip = jQuery(this).val();
		jQuery('.tip').val(tip);
		
		total = (parseFloat(subtotal) + parseFloat(tip) + parseFloat(tax)) - parseFloat(discount);
		total = parseFloat(total, 10).toFixed(2);
		debugger;
		jQuery('#totalamount').val(total);
		jQuery('#totalamount_text').html(total);
	});
	
</script>
<script>
            
        
	jQuery(document).ready(function(){
		jQuery("#RestaurantOrderForm").validationEngine({

		});
	});
	
	 jQuery('.submit_order').click(function(e) {
	    var isValid = true;
	   	//e.preventDefault();
	    
	    //If validation passes allow user to slide to next page
	    jQuery("#RestaurantOrderForm").find(':input').each(function (i, item) {
	      if (jQuery(item).validationEngine('validate')){
	        isValid = false;
	      }       
	    });
	    
	    if(jQuery('#email').length != 0){
	    var emailval = jQuery('#email').val();

	      jQuery('#email').after('<div class="UserEmailExistformError parentFormUserPropertymanagerForm formError email_exists" style="opacity: 0.87; position: absolute; left: 171px; margin-top: -50px;"><div class="formErrorContent">* Validating Email please wait ...<br></div><div class="formErrorArrow"><div class="line10"><!-- --></div><div class="line9"><!-- --></div><div class="line8"><!-- --></div><div class="line7"><!-- --></div><div class="line6"><!-- --></div><div class="line5"><!-- --></div><div class="line4"><!-- --></div><div class="line3"><!-- --></div><div class="line2"><!-- --></div><div class="line1"><!-- --></div></div></div>'); 
	      $.ajax({
	      	type: 'POST',
	        url:"/imeals/Restaurants/validateusername/",
	        data: {email: emailval},
	        success:function(result){
	          if(result == 'exists'){
	            isValid = false;
	            jQuery('.UserEmailExistformError .formErrorContent').html('* Email address already exists'); 
	          } else {
	            jQuery('.UserEmailExistformError').hide();
	          }
	          
	      },
	      error:function(result){
	      	//alert(result.statusText);
	      }}).done(function(){
	        if(isValid){
				alert('Is Valid');
	        } else {
	        	
	        }
	      });
	    }
	  });

</script>