<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Before Filter Method
 *
 * return void
 */	
	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('*');
	}

	function index(){}

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function display($message = null) {
	$user = $this->Auth->user();
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		if($message == 'invalid session'){
  			$message = 'Sorry, your session has expired. Please enter your address.';
		}else{
  			$message = null;
		}
		$this->set(compact('page', 'subpage', 'title_for_layout','message'));
		
		if ($this->request->is('post')) {
  		$errors = '';
  		$data = $this->request->data;

      $type = $data['option'];
      $address = $data['Search']['search_address'];
      $zip = $data['Search']['search_zipcode'];
      
      //Enter Geo Code Data Here
      if($address != null) {
      	$geo_address = $this->geocodeaddress($address);
      	if(isset($geo_address['errors'])){
        	$errors = $geo_address['errors'];
      	}else{
        	$geo_address_type = $geo_address['type'];
      	}
      }
      else if ($zip != null) {
      	$geo_address = $this->geocodeaddress($zip);
      	if(isset($geo_address['errors'])){
        	$errors = $geo_address['errors'];
      	}else{
        	$geo_address_type = $geo_address['type'];
      	}
      }
      else {
      	$geo_address = null;
      	$errors = 'Please enter a valid address';
      }
      	
      //validate address and zip
      //$geo_address_type = RANGE_INTERPOLATED for zip and = ROOFTOP for building/house
      //Delivery must have ROOFTOP and Pickup can be RANGE_INTERPOLATED or ROOFTOP
	    if(isset($geo_address_type)){
	       if($type == 'delivery' && ($geo_address_type != 'ROOFTOP' && $geo_address_type != 'RANGE_INTERPOLATED')) {
            $errors = 'Please enter a valid address for delivery.';
         } elseif($type == 'pickup' && ($geo_address_type != 'RANGE_INTERPOLATED' && $geo_address_type != 'ROOFTOP' && $geo_address_type != 'APPROXIMATE' )){
            $errors = 'Please enter a valid address or zip code.';
         }
      } else {
        $errors = 'Please enter a valid address';
      }
	/*echo '<pre>';
	var_dump($geo_address);
	echo '</pre>';*/
      //set $errors if blank
      if($errors == '' && $geo_address != null && isset($geo_address['city'])) {
	       $this->loadModel('Restaurant');
	      	$cityid = $this->Restaurant->City->find('first',
			array('conditions' => 
				array('AND' => array('City.name' => $geo_address['city'], 'City.active' => 1)
			)));
			
			if($cityid != null && count($cityid) > 0) {
		      	$city_name = $geo_address['city'];
		     	//set session variables
		     
		        $variables['lat'] = $geo_address['lat']; 
	            $variables['lng']  = $geo_address['lng'];
	           	// echo '-'.trim($geo_address['address']).'-';
	            if(trim($geo_address['address']) != '') {
		            $variables['address'] = $geo_address['address'];
		        } else {
		        	$variables['address'] = $geo_address['city'].', '.$geo_address['state'];
		        }
		        
	    	    $variables['streetnum'] = $geo_address['streetnum'];
	            $variables['street'] = $geo_address['street'];  
	            $variables['ordertype'] = $type;
	            $variables['city'] = $geo_address['city'];
	            $variables['state'] = $geo_address['state']; 
	            if(isset($geo_address['zip']))
		            $variables['zip'] = $geo_address['zip']; 
	            else 
	            	$variables['zip'] = '99999';
	            $this->setGeoSessionVariables($variables);
            } else {
            	$errors = 'Sorry there are no restaurants for this city.';
            }
           
          //$errors = 'test';
          //echo '<pre>'.var_dump($variables).'</pre>';
          //echo $_SESSION['address'];
      }
      else {
      	$errors = 'Sorry there are no restaurants for this address.';
      }

      if($errors != ''){
      	$this->set('type',$type);
        $this->set('errors',$errors);
      }	else {
        $this->redirect(array('controller'=>'restaurants','action' => 'search',$city_name));
      }
    
  	}
		$this->render(implode('/', $path));
		
		
	}
	
	public function setGeoSessionVariables($variables) {
		$_SESSION['streetnum']=$variables['streetnum'];
		$_SESSION['street']=$variables['street'];
		$_SESSION['city']=$variables['city'];
		$_SESSION['state']=$variables['state'];
		$_SESSION['address']=$variables['address'];
		$_SESSION['ordertype']=$variables['ordertype'];
		$_SESSION['lat']=$variables['lat'];
		$_SESSION['lng']=$variables['lng'];
		if(isset($variables['zip']))
			$_SESSION['zip']=$variables['zip'];
	}

	public $components = array('Geocoder');
	
	public function geocodeaddress($address = null) {
		$addressinfo = $this->Geocoder->getLatLng($address); 
		return $addressinfo;
	}	
	
	public function services_summary() {
	
	}
	
	public function meetings_events() {
	
	}
	
	public function virtual_cafeteria() {
	
	}
	
	public function personal_orders() {
	
	}
}
