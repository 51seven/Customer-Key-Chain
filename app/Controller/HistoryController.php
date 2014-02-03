<?php
class HistoryController extends AppController {

    public $uses = array(
        'History',
    );
    public $helpers = array(
        'Time',
        'Markdown.Markdown',
    ); 

    // Es wird ein neuer History-Eintrag zum übergebenen Kunden erstellt
    public function create($cid = null) {
		if($this->request->is('post')) {
            $this->request->data['History']['customer_id'] = $cid;

            if($this->History->save($this->request->data)) {
                $this->Session->setFlash('Eintrag erfolgreich erstellt.', 'flash_bt_good');
                $this->redirect(array('controller' => 'customer', 'action' => 'view/'.$cid));
            }
            else {
                $this->Session->setFlash('Fehler beim erstellen des Eintrags.', 'flash_bt_bad');
            }
        }
    }

    public function edit($hid = null) {
        if($this->History->findByHistory_id($hid)) {
            // Speichern
            if($this->request->is('post')) { 
                if($this->History->save($this->request->data)) {
                    $this->Session->setFlash('Eintrag wurde erfolgreich aktualisiert', 'flash_bt_good');
                    $this->redirect('view/'.$hid);
                }
                else {
                    $this->Session->setFlash('Eintrag konnte nicht aktualisiert werden.', 'flash_bt_bad');
                    $this->redirect('edit/'.$hid);
                }
            }
            // Felder vorselektieren
            else {
                $this->request->data = $this->History->findByHistory_id($hid);
            }
        }
        else {
            $this->Session->setFlash('Ungültiger Eintrag', 'flash_bt_warning');
            $this->redirect('/');
        }
    }

    public function delete($hid) {
        if($this->History->findByHistory_id($hid)) {
            if($this->History->delete($hid)) {
                $this->Session->setFlash('Eintrag wurde erfolgreich gelöscht.', 'flash_bt_warning');
                $this->redirect('/'); 
            }   
            else {
                $this->Session->setFlash('Eintrag konnte nicht gelöscht werden.', 'flash_bt_warning');
                $this->redirect('/');
            }     
        }
        else {
            $this->Session->setFlash('Eintrag wurde nicht gefunden.', 'flash_bt_warning');
            $this->redirect('/');
        }
    }


}




