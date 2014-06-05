<link href="<?php echo $this->request->webroot; ?>css/validationEngine.jquery.css" rel="stylesheet">	

<?php 
	/*echo 'ASAP-'.$_SESSION['ordertypeatasap'];
	echo '<br>Order at-'.$_SESSION['ordertypeat'];
	echo '<br>IS ASAP-'.$_SESSION['ordertypeatisasap'];
	echo '<br>Order For-'.$_SESSION['ordertypefor'];*/
	//Add jQuery Validation engine localization file
	echo $this->Html->script('jquery.validationEngine-en.js');
	//Add jQuery validation engine
	echo $this->Html->script('jquery.validationEngine.js');
	
?>
<div id="orderingsteps">
	<div class="wrapper">
		<ul>
			<?php if(isset($user)) { ?> 
				<li><a href="/">1. Enter Your Info</a></li>
				<li><a href="../search/<?php echo $_SESSION['city']; ?>">2. Select a Restaurant</a></li>
				<li class="orderfrommenu"><a href="../menu/<?php echo $_SESSION['restaurant_id']; ?>/<?php echo $_SESSION['ordertypeid']; ?>">3. Order from the Menu</a></li>
				<li class="active"><span class="active_num">4.</span> Checkout</li>		
			<?php } else { ?>				
				<li><a href="/">1. Enter Your Info</a></li>
				<li><a href="../../search/<?php echo $_SESSION['city']; ?>">2. Select a Restaurant</a></li>
				<li class="orderfrommenu"><a href="../../menu/<?php echo $_SESSION['restaurant_id']; ?>/<?php echo $_SESSION['ordertypeid']; ?>">3. Order from the Menu</a></li>
				<li class="active"><span class="active_num">4.</span> Checkout</li>				
			<?php } ?>
		</ul>
	</div><!-- .wrapper -->
