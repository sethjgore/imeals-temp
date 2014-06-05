<table class="table table-striped table-bordered" cellpadding = "0" cellspacing = "0">
<tr>
	<th><?php echo __('Name'); ?></th>
	<th><?php echo __('Title'); ?></th>
	<th><?php echo __('Phone'); ?></th>
	<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php
	$i = 0;
	if(isset($rest_contacts)){
	foreach ($rest_contacts as $restaurantContact): ?>
	<tr id="rescontact-<?php echo $i; ?>">
		<td><?php echo $restaurantContact['RestaurantContact']['name']; ?></td>
		<td><?php echo $restaurantContact['RestaurantContact']['title']; ?></td>
		<td><?php echo $restaurantContact['RestaurantContact']['phone']; ?></td>
		<td class="actions">
			<?php echo $this->Js->submit(__("Delete"), array(
    	             'update'=>'#contact_deleted',
    	             'url'=>array('controller'=>'RestaurantContacts','action'=>'delete',$restaurantContact['RestaurantContact']['id']),
    	             'confirm'=>'Are you sure you want to delete '.$restaurantContact['RestaurantContact']['name'].'?',
    	             'success'=> 'jQuery("#rescontact-'.$i.'").remove();',
    	             'escape'=>false,
    	             'evalScripts' => true,
    	             'div'=>false,
    	             'class'=>'btn btn-danger btn-mini confirm_delete')
    	           );
 ?>
		</td>
	</tr>
<?php $i++; endforeach; } ?>
    	
</table>
<?php 
$all_errors = '';
if(isset($errors)){ 
   foreach($errors as $error):
    $all_errors .= $error[0] . '<br>';
   endforeach;
?>  
  <script>jQuery('#addContactErrors').html('<?php echo $all_errors; ?>'); </script>
<?php
}else{
?>
    <script>jQuery('#addRestContact').modal('hide'); </script>
<?php } 

echo $this->Js->writeBuffer();?>
