<?php
 $items = $this->request->data;
?>
<div class="items form">
<?php echo $this->Form->create('Item',array('enctype' => 'multipart/form-data')); ?>
	<fieldset>
	<?php
		echo $this->Form->hidden('menuid', array('value'=>$items['Category']['menu_id'], 'name'=>'data[MenuID]'));
		echo $this->Form->hidden('menuid', array('value'=>$items['Item']['category_id'], 'name'=>'data[CategoryID]'));
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('label'=>'Item Name'));
		echo $this->Form->input('price');
		echo $this->Form->input('popular', array('label'=>'Featured Item','type'=>'checkbox')); 
			
		echo $this->Form->input('description');
		
		if(isset($this->request->data['Item']['photo_url']) && $this->request->data['Item']['photo_url'] != ""):
    		  echo '<label>Item Photo</label><img width="90" src="'.Router::url('/',true) . 'files/' .$this->request->data['Item']['photo_url'].'" alt="" />';
    		  echo '<a href="#" id="edit_logo" style="margin-left:10px;">Edit Photo</a>';
    		  echo '<div class="edit_logo_input" style="display:none;"><input type="hidden" name="MAX_FILE_SIZE" value="32000000" />';
    		  echo $this->Form->input('photo_file',array('type' => 'file')); 
    		  echo '</div><br><br>';
    		  
    else:		  
		  echo '<input type="hidden" name="MAX_FILE_SIZE" value="32000000" />';
      echo $this->Form->input('photo_file',array('type'=>'file'));
    endif;
	
		echo ('<h5>Item Variations</h5><br><br>');
		$i=0;
		echo '<ul id="VariationGroup">';
  		
  		//Loop through Variation Groups
  		foreach($items['VariationGroup'] as $vgroup):
  		  echo '<li class="variation_group" id="VariationGroup_'.$vgroup['id'].'">';
  		  if(isset($vgroup['id'])) {
  		    echo $this->Form->input('VariationGroup.'.$i.'.id');
  		    echo ' <span class="draganddrop">Move</span>';
  		    echo $this->Js->submit(__("X"), array(
	             'update'=>'#vg_deleted',
	             'url'=>array('controller'=>'VariationGroups','action'=>'deactivate',$vgroup['id']),
	             'confirm'=>'Are you sure you want to delete?',
	             'success'=> 'jQuery("#variation_group_'.$i.'").slideUp(function(){jQuery(this).remove();});',
	             'escape'=>false,
	             'evalScripts' => true,
	             'div'=>false,
	             'class'=>'btn btn-danger btn-mini confirm_delete delete_vg')
	           );
    	     
    	  }
  		  echo $this->Form->input('VariationGroup.'.$i.'.group_name',array('label'=>'Variation Group Name'));
  		  echo $this->Form->input('VariationGroup.'.$i.'.num_choices',array('label'=>'How many can user choose?'));
  		  $j=0;
  		  echo '<div class="variations">';
  		  echo '<ul class="Variation">';
  		  //Loop through Variations
  		  if(isset($vgroup['Variation'])): foreach($vgroup['Variation'] as $variation):		   
  		  echo '<li id="Variation_'.$variation['id'].'">';
  		    if(isset($variation['id'])) $variation_id = $variation['id']; else $variation_id = "";
  		    if(isset($variation['id']))
    		    echo $this->Form->input('VariationGroup.'.$i.'.Variation.'.$j.'.id');
  		    echo $this->Form->input('VariationGroup.'.$i.'.Variation.'.$j.'.name',array('label'=>'Name'));
  		    echo $this->Form->input('VariationGroup.'.$i.'.Variation.'.$j.'.amount',array('label'=>'Cost'));
  		    echo '<div style="clear: both;"></div>';
  		    echo ' <span class="draganddropvariation">Move</span>';
  		    echo $this->Js->submit(__("x"), array(
	             'update'=>'#v_deleted',
	             'url'=>array('controller'=>'Variations','action'=>'deactivate',$variation_id),
	             'confirm'=>'Are you sure you want to delete?',
	             'success'=> 'jQuery("#variation_'.$j.'").slideUp(function(){jQuery(this).remove();});',
	             'escape'=>false,
	             'evalScripts' => true,
	             'div'=>false,
	             'class'=>'delete_v')
	           );
  		  echo '</li><!-- #variation_'.$j.' -->';
  		  $j++;
  		  endforeach; endif;
  		  echo '</ul><!-- .variation -->';
  		  echo '<a data-vgnum="'.$i.'" data-vnum="'.$j.'" href="#" class="btn btn-mini add_variation">Add Variation</a>';
  		  echo '</div><!-- .variations --> ';
  		  $i++;
  		  echo '</li>';
  		endforeach;
  		if($i == 0){
    		echo 'No Variation Groups<br>';
  		}
		echo '</ul><!-- .variation_groups --> ';
		echo '<div class="clear"></div>';
		echo '<br><a href="#" id="add_variation_group" class="btn btn-mini">Add Variation Group</a>';
		?>                
	
	</fieldset>
