<?php
App::uses('AppModel', 'Model');
/**
 * Item Model
 *
 * @property Category $Category
 * @property VariationGroup $VariationGroup
 * @property TempItem $TempItem
 * @property OrderItem $OrderItem
 */
class Item extends AppModel {

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
		'category_id' => array(
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
		'price' => array(
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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => 'Category.sort_order'
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'VariationGroup' => array(
			'className' => 'VariationGroup',
			'foreignKey' => 'item_id',
			'dependent' => false,
			'conditions' => array('VariationGroup.active'=>1),
			'fields' => '',
			'order' => 'VariationGroup.sort_order',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'TempItem' => array(
			'className' => 'TempItem',
			'foreignKey' => 'item_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'OrderItem' => array(
			'className' => 'OrderItem',
			'foreignKey' => 'item_id',
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
	
	
	
	//Function to Copy Item
  function copyItem($copy_item_id,$copy_item_category_id){
	
    //Duplicate Item
    $copy_item = $this->find('first',array(
    	'contain' => array(
	       'VariationGroup'=>array(
	         'Variation'
	       )    
    	),
    	'conditions' =>array(
    	   'Item.id'=>$copy_item_id
    	)
  	));
  	
  	//Set New Item equal to Copy Item
  	$new_item = $copy_item;
  	$new_item['Item']['category_id'] = $copy_item_category_id;
  	
  	//Unset item id and created/updated date
  	unset($new_item['Item']['id']);
  	unset($new_item['Item']['created']);
  	unset($new_item['Item']['modified']);
  	$new_item['Item']['sort_order'] = 100;
  	$new_item['Item']['active'] = 1;
    
     //Unset each id and foriegn key id in the inside tables
  	 foreach($new_item['VariationGroup'] as $vgkey => $vgval):
       unset($new_item['VariationGroup'][$vgkey]['id']);
       unset($new_item['VariationGroup'][$vgkey]['item_id']);
       
       foreach($vgval['Variation'] as $vkey => $vval):
         unset($new_item['VariationGroup'][$vgkey]['Variation'][$vkey]['id']);
         unset($new_item['VariationGroup'][$vgkey]['Variation'][$vkey]['variation_group_id']);
       endforeach;
     endforeach;
		
		$this->create();
		if($this->saveAll($new_item,array('deep'=>true)))
  	  return $this->id;
    else
      return false;
	}



	
}
