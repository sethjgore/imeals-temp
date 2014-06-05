<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Restaurants Controller
 *
 * @property Restaurant $Restaurant
 */
class RestaurantsController extends AdminController {

/**
 * Before Filter Method
 *
 * return void
 */	
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('search','menu', 'additem','order','setvariables', 'checkRestaurantExists', 'getTodayTomorrow',
		'submitorder','validateusername', 'validateorder', 'updateTipAmount', 'submitpayment', 'orderconfirmation','geocodeaddress','changeordertype','changeaddress','searchChangeToDelivery','changeordertime',
		'distanceGeoPoints', 'validatepromo','removepromo','orderhasitems', 'saveorderpdf', 'searchChangeAddress', 'validatecashorder','sendPhoneCall', 'buildPhoneCall');
		
		if ($this->RequestHandler->isXml()) {
       		$this->RequestHandler->setContent('xml');
    	}
	}
	
	public $components = array('AuthorizeNet','Geocoder','Twilio','RequestHandler');
	
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->redirect(array('action' => 'bycity'));
	}

/**
 * bycity method
 *
 * @return void
 */
	public function bycity($city_id = null) {
		$this->Restaurant->recursive = 0;
		if($city_id == null){
		  $this->paginate = array(
        'conditions' => array('Restaurant.active'=>1)
      );
  		$this->set('restaurants', $this->paginate());
  		$this->set('inactive_restaurants', $this->paginate(array('Restaurant.active'=>0 )));
  		$this->set('city','All Cities');
		} else {
  		$this->set('restaurants', $this->paginate(array('Restaurant.city_id'=>$city_id,'Restaurant.active'=>1 )));
      $this->set('inactive_restaurants', $this->paginate(array('Restaurant.city_id'=>$city_id,'Restaurant.active'=>0 )));
		}
		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
	  $this->Restaurant->recursive = 1;
	  $this->loadModel('RestaurantContact');
		if (!$this->Restaurant->exists($id)) {
			throw new NotFoundException(__('Invalid restaurant'));
		}
		$options = array('conditions' => array('Restaurant.' . $this->Restaurant->primaryKey => $id));
		$this->set('restaurant', $this->Restaurant->find('first', $options));
		$this->set('contacts', $this->Restaurant->find('all',array(
		        'contain' => array(
				      'RestaurantContact'
				    ),
				    'conditions' => array(
				      'Restaurant.' . $this->Restaurant->primaryKey => $id
				    )
				    )));
		$this->set('order_types', $this->Restaurant->RestaurantOrderType->find('all'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Restaurant->exists($id)) {
			throw new NotFoundException(__('Invalid restaurant'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$data = $this->request->data;
		 
      //Logo File Info in $data['Restaurant']['logo_file']
      if(isset($data['Restaurant']['logo_file']) && $data['Restaurant']['logo_file']['tmp_name'] != ""):
        
        //Upload Restaurant Logo
        $results = $this->uploadphoto($data['Restaurant']['logo_file']);

        //If Upload was sucess (not an error)
        if(!isset($results['error'])):
          $data['Restaurant']['logo_url'] = $results['image_path'];
               
          if ($this->Restaurant->saveAll($data)) {
    				$this->Session->setFlash(__('The restaurant has been Saved'),'flash_good');
    				//$this->redirect(array('action' => 'view',$this->Restaurant->id));
    			} else {
    				$this->Session->setFlash(__('The restaurant could not be saved. Please, try again.'));
    			}

        else:
    		    $this->Session->setFlash(__($results['error']),'flash_bad');
    		endif; // uploadphoto return false
      else: //$data['Restaurant']['logo_file'] no set
        if ($this->Restaurant->saveAll($data)) {
    				$this->Session->setFlash(__('The restaurant has been Saved'),'flash_good');
    				//$this->redirect(array('action' => 'view',$this->Restaurant->id));
    			} else {
    				$this->Session->setFlash(__('The restaurant could not be saved. Please, try again.'));
    			}
      endif;
			
		} 
		$options = array(
			   'conditions' => array(
			     'Restaurant.' . $this->Restaurant->primaryKey => $id),
			     'contain'=>array(
			       'RestaurantOrderType'=>array(
			         'OrderType',
			         'Menu'=>array(
			           'conditions' => array('Menu.active',1),
			           'MenuHour'
			         ),
			       ),
			       'RestaurantContact',
			       'User',
			       'Cuisine'
			     ));
		$this->request->data = $this->Restaurant->find('first', $options);
		$this->set('restaurant', $this->request->data);
		$inactive_options=array(
			   'conditions' => array(
			     'Restaurant.' . $this->Restaurant->primaryKey => $id),
			     'contain'=>array(
			       'RestaurantOrderType'=>array(
			         'OrderType',
			         'Menu'=>array(
			           'conditions' => array('Menu.active',0),
			           'MenuHour'
			         ),
			       ),
			       'RestaurantContact',
			       'User',
			       'Cuisine'
			     ));
		$this->set('inactive_menus',$this->Restaurant->find('first', $inactive_options));
		$cities = $this->Restaurant->City->find('list');
		$billingStates = $this->Restaurant->BillingState->find('list');
		$cuisines = $this->Restaurant->Cuisine->find('list');
		/*$users = $this->Restaurant->User->find('list', array(	
		  'fields' => array('User.id', 'User.user_email'),
		  'order' => array('User.user_email'),
		  'joins' => array(
		    array(
  		    'table'=>'users_groups',
  		    'alias'=>'UserGroups',
  		    'type'=>'inner',
  		    'conditions'=> array('UserGroups.user_id = User.id')
  		    ),
  		  array(
  		    'table'=>'groups',
  		    'alias'=>'Groups',
  		    'type'=>'inner',
  		    'conditions'=> array("UserGroups.group_id = Groups.id","Groups.id = 4")
  		    )
		  )
		  ));	*/
		$users = $this->Restaurant->User->find('list', array(	
		  'fields' => array('User.id', 'User.user_email'),
		  'order' => array('User.user_email'),
		  'joins' => array(
  		   array(
  		    'table'=>'restaurants_users',
  		    'alias'=>'RestaurantUsers',
  		    'type'=>'inner',
  		    'conditions'=> array("RestaurantUsers.user_id = User.id",'RestaurantUsers.restaurant_id='.$id))
		  )));	
		  	  	
		  $this->set(compact('cities', 'billingStates', 'cuisines', 'users'));
	}
	
	public function getRestaurantsByCity(){
	  $this->layout='ajax';
  	$this->set('restaurants',$this->Restaurant->find('list',array(
  	  'fields'=>array('Restaurant.id','Restaurant.address','Restaurant.name'),
  	   'conditions'=>array('Restaurant.city_id'=>$_GET['data']['Menu']['copy_city'],'Restaurant.active'=>1)
    )));
  	$this->set('id_set',$_GET['id']);
  	$this->set('type',$_GET['type']);
  	$this->render('ajax_addRestaurantSelect','ajax');
	}
	
	public function getMenusByRestaurant(){
	  $this->layout='ajax';
  	$this->set('restaurants',$this->Restaurant->find('all',array(
				  'contain' => array(				      
				      'RestaurantOrderType' => array(
				        'fields'=>array('RestaurantOrderType.id'),
				        'Menu'=>array(
				          'fields'=>array('Menu.id','Menu.name'),
				          'conditions' =>  array('Menu.active',1)
				        ),
				      ), 
				    ),
				    'conditions' => array(
				      'Restaurant.id' => $_GET['data']['Menu']['copy_restaurant'],
				      'Restaurant.active' => 1
				    ),
				    'fields'=>array('Restaurant.name')
				)));
		$this->set('id_set',$_GET['id']);
		$this->set('type',$_GET['type']);
  	$this->render('ajax_addMenuSelect','ajax');

	}
	
	public function getItemsByMenu(){
  	$this->layout = 'ajax';
  	$this->loadModel('Category');
  	$this->set('categories',$this->Category->find('all',array(
				    'contain' => array(
				      'Item' => array(
				        'fields'=>array('Item.id','Item.name'),
				        'conditions' =>  array('Item.active',1)
				      )
				    ),
				    'conditions' => array(
				      'Category.menu_id'=> $_GET['data']['Menu']['copy_menu'],
				      'Category.active'=> 1
				    ),
				    'fields'=>array('Category.id','Category.name')
				)));
		$this->set('id_set',$_GET['id']);
		$this->set('type',$_GET['type']);
  	$this->render('ajax_addItemSelect','ajax');
	}

/*Search Functions */
	public function search($cityname = null) {
	  if(!isset($_SESSION['lat']) && !isset($_SESSION['long'])){
				$this->redirect(array('controller'=>'pages','action' => 'home', '?'=>array('message'=>'invalid session')));
	  }

	  $this->layout='default';
	  if(!isset($_POST['sort_direction'])) {
	  	$sort = 'name ASC';
	  	$sortdist = 'distance ASC';
	  	
	  }
		
		$cityid = $this->Restaurant->City->find('first',
		array('conditions' => 
			array('AND' => array('City.name' => $cityname, 'City.active' => 1)
		)));
			
		$_SESSION['cityname'] = $cityname;

    	if(isset($_POST['ordertype'])) {
			$_SESSION['ordertype'] = $_POST['ordertype'];
		}
		
    	if(isset($_POST['chkdcuisines'])) {
			$this->set('chkdcuisines', $_POST['chkdcuisines']);
			$_SESSION['chkdcuisines'] = $_POST['chkdcuisines'];
		}		
		
		$type = $_SESSION['ordertype'];
		$this->set('ordertype', strtolower(ucfirst($type)));					

		if($cityid != null) {
			$citytimezone = $cityid['City']['timezone_id'];

			//Get City Timezone
			$timezone = $this->Restaurant->City->Timezone->find('first',array('conditions' => array('id' => $cityid['City']['timezone_id'])));
			$this->set('timezone', $timezone['Timezone']['name']);
			$_SESSION['timezone'] = $timezone['Timezone']['name'];
			
			//Get Current time, date, hour, minute, am or pm for the timezone of the 
			$stored_time = date('m/d/Y h:i:s a', time());
			date_default_timezone_set($timezone['Timezone']['name']);
			$timestamp = strtotime($stored_time);
			$timestamp = $timestamp + date('Z');
			$tomor_timestamp = $timestamp + date('Z')+1;
			$date = date('m/d/Y H:i:s A', $timestamp);
			$hour = date('H',$timestamp);
			$minute = date('i',$timestamp);
			$ampm = date('A',$timestamp);

			//Set today and tomorrows day of week
			$today = date( "l", $timestamp);
			$tomorrow = date("l", mktime(0,0,0,date("m"),date("d")+1,date("Y")));			
						
			
			if(!isset($_SESSION['ordertypefor'])) {
				//$selected_date = date("m/d/Y", mktime(0,0,0,date("m"),date("d")+1,date("Y")));
				$dw = $today;

			} else {
				
				$dw = date('l', strtotime($_SESSION['ordertypefor'].' 00:00:00'));
			}

			if(!isset($_SESSION['ordertypeat']) || $_SESSION['ordertypeat'] == '00:00') {
				//Set default time to the nearest 15 minute interval
				if($minute < 15)
					$minute = 30;
				else if ($minute < 30)
					$minute = 45;
				else if ($minute < 45) {
					$minute = 00;
					$hour++;
				} 
				else {
					$minute = 15;
					$hour++;
				}
				$defaulttime = $hour.':'.str_pad($minute, 2, '0', STR_PAD_LEFT);			
			
				$_SESSION['ordertypeat'] = $hour.':'.str_pad($minute, 2, '0', STR_PAD_LEFT);
				$_SESSION['ordertypefor'] = date('m/d/Y', $timestamp);
				$_SESSION['ordertypedate'] = $date;
				$_SESSION['ordertypeatisasap'] = 'Y';
			
			} else if 
				((strtotime($_SESSION['ordertypeat']) <= strtotime($_SESSION['ordertypeatasap']) && $_SESSION['ordertypefor'] == date('m/d/Y', $timestamp)) 
				|| 
				(isset($_POST['ordertypeat']) && strtotime($_POST['ordertypeat']) <= strtotime($_SESSION['ordertypeatasap']) && $_SESSION['ordertypefor'] == date('m/d/Y', $timestamp)) ){ 
				
				$_SESSION['ordertypeat'] = $_SESSION['ordertypeatasap'];
				$defaulttime = $_SESSION['ordertypeatasap'];
				$_SESSION['ordertypeatisasap'] = 'Y';
			} else {

				$defaulttime = $_SESSION['ordertypeat'];
				$_SESSION['ordertypeatisasap'] = 'N';
			}

			//Set the ASAP time every time this page loads
			$this->setASAP();
			
						
			$lat = $_SESSION['lat'];
			$lng = $_SESSION['lng'];
			
			//Parameters from drop down change
			if($this->RequestHandler->isAjax()) {
					if(isset($_POST['lattitude'])) {
						$lat = $_POST['lattitude'];
					}
					
					if(isset($_POST['longitude'])) {
						$lng = $_POST['longitude'];
					}
					
					if(isset($_POST['ordertype'])) {
						$type = $_POST['ordertype'];
					}
					
					if(isset($_POST['ordertypeat'])) {
						$defaulttime = $_POST['ordertypeat'];
						$_SESSION['ordertypeat'] = $_POST['ordertypeat'];
					}
					
					if(isset($_POST['ordertypefor'])) {
						$ordertypefor = $_POST['ordertypefor'];
						$dw = date('l', strtotime($ordertypefor.' 00:00:00'));
						
						$_SESSION['ordertypefor'] = $ordertypefor;
					}
					
					//if not sorting by distance
					if(isset($_POST['sort_direction'])) {
					
						if($_POST['sort_direction'] != 'distance DESC' && $_POST['sort_direction'] != 'distance ASC') {
							$sort = $_POST['sort_direction'];	
							$this->set('sort', $sort);
						}
						else {
							//else if sorting by distance
							$sortdist = $_POST['sort_direction'];
							$sort = 'name ASC';
						} 
					}
					else {
						$sort = 'name ASC';
					}		
			}
			
			$this->loadModel('RestaurantOrderType');
			$this->RestaurantOrderType->recursive = 3;
			
			if(isset($_POST['address_post'])) {
				$addressinfo = $this->geocodeaddress($_POST['address_post']);
		
			} else {
				$addressinfo = $this->validateAddress(null);
			}
			
			//Check if new city was entered; if new city check restaurants in that city
			if($_SESSION['cityname'] != $addressinfo['city']) {
				$cityid = $this->Restaurant->City->find('first',
				array('conditions' => 
					array('AND' => array('City.name' => $addressinfo['city'], 'City.active' => 1)
				)));
			}
		
		
			if(strtolower(trim($type)) == 'pickup') {
				//echo 'DW-'.$dw.'-Time-'.$defaulttime.'-City-'.$cityid['City']['id'];
				//Search for restaurants that can be picked up from			
				$restaurants = $this->Restaurant->getPickRestaurants($dw, $defaulttime, $cityid['City']['id'], $sort);
				$this->set('restaurants', $restaurants);	
				$this->set('dw', $dw);
				$this->set('defaulttime', $defaulttime);
						
			}
			else if(strtolower(trim($type)) == 'delivery') {
				//Search for Restaurants in the radius of the restaurant or the polygon of restaurant;  Latitude and Longitude are stored
				//as cookies when a users searches
				//$restaurants = $this->Restaurant->getDeliveryRestaurants($dw, $defaulttime, $lat, $lng, $cityid['City']['id'], $sort);
				//$data = $restaurants->paginate('Restaurant');
				//$this->set('restaurants', $restaurants);
				
					
					$lat = $addressinfo['lat'];
					$lng = $addressinfo['lng'];
					$address = $addressinfo['address'];
					$street = $addressinfo['street'];
					$streetnum = $addressinfo['streetnum'];	
					$addresstype = $addressinfo['type'];
		

					if(isset($addresstype) && ($addresstype == 'RANGE_INTERPOLATED' || $addresstype == 'ROOFTOP') || !isset($addresstype)) {
						$restaurants = $this->Restaurant->getDeliveryRestaurants($dw, $defaulttime, $lat, $lng, $cityid['City']['id'], $sort);
						$this->set('restaurants', $restaurants);
						$this->set('dw', $dw);
						$this->set('defaulttime', $defaulttime);
						
						//Set cuisines totals
						$this->set('allcuisines',$this->Restaurant->get_cuisine_totals($restaurants));
						
					}
					else {
						$restaurants = null;
						$this->set('restaurants', $restaurants);
						$code = 'invalid address';	
					}
			}
			
			//Set new address info if it is posted
			if(isset($addressinfo) && isset($restaurants) && count($restaurants) > 0) {
				$this->Geocoder->setGeoSessionVariables($addressinfo);
			}
			
			if(isset($restaurants)) {
				$maxpickupdeliverytime = 0;
				foreach($restaurants as $restaurant):
					foreach($restaurant as $restordertype):
						if(isset($restordertype['delivery_estimate_max']) && $restordertype['delivery_estimate_max'] > $maxpickupdeliverytime){
									$maxpickupdeliverytime = $restordertype['delivery_estimate_max'];
						}
		
					endforeach;	
				endforeach;
				
				$this->set('gettodaytime',$this->Restaurant->getTime($timezone['Timezone']['name'], 'today', $maxpickupdeliverytime));
			    $this->set('gettomorrowtime',$this->Restaurant->getTime($timezone['Timezone']['name'], 'tomorrow', $maxpickupdeliverytime));
			    
			    $this->set('getcurrentfuturedays',$this->Restaurant->getCurrentFutureDays($timezone['Timezone']['name'], 'today', $maxpickupdeliverytime));

				//Set cuisines totals
	      		$this->set('allcuisines',$this->Restaurant->get_cuisine_totals($restaurants));
      		
	      		//Get Distances
	      		$start[0] = $lat;
	      		$start[1] = $lng;      		
	      		$a = 0;
	      		
	      		
	      		foreach($restaurants as $restaurant) {
	      			$restlat = $restaurant['RestaurantOrderType']['lat'];
	      			$restlng = $restaurant['RestaurantOrderType']['long'];
	      			$finish[0] = $restlat;
	      			$finish[1] = $restlng;
	      			      			
	      			$dist = $this->Haversine($start, $finish);
	      			
	      			$restaurants[$a]['RestaurantOrderType']['distance'] = $dist;
	      			$a++;
	      			
	      		}
      		} else {
      			$this->set('gettodaytime',$this->Restaurant->getTime($timezone['Timezone']['name'], 'today', 30));
				$this->set('gettomorrowtime',$this->Restaurant->getTime($timezone['Timezone']['name'], 'tomorrow', 30));
			    $this->set('getcurrentfuturedays',$this->Restaurant->getCurrentFutureDays($timezone['Timezone']['name'], 'today', 30));
      		}
      		
      		if($cityid['City']['restaurants_closedindicator'] > count($restaurants))
      			$this->set('isclosed', 'isclosed');
      		
			if(isset($sortdist)) {    		
				if(strpos($sortdist, 'ASC', 0) == 0)
					$sortdist = '>';
				else
					$sortdist = '<';
				
	      		$sortedrestaurant = $this->bubble_sort($restaurants, $sortdist);
	      		$this->set('restaurants', $sortedrestaurant);
      		} else {
      			if(isset($restaurants))
      				$this->set('restaurants', $restaurants);
      		}
		} 
		else {
			$this->set('restaurants', null);
			$this->set('gettime',null);
			$this->set('allcuisines',null);
			
			$this->set('gettodaytime',null);
			$this->set('gettomorrowtime',null);
			$this->set('getcurrentfuturedays',null);
			$_SESSION['ordertypefor'] = null;
			$_SESSION['ordertypeatasap'] = null;
				
			$restaurants = null;
			$_SESSION['ordertypeat'] = 0;
			//echo $_SESSION['ordertypeat'];
		}
		
		
		if($this->RequestHandler->isAjax()) {
				
			if(isset($restaurants) && isset($_POST['returnresults'])) {
				if($restaurants != null) {
		  			//Set new date if today or tomorrow was changed
		  			if(isset($_POST['label'])) {
		  			
		  				$_SESSION[$_POST['label']]=$_POST['value'];
		  			
		  				if($_POST['label'] == 'ordertypefor_post') {
		  					$_SESSION['ordertypedate']=$selected_date;
		  				}
		  			}
		  			
		  			if($_POST['returnresults'] != 'true') {
						$this->render('found','ajax');  	
					}		
		  			else {
		  				$this->set('test',$defaulttime.'-'.$dw);
			  			$this->render('results','ajax');
			  		}
			  	}	else {
			  		if($_POST['returnresults'] != 'true') {
						$this->render('found','ajax');  	
					}		
		  			else {
		  				$this->set('test',$defaulttime.'-'.$dw);
			  			$this->render('results','ajax');
			  		}
			  	}
	  		}
	  		
	  		//$this->set('test',$_POST['returnresults']);
	  		$this->render('results','ajax');
	  			
	  	  }
	}
	
	
	/*
		Function will check if a restaurant exists based on location, time and order type
		AJAX Functions - 
	*/
	public function checkRestaurantExists($cityname = null) {
			
		$options = array('conditions' => array('City.name' => $cityname));
		$cityid = $this->Restaurant->City->find('first',$options);
		$restaurant_id = $_SESSION['restaurant_id'];
		$sort = 'name ASC';
		$code = '';
		//Check if restaurants exists in city
		if($cityid != null) {
			
			//Get variables
			$lat = $_SESSION['lat'];
			$lng = $_SESSION['lng'];
			$ordertype = $_SESSION['ordertype'];
			$orderfor = $_SESSION['ordertypedate'];
			$orderat = $_SESSION['ordertypeat'];
			$timezone = $_SESSION['timezone'];
			$time = $this->Restaurant->getTodayTomorrow($timezone);
			$dw = $time['today'];
				
			if($this->RequestHandler->isAjax()) {
					if(isset($_POST['label'])) {
						//If Order Type At is changed set new default time
						if($_POST['label'] == 'ordertypeat') {
							$orderat = $_POST['value'];
						}
						
						//If Order Type today or tomorrow is changed set day of week
						if($_POST['label'] == 'ordertypefor') {
							$ordertypefor = $_POST['value'];
							if($ordertypefor == 'today')
								$dw = $time['today'];
							else if($ordertypefor == 'tomorrow')
								$dw	= $time['tomorrow'];
						}
						
						//If Delivery or Pickup changed set new type
						if($_POST['label'] == 'ordertype') {
							$ordertype = $_POST['value'];
						}
						
						//If Address changed set new lat and long variables
						if($_POST['label'] == 'lat') {
							$lat = $_POST['value'];
						}
						if($_POST['label'] == 'lng' ) {
							$lng = $_POST['value'];
						}	
					}		
					else {
						if(isset($_POST['lattitude'])) {
							$lat = $_POST['lattitude'];
						}
						
						if(isset($_POST['longitude'])) {
							$lng = $_POST['longitude'];
						}
						
						if(isset($_POST['orderfor'])) {
							$orderfor = $_POST['orderfor'];
							
							$ordertypefor = $_POST['orderfor'];
							if($ordertypefor == 'today')
								$dw = $time['today'];
							else if($ordertypefor == 'tomorrow')
								$dw	= $time['tomorrow'];
						}
						
						if(isset($_POST['orderat'])) {
							$orderat = $_POST['orderat'];
						}
						
						if(isset($_POST['ordertype_post'])) {
							$ordertype = $_POST['ordertype_post'];
						}
						
					}	
				if(strtolower(trim($ordertype)) == 'pickup') {
					
					//Search for restaurants that can be picked up from
					$restaurants = $this->Restaurant->getPickRestaurants($dw, $orderat, $cityid['City']['id'], $sort);
					$this->set('restaurants', $restaurants);
					//Set cuisines totals
					$this->set('allcuisines',$this->Restaurant->get_cuisine_totals($restaurants));
					
					if(isset($_SESSION['deliverycharge'])) {
						$_SESSION['deliverycharge'] = 0;
					}	
				}
				else if(strtolower(trim($ordertype)) == 'delivery') {
	
					//Search for Restaurants in the radius of the restaurant or the polygon of restaurant;  Latitude and Longitude are stored
					//as cookies when a users searches
					

					if(isset($_POST['address_post'])) {
						$addressinfo = $this->geocodeaddress($_POST['address_post']);
						$lat = $addressinfo['lat'];
						$lng = $addressinfo['lng'];
						$address = $addressinfo['address'];
						$street = $addressinfo['street'];
						$streetnum = $addressinfo['streetnum'];	
						$type = $addressinfo['type'];						
					
					} 
					//echo $type;
					if(isset($type) && ($type == 'RANGE_INTERPOLATED' || $type == 'ROOFTOP') || !isset($type)) {
						$restaurants = $this->Restaurant->getDeliveryRestaurants($dw, $orderat, $lat, $lng, $cityid['City']['id'], $sort);
						$this->set('restaurants', $restaurants);
						
						//Set cuisines totals
						$this->set('allcuisines',$this->Restaurant->get_cuisine_totals($restaurants));
						
					}
					else {
						$restaurants = null;
						$code = 'invalid address';	
					}
					
				}
				
				$restaurant_exists = false;
				if(isset($restaurants)) {
					foreach($restaurants as $restaurant):
						if($restaurant['Restaurant']['id'] == $restaurant_id) {
							$restaurant_exists = true;
							break;	
						}
					endforeach;
				}
				
				
				
				if(isset($restaurants) && isset($_POST['returnresults']) && $restaurant_exists) {
					//echo '<pre>'; echo var_dump($restaurants); echo '</pre>';
					if($restaurants != null) {
			  			//Set new date if today or tomorrow was changed
			  			if(isset($_POST['label'])) {
			  			
			  				$_SESSION[$_POST['label']]=$_POST['value'];
			  			
			  				//Set new session variable date if changed date
			  				if($_POST['label'] == 'ordertypefor_post') {
			  					$_SESSION['ordertypedate']=$selected_date;
			  				}
			  			}
			  			
			  			//Set new lat and long if address changed
			  			if(isset($_POST['lattitude']))
			  				$_SESSION['lat']=$lat;
			  			
			  			if(isset($_POST['longitude']))
			  				$_SESSION['lng']=$lng;
			  				
			  			//Set new order for and order at
			  			if(isset($_POST['orderfor'])) {
			  				$_SESSION['ordertypedate']=$orderfor;		
			  				$_SESSION['ordertypefor']=$_POST['orderfor'];
			  			}
			  				
			  			if(isset($_POST['orderat']))
			  				$_SESSION['ordertypeat']=$orderat;					  					  				
			  			
			  			//Set new order type
			  			if(isset($_POST['ordertype_post'])) {
							$_SESSION['ordertype'] = $_POST['ordertype_post'];
						}
			  			
			  			if($_POST['returnresults'] != 'true') {
			  				//$this->set('test', $code);
			  				$this->set('code', $code);
							$this->render('found','ajax');  	
						}		
			  			else {
				  			$this->render('results','ajax');
				  		}
				  	}	
		  		}
		  		else {
		  			//$this->set('test', $code);
		  			$this->set('restaurants', null);
		  			$this->set('code', $code);
					$this->render('found','ajax');
		  		}
			}/* End if Ajax request */
		}/* End Check if restaurants are in city*/
		else {
			//$this->set('test', $ordertype);
			$this->set('restaurants', null);
			$this->render('found','ajax'); 
		}
	}
	
	/*
	* Called on Restaurants/Search page when user changes
	* from Pickup to Delivery and has Zip code as address
	**/
	public function searchChangeToDelivery(){
  	//Get Address
  	if(isset($_POST['address']))
			$address = $_POST['address'];

		//Validate Address
		$addressinfo = $this->validateAddress($address);
		$this->Geocoder->setGeoSessionVariables($addressinfo);
				
		//Throw error if invalid address
		if(isset($addressinfo['errors']) || ($_POST['ordertype'] == 'Delivery' && $addressinfo['type'] =='APPROXIMATE'))
  			$this->set('errors','error');
    
    	$this->render('ajax_searchChangeToDelivery','ajax');
	  
	}
	
	public function searchChangeAddress($address = null) {
		$this->loadModel('TempOrder');
		
		if(isset($_POST['address']))
			$address = $_POST['address'];
			
		//Validate Address
		$addressinfo = $this->validateAddress($address);

		if($addressinfo != null) {
			
			if(isset($_POST['ordertype']))
				$ordertype = $_POST['ordertype'];		
			else
				$ordertype = $_SESSION['ordertype'];

			if(isset($_SESSION['restaurant_id'])) {
				$restaurant_id = $_SESSION['restaurant_id'];
				$restaurant = $this->Restaurant->find('first',array('conditions'=>array('id'=>$restaurant_id)));
			}
			
			$ordertypeat = $_SESSION['ordertypeat'];
			$ordertypefor = $_SESSION['ordertypefor'];
			$ordertypefor = date('l', strtotime($ordertypefor.' 00:00:00'));
			
			//$ordertypefor = CakeTime::format('l', $dw, false,$_SESSION['timezone']);
			//echo 'session='.$_SESSION['ordertypefor'].'var='.$ordertypefor.'dw='.$dw;
			
			$cityname = $_SESSION['cityname'];
			$cityid = $this->Restaurant->City->find('first',array('conditions' => array('City.name' => $cityname)));
			$sort = 'name ASC';
			
			if(trim($ordertypeat == 'ASAP') || trim($ordertypeat) == '') {
				//If ASAP the order at will be empty to we will add the delivery max and set a new order type at value
		   		if($ordertypeat == 'ASAP' || trim($ordertypeat) == '') {
		   			$currenttime = time();
		   			$orderat = CakeTime::format('H:i', $currenttime, false,$_SESSION['timezone']);
		   		} else {
		   			$orderat = $ordertypeat;
		   		}
			} else {
				$orderat = $ordertypeat;
			}	
			
			if(trim(strtolower($ordertype)) == 'pickup') {		
				$valid_restaurants = $this->Restaurant->getPickRestaurants($ordertypefor, $orderat, $cityid['City']['id'], $sort);
				
			} else if(trim(strtolower($ordertype)) == 'delivery' && $addressinfo['type'] != 'APPROXIMATE')  {			
				
				$valid_restaurants = $this->Restaurant->getDeliveryRestaurants($ordertypefor, $orderat, $addressinfo['lat'], $addressinfo['lng'], $cityid['City']['id'], $sort);
				
			}
			/*echo $ordertype.'-'.$ordertypefor.'-'.$orderat.'-'.$cityid['City']['id'].'-'.$sort;*/
			echo $_POST['ordertype'];
			echo '<pre>';
				var_dump($valid_restaurants);
			echo'</pre>';
			
			
			if(isset($valid_restaurants) && !empty($valid_restaurants)) {
		   		//If order type has changed then change menu page to pull that order type menu and reset order type in session
	   			$this->Geocoder->setGeoSessionVariables($addressinfo);
	   			$this->set('ordertype', strtolower($ordertype));
	   			$this->set('restaurants', $valid_restaurants);	   			
		  		$this->render('results','ajax');
			}
			else
				$errorcode = 'Please enter a valid address.';
				
			$this->set('errorcode', $errorcode);			
				
		}
		else {
			$errorcode = 'Please enter a valid address.';
			$this->set('errorcode', $errorcode);
		}
		
	}	

/* Menu Functions */
	public function menu($restaurant_id = null, $restaurantordertypeid = null) {
	   
	   if(!isset($_SESSION['lat']) && !isset($_SESSION['long'])){
				$this->redirect(array('controller'=>'pages','action' => 'home', '?'=>array('message'=>'invalid session')));
     }
	   $this->layout='default';
	   $this->loadModel('TempOrder');
	   $this->loadModel('Order');
	   $this->loadModel('Restaurant');
	   $this->loadModel('User');
	   $this->loadModel('RestaurantOrderType');
	   
	   //Determine if this is a new order or a existing order for the restaurant
	   $isneworder = true;

	  if(isset($_SESSION['restaurant_id'])) {
		   if($_SESSION['restaurant_id'] == $restaurant_id && isset($_SESSION['orderid']) && $_SESSION['orderid'] != null) {
		   		//Check temp order id is in orders table
		   		$temporderid = $_SESSION['orderid'];
		   		$temporder = $this->TempOrder->getTempOrder($temporderid);
		   		
		   		if($temporder != null)
		   			$isneworder = false;
		   }
	   } 
	   $_SESSION['restaurant_id'] = $restaurant_id;
	   $_SESSION['ordertypeid'] = $restaurantordertypeid;
	   //Get Restaurant Data
	   $restaurant = $this->Restaurant->find('first',array(
	   	'conditions'=>array('Restaurant.id'=>$restaurant_id),
	   	'contain' =>array(
	   		'City'=>array(
	   			'Timezone'
	   		)
	   	)
	   	));
	   $user = $this->Auth->user();

	   $userhasbeentorestaurant = $this->TempOrder->find('list',array(
	   	'conditions'=>array('TempOrder.restaurant_id'=>$restaurant_id,'TempOrder.user_id'=>$user['id']),
	   	'contain' =>array(
	   		'City'=>array(
	   			'Timezone'
	   		)
	   	)
	   	));
	   	
	   if(isset($restaurant['Restaurant']['deals']) && !$userhasbeentorestaurant)
	   		$_SESSION['deals'] = $restaurant['Restaurant']['deals'];
	   else
		   	$_SESSION['deals'] = null;
		   	
	   $this->set('timezone', $restaurant['City']['Timezone']['name']);
	   
   
	   
	   //Get order at time
	   $orderat = $_SESSION['ordertypeat'];

	   //Get order at date
	   $orderdate = $_SESSION['ordertypefor'];
	   //Correct format - 2013-04-19 17:00:00
	   $d = date('Y-m-d', strtotime($orderdate));
	   $t = date('H:i:s', strtotime($orderat.':00'));
	   $orderdate = date('Y-m-d H:i:s', strtotime($d . ' ' . $t));
	   //Get order day today or tomorrow
	   $orderfor = $_SESSION['ordertypefor'];
	   
	   //Get order type - deliver/pickup
	   $ordertype = $_SESSION['ordertype'];
	   
	   //Set timezone in session
	   $timezone=$restaurant['City']['Timezone']['name'];
	   $_SESSION['timezone'] = $timezone;
	   
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
			
		$today = date( "m/d/Y", $timestamp);
		$tomorrow = date("m/d/Y", mktime(0,0,0,date("m"),date("d")+1,date("Y")));
		
	   	//Set the ASAP time every time this page loads
		$this->setASAP();
		$date = date('m/d/Y', time());

		if($today == $_SESSION['ordertypefor'])
			if ((strtotime($_SESSION['ordertypeat']) <= strtotime($_SESSION['ordertypeatasap'])) || 
				(isset($_POST['ordertypeat']) && strtotime($_POST['ordertypeat']) <= strtotime($_SESSION['ordertypeatasap']))){
				
				
					$_SESSION['ordertypeat'] = $_SESSION['ordertypeatasap'];
					$_SESSION['ordertypeatisasap'] = 'Y';
			} else {
				$defaulttime = $_SESSION['ordertypeat'];
				$_SESSION['ordertypeatisasap'] = 'N';
			}	
		else {
			$defaulttime = $_SESSION['ordertypeat'];
			$_SESSION['ordertypeatisasap'] = 'N';
		}				   
	   
		$this->set('today', $today);
		$this->set('tomorrow', $tomorrow);	   
	   
	   $this->set('tip',$this->Restaurant->getTipAmounts());

	   $this->set('salestax', '0.00');
	   $this->set('subtotal', '0.00');
	   $this->set('total', '0.00');	
	   
	   if($user == null && $_SESSION['deals']) {
	   		$this->set('discount', '$0.00');
	   }   
			$address = '';
	   		if(isset($_SESSION['streetnum']) && $_SESSION['streetnum'] != '')
				$address = $_SESSION['streetnum'].' '.$_SESSION['street'].',';
			if(isset($_SESSION['city']))
				$address .= $_SESSION['city'];
			if(isset($_SESSION['state']))
				$address .= ' '.$_SESSION['state'];	
	   	
		$zip = $_SESSION['zip']; 		   		   
		
	   $rest_order_type_object = $this->Restaurant->RestaurantOrderType->find('first',array('conditions' => array('id'=>$restaurantordertypeid)));
	   
	   $this->set('deliveryminimum', $rest_order_type_object['RestaurantOrderType']['delivery_min']);
	   
		$this->set('gettodaytime',$this->Restaurant->getTime($restaurant['City']['Timezone']['name'], 'today', $rest_order_type_object['RestaurantOrderType']['delivery_estimate_max']));
	    $this->set('gettomorrowtime',$this->Restaurant->getTime($restaurant['City']['Timezone']['name'], 'tomorrow', $rest_order_type_object['RestaurantOrderType']['delivery_estimate_max']));
	    
	    $_SESSION['delivery_estimate_max'] = $rest_order_type_object['RestaurantOrderType']['delivery_estimate_max'];

	    $this->set('getcurrentfuturedays',$this->Restaurant->getCurrentFutureDays($restaurant['City']['Timezone']['name'], 'today', 30));
	    
	   $data = array();
	   //if new order then create order else get order 
	   if($isneworder == 1) {

	   		//Set Delivery charge
			$_SESSION['deliverycharge'] = $rest_order_type_object['RestaurantOrderType']['delivery_charge'];
			
			//If ASAP the order at will be empty to we will add the delivery max and set a new order type at value
	   		if($orderat == '') {
	   			$currenttime = strtotime('+'.$rest_order_type_object['RestaurantOrderType']['delivery_charge'].' minutes', time());
	   			$orderat = CakeTime::format('H:i', $currenttime, false,$_SESSION['timezone']);
	   			$_SESSION['ordertypeat'] = 'ASAP';
	   		}	
	   		
	   		   			
		   $data['TempOrder']=array(
			   	'address'=>$address,
			   	'zip'=>$zip,
			   	'city'=>$restaurant['Restaurant']['city_id'],
			   	'state'=>$restaurant['City']['state_id'],		   			   	
			   	'order_for'=>$orderfor,
			   	'type'=>$ordertype,
			   	'order_date'=>$orderdate,
			   	'order_at'=>$orderat,
			   	'restaurant_id'=>$restaurant_id,
			   	'sub_total'=>'0',
			   	'tax'=>$restaurant['Restaurant']['sales_tax'],
			   	'total'=>'0',
			   	'user_id'=>'0',
			   	'order_type_id'=>$rest_order_type_object['RestaurantOrderType']['order_type_id'],
			   	'status'=>'menu'
		   	);
		   		$this->TempOrder->create();
		   	  if($this->TempOrder->save($data)) {
			   		$this->set('orderid', $this->TempOrder->id);
			   		$_SESSION['orderid'] = $this->TempOrder->id;
			   		
			   		$temporder = $this->TempOrder->getTempOrder($this->TempOrder->id);
			   		$tempordertotals = $temporder['tempordertotals'];
	   				$orderdetails = $temporder['orderdetails'];
	   				
		        	$this->set('subtotal', money_format('%i', $tempordertotals['subtotal']));
					$this->set('total', money_format('%i', $tempordertotals['total']));
					$this->set('salestax', money_format('%i', $tempordertotals['salestax']));
					$this->set('discount', money_format('%i', $tempordertotals['discount']));
					
					$this->set('orderdetails', $orderdetails);	   				
			   		
			   } else {
			   		$this->Session->setFlash(__('The order could not be started. Please, try again.'),'flash_bad');
			   		
			   }
			   
  			
			
	   
	   } else {
	   			
	   		$tempordertotals = $temporder['tempordertotals'];
	   		$orderdetails = $temporder['orderdetails'];
	   		
	   		//$this->set('subtotal', str_pad((string)$tempordertotals['subtotal'], 5, '00', STR_PAD_RIGHT));
	   		$this->set('orderid', $temporderid);
	   		
        	$this->set('subtotal', money_format('%i', $tempordertotals['subtotal']));
			$this->set('total', money_format('%i', $tempordertotals['total']));
			$this->set('salestax', money_format('%i', $tempordertotals['salestax']));
			$this->set('discount', money_format('%i', $tempordertotals['discount']));
			
			$this->set('orderdetails', $orderdetails);
			
			//If ASAP the order at will be empty to we will add the delivery max and set a new order type at value
	   		if($orderat == '') {
	   			$_SESSION['ordertypeat'] = 'ASAP';
	   		}	
	   }
	   	   
	   $this->set(
	     'menus',
	     $this->Restaurant->getResturantItems($restaurant_id, $restaurantordertypeid)
	   );
	}
	
	/* Menu Functions */
	public function previewmenu($restaurant_id = null, $restaurantordertypeid = null) {

	   $this->layout='default';
	
	  
	   $user = $this->Auth->user();
	   	   
	   $this->set(
	     'menus',
	     $this->Restaurant->getResturantItems($restaurant_id, $restaurantordertypeid)
	   );
	}
	
	/*  Remove Promove 
		Views - Menu, Order
		JQuery - menu.js (removePromotionCode)
	*/
	public function removepromo() {
		$this->loadModel('Promotion');
		$this->loadModel('TempOrder');
		$this->loadModel('PromoCode');
		
		if(isset($_POST['orderid']))
			$orderid = $_POST['orderid'];
		else
			$orderid = null;
		
		//Get Order
		$order = $this->TempOrder->getOrderDetails($orderid);
		$promocodeid = $order[0]['TempOrder']['promo_code_id'];
		$promotioncode = $this->Promotion->getPromotionCode($promocodeid);

		//get the array count
		$promocodetableid = $this->searchForCodebyid($promocodeid, $promotioncode['PromoCode']);
	
		//Update promotion code used count
		$promodata['PromoCode']['id'] = $promocodeid;
		$promodata['PromoCode']['used_count'] = $promotioncode['PromoCode'][$promocodetableid]['used_count'] - 1;
		
		
		if($this->PromoCode->save($promodata)) {

		} else {
			$this->Session->setFlash(__('Error saving. Please, try again.','flash_bad'));
		}	
		
		//Update temp order
		$orderdata = array();
		$orderdata['TempOrder']=array(
			'id'=> $orderid,
			'promo_percentage'=>0,
			'promo_discount'=>0.00,
			'promo_code_id'=>0
		);
		
		
		if($this->TempOrder->save($orderdata)) {
			//Update temp order total
			$this->TempOrder->updateOrderTotal($orderid, null);
		} else {
			$this->Session->setFlash(__('The item could not be saved. Please, try again.','flash_bad'));
		}
		
		//Get new totals
		$order = $this->TempOrder->getOrderTotal($orderid);
		$promodiscount = $order['promodiscount'];
		$newtotal = $order['total'];
		
		$data['valid'] = 'valid';
		$data['discount'] = $promodiscount;
		$data['total'] =  $newtotal;
		
		$this->set('valid', $data);
		
	}
	
	/*  Validate Promo
		Views - Menu, Order
		JQuery - menu.js (validatePromotionCode)
	*/
	
	public function validatepromo() {
		$this->loadModel('Promotion');
		$this->loadModel('PromoCode');
		$this->loadModel('TempOrder');
		
		if(isset($_POST['promo']))
			$promocode = $_POST['promo'];
			
		if(isset($_POST['ordertype']))
			$ordertype = $_POST['ordertype'];
		
		if(isset($_POST['orderid']))
			$orderid = $_POST['orderid'];
		else
			$orderid = null;
		
		//Get order and validate there are items
		$order = $this->TempOrder->getOrderTotal($orderid);
		if($order['total'] != 0.00) {
			//Validate Promotions
			$valid = $this->Promotion->promoIsValid($promocode, $ordertype);
			if(!empty($valid)) {

				//Get Promocode id
				$promocodeid = $this->searchForCodebycode($promocode, $valid[0]['PromoCode']);
				
				$promodiscount = ($valid[0]['Promotion']['discount_percent']/100) * $order['subtotal'];
				
				//Update temp order with promo discount
				$orderdata = array();
				$orderdata['TempOrder']=array(
					'id'=> $orderid,
					'promo_percentage'=>$valid[0]['Promotion']['discount_percent'],
					'promo_discount'=>$promodiscount,
					'promo_code_id'=>$promocodeid
				);
				
				//save discount and update total
				if($this->TempOrder->save($orderdata)) {
					$this->TempOrder->updateOrderTotal($orderid, null);
				} else {
					$this->Session->setFlash(__('The item could not be saved. Please, try again.','flash_bad'));
				}
				
				
				$promocodetableid = $this->searchForCodebyid($promocodeid, $valid[0]['PromoCode']);
				//Update promotion code used count
				$promodata['Promotion']['id'] = $valid[0]['Promotion']['id'];
				$promodata['PromoCode'][0]['id'] = $valid[0]['PromoCode'][$promocodetableid]['id'];
				$promodata['PromoCode'][0]['used_count'] = $valid[0]['PromoCode'][$promocodetableid]['used_count'] + 1;
				if($this->Promotion->saveAll($promodata)) {

				} else {
					$this->Session->setFlash(__('Error saving. Please, try again.','flash_bad'));
				}
				
				
				//Get new totals
				$order = $this->TempOrder->getOrderTotal($orderid);
				$promodiscount = $order['promodiscount'];
				$newtotal = $order['total'];
				
				$data['valid'] = 'valid';
				$data['discount'] = $promodiscount;
				$data['total'] =  $newtotal;
				$this->set('valid', $data);	
			} else {
				$this->set('valid', $valid);
			}
		} else {
			$this->set('valid', 'noorder');
		}
		
	}
	
		
	/*  Change Address
		Views - Menu, Order
		JQuery - menu.js (changeaddress)
	*/
	
	public function changeaddress($address = null) {
		$this->loadModel('TempOrder');
		
		if(isset($_POST['address']))
			$address = $_POST['address'];
			
		//Validate Address
		$addressinfo = $this->validateAddress($address);

		//Check if new city was entered; if new city check restaurants in that city
		if($_SESSION['cityname'] != $addressinfo['city']) {
			$cityid = $this->Restaurant->City->find('first',
			array('conditions' => 
				array('AND' => array('City.name' => $addressinfo['city'], 'City.active' => 1)
			)));
		} else {
			$cityname = $_SESSION['cityname'];
			$cityid = $this->Restaurant->City->find('first',array('conditions' => array('City.name' => $cityname)));
		}

		if($addressinfo != null) {
			
			if(isset($_POST['ordertype']))
				$ordertype = $_POST['ordertype'];		
			else
				$ordertype = $_SESSION['ordertype'];

			if(isset($_SESSION['restaurant_id'])) {
				$restaurant_id = $_SESSION['restaurant_id'];
				$restaurant = $this->Restaurant->find('first',array('conditions'=>array('id'=>$restaurant_id)));
			}
			
			$ordertypeat = $_SESSION['ordertypeat'];
			$ordertypefor = $_SESSION['ordertypefor'];
			$ordertypefor = date('l', strtotime($ordertypefor.' 00:00:00'));
			
			//$ordertypefor = CakeTime::format('l', $dw, false,$_SESSION['timezone']);
			//echo 'session='.$_SESSION['ordertypefor'].'var='.$ordertypefor.'dw='.$dw;
			

			$sort = 'name ASC';
			
			if(trim($ordertypeat == 'ASAP') || trim($ordertypeat) == '') {
				//If ASAP the order at will be empty to we will add the delivery max and set a new order type at value
		   		if($ordertypeat == 'ASAP' || trim($ordertypeat) == '') {
		   			$currenttime = time();
		   			$orderat = CakeTime::format('H:i', $currenttime, false,$_SESSION['timezone']);
		   		} else {
		   			$orderat = $ordertypeat;
		   		}
			} else {
				$orderat = $ordertypeat;
			}	
			
			if(trim(strtolower($ordertype)) == 'pickup' && $restaurant['Restaurant']['po_pickup'] == '1') {		

				$valid_restaurants = $this->Restaurant->getPickRestaurants($ordertypefor, $orderat, $cityid['City']['id'], $sort);
				
			} else if(trim(strtolower($ordertype)) == 'delivery' && $restaurant['Restaurant']['po_delivery'] == '1' && $addressinfo['type'] != 'APPROXIMATE')  {			
				
				$valid_restaurants = $this->Restaurant->getDeliveryRestaurants($ordertypefor, $orderat, $addressinfo['lat'], $addressinfo['lng'], $cityid['City']['id'], $sort);
				
			}
			//echo 'ordertype'.$ordertype.'-'.$ordertypefor.'-'.$orderat.'-'.$cityid['City']['id'].'-'.$sort;
			/*echo '<pre>';
				var_dump($valid_restaurants);
			echo'</pre>';*/
			
			
			if(isset($valid_restaurants) && !empty($valid_restaurants)) {
				$errorcode = 'OK';
				$ordertypeid =  $valid_restaurants[0]['RestaurantOrderType']['id'];
				
				if(isset($addressinfo['zip']) && trim($addressinfo['address']) == '')
					$address = $addressinfo['zip'];
				else if (isset($addressinfo['zip']))
					$address == $addressinfo['zip'];
					
				//Update Temp Order
				$data['TempOrder']=array(
				   	'address'=>$address,
				   	'id'=>$_SESSION['orderid']
   				);
			   	
			   	if($this->TempOrder->save($data)) {
			   		$ordertypeid =  $valid_restaurants[0]['RestaurantOrderType']['id'];	
					$_SESSION['ordertypeid'] = $ordertypeid;				   		

			   		//If order type has changed then change menu page to pull that order type menu and reset order type in session
			   		if(isset($_POST['ordertype']) && strtolower($_POST['ordertype']) != strtolower($_SESSION['ordertype'])) {
			   			$this->set('address', 'CHANGEMENU-'.$ordertypeid);
			   			$this->Geocoder->setGeoSessionVariables($addressinfo);
				   		//Update Order Type
				   		$_SESSION['ordertype'] = strtoupper($ordertype);					   				   			
			   		}
			   		 else {
				   	  	//Set address session variables
				   	  	$this->Geocoder->setGeoSessionVariables($addressinfo);
				   	  	
				   	  	if(isset($addressinfo['streetnum']))
				   	  		$addressinformation = $addressinfo['streetnum'];
				   	  	if(isset($addressinfo['streetnum']) && trim($addressinfo['streetnum']) != '')
				   	  		$addressinformation = $addressinformation.' '.$addressinfo['street'].'<br>';
				   	  	if(isset($addressinfo['city']))
				   	  		$addressinformation = $addressinformation.$addressinfo['city'].', '.$addressinfo['state'];
				   	  		
				   	  	$this->set('address', $addressinformation);
				   	}

			   			  	
				} else {
					$this->Session->setFlash(__('The order could not be started. Please, try again.'));
					$errorcode = 'ERROR';
				}
			}
			else
				$errorcode = 'Please enter a valid address.';
				
			$this->set('errorcode', $errorcode);			
				
		}
		else {
			$errorcode = 'Please enter a valid address.';
			$this->set('errorcode', $errorcode);
		}
		
	}
	
	/*  Change Order Time
		Views - Menu, Order
		JQuery - menu.js (changeOrderTime)
	*/	
	
	public function changeordertime($todaytomorrow = null, $time = null) {
		$this->loadModel('TempOrder');
		
		if(isset($_POST['todaytomorrow']))
			$todaytomorrow = $_POST['todaytomorrow'];
		
		if(isset($_POST['time']))
			$time = $_POST['time'];
			
		$ordertype = $_SESSION['ordertype'];

		$restaurant_id = $_SESSION['restaurant_id'];
		$restaurant = $this->Restaurant->find('first',array('conditions'=>array('id'=>$restaurant_id)));
		$cityname = $_SESSION['cityname'];
		$cityid = $this->Restaurant->City->find('first',array('conditions' => array('City.name' => $cityname)));

		//Get City Timezone
			$timezone = $this->Restaurant->City->Timezone->find('first',array('conditions' => array('id' => $cityid['City']['timezone_id'])));
		//Get Current time, date, hour, minute, am or pm for the timezone of the 
		$stored_time = date('m/d/Y h:i:s a', time());
		date_default_timezone_set($timezone['Timezone']['name']);
		$timestamp = strtotime($stored_time);
		$timestamp = $timestamp + date('Z');
		$tomor_timestamp = $timestamp + date('Z')+1;
		$date = date('Y-m-d H:i:s A', $timestamp);
		$hour = date('H',$timestamp);
		$minute = date('i',$timestamp);
		$ampm = date('A',$timestamp);
			
		$today = date( "l", $timestamp);
		$tomorrow = date("l", mktime(0,0,0,date("m"),date("d")+1,date("Y")));
		
		$ordertypeat = $time;

		if(trim($ordertypeat == 'ASAP') || trim($ordertypeat) == '') {
			//If ASAP the order at will be empty to we will add the delivery max and set a new order type at value
	   		if($ordertypeat == 'ASAP' || trim($ordertypeat) == '') {
	   			$currenttime = time();
	   			$orderat = CakeTime::format('H:i', $currenttime, false,$_SESSION['timezone']);
	   		} else {
	   			$orderat = $ordertypeat;
	   		}
		} else {
			$orderat = $ordertypeat;
		}	
		
		if($todaytomorrow == 'today') {
			$ordertypefor = $today;
			$ordertypefordate = $todaytomorrow;
		}
		else if($todaytomorrow == 'tomorrow') {
			$ordertypefor= $tomorrow;
			$ordertypefordate = $todaytomorrow;
		}
		else {
			$ordertypefor = date('l', strtotime($todaytomorrow.' 00:00:00'));
			$ordertypefordate = $todaytomorrow;
		}
			
		$sort = 'name ASC';
		$addressinfo = $this->validateAddress();
		if(trim(strtolower($ordertype)) == 'pickup' && $restaurant['Restaurant']['po_pickup'] == '1') {

			$valid_restaurants = $this->Restaurant->getPickRestaurants($ordertypefor, $orderat, $cityid['City']['id'], $sort);
					
		} else if(trim(strtolower($ordertype)) == 'delivery' && $restaurant['Restaurant']['po_delivery'] == '1')  {
		
			$valid_restaurants = $this->Restaurant->getDeliveryRestaurants($ordertypefor, $orderat, $addressinfo['lat'], $addressinfo['lng'], $cityid['City']['id'], $sort);
								
		}
		if(isset($valid_restaurants) && count($valid_restaurants) > 0) {
			$errorcode = 'OK';
			
			foreach($valid_restaurants as $restaurant):
				foreach($restaurant as $restordertype):
					if(isset($restordertype['restaurant_id']) && $restordertype['restaurant_id'] == $restaurant_id){

						$ordertypedeliverymax = $restordertype['delivery_estimate_max'];
						$ordertypedeliverymin = $restordertype['delivery_estimate_min'];
						
						$ordertypeid = $restordertype['id'];		
					}
	
				endforeach;	
			endforeach;
		}
		
		if(isset($ordertypedeliverymin) && isset($ordertypedeliverymax)) {
			if(trim($ordertypeat == 'ASAP') || trim($ordertypeat) == '') {
				//If ASAP the order at will be empty to we will add the delivery max and set a new order type at value
		   		if($ordertypeat == 'ASAP' || trim($ordertypeat) == '') {
		   			$currenttime = strtotime(time());
		   			$orderat = CakeTime::format('H:i', $currenttime, false,$_SESSION['timezone']);
		   			$ordertypedeliveryestimate = $ordertypedeliverymin.' - '.$ordertypedeliverymax.' minutes';
		   		} else {
		   			$orderat = $ordertypeat;
		   			$ordertypedeliveryestimate = $ordertypedeliverymax;
		   		}
			} else {
				$orderat = $ordertypeat;
		   		$ordertypedeliveryestimate = $ordertypedeliverymax;				
			}
			
			//Correct format - 2013-04-19 17:00:00
			$d = date('Y-m-d', strtotime($ordertypefor));
			$t = date('H:i:s', strtotime($ordertypeat.':00'));
			$orderdate = date('Y-m-d H:i:s', strtotime($d . ' ' . $t));
			   
			//Update Temp Order
			$data['TempOrder']=array(
			   	'order_at'=>$orderat,
			   	'order_for'=>$todaytomorrow,
			   	'order_date'=>$orderdate,			   				   	
			   	'id'=>$_SESSION['orderid']
				);
		   	
		   	if($this->TempOrder->save($data)) {
		   	  	//$this->set('ordertime', $ordertypefor);
		   	  	$this->set('ordertime', $ordertypedeliveryestimate);
		   	  	$_SESSION['ordertypeat']=$ordertypeat;
		   	  	$_SESSION['ordertypefor']=date('d-m-Y', strtotime($ordertypefordate));
		   	  	
			} else {
				$this->Session->setFlash(__('The order could not be started. Please, try again.'));
				$errorcode = 'ERROR';
			}
		}
		else {
			$errorcode = 'ERROR';	
		}	
		
		if(isset($errorcode))
			$this->set('errorcode', $errorcode);
			
	}
	
	/*  Change Order Type = Pickup or Delivery
		Views - Menu, Order
		JQuery - menu.js (changeOrderType)
	*/	
	
	public function changeordertype($ordertype = null) {
		//Validate restaurant has new order type
		$this->loadModel('TempOrder');
		
		if(isset($_POST['ordertype']) || $ordertype != null) {
			
			if(isset($_POST['ordertype']))
				$ordertype = $_POST['ordertype'];
				
			if(isset($_SESSION['restaurant_id'])) {
					$restaurant_id = $_SESSION['restaurant_id'];
					$restaurant = $this->Restaurant->find('first',array('conditions'=>array('id'=>$restaurant_id)));
					
					$addressinfo = $this->validateAddress();
					
					$ordertypeat = $_SESSION['ordertypeat'];
					$ordertypefor = $_SESSION['ordertypefor'];

					$dw = date('l', strtotime($_SESSION['ordertypefor']));
					$cityname = $_SESSION['cityname'];
					$cityid = $this->Restaurant->City->find('first',array('conditions' => array('City.name' => $cityname)));

					$sort = 'name ASC';
					
					if(trim($ordertypeat == 'ASAP') || trim($ordertypeat) == '') {
						//If ASAP the order at will be empty to we will add the delivery max and set a new order type at value
				   		if($ordertypeat == 'ASAP' || trim($ordertypeat) == '') {
				   			$currenttime = time();
				   			$orderat = CakeTime::format('H:i', $currenttime, false,$_SESSION['timezone']);
				   		} else {
				   			$orderat = $ordertypeat;
				   		}
					} else {
						$orderat = $ordertypeat;
					}

					
					if(trim(strtolower($ordertype)) == 'pickup' && $restaurant['Restaurant']['po_pickup'] == '1') {
						$valid_restaurants = $this->Restaurant->getPickRestaurants($dw, $orderat, $cityid['City']['id'], $sort);
						
					} else if(trim(strtolower($ordertype)) == 'delivery' && $restaurant['Restaurant']['po_delivery'] == '1' && $addressinfo['type'] != 'APPROXIMATE')  {
						
						$valid_restaurants = $this->Restaurant->getDeliveryRestaurants($dw, $orderat, $addressinfo['lat'], $addressinfo['lng'], $cityid['City']['id'], $sort);
						
					}
					
					//echo $dw.'-'.$ordertypeat.'-'.$addressinfo['lat'].'-'.$addressinfo['lng'];

					if(isset($valid_restaurants) && count($valid_restaurants) != 0) {
						$errorcode = 'OK';
						foreach($valid_restaurants as $restaurant):
							foreach($restaurant as $restordertype):
								if(isset($restordertype['restaurant_id']) && $restordertype['restaurant_id'] == $restaurant_id){
									
									$ordertypeid = $restordertype['id'];		
								}
				
							endforeach;	
						endforeach;

						if(isset($ordertypeid)) {
							//Update Temp Order
							$data['TempOrder']=array(
							   	'order_type_id'=>$ordertypeid,
							   	'id'=>$_SESSION['orderid']
			   				);
			   				
			   				$getorder = $this->TempOrder->getOrderDetails($_SESSION['orderid']);
			   				foreach($getorder[0]['TempItem'] as $tempitem):
			   					$this->TempOrder->TempItem->TempVariation->deleteAll(array('temp_item_id'=>$tempitem['id'], false));
			   					$this->TempOrder->TempItem->delete($tempitem['id']);
			   				endforeach;
						   	
						   	if($this->TempOrder->delete($_SESSION['orderid'])) {
						   		
						   		//Set ordertype
						   	  	$_SESSION['ordertype'] = strtoupper($ordertype);					   		
						   	  	$_SESSION['ordertypeid'] = $ordertypeid;
						   	  	$this->set('ordertypeid', $ordertypeid);
						   	  	unset($_SESSION['orderid']);
							} else {
								$this->Session->setFlash(__('The order could not be started. Please, try again.'));
							}
						} else {
							$errorcode = 'NOMENU';
							$this->Session->setFlash(__('The order could not be started. Please, try again.'));
						}
					}
					else
						$errorcode = 'CHANGEADDRSS';
						
					$this->set('errorcode', $errorcode);
					
				} 
				else {
					//Used on search restaurants page
					$addressinfo = $this->validateAddress();
					
					$this->set('errorcode', 'test');
				}
				
		}
	}	
	
	
	
	/* Order Functions */
	public function order($temporderid = null) {
	   if(!isset($_SESSION['lat']) && !isset($_SESSION['long'])){
				$this->redirect(array('controller'=>'pages','action' => 'home', '?'=>array('message'=>'invalid session')));
     	}		
     	$this->layout = 'default';
		//Get Order Totals
		$this->loadModel('TempOrder');
		$tempordertotals = $this->TempOrder->getOrderTotal($temporderid);

		//Get user information if logged in
		$user = $this->Auth->user();		

		if(!empty($user)){
		
			$this->loadModel('User');
			$user = $this->User->find('first',array(
			   	'conditions'=>array('User.id'=>$user['id']
			   	)
			));
			$paymentinfo = $user['PaymentInfo'];
				
			$this->set('user', $user); 
			$this->set('paymentinfo', $paymentinfo); 
		}
		

		//Get order day today or tomorrow
		$orderfor = $_SESSION['ordertypefor'];
		
		//Get Current time, date, hour, minute, am or pm for the timezone of the 
		$stored_time = date('m/d/Y h:i:s a', time());
		date_default_timezone_set($_SESSION['timezone']);
		$timestamp = strtotime($stored_time);
		$timestamp = $timestamp + date('Z');
		$tomor_timestamp = $timestamp + date('Z')+1;
		$date = date('Y-m-d H:i:s A', $timestamp);
		$hour = date('H',$timestamp);
		$minute = date('i',$timestamp);
		$ampm = date('A',$timestamp);
			
		$today = date( "d-m-Y", $timestamp);
		$tomorrow = date("d-m-Y", mktime(0,0,0,date("m"),date("d")+1,date("Y")));	   
	   
		$this->set('today', $today);
		$this->set('tomorrow', $tomorrow);	
		
	   	//Set the ASAP time every time this page loads
		$this->setASAP();
	   if ((strtotime($_SESSION['ordertypeat']) <= strtotime($_SESSION['ordertypeatasap'])) || (isset($_POST['ordertypeat']) && strtotime($_POST['ordertypeat']) <= strtotime($_SESSION['ordertypeatasap']))){
				$_SESSION['ordertypeat'] = $_SESSION['ordertypeatasap'];
				$_SESSION['ordertypeatisasap'] = 'Y';
		} else {
			$_SESSION['ordertypeatisasap'] = 'N';
		}	  		  
				
		   
		//Get time options for dropdown in view
		//$this->set('gettime',$this->Restaurant->getTime($_SESSION['timezone'], $orderfor));

		//$this->set('gettodaytime',$this->Restaurant->getTime($_SESSION['timezone'], 'today'));
	    //$this->set('gettomorrowtime',$this->Restaurant->getTime($_SESSION['timezone'], 'tomorrow'));
	   
	    $this->set('getcurrentfuturedays',$this->Restaurant->getCurrentFutureDays($_SESSION['timezone'], 'today', 30));	   
	   
		$this->set('tip',$this->Restaurant->getTipAmounts());
		
		$temporder = $this->TempOrder->getTempOrder($temporderid);
		
		$this->loadModel('Restaurant');
		$restaurant = $this->Restaurant->getRestaurantInfo($temporder['orderdetails'][0]['TempOrder']['restaurant_id']);
		$this->set('restaurantinfo', $restaurant);
		
		$this->set('gettodaytime',$this->Restaurant->getTime($_SESSION['timezone'], 'today', $_SESSION['delivery_estimate_max']));
		
	    $this->set('gettomorrowtime',$this->Restaurant->getTime($_SESSION['timezone'], 'tomorrow', $_SESSION['delivery_estimate_max']));

		if(isset($user)) {
		 	$userhasbeentorestaurant = $this->TempOrder->find('list',array(
		   	'conditions'=>array('TempOrder.restaurant_id'=>$temporder['orderdetails'][0]['TempOrder']['restaurant_id'],'TempOrder.user_id'=>$user['User']['id']),
		   	'contain' =>array(
		   		'City'=>array(
		   			'Timezone'
		   		)
		   	)
		   	));
	   	} else {
	   		$userhasbeentorestaurant = false;
	   	}
	   	
	   if(isset($userhasbeentorestaurant) && isset($restaurant['Restaurant']['deals']) && !$userhasbeentorestaurant) {
		   	
	   		$_SESSION['deals'] = $restaurant['Restaurant']['deals'];
	   	}
	   else {
		   	$_SESSION['deals'] = null;	   	
	   }
		
		$tempordertotals = $temporder['tempordertotals'];
		$orderdetails = $temporder['orderdetails'];
		$this->set('user', $user);
		
		$this->set('subtotal', money_format('%i', $tempordertotals['subtotal']));
		$this->set('total', money_format('%i', $tempordertotals['total']));
		$this->set('salestax', money_format('%i', $tempordertotals['salestax']));
		$this->set('discount', money_format('%i', $tempordertotals['discount']));
		$this->set('orderdetails', $orderdetails);
		$this->set('orderid', $temporderid);

		
}


public function additem() {
	if($this->RequestHandler->isAjax()) {
		//Get values from posts
		if(isset($_POST['temporderid']))
			$temporderid = $_POST['temporderid'];
			
		if(isset($_POST['itemid']))
			$itemid = $_POST['itemid'];	
			
		if(isset($_POST['quantity']))
			$quantity = $_POST['quantity'];	
			
		if(isset($_POST['specialinstructions']))
			$specialinstructions = $_POST['specialinstructions'];									
			
		$this->loadModel('TempItem');
		$data = array();
		$data['TempItem']=array(
			'temp_order_id'=>$temporderid,
			'item_id'=>$itemid,
			'quantity'=>$quantity,
			'special_instructions'=>$specialinstructions
		);
			  
		$this->TempItem->create();
		
		echo '<pre>';var_dump($data);echo '</pre>';
		if($this->TempItem->save($data)) {
			
		} else {
			$this->Session->setFlash(__('The item could not be saved. Please, try again.','flash_bad'));
		}
		
		
		//Update Order Information 
		$this->loadModel('TempOrder');
		$orderdata = array();
		$orderdata['TempItem']=array(
			'id'=>$temporderid,
			'sub_total'=>'1.00'
		);
		
		if($this->TempOrder->save($this->request->$orderdata)) {
			
		} else {
			$this->Session->setFlash(__('The item could not be saved. Please, try again.','flash_bad'));
		}
		
	}
}

	public function add() {

	  $this->Restaurant->set( $this->request->data );
		if ($this->request->is('post') && $this->Restaurant->validates()) {
		  $data = $this->request->data;
		  
      //Logo File Info in $data['Restaurant']['logo_file']
      if(isset($data['Restaurant']['logo_file']) && $data['Restaurant']['logo_file']['tmp_name'] != ""):
        
        //Upload Restaurant Logo
        $results = $this->uploadphoto($data['Restaurant']['logo_file']);

        //If Upload was sucess (not an error)
        if(!isset($results['error'])):
          $data['Restaurant']['logo_url'] = $results['image_path'];
          
          $this->Restaurant->create();
    			
    			$user_id = $this->Restaurant->addRestaurantUser($data);
          $data['User'] = array('User'=>array('0'=>$user_id));
          
          if ($this->Restaurant->saveAll($data,array('validate' => true))) {
    				$this->Session->setFlash(__('General Information Saved'),'flash_good');
    				$this->redirect(array('action' => 'add_2',$this->Restaurant->id));
    			} else {
    				$this->Session->setFlash(__('The restaurant could not be saved. Please, try again.'),'flash_bad');
    			}

        else:
    		    $this->Session->setFlash(__($results['error']),'flash_bad');
    		endif; // uploadphoto return false
      else: //$data['Restaurant']['logo_file'] no set
        $this->Session->setFlash(__('Please upload a restaurant logo under 32MB.'),'flash_bad');
      endif;
		}
		$cities = $this->Restaurant->City->find('list');
		$billingStates = $this->Restaurant->BillingState->find('list');
		$cuisines = $this->Restaurant->Cuisine->find('list');
		$this->set(compact('cities', 'billingStates', 'cuisines'));
	}

 
	public function add_2($restaurant_id = null) {
		if (($this->request->is('post') || $this->request->is('put')) && $this->Restaurant->validates()) {
			if ($this->Restaurant->save($this->request->data)) {
				$this->Session->setFlash(__('Billing Information Saved'),'flash_good');
				$this->redirect(array('action' => 'add_3',$restaurant_id));
			} else {
				$this->Session->setFlash(__('Billing Information could not be saved. Please, try again.'));
			}
		}
		$billingStates = $this->Restaurant->BillingState->find('list');
		$this->set(compact('billingStates','restaurant_id'));
	}

	public function add_3($restaurant_id = null) {
  	$options = array(
			   'conditions' => array(
			     'Restaurant.' . $this->Restaurant->primaryKey => $restaurant_id),
			     'contain'=>array(
			       'RestaurantOrderType'=>array(
			         'OrderType',
			         'Menu'=>array(
			           'MenuHour'
			         )
			       ),
			       'RestaurantContact'
			     ));
			$this->request->data = $this->Restaurant->find('first', $options);
			$this->set('restaurant', $this->request->data);
			$this->set('restaurant_id',$restaurant_id);
	}
	

	public function add_4($restaurant_id = null) {
    if (($this->request->is('post') || $this->request->is('put')) && $this->Restaurant->validates()) {
			if ($this->Restaurant->save($this->request->data)) {

				$this->Session->setFlash(__('Technical Information Saved'),'flash_good');
				$this->redirect(array('action' => 'add_5',$restaurant_id));
			} else {
				$this->Session->setFlash(__('Technical Information could not be saved. Please, try again.','flash_bad'));
			}
		}
    $this->set('restaurant_id',$restaurant_id);
	}
	

	public function add_5($restaurant_id = null,$order_type_id = null) {
	  
  	if (($this->request->is('post') || $this->request->is('put')) && $this->Restaurant->validates()) {
			if ($this->Restaurant->save($this->request->data)) {
				$this->Session->setFlash(__('Order Types Saved'),'flash_good');
				$this->redirect(array('action' => 'add_6',$restaurant_id));
			} else {
				$this->Session->setFlash(__('Order Types could not be saved. Please, try again.','flash_bad'));
			}
		} else {
  		$options = array(
			   'conditions' => array(
			     'Restaurant.' . $this->Restaurant->primaryKey => $restaurant_id),
			     'contain'=>array(
			       'RestaurantOrderType'=>array(
			         'OrderType',
			         'Menu'=>array(
			           'MenuHour'
			         )
			       ),
			       'RestaurantContact'
			     ));
			$this->request->data = $this->Restaurant->find('first', $options);
		}
		
  	$this->set('restaurant_id',$restaurant_id);
	}
	
	/**
 * add method
 *
 * @return void
 */
	public function add_6($restaurant_id = null) {
	  $options = array(
			   'conditions' => array(
			     'Restaurant.' . $this->Restaurant->primaryKey => $restaurant_id),
			     'contain'=>array(
			       'RestaurantOrderType'=>array(
			         'OrderType',
			         'Menu'=>array(
			           'MenuHour'
			         )
			       ),
			       'RestaurantContact'
			     ));
			$this->request->data = $this->Restaurant->find('first', $options);
			$this->set('restaurant', $this->request->data);
		  $this->set('cities',  $this->Restaurant->City->find('list'));

  	  $this->set('restaurant_id',$restaurant_id);
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
		$this->Restaurant->id = $id;
		if (!$this->Restaurant->exists()) {
			throw new NotFoundException(__('Invalid restaurant'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Restaurant->delete()) {
			$this->Session->setFlash(__('Restaurant deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Restaurant was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	/**
 * deactivate method
 *
 */
	public function deactivate($id = null) {
		$this->Restaurant->id = $id;
		if (!$this->Restaurant->exists()) {
			throw new NotFoundException(__('Invalid restaurant'));
		}
		$this->request->onlyAllow('post', 'deactivate');
		if($this->Restaurant->saveField('active',0)){
  		$this->Session->setFlash(__('Restaurant deactivated'),'flash_good');
			$this->redirect(array('action' => 'bycity'));
		}
		$this->Session->setFlash(__('Restaurant was not deactivate'),'flash_bad');
		$this->redirect(array('action' => 'bycity'));
	}
	
	/**
 * activate method
 *
 */
	public function activate($id = null) {
		$this->Restaurant->id = $id;
		if (!$this->Restaurant->exists()) {
			throw new NotFoundException(__('Invalid restaurant'));
		}
		$this->request->onlyAllow('post', 'activate');
		if($this->Restaurant->saveField('active',1)){
  		$this->Session->setFlash(__('Restaurant activated'),'flash_good');
			$this->redirect(array('action' => 'bycity'));
		}
		$this->Session->setFlash(__('Restaurant was not activate'),'flash_bad');
		$this->redirect(array('action' => 'bycity'));
	}
		
	public function validateorder() {
	
		//Validate username is distinct
		if(isset($_POST['email'])) {
			$emailValue = $_POST['email'];
			
			if($emailValue != null){
				$user = $this->validateusername($emailValue);
			}	
		}
		
		//Validate order has not been processed
		if(isset($_POST['orderid'])) {
			$this->loadModel('Order');
			$orderid = $_POST['orderid'];
			$order = $this->Order->getOrder($orderid);
		}
		
		if(isset($_POST['orderid'])) {
			$this->loadModel('TempOrder');
			$temporderid = $_POST['orderid'];
			$temporder = $this->TempOrder->getTempOrder($temporderid);
		}
		
		//Validate credit card without charging
		if(isset($_POST['ccnum']))
			$isvalidcc = $this->AuthorizeNet->validateCreditcard_number($_POST['ccnum']);
		if(isset($_POST['month']) && isset($_POST['year']))
			$isvalidexpiration = $this->AuthorizeNet->validateCreditCardExpirationDate($_POST['month'], $_POST['year']);
		if(isset($_POST['ccnum']) && isset($_POST['cvv']))
			$isvalidcvv = $this->AuthorizeNet->validateCVV($_POST['ccnum'], $_POST['cvv']);				
		
		//Used for testing
		$isvalidcc = true;
		
		if(isset($user) && count($user) > 0)
		   	$this->set('user', 'exists');
		else
		   $this->set('user', 'does_not_exits');		

		if($order)  
		   	$this->set('order', 'processed');
		else
		   $this->set('order', 'ready');	
		
		if($_POST['checkcc']== false  || ($isvalidcc && $_POST['checkcc']== true))  
		   	$this->set('validcc', 'yes');
		else
		   $this->set('validcc', 'no');	
		
		if($_POST['checkcc']== false  || ($isvalidexpiration && $_POST['checkcc']== true))  
		   	$this->set('validexp', 'yes');
		else
		   $this->set('validexp', 'no');	
		   
		if($_POST['checkcc']== false  || ($isvalidcvv && $_POST['checkcc']== true))  
		   	$this->set('validcvv', 'yes');
		else
		   $this->set('validcvv', 'no');
		   
		if($temporder)	
		   	$this->set('temporder', 'items');
		else
		   $this->set('temporder', 'noitems');				   			   		   		   		
		
	}
	
	public function validatecashorder() {
	
		//Validate username is distinct
		if(isset($_POST['email'])) {
			$emailValue = $_POST['email'];
			
			if($emailValue != null){
				$user = $this->validateusername($emailValue);
			}	
		}
		
		//Validate order has not been processed
		if(isset($_POST['orderid'])) {
			$this->loadModel('Order');
			$orderid = $_POST['orderid'];
			$order = $this->Order->getOrder($orderid);
		}
		
		if(isset($_POST['orderid'])) {
			$this->loadModel('TempOrder');
			$temporderid = $_POST['orderid'];
			$temporder = $this->TempOrder->getTempOrder($temporderid);
		}
		
		
		if(isset($user) && count($user) > 0)
		   	$this->set('user', 'exists');
		else
		   $this->set('user', 'does_not_exits');		

		if($order)  
		   	$this->set('order', 'processed');
		else
		   $this->set('order', 'ready');	
					   			   		   		   		
		
	}	
	
	public function orderhasitems() {
	
		//Validate order has not been processed
		if(isset($_POST['orderid'])) {
			$this->loadModel('TempOrder');
			$orderid = $_POST['orderid'];
			$temporder = $this->TempOrder->getTempOrder($orderid);
		}

		if(isset($_POST['deliverymin'])) { 
			$deliveryminimum = $_POST['deliverymin'];
		}

		if(isset($_POST['ordertype'])) { 
			$ordertype = $_POST['ordertype'];
		}		
		
		
		$isValid = true;
		if(strtoupper($ordertype) == 'DELIVERY' && $temporder['tempordertotals']['subtotal'] <= 0) {
			$isValid = false;
			$errormsg = 'noitems';
		}
		else if(strtoupper($ordertype) == 'DELIVERY' && $temporder['tempordertotals']['subtotal'] < $deliveryminimum) {
			$isValid = false;
			$errormsg = 'deliveryminimum';	
		} else if($temporder['tempordertotals']['subtotal'] == 0) {
			$isValid = false;
			$errormsg = 'noitems';
		}
		
		if($temporder && !empty($temporder['orderdetails'][0]['TempItem']) && $isValid)	
		   	$this->set('temporder', 'items');
		else
		   $this->set('temporder', $errormsg);				   			   		   		   		
		
	}
	
	public function updateTipAmount() {
		if($this->RequestHandler->isAjax()) {
			if(isset($_POST['tipamnt'])) {
				$tip = $_POST['tipamnt'];
			} else {
				$tip = 0;
			}
			if(isset($_POST['totalamnt'])) {
				$total = $_POST['totalamnt'];
			} else {
				$total = 0;
			}		
			
			
			//Update Order Information 
			$this->loadModel('TempOrder');
			$orderdata = array();
			$orderdata['TempOrder']=array(
				'id'=> $_SESSION['orderid'],
				'total'=>$total,
				'tip'=>$tip
			);
			
			if($this->TempOrder->save($orderdata)) {

			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.','flash_bad'));
			}
			
		}
	}
	
	public function orderconfirmation($orderid = null, $isnew = null) {
		$this->loadModel('Order');
		$this->loadModel('Restaurant');
		$order = $this->Order->getFinalOrder($orderid);
		$restaurant = $this->Restaurant->getRestaurantInfo($order[0]['Order']['restaurant_id']);
		
		$this->set('restaurant', $restaurant);
		$this->set('order', $order);
		
		if($isnew == 1)
			$this->set('isnew', 'true');
	
	}
	
	public function getDeliveryOrdersHtml($orderinfo = null) {
			/*$orderinfo = array();
			$orderinfo['restaurantname'] = 'Breadstix';
			$orderinfo['ordernumber'] = '99';
			$orderinfo['restaurantphone'] = '2223334444';
			$orderinfo['orderdate'] = time();
			$orderinfo['deliverytime'] = '15 - 30 minutes';
			$orderinfo['delivertoname'] = 'Christopher Schwing';
			$orderinfo['delivertoaddress'] = '123 Main';
			$orderinfo['delivertocitystate'] = 'Baton Rouge, LA';
			$orderinfo['delivertoapt'] = 'C';
			$orderinfo['delivertophone'] = '2225556666';
			$orderinfo['deliverinstructions'] = 'deliver to back door please';
			$orderinfo['orderdetails'] = '';
			$orderinfo['producttotal'] = '20.00';
			$orderinfo['salestax'] = '2.00';
			$orderinfo['tipamount'] = '1.00';
			$orderinfo['ordertotal'] = '23.00';
			$orderinfo['orderplacedby'] = 'Christopher Schwing';
			$orderinfo['paymentinfo'] = 'American Express Last 4: 1044';
			$orderinfo['ordertype'] = 	'Pickup';
			*/
			$html = '';
			$html .= '<div><img src="http://imealsdev.com/img/logo.png"/></div>';
			$html .= '<table rules="all" style="border: 0px solid #FFF; width: 100%;">';
				$html .= '<tr>';
					$html .= '<td style="font-size: 16px; width: 50%; padding: 10px 10px 10px 0px;">';
						$html .= strtoupper($orderinfo['restaurantname']);
					$html .= '</td>';
					$html .= '<td style="font-size: 16px; width: 50%;">';
						$html .= 'Order #: <span style="color: red;">'.$orderinfo['ordernumber'].'</spa>';
					$html .= '</td>';
				$html .= '</tr>';
				$html .= '<tr>';
					$html .= '<td style=" padding: 10px 10px 10px 0px;">';
						$html .= 'Phone: '.$orderinfo['restaurantphone'];
					$html .= '</td>';
					$html .= '<td>';
						$html .= 'Ordered:'.date('l, F jS, Y g:i A', strtotime($orderinfo['orderdate']));
					$html .= '</td>';
				$html .= '</tr>';
				$html .= '<tr>';
					$html .= '<td colspan="2" style="background-color: rgba(248, 248, 130, 0.4); font-size: 20px; text-align: center;">';
						$html .= 'Estimated Delivery Time: <span style="color: red;">'.$orderinfo['deliverytime'].'</span>';
					$html .= '</td>';
				$html .= '</tr>';
			$html .= '</table>';
			$html .= '<table rules="all" style="border: 0px solid #FFF; width: 100%; border-top: 1px solid #CCC; width: 100%;">';
			$html .= '<tr style="font-weight: bold;">';
				$html .= '<td style="width: 50%; padding-top: 5px;">';
					$html .= 'Deliver To:';
				$html .= '</td>';
				$html .= '<td rowspan="6" style="width: 50%; padding-top: 5px; border-bottom: 3px solid #CCC;" valign="top">';
					$html .= 'Delivery Instructions:<br>';
					$html .= $orderinfo['deliverinstructions'];
				$html .= '</td>';
			$html .= '</tr>';
			$html .= '<tr>';
				$html .= '<td>'.$orderinfo['delivertoname'].'</td>';
			$html .= '</tr>';
			$html .= '<tr>';
				$html .= '<td>'.$orderinfo['delivertoaddress'].'</td>';
			$html .= '</tr>';
			$html .= '<tr>';
				$html .= '<td>City, State: '.$orderinfo['delivertocitystate'].'</td>';
			$html .= '</tr>';
			$html .= '<tr>';
				$html .= '<td>Apt/Flat/Suite/Floor #: '.$orderinfo['delivertoapt'].'</td>';
			$html .= '</tr>';
			$html .= '<tr style="border-bottom: 3px solid #CCC;">';
				$html .= '<td style="font-weight: bold;">'.$orderinfo['delivertophone'].'</td>';
			$html .= '</tr>';
		$html .= '</table>';
		
		$html .= '<table cellpadding="3" style="border-collapse:collapse; width: 100%;">';
		
		foreach($orderinfo['orderdetails']['TempItem'] as $orderitem):
		$html .= '<tr>';
			$html .= '<td style="width: 2%; border-bottom: 1px solid #CCC; vertical-align: top;"><span style="color: red; font-size: 20px;">'.$orderitem['quantity'].'</span></td>';
			$html .= '<td style="width: 65%; border-bottom: 1px solid #CCC;">';
				$html .= '<span style="font-weight: bold;">'.$orderitem['Item']['name'].'</span><br>';
				$variationamount = 0;
				foreach($orderitem['TempVariation'] as $orderitemvariation):
					$html .= $orderitemvariation['Variation']['name'].'<br>';
					$variationamount = $variationamount + $orderitemvariation['Variation']['amount'];
				endforeach;
			$html .= '</td>';
			$html .= '<td style="width: 15%; border-bottom: 1px solid #CCC; vertical-align: top;">'.$orderitem['Item']['name'].'</td>';
			$html .= '<td style="width: 8%; border-bottom: 1px solid #CCC; vertical-align: top;">x '.$orderitem['quantity'].'</td>';
			$html .= '<td style="width: 5%; border-bottom: 1px solid #CCC; vertical-align: top;">=</td>';
			if($variationamount == 0)
				$itemtotal = money_format('%i', $orderitem['quantity']*$orderitem['Item']['price']);
			else
				$itemtotal = money_format('%i', $orderitem['quantity']*($orderitem['Item']['price'] + $variationamount));
				
			$html .= '<td style="width: 5%; border-bottom: 1px solid #CCC; vertical-align: top;">$'.$itemtotal.'</td>';
		$html .= '</tr>';
		endforeach;		
		
		$html .= '<tr>';
			$html .= '<td></td>';
			$html .= '<td></td>';
			$html .= '<td colspan="2">Product Total:</td>';
			$html .= '<td>=</td>';
			$html .= '<td>$'.$orderinfo['producttotal'].'</td>';
		$html .= '</tr>';
		$html .= '<tr>';
			$html .= '<td></td>';
			$html .= '<td></td>';
			$html .= '<td colspan="2">Sales Tax:</td>';
			$html .= '<td>=</td>';
			$salestax = ($orderinfo['producttotal']*$orderinfo['salestax'])/100;
			$html .= '<td>$'.money_format('%i', $salestax).'</td>';
		$html .= '</tr>';
		$html .= '<tr>';
			$html .= '<td></td>';
			$html .= '<td></td>';
			$html .= '<td colspan="2">Tip Amount:</td>';
			$html .= '<td>=</td>';
			$html .= '<td>$'.$orderinfo['tipamount'].'</td>';
		$html .= '</tr>';		
		if($orderinfo['promo_discount'] > 0 && $orderinfo['promo_discount'] != '') {
		$html .= '<tr>';
			$html .= '<td></td>';
			$html .= '<td></td>';
			$html .= '<td colspan="2">Promotion Discount:</td>';
			$html .= '<td>=</td>';
			$html .= '<td style="color: red; ">$'.$orderinfo['promo_discount'].'</td>';
		$html .= '</tr>';
		}
		if($orderinfo['first_time_discount'] > 0 && $orderinfo['first_time_discount'] != '') {
		$html .= '<tr>';
			$html .= '<td></td>';
			$html .= '<td></td>';
			$html .= '<td colspan="2">First Time Discount:</td>';
			$html .= '<td>=</td>';
			$html .= '<td style="color: red; ">$'.$orderinfo['first_time_discount'].'</td>';
		$html .= '</tr>';	
		}	
		$html .= '<tr>';
			$html .= '<td></td>';
			$html .= '<td></td>';
			$html .= '<td colspan="2">Delivery Charge:</td>';
			$html .= '<td>=</td>';
			$html .= '<td>$'.$orderinfo['delivery_charge'].'</td>';
		$html .= '</tr>';					
		$html .= '<tr>';
			$html .= '<td></td>';
			$html .= '<td></td>';
			$html .= '<td colspan="2">Grand Total</td>';
			$html .= '<td>=</td>';
			$html .= '<td style="font-weight: bold;">$'.$orderinfo['ordertotal'].'</td>';
		$html .= '</tr>';
	$html .= '</table>';
	$html .= '<table style="border-collapse:collapse; width: 100%;" cellpadding="3">';
		$html .= '<tr>';
			$html .= '<td style="font-weight: bold; width: 70%; border-top: 3px solid #CCC;">Order Placed By:</td>';
			$html .= '<td style="font-weight: bold; width: 25%; border-top: 3px solid #CCC;">Amount</td>';
		$html .= '</tr>';
		$html .= '<tr>';
			$html .= '<td style="border-bottom: 1px solid #CCC;">'.$orderinfo['orderplacedby'].'</td>';
			$html .= '<td style="border-bottom: 1px solid #CCC;">$'.$orderinfo['ordertotal'].'</td>';
		$html .= '</tr>';
	$html .= '</table>';
	$html .= '<table style="border-collapse:collapse;" cellpadding="3">';
		$html .= '<tr>';
			$html .= '<td style="font-weight: bold; width: 70%;">Payment Information</td>';
			$html .= '<td style="font-weight: bold; width: 15%;">Amount</td>';
			$html .= '<td style="font-weight: bold; width: 10%;">Order Type</td>';
		$html .= '</tr>';
		$html .= '<tr>';
			$html .= '<td style="border-bottom: 1px solid #CCC;">'.$orderinfo['paymentinfo'].'</td>';
			$html .= '<td style="border-bottom: 1px solid #CCC;">$'.$orderinfo['ordertotal'].'</td>';
			$html .= '<td style="border-bottom: 1px solid #CCC;">'.$orderinfo['ordertype'].'</td>';
		$html .= '</tr>';
	$html .= '</table>';
	$html .= '<div style="font-weight: bold; width: 100%;">For questions contact support@imeals.com</div>';
	
	return $html;
	
}
	
public function getPickupOrdersHtml($orderinfo = null) {
			/*$orderinfo = array();
			$orderinfo['restaurantname'] = 'Breadstix';
			$orderinfo['ordernumber'] = '99';
			$orderinfo['restaurantphone'] = '2223334444';
			$orderinfo['orderdate'] = time();
			$orderinfo['deliverytime'] = '15 - 30 minutes';
			$orderinfo['delivertoname'] = 'Christopher Schwing';
			$orderinfo['delivertoaddress'] = '123 Main';
			$orderinfo['delivertocitystate'] = 'Baton Rouge, LA';
			$orderinfo['delivertoapt'] = 'C';
			$orderinfo['delivertophone'] = '2225556666';
			$orderinfo['deliverinstructions'] = 'deliver to back door please';
			$orderinfo['orderdetails'] = '';
			$orderinfo['producttotal'] = '20.00';
			$orderinfo['salestax'] = '2.00';
			$orderinfo['tipamount'] = '1.00';
			$orderinfo['ordertotal'] = '23.00';
			$orderinfo['orderplacedby'] = 'Christopher Schwing';
			$orderinfo['paymentinfo'] = 'American Express Last 4: 1044';
			$orderinfo['ordertype'] = 	'Pickup';
			*/
			$html = '';
			$html .= '<div><img src="http://imealsdev.com/img/logo.png"/></div>';
			$html .= '<table rules="all" style="border: 0px solid #FFF; width: 100%;">';
				$html .= '<tr>';
					$html .= '<td style="font-size: 16px; width: 50%; padding: 10px 10px 10px 0px;">';
						$html .= strtoupper($orderinfo['restaurantname']);
					$html .= '</td>';
					$html .= '<td style="font-size: 16px; width: 50%;">';
						$html .= 'Order #: <span style="color: red;">'.$orderinfo['ordernumber'].'</spa>';
					$html .= '</td>';
				$html .= '</tr>';
				$html .= '<tr>';
					$html .= '<td style=" padding: 10px 10px 10px 0px;">';
						$html .= 'Phone: '.$orderinfo['restaurantphone'];
					$html .= '</td>';
					$html .= '<td>';
						$html .= 'Ordered:'.date('l, F jS, Y g:i A', strtotime($orderinfo['orderdate']));
					$html .= '</td>';
				$html .= '</tr>';
				$html .= '<tr>';
					$html .= '<td colspan="2" style="background-color: rgba(248, 248, 130, 0.4); font-size: 20px; text-align: center;">';
						$html .= 'Estimated Pickup Time: <span style="color: red;">'.$orderinfo['deliverytime'].'</span>';
					$html .= '</td>';
				$html .= '</tr>';
			$html .= '</table>';
			$html .= '<table rules="all" style="border: 0px solid #FFF; width: 100%; border-top: 1px solid #CCC; width: 100%;">';
			$html .= '<tr style="font-weight: bold;">';
				$html .= '<td style="width: 50%; padding-top: 5px;">';
					$html .= 'Pickup:';
				$html .= '</td>';
				$html .= '<td rowspan="6" style="width: 50%; padding-top: 5px; border-bottom: 3px solid #CCC;" valign="top">';
					$html .= 'Pickup Instructions:<br>';
					$html .= $orderinfo['deliverinstructions'];
				$html .= '</td>';
			$html .= '</tr>';
			$html .= '<tr>';
				$html .= '<td>'.$orderinfo['delivertoname'].'</td>';
			$html .= '</tr>';
			$html .= '<tr>';
				$html .= '<td>'.$orderinfo['delivertoaddress'].'</td>';
			$html .= '</tr>';
			$html .= '<tr>';
				$html .= '<td>City, State: '.$orderinfo['delivertocitystate'].'</td>';
			$html .= '</tr>';
			$html .= '<tr>';
				$html .= '<td>Apt/Flat/Suite/Floor #: '.$orderinfo['delivertoapt'].'</td>';
			$html .= '</tr>';
			$html .= '<tr style="border-bottom: 3px solid #CCC;">';
				$html .= '<td style="font-weight: bold;">'.$orderinfo['delivertophone'].'</td>';
			$html .= '</tr>';
		$html .= '</table>';
		
		$html .= '<table cellpadding="3" style="border-collapse:collapse; width: 100%;">';
		
		foreach($orderinfo['orderdetails']['TempItem'] as $orderitem):
		$html .= '<tr>';
			$html .= '<td style="width: 2%; border-bottom: 1px solid #CCC; vertical-align: top;"><span style="color: red; font-size: 20px;">'.$orderitem['quantity'].'</span></td>';
			$html .= '<td style="width: 65%; border-bottom: 1px solid #CCC;">';
				$html .= '<span style="font-weight: bold;">'.$orderitem['Item']['name'].'</span><br>';
				$variationamount = 0;
				foreach($orderitem['TempVariation'] as $orderitemvariation):
					$html .= $orderitemvariation['Variation']['name'].'<br>';
					$variationamount = $variationamount + $orderitemvariation['Variation']['amount'];
				endforeach;
			$html .= '</td>';
			$html .= '<td style="width: 15%; border-bottom: 1px solid #CCC; vertical-align: top;">'.$orderitem['Item']['name'].'</td>';
			$html .= '<td style="width: 8%; border-bottom: 1px solid #CCC; vertical-align: top;">x '.$orderitem['quantity'].'</td>';
			$html .= '<td style="width: 5%; border-bottom: 1px solid #CCC; vertical-align: top;">=</td>';
			if($variationamount == 0)
				$itemtotal = money_format('%i', $orderitem['quantity']*$orderitem['Item']['price']);
			else
				$itemtotal = money_format('%i', $orderitem['quantity']*($orderitem['Item']['price'] + $variationamount));
				
			$html .= '<td style="width: 5%; border-bottom: 1px solid #CCC; vertical-align: top;">$'.$itemtotal.'</td>';
		$html .= '</tr>';
		endforeach;		
		
		$html .= '<tr>';
			$html .= '<td></td>';
			$html .= '<td></td>';
			$html .= '<td colspan="2">Product Total:</td>';
			$html .= '<td>=</td>';
			$html .= '<td>$'.$orderinfo['producttotal'].'</td>';
		$html .= '</tr>';
		$html .= '<tr>';
			$html .= '<td></td>';
			$html .= '<td></td>';
			$html .= '<td colspan="2">Sales Tax:</td>';
			$html .= '<td>=</td>';
			$salestax = ($orderinfo['producttotal']*$orderinfo['salestax'])/100;
			$html .= '<td>$'.money_format('%i', $salestax).'</td>';
		$html .= '</tr>';
		$html .= '<tr>';
			$html .= '<td></td>';
			$html .= '<td></td>';
			$html .= '<td colspan="2">Tip Amount:</td>';
			$html .= '<td>=</td>';
			$html .= '<td>$'.$orderinfo['tipamount'].'</td>';
		$html .= '</tr>';	
		if($orderinfo['promo_discount'] > 0 && $orderinfo['promo_discount'] != '') {
		$html .= '<tr>';
			$html .= '<td></td>';
			$html .= '<td></td>';
			$html .= '<td colspan="2">Promotion Discount:</td>';
			$html .= '<td>=</td>';
			$html .= '<td style="color: red; ">$'.$orderinfo['promo_discount'].'</td>';
		$html .= '</tr>';
		}
		if($orderinfo['first_time_discount'] > 0 && $orderinfo['first_time_discount'] != '') {
		$html .= '<tr>';
			$html .= '<td></td>';
			$html .= '<td></td>';
			$html .= '<td colspan="2">First Time Discount:</td>';
			$html .= '<td>=</td>';
			$html .= '<td style="color: red; ">$'.$orderinfo['first_time_discount'].'</td>';
		$html .= '</tr>';	
		}				
		$html .= '<tr>';
			$html .= '<td></td>';
			$html .= '<td></td>';
			$html .= '<td colspan="2">Grand Total</td>';
			$html .= '<td>=</td>';
			$html .= '<td style="font-weight: bold;">$'.$orderinfo['ordertotal'].'</td>';
		$html .= '</tr>';
	$html .= '</table>';
	$html .= '<table style="border-collapse:collapse; width: 100%;" cellpadding="3">';
		$html .= '<tr>';
			$html .= '<td style="font-weight: bold; width: 70%; border-top: 3px solid #CCC;">Order Placed By:</td>';
			$html .= '<td style="font-weight: bold; width: 25%; border-top: 3px solid #CCC;">Amount</td>';
		$html .= '</tr>';
		$html .= '<tr>';
			$html .= '<td style="border-bottom: 1px solid #CCC;">'.$orderinfo['orderplacedby'].'</td>';
			$html .= '<td style="border-bottom: 1px solid #CCC;">$'.$orderinfo['ordertotal'].'</td>';
		$html .= '</tr>';
	$html .= '</table>';
	$html .= '<table style="border-collapse:collapse;" cellpadding="3">';
		$html .= '<tr>';
			$html .= '<td style="font-weight: bold; width: 70%;">Payment Information</td>';
			$html .= '<td style="font-weight: bold; width: 15%;">Amount</td>';
			$html .= '<td style="font-weight: bold; width: 10%;">Order Type</td>';
		$html .= '</tr>';
		$html .= '<tr>';
			$html .= '<td style="border-bottom: 1px solid #CCC;">'.$orderinfo['paymentinfo'].'</td>';
			$html .= '<td style="border-bottom: 1px solid #CCC;">$'.$orderinfo['ordertotal'].'</td>';
			$html .= '<td style="border-bottom: 1px solid #CCC;">'.$orderinfo['ordertype'].'</td>';
		$html .= '</tr>';
	$html .= '</table>';
	$html .= '<div style="font-weight: bold; width: 100%;">For questions contact support@imeals.com</div>';
	
	return $html;
	
	}	
	
	public function sendFax($html) {
		//3372565326
		
		
        $posturl = 'https://api.phaxio.com/v1/send';
        $post['to'] = '13372565326';  
        $post['string_data'] =  $html;
        $post['string_data_type'] = 'html';
        $post['api_key'] = '4e06f1598598a6f8252827089947f93b7f1090a4';
        $post['api_secret'] = '81b68b4968c49d721a5eff0623e89961fed91d90'; 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $posturl);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		$response = curl_exec($ch);
		if($response != null)
			return true;
		
	}
	
	public function sendPhoneCall($orderid = null) {
		// Get the PHP helper library from twilio.com/docs/php/install
		//require_once('/path/to/twilio-php/Services/Twilio.php'); // Loads the library
		

		$sid = "AC2723d6bfc7e5242865aba259ced47e8a"; 
		$token = "c72aaae9406e987b7e9f695f286c029b"; 
		$client = new $this->Twilio($sid, $token);
		$xmltext = '<?xml version="1.0" encoding="utf-8"?><Response><Say voice="alice">I like big butts and I cannot lie!</Say></Response>';
		$xml = Xml::build($xmltext);

		$call = $client->account->calls->create("+19854927387", "+12253230545", "http://imealsdev.com/restaurants/buildPhoneCall.xml?orderid=".$orderid	, array());
		echo $call->sid;
		//$this->loadModel('Order');
		//$order = $this->Order->getOrderDetails($orderid);		

       //echo $this->Twilio->getVersion();//client =  $this->Services_Twilio('AC123', '456bef', null, null, 3);
	}
	
	public function buildPhoneCall() {
		$this->layout = 'twilio';
		$this->loadModel('Order');
		$this->loadModel('TempOrder');
						
						$orderid = $_GET['orderid'];
						//$order = $this->Order->find('first',array('conditions'=>array('id'=>80)));
						$order = $this->Order->getOrderDetails($orderid);
						$userid = $order[0]['Order']['user_id'];
						$this->loadModel('User');
						$user = $this->User->find('first',array('conditions'=>array('User.id'=>$userid)));						

						/*$temporder = $this->TempOrder->getOrderDetails('224');
						$orderinfo = array();
						$orderinfo['restaurantname'] = 'MELLOW MUSHROOM';
						$orderinfo['ordernumber'] = '61';
						$orderinfo['restaurantphone'] = '2147483647';
						$orderinfo['orderdate'] = $order['Order']['created'];
						$orderinfo['deliverytime'] = $order['Order']['order_at'];
						$orderinfo['delivertoname'] = 'John Baker';
						$orderinfo['delivertoaddress'] = $order['Order']['address'];
						$orderinfo['delivertocitystate'] = 'Baton Rouge LA';
						$orderinfo['delivertoapt'] = '';
						$orderinfo['delivertophone'] = '2147483647';
						$orderinfo['deliverinstructions'] = $order['Order']['special_instructions'];
						$orderinfo['orderdetails'] = $temporder[0];
						$orderinfo['producttotal'] = $order['Order']['sub_total'];
						$orderinfo['salestax'] = $order['Order']['tax'];
						$orderinfo['tipamount'] = $order['Order']['tip'];
						$orderinfo['first_time_discount'] = $order['Order']['first_time_discount'];
						$orderinfo['promo_discount'] = $order['Order']['promo_discount'];	
						$orderinfo['delivery_charge'] = $order['Order']['delivery_charge'];					
						$orderinfo['ordertotal'] = $order['Order']['total'];
						$orderinfo['orderplacedby'] = 'John Baker';
						$orderinfo['paymentinfo'] = 'VISA Last 4:0027';
						$orderinfo['ordertype'] = 	'PICKUP';*/
						
						$orderinfo = array();
						$orderinfo['ordernumber'] = $order[0]['Order']['id'];
						$orderinfo['orderdate'] = $order[0]['Order']['created'];
						$orderinfo['deliverytime'] = $order[0]['Order']['order_at'];
						$orderinfo['delivertoname'] = $user['User']['first_name'].' '.$user['User']['last_name'];
						$orderinfo['delivertoaddress'] = $order[0]['Order']['address'];
						//$orderinfo['delivertocitystate'] = $_SESSION['cityname'].','.$_SESSION['state'];
						$orderinfo['delivertoapt'] = $order[0]['Order']['appt'];
						$orderinfo['delivertophone'] = $user['User']['phone'];
						$orderinfo['deliverinstructions'] = $order[0]['Order']['special_instructions'];
						$orderinfo['orderdetails'] = $order[0]["OrderItem"];
						$orderinfo['producttotal'] = $order[0]['Order']['sub_total'];
						$orderinfo['salestax'] = $order[0]['Order']['tax'];
						$orderinfo['tipamount'] = $order[0]['Order']['tip'];
						$orderinfo['first_time_discount'] = $order[0]['Order']['first_time_discount'];
						$orderinfo['promo_discount'] = $order[0]['Order']['promo_discount'];	
						$orderinfo['delivery_charge'] = $order[0]['Order']['delivery_charge'];					
						$orderinfo['ordertotal'] = $order[0]['Order']['total'];
						$orderinfo['orderplacedby'] = $user['User']['first_name'].' '.$user['User']['last_name'];
						$orderinfo['ordertype'] = 	$order[0]['Order']['type'];
						
		$xmltext = '<Response>';
		$xmltext .= '<Say>';
			$xmltext .= 'Hello, this is iMeals dot com';	
		$xmltext .= '</Say>';
		$xmltext .= '<Pause length="1"/>';
		$xmltext .= '<Say>';							
			$xmltext .= 'You have received an online order for '. $orderinfo['ordertype'];
		$xmltext .= '</Say>';
		$xmltext .= '<Pause length="2"/>';
		$xmltext .= '<Say>';						
			$xmltext .= 'Name '.$orderinfo['delivertoname'].' Phone number '. implode(' ',str_split($orderinfo['delivertophone']));
		$xmltext .= '</Say>';
		$xmltext .= '<Pause length="2"/>';
		$xmltext .= '<Say>';
			$xmltext .= 'Special Instructions, '.$orderinfo['deliverinstructions'];
		$xmltext .= '</Say>';
		$xmltext .= '<Pause length="2"/>';
		$xmltext .= '<Say>';			
			$xmltext .= 'Here is the order';
		$xmltext .= '</Say>';
		
		/* Loop through items */

		foreach($order[0]["OrderItem"] as $orderitem):
			//echo $orderitem['Item']['name'];
			$xmltext .= '<Pause length="2"/>';
			$xmltext .= '<Say>';
				$xmltext .= $orderitem['quantity'];
			$xmltext .= '</Say>';
			$xmltext .= '<Pause length=".5"/>';	
			$xmltext .= '<Say>';
				if($orderitem['Item']['name'] != null)
					$xmltext .= $orderitem['Item']['name'];
			$xmltext .= '</Say>';
			$xmltext .= '<Pause length=".5"/>';	
				/* Loop through item variation */	
				foreach($orderitem['OrderVariation'] as $ordervariation):
					$xmltext .= '<Say>';
					$xmltext .= $ordervariation['Variation']['name'];
					$xmltext .= '</Say>';
					$xmltext .= '<Pause length=".5"/>';
				endforeach;

		endforeach;
		$xmltext .= '<Say>';
			$xmltext .= 'This completes the order.';
			$xmltext .= '</Say>';
		$xmltext .= '<Pause length=".5"/>';
		$xmltext .= '<Say>';
			$xmltext .= 'The customer will arrive at'.date('h:i:s', strtotime($order[0]['Order']['order_at']));
		$xmltext .= '</Say>';
		$xmltext .= '<Pause length=".5"/>';	
		$xmltext .= '<Gather numDigits="1" action="loopPhoneCall" method="POST">';
        	$xmltext .= '<Say>Press 2 to confirm the order.  If the order is not confirmed the order will repeat.</Say>';
    	$xmltext .= '</Gather>';	
		$xmltext .= '</Response>';
		echo $xmltext;
		// Only allow XML requests
	    if (!$this->RequestHandler->isXml()) {
	        throw new MethodNotAllowedException();
	    }
		$xml = Xml::build($xmltext);
    	$this->set('xml', $xmltext);
	    // Set response as XML
	    //$this->RequestHandler->respondAs('xml');
	    //$this->RequestHandler->renderAs($this, 'xml');
    	
	}
	
	
	public function submitpayment($orderid = null) {
		//$this->redirect('orderconfirmation');
			$this->loadModel('User');
			$this->loadModel('Order');
			$this->loadModel('TempOrder');
			$this->loadModel('Restaurant');
			$order = $this->Order->getOrder($orderid);

		   	if(count($order) == 0) {	
		   		if(isset($this->request->data['PaymentInfo'])) {
					//New Payment Info
					$newpaymentinfo = $this->request->data['PaymentInfo'];
					//If they want to add a new payment profile
					$addnewpaymentprofile = $this->request->data['PaymentInfo']['saveinfo'];
				} else {
					$newpaymentinfo = false;
					$addnewpaymentprofile = false;
				}
				
				//If they have chosen existing payment profile
				if(isset($this->request->data['cc']['existing']))
					$chargeprofle = $this->request->data['cc']['existing'];
				else
					$chargeprofle = null;
					
				//1 - Create or Get iMeals User Info - $userid
				$user = $this->Auth->user();
				if(empty($user)) {
					if($this->User->validates())
						
						$this->request->data['User']['user_status'] =  1;
						$this->request->data['User']['user_name'] = $this->request->data['User']['user_email'];
						$this->request->data['Group'] = array('Group'=>array('0'=>'2'));
						
						if($addnewpaymentprofile) {
							$this->request->data['PaymentInfo']['lastfour_digits'] = substr($this->request->data['PaymentInfo']['cc_number'],strlen($this->request->data['PaymentInfo']['cc_number'])-4,4);
							$this->request->data['PaymentInfo']['card_type'] = $this->request->data['PaymentInfo']['card_type'];
						} else {
							
							unset($this->request->data['PaymentInfo']);
						}
						
						$user = $this->User->saveAssociated($this->request->data);
						//$user = $this->User->save($this->request->data['User']);
						
						if(!empty($user) && $user) {
							$user = $this->User->findById($this->User->id);
							$userid = $user['User']['id'];
							/*$user = $this->User->find('first',array(
							   	'conditions'=>array('User.id'=>$userid
							   	)
							));*/
							$isnew = 1;
						} else if(!$user) {
							
							$user = $this->User->find('first',array(
							   	'conditions'=>array('User.user_email'=>$this->request->data['User']['user_email']
							   	)
							));
							
							if(!empty($user))
								$userid = $user['User']['id'];
							else
								$userid = null;
								
							$isnew = 0;
						}
				} else {
					$userid = $user['id'];
					
					//Update user information
					$this->request->data['User']['id'] = $userid;
					$this->User->saveAssociated($this->request->data['User']);
					
					if($addnewpaymentprofile) {
						//If new payment profile update payment info
						$this->request->data['PaymentInfo']['lastfour_digits'] = substr($this->request->data['PaymentInfo']['cc_number'],strlen($this->request->data['PaymentInfo']['cc_number'])-4,4);
						$this->request->data['PaymentInfo']['card_type'] = $this->request->data['PaymentInfo']['card_type'];
						$this->request->data['PaymentInfo']['id'] = $user['PaymentInfo']['id'];
								
						$this->loadModel('PaymentInfo');
						$getpaymentinfo = $this->PaymentInfo->saveAssociated($this->request->data['PaymentInfo']);
										
						//Find User
						$user = $this->User->findById($userid);
					} else {

						$user = $this->User->findById($userid);
						//$_SESSION['PaymentInfo'] = $user['PaymentInfo'];
						
					}
					
					$paymentinfo = $user['PaymentInfo'];
					$isnew = 0;	
				}

				
				//Get Order Total
				$this->loadModel('TempOrder');
				$temporderid = $this->request->data['TempOrder'][0]['id'];
				$temporder = $this->TempOrder->getOrderDetails($temporderid);

				$ordertotal = $temporder[0]['TempOrder']['total'];
				
				//2 - Process Payment - $pymntprocessed
				$pymntprocessed = false;
				if($userid != null) {	
					if(isset($paymentinfo) && !$addnewpaymentprofile && $chargeprofle) {
						//Chosen to use current profile
						$userProfile = $user['PaymentInfo']['customer_profile_id'];
						$userPaymentProfile = $user['PaymentInfo']['customer_pymnt_profile_id'];
	
						$chargePaymentProfile = $this->AuthorizeNet->chargePaymentProfilCreditCard($ordertotal, $userProfile, $userPaymentProfile, $temporderid);
						if(isset($chargePaymentProfile))
							$pymntprocessed = true;

							
					} else {
						//Else if we have no payment or new paymentinfo then charge card
						$chargeCreditCard = $this->chargeCreditCard($user, $newpaymentinfo, $temporder);
						
						if(isset($chargeCreditCard))
							$pymntprocessed = true;
					}
				}
				
				//Get Restaurantinfo
				$restaurant = $this->Restaurant->getRestaurantInfo($temporder[0]['TempOrder']['restaurant_id']);
			
				
				//3 Send Order - $sendorder
				$sendorder = false;
				if(($userid != null && $pymntprocessed != null && $pymntprocessed) || ($userid != null && !$restaurant['Restaurant']['cc_y_n'])) {
					//Set Order At
					$this->setASAP();
				   	if ((strtotime($_SESSION['ordertypeat']) <= strtotime($_SESSION['ordertypeatasap'])) || (isset($_POST['ordertypeat']) && strtotime($_POST['ordertypeat']) <= strtotime($_SESSION['ordertypeatasap']))){
							$_SESSION['ordertypeat'] = $_SESSION['ordertypeatasap'];
							$_SESSION['ordertypeatisasap'] = 'Y';
					} else {
						$_SESSION['ordertypeatisasap'] = 'N';
					}	 
					
					//Submit Order from Temp Order to Order	
					unset($temporder[0]['TempOrder']['id']);
					foreach($temporder[0]['TempItem'] as $catkey => $catval):
					   unset($temporder[0]['TempItem'][$catkey]['id']);
					   unset($temporder[0]['TempItem'][$catkey]['temp_order_id']);
					   
					   foreach($catval['TempVariation'] as $itemkey => $itemval):
		     				unset($temporder[0]['TempItem'][$catkey]['TempVariation'][$itemkey]['id']);
		     				unset($temporder[0]['TempItem'][$catkey]['TempVariation'][$itemkey]['temp_item_id']);
						endforeach;   
					endforeach;
		
					$order['Order'] = $temporder[0]['TempOrder'];
					$order['OrderItem'] = $temporder[0]['TempItem'];
					$order['Order']['temp_order_id'] = $temporderid;
					$order['Order']['user_id'] = $userid;
					$order['Order']['special_instructions'] = $temporder[0]['TempOrder']['special_instructions'];
										
					foreach($order['OrderItem'] as $item => $catval):
						$order['OrderItem'][$item]['OrderVariation'] = $order['OrderItem'][$item]['TempVariation'];
					endforeach;
					
					/*To Do
						Validate ordered items are still valid for this menu time
						If ASAP save the date plus delivery or pickup max as order at
						order_for - Thursday
						order_at - 14:15
						delivery_charge
						
					*/
					
					if($this->Order->saveAll($order,array('deep'=>true))) {
						$order = $this->Order->findById($this->Order->id);
						//$order = $this->Order->find('first',array('conditions'=>array('id'=>60)));
						if(!$restaurant['Restaurant']['cc_y_n'])
							$pymntinfo = 'Cash';
						else if($restaurant['Restaurant']['cc_y_n'])
							$pymntinfo =  strtoupper($newpaymentinfo['card_type']).' Last 4:'.substr($newpaymentinfo['cc_number'], strlen($newpaymentinfo['cc_number'])-4, 4);

						$orderinfo = array();
						$orderinfo['restaurantname'] = $restaurant['Restaurant']['name'];
						$orderinfo['ordernumber'] = $order['Order']['id'];
						$orderinfo['restaurantphone'] = $restaurant['Restaurant']['phone'];
						$orderinfo['orderdate'] = $order['Order']['created'];
						$orderinfo['deliverytime'] = $order['Order']['order_at'];
						$orderinfo['delivertoname'] = $user['User']['first_name'].' '.$user['User']['last_name'];
						$orderinfo['delivertoaddress'] = $order['Order']['address'];
						$orderinfo['delivertocitystate'] = $_SESSION['cityname'].','.$_SESSION['state'];
						$orderinfo['delivertoapt'] = $order['Order']['appt'];
						$orderinfo['delivertophone'] = $user['User']['phone'];
						$orderinfo['deliverinstructions'] = $order['Order']['special_instructions'];
						$orderinfo['orderdetails'] = $temporder[0];
						$orderinfo['producttotal'] = $order['Order']['sub_total'];
						$orderinfo['salestax'] = $order['Order']['tax'];
						$orderinfo['tipamount'] = $order['Order']['tip'];
						$orderinfo['first_time_discount'] = $order['Order']['first_time_discount'];
						$orderinfo['promo_discount'] = $order['Order']['promo_discount'];	
						$orderinfo['delivery_charge'] = $order['Order']['delivery_charge'];					
						$orderinfo['ordertotal'] = $order['Order']['total'];
						$orderinfo['orderplacedby'] = $user['User']['first_name'].' '.$user['User']['last_name'];
						$orderinfo['paymentinfo'] = $pymntinfo;
						$orderinfo['ordertype'] = 	$_SESSION['ordertype'];
						
						
							
						if($restaurant['Restaurant']['po_email_alert']) {
							//Send email
							$email = new CakeEmail();
							if(strtolower(trim($_SESSION['ordertype'])) == 'delivery') {
								$html = $this->getDeliveryOrdersHtml($orderinfo);
								
								$email->template('deliveryorderview','deliveryorder')
									->emailFormat('both')
									->from(array('schwing.chris@gmail.com' => 'iMeals'))
									->to($restaurant['Restaurant']['email'])
									->cc('markpmontero@gmail.com')
									->bcc('chris@yolodesign.com')
									->subject('Order Confirmation')
									->viewVars(array(
										'ordershtml' => $html	
										)
									)->send();
							} else if (strtolower(trim($_SESSION['ordertype'])) == 'pickup') {
								$html = $this->getPickupOrdersHtml($orderinfo);
								$email->template('pickuporderview','pickuporder')
									->emailFormat('both')
									->from(array('schwing.chris@gmail.com' => 'iMeals'))
									->to(array($restaurant['Restaurant']['email'],'chris@yolodesign.com'))
									->cc('markpmontero@gmail.com')
									->subject('Order Confirmation')
									->viewVars(array(
										'ordershtml' => $html		
										)
									)->send();
							}
						}
						
						
						if($restaurant['Restaurant']['po_fax_alert']) {
							//$this->sendFax($html);
						}
						
						$_SESSION['delivertophone'] = $orderinfo['delivertophone'];
						$_SESSION['delivertoname'] = $orderinfo['delivertoname'];
						$_SESSION['paymentinfo'] = $orderinfo['paymentinfo'];
						
						$this->sendPhoneCall($order['Order']['id']);
						
						//ToDo
						//Send Phone
						//ToDo
						
						//reset order id and user
						
					}
					
					$sendorder = true;
				}
				
				//4 - Save Profile and Payment Profile - $saveprofile
				$saveprofile = false;
				if($newpaymentinfo['saveinfo'] && $sendorder && $pymntprocessed) {
				//if($newpaymentinfo['saveinfo']) {
					if((!isset($paymentinfo)) || (isset($paymentinfo) && $paymentinfo['customer_profile_id'] == 0)) {
						//User does not have payment info						
						//Create Authorize.Net Profile
						$userProfile = $this->AuthorizeNet->createAuthorize_NetProfile($user['User']['id'], $user['User']['user_email']);
									
						//Create Payment Profile
						$userPaymentProfile = $this->AuthorizeNet->createAuthorize_NetPaymentProfile($user['User']['id'], $user['User']['user_email'], $user['User']['first_name'], $user['User']['last_name'], $user['User']['phone'], $newpaymentinfo['cc_number'], 
							$newpaymentinfo['cc_expiration_year'].'-'.$newpaymentinfo['cc_expiration_month'], $userProfile);
						
						//Create profile in payment info table
						$this->loadModel('PaymentInfo');	
						/*echo 'customer_profile_id='.$userProfile;
						echo '<br>';
						echo 'customer_pymnt_profile_id='.$userPaymentProfile;*/
						
						$newpaymentinfo['customer_profile_id'] = $userProfile;
						$newpaymentinfo['customer_pymnt_profile_id'] = $userPaymentProfile;
						$newpaymentinfo['lastfour_digits'] = substr($newpaymentinfo['cc_number'],strlen($newpaymentinfo['cc_number'])-4,4);
						$newpaymentinfo['card_type'] = $newpaymentinfo['card_type'];
						$newpaymentinfo['user_id'] = $user['User']['id'];
						$newpaymentinfo['billing_zip'] = $newpaymentinfo['billing_zip'];
						$newpaymentinfo['modified'] = date('c');
						
						if ($this->PaymentInfo->save($newpaymentinfo)) {
							$saveprofile = true;
						} 
					}
					else if(isset($paymentinfo)) {
						//Else If checked box save profile and user already has payment profile then update payment profile
						//ToDo
						$saveprofile = true;
						$userProfile = $paymentinfo['customer_profile_id'];
						$userPaymentProfile = $paymentinfo['customer_pymnt_profile_id'];
					}
				}
				
				//Check $sendorder (did the order send) / $pymntprocessed was the payment processed / $saveprofile did the profile save
				//Show error depending on which did not process
				//ToDo
				$_SESSION['orderid'] = null;
				$this->redirect('orderconfirmation/'.$order['Order']['id'].'/'.$isnew);	
				/*echo 'Created User = '. $userid;
				echo '<br>Payment Processed = '.$pymntprocessed;
				echo '<br>Sent Order = '.$sendorder;
				echo '<br>Saved Profile = '.$saveprofile.' Profile ID = '.$userProfile.'Payment Profile ID = '.$userPaymentProfile;
				*/
		}//End if order is null
		else {
			echo 'Order has already be processed.';
		}
	}
	
	
	public function chargeCreditCard($user = null, $paymentinfo = null, $orderinfo = null) {
			
		// By default, this sample code is designed to post to our test server for
		// developer accounts: https://test.authorize.net/gateway/transact.dll
		// for real accounts (even in test mode), please make sure that you are
		// posting to: https://secure.authorize.net/gateway/transact.dll
		$post_url = "https://test.authorize.net/gateway/transact.dll";
		
		$post_values = array(
			
			// the API Login ID and Transaction Key must be replaced with valid values
			"x_login"			=> "6J8RyjNm8LEd",
			"x_tran_key"		=> "9A9NJxpt6734Fv8b",


			//"x_login"			=> "2ncCrg2FQ99E",
			//"x_tran_key"		=> "4G8jtgAtu44K64Mf",		
			
		
			"x_version"			=> "3.1",
			"x_delim_data"		=> "TRUE",
			"x_delim_char"		=> "|",
			"x_relay_response"	=> "FALSE",
		
			"x_type"			=> "AUTH_CAPTURE",
			"x_method"			=> "CC",
			"x_card_num"		=> $paymentinfo['cc_number'],
			"x_exp_date"		=> $paymentinfo['cc_expiration_month'].'/'.$paymentinfo['cc_expiration_year'],
		
			"x_amount"			=> $orderinfo[0]['TempOrder']['total'],
			"x_description"		=> "iMeals Order - ".$orderinfo[0]['TempOrder']['id'],
		
			"x_first_name"		=> $user['User']['first_name'],
			"x_last_name"		=> $user['User']['last_name'],
			"x_address"			=> "none",
			"x_state"			=> "none",
			"x_zip"				=> "none"
			// Additional fields can be added here as outlined in the AIM integration
			// guide at: http://developer.authorize.net
		);
		
		// This section takes the input fields and converts them to the proper format
		// for an http post.  For example: "x_login=username&x_tran_key=a1B2c3D4"
		$post_string = "";
		foreach( $post_values as $key => $value )
			{ $post_string .= "$key=" . urlencode( $value ) . "&"; }
		$post_string = rtrim( $post_string, "& " );
		
		// The following section provides an example of how to add line item details to
		// the post string.  Because line items may consist of multiple values with the
		// same key/name, they cannot be simply added into the above array.
		//
		// This section is commented out by default.
		/*
		$line_items = array(
			"item1<|>golf balls<|><|>2<|>18.95<|>Y",
			"item2<|>golf bag<|>Wilson golf carry bag, red<|>1<|>39.99<|>Y",
			"item3<|>book<|>Golf for Dummies<|>1<|>21.99<|>Y");
			
		foreach( $line_items as $value )
			{ $post_string .= "&x_line_item=" . urlencode( $value ); }
		*/
		
		// This sample code uses the CURL library for php to establish a connection,
		// submit the post, and record the response.
		// If you receive an error, you may want to ensure that you have the curl
		// library enabled in your php configuration
		$request = curl_init($post_url); // initiate curl object
			curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
			curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
			curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
			curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
			$post_response = curl_exec($request); // execute curl post and store results in $post_response
			// additional options may be required depending upon your server configuration
			// you can find documentation on curl options at http://www.php.net/curl_setopt
		curl_close ($request); // close curl object
		
		// This line takes the response and breaks it into an array using the specified delimiting character
		$response_array = explode($post_values["x_delim_char"],$post_response);
		
		// The results are output to the screen in the form of an html numbered list.
		//echo "<OL>\n";
		foreach ($response_array as $value)
		{
			//echo "<LI>" . $value . "&nbsp;</LI>\n";
		}
		//echo "</OL>\n";
		// individual elements of the array could be accessed to read certain response
		// fields.  For example, response_array[0] would return the Response Code,
		// response_array[2] would return the Response Reason Code.
		// for a list of response fields, please review the AIM Implementation Guide
		
		if(isset($response_array[3]))
			return true;
		else
			return false;
	}
	
	
/* Random Functions */

	public function validateAddress($address = null) {
		if($address == null)
			$address = $_SESSION['streetnum'].' '.$_SESSION['street'].' '.$_SESSION['city'].' '.$_SESSION['state'];
	
		$addressinfo = $this->Geocoder->getLatLng($address);
		return $addressinfo;	
	}
	
	public function geocodeaddress($address = null) {
	
		//$address = '11572 Cedar Park, Baton Rouge, LA';
		
		$addressinfo = $this->Geocoder->getLatLng($address); 
		return $addressinfo;
		//echo '<pre>'.var_dump($addressinfo).'</pre>';
	}

	
	function searchForCodebycode($id, $array) {
	   foreach ($array as $key => $val) {
	       if ($val['code'] === $id) {
	           return $val['id'];
	       }
	   }
	   return null;
	}
	function searchForCodebyid($id, $array) {
		$a = 0;
	   foreach ($array as $key => $val) {
	       if ($val['id'] === $id) {
	           return $a;
	       }
	       $a++;
	   }
	   return null;
	}	

	public function distanceGeoPoints ($lat1, $lon1, $lat2, $lon2, $unit='N') {

	    $theta = $lon1 - $lon2; 
		  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)); 
		  $dist = acos($dist); 
		  $dist = rad2deg($dist); 
		  $miles = $dist * 60 * 1.1515;
		  $unit = strtoupper($unit);
		
		  if ($unit == "K") {
		    return ($miles * 1.609344); 
		  } else if ($unit == "N") {
		      return ($miles * 0.8684);
		    } else {
		        return $miles;
		      }
	}
	
	public function Haversine($start, $finish) {
 
	    $theta = $start[1] - $finish[1]; 
	    $distance = (sin(deg2rad($start[0])) * sin(deg2rad($finish[0]))) + (cos(deg2rad($start[0])) * cos(deg2rad($finish[0])) * cos(deg2rad($theta))); 
	    $distance = acos($distance); 
	    $distance = rad2deg($distance); 
	    $distance = $distance * 60 * 1.1515; 
	 
	    return round($distance, 2);
 
	}
	
	
	public function setASAP() {
		App::uses('CakeTime', 'Utility');
		//Calculate ASAP
		$currenttime = strtotime('+30 minutes', time());
		$ordertypeatasap = CakeTime::format('H:i', $currenttime, false,$_SESSION['timezone']);

		$hour = new DateTime($ordertypeatasap);
		$hour = $hour->format('H') ;

		//$hour = date('H',$ordertypeatasap);
		$minute = date('i',$ordertypeatasap);


		/*if($minute < 15)
			$minute = 30;
		else if ($minute < 30)
			$minute = 45;
		else if ($minute < 45) {
			$minute = 00;
			$hour++;
		} 
		else {
			$minute = 15;
			$hour++;
		}*/

		//$ordertypeatasap = $hour.':'.str_pad($minute, 2, '0', STR_PAD_LEFT);
		
		$_SESSION['ordertypeatasap'] = $ordertypeatasap;	
	}	
	

	function bubble_sort($arr, $sortdistance) {
	    $size = count($arr);
	    if($sortdistance == '<') {
		   	for ($i=0; $i<$size; $i++) {
		        for ($j=0; $j<$size-1-$i; $j++) {
		            if ($arr[$j+1]['RestaurantOrderType']['distance'] < $arr[$j]['RestaurantOrderType']['distance']) {
		                $this->swap($arr, $j, $j+1);
		            }
		        }
		    }
	    }
	    else {
		    for ($i=0; $i<$size; $i++) {
		        for ($j=0; $j<$size-1-$i; $j++) {
		            if ($arr[$j+1]['RestaurantOrderType']['distance'] > $arr[$j]['RestaurantOrderType']['distance']) {
		                $this->swap($arr, $j, $j+1);
		            }
		        }
		    }
	    }
	    return $arr;
	}
	
	function swap(&$arr, $a, $b) {
	    $tmp = $arr[$a]['RestaurantOrderType'];
	    $arr[$a]['RestaurantOrderType'] = $arr[$b]['RestaurantOrderType'];
	    $arr[$b]['RestaurantOrderType'] = $tmp;
	    
	    $tmp1 = $arr[$a]['Restaurant'];
	    $arr[$a]['Restaurant'] = $arr[$b]['Restaurant'];
	    $arr[$b]['Restaurant'] = $tmp1;	    
	}
	
	public function setvariables() {
		
		if(isset($_POST['streetnum_post'])) {
			$_SESSION['streetnum']=$_POST['streetnum_post'];
		}
		
		if(isset($_POST['street_post'])) {
			$_SESSION['street']=$_POST['street_post'];
		}
		
		if(isset($_POST['city_post'])) {
			$_SESSION['city']=$_POST['city_post'];
		}
		
		if(isset($_POST['state_post'])) {
			$_SESSION['state']=$_POST['state_post'];
		}
		
		if(isset($_POST['address_post'])) {
			$_SESSION['address']=$_POST['address_post'];
		}
		
		if(isset($_POST['ordertype'])) {
			$_SESSION['ordertype'] = $_POST['ordertype'];
		}
		
		if(isset($_POST['ordertype_post'])) {
			$_SESSION['ordertype']=$_POST['ordertype_post'];
		}
		
		if(isset($_POST['ordertypeat_post'])) {
			$_SESSION['ordertypeat']=$_POST['ordertypeat'];
		}
		
		if(isset($_POST['lat_post'])) {
			$_SESSION['lat']=$_POST['lat_post'];
		}		
		
		if(isset($_POST['lng_post'])) {
			$_SESSION['lng']=$_POST['lng_post'];
		}
		
		if(isset($_POST['ordertypefor_post'])) {
			$_SESSION['ordertypefor']=$_POST['ordertypefor_post'];
		}	
		
		if(isset($_POST['zip_post'])) {
			$_SESSION['zip']=$_POST['zip_post'];
		}												
	}
	
	public function validateusername($emailValue) {
			if($emailValue != null){
				$this->loadModel('User');
				$user = $this->User->find('first',array('conditions'=>array('`User`.`user_email`'=>$emailValue)));
		    	 return $user;
			}	
	}

}
