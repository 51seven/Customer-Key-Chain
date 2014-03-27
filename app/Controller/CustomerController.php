<?php
class CustomerController extends AppController {

    public $uses = array(
        'Customer',
        'Combination',
        'Contactperson',
        'History',
        'Funfact',
    );
    public $helpers = array(
        'Markdown.Markdown',
    ); 

    public function checkPermission() {
        if(!$this->Auth->user('isadmin')) {
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

    /*  
    called by route:
    */
    public function index() {
        $this->set('user', $this->Auth->user());
        
        // Anzahl an gespeicherten Kombinationen:
        $combination_count = $this->Combination->find('count');

        // Anzahl der Kunden
        $customer_count = $this->Customer->find('count');

        // Kunden bei denen der letzte Eintrag länger als 30 Tage her ist
        $onemonth = date('Y-m-d', strtotime('-1 month'));
        $frozen_customers = $this->History->find('all', array(
            'conditions' => array('History.time <=' => $onemonth),
            'group' => 'History.customer_id',
            'fields' => array('History.history_id', 'History.customer_id', 'MAX(History.time) as time', 'Customer.name'),
        ));

        // Aktivitäten der Benutzer
        $user_activity = 'user_activity';

        $this->set('combination_count', $combination_count);
        $this->set('customer_count', $customer_count);
        $this->set('frozen_customers', $frozen_customers);
        $this->set('user_activity', $user_activity);
    }

    public function view($cid = null) {
    	$customer = $this->Customer->findByCustomer_id($cid);

    	if(!$customer) {
    		$this->Session->setFlash('Kunde wurde nicht gefunden.', 'flash_bt_warning');
    		$this->redirect('index');
    	}
    	else {
            $favorites = $this->Favorite->find('list', array(
                'conditions' => array(
                    'user_id' => $this->Auth->user('user_id')
                ),
                'fields' => 'customer_id'
            ));
            $isfav = false;
            foreach($favorites as $favorite) {
                if($favorite == $cid) $isfav = true;
            }
    		$combinations = $this->Combination->findAllByCustomer_id($cid);
            $combos = array();
            foreach($combinations as $combination) {
                $type = $combination['Type']['name'];
                if(!array_key_exists($type, $combos)) {
                    $combos[$type] = array();
                }
                $combos[$type][] = $combination['Combination'];
            }

            $this->Contactperson->recursive = -1;
            $contactpersons = $this->Contactperson->findAllByCustomer_id($cid);

            $this->History->recursive = -1;
            $histories = $this->History->findAllByCustomer_id($cid);

            $funfact = $this->Funfact->find('first', array(
                'conditions' => array('Funfact.customer_id LIKE' => $cid),
                'fields' => array('Funfact.customer_id', 'Funfact.text'),
                'order' => 'RAND()',
            ));

            $this->set('funfact', $funfact);
            $this->set('histories', $histories);
            $this->set('contactpersons', $contactpersons);
            $this->set('isfav', $isfav);
    		$this->set('combinations', $combos);
    		$this->set('customer', $customer);
    	}
    }

    public function create() {
		if($this->request->is('post')) {
            if($this->Customer->save($this->request->data)) {
                $this->Session->setFlash('Kunde erfolgreich erstellt.', 'flash_bt_good');
                $this->redirect(array('controller' => 'customer', 'action' => 'view/'.$this->Customer->getLastInsertId()));
            }
            else {
                $this->Session->setFlash('Fehler beim erstellen eines neuen Kunden.', 'flash_bt_bad');
            }
        }
    }

    public function edit($cid = null) {
        // Speichern
        if($this->request->is('post')) { 
            $this->request->data['Customer']['customer_id'] = $cid;

            if($this->Customer->save($this->request->data)) {
                $this->Session->setFlash('Kunde erfolgreich aktualisiert', 'flash_bt_good');
                $this->redirect('view/'.$cid);
            }
            else {
                $this->Session->setFlash('Kunde konnte nicht aktualisiert werden.', 'flash_bt_bad');
                $this->redirect('edit/'.$cid);
            }
        }
        // Felder vorselektieren
        else {
            if($cid) {
                $this->request->data = $this->Customer->findByCustomer_id($cid);
            }
            else {
                $this->Session->setFlash('Ungültiger Kunde', 'flash_bt_warning');
                $this->redirect('/');
            }
        }
    }

    public function search() {

        if(isset($this->request->query['string'])) {
            $string = $this->request->query['string'];
        }
        else {
            $this->Session->setFlash('Kein Suchstring vorhanden.', 'flash_bt_info');
            $this->redirect('index');
        }

        if(strlen($string) < 3) {
            $this->Session->setFlash('Suche muss mindestens 3 Buchstaben enthalten.', 'flash_bt_info');
            $this->redirect('index');
        }
        else {
            $contact_results = $this->Contactperson->find('list', array(
                'conditions' => array(
                    'OR' => array(
                        array('Contactperson.prename LIKE' => $string),
                        array('Contactperson.name LIKE' => $string),
                        array('Contactperson.fullname LIKE' => $string),
                    ),
                ),
            ));

            $customer_results = $this->Customer->find('list', array(
                'conditions' => array('Customer.name LIKE' => '%'.$string.'%'),
            ));

            // Suchergebnisse filtern
            if(!$this->Auth->user('isadmin')) {
                $permissions = $this->Permission->find('list', array(
                    'conditions' => array('user_id' => $this->Auth->user('user_id')),
                    'fields' => 'customer_id'
                ));   

                // Kunden filtern
                $filtered_results = array();

                foreach ($customer_results as $key => $result) {
                    if(in_array($key, $permissions)) {
                        $filtered_results[$key] = $result;
                    }    
                }
                $customer_results = $filtered_results;

                // Kontakte filtern
                $filtered_results = array();

                foreach ($contact_results as $key => $result) {
                    if(in_array($key['Customer']['customer_id'], $permissions)) {
                        $filtered_results[$key] = $result;
                    }    
                }
                $customer_results = $filtered_results;

            }

            $this->set('customer_results', $customer_results);
            $this->set('contact_results', $contact_results);
            $this->set('string', $string);
        }
    }

    public function delete($cid) {
        if($this->Customer->findByCustomer_id($cid)) {
            if($this->Combination->deleteAll(array('Combination.customer_id' => $cid))) {
                if($this->Customer->delete($cid, true)) {
                    $this->Session->setFlash('Kunde erfolgreich gelöscht.', 'flash_bt_good');
                    $this->redirect('/');
                }
                else {
                    $this->Session->setFlash('Kunde konnte nicht gelöscht werden.', 'flash_bt_bad');
                    $this->redirect('/');
                }
            }
            else {
                $this->Session->setFlash('Kundenkombinationen konnten nicht gelöscht werden.', 'flash_bt_bad');
                $this->redirect('/');
            }
        }
        else {
            $this->Session->setFlash('Kunde nicht gefunden', 'flash_bt_warning');
            $this->redirect('/');
        }
    }


}
