<style>
.form-signin {
	max-width: 300px;
	padding: 19px 29px 29px;
	margin: 0 auto 20px;
	background-color: #fff;
}

.form-signin .form-signin-heading,.form-signin .checkbox {
	margin-bottom: 15px;
}

.message {
	margin-bottom: 15px;
	color: red;
}
</style>

<div class="container">
	<?php if (!empty($error)) {?>
		<div style="margin-bottom:0px;" class="alert alert-error"><?php echo $error;?></div>
	<?php } ?>
	<?php echo $this->Form->create('User', array('action' => 'login','class'=>' form-signin')); ?>
	<h3 class="form-signin-heading">
		<?php echo __('Please sign in'); ?>
	</h3>
	<div style="display: none;">
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->Session->flash('auth'); ?>
	</div>
	<label><?php echo __('Email'); ?> </label>
	<div class="input-prepend">
		<span class="add-on"> <i class="icon-user"></i>
		</span>
		<?php echo $this->Form->input('user_email',array('div' => false,'label'=>false,'placeholder'=>__('Email address'))); ?>
	</div>
	<label><?php echo __('Password'); ?> </label>
	<div class="input-prepend">
		<span class="add-on">@</span>
		<?php echo $this->Form->password('user_password',array('div' => false,'label'=>false,'placeholder'=>__('Password'))); ?>
	</div>
	<label class="checkbox"> <?php echo $this->Form->checkbox('remember_me',array('div' => false,'label'=>false)); ?>
		<?php echo __('Remember me'); ?>
	</label>
	<div>
		<button type="submit" class="btn btn-large btn-primary">
			<?php echo __('Sign in'); ?>
		</button>
	</div>
	<?php if (isset($general['Setting']) && (int)$general['Setting']['disable_reset_password'] == 0){?>
		<label>
			<a href="#" onclick='resetPassword(); return false;'><?php echo __('Can\'t access your account?'); ?></a> 
		</label>
	<?php } ?>
	<?php if (isset($general['Setting']) && (int)$general['Setting']['disable_registration'] == 0){?>
		<label>
			<?php echo $this->Html->link(__('Create new an Account'), array('controller' => 'users','action' => 'signup')); ?>
		 </label>
	<?php }?>
	<?php echo $this->Form->end(); ?>

</div>

<script>
<?php if (isset($general['Setting']) && (int)$general['Setting']['disable_reset_password'] == 0){?>
function resetPassword() {
	var step = 1;
    var mId = $.sModal({
    	header:'<?php echo __('Reset Password'); ?>',
    	width:450,
        form:[
			{label:'<?php echo __('Email Address'); ?>',type:'text',name:'user_email',attr:{'placeholder':'Email address',style:'width:300px;'}}
              ],
        animate: 'fadeDown',
        buttons: [{
            text: ' <?php echo __('Submit'); ?> ',
            addClass: 'btn-primary',
            click: function(id, data) {
            	if (step == 1){
	            	var btnSubmit = $('#'+id).children('.modal-footer').children('button');
	            	btnSubmit.attr({disabled:'disabled'});
	            	btnSubmit.text('<?php echo __('Loading...'); ?>');
	            	$.post('<?php echo Router::url(array('controller' => 'users','action' => 'resetPassword')); ?>',{data:{User:{user_email:$('#'+id).find('#user_email').val()}}},function(o){
	            		if (o.send_link == 1){
		            		btnSubmit.attr({disabled:false});
		                	btnSubmit.text('<?php echo __('Done'); ?>');
		                	$('#'+id).children('.modal-body').children('div').html('<div class="alert alert-success" style="padding:8px;"><?php echo __('We have sent you an password reset instructions email. Please check your email.'); ?></div>');
		                	step =2;
	            		}else{
	            			btnSubmit.attr({disabled:false});
		                	btnSubmit.text(' <?php echo __('Submit'); ?> ');
	            			step =1;
	            			$('#'+id).find('.alert-error').remove();
	            			$('#'+id).children('.modal-body').children('div').prepend('<div class="alert alert-error" style="padding:8px;"><?php echo __('<strong>Error</strong> !, Please provide a correct email address.'); ?></div>');
	            		}
	            	},'json');
            	}else if (step == 2){
            		$.sModal('close', id);
            	}
            }
        }]
        });
    $('#'+mId).find('input[type="text"]').each(function(){
		$(this).keypress(function(event){
			 if ( event.which == 13 ) {
			 	event.preventDefault();
			 }
		});
	});
}
<?php } ?>
$(document).ready(function(){
	$('#authMessage').each(function(){
		var errors = $('<div class="alert alert-error" style="margin-bottom:0px;"></div>').html($(this).html());
		$('#container').children('.container').prepend(errors);
	});

	$('#flashMessage').each(function(){
		var errors = $('<div class="alert alert-success" style="margin-bottom:0px;"></div>').html($(this).html());
		$('#container').children('.container').prepend(errors);
	});
});
</script>
