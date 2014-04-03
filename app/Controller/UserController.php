<?php
class UserController extends AppController {

    public $components = array(
        'Security', 
        'Cookie',
    );
    public $uses = array(
        'User', 
        'Task',
        'Customer',
        'Favorite',
    );
    public $helpers = array(
        'Time',
    ); 

    public function beforeFilter() {
        // Kein blackhole callback (validatePost, CheckForm) bei AJAX Request
        // blackhole callback bei POST Aufruf trotzdem vorhanden
        // (AJAXCall leitet zu POST weiter)
        //$this->Security->csrfCheck = false;
        $this->Auth->flash = array('element' => 'flash_bt_warning');

        // Welche Actions sind erlaubt?
        $this->Auth->allow('login', 'createsalt');

        // Autologin?
        $cookie = $this->Cookie->read('autologin');

        if(!$this->Auth->loggedIn() && isset($cookie)) { // Wenn ausgeloggt und Cookie gesetzt
            
            $this->log('Try to autologin...', 'debug');
            $this->log($cookie, 'debug');

            if(Security::hash($cookie['username'].$cookie['time']) == $cookie['hash']) { // Wenn cookie gültig
                $this->User->recursive = -1;
                $user = $this->User->findByUsernameAndPassword($cookie['username'], $cookie['password']);

                // DO NOT TOUCH THIS! (srsly, just dont do it)
                $user = $user['User']; // This is so fucking dirty, but it works.

                if(count($user) > 0) { // Wenn ein Benutzer gefunden wurde: Authentifizieren
                    $this->Auth->login($user);
                    $this->Auth->authenticate = $user;
                    $this->redirect($this->Auth->loginRedirect);
                }
                else {
                    $this->log('Autologin failed.', 'debug');
                }
            }
        }
        if($this->Auth->loggedIn()) { // User setzen, falls eingeloggt
            $this->set('current_user', $this->Auth->user());
        } 
        else {
            $this->set('current_user', false);
        }
    }

    // Just a development function
    public function createsalt($pw) {
        echo Security::hash($pw, 'sha1', true);
        $this->autoRender = false;
    }

    /**
     * @param Kunden ID
     * Toggle the Customer favorite state
    */
    public function favorite($customer_id = null) {

        // Falls kein Admin: Rechte vorhanden?
        if(!$this->Auth->user('isadmin')) {
            $permissions = $this->Permission->find('list', array(
                'conditions' => array('user_id' => $this->Auth->user('user_id')),
                'fields' => 'customer_id'
            ));
            if(!in_array($customer_id, $permissions)) {                
                throw new MethodNotAllowedException('You dont have permission add this Customer to your favorites.'); 
            }
        }

        // Gültiger Kunde?
        $customer = $this->Customer->findByCustomer_id($customer_id);
        if($customer) {
            // Kunde bereits Favorit? Entfernen!
            if($this->Favorite->findByCustomer_idAndUser_id($customer_id, $this->Auth->user('user_id'))) {
                $this->Favorite->deleteAll(array('Favorite.customer_id' => $customer_id, 'Favorite.user_id' => $this->Auth->user('user_id')));
                $this->redirect(array('controller' => 'customer', 'action' => 'view', $customer_id));
            }
            // Kunde als Favorit speichern
            else {       
                // data to save
                $new_fav = array('Favorite' => array(
                    'user_id' => $this->Auth->user('user_id'),
                    'customer_id' => $customer_id
                ));

                if($this->Favorite->save($new_fav)) {
                    $this->redirect(array('controller' => 'customer', 'action' => 'view', $customer_id));
                }
                else {
                    $this->Session->setFlash($customer['Customer']['name'].' konnte nicht als Favorit gespeichert werden', 'flash_bt_bad');
                    $this->redirect(array('controller' => 'customer', 'action' => 'view', $customer_id));
                }
            }
        }
        else {
            $this->Session->setFlash('Ungültiger Kunde.', 'flash_bt_bad');
            $this->redirect('/');
        }
    }

    public function login() {
        $this->layout = 'login';

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if($this->request->data['User']['stay'] == 1) {
                    $currentTime = time();
                    $cookie = array(
                        'username' => $this->request->data['User']['username'],
                        'password' => Security::hash($this->request->data['User']['password'], 'sha1', true),
                        'time' => $currentTime,
                        'hash' => Security::hash($this->request->data['User']['username'].$currentTime) // Checksumme
                    );
                    // Cookie Speichern
                    $this->Cookie->write('autologin', $cookie, true, '+1 year');
                }

                $this->Session->write('NavCollapse.fav', true);
                $this->Session->setFlash('Willkommen zurück, '.$this->request->data['User']['username'], 'flash_bt_good');
                return $this->redirect($this->Auth->redirect());
            } 
            else {
                $this->Session->setFlash('Login fehlgeschlagen', 'flash_bt_bad');
            }
        }

        // Falls User bereits eingeloggt war
        if($this->Auth->loggedIn()) {
            $this->Session->setFlash('Alles ok. Du bist bereits eingeloggt.', 'flash_bt_warning');
            return $this->redirect($this->Auth->redirect());
        }
    }

    // Logout-Funktion
    public function logout() {
        $this->Session->setFlash('Du wurdest erfolgreich ausgeloggt.', 'flash_bt_info');
        //$this->Session->delete('User');
        $this->Cookie->delete('autologin');
        return $this->redirect($this->Auth->logout());
    }

    public function changepw() {

        if($this->request->is('post')) {
            $this->User->recursive = -1;
            $this->User->id = $this->Auth->user('user_id');

            // oldpw == dbpw
            if($this->User->field('password') == Security::hash($this->request->data['User']['old_password'], 'sha1', true)) {
                // newpw1 == newpw2
                if($this->request->data['User']['password'] == $this->request->data['User']['confirm_password']) {
                    $this->User->password = $this->request->data['User']['confirm_password'];

                    // Passwort matching?
                    $password['User']['password'] = $this->request->data['User']['password'];
                    unset($this->request->data);
                    $this->User->set($password);

                    if($this->User->validates(array('fieldList' => array('password')))) {                 
                        if($this->User->save()) {
                           $this->Session->setFlash('Passwort erfolgreich geändert.', 'flash_bt_good'); 
                        }
                        else {
                            $this->Session->setFlash('Passwort konnte nicht geändert werden.', 'flash_bt_bad'); 
                        }
                    }
                    else {
                        $this->Session->setFlash('Passwort konnte nicht geändert werden.', 'flash_bt_bad'); 
                    }

                }
                else {
                    $this->Session->setFlash('Passwörter stimmen nicht überein.', 'flash_bt_bad'); 
                }
            }
            else {
                $this->Session->setFlash('Dein altes Passwort scheint nicht korrekt zu sein.', 'flash_bt_bad'); 
            }
        }

    }

}



?>
