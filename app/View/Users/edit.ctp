<div class="container">
	<div class="row-fluid show-grid" id="tab_user_manager">
		<div class="span12">
			<ul class="nav nav-tabs">
				<?php if ($this->Acl->check('Users','index') == true){?>
					<li class="active"><?php echo $this->Html->link(__('User Manager'), array('controller' => 'users','action' => 'index')); ?></li>
				<?php } ?>
				<?php if ($this->Acl->check('Groups','index') == true){?>
					<li><?php echo $this->Html->link(__('Groups'), array('controller' => 'groups','action' => 'index')); ?></li>
				<?php }?>
				<?php if ($this->Acl->check('Permissions','index','AuthAcl') == true){?>
					<li><?php echo $this->Html->link(__('Permissions'), array('plugin' => 'auth_acl','controller' => 'permissions','action' => 'index')); ?></li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<div class="row-fluid show-grid">
		<div class="span12">
		<h3><?php echo __('Edit User'); ?></h3>
			<?php if (count($errors) > 0){ ?>
			<div class="alert alert-error">
				<button data-dismiss="alert" class="close" type="button">√ó</button>
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
			<?php echo
			$this->Form->create('User',array('class'=>'form-horizontal')); ?>
			<div
				class="control-group <?php if (array_key_exists('user_email', $errors)){ echo 'error'; } ?>">
				<label for="inputEmail" class="control-label"><?php echo __('Email'); ?><span
					style="color: red;">*</span>
				</label>
				<div class="controls">
					<?php echo $this->Form->input('user_email',array('div' => false,'label'=>false,'error'=>false,'readonly'=>'readonly')); ?>
					
					<?php //echo $this->Form->input('user_email',array('div' => false,'label'=>false,'error'=>false)); ?>					
				</div>
			</div>
			<div
				class="control-group <?php if (array_key_exists('user_password', $errors)){ echo 'error'; } ?>">
				<label for="inputEmail" class="control-label"><?php echo __('Password'); ?>
				</label>
				<div class="controls">
					<?php echo $this->Form->password('user_password',array('div' => false,'label'=>false,'class' => 'input-large','error'=>false)); ?>
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

			<div class="control-group">
				<label for="inputEmail" class="control-label"><?php echo __('Groups'); ?>
				</label>
				<div class="controls">
					<?php echo $this->Form->input('Group',array('div' => false,'label'=>false,'empty' => ' ')); ?>
				</div>
			</div>
			<?php  
			$disabled = '';
			if ($auth_user['id'] == $this->request->data['User']['id']){
					$disabled = 'disabled';
				}
				?>
			<div class="control-group">
				<label for="inputEmail" class="control-label"><?php echo __('Status'); ?>
				</label>
				<div class="controls">
					<?php echo $this->Form->checkbox('user_status',array('div' => false,'label'=>false,'disabled' =>$disabled)); ?>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" class="btn btn-primary"
					value="<?php echo __('Save User'); ?>" /> <input type="button"
					class="btn" value="<?php echo __('Cancel'); ?>"
					onclick="cancel_add_user();" />
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>
<script>
	function cancel_add_user() {
		window.location = '<?php echo Router::url(array('controller' => 'users','action' => 'index')); ?>';
	}
</script>
