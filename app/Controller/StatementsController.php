<?php
//App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * Cuisines Controller
 *
 * @property Cuisine $Cuisine
 */
class StatementsController extends AdminController {

  public $uses=array();
  
  public function index(){
    $this->redirect('bycity');
  }
  
/**
 * bycity - view statements by city
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function bycity($city_id = null) {
    
    $this->loadModel('Restaurant');
    $data = array();
    if ($this->request->is('post')) {
      
      //Date Conditions
      if(strrpos($this->request->data['Statement']['date_range'], ' - ')){
    		$date_range = explode(" - ",$this->request->data['Statement']['date_range']);
        $start_date = $date_range[0];
        $end_date = $date_range[1];
  		} else {
    		$start_date = $this->request->data['Statement']['date_range'];
    		$end_date = $start_date;
  		}
  		
  		$contain = array(
            'City'=>array('State'),
            'Order'=>array(
              'conditions' => array(
                  "Order.order_date >= STR_TO_DATE('" . date('Y-m-d',strtotime($start_date)) . " 00:00:00', '%Y-%m-%d %H:%i:%s')",
                  "Order.order_date <= STR_TO_DATE('" . date('Y-m-d',strtotime($end_date)) . " 23:59:59', '%Y-%m-%d %H:%i:%s')"
              ),
              'OrderType'
            ),
            'DeductionAddition'=>array(
              'conditions' => array(
                  "DeductionAddition.date >= STR_TO_DATE('" . date('Y-m-d',strtotime($start_date)) . " 00:00:00', '%Y-%m-%d %H:%i:%s')",
                  "DeductionAddition.date <= STR_TO_DATE('" . date('Y-m-d',strtotime($end_date)) . " 23:59:59', '%Y-%m-%d %H:%i:%s')"
                )
            )
          );
      
      $conditions = array('Restaurant.active'=>1);
  		
      //Restaurant and City Conditions
      
      //if restaurant_id is submitted, get restaurant
      if($this->request->data['Statement']['restaurant_id'] != ""){
        $conditions['Restaurant.id']=$this->request->data['Statement']['restaurant_id'];
        $restaurants = $this->Restaurant->find('all',array(
          'conditions'=>$conditions,
          'contain'=> $contain
        ));
      }
      //if not restaurant_id, if city_id, get all restaurants in city
      elseif($city_id != null && $city_id != 'all'){
        $conditions['Restaurant.city_id']=$city_id;
		    $restaurants = $this->Restaurant->find('all',array(
		      'conditions'=> $conditions,
          'contain'=> $contain
        ));
		  }
      //if not restaurant id and not city id, get all restaurants in all cities
      else {
        $restaurants = $this->Restaurant->find('all',array(
          'conditions'=>$conditions,
          'contain'=> $contain
        ));
      }
      
      $this->set('restaurants', $restaurants);
      $this->set('start_date',$start_date);
      $this->set('end_date',$end_date);
      
      //Create PDF
      App::import('Vendor', 'Fpdf', array('file' => 'fpdf/fpdf.php'));
      $this->layout = 'pdf'; //this will use the pdf.ctp layout
 
      $this->set('fpdf', new FPDF('P','mm','A4'));
 
      $this->render('pdf');
      
    }
		$this->loadModel('City');
		$cities = $this->City->find('list');
		
    
		if($city_id != null && $city_id != 'all')
		  $restaurants = $this->Restaurant->find('list',array('conditions'=>array('Restaurant.city_id'=>$city_id,'Restaurant.active'=>1)));
		else
		  $restaurants = $this->Restaurant->find('list',array('condition'=>array('Restaurant.active'=>1)));
		$this->set(compact('city_id','cities','restaurants'));
  }


  
  public function pdf(){
    
  }

}
