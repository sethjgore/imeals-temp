<div class="promotions view">
<h2><?php  echo __('Promotion'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($promotion['Promotion']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($promotion['Promotion']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($promotion['OrderType']['name'], array('controller' => 'order_types', 'action' => 'view', $promotion['OrderType']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Promotion'), array('action' => 'edit', $promotion['Promotion']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Promotion'), array('action' => 'delete', $promotion['Promotion']['id']), null, __('Are you sure you want to delete # %s?', $promotion['Promotion']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Promotions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Promotion'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Types'), array('controller' => 'order_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Type'), array('controller' => 'order_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Promo Codes'), array('controller' => 'promo_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Promo Code'), array('controller' => 'promo_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Promo Codes'); ?></h3>
	<?php if (!empty($promotion['PromoCode'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Promotion Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($promotion['PromoCode'] as $promoCode): ?>
		<tr>
			<td><?php echo $promoCode['id']; ?></td>
			<td><?php echo $promoCode['promotion_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'promo_codes', 'action' => 'view', $promoCode['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'promo_codes', 'action' => 'edit', $promoCode['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'promo_codes', 'action' => 'delete', $promoCode['id']), null, __('Are you sure you want to delete # %s?', $promoCode['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Promo Code'), array('controller' => 'promo_codes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
