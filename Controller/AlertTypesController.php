<?php
App::uses('AppController', 'Controller');
/**
 * AlertTypes Controller
 *
 * @property AlertType $AlertType
 * @property PaginatorComponent $Paginator
 */
class AlertTypesController extends AppController {

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
		$this->AlertType->recursive = 0;
		$this->set('alertTypes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AlertType->exists($id)) {
			throw new NotFoundException(__('Invalid alert type'));
		}
		$options = array('conditions' => array('AlertType.' . $this->AlertType->primaryKey => $id));
		$this->set('alertType', $this->AlertType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AlertType->create();
			if ($this->AlertType->save($this->request->data)) {
				$this->Session->setFlash(__('The alert type has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The alert type could not be saved. Please, try again.'), 'flash/error');
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
        $this->AlertType->id = $id;
		if (!$this->AlertType->exists($id)) {
			throw new NotFoundException(__('Invalid alert type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AlertType->save($this->request->data)) {
				$this->Session->setFlash(__('The alert type has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The alert type could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('AlertType.' . $this->AlertType->primaryKey => $id));
			$this->request->data = $this->AlertType->find('first', $options);
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
		$this->AlertType->id = $id;
		if (!$this->AlertType->exists()) {
			throw new NotFoundException(__('Invalid alert type'));
		}
		if ($this->AlertType->delete()) {
			$this->Session->setFlash(__('Alert type deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Alert type was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
