
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/redmond/jquery-ui.css" type="text/css" />
    <script src='<?php echo $this->request->webroot; ?>/js/date.js'></script>
    <script src='<?php echo $this->request->webroot; ?>/js/daterangepicker.jQuery.js'></script>
		<script type="text/javascript">
			jQuery(function(){
					jQuery('#rangeA').daterangepicker({arrows: true});
			 });
		</script>

<div class="orders index">
  <h3>Select</h3>
	<?php echo $this->Form->create('Order'); ?>
	<fieldset>
	<?php
		echo $this->Form->hidden('cities',array('value'=>$city_id)); 
		echo $this->Form->input('cities',array('type'=>'select','empty'=>'All Cities','default'=>$city_id,'disabled'=>true,'label'=>'City')); 
		echo $this->Form->input('restaurants',array('type'=>'select','empty'=>'All Restaurants','label'=>'Restaurant'));
  ?>
  Select Date Range: <br><br>
	<input type="text" value="<?php echo date("n/d/Y") . ' - ' . date("n/d/Y",strtotime('+1years')); ?>" id="rangeA" name="data[Order][date_range]" />
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

</div>
<div class="actions">
	<h3><?php echo __('Search Orders'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Back to Dashboard'), array('controller'=>'Dashboard','action' => 'index')); ?></li>

	</ul>
</div>