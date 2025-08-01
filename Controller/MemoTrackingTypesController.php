<?php
App::uses('AppController', 'Controller');
/**
 * MemoTrackingTypes Controller
 *
 * @property MemoTrackingType $MemoTrackingType
 * @property PaginatorComponent $Paginator
 */
class MemoTrackingTypesController extends AppController {

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
		$this->MemoTrackingType->recursive = 0;
		$this->set('memoTrackingTypes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MemoTrackingType->exists($id)) {
			throw new NotFoundException(__('Invalid memo tracking type'));
		}
		$options = array('conditions' => array('MemoTrackingType.' . $this->MemoTrackingType->primaryKey => $id));
		$this->set('memoTrackingType', $this->MemoTrackingType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MemoTrackingType->create();
			if ($this->MemoTrackingType->save($this->request->data)) {
				$this->Session->setFlash(__('The memo tracking type has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The memo tracking type could not be saved. Please, try again.'), 'flash/error');
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
        $this->MemoTrackingType->id = $id;
		if (!$this->MemoTrackingType->exists($id)) {
			throw new NotFoundException(__('Invalid memo tracking type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MemoTrackingType->save($this->request->data)) {
				$this->Session->setFlash(__('The memo tracking type has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The memo tracking type could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('MemoTrackingType.' . $this->MemoTrackingType->primaryKey => $id));
			$this->request->data = $this->MemoTrackingType->find('first', $options);
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
		$this->MemoTrackingType->id = $id;
		if (!$this->MemoTrackingType->exists()) {
			throw new NotFoundException(__('Invalid memo tracking type'));
		}
		if ($this->MemoTrackingType->delete()) {
			$this->Session->setFlash(__('Memo tracking type deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Memo tracking type was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
