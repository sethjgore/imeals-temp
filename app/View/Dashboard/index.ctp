<div id="dashboard_links">
<?php 

echo $this->Form->input('city_id',array('label'=>'Select City','empty'=>'All Cities'));
echo '<br><br>';
echo $this->Html->link(__('Restaurants'), array('controller'=>'Restaurants','action' => 'index'),array('class'=>'city_filter'));
echo '<br>';
echo $this->Html->link(__('VC Businesses'), array('controller'=>'Virtualcafe','action' => 'index'),array('class'=>'city_filter'));
echo '<br>';
echo $this->Html->link(__('Invoiced Businesses'), array('controller'=>'Virtualcafe','action' => 'index'),array('class'=>'city_filter'));
echo '<br>-------------------------------------<br>';
echo $this->Html->link(__('Orders'), array('controller'=>'Orders','action' => 'index'),array('class'=>'city_filter'));
echo '<br>';
echo $this->Html->link(__('Deductions/Additions'), array('controller'=>'DeductionAdditions','action' => 'index'),array('class'=>'city_filter'));
echo '<br>-------------------------------------<br>';
echo $this->Html->link(__('Restaurant Statements'), array('controller'=>'Statements','action' => 'index'),array('class'=>'city_filter'));
echo '<br>';
echo $this->Html->link(__('Company Invoices'), array('controller'=>'Orders','action' => 'index'),array('class'=>'city_filter'));
echo '<br>-------------------------------------<br>';
echo $this->Html->link(__('Tell a Friend'), array('controller'=>'Restaurants','action' => 'index'),array('class'=>'city_filter'));
echo '<br>';
echo $this->Html->link(__('Discount Codes / Promotions'), array('controller'=>'Promotions','action' => 'index'));
echo '<br><br><br><br>';
echo $this->Html->link(__('Customer Database'), array('controller'=>'Users','action' => 'database'));
?>
</div><!-- #dashboard_links -->
<script>
jQuery(function(){
	jQuery('a.city_filter').click(function(){
	 jQuery(this).attr('href',jQuery(this).attr('href') + '/bycity/' + jQuery('#city_id').val());
	});
});
</script>