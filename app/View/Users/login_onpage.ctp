<?php if(isset($url)) ?>
<script type="text/javascript">
	<?php if(isset($url))
		echo 'window.location.href = "'.$url.'";'; ?>
	<?php if(isset($error))
		echo 'jQuery("#loginmsg.user_message").fadeIn();' ?>
			
</script>
	<?php if(isset($error))
		echo $error; ?>	
