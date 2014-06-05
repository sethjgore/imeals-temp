<div class="items form">
<?php echo $this->Form->create('Item',array('enctype' => 'multipart/form-data')); ?>
	<fieldset>
	<?php
		//'cat_id','rest_name','menu_name','cat_name'
		if($cat_id != null){
  		 echo $this->Form->hidden('Item.category_id',array('value'=>$cat_id));
  		 if($rest_menu_name != null && $cat_name != null){
  		    echo '<h3>Add Item to ' . $rest_menu_name .'</h3>';
  		    echo '<h5>Category: ' . $cat_name . '</h5>';
  		 }
		} else {
  	   echo $this->Form->input('Item.category_id');	
		}
		echo $this->Form->input('Item.name');
		echo $this->Form->input('Item.price');
		echo $this->Form->input('Item.description');
		echo '<input type="hidden" name="MAX_FILE_SIZE" value="32000000" />';
      echo $this->Form->input('Item.photo_file',array('type'=>'file'));
	?>
	<br><br>
	<h5>Item Variations</h5>
	<br>
	 <div id="variation_groups"></div>
	 <div class="clear"></div>
	 <a href="#" id="add_variation_group" class="btn btn-mini">Add Variation Group</a> 
	 <span style="font-size: 70%; margin-left: 10px;">[Example: Toppings, Type of Bread, Sides, etc.]</span>
	 
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo 'Add Item'; ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Back to Menu'), array('controller'=>'menus','action' => 'edit',$menu_id,$rest_menu_name)); ?></li>
	</ul>
</div>

<script>
var variationGroupCount = 0;
var variationCount = 0;
jQuery(function(){
	jQuery('#add_variation_group').click(function(e){
	  e.preventDefault();
	  jQuery('#variation_groups').append('<div class="variation_group"><input class="btn btn-danger btn-mini confirm_delete delete_vg" onclick="jQuery(this).parent().remove(); return false;" type="submit" value="X"><div class="input text required"><label for="VariationGroup'+variationGroupCount+'GroupName">Group Name</label><input type="text" required="required" id="VariationGroup'+variationGroupCount+'GroupName" maxlength="250" name="data[VariationGroup]['+variationGroupCount+'][group_name]"></div><div class="input number required"><label for="VariationGroup'+variationGroupCount+'NumChoices">How many can user choose?</label><input type="number" required="required" id="VariationGroup'+variationGroupCount+'NumChoices" name="data[VariationGroup]['+variationGroupCount+'][num_choices]"></div><br><div id="vg-'+variationGroupCount+'" class="variation"></div><a href="#" class="btn btn-mini add_variation">Add Variation</a>	 </div>');
	  jQuery('.add_variation').unbind('click').click(function(e){
	    var vgGroup = jQuery(this).prev().attr('id').replace('vg-','');
  	  e.preventDefault();
  	  jQuery(this).prev('.variation').append('<div class="variation_wrapper"><div class="input text">'
      +'<label for="Variation'+variationCount+'Name">Name</label>'
      +'<input id="Variation'+variationCount+'Name" type="text" name="data[VariationGroup]['+vgGroup+'][Variation]['+variationCount+'][name]">'
      +'</div>'
      +'<div class="input text">'
      +'<label for="Variation'+variationCount+'Amount">Cost</label>'
      +'<input id="Variation'+variationCount+'Amount" type="text" name="data[VariationGroup]['+vgGroup+'][Variation]['+variationCount+'][amount]">'
      +'</div>'
      +'<input class="delete_v" type="submit" onclick="jQuery(this).parent().remove(); return false;" value="x" >'
      +'</div><!-- variation_wrapper -->'
      +'<div class="clear"></div>');
  	  variationCount++;

	  });
  	variationGroupCount++;
	});
});
</script>