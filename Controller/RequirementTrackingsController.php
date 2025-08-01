<?php
App::uses('AppController', 'Controller');
/**
 * RequirementTrackings Controller
 *
 * @property RequirementTracking $RequirementTracking
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class RequirementTrackingsController extends AppController
{

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
	public function index()
	{
		$this->RequirementTracking->recursive = 0;
		$this->set('requirementTrackings', $this->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null)
	{
		if (!$this->RequirementTracking->exists($id)) {
			throw new NotFoundException(__('Invalid requirement tracking'));
		}
		$options = array('conditions' => array('RequirementTracking.' . $this->RequirementTracking->primaryKey => $id));
		$this->set('requirementTracking', $this->RequirementTracking->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add()
	{
		if ($this->request->is('post')) {
			$this->RequirementTracking->create();
			if ($this->RequirementTracking->save($this->request->data)) {
				$this->Session->setFlash(__('The requirement tracking has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requirement tracking could not be saved. Please, try again.'), 'flash/error');
			}
		}
		$requirements = $this->RequirementTracking->Requirement->find('list');
		$requirementTrackingTypes = $this->RequirementTracking->RequirementTrackingType->find('list');
		$milestones = $this->RequirementTracking->Milestone->find('list');
		$this->set(compact('requirements', 'requirementTrackingTypes', 'milestones'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null)
	{
		$this->RequirementTracking->id = $id;
		if (!$this->RequirementTracking->exists($id)) {
			throw new NotFoundException(__('Invalid requirement tracking'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RequirementTracking->save($this->request->data)) {
				$this->Session->setFlash(__('The requirement tracking has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requirement tracking could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('RequirementTracking.' . $this->RequirementTracking->primaryKey => $id));
			$this->request->data = $this->RequirementTracking->find('first', $options);
		}
		$requirements = $this->RequirementTracking->Requirement->find('list');
		$requirementTrackingTypes = $this->RequirementTracking->RequirementTrackingType->find('list');
		$milestones = $this->RequirementTracking->Milestone->find('list');
		$this->set(compact('requirements', 'requirementTrackingTypes', 'milestones'));
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @throws MethodNotAllowedException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null)
	{
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->RequirementTracking->id = $id;
		if (!$this->RequirementTracking->exists()) {
			throw new NotFoundException(__('Invalid requirement tracking'));
		}
		if ($this->RequirementTracking->delete()) {
			$this->Session->setFlash(__('Requirement tracking deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Requirement tracking was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
