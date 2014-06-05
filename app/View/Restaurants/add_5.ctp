<div class="restaurants form">
<?php echo $this->Form->create('Restaurant'); ?>
	<fieldset>
		<legend><?php echo __('Add Restaurant'); ?></legend>
		<ul class="nav nav-tabs" id="RestaurantTabs">
    <li><a href="#" class="deactive">General</a></li>
    <li><a href="#" class="deactive">Billing</a></li>
    <li><a href="#" class="deactive">Contact</a></li>
    <li><a href="#" class="deactive">Technical</a></li>
    <li class="active"><a href="#">Order Types</a></li>
    <li><a href="#" class="deactive">Menus</a></li>
  </ul>
  <h6>*Note: Must configure Order Types to be able to add Menus</h6>

  <?php	echo $this->Form->input('id',array('value'=>$restaurant_id)); ?>
  		
  		
  		<?php echo $this->Form->input('Restaurant.po_pickup',array('label'=>'Personal Pickup'));?>
  		  <div class="edit_order_type">
    		  <?php 
    		  if($this->request->data['Restaurant']['po_pickup_configured'] == 0):
    		    echo $this->Html->link(__('Configure Personal Pickup'), array('controller' => 'restaurant_order_types', 'action' => 'add',$restaurant_id,'1','Personal Pickup'),array('target'=>'blank' )); 
    		  else:
    		    echo '&#10004; Personal Pickup Configured'; 
    		  endif;
    		  ?>
    		  
  		  </div>
  		<?php echo $this->Form->input('Restaurant.po_delivery',array('label'=>'Personal Delivery')); ?>
  		  <div class="edit_order_type">
    		  <?php 
    		  if($this->request->data['Restaurant']['po_delivery_configured'] == 0):
    		    echo $this->Html->link(__('Configure Personal Delivery'), array('controller' => 'restaurant_order_types', 'action' => 'add',$restaurant_id,'2','Personal Delivery'),array('target'=>'blank' )); 
    		  else:
    		    echo '&#10004; Personal Delivery Configured'; 
    		  endif;
    		  
    		  ?>
  		  </div>

  		<?php echo $this->Form->input('Restaurant.me_pickup',array('label'=>'ME Pickup'));                       ?>
  		<?php echo $this->Form->input('Restaurant.me_delivery',array('label'=>'Me Delivery'));                   ?>

  		<?php echo $this->Form->input('Restaurant.me_catering_pickup',array('label'=>'ME Catering Pickup'));     ?>
  		<?php echo $this->Form->input('Restaurant.me_catering_delivery',array('label'=>'Me Catering Delivery')); ?>
  		
  		<?php echo $this->Form->input('Restaurant.vc_delivery',array('label'=>'Virtual Cafeteria'));             ?>
  		
  	

	</fieldset>
<?php echo $this->Form->end(__('Next')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Restaurants'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Restaurants'), array('action' => 'index')); ?></li>
	</ul>
</div>

<script>
  jQuery('input:checkbox').change(function(){
     if(jQuery(this).is(':checked')){
        jQuery(this).parent().next('.edit_order_type').slideDown();
     } else {
        jQuery(this).parent().next('.edit_order_type').slideUp();
     }
  });
  jQuery(function(){
  	jQuery('input:checkbox').each(function(){
    	if(jQuery(this).is(':checked')){
        jQuery(this).parent().next('.edit_order_type').show();
      }
  	});
  });
</script>