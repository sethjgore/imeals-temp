<div class="orders index">
	<h2><?php 
	  if(isset($city_id) && $city_id == 'all') 
	    echo __('Orders: All Cities' . ' > '); 
	  else 
	    echo __('Orders: ' . $city_name['City']['name'] . ' > '); 
	  if(isset($restaurant_id) && $restaurant_id == 'all') 
	    echo __('All Restaurants'); 
	  else 
	    echo __($restaurant_name['Restaurant']['name']); ?>
  </h2>
  <br>
  Activity For: <?php echo $start_date . ' - ' . $end_date; ?>
  <br><br>
  Total Orders: <?php $count = $this->Paginator->counter(array(
	'format' => __('{:count}')
	)); echo $count;?><br>
  Gross Sales: $<?php if($count!=0)echo $total[0][0]['gross_total']; else echo '0'; ?><br>
  Average Order: $<?php if($count!=0) echo round(floatval($total[0][0]['gross_total']) / floatval($count),2); else echo '0'; ?><br>
  <br><br>
  Type: <?php echo $this->Form->create('Order'); echo $this->Form->input('order_type_id',array('label'=>false, 'empty'=>'All','options'=>$orderTypes,'onchange'=>'this.form.submit()')); echo $this->form->end(); ?>
  <br><br>
    <?php if(isset($order_type_id)) 
            echo $this->Html->link(__('Detailed Report'), array('controller' => 'orders', 'action' => 'detailed_report', $order_type_id )); 
          else
            echo $this->Html->link(__('Detailed Report'), array('controller' => 'orders', 'action' => 'detailed_report' )); 
          ?>
	<br><br>
  <table class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('order_date'); ?></th>
			<th><?php echo $this->Paginator->sort('user_name','Name'); ?></th>
			<th><?php echo $this->Paginator->sort('total','Order Total'); ?></th>
			<th><?php echo $this->Paginator->sort('order_type_id','Order Type'); ?></th>
			<th><?php echo $this->Paginator->sort('id','Order Id'); ?></th>
	</tr>
	<?php foreach ($orders as $order): ?>
	<tr>
		<td><?php echo h(date('m/d/Y g:ia' , strtotime($order['Order']['order_date']))); ?>&nbsp;</td>
		<td>
			<?php echo  $order['User']['first_name'] . ' ' . $order['User']['last_name'] . '<br>' . $order['Restaurant']['name']; ?>
		</td>
		<td><?php echo h('$'.$order['Order']['total']); ?>&nbsp;</td>
		<td>
			<?php echo $order['OrderType']['name']; ?>
		</td>
		<td><?php echo $this->Html->link(__($order['Order']['id']), array('action' => 'view', $order['Order']['id'])); ?> &nbsp;</td>
		
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
	<h3><?php echo __('Orders'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Back To Search'), array('controller' => 'orders', 'action' => 'bycity',$city_id)); ?> </li>
	</ul>
</div>