<div class="container">
	<div class="row-fluid show-grid" id="tab_user_manager">
		<div class="span12">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#"><?php echo __('Edit Profile'); ?></a></li>
			</ul>
		</div>
	</div>
	<div class="row-fluid show-grid">
		<div class="span12">
			<?php if (count($errors) > 0){ ?>
			<div class="alert alert-error">
				<button data-dismiss="alert" class="close" type="button">×</button>
				<?php foreach($errors as $error){ ?>
				<?php foreach($error as $er){ ?>
				<strong><?php echo __('Error!'); ?>
				</strong>
				<?php echo h($er); ?>
				<br />
				<?php } ?>
				<?php } ?>
			</div>
			<?php } ?>
			<div class="alert alert-success">
				
			</div>			
			<?php echo
			$this->Form->create('User',array('class'=>'form-horizontal')); ?>
			<div
				class="control-group <?php if (array_key_exists('user_email', $errors)){ echo 'error'; } ?>">
				<label for="inputEmail" class="control-label"><?php echo __('Email'); ?>
				</label>
				<div class="controls">
					<?php echo $this->Form->input('user_email',array('div' => false,'label'=>false,'error'=>false,'readonly'=>'readonly')); ?>
				</div>
			</div>
			<div
				class="control-group <?php if (array_key_exists('user_password', $errors)){ echo 'error'; } ?>">
				<label for="inputEmail" class="control-label"><?php echo __('Password'); ?>
				</label>
				<div class="controls">
					<?php echo $this->Form->password('user_password',array('div' => false,'label'=>false,'class' => 'input-xlarge', 'error'=>false)); ?>
				</div>
			</div>
			<div
				class="control-group <?php if (array_key_exists('user_confirm_password', $errors)){ echo 'error'; } ?>">
				<label for="inputEmail" class="control-label"><?php echo __('Confirm Password'); ?>
				</label>
				<div class="controls">
					<?php echo $this->Form->password('user_confirm_password',array('div' => false,'label'=>false,'class' => 'input-xlarge', 'error'=>false)); ?>
				</div>
			</div>

			<div
				class="control-group <?php if (array_key_exists('first_name', $errors)){ echo 'error'; } ?>">
				<label for="inputEmail" class="control-label"><?php echo __('First Name'); ?><span
					style="color: red;">*</span>
				</label>
				<div class="controls">
					<?php echo $this->Form->input('first_name',array('div' => false,'label'=>false,'class' => 'input-xlarge','error'=>false)); ?>
				</div>
			</div>
			
			<div
				class="control-group <?php if (array_key_exists('last_name', $errors)){ echo 'error'; } ?>">
				<label for="inputEmail" class="control-label"><?php echo __('Last Name'); ?><span
					style="color: red;">*</span>
				</label>
				<div class="controls">
					<?php echo $this->Form->input('last_name',array('div' => false,'label'=>false,'class' => 'input-xlarge','error'=>false)); ?>
				</div>
			</div>
			
			<div
				class="control-group <?php if (array_key_exists('phone', $errors)){ echo 'error'; } ?>">
				<label for="inputEmail" class="control-label"><?php echo __('Phone'); ?><span
					style="color: red;">*</span>
				</label>
				<div class="controls">
					<?php echo $this->Form->input('phone',array('div' => false,'label'=>false,'class' => 'input-xlarge','error'=>false)); ?>
				</div>
			</div>			


			<div class="form-actions">
				<input type="button" class="btn btn-primary"
					value="<?php echo __('Save'); ?>" onclick="editAccount();" />
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>
<style>
	.alert-success {
		display: none;
	}
</style>
<script>
	function editAccount(){
		$.post('<?php echo Router::url(array('controller' => 'users','action' => 'editAccount')); ?>',$('#UserEditAccountForm').serialize(),function(o){
		console.log(o.error);
			if (o.error == 0){
			//'<div class="alert alert-success" style="position: fixed; right:0px; top:45px; display: none;">'
			//					+ '</div>';
				var strAlertSuccess = '<button data-dismiss="alert" class="close" type="button">×</button>'
					+ '<strong><?php echo __('Success!'); ?></strong> <?php echo __('You successfully edited your account'); ?>';
				var alertSuccess = $(strAlertSuccess).appendTo('.alert-success');
				jQuery('.alert-success').fadeIn();
				setTimeout(function() {
					jQuery('.alert-success').fadeOut();				
					alertSuccess.remove();
				}, 2000);
			}else{
			//'<div class="alert alert-error" style="position: fixed; right:0px; top:45px; display: none;">'
			//					+ '</div>';
				var strAlertSuccess = '<button data-dismiss="alert" class="close" type="button">×</button>'
					+ o.error_message;
				var alertSuccess = $(strAlertSuccess).appendTo('.alert-success');
				jQuery('.alert-success').fadeIn();
				alertSuccess.show();
				setTimeout(function() {
					jQuery('.alert-success').fadeOut();
					alertSuccess.remove();
				}, 3000);
			}
		},'json');
	}
</script>
