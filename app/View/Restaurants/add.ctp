<div class="restaurants form">
<?php echo $this->Form->create('Restaurant',array('enctype' => 'multipart/form-data')); ?>
  <?php if(isset($error)) echo $error; ?>
	<fieldset>
		<legend><?php echo __('Add Restaurant'); ?></legend>
		<ul class="nav nav-tabs" id="RestaurantTabs">
    <li class="active"><a href="#general">General</a></li>
    <li><a href="#" class="deactive">Billing</a></li>
    <li><a href="#" class="deactive">Contact</a></li>
    <li><a href="#" class="deactive">Technical</a></li>
    <li><a href="#" class="deactive">Order Types</a></li>
    <li><a href="#" class="deactive">Menus</a></li>
  </ul>
	<?php
		echo $this->Form->input('city_id');
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo '<input type="hidden" name="MAX_FILE_SIZE" value="32000000" />';
		echo $this->Form->input('logo_file',array('type' => 'file'));  
		echo $this->Form->input('address');
		echo $this->Form->input('zip');
		echo $this->Form->input('description');
		echo $this->Form->input('Cuisine');

		echo '<div class="input number"><label for="RestaurantDeals">First Time Deal</label>';
		echo '<div class="input-append">';
		echo $this->Form->input('deals',array('div'=>false,'label'=>false));
		echo '<span class="add-on">%</span>';
		echo '</div></div>';
		
		echo '<div class="input number"><label for="RestaurantPrice">Price</label>';
		echo '<div class="input-prepend">';
		echo '<span class="add-on">($ to $$$$)</span>';
		echo $this->Form->input('price',array('div'=>false,'label'=>false));
		echo '</div></div>';
		
				
		echo '<div class="input number"><label for="RestaurantSalesTax">Sales Tax</label>';
		echo '<div class="input-append">';
		echo $this->Form->input('sales_tax',array('div'=>false,'label'=>false));
		echo '<span class="add-on">%</span>';
		echo '</div></div>';

		echo $this->Form->input('phone');
		echo $this->Form->input('fax');		
		echo $this->Form->input('User.user_email');
		echo $this->Form->input('User.user_password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Next')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Restaurants'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Restaurants'), array('action' => 'index')); ?></li>
	</ul>
</div>