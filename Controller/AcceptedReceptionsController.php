<?php
App::uses('AppController', 'Controller');
/**
 * AcceptedReceptions Controller
 *
 * @property AcceptedReception $AcceptedReception
 * @property PaginatorComponent $Paginator
 */
class AcceptedReceptionsController extends AppController {

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
		$this->AcceptedReception->recursive = 0;
		$this->set('acceptedReceptions', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AcceptedReception->exists($id)) {
			throw new NotFoundException(__('Invalid accepted reception'));
		}
		$options = array('conditions' => array('AcceptedReception.' . $this->AcceptedReception->primaryKey => $id));
		$this->set('acceptedReception', $this->AcceptedReception->find('first', $options));
        
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
	public function pdf($id = null) {
		
		$options = array('conditions' => array('AcceptedReception.' . $this->AcceptedReception->primaryKey => $id));
		$this->set('acceptedReception', $this->AcceptedReception->find('first', $options));
        
        $active = $this->active;
        
        $this->pdfConfig = array(
            'download' => false,
            'filename' => 'Accepted Reception.pdf',
            'pageSize' => 'A4',
        );
        
		$this->set(compact('active'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($memoId = null) { 
        
		if ($this->request->is('post')) { //debug($this->request->data); exit;
            
            $receptionDate = ($this->request->data['AcceptedReception']['reception_date']) ? date("Y-m-d", strtotime($this->request->data['AcceptedReception']['reception_date'])) : NULL;                             
            $officeGuideDate = ($this->request->data['AcceptedReception']['office_guide_date']) ? date("Y-m-d", strtotime($this->request->data['AcceptedReception']['office_guide_date'])) : NULL;                             
            $invoiceDate = ($this->request->data['AcceptedReception']['invoice_date']) ? date("Y-m-d", strtotime($this->request->data['AcceptedReception']['invoice_date'])) : NULL;                             
            $purchaseOrderDate = ($this->request->data['AcceptedReception']['purchase_order_date']) ? date("Y-m-d", strtotime($this->request->data['AcceptedReception']['purchase_order_date'])) : NULL;                            
                                         
                                         
            $this->request->data['AcceptedReception']['reception_date'] = $receptionDate;
            $this->request->data['AcceptedReception']['office_guide_date'] = $officeGuideDate;
            $this->request->data['AcceptedReception']['invoice_date'] = $invoiceDate;
            $this->request->data['AcceptedReception']['purchase_order_date'] = $purchaseOrderDate;
                                
            $memoTrackingId = $this->AcceptedReception->MemoTracking->field('id', array('MemoTracking.memo_id' => $memoId, 'MemoTracking.to' => $this->Auth->user('username'), 'MemoTracking.viewed' => 0));  // Tipo Propietario    
            $this->request->data['AcceptedReception']['memo_tracking_id'] = $memoTrackingId;                                           
            
            if(!$memoTrackingId):
            
                $data['memo_id'] = $memoId;
                $data['memo_tracking_type_id'] = '5b8588ba-ef8c-49e1-8592-1f68c26b1ae0';
                $data['to'] = $this->Auth->user('username');
            
                $this->AcceptedReception->MemoTracking->create();
			    $this->AcceptedReception->MemoTracking->save($data);
            
                $this->request->data['AcceptedReception']['memo_tracking_id'] = $this->AcceptedReception->MemoTracking->getInsertID();
            
            endif;            
            
			$this->AcceptedReception->create();
			if ($this->AcceptedReception->save($this->request->data)) {
                
				$this->Session->setFlash(__('The accepted reception has been saved'), 'flash/success');
				$this->redirect(array('controller' => 'memos', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The accepted reception could not be saved. Please, try again.'), 'flash/error');
			}
		}
		
        $active = $this->active;
		$this->set(compact('myMemoTracking', 'active'));
	}		

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        $this->AcceptedReception->id = $id;
		if (!$this->AcceptedReception->exists($id)) {
			throw new NotFoundException(__('Invalid accepted reception'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {  
            
            $receptionDate = ($this->request->data['AcceptedReception']['reception_date']) ? date("Y-m-d", strtotime($this->request->data['AcceptedReception']['reception_date'])) : NULL;
            $officeGuideDate = ($this->request->data['AcceptedReception']['office_guide_date']) ? date("Y-m-d", strtotime($this->request->data['AcceptedReception']['office_guide_date'])) : NULL;
            $invoiceDate = ($this->request->data['AcceptedReception']['invoice_date']) ? date("Y-m-d", strtotime($this->request->data['AcceptedReception']['invoice_date'])) : NULL;
            $purchaseOrderDate = ($this->request->data['AcceptedReception']['purchase_order_date']) ? date("Y-m-d", strtotime($this->request->data['AcceptedReception']['purchase_order_date'])) : NULL;                            
                                         
                                         
            $this->request->data['AcceptedReception']['reception_date'] = $receptionDate;
            $this->request->data['AcceptedReception']['office_guide_date'] = $officeGuideDate;
            $this->request->data['AcceptedReception']['invoice_date'] = $invoiceDate;
            $this->request->data['AcceptedReception']['purchase_order_date'] = $purchaseOrderDate;
                                                                      
             if($this->request->data['AcceptedReception']['memo_tracking_id'] == ''):
                
                $acceptedReception = $this->AcceptedReception->find('first', array('conditions' => array('AcceptedReception.id' => $id)));
               
                $data['memo_id'] = $acceptedReception['MemoTracking']['memo_id'];
                $data['memo_tracking_type_id'] = '5b8588ba-ef8c-49e1-8592-1f68c26b1ae0';
                $data['to'] = $this->Auth->user('username');
            
                $this->AcceptedReception->MemoTracking->create();
			    $this->AcceptedReception->MemoTracking->save($data);
            
                $this->request->data['AcceptedReception']['memo_tracking_id'] = $this->AcceptedReception->MemoTracking->getInsertID();
            
            endif; 
                                                                      
			if ($this->AcceptedReception->save($this->request->data)) { 
                
				$this->Session->setFlash(__('The accepted reception has been saved'), 'flash/success');
				$this->redirect(array('controller' => 'memos', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The accepted reception could not be saved. Please, try again.'), 'flash/error');
			}
		} else {            
			$options = array('conditions' => array('AcceptedReception.' . $this->AcceptedReception->primaryKey => $id));
			$this->request->data = $this->AcceptedReception->find('first', $options);
            
            $memoId = $this->AcceptedReception->MemoTracking->field('memo_id', array('id' => $this->request->data['AcceptedReception']['memo_tracking_id']));
            $ownerForm = $this->AcceptedReception->MemoTracking->field('id', array('viewed' => 0, 'to' => $this->Auth->user('username'), 'memo_id' => $memoId)); 
            $this->request->data['AcceptedReception']['memo_tracking_id'] = $ownerForm;
            
            $receptionDateVal = ($this->request->data['AcceptedReception']['reception_date']) ? date("d-m-Y", strtotime($this->request->data['AcceptedReception']['reception_date'])) : NULL;
            $officeGuideDateVal = ($this->request->data['AcceptedReception']['office_guide_date']) ? date("d-m-Y", strtotime($this->request->data['AcceptedReception']['office_guide_date'])) : NULL;
            $invoiceDateVal = ($this->request->data['AcceptedReception']['invoice_date']) ? date("d-m-Y", strtotime($this->request->data['AcceptedReception']['invoice_date'])) : NULL;
            $purchaseOrderDateVal = ($this->request->data['AcceptedReception']['purchase_order_date']) ? date("d-m-Y", strtotime($this->request->data['AcceptedReception']['purchase_order_date'])) : NULL;
            
            $receptionDate = $receptionDateVal;                             
            $officeGuideDate = $officeGuideDateVal;                             
            $invoiceDate = $invoiceDateVal;                             
            $purchaseOrderDate = $purchaseOrderDateVal;
		}
		
        $active = $this->active;
        $memoTrackings = $this->AcceptedReception->MemoTracking->find('list', array('conditions' => array('memo_id' => $memoId)));
        
		$this->set(compact('active', 'memoTrackings'));
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
		$this->AcceptedReception->id = $id;
		if (!$this->AcceptedReception->exists()) {
			throw new NotFoundException(__('Invalid accepted reception'));
		}
		if ($this->AcceptedReception->delete()) {
			$this->Session->setFlash(__('Accepted reception deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Accepted reception was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
}
