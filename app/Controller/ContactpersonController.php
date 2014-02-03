<?php
class ContactpersonController extends AppController {

    public $uses = array(
        'Contactperson',
    );
    public $helpers = array(
        'Time',
        'Markdown.Markdown',
    ); 

    // Es wird eine Kontaktperson zum übergebenen Kundn erstellt
    public function create($cid = null) {
		if($this->request->is('post')) {

            $this->request->data['Contactperson']['customer_id'] = $cid;

            if($this->Contactperson->save($this->request->data)) {
                $this->Session->setFlash('Kontaktperson erfolgreich erstellt.', 'flash_bt_good');
                $this->redirect(array('controller' => 'customer', 'action' => 'view/'.$cid));
            }
            else {
                $this->Session->setFlash('Fehler beim erstellen eines neuen Kunden.', 'flash_bt_bad');
            }
        }
    }

    public function edit($cpid = null) {
        if($this->Contactperson->findByContactperson_id($cpid)) {
            // Speichern
            if($this->request->is('post')) { 
                if($this->Contactperson->save($this->request->data)) {
                    $this->Session->setFlash('Kontaktperson erfolgreich aktualisiert', 'flash_bt_good');
                    $this->redirect('view/'.$cpid);
                }
                else {
                    $this->Session->setFlash('Kontaktperson konnte nicht aktualisiert werden.', 'flash_bt_bad');
                    $this->redirect('edit/'.$cpid);
                }
            }
            // Felder vorselektieren
            else {
                $this->request->data = $this->Contactperson->findByContactperson_id($cpid);
            }
        }
        else {
            $this->Session->setFlash('Ungültige Kontaktperson.', 'flash_bt_bad');
            $this->redirect('/');
        }
    }

    public function delete($cpid) {
        if($this->Contactperson->findByContactperson_id($cpid)) {
            if($this->Contactperson->delete($cpid)) {
                $this->Session->setFlash('Kontaktperson wurde erfolgreich gelöscht.', 'flash_bt_warning');
                $this->redirect('/'); 
            }   
            else {
                $this->Session->setFlash('Kontaktperson konnte nicht gelöscht werden.', 'flash_bt_warning');
                $this->redirect('/');
            }     
        }
        else {
            $this->Session->setFlash('Kontaktperson nicht gefunden.', 'flash_bt_warning');
            $this->redirect('/');
        }
    }


}




