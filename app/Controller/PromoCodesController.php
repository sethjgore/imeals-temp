<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * PromoCodes Controller
 *
 * @property PromoCode $PromoCode
 */
class PromoCodesController extends AdminController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PromoCode->recursive = 0;
		$this->set('promoCodes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PromoCode->exists($id)) {
			throw new NotFoundException(__('Invalid promo code'));
		}
		$options = array('conditions' => array('PromoCode.' . $this->PromoCode->primaryKey => $id));
		$this->set('promoCode', $this->PromoCode->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PromoCode->create();
			if ($this->PromoCode->save($this->request->data)) {
				$this->Session->setFlash(__('The promo code has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The promo code could not be saved. Please, try again.'));
			}
		}
		$promotions = $this->PromoCode->Promotion->find('list');
		$this->set(compact('promotions'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PromoCode->exists($id)) {
			throw new NotFoundException(__('Invalid promo code'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PromoCode->save($this->request->data)) {
				$this->Session->setFlash(__('The promo code has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The promo code could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PromoCode.' . $this->PromoCode->primaryKey => $id));
			$this->request->data = $this->PromoCode->find('first', $options);
		}
		$promotions = $this->PromoCode->Promotion->find('list');
		$this->set(compact('promotions'));
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
		$this->PromoCode->id = $id;
		if (!$this->PromoCode->exists()) {
			throw new NotFoundException(__('Invalid promo code'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PromoCode->delete()) {
			$this->Session->setFlash(__('Promo code deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Promo code was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}
