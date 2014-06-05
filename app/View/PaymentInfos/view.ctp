<div class="paymentInfos view">
<h2><?php  echo __('Payment Info'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($paymentInfo['PaymentInfo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($paymentInfo['User']['email'], array('controller' => 'users', 'action' => 'view', $paymentInfo['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payment Type'); ?></dt>
		<dd>
			<?php echo h($paymentInfo['PaymentInfo']['payment_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cc Number'); ?></dt>
		<dd>
			<?php echo h($paymentInfo['PaymentInfo']['cc_number']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cc Expiration Date'); ?></dt>
		<dd>
			<?php echo h($paymentInfo['PaymentInfo']['cc_expiration_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Billing Zip'); ?></dt>
		<dd>
			<?php echo h($paymentInfo['PaymentInfo']['billing_zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cc Security Code'); ?></dt>
		<dd>
			<?php echo h($paymentInfo['PaymentInfo']['cc_security_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($paymentInfo['PaymentInfo']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($paymentInfo['PaymentInfo']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Payment Info'), array('action' => 'edit', $paymentInfo['PaymentInfo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Payment Info'), array('action' => 'delete', $paymentInfo['PaymentInfo']['id']), null, __('Are you sure you want to delete # %s?', $paymentInfo['PaymentInfo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Payment Infos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment Info'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
