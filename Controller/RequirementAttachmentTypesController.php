<?php
App::uses('AppController', 'Controller');
/**
 * RequirementAttachmentTypes Controller
 *
 * @property RequirementAttachmentType $RequirementAttachmentType
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class RequirementAttachmentTypesController extends AppController {

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
		$this->RequirementAttachmentType->recursive = 0;
		$this->set('requirementAttachmentTypes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RequirementAttachmentType->exists($id)) {
			throw new NotFoundException(__('Invalid requirement attachment type'));
		}
		$options = array('conditions' => array('RequirementAttachmentType.' . $this->RequirementAttachmentType->primaryKey => $id));
		$this->set('requirementAttachmentType', $this->RequirementAttachmentType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RequirementAttachmentType->create();
			if ($this->RequirementAttachmentType->save($this->request->data)) {
				$this->Session->setFlash(__('The requirement attachment type has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requirement attachment type could not be saved. Please, try again.'), 'flash/error');
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
        $this->RequirementAttachmentType->id = $id;
		if (!$this->RequirementAttachmentType->exists($id)) {
			throw new NotFoundException(__('Invalid requirement attachment type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RequirementAttachmentType->save($this->request->data)) {
				$this->Session->setFlash(__('The requirement attachment type has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requirement attachment type could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('RequirementAttachmentType.' . $this->RequirementAttachmentType->primaryKey => $id));
			$this->request->data = $this->RequirementAttachmentType->find('first', $options);
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
		$this->RequirementAttachmentType->id = $id;
		if (!$this->RequirementAttachmentType->exists()) {
			throw new NotFoundException(__('Invalid requirement attachment type'));
		}
		if ($this->RequirementAttachmentType->delete()) {
			$this->Session->setFlash(__('Requirement attachment type deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Requirement attachment type was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
