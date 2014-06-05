<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * Items Controller
 *
 * @property Item $Item
 */
class ItemsController extends AdminController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Item->recursive = 0;
		$this->set('items', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Item->exists($id)) {
			throw new NotFoundException(__('Invalid item'));
		}
		$options = array('conditions' => array('Item.' . $this->Item->primaryKey => $id));
		$this->set('item', $this->Item->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($cat_id = null, $rest_menu_name = null, $cat_name = null,$menu_id=null) {
		if ($this->request->is('post')) {
			$this->Item->create();
			
			$data = $this->request->data;
      
      //Logo File Info in $data['Restaurant']['logo_file']
      if(isset($data['Item']['photo_file']) && $data['Item']['photo_file']['tmp_name'] != ""):
        
        //Upload Restaurant Logo
        $results = $this->uploadphoto($data['Item']['photo_file']);

        //If Upload was sucess (not an error)
        if(!isset($results['error'])):
          $data['Item']['photo_url'] = $results['image_path'];
               
        if ($this->Item->saveAssociated($data,array('deep'=>true))) {
  				$this->Session->setFlash(__('The item has been saved'),'flash_good');
  				$rest_name = explode(" ",$rest_menu_name);
  				$this->redirect(array('controller'=>'menus','action' => 'edit',$menu_id,$rest_name[0]));
  			} else {
  				$this->Session->setFlash(__('The item could not be saved. Please, try again.'),'flash_bad');
  			}

        else:
    		    $this->Session->setFlash(__($results['error']),'flash_bad');
    		endif; // uploadphoto return false
      else: //$data['Items']['logo_file'] no set
        
        if ($this->Item->saveAssociated($data,array('deep'=>true))) {
  				$this->Session->setFlash(__('The item has been saved'),'flash_good');
  				$rest_name = explode(" ",$rest_menu_name);
  				$this->redirect(array('controller'=>'menus','action' => 'edit',$menu_id,$rest_name[0]));
  			} else {
  				$this->Session->setFlash(__('The item could not be saved. Please, try again.'),'flash_bad');
  			}
  			
      endif;
      
			
		}
		$categories = $this->Item->Category->find('list');
		$this->set(compact('categories','cat_id','rest_menu_name','cat_name','menu_id'));
	}


/**
 * copyItem method
 *
 * @return void
 */
	public function copyItem($rest_id = null, $rest_menu_name = null) {

		if($this->RequestHandler->isAjax()){

			$data=$this->request->data;
			
			if(isset($data['Menu']['copy_item'])){
  			if($data['Menu']['copy_item'] != null && $data['Menu']['copy_item'] != ""){
  			  $i=0;
  			  $a=0;
  			  	while($a<$data['Menu']['numcopies']){
	  			    foreach($data['Menu']['copy_item'] as $copy_item):
	        			$copy_item = $this->Item->copyItem($copy_item,$data['Category']['id']);
	        			$items[$i]=$this->Item->find('first',array('conditions'=>array('Item.id'=>$copy_item)));
	        			$i++;
	    			endforeach;
	    			
	    			$a++;
    			}
    			$restaurant_name = $data['Restaurant']['name'];
    			$menu_id = $data['Menu']['id'];
    			$id_set = $data['Menu']['id_set'];
          $type = $data['Menu']['type'];
    			$this->set(compact('restaurant_name','menu_id','id_set','type','items'));
    			if($copy_item){
        			  
        			  $this->render('new_item','ajax');
      			  } else {
        			  $this->set('errors','Error copying Item');
        			  $this->render('new_item','ajax');
      			  }  
    		  }

    		}
    	}	
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null,$restaurant_name = null) {
		
		if (!$this->Item->exists($id)) {
			throw new NotFoundException(__('Invalid item'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$data = $this->request->data;
		 
      //Logo File Info in $data['Restaurant']['logo_file']
      if(isset($data['Item']['photo_file']) && $data['Item']['photo_file']['tmp_name'] != ""):
        
        //Upload Restaurant Logo
        $results = $this->uploadphoto($data['Item']['photo_file']);

        //If Upload was sucess (not an error)
        if(!isset($results['error'])):
          $data['Item']['photo_url'] = $results['image_path'];
               
        if ($this->Item->saveAssociated($data,array('deep'=>true))) {
  				$this->redirect(array('controller'=>'menus','action' => 'edit',$this->request->data['MenuID'],$restaurant_name.'&#35;Category_'.$this->request->data['CategoryID']));
  				$this->Session->setFlash(__('The item has been saved'),'flash_good');
  			} else {
  				$this->Session->setFlash(__('The item could not be saved. Please, try again.'),'flash_bad');
  			}

        else:
    		    $this->Session->setFlash(__($results['error']),'flash_bad');
    		endif; // uploadphoto return false
      else: //$data['Items']['logo_file'] no set
        
        if ($this->Item->saveAssociated($data,array('deep'=>true))) {
  				$this->Session->setFlash(__('The item has been saved'),'flash_good');
  				$this->redirect(array('controller'=>'menus','action' => 'edit',$this->request->data['MenuID'],$restaurant_name.'&#35;Category_'.$this->request->data['CategoryID']));
  			} else {
  				$this->Session->setFlash(__('The item could not be saved. Please, try again.'),'flash_bad');
  			}
  			
      endif;
			
			
		}
		$options = array(
			 'conditions' => array('Item.' . $this->Item->primaryKey => $id),
			 'contain'=> array('Category','VariationGroup'=>array('Variation','order' => array('VariationGroup.sort_order'))));
			$this->request->data = $this->Item->find('first', $options);
		$categories = $this->Item->Category->find('list');
		$this->set(compact('categories','restaurant_name'));
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
		$this->Item->id = $id;
		if (!$this->Item->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Item->delete()) {
			$this->Session->setFlash(__('Item deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Item was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
		/**
 * deactivate method
 *
 */
	public function deactivate($id = null,$menu_id = null,$rest_name = null) {
		$this->Item->id = $id;
		if (!$this->Item->exists()) {
			throw new NotFoundException(__('Invalid Item'));
		}
		$this->request->onlyAllow('post', 'deactivate');
		if($this->Item->saveField('active',0)){
  		$this->Session->setFlash(__('Item deleted'),'flash_good');
			$this->redirect(array('controller'=>'menus','action' => 'edit',$menu_id,$rest_name));
		}
		$this->Session->setFlash(__('Item was not deleted'),'flash_bad');
		$this->redirect(array('controller'=>'menus','action' => 'edit',$menu_id,$rest_name));
	}
	/**
 * reorder method
 *
 */
	public function reorder() {
  	foreach ($this->request->data['Item'] as $key => $value) {
  		$this->Item->id = $value;
  		$this->Item->saveField("sort_order",$key + 1);
  	}
  	//$this->log(print_r($this->request->data,true));
  	exit();
  }

}
