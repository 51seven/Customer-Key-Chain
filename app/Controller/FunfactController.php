<?php
App::uses('AppController', 'Controller');
/**
 * Funfacts Controller
 *
 * @property Funfact $Funfact
 * @property PaginatorComponent $Paginator
 */
class FunfactController extends AppController {

/**
 * add method
 *
 * @return void
 */
	public function create($cid) {
		if ($this->request->is('post')) {
			$this->Funfact->create();
			if ($this->Funfact->save($this->request->data)) {
				$this->Session->setFlash('The funfact has been saved.', 'flash_bt_good');
				return $this->redirect(array('controller' => 'customer', 'action' => 'view', $cid));
			} 
			else {
				$this->Session->setFlash('The funfact could not be saved. Please, try again.', 'flash_bt_good');
			}
		}
		else {
			$this->request->data['Funfact']['customer_id'] = $cid;
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Funfact->exists($id)) {
			throw new NotFoundException(__('Invalid funfact'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Funfact->save($this->request->data)) {
				$this->Session->setFlash('The funfact has been saved.', 'flash_bt_good');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The funfact could not be saved. Please, try again.', 'flash_bt_bad');
			}
		} else {
			$options = array('conditions' => array('Funfact.' . $this->Funfact->primaryKey => $id));
			$this->request->data = $this->Funfact->find('first', $options);
		}
		$customers = $this->Funfact->Customer->find('list');
		$this->set(compact('customers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Funfact->id = $id;
		if (!$this->Funfact->exists()) {
			throw new NotFoundException(__('Invalid funfact'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Funfact->delete()) {
			$this->Session->setFlash(__('The funfact has been deleted.'));
		} else {
			$this->Session->setFlash(__('The funfact could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}




}