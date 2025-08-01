<?php
App::uses('AppController', 'Controller');
/**
 * RequirementProcesses Controller
 *
 * @property RequirementProcess $RequirementProcess
 * @property PaginatorComponent $Paginator
 */
class RequirementProcessesController extends AppController
{

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
	public function index()
	{
		$this->RequirementProcess->recursive = 0;
		$this->set('requirementProcesses', $this->paginate());
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
		if (!$this->RequirementProcess->exists($id)) {
			throw new NotFoundException(__('Invalid requirement process'));
		}
		$options = array('conditions' => array('RequirementProcess.' . $this->RequirementProcess->primaryKey => $id));
		$this->set('requirementProcess', $this->RequirementProcess->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add()
	{
		if ($this->request->is('post')) {
			$this->RequirementProcess->create();
			if ($this->RequirementProcess->save($this->request->data)) {
				$this->Session->setFlash(__('The requirement process has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requirement process could not be saved. Please, try again.'), 'flash/error');
			}
		}
		$requirementProcessAreas = $this->RequirementProcess->RequirementProcessArea->find('list');
		$this->set(compact('requirementProcessAreas'));
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
		$this->RequirementProcess->id = $id;
		if (!$this->RequirementProcess->exists($id)) {
			throw new NotFoundException(__('Invalid requirement process'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RequirementProcess->save($this->request->data)) {
				$this->Session->setFlash(__('The requirement process has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requirement process could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('RequirementProcess.' . $this->RequirementProcess->primaryKey => $id));
			$this->request->data = $this->RequirementProcess->find('first', $options);
		}
		$requirementProcessAreas = $this->RequirementProcess->RequirementProcessArea->find('list');
		$this->set(compact('requirementProcessAreas'));
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
		$this->RequirementProcess->id = $id;
		if (!$this->RequirementProcess->exists()) {
			throw new NotFoundException(__('Invalid requirement process'));
		}
		if ($this->RequirementProcess->delete()) {
			$this->Session->setFlash(__('Requirement process deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Requirement process was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}

	public function beforeFilter()
	{
		// FORMA MULA DE DAR PERSMISOS A UNA VISTA
		parent::beforeFilter();
		$this->Auth->allow(
			'add',
			'index',
			'delete',
			'edit',
			'view'
		);
	}
}
