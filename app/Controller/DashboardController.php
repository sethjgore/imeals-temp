<?php
App::uses('AdminController', 'Controller');
/**
 * Cuisines Controller
 *
 * @property Cuisine $Cuisine
 */
class DashboardController extends AdminController {

  public $uses=array();
  
  public function index(){
    $this->loadModel('City');
    $this->set('cities',$this->City->find('list'));
  }

}
