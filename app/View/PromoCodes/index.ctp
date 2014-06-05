<div class="promoCodes index">
	<h2><?php echo __('Active Codes'); ?></h2>
	<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('promotion_id'); ?></th>
			<th><?php echo $this->Paginator->sort('code','Promo Code'); ?></th>
			<th><?php echo $this->Paginator->sort('used_count'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($promoCodes as $promoCode): ?>
	<tr>
		<td><?php echo h($promoCode['PromoCode']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($promoCode['Promotion']['name'], array('controller' => 'promotions', 'action' => 'view', $promoCode['Promotion']['id'])); ?>
		</td>
		<td><?php echo h($promoCode['PromoCode']['code']); ?>&nbsp;</td>
		<td><?php echo h($promoCode['PromoCode']['used_count']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $promoCode['PromoCode']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $promoCode['PromoCode']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $promoCode['PromoCode']['id']), null, __('Are you sure you want to delete # %s?', $promoCode['PromoCode']['id'])); ?>
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
	<h3><?php echo __('Promo Codes'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Promo Code'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Promotions'), array('controller' => 'promotions', 'action' => 'index')); ?> </li>
	</ul>
</div>
