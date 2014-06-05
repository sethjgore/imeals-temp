<?php $promotions = $this->request->data; ?>

<div class="promotions form">
<?php echo $this->Form->create('Promotion'); ?>
	<fieldset>
		<legend><?php echo __('Edit Promotion'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('label'=>'Description'));
		echo $this->Form->input('order_type_id',array('type'=>'select'));
		echo $this->Form->input('frequency',array('type'=>'select','options'=>array('once'=>'One Time','multiple'=>'Multiple'),'empty'=>'Select Frequency of Use'));
		echo $this->Form->input('begin');
		echo $this->Form->input('expire');
		
		$i=0;
		foreach($promotions['PromoCode'] as $promocode):
		  echo $this->Form->input('PromoCode.'.$i.'.id',array('value'=>$promocode['id']));
		  echo $this->Form->input('PromoCode.'.$i.'.code',array('value'=>$promocode['code']));
		  $i++;
		endforeach;
		echo $this->Form->input('add_more_codes',array('type'=>'textarea','label'=>'Add More<br>Codes<br>(Seperated By <br>Commas)'));
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
	</ul>
</div>
