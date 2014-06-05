<?php
$this->Paginator->options(array('url' => $passArg));
?>
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
		<?php if ($this->Acl->check('Users','add') == true){?>
		<div class="span12" style="text-align: right;">
			<button class="btn btn-success" type="button"
				onclick="showAddUserPage();">
				<i class="icon-plus icon-white"></i>
				<?php echo __('User'); ?>
			</button>
		</div>
		<?php }?>
	</div>
	<?php echo $this->Form->create('User', array('action' => 'index','class'=>' form-signin form-horizontal')); ?>
	<div class="row-fluid show-grid">
		<div class="span12">
			<div class="input-append">
				<?php echo $this->Form->input('filter',array('div' => false,'label'=>false,'placeholder'=>"Search Users",'class'=>'input-xlarge')); ?>
				<button class="btn" type="submit">
					<?php echo __('Search'); ?>
				</button>
				<button class="btn" type="button" onclick="cancelSearch();">
					<i class="icon-remove-sign"></i>
				</button>
			</div>
		</div>
	</div>
	<?php echo $this->Form->end(); ?>
	<div class="row-fluid show-grid">
		<div class="span12">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th style="text-align: center; width: 30px;"><?php echo $this->Paginator->sort('id',__('ID')); ?>
						</th>
						<th style="text-align: center; width: 250px;"><?php echo $this->Paginator->sort('user_email',__('User Email')); ?>
						</th>
						<th style="text-align: center;"><?php echo $this->Paginator->sort('first_name',__('First')); ?>
						</th>
						<th style="text-align: center;"><?php echo $this->Paginator->sort('last_name',__('Last')); ?>
						</th>						
						<th style="text-align: center; width: 150px;">Groups</th>
						<th style="text-align: center; width: 60px;"><?php echo $this->Paginator->sort('user_status',__('Status')); ?>
						</th>
						<th style="text-align: center; width: 150px;"><?php echo $this->Paginator->sort('created',__('Created')); ?>
						</th>
						<?php if ($this->Acl->check('Users','view') == true || $this->Acl->check('Users','edit') == true || $this->Acl->check('Users','delete') == true){?>
						<th style="text-align: center; width: 160px;"><?php echo __('Actions'); ?>
						</th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($users as $user): ?>
					<tr>
						<td style="text-align: center;"><?php echo h($user['User']['id']); ?>&nbsp;
						</td>
						<td><?php echo h($user['User']['user_email']); ?>&nbsp;</td>
						<td><?php echo h($user['User']['first_name']); ?>&nbsp;</td>
						<td><?php echo h($user['User']['last_name']); ?>&nbsp;</td>						
						<td style="text-align: center;"><?php
						$groupNames = array();
						if (!empty($user['Group'])){
									foreach($user['Group'] as $group){
										$groupNames[] = $group['name'];
									}
								}
								echo implode(',',$groupNames);
							 ?>
						</td>
						<td style="text-align: center;">
							<?php if ($this->Acl->check('Users','changeStatus') == true){?>
								<?php  if ($auth_user['id'] != $user['User']['id']){?> 
									<a href="#" onclick="changeStatus(this,'<?php echo h($user['User']['id']); ?>',0); return false;" id="status_allowed_<?php echo h($user['User']['id']); ?>" <?php if ($user['User']['user_status'] == 0){ ?> style="display: none;" <?php } ?>>
										<img src="<?php echo $this->request->webroot; ?>img/icons/allowed.png" /> 
									</a>
									<a href="#" onclick="changeStatus(this,'<?php echo h($user['User']['id']); ?>',1); return false;" id="status_denied_<?php echo h($user['User']['id']); ?>" <?php if ($user['User']['user_status'] == 1){ ?> style="display: none;" <?php } ?>>
										<img src="<?php echo $this->request->webroot; ?>img/icons/denied.png" />
									</a>
								<?php }else{ ?> 
									<img src="<?php echo $this->request->webroot; ?>img/icons/disabled.png" /> 
								<?php } ?>
							<?php }else{ ?> 
								<a id="status_allowed_<?php echo h($user['User']['id']); ?>" <?php if ($user['User']['user_status'] == 0){ ?> style="display: none;" <?php } ?>>
									<img src="<?php echo $this->request->webroot; ?>img/icons/disabled.png" /> 
								</a>
								<a id="status_denied_<?php echo h($user['User']['id']); ?>" <?php if ($user['User']['user_status'] == 1){ ?> style="display: none;" <?php } ?>>
									<img	src="<?php echo $this->request->webroot; ?>img/icons/disabled2.png" /> 
								</a>
							<?php } ?>
						</td>
						<td style="text-align: center;"><?php echo h($user['User']['created']); ?>&nbsp;
						</td>
						<?php if ($this->Acl->check('Users','view') == true || $this->Acl->check('Users','edit') == true || $this->Acl->check('Users','delete') == true){?>
						<td style="text-align: center;">
							<?php echo $this->Acl->link(__('View'), array('action' => 'view', $user['User']['id']),array('class'=>'btn btn-mini')); ?>
							<?php echo $this->Acl->link(__('Edit'), array('action' => 'edit', $user['User']['id']),array('class'=>'btn btn-mini btn-primary')); ?>
							<?php  if ($auth_user['id'] != $user['User']['id']){?> 
								<?php echo $this->Acl->link(__('Inactivate'), array('action' => 'delete', $user['User']['id']),array('class'=>'btn btn-mini btn-danger','onclick' =>'delUser("'.h($user['User']['id']).'","'.h($user['User']['user_email']).'");return false;')); ?>
							<?php }else{ ?> 
								<?php if ($this->Acl->check('Users','delete') == true){?>
									<?php echo $this->Acl->link(__('Inactivate'), array(),array('class'=>'btn btn-mini btn-danger disabled','onclick'=>'return false;')); ?>
								<?php } ?> 
							<?php }?>
						</td>
						<?php } ?>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<p>
				<?php

				echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>
			</p>

			<div class="pagination">
				<ul>
					<?php echo $this->Paginator->prev('&larr; ' . __('previous'),
							array('tag' => 'li','escape' => false)); echo
							$this->Paginator->numbers(array('separator' => '','tag'=>'li')); echo
					$this->Paginator->next(__('next') . ' &rarr;', array('tag' => 'li','escape' => false)); ?>
				</ul>
			</div>
		</div>
	</div>

</div>
<script>
	function cancelSearch(){
		removeUserSearchCookie();
		window.location = '<?php echo Router::url(array('controller' => 'users','action' => 'index')); ?>';
	}
	function delUser(user_id, email) {
	    $.sModal({
	        image: '<?php echo $this->request->webroot; ?>img/icons/error.png',
	        content: '<?php echo __('Are you sure you want to inactivate'); ?>  <b>' + email + '</b>?',
	        animate: 'fadeDown',
	        buttons: [{
	            text: ' <?php echo __('Inactivate'); ?> ',
	            addClass: 'btn-danger',
	            click: function(id, data) {
	                $.post('<?php echo Router::url(array('controller' => 'users','action' => 'delete')); ?>/' + user_id, {}, function(o) {
	                    $('#container').load('<?php echo Router::url(array('controller' => 'users','action' => 'index'));  ?>', function() {
	                        $.sModal('close', id);
	                        $('#tab_user_manager').find('a').each(function(){
	                    		$(this).click(function(){
	                    			removeUserSearchCookie();
	                    		});
	                    	});
	                    });
	                }, 'json');
	            }
	        }, {
	            text: ' <?php echo __('Cancel'); ?> ',
	            click: function(id, data) {
	                $.sModal('close', id);
	            }
	        }]
	        });
	}
	function changeStatus(obj,user_id,status){
		if (status == undefined){
			status = 0;
		}
		$.post('<?php echo Router::url(array('controller' => 'users','action' => 'changeStatus')); ?>',{data:{User:{id:user_id,user_status:status}}},function(o){
			if (status == 0){
				$('#status_allowed_'+user_id).hide();
				$('#status_denied_'+user_id).show();
			}else{
				$('#status_allowed_'+user_id).show();
				$('#status_denied_'+user_id).hide();
			}
			var strAlertSuccess = '<div class="alert alert-success" style="position: fixed; right:0px; top:45px; display: none;">'
				+ '<button data-dismiss="alert" class="close" type="button">×</button>'
				+ '<strong><?php echo __('Success!'); ?></strong> <?php echo __('You successfully changed the user status'); ?>' + '</div>';
			var alertSuccess = $(strAlertSuccess).appendTo('body');
			alertSuccess.show();
			setTimeout(function() {
				alertSuccess.remove();
			}, 2000);
		},'json');
	}
	function showAddUserPage() {
		window.location = "<?php echo Router::url(array('controller' => 'users','action' => 'add')); ?>";
	}
	$(document).ready(function() {
		$('.pagination > ul > li').each(function() {
			if ($(this).children('a').length <= 0) {
				var tmp = $(this).html();
				if ($(this).hasClass('prev')) {
					$(this).addClass('disabled');
				} else if ($(this).hasClass('next')) {
					$(this).addClass('disabled');
				} else {
					$(this).addClass('active');
				}
				$(this).html($('<a></a>').append(tmp));
			}
		});
	});
</script>
