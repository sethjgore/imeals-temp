<div class="menuHours view">
<h2><?php  echo __('Menu Hour'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($menuHour['MenuHour']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Menu'); ?></dt>
		<dd>
			<?php echo $this->Html->link($menuHour['Menu']['name'], array('controller' => 'menus', 'action' => 'view', $menuHour['Menu']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Day'); ?></dt>
		<dd>
			<?php echo h($menuHour['MenuHour']['day']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Time Open'); ?></dt>
		<dd>
			<?php echo h($menuHour['MenuHour']['time_open']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Time Closed'); ?></dt>
		<dd>
			<?php echo h($menuHour['MenuHour']['time_closed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lead Time'); ?></dt>
		<dd>
			<?php echo h($menuHour['MenuHour']['lead_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($menuHour['MenuHour']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($menuHour['MenuHour']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Menu Hour'), array('action' => 'edit', $menuHour['MenuHour']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Menu Hour'), array('action' => 'delete', $menuHour['MenuHour']['id']), null, __('Are you sure you want to delete # %s?', $menuHour['MenuHour']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Menu Hours'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu Hour'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Menus'), array('controller' => 'menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu'), array('controller' => 'menus', 'action' => 'add')); ?> </li>
	</ul>
</div>
