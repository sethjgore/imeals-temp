<select id="select_restaurant_<?php echo $id_set; ?>" name="data[Menu][copy_restaurant]">
<option value="">Select Restaurant</option>
<?php foreach($restaurants as $restaurantname => $restaurant):
  foreach ($restaurant as $key => $val):
?>
<option value="<?php echo $key; ?>"><?php echo $restaurantname . ' - ' . $val; ?></option>
<?php endforeach; endforeach; ?>
</select>

<script>jQuery('.choose_item,.choose_menu').html('');jQuery('#copyItemButton').hide();</script>
<?php
$this->Js->get('#select_restaurant_'. $id_set )->event('change',
  	$this->Js->request(
  		array('controller'=>'restaurants',
  			'action'=>'getMenusByRestaurant'),
  		array('update' => '#choose_menu_'. $id_set, 
  			'dataExpression' => true, 
  			'data' => 'jQuery("#select_restaurant_'.$id_set.'").serialize() + "&id='.$id_set.'&type='.$type.'"',
  			'evalScripts' => true
  	)
  ));
echo $this->Js->writeBuffer();?>