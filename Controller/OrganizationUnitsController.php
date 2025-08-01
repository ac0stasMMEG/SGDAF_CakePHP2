<?php
App::uses('AppController', 'Controller');
/**
 * OrganizationUnits Controller
 *
 * @property OrganizationUnit $OrganizationUnit
 * @property PaginatorComponent $Paginator
 */
class OrganizationUnitsController extends AppController {

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
		$this->OrganizationUnit->recursive = 0;
		$this->set('organizationUnits', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->OrganizationUnit->exists($id)) {
			throw new NotFoundException(__('Invalid organization unit'));
		}
		$options = array('conditions' => array('OrganizationUnit.' . $this->OrganizationUnit->primaryKey => $id));
		$this->set('organizationUnit', $this->OrganizationUnit->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->OrganizationUnit->create();
			if ($this->OrganizationUnit->save($this->request->data)) {
				$this->Session->setFlash(__('The organization unit has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The organization unit could not be saved. Please, try again.'), 'flash/error');
			}
		}
		$parentOrganizationUnits = $this->OrganizationUnit->ParentOrganizationUnit->find('list');
		$this->set(compact('parentOrganizationUnits'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        $this->OrganizationUnit->id = $id;
		if (!$this->OrganizationUnit->exists($id)) {
			throw new NotFoundException(__('Invalid organization unit'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->OrganizationUnit->save($this->request->data)) {
				$this->Session->setFlash(__('The organization unit has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The organization unit could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('OrganizationUnit.' . $this->OrganizationUnit->primaryKey => $id));
			$this->request->data = $this->OrganizationUnit->find('first', $options);
		}
		$parentOrganizationUnits = $this->OrganizationUnit->ParentOrganizationUnit->find('list');
		$this->set(compact('parentOrganizationUnits'));
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
		$this->OrganizationUnit->id = $id;
		if (!$this->OrganizationUnit->exists()) {
			throw new NotFoundException(__('Invalid organization unit'));
		}
		if ($this->OrganizationUnit->delete()) {
			$this->Session->setFlash(__('Organization unit deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Organization unit was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
