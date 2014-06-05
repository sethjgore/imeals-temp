<div class="promoCodes form">
<?php echo $this->Form->create('PromoCode'); ?>
	<fieldset>
		<legend><?php echo __('Edit Promo Code'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('promotion_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PromoCode.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('PromoCode.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Promo Codes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Promotions'), array('controller' => 'promotions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Promotion'), array('controller' => 'promotions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Temp Orders'), array('controller' => 'temp_orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Temp Order'), array('controller' => 'temp_orders', 'action' => 'add')); ?> </li>
	</ul>
</div>
