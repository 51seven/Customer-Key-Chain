<?php
class CombinationController extends AppController {

    public $uses = array(
        'Combination',
        'Customer',
        'Type',
    );
    public $helpers = array(
        'Time',
    ); 

    public function create() {
        // Neue Kombination speichern
        if($this->request->is('post')) {

            if($this->Combination->save($this->request->data)) {
                $this->Session->setFlash('Kombination erfolgreich gespeichert.');
                $this->redirect(array('controller' => 'combination', 'action' => 'view/'.$this->Combination->getLastInsertId()));
            }
            else {
                $this->Session->setFlash('Fehler beim speichern der Kombination.');
            }
        }
        else {
            $this->set('customers', $this->Combination->Customer->find('list'));
            $this->set('types', $this->Combination->Type->find('list'));
        }
    }

    public function view($cid = null) {
        if($cid) {
            $this->set('combination', $this->Combination->findByCombination_id($cid));
        }
        else {
            $this->Session->setFlash('Ungültige Kombination');
            $this->redirect('/');
        }
    }

    public function edit($cid = null) {
        // Speichern
        if($this->request->is('post')) { 
            $this->request->data['Combination']['combination_id'] = $cid;

            if($this->Combination->save($this->request->data)) {
                $this->Session->setFlash('Kombination erfolgreich aktualisiert');
                $this->redirect('view/'.$cid);
            }
            else {
                $this->Session->setFlash('Kombination konnte nicht aktualisiert werden.');
                $$this->redirect('edit/'.$cid);
            }
        }
        // Felder vorselektieren
        else {
            if($cid) {
                $this->request->data = $this->Combination->findByCombination_id($cid);
            }
            else {
                $this->Session->setFlash('Ungültige Kombination');
                $this->redirect('/');
            }
        }


    }

    public function delete($cid = null) {
        $combination = $this->Combination->findByCombination_id($cid);

        if($combination) {
            if($this->Combination->delete($cid)) {
                $this->Session->setFlash('Kombination erfolgreich gelöscht.');
                $this->redirect('/customer/view/'.$combination['Customer']['customer_id']);
            }
            else {
                $this->Session->setFlash('Kombination konnte nicht gelöscht werden.');
                $this->redirect('/');
            }
        }
        else {
            $this->Session->setFlash('Ungültige Kombination');
            $this->redirect('/');
        }

    }





    
}