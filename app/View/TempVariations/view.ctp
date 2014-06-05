<div class="tempVariations view">
<h2><?php  echo __('Temp Variation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($tempVariation['TempVariation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Temp Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($tempVariation['TempItem']['id'], array('controller' => 'temp_items', 'action' => 'view', $tempVariation['TempItem']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Variation'); ?></dt>
		<dd>
			<?php echo $this->Html->link($tempVariation['Variation']['name'], array('controller' => 'variations', 'action' => 'view', $tempVariation['Variation']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Temp Variation'), array('action' => 'edit', $tempVariation['TempVariation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Temp Variation'), array('action' => 'delete', $tempVariation['TempVariation']['id']), null, __('Are you sure you want to delete # %s?', $tempVariation['TempVariation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Temp Variations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Temp Variation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Temp Items'), array('controller' => 'temp_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Temp Item'), array('controller' => 'temp_items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Variations'), array('controller' => 'variations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Variation'), array('controller' => 'variations', 'action' => 'add')); ?> </li>
	</ul>
</div>
