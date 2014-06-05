<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * RestaurantOrderTypes Controller
 *
 * @property RestaurantOrderType $RestaurantOrderType
 */
class RestaurantOrderTypesController extends AdminController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->RestaurantOrderType->recursive = 0;
		$this->set('restaurantOrderTypes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RestaurantOrderType->exists($id)) {
			throw new NotFoundException(__('Invalid restaurant order type'));
		}
		$options = array('conditions' => array('RestaurantOrderType.' . $this->RestaurantOrderType->primaryKey => $id));
		$this->set('restaurantOrderType', $this->RestaurantOrderType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($rest_id = null,$order_type_id = null,$order_type_name=null) {
	
	  $exist = $this->RestaurantOrderType->find('first',array('conditions'=>array('restaurant_id'=> $rest_id,'order_type_id'=>$order_type_id)));
	  
	  if ($this->request->is('post')) {
			$this->RestaurantOrderType->create();
			//If order type for this restaurant already exists, do not create a new
		  if(empty($exist)){
    			if ($this->RestaurantOrderType->save($this->request->data)) {
    			  $this->RestaurantOrderType->Restaurant->id = $rest_id;
    			  // 1	Personal Pickup
            // 2	Personal Delivery
            // 3	ME Pickup
            // 4	ME Delivery
            // 5	ME Catering Pickup	
            // 6	ME Catering Delivery
            // 7	Virtual Cafe
    			  if($this->request->data['RestaurantOrderType']['order_type_id'] == 1){
      			  $this->RestaurantOrderType->Restaurant->saveField('po_pickup_configured',$this->RestaurantOrderType->id);
      			  $this->RestaurantOrderType->Restaurant->saveField('po_pickup',1);    
    			  }
    			  if($this->request->data['RestaurantOrderType']['order_type_id'] == 2){
      			  $this->RestaurantOrderType->Restaurant->saveField('po_delivery_configured',$this->RestaurantOrderType->id);
      			  $this->RestaurantOrderType->Restaurant->saveField('po_delivery',1);    
    			  }
    				$this->Session->setFlash(__('The restaurant order type has been saved'),'flash_good');
    				$this->redirect(array('controller'=>'restaurants','action' => 'add_5',$rest_id));
    			} else {
    				$this->Session->setFlash(__('The restaurant order type could not be saved. Please, try again.'),'flash_bad');
    			}
       } else {
         $this->Session->setFlash('The restaurant order type already exists. Please edit it below','flash_good');
         $this->redirect(array('controller' => 'RestaurantOrderTypes', 'action' => 'edit', $exist['RestaurantOrderType']['id']));
       }
		}
		$restaurants = $this->RestaurantOrderType->Restaurant->find('list');
		//Get Restaurant Address
		$this->loadModel('Restaurant');
		$restaurant = $this->Restaurant->find('first',array(
	   		'conditions'=>array('Restaurant.id'=>$rest_id)
	   	));
	   	
		$orderTypes = $this->RestaurantOrderType->OrderType->find('list');
		
    if($rest_id != null)
      $this->set('restaurant_id', $rest_id);

    if($order_type_id != null)
      $this->set('order_type_id', $order_type_id);

    if($order_type_name != null)
	   	$address = $restaurant['Restaurant']['address'].' '.$restaurant['Restaurant']['zip'];
	   	$addressinfo = $this->Geocoder->getLatLng($address);
		$this->set('address', $addressinfo);	
		
      	$this->set('order_type_name', $order_type_name);
		$this->set(compact('restaurants', 'orderTypes'));
		if(!empty($exist)){
  		$this->Session->setFlash('The restaurant order type already exists. Please edit it below','flash_good');
         $this->redirect(array('controller' => 'RestaurantOrderTypes', 'action' => 'edit', $exist['RestaurantOrderType']['id']));
		}
	}
	
	public function success(){
  	
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public $components = array('Geocoder');
public function edit($id = null) {
		$this->loadModel('OrderType');	
		if (!$this->RestaurantOrderType->exists($id)) {
			throw new NotFoundException(__('Invalid restaurant order type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RestaurantOrderType->save($this->request->data)) {
				$this->Session->setFlash(__('The restaurant order type has been saved'),'flash_good');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The restaurant order type could not be saved. Please, try again.'),'flash_bad');
			}
		} else {
			$options = array('conditions' => array('RestaurantOrderType.' . $this->RestaurantOrderType->primaryKey => $id));
			$this->request->data = $this->RestaurantOrderType->find('first', $options);
		}
		$restaurants = $this->RestaurantOrderType->Restaurant->find('list');
		
		//Get Restaurant Address
		$this->loadModel('Restaurant');
		$restaurant = $this->Restaurant->find('first',array(
	   		'conditions'=>array('Restaurant.id'=>$this->request->data['RestaurantOrderType']['restaurant_id'])
	   	));
	   	
	   	//Get Order Type
	   	$options = array('conditions' => array('id'=> $this->request->data['RestaurantOrderType']['order_type_id']));
		$orderTypes = $this->OrderType->find('first', $options);
	   	$this->set('RestOrderType', $orderTypes);
	   			
	   	//Geocode address
	   	if(isset($restaurant) && !empty($restaurant)) {
	   		$this->set(compact('restaurant', $restaurant));
	   		$this->set(compact('RestaurantOrderType', $this->request->data['RestaurantOrderType']));

		   	$address = $restaurant['Restaurant']['address'].' '.$restaurant['Restaurant']['zip'];
		   	$addressinfo = $this->Geocoder->getLatLng($address);
			$this->set('address', $addressinfo);	   	
		}
				
		$this->set(compact('restaurants', 'orderTypes'));
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
		$this->RestaurantOrderType->id = $id;
		if (!$this->RestaurantOrderType->exists()) {
			throw new NotFoundException(__('Invalid restaurant order type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->RestaurantOrderType->delete()) {
			$this->Session->setFlash(__('Restaurant order type deleted'),'flash_good');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Restaurant order type was not deleted'),'flash_bad');
		$this->redirect(array('action' => 'index'));
	}
}
