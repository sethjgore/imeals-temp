<div class="restaurants index">
	<h3><?php if(!isset($city)) echo __($restaurants[0]['City']['name']); else echo 'All Cities' ?> - Active Restaurants</h3>
	<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
	<tr>
			<th style="min-width:50px;">&nbsp;</th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('city_id'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('zip'); ?></th>
			<th><?php echo $this->Paginator->sort('phone'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($restaurants as $restaurant): ?>
	<tr>		
	  
	  <td><img width="50" src="<?php echo Router::url('/',true) . 'files/' . $restaurant['Restaurant']['logo_url']; ?>" alt=""/></td>
		<td><?php echo $this->Html->link(__($restaurant['Restaurant']['name']), array('action' => 'edit', $restaurant['Restaurant']['id'])); ?>
		&nbsp;</td>
		<td>
			<?php echo $this->Html->link($restaurant['City']['name'], array('controller' => 'cities', 'action' => 'view', $restaurant['City']['id'])); ?>
		</td>
		<td><?php echo h($restaurant['Restaurant']['email']); ?>&nbsp;</td>
		<td><?php echo h($restaurant['Restaurant']['address']); ?>&nbsp;</td>
		<td><?php echo h($restaurant['Restaurant']['zip']); ?>&nbsp;</td>
		<td><?php echo h($restaurant['Restaurant']['phone']); ?>&nbsp;</td>
		<td class="line_actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $restaurant['Restaurant']['id']),array('class'=>'btn btn-mini')); ?>
			<?php echo $this->Form->postLink(__('Deactivate'), array('action' => 'deactivate', $restaurant['Restaurant']['id']),array('class'=>'btn btn-mini'), __('Are you sure you want to deactivate %s?', $restaurant['Restaurant']['name'])); ?>
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
	
	<br><br>
	
	<h3>Inactive Restaurants</h3>
  <table class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
	<tr>
			<th style="min-width:50px;">&nbsp;</th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('city_id'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('zip'); ?></th>
			<th><?php echo $this->Paginator->sort('phone'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($inactive_restaurants as $restaurant): ?>
	<tr>		
	  
	  <td><img width="50" src="<?php echo Router::url('/',true) . 'files/' . $restaurant['Restaurant']['logo_url']; ?>" alt=""/></td>
	  
		<td><?php echo $this->Html->link(__($restaurant['Restaurant']['name']), array('action' => 'edit', $restaurant['Restaurant']['id'])); ?>
		&nbsp;</td>
		<td>
			<?php echo $this->Html->link($restaurant['City']['name'], array('controller' => 'cities', 'action' => 'view', $restaurant['City']['id'])); ?>
		</td>
		<td><?php echo h($restaurant['Restaurant']['email']); ?>&nbsp;</td>
		<td><?php echo h($restaurant['Restaurant']['address']); ?>&nbsp;</td>
		<td><?php echo h($restaurant['Restaurant']['zip']); ?>&nbsp;</td>
		<td><?php echo h($restaurant['Restaurant']['phone']); ?>&nbsp;</td>
		<td class="line_actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $restaurant['Restaurant']['id']),array('class'=>'btn btn-mini')); ?>
			<?php echo $this->Form->postLink(__('Activate'), array('action' => 'activate', $restaurant['Restaurant']['id']),array('class'=>'btn btn-mini'), __('Are you sure you want to activate %s?', $restaurant['Restaurant']['name'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>

	
</div>
<div class="actions">
	<h3><?php echo __('Restaurants'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Restaurant'), array('action' => 'add')); ?></li>
	</ul>
</div>
