<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * DeductionAdditions Controller
 *
 * @property DeductionAddition $DeductionAddition
 */
class DeductionAdditionsController extends AdminController {
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
	  //If is post, filter by date range
	  if($this->request->is('post')){
  	  //Get Start and End Date of Range
  	  if(strrpos($this->request->data['DeductionAddition']['date_range'], ' - ')){
    		$date_range = explode(" - ",$this->request->data['DeductionAddition']['date_range']);
        $start_date = $date_range[0];
        $end_date = $date_range[1];
  		} else {
    		$start_date = $this->request->data['DeductionAddition']['date_range'];
    		$end_date = $start_date;
  		}
  		//Initiate Conditions array
	    $conditions = array();
      //Set Start Date Condition
  	  if($start_date != 'all' && $start_date != ''){
    		//Add Start Date Condition
    		$start_condition = "DeductionAddition.date >= STR_TO_DATE('" . date('Y-m-d',strtotime($start_date)) . " 00:00:00', '%Y-%m-%d %H:%i:%s')";
    		array_push($conditions,$start_condition);
  		}
  		//Set End Date Condition
  		if($end_date != 'all' && $end_date != ''){
    		//Add End Date Condition
    		$end_condition = "DeductionAddition.date <= STR_TO_DATE('" . date('Y-m-d',strtotime($end_date)) . " 23:59:59', '%Y-%m-%d %H:%i:%s')";
    		array_push($conditions,$end_condition);
  		} 
  		
  	  //Get Orders and Paginate 
  		 $this->paginate = array(	  
       'conditions'=> $conditions,
  	   'order'=>array('date'),
  	   'limit'=>25
  	  );
		}
		$this->DeductionAddition->recursive = 0;
		$this->set('deductionadditions', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DeductionAddition->exists($id)) {
			throw new NotFoundException(__('Invalid temp variation'));
		}
		$options = array('conditions' => array('DeductionAddition.' . $this->DeductionAddition->primaryKey => $id));
		$this->set('DeductionAddition', $this->DeductionAddition->find('first', $options));
	}
/**
 * bycity - view orders by city
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function bycity($city_id = null) {
    
		if ($this->request->is('post')) {

  		$this->DeductionAddition->create();
			if ($this->DeductionAddition->save($this->request->data)) {
				$this->Session->setFlash(__('The Deduction/Addition has been saved'),'flash_good');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Deduction/Addition could not be saved. Please, try again.'),'flash_bad');
			}

    }

		$this->loadModel('City');
		$cities = $this->City->find('list');
		if($city_id != null && $city_id != 'all')
		  $restaurants = $this->DeductionAddition->Restaurant->find('list',array('conditions'=>array('Restaurant.city_id'=>$city_id)));
		else
		  $restaurants = $this->DeductionAddition->Restaurant->find('list');
		$this->set(compact('city_id','cities','restaurants'));
  }

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DeductionAddition->create();
			if ($this->DeductionAddition->save($this->request->data)) {
				$this->Session->setFlash(__('The Deduction/Addition has been saved'),'flash_good');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Deduction/Addition could not be saved. Please, try again.'),'flash_bad');
			}
		}
		$restaurants = $this->DeductionAddition->Restaurant->find('list');
		$this->set(compact('restaurants'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->DeductionAddition->exists($id)) {
			throw new NotFoundException(__('Invalid temp variation'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->DeductionAddition->save($this->request->data)) {
				$this->Session->setFlash(__('The temp variation has been saved'),'flash_good');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The temp variation could not be saved. Please, try again.'),'flash_bad');
			}
		} else {
			$options = array('conditions' => array('DeductionAddition.' . $this->DeductionAddition->primaryKey => $id));
			$this->request->data = $this->DeductionAddition->find('first', $options);
		}
		$restaurants = $this->DeductionAddition->Restaurant->find('list');
		$this->set(compact('restaurants'));
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
		$this->DeductionAddition->id = $id;
		if (!$this->DeductionAddition->exists()) {
			throw new NotFoundException(__('Invalid temp variation'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->DeductionAddition->delete()) {
			$this->Session->setFlash(__('Temp variation deleted'),'flash_good');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Temp variation was not deleted'),'flash_bad');
		$this->redirect(array('action' => 'index'));
	}

}
