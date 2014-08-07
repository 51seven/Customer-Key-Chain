<?php
class TagController extends AppController {

// FUCKING GIT
    public $uses = array(
        'Tag',
    );

    public function index() {
        $this->set('tags', $this->Tag->find('list'));
    }

    public function create() {

		if($this->request->is('post')) {
            if($this->Tag->save($this->request->data)) {
                $this->Session->setFlash('Tag erfolgreich erstellt.', 'flash_bt_good');
            }
            else {
                $this->Session->setFlash('Fehler beim erstellen des Tags.', 'flash_bt_bad');
            }
        }
    }

    public function edit($tid = null) {
        if (!$this->Tag->exists($tid)) {
            throw new NotFoundException(__('Invalid Tag'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Tag->save($this->request->data)) {
                $this->Session->setFlash('The Tag has been saved.', 'flash_bt_good');
                return $this->redirect(array('action' => 'index'));
            } 
            else {
                $this->Session->setFlash('The Tag could not be saved. Please, try again.', 'flash_bt_bad');
            }
        } 
        else {
            $options = array('conditions' => array('tag.' . $this->Tag->primaryKey => $tid));
            $this->request->data = $this->Tag->find('first', $options);
        }
    }

    public function delete($tid = null) {
        $tag = $this->Tag->findByTag_id($tid);

        if($tag) {
            if($this->Tag->delete($tid)) {
                $this->Session->setFlash('Tag erfolgreich gelöscht.', 'flash_bt_good');
                $this->redirect('/');
            }
            else {
                $this->Session->setFlash('Tag konnte nicht gelöscht werden.', 'flash_bt_bad');
                $this->redirect('/');
            }
        }
        else {
            $this->Session->setFlash('Tag nicht gefunden', 'flash_bt_warning');
            $this->redirect('/');
        }
    }


}
