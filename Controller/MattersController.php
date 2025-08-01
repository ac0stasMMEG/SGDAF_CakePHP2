<?php
App::uses('AppController', 'Controller');
/**
 * Matters Controller
 *
 * @property Matter $Matter
 * @property PaginatorComponent $Paginator
 */
class MattersController extends AppController {

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
        
		$matters = $this->Matter->find('all');
        
        $this->set(compact('matters'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Matter->exists($id)) {
			throw new NotFoundException(__('Invalid matter'));
		}
		$options = array('conditions' => array('Matter.' . $this->Matter->primaryKey => $id));
		$this->set('matter', $this->Matter->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
        
        /*$db = ConnectionManager::getDataSource("rrhh");
        $dataRRHH = $db->query("SELECT * FROM dbo.t_Jefaturas"); 
        
        debug($dataRRHH);*/
        
		if ($this->request->is('post')) {
			$this->Matter->create();
			if ($this->Matter->save($this->request->data)) {
				$this->Session->setFlash(__('The matter has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The matter could not be saved. Please, try again.'), 'flash/error');
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
        $this->Matter->id = $id;
		if (!$this->Matter->exists($id)) {
			throw new NotFoundException(__('Invalid matter'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Matter->save($this->request->data)) {
				$this->Session->setFlash(__('The matter has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The matter could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('Matter.' . $this->Matter->primaryKey => $id));
			$this->request->data = $this->Matter->find('first', $options);
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
		$this->Matter->id = $id;
		if (!$this->Matter->exists()) {
			throw new NotFoundException(__('Invalid matter'));
		}
		if ($this->Matter->delete()) {
			$this->Session->setFlash(__('Matter deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Matter was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
