<?php
// hasOne: the other model contains the foreign key.
// HABTM requires a separate join table that includes both model names.

class Customer extends AppModel {
    public $useTable = 'customers'; 
    public $primaryKey = 'customer_id'; 

    public $order = array(
        'Customer.name ASC'
    );

    public $hasMany = array(
        'Contactperson' => array(
            'className' => 'Contactperson',
            'foreignKey' => 'contactperson_id'
        ),
        'History' => array(
            'className' => 'History',
            'foreignKey' => 'history_id'
        ),
        'History' => array(
            'className' => 'History',
            'foreignKey' => 'history_id'
        ),
    );

    // Varlidation Rules for this Model
    public $validate = array(
        'name' => array(
            'rule'     => 'notEmpty',
            'required' => true,
            'message' => 'Der Kunde muss einen Namen haben.'
        )
    );

    public function checkPermission($customer, $user) {
        if(!$user('isadmin')) {
            // nur erlaubte Kunden anzeigen
            $permissions = $this->Permission->find('list', array(
                'conditions' => array('user_id' => $this->Auth->user('user_id')),
                'fields' => 'customer_id'
            ));

            $allowedActions = array('view', 'history', 'contacts', 'search');

            if(in_array($this->action, $allowedActions)) {
                if(isset($this->request->pass[0])) {
                    if(in_array($this->request->pass[0], $permissions) || $this->action == 'search') {
                        return true;
                    }
                    else {                    
                        throw new ForbiddenException('Du hast keine Berechtigung diesen Kunden zu sehen.');
                    }
                }
            }
            else {
                throw new ForbiddenException('Deine Berechtigungen reichen leider nicht aus.');
            }
        }
        else if($this->Auth->loggedIn()) {
            // Eingeloggt 
            if($this->action == 'search' OR $this->action == 'index') {
                return true;
            }
        }
        else {
            // Nicht eingeloggt. Redirect zum Login
            $this->Session->setFlash('Bitte melde dich an.', 'flash_bt_warning');
            $this->redirect(array('controller' => 'user', 'action' => 'login'));
            return false;
        }
    }    
}
?>