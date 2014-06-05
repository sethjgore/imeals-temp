<div class="paymentInfos form">
<?php echo $this->Form->create('PaymentInfo'); ?>
	<fieldset>
		<legend><?php echo __('Edit Payment Info'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('payment_type');
		echo $this->Form->input('cc_number');
		echo $this->Form->input('cc_expiration_date');
		echo $this->Form->input('billing_zip');
		echo $this->Form->input('cc_security_code');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PaymentInfo.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('PaymentInfo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Payment Infos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
