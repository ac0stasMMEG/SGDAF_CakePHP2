<?php
App::uses('AppController', 'Controller');
/**
 * Attachments Controller
 *
 * @property Attachment $Attachment
 * @property PaginatorComponent $Paginator
 */
class AttachmentsController extends AppController {

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
		$this->Attachment->recursive = 0;
		$this->set('attachments', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Attachment->exists($id)) {
			throw new NotFoundException(__('Invalid attachment'));
		}
		$options = array('conditions' => array('Attachment.' . $this->Attachment->primaryKey => $id));
		$this->set('attachment', $this->Attachment->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Attachment->create();
			if ($this->Attachment->save($this->request->data)) {
				$this->Session->setFlash(__('The attachment has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attachment could not be saved. Please, try again.'), 'flash/error');
			}
		}
		$memos = $this->Attachment->Memo->find('list');
		$attachmentTypes = $this->Attachment->AttachmentType->find('list');
		$this->set(compact('memos', 'attachmentTypes'));
	}
    
/**
 * add_files method
 *
 * @return void
 */
	public function add_files() { //debug($this->request->data); exit;
            
        $memoId = $this->request->data['Attachment']['filename']['memo_id'];
        $type = $this->request->data['Attachment']['filename']['type'];
        $name = $this->request->data['Attachment']['filename']['name'];
        $tmpName = $this->request->data['Attachment']['filename']['tmp_name'];

        if($type == 'application/pdf'){
            $this->Attachment->create();

            if ($this->Attachment->save($this->request->data['Attachment']['filename'])) {

                mkdir('../webroot/files/'.$this->Attachment->getInsertID(), 0777, true);

                if(move_uploaded_file($tmpName, '../webroot/files/'.$this->Attachment->getInsertID().'/'.$name)){

                    $this->Session->setFlash(__('El adjunto se ha ingresado correctamente.'), 'flash/success');

                }else{
                    rmdir($this->Attachment->getInsertID());

                    $this->Session->setFlash(__('El adjunto no pudo ser guardado. Por favor, inténtelo nuevamente.'), 'flash/error');
                }
            }else{
                $this->Session->setFlash(__('El adjunto no pudo ser guardado. Por favor, inténtelo nuevamente.'), 'flash/error');
            }

        }else{
            $this->Session->setFlash(__('El formato del archivo seleccionado, no corresponde.'), 'flash/error');
        }
		
        
        $this->redirect(array('controller' => 'memos', 'action' => 'parts_office'));
	}    

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        $this->Attachment->id = $id;
		if (!$this->Attachment->exists($id)) {
			throw new NotFoundException(__('Invalid attachment'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Attachment->save($this->request->data)) {
				$this->Session->setFlash(__('The attachment has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attachment could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('Attachment.' . $this->Attachment->primaryKey => $id));
			$this->request->data = $this->Attachment->find('first', $options);
		}
		$memos = $this->Attachment->Memo->find('list');
		$attachmentTypes = $this->Attachment->AttachmentType->find('list');
		$this->set(compact('memos', 'attachmentTypes'));
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
		$this->Attachment->id = $id;
		if (!$this->Attachment->exists()) {
			throw new NotFoundException(__('Invalid attachment'));
		}
		if ($this->Attachment->delete()) {
			$this->Session->setFlash(__('Attachment deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Attachment was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
