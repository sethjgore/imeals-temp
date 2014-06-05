<?php
App::uses('AppModel', 'Model');
/**
 * TempOrder Model
 *
 * @property Restaurant $Restaurant
 * @property PromoCode $PromoCode
 * @property User $User
 * @property OrderType $OrderType
 * @property VirtualCafe $VirtualCafe
 * @property TempItem $TempItem
 */
class TempOrder extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';
	
	public $actsAs = array('Containable');
  public $recursive = -1;

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'address' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'zip' => array(
			'postal' => array(
				'rule' => array('postal'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'city' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),	
		),
		'state' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'order_date' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'order_for' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'order_at' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'restaurant_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sub_total' => array(
			'money' => array(
				'rule' => array('money'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'tax' => array(
			'money' => array(
				'rule' => array('money'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'tax_total' => array(
			'money' => array(
				'rule' => array('money'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),		
		'tip' => array(
			'money' => array(
				'rule' => array('money'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'total' => array(
			'money' => array(
				'rule' => array('money'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'order_type_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Restaurant' => array(
			'className' => 'Restaurant',
			'foreignKey' => 'restaurant_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'city',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),	
		'State' => array(
			'className' => 'State',
			'foreignKey' => 'state',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),				
		'PromoCode' => array(
			'className' => 'PromoCode',
			'foreignKey' => 'promo_code_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'OrderType' => array(
			'className' => 'OrderType',
			'foreignKey' => 'order_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'VirtualCafe' => array(
			'className' => 'VirtualCafe',
			'foreignKey' => 'virtual_cafe_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'TempItem' => array(
			'className' => 'TempItem',
			'foreignKey' => 'temp_order_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

/**
 * Update Order Total
 *
 */
 	
	public function updateOrderTotal($temporderid = null, $tip = null) {
		$temporders = $this->find('all', array(
			'conditions'=>array(
				'id'=>$temporderid
			),
			'contain'=>array(
				'TempItem'=>array(
					'Item',
					'TempVariation'=>array(
						'Variation'
					)
				)
			)
		));
		
		$subtotal = 0;
		$total = 0;
		foreach($temporders[0]['TempItem'] as $tempitem):
			$variationtotal = 0;
			if($tempitem['TempVariation'] != null)	{		
				foreach($tempitem['TempVariation'] as $tempvariation):
					$variationtotal+=$tempvariation['Variation']['amount'];
				endforeach;
				$subtotal+=$tempitem['quantity']*$variationtotal;
			}
			
			$subtotal+=$tempitem['quantity']*$tempitem['Item']['price'];
			
		endforeach;
	
		//calculate discount
		
		if(isset($_SESSION['deals'])) {
			$discount = ($_SESSION['deals']/100) * $subtotal;
		} else {
			$discount = 0;
		}
						
		//calculate tax based on original total
		if($temporders[0]['TempOrder']['tax'] != 0.00)
			$salestax = ($subtotal - $discount)*($temporders[0]['TempOrder']['tax']/100);
		else
			$salestax = 0;
			
		if($temporders[0]['TempOrder']['promo_discount'] != 0)
			$promodiscount = $subtotal*($temporders[0]['TempOrder']['promo_percentage']/100);
		else
			$promodiscount = 0;
				
		//calculate total
		$total = ($subtotal - $discount) + $salestax - $promodiscount;
		
		/*echo 'subtotal='.$subtotal.'<br>';
		echo 'discount='.$discount.'<br>';
		echo 'tax='.$temporders[0]['TempOrder']['tax'].'<br>';
		echo 'tax total='.$salestax.'<br>';
		echo 'total='.$total.'<br>';*/		
		
		$deliverycharge = 0;
		if(isset($_SESSION['deliverycharge']) && strtoupper($_SESSION['ordertype']) == 'DELIVERY') {
			$total = $total + $_SESSION['deliverycharge'];
			$deliverycharge = $_SESSION['deliverycharge'];
		}
		
		//echo 'Delivery'.$temporders[0]['TempOrder']['tax'];
		
		if($tip != null)
			$total = $total + $tip;
		else
			$total = $total + $temporders[0]['TempOrder']['tip'];
		
		if(!$this->updateAll(
			array(
				'TempOrder.sub_total'=>$subtotal,
				'TempOrder.total'=>$total,
				'TempOrder.delivery_charge'=>$deliverycharge,
				'TempOrder.first_time_discount'=>$discount,
				'TempOrder.promo_discount'=>$promodiscount,
				'TempOrder.tax_total'=>$salestax
			),
			array(
				'TempOrder.id'=>$temporderid
			)
		))
			return true;
		else
			return false;
		
		return $temporder;
	}
	
/**
 * Get Order Total
 *
 */
 	
	public function getOrderTotal($temporderid = null) {
		$temporders = $this->find('all', array(
			'conditions'=>array(
				'id'=>$temporderid
			),
			'contain'=>array(
				'TempItem'=>array(
					'Item',
					'TempVariation'=>array(
						'Variation'
					)
				)
			)
		));
		
		$subtotal = 0;
		$total = 0;
		foreach($temporders[0]['TempItem'] as $tempitem):
			$variationtotal = 0;
			foreach($tempitem['TempVariation'] as $tempvariation):
				$variationtotal+=$tempvariation['Variation']['amount'];
			endforeach;
			
			$subtotal+=$tempitem['quantity']*$variationtotal;
			$subtotal+=$tempitem['quantity']*$tempitem['Item']['price'];
			
		endforeach;
		
		//$this->loadModel('User');
		$total = $temporders[0]['TempOrder']['total'];
		$subtotal = $temporders[0]['TempOrder']['sub_total'];
		$salestax = $temporders[0]['TempOrder']['tax_total'];
		$discount = $temporders[0]['TempOrder']['first_time_discount'];
		$promodiscount = $temporders[0]['TempOrder']['promo_discount'];
		$promopercentage = $temporders[0]['TempOrder']['promo_percentage'];
		
		/*
		//Calculate discount
		if(isset($_SESSION['deals'])) {
			$discount = .2 * $subtotal;
		} else {
			$discount = 0;
		}
		
		//Calculate tax
		if($temporders[0]['TempOrder']['tax'] != 0) {
			$salestax = $temporders[0]['TempOrder']['tax']/100;
			$tax = $subtotal*($temporders[0]['TempOrder']['tax']/100);
		}
		else {
			$salestax = 0;	
			$tax = 0;
		}		
		
		//calculate total
		$total = ($subtotal + $tax) - $discount;
		
		//Add Delivery Charge
		if($_SESSION['deliverycharge'] != null)
			$total = $total + $_SESSION['deliverycharge'];
		
		//Add Tip
		$total = $total + $temporders[0]['TempOrder']['tip'];
	   */
		$this->set('discount', $discount); 	   
   	   	$this->set('salestax', $salestax);
	   	$this->set('subtotal', $subtotal);
	   	$this->set('total', $total);
	   	$this->set('tipamount',$temporders[0]['TempOrder']['tip']);
	   	$this->set('promodiscount',$promodiscount);
	   	$this->set('promopercentage',$promopercentage);
	   	
		$tempordertotals = array("total"=>$total,"subtotal"=>$subtotal,"salestax"=>$salestax,"discount"=>$discount,"promodiscount"=>$promodiscount, "promopercentage"=>$promopercentage);
		
		
		return $tempordertotals;
	}
	
	public function getOrderDetails($temporderid = null) {
		$temporders = $this->find('all', array(
			'conditions'=>array(
				'id'=>$temporderid
			),
			'contain'=>array(
				'TempItem'=>array(
					'Item' => array(
				           'VariationGroup' => array(
          				   'Variation'
          				),
				    ),
					'TempVariation'=>array(
							'Variation'=>array(
								'VariationGroup'
							)
					)
				)
			)
		));
		
		return $temporders;
	}
	
	public function getTempOrder($temporderid = null) {
		//Get Order Totals
		$tempordertotals = $this->getOrderTotal($temporderid);

		$this->set('subtotal', $tempordertotals['subtotal']);
		$this->set('total', $tempordertotals['total']);
		//$this->set('salestax', $tempordertotals['salestax']);
		
		$orderdetails = $this->getOrderDetails($temporderid);
		$this->set('orderdetails', $orderdetails);
		//echo '<pre>'; echo var_dump($orderdetails); echo '</pre>';
		
		$temporder = array('tempordertotals'=>$tempordertotals, 'orderdetails'=>$orderdetails);
		
		return $temporder;
	}
}
