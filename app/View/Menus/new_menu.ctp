<?php 
foreach($menus as $menu):
    	           
     echo '<div class="menu_line">';
     
     if($menu['Menu']['upsell_y_n'] == 1):
      echo $this->Html->link(__('<i class="icon-arrow-up"></i> '.$menu['Menu']['name']), array('controller' => 'menus', 'action' => 'edit',$menu['Menu']['id'],__($rest_name)),array('id'=>'menu-'.$menu['Menu']['id'],'escape'=>false)). ' ';
     else:
      echo $this->Html->link(__('<i class="icon-list-alt"></i> '.$menu['Menu']['name']), array('controller' => 'menus', 'action' => 'edit',$menu['Menu']['id'],__($rest_name)),array('id'=>'menu-'.$menu['Menu']['id'],'escape'=>false)). ' ';
     endif;
     
     echo '<div class="menu_delete">';
     
     echo $this->Form->create();
     echo $this->Js->submit(__("Delete"), array(
       'update'=>'#menu_deleted',
       'url'=>array('controller'=>'Menus','action'=>'deactivate',$menu['Menu']['id']),
       'confirm'=>'Are you sure you want to delete '.$menu['Menu']['name'].'?',
       'success'=> 'jQuery("#menu-'.$menu['Menu']['id'].'").parent().remove();',
       'escape'=>false,
       'div'=>false,
       'class'=>'btn btn-danger btn-mini confirm_delete')
     );
     echo $this->Form->end(); 
     
     echo '</div><!-- menu_delete --><br><br></div><!-- menu_line -->';
    	           
endforeach;    
echo $this->Js->writeBuffer();?>
 <script>jQuery('.modal').modal('hide');</script>