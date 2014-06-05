<?php  
if(isset($errors)): ?>
  <script>jQuery('#errors').html(<?php echo $errors; ?>);</script>
<?php else:
  if(isset($items)):
  foreach($items as $item):
  echo '<li id="Item_'. $item['Item']['id'] .'" class="menu_item">'; ?>
		<div class="item_name"><?php echo $this->Html->link(__($item['Item']['name']), array('controller'=>'items','action' => 'edit', $item['Item']['id'])); ?></div>
		<div class="item_price"><?php echo h($item['Item']['price']); ?></div>
		<div class="item_desc"><?php echo h($item['Item']['description']); ?></div>
		<div class="item_actions">
			<?php if(!isset($restaurant_name)) $restaurant_name = ''; ?>
			<?php echo $this->Html->link(__('Edit'), array('controller'=>'items','action' => 'edit', $item['Item']['id'],$restaurant_name)); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('controller'=>'items','action' => 'deactivate', $item['Item']['id'],$menu_id,$restaurant_name), null, __('Are you sure you want to delete %s?', $item['Item']['name'])); ?>
			<?php echo $this->Html->link(__('Move'), '#', array('class'=>'move-item')); ?>
		</div>
	 
  <?php echo '</li>'; ?>
  <?php endforeach; ?>
  <script>
  jQuery('ul#menu_items_<?php echo $id_set; ?> li.new').removeClass('new').parent().append('<li class="new"></li>');
  jQuery('.modal').modal('hide');
  location.reload();
  </script>

<?php 
    endif;
    endif; 
    echo $this->Js->writeBuffer();
?>