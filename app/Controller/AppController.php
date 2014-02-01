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
            'flash' => array(
                'element' => 'flash_bt_warning',
                'key' => 'auth',
                'params' => array(1)
            )
        ),
        //'DebugKit.Toolbar'
    );

    public $uses = array(
        'Customer'
    );

 	public function beforeFilter() {
        $this->Auth->deny();
    }

    /**
     * beforeRender callback
     *
     * @return void
     */
    public function beforeRender() {
        $this->set('favorite_customers', $this->Customer->find('list', array(
            'conditions' =>  array('isfavorite' => true),
        )));
        $this->set('all_customers', $this->Customer->find('list', array(
            'conditions' =>  array('isfavorite' => false),
        )));
    }
    

}



