<?php
App::uses('AppController', 'Controller');
/**
 * MemoTypes Controller
 *
 * @property MemoType $MemoType
 * @property PaginatorComponent $Paginator
 */
class MemoTypesController extends AppController {

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
		$this->MemoType->recursive = 0;
		$this->set('memoTypes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MemoType->exists($id)) {
			throw new NotFoundException(__('Invalid memo type'));
		}
		$options = array('conditions' => array('MemoType.' . $this->MemoType->primaryKey => $id));
		$this->set('memoType', $this->MemoType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MemoType->create();
			if ($this->MemoType->save($this->request->data)) {
				$this->Session->setFlash(__('The memo type has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The memo type could not be saved. Please, try again.'), 'flash/error');
			}
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
        $this->MemoType->id = $id;
		if (!$this->MemoType->exists($id)) {
			throw new NotFoundException(__('Invalid memo type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MemoType->save($this->request->data)) {
				$this->Session->setFlash(__('The memo type has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The memo type could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('MemoType.' . $this->MemoType->primaryKey => $id));
			$this->request->data = $this->MemoType->find('first', $options);
		}
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
		$this->MemoType->id = $id;
		if (!$this->MemoType->exists()) {
			throw new NotFoundException(__('Invalid memo type'));
		}
		if ($this->MemoType->delete()) {
			$this->Session->setFlash(__('Memo type deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Memo type was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
