<div id="dashboard_menu" class="navbar">
  <div class="navbar-inner">
  	 <ul class="nav">
  	     <?php if ($this->Acl->check('MyAccount','index') == true){?>
  	        <li>
							<?php echo $this->Html->link( __('My Account'), array('controller' => 'myaccount','action' => 'index')); ?>			
						</li>
						<?php } ?>
				<?php if ($this->Acl->check('MyAccount','index') == true){?>
  	        <li>
							<?php echo $this->Html->link( __('Order History'), array('controller' => 'myaccount','action' => 'index')); ?>			
						</li>
						<?php } ?>
  	        <li>
							<?php echo $this->Html->link( __('Edit Account'), array('controller' => 'user','action' => 'editAccount')); ?>			
						</li>
						
  	 </ul>
  	 </ul>
					<ul class="nav pull-right">
						<?php if (!empty($login_user)){ ?>
						<li
							class="dropdown"><a
							data-toggle="dropdown" class="dropdown-toggle" href="#"> <i
								class="icon icon-user"></i> <?php echo h($login_user['user_name']); ?>
								<b class="caret"></b>
						</a>
							<ul class="dropdown-menu">
								<li><?php echo $this->Html->link(__('<i class="icon-user"></i> My Account'), array('plugin' => false,'controller' => 'myaccount','action' => 'index'),array('escape'=>false)); ?></li>
								<li class="divider"></li>
								<li><?php echo $this->Html->link(__('<i class="icon-pencil"></i> Edit Account'), array('plugin' => false,'controller' => 'users','action' => 'editAccount'),array('escape'=>false)); ?></li>
								<li class="divider"></li>
								<li><?php echo $this->Html->link(__('<i class="icon-minus-sign"></i> Logout'), array('controller' => 'users','action' => 'logout'),array('escape'=>false)); ?></li>
							</ul></li>
						<?php }else{ ?>
						<li><?php echo $this->Html->link(__('Sign in'), array('controller' => 'users','action' => 'login')); ?></li>
						</a></li>
						<?php } ?>
					</ul>
  </div><!-- .navbar-inner -->
</div><!-- #dashboard_menu -->
<div class="dashboard profile_photo">
	 <h4>Welcome <span><br><?php echo $user['User']['first_name'] . ' ' . $user['User']['last_name']; ?>!</span></h4>
	 <br>
	 <?php echo $this->Html->link( __('Edit Account'), array('controller' => 'users','action' => 'editAccount')); ?>		
	  | 
	  <?php echo $this->Html->link(h('Logout'), 
	                        array('controller' => 'users', 'action' => 'logout', 'full_base' => true)
	                    );?>
</div><!-- .dashboard -->
<div class="dashboard order_history">
	<h4>Order History</h4>
	<style>
		table tr td {
		  padding: 6px 0px;
		}
	</style>
	<table>
		<thead>
			<th>Date</th>
			<th>Restaurant</th>
			<th>Time</th>
			<th>Order Total</th>
			<th>Status</th>
			<th>Number</th>
		</thead>
		<tbody>
		<?php if(isset($user['Order'])): foreach($user['Order'] as $order): ?>
			<tr>
				<td><?php echo $this->Time->format('m\/d\/y',$order['order_date']); ?></td>
				<td><?php echo $order['Restaurant']['name']; ?></td>
				<td><?php echo $this->Time->format('g:i a',$order['order_date']); ?></td>
				<td>$<?php echo $order['total']; ?></td>
				<td><?php echo 'Received';//echo strtoupper($order['type']); ?></td>
				<td><?php echo $this->Html->link(__('#'.$order['id']), array('plugin' => false,'controller' => 'orders','action' => 'view',$order['id'])); ?></td>
			</tr>
			<?php endforeach; endif;?>
		</tbody>
	</table>
</div><!-- .dashboard -->

