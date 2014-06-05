<div class="cuisines index">
	<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($cuisines as $cuisine): ?>
	<tr>
		<td><?php echo h($cuisine['Cuisine']['name']); ?>&nbsp;</td>
		<td class="line_actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $cuisine['Cuisine']['id']),array('class'=>'btn btn-mini btn-primary')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $cuisine['Cuisine']['id']),array('class'=>'btn btn-mini btn-danger'), __('Are you sure you want to delete cuisine type %s?', $cuisine['Cuisine']['name'])); ?>
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
	<h3><?php echo __('Cuisines'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Add New Cuisine'), array('action' => 'add')); ?></li>
	</ul>
</div>
