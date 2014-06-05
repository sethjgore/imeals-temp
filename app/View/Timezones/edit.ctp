<div class="timezones form">
<?php echo $this->Form->create('Timezone'); ?>
	<fieldset>
		<legend><?php echo __('Edit Timezone'); ?></legend>
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Timezone.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Timezone.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Timezones'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
	</ul>
</div>
