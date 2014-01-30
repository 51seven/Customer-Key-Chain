<?php
class TypeController extends AppController {

    public $uses = array(
        'Type',
    );

    public function create() {
		if($this->request->is('post')) {
            if($this->Type->save($this->request->data)) {
                $this->Session->setFlash('Typ erfolgreich erstellt.');
                $this->redirect('/');
            }
            else {
                $this->Session->setFlash('Fehler beim erstellen des Typs.');
            }
        }
    }

    public function delete($tid) {
        $type = $this->Type->findByType_id($tid);

        if($type) {
            if($this->Type->delete($tid)) {
                $this->Session->setFlash('Type erfolgreich gelöscht.');
                $this->redirect('/');
            }
            else {
                $this->Session->setFlash('Type konnte nicht gelöscht werden.');
                $this->redirect('/');
            }
        }
        else {
            $this->Session->setFlash('Type nicht gefunden');
            $this->redirect('/');
        }
    }


}
