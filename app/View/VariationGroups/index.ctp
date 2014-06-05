<div class="variationGroups index">
	<h2><?php echo __('Variation Groups'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('item_id'); ?></th>
			<th><?php echo $this->Paginator->sort('group_name'); ?></th>
			<th><?php echo $this->Paginator->sort('num_choices'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($variationGroups as $variationGroup): ?>
	<tr>
		<td><?php echo h($variationGroup['VariationGroup']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($variationGroup['Item']['name'], array('controller' => 'items', 'action' => 'view', $variationGroup['Item']['id'])); ?>
		</td>
		<td><?php echo h($variationGroup['VariationGroup']['group_name']); ?>&nbsp;</td>
		<td><?php echo h($variationGroup['VariationGroup']['num_choices']); ?>&nbsp;</td>
		<td><?php echo h($variationGroup['VariationGroup']['created']); ?>&nbsp;</td>
		<td><?php echo h($variationGroup['VariationGroup']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $variationGroup['VariationGroup']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $variationGroup['VariationGroup']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $variationGroup['VariationGroup']['id']), null, __('Are you sure you want to delete # %s?', $variationGroup['VariationGroup']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Variation Group'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Variations'), array('controller' => 'variations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Variation'), array('controller' => 'variations', 'action' => 'add')); ?> </li>
	</ul>
</div>
