<div class="cuisines form">
<?php echo $this->Form->create('Cuisine'); ?>
	<fieldset>
		<legend><?php echo __('Edit Cuisine'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Cuisine.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Cuisine.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Cuisines'), array('action' => 'index')); ?></li>
	</ul>
</div>
