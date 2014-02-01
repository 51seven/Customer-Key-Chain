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

        $this->Auth->flash = array(
           'element' => 'flash_bt_warning'
      );

        // Welche Actions sind erlaubt?
        $this->Auth->allow('login', 'createsalt');
        
        // Autologin?
        $cookie = $this->Cookie->read('autologin');
/*
        if(!$this->Auth->loggedIn() && isset($cookie)) { // Wenn ausgeloggt und Cookie gesetzt
            if(Security::hash($cookie['username'].$cookie['time']) == $cookie['hash']) { // Wenn cookie gültig
                $this->User->recursive = -1;
                $user = $this->User->findByUsernameAndPassword($cookie['username'], $cookie['password']);

                if(count($user) > 0) { // Wenn ein Benutzer gefunden wurde: Authentifizieren
                    $this->Auth->login($user);
                    $this->Auth->authenticate = $user;
                    $this->Session->write('User', $user['User']);
                }
            }
        }*/
        if($this->Auth->loggedIn()) { // User setzen, falls eingeloggt
            $user = $this->Auth->user();
            unset($user['User']['password']); // Security shit
            $this->set('current_user', $user);
        } 
        else {
            $this->set('current_user', null);
        }
    }

    // Just a development function
    public function createsalt($pw) {
        echo Security::hash($pw, 'sha1', true);
        $this->autoRender = false;
    }

    public function index() {
        $users = $this->User->find('all');
        $this->set('users', $users);
    }

    public function settings() {  

        // User-ID des aktuell eingeloggten Benutzers auslesen
        $user_id = $this->Session->read('User.user_id');
        $this->User->recursive = -1;

        if($this->request->is('post')) {
            $this->request->data['User']['user_id'] = $user_id;

            // Schaut nach ob das Passwort aktuaisiert werden soll
            /*if($this->request->data['User']['password_old'] != null) {

                $db_password = $this->User->findByUser_id($user_id);
                // Stimmt das alte PW mit dem neuen überein?
                if($db_password == Security::hash($this->request->data['User']['password_old'], 'sha1', true)) {
                    // Stimmen die beiden neuen Passwörter überein?
                    if($this->request->data['User']['password_new'] == $this->request->data['User']['password_confirm']) {


                    }
                }
            }*/
            
            unset($this->request->data['User']['password_old']);
            unset($this->request->data['User']['password_new']);
            unset($this->request->data['User']['password_confirm']);

            if($this->User->save($this->request->data, $validate = true)) {
                $this->Session->setFlash('Profil erfolgreich aktualisiert.', 'flash_bt_good');
            }
            else {
                $this->Session->setFlash('Profil konnte nicht aktualisiert werden.', 'flash_bt_bad');   
            }

            $this->redirect('/user/settings');
        } 
        else {
            $user = $this->User->findByUser_id($user_id, array('color'));
            $this->data = $user;
        }
    }

    /**
     * @param Kunden ID
     * Toggle the Customer favorite state
    */
    public function favorite($customer_id = null) {
        // Gültiger Kunde?
        $customer = $this->Customer->findByCustomer_id($customer_id);
        if($customer) {
            // Kunde bereits Favorit? Entfernen!
            if($this->Favorite->findByCustomer_idAndUser_id($customer_id, $this->Auth->user('user_id'))) {
                $this->Favorite->deleteAll(array('Favorite.customer_id' => $customer_id, 'Favorite.user_id' => $this->Auth->user('user_id')));
                //$this->Session->setFlash($customer['Customer']['name'].' wurde von den Favoriten entfernt.', 'flash_bt_good');
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
                    //$this->Session->setFlash($customer['Customer']['name'].' erfolgreich als Favorit gespeichert.', 'flash_bt_good');
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
                        'hash' => Security::hash($user['User']['username'].$currentTime) // Checksumme
                    );
                    // Cookie Speichern
                    $this->Cookie->write('autologin', $cookie, true, '+1 year');
                }

                $this->Session->setFlash('Willkommen zurück, '.$this->request->data['User']['username'], 'flash_bt_good');
                return $this->redirect($this->Auth->redirectUrl());
            } 
            else {
                $this->Session->setFlash('Login fehlgeschlagen', 'flash_bt_bad');
            }
        }
    }

    // Logout-Funktion
    public function logout() {
        $this->Session->setFlash('Du wurdest erfolgreich ausgeloggt.', 'flash_bt_info');
        $this->Session->delete('User');
        $this->Cookie->delete('autologin');
        return $this->redirect($this->Auth->logout());
    }


}
