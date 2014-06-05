<div class="restaurants form">
<ul class="nav nav-tabs" id="RestaurantTabs">
  <li class="active"><a href="#general">General</a></li>
  <li><a href="#billing">Billing</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#technical">Technical</a></li>
  <li><a href="#order_types">Order Types</a></li>
  <li><a href="#menus">Menus</a></li>
</ul>
 
<div class="tab-content">
  <div class="tab-pane active" id="general">
    <?php echo $this->Form->create('Restaurant',array('enctype' => 'multipart/form-data')); ?>
    	<fieldset>
    	  <?php
    		echo $this->Form->input('id');
    		echo $this->Form->input('city_id');
    		echo $this->Form->input('name');
    		echo $this->Form->input('email');
    		if(isset($this->request->data['Restaurant']['logo_url']) && $this->request->data['Restaurant']['logo_url'] != ""):
    		  echo '<label>Logo</label><img width="90" src="'.Router::url('/',true) . 'files/' .$this->request->data['Restaurant']['logo_url'].'" alt="" />';
    		  echo '<a href="#" id="edit_logo" style="margin-left:10px;">Edit Logo</a>';
    		  echo '<div class="edit_logo_input" style="display:none;"><input type="hidden" name="MAX_FILE_SIZE" value="32000000" />';
    		  echo $this->Form->input('logo_file',array('type' => 'file')); 
    		  echo '</div><br><br>'; 
    		else:
    		  echo '<div class="edit_logo_input"><input type="hidden" name="MAX_FILE_SIZE" value="32000000" />';
    		  echo $this->Form->input('logo_file',array('type' => 'file')); 
    		  echo '</div>'; 
    		endif;
    		echo $this->Form->input('address');
    		echo $this->Form->input('zip');
    		echo $this->Form->input('description');
    		echo $this->Form->input('Cuisine');
    		
    		echo '<div class="input number"><label for="RestaurantDeals">First Time Deal</label>';
    		echo '<div class="input-append">';
    		echo $this->Form->input('deals',array('div'=>false,'label'=>false));
    		echo '<span class="add-on">%</span>';
    		echo '</div></div>';
    		
    		echo '<div class="input number"><label for="RestaurantPrice">Price</label>';
    		echo '<div class="input-prepend">';
    		echo '<span class="add-on">($ to $$$$)</span>';
    		echo $this->Form->input('price',array('div'=>false,'label'=>false));
    		echo '</div></div>';
    				
    		echo '<div class="input number"><label for="RestaurantSalesTax">Sales Tax</label>';
    		echo '<div class="input-append">';
    		echo $this->Form->input('sales_tax',array('div'=>false,'label'=>false));
    		echo '<span class="add-on">%</span>';
    		echo '</div></div>';

    		echo $this->Form->input('phone');
    		echo $this->Form->input('fax'); 
    		echo $this->Form->input('User');
    		  ?>
        </fieldset>
    <?php echo $this->Form->end(__('Save')); ?>
  </div><!-- #general -->
  <div class="tab-pane" id="billing">
    <?php echo $this->Form->create('Restaurant'); ?>
    	<fieldset>
    	  <?php
    	  echo $this->Form->input('id');
    		echo $this->Form->input('billing_name');
    		echo $this->Form->input('billing_street');
    		echo $this->Form->input('billing_city');
    		echo $this->Form->input('billing_state_id');
    		echo $this->Form->input('billing_zip');
    		echo $this->Form->input('mailing_fee',array('label'=>'Include Mailing Fee ($0.50 mailing charge to restaurant statement)'));
    		echo '<div class="input number"><label for="RestaurantCommission">Comission</label>';
    		echo '<div class="input-append">';
    		echo $this->Form->input('commission',array('div'=>false,'label'=>false));
    		echo '<span class="add-on">%</span>';
    		echo '</div></div>';
    		
    		echo $this->Form->input('cc_y_n',array('label'=>'Restaurant Accepts Credit Cards?'));
    		
    		echo '<div class="input number"><label for="RestaurantCcPercent">Credit Card Percent</label>';
    		echo '<div class="input-append">';
    		echo $this->Form->input('cc_percent',array('div'=>false,'label'=>false));
    		echo '<span class="add-on">%</span>';
    		echo '</div></div>';
    				
    		echo '<div class="input number"><label for="RestaurantCcFlatFee">Credit Card Flat Fee</label>';
    		echo '<div class="input-prepend">';
    		echo '<span class="add-on">$</span>';
    		echo $this->Form->input('cc_flat_fee',array('div'=>false,'label'=>false));
    		echo '</div></div>';
    		
    		echo $this->Form->input('wf_y_n',array('label'=>'Has Weekly Fee?'));
    		echo $this->Form->input('wf_fee_reason',array('label'=>'Weekly Fee Reason'));
    		
    		echo '<div class="input number"><label for="RestaurantWfFeeAmt">Weekly Fee Amount</label>';
    		echo '<div class="input-prepend">';
    		echo '<span class="add-on">$</span>';
    		echo $this->Form->input('wf_fee_amt',array('div'=>false,'label'=>false));
    		echo '</div></div>'; ?>
    		</fieldset>
    <?php echo $this->Form->end(__('Save')); ?>
  </div><!-- #general -->
  <div class="tab-pane" id="contact">
    <h3><?php echo __('Restaurant Contacts'); ?></h3>
    	<?php if (!empty($restaurant['RestaurantContact'])): ?>
    <div id="rest_contacts">
    	<table class="table table-striped table-bordered" cellpadding = "0" cellspacing = "0">
    	<tr>
    		<th><?php echo __('Name'); ?></th>
    		<th><?php echo __('Title'); ?></th>
    		<th><?php echo __('Phone'); ?></th>
    		<th class="actions"><?php echo __('Actions'); ?></th>
    	</tr>
    	<?php
    		$i = 0;
    		foreach ($restaurant['RestaurantContact'] as $restaurantContact): ?>
    		<tr id="rescontact-<?php echo $i; ?>">
    			<td><?php echo $restaurantContact['name']; ?></td>
    			<td><?php echo $restaurantContact['title']; ?></td>
    			<td><?php echo $restaurantContact['phone']; ?></td>
    			<td class="actions">
					<?php 
					echo $this->Html->link(__('Edit'), array('controller'=>'RestaurantContacts','action' => 'edit',$restaurantContact['id'],$restaurant['Restaurant']['id']));
					?>
    				<?php    				
    				echo $this->Js->submit(__("Delete"), array(
    	             'update'=>'#contact_deleted',
    	             'url'=>array('controller'=>'RestaurantContacts','action'=>'delete',$restaurantContact['id']),
    	             'confirm'=>'Are you sure you want to delete '.$restaurantContact['name'].'?',
    	             'success'=> 'jQuery("#rescontact-'.$i.'").remove();',
    	             'escape'=>false,
    	             'evalScripts' => true,
    	             'div'=>false,
    	             'class'=>'btn btn-danger btn-mini confirm_delete')
    	           );
    	       ?>
    			</td>
    		</tr>
    	<?php $i++; endforeach; ?>
    	</table>
     </div><!-- #rest_contacts -->

    <?php endif; ?>
      <br>
     <?php echo $this->Html->link(__('<i class="icon-plus icon-white"></i> Add Restaurant Contact'),'#addRestContact' ,array('class'=>'btn btn-small btn-success','escape'=>false,'role'=>'button','data-toggle'=>'modal'));
    	         ?>
    	         <!-- Add Menu Modal -->
                <div id="addRestContact" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h3 id="myModalLabel">Add Contact</h3>
                  </div>
                  <div class="modal-body">
                      <div id="addContactErrors"></div>
                       <?php echo $this->Form->create('RestaurantContact',array('controller'=>'RestaurantContacts','action'=>'add')); ?>
                          	<fieldset>
                          	<?php
                          		echo $this->Form->hidden('restaurant_id',array('value'=>$restaurant['Restaurant']['id']));
                          		echo $this->Form->input('name',array('label'=>'Contact Name'));
                          		echo $this->Form->input('title',array('label'=>'Contact Title'));
                          		echo $this->Form->input('phone',array('label'=>'Contact Phone'));
                          	?>
                          	</fieldset>
                          <?php echo $this->Js->submit(__('Add Contact'), array('update'=>'#rest_contacts', 'url'=>array('controller'=>'RestaurantContacts','action'=>'add')));
                                echo $this->Form->end();
                          ?>

                  </div>
                </div><!-- .modal -->
                
   
  </div>
  <div class="tab-pane" id="technical">
    <?php echo $this->Form->create('Restaurant'); ?>
    	<fieldset>
    	  <?php
    	  		echo $this->Form->input('id');
    	  		echo '<strong>Phone Alerts</strong><br><br>';
    	  		echo $this->Form->input('po_phone_alert',array('label'=>'Personal Order Phone Alerts'));
    	  		echo $this->Form->input('me_phone_alert',array('label'=>'Meeting & Event Phone Alerts'));
    	  		echo $this->Form->input('vc_phone_alert',array('label'=>'Virtual Cafe Phone Alerts'));
    	  		echo '<br><br><strong>Fax Alerts</strong><br><br>';
    	  		echo $this->Form->input('po_fax_alert',array('label'=>'Personal Order Fax Alerts'));
    	  		echo $this->Form->input('me_fax_alert',array('label'=>'Meeting & Event Fax Alerts'));
    	  		echo $this->Form->input('vc_fax_alert',array('label'=>'Virtual Cafe Fax Alerts'));
    	  		echo '<br><br><strong>Email Alerts</strong><br><br>';
    	  		echo $this->Form->input('po_email_alert',array('label'=>'Personal Order Email Alerts'));
    	  		echo $this->Form->input('me_email_alert',array('label'=>'Meeting & Event Email Alerts'));
    	  		echo $this->Form->input('vc_email_alert',array('label'=>'Virtual Cafe Email Alerts'));
    	  ?>
    		</fieldset>
    <?php echo $this->Form->end(__('Save')); ?>
  </div>
  <div class="tab-pane" id="order_types">
    <?php echo $this->Form->create('Restaurant'); ?>
      <h6>*Note: Must configure Order Types to be able to add Menus</h6>
    	<fieldset>
    	  <?php
    	  		echo $this->Form->input('id');
      		  echo $this->Form->input('po_pickup',array('label'=>'Personal Pickup'));?>
  		  <div class="edit_order_type">
  		    <?php 
    		  if($restaurant['Restaurant']['po_pickup_configured'] == 0):
    		    echo $this->Html->link(__('Configure Personal Pickup'), array('controller' => 'restaurant_order_types', 'action' => 'add',$restaurant['Restaurant']['id'],'1','Personal Pickup'),array('target'=>'blank' ));
    		  else:
    		    echo $this->Html->link(__('Edit Personal Pickup'), array('controller' => 'restaurant_order_types', 'action' => 'edit',$this->request->data['Restaurant']['po_pickup_configured']),array('target'=>'blank' )); 
    		  endif;
    		  ?>
  		  </div>
  		<?php echo $this->Form->input('po_delivery',array('label'=>'Personal Delivery')); ?>
  		  <div class="edit_order_type">
    		  <?php 
    		    if($restaurant['Restaurant']['po_delivery_configured'] == 0):
      		     echo $this->Html->link(__('Configure Personal Delivery'), array('controller' => 'restaurant_order_types', 'action' => 'add',$restaurant['Restaurant']['id'],'2','Personal Delivery'),array('target'=>'blank' )); 
    		    else:
      		     echo $this->Html->link(__('Edit Personal Delivery'), array('controller' => 'restaurant_order_types', 'action' => 'edit',$this->request->data['Restaurant']['po_delivery_configured']),array('target'=>'blank' )); 
      		  endif; 
    		     ?>
  		  </div>

  		<?php echo $this->Form->input('me_pickup',array('label'=>'ME Pickup'));                       ?>
  		<?php echo $this->Form->input('me_delivery',array('label'=>'Me Delivery'));                   ?>

  		<?php echo $this->Form->input('me_catering_pickup',array('label'=>'ME Catering Pickup'));     ?>
  		<?php echo $this->Form->input('me_catering_delivery',array('label'=>'Me Catering Delivery')); ?>
  		
  		<?php echo $this->Form->input('vc_delivery',array('label'=>'Virtual Cafeteria'));             ?>
  		
  	<?php echo $this->Form->end(__('Save')); ?>
  	
  </div><!-- .orader_types -->
  <div class="tab-pane rest_menus" id="menus">
    <h2>Active Menus</h2>
     <div style="font-size:11px;line-height:12px;">
     	   <i class="icon-arrow-up"></i> = Up-Sell Menu <br>
    	   <i class="icon-list-alt"></i> = Regular Menu<br>
     </div><!--  --><br>
    	   <?php if (!empty($restaurant['RestaurantOrderType'])):
    	      $i=0;
    	     foreach ($restaurant['RestaurantOrderType'] as $restaurantOrderType):
    	      if(($restaurantOrderType['OrderType']['name'] == 'Personal Pickup' && $restaurant['Restaurant']['po_pickup']) ||
    	          $restaurantOrderType['OrderType']['name'] == 'Personal Delivery' && $restaurant['Restaurant']['po_delivery']):
    	       echo '<div class="rest_menu_header">';
    	       echo '<h4>'.$restaurantOrderType['OrderType']['name'] . '</h4>';
    	       echo '<br><br></div><!-- .rest_menu_header -->';
    	       echo '<div class="indent"><div id="menu-'.$i.'">';
    	       if (!empty($restaurantOrderType['Menu'])):
    	         foreach($restaurantOrderType['Menu'] as $menu):
    	           echo '<div class="menu_line">';
    	           if($menu['upsell_y_n'] == 1):
    	            echo $this->Html->link(__('<i class="icon-arrow-up"></i> '.$menu['name']), array('controller' => 'menus', 'action' => 'edit',$menu['id'],__($restaurant['Restaurant']['name'])),array('id'=>'menu-'.$menu['id'],'escape'=>false)). ' ';
    	           else:
    	            echo $this->Html->link(__('<i class="icon-list-alt"></i> '.$menu['name']), array('controller' => 'menus', 'action' => 'edit',$menu['id'],__($restaurant['Restaurant']['name'])),array('id'=>'menu-'.$menu['id'],'escape'=>false)). ' ';
    	           endif;
    	           echo '<div class="menu_delete">';
    	           
    	           echo $this->Form->create();
    	           echo $this->Js->submit(__("Delete"), array(
    	             'update'=>'#menu_deleted',
    	             'url'=>array('controller'=>'Menus','action'=>'deactivate',$menu['id']),
    	             'confirm'=>'Are you sure you want to delete '.$menu['name'].'?',
    	             'success'=> 'jQuery("#menu-'.$menu['id'].'").parent().remove();',
    	             'escape'=>false,
    	             'evalScripts' => true,
    	             'div'=>false,
    	             'class'=>'btn btn-danger btn-mini confirm_delete')
    	           );
    	           echo $this->Form->end(); 
    	           
    	           echo '</div><!-- menu_delete --><br><br></div><!-- menu_line -->';
    	           
    	         endforeach;    	           
    	       else:
    	         echo 'No Menus<br><br>';
    	       endif;
    	       echo '</div>';
    	       echo $this->Html->link(__('<i class="icon-plus icon-white"></i> Add Menu'),'#addMenuModal-'.$i ,array('class'=>'btn btn-mini btn-success','escape'=>false,'role'=>'button','data-toggle'=>'modal'));
    	         ?>
    	         
    	         <!-- Add Menu Modal -->
                <div id="addMenuModal-<?php echo $i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h3 id="myModalLabel">Add Menu</h3>
                  </div>
                  <div class="modal-body">
                      <?php echo $this->Form->create('Menu',array('action'=>'add','id'=>'ajaxAddMenu'.$i)); ?>
                      	<fieldset>
                      	<?php
                          echo $this->Form->hidden('Menu.restaurant_order_type_id',array('value'=>$restaurantOrderType['id']));
                      		echo $this->Form->input('Menu.name',array('label'=>'Menu Name'));
                      		echo $this->Form->input('Menu.upsell_y_n', array('label'=>'Is this the Upsell menu?'));
                      		echo $this->Form->hidden('Menu.active',array('value'=>1));
                      		
                      		echo '<br><h4>Make a copy of an existing Menu:</h4>';
                      		echo $this->Form->input('copy_city',array('type'=>'select','options'=>$cities,'empty'=>'Choose City','id'=>'select_city_'.$i,'label'=>false)); 
                      		echo '<div id="choose_restaurant_'.$i.'"></div><div id="choose_menu_'.$i.'" class="choose_menu"></div>';
                      		//Set Javascript for Copying a menu
                      		$this->Js->get('#select_city_'.$i)->event('change',
                          	$this->Js->request(
                          		array('controller'=>'restaurants',
                          			'action'=>'getRestaurantsByCity'),
                          		array('update' => '#choose_restaurant_'.$i, 
                          			'dataExpression' => true, 
                          			'data' => 'jQuery("#select_city_'.$i.'").serialize() + "&id='.$i.'&type=cpMenu"',
                          			'evalScripts'=>true,
                          			'success' => 'jQuery(".choose_menu").html("");'
                          		)
                          	)
                          );	
                      	?>
                      	</fieldset>
                      <?php 
                      echo $this->Js->submit(__('Save'), array('update'=>'#menu-'.$i, 'url'=>array('controller'=>'Menus','action'=>'add',$restaurantOrderType['id'],__($restaurant['Restaurant']['name']))));
                      echo $this->Form->end(); ?>

                  </div>
                </div>
    	         <?php
    	       echo '</div><!-- .indent --><br><br>';
    	       $i++;
    	       endif;
    	     endforeach;
    	     endif;
   ?> 
   <br><br><br><br>
     <div id="inactive_menu_contorl" class="btn btn-info">
     	Click Here To View Inactive Menus
     </div><!-- .btn -->
     <div id="inactive_menus" style="display:none;">
     	
    
       <?php if (!empty($inactive_menus['RestaurantOrderType'])):
        	     $i=0;
        	     foreach ($inactive_menus['RestaurantOrderType'] as $restaurantOrderType):
        	      if(($restaurantOrderType['OrderType']['name'] == 'Personal Pickup' && $restaurant['Restaurant']['po_pickup']) ||
        	          $restaurantOrderType['OrderType']['name'] == 'Personal Delivery' && $restaurant['Restaurant']['po_delivery']):
        	       echo '<div class="rest_menu_header">';
        	       echo '<h4>'.$restaurantOrderType['OrderType']['name'] . '</h4>';
        	       echo '<br><br></div><!-- .rest_menu_header -->';
        	       echo '<div class="indent"><div id="menu-'.$i.'">';
              if (!empty($restaurantOrderType['Menu'])):
    	         foreach($restaurantOrderType['Menu'] as $menu):
    	           echo '<div class="menu_line">';
    	           if($menu['upsell_y_n'] == 1):
    	            echo $this->Html->link(__('<i class="icon-arrow-up"></i> '.$menu['name']), array('controller' => 'menus', 'action' => 'edit',$menu['id'],__($restaurant['Restaurant']['name'])),array('id'=>'menu-'.$menu['id'],'escape'=>false)). ' ';
    	           else:
    	            echo $this->Html->link(__('<i class="icon-list-alt"></i> '.$menu['name']), array('controller' => 'menus', 'action' => 'edit',$menu['id'],__($restaurant['Restaurant']['name'])),array('id'=>'menu-'.$menu['id'],'escape'=>false)). ' ';
    	           endif;
    	       
    	           
    	           echo '<br></div><!-- menu_line -->';
    	           
    	         endforeach;    	           
    	       else:
    	         echo 'No Menus<br><br>';
    	       endif;
          echo '</div></div><!-- .indent --><br><br>';
    	       $i++;
    	       endif;
    	     endforeach;
    	     endif;
       ?>
       </div><!-- . -->
  </div>
</div><!-- .tab-content -->

<script>
 $('#RestaurantTabs a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
 });
 jQuery('#order_types input:checkbox').change(function(){
     if(jQuery(this).is(':checked')){
        jQuery(this).parent().next('.edit_order_type').slideDown();
     } else {
        jQuery(this).parent().next('.edit_order_type').slideUp();
     }
  });
  jQuery('#order_types input:checkbox').each(function(){
     if(jQuery(this).is(':checked')){
        jQuery(this).parent().next('.edit_order_type').slideDown();
     } else {
        jQuery(this).parent().next('.edit_order_type').slideUp();
     }
  });
  jQuery('#inactive_menu_contorl').click(function(e){
  	e.preventDefault();
  	jQuery('#inactive_menus').slideToggle();
  });
  jQuery('#edit_logo').click(function(e){
  	e.preventDefault();
  	jQuery('.edit_logo_input').slideToggle();
  });
</script>
		
</div>
<div class="actions">
	<h3><?php  echo __($restaurant['Restaurant']['name']); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete '.$restaurant['Restaurant']['name']), array('action' => 'delete', $this->Form->value('Restaurant.id')), null, __('Are you sure you want to delete %s?', $this->Form->value('Restaurant.name'))); ?></li>
		<li><?php echo $this->Html->link(__('List Restaurants'), array('action' => 'index')); ?></li>
	</ul>
</div>
