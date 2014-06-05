<div class="restaurants form">
<?php echo $this->Form->create('Restaurant'); ?>
	<fieldset>
		<legend><?php echo __('Add Restaurant'); ?></legend>
		<ul class="nav nav-tabs" id="RestaurantTabs">
    <li><a href="#" class="deactive">General</a></li>
    <li><a href="#" class="deactive">Billing</a></li>
    <li><a href="#" class="deactive">Contact</a></li>
    <li class="active"><a href="#">Technical</a></li>
    <li><a href="#" class="deactive">Order Types</a></li>
    <li><a href="#" class="deactive">Menus</a></li>
  </ul>

  <?php
  		echo $this->Form->input('id',array('value'=>$restaurant_id));
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
<?php echo $this->Form->end(__('Next')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Restaurants'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Restaurants'), array('action' => 'index')); ?></li>
	</ul>
</div>