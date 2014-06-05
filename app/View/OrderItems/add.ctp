<div class="orderItems form">
<?php echo $this->Form->create('OrderItem'); ?>
	<fieldset>
		<legend><?php echo __('Add Order Item'); ?></legend>
	<?php
		echo $this->Form->input('order_id');
		echo $this->Form->input('item_id');
		echo $this->Form->input('quantity');
		echo $this->Form->input('special_instructions');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Order Items'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Variations'), array('controller' => 'order_variations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Variation'), array('controller' => 'order_variations', 'action' => 'add')); ?> </li>
	</ul>
</div>
