<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * VariationGroups Controller
 *
 * @property VariationGroup $VariationGroup
 */
class VariationGroupsController extends AdminController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->VariationGroup->recursive = 0;
		$this->set('variationGroups', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->VariationGroup->exists($id)) {
			throw new NotFoundException(__('Invalid variation group'));
		}
		$options = array('conditions' => array('VariationGroup.' . $this->VariationGroup->primaryKey => $id));
		$this->set('variationGroup', $this->VariationGroup->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->VariationGroup->create();
			if ($this->VariationGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The variation group has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The variation group could not be saved. Please, try again.'));
			}
		}
		$items = $this->VariationGroup->Item->find('list');
		$this->set(compact('items'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->VariationGroup->exists($id)) {
			throw new NotFoundException(__('Invalid variation group'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->VariationGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The variation group has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The variation group could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('VariationGroup.' . $this->VariationGroup->primaryKey => $id));
			$this->request->data = $this->VariationGroup->find('first', $options);
		}
		$items = $this->VariationGroup->Item->find('list');
		$this->set(compact('items'));
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
		$this->VariationGroup->id = $id;
		if (!$this->VariationGroup->exists()) {
			throw new NotFoundException(__('Invalid variation group'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->VariationGroup->delete()) {
			$this->Session->setFlash(__('Variation group deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Variation group was not deleted'));
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
		$this->VariationGroup->id = $id;
		if (!$this->VariationGroup->exists()) {
			throw new NotFoundException(__('Invalid variation group'));
		}
		$this->request->onlyAllow('ajax');
		if($this->VariationGroup->saveField('active',0)){
  		$this->render('deactivated','ajax');
		}
	}
	
/**
 * reorder method
 *
 */
	public function reorder() {
  	foreach ($this->request->data['VariationGroup'] as $key => $value) {
  		$this->VariationGroup->id = $value;
  		$this->VariationGroup->saveField("sort_order",$key + 1);
  	}
  	//$this->log(print_r($this->request->data,true));
  	exit();
  }	
	
}
