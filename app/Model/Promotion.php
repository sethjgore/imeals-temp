<?php
App::uses('AppModel', 'Model');
/**
 * Promotion Model
 *
 * @property OrderType $OrderType
 * @property PromoCode $PromoCode
 */
class Promotion extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	
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
		'name' => array(
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
		'codes' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter discount codes',
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
		'OrderType' => array(
			'className' => 'OrderType',
			'foreignKey' => 'order_type_id',
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
		'PromoCode' => array(
			'className' => 'PromoCode',
			'foreignKey' => 'promotion_id',
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
	
	public function promoIsValid($promocode = null, $ordertype = null){
	
		//	$isvalid = $this->recursive = 1;
		$isvalid = $this->find('all',array(
			          'conditions' => array('AND' => array('Promotion.order_type_id'=>$ordertype, 'PromoCode.code'=>$promocode)),
				      'joins' => array(
	                    array(
	                        'table' => 'promo_codes',
	                        'alias' => 'PromoCode',
	                        'type' => 'INNER',
	                        'conditions' => array('PromoCode.promotion_id = Promotion.id')
                    )),
                    'recursive'=>1));	
		//Check how many times the promo can be used and how many times it has been used
		if(isset($isvalid['Promotion']) && $isvalid['Promotion']['frequency'] == 'once') {
			foreach ($isvalid['PromoCode'] as $key => $val) {
		       if ($val['code'] == $promocode && $val['used_count'] >= 1) {
		           $isvalid = null;
		       }
		   	}
	   	}
		
		return $isvalid;
	}
	
	public function getPromotionCode($promocodeid = null){
	
		//	$isvalid = $this->recursive = 1;
		$isvalid = $this->find('first',array(
			          'conditions' => array('PromoCode.id = '.$promocodeid),
				      'joins' => array(
	                    array(
	                        'table' => 'promo_codes',
	                        'alias' => 'PromoCode',
	                        'type' => 'LEFT',
	                        'conditions' => 'PromoCode.id = '.$promocodeid
                    )),
                    'recursive'=>1));	

		return $isvalid;
	}

}
