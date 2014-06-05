<div class="orders index">
	<?php echo $this->Form->create('DeductionAddition'); ?>
	<fieldset>
	<?php
		echo $this->Form->hidden('cities',array('value'=>$city_id)); 
		echo $this->Form->input('cities',array('type'=>'select','empty'=>'All Cities','default'=>$city_id,'disabled'=>true,'label'=>'City')); 
		echo $this->Form->input('restaurant_id',array('type'=>'select','empty'=>'All Restaurants','label'=>'Restaurant'));
		echo '<br>Type:</br></br>';
		echo $this->Form->input('type', array('type'=>'radio','options'=>array('Addition'=>'Addition','Deduction'=>'Deduction'),'legend'=>false));
		echo $this->Form->input('date');
		echo $this->Form->input('amount');
		echo $this->Form->input('reason');
  ?>
	</fieldset>
<?php echo $this->Form->end(__('Save')); ?>

</div>
<div class="actions">
	<h3><?php echo __('Deductions/ Additions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Back to Dashboard'), array('controller'=>'Dashboard','action' => 'index')); ?></li>

	</ul>
</div>