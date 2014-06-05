<div class="promotions index">
  <div style="float:right;"><?php echo $this->Html->link(h('Active'), 
          array('controller' => 'Promotions', 'action' => 'index', 'full_base' => true)
      );?> / 
      <b><?php echo $this->Html->link(h('Expired'), 
          array('controller' => 'Promotions', 'action' => 'expired', 'full_base' => true)
      );?></b>
  </div>
	<h2><?php echo __('Expired Codes'); ?></h2>
	Filter by Expire Date: <?php echo $this->Form->Create();
	echo $this->Form->input(
    	'filter_month',
    	array(
    		'label' => false,
    		'type' => 'date',
    		'empty' => 'Select Month',
    		'timeFormat' => '',
    		'dateFormat' => 'M',
    		'onchange'=>'this.form.submit()'
    	)
    ); ?>
      <?php echo $this->Form->input(
    	'filter_year',
    	array(
    		'label' => false,
    		'type' => 'date',
    		'empty' => 'Select Year',
    		'timeFormat' => '',
    		'dateFormat' => 'Y',
    		'minYear' => (
    			date('Y') - 15
    		),
    		'maxYear' => (
    			date('Y') 
    		),
    		'onchange'=>'this.form.submit()'
    	)
    ); 
    echo $this->Form->End(); ?>
	
	<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('order_type_id'); ?></th>
			<th><?php echo $this->Paginator->sort('frequency'); ?></th>
			<th><?php echo $this->Paginator->sort('begin'); ?></th>
			<th><?php echo $this->Paginator->sort('expire','Expires'); ?></th>
			<th><?php echo $this->Paginator->sort('discount_percent'); ?></th>
			<th>Codes Redeemed</th>
			<th>Total Savings</th>
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
		<td><?php echo h($promotion['Promotion']['discount_percent'].'%'); ?>&nbsp;</td>
		<td><?php echo '<table class="promo_code_count">';
		          foreach($promotion['PromoCode'] as $promocode): 
		            
		            echo '<tr><td>';
		            echo $promocode['code'] . '</td><td>';
		            echo $promocode['used_count'] . '</td><tr>';
              endforeach; 
              echo '</table>';
      ?></td>
		<td>????&nbsp;</td>

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