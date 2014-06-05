<div class="menuHours form">
<?php echo $this->Form->create('MenuHour'); ?>
	<fieldset>
		<legend><?php echo __('Add Menu Hours'); ?></legend>
	<?php
	  if(isset($menu_id) && $menu_id != null){
  	   echo $this->Form->hidden('menu_id',array('value'=>$menu_id));
  	   echo '<h3>' . $menu_name . '</h3>';  
	  } else {
  	   echo $this->Form->input('menu_id');
	  }
		echo $this->Form->input('day',array('type'=>'select','options'=>array('Monday'=>'Monday','Tuesday'=>'Tuesday','Wednesday'=>'Wednesday','Thursday'=>'Thursday','Friday'=>'Friday','Saturday'=>'Saturday','Sunday'=>'Sunday'),'empty'=>'Select Day'));
		echo $this->Form->input('time_open');
		echo $this->Form->input('time_closed');
		echo $this->Form->input('lead_time');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Menu Hours'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Menus'), array('controller' => 'menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu'), array('controller' => 'menus', 'action' => 'add')); ?> </li>
	</ul>
</div>
