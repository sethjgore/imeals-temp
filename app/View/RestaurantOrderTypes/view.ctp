<div class="restaurantOrderTypes view">
<h2><?php  echo __('Restaurant Order Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($restaurantOrderType['RestaurantOrderType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Restaurant'); ?></dt>
		<dd>
			<?php echo $this->Html->link($restaurantOrderType['Restaurant']['name'], array('controller' => 'restaurants', 'action' => 'view', $restaurantOrderType['Restaurant']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($restaurantOrderType['OrderType']['name'], array('controller' => 'order_types', 'action' => 'view', $restaurantOrderType['OrderType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Long'); ?></dt>
		<dd>
			<?php echo h($restaurantOrderType['RestaurantOrderType']['long']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lat'); ?></dt>
		<dd>
			<?php echo h($restaurantOrderType['RestaurantOrderType']['lat']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Radius'); ?></dt>
		<dd>
			<?php echo h($restaurantOrderType['RestaurantOrderType']['radius']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Delivery Min'); ?></dt>
		<dd>
			<?php echo h($restaurantOrderType['RestaurantOrderType']['delivery_min']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Delivery Charge'); ?></dt>
		<dd>
			<?php echo h($restaurantOrderType['RestaurantOrderType']['delivery_charge']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Upsell'); ?></dt>
		<dd>
			<?php echo h($restaurantOrderType['RestaurantOrderType']['upsell']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($restaurantOrderType['RestaurantOrderType']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($restaurantOrderType['RestaurantOrderType']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Restaurant Order Type'), array('action' => 'edit', $restaurantOrderType['RestaurantOrderType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Restaurant Order Type'), array('action' => 'delete', $restaurantOrderType['RestaurantOrderType']['id']), null, __('Are you sure you want to delete # %s?', $restaurantOrderType['RestaurantOrderType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Restaurant Order Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Restaurant Order Type'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Restaurants'), array('controller' => 'restaurants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Restaurant'), array('controller' => 'restaurants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Types'), array('controller' => 'order_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Type'), array('controller' => 'order_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Menus'), array('controller' => 'menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu'), array('controller' => 'menus', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Menus'); ?></h3>
	<?php if (!empty($restaurantOrderType['Menu'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Restaurant Order Type Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Upsell Y N'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($restaurantOrderType['Menu'] as $menu): ?>
		<tr>
			<td><?php echo $menu['id']; ?></td>
			<td><?php echo $menu['restaurant_order_type_id']; ?></td>
			<td><?php echo $menu['name']; ?></td>
			<td><?php echo $menu['upsell_y_n']; ?></td>
			<td><?php echo $menu['active']; ?></td>
			<td><?php echo $menu['created']; ?></td>
			<td><?php echo $menu['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'menus', 'action' => 'view', $menu['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'menus', 'action' => 'edit', $menu['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'menus', 'action' => 'delete', $menu['id']), null, __('Are you sure you want to delete # %s?', $menu['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Menu'), array('controller' => 'menus', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
