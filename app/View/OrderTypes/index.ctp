<div class="orderTypes index">
	<h2><?php echo __('Order Types'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($orderTypes as $orderType): ?>
	<tr>
		<td><?php echo h($orderType['OrderType']['id']); ?>&nbsp;</td>
		<td><?php echo h($orderType['OrderType']['name']); ?>&nbsp;</td>
		<td><?php echo h($orderType['OrderType']['created']); ?>&nbsp;</td>
		<td><?php echo h($orderType['OrderType']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $orderType['OrderType']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $orderType['OrderType']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $orderType['OrderType']['id']), null, __('Are you sure you want to delete # %s?', $orderType['OrderType']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Order Type'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Promotions'), array('controller' => 'promotions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Promotion'), array('controller' => 'promotions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Temp Orders'), array('controller' => 'temp_orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Temp Order'), array('controller' => 'temp_orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Restaurant Order Types'), array('controller' => 'restaurant_order_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Restaurant Order Type'), array('controller' => 'restaurant_order_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
