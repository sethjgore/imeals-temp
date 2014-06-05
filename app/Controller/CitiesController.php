<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 */
class CitiesController extends AdminController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->City->recursive = 0;
		$this->set('cities', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->City->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		$this->City->recursive = 1;
		$options = array('conditions' => array('City.' . $this->City->primaryKey => $id));
		$this->set('city', $this->City->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
		  
		  $data = $this->request->data;
		  $user_id = $this->City->addCityUser($data);
		  
		  $data['User'] = array('User'=>array('0'=>$user_id));
		 
			//$this->City->create();
			
			if ($this->City->saveAll($data)) {
				$this->Session->setFlash(__('The city has been saved'),'flash_good');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The city could not be saved. Please, try again.'),'flash_bad');
			}
		}
		$states = $this->City->State->find('list');
		$timezones = $this->City->Timezone->find('list',array('fields'=>array('zone_desc')));
		$users = $this->City->User->find('list', array(
		  'fields' => array('User.id', 'User.user_email'),
		  'order' => array('User.user_email'),
		  'joins' => array(
		    array(
  		    'table'=>'users_groups',
  		    'alias'=>'UserGroups',
  		    'type'=>'inner',
  		    'conditions'=> array('UserGroups.user_id = User.id')
  		    ),
  		  array(
  		    'table'=>'groups',
  		    'alias'=>'Groups',
  		    'type'=>'inner',
  		    'conditions'=> array("UserGroups.group_id = Groups.id","Groups.id = 3")
  		    )
		  )
		  ));
		$this->set(compact('states', 'timezones', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->City->exists($id)) {
			throw new NotFoundException(__('Invalid city'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->City->save($this->request->data)) {
				$this->Session->setFlash(__('The city has been saved'),'flash_good');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The city could not be saved. Please, try again.'),'flash_bad');
			}
		} else {
			$options = array('conditions' => array('City.' . $this->City->primaryKey => $id),'contain'=>'User');
			$this->request->data = $this->City->find('first', $options);
		}
		
		$states = $this->City->State->find('list');
		$timezones = $this->City->Timezone->find('list',array('fields'=>array('zone_desc')));
		$users = $this->City->User->find('list', array(
		  'fields' => array('User.id', 'User.user_email'),
		  'order' => array('User.user_email'),
		  'joins' => array(
		    array(
  		    'table'=>'users_groups',
  		    'alias'=>'UserGroups',
  		    'type'=>'inner',
  		    'conditions'=> array('UserGroups.user_id = User.id')
  		    ),
  		  array(
  		    'table'=>'groups',
  		    'alias'=>'Groups',
  		    'type'=>'inner',
  		    'conditions'=> array("UserGroups.group_id = Groups.id","Groups.id = 3")
  		    )
		  )
		  ));

		$this->set(compact('states', 'timezones', 'users'));
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
		$this->City->id = $id;
		if (!$this->City->exists()) {
			throw new NotFoundException(__('Invalid city'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->City->delete()) {
			$this->Session->setFlash(__('City deleted'),'flash_good');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('City was not deleted'),'flash_bad');
		$this->redirect(array('action' => 'index'));
	}

}
