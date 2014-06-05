<div class="menus index">
	<h2><?php echo __('Menus'); ?></h2>
	<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('restaurant_order_type_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('upsell_y_n'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($menus as $menu): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($menu['RestaurantOrderType']['restaurant_id'], array('controller' => 'restaurant_order_types', 'action' => 'view', $menu['RestaurantOrderType']['id'])); ?>
		</td>
		<td><?php echo h($menu['Menu']['name']); ?>&nbsp;</td>
		<td><?php echo h($menu['Menu']['upsell_y_n']); ?>&nbsp;</td>
		<td><?php echo h($menu['Menu']['active']); ?>&nbsp;</td>
		<td><?php echo h($menu['Menu']['created']); ?>&nbsp;</td>
		<td><?php echo h($menu['Menu']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $menu['Menu']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $menu['Menu']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('controller'=>'menu','action' => 'delete', $menu['Menu']['id']), null, __('Are you sure you want to delete # %s?', $menu['Menu']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Menu'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Menu Hours'), array('controller' => 'menu_hours', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Hour'), array('controller' => 'menu_hours', 'action' => 'add')); ?> </li>
	</ul>
</div>
