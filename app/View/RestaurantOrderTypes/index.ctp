<div class="restaurantOrderTypes index">
	<h2><?php echo __('Restaurant Order Types'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('restaurant_id'); ?></th>
			<th><?php echo $this->Paginator->sort('order_type_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($restaurantOrderTypes as $restaurantOrderType): ?>
	<tr>
		<td><?php echo h($restaurantOrderType['RestaurantOrderType']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($restaurantOrderType['Restaurant']['name'], array('controller' => 'restaurants', 'action' => 'view', $restaurantOrderType['Restaurant']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($restaurantOrderType['OrderType']['name'], array('controller' => 'order_types', 'action' => 'view', $restaurantOrderType['OrderType']['id'])); ?>
		</td>
		<td><?php echo h($restaurantOrderType['RestaurantOrderType']['created']); ?>&nbsp;</td>
		<td><?php echo h($restaurantOrderType['RestaurantOrderType']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $restaurantOrderType['RestaurantOrderType']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $restaurantOrderType['RestaurantOrderType']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $restaurantOrderType['RestaurantOrderType']['id']), null, __('Are you sure you want to delete # %s?', $restaurantOrderType['RestaurantOrderType']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Restaurant Order Type'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Restaurants'), array('controller' => 'restaurants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Restaurant'), array('controller' => 'restaurants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Types'), array('controller' => 'order_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Type'), array('controller' => 'order_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Menus'), array('controller' => 'menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu'), array('controller' => 'menus', 'action' => 'add')); ?> </li>
	</ul>
</div>
