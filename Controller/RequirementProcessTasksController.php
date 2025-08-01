<?php
App::uses('AppController', 'Controller');
/**
 * RequirementProcessTasks Controller
 *
 * @property RequirementProcessTask $RequirementProcessTask
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class RequirementProcessTasksController extends AppController
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
		#$this->theme = 'Login2';
		$this->RequirementProcessTask->recursive = 0;
		$this->set('requirementProcessTasks', $this->paginate());
		#debug();
		#exit;
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
		if (!$this->RequirementProcessTask->exists($id)) {
			throw new NotFoundException(__('Invalid requirement process task'));
		}
		$options = array('conditions' => array('RequirementProcessTask.' . $this->RequirementProcessTask->primaryKey => $id));
		$this->set('requirementProcessTask', $this->RequirementProcessTask->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add()
	{
		if ($this->request->is('post')) {
			$this->RequirementProcessTask->create();
			if ($this->RequirementProcessTask->save($this->request->data)) {
				$this->Session->setFlash(__('The requirement process task has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requirement process task could not be saved. Please, try again.'), 'flash/error');
			}
		}
		$requirementProcesses = $this->RequirementProcessTask->RequirementProcess->find('list');
		$requirementProcessAreas = $this->RequirementProcessTask->RequirementProcessArea->find('list');
		$this->set(compact('requirementProcesses', 'requirementProcessAreas'));
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
	
		$this->RequirementProcessTask->id = $id;
		if (!$this->RequirementProcessTask->exists($id)) {
			throw new NotFoundException(__('Invalid requirement process task'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RequirementProcessTask->save($this->request->data)) {
				$this->Session->setFlash(__('The requirement process task has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requirement process task could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('RequirementProcessTask.' . $this->RequirementProcessTask->primaryKey => $id));
			$this->request->data = $this->RequirementProcessTask->find('first', $options);
		}

		#debug( $this->request->data );
		#exit;

		$requirementProcesses = $this->RequirementProcessTask->RequirementProcess->find('list');
		$requirementProcessAreas = $this->RequirementProcessTask->RequirementProcessArea->find('list');
		$this->set(compact('requirementProcesses', 'requirementProcessAreas'));
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
		$this->RequirementProcessTask->id = $id;
		if (!$this->RequirementProcessTask->exists()) {
			throw new NotFoundException(__('Invalid requirement process task'));
		}
		if ($this->RequirementProcessTask->delete()) {
			$this->Session->setFlash(__('Requirement process task deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Requirement process task was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}

	public function beforeFilter()
	{
		// FORMA MULA DE DAR PERSMISOS A UNA VISTA
		parent::beforeFilter();
		$this->Auth->allow(
			'add',
			'index',
			'edit',
			'view'
		);
	}
}
