<?php
App::uses('AppController', 'Controller');
/**
 * AttachmentTypes Controller
 *
 * @property AttachmentType $AttachmentType
 * @property PaginatorComponent $Paginator
 */
class AttachmentTypesController extends AppController {

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
		$this->AttachmentType->recursive = 0;
		$this->set('attachmentTypes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AttachmentType->exists($id)) {
			throw new NotFoundException(__('Invalid attachment type'));
		}
		$options = array('conditions' => array('AttachmentType.' . $this->AttachmentType->primaryKey => $id));
		$this->set('attachmentType', $this->AttachmentType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AttachmentType->create();
			if ($this->AttachmentType->save($this->request->data)) {
				$this->Session->setFlash(__('The attachment type has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attachment type could not be saved. Please, try again.'), 'flash/error');
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
        $this->AttachmentType->id = $id;
		if (!$this->AttachmentType->exists($id)) {
			throw new NotFoundException(__('Invalid attachment type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AttachmentType->save($this->request->data)) {
				$this->Session->setFlash(__('The attachment type has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attachment type could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('AttachmentType.' . $this->AttachmentType->primaryKey => $id));
			$this->request->data = $this->AttachmentType->find('first', $options);
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
		$this->AttachmentType->id = $id;
		if (!$this->AttachmentType->exists()) {
			throw new NotFoundException(__('Invalid attachment type'));
		}
		if ($this->AttachmentType->delete()) {
			$this->Session->setFlash(__('Attachment type deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Attachment type was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
