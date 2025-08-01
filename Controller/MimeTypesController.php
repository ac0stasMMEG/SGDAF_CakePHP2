<?php
App::uses('AppController', 'Controller');
/**
 * MimeTypes Controller
 *
 * @property MimeType $MimeType
 * @property PaginatorComponent $Paginator
 */
class MimeTypesController extends AppController {

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
		$this->MimeType->recursive = 0;
		$this->set('mimeTypes', $this->paginate());
        
        $active = $this->active;
        
        $this->set(compact('active'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MimeType->exists($id)) {
			throw new NotFoundException(__('Invalid mime type'));
		}
		$options = array('conditions' => array('MimeType.' . $this->MimeType->primaryKey => $id));
		$this->set('mimeType', $this->MimeType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MimeType->create();
			if ($this->MimeType->save($this->request->data)) {
				$this->Session->setFlash(__('The mime type has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mime type could not be saved. Please, try again.'), 'flash/error');
			}
		}
        
        $active = $this->active;
        
        $this->set(compact('active'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        $this->MimeType->id = $id;
		if (!$this->MimeType->exists($id)) {
			throw new NotFoundException(__('Invalid mime type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MimeType->save($this->request->data)) {
				$this->Session->setFlash(__('The mime type has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mime type could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('MimeType.' . $this->MimeType->primaryKey => $id));
			$this->request->data = $this->MimeType->find('first', $options);
		}
        
        $active = $this->active;
        
        $this->set(compact('active'));
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
		$this->MimeType->id = $id;
		if (!$this->MimeType->exists()) {
			throw new NotFoundException(__('Invalid mime type'));
		}
		if ($this->MimeType->delete()) {
			$this->Session->setFlash(__('Mime type deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Mime type was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
