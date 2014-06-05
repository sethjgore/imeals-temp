<div class="cuisines form">
<?php echo $this->Form->create('Cuisine'); ?>
	<fieldset>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Add Cuisine'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Cuisines'), array('action' => 'index')); ?></li>
	</ul>
</div>
