<div class="restaurants index">
	<h2><?php echo __('Restaurants'); ?></h2>
	<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('city_id'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('zip'); ?></th>
			<th><?php echo $this->Paginator->sort('phone'); ?></th>
			<th><?php echo $this->Paginator->sort('fax'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($restaurants as $restaurant): ?>
	<tr>		
		<td><?php echo $this->Html->link($restaurant['Restaurant']['name'], array('controller' => 'restaurants', 'action' => 'edit', $restaurant['Restaurant']['id'])); ?>
		<td>
			<?php echo $this->Html->link($restaurant['City']['name'], array('controller' => 'cities', 'action' => 'view', $restaurant['City']['id'])); ?>
		</td>
		<td><?php echo h($restaurant['Restaurant']['email']); ?>&nbsp;</td>
		<td><?php echo h($restaurant['Restaurant']['address']); ?>&nbsp;</td>
		<td><?php echo h($restaurant['Restaurant']['zip']); ?>&nbsp;</td>
		<td><?php echo h($restaurant['Restaurant']['phone']); ?>&nbsp;</td>
		<td><?php echo h($restaurant['Restaurant']['fax']); ?>&nbsp;</td>
		<td class="line_actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $restaurant['Restaurant']['id']),array('class'=>'btn btn-mini btn-primary')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $restaurant['Restaurant']['id']),array('class'=>'btn btn-mini btn-danger'), __('Are you sure you want to delete # %s?', $restaurant['Restaurant']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Restaurant'), array('action' => 'add')); ?></li>
	</ul>
</div>
