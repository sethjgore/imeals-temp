<div class="cities index">
	<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('state_id'); ?></th>
			<th><?php echo $this->Paginator->sort('timezone_id'); ?></th>
			<th><?php echo $this->Paginator->sort('restaurants_closedindicator'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($cities as $city): ?>
	<tr>
		<td><?php echo h($city['City']['name']); ?>&nbsp;</td>
		<td>
			<?php 
				//echo $this->Html->link($city['State']['full_name'], array('controller' => 'states', 'action' => 'view', $city['State']['id'])); 
				echo $city['State']['full_name'];
			?>
		</td>
		<td>
			<?php 
				//echo $this->Html->link($city['Timezone']['name'], array('controller' => 'timezones', 'action' => 'view', $city['Timezone']['id'])); 
				
				echo $city['Timezone']['name'];
			?>
		</td>
		<td>
			<?php 
				//echo $this->Html->link($city['Timezone']['name'], array('controller' => 'timezones', 'action' => 'view', $city['Timezone']['id'])); 
				
				echo $city['City']['restaurants_closedindicator'];
			?>
		</td>		
		<td class="line_actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $city['City']['id']),array('class'=>'btn btn-mini')); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $city['City']['id']),array('class'=>'btn btn-mini btn-primary')); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $city['City']['id']),array('class'=>'btn btn-mini btn-danger'), __('Are you sure you want to delete # %s?', $city['City']['id'])); ?>
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
	<h3><?php echo __('Cities'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Add City'), array('action' => 'add')); ?></li>
	</ul>
</div>
