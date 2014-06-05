<?php 
	if($restaurants != null) {
		//echo $test;
		echo '<pre>'; echo var_dump($restaurants); echo '</pre>';
		
	}
	else if ($code == 'invalid address') {
		echo 'invalidaddress';
	}
	else {
		//echo $test;
		echo 'none';
	}
	
?>