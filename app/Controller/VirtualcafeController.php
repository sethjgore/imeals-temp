<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * Virtualcafe Controller
 *
 * @property Virtualcafe $Virtualcafe
 */
class VirtualcafeController extends AdminController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Virtualcafe->recursive = 0;
		$this->set('virtualcafe', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Virtualcafe->exists($id)) {
			throw new NotFoundException(__('Invalid virtualcafe'));
		}
		$options = array('conditions' => array('Virtualcafe.' . $this->Virtualcafe->primaryKey => $id));
		$this->set('virtualcafe', $this->Virtualcafe->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Virtualcafe->create();
			if ($this->Virtualcafe->save($this->request->data)) {
				$this->Session->setFlash(__('The virtualcafe has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The virtualcafe could not be saved. Please, try again.'));
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
		if (!$this->Virtualcafe->exists($id)) {
			throw new NotFoundException(__('Invalid virtualcafe'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Virtualcafe->save($this->request->data)) {
				$this->Session->setFlash(__('The virtualcafe has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The virtualcafe could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Virtualcafe.' . $this->Virtualcafe->primaryKey => $id));
			$this->request->data = $this->Virtualcafe->find('first', $options);
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
		$this->Virtualcafe->id = $id;
		if (!$this->Virtualcafe->exists()) {
			throw new NotFoundException(__('Invalid virtualcafe'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Virtualcafe->delete()) {
			$this->Session->setFlash(__('Virtualcafe deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Virtualcafe was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
