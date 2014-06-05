<br><br>
<h4>Search Results for "<?php echo $search; ?>":</h4>
<?php 
foreach($users as $user):
  echo $this->Html->link($user['User']['last_name'] . ', ' . $user['User']['first_name'] . ' [' .$user['User']['user_email'] . ']', 
      array('controller' => 'myaccount', 'action' => 'user', $user['User']['id'], 'full_base' => true)
  );
  echo '<br>';
  endforeach;
 ?>