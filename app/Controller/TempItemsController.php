<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * TempItems Controller
 *
 * @property TempItem $TempItem
 */
class TempItemsController extends AdminController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->TempItem->recursive = 0;
		$this->set('tempItems', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TempItem->exists($id)) {
			throw new NotFoundException(__('Invalid temp item'));
		}
		$options = array('conditions' => array('TempItem.' . $this->TempItem->primaryKey => $id));
		$this->set('tempItem', $this->TempItem->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TempItem->create();
			if ($this->TempItem->save($this->request->data)) {
				$this->Session->setFlash(__('The temp item has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The temp item could not be saved. Please, try again.'));
			}
		}
		$tempOrders = $this->TempItem->TempOrder->find('list');
		$items = $this->TempItem->Item->find('list');
		$this->set(compact('tempOrders', 'items'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->TempItem->exists($id)) {
			throw new NotFoundException(__('Invalid temp item'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->TempItem->save($this->request->data)) {
				$this->Session->setFlash(__('The temp item has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The temp item could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('TempItem.' . $this->TempItem->primaryKey => $id));
			$this->request->data = $this->TempItem->find('first', $options);
		}
		$tempOrders = $this->TempItem->TempOrder->find('list');
		$items = $this->TempItem->Item->find('list');
		$this->set(compact('tempOrders', 'items'));
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
		$this->TempItem->id = $id;
		if (!$this->TempItem->exists()) {
			throw new NotFoundException(__('Invalid temp item'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->TempItem->delete()) {
			$this->Session->setFlash(__('Temp item deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Temp item was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}
