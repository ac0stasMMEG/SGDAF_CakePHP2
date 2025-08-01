<?php
App::uses('AppController', 'Controller');
/**
 * Subrogances Controller
 *
 * @property Subrogance $Subrogance
 * @property PaginatorComponent $Paginator
 */
class SubrogancesController extends AppController {

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

        $subrogances = $this->Subrogance->find('all');
		$this->set(compact('subrogances'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Subrogance->exists($id)) {
			throw new NotFoundException(__('Invalid subrogance'));
		}
		$options = array('conditions' => array('Subrogance.' . $this->Subrogance->primaryKey => $id));
		$this->set('subrogance', $this->Subrogance->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) { debug($this->request->data); exit;
			$this->Subrogance->create();
			if ($this->Subrogance->save($this->request->data)) {
                
                if(move_uploaded_file($this->request->data['Subrogances']['filename']['tmp_name'], '../webroot/mark/'.$this->request->data['Subrogances']['filename']['name'])){
                }else{
                    rmdir($this->request->data['Subrogances']['filename']['name']);
                }
                
				$this->Session->setFlash(__('The subrogance has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subrogance could not be saved. Please, try again.'), 'flash/error');
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
        $this->Subrogance->id = $id;
		if (!$this->Subrogance->exists($id)) {
			throw new NotFoundException(__('Invalid subrogance'));
		}
		if ($this->request->is('post') || $this->request->is('put')) { debug($this->request->data); exit;
			if ($this->Subrogance->save($this->request->data)) {
				$this->Session->setFlash(__('The subrogance has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subrogance could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('Subrogance.' . $this->Subrogance->primaryKey => $id));
			$this->request->data = $this->Subrogance->find('first', $options);
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
		$this->Subrogance->id = $id;
		if (!$this->Subrogance->exists()) {
			throw new NotFoundException(__('Invalid subrogance'));
		}
		if ($this->Subrogance->delete()) {
			$this->Session->setFlash(__('Subrogancia eliminada'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('La subrogancia no puede ser eliminada, por que este usuario tiene firmados memos con dicho rol.'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
