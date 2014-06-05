<div class="menus view">
<h2><?php  echo __('Menu'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Restaurant Order Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($menu['RestaurantOrderType']['restaurant_id'], array('controller' => 'restaurant_order_types', 'action' => 'view', $menu['RestaurantOrderType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Upsell Y N'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['upsell_y_n']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Menu'), array('action' => 'edit', $menu['Menu']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Menu'), array('action' => 'delete', $menu['Menu']['id']), null, __('Are you sure you want to delete # %s?', $menu['Menu']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Menus'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Restaurant Order Types'), array('controller' => 'restaurant_order_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Restaurant Order Type'), array('controller' => 'restaurant_order_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Menu Hours'), array('controller' => 'menu_hours', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Hour'), array('controller' => 'menu_hours', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Categories'); ?></h3>
	<?php if (!empty($menu['Category'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Menu Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($menu['Category'] as $category): ?>
		<tr>
			<td><?php echo $category['id']; ?></td>
			<td><?php echo $category['menu_id']; ?></td>
			<td><?php echo $category['name']; ?></td>
			<td><?php echo $category['description']; ?></td>
			<td><?php echo $category['created']; ?></td>
			<td><?php echo $category['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'categories', 'action' => 'view', $category['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'categories', 'action' => 'edit', $category['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'categories', 'action' => 'delete', $category['id']), null, __('Are you sure you want to delete # %s?', $category['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Menu Hours'); ?></h3>
	<?php if (!empty($menu['MenuHour'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Menu Id'); ?></th>
		<th><?php echo __('Day'); ?></th>
		<th><?php echo __('Time Open'); ?></th>
		<th><?php echo __('Time Closed'); ?></th>
		<th><?php echo __('Lead Time'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($menu['MenuHour'] as $menuHour): ?>
		<tr>
			<td><?php echo $menuHour['id']; ?></td>
			<td><?php echo $menuHour['menu_id']; ?></td>
			<td><?php echo $menuHour['day']; ?></td>
			<td><?php echo $menuHour['time_open']; ?></td>
			<td><?php echo $menuHour['time_closed']; ?></td>
			<td><?php echo $menuHour['lead_time']; ?></td>
			<td><?php echo $menuHour['created']; ?></td>
			<td><?php echo $menuHour['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'menu_hours', 'action' => 'view', $menuHour['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'menu_hours', 'action' => 'edit', $menuHour['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'menu_hours', 'action' => 'delete', $menuHour['id']), null, __('Are you sure you want to delete # %s?', $menuHour['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Menu Hour'), array('controller' => 'menu_hours', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
