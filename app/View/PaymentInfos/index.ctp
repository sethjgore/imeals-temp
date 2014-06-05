<div class="paymentInfos index">
	<h2><?php echo __('Payment Infos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('payment_type'); ?></th>
			<th><?php echo $this->Paginator->sort('cc_number'); ?></th>
			<th><?php echo $this->Paginator->sort('cc_expiration_date'); ?></th>
			<th><?php echo $this->Paginator->sort('billing_zip'); ?></th>
			<th><?php echo $this->Paginator->sort('cc_security_code'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($paymentInfos as $paymentInfo): ?>
	<tr>
		<td><?php echo h($paymentInfo['PaymentInfo']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($paymentInfo['User']['email'], array('controller' => 'users', 'action' => 'view', $paymentInfo['User']['id'])); ?>
		</td>
		<td><?php echo h($paymentInfo['PaymentInfo']['payment_type']); ?>&nbsp;</td>
		<td><?php echo h($paymentInfo['PaymentInfo']['cc_number']); ?>&nbsp;</td>
		<td><?php echo h($paymentInfo['PaymentInfo']['cc_expiration_date']); ?>&nbsp;</td>
		<td><?php echo h($paymentInfo['PaymentInfo']['billing_zip']); ?>&nbsp;</td>
		<td><?php echo h($paymentInfo['PaymentInfo']['cc_security_code']); ?>&nbsp;</td>
		<td><?php echo h($paymentInfo['PaymentInfo']['created']); ?>&nbsp;</td>
		<td><?php echo h($paymentInfo['PaymentInfo']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $paymentInfo['PaymentInfo']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $paymentInfo['PaymentInfo']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $paymentInfo['PaymentInfo']['id']), null, __('Are you sure you want to delete # %s?', $paymentInfo['PaymentInfo']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Payment Info'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
