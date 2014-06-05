<style>
.form-signin {
	max-width: 400px;
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
	<?php echo $this->Form->create('User', array('action' => 'signup','class'=>' form-signin')); ?>
	<h3 class="form-signin-heading">
		<?php echo __('Create a new AuthAcl Account'); ?>
	</h3>
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->Session->flash('auth'); ?>
	<label><?php echo __('Full Name'); ?> </label>
	<div class="input-prepend">
		<span class="add-on"> <i class="icon-user"></i>
		</span>
		<?php echo $this->Form->input('user_name',array('div' => false,'label'=>false,'placeholder'=>__('Full Name'),'error'=>false)); ?>
	</div>
	<?php if (!empty($errors['user_name'])){ ?>
	<div style="margin-bottom: 10px; color: red;">
		<?php foreach($errors['user_name'] as $error){  ?>
		<div>
			<strong><?php echo __('Error!'); ?> </strong>
			<?php echo h($error); ?>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
	<label><?php echo __('Email'); ?> </label>
	<div class="input-prepend">
		<span class="add-on"> <i class="icon-envelope"></i></i>
		</span>
		<?php echo $this->Form->input('user_email',array('div' => false,'label'=>false,'placeholder'=>__('Email address'),'error'=>false)); ?>
	</div>
	<?php if (!empty($errors['user_email'])){ ?>
	<div style="margin-bottom: 10px; color: red;">
		<?php foreach($errors['user_email'] as $error){  ?>
		<div>
			<strong><?php echo __('Error!'); ?> </strong>
			<?php echo h($error); ?>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
	<label><?php echo __('Password'); ?> </label>
	<div class="input-prepend">
		<span class="add-on">@</span>
		<?php echo $this->Form->password('user_password',array('div' => false,'label'=>false,'placeholder'=>__('Password'),'error'=>false)); ?>
	</div>
	<?php if (!empty($errors['user_password'])){ ?>
	<div style="margin-bottom: 10px; color: red;">
		<?php foreach($errors['user_password'] as $error){  ?>
		<div>
			<strong><?php echo __('Error!'); ?> </strong>
			<?php echo h($error); ?>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
	<label><?php echo __('Confirm Password'); ?> </label>
	<div class="input-prepend">
		<span class="add-on">@</span>
		<?php echo $this->Form->password('user_confirm_password',array('div' => false,'label'=>false,'placeholder'=>__('Confirm Password'),'error'=>false)); ?>
	</div>
	<?php if (!empty($errors['user_confirm_password'])){ ?>
	<div style="margin-bottom: 10px; color: red;">
		<?php foreach($errors['user_confirm_password'] as $error){  ?>
		<div>
			<strong><?php echo __('Error!'); ?> </strong>
			<?php echo h($error); ?>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
	<?php  if (isset($general['Setting']) && (int)$general['Setting']['enable_recaptcha'] == 1){ ?>
	<label> <script type="text/javascript">
			var RecaptchaOptions = {
				theme : 'clean'
			};
		</script> <?php 
		$publickey = $general['Setting']['recaptcha_public_key'];
			echo recaptcha_get_html($publickey, null); ?>
	</label>
	<?php echo $this->Form->hidden('recaptcha',array('value'=>'1')); ?>
	<?php if (!empty($errors['recaptcha'])){ ?>
	<div style="margin-bottom: 10px; color: red;">
		<?php foreach($errors['recaptcha'] as $error){  ?>
		<div>
			<strong><?php echo __('Error!'); ?> </strong>
			<?php echo h($error); ?>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
	<?php } ?>
	<div>
		<button type="submit" class="btn btn-large btn-primary">
			<?php echo __('Create my account'); ?>
		</button>
	</div>
	<label>
		<?php echo $this->Html->link(__('Have an account? Sign in!'), array('controller' => 'users','action' => 'login')); ?>
	</label>
	<?php echo $this->Form->end(); ?>

</div>
