<?php
class CustomerController extends AppController {

    public $uses = array(
        'Customer',
        'Combination',
    );
    public $helpers = array(
        'Time',
    ); 

    public function checkPermission() {
        if(!$this->Auth->user('isadmin')) {
            // nur erlaubte Kunden anzeigen
            $permissions = $this->Permission->find('list', array(
                'conditions' => array('user_id' => $this->Auth->user('user_id')),
                'fields' => 'customer_id'
            ));

            if($this->action == 'view') {
                if(in_array($this->request->pass[0], $permissions)) {
                    return true;
                }
                else {
                   throw new MethodNotAllowedException('You dont have permission to see this Customer.'); 
                }
            }
            else if($this->action == 'search' OR $this->action == 'index') {
                return true;
            }
            else {
                throw new MethodNotAllowedException('Insufficient permissions.');
            }
        }
    }

    public function index() {
        $this->set('user', $this->Auth->user());
    }

    public function view($cid = null) {
    	$customer = $this->Customer->findByCustomer_id($cid);

    	if(!$customer) {
    		$this->Session->setFlash('Kunde wurde nicht gefunden.', 'flash_bt_warning');
    		$this->render('index');
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
            $results = $this->Customer->find('list', array(
                'conditions' => array('Customer.name LIKE' => '%'.$string.'%'),
            ));

            // Suchergebnisse filtern
            if(!$this->Auth->user('isadmin')) {
                $permissions = $this->Permission->find('list', array(
                    'conditions' => array('user_id' => $this->Auth->user('user_id')),
                    'fields' => 'customer_id'
                ));   

                $filtered_results = array();

                foreach ($results as $key => $result) {
                    if(in_array($key, $permissions)) {
                        $filtered_results[$key] = $result;
                    }    
                }

                $results = $filtered_results;
            }

            $this->set('results', $results);
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
