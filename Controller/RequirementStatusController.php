<?php
App::uses('AppController', 'Controller');
/**
 * RequirementStatus Controller
 *
 * @property RequirementStatus $RequirementStatus
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class RequirementStatusController extends AppController
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
		$this->RequirementStatus->recursive = 0;
		$this->set('requirementStatus', $this->paginate());
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
		if (!$this->RequirementStatus->exists($id)) {
			throw new NotFoundException(__('Invalid requirement status'));
		}
		$options = array('conditions' => array('RequirementStatus.' . $this->RequirementStatus->primaryKey => $id));
		$this->set('requirementStatus', $this->RequirementStatus->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add()
	{
		if ($this->request->is('post')) {
			$this->RequirementStatus->create();
			if ($this->RequirementStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The requirement status has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requirement status could not be saved. Please, try again.'), 'flash/error');
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
		$this->RequirementStatus->id = $id;
		if (!$this->RequirementStatus->exists($id)) {
			throw new NotFoundException(__('Invalid requirement status'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RequirementStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The requirement status has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requirement status could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('RequirementStatus.' . $this->RequirementStatus->primaryKey => $id));
			$this->request->data = $this->RequirementStatus->find('first', $options);
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
		$this->RequirementStatus->id = $id;
		if (!$this->RequirementStatus->exists()) {
			throw new NotFoundException(__('Invalid requirement status'));
		}
		if ($this->RequirementStatus->delete()) {
			$this->Session->setFlash(__('Requirement status deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Requirement status was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
	/**
	 * n_index method
	 *
	 * @return void
	 */
	public function n_index()
	{
		$this->RequirementStatus->recursive = 0;
		$this->set('requirementStatus', $this->paginate());
	}

	/**
	 * n_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function n_view($id = null)
	{
		if (!$this->RequirementStatus->exists($id)) {
			throw new NotFoundException(__('Invalid requirement status'));
		}
		$options = array('conditions' => array('RequirementStatus.' . $this->RequirementStatus->primaryKey => $id));
		$this->set('requirementStatus', $this->RequirementStatus->find('first', $options));
	}

	/**
	 * n_add method
	 *
	 * @return void
	 */
	public function n_add()
	{
		if ($this->request->is('post')) {
			$this->RequirementStatus->create();
			if ($this->RequirementStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The requirement status has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requirement status could not be saved. Please, try again.'), 'flash/error');
			}
		}
	}

	/**
	 * n_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function n_edit($id = null)
	{
		$this->RequirementStatus->id = $id;
		if (!$this->RequirementStatus->exists($id)) {
			throw new NotFoundException(__('Invalid requirement status'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->RequirementStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The requirement status has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requirement status could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('RequirementStatus.' . $this->RequirementStatus->primaryKey => $id));
			$this->request->data = $this->RequirementStatus->find('first', $options);
		}
	}

	/**
	 * n_delete method
	 *
	 * @throws NotFoundException
	 * @throws MethodNotAllowedException
	 * @param string $id
	 * @return void
	 */
	public function n_delete($id = null)
	{
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->RequirementStatus->id = $id;
		if (!$this->RequirementStatus->exists()) {
			throw new NotFoundException(__('Invalid requirement status'));
		}
		if ($this->RequirementStatus->delete()) {
			$this->Session->setFlash(__('Requirement status deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Requirement status was not deleted'), 'flash/error');
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
