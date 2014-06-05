<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

   	public $components = array(
			'Acl',
			'Auth' => array(
					'authorize' => 'Controller',
					'authenticate' => array(
							'Form' => array(
									'fields' => array('username' => 'user_email',
											'password' => 'user_password'),
									'scope' => array('`User`.`user_status`' => 1)
							),
					),
			),
			'Session',
			'Cookie',
			'RequestHandler'
	);
    
    public $helpers = array('Time', 'Paginator','Js','Html', 'Form', 'Session');
    	
    public function isAuthorized($user = null) {
        // Any registered user can access public functions
        if (empty($this->request->params['admin'])) {
            return true;
        }

        // Only admins can access admin functions
        if (isset($this->request->params['admin'])) {
            return (bool)($user['role'] === 'admin');
        }

        // Default deny
        return false;
    }
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('display');
        $this->set('logged_in',$this->Auth->loggedIn());
        $this->set('current_user',$this->Auth->user());
    }
    
    public function uploadphoto($image_file){
      
      $image_file['name'] = str_replace(' ', '_', $image_file['name']);
      
      $results = array();
      
      if($image_file['tmp_name'] == ''){
        $results['error'] = 'Please upload a restaurant logo';
      } else {
        
        $img_details = getimagesize($image_file['tmp_name']);
        
  		  if($this->isUploadedFile($image_file,$img_details)):
          
          if($image_file['size'] < 32000000):
            
            $uploadDir = WWW_ROOT . 'files';
            $target_path = $uploadDir . DS . $image_file['name'];
        
            $temp_path = substr($target_path, 0, strlen($target_path) - strlen($this->_ext($image_file['name']))); //temp path without the ext 
            $i=1; 
            //make sure the file doesn't already exist, if it does, add an itteration to it 
            while(file_exists($target_path)){ 
                $target_path = $temp_path . "-" . $i . $this->_ext($image_file['name']); 
                $i++; 
            } 
            $results['image_path'] = $image_file['name'];
            
            if(!move_uploaded_file($image_file['tmp_name'], $target_path)):
              $results['error'] = 'The logo image could not be uploaded. Only .jpg, .png, .gif, and .jpeg are allowed. Please, try again.';
            endif;//move_upload_file
          else:
            $results['error'] = 'The logo image is too big. Max size allowed is 32MB. Please, try again.';
          endif; //if upload size
  		  else:
  		    $results['error'] = 'Sorry, the logo image could not be uploaded. Only .jpg, .png, .gif, and .jpeg are allowed. Please, try again.';
  		  endif;
      }
		  
		  return $results;

    }
    
    public function isUploadedFile($params,$img_details) {
    
      if($img_details && ($img_details['mime'] == 'image/jpeg' || $img_details['mime'] == 'image/png' || $img_details['mime'] == 'image/gif' || $img_details['mime'] == 'image/x-png' ))
        {
          if ((isset($params['error']) && $params['error'] == 0) ||
              (!empty( $params['tmp_name']) && $params['tmp_name'] != 'none')
          ) {
              return is_uploaded_file($params['tmp_name']);
          }
        }
        
        return false;
    }
    /*************************************************** 
    * Returns the extension of the uploaded filename. 
    * 
    * @return string $extension A filename extension 
    * @access protected 
    */ 
    function _ext($filename = null){ 
      return strrchr($filename,"."); 
    } 
    
}
