<?php
//App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 */
class CategoriesController extends AdminController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Category->recursive = 0;
		$this->set('categories', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		$this->set('category', $this->Category->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($menu_id = null, $restaurant_name = null, $menu_name = null ) {
		if ($this->request->is('post')) {
			$this->Category->create();
			$this->request->data['Category']['sort_order'] = 0;
			if ($this->Category->save($this->request->data)) {
			 if($this->RequestHandler->isAjax()){
				  $this->set('categories',$this->Category->find('all',array(
				    'conditions'=>array('menu_id' => $this->request->data['Category']['menu_id'],'active'=>1),
				    'contain'=>array(
		          'Item' => array(
		            'VariationGroup'=>array(
		              'Variation'
		            )
		          )
				    ),
				    'order' => array('Category.sort_order')
				    )));
				  $this->loadModel('City');
          $cities = $this->City->find('list');
				  $this->set(compact('menu_id','menu_name','restaurant_name','cities'));
  				$this->render('new_category','ajax');
  		  } else {
				  $this->Session->setFlash(__('The category has been saved'),'flash_good');
				  $this->redirect(array('action' => 'index'));
				}
			} else {
			  if($this->RequestHandler->isAjax()){
			    $this->set('errors',$this->Category->validationErrors);
			    $this->set('categories',$this->Category->find('all',array(
				    'conditions'=>array('menu_id' => $this->request->data['Category']['menu_id'],'active'=>1),
				    'contain'=>array(
		          'Item' => array(
		            'VariationGroup'=>array(
		              'Variation'
		            )
		          )
				    ),
				    'order' => array('Category.sort_order')
				    )));
			    $this->loadModel('City');
          $cities = $this->City->find('list');
				  $this->set(compact('menu_id','menu_name','restaurant_name','cities'));
  			  $this->render('new_category','ajax');
			  }
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'),'flash_bad');
			}
		}
		$menus = $this->Category->Menu->find('list');
		$this->set(compact('menus','menu_id','menu_name','restaurant_name','cities'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null,$menu_id = null,$restaurant_name = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved'),'flash_good');
				if($menu_id != null){
				  $this->redirect(array('controller'=>'menus','action' => 'edit',$menu_id,$restaurant_name));
				}
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'),'flash_bad');
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
		}
		$menus = $this->Category->Menu->find('list');
		$this->set(compact('menus'));
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
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Category->delete()) {
			$this->Session->setFlash(__('Category deleted'),'flash_good');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Category was not deleted'),'flash_bad');
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * deactivate method
 *
 */
	public function deactivate($cat_id = null) {
  	$this->layout = 'ajax';
  	$this->Category->id = $cat_id;
  	if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid Category'));
		}
		if($this->Category->saveField('active',0)){
  		$this->render('deactivated','ajax');
		}
	}
	
/**
 * reorder method
 *
 */
	public function reorder() {
  	foreach ($this->request->data['Category'] as $key => $value) {
  		$this->Category->id = $value;
  		$this->Category->saveField("sort_order",$key + 1);
  	}
  	//$this->log(print_r($this->request->data,true));
  	exit();
  }
}

