<div class="restaurantContacts form">
<?php echo $this->Form->create('RestaurantContact'); ?>
	<fieldset>
		<legend><?php echo __('Edit Restaurant Contact'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('restaurant_id');
		echo $this->Form->input('name');
		echo $this->Form->input('title');
		echo $this->Form->input('phone');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('RestaurantContact.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('RestaurantContact.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Restaurant Contacts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Restaurants'), array('controller' => 'restaurants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Restaurant'), array('controller' => 'restaurants', 'action' => 'add')); ?> </li>
	</ul>
</div>
