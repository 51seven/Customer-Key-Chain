<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
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
    	'Security',
        'Session', 
        'Auth' => array(
            'loginRedirect' => array('controller' => 'pages', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'user', 'action' => 'login'),
            'loginAction' => array('controller' => 'user', 'action' => 'login'),
            'authError' => 'Bitte melde Dich an, bevor du auf diese Seite zugreifst.',
            /*'authenticate' => array(
                'Form' => array(
                    'fields' => array(
                        'username' => 'username', 
                        'password' => 'password'
                    )
                )
            )*/ // It seems that this snipped isnt neccessary. hum.
            'flash' => array(
                'element' => 'flash_bt_warning',
                'key' => 'auth',
                'params' => array(1)
            )
        ),
        //'DebugKit.Toolbar'
    );

    public $uses = array(
        'Customer',
        'Favorite',
    );

    public $permissions = array(); 

    /*
     * @overrice (not rly, but its sounds cooler)
     * Overrides the method. 
     */
    function isAuthorized(){ 
        if($this->Auth->user('isadmin')) return true; //Remove this line if you don't want admins to have access to everything by default
        if(!empty($this->permissions[$this->action])) { 
            if($this->permissions[$this->action] == '*') {
                return true; 
            }
            if(in_array($this->Auth->user('group'), $this->permissions[$this->action])) {
                return true; 
            }
        } 
        return false; 
         
    } 

 	public function beforeFilter() {
        if($this->Auth->user('isadmin')) {
            $this->Auth->allow();
            return;
        }
        else {

            return;
        }

        // Default deny
        $this->Auth->deny();
    }

    
    /* 
     * beforeRender callback
     */
    public function beforeRender() {
        // Get Favorite Customer IDs
        $favorites = $this->Favorite->find('list', array(
            'conditions' => array(
                'user_id' => $this->Auth->user('user_id')
            ),
            'fields' => 'customer_id'
        ));

        // Favorites
        $this->set('favorite_customers', $this->Customer->findAllByCustomer_id($favorites));

        // Other (favorites excluded)
        $customer = $this->Customer->find('all', array('conditions' => array('NOT' => array('customer_id' => $favorites))));
        $this->set('all_customers', $customer);
    }
    

}



