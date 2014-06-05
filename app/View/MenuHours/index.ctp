<div class="menuHours index">
	<h2><?php echo __('Menu Hours'); ?></h2>
	<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('menu_id'); ?></th>
			<th><?php echo $this->Paginator->sort('day'); ?></th>
			<th><?php echo $this->Paginator->sort('time_open'); ?></th>
			<th><?php echo $this->Paginator->sort('time_closed'); ?></th>
			<th><?php echo $this->Paginator->sort('lead_time'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($menuHours as $menuHour): ?>
	<tr>
		<td><?php echo h($menuHour['MenuHour']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($menuHour['Menu']['name'], array('controller' => 'menus', 'action' => 'view', $menuHour['Menu']['id'])); ?>
		</td>
		<td><?php echo h($menuHour['MenuHour']['day']); ?>&nbsp;</td>
		<td><?php echo h($menuHour['MenuHour']['time_open']); ?>&nbsp;</td>
		<td><?php echo h($menuHour['MenuHour']['time_closed']); ?>&nbsp;</td>
		<td><?php echo h($menuHour['MenuHour']['lead_time']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $menuHour['MenuHour']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $menuHour['MenuHour']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $menuHour['MenuHour']['id']), null, __('Are you sure you want to delete # %s?', $menuHour['MenuHour']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Menu Hour'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Menus'), array('controller' => 'menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu'), array('controller' => 'menus', 'action' => 'add')); ?> </li>
	</ul>
</div>
