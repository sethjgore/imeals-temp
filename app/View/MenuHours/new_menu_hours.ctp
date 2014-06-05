<table class="table table-striped table-bordered" cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo h('Day'); ?></th>
			<th><?php echo h('Time Open'); ?></th>
			<th><?php echo h('Time Closed'); ?></th>
			<th><?php echo h('Lead Time'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($menu_hours as $menuHour): ?>
	<tr>
		<td><?php echo h($menuHour['MenuHour']['day']); ?>&nbsp;</td>
		<td><?php echo DATE('g:i a', strtotime($menuHour['MenuHour']['time_open'])); ?>&nbsp;</td>
		<td><?php echo DATE('g:i a', strtotime($menuHour['MenuHour']['time_closed'])); ?>&nbsp;</td>
		<td><?php echo h($menuHour['MenuHour']['lead_time']); ?>&nbsp;</td>
		<td class="line_actions">
			<?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $menuHour['MenuHour']['id'])); ?>
			
			<?php echo $this->Html->link(__('Edit'), array('controller'=>'menuhours','action' => 'edit', $menuHour['MenuHour']['id'],$menu_id,$restaurant_name)); ?>			
			
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $menuHour['MenuHour']['id'],$menu_id,$restaurant_name), null, __('Are you sure you want to delete the hours for %s?', $menuHour['MenuHour']['day'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</table>
	<?php 
$all_errors = '';
if(isset($errors)){ 
   foreach($errors as $error):
    $all_errors .= $error[0] . '<br>';
   endforeach;
?>  
    <script>jQuery('#addMenuHoursError').html('<?php echo $all_errors; ?><br>'); </script>
<?php
}else{
?>
    <script>jQuery('.modal').modal('hide'); </script>
<?php } 

echo $this->Js->writeBuffer();?>
