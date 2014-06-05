<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * OrderVariations Controller
 *
 * @property OrderVariation $OrderVariation
 */
class OrderVariationsController extends AdminController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->OrderVariation->recursive = 0;
		$this->set('orderVariations', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->OrderVariation->exists($id)) {
			throw new NotFoundException(__('Invalid order variation'));
		}
		$options = array('conditions' => array('OrderVariation.' . $this->OrderVariation->primaryKey => $id));
		$this->set('orderVariation', $this->OrderVariation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->OrderVariation->create();
			if ($this->OrderVariation->save($this->request->data)) {
				$this->Session->setFlash(__('The order variation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The order variation could not be saved. Please, try again.'));
			}
		}
		$orderItems = $this->OrderVariation->OrderItem->find('list');
		$variations = $this->OrderVariation->Variation->find('list');
		$this->set(compact('orderItems', 'variations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->OrderVariation->exists($id)) {
			throw new NotFoundException(__('Invalid order variation'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->OrderVariation->save($this->request->data)) {
				$this->Session->setFlash(__('The order variation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The order variation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('OrderVariation.' . $this->OrderVariation->primaryKey => $id));
			$this->request->data = $this->OrderVariation->find('first', $options);
		}
		$orderItems = $this->OrderVariation->OrderItem->find('list');
		$variations = $this->OrderVariation->Variation->find('list');
		$this->set(compact('orderItems', 'variations'));
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
		$this->OrderVariation->id = $id;
		if (!$this->OrderVariation->exists()) {
			throw new NotFoundException(__('Invalid order variation'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->OrderVariation->delete()) {
			$this->Session->setFlash(__('Order variation deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Order variation was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


}
