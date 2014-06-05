<div class="menuHours form">
<?php echo $this->Form->create('MenuHour'); ?>
	<fieldset>
		<legend><?php echo __('Edit Menu Hour'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('menu_id');
		echo $this->Form->input('day',array('type'=>'select','options'=>array('Monday'=>'Monday','Tuesday'=>'Tuesday','Wednesday'=>'Wednesday','Thursday'=>'Thursday','Friday'=>'Friday','Saturday'=>'Saturday','Sunday'=>'Sunday'),'empty'=>'Select Day'));
		echo $this->Form->input('time_open', array('class'=>'smallinput'));
		echo $this->Form->input('time_closed', array('class'=>'smallinput'));
		echo $this->Form->input('lead_time',array('label'=>'Lead Time in minutes'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MenuHour.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('MenuHour.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Menu Hours'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Menus'), array('controller' => 'menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu'), array('controller' => 'menus', 'action' => 'add')); ?> </li>
	</ul>
</div>