</div><!-- #orderingsteps -->
<div class="wrapper">
<div id="order">
	<h2 class="blue_font"><?php echo 'Enter your '.$_SESSION['ordertype'].' information'; ?></h2>
	<?php echo $this->Form->create('Restaurant',array('controller'=>'Restaurant','action'=>'submitpayment','url' => array($orderid))); ?>
	<?php 
		//echo $this->Form->create('Restaurant'); 
		echo $this->Form->hidden('TempOrder.0.id',array('value'=>$orderid, 'class'=>'itemid'));
		//echo $this->Form->hidden('TempOrder.0.total',array('class'=>'ordertotal'));
	?>
	<div class="order_personal_information">
	<table id="delivery_order">
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
		</tr>
		<tr>
			<td>
				<?php 
				if(isset($user)) {
					$userfname = $user['User']['first_name'];
					$userlname = $user['User']['last_name'];
					$useremail = $user['User']['user_email'];
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
					echo $this->Form->input('User.phone', array('value'=>$user['User']['phone'], 'label'=>false,'div' => false, 'class'=>'validate[required] text-input'));
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
		<td></td>
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
	</div>
	<br/>
	<div class="order_billing_information">
		<?php 
				if(!$restaurantinfo['Restaurant']['cc_y_n']) {
					echo '<div class="order_billing_information_alert">';
						echo $this->Html->image('cash_bag.png', array('class' => 'cash_bag'));
					echo 'Reminder: This restaurant only accepts cash.</div><br><br>';
					echo $this->Form->button("Submit My Order!", array('class' => 'submit_order red_button btn','escape' => false, 'onClick' => 'return validateCashOrder();' )); 
					echo $this->Form->end();
				}	
				//else If Restaurant accepts Credict Card
				else if($restaurantinfo['Restaurant']['cc_y_n']) {
			?>
			
	<?php 
		if(isset($user) && isset($paymentinfo) && $paymentinfo['customer_pymnt_profile_id'] != '') {
	?>
		<div class="existing_info">
			<h3 class="blue_font">Select an existing payment method or enter a new one below.</h3>
			<div id="existingcc">
					<?php echo $this->Form->input('cc.existing', array('id'=>'existingcc','label'=>'','type'=>'checkbox','class'=>'')); ?>

					<b>Card Type:</b> <?php echo $user['PaymentInfo']['card_type']; ?>

					<b>Last 4 Digits:</b> <?php echo $user['PaymentInfo']['lastfour_digits']; ?>
			</div>
		</div>
	<?php
		} else {
	?>
		<h2>Billing Information</h2>
	<?php
		}
	?>
	<table id="cc_info">
		<tr>
			<th>Credit Card</th>
			<th>Card Number</th>
		</tr>
		<tr>
			<td>
				<?php
					$cctypes = array('VISA' => 'VISA', 'MASTERCARD' => 'MASTERCARD', 'DISCOVER' => 'DISCOVER', 'AMERICAN EXPRESS' => 'AMERICAN EXPRESS');
					echo $this->Form->input('PaymentInfo.card_type',array('type'=>'select','label'=>false, 'options'=>$cctypes,'empty'=>'Credit Card Type','class'=>'newcc')); 
				?>
			</td>
			<td>
				<?php 
					echo $this->Form->input('PaymentInfo.cc_number', array('value'=>'', 'label'=>false,'div' => false,'class'=>'newcc', 'id'=>'cc_num'));
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
					echo $this->Form->input('PaymentInfo.cc_expiration_month',array('type'=>'select','label'=>false,'id'=>'cc_month',
					'div' => false,'class'=>'newcc'));
					echo $this->Form->input('PaymentInfo.cc_expiration_year',array('type'=>'select','label'=>false,'id'=>'cc_year',
					'div' => false,'class'=>'newcc')); 
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
					  if(i<10)
					  	$("#cc_month").append('<option value="0' + i + '">' + i + '</option>');
					  else
					  	$("#cc_month").append('<option value="' + i + '">' + i + '</option>');
					}
                </script>
			</td>
			<td>
				<?php 
					echo $this->Form->input('PaymentInfo.billing_zip', array('value'=>'', 'label'=>false,'div' => false,'class'=>'newcc'));
				?>							
			</td>
		</tr>	
		<tr>
			<th colspan="2">Security Code</th>
		</tr>	
		<tr>
			<td colspan="2">
				<?php 
					echo $this->Form->input('PaymentInfo.cc_security_code', array('value'=>'', 'label'=>false,'div' => false,'class'=>'newcc','id'=>'cc_code'));
				?>							
			</td>
		</tr>
		<tr>
			<td colspan="2" class="savebillinginfo">
		<?php echo $this->Form->input('PaymentInfo.saveinfo', array('label'=>'Save Billing Information','type'=>'checkbox','class'=>'')); ?>
			</td>
		</tr>
	</table>
<?php 
	
	echo $this->Form->button("Submit My Order!", array('id' => 'submitorder', 'class' => 'red_button btn','escape' => false, 'onClick' => 'return validateOrder();' )); 
	echo $this->Form->end(); 
	}//End if accepts credit card
?>
	</div>
	<br><br>
     <div id="validation" class="alert alert-error"></div>  
      
  <?php //echo $this->Form->submit(__('Send')); ?>
 
</div><!-- #order -->
<div id="orderinformation" class="order">
			<!--<a href="../order" class="red_button">Proceed to Checkout</a><br/>-->
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
		
							if(date('m/d/Y', strtotime($_SESSION['ordertypefor'])) == date('m/d/Y', strtotime($today)))
								echo 'TODAY';
							else if(date('m/d/Y', strtotime($_SESSION['ordertypefor'])) == date('m/d/Y', strtotime($tomorrow)))
								echo 'TOMORROW';		
							else
								echo strtoupper(date('m/d/Y(D)', strtotime($_SESSION['ordertypefor'])));	
								


						?>						
						<?php 
							if($_SESSION['ordertypeat'] != 'ASAP')
								echo '('.DATE("g:ia", STRTOTIME($orderat)).')';
							else
								echo 'ASAP';
														
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
			<?php 
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
	    						
			?>
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
					
					echo $this->Form->input('time',array('type'=>'select','options'=>$gettodaytime,'id'=>'editordertype_at','label'=>'','default'=> $orderat,'empty'=>'ASAP','class'=>'','div'=>'input select today_select'));
					
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
				<div class="order_label">Order Type<a href="#" id="changeordertype" class="ordertype_link order_edit_link">Change to 
					<?php if(trim(strtoupper($_SESSION['ordertype'])) == 'DELIVERY') { echo 'PICKUP'; } else { echo 'DELIVERY'; } ;?> 
				&raquo;</a> </div>
				<b><span class="ordertype_val"><?php echo strtoupper($_SESSION['ordertype']);?></span></b>
				<input type="hidden" value="<?php echo trim(strtoupper($_SESSION['ordertype']));?>" id="ordertype">
				<br/>
					
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
						<?php //echo $_SESSION['deals']; 
						if($_SESSION['deals']) { ?>
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
								<span id="totalamount_text"><?php echo '$'.$orderdetails[0]['TempOrder']['total']; ?></span>
								<input type="hidden" id="totalamount" value="<?php echo $orderdetails[0]['TempOrder']['total']; ?>"/>
							</td>
						</tr>
					</table>
				</div>
				<div id="order_details">
					<h2 class="blue_font">Order Details</h2><br/>
					<div id="order_details_allitems">
					<div class="order_details_restaurant_name">Ordering from <?php echo $restaurantinfo['Restaurant']['name'];?></div>
					<br />
					
	<?php 
	foreach($orderdetails[0]['TempItem'] as $orderitem):
		echo '<div class="order_details_itemslist">';
			/*
			echo '<span class="order_details_price">'.$orderitem['Item']['price'].'</span>';
			echo '<span class="order_details_edit"><a href="../../menu/'.$orderdetails[0]['TempOrder']['restaurant_id']
				.'/'.$_SESSION['restaurant_id'].'?edititem='.$orderitem['id'].'" class="order_details_item_name blue_font">Edit/Delete</a></span>';
			*/	
			echo '<button type="button" class="close" id="'.$orderitem['Item']['id'].'">×</button>';
			echo '<span class="order_details_price">'.$orderitem['quantity'].' '.$orderitem['Item']['name'].' - $'.$orderitem['Item']['price'].'</span>';
			
			if($orderitem['special_instructions'] != 'upsell')
				echo '<span class="order_details_edit"><a href="../../menu/'.$orderdetails[0]['TempOrder']['restaurant_id']
				.'/'.$_SESSION['ordertypeid'].'?edititem='.$orderitem['id'].'" class="order_details_item_name blue_font">Edit&raquo;</a></span>&nbsp;&nbsp;';	
			
			//Delete Popup
			echo $this->Form->create('TempOrder',array('controller'=>'TempOrders','action'=>'deleteitem'));
			echo '<div class="modal fade deleteitem" id="modal'.$orderitem['Item']['id'].'">';
			  echo '<div class="modal-dialog">';
			   echo '<div class="modal-content">';
			      echo '<div class="modal-header">';
			        echo '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
			        echo '<h4 class="modal-title">Delete Item</h4>';
			     echo '</div>';
			      echo '<div class="modal-body">';
					echo $this->Form->hidden('TempOrder.IsOrderPage',array('value'=>1, 'class'=>'IsOrderPage'));
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

			/*	
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

			*/
			//End Popup
			//echo '<span class="order_details_item">'.$orderitem['quantity'].' '.$orderitem['Item']['name'].'</span>';
			
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
</div><!-- .wrapper -->		
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
    <button class="btn btn-primary" id="changeaddress_modal">Find My Food!</button>
  </div>
</div>

<!-- Processing Order -->
<div id="processingOrder" class="modal hide fade" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <h3 class="red_font" id="myModalLabel">Thanks so much for ordering with us!</h3>
  </div>
  <div class="modal-body">
    <p>
    	We are currently validating your ordering. If all is good we will submit your order and setup your account.
    	<br/>
    	<!-- Your account can be accessed by clicking the "My Account" link and logging in with the username and password you have setup.
    	<br/> -->
    	<div class="loader_wrapper">
			<?php echo $this->Html->image('loader.gif', array('class' => 'loader_image')); ?>
		</div>
    </p>
  </div>
  <div class="modal-footer">
  </div>
</div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<?php echo $this->Html->script('map.js'); ?>
<?php echo $this->Html->script('menu.js'); ?>
<?php echo $this->Html->script('jquery.mask.js'); ?>

<script>
	$(document).ready(function(){
	  $('#UserPhone').mask('(000) 000-0000');
	  jQuery('#PaymentInfoBillingZip').mask('00000-000');
	  //jQuery('#processingOrder').modal('show');

	});
	var mainurl = '<?php echo Configure::read('mainurl'); ?>';
	//Change Address from the modal - the modal "only" displays when order type has been changed
	/*jQuery('#changeaddress_modal').click(function() {
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
		
	});*/
	
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
	
	//Change Address from typing in a new address in the box
	/*jQuery('#changeaddress').click(function() {
		var address_val = jQuery('#search_address').val();
		var btnid = $(this).attr('id');
		var ordertype_val = jQuery('#ordertype').val();
		var restaurantid = <?php echo $_SESSION['restaurant_id'];?>;
		ordertype_val.replace(/^\s+|\s+$/g,'');
		
		changeAddress(address_val, btnid, ordertype_val, restaurantid, 'textbox');
		
	});*/
	
	
	//Change Order Type
	jQuery('#changeordertype').click(function() {
		var ordertype_val = jQuery('#ordertype_change').val();
		var restaurantid = <?php echo $_SESSION['restaurant_id'];?>;
		var city = '<?php echo $_SESSION['city']; ?>';
		changeOrderType(ordertype_val, restaurantid, city);
		
	});
	
	//Change Order type for today or tomorrow
	/*jQuery('#editordertype_for').change(function() {
		alert('test');
		var ordertypefor = jQuery('#editordertype_for').val();
		changeOrderTypeFor(ordertypefor);

	});*/

	
	function editordertype_forChange(ordertype) {
		//var ordertypefor = jQuery('#editordertype_for option:selected').text().toLowerCase();
		var ordertypefor = jQuery(ordertype).find('option:selected').text().toLowerCase();
		changeOrderTypeFor(ordertypefor);
	}	
	
	//Add Upsell Item
	/*function addupsellitem(id) {
		var upsellitem = '.' + id + 'upsell';
		var temporderid_val = <?php echo $orderid; ?>;
		var itemid_val = id;
		addUpsell(upsellitem, temporderid_val, itemid_val);
	}*/
	
	
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
	
            
        
	jQuery(document).ready(function(){
		jQuery("#RestaurantOrderForm").validationEngine({

		});
	});
	
	 //jQuery('.submit_order').click(function(e) {
	 function validateOrder() {
	    var isValid = true;
	    
	   	//e.preventDefault();
	    debugger;
	    //If user has existing payment profile

	    if(jQuery('#existingcc').length <= 0 || (jQuery('#existingcc').length = 1 && jQuery('#existingcc:checked').length == 0)) {
	    	jQuery('.newcc').each(function() {
	    		jQuery(this).addClass('validate[required]');
	    		jQuery('#processingOrder').modal('hide');
	    	});
	    } else if (jQuery('#existingcc').length > 0 && jQuery('#existingcc:checked').length == 1) {
	    	jQuery('.newcc').each(function() {
	    		jQuery(this).removeClass('validate[required]');
	    		jQuery('#processingOrder').modal('hide');
	    	});
	    }
	    
	    //Clear Validation 
	    jQuery("#RestaurantSubmitpaymentForm").validationEngine('hideAll');
	    
	    //If validation passes allow user to slide to next page
	    jQuery("#RestaurantSubmitpaymentForm").find(':input').each(function (i, item) {
	      if (jQuery(item).validationEngine('validate')){
	        isValid = false;
	        jQuery('#processingOrder').modal('hide');
	      }       
	    });
	    
	    if(isValid){
		    var emailval = jQuery('#email').val();
			var orderid_val = '<?php echo $orderid ?>';
			var ccnum_val = jQuery('#cc_num').val();
			var month_val = jQuery('#cc_month').val();
			var year_val = jQuery('#cc_year').val();
			var cvv_val = jQuery('#cc_code').val();
		
	      jQuery('#email').after('<div class="UserEmailExistformError parentFormUserPropertymanagerForm formError email_exists" style="opacity: 0.87; position: absolute; left: 171px; margin-top: -50px;"><div class="formErrorContent">* Validating Email please wait ...<br></div><div class="formErrorArrow"><div class="line10"><!-- --></div><div class="line9"><!-- --></div><div class="line8"><!-- --></div><div class="line7"><!-- --></div><div class="line6"><!-- --></div><div class="line5"><!-- --></div><div class="line4"><!-- --></div><div class="line3"><!-- --></div><div class="line2"><!-- --></div><div class="line1"><!-- --></div></div></div>'); 
	     	
	     checkcc_val = true;
	     if(jQuery('#existingcc :checked').size() == 1)
	     	checkcc_val = false;
	     	
	      $.ajax({
	      	type: 'POST',
	      	async: false,
	        url:mainurl+"/Restaurants/validateorder/",
	        data: {email: emailval, orderid: orderid_val, ccnum: ccnum_val, month: month_val, year: year_val, cvv: cvv_val, checkcc: checkcc_val},
	        success:function(result){
	        	var values = result.split('|');
				var errormsg = '';
	          if(values[0] == 'exists') {
	            isValid = false;
	            jQuery('.UserEmailExistformError .formErrorContent').html('* Email address already exists'); 
	            errormsg = '<li>Email address already exists</li>';
	            jQuery('#processingOrder').modal('hide');
	          } else {
	            jQuery('.UserEmailExistformError').hide();
	            jQuery('#processingOrder').modal('hide');
	          } 
	          
	          if(values[1] == 'processed') {
	            isValid = false;
	            jQuery('.UserEmailExistformError .formErrorContent').html('* Order has been processed'); 
	            errormsg = errormsg+'<li>Order has been processed</li>';
	          } else {
	            jQuery('.UserEmailExistformError').hide();
	          } 
	          
	          //validate cc num
	          if(values[2] == 'no' && (jQuery('#existingcc').length > 0 && jQuery('#existingcc:checked').length != 1)) {
	            isValid = false;
	            jQuery('.UserEmailExistformError .formErrorContent').html('* Invalid Credit Card Number'); 
	            errormsg = errormsg+'<li>Invalid Credit Card Number</li>';	            
	          } else {
	            jQuery('.UserEmailExistformError').hide();
	          } 
	          
	          //validate cc expiration
	          if(values[3] == 'no' && (jQuery('#existingcc').length > 0 && jQuery('#existingcc:checked').length != 1)) {
	            isValid = false;
	            jQuery('.UserEmailExistformError .formErrorContent').html('* Invalid Credit Card Expiration Date'); 
	            errormsg = errormsg+'<li>Invalid Credit Card Expiration Date</li>';	            	            
	          } else {
	            jQuery('.UserEmailExistformError').hide();
	          } 	    
	          
	          //validate cc cvv
	         if(values[4] == 'no' && (jQuery('#existingcc').length > 0 && jQuery('#existingcc:checked').length != 1)) {
	            isValid = false;
	            jQuery('.UserEmailExistformError .formErrorContent').html('* Invalid Credit Card Security Code'); 
	            errormsg = errormsg+'<li>Invalid Credit Card Security Code</li>';		            
	          } else {
	            jQuery('.UserEmailExistformError').hide();
	          } 
	          
	          if(!isValid && errormsg != '') {
	          	jQuery('#validation').fadeIn();
	          	jQuery('#validation').html('<ul>'+errormsg+'</ul>'); 
	          	jQuery('#processingOrder').modal('hide');     	          	          
	          } else {
	          	jQuery('#processingOrder').modal('show');
	          }
	      },
	      error:function(result){
			isValid = false;
	      }});
	    } else {
			isValid = false;
			jQuery('html,body').animate({scrollTop: jQuery('.formErrorContent').first().offset().top-100}, 700, "swing");			
	    }
	  //});
	  
	  	return isValid;
	  }
	  
	function validateCashOrder() {
	    var isValid = true;
	   	//e.preventDefault();
	    debugger;
	    //If user has existing payment profile

	    if(jQuery('#existingcc').length <= 0 || (jQuery('#existingcc').length = 1 && jQuery('#existingcc:checked').length == 0)) {
	    	jQuery('.newcc').each(function() {
	    		jQuery(this).addClass('validate[required]');
	    	});
	    } else if (jQuery('#existingcc').length > 0 && jQuery('#existingcc:checked').length == 1) {
	    	jQuery('.newcc').each(function() {
	    		jQuery(this).removeClass('validate[required]');
	    	});
	    }
	    
	    //Clear Validation 
	    jQuery("#RestaurantSubmitpaymentForm").validationEngine('hideAll');
	    
	    //If validation passes allow user to slide to next page
	    jQuery("#RestaurantSubmitpaymentForm").find(':input').each(function (i, item) {
	      if (jQuery(item).validationEngine('validate')){
	        isValid = false;
	      }       
	    });
	    
	    if(isValid){
		    var emailval = jQuery('#email').val();
			var orderid_val = '<?php echo $orderid ?>';
		
	      jQuery('#email').after('<div class="UserEmailExistformError parentFormUserPropertymanagerForm formError email_exists" style="opacity: 0.87; position: absolute; left: 171px; margin-top: -50px;"><div class="formErrorContent">* Validating Email please wait ...<br></div><div class="formErrorArrow"><div class="line10"><!-- --></div><div class="line9"><!-- --></div><div class="line8"><!-- --></div><div class="line7"><!-- --></div><div class="line6"><!-- --></div><div class="line5"><!-- --></div><div class="line4"><!-- --></div><div class="line3"><!-- --></div><div class="line2"><!-- --></div><div class="line1"><!-- --></div></div></div>'); 
	     	
	     checkcc_val = true;
	     if(jQuery('#existingcc :checked').size() == 1)
	     	checkcc_val = false;
	     	
	      $.ajax({
	      	type: 'POST',
	      	async: false,
	        url:mainurl+"/Restaurants/validatecashorder/",
	        data: {email: emailval, orderid: orderid_val},
	        success:function(result){
	        	var values = result.split('|');
				var errormsg = '';
	          if(values[0] == 'exists') {
	            isValid = false;
	            jQuery('.UserEmailExistformError .formErrorContent').html('* Email address already exists'); 
	            errormsg = '<li>Email address already exists</li>';
	            
	          } else {
	            jQuery('.UserEmailExistformError').hide();
	          } 
	          
	          if(values[1] == 'processed') {
	            isValid = false;
	            jQuery('.UserEmailExistformError .formErrorContent').html('* Order has been processed'); 
	            errormsg = errormsg+'<li>Order has been processed</li>';
	          } else {
	            jQuery('.UserEmailExistformError').hide();
	          } 
	          	          
	          if(!isValid && errormsg != '') {
	          	jQuery('#validation').fadeIn();
	          	jQuery('#validation').html('<ul>'+errormsg+'</ul>');      	          	          
	          }
	      },
	      error:function(result){
			isValid = false;
	      }});
	    } else {
			isValid = false;			
	    }
	  //});
	  
	  	return isValid;
	  }	  
	  
	
	
	
</script>

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