<?php 
	echo '<pre>';
	var_dump($valid);
	echo '</pre>';
	
	if($valid == 'noorder')
		echo 'Please add item to order.';
	else if(count($valid) > 0)
		echo $valid['discount'].'|'.$valid['total'];
	else
		echo 'invalid';
?>