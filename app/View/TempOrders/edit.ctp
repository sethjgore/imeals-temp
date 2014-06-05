<div class="tempOrders form">
<?php echo $this->Form->create('TempOrder'); ?>
	<fieldset>
		<legend><?php echo __('Edit Temp Order'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('address');
		echo $this->Form->input('appt');
		echo $this->Form->input('zip');
		echo $this->Form->input('type');
		echo $this->Form->input('order_date');
		echo $this->Form->input('order_for');
		echo $this->Form->input('order_at');
		echo $this->Form->input('restaurant_id');
		echo $this->Form->input('sub_total');
		echo $this->Form->input('tax');
		echo $this->Form->input('tip');
		echo $this->Form->input('total');
		echo $this->Form->input('promo_code_id');
		echo $this->Form->input('special_instructions');
		echo $this->Form->input('user_id');
		echo $this->Form->input('order_type_id');
		echo $this->Form->input('status');
		echo $this->Form->input('virtual_cafe_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('TempOrder.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('TempOrder.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Temp Orders'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Restaurants'), array('controller' => 'restaurants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Restaurant'), array('controller' => 'restaurants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Promo Codes'), array('controller' => 'promo_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Promo Code'), array('controller' => 'promo_codes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Types'), array('controller' => 'order_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Type'), array('controller' => 'order_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Virtual Caves'), array('controller' => 'virtual_caves', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Virtual Cafe'), array('controller' => 'virtual_caves', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Temp Items'), array('controller' => 'temp_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Temp Item'), array('controller' => 'temp_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
