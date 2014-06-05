<div class="restaurants form">
	<fieldset>
		<legend><?php echo __('Add Restaurant'); ?></legend>
		<ul class="nav nav-tabs" id="RestaurantTabs">
    <li><a href="#" class="deactive">General</a></li>
    <li><a href="#" class="deactive">Billing</a></li>
    <li class="active"><a href="#">Contact</a></li>
    <li><a href="#" class="deactive">Technical</a></li>
    <li><a href="#" class="deactive">Order Types</a></li>
    <li><a href="#" class="deactive">Menus</a></li>
  </ul>
    <div id="rest_contacts">
    	<?php if (!empty($restaurant['RestaurantContact'])): ?>
    
    	<table class="table table-striped table-bordered" cellpadding = "0" cellspacing = "0">
    	<tr>
    		<th><?php echo __('Name'); ?></th>
    		<th><?php echo __('Title'); ?></th>
    		<th><?php echo __('Phone'); ?></th>
    		<th class="actions"><?php echo __('Actions'); ?></th>
    	</tr>
    	<?php
    		$i = 0;
    		foreach ($restaurant['RestaurantContact'] as $restaurantContact): ?>
    		<tr id="rescontact-<?php echo $i; ?>">
    			<td><?php echo $restaurantContact['name']; ?></td>
    			<td><?php echo $restaurantContact['title']; ?></td>
    			<td><?php echo $restaurantContact['phone']; ?></td>
    			<td class="actions">
    				<?php 
    				echo $this->Js->submit(__("Delete"), array(
    	             'update'=>'#contact_deleted',
    	             'url'=>array('controller'=>'RestaurantContacts','action'=>'delete',$restaurantContact['id']),
    	             'confirm'=>'Are you sure you want to delete '.$restaurantContact['name'].'?',
    	             'success'=> 'jQuery("#rescontact-'.$i.'").remove();',
    	             'escape'=>false,
    	             'evalScripts' => true,
    	             'div'=>false,
    	             'class'=>'btn btn-danger btn-mini confirm_delete')
    	           );
    	       ?>
    			</td>
    		</tr>
    	<?php $i++; endforeach; ?>
    	</table>

    <?php endif; ?>
     </div><!-- #rest_contacts -->
      <br>
     <?php echo $this->Html->link(__('<i class="icon-plus icon-white"></i> Add Restaurant Contact'),'#addRestContact' ,array('class'=>'btn btn-small btn-success','escape'=>false,'role'=>'button','data-toggle'=>'modal'));
    	         ?>
    	         <!-- Add Menu Modal -->
                <div id="addRestContact" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h3 id="myModalLabel">Add Contact</h3>
                  </div>
                  <div class="modal-body">
                      <div id="addContactErrors"></div>
                       <?php echo $this->Form->create('RestaurantContact',array('controller'=>'RestaurantContacts','action'=>'add')); ?>
                          	<fieldset>
                          	<?php
                          		echo $this->Form->hidden('restaurant_id',array('value'=>$restaurant['Restaurant']['id']));
                          		echo $this->Form->input('name',array('id'=>'restcontactname','label'=>'Contact Name','class'=>'required'));
                          		echo $this->Form->input('title',array('id'=>'restcontacttitle','label'=>'Contact Title'));
                          		echo $this->Form->input('phone',array('id'=>'restcontactphone','label'=>'Contact Phone'));
                          	?>
                          	</fieldset>
                          <?php echo $this->Js->submit(__('Add Contact'), array('update'=>'#rest_contacts', 'class'=>'rest_contact_submit', 
                                'url'=>array('controller'=>'RestaurantContacts','action'=>'add')));
                                echo $this->Form->end();
                          ?>

                  </div>
                </div><!-- .modal -->
                
   <script>jQuery('.rest_contact_submit').attr('data-dismiss','model');</script>

	
		</fieldset>

<?php echo $this->Html->link('Next', array('controller' => 'restaurants', 'action' => 'add_4',$restaurant_id), array('class' => 'btn btn-success'));
 ?>
</div>
<div class="actions">
	<h3><?php echo __('Restaurants'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Restaurants'), array('action' => 'index')); ?></li>
	</ul>
</div>
