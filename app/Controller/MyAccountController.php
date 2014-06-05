<?php
//App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * Cuisines Controller
 *
 * @property Cuisine $Cuisine
 */
class MyAccountController extends AdminController {

  public $uses=array();
  
  public function index(){
    $this->loadModel('User');
    $this->set('user', $this->User->find('first',array(
      'conditions'=>array(
        'User.id' => $this->Auth->user('id')
      ),
      'contain'=>array(
        'Order'=>array(
          'Restaurant'=>array(
            'fields'=>array('Restaurant.name')
          )
        )
      )
    )));
  }
  
  public function user($user_id){
    $this->loadModel('User');
    $this->set('user', $this->User->find('first',array(
      'contain'=>array(
        'Order'=>array(
          'Restaurant'
        )
      ),
      'conditions'=>array(
        'User.id' => $user_id
      )
    )));
    $this->render('index');
  }

}
