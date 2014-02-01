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
            ),

        ),
        'DebugKit.Toolbar'
    );

    public $uses = array(
        'Customer',
        'Favorite',
        'Permission',
    );

    // Customer -> view (eingeschrängt), search
    // User -> allow all
    // Type -> deny all
    // Combination -> view (do not implement)

    public function beforeFilter() {
        $this->checkPermission($this->Auth->user());
    }
    
    /*
     * Has to be overwritten in Conrtollers or no controller-action is allowed
     * default: block all actions if no admin
     */
    public function checkPermission() {
        if(!$this->Auth->user('isadmin')) {
            throw new MethodNotAllowedException('Insufficient permissions.');
            return true;
        }
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

        // Wenn kein Admin, dann nur Kunden anzeigen auf die der User Rechte hat
        if(!$this->Auth->user('isadmin')) {
            $permissions = $this->Permission->find('list', array(
                'conditions' => array(
                    'user_id' => $this->Auth->user('user_id')
                ),
                'fields' => 'customer_id'
            ));
        
            $favorite_customers = $this->Customer->findAllByCustomer_id($favorites);
            
            $all_customers = $this->Customer->find('all', array('conditions' => array(
                'customer_id' => $permissions,
                'NOT' => array('customer_id' => $favorites)
            )));
        }
        else {
            $favorite_customers = $this->Customer->findAllByCustomer_id($favorites);
            $all_customers = $this->Customer->find('all', array('conditions' => array('NOT' => array('customer_id' => $favorites))));
        }

        $fav_collapsed = false;
        $all_collapsed = false;
        // Set toggle sidebar state 
        if(isset($this->request->query['sbt'])) {
            switch ($this->request->query['sbt']) {
                // Favorite shown, other hidden (fav)
                case 'f': 
                    $fav_collapsed = true;
                    $all_collapsed = false;
                    break;
                // Favorite hidden, other shown (all)
                case 'a': 
                    $fav_collapsed = false;
                    $all_collapsed = true;
                    break;
                // Favorite shown, other shown (both)
                case 'b': 
                    $fav_collapsed = true;
                    $all_collapsed = true;
                    break;
                // Favorite hidden, other shown (nothing)
                case 'n': 
                    $fav_collapsed = false;
                    $all_collapsed = false;
                    break;
                // No Changes 
                default: 
                    break;
            }
        }

        $this->set('favorite_customers', $favorite_customers);
        $this->set('all_customers', $all_customers);
        $this->set('isadmin', $this->Auth->user('isadmin'));
        $this->set('fav_collapsed', $fav_collapsed);
        $this->set('all_collapsed', $all_collapsed);
    }
    

}



