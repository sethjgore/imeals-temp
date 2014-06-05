<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * States Controller
 *
 * @property State $State
 */
class StatesController extends AdminController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->State->recursive = 0;
		$this->set('states', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->State->exists($id)) {
			throw new NotFoundException(__('Invalid state'));
		}
		$options = array('conditions' => array('State.' . $this->State->primaryKey => $id));
		$this->set('state', $this->State->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->State->create();
			if ($this->State->save($this->request->data)) {
				$this->Session->setFlash(__('The state has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The state could not be saved. Please, try again.'));
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
		if (!$this->State->exists($id)) {
			throw new NotFoundException(__('Invalid state'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->State->save($this->request->data)) {
				$this->Session->setFlash(__('The state has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The state could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('State.' . $this->State->primaryKey => $id));
			$this->request->data = $this->State->find('first', $options);
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
		$this->State->id = $id;
		if (!$this->State->exists()) {
			throw new NotFoundException(__('Invalid state'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->State->delete()) {
			$this->Session->setFlash(__('State deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('State was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}
