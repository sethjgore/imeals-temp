<?php 

//set variabels
if (isset($menu['Menu']['name'])) $menu_name = $menu['Menu']['name']; else $menu_name = "";
if (!isset($restaurant_name)) $restaurant_name = ""; ?>

<div class="menus form">
		<div class="menu_name">
	<?php
	  echo $this->Form->create('Menu');
		echo $this->Form->input('id');
		echo $this->Form->hidden('restaurant_order_type_id');
		echo $this->Form->input('name',array('div'=>false));
		echo $this->Form->submit(
      __('Save Name'), 
      array('class' => 'btn btn-success', 'title' => 'Update Menu Name','div'=>false)
    ); 
    echo $this->Form->end(); ?>
		</div>
	<div class="clear"></div><br><br>
	
	<h2 class="menu_header menu_hours_header"><?php echo __('Menu Hours'); ?></h2><?php echo $this->Html->link(__('<i class="icon-plus icon-white"></i> Add Menu Hours'),'#addMenuHour' ,array('class'=>'btn btn-small btn-success add-btn','escape'=>false,'role'=>'button','data-toggle'=>'modal'));
    	         ?>
	<div id="menu_hours">
	<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo h('Day'); ?></th>
			<th><?php echo h('Time Open'); ?></th>
			<th><?php echo h('Time Closed'); ?></th>
			<th><?php echo h('Lead Time'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($menu['MenuHour'] as $menuHour): ?>
	<tr>
		<td><?php echo h($menuHour['day']); ?>&nbsp;</td>
		<td><?php echo DATE('g:i a', strtotime($menuHour['time_open'])); ?>&nbsp;</td>
		<td><?php echo DATE('g:i a', strtotime($menuHour['time_closed'])); ?>&nbsp;</td>
		<td><?php echo h($menuHour['lead_time']); ?>&nbsp;</td>
		<td class="line_actions">
			<?php echo $this->Html->link(__('Edit'), array('controller'=>'menuhours','action' => 'edit', $menuHour['id'],$menu['Menu']['id'],$restaurant_name)); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('controller'=>'menuhours','action' => 'delete', $menuHour['id'],$menu['Menu']['id'],$restaurant_name), null, __('Are you sure you want to delete the hours for %s?', $menuHour['day'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</table>
	</div><!-- #menu_hours -->
	
<br>

 <!-- Add Menu Modal -->
  <div id="addMenuHour" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">Add <?php echo $menu_name; ?> Menu Hours</h3>
    </div>
    <div class="modal-body">
          <div id="addMenuHoursError" class="val_errors"></div>
         <?php echo $this->Form->create('MenuHour',array('Action'=>'add')); ?>
      	<fieldset>
      	Select one or multiple days:<br><br>
      	<?php
        	   echo $this->Form->hidden('menu_id',array('value'=>$menu['Menu']['id']));
        	   echo $this->Form->hidden('restaurantname',array('value'=>$restaurant_name));
      		//echo $this->Form->input('day',array('type'=>'select','options'=>array('Monday'=>'Monday','Tuesday'=>'Tuesday','Wednesday'=>'Wednesday','Thursday'=>'Thursday','Friday'=>'Friday','Saturday'=>'Saturday','Sunday'=>'Sunday'),'empty'=>'Select Day'));
      		echo '<div style="float:left; width:45%; clear:none;">';
      		echo $this->Form->input('Days.Monday', array('label'=>'Monday','type'=>'checkbox','div'=> false));
      		echo $this->Form->input('Days.Tuesday', array('label'=>'Tuesday','type'=>'checkbox','div'=> false));
      		echo $this->Form->input('Days.Wednesday', array('label'=>'Wednesday','type'=>'checkbox','div'=> false));
      		echo $this->Form->input('Days.Thursday', array('label'=>'Thursday','type'=>'checkbox','div'=> false));
      		echo '</div><div style="float:right; width:45%; clear:none;">';
      		echo $this->Form->input('Days.Friday', array('label'=>'Friday','type'=>'checkbox','div'=> false));
      		echo $this->Form->input('Days.Saturday', array('label'=>'Saturday','type'=>'checkbox','div'=> false));
      		echo $this->Form->input('Days.Sunday', array('label'=>'Sunday','type'=>'checkbox','div'=> false));
          	echo '</div><div class="clear"><br></div>';
      		
      		echo $this->Form->input('time_open',
      			array('selected' => 
      				array('hour' => '11','min' => '00','meridian' => 'am')
            ));
                
      		echo $this->Form->input('time_closed',
      			array('selected' => 
      				array('hour' => '9','min' => '00','meridian' => 'pm')
            ));
      		echo $this->Form->input('lead_time',array('label'=>'Lead Time in minutes'));
      	?>
      	</fieldset>
      <?php echo $this->Js->submit(__('Add Menu Hour'), array('update'=>'#menu_hours', 'url'=>array('controller'=>'MenuHours','action'=>'addmultiple',$menu['Menu']['id'], $menu_name, $restaurant_name)));
            echo $this->Form->end(); ?>
         
    </div>
  </div><!-- .modal -->

<br><br><br><br>


<h2 class="menu_header"><?php echo __('Menu Items'); ?></h2><?php echo $this->Html->link(__('<i class="icon-plus icon-white"></i> Add Menu Category'),'#addMenuCategory' ,array('class'=>'btn btn-small btn-success add-btn','escape'=>false,'role'=>'button','data-toggle'=>'modal')); ?>
<br><br>

 <!-- Add Menu Category Modal -->
  <div id="addMenuCategory" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">Add Menu Category</h3>
    </div>
    <div class="modal-body">
      <div id="addCategoryErrors" class="val_errors"></div><!-- #addCategoryErrors -->
         <?php echo $this->Form->create('Category',array('Action'=>'add')); ?>
      	<fieldset>
      	<?php
        	   echo $this->Form->hidden('menu_id',array('value'=>$menu['Menu']['id']));
        	   echo $this->Form->input('name',array('label'=>'Category Name'));
        	   echo $this->Form->input('description');
      	?>
      	</fieldset>
      <?php echo $this->Js->submit(__('Add Category'), array('update'=>'#menu_categories_wrapper', 'url'=>array('controller'=>'categories','action'=>'add',$menu['Menu']['id'], $restaurant_name , $menu_name )));
            echo $this->Form->end(); ?>
         
    </div>
  </div><!-- .modal -->
<br><br><br>
<div id="menu_categories_wrapper">
<ul id="menu_categories">
	<?php $model_count=0;
	foreach ($menu['Category'] as $category): ?>
  <?php  echo '<li id="Category_'. $category['id'] .'">';
  	
	
  echo  '<h3 class="menu_cat_name">'.$category['name'].' &nbsp;'; ?>
      <div class="category_actions">
    			<?php echo $this->Html->link(__('Edit'), array('controller'=>'categories','action' => 'edit', $category['id'],$menu['Menu']['id'],$restaurant_name)); ?>
    			<?php if(!isset($restaurant_name)) $restaurant_name = ''; ?>
    			<?php echo $this->Js->submit(__("Delete"), array(
    	             'update'=>'#vg_deleted',
    	             'url'=>array('controller'=>'categories','action'=>'deactivate',$category['id']),
    	             'confirm'=>'Are you sure you want to delete ' . $category['name'] . '?',
    	             'success'=> 'jQuery("#Category_'. $category['id'] .'").slideUp(function(){jQuery(this).remove();});',
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
	<?php 
	$item_count = 0;
	$item_total = count($category['Item']);
	foreach ($category['Item'] as $item): ?>

	<?php  echo '<li id="Item_'. $item['id'] .'" class="menu_item';
	
	if($item_count == (round($item_total/2,0,PHP_ROUND_HALF_UP) -1)) echo ' center_items';
	echo '">';?>
		<div class="item_name"><?php echo $this->Html->link(__($item['name']), array('controller'=>'items','action' => 'edit', $item['id'])); ?></div>
		<div class="item_price"><?php echo h($item['price']); ?></div>
		<div class="item_desc"><?php echo h($item['description']); ?></div>
		<div class="item_actions">
			<?php if(!isset($restaurant_name)) $restaurant_name = ''; ?>
			<?php echo $this->Html->link(__('Edit'), array('controller'=>'items','action' => 'edit', $item['id'],$restaurant_name)); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('controller'=>'items','action' => 'deactivate', $item['id'],$menu['Menu']['id'],$restaurant_name), null, __('Are you sure you want to delete %s?', $item['name'])); ?>
			<?php echo $this->Html->link(__('Move'), '#', array('class'=>'move-item')); ?>
		</div>
	 
  <?php echo '</li>'; 
    $item_count++;
  ?>
<?php endforeach; ?>
<li class="new"></li>
</ul>
<div class="clear"><br></div>
   <?php 
         
         echo $this->Html->link(__('Add '.$category['name'].' Item'), array('controller'=>'items', 'action' => 'add',$category['id'],$restaurant_name .' - '.$menu_name,$category['name'],$menu['Menu']['id']),array('class'=>'btn btn-mini add-item'));
         echo ' ' . $this->Html->link(__('Copy Existing Item'),'#copyItem'.$model_count,array('class'=>'btn btn-mini','role'=>'button','data-toggle'=>'modal'));
         
    	         ?>
    	         <!-- Add Menu Modal -->
                <div id="copyItem<?php echo $model_count; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h3 id="myModalLabel">Copy Existing Item</h3>
                  </div>
                  <div class="modal-body">
                      <?php echo $this->Form->create('Menu',array('action'=>'copyVariation','id'=>'ajaxCopyMenu'.$model_count)); ?>
                      	<fieldset>
                      	<?php
                      	  echo $this->Form->hidden('Category.id',array('value'=>$category['id']));
                      	  echo $this->Form->hidden('Menu.id',array('value'=>$menu['Menu']['id']));
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
                      <?php echo $this->Form->input('Menu.numcopies',array('label'=>'Number of Copies')); ?>
                      <?php 
                      echo $this->Js->submit(__('Add Item'), array('update'=>'#Category_'. $category['id'] . ' ul li.new', 'url'=>array('controller'=>'Items','action'=>'copyItem',$menu['Menu']['id'],$restaurant_name)));
                      echo $this->Form->end(); ?>
                      </div><!-- #copyItemButton -->
                  </div>
                </div>

<?php
  echo '<br><br></li>';
  $model_count++;
  endforeach; ?>
</ul><!-- #menu_categories -->
</div><!-- .menu_categories_wrapper -->
<br>



	
</div>
<div class="actions">
	<h3><?php 
		echo strpos($restaurant_name, '&',0);
		echo $this->Html->link($restaurant_name, array('controller'=>'restaurants','action' => 'edit',$menu['RestaurantOrderType']['restaurant_id']));  echo ': '; ?>
	<?php if ($menu_name != "") echo $menu_name; else echo 'Actions'; ?></h3>
	<ul>
		<li><?php echo $this->Form->postLink('Delete ' . $menu_name, array('action' => 'delete', $this->Form->value('Menu.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Menu.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Back To Restaurant'), array('controller'=>'restaurants','action' => 'edit',$menu['RestaurantOrderType']['restaurant_id'])); ?></li>
		<li><?php echo $this->Html->link(__('Preview Menu'), array('controller'=>'restaurants','action' => 'previewmenu',$menu['RestaurantOrderType']['restaurant_id'],$menu['RestaurantOrderType']['id']),array('target' => '_blank')); ?></li>
	</ul>
</div>


	<script>
  	jQuery(function(){
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
    	       $.post("/categories/reorder", jQuery(this).sortable("serialize"));
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
    	     opacity:0.80000000000, 
    	     placeholder:"drag_item_here", 
    	     stop:function (event, ui) {
    	       $.post("/items/reorder", jQuery(this).sortable("serialize"));
    	       //Find Middle and Add Class center_items
    	       $total = jQuery(this).find('li').removeClass('center_items').size();
    	       $middle = Math.floor(($total - 2)/2);
    	       jQuery(this).find('li:eq('+$middle+')').addClass('center_items');
    	     }, 
    	     tolerance:"pointer"
    	   });
      });
  	});
  	
  	//jQuery('#menu_hours').hide();
  	jQuery('.menu_hours_header').click(function() {
  		jQuery('#menu_hours').slideToggle();
  	});
  	
	</script>
	<style>
		.menu_hours_header:hover {
			cursor: pointer;
			text-decoration: underline;
		}
		#menu_hours {
			min-width: 100%;
		}
	</style>
