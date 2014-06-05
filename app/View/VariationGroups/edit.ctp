<div class="variationGroups form">
<?php echo $this->Form->create('VariationGroup'); ?>
	<fieldset>
		<legend><?php echo __('Edit Variation Group'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('item_id');
		echo $this->Form->input('group_name');
		echo $this->Form->input('num_choices');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('VariationGroup.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('VariationGroup.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Variation Groups'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Variations'), array('controller' => 'variations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Variation'), array('controller' => 'variations', 'action' => 'add')); ?> </li>
	</ul>
</div>
