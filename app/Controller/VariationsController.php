<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * Variations Controller
 *
 * @property Variation $Variation
 */
class VariationsController extends AdminController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Variation->recursive = 0;
		$this->set('variations', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Variation->exists($id)) {
			throw new NotFoundException(__('Invalid variation'));
		}
		$options = array('conditions' => array('Variation.' . $this->Variation->primaryKey => $id));
		$this->set('variation', $this->Variation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Variation->create();
			if ($this->Variation->save($this->request->data)) {
				$this->Session->setFlash(__('The variation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The variation could not be saved. Please, try again.'));
			}
		}
		$variationGroups = $this->Variation->VariationGroup->find('list');
		$this->set(compact('variationGroups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Variation->exists($id)) {
			throw new NotFoundException(__('Invalid variation'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Variation->save($this->request->data)) {
				$this->Session->setFlash(__('The variation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The variation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Variation.' . $this->Variation->primaryKey => $id));
			$this->request->data = $this->Variation->find('first', $options);
		}
		$variationGroups = $this->Variation->VariationGroup->find('list');
		$this->set(compact('variationGroups'));
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
		$this->Variation->id = $id;
		if (!$this->Variation->exists()) {
			throw new NotFoundException(__('Invalid variation'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Variation->delete()) {
			$this->Session->setFlash(__('Variation deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Variation was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * deactivate method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function deactivate($id = null) {
		$this->layout = 'ajax';
		$this->Variation->id = $id;
		if (!$this->Variation->exists()) {
			throw new NotFoundException(__('Invalid variation group'));
		}
		$this->request->onlyAllow('ajax');
		if($this->Variation->saveField('active',0)){
  		$this->render('deactivated','ajax');
		}
	}
	
/**
 * reorder method
 *
 */
	public function reorder() {
  	foreach ($this->request->data['Variation'] as $key => $value) {
  		$this->Variation->id = $value;
  		$this->Variation->saveField("sort_order",$key + 1);
  	}
  	//$this->log(print_r($this->request->data,true));
  	exit();
  }	
}
