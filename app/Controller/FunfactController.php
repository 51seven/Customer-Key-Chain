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
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Funfact->recursive = 0;
		$this->set('funfacts', $this->Funfact->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Funfact->exists($id)) {
			throw new NotFoundException(__('Invalid funfact'));
		}
		$options = array('conditions' => array('Funfact.' . $this->Funfact->primaryKey => $id));
		$this->set('funfact', $this->Funfact->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Funfact->create();
			if ($this->Funfact->save($this->request->data)) {
				$this->Session->setFlash(__('The funfact has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The funfact could not be saved. Please, try again.'));
			}
		}
		$customers = $this->Funfact->Customer->find('list');
		$this->set(compact('customers'));
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
				$this->Session->setFlash(__('The funfact has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The funfact could not be saved. Please, try again.'));
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

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Funfact->recursive = 0;
		$this->set('funfacts', $this->Funfact->find('all'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Funfact->exists($id)) {
			throw new NotFoundException(__('Invalid funfact'));
		}
		$options = array('conditions' => array('Funfact.' . $this->Funfact->primaryKey => $id));
		$this->set('funfact', $this->Funfact->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Funfact->create();
			if ($this->Funfact->save($this->request->data)) {
				$this->Session->setFlash(__('The funfact has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The funfact could not be saved. Please, try again.'));
			}
		}
		$customers = $this->Funfact->Customer->find('list');
		$this->set(compact('customers'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Funfact->exists($id)) {
			throw new NotFoundException(__('Invalid funfact'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Funfact->save($this->request->data)) {
				$this->Session->setFlash(__('The funfact has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The funfact could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Funfact.' . $this->Funfact->primaryKey => $id));
			$this->request->data = $this->Funfact->find('first', $options);
		}
		$customers = $this->Funfact->Customer->find('list');
		$this->set(compact('customers'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
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
	}}
