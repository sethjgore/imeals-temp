<div class="orders view">
<h2><?php  echo __('Order Details'); ?></h2>
	<table class="simple">
		<tr><td><?php echo __('Order Id'); ?></td>
		<td>
			<?php echo h($order['Order']['id']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Restaurant'); ?></td>
		<td>
			<?php echo $order['Restaurant']['name'] . '<br>' .
			           $order['Restaurant']['address'] . '<br>'.
			           $order['Restaurant']['City']['name'] . ', ' . $order['Restaurant']['City']['State']['abbreviation'] . ' ' . $order['Restaurant']['zip']. '<br>' ;?>
			<?php 
				if ($this->Acl->check('Users','index') == true){
					echo $this->Html->link($order['Restaurant']['name'], array('controller' => 'restaurants', 'action' => 'view', $order['Restaurant']['id']));
				} else {
					echo $order['Restaurant']['name'];
				}
			?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('User'); ?></td>
		<td>
			<?php echo $order['User']['first_name'] . ' ' . $order['User']['last_name'] . '<br>'; ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Order Address'); ?></td>
		<td>
			<?php echo h($order['Order']['address'] . ', ' . $order['Restaurant']['City']['name'] . ', ' . $order['Restaurant']['City']['State']['abbreviation'] . ' ' . $order['Order']['zip']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Order Appartment'); ?></td>
		<td>
			<?php echo h($order['Order']['appt']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Order Date'); ?></td>
		<td>
			<?php echo h($order['Order']['order_date']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Placed At'); ?></td>
		<td>
			<?php echo h($order['Order']['created']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Type'); ?></td>
		<td>
			<?php echo h($order['OrderType']['name']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Order For'); ?></td>
		<td>
			<?php echo h($order['Order']['order_for']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Order At'); ?></td>
		<td>
			<?php echo h($order['Order']['order_at']); ?>
			&nbsp;
		</td></tr>
				<tr><td><?php echo __('Sub Total'); ?></td>
		<td>
			<?php echo h('$'.$order['Order']['sub_total']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Tax'); ?></td>
		<td>
			<?php echo h('$'.$order['Order']['tax']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Tip'); ?></td>
		<td>
			<?php echo h('$'.$order['Order']['tip']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Total'); ?></td>
		<td>
			<?php echo h('$'.$order['Order']['total']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Special Instructions'); ?></td>
		<td>
			<?php echo h($order['Order']['special_instructions']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Status'); ?></td>
		<td>
			<?php echo h($order['Order']['status']); ?>
			&nbsp;
		</td></tr>
		</table>
		<br><br>
		<h3>Order Items:</h3>
		<?php $c=1; 
		  echo '<table class="simple">';
		  echo '<thead><tr><th></th><th>Item Name</th><th>Quantity Ordered</th><th>Unit Price</th></thead><tbody>';
		  foreach($order['OrderItem'] as $item): 
		  
  		  echo '<tr><td>'.$c .'.</td><td>'. $item['Item']['name'] . '</td><td>' . $item['quantity'] . '</td><td>$' . $item['Item']['price'] . '</td></tr>';
  		    if(isset($item['OrderVariation'])){
    		    foreach($item['OrderVariation'] as $variation):
    		      echo '<tr><td>&nbsp;</td><td> - '.$variation['Variation']['name'].'</td><td>&nbsp;</td><td>$'.$variation['Variation']['amount'].'</td></tr>';
    		    endforeach;
  		    } 
        $c++;
      endforeach;
      echo '</tbody></table>';
		?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<?php if ($this->Acl->check('Users','index') == true){?>		
			<li><?php echo $this->Form->postLink(__('Delete Order'), array('action' => 'delete', $order['Order']['id']), null, __('Are you sure you want to delete order #%s?', $order['Order']['id'])); ?> </li>
		<?php } ?>
	</ul>
</div>


</div>
