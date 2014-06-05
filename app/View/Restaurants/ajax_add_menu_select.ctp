<select id="select_menu_<?php echo $id_set; ?>" name="data[Menu][copy_menu]">

<option value="">Select Menu</option>

<?php foreach($restaurants as $restaurant):
        foreach($restaurant["RestaurantOrderType"] as $ordertype):
          foreach($ordertype['Menu'] as $menu): ?>

            <option value="<?php echo $menu['id']; ?>"><?php echo $menu['name']; ?></option>
  <?php 
          endforeach;
        endforeach; 
      endforeach; ?>

</select>

<script>jQuery('.choose_item').html('');jQuery('#copyItemButton').hide();</script>

<?php
if($type == 'cpItem'):
$this->Js->get('#select_menu_'. $id_set )->event('change',
  	$this->Js->request(
  		array('controller'=>'restaurants',
  			'action'=>'getItemsByMenu'),
  		array('update' => '#choose_item_'. $id_set, 
  			'dataExpression' => true, 
  			'data' => 'jQuery("#select_menu_'.$id_set.'").serialize() + "&id='.$id_set.'&type='.$type.'"',
  			'evalScripts' => true
  	)
  ));
echo $this->Js->writeBuffer();
endif;?>