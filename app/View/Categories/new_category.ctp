<ul id="menu_categories">
<?php 
$model_count = 0;
foreach ($categories as $category):
  echo '<li id="Category_'. $category['Category']['id'] .'">';
  	
	
  echo  '<h3 class="menu_cat_name">'.$category['Category']['name'].' &nbsp;'; ?>
      <div class="category_actions">
    			<?php echo $this->Html->link(__('Edit'), array('controller'=>'categories','action' => 'edit', $category['Category']['id'],$menu_id,$restaurant_name)); ?>
    			<?php echo $this->Js->submit(__("Delete"), array(
    	             'update'=>'#vg_deleted',
    	             'url'=>array('controller'=>'categories','action'=>'deactivate',$category['Category']['id']),
    	             'confirm'=>'Are you sure you want to delete ' . $category['Category']['name'] . '?',
    	             'success'=> 'jQuery("#Category_'. $category['Category']['id'] .'").slideUp(function(){jQuery(this).remove();});',
    	             'escape'=>false,
    	             'evalScripts' => true,
    	             'div'=>false,
    	             'class'=>'delete_cat')
    	           );
    	     ?>
    			<?php echo ' <span class="draganddrop">Move</span>'; ?>
    		</div>
  <?php echo '</h3>'; ?>
	<ul class="menu_items" id="menu_items_<?php echo $model_count; ?>">
	<?php if($category['Item']): foreach ($category['Item'] as $item): ?>
	<?php  echo '<li id="Item_'. $item['id'] .'" class="menu_item">'; ?>
		<div class="item_name"><?php echo $this->Html->link(__($item['name']), array('controller'=>'items','action' => 'edit', $item['id'])); ?></div>
		<div class="item_price"><?php echo h($item['price']); ?></div>
		<div class="item_desc"><?php echo h($item['description']); ?></div>
		<div class="item_actions">
			<?php echo $this->Html->link(__('Edit'), array('controller'=>'items','action' => 'edit', $item['id'])); ?>
			<?php if(!isset($restaurant_name)) $restaurant_name = ''; ?>
			<?php echo $this->Form->postLink(__('Delete'), array('controller'=>'items','action' => 'deactivate', $item['id'],$category['Category']['menu_id'],$restaurant_name), null, __('Are you sure you want to delete %s?', $item['name'])); ?>
			<?php echo $this->Html->link(__('Move'), '#', array('class'=>'move-item')); ?>
		</div>
	</div>
	<?php echo '</li>'; ?>
<?php endforeach; endif;?>
<li class="new"></li>
</ul>
<div class="clear"><br></div>
   <?php 
         echo $this->Html->link(__('Add '.$category['Category']['name'].' Item'), array('controller'=>'items', 'action' => 'add',$category['Category']['id'],$restaurant_name .' - '.$menu_name,$category['Category']['name'],$category['Category']['menu_id']),array('class'=>'btn btn-mini add-item'));
         echo ' ' . $this->Html->link(__('Copy Existing Item'),'#copyItem'.$model_count,array('class'=>'btn btn-mini','role'=>'button','data-toggle'=>'modal'));
         
    	         ?>
    	         <!-- Add Menu Modal -->
                <div id="copyItem<?php echo $model_count; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h3 id="myModalLabel">Copy Existing Item</h3>
                  </div>
                  <div class="modal-body">
                      <div id="addCategoryErrors" class="val_errors"></div><!-- #addCategoryErrors -->
                      <?php echo $this->Form->create('Menu',array('action'=>'copyVariation','id'=>'ajaxCopyMenu'.$model_count)); ?>
                      	<fieldset>
                      	<?php
                      	  echo $this->Form->hidden('Category.id',array('value'=>$category['Category']['id']));
                      	  echo $this->Form->hidden('Menu.id',array('value'=>$category['Category']['menu_id']));
                      	  echo $this->Form->hidden('Menu.type',array('value'=>'cpItem'));
                      	  echo $this->Form->hidden('Menu.id_set',array('value'=>$model_count));
                      	  echo $this->Form->hidden('Restaurant.name',array('value'=>$restaurant_name));
                      		echo $this->Form->input('copy_city',array('type'=>'select','options'=>$cities,'empty'=>'Choose City','id'=>'select_city_'.$model_count,'label'=>false)); 
                      		echo '<div id="choose_restaurant_'.$model_count.'" class="choose_restaurant"></div><div id="choose_menu_'.$model_count.'" class="choose_menu"></div><div id="choose_item_'.$model_count.'" class="choose_item"></div>';
                      		//Set Javascript for Copying a menu
                      		$this->Js->get('#select_city_'.$model_count)->event('change',
                          	$this->Js->request(
                          		array('controller'=>'restaurants',
                          			'action'=>'getRestaurantsByCity'),
                          		array('update' => '#choose_restaurant_'.$model_count, 
                          			'dataExpression' => true, 
                          			'data' => 'jQuery("#select_city_'.$model_count.'").serialize() + "&id='.$model_count.'&type=cpItem"',
                          			'evalScripts'=>true,
                          			'success' => 'jQuery(".choose_menu").html("");'
                          		)
                          	)
                          );	
                      	?>
                      	</fieldset>
                      <div id="copyItemButton<?php echo $model_count; ?>" style="display:none;">
                      <?php 
                      echo $this->Js->submit(__('Add Item'), array('update'=>'#Category_'. $category['Category']['id'] . ' ul li.new', 'url'=>array('controller'=>'Items','action'=>'copyItem',$category['Category']['menu_id'],$restaurant_name)));
                      echo $this->Form->end(); ?>
                      </div><!-- #copyItemButton -->
                  </div>
                </div>

<?php

  echo '<br><br></li>';
  $model_count++;
  endforeach; ?>
  </ul>
 <?php 
$all_errors = '';
if(isset($errors)){ 
   foreach($errors as $error):
    $all_errors .= $error[0] . '<br>';
   endforeach;
?>  
  <script>jQuery('#addCategoryErrors').html('<?php echo $all_errors; ?>'); </script>
<?php
}else{ ?>
    <script>
    jQuery(function(){
    	
      jQuery('.modal').modal('hide');
  	  
        jQuery("#menu_categories").sortable({
    	     axis:"y", 
    	     cursor:"move", 
    	     delay:30, 
    	     distance:10, 
    	     forceHelperSize:true, 
    	     forcePlaceholderSize:true, 
    	     handle:".draganddrop", 
    	     opacity:0.8, 
    	     placeholder:"drag_here", 
    	     stop:function (event, ui) {
    	       $.post("/imeals/categories/reorder", jQuery(this).sortable("serialize"))
    	     }, 
    	     tolerance:"pointer"
    	 });

  		jQuery(".menu_items").each(function() {
    	  jQuery(this).sortable({
    	     axis:"y", 
    	     cursor:"move", 
    	     delay:30, 
    	     distance:10, 
    	     forceHelperSize:true, 
    	     forcePlaceholderSize:true, 
    	     handle:".move-item", 
    	     opacity:0.8, 
    	     placeholder:"drag_item_here", 
    	     stop:function (event, ui) {
    	       $.post("/imeals/items/reorder", jQuery(this).sortable("serialize"))
    	     }, 
    	     tolerance:"pointer"
    	   });
      });
     });

      
    </script>
<?php } ?>
<?php
echo $this->Js->writeBuffer(); ?>