<div class="promotions index">
  <div style="float:right;"><b><?php echo $this->Html->link(h('Active'), 
          array('controller' => 'Promotions', 'action' => 'index', 'full_base' => true)
      );?></b> / 
      <?php echo $this->Html->link(h('Expired'), 
          array('controller' => 'Promotions', 'action' => 'expired', 'full_base' => true)
      );?>
  </div>
	<h2><?php echo __('Active Codes'); ?></h2>
	<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('order_type_id'); ?></th>
			<th><?php echo $this->Paginator->sort('frequency'); ?></th>
			<th><?php echo $this->Paginator->sort('begin'); ?></th>
			<th><?php echo $this->Paginator->sort('expire'); ?></th>
			<th>Codes</th>
			<th><?php echo $this->Paginator->sort('discount_percent'); ?></th>
			
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($promotions as $promotion): ?>
	<tr>
		<td><?php echo h($promotion['Promotion']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $promotion['OrderType']['name']; ?>
		</td>
		<td><?php if($promotion['Promotion']['frequency'] == 'once'){ echo 'One Time Use'; } else echo 'Multiple Use'; ?>&nbsp;</td>
		<td><?php echo h($promotion['Promotion']['begin']); ?>&nbsp;</td>
		<td><?php echo h($promotion['Promotion']['expire']); ?>&nbsp;</td>
		<td><?php echo '<table class="promo_code_count">';
		          foreach($promotion['PromoCode'] as $promocode): 
		            
		            echo '<tr><td>';
		            echo $promocode['code'] . '</td><td>';
		            echo $promocode['used_count'] . '</td><tr>';
              endforeach; 
              echo '</table>';
      ?></td>
		<td><?php echo h($promotion['Promotion']['discount_percent'].'%'); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $promotion['Promotion']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Promotions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Promotion'), array('action' => 'add')); ?></li>
	</ul>
</div>
