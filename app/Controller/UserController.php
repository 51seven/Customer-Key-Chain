<?php
class UserController extends AppController {

    public $components = array(
        'Security', 
        'Cookie',
    );
    public $uses = array(
        'User', 
        'Task'
    );
    public $helpers = array(
        'Time',
    ); 

    public function beforeFilter() {
        // Kein blackhole callback (validatePost, CheckForm) bei AJAX Request
        // blackhole callback bei POST Aufruf trotzdem vorhanden
        // (AJAXCall leitet zu POST weiter)
        $this->Security->csrfCheck = false;

        $this->Auth->flash = array(
           'element' => 'flash_bt_warning'
      );

        // Welche Actions sind erlaubt?
        $this->Auth->allow('login', 'createsalt');
        
        // Autologin?
        $cookie = $this->Cookie->read('autologin');

        // Wenn ausgeloggt und Cookie gesetzt
        if(!$this->Auth->loggedIn() && isset($cookie)) {
            // Wenn cookie gültig
            if(Security::hash($cookie['username'].$cookie['time']) == $cookie['hash']) {
                $user = $this->User->find('first', array(
                    'conditions' => array(
                        'User.username' => $cookie['username'],
                        'User.password' => $cookie['password']
                    ),
                    'recursive' => -1,
                ));
                // Wenn ein Benutzer gefunden wurde: Authentifizieren
                if(count($user) > 0) {
                    $this->Auth->login($user);
                    $this->Auth->authenticate = $user;
                    $this->Session->write('User', $user['User']);
                }
            }
        }
        // User setzen, falls eingeloggt
        if($this->Auth->loggedIn()) {
            $user = $this->Auth->user();
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

    public function login() {
        $this->layout = 'login';

        if($this->request->is('Post')) {

            $this->User->recursive = -1;

            $user = $this->User->findByUsernameAndPassword(
                $this->request->data['User']['username'], 
                Security::hash($this->request->data['User']['password'], 'sha1', true) //true = default salt
            );

            if(!$user) {
                $this->Session->setFlash('Login fehlgeschlagen.', 'flash_bt_warning');
                $this->redirect($this->Auth->loginAction);
            }
            else { 
                //debug($user);

                // User Authentifizieren
                $this->Auth->login($user);
                $this->Auth->authenticate = $user;

                // Wichtige Daten in der Session speichern:
                $this->Session->write('User', $user['User']);

                // Eingeloggt bleiben?
                if($this->request->data['User']['stay'] == 1) {
                    $currentTime = time();
                    $cookie = array(
                        'username' => $user['User']['username'],
                        'password' => $user['User']['password'],
                        'time' => $currentTime,
                        'hash' => Security::hash($user['User']['username'].$currentTime) // Checksumme
                    );
                    // Cookie Speichern
                    $this->Cookie->write('autologin', $cookie, true, '+1 year');
                }
                
                // weiterleiten
                $this->redirect($this->Auth->loginRedirect);
            }
        }
    }

    // Logout-Funktion
    public function logout() {
        $this->Session->setFlash('Du wurdest erfolgreich ausgeloggt.', 'flash_bt_info');
        $this->Session->delete('User');
        $this->Cookie->delete('autologin');
        $this->redirect($this->Auth->logout());
    }


}
