<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * Orders Controller
 *
 * @property Order $Order
 */
class OrdersController extends AdminController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Order->recursive = 0;
		$this->set('orders', $this->paginate());
	}

/**
 * Search method
 *
 * @return void
 */
	public function search() {
	  $this->Order->recursive = 1;
	  $conditions = array('Order.restaurant_id = restaurants.id');
      
		$city_id = $_SESSION['search_city_id'];
		$restaurant_id = $_SESSION['search_restaurant_id'];
		$start_date = $_SESSION['search_start_date'];
		$end_date = $_SESSION['search_end_date'];
		$city_name = '';
		$restaurant_name = '';
		
		if($start_date != 'all'){
  		//Add Start Date Condition
  		$start_condition = "Order.order_date >= STR_TO_DATE('" . date('Y-m-d',strtotime($start_date)) . " 00:00:00', '%Y-%m-%d %H:%i:%s')";
  		array_push($conditions,$start_condition);
		}
		if($end_date != 'all'){
  		//Add End Date Condition
  		$end_condition = "Order.order_date <= STR_TO_DATE('" . date('Y-m-d',strtotime($end_date)) . " 23:59:59', '%Y-%m-%d %H:%i:%s')";
  		array_push($conditions,$end_condition);
		} 
		if($city_id != "all"){
		  //Add City Condition
		  $city_condition = 'restaurants.city_id = '.$city_id;
		  array_push($conditions,$city_condition);
		  //Find City Name
		  $this->loadModel('City');
      $city_name = $this->City->find('first',array('conditions'=>array('City.id'=>$city_id),'fields'=>array('name')));
		}
		if($restaurant_id != "all"){
		  //Add Restaurant Condition
		  $rest_condition = 'Order.restaurant_id = '.$restaurant_id;
		  array_push($conditions,$rest_condition);
		  //Find Restaurant Name
		  $restaurant_name = $this->Order->Restaurant->find('first',array('conditions'=>array('Restaurant.id'=>$restaurant_id),'fields'=>array('name')));
    }
    
    //If post filter by order id
    if ($this->request->is('post')) {
      if($this->request->data['Order']['order_type_id'] != ''){
         $type_condition = 'Order.order_type_id = ' . $this->request->data['Order']['order_type_id'];
         array_push($conditions, $type_condition);
         $this->set('order_type_id',$this->request->data['Order']['order_type_id']);
      }
    }
    
		 //Get Orders and Paginate 
		 $this->paginate = array(
	  'joins' => array(
	    array(
		    'table'=>'restaurants',
		    'alias'=>'restaurants',
		    'type'=>'inner',
		    'conditions'=> $conditions
		    )
	   ),
	   'order'=>array('order_date'),
	   'limit'=>25
	  );
	  		
		$this->set('orders', $this->paginate());
    
    //Get Gross Sales and Average Order
    $total = $this->Order->find('all', array(
      'fields' => array('SUM(Order.total) as gross_total'), 
      'joins' => array(
        array(
          'table'=>'restaurants',
  		    'alias'=>'restaurants',
  		    'type'=>'inner',
  		    'conditions'=> $conditions
        )
      )));
      
    //Get all Order Types
    $orderTypes = $orderTypes = $this->Order->OrderType->find('list');
    $this->set(compact('city_id','restaurant_id','city_name','restaurant_name','start_date','end_date','total','orderTypes'));
      
	}
	
	/** detailed_report 
	*
	*
	*/
	public function detailed_report($order_type_id = null){
    $this->Order->recursive = 1;
	  $conditions = array('Order.restaurant_id = restaurants.id');
      
		$city_id = $_SESSION['search_city_id'];
		$restaurant_id = $_SESSION['search_restaurant_id'];
		$start_date = $_SESSION['search_start_date'];
		$end_date = $_SESSION['search_end_date'];
		$city_name = '';
		$restaurant_name = '';
		
		if($start_date != 'all'){
  		//Add Start Date Condition
  		$start_condition = "Order.order_date >= STR_TO_DATE('" . date('Y-m-d',strtotime($start_date)) . " 00:00:00', '%Y-%m-%d %H:%i:%s')";
  		array_push($conditions,$start_condition);
		}
		if($end_date != 'all'){
  		//Add End Date Condition
  		$end_condition = "Order.order_date <= STR_TO_DATE('" . date('Y-m-d',strtotime($end_date)) . " 23:59:59', '%Y-%m-%d %H:%i:%s')";
  		array_push($conditions,$end_condition);
		} 
		if($city_id != "all"){
		  //Add City Condition
		  $city_condition = 'restaurants.city_id = '.$city_id;
		  array_push($conditions,$city_condition);
		  //Find City Name
		  $this->loadModel('City');
      $city_name = $this->City->find('first',array('conditions'=>array('City.id'=>$city_id),'fields'=>array('name')));
		}
		if($restaurant_id != "all"){
		  //Add Restaurant Condition
		  $rest_condition = 'Order.restaurant_id = '.$restaurant_id;
		  array_push($conditions,$rest_condition);
		  //Find Restaurant Name
		  $restaurant_name = $this->Order->Restaurant->find('first',array('conditions'=>array('Restaurant.id'=>$restaurant_id),'fields'=>array('name')));
    }
    
    //If order id passed in
    if ($order_type_id != null) {
       $type_condition = 'Order.order_type_id = ' . $order_type_id;
       array_push($conditions, $type_condition);
       $this->set('order_type_id',$order_type_id);
    }
    
		 //Get Orders Total 
		$order_counts = $this->Order->find('all',  array(
	  'joins' => array(
	    array(
		    'table'=>'restaurants',
		    'alias'=>'restaurants',
		    'type'=>'inner',
		    'conditions'=> $conditions
		    )
	   ),
	   'contain' => array(
	      'OrderType'
	   ),
	   'fields'=>array('Order.order_type_id, Count(Order.id) as OrderCount,OrderType.name'),
	   'group' => 'Order.order_type_id'
	  ));
    
    //Get Order Type Count
    
    
    //Get Gross Sales and Average Order
    $total = $this->Order->find('all', array(
      'fields' => array('SUM(Order.total) as gross_total, SUM(Order.sub_total) as sub_total, SUM(Order.tip) as tip,SUM(Order.tax) as tax'), 
      'joins' => array(
        array(
          'table'=>'restaurants',
  		    'alias'=>'restaurants',
  		    'type'=>'inner',
  		    'conditions'=> $conditions
        )
      )));
      
    //Get all Order Types
    $this->set(compact('city_id','restaurant_id','city_name','restaurant_name','start_date','end_date','total','order_counts'));
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
  		$city_id = $this->request->data['Order']['cities'];
  		$restaurant_id = $this->request->data['Order']['restaurants'];
  		
  		if(strrpos($this->request->data['Order']['date_range'], ' - ')){
    		$date_range = explode(" - ",$this->request->data['Order']['date_range']);
        $start_date = $date_range[0];
        $end_date = $date_range[1];
  		} else {
    		$start_date = $this->request->data['Order']['date_range'];
    		$end_date = $start_date;
  		}
  		if($city_id != "" && $city_id != null){
  		  $_SESSION['search_city_id'] = $city_id;
  		} else {
    		$_SESSION['search_city_id'] = 'all';
  		}
  		if($restaurant_id != "" && $restaurant_id != null){
  		  $_SESSION['search_restaurant_id'] = $restaurant_id;
      } else {
        $_SESSION['search_restaurant_id'] = 'all';
      }
      if($start_date != "" && $start_date != null){
  		  $_SESSION['search_start_date'] = $start_date;
      } else {
        $_SESSION['search_start_date'] = 'all';
      }
      if($end_date != "" && $end_date != null){
  		  $_SESSION['search_end_date'] = $end_date;
      } else {
        $_SESSION['search_end_date'] = 'all';
      }
      $this->redirect(array('action' => 'search'));

    }

		$this->loadModel('City');
		$cities = $this->City->find('list');
		if($city_id != null && $city_id != 'all')
		  $restaurants = $this->Order->Restaurant->find('list',array('conditions'=>array('Restaurant.city_id'=>$city_id,'Restaurant.active'=>1)));
		else
		  $restaurants = $this->Order->Restaurant->find('list',array('conditions'=>array('Restaurant.active'=>1)));
		$this->set(compact('city_id','cities','restaurants'));
  }

