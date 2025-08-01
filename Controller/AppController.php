<?php


App::uses('RequirementsController', 'Controller');
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    
    public $theme = "CakeAdminLTE";
    
    public $components = array(
        'Acl',
        'DebugKit.Toolbar',
        'Auth' => array(
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            )
        ),
        'Session',
        'RequestHandler'
    );
    
    public $helpers = array('Html', 'Form', 'Session', 'Captcha.Captcha');

    public function beforeFilter() {
        
      //Configure AuthComponent
        if (!empty($this->request->data) && empty($this->request->data[$this->Auth->userModel])) {
            $user['User']['id'] = $this->Auth->user('id');
            $this->request->data[$this->Auth->userModel] = $user;
        }
        
        $this->Auth->loginAction = array(
          'controller' => 'users',
          'action' => 'login'
        );
        $this->Auth->logoutRedirect = array(
          'controller' => 'users',
          'action' => 'login'
        );
        $this->Auth->loginRedirect = array(
          'controller' => 'users',
          'action' => 'login'
        );
        
        $this->colors = array('bg-aqua' => __('Aqua'), 'bg-green' => __('Green'), 'bg-yellow' => __('Yellow'), 'bg-red' => __('Red'));
        $this->active = array(0 => __('No'), 1 => __('Yes'));
        $this->purchaseMethods = array(0 => __('Framework Agreement'), 1 => __('Public Tender'), 2 => __('Direct Deal'), 3 => __('Compra Ágil'), 4 => __('Compra Coordinada'));
        $this->evaluations = array(0 => __('Very good'), 1 => __('Good'), 2 => __('Regular'), 3 => __('Bad')); 
        $this->ldap = array(
          'LDAP_HOST' => "10.50.0.2", 
          'LDAP_HOST_2' => "10.50.0.6", 
          'LDAP_PORT' => 389,
          'LDAP_ADMIN_DN' => "memo",
          'LDAP_ADMIN_PASSWORD' => "Ksjn23_12",
          'LDAP_SEARCH_OU' => "OU=MMEG,DC=mmeg,DC=cl"
        );

        $this->Auth->allow('display');
        
        # LLAMADA A REQUIREMENTS
        #$this->loadModel('Requirement');
        #$requirements = $this->Requirement->find('all', array('contain' => false));
        #$this->set(compact('requirements'));

    }
    
}
