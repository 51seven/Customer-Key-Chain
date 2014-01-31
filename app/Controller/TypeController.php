<?php
class TypeController extends AppController {

    public $uses = array(
        'Type',
    );

    public function create() {
		if($this->request->is('post')) {
            if($this->Type->save($this->request->data)) {
                $this->Session->setFlash('Typ erfolgreich erstellt.', 'flash_bt_good');
                $this->redirect('/');
            }
            else {
                $this->Session->setFlash('Fehler beim erstellen des Typs.', 'flash_bt_bad');
            }
        }
    }

    public function delete($tid) {
        $type = $this->Type->findByType_id($tid);

        if($type) {
            if($this->Type->delete($tid)) {
                $this->Session->setFlash('Typ erfolgreich gelöscht.', 'flash_bt_info');
                $this->redirect('/');
            }
            else {
                $this->Session->setFlash('Typ konnte nicht gelöscht werden.', 'flash_bt_bad');
                $this->redirect('/');
            }
        }
        else {
            $this->Session->setFlash('Typ nicht gefunden', 'flash_bt_warning');
            $this->redirect('/');
        }
    }


}