<?php echo $this->Form->end(__('Save')); ?>
</div>
<div class="actions">
	<h3><?php echo 'Edit ' . $items['Item']['name']; ?></h3>
	<ul>
		<li><?php echo $this->Form->postLink(__('Delete ' . $items['Item']['name']), array('action' => 'delete', $this->Form->value('Item.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Item.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Back to Menu'), array('controller'=>'menus','action' => 'edit',$items['Category']['menu_id'],$restaurant_name)); ?></li>
	</ul>
</div>

<script>
var variationGroupCount = <?php echo $i; ?>;

//Function to dynamically add variations
function add_variation_click(){
  jQuery('.add_variation').unbind('click').click(function(e){
	    e.preventDefault();
	    
	    s_vgGroup = jQuery(this).attr('data-vgnum');
	    s_variationCount = jQuery(this).attr('data-vnum');
  	  
  	  jQuery(this).prev('.variation').append('<div class="variation_wrapper"><div class="input text">'
      +'<label for="Variation'+s_variationCount+'Name">Name</label>'
      +'<input id="Variation'+s_variationCount+'Name" type="text" name="data[VariationGroup]['+s_vgGroup+'][Variation]['+s_variationCount+'][name]">'
      +'</div>'
      +'<div class="input text">'
      +'<label for="Variation'+s_variationCount+'Amount">Cost</label>'
      +'<input id="Variation'+s_variationCount+'Amount" type="text" name="data[VariationGroup]['+s_vgGroup+'][Variation]['+s_variationCount+'][amount]">'
      +'</div>'
      +'<input class="delete_v" type="submit" onclick="jQuery(this).parent().remove(); return false;" value="x" >'
      +'</div><!-- variation_wrapper -->'
      );
      jQuery(this).attr('data-vnum',parseInt(s_variationCount)+1);
	  });
}

//Function to dynamically add variation groups
jQuery(function(){
  add_variation_click();
	jQuery('#add_variation_group').click(function(e){
	  e.preventDefault();
	  jQuery('#variation_groups').append('<div class="variation_group"><input class="btn btn-danger btn-mini confirm_delete delete_vg" onclick="jQuery(this).parent().remove(); return false;" type="submit" value="X"><div class="input text required"><label for="VariationGroup'+variationGroupCount+'GroupName">Group Name</label><input type="text" required="required" id="VariationGroup'+variationGroupCount+'GroupName" maxlength="250" name="data[VariationGroup]['+variationGroupCount+'][group_name]"></div><div class="input number required"><label for="VariationGroup'+variationGroupCount+'NumChoices">How many can user choose?</label><input type="number" required="required" id="VariationGroup'+variationGroupCount+'NumChoices" name="data[VariationGroup]['+variationGroupCount+'][num_choices]"></div><br><div id="vg-'+variationGroupCount+'"class="variation"></div><a data-vgnum="'+variationGroupCount+'" data-vnum="0" href="#" class="btn btn-mini add_variation">Add Variation</a>	 </div>');
	  add_variation_click();
  	variationGroupCount++;
	});
});
jQuery('#edit_logo').click(function(e){
  	e.preventDefault();
  	jQuery('.edit_logo_input').slideToggle();
  });

  	jQuery(function(){
  		 jQuery("#VariationGroup").sortable({
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
    	       $.post("/VariationGroups/reorder", jQuery(this).sortable("serialize"));
    	     }, 
    	     tolerance:"pointer"
    	 });
    	 
  		jQuery(".Variation").each(function() {
    	  jQuery(this).sortable({
    	     axis:"y", 
    	     cursor:"move", 
    	     delay:30, 
    	     distance:10, 
    	     forceHelperSize:true, 
    	     forcePlaceholderSize:true, 
    	     handle:".draganddropvariation", 
    	     opacity:0.80000000000, 
    	     placeholder:"drag_item_here", 
    	     stop:function (event, ui) {
    	       $.post("/Variations/reorder", jQuery(this).sortable("serialize"));
    	       //Find Middle and Add Class center_items
    	       $total = jQuery(this).find('li').removeClass('center_items').size();
    	       $middle = Math.floor(($total - 2)/2);
    	       jQuery(this).find('li:eq('+$middle+')').addClass('center_items');
    	     }, 
    	     tolerance:"pointer"
    	   });
      });
  	});
  
</script>