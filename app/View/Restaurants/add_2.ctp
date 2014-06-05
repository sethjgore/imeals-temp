<div class="restaurants form">
<?php echo $this->Form->create('Restaurant'); ?>
	<fieldset>
		<legend><?php echo __('Add Restaurant'); ?></legend>
		<ul class="nav nav-tabs" id="RestaurantTabs">
    <li><a href="#" class="deactive">General</a></li>
    <li class="active"><a href="#">Billing</a></li>
    <li><a href="#" class="deactive">Contact</a></li>
    <li><a href="#" class="deactive">Technical</a></li>
    <li><a href="#" class="deactive">Order Types</a></li>
    <li><a href="#" class="deactive">Menus</a></li>
  </ul>
	<?php
		echo $this->Form->input('id',array('value'=>$restaurant_id));
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
		echo '</div></div>';
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