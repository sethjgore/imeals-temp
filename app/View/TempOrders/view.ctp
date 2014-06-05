<div class="tempOrders view">
<h2><?php  echo __('Temp Order'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($tempOrder['TempOrder']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($tempOrder['TempOrder']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Appt'); ?></dt>
		<dd>
			<?php echo h($tempOrder['TempOrder']['appt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip'); ?></dt>
		<dd>
			<?php echo h($tempOrder['TempOrder']['zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($tempOrder['TempOrder']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order Date'); ?></dt>
		<dd>
			<?php echo h($tempOrder['TempOrder']['order_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order For'); ?></dt>
		<dd>
			<?php echo h($tempOrder['TempOrder']['order_for']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order At'); ?></dt>
		<dd>
			<?php echo h($tempOrder['TempOrder']['order_at']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Restaurant'); ?></dt>
		<dd>
			<?php echo $this->Html->link($tempOrder['Restaurant']['name'], array('controller' => 'restaurants', 'action' => 'view', $tempOrder['Restaurant']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sub Total'); ?></dt>
		<dd>
			<?php echo h($tempOrder['TempOrder']['sub_total']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tax'); ?></dt>
		<dd>
			<?php echo h($tempOrder['TempOrder']['tax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tip'); ?></dt>
		<dd>
			<?php echo h($tempOrder['TempOrder']['tip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total'); ?></dt>
		<dd>
			<?php echo h($tempOrder['TempOrder']['total']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Promo Code'); ?></dt>
		<dd>
			<?php echo $this->Html->link($tempOrder['PromoCode']['promotion_id'], array('controller' => 'promo_codes', 'action' => 'view', $tempOrder['PromoCode']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Special Instructions'); ?></dt>
		<dd>
			<?php echo h($tempOrder['TempOrder']['special_instructions']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($tempOrder['User']['email'], array('controller' => 'users', 'action' => 'view', $tempOrder['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($tempOrder['OrderType']['name'], array('controller' => 'order_types', 'action' => 'view', $tempOrder['OrderType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($tempOrder['TempOrder']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Virtual Cafe'); ?></dt>
		<dd>
			<?php echo $this->Html->link($tempOrder['VirtualCafe']['id'], array('controller' => 'virtual_caves', 'action' => 'view', $tempOrder['VirtualCafe']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($tempOrder['TempOrder']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($tempOrder['TempOrder']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Temp Order'), array('action' => 'edit', $tempOrder['TempOrder']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Temp Order'), array('action' => 'delete', $tempOrder['TempOrder']['id']), null, __('Are you sure you want to delete # %s?', $tempOrder['TempOrder']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Temp Orders'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Temp Order'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Temp Items'); ?></h3>
	<?php if (!empty($tempOrder['TempItem'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Temp Order Id'); ?></th>
		<th><?php echo __('Item Id'); ?></th>
		<th><?php echo __('Quantity'); ?></th>
		<th><?php echo __('Special Instructions'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($tempOrder['TempItem'] as $tempItem): ?>
		<tr>
			<td><?php echo $tempItem['id']; ?></td>
			<td><?php echo $tempItem['temp_order_id']; ?></td>
			<td><?php echo $tempItem['item_id']; ?></td>
			<td><?php echo $tempItem['quantity']; ?></td>
			<td><?php echo $tempItem['special_instructions']; ?></td>
			<td><?php echo $tempItem['created']; ?></td>
			<td><?php echo $tempItem['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'temp_items', 'action' => 'view', $tempItem['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'temp_items', 'action' => 'edit', $tempItem['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'temp_items', 'action' => 'delete', $tempItem['id']), null, __('Are you sure you want to delete # %s?', $tempItem['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Temp Item'), array('controller' => 'temp_items', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
