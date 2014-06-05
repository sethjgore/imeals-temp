<div class="tempVariations index">
	<h2><?php echo __('Temp Variations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('temp_item_id'); ?></th>
			<th><?php echo $this->Paginator->sort('variation_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($tempVariations as $tempVariation): ?>
	<tr>
		<td><?php echo h($tempVariation['TempVariation']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($tempVariation['TempItem']['id'], array('controller' => 'temp_items', 'action' => 'view', $tempVariation['TempItem']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($tempVariation['Variation']['name'], array('controller' => 'variations', 'action' => 'view', $tempVariation['Variation']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $tempVariation['TempVariation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $tempVariation['TempVariation']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $tempVariation['TempVariation']['id']), null, __('Are you sure you want to delete # %s?', $tempVariation['TempVariation']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Temp Variation'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Temp Items'), array('controller' => 'temp_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Temp Item'), array('controller' => 'temp_items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Variations'), array('controller' => 'variations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Variation'), array('controller' => 'variations', 'action' => 'add')); ?> </li>
	</ul>
</div>
