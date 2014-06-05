<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * Promotions Controller
 *
 * @property Promotion $Promotion
 */
class PromotionsController extends AdminController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Promotion->recursive = 1;
		$this->paginate = array(
        'conditions' => array("Promotion.expire > STR_TO_DATE('" . date('Y-m-d',time()) . " 00:00:00', '%Y-%m-%d %H:%i:%s')"
      )
    );
		$this->set('promotions', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Promotion->exists($id)) {
			throw new NotFoundException(__('Invalid promotion'));
		}
		$options = array('conditions' => array('Promotion.' . $this->Promotion->primaryKey => $id));
		$this->set('promotion', $this->Promotion->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
		  $data = $this->request->data;
		  //Save all codes from comma delimated text box
		  $codes = explode(',',$data['Promotion']['codes']);
		  $data['PromoCode'] = array();
		  $i=0;
		  foreach($codes as $code):
  		  $data['PromoCode'][$i]['code'] = trim($code);
  		  $i++;
  		endforeach;
			$this->Promotion->create();
			
      if ($this->Promotion->saveAll($data)) {
				$this->Session->setFlash(__('The promotion has been saved'),'flash_good');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The promotion could not be saved. Please, try again.'),'flash_bad');
			}

		}
		$orderTypes = $this->Promotion->OrderType->find('list');
		$this->set(compact('orderTypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
	  $this->Promotion->recursive = 1;
		if (!$this->Promotion->exists($id)) {
			throw new NotFoundException(__('Invalid promotion'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
		  $data = $this->request->data;
		  //Save all codes from comma delimated text box
		  if($data['Promotion']['add_more_codes'] != ""):
  		  $codes = explode(',',$data['Promotion']['add_more_codes']);
  		  if(!isset($data['PromoCode'])){
    		  $data['PromoCode'] = array();
    		  $i=0;
  		  } else {
    		  $i = count($data['PromoCode']) + 1;
  		  }
  		  
  		  foreach($codes as $code):
    		  $data['PromoCode'][$i]['code'] = trim($code);
    		  $i++;
    		endforeach;
      endif;
			if ($this->Promotion->saveAll($data)) {
				$this->Session->setFlash(__('The promotion has been saved'),'flash_good');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The promotion could not be saved. Please, try again.'),'flash_bad');
			}
		} else {
			$options = array('conditions' => array('Promotion.' . $this->Promotion->primaryKey => $id));
			$this->request->data = $this->Promotion->find('first', $options);
		}
		$orderTypes = $this->Promotion->OrderType->find('list');
		$this->set(compact('orderTypes'));
	}

/**
 * expired method
 *
 * @throws NotFoundException
 * @return void
 */
	public function expired() {
	  $this->Promotion->recursive = 1;
	  if ($this->request->is('post') || $this->request->is('put')) {
	    $month = $this->request->data['Promotion']['filter_month']['month'];
	    $year = $this->request->data['Promotion']['filter_year']['year'];

  	  //If only Month is filtered, ask user to also fiter by year
  	  if($month != "" && $year == ""){
    	    $this->Session->setFlash(__('Please also select a year'),'flash_bad');
    	    $this->paginate = array(
            'conditions' => array("Promotion.expire < STR_TO_DATE('" . date('Y-m-d',time()) . " 00:00:00', '%Y-%m-%d %H:%i:%s')"
           )
          );
  	  } //If only year is filtered, return for that year
  	  elseif ($month == "" && $year != ""){
    	  $this->paginate = array(
            'conditions' => array("Promotion.expire >= STR_TO_DATE('" . date('Y-m-d',mktime(0,0,0,1,1,$year)) . " 00:00:00', '%Y-%m-%d %H:%i:%s') && Promotion.expire <= STR_TO_DATE('" . date('Y-m-d',mktime(0,0,0,12,31,$year)) . " 00:00:00', '%Y-%m-%d %H:%i:%s') && Promotion.expire < STR_TO_DATE('" . date('Y-m-d',time()) . " 00:00:00', '%Y-%m-%d %H:%i:%s')"
           )
          );
  	  }
  	  elseif ($month != "" && $year != ""){
    	  $this->paginate = array(
            'conditions' => array("Promotion.expire >= STR_TO_DATE('" . date('Y-m-d',mktime(0,0,0,$month,1,$year)) . " 00:00:00', '%Y-%m-%d %H:%i:%s') && Promotion.expire <= STR_TO_DATE('" . date('Y-m-d',mktime(0,0,0,$month,date('t',strtotime($month.'/1/'.$year)),$year)) . " 00:00:00', '%Y-%m-%d %H:%i:%s') && Promotion.expire < STR_TO_DATE('" . date('Y-m-d',time()) . " 00:00:00', '%Y-%m-%d %H:%i:%s')"
           )
          );
  	  }
	  } else {
  	  $this->paginate = array(
        'conditions' => array("Promotion.expire < STR_TO_DATE('" . date('Y-m-d',time()) . " 00:00:00', '%Y-%m-%d %H:%i:%s')"
       )
      );
	  }
	  
		$this->set('promotions', $this->paginate());
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
		$this->Promotion->id = $id;
		if (!$this->Promotion->exists()) {
			throw new NotFoundException(__('Invalid promotion'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Promotion->delete()) {
			$this->Session->setFlash(__('Promotion deleted'),'flash_good');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Promotion was not deleted'),'flash_bad');
		$this->redirect(array('action' => 'index'));
	}

}
