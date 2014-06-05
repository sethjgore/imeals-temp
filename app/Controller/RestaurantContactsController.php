<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * RestaurantContacts Controller
 *
 * @property RestaurantContact $RestaurantContact
 */
class RestaurantContactsController extends AdminController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->RestaurantContact->recursive = 0;
		$this->set('restaurantContacts', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RestaurantContact->exists($id)) {
			throw new NotFoundException(__('Invalid restaurant contact'));
		}
		$options = array('conditions' => array('RestaurantContact.' . $this->RestaurantContact->primaryKey => $id));
		$this->set('restaurantContact', $this->RestaurantContact->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RestaurantContact->create();
			if ($this->RestaurantContact->save($this->request->data)) {
  			if($this->RequestHandler->isAjax()){
    			$this->set('rest_contacts',$this->RestaurantContact->find('all',array('conditions'=>array('restaurant_id' => $this->request->data['RestaurantContact']['restaurant_id']))));
  				$this->render('new_rest_contact','ajax');
  			} else {
				  $this->Session->setFlash(__('The restaurant contact has been saved'));
				  $this->redirect(array('action' => 'index'));
				}
			} else {
			  if($this->RequestHandler->isAjax()){
			    $this->set('errors',$this->RestaurantContact->validationErrors);
			    //$this->set('rest_contacts',$this->RestaurantContact->find('all',array('conditions'=>array('restaurant_id' => $this->request->data['RestaurantContact']['restaurant_id']))));
  			  $this->render('new_rest_contact','ajax');
			  }
				$this->Session->setFlash(__('The restaurant contact could not be saved. Please, try again.'));
			}
		}
		$restaurants = $this->RestaurantContact->Restaurant->find('list');
		$this->set(compact('restaurants'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null, $restid = null) {
		if (!$this->RestaurantContact->exists($id)) {
			throw new NotFoundException(__('Invalid restaurant contact'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RestaurantContact->save($this->request->data)) {
				$this->Session->setFlash(__('The restaurant contact has been saved'));
				if(isset($restid)) {
					$this->redirect(array(
					    'controller' => 'Restaurants',
					    'action' => 'edit', 
					    $restid)
					);
				}				
				else
					$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The restaurant contact could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RestaurantContact.' . $this->RestaurantContact->primaryKey => $id));
			$this->request->data = $this->RestaurantContact->find('first', $options);
		}
		$restaurants = $this->RestaurantContact->Restaurant->find('list');
		$this->set(compact('restaurants'));
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
		$this->RestaurantContact->id = $id;
		if (!$this->RestaurantContact->exists()) {
			throw new NotFoundException(__('Invalid restaurant contact'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->RestaurantContact->delete()) {
			$this->Session->setFlash(__('Restaurant contact deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Restaurant contact was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}
