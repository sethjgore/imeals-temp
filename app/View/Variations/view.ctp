<div class="variations view">
<h2><?php  echo __('Variation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($variation['Variation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Variation Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($variation['VariationGroup']['group_name'], array('controller' => 'variation_groups', 'action' => 'view', $variation['VariationGroup']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($variation['Variation']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($variation['Variation']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($variation['Variation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($variation['Variation']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Variation'), array('action' => 'edit', $variation['Variation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Variation'), array('action' => 'delete', $variation['Variation']['id']), null, __('Are you sure you want to delete # %s?', $variation['Variation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Variations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Variation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Variation Groups'), array('controller' => 'variation_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Variation Group'), array('controller' => 'variation_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Temp Variations'), array('controller' => 'temp_variations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Temp Variation'), array('controller' => 'temp_variations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Variations'), array('controller' => 'order_variations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Variation'), array('controller' => 'order_variations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Temp Variations'); ?></h3>
	<?php if (!empty($variation['TempVariation'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Temp Item Id'); ?></th>
		<th><?php echo __('Variation Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($variation['TempVariation'] as $tempVariation): ?>
		<tr>
			<td><?php echo $tempVariation['id']; ?></td>
			<td><?php echo $tempVariation['temp_item_id']; ?></td>
			<td><?php echo $tempVariation['variation_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'temp_variations', 'action' => 'view', $tempVariation['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'temp_variations', 'action' => 'edit', $tempVariation['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'temp_variations', 'action' => 'delete', $tempVariation['id']), null, __('Are you sure you want to delete # %s?', $tempVariation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Temp Variation'), array('controller' => 'temp_variations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Order Variations'); ?></h3>
	<?php if (!empty($variation['OrderVariation'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Order Item Id'); ?></th>
		<th><?php echo __('Variation Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($variation['OrderVariation'] as $orderVariation): ?>
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
