<?php
App::uses('AppController', 'Controller');
/**
 * RequirementProcessAreas Controller
 *
 * @property RequirementProcessArea $RequirementProcessArea
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class RequirementProcessAreasController extends AppController
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
		$this->RequirementProcessArea->recursive = 0;
		$this->set('requirementProcessAreas', $this->paginate());
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
		if (!$this->RequirementProcessArea->exists($id)) {
			throw new NotFoundException(__('Invalid requirement process area'));
		}
		$options = array('conditions' => array('RequirementProcessArea.' . $this->RequirementProcessArea->primaryKey => $id));
		$this->set('requirementProcessArea', $this->RequirementProcessArea->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add()
	{
		if ($this->request->is('post')) {
			$this->RequirementProcessArea->create();
			if ($this->RequirementProcessArea->save($this->request->data)) {
				$this->Session->setFlash(__('The requirement process area has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requirement process area could not be saved. Please, try again.'), 'flash/error');
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
	public function edit($id = null)
	{
		$this->RequirementProcessArea->id = $id;
		if (!$this->RequirementProcessArea->exists($id)) {
			throw new NotFoundException(__('Invalid requirement process area'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RequirementProcessArea->save($this->request->data)) {
				$this->Session->setFlash(__('The requirement process area has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requirement process area could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('RequirementProcessArea.' . $this->RequirementProcessArea->primaryKey => $id));
			$this->request->data = $this->RequirementProcessArea->find('first', $options);
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
	public function delete($id = null)
	{
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->RequirementProcessArea->id = $id;
		if (!$this->RequirementProcessArea->exists()) {
			throw new NotFoundException(__('Invalid requirement process area'));
		}
		if ($this->RequirementProcessArea->delete()) {
			$this->Session->setFlash(__('Requirement process area deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Requirement process area was not deleted'), 'flash/error');
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
