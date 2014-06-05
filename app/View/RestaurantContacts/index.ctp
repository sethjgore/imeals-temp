<div class="restaurantContacts index">
	<h2><?php echo __('Restaurant Contacts'); ?></h2>
	<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('restaurant_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('phone'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($restaurantContacts as $restaurantContact): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($restaurantContact['Restaurant']['name'], array('controller' => 'restaurants', 'action' => 'view', $restaurantContact['Restaurant']['id'])); ?>
		</td>
		<td><?php echo h($restaurantContact['RestaurantContact']['name']); ?>&nbsp;</td>
		<td><?php echo h($restaurantContact['RestaurantContact']['title']); ?>&nbsp;</td>
		<td><?php echo h($restaurantContact['RestaurantContact']['phone']); ?>&nbsp;</td>
		<td class="line_actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $restaurantContact['RestaurantContact']['id']),array('class'=>'btn btn-mini')); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $restaurantContact['RestaurantContact']['id']),array('class'=>'btn btn-mini btn-primary')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $restaurantContact['RestaurantContact']['id']),array('class'=>'btn btn-mini btn-danger'), __('Are you sure you want to delete # %s?', $restaurantContact['RestaurantContact']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Restaurant Contact'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Restaurants'), array('controller' => 'restaurants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Restaurant'), array('controller' => 'restaurants', 'action' => 'add')); ?> </li>
	</ul>
</div>
