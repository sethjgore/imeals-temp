<div class="promoCodes view">
<h2><?php  echo __('Promo Code'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($promoCode['PromoCode']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Promotion'); ?></dt>
		<dd>
			<?php echo $this->Html->link($promoCode['Promotion']['name'], array('controller' => 'promotions', 'action' => 'view', $promoCode['Promotion']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Promo Code'), array('action' => 'edit', $promoCode['PromoCode']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Promo Code'), array('action' => 'delete', $promoCode['PromoCode']['id']), null, __('Are you sure you want to delete # %s?', $promoCode['PromoCode']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Promo Codes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Promo Code'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Promotions'), array('controller' => 'promotions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Promotion'), array('controller' => 'promotions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Temp Orders'), array('controller' => 'temp_orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Temp Order'), array('controller' => 'temp_orders', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Orders'); ?></h3>
	<?php if (!empty($promoCode['Order'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Appt'); ?></th>
		<th><?php echo __('Zip'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Order Date'); ?></th>
		<th><?php echo __('Order For'); ?></th>
		<th><?php echo __('Order At'); ?></th>
		<th><?php echo __('Restaurant Id'); ?></th>
		<th><?php echo __('Sub Total'); ?></th>
		<th><?php echo __('Tax'); ?></th>
		<th><?php echo __('Tip'); ?></th>
		<th><?php echo __('Total'); ?></th>
		<th><?php echo __('Promo Code Id'); ?></th>
		<th><?php echo __('Special Instructions'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Order Type Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Virtual Cafe Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($promoCode['Order'] as $order): ?>
		<tr>
			<td><?php echo $order['id']; ?></td>
			<td><?php echo $order['address']; ?></td>
			<td><?php echo $order['appt']; ?></td>
			<td><?php echo $order['zip']; ?></td>
			<td><?php echo $order['type']; ?></td>
			<td><?php echo $order['order_date']; ?></td>
			<td><?php echo $order['order_for']; ?></td>
			<td><?php echo $order['order_at']; ?></td>
			<td><?php echo $order['restaurant_id']; ?></td>
			<td><?php echo $order['sub_total']; ?></td>
			<td><?php echo $order['tax']; ?></td>
			<td><?php echo $order['tip']; ?></td>
			<td><?php echo $order['total']; ?></td>
			<td><?php echo $order['promo_code_id']; ?></td>
			<td><?php echo $order['special_instructions']; ?></td>
			<td><?php echo $order['user_id']; ?></td>
			<td><?php echo $order['order_type_id']; ?></td>
			<td><?php echo $order['status']; ?></td>
			<td><?php echo $order['virtual_cafe_id']; ?></td>
			<td><?php echo $order['created']; ?></td>
			<td><?php echo $order['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'orders', 'action' => 'view', $order['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'orders', 'action' => 'edit', $order['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'orders', 'action' => 'delete', $order['id']), null, __('Are you sure you want to delete # %s?', $order['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Temp Orders'); ?></h3>
	<?php if (!empty($promoCode['TempOrder'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Appt'); ?></th>
		<th><?php echo __('Zip'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Order Date'); ?></th>
		<th><?php echo __('Order For'); ?></th>
		<th><?php echo __('Order At'); ?></th>
		<th><?php echo __('Restaurant Id'); ?></th>
		<th><?php echo __('Sub Total'); ?></th>
		<th><?php echo __('Tax'); ?></th>
		<th><?php echo __('Tip'); ?></th>
		<th><?php echo __('Total'); ?></th>
		<th><?php echo __('Promo Code Id'); ?></th>
		<th><?php echo __('Special Instructions'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Order Type Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Virtual Cafe Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($promoCode['TempOrder'] as $tempOrder): ?>
		<tr>
			<td><?php echo $tempOrder['id']; ?></td>
			<td><?php echo $tempOrder['address']; ?></td>
			<td><?php echo $tempOrder['appt']; ?></td>
			<td><?php echo $tempOrder['zip']; ?></td>
			<td><?php echo $tempOrder['type']; ?></td>
			<td><?php echo $tempOrder['order_date']; ?></td>
			<td><?php echo $tempOrder['order_for']; ?></td>
			<td><?php echo $tempOrder['order_at']; ?></td>
			<td><?php echo $tempOrder['restaurant_id']; ?></td>
			<td><?php echo $tempOrder['sub_total']; ?></td>
			<td><?php echo $tempOrder['tax']; ?></td>
			<td><?php echo $tempOrder['tip']; ?></td>
			<td><?php echo $tempOrder['total']; ?></td>
			<td><?php echo $tempOrder['promo_code_id']; ?></td>
			<td><?php echo $tempOrder['special_instructions']; ?></td>
			<td><?php echo $tempOrder['user_id']; ?></td>
			<td><?php echo $tempOrder['order_type_id']; ?></td>
			<td><?php echo $tempOrder['status']; ?></td>
			<td><?php echo $tempOrder['virtual_cafe_id']; ?></td>
			<td><?php echo $tempOrder['created']; ?></td>
			<td><?php echo $tempOrder['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'temp_orders', 'action' => 'view', $tempOrder['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'temp_orders', 'action' => 'edit', $tempOrder['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'temp_orders', 'action' => 'delete', $tempOrder['id']), null, __('Are you sure you want to delete # %s?', $tempOrder['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Temp Order'), array('controller' => 'temp_orders', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
