<?php
class CombinationController extends AppController {

    public $uses = array(
        'Combination',
        'Customer',
        'Type',
        'Tag',
    );
    public $helpers = array(
        'Time',
    ); 

    public function create($customer_id = null) {
        // Neue Kombination speichern
        if($this->request->is('post')) {

            $tags = explode(',', $this->request->data['Combination']['tags']);
            unset($this->request->data['Combination']['tags']);

            $tag_ids = array();

            foreach ($tags as $name) {
                // Get Tag ID if exists
                if($tag = $this->Tag->findByName($name)) {
                    array_push($tag_ids, $tag['Tag']['tag_id']);
                }
                // Create Tag and get insert ID
                else {
                    if($this->Tag->save(array('Tag' => array('name' => $name)))) {
                        array_push($tag_ids, $this->Tag->getLastInsertId());
                    }
                }

                // Resets the model
                $this->Tag->clear();
            }

            $this->request->data['Tag'] = $tag_ids;

            if($this->Combination->saveAll($this->request->data)) {
                $this->Session->setFlash('Kombination erfolgreich gespeichert.', 'flash_bt_good');
            }
            else {
                $this->Session->setFlash('Kombination konnte nicht gespeichert werden.', 'flash_bt_warning');
            }

            $this->redirect(array('controller' => 'customer', 'action' => 'view', $customer_id));
        }
        else {
            if($this->Customer->findByCustomer_id($customer_id)) {
                $this->request->data['Combination']['customer_id'] = $customer_id;

                $this->set('tags', "'".implode("','", $this->Tag->find('list'))."'");
                $this->set('types', $this->Combination->Type->find('list'));    
            }
            else {
                $this->Session->setFlash('Kunde nicht gefunden.', 'flash_bt_warning');
                $this->redirect('/');
            }
        }
    }

    public function view($cid = null) {
        if($cid) {
            $taggedby = $this->Combination->find('first', array(
                'conditions' => array(
                    'combination_id' => $cid
                ),
                'fields' => array('Combination.combination_id'),
            ));

            $assignedtags = array();

            if(isset($taggedby['Tag'])) {
                foreach ($taggedby['Tag'] as $key => $tag) {
                    array_push($assignedtags, $taggedby['Tag'][$key]['name']);
                }

                $this->set('assignedtags', $assignedtags);
            }

            $this->set('combination', $this->Combination->findByCombination_id($cid));
        }
        else {
            $this->Session->setFlash('Ungültige Kombination', 'flash_bt_warning');
            $this->redirect('/');
        }
    }

    public function edit($cid = null) {
        // Speichern
        if($this->request->is('post')) { 

            $this->request->data['Combination']['combination_id'] = $cid;

            $tags = explode(',', $this->request->data['Combination']['tags']);
            unset($this->request->data['Combination']['tags']);

            $tag_ids = array();

            foreach ($tags as $name) {
                // Get Tag ID if exists
                if($tag = $this->Tag->findByName($name)) {
                    array_push($tag_ids, $tag['Tag']['tag_id']);
                }
                // Create Tag and get insert ID
                else {
                    if($this->Tag->save(array('Tag' => array('name' => $name)))) {
                        array_push($tag_ids, $this->Tag->getLastInsertId());
                    }
                }

                // Resets the model
                $this->Tag->clear();
            }

            $this->request->data['Tag'] = $tag_ids;

            if($this->Combination->saveAll($this->request->data)) {
                $this->Session->setFlash('Kombination erfolgreich aktualisiert', 'flash_bt_good');
                $this->redirect('view/'.$cid);
            }
            else {
                $this->Session->setFlash('Kombination konnte nicht aktualisiert werden.', 'flash_bt_bad');
                $$this->redirect('edit/'.$cid);
            }
        }
        // Felder vorselektieren
        else {
            if($cid) {
                $this->set('tags', "'".implode("','", $this->Tag->find('list'))."'");

                $taggedby = $this->Combination->find('first', array(
                    'conditions' => array(
                        'combination_id' => $cid
                    ),
                    'fields' => array('Combination.combination_id'),
                ));

                $assignedtags = array();

                if(isset($taggedby['Tag'])) {
                    foreach ($taggedby['Tag'] as $key => $tag) {
                        array_push($assignedtags, $taggedby['Tag'][$key]['name']);
                    }

                    $this->set('assignedtags', $assignedtags);
                }

                $this->request->data = $this->Combination->findByCombination_id($cid);
            }
            else {
                $this->Session->setFlash('Ungültige Kombination', 'flash_bt_warning');
                $this->redirect('/');
            }
        }
    }

    public function delete($cid = null) {
        if($combination = $this->Combination->findByCombination_id($cid)) {
            if($this->Combination->deleteAll(array('combination_id' => $cid, false))) {
                $this->Session->setFlash('Kombination erfolgreich gelöscht.', 'flash_bt_good');
                $this->redirect('/customer/view/'.$combination['Customer']['customer_id']);
            }
            else {
                $this->Session->setFlash('Kombination konnte nicht gelöscht werden.', 'flash_bt_warning');
                $this->redirect('/');
            }
        }
        else {
            $this->Session->setFlash('Ungültige Kombination', 'flash_bt_warning');
            $this->redirect('/');
        }

    }    
}