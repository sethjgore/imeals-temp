<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * PaymentInfos Controller
 *
 * @property PaymentInfo $PaymentInfo
 */
class PaymentInfosController extends AdminController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PaymentInfo->recursive = 0;
		$this->set('paymentInfos', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PaymentInfo->exists($id)) {
			throw new NotFoundException(__('Invalid payment info'));
		}
		$options = array('conditions' => array('PaymentInfo.' . $this->PaymentInfo->primaryKey => $id));
		$this->set('paymentInfo', $this->PaymentInfo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PaymentInfo->create();
			if ($this->PaymentInfo->save($this->request->data)) {
				$this->Session->setFlash(__('The payment info has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment info could not be saved. Please, try again.'));
			}
		}
		$users = $this->PaymentInfo->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PaymentInfo->exists($id)) {
			throw new NotFoundException(__('Invalid payment info'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PaymentInfo->save($this->request->data)) {
				$this->Session->setFlash(__('The payment info has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment info could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PaymentInfo.' . $this->PaymentInfo->primaryKey => $id));
			$this->request->data = $this->PaymentInfo->find('first', $options);
		}
		$users = $this->PaymentInfo->User->find('list');
		$this->set(compact('users'));
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
		$this->PaymentInfo->id = $id;
		if (!$this->PaymentInfo->exists()) {
			throw new NotFoundException(__('Invalid payment info'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PaymentInfo->delete()) {
			$this->Session->setFlash(__('Payment info deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Payment info was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
