<select multiple id="select_item_<?php echo $id_set; ?>" name="data[Menu][copy_item][]" style="height:140px;">

<?php 
            $i=0;
            foreach($categories as $category):
              foreach($category['Item'] as $item): 
                if(isset($item['id'])): ?>
              
              <option value="<?php echo $item['id']; ?>"><?php echo $category['Category']['name'] . ' - ' . $item['name']; ?></option>
  <?php 
                endif;
              endforeach;
              $i++;
            endforeach;
     ?>

</select>

<script>jQuery('#copyItemButton<?php echo $id_set; ?>').fadeIn(); </script>
<?php echo $this->Js->writeBuffer(); ?>