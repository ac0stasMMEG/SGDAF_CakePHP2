<?php
App::uses('AppController', 'Controller');
/**
 * RequirementAttachments Controller
 *
 * @property RequirementAttachment $RequirementAttachment
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class RequirementAttachmentsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->RequirementAttachment->recursive = 0;
		$this->set('requirementAttachments', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RequirementAttachment->exists($id)) {
			throw new NotFoundException(__('Invalid requirement attachment'));
		}
		$options = array('conditions' => array('RequirementAttachment.' . $this->RequirementAttachment->primaryKey => $id));
		$this->set('requirementAttachment', $this->RequirementAttachment->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RequirementAttachment->create();
			if ($this->RequirementAttachment->save($this->request->data)) {
				$this->Session->setFlash(__('The requirement attachment has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requirement attachment could not be saved. Please, try again.'), 'flash/error');
			}
		}
		$requiremetAttachmentTypes = $this->RequirementAttachment->RequiremetAttachmentType->find('list');
		$this->set(compact('requiremetAttachmentTypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        $this->RequirementAttachment->id = $id;
		if (!$this->RequirementAttachment->exists($id)) {
			throw new NotFoundException(__('Invalid requirement attachment'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RequirementAttachment->save($this->request->data)) {
				$this->Session->setFlash(__('The requirement attachment has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requirement attachment could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('RequirementAttachment.' . $this->RequirementAttachment->primaryKey => $id));
			$this->request->data = $this->RequirementAttachment->find('first', $options);
		}
		$requiremetAttachmentTypes = $this->RequirementAttachment->RequiremetAttachmentType->find('list');
		$this->set(compact('requiremetAttachmentTypes'));
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
		$this->RequirementAttachment->id = $id;
		if (!$this->RequirementAttachment->exists()) {
			throw new NotFoundException(__('Invalid requirement attachment'));
		}
		if ($this->RequirementAttachment->delete()) {
			$this->Session->setFlash(__('Requirement attachment deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Requirement attachment was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
