<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * Cuisines Controller
 *
 * @property Cuisine $Cuisine
 */
class CuisinesController extends AdminController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Cuisine->recursive = 0;
		$this->set('cuisines', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Cuisine->exists($id)) {
			throw new NotFoundException(__('Invalid cuisine'));
		}
		$options = array('conditions' => array('Cuisine.' . $this->Cuisine->primaryKey => $id));
		$this->set('cuisine', $this->Cuisine->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Cuisine->create();
			if ($this->Cuisine->save($this->request->data)) {
				$this->Session->setFlash(__('The cuisine has been saved'),'flash_good');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cuisine could not be saved. Please, try again.'),'flash_bad');
			}
		}
		$restaurants = $this->Cuisine->Restaurant->find('list');
		$this->set(compact('restaurants'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Cuisine->exists($id)) {
			throw new NotFoundException(__('Invalid cuisine'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Cuisine->save($this->request->data)) {
				$this->Session->setFlash(__('The cuisine has been saved'),'flash_good');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cuisine could not be saved. Please, try again.'),'flash_bad');
			}
		} else {
			$options = array('conditions' => array('Cuisine.' . $this->Cuisine->primaryKey => $id));
			$this->request->data = $this->Cuisine->find('first', $options);
		}
		$restaurants = $this->Cuisine->Restaurant->find('list');
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
		$this->Cuisine->id = $id;
		if (!$this->Cuisine->exists()) {
			throw new NotFoundException(__('Invalid cuisine'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Cuisine->delete()) {
			$this->Session->setFlash(__('Cuisine deleted'),'flash_good');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Cuisine was not deleted'),'flash_bad');
		$this->redirect(array('action' => 'index'));
	}

}
