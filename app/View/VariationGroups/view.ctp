<div class="variationGroups view">
<h2><?php  echo __('Variation Group'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($variationGroup['VariationGroup']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($variationGroup['Item']['name'], array('controller' => 'items', 'action' => 'view', $variationGroup['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group Name'); ?></dt>
		<dd>
			<?php echo h($variationGroup['VariationGroup']['group_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Chose Amt'); ?></dt>
		<dd>
			<?php echo h($variationGroup['VariationGroup']['num_choices']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($variationGroup['VariationGroup']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($variationGroup['VariationGroup']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Variation Group'), array('action' => 'edit', $variationGroup['VariationGroup']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Variation Group'), array('action' => 'delete', $variationGroup['VariationGroup']['id']), null, __('Are you sure you want to delete # %s?', $variationGroup['VariationGroup']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Variation Groups'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Variation Group'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Variations'), array('controller' => 'variations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Variation'), array('controller' => 'variations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Variations'); ?></h3>
	<?php if (!empty($variationGroup['Variation'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Variation Group Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Amount'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($variationGroup['Variation'] as $variation): ?>
		<tr>
			<td><?php echo $variation['id']; ?></td>
			<td><?php echo $variation['variation_group_id']; ?></td>
			<td><?php echo $variation['name']; ?></td>
			<td><?php echo $variation['amount']; ?></td>
			<td><?php echo $variation['created']; ?></td>
			<td><?php echo $variation['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'variations', 'action' => 'view', $variation['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'variations', 'action' => 'edit', $variation['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'variations', 'action' => 'delete', $variation['id']), null, __('Are you sure you want to delete # %s?', $variation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Variation'), array('controller' => 'variations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
