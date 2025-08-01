<?php
App::uses('AppController', 'Controller');
/**
 * Shares Controller
 *
 * @property Share $Share
 * @property PaginatorComponent $Paginator
 */
class SharesController extends AppController {

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
        
        $shares = $this->Share->find('all');
        $this->set(compact('shares'));
        
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Share->exists($id)) {
			throw new NotFoundException(__('Invalid share'));
		}
		$options = array('conditions' => array('Share.' . $this->Share->primaryKey => $id));
		$this->set('share', $this->Share->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) { //debug($this->request->data); exit;
            ($this->request->data['Share']['parent_id'] == '') ? $this->request->data['Share']['parent_id'] = NULL : NULL;                             
			$this->Share->create();
			if ($this->Share->save($this->request->data)) {
				$this->Session->setFlash(__('The share has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The share could not be saved. Please, try again.'), 'flash/error');
			}
		}
		$parents = $this->Share->Parent->find('list', array('fields' => array('id', 'username'), 'order' => array('username' => 'ASC')));
		$this->set(compact('parents'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        $this->Share->id = $id;
		if (!$this->Share->exists($id)) {
			throw new NotFoundException(__('Invalid share'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
            ($this->request->data['Share']['parent_id'] == '') ? $this->request->data['Share']['parent_id'] = NULL : NULL;
			if ($this->Share->save($this->request->data)) {
				$this->Session->setFlash(__('The share has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The share could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('Share.' . $this->Share->primaryKey => $id));
			$this->request->data = $this->Share->find('first', $options);
		}
		$parents = $this->Share->Parent->find('list', array('fields' => array('id', 'username'), 'order' => array('username' => 'ASC')));
		$this->set(compact('parents'));
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
		$this->Share->id = $id;
		if (!$this->Share->exists()) {
			throw new NotFoundException(__('Invalid share'));
		}
		if ($this->Share->delete()) {
			$this->Session->setFlash(__('Share deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Share was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
