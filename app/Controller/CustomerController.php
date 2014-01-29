<?php
class CustomerController extends AppController {

    public $uses = array(
        'Customer',
        'Combination'
    );
    public $helpers = array(
        'Time',
    ); 

    public function index() {
    	$this->set('customers', $this->Customer->find('all', array('order' => 'Customer.name ASC')));
    }

    public function view($cid = null) {
    	$customer = $this->Customer->findByCustomer_id($cid);

    	if(!$customer) {
    		$this->Session->setFLash('Kunde wurde nicht gefudnen.');
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
                $this->Session->setFlash('Kunde erfolgreich erstellt.');
                $this->redirect(array('controller' => 'customer', 'action' => 'view/'.$this->Customer->getLastInsertId()));
            }
            else {
                $this->Session->setFlash('Fehler beim erstellen eines neuen Kunden.');
            }
        }
    }

    public function search() {

        if(isset($this->request->query['string'])) {
            $string = $this->request->query['string'];
        }
        else {
            $this->Session->setFlash('Kein Suchstring vorhanden.');
            $this->redirect('index');
        }

        if(strlen($string) < 3) {
            $this->Session->setFlash('Suche muss mindestens 3 Buchstaben enthalten.');
            $this->redirect('index');
        }
        else {
            $this->set('results', $this->Customer->find('all', array(
                'conditions' => array('Customer.name LIKE' => '%'.$string.'%')
            )));
            $this->set('string', $string);
        }
    }


}
