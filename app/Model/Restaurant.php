<?php
App::uses('AppModel', 'Model');
App::uses('CakeTime', 'Utility');
/**
 * Restaurant Model
 *
 * @property City $City
 * @property BillingState $BillingState
 * @property Order $Order
 * @property RestaurantContact $RestaurantContact
 * @property RestaurantOrderType $RestaurantOrderType
 * @property TempOrder $TempOrder
 * @property Cuisine $Cuisine
 * @property User $User
 */
class Restaurant extends AppModel {

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
		'city_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'email' => array(
			'email' => array(
				'rule' => array('email'),
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
		'logo_url' => array(
			'url' => array(
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
		'sales_tax' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'phone' => array(
			'phone' => array(
				'rule' => array('phone'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'fax' => array(
			'phone' => array(
				'rule' => array('phone'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'billing_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'billing_street' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'billing_city' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'billing_state_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'billing_zip' => array(
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
		'po_pickup' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'po_delivery' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'po_phone_alert' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'po_fax_alert' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'po_email_alert' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'me_pickup' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'me_catering_pickup' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'me_delivery' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'me_catering_delivery' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'me_phone_alert' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'me_fax_alert' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'me_email_alert' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'vc_delivery' => array(
			'boolean' => array(
				'rule' => array('boolean'),
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
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'city_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'BillingState' => array(
			'className' => 'State',
			'foreignKey' => 'billing_state_id',
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
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'restaurant_id',
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
		'RestaurantContact' => array(
			'className' => 'RestaurantContact',
			'foreignKey' => 'restaurant_id',
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
		'RestaurantOrderType' => array(
			'className' => 'RestaurantOrderType',
			'foreignKey' => 'restaurant_id',
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
		'TempOrder' => array(
			'className' => 'TempOrder',
			'foreignKey' => 'restaurant_id',
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
		'DeductionAddition' => array(
			'className' => 'DeductionAddition',
			'foreignKey' => 'restaurant_id',
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
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Cuisine' => array(
			'className' => 'Cuisine',
			'joinTable' => 'cuisines_restaurants',
			'foreignKey' => 'restaurant_id',
			'associationForeignKey' => 'cuisine_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'User' => array(
			'className' => 'User',
			'joinTable' => 'restaurants_users',
			'foreignKey' => 'restaurant_id',
			'associationForeignKey' => 'user_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);
	
	
//Returns All Items associated with a restaurant
public function getResturantItems($restaurant_id = null, $restordertypeid = null){
  	if($restaurant_id != null){
    	return $this->find('all',array(
				  'contain' => array(				      
				      'City' => array('State'),
				      'RestaurantOrderType' => array(
				      	'conditions' => array('id' => $restordertypeid),
				        'Menu' => array(			        	
				          'conditions' => array('restaurant_order_type_id' => $restordertypeid,'Menu.active'=>1),
				          'Category' => array(
				            'conditions' => array('Category.active',1),
				            'Item' => array(
				              'conditions' => array('Item.active',1),
				              'VariationGroup' => array(
          				        'Variation'
          				    ),
				            ),
				          ),
				          'MenuHour' => array(
				          	'conditions' => array('AND' => (array(
				          		'time_open <' => $_SESSION['ordertypeat'], 
				          		'time_closed >' => $_SESSION['ordertypeat'],
				          		'day' => CakeTime::format('l', $_SESSION['ordertypefor'], false,$_SESSION['timezone'])
				          	)))
				          ),				          
				        ),
				      ),
				    ),
				    'conditions' => array(
				      'Restaurant.id' => $restaurant_id
				    )
				)
    	);
  	}
  	
}  	

public function getTodayTomorrow($timezone) {
	//Get Current time, date, hour, minute, am or pm for the timezone of the 
	$stored_time = date('m/d/Y h:i:s a', time());
	date_default_timezone_set($timezone);
	$timestamp = strtotime($stored_time);
	$timestamp = $timestamp + date('Z');
	$tomor_timestamp = $timestamp + date('Z')+1;
	$date = date('Y-m-d H:i:s A', $timestamp);
	$hour = date('H',$timestamp);
	$minute = date('i',$timestamp);
	$ampm = date('A',$timestamp);
	
	//Set today and tomorrows day of week
	$today = date( "l", $timestamp);
	$tomorrow = date("l", mktime(0,0,0,date("m"),date("d")+1,date("Y")));
	$selected_date = date("m/d/Y", mktime(0,0,0,date("m"),date("d")+1,date("Y")));
	
	$time = array(
		"today" => $today,
		"tomorrow" => $tomorrow,
		"selected" => $selected_date
	);
	
	return $time;
}

//Adds a new user that with Vendor role
public function addRestaurantUser($data){
		  
		  $data['User']['first_name'] = $data['Restaurant']['name'];
		  $data['User']['last_name'] = 'Manager';
		  $data['User']['phone'] = $data['Restaurant']['phone'];
		  $timezone = $this->City->find('first',array('conditions'=>array('id'=>$data['Restaurant']['city_id'])));
		  $data['User']['timezone_id'] = $timezone['City']['timezone_id'];
		  $data['User']['user_status'] = 1;
		  $data['User']['user_name'] = strtolower($data['User']['first_name']) . strtolower($data['User']['last_name']);
		  $data['Group'] = array('Group'=>array('0'=>'4'));
		  unset($data['Restaurant']);
		  $this->User->saveAll($data);
		  return $this->User->id;
}
//Returns restaurants which delivery during the specified parameters
public function searchRestaurantsDelivery($cityid = null, $lat = null, $lng = null, $cityid = null) {
		return '1';	
	}


private function loopTime($time_option,$hour_start,$hour_end,$minute_start){
  for ($i = $hour_start; $i <= $hour_end; $i++){
      for ($j = $minute_start; $j <= 45; $j+=15){
        if($i==0) {$hour = 12; $ampm = 'am';}
        elseif($i==12) {$hour = 12; $ampm = 'pm';}
        elseif($i >12) {$hour = $i - 12; $ampm = 'pm';}
        else {$hour = $i; $ampm = 'am';}
        $time_option[str_pad($i, 2, '0', STR_PAD_LEFT) .':'. str_pad($j, 2, '0', STR_PAD_LEFT)]= $hour.':'.str_pad($j, 2, '0', STR_PAD_LEFT).$ampm;
      }
    }

  return $time_option;
}

public function getTime($timezone = null, $today_tomorrow = null, $maxtime = null) {

		//Initalize variables
		$time_option = array();
		$to = 0;
		
		//set current minute and current hour in timezone
		//CakeTime::format('Y-m-d H:i:s', time(), false,'America/Chicago');
		$currenttime = strtotime('+'.$maxtime.' minutes', time());
		$currentminute = CakeTime::format('i', $currenttime, false,$timezone);
		$currenthour = CakeTime::format('H', $currenttime, false,$timezone);
		//$currentminute = CakeTime::format('i', time(), false,$timezone);
		//$currenthour = CakeTime::format('H', time(), false,$timezone);
		
		//If For = Today, set 15 min intervals for rest of day
		if(strtolower($today_tomorrow) == 'today'):
			//Set ASAP Time
			//$time_option[str_pad($currenthour, 2, '0', STR_PAD_LEFT) .':'. str_pad($currentminute, 2, '0', STR_PAD_LEFT)]= 'ASAP';
			
		  //Loop through rest of hour
		  if($currentminute < 15) $time_option = $this->loopTime($time_option,$currenthour,$currenthour,15);
		  elseif($currentminute < 30) $time_option = $this->loopTime($time_option,$currenthour,$currenthour,30);
		  elseif($currentminute < 45) $time_option = $this->loopTime($time_option,$currenthour,$currenthour,45);
		  //Loop through rest of day
		  $time_option = $this->loopTime($time_option,$currenthour + 1,23,0);
		  
		//If For = Tomorrow, set 15min intervals all day
		elseif(strtolower($today_tomorrow) == 'tomorrow'):
		  //Loop through full day
		  $time_option = $this->loopTime($time_option,0,23,0);
		endif;
		
    return $time_option;
}	

public function getCurrentFutureDays($timezone = null, $today_tomorrow = null, $maxtime = null) {
	//Initalize variables
		$time_option = array();
		$to = 0;
		
		//set current minute and current hour in timezone
		$currenttime = strtotime('+'.$maxtime.' minutes', time());
		
		//Get current day and date
		$currentday = CakeTime::format('l', $currenttime, false,$timezone);
		$currentdate = CakeTime::format('m/d/Y', $currenttime, false,$timezone);
		$time_option[$currentdate] = 'Today';
		//$time_option['today'] = 'Today';
		
		$tomorrow = date('m/d/Y', strtotime($currentdate.' + 1 days'));
		$time_option[$tomorrow] = 'Tomorrow';		
		//$time_option['tomorrow'] = 'Tomorrow';		
		
		for ($i=2;$i < 16; $i++) {
			$date = date('m/d/Y', strtotime($currentdate.' + '.$i.' days'));
			$day = date('D', strtotime($currentdate.' + '.$i.' days'));;
			$time_option[$date] = $date.'('.$day.')';	
		}
		
    return $time_option;

}


	public function getTipAmounts(){
		$tip = array();
		$tipamnt_text = '$0.00';
		$tip[0] = $tipamnt_text;
		
		for($i=.5;$i<50;$i=$i+.25) {
			if(strlen($i) == 3)
				$tipamnt = str_pad((string)$i, 4, '0', STR_PAD_RIGHT);
			else if(strlen($i) == 2 && $i >= 10)
				$tipamnt = str_pad((string)$i, 5, '.00', STR_PAD_RIGHT);
			else if(strlen($i) == 4 && $i >= 10)
				$tipamnt = str_pad((string)$i, 5, '0', STR_PAD_RIGHT);
			else 
				$tipamnt = str_pad((string)$i, 4, '.00', STR_PAD_RIGHT);
			
			$tipamnt_text = '$'.$tipamnt;
			
		  	$tip[(string)$tipamnt] = $tipamnt_text;
		}
		return $tip;	
	}
	
	public function getPickRestaurants($dw = null, $defaulttime = null, $cityid = null, $sort = null) {
	
	    //Set ASAP defaulttime to Now
			if($defaulttime == null || $defaulttime == ''){
  			$defaulttime = date('G:i');
			}
			$pickup_restaurants = $this->RestaurantOrderType->find('all',array(
			    'contain' => array(
			      'Restaurant'=>array('Cuisine'),
			      'Menu'=> array(
			      	'MenuHour'
			      )
			    ),
			    'joins' => array (
				    array(
				      'table' => 'menus',
				      'alias' => 'menus',
				      'type' => 'INNER',
				      'conditions' => array( 'AND' => array(
				      	  'menus.restaurant_order_type_id=RestaurantOrderType.id',
				      	  'menus.active' => 1
				      	)		     
			      	  )
			        ),
				    array(
				      'table' => 'menu_hours',
				      'alias' => 'menu_hours',
				      'type' => 'INNER',
				      'conditions' => array( 'AND' => array(
				      	'menu_hours.menu_id=menus.id'),
				      	'menu_hours.day'=>$dw,
				      	"TIMEDIFF(`menu_hours`.`time_open`,ADDTIME('".$defaulttime."',(CONCAT('00:',`menu_hours`.`lead_time`,':00')))) <" => 0,
				      	"TIMEDIFF(`menu_hours`.`time_closed`,ADDTIME('".$defaulttime."',(CONCAT('00:',`menu_hours`.`lead_time`,':00')))) >" => 0		     
			      	  )
			        )				        
			    ),
			    'conditions' => array(
			      'AND' => array( 
			        'city_id' => $cityid,
			        'po_pickup' => 1,
				      'order_type_id'=>1
			        )
			    ),
					'group'=>'restaurant_id',
				  'order' => array($sort)
				));
				
				return $pickup_restaurants;
	}
	
	public function getDeliveryRestaurants($dw = null, $defaulttime = null, $lat = null, $lng = null, $cityid = null, $sort) {
			
  			//Set ASAP defaulttime to Now
  			if($defaulttime == null || $defaulttime == ''){
    			$defaulttime = date('G:i');
  			}
				$delivery_restaurants = $this->RestaurantOrderType->find('all',array(
				    'contain' => array(
				      'Restaurant'=>array('Cuisine'),
				      'Menu'=> array(
				      	'MenuHour'
				      )
				     ),
				    'joins' => array (
					    array(
					      'table' => 'menus',
					      'alias' => 'menus',
					      'type' => 'INNER',
					      'conditions' => array( 'AND' => array(
					      	'menus.restaurant_order_type_id=RestaurantOrderType.id',
					      	'menus.active' => 1
					      	)		     
				      	  )
				        ),
					    array(
					      'table' => 'menu_hours',
					      'alias' => 'menu_hours',
					      'type' => 'INNER',
					      'conditions' => array( 'AND' => array(
					      	'menu_hours.menu_id=menus.id',
					      	'menu_hours.day'=>$dw,
					      	"TIMEDIFF(`menu_hours`.`time_open`,ADDTIME('".$defaulttime."',`menu_hours`.`lead_time`)) <" => 0,
					      	"TIMEDIFF(`menu_hours`.`time_closed`,ADDTIME('".$defaulttime."',`menu_hours`.`lead_time`)) >" => 0)		     
				      	  )
				        )				        
				    ),
				    'conditions' => array(
				      'OR' => array( 
				        "MBRContains(GeomFromText(concat('Polygon((',RestaurantOrderType.delivery_area,'))')), GeomFromText('Point(".$lat." ".$lng.")'))"=> 1,
				        'RestaurantOrderType.radius >=' => '( 3959 * acos( cos( radians('.$lat.') ) * cos( radians( RestaurantOrderType.lat ) ) * cos( radians( RestaurantOrderType.long ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( RestaurantOrderType.lat ) ) ) )'
				        ),
					   'AND' => array(
				      	'city_id' => $cityid,
				       	'po_delivery' => 1,
				       	'order_type_id'=>2
				       	)
				    ),
				    'group'=>'restaurant_id',
				    'order' => array($sort)
				));

		return $delivery_restaurants;
	
	}
	
	/*
						      	"TIMEDIFF(`menu_hours`.`time_open`,ADDTIME('".$defaulttime."',(CONCAT('00:',`menu_hours`.`lead_time`,':00')))) <=" => 0,
					      	"TIMEDIFF(`menu_hours`.`time_closed`,ADDTIME('".$defaulttime."',(CONCAT('00:',`menu_hours`.`lead_time`,':00')))) >" => 0)
					      	*/
	public function get_cuisine_totals($restaurants = null){
  	//Loop through restaurants to get Cusines Totals
    $allCusines = array();
    foreach($restaurants as $restaurant):
      if(isset($restaurant['Restaurant']['Cuisine'])):
        foreach($restaurant['Restaurant']['Cuisine'] as $cusine):
          if(isset($allCusines[$cusine['name']])):
            $allCusines[$cusine['name']] =  intval($allCusines[$cusine['name']]) + 1;
          else:
            $allCusines[$cusine['name']] = 1;
          endif;
        endforeach;
      endif;
    endforeach;
    
    return $allCusines;
	}
	
	public function creatUser($data) {
		  $this->User->saveAll($data);
		  return $this->User->id;
	}
	
	public function getRestaurantInfo($restaurantid = null) {
		$restaurant = $this->find('first',array('conditions'=>array('Restaurant.id'=>$restaurantid), 'recursive' => 0));
		return $restaurant;
		
	}
}