/**
 * deductions_additions method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	
	public function deductions_additions($city_id = null) {
    
    $this->loadModel('City');
      $city_name = $this->City->find('first',array('conditions'=>array('City.id'=>$city_id),'fields'=>array('name')));
    if($city_id != null && $city_id != 'all')
		  $restaurants = $this->Order->Restaurant->find('list',array('conditions'=>array('Restaurant.city_id'=>$city_id)));
		else
		  $restaurants = $this->Order->Restaurant->find('list');
		$this->set(compact('city_id','city_name','restaurants'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
	  $this->Order->recursive = 0;
		if (!$this->Order->exists($id)) {
			throw new NotFoundException(__('Invalid order'));
		}
		$options = array(
		  'conditions' => array('Order.' . $this->Order->primaryKey => $id),
		  'contain' => array(
		    'Restaurant'=>array('City'=>array('State')),
		    'User',
		    'OrderItem' => array('Item','OrderVariation'=>array('Variation')),
		    'OrderType'
		  ));
		$this->set('order', $this->Order->find('first', $options));
	}
	
	public function checkout(){
  	
	}
/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Order->create();
			if ($this->Order->save($this->request->data)) {
				$this->Session->setFlash(__('The order has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The order could not be saved. Please, try again.'));
			}
		}
		$restaurants = $this->Order->Restaurant->find('list');
		$promoCodes = $this->Order->PromoCode->find('list');
		$users = $this->Order->User->find('list');
		$orderTypes = $this->Order->OrderType->find('list');
		$virtualCaves = $this->Order->VirtualCafe->find('list');
		$this->set(compact('restaurants', 'promoCodes', 'users', 'orderTypes', 'virtualCaves'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Order->exists($id)) {
			throw new NotFoundException(__('Invalid order'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Order->save($this->request->data)) {
				$this->Session->setFlash(__('The order has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The order could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id));
			$this->request->data = $this->Order->find('first', $options);
		}
		$restaurants = $this->Order->Restaurant->find('list');
		$promoCodes = $this->Order->PromoCode->find('list');
		$users = $this->Order->User->find('list');
		$orderTypes = $this->Order->OrderType->find('list');
		$virtualCaves = $this->Order->VirtualCafe->find('list');
		$this->set(compact('restaurants', 'promoCodes', 'users', 'orderTypes', 'virtualCaves'));
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
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			throw new NotFoundException(__('Invalid order'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Order->delete()) {
			$this->Session->setFlash(__('Order deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Order was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


}
