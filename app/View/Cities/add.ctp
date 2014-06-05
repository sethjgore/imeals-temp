<div class="cities form">
<?php echo $this->Form->create('City'); ?>
	<fieldset>
	<?php
		echo $this->Form->input('City.name',array('label'=>'City Name'));
		echo $this->Form->input('state_id');
		echo $this->Form->input('timezone_id');
		echo $this->Form->input('restaurants_closedindicator',array('label'=>'Show Restaurants Closed Indicator when the number of restaurants available is less than:'));
		echo $this->Form->input('active',array('label'=>'Active'));
		//echo $this->Form->input('User',array('label'=>'City Manager'));
	?>
	<h2>City Manager</h2>
	<?php
		echo $this->Form->input('User.first_name');
		echo $this->Form->input('User.last_name');	
		echo $this->Form->input('User.phone');				
		echo $this->Form->input('User.user_email');
		echo $this->Form->input('User.user_password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Add City'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Cities'), array('action' => 'index')); ?></li>
	</ul>
</div>
