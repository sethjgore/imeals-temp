<div class="orderVariations view">
<h2><?php  echo __('Order Variation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($orderVariation['OrderVariation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($orderVariation['OrderItem']['order_id'], array('controller' => 'order_items', 'action' => 'view', $orderVariation['OrderItem']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Variation'); ?></dt>
		<dd>
			<?php echo $this->Html->link($orderVariation['Variation']['name'], array('controller' => 'variations', 'action' => 'view', $orderVariation['Variation']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Order Variation'), array('action' => 'edit', $orderVariation['OrderVariation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Order Variation'), array('action' => 'delete', $orderVariation['OrderVariation']['id']), null, __('Are you sure you want to delete # %s?', $orderVariation['OrderVariation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Variations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Variation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Items'), array('controller' => 'order_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Item'), array('controller' => 'order_items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Variations'), array('controller' => 'variations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Variation'), array('controller' => 'variations', 'action' => 'add')); ?> </li>
	</ul>
</div>
