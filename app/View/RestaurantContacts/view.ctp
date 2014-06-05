<div class="restaurantContacts view">
<h2><?php  echo __('Restaurant Contact'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($restaurantContact['RestaurantContact']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Restaurant'); ?></dt>
		<dd>
			<?php echo $this->Html->link($restaurantContact['Restaurant']['name'], array('controller' => 'restaurants', 'action' => 'view', $restaurantContact['Restaurant']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($restaurantContact['RestaurantContact']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($restaurantContact['RestaurantContact']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($restaurantContact['RestaurantContact']['phone']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Restaurant Contact'), array('action' => 'edit', $restaurantContact['RestaurantContact']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Restaurant Contact'), array('action' => 'delete', $restaurantContact['RestaurantContact']['id']), null, __('Are you sure you want to delete # %s?', $restaurantContact['RestaurantContact']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Restaurant Contacts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Restaurant Contact'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Restaurants'), array('controller' => 'restaurants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Restaurant'), array('controller' => 'restaurants', 'action' => 'add')); ?> </li>
	</ul>
</div>
