<div class="menus form">
<?php echo $this->Form->create('Menu'); ?>
	<fieldset>
		<legend><?php echo __('Add Menu'); ?></legend>
	<?php
	  if(isset($rest_order_type_id)){
  	  echo '<h3>'.$restaurant['Restaurant']['name']. ' ' . $restaurant['OrderType']['name'] . ' Menu</h3>';
  	  echo $this->Form->hidden('restaurant_order_type_id',array('value'=>$rest_order_type_id));
	  } else {
  	   echo $this->Form->input('restaurant_order_type_id');
	  }
		echo $this->Form->input('name');
		echo $this->Form->input('upsell_y_n');
		echo $this->Form->input('active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Menus'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Restaurant Order Types'), array('controller' => 'restaurant_order_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Restaurant Order Type'), array('controller' => 'restaurant_order_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Menu Hours'), array('controller' => 'menu_hours', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Hour'), array('controller' => 'menu_hours', 'action' => 'add')); ?> </li>
	</ul>
</div>
