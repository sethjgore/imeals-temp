<div class="tempOrders index">
	<h2><?php echo __('Temp Orders'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('appt'); ?></th>
			<th><?php echo $this->Paginator->sort('zip'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('order_date'); ?></th>
			<th><?php echo $this->Paginator->sort('order_for'); ?></th>
			<th><?php echo $this->Paginator->sort('order_at'); ?></th>
			<th><?php echo $this->Paginator->sort('restaurant_id'); ?></th>
			<th><?php echo $this->Paginator->sort('sub_total'); ?></th>
			<th><?php echo $this->Paginator->sort('tax'); ?></th>
			<th><?php echo $this->Paginator->sort('tip'); ?></th>
			<th><?php echo $this->Paginator->sort('total'); ?></th>
			<th><?php echo $this->Paginator->sort('promo_code_id'); ?></th>
			<th><?php echo $this->Paginator->sort('special_instructions'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('order_type_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('virtual_cafe_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($tempOrders as $tempOrder): ?>
	<tr>
		<td><?php echo h($tempOrder['TempOrder']['id']); ?>&nbsp;</td>
		<td><?php echo h($tempOrder['TempOrder']['address']); ?>&nbsp;</td>
		<td><?php echo h($tempOrder['TempOrder']['appt']); ?>&nbsp;</td>
		<td><?php echo h($tempOrder['TempOrder']['zip']); ?>&nbsp;</td>
		<td><?php echo h($tempOrder['TempOrder']['type']); ?>&nbsp;</td>
		<td><?php echo h($tempOrder['TempOrder']['order_date']); ?>&nbsp;</td>
		<td><?php echo h($tempOrder['TempOrder']['order_for']); ?>&nbsp;</td>
		<td><?php echo h($tempOrder['TempOrder']['order_at']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($tempOrder['Restaurant']['name'], array('controller' => 'restaurants', 'action' => 'view', $tempOrder['Restaurant']['id'])); ?>
		</td>
		<td><?php echo h($tempOrder['TempOrder']['sub_total']); ?>&nbsp;</td>
		<td><?php echo h($tempOrder['TempOrder']['tax']); ?>&nbsp;</td>
		<td><?php echo h($tempOrder['TempOrder']['tip']); ?>&nbsp;</td>
		<td><?php echo h($tempOrder['TempOrder']['total']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($tempOrder['PromoCode']['promotion_id'], array('controller' => 'promo_codes', 'action' => 'view', $tempOrder['PromoCode']['id'])); ?>
		</td>
		<td><?php echo h($tempOrder['TempOrder']['special_instructions']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($tempOrder['User']['email'], array('controller' => 'users', 'action' => 'view', $tempOrder['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($tempOrder['OrderType']['name'], array('controller' => 'order_types', 'action' => 'view', $tempOrder['OrderType']['id'])); ?>
		</td>
		<td><?php echo h($tempOrder['TempOrder']['status']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($tempOrder['VirtualCafe']['id'], array('controller' => 'virtual_caves', 'action' => 'view', $tempOrder['VirtualCafe']['id'])); ?>
		</td>
		<td><?php echo h($tempOrder['TempOrder']['created']); ?>&nbsp;</td>
		<td><?php echo h($tempOrder['TempOrder']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $tempOrder['TempOrder']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $tempOrder['TempOrder']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $tempOrder['TempOrder']['id']), null, __('Are you sure you want to delete # %s?', $tempOrder['TempOrder']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Temp Order'), array('action' => 'add')); ?></li>
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
