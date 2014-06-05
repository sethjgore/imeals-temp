<div class="orderVariations form">
<?php echo $this->Form->create('OrderVariation'); ?>
	<fieldset>
		<legend><?php echo __('Edit Order Variation'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('order_item_id');
		echo $this->Form->input('variation_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('OrderVariation.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('OrderVariation.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Order Variations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Order Items'), array('controller' => 'order_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Item'), array('controller' => 'order_items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Variations'), array('controller' => 'variations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Variation'), array('controller' => 'variations', 'action' => 'add')); ?> </li>
	</ul>
</div>
