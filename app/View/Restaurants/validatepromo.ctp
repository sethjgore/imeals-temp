<?php 
	if($valid == 'noorder')
		echo 'noorder';
	else if(count($valid) > 0)
		echo $valid['discount'].'|'.$valid['total'];
	else
		echo 'invalid';
?>