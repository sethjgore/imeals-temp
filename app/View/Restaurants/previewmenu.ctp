<?php 
	/*echo 'ASAP-'.$_SESSION['ordertypeatasap'];
	echo '<br>Order at-'.$_SESSION['ordertypeat'];
	echo '<br>IS ASAP-'.$_SESSION['ordertypeatisasap'];*/
?>

<div id="orderingsteps">
	<div class="wrapper">
		<ul>
			<li><a href="#">1. Enter Your Info</a></li>
			<li><a href="#">2. Select a Restaurant</a></li>
			<li class="active"><span class="active_num">3.</span> Order from the Menu</li>
			<li>4. Checkout</li>						
		</ul>		
		
	</div><!-- .wrapper -->
</div><!-- #orderingsteps -->
<input type="hidden" id="orderid" value="1"/>
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
    		if(isset($ordertype['Menu']) && count($ordertype['Menu']) > 0):
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
            		   				
    			</div><!-- .rest_delivery -->    				
				<div class="build_meal">
				  Build Your Meal Below
				</div><!-- .build_meal -->
            	<div class="clear"></div>
    			</div><!-- #restaurantinfo -->
    			<div class="restaurantmenu">
    					<?php
    						foreach($ordertype['Menu'] as $menu): 
    						if($menu['upsell_y_n'] != 1) {?>
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
    								'<a href="#" class="category_showhide">-</a></span><br>'.
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
    														
    													echo '<a href="#" class="item_name blue_font" data-placement="right" data-toggle="tooltip">'.$item['name'].'</a>
    													<span class="item_price">$'.$item['price'].'</span>';
    													
    													//hover for item
    													echo '<div class="item_hover" style="display:none;">';
    															if(isset($item['photo_url']) && $item['photo_url'] != '')
    															echo '<img src="'.Router::url('/',true) . 'files/'.$item['photo_url'].'" />';
    															
    															echo '<a href="#" class="heading">'.$item['name'].'</a>';
    															echo '<div class="desc">'.$item['description'].'</div>';
    													echo '</div>';//End item_hover
    													
    														//popup for item
    											    														
    								echo '<div class="item_variation modal fade" style="display:none;">';
						  			echo '<div class="modal-dialog">';
						    			echo '<div class="modal-content">';
									//Form			
    								echo $this->Form->create('TempOrder',array('controller'=>'TempOrders','action'=>'additem'));
										echo $this->Form->hidden('TempOrder.id',array('value'=>'1', 'class'=>'itemid'));
										echo $this->Form->hidden('TempOrder.tip',array('value'=>'0.00', 'class'=>'tip'));
										echo $this->Form->hidden('TempItem.0.temp_order_id',array('value'=>'1', 'class'=>'itemid'));
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
    																			
    																				echo $this->Form->input('TempItem.0.TempVariation.'.$vcount.'.variation_id', array('type'=>'radio','options'=>$variationlist,'legend'=>false,'separator'=>'</li><li>','div'=>false,'value'=>'','class'=>'variation'));
    																				
    																				
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
      
      echo $this->Js->submit(__('Add to Order'));
      
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
    							else { 
    								$hasUpSell = true;
    							?>
    								<div id="upsellmenu" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									  <div class="modal-header">
									    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									    <h3 class="red_font" id="myModalLabel">Can we offer you anything else?</h3>
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
    								</div><!-- .modal-body -->
		    							  <div class="modal-footer">
										    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> -->
										    <?php
										    if(!$logged_in) {
												echo '<a href="#login_screen" id="finish_upsell" class="" data-toggle="modal">All Done!</a>';
											}			
											else {
												echo '<button class="btn cancelupsell" data-dismiss="modal" aria-hidden="true">Cancel</button>';
												echo '<a  href="../../order/'.$orderid.'" class="addupsellitem">All Done!</a>';
											}
											?>	
											
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
			<h2 class="blue_font">Order Information</h2><br/>
			
		</div><!-- #orderinformation -->
	</div><!-- .wrapper -->
</div><!-- restaurantmenu -->
<!-- Modal -->
<!-- Enter New Address -->
<div id="newAddress" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel" class="darkblue_font enter_del_address"><?php echo $this->Html->image('delivery-truck.png', array('alt' => 'Delivery Truck','style'=>'width:41px;')); ?><br><span style="font-size: 14px;">Delivery from this restaurant is not available to your address.  <br>Please click <a href="../../search/<?php echo $_SESSION['city']; ?>">here</a> to select another restaurant or enter a new address below:</span></h3>
  </div>
  <div class="modal-body">
    <p>
    	<input type="text" id="search_new_address"/>
    </p>
	   	<div class="user_message">Enter Address, City, State</div>
    <p>
    	<div id="addressinvalid" style="display: none;" class="alert alert-danger"></div>
    </p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" id="changeaddress_modal">Find My Food!</button>
  </div>
</div>
<!-- End Enter New Address -->
<div id="login_screen" class="modal hide fade">
  <div class="modal-header">
  	<h3 class="red_font">Existing or New User?</h3>
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
		<a href="../../order/<?php echo $orderid ?>/new" class="lightblue_button">New User</a>
	</div>
  </div>
</div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
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
	
		changeAddress(address_val, btnid, ordertype_val, restaurantid, 'modal');
		
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


	
</script>

<?php echo $this->Html->script('menu.js'); ?>
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