<div class="orderVariations index">
	<h2><?php echo __('Order Variations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('order_item_id'); ?></th>
			<th><?php echo $this->Paginator->sort('variation_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($orderVariations as $orderVariation): ?>
	<tr>
		<td><?php echo h($orderVariation['OrderVariation']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($orderVariation['OrderItem']['order_id'], array('controller' => 'order_items', 'action' => 'view', $orderVariation['OrderItem']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($orderVariation['Variation']['name'], array('controller' => 'variations', 'action' => 'view', $orderVariation['Variation']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $orderVariation['OrderVariation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $orderVariation['OrderVariation']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $orderVariation['OrderVariation']['id']), null, __('Are you sure you want to delete # %s?', $orderVariation['OrderVariation']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Order Variation'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Order Items'), array('controller' => 'order_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Item'), array('controller' => 'order_items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Variations'), array('controller' => 'variations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Variation'), array('controller' => 'variations', 'action' => 'add')); ?> </li>
	</ul>
</div>
