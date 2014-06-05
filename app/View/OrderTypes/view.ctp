<div class="orderTypes view">
<h2><?php  echo __('Order Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($orderType['OrderType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($orderType['OrderType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($orderType['OrderType']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($orderType['OrderType']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Order Type'), array('action' => 'edit', $orderType['OrderType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Order Type'), array('action' => 'delete', $orderType['OrderType']['id']), null, __('Are you sure you want to delete # %s?', $orderType['OrderType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Type'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Orders'); ?></h3>
	<?php if (!empty($orderType['Order'])): ?>
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
		foreach ($orderType['Order'] as $order): ?>
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
	<h3><?php echo __('Related Promotions'); ?></h3>
	<?php if (!empty($orderType['Promotion'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Order Type Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($orderType['Promotion'] as $promotion): ?>
		<tr>
			<td><?php echo $promotion['id']; ?></td>
			<td><?php echo $promotion['name']; ?></td>
			<td><?php echo $promotion['order_type_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'promotions', 'action' => 'view', $promotion['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'promotions', 'action' => 'edit', $promotion['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'promotions', 'action' => 'delete', $promotion['id']), null, __('Are you sure you want to delete # %s?', $promotion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Promotion'), array('controller' => 'promotions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Temp Orders'); ?></h3>
	<?php if (!empty($orderType['TempOrder'])): ?>
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
		foreach ($orderType['TempOrder'] as $tempOrder): ?>
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
<div class="related">
	<h3><?php echo __('Related Restaurant Order Types'); ?></h3>
	<?php if (!empty($orderType['RestaurantOrderType'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Restaurant Id'); ?></th>
		<th><?php echo __('Order Type Id'); ?></th>
		<th><?php echo __('Long'); ?></th>
		<th><?php echo __('Lat'); ?></th>
		<th><?php echo __('Radius'); ?></th>
		<th><?php echo __('Delivery Min'); ?></th>
		<th><?php echo __('Delivery Charge'); ?></th>
		<th><?php echo __('Upsell'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($orderType['RestaurantOrderType'] as $restaurantOrderType): ?>
		<tr>
			<td><?php echo $restaurantOrderType['id']; ?></td>
			<td><?php echo $restaurantOrderType['restaurant_id']; ?></td>
			<td><?php echo $restaurantOrderType['order_type_id']; ?></td>
			<td><?php echo $restaurantOrderType['long']; ?></td>
			<td><?php echo $restaurantOrderType['lat']; ?></td>
			<td><?php echo $restaurantOrderType['radius']; ?></td>
			<td><?php echo $restaurantOrderType['delivery_min']; ?></td>
			<td><?php echo $restaurantOrderType['delivery_charge']; ?></td>
			<td><?php echo $restaurantOrderType['upsell']; ?></td>
			<td><?php echo $restaurantOrderType['created']; ?></td>
			<td><?php echo $restaurantOrderType['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'restaurant_order_types', 'action' => 'view', $restaurantOrderType['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'restaurant_order_types', 'action' => 'edit', $restaurantOrderType['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'restaurant_order_types', 'action' => 'delete', $restaurantOrderType['id']), null, __('Are you sure you want to delete # %s?', $restaurantOrderType['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Restaurant Order Type'), array('controller' => 'restaurant_order_types', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
