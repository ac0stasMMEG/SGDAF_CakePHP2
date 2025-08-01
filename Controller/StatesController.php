<?php
App::uses('AppController', 'Controller');
/**
 * States Controller
 *
 * @property State $State
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class StatesController extends AppController {

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
		$this->State->recursive = 0;
		$this->set('states', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->State->exists($id)) {
			throw new NotFoundException(__('Invalid state'));
		}
		$options = array('conditions' => array('State.' . $this->State->primaryKey => $id));
		$this->set('state', $this->State->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->State->create();
			if ($this->State->save($this->request->data)) {
				$this->Session->setFlash(__('The state has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The state could not be saved. Please, try again.'), 'flash/error');
			}
		}
	}
    
/**
 * add method
 *
 * @return void
 */
	public function complete($memoId = null, $complete = true) {
		if ($this->request->is('post')) {
            
            $observation = $this->request->data['Data']['observation'];
            
            if(!$complete){
                $this->State->Memo->updateAll(
                    array('Memo.state_id' => NULL, 'Memo.state_observation' => "'$observation'"),
                    array('Memo.id' => $memoId)
                ); // Estado "Gestioando" 

                $this->Session->setFlash(__('El memorándum ha sido recuperado y enviado a la bandeja de "Recibidos"'), 'flash/success');
                
            }else{
                $this->State->Memo->updateAll(
                    array('Memo.state_id' => "'5e347552-4c10-49d8-947d-94bcc26b1ae0'", 'Memo.state_observation' => "'$observation'"),
                    array('Memo.id' => $memoId)
                ); // Estado "Gestioando" 

                $this->Session->setFlash(__('El memorándum ha sido enviado a la bandeja de "Gestionados".'), 'flash/success');
            }
			
            $this->redirect(array('controller' => 'memos', 'action' => 'index'));
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
        $this->State->id = $id;
		if (!$this->State->exists($id)) {
			throw new NotFoundException(__('Invalid state'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->State->save($this->request->data)) {
				$this->Session->setFlash(__('The state has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The state could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('State.' . $this->State->primaryKey => $id));
			$this->request->data = $this->State->find('first', $options);
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
		$this->State->id = $id;
		if (!$this->State->exists()) {
			throw new NotFoundException(__('Invalid state'));
		}
		if ($this->State->delete()) {
			$this->Session->setFlash(__('State deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('State was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
