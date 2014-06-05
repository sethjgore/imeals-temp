<div class="tempVariations form">
<?php echo $this->Form->create('TempVariation'); ?>
	<fieldset>
		<legend><?php echo __('Edit Temp Variation'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('temp_item_id');
		echo $this->Form->input('variation_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('TempVariation.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('TempVariation.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Temp Variations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Temp Items'), array('controller' => 'temp_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Temp Item'), array('controller' => 'temp_items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Variations'), array('controller' => 'variations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Variation'), array('controller' => 'variations', 'action' => 'add')); ?> </li>
	</ul>
</div>
