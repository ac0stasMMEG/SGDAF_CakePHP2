<?php
App::uses('AppController', 'Controller');
/**
 * Milestones Controller
 *
 * @property Milestone $Milestone
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class MilestonesController extends AppController {

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
		$this->Milestone->recursive = 0;
		$this->set('milestones', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Milestone->exists($id)) {
			throw new NotFoundException(__('Invalid milestone'));
		}
		$options = array('conditions' => array('Milestone.' . $this->Milestone->primaryKey => $id));
		$this->set('milestone', $this->Milestone->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Milestone->create();
			if ($this->Milestone->save($this->request->data)) {
				$this->Session->setFlash(__('The milestone has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The milestone could not be saved. Please, try again.'), 'flash/error');
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
        $this->Milestone->id = $id;
		if (!$this->Milestone->exists($id)) {
			throw new NotFoundException(__('Invalid milestone'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Milestone->save($this->request->data)) {
				$this->Session->setFlash(__('The milestone has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The milestone could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('Milestone.' . $this->Milestone->primaryKey => $id));
			$this->request->data = $this->Milestone->find('first', $options);
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
		$this->Milestone->id = $id;
		if (!$this->Milestone->exists()) {
			throw new NotFoundException(__('Invalid milestone'));
		}
		if ($this->Milestone->delete()) {
			$this->Session->setFlash(__('Milestone deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Milestone was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
    
/**
 * index method
 *
 * @return void
 */
	public function percentage($id = null) {
		
        $percentage = $this->Milestone->RequirementTracking->find('first', array('conditions' => array('requirement_id' => $id, 'milestone_id IS NOT NULL'), 'order' => array('RequirementTracking.created' => 'DESC'))); //debug($percentage);
        
        return $percentage;
	}
}
