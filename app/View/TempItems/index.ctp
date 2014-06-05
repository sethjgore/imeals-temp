<div class="tempItems index">
	<h2><?php echo __('Temp Items'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('temp_order_id'); ?></th>
			<th><?php echo $this->Paginator->sort('item_id'); ?></th>
			<th><?php echo $this->Paginator->sort('quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('special_instructions'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($tempItems as $tempItem): ?>
	<tr>
		<td><?php echo h($tempItem['TempItem']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($tempItem['TempOrder']['id'], array('controller' => 'temp_orders', 'action' => 'view', $tempItem['TempOrder']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($tempItem['Item']['name'], array('controller' => 'items', 'action' => 'view', $tempItem['Item']['id'])); ?>
		</td>
		<td><?php echo h($tempItem['TempItem']['quantity']); ?>&nbsp;</td>
		<td><?php echo h($tempItem['TempItem']['special_instructions']); ?>&nbsp;</td>
		<td><?php echo h($tempItem['TempItem']['created']); ?>&nbsp;</td>
		<td><?php echo h($tempItem['TempItem']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $tempItem['TempItem']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $tempItem['TempItem']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $tempItem['TempItem']['id']), null, __('Are you sure you want to delete # %s?', $tempItem['TempItem']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Temp Item'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Temp Orders'), array('controller' => 'temp_orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Temp Order'), array('controller' => 'temp_orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Temp Variations'), array('controller' => 'temp_variations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Temp Variation'), array('controller' => 'temp_variations', 'action' => 'add')); ?> </li>
	</ul>
</div>
