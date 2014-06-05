<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * TempOrders Controller
 *
 * @property TempOrder $TempOrder
 */
class TempOrdersController extends AdminController {
/**
 * Before Filter Method
 *
 * return void
 */	
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('additem', 'updateitem','deleteitem', 'updateOrderTotal', 'getOrderTotal', 'getOrderDetails',
		'getTempOrder', 'addupsellitem', 'deleteupsellitem');
	}
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->TempOrder->recursive = 0;
		$this->set('tempOrders', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TempOrder->exists($id)) {
			throw new NotFoundException(__('Invalid temp order'));
		}
		$options = array('conditions' => array('TempOrder.' . $this->TempOrder->primaryKey => $id));
		$this->set('tempOrder', $this->TempOrder->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TempOrder->create();
			if ($this->TempOrder->save($this->request->data)) {
				$this->Session->setFlash(__('The temp order has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The temp order could not be saved. Please, try again.'));
			}
		}
		$restaurants = $this->TempOrder->Restaurant->find('list');
		$promoCodes = $this->TempOrder->PromoCode->find('list');
		$users = $this->TempOrder->User->find('list');
		$orderTypes = $this->TempOrder->OrderType->find('list');
		$virtualCaves = $this->TempOrder->VirtualCafe->find('list');
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
		if (!$this->TempOrder->exists($id)) {
			throw new NotFoundException(__('Invalid temp order'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->TempOrder->save($this->request->data)) {
				$this->Session->setFlash(__('The temp order has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The temp order could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('TempOrder.' . $this->TempOrder->primaryKey => $id));
			$this->request->data = $this->TempOrder->find('first', $options);
		}
		$restaurants = $this->TempOrder->Restaurant->find('list');
		$promoCodes = $this->TempOrder->PromoCode->find('list');
		$users = $this->TempOrder->User->find('list');
		$orderTypes = $this->TempOrder->OrderType->find('list');
		$virtualCaves = $this->TempOrder->VirtualCafe->find('list');
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
		$this->TempOrder->id = $id;
		if (!$this->TempOrder->exists()) {
			throw new NotFoundException(__('Invalid temp order'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->TempOrder->delete()) {
			$this->Session->setFlash(__('Temp order deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Temp order was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	
	/**
	*add item
	*/
	public function additem() {

		//echo '<pre>'; var_dump($this->request->data['TempItem'][0]);	echo'</pre>';
		$this->loadModel('Restaurant');
		if(isset($this->request->data['TempItem'][0]['TempVariation']))
			$orginalTempVarition = $this->request->data['TempItem'][0]['TempVariation'];
			
		if(isset($this->request->data['TempItem'][0]['TempVariationCheckbox'])) {
			$this->request->data['TempItem'][0]['TempVariation'] = array();		
				
			foreach($this->request->data['TempItem'][0]['TempVariationCheckbox'] as $variationcheckboxes):
				foreach($variationcheckboxes['Checkbox'] as $checkbox):
					if($checkbox['ischecked'])
						array_push($this->request->data['TempItem'][0]['TempVariation'],array('variation_id'=>$checkbox['variation_id']));
						
						//echo $checkbox['variation_id'];
				endforeach;
			endforeach;
			
			if(isset($orginalTempVarition)) {
				foreach($orginalTempVarition as $tempvar):
					if($tempvar['variation_id'] != '')
						array_push($this->request->data['TempItem'][0]['TempVariation'],array('variation_id'=>$tempvar['variation_id']));
				endforeach;
			}
			//array_push($orginalTempVarition, $this->request->data['TempItem'][0]['TempVariation']);
			
		}
		
		//echo '<pre>'; var_dump($this->request->data);	echo'</pre>';
		//echo $this->request->data['TempOrder']['tip'];
	
		if ($this->TempOrder->saveAssociated($this->request->data,array('deep' => true))) {
			$this->Session->setFlash(__('The temp order has been saved'));
		} else {
			$this->Session->setFlash(__('The temp order could not be saved. Please, try again.'));
		}
		
		//Update Order total
	    $this->TempOrder->updateOrderTotal($this->request->data['TempOrder']['id'], $this->request->data['TempOrder']['tip']);

	    //Get Order Total
	   	$this->TempOrder->getOrderTotal($this->request->data['TempOrder']['id']);
	    
	    //Get all items for the order
	    $this->set('orderdetails', $this->TempOrder->getOrderDetails($this->request->data['TempOrder']['id']));
	    
	    //echo '<pre>'; var_dump($this->TempOrder->getOrderDetails($this->request->data['TempOrder']['id']));	echo'</pre>';
	    
	    
	    $orderfor = $_SESSION['ordertypefor'];
		$timezone = $_SESSION['timezone'];
		
	   //Get time options for dropdown in view
	   $this->set('gettime',$this->Restaurant->getTime($timezone, $orderfor));
	   $this->set('tip',$this->Restaurant->getTipAmounts());
	   $this->set('deliveryminimum',$this->request->data['TempOrder']['DeliveryMinimum']);
	   $this->set('hasUpSell',$this->request->data['TempOrder']['HasUpsell']);	   	   
	   
	   
	   
	    if($this->RequestHandler->isAjax())
	    	$this->render('orderdetails','ajax');
	    
	}
	/**
	*add upsell item
	*/
	public function addupsellitem() {
		//echo '<pre>'; var_dump($this->request->data);	echo'</pre>';
		$this->loadModel('Restaurant');
		$this->loadModel('TempItem');
		
		$upsellitem['TempItem'] = array("temp_order_id" => $this->request->data['temporderid'],
					   "item_id" => $this->request->data['itemid'], "quantity" => 1, "special_instructions" => "upsell");
		
		//echo '<pre>'; var_dump($upsellitem);	echo'</pre>';
		//echo $this->request->data['TempOrder']['tip'];
		
		
		
		if ($this->TempItem->saveAssociated($upsellitem,array('deep' => true))) {
			$this->set('tempitemid', $this->TempItem->id);
			
			$this->Session->setFlash(__('The temp item has been saved'));
		} else {
			$this->Session->setFlash(__('The temp order could not be saved. Please, try again.'));
		}
		
		//Update Order total
	    $this->TempOrder->updateOrderTotal($this->request->data['temporderid'], 0);

	    //Get Order Total
	   	$this->TempOrder->getOrderTotal($this->request->data['temporderid']);
	    
	    //Get all items for the order
	    $this->set('orderdetails', $this->TempOrder->getOrderDetails($this->request->data['temporderid']));
	    $this->set('upsellitems', $upsellitem);
	    
	   	$orderfor = $_SESSION['ordertypefor'];
		$timezone = $_SESSION['timezone'];
		
	   //Get time options for dropdown in view
	   $this->set('gettime',$this->Restaurant->getTime($timezone, $orderfor));
	   $this->set('tip',$this->Restaurant->getTipAmounts());
	   
	    if($this->RequestHandler->isAjax())
	    	$this->render('orderdetails','ajax');
	    
	}
	/**
	*update item
	*/
	public function updateitem() {
		//echo '<pre>'; var_dump($this->request->data);	echo'</pre>';
		$this->loadModel('Restaurant');
		
		$this->TempOrder->TempItem->TempVariation->deleteAll(array('temp_item_id'=>$this->request->data['TempItem'][0]['id'], false));
		
		if(isset($this->request->data['TempItem'][0]['TempVariation']))
			$orginalTempVarition = $this->request->data['TempItem'][0]['TempVariation'];
			
		
		if(isset($this->request->data['TempItem'][0]['TempVariationCheckbox'])) {
			$this->request->data['TempItem'][0]['TempVariation'] = array();	
			foreach($this->request->data['TempItem'][0]['TempVariationCheckbox'] as $variationcheckboxes):
				foreach($variationcheckboxes['Checkbox'] as $checkbox):
					if($checkbox['ischecked'])
						array_push($this->request->data['TempItem'][0]['TempVariation'],array('variation_id'=>$checkbox['variation_id']));
				endforeach;
			endforeach;
			
			if(isset($orginalTempVarition)) {
				foreach($orginalTempVarition as $tempvar):
					if($tempvar['variation_id'] != '')
						array_push($this->request->data['TempItem'][0]['TempVariation'],array('variation_id'=>$tempvar['variation_id']));
				endforeach;
			}
		}
		
		//echo '<pre>'; var_dump($this->request->data);	echo'</pre>';
		
	
		if ($this->TempOrder->saveAssociated($this->request->data,array('deep' => true))) {
			$this->Session->setFlash(__('The temp order has been saved'));
		} else {
			$this->Session->setFlash(__('The temp order could not be saved. Please, try again.'));
		}
		
		//Update Order total
	    $this->TempOrder->updateOrderTotal($this->request->data['TempOrder']['id'], $this->request->data['TempOrder']['tip']);

	    //Get Order Total
	   	$this->TempOrder->getOrderTotal($this->request->data['TempOrder']['id']);
	    
	    //Get all items for the order
	    $this->set('orderdetails', $this->TempOrder->getOrderDetails($this->request->data['TempOrder']['id']));
	    
	    //echo '<pre>'; var_dump($this->TempOrder->getOrderDetails($this->request->data['TempOrder']['id']));	echo'</pre>';
	   
	   	$orderfor = $_SESSION['ordertypefor'];
		$timezone = $_SESSION['timezone'];
	   
	   //Get time options for dropdown in view
	   $this->set('gettime',$this->Restaurant->getTime($timezone, $orderfor));
	   $this->set('tip',$this->Restaurant->getTipAmounts());
	   
	    if($this->RequestHandler->isAjax())
	    	$this->render('orderdetails','ajax');
	    	
	    	
	}
	
	public function deleteupsellitem() {
		//echo '<pre>'; var_dump($this->request->data);	echo'</pre>';
		$this->loadModel('Restaurant');

		$this->TempOrder->TempItem->delete($this->request->data['tempitemid']);
		
		//Update Order total
	    $this->TempOrder->updateOrderTotal($this->request->data['temporderid'], 0);
		
		//Get Order Total
	   	$this->TempOrder->getOrderTotal($this->request->data['temporderid']);
	    
	    //Get all items for the order
	    $this->set('orderdetails', $this->TempOrder->getOrderDetails($this->request->data['temporderid']));
	    $this->set('upsellitems', $this->request->data['tempitemid']);
	    
	   	$orderfor = $_SESSION['ordertypefor'];
		$timezone = $_SESSION['timezone'];
		
	   //Get time options for dropdown in view
	   $this->set('gettime',$this->Restaurant->getTime($timezone, $orderfor));
	   $this->set('tip',$this->Restaurant->getTipAmounts());
	   
	    if($this->RequestHandler->isAjax())
	    	$this->render('orderdetails','ajax');
	}
	
	public function deleteitem() {
		//echo '<pre>'; var_dump($this->request->data);	echo'</pre>';
		$this->loadModel('Restaurant');
		
		$this->TempOrder->TempItem->TempVariation->deleteAll(array('temp_item_id'=>$this->request->data['TempItem'][0]['id'], false));
		$this->TempOrder->TempItem->delete($this->request->data['TempItem'][0]['id']);
		
		if(isset($this->request->data['TempOrder']['IsOrderPage']))
			$this->set('IsOrderPage',true);
		
		//Update Order total
	    $this->TempOrder->updateOrderTotal($this->request->data['TempOrder']['id']);
	    
	    //Get Order Total
	   	$this->TempOrder->getOrderTotal($this->request->data['TempOrder']['id']);
	    
	    //Get all items for the order
	    $this->set('orderdetails', $this->TempOrder->getOrderDetails($this->request->data['TempOrder']['id']));
	    
	   	$orderfor = $_SESSION['ordertypefor'];
		$timezone = $_SESSION['timezone'];
		
	   	//Get time options for dropdown in view
	   	$this->set('gettime',$this->Restaurant->getTime($timezone, $orderfor));
	   	$this->set('tip',$this->Restaurant->getTipAmounts());
	   
	    if($this->RequestHandler->isAjax())
	    	$this->render('orderdetails','ajax');
	    	
	}	
}

