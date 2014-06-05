<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * OrderTypes Controller
 *
 * @property OrderType $OrderType
 */
class OrderTypesController extends AdminController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->OrderType->recursive = 0;
		$this->set('orderTypes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->OrderType->exists($id)) {
			throw new NotFoundException(__('Invalid order type'));
		}
		$options = array('conditions' => array('OrderType.' . $this->OrderType->primaryKey => $id));
		$this->set('orderType', $this->OrderType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->OrderType->create();
			if ($this->OrderType->save($this->request->data)) {
				$this->Session->setFlash(__('The order type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The order type could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->OrderType->exists($id)) {
			throw new NotFoundException(__('Invalid order type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->OrderType->save($this->request->data)) {
				$this->Session->setFlash(__('The order type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The order type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('OrderType.' . $this->OrderType->primaryKey => $id));
			$this->request->data = $this->OrderType->find('first', $options);
		}
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
		$this->OrderType->id = $id;
		if (!$this->OrderType->exists()) {
			throw new NotFoundException(__('Invalid order type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->OrderType->delete()) {
			$this->Session->setFlash(__('Order type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Order type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


}
