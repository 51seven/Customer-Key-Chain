<?php
class TypeController extends AppController {

    public $uses = array(
        'Type',
    );

    public function index() {
        $this->set('types', $this->Type->find('list'));
    }

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

    public function edit($tid = null) {
        if (!$this->Type->exists($tid)) {
            throw new NotFoundException(__('Invalid Type'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Type->save($this->request->data)) {
                $this->Session->setFlash('The Type has been saved.', 'flash_bt_good');
                return $this->redirect(array('action' => 'index'));
            } 
            else {
                $this->Session->setFlash('The Type could not be saved. Please, try again.', 'flash_bt_bad');
            }
        } 
        else {
            $options = array('conditions' => array('Type.' . $this->Type->primaryKey => $tid));
            $this->request->data = $this->Type->find('first', $options);
        }
    }

    public function delete($tid = null) {
        $type = $this->Type->findByType_id($tid);

        if($type) {
            if($this->Type->delete($tid)) {
                $this->Session->setFlash('Typ erfolgreich gelöscht.', 'flash_bt_good');
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
