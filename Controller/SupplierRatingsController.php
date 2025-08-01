<?php
App::uses('AppController', 'Controller');
/**
 * SupplierRatings Controller
 *
 * @property SupplierRating $SupplierRating
 * @property PaginatorComponent $Paginator
 */
class SupplierRatingsController extends AppController {

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
		$this->SupplierRating->recursive = 0;
		$this->set('supplierRatings', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SupplierRating->exists($id)) {
			throw new NotFoundException(__('Invalid supplier rating'));
		}
		$options = array('conditions' => array('SupplierRating.' . $this->SupplierRating->primaryKey => $id));
		$this->set('supplierRating', $this->SupplierRating->find('first', $options));
        
        $purchaseMethods = $this->purchaseMethods;
        $active = $this->active;
        $evaluations = $this->evaluations;        
        
		$this->set(compact('purchaseMethods', 'active', 'evaluations'));
	}
    
/**
 * pdf method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function pdf($id = null) {

		$options = array('conditions' => array('SupplierRating.' . $this->SupplierRating->primaryKey => $id));
		$this->set('supplierRating', $this->SupplierRating->find('first', $options));
        
        $purchaseMethods = $this->purchaseMethods;
        $active = $this->active;
        $evaluations = $this->evaluations;
        
        $this->pdfConfig = array(
            'download' => false,
            'filename' => 'Supplier Rating.pdf',
            'pageSize' => 'A4',
        );
        
		$this->set(compact('purchaseMethods', 'active', 'evaluations'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($memoId = null) {
		if ($this->request->is('post')) { //debug($this->request->data); //exit;
            
            $qualificationDate = date("Y-m-d", strtotime($this->request->data['SupplierRating']['qualification_date']));                                                         
            $this->request->data['SupplierRating']['qualification_date'] = $qualificationDate;
            
            $memoTrackingId = $this->SupplierRating->MemoTracking->field('id', array('MemoTracking.memo_id' => $memoId, 'MemoTracking.to' => $this->Auth->user('username'), 'MemoTracking.viewed' => 0));  // Tipo Propietario    
            $this->request->data['SupplierRating']['memo_tracking_id'] = $memoTrackingId; 
            
            if(!$memoTrackingId):
                //debug($this->request->data); exit;
            
                $data['memo_id'] = $memoId;
                $data['memo_tracking_type_id'] = '5b8588ba-ef8c-49e1-8592-1f68c26b1ae0';
                $data['to'] = $this->Auth->user('username');
            
                $this->SupplierRating->MemoTracking->create();
			    $this->SupplierRating->MemoTracking->save($data);
            
                $this->request->data['SupplierRating']['memo_tracking_id'] = $this->SupplierRating->MemoTracking->getInsertID();
            
            endif; 
            
            
			$this->SupplierRating->create();
			if ($this->SupplierRating->save($this->request->data)) {
                
                $memoId = $this->SupplierRating->MemoTracking->field('memo_id', array('id' => $myMemoTracking));
                
				$this->Session->setFlash(__('The supplier rating has been saved'), 'flash/success');
				$this->redirect(array('controller' => 'memos', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The supplier rating could not be saved. Please, try again.'), 'flash/error');
			}
		}
		
        $purchaseMethods = $this->purchaseMethods;
        $active = $this->active;
        $evaluations = $this->evaluations;
		$this->set(compact('myMemoTracking', 'purchaseMethods', 'active', 'evaluations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        $this->SupplierRating->id = $id;
		if (!$this->SupplierRating->exists($id)) {
			throw new NotFoundException(__('Invalid supplier rating'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
            
            $qualificationDate = date("Y-m-d", strtotime($this->request->data['SupplierRating']['qualification_date']));                                                         
            $this->request->data['SupplierRating']['qualification_date'] = $qualificationDate;
            
            if($this->request->data['SupplierRating']['memo_tracking_id'] == ''):
                
                $supplierRating = $this->SupplierRating->find('first', array('conditions' => array('SupplierRating.id' => $id)));
               
                $data['memo_id'] = $supplierRating['MemoTracking']['memo_id'];
                $data['memo_tracking_type_id'] = '5b8588ba-ef8c-49e1-8592-1f68c26b1ae0';
                $data['to'] = $this->Auth->user('username');
            
                $this->SupplierRating->MemoTracking->create();
			    $this->SupplierRating->MemoTracking->save($data);
            
                $this->request->data['SupplierRating']['memo_tracking_id'] = $this->SupplierRating->MemoTracking->getInsertID();
            
            endif; 
            
			if ($this->SupplierRating->save($this->request->data)) {                
				$this->Session->setFlash(__('The supplier rating has been saved'), 'flash/success');
				$this->redirect(array('controller' => 'memos', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The supplier rating could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('SupplierRating.' . $this->SupplierRating->primaryKey => $id));
			$this->request->data = $this->SupplierRating->find('first', $options);
            
            $memoId = $this->SupplierRating->MemoTracking->field('memo_id', array('id' => $this->request->data['SupplierRating']['memo_tracking_id']));
            $ownerForm = $this->SupplierRating->MemoTracking->field('id', array('viewed' => 0, 'to' => $this->Auth->user('username'), 'memo_id' => $memoId)); 
            $this->request->data['SupplierRating']['memo_tracking_id'] = $ownerForm;
            
            $qualificationDate = date("d-m-Y", strtotime($this->request->data['SupplierRating']['qualification_date']));                                                         
            $this->request->data['SupplierRating']['qualification_date'] = $qualificationDate;
		}
		
        $memoTrackings = $this->SupplierRating->MemoTracking->find('list', array('conditions' => array('memo_id' => $memoId)));
        $purchaseMethods = $this->purchaseMethods;
        $active = $this->active;
        $evaluations = $this->evaluations;
        
		$this->set(compact('memoTrackings', 'purchaseMethods', 'active', 'evaluations'));
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
		$this->SupplierRating->id = $id;
		if (!$this->SupplierRating->exists()) {
			throw new NotFoundException(__('Invalid supplier rating'));
		}
		if ($this->SupplierRating->delete()) {
			$this->Session->setFlash(__('Supplier rating deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Supplier rating was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
