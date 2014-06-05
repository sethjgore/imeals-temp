<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * MenuHours Controller
 *
 * @property MenuHour $MenuHour
 */
class MenuHoursController extends AdminController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->MenuHour->recursive = 0;
		$this->set('menuHours', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MenuHour->exists($id)) {
			throw new NotFoundException(__('Invalid menu hour'));
		}
		$options = array('conditions' => array('MenuHour.' . $this->MenuHour->primaryKey => $id));
		$this->set('menuHour', $this->MenuHour->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($menu_id = null,$menu_name = null) {
		if ($this->request->is('post')) {
			$this->MenuHour->create();
			if ($this->MenuHour->save($this->request->data)) {
			  if($this->RequestHandler->isAjax()){
				  $this->set('menu_hours',$this->MenuHour->find('all',array('conditions'=>array('menu_id' => $this->request->data['MenuHour']['menu_id']))));
  				$this->render('new_menu_hours','ajax');
  		  } else {
				  $this->Session->setFlash(__('The menu hour has been saved'));
				  $this->redirect(array('action' => 'index'));
				}
			} else {
			  $this->set('errors',$this->MenuHour->validationErrors);
			  $this->set('menu_hours',$this->MenuHour->find('all',array('conditions'=>array('menu_id' => $this->request->data['MenuHour']['menu_id']))));
  		  $this->render('new_menu_hours','ajax');
  			
			}
		}
		if($menu_id != null && $menu_name != null){
  		$this->set(compact('menu_id','menu_name'));
		}
		$menus = $this->MenuHour->Menu->find('list');
		$this->set(compact('menus'));
	}

/**
 * add method
 *
 * @return void
 */
	public function addmultiple($menu_id = null,$menu_name = null, $restaurant_name) {

		if ($this->request->is('post')) {
			$data = $this->request->data;
			foreach($data['Days'] as $day => $val):
			  $this->MenuHour->create();
			  unset($data['MenuHour']['day']);
			  if($val == 1){
  			  $data['MenuHour']['day'] = $day;
    			if (!$this->MenuHour->save($data)) {
    			  $this->set('errors',$this->MenuHour->validationErrors);
    			  $this->set('menu_hours',$this->MenuHour->find('all',array('conditions'=>array('menu_id' => $this->request->data['MenuHour']['menu_id']))));
      		  $this->render('new_menu_hours','ajax');
      			
    			}
      		}
			
			endforeach;
			$this->set('menu_id', $menu_id);
			$this->set('restaurant_name', $restaurant_name);
			if($this->RequestHandler->isAjax()){
			  $this->set('menu_hours',$this->MenuHour->find('all',array('conditions'=>array('menu_id' => $this->request->data['MenuHour']['menu_id']))));
				$this->render('new_menu_hours','ajax');
		  } else {
			  $this->Session->setFlash(__('The menu hour has been saved'));
			  $this->redirect(array('action' => 'index'));
			}
		}
		if($menu_id != null && $menu_name != null){
  		$this->set(compact('menu_id','menu_name'));
		}
		$menus = $this->MenuHour->Menu->find('list');
		$this->set(compact('menus'));
	}
	
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null,$menu_id = null,$restaurant = null) {
		if (!$this->MenuHour->exists($id)) {
			throw new NotFoundException(__('Invalid menu hour'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MenuHour->save($this->request->data)) {
				$this->Session->setFlash(__('The menu hour has been saved'),'flash_good');
					if($menu_id != null && $restaurant != null)
			  $this->redirect(array('controller' => 'menus','action' => 'edit',$menu_id,$restaurant));
			else
			  $this->redirect(array('action' => 'index'));

			} else {
				$this->Session->setFlash(__('The menu hour could not be saved. Please, try again.'),'flash_bad');
			}
		} else {
			$options = array('conditions' => array('MenuHour.' . $this->MenuHour->primaryKey => $id));
			$this->request->data = $this->MenuHour->find('first', $options);
		}
		$menus = $this->MenuHour->Menu->find('list');
		$this->set(compact('menus'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null,$menu_id = null,$restaurant = null) {
		$this->MenuHour->id = $id;
		if (!$this->MenuHour->exists()) {
			throw new NotFoundException(__('Invalid menu hour'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MenuHour->delete()) {
			$this->Session->setFlash(__('Menu hour deleted'),'flash_good');
			if($menu_id != null && $restaurant != null)
			  $this->redirect(array('controller' => 'menus','action' => 'edit',$menu_id,$restaurant));
			else
			  $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Menu hour was not deleted'),'flash_bad');
		$this->redirect(array('action' => 'index'));
	}

}
