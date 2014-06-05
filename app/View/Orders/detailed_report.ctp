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
  Restaurant: <?php if(isset($restaurant_id) && $restaurant_id == 'all') 
	    echo __('All Restaurants'); 
	  else 
	    echo __($restaurant_name['Restaurant']['name']); ?>
  <br>
  Period: <?php echo $start_date . ' - ' . $end_date; ?>
  <br><br>
  <table style="width:60%;">
  <tr>
    <td colspan="2" style="font-weight:bold;">Order Types:</td>
  </tr>
  <?php $order_total = 0; ?>
  <?php foreach($order_counts as $order_count):?>
    <tr>
      <td><?php echo $order_count['OrderType']['name']; ?></td>
      <td><?php echo $order_count[0]['OrderCount']; ?></td>
      <?php $order_total = $order_total +  intval($order_count[0]['OrderCount']); ?>
    </tr>  
  <?php endforeach; ?>
  <tr>
    <td style="font-weight:bold; border-top:2px solid #000;">Total Orders:</td>
    <td style="border-top:2px solid #000;"><?php echo $order_total; ?></td>
  </tr> 
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr> 
  <tr>
    <td colspan="2" style="font-weight:bold;">Breakdown:</td>
  </tr>  
	<tr>
		<td>Subtotal:</td>
		<td>$<?php echo $total[0][0]['sub_total'] ?></td>
	</tr>
	<tr>
		<td>Tip</td>
		<td>$<?php echo $total[0][0]['tip'] ?></td>
	</tr>
	<tr>
		<td>Delivery</td>
		<td>$ ?????</td>
	</tr>
	<tr>
		<td>Tax</td>
		<td>$<?php echo $total[0][0]['tax'] ?></td>
	</tr>
	<tr>
		<td>First Time Discounts</td>
		<td>$ ??????</td>
	</tr>
	<tr>
		<td style="border-top:2px solid #000; font-weight:bold;">Gross Sales</td>
		<td style="border-top:2px solid #000;">$<?php if($order_count!=0)echo $total[0][0]['gross_total']; else echo '0'; ?></td>
	</tr>
	<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight:bold;">Debits:</td>
  </tr>
  <tr>
		<td>iMeals Commission (%)</td>
		<td>$ ??????</td>
	</tr>
	<tr>
		<td style="border-top:2px solid #000; font-weight:bold;">Check Total</td>
		<td style="border-top:2px solid #000;">????</td>
	</tr>    
  </table>
  </div>
<div class="actions">
	<h3><?php echo __('Detail Report'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Back To Search'), array('controller' => 'orders', 'action' => 'bycity',$city_id)); ?> </li>
	</ul>
</div>