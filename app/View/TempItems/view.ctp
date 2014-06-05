<div class="tempItems view">
<h2><?php  echo __('Temp Item'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($tempItem['TempItem']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Temp Order'); ?></dt>
		<dd>
			<?php echo $this->Html->link($tempItem['TempOrder']['id'], array('controller' => 'temp_orders', 'action' => 'view', $tempItem['TempOrder']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($tempItem['Item']['name'], array('controller' => 'items', 'action' => 'view', $tempItem['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($tempItem['TempItem']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Special Instructions'); ?></dt>
		<dd>
			<?php echo h($tempItem['TempItem']['special_instructions']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($tempItem['TempItem']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($tempItem['TempItem']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Temp Item'), array('action' => 'edit', $tempItem['TempItem']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Temp Item'), array('action' => 'delete', $tempItem['TempItem']['id']), null, __('Are you sure you want to delete # %s?', $tempItem['TempItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Temp Items'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Temp Item'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Temp Orders'), array('controller' => 'temp_orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Temp Order'), array('controller' => 'temp_orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Temp Variations'), array('controller' => 'temp_variations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Temp Variation'), array('controller' => 'temp_variations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Temp Variations'); ?></h3>
	<?php if (!empty($tempItem['TempVariation'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Temp Item Id'); ?></th>
		<th><?php echo __('Variation Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($tempItem['TempVariation'] as $tempVariation): ?>
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
