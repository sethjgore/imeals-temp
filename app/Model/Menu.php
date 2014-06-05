<?php
App::uses('AppModel', 'Model');
/**
 * Menu Model
 *
 * @property RestaurantOrderType $RestaurantOrderType
 * @property Category $Category
 * @property MenuHour $MenuHour
 */
class Menu extends AppModel {

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
		'restaurant_order_type_id' => array(
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
		'upsell_y_n' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'active' => array(
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
		'RestaurantOrderType' => array(
			'className' => 'RestaurantOrderType',
			'foreignKey' => 'restaurant_order_type_id',
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
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'menu_id',
			'dependent' => false,
			'conditions' => array('Category.active'=>1),
			'fields' => '',
			'order' => 'sort_order',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'MenuHour' => array(
			'className' => 'MenuHour',
			'foreignKey' => 'menu_id',
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
	
	function copyMenu($new_menu_id,$new_menu_data){
	
    //Duplicate Menu
    $copy_menu = $this->find('first',array(
    	'contain' => array(
    	   'Category'=>array(
    	     'Item' =>array(
    	       'VariationGroup'=>array(
    	         'Variation'
    	       )    
    	     )
    	   ),
    	   'MenuHour'
    	),
    	'conditions' =>array(
    	   'Menu.id'=>$new_menu_data['Menu']['copy_menu']
    	)
  	));
  	$new_menu = $new_menu_data;
  	$new_menu['Category']=$copy_menu['Category'];
		$new_menu['MenuHour']=$copy_menu['MenuHour'];
		unset($new_menu['Menu']['id']);
		foreach($new_menu['MenuHour'] as $mhkey => $mhval):
		   unset($new_menu['MenuHour'][$mhkey]['id']);
		   unset($new_menu['MenuHour'][$mhkey]['menu_id']);
	  endforeach;
		foreach($new_menu['Category'] as $catkey => $catval):
		   unset($new_menu['Category'][$catkey]['id']);
		   unset($new_menu['Category'][$catkey]['menu_id']);
		   
		   foreach($catval['Item'] as $itemkey => $itemval):
		     unset($new_menu['Category'][$catkey]['Item'][$itemkey]['id']);
		     unset($new_menu['Category'][$catkey]['Item'][$itemkey]['category_id']);
		     
		     foreach($itemval['VariationGroup'] as $vgkey => $vgval):
		       unset($new_menu['Category'][$catkey]['Item'][$itemkey]['VariationGroup'][$vgkey]['id']);
		       unset($new_menu['Category'][$catkey]['Item'][$itemkey]['VariationGroup'][$vgkey]['item_id']);
		       
		       foreach($vgval['Variation'] as $vkey => $vval):
		         unset($new_menu['Category'][$catkey]['Item'][$itemkey]['VariationGroup'][$vgkey]['Variation'][$vkey]['id']);
		         unset($new_menu['Category'][$catkey]['Item'][$itemkey]['VariationGroup'][$vgkey]['Variation'][$vkey]['variation_group_id']);
		       endforeach;
		     endforeach;
		   endforeach;
		endforeach;
		
		$this->saveAll($new_menu,array('deep'=>true));
  	return true;
	}

}
