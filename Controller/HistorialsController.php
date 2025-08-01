<?php
App::uses('AppController', 'Controller');
/**
 * Historials Controller
 *
 * @property Historial $Historial
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class HistorialsController extends AppController {

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
		$this->Historial->recursive = 0;
		$this->set('historials', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null, $all = null) {

		if($all == 0):
			$historial = $this->Historial->find('first', array('conditions' => array('Historial.id' => $id)));  //debug($historial);
			$memo = $this->Historial->Memo->find('first', array('conditions' => array('Memo.id' => $historial['Historial']['memo_two']))); //debug($memo); 
			$memoTwo = 'D'.$memo['Memo']['memo_number'].'-'.$memo['Memo']['year'];
			return $memoTwo;
		else:
			if (!$this->Historial->exists($id)) {
				throw new NotFoundException(__('Invalid historial'));
			}
			$options = array('conditions' => array('Historial.' . $this->Historial->primaryKey => $id));
			$this->set('historial', $this->Historial->find('first', $options));
		endif;
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Historial->create();
			if ($this->Historial->save($this->request->data)) {
				$this->Session->setFlash(__('The historial has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The historial could not be saved. Please, try again.'), 'flash/error');
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
        $this->Historial->id = $id;
		if (!$this->Historial->exists($id)) {
			throw new NotFoundException(__('Invalid historial'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Historial->save($this->request->data)) {
				$this->Session->setFlash(__('The historial has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The historial could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('Historial.' . $this->Historial->primaryKey => $id));
			$this->request->data = $this->Historial->find('first', $options);
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
		$this->Historial->id = $id;
		if (!$this->Historial->exists()) {
			throw new NotFoundException(__('Invalid historial'));
		}
		if ($this->Historial->delete()) {
			$this->Session->setFlash(__('Historial deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Historial was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
