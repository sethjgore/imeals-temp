<div class="promotions form">
<?php echo $this->Form->create('Promotion'); ?>
	<fieldset>
		<legend><?php echo __('Add Promotion / Discount Code'); ?></legend>
	<?php
		echo $this->Form->input('name',array('label'=>'Description'));
		echo $this->Form->input('order_type_id',array('type'=>'select'));
		echo $this->Form->input('frequency',array('type'=>'select','options'=>array('once'=>'One Time','multiple'=>'Multiple'),'empty'=>'Select Frequency of Use'));
		echo $this->Form->input('begin');
		echo $this->Form->input('expire');
		echo $this->Form->input('codes',array('label'=>'Codes <br>(separated <br>by commas)','type'=>'textarea'));
		
		echo '<div class="input number"><label for="PromotionDiscountPercent">Discount Percent</label>';
		echo '<div class="input-append ">';
		echo $this->Form->input('discount_percent',array('div'=>false,'label'=>false));
		echo '<span class="add-on">%</span>';
		echo '</div></div>';
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Promotions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('New Promo Code'), array('controller' => 'promo_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
