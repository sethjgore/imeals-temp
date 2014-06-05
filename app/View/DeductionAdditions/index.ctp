<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/redmond/jquery-ui.css" type="text/css" />
<script src='<?php echo $this->request->webroot; ?>/js/date.js'></script>
<script src='<?php echo $this->request->webroot; ?>/js/daterangepicker.jQuery.js'></script>
<script type="text/javascript">
	jQuery(function(){
			jQuery('#rangeA').daterangepicker({arrows: true});
	 });
</script>

<div class="orders index">
 <?php echo $this->Form->create('DeductionAddition',array('action'=>'index')); ?>
      
  <input class="date_filter" type="text" value="<?php echo date("n/d/Y"); ?>" id="rangeA" name="data[DeductionAddition][date_range]" />
  

<?php echo $this->Form->end('Filter'); ?>

  <br><br>
	<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
	<tr>
			<th><?php echo $this->Paginator->sort('Restaurant'); ?></th>
			<th><?php echo $this->Paginator->sort('Date'); ?></th>	
			<th><?php echo $this->Paginator->sort('Type'); ?></th>
			<th><?php echo $this->Paginator->sort('Amount'); ?></th>
			<th><?php echo $this->Paginator->sort('Reason'); ?></th>	
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($deductionadditions as $deductionaddition): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($deductionaddition['Restaurant']['name'], array('controller' => 'restaurants', 'action' => 'view', $deductionaddition['Restaurant']['id'])); ?>
		</td>
		<td><?php echo h($deductionaddition['DeductionAddition']['date']); ?>&nbsp;</td>
		<td><?php echo h($deductionaddition['DeductionAddition']['type']); ?>&nbsp;</td>
		<td><?php echo h('$'.$deductionaddition['DeductionAddition']['amount']); ?>&nbsp;</td>
		<td><?php echo h($deductionaddition['DeductionAddition']['reason']); ?>&nbsp;</td>
		
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $deductionaddition['DeductionAddition']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $deductionaddition['DeductionAddition']['id']), null, __('Are you sure you want to delete?')); ?>
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
	<h3><?php echo __('Deductions/ Additions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Add New'), array('action' => 'bycity')); ?></li>
	</ul>
</div>
