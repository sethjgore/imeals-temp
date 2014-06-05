<div class="restaurants form">
	<fieldset>
		<legend><?php echo __('Add Restaurant'); ?></legend>
		<ul class="nav nav-tabs" id="RestaurantTabs">
    <li><a href="#" class="deactive">General</a></li>
    <li><a href="#" class="deactive">Billing</a></li>
    <li><a href="#" class="deactive">Contact</a></li>
    <li><a href="#" class="deactive">Technical</a></li>
    <li><a href="#" class="deactive">Order Types</a></li>
    <li class="active"><a href="#">Menus</a></li>
  </ul>

  <?php if (!empty($restaurant['RestaurantOrderType'])):
    	      $i=0;
    	     foreach ($restaurant['RestaurantOrderType'] as $restaurantOrderType):
    	       echo '<div class="rest_menu_header">';
    	       echo '<h4>'.$restaurantOrderType['OrderType']['name'] . '</h4>';
    	       echo '<br><br></div><!-- .rest_menu_header -->';
    	       echo '<div class="indent"><div id="menu-'.$i.'">';
    	       if (!empty($restaurantOrderType['Menu'])):
    	         foreach($restaurantOrderType['Menu'] as $menu):
    	           echo '<div class="menu_line">';
    	           
    	           if($menu['upsell_y_n'] == 1):
    	            echo $this->Html->link(__('<i class="icon-arrow-up"></i> '.$menu['name']), array('controller' => 'menus', 'action' => 'edit',$menu['id'],__($restaurant['Restaurant']['name'])),array('id'=>'menu-'.$menu['id'],'escape'=>false)). ' ';
    	           else:
    	            echo $this->Html->link(__('<i class="icon-list-alt"></i> '.$menu['name']), array('controller' => 'menus', 'action' => 'edit',$menu['id'],__($restaurant['Restaurant']['name'])),array('id'=>'menu-'.$menu['id'],'escape'=>false)). ' ';
    	           endif;
    	           echo '<div class="menu_delete">';
    	           
    	           echo $this->Form->create();
    	           echo $this->Js->submit(__("Delete"), array(
    	             'update'=>'#menu_deleted',
    	             'url'=>array('controller'=>'Menus','action'=>'deactivate',$menu['id']),
    	             'confirm'=>'Are you sure you want to delete '.$menu['name'].'?',
    	             'success'=> 'jQuery("#menu-'.$menu['id'].'").parent().remove();',
    	             'escape'=>false,
    	             'evalScripts' => true,
    	             'div'=>false,
    	             'class'=>'btn btn-danger btn-mini confirm_delete')
    	           );
    	           echo $this->Form->end(); 
    	           
    	           echo '</div><!-- menu_delete --><br><br></div><!-- menu_line -->';
    	         endforeach;    	           
    	       else:
    	         echo 'No Menus<br><br>';
    	       endif;
    	       echo '</div>';
    	       echo $this->Html->link(__('<i class="icon-plus icon-white"></i> Add Menu'),'#addMenuModal-'.$i ,array('class'=>'btn btn-mini btn-success','escape'=>false,'role'=>'button','data-toggle'=>'modal'));
    	         ?>
    	         <!-- Add Menu Modal -->
                <div id="addMenuModal-<?php echo $i; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h3 id="myModalLabel">Add Menu</h3>
                  </div>
                  <div class="modal-body">
                      <?php echo $this->Form->create('Menu',array('action'=>'add','id'=>'ajaxAddMenu'.$i)); ?>
                      	<fieldset>
                      	<?php
                          echo $this->Form->hidden('Menu.restaurant_order_type_id',array('value'=>$restaurantOrderType['id']));
                      		echo $this->Form->input('Menu.name',array('label'=>'Menu Name'));
                      		echo $this->Form->input('Menu.upsell_y_n', array('label'=>'Is this an Upsell menu?'));
                      		echo $this->Form->hidden('Menu.active',array('value'=>1));
                      		
                      		echo '<br><div class="make_copy_title">Make a copy of an existing Menu:</div>';
                      		echo $this->Form->input('copy_city',array('type'=>'select','options'=>$cities,'empty'=>'Choose City','id'=>'select_city_'.$i,'label'=>false)); 
                      		echo '<div id="choose_restaurant_'.$i.'"></div><div id="choose_menu_'.$i.'" class="choose_menu"></div>';
                      		//Set Javascript for Copying a menu
                      		$this->Js->get('#select_city_'.$i)->event('change',
                          	$this->Js->request(
                          		array('controller'=>'restaurants',
                          			'action'=>'getRestaurantsByCity'),
                          		array('update' => '#choose_restaurant_'.$i, 
                          			'dataExpression' => true, 
                          			'data' => 'jQuery("#select_city_'.$i.'").serialize() + "&id='.$i.'&type=cpMenu"',
                          			'evalScripts'=>true,
                          			'success' => 'jQuery(".choose_menu").html("");'
                          		)
                          	)
                          );	
                      	?>
                      	</fieldset>
                      <?php 
                      echo $this->Js->submit(__('Save'), array('update'=>'#menu-'.$i, 'url'=>array('controller'=>'Menus','action'=>'add',$restaurantOrderType['id'],__($restaurant['Restaurant']['name']))));
                      echo $this->Form->end(); ?>

                  </div>
                </div>
    	         <?php
    	       echo '</div><!-- .indent --><br><br>';
    	       $i++;
    	     endforeach;
    	     endif;
   ?> 
  		

  	

	</fieldset>
<br><br>
<?php echo $this->Html->link(h('Complete Setup'), 
                      array('controller' => 'restaurants', 'action' => 'edit', $restaurant_id, 'full_base' => true),
                      array('class'=>'btn btn-success')
                  );?>

</div>
<div class="actions">
	<h3><?php echo __('Restaurants'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Restaurants'), array('action' => 'index')); ?></li>
	</ul>
</div>

