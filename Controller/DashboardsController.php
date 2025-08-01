<?php
App::uses('AppController', 'Controller');
/**
 * Dashboards Controller
 *
 * @property Dashboard $Dashboard
 * @property PaginatorComponent $Paginator
 */
class DashboardsController extends AppController {

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
		$this->Dashboard->recursive = 0;
		$this->set('dashboards', $this->paginate());
        
        $colors = $this->colors;
        $this->set(compact('colors'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Dashboard->exists($id)) {
			throw new NotFoundException(__('Invalid dashboard'));
		}
		$options = array('conditions' => array('Dashboard.' . $this->Dashboard->primaryKey => $id));
		$this->set('dashboard', $this->Dashboard->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Dashboard->create();
			if ($this->Dashboard->save($this->request->data)) {
				$this->Session->setFlash(__('The dashboard has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The dashboard could not be saved. Please, try again.'), 'flash/error');
			}
		}
		$groups = $this->Dashboard->Group->find('list');
        $colors = $this->colors;
		$this->set(compact('groups', 'colors'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        $this->Dashboard->id = $id;
		if (!$this->Dashboard->exists($id)) {
			throw new NotFoundException(__('Invalid dashboard'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Dashboard->save($this->request->data)) {
				$this->Session->setFlash(__('The dashboard has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The dashboard could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('Dashboard.' . $this->Dashboard->primaryKey => $id));
			$this->request->data = $this->Dashboard->find('first', $options);
		}
		$groups = $this->Dashboard->Group->find('list');
        $colors = $this->colors;
		$this->set(compact('groups', 'colors'));
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
		$this->Dashboard->id = $id;
		if (!$this->Dashboard->exists()) {
			throw new NotFoundException(__('Invalid dashboard'));
		}
		if ($this->Dashboard->delete()) {
			$this->Session->setFlash(__('Dashboard deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Dashboard was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
