<div class="restaurants view">
<div class="floatRight"><?php echo $this->Html->link('<i class="icon-pencil icon-white"></i> Edit', array('controller' => 'restaurants', 'action' => 'edit', $restaurant['Restaurant']['id']),array('class'=>'btn btn-primary','escape' => false)); ?></div>
<h2><?php  echo __($restaurant['Restaurant']['name']); ?></h2>
<div class="clear"></div>
<ul class="nav nav-tabs" id="RestaurantTabs">
  <li class="active"><a href="#general">General</a></li>
  <li><a href="#billing">Billing</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#technical">Technical</a></li>
  <li><a href="#order_types">Order Types</a></li>
  <li><a href="#menus">Menus</a></li>
</ul>
 
<div class="tab-content">
  <div class="tab-pane active" id="general">
      <dl>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo $this->Html->link($restaurant['City']['name'], array('controller' => 'cities', 'action' => 'view', $restaurant['City']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($restaurant['Restaurant']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($restaurant['Restaurant']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($restaurant['Restaurant']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip'); ?></dt>
		<dd>
			<?php echo h($restaurant['Restaurant']['zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($restaurant['Restaurant']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deals'); ?></dt>
		<dd>
			<?php echo h($restaurant['Restaurant']['deals']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($restaurant['Restaurant']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sales Tax'); ?></dt>
		<dd>
			<?php echo h($restaurant['Restaurant']['sales_tax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($restaurant['Restaurant']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fax'); ?></dt>
		<dd>
			<?php echo h($restaurant['Restaurant']['fax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Restaurant Created'); ?></dt>
		<dd>
			<?php echo h($restaurant['Restaurant']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Modified'); ?></dt>
		<dd>
			<?php echo h($restaurant['Restaurant']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Logo Url'); ?></dt>
		<dd>
			<?php echo h($restaurant['Restaurant']['logo_url']); ?>
			&nbsp;
		</dd>
	</dl>

    
  </div>
  <div class="tab-pane" id="billing">
    <dl>
      <dt><?php echo __('Billing Name'); ?></dt>
		<dd>
			<?php echo h($restaurant['Restaurant']['billing_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Billing Street'); ?></dt>
		<dd>
			<?php echo h($restaurant['Restaurant']['billing_street']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Billing City'); ?></dt>
		<dd>
			<?php echo h($restaurant['Restaurant']['billing_city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Billing State'); ?></dt>
		<dd>
			<?php echo $this->Html->link($restaurant['BillingState']['full_name'], array('controller' => 'states', 'action' => 'view', $restaurant['BillingState']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Billing Zip'); ?></dt>
		<dd>
			<?php echo h($restaurant['Restaurant']['billing_zip']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Commission'); ?></dt>
		<dd>
			<?php echo h($restaurant['Restaurant']['commission']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Accepts CC?'); ?></dt>
		<dd>
			<?php echo h(($restaurant['Restaurant']['cc_y_n'] == 1 ? 'Yes' : 'No')); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CC Percent'); ?></dt>
		<dd>
			<?php echo h($restaurant['Restaurant']['cc_percent']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CC Flat Fee'); ?></dt>
		<dd>
			<?php echo h($restaurant['Restaurant']['cc_flat_fee']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Weekly fee'); ?></dt>
		<dd>
			<?php echo h(($restaurant['Restaurant']['wf_y_n'] == 1 ? 'Yes' : 'No')); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Weekly Fee Reason'); ?></dt>
		<dd>
			<?php echo h($restaurant['Restaurant']['wf_fee_reason']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Weekly Fee Amt'); ?></dt>
		<dd>
			<?php echo h($restaurant['Restaurant']['wf_fee_amt']); ?>
			&nbsp;
		</dd>
    </dl>
  </div>
  <div class="tab-pane" id="contact">
     
      <?php 
       if (!empty($contacts[0]['RestaurantContact'])): ?>
      	<table class="table table-striped table-bordered" cellpadding = "0" cellspacing = "0">
      	<tr>
      		<th><?php echo __('Name'); ?></th>
      		<th><?php echo __('Title'); ?></th>
      		<th><?php echo __('Phone'); ?></th>
      		<th class="actions"><?php echo __('Actions'); ?></th>
      	</tr>
      	<?php
      		$i = 0;
      		foreach ($contacts[0]['RestaurantContact'] as $restaurantContact): ?>
      		<tr>
      			<td><?php echo $restaurantContact['name']; ?></td>
      			<td><?php echo $restaurantContact['title']; ?></td>
      			<td><?php echo $restaurantContact['phone']; ?></td>
      			<td class="actions">
      				<?php echo $this->Html->link(__('View'), array('controller' => 'restaurant_contacts', 'action' => 'view', $restaurantContact['id'])); ?>
      				<?php echo $this->Html->link(__('Edit'), array('controller' => 'restaurant_contacts', 'action' => 'edit', $restaurantContact['id'])); ?>
      				<?php echo $this->Form->postLink(__('Deactivate'), array('controller' => 'restaurant_contacts', 'action' => 'deactivate', $restaurantContact['id']), null, __('Are you sure you want to delete # %s?', $restaurantContact['id'])); ?>
      			</td>
      		</tr>
      	<?php endforeach; ?>
      	</table>
      <?php else: ?>
        No Contact.
      <?php endif; ?>

  </div>
  <div class="tab-pane" id="technical">
    Phone Alerts<br><br><br>
      <dt><?php echo __('Personal Order Phone Alert'); ?></dt>
  		<dd>
  			<?php echo h(($restaurant['Restaurant']['po_phone_alert'] == 1 ? 'Yes' : 'No')); ?>
  			&nbsp;
  		</dd>
  		<dt><?php echo __('Meeting & Events Phone Alert'); ?></dt>
  		<dd>
  			<?php echo h(($restaurant['Restaurant']['me_phone_alert'] == 1 ? 'Yes' : 'No')); ?>
  			&nbsp;
  		</dd>
  		<dt><?php echo __('Virtual Cafe Phone Alert'); ?></dt>
  		<dd>
  			<?php echo h(($restaurant['Restaurant']['vc_phone_alert'] == 1 ? 'Yes' : 'No')); ?>
  			&nbsp;
  		</dd>
		<div class="clear"><br><br></div>
		
    Fax Alerts<br><br><br>
    <dt><?php echo __('Personal Order Fax Alert'); ?></dt>
    <dd>
  			<?php echo h(($restaurant['Restaurant']['po_fax_alert'] == 1 ? 'Yes' : 'No')); ?>
  			&nbsp;
    </dd>
    <dt><?php echo __('Meeting & Events Fax Alert'); ?></dt>
		<dd>
			<?php echo h(($restaurant['Restaurant']['me_fax_alert'] == 1 ? 'Yes' : 'No')); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Virtual Cafe Fax Alert'); ?></dt>
		<dd>
			<?php echo h(($restaurant['Restaurant']['vc_fax_alert'] == 1 ? 'Yes' : 'No')); ?>
			&nbsp;
		</dd>
    <div class="clear"><br><br></div>
    
    Email Alerts<br><br><br>
    <dt><?php echo __('Personal Order Email Alert'); ?></dt>
    <dd>
  			<?php echo h(($restaurant['Restaurant']['po_email_alert'] == 1 ? 'Yes' : 'No')); ?>
  			&nbsp;
    </dd>
    <dt><?php echo __('Meeting & Events Email Alert'); ?></dt>
		<dd>
			<?php echo h(($restaurant['Restaurant']['me_email_alert'] == 1 ? 'Yes' : 'No')); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Virtual Cafe Email Alert'); ?></dt>
		<dd>
			<?php echo h(($restaurant['Restaurant']['vc_email_alert'] == 1 ? 'Yes' : 'No')); ?>
			&nbsp;
		</dd>
		
  </div><!-- #technical -->
  <div class="tab-pane" id="order_types">
    <dt><?php echo __('Personal Order Pickup'); ?></dt>
		<dd>
			<?php echo h(($restaurant['Restaurant']['po_pickup'] == 1 ? 'Yes' : 'No')); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Personal Order Delivery'); ?></dt>
		<dd>
			<?php echo h(($restaurant['Restaurant']['po_delivery'] == 1 ? 'Yes' : 'No')); ?>
			&nbsp;
		</dd>
				<dt><?php echo __('Meetings & Events Pickup'); ?></dt>
		<dd>
			<?php echo h(($restaurant['Restaurant']['me_pickup'] == 1 ? 'Yes' : 'No')); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meeting & Events Delivery'); ?></dt>
		<dd>
			<?php echo h(($restaurant['Restaurant']['me_delivery'] == 1 ? 'Yes' : 'No')); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meeting & Events Catering Pickup'); ?></dt>
		<dd>
			<?php echo h(($restaurant['Restaurant']['me_catering_pickup'] == 1 ? 'Yes' : 'No')); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meeting & Events Catering Delivery'); ?></dt>
		<dd>
			<?php echo h(($restaurant['Restaurant']['me_catering_delivery'] == 1 ? 'Yes' : 'No')); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vc Delivery'); ?></dt>
		<dd>
			<?php echo h(($restaurant['Restaurant']['vc_delivery'] == 1 ? 'Yes' : 'No')); ?>
			&nbsp;
		</dd>

    
  </div><!-- #order_types -->
  <div class="tab-pane" id="menus">Menus</div><!-- #menus -->
</div>
<script>
 $('#RestaurantTabs a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
 });
</script>


	</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Restaurant'), array('action' => 'edit', $restaurant['Restaurant']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Restaurant'), array('action' => 'delete', $restaurant['Restaurant']['id']), null, __('Are you sure you want to delete # %s?', $restaurant['Restaurant']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Restaurants'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Restaurant'), array('action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Orders'); ?></h3>
	<?php if (!empty($restaurant['Order'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Appt'); ?></th>
		<th><?php echo __('Zip'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Order Date'); ?></th>
		<th><?php echo __('Order For'); ?></th>
		<th><?php echo __('Order At'); ?></th>
		<th><?php echo __('Restaurant Id'); ?></th>
		<th><?php echo __('Sub Total'); ?></th>
		<th><?php echo __('Tax'); ?></th>
		<th><?php echo __('Tip'); ?></th>
		<th><?php echo __('Total'); ?></th>
		<th><?php echo __('Promo Code Id'); ?></th>
		<th><?php echo __('Special Instructions'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Order Type Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Virtual Cafe Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($restaurant['Order'] as $order): ?>
		<tr>
			<td><?php echo $order['id']; ?></td>
			<td><?php echo $order['address']; ?></td>
			<td><?php echo $order['appt']; ?></td>
			<td><?php echo $order['zip']; ?></td>
			<td><?php echo $order['type']; ?></td>
			<td><?php echo $order['order_date']; ?></td>
			<td><?php echo $order['order_for']; ?></td>
			<td><?php echo $order['order_at']; ?></td>
			<td><?php echo $order['restaurant_id']; ?></td>
			<td><?php echo $order['sub_total']; ?></td>
			<td><?php echo $order['tax']; ?></td>
			<td><?php echo $order['tip']; ?></td>
			<td><?php echo $order['total']; ?></td>
			<td><?php echo $order['promo_code_id']; ?></td>
			<td><?php echo $order['special_instructions']; ?></td>
			<td><?php echo $order['user_id']; ?></td>
			<td><?php echo $order['order_type_id']; ?></td>
			<td><?php echo $order['status']; ?></td>
			<td><?php echo $order['virtual_cafe_id']; ?></td>
			<td><?php echo $order['created']; ?></td>
			<td><?php echo $order['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'orders', 'action' => 'view', $order['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'orders', 'action' => 'edit', $order['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'orders', 'action' => 'delete', $order['id']), null, __('Are you sure you want to delete # %s?', $order['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Restaurant Contacts'); ?></h3>
	<?php if (!empty($restaurant['RestaurantContact'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Restaurant Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($restaurant['RestaurantContact'] as $restaurantContact): ?>
		<tr>
			<td><?php echo $restaurantContact['id']; ?></td>
			<td><?php echo $restaurantContact['restaurant_id']; ?></td>
			<td><?php echo $restaurantContact['name']; ?></td>
			<td><?php echo $restaurantContact['title']; ?></td>
			<td><?php echo $restaurantContact['phone']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'restaurant_contacts', 'action' => 'view', $restaurantContact['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'restaurant_contacts', 'action' => 'edit', $restaurantContact['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'restaurant_contacts', 'action' => 'delete', $restaurantContact['id']), null, __('Are you sure you want to delete # %s?', $restaurantContact['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Restaurant Contact'), array('controller' => 'restaurant_contacts', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Restaurant Order Types'); ?></h3>
	<?php if (!empty($restaurant['RestaurantOrderType'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Restaurant Id'); ?></th>
		<th><?php echo __('Order Type Id'); ?></th>
		<th><?php echo __('Long'); ?></th>
		<th><?php echo __('Lat'); ?></th>
		<th><?php echo __('Radius'); ?></th>
		<th><?php echo __('Delivery Min'); ?></th>
		<th><?php echo __('Delivery Charge'); ?></th>
		<th><?php echo __('Upsell'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($restaurant['RestaurantOrderType'] as $restaurantOrderType): ?>
		<tr>
			<td><?php echo $restaurantOrderType['id']; ?></td>
			<td><?php echo $restaurantOrderType['restaurant_id']; ?></td>
			<td><?php echo $restaurantOrderType['order_type_id']; ?></td>
			<td><?php echo $restaurantOrderType['long']; ?></td>
			<td><?php echo $restaurantOrderType['lat']; ?></td>
			<td><?php echo $restaurantOrderType['radius']; ?></td>
			<td><?php echo $restaurantOrderType['delivery_min']; ?></td>
			<td><?php echo $restaurantOrderType['delivery_charge']; ?></td>
			<td><?php echo $restaurantOrderType['upsell']; ?></td>
			<td><?php echo $restaurantOrderType['created']; ?></td>
			<td><?php echo $restaurantOrderType['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'restaurant_order_types', 'action' => 'view', $restaurantOrderType['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'restaurant_order_types', 'action' => 'edit', $restaurantOrderType['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'restaurant_order_types', 'action' => 'delete', $restaurantOrderType['id']), null, __('Are you sure you want to delete # %s?', $restaurantOrderType['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Restaurant Order Type'), array('controller' => 'restaurant_order_types', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Temp Orders'); ?></h3>
	<?php if (!empty($restaurant['TempOrder'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Appt'); ?></th>
		<th><?php echo __('Zip'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Order Date'); ?></th>
		<th><?php echo __('Order For'); ?></th>
		<th><?php echo __('Order At'); ?></th>
		<th><?php echo __('Restaurant Id'); ?></th>
		<th><?php echo __('Sub Total'); ?></th>
		<th><?php echo __('Tax'); ?></th>
		<th><?php echo __('Tip'); ?></th>
		<th><?php echo __('Total'); ?></th>
		<th><?php echo __('Promo Code Id'); ?></th>
		<th><?php echo __('Special Instructions'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Order Type Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Virtual Cafe Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($restaurant['TempOrder'] as $tempOrder): ?>
		<tr>
			<td><?php echo $tempOrder['id']; ?></td>
			<td><?php echo $tempOrder['address']; ?></td>
			<td><?php echo $tempOrder['appt']; ?></td>
			<td><?php echo $tempOrder['zip']; ?></td>
			<td><?php echo $tempOrder['type']; ?></td>
			<td><?php echo $tempOrder['order_date']; ?></td>
			<td><?php echo $tempOrder['order_for']; ?></td>
			<td><?php echo $tempOrder['order_at']; ?></td>
			<td><?php echo $tempOrder['restaurant_id']; ?></td>
			<td><?php echo $tempOrder['sub_total']; ?></td>
			<td><?php echo $tempOrder['tax']; ?></td>
			<td><?php echo $tempOrder['tip']; ?></td>
			<td><?php echo $tempOrder['total']; ?></td>
			<td><?php echo $tempOrder['promo_code_id']; ?></td>
			<td><?php echo $tempOrder['special_instructions']; ?></td>
			<td><?php echo $tempOrder['user_id']; ?></td>
			<td><?php echo $tempOrder['order_type_id']; ?></td>
			<td><?php echo $tempOrder['status']; ?></td>
			<td><?php echo $tempOrder['virtual_cafe_id']; ?></td>
			<td><?php echo $tempOrder['created']; ?></td>
			<td><?php echo $tempOrder['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'temp_orders', 'action' => 'view', $tempOrder['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'temp_orders', 'action' => 'edit', $tempOrder['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'temp_orders', 'action' => 'delete', $tempOrder['id']), null, __('Are you sure you want to delete # %s?', $tempOrder['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Temp Order'), array('controller' => 'temp_orders', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Cuisines'); ?></h3>
	<?php if (!empty($restaurant['Cuisine'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($restaurant['Cuisine'] as $cuisine): ?>
		<tr>
			<td><?php echo $cuisine['id']; ?></td>
			<td><?php echo $cuisine['name']; ?></td>
			<td><?php echo $cuisine['created']; ?></td>
			<td><?php echo $cuisine['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'cuisines', 'action' => 'view', $cuisine['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'cuisines', 'action' => 'edit', $cuisine['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'cuisines', 'action' => 'delete', $cuisine['id']), null, __('Are you sure you want to delete # %s?', $cuisine['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Cuisine'), array('controller' => 'cuisines', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($restaurant['User'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($restaurant['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['email']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['first_name']; ?></td>
			<td><?php echo $user['last_name']; ?></td>
			<td><?php echo $user['phone']; ?></td>
			<td><?php echo $user['created']; ?></td>
			<td><?php echo $user['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
