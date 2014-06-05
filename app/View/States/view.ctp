<div class="states view">
<h2><?php  echo __('State'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($state['State']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Full Name'); ?></dt>
		<dd>
			<?php echo h($state['State']['full_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Abbreviation'); ?></dt>
		<dd>
			<?php echo h($state['State']['abbreviation']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit State'), array('action' => 'edit', $state['State']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete State'), array('action' => 'delete', $state['State']['id']), null, __('Are you sure you want to delete # %s?', $state['State']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List States'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New State'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Restaurants'), array('controller' => 'restaurants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Restaurants'), array('controller' => 'restaurants', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Cities'); ?></h3>
	<?php if (!empty($state['City'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('State Id'); ?></th>
		<th><?php echo __('Timezone Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($state['City'] as $city): ?>
		<tr>
			<td><?php echo $city['id']; ?></td>
			<td><?php echo $city['name']; ?></td>
			<td><?php echo $city['state_id']; ?></td>
			<td><?php echo $city['timezone_id']; ?></td>
			<td><?php echo $city['created']; ?></td>
			<td><?php echo $city['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'cities', 'action' => 'view', $city['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'cities', 'action' => 'edit', $city['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'cities', 'action' => 'delete', $city['id']), null, __('Are you sure you want to delete # %s?', $city['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Restaurants'); ?></h3>
	<?php if (!empty($state['Restaurants'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('City Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Logo Url'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Zip'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Deals'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Sales Tax'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('Fax'); ?></th>
		<th><?php echo __('Billing Name'); ?></th>
		<th><?php echo __('Billing Street'); ?></th>
		<th><?php echo __('Billing City'); ?></th>
		<th><?php echo __('Billing State Id'); ?></th>
		<th><?php echo __('Billing Zip'); ?></th>
		<th><?php echo __('Commission'); ?></th>
		<th><?php echo __('Cc Y N'); ?></th>
		<th><?php echo __('Cc Percent'); ?></th>
		<th><?php echo __('Cc Flat Fee'); ?></th>
		<th><?php echo __('Wf Y N'); ?></th>
		<th><?php echo __('Wf Fee Reason'); ?></th>
		<th><?php echo __('Wf Fee Amt'); ?></th>
		<th><?php echo __('Po Pickup'); ?></th>
		<th><?php echo __('Po Delivery'); ?></th>
		<th><?php echo __('Po Phone Alert'); ?></th>
		<th><?php echo __('Po Fax Alert'); ?></th>
		<th><?php echo __('Po Email Alert'); ?></th>
		<th><?php echo __('Me Pickup'); ?></th>
		<th><?php echo __('Me Catering Pickup'); ?></th>
		<th><?php echo __('Me Delivery'); ?></th>
		<th><?php echo __('Me Catering Delivery'); ?></th>
		<th><?php echo __('Me Phone Alert'); ?></th>
		<th><?php echo __('Me Fax Alert'); ?></th>
		<th><?php echo __('Me Email Alert'); ?></th>
		<th><?php echo __('Vc Delivery'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($state['Restaurants'] as $restaurants): ?>
		<tr>
			<td><?php echo $restaurants['id']; ?></td>
			<td><?php echo $restaurants['city_id']; ?></td>
			<td><?php echo $restaurants['name']; ?></td>
			<td><?php echo $restaurants['email']; ?></td>
			<td><?php echo $restaurants['logo_url']; ?></td>
			<td><?php echo $restaurants['address']; ?></td>
			<td><?php echo $restaurants['zip']; ?></td>
			<td><?php echo $restaurants['description']; ?></td>
			<td><?php echo $restaurants['deals']; ?></td>
			<td><?php echo $restaurants['price']; ?></td>
			<td><?php echo $restaurants['sales_tax']; ?></td>
			<td><?php echo $restaurants['phone']; ?></td>
			<td><?php echo $restaurants['fax']; ?></td>
			<td><?php echo $restaurants['billing_name']; ?></td>
			<td><?php echo $restaurants['billing_street']; ?></td>
			<td><?php echo $restaurants['billing_city']; ?></td>
			<td><?php echo $restaurants['billing_state_id']; ?></td>
			<td><?php echo $restaurants['billing_zip']; ?></td>
			<td><?php echo $restaurants['commission']; ?></td>
			<td><?php echo $restaurants['cc_y_n']; ?></td>
			<td><?php echo $restaurants['cc_percent']; ?></td>
			<td><?php echo $restaurants['cc_flat_fee']; ?></td>
			<td><?php echo $restaurants['wf_y_n']; ?></td>
			<td><?php echo $restaurants['wf_fee_reason']; ?></td>
			<td><?php echo $restaurants['wf_fee_amt']; ?></td>
			<td><?php echo $restaurants['po_pickup']; ?></td>
			<td><?php echo $restaurants['po_delivery']; ?></td>
			<td><?php echo $restaurants['po_phone_alert']; ?></td>
			<td><?php echo $restaurants['po_fax_alert']; ?></td>
			<td><?php echo $restaurants['po_email_alert']; ?></td>
			<td><?php echo $restaurants['me_pickup']; ?></td>
			<td><?php echo $restaurants['me_catering_pickup']; ?></td>
			<td><?php echo $restaurants['me_delivery']; ?></td>
			<td><?php echo $restaurants['me_catering_delivery']; ?></td>
			<td><?php echo $restaurants['me_phone_alert']; ?></td>
			<td><?php echo $restaurants['me_fax_alert']; ?></td>
			<td><?php echo $restaurants['me_email_alert']; ?></td>
			<td><?php echo $restaurants['vc_delivery']; ?></td>
			<td><?php echo $restaurants['created']; ?></td>
			<td><?php echo $restaurants['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'restaurants', 'action' => 'view', $restaurants['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'restaurants', 'action' => 'edit', $restaurants['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'restaurants', 'action' => 'delete', $restaurants['id']), null, __('Are you sure you want to delete # %s?', $restaurants['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Restaurants'), array('controller' => 'restaurants', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
