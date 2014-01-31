<?php
class CustomerController extends AppController {

    public $uses = array(
        'Customer',
        'Combination',
    );
    public $helpers = array(
        'Time',
    ); 

    public function index() {
    	//$this->set('customers', $this->Customer->find('list', array('order' => 'Customer.name ASC')));
    }

    public function view($cid = null) {
    	$customer = $this->Customer->findByCustomer_id($cid);

    	if(!$customer) {
    		$this->Session->setFLash('Kunde wurde nicht gefunden.', 'flash_bt_warning');
    		$this->render('index');
    	}
    	else {
    		$combinations = $this->Combination->findAllByCustomer_id($cid);
    		$this->set('combinations', $combinations);
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
            $this->set('results', $this->Customer->find('all', array(
                'conditions' => array('Customer.name LIKE' => '%'.$string.'%')
            )));
            $this->set('string', $string);
        }
    }

    public function delete($cid) {
        $customer = $this->Customer->findByCustomer_id($cid);

        if($customer) {
            if($this->Customer->delete($cid)) {
                $this->Session->setFlash('Kunde erfolgreich gelöscht.', 'flash_bt_good');
                $this->redirect('/');
            }
            else {
                $this->Session->setFlash('Kunde konnte nicht gelöscht werden.', 'flash_bt_bad');
                $this->redirect('/');
            }
        }
        else {
            $this->Session->setFlash('Kunde nicht gefunden', 'flash_bt_warning');
            $this->redirect('/');
        }
    }


}
