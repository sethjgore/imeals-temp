<div class="items view">
<h2><?php  echo __('Item'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($item['Item']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($item['Category']['name'], array('controller' => 'categories', 'action' => 'view', $item['Category']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($item['Item']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($item['Item']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($item['Item']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Photo Url'); ?></dt>
		<dd>
			<?php echo h($item['Item']['photo_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($item['Item']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($item['Item']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Item'), array('action' => 'edit', $item['Item']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Item'), array('action' => 'delete', $item['Item']['id']), null, __('Are you sure you want to delete # %s?', $item['Item']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Variation Groups'), array('controller' => 'variation_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Variation Group'), array('controller' => 'variation_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Temp Items'), array('controller' => 'temp_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Temp Item'), array('controller' => 'temp_items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Items'), array('controller' => 'order_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Item'), array('controller' => 'order_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Variation Groups'); ?></h3>
	<?php if (!empty($item['VariationGroup'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Item Id'); ?></th>
		<th><?php echo __('Group Name'); ?></th>
		<th><?php echo __('Chose Amt'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['VariationGroup'] as $variationGroup): ?>
		<tr>
			<td><?php echo $variationGroup['id']; ?></td>
			<td><?php echo $variationGroup['item_id']; ?></td>
			<td><?php echo $variationGroup['group_name']; ?></td>
			<td><?php echo $variationGroup['chose_amt']; ?></td>
			<td><?php echo $variationGroup['created']; ?></td>
			<td><?php echo $variationGroup['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'variation_groups', 'action' => 'view', $variationGroup['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'variation_groups', 'action' => 'edit', $variationGroup['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'variation_groups', 'action' => 'delete', $variationGroup['id']), null, __('Are you sure you want to delete # %s?', $variationGroup['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Variation Group'), array('controller' => 'variation_groups', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Temp Items'); ?></h3>
	<?php if (!empty($item['TempItem'])): ?>
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
		foreach ($item['TempItem'] as $tempItem): ?>
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
<div class="related">
	<h3><?php echo __('Related Order Items'); ?></h3>
	<?php if (!empty($item['OrderItem'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Order Id'); ?></th>
		<th><?php echo __('Item Id'); ?></th>
		<th><?php echo __('Quantity'); ?></th>
		<th><?php echo __('Special Instructions'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($item['OrderItem'] as $orderItem): ?>
		<tr>
			<td><?php echo $orderItem['id']; ?></td>
			<td><?php echo $orderItem['order_id']; ?></td>
			<td><?php echo $orderItem['item_id']; ?></td>
			<td><?php echo $orderItem['quantity']; ?></td>
			<td><?php echo $orderItem['special_instructions']; ?></td>
			<td><?php echo $orderItem['created']; ?></td>
			<td><?php echo $orderItem['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'order_items', 'action' => 'view', $orderItem['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'order_items', 'action' => 'edit', $orderItem['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'order_items', 'action' => 'delete', $orderItem['id']), null, __('Are you sure you want to delete # %s?', $orderItem['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Order Item'), array('controller' => 'order_items', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
