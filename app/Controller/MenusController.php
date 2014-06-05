<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * Menus Controller
 *
 * @property Menu $Menu
 */
class MenusController extends AdminController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Menu->recursive = 0;
		$this->set('menus', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Menu->exists($id)) {
			throw new NotFoundException(__('Invalid menu'));
		}
		$options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
		$this->set('menu', $this->Menu->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($rest_order_type_id = null,$rest_name = null) {
		if ($this->request->is('post')) {
			//Create New Menu
			$this->Menu->create();
			$new_menu = $this->request->data;
			//Determine if a copy was asked for
			if(isset($new_menu['Menu']['copy_menu'])){
  			if($new_menu['Menu']['copy_menu'] != null && $new_menu['Menu']['copy_menu'] != ""){
    			$copy_menu = $this->Menu->copyMenu($this->Menu->id,$new_menu);
    			if($this->RequestHandler->isAjax()){
  				  $this->set('menus',$this->Menu->find('all',array('conditions'=>array('restaurant_order_type_id' => $rest_order_type_id,'active'=>'1'))));
  				  $this->set('rest_name',$rest_name);
    				$this->render('new_menu','ajax');
    		  }
    		}
    	}	else {
      	if ($this->Menu->save($new_menu)) {	
  				if($this->RequestHandler->isAjax()){
  				  $this->set('menus',$this->Menu->find('all',array('conditions'=>array('restaurant_order_type_id' => $rest_order_type_id,'active'=>'1'))));
  				  $this->set('rest_name',$rest_name);
    				$this->render('new_menu','ajax');
    		  } else {
      		  $this->Session->setFlash(__('The menu has been saved'));
      		  $this->redirect(array('action' => 'index'));  
    		  }
  			} else {
  				$this->Session->setFlash(__('The menu could not be saved. Please, try again.'));
  			}
    	}
			
		}
		$restaurantOrderTypes = $this->Menu->RestaurantOrderType->find('list');
		if($rest_order_type_id != null){
		  $restaurant = $this->Menu->RestaurantOrderType->find('first',array(
		    'conditions' => array('RestaurantOrderType.id'=>$rest_order_type_id),
		    'contain' => array('Restaurant','OrderType')
		  ));
		  $this->set('rest_order_type_id',$rest_order_type_id);
		}
		$this->set(compact('restaurantOrderTypes','restaurant'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null,$restaurant_name = null) {
		if (!$this->Menu->exists($id)) {
			throw new NotFoundException(__('Invalid menu'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Menu->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The menu has been saved'),'flash_good');
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.'),'flash_bad');
			}
		}
		$options = array(
			 'conditions' => array('Menu.' . $this->Menu->primaryKey => $id),
			 'contain' => array(
			   'MenuHour',
			   'RestaurantOrderType',
			   'Category' => array(
			     'conditions' => array('Category.active',1),
			     'Item' => array(
			       'conditions' => array('Item.active',1),
			       'VariationGroup' => array(
			         'Variation'
			       )
			     )
 			   )
			 ));
			$this->request->data = $this->Menu->find('first', $options);
			$menu = $this->request->data;
		if($restaurant_name != null){
		if(strpos($restaurant_name, '&',0) > 0 && strpos($restaurant_name, '&',0) != false)
			$restaurant_name = substr($restaurant_name,0,strpos($restaurant_name, '&',0));
  		
  		$this->set('restaurant_name',$restaurant_name);
		} else {
  		$this->set('restaurant_name','');
		}
		$this->loadModel('City');
		$cities = $this->City->find('list');
		$restaurantOrderTypes = $this->Menu->RestaurantOrderType->find('list');
		$this->set(compact('restaurantOrderTypes','menu','cities'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Menu->id = $id;
		if (!$this->Menu->exists()) {
			throw new NotFoundException(__('Invalid menu'));
		}
		$this->request->onlyAllow('post', 'delete', 'get');
		if ($this->Menu->delete()) {
  		  $this->Session->setFlash(__('Menu deleted'));
  		  $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Menu was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	/**
   * deactivate Menu
   *
   * @throws NotFoundException
   * @throws MethodNotAllowedException
   * @param string $id
   * @return void
   */
	public function deactivate($menu_id = null){
  	$this->layout = 'ajax';
  	$this->Menu->id = $menu_id;
  	if (!$this->Menu->exists()) {
			throw new NotFoundException(__('Invalid menu'));
		}
		if($this->Menu->saveField('active',0)){
  		$this->render('deactivated','ajax');
		}
	}

}
