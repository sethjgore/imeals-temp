<div class="categories form">
<?php echo $this->Form->create('Category'); ?>
	<fieldset>
		<legend><?php echo __('Add Category'); ?></legend>
	<?php
	  if($menu_id != null){
  	  echo $this->Form->hidden('menu_id',array('value'=>$menu_id));
  	  if($menu_name != null && $rest_name != null){
  	   echo '<h3>' . $rest_name .'</h3>';
  	   echo '<h4>' . $menu_name . ' Menu</h4>';
  	  }
	  } else {
		  echo $this->Form->input('menu_id');
		}

		echo $this->Form->input('name',array('label'=>'Category Name'));
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Categories'), array('action' => 'index')); ?></li>
  		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
