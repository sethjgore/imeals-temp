<div class="variations form">
<?php echo $this->Form->create('Variation'); ?>
	<fieldset>
		<legend><?php echo __('Add Variation'); ?></legend>
	<?php
		echo $this->Form->input('variation_group_id');
		echo $this->Form->input('name');
		echo $this->Form->input('amount');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Variations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Variation Groups'), array('controller' => 'variation_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Variation Group'), array('controller' => 'variation_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Temp Variations'), array('controller' => 'temp_variations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Temp Variation'), array('controller' => 'temp_variations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Variations'), array('controller' => 'order_variations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Variation'), array('controller' => 'order_variations', 'action' => 'add')); ?> </li>
	</ul>
</div>
