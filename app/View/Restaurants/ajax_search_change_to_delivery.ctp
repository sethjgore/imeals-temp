<?php if(isset($errors)): ?>
  <script>jQuery('#newAddress .modal-body p').prepend('Please enter a valid address in the form of Street Number and Name, City, State<br><br>');</script>
<?php else:
  $_SESSION['ordertype'] = 'delivery'; ?>
  <script>location.reload();</script>

<?php endif; ?>



