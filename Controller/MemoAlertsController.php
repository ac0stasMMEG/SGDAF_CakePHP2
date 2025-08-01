<?php
App::uses('AppController', 'Controller');
/**
 * MemoAlerts Controller
 *
 * @property MemoAlert $MemoAlert
 * @property PaginatorComponent $Paginator
 */
class MemoAlertsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->MemoAlert->recursive = 0;
		$this->set('memoAlerts', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MemoAlert->exists($id)) {
			throw new NotFoundException(__('Invalid memo alert'));
		}
		$options = array('conditions' => array('MemoAlert.' . $this->MemoAlert->primaryKey => $id));
		$this->set('memoAlert', $this->MemoAlert->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MemoAlert->create();
			if ($this->MemoAlert->save($this->request->data)) {
				$this->Session->setFlash(__('The memo alert has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The memo alert could not be saved. Please, try again.'), 'flash/error');
			}
		}
		$alertTypes = $this->MemoAlert->AlertType->find('list');
		$memos = $this->MemoAlert->Memo->find('list');
		$users = $this->MemoAlert->User->find('list');
		$this->set(compact('alertTypes', 'memos', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        $this->MemoAlert->id = $id;
		if (!$this->MemoAlert->exists($id)) {
			throw new NotFoundException(__('Invalid memo alert'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MemoAlert->save($this->request->data)) {
				$this->Session->setFlash(__('The memo alert has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The memo alert could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('MemoAlert.' . $this->MemoAlert->primaryKey => $id));
			$this->request->data = $this->MemoAlert->find('first', $options);
		}
		$alertTypes = $this->MemoAlert->AlertType->find('list');
		$memos = $this->MemoAlert->Memo->find('list');
		$users = $this->MemoAlert->User->find('list');
		$this->set(compact('alertTypes', 'memos', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->MemoAlert->id = $id;
		if (!$this->MemoAlert->exists()) {
			throw new NotFoundException(__('Invalid memo alert'));
		}
		if ($this->MemoAlert->delete()) {
			$this->Session->setFlash(__('Memo alert deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Memo alert was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
