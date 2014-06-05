<div class="tempItems form">
<?php echo $this->Form->create('TempItem'); ?>
	<fieldset>
		<legend><?php echo __('Add Temp Item'); ?></legend>
	<?php
		echo $this->Form->input('temp_order_id');
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

		<li><?php echo $this->Html->link(__('List Temp Items'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Temp Orders'), array('controller' => 'temp_orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Temp Order'), array('controller' => 'temp_orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Temp Variations'), array('controller' => 'temp_variations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Temp Variation'), array('controller' => 'temp_variations', 'action' => 'add')); ?> </li>
	</ul>
</div>
