<div class="row-fluid">
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
		<?php echo $this->Form->create('User', array('action' => 'resetPassword/'.$code,'class'=>'form-horizontal')); ?>
		<input type="hidden" name="data[User][code]"
			value="<?php echo h($code); ?>" />
		<h3>
			<?php echo __('Recover Password'); ?>
		</h3>
		<br />
		<div class="control-group">
			<label for="inputEmail" class="control-label"><?php echo __('New Password'); ?>
			</label>
			<div class="controls">
				<?php echo $this->Form->password('user_password',array('div' => false,'label'=>false,'placeholder'=>__('New Password'))); ?>
			</div>
		</div>
		<div class="control-group">
			<label for="inputPassword" class="control-label"><?php echo __('Confirm Password'); ?>
			</label>
			<div class="controls">
				<?php echo $this->Form->password('user_confirm_password',array('div' => false,'label'=>false,'placeholder'=>__('Confirm Password'))); ?>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button class="btn btn-primary" type="submit">
					<?php echo __('Submit'); ?>
				</button>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
