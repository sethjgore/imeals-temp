<div class="orderItems view">
<h2><?php  echo __('Order Item'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($orderItem['OrderItem']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order'); ?></dt>
		<dd>
			<?php echo $this->Html->link($orderItem['Order']['id'], array('controller' => 'orders', 'action' => 'view', $orderItem['Order']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($orderItem['Item']['name'], array('controller' => 'items', 'action' => 'view', $orderItem['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($orderItem['OrderItem']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Special Instructions'); ?></dt>
		<dd>
			<?php echo h($orderItem['OrderItem']['special_instructions']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($orderItem['OrderItem']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($orderItem['OrderItem']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Order Item'), array('action' => 'edit', $orderItem['OrderItem']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Order Item'), array('action' => 'delete', $orderItem['OrderItem']['id']), null, __('Are you sure you want to delete # %s?', $orderItem['OrderItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Items'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Item'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Variations'), array('controller' => 'order_variations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Variation'), array('controller' => 'order_variations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Order Variations'); ?></h3>
	<?php if (!empty($orderItem['OrderVariation'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Order Item Id'); ?></th>
		<th><?php echo __('Variation Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($orderItem['OrderVariation'] as $orderVariation): ?>
		<tr>
			<td><?php echo $orderVariation['id']; ?></td>
			<td><?php echo $orderVariation['order_item_id']; ?></td>
			<td><?php echo $orderVariation['variation_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'order_variations', 'action' => 'view', $orderVariation['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'order_variations', 'action' => 'edit', $orderVariation['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'order_variations', 'action' => 'delete', $orderVariation['id']), null, __('Are you sure you want to delete # %s?', $orderVariation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Order Variation'), array('controller' => 'order_variations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
