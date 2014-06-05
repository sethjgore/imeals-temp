<div id="custom_database_form">
<h3>Search for a customer by last name:</h3><br>
<?php 
    echo $this->Form->create('User',array('action'=>'database'));
    echo $this->Form->input('last_name',array('div' => false,'label'=>'Last Name: '));
    echo $this->Js->submit(__('Go'), array('update'=>'#user_results', 'url'=>array('controller'=>'users','action'=>'database'),'class'=>'btn','div'=>false));
    echo $this->Form->end();  ?>
</div>
<div id="user_results"></div>