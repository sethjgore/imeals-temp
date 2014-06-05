<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * TempVariations Controller
 *
 * @property TempVariation $TempVariation
 */
class TempVariationsController extends AdminController {
/**
 * Before Filter Method
 *
 * return void
 */	
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('deleteAll');
	}
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->TempVariation->recursive = 0;
		$this->set('tempVariations', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TempVariation->exists($id)) {
			throw new NotFoundException(__('Invalid temp variation'));
		}
		$options = array('conditions' => array('TempVariation.' . $this->TempVariation->primaryKey => $id));
		$this->set('tempVariation', $this->TempVariation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TempVariation->create();
			if ($this->TempVariation->save($this->request->data)) {
				$this->Session->setFlash(__('The temp variation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The temp variation could not be saved. Please, try again.'));
			}
		}
		$tempItems = $this->TempVariation->TempItem->find('list');
		$variations = $this->TempVariation->Variation->find('list');
		$this->set(compact('tempItems', 'variations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->TempVariation->exists($id)) {
			throw new NotFoundException(__('Invalid temp variation'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->TempVariation->save($this->request->data)) {
				$this->Session->setFlash(__('The temp variation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The temp variation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('TempVariation.' . $this->TempVariation->primaryKey => $id));
			$this->request->data = $this->TempVariation->find('first', $options);
		}
		$tempItems = $this->TempVariation->TempItem->find('list');
		$variations = $this->TempVariation->Variation->find('list');
		$this->set(compact('tempItems', 'variations'));
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
		$this->TempVariation->id = $id;
		if (!$this->TempVariation->exists()) {
			throw new NotFoundException(__('Invalid temp variation'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->TempVariation->delete()) {
			$this->Session->setFlash(__('Temp variation deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Temp variation was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}
