<?php
class HistoryController extends AppController {

    public $uses = array(
        'History',
        'Customer',
    );
    public $helpers = array(
        'Time',
        'Markdown.Markdown',
    ); 

    // Es wird ein neuer History-Eintrag zum übergebenen Kunden erstellt
    public function create($cid = null) {
		if($this->request->is('post')) {
            $this->request->data['History']['customer_id'] = $cid;
            $this->request->data['History']['user_id'] = $this->Auth->user('user_id');
            $this->request->data['History']['updated'] = "";

            if($this->History->save($this->request->data)) {
                $this->Session->setFlash('Eintrag erfolgreich erstellt.', 'flash_bt_good');
                $this->redirect(array('controller' => 'history', 'action' => 'listall', $cid));
            }
            else {
                $this->Session->setFlash('Fehler beim erstellen des Eintrags.', 'flash_bt_bad');
            }
        }
    }

     /**
    * Listet alle historischen Ereignisse zu einem Kunden auf
    * @param customer_id
    */
    public function listall($cid = null) {   
        if(!$this->Customer->findByCustomer_id($cid)) {
            $this->Session->setFlash('Kunde wurde nicht gefunden.', 'flash_bt_warning');
            $this->redirect('index');
        }

        $history = $this->History->findAllByCustomer_id($cid, array(), array('History.time' => 'DESC'));

        if($history) {
            $fade = -1;
            
            if(isset($this->request->query['fade'])) {
                $fade = $this->request->query['fade'];
            }

            $this->set('history', $history);
            $this->set('fade', $fade);
            $this->render('listall');
        }
        else {
            $this->Session->setFlash('Der Kunde hat noch keine History. Du kannst jetzt einen erstellen. ', 'flash_bt_warning', array(
                'link_text' => 'Zurück zum Kunden',
                'link_url' => array('controller' => 'customer', 'action' => 'view', $cid)                
            ));
            $this->redirect(array('controller' => 'history', 'action' => 'create', $cid));
        }
    }

    public function edit($hid = null) {
        if($this->History->findByHistory_id($hid)) {
            // Speichern
            if($this->request->is('post')) { 
                $this->request->data['History']['updated'] = "Geändert am ".date('d.m.y')." von ".$this->Auth->user('username').".";

                if($this->History->save($this->request->data)) {
                    $this->Session->setFlash('Eintrag wurde erfolgreich aktualisiert', 'flash_bt_good');
                    $this->redirect(array(
                        'controller' => 'customer', 
                        'action' => 'History', 
                        $this->request->data['History']['customer_id'],
                        '?' => array('fade' => $hid),
                    ));
                }
                else {
                    $this->Session->setFlash('Eintrag konnte nicht aktualisiert werden.', 'flash_bt_bad');
                    $this->redirect('edit/'.$hid);
                }
            }
            // Felder vorselektieren
            else {
                $this->request->data = $this->History->findByHistory_id($hid);
                $this->set('history_id', $this->request->data['History']['history_id']);
            }
        }
        else {
            $this->Session->setFlash('Ungültiger Eintrag', 'flash_bt_warning');
            $this->redirect('/');
        }
    }

    public function delete($hid) {
        $history = $this->History->findByHistory_id($hid);

        if($history) {
            if($this->History->delete($hid)) {
                $this->Session->setFlash('Eintrag wurde erfolgreich gelöscht.', 'flash_bt_warning');
                $this->redirect(array('controller' => 'customer', 'action' => 'history', $history['History']['customer_id']));
            }   
            else {
                $this->Session->setFlash('Eintrag konnte nicht gelöscht werden.', 'flash_bt_warning');
            }     
        }
        else {
            $this->Session->setFlash('Eintrag wurde nicht gefunden.', 'flash_bt_warning');
            $this->redirect('/');
        }
    }


}




