<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * Timezones Controller
 *
 * @property Timezone $Timezone
 */
class TimezonesController extends AdminController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Timezone->recursive = 0;
		$this->set('timezones', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Timezone->exists($id)) {
			throw new NotFoundException(__('Invalid timezone'));
		}
		$options = array('conditions' => array('Timezone.' . $this->Timezone->primaryKey => $id));
		$this->set('timezone', $this->Timezone->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Timezone->create();
			if ($this->Timezone->save($this->request->data)) {
				$this->Session->setFlash(__('The timezone has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The timezone could not be saved. Please, try again.'));
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
		if (!$this->Timezone->exists($id)) {
			throw new NotFoundException(__('Invalid timezone'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Timezone->save($this->request->data)) {
				$this->Session->setFlash(__('The timezone has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The timezone could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Timezone.' . $this->Timezone->primaryKey => $id));
			$this->request->data = $this->Timezone->find('first', $options);
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
		$this->Timezone->id = $id;
		if (!$this->Timezone->exists()) {
			throw new NotFoundException(__('Invalid timezone'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Timezone->delete()) {
			$this->Session->setFlash(__('Timezone deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Timezone was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}
