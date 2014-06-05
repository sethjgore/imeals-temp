<div class="cities view">
<h3><?php  echo __('City'); ?></h3>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($city['City']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($city['City']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php //echo $this->Html->link($city['State']['full_name'], array('controller' => 'states', 'action' => 'view', $city['State']['id'])); 
				echo $city['State']['full_name'];
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Timezone'); ?></dt>
		<dd>
			<?php echo $this->Html->link($city['Timezone']['name'], array('controller' => 'timezones', 'action' => 'view', $city['Timezone']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Show Restaurants Closed Indicator when the number of restaurants available is less than:'); ?></dt>
		<dd>
			<?php //echo $this->Html->link($city['State']['full_name'], array('controller' => 'states', 'action' => 'view', $city['State']['id'])); 
				echo $city['City']['restaurants_closedindicator'];
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($city['City']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($city['City']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit City'), array('action' => 'edit', $city['City']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete City'), array('action' => 'delete', $city['City']['id']), null, __('Are you sure you want to delete # %s?', $city['City']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cities'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('action' => 'add')); ?> </li>
	</ul>
</div>
<div class="clear"></div><br><br><br>
<div class="related">
	<h3><?php echo __($city['City']['name'].' Restaurants'); ?></h3>
	<?php if (!empty($city['Restaurant'])): ?>
	<table class="table table-striped table-bordered" cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Logo'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Zip'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('Fax'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($city['Restaurant'] as $restaurant): ?>
		<tr>
			<td><img width="45" src="<?php echo $restaurant['logo_url']; ?>" alt="<?php echo $restaurant['name']; ?>" /></td>
			<td><?php echo $restaurant['name']; ?></td>
			<td><?php echo $restaurant['email']; ?></td>
			<td><?php echo $restaurant['address']; ?></td>
			<td><?php echo $restaurant['zip']; ?></td>
			<td><?php echo $restaurant['phone']; ?></td>
			<td><?php echo $restaurant['fax']; ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Restaurant'), array('controller' => 'restaurants', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="clear"></div><br><br><br>
<div class="related">
	<h3><?php echo __($city['City']['name'] . ' City Managers'); ?></h3>
	<?php if (!empty($city['User'])): ?>
	<table class="table table-striped table-bordered" cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('User Status'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($city['User'] as $user): ?>
		<tr>
			<td><?php echo $user['user_email']; ?></td>
			<td><?php echo $user['first_name']; ?></td>
			<td><?php echo $user['last_name']; ?></td>
			<td><?php echo $user['phone']; ?></td>
			<td><?php if ($user['user_status']) echo 'Active'; else echo 'Inactive'; ?></td>
			<td class="line_actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id']),array('class'=>'btn btn-mini')); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'], $city['City']['id']),array('class'=>'btn btn-mini btn-primary')); ?>
				<?php echo $this->Form->postLink(__('Change Status'), array('controller' => 'users', 'action' => 'delete', $user['id']),array('class'=>'btn btn-mini btn-danger'), __('Are you sure you want to change this users status?')); ?>
			</td>			
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', $city['City']['id'], 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
