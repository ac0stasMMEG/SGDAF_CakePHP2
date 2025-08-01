<?php
App::uses('AppController', 'Controller');
/**
 * RequirementTrackingTypes Controller
 *
 * @property RequirementTrackingType $RequirementTrackingType
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class RequirementTrackingTypesController extends AppController {

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
		$this->RequirementTrackingType->recursive = 0;
		$this->set('requirementTrackingTypes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RequirementTrackingType->exists($id)) {
			throw new NotFoundException(__('Invalid requirement tracking type'));
		}
		$options = array('conditions' => array('RequirementTrackingType.' . $this->RequirementTrackingType->primaryKey => $id));
		$this->set('requirementTrackingType', $this->RequirementTrackingType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RequirementTrackingType->create();
			if ($this->RequirementTrackingType->save($this->request->data)) {
				$this->Session->setFlash(__('The requirement tracking type has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requirement tracking type could not be saved. Please, try again.'), 'flash/error');
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
        $this->RequirementTrackingType->id = $id;
		if (!$this->RequirementTrackingType->exists($id)) {
			throw new NotFoundException(__('Invalid requirement tracking type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RequirementTrackingType->save($this->request->data)) {
				$this->Session->setFlash(__('The requirement tracking type has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requirement tracking type could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('RequirementTrackingType.' . $this->RequirementTrackingType->primaryKey => $id));
			$this->request->data = $this->RequirementTrackingType->find('first', $options);
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
		$this->RequirementTrackingType->id = $id;
		if (!$this->RequirementTrackingType->exists()) {
			throw new NotFoundException(__('Invalid requirement tracking type'));
		}
		if ($this->RequirementTrackingType->delete()) {
			$this->Session->setFlash(__('Requirement tracking type deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Requirement tracking type was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
