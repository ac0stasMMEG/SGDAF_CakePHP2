<?php
App::uses('AppController', 'Controller');

/**
 * MemoTrackings Controller
 *
 * @property MemoTracking $MemoTracking
 * @property PaginatorComponent $Paginator
 */
class MemoTrackingsController extends AppController {
    
    public $actsAs = array('Containable');

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
		$this->MemoTracking->recursive = 0;
		$this->set('memoTrackings', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MemoTracking->exists($id)) {
			throw new NotFoundException(__('Invalid memo tracking'));
		}
		$options = array('conditions' => array('MemoTracking.' . $this->MemoTracking->primaryKey => $id));
		$this->set('memoTracking', $this->MemoTracking->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MemoTracking->create();
			if ($this->MemoTracking->save($this->request->data)) {
				$this->Session->setFlash(__('The memo tracking has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The memo tracking could not be saved. Please, try again.'), 'flash/error');
			}
		}
		$memos = $this->MemoTracking->Memo->find('list');
		$memoTrackingTypes = $this->MemoTracking->MemoTrackingType->find('list');
		$this->set(compact('memos', 'memoTrackingTypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        $this->MemoTracking->id = $id;
		if (!$this->MemoTracking->exists($id)) {
			throw new NotFoundException(__('Invalid memo tracking'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MemoTracking->save($this->request->data)) {
				$this->Session->setFlash(__('The memo tracking has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The memo tracking could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('MemoTracking.' . $this->MemoTracking->primaryKey => $id));
			$this->request->data = $this->MemoTracking->find('first', $options);
		}
		$memos = $this->MemoTracking->Memo->find('list');
		$memoTrackingTypes = $this->MemoTracking->MemoTrackingType->find('list');
		$this->set(compact('memos', 'memoTrackingTypes'));
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
		$this->MemoTracking->id = $id;
		if (!$this->MemoTracking->exists()) {
			throw new NotFoundException(__('Invalid memo tracking'));
		}
		if ($this->MemoTracking->delete()) {
			$this->Session->setFlash(__('Memo tracking deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Memo tracking was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}
    
/**
 * refuse method
 *
 * @return void
 */
	public function refuse($memoId = null, $memoParentId = null) {
        
        if ($this->request->is('post') || $this->request->is('put')) {
            //debug($memoId);  debug($memoParentId); exit;
            App::import('Controller', 'Memos');
            $MemoController = new MemosController;
            
            $observationMemo = $this->request->data['MemoTracking']['observation'];
            $memoId = is_null($memoParentId) ? $memoId : $memoParentId;
                                                                      
            $this->MemoTracking->updateAll(
                array('MemoTracking.observation' => "'".$observationMemo."'", 'MemoTracking.approved' => 0),
                array('MemoTracking.memo_id' => $memoId, 'MemoTracking.viewed' => 0)
            ); 
            
            $this->MemoTracking->updateAll(
                array('MemoTracking.read' => 0),
                array('MemoTracking.memo_id' => $memoId, 'MemoTracking.viewed' => 0, 'MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0')
            ); // Propietario
            
            $users = $this->MemoTracking->find('list', array('conditions' => array('MemoTracking.memo_id' => $memoId, 'MemoTracking.viewed' => 0, 'MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0'), 'fields' => array('MemoTracking.to')));
           
            foreach($users as $user):
               $MemoController->contact_email(1, $user, $memoId);
            endforeach; 
            
            $this->Session->setFlash(__('The memo has been rejected.'), 'flash/success');
            $this->redirect(array('controller' => 'memos', 'action' => 'index'));
        }
	}
    
/**
 * shunt method
 *
 * @return void
 */
	public function shunt($memoId = null) {
        
        $this->loadModel('MemoAlert');
        
        if ($this->request->is('post') || $this->request->is('put')) {
            
            App::import('Controller', 'Memos');
            $MemoController = new MemosController;
            
            $dataTos = $this->request->data['Data']['users'];
            $observation = $this->request->data['Data']['observation'];
            
            foreach($dataTos as $dataTo):
                
                $this->MemoTracking->create();

                $this->request->data['MemoTracking']['memo_id'] = $memoId;
                $this->request->data['MemoTracking']['memo_tracking_type_id'] = '5c924533-db78-449d-b52a-0450c26b1ae0'; // Tipo Derivación
                $this->request->data['MemoTracking']['to'] = $dataTo;
                $this->request->data['MemoTracking']['read'] = 0;
                $this->request->data['MemoTracking']['subrogance_id'] = NULL;
                $this->request->data['MemoTracking']['observation'] = $observation;
                $this->MemoTracking->save($this->request->data['MemoTracking']);

                $this->MemoAlert->create();

                $this->request->data['MemoAlert']['memo_id'] = $memoId;
                $this->request->data['MemoAlert']['alert_type_id'] = '5c9245e9-fb84-4333-8d6b-0450c26b1ae0'; // Tipo Derivación
                $this->request->data['MemoAlert']['to'] = $dataTo;
                $this->MemoAlert->save($this->request->data['MemoAlert']);

                $MemoController->contact_email(4, $dataTo, $memoId, $observation);

            endforeach;
            
            $this->Session->setFlash(__('The memo has been shunted.'), 'flash/success');
            $this->redirect(array('controller' => 'memos', 'action' => 'index'));
        }
        
        $listUsers = $this->list_users(); //debug($listUsers);
        
        $this->set(compact('listUsers'));
	}
    
/**
 * list_users method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
    public function list_users() {

        $LDAP_HOST = $this->ldap['LDAP_HOST']; //ldap://violeta.mmeg.cl
        $LDAP_HOST_2 = $this->ldap['LDAP_HOST_2']; //ldap://amanda.mmeg.cl
		$LDAP_PORT = $this->ldap['LDAP_PORT']; //3268 o 389
		$LDAP_ADMIN_DN = $this->ldap['LDAP_ADMIN_DN'];
		$LDAP_ADMIN_PASSWORD = $this->ldap['LDAP_ADMIN_PASSWORD'];
		$LDAP_SEARCH_OU = $this->ldap['LDAP_SEARCH_OU'];
              
        $ds = (ldap_connect($LDAP_HOST, $LDAP_PORT)) ? ldap_connect($LDAP_HOST, $LDAP_PORT) : ldap_connect($LDAP_HOST_2, $LDAP_PORT);

        if (ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3))
        {
            if (ldap_bind($ds, $LDAP_ADMIN_DN, $LDAP_ADMIN_PASSWORD))
            { 

                $sr = ldap_search($ds, $LDAP_SEARCH_OU, "displayname=*"); 
                $infos = ldap_get_entries($ds, $sr);  
                //var_dump($infos); exit;
                $i=0;
                foreach($infos as $info)
                { 
                    if(!empty($infos[$i]["name"][0]))
                    { 
                        $organizationName = explode(',OU=', $infos[$i]["distinguishedname"][0]);

                        if($organizationName[1] <> 'ELIMINAR'){ //debug($response);

                            $completeName = $infos[$i]["displayname"][0];
                            $userName = $infos[$i]["samaccountname"][0];
                            $response[$userName] = $completeName; 
                        }
                    }

                    $i++;
                }
                ldap_close($ds);
                return($response);
            }
        }
    }
    
/**
 * alert_shunt method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
    public function alert_shunt($mail = null) {
        
        $this->loadModel('MemoAlert');

        $alertsShunt = $this->MemoTracking->find('all', array('conditions' => array('viewed' => 0, 'memo_tracking_type_id' => '5c924533-db78-449d-b52a-0450c26b1ae0', 'MemoTracking.to' => $this->Auth->user('username'))));
        
        if($mail):
            $alertsShuntMail = $this->MemoAlert->find('all', array('conditions' => array('viewed' => 0, 'alert_type_id' => '5c9245e9-fb84-4333-8d6b-0450c26b1ae0', 'MemoAlert.to' => $this->Auth->user('username'))));

            if(!empty($alertsShuntMail)):
        
                App::import('Controller', 'Memos');
                $MemoController = new MemosController;

                $period = $alertsShuntMail[0]['AlertType']['period'];

                foreach($alertsShuntMail as $sendMail):

                    $dateAlert = new DateTime($sendMail['MemoAlert']['created']);
                    $dateToday = new DateTime(date('Y-m-d h:i:s'));

                    $diff = $dateAlert->diff($dateToday)->format("%a");

                    if($diff >= $period):

                        $dataTo = $sendMail['MemoAlert']['to'];
                        $memoId = $sendMail['MemoAlert']['memo_id'];
                        $memoAlertId = $sendMail['MemoAlert']['id'];

                        $this->MemoAlert->id = $memoAlertId;
                        $this->MemoAlert->saveField('viewed', 1);

                        $MemoController->contact_email(5, $dataTo, $memoId);

                    endif;
                endforeach;
            endif;
        endif;                                      
        
        return($alertsShunt);
    }
    
/**
 * alert_shunt method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
    public function memo_shunt($memoId = null) {

        $memoShunt = $this->MemoTracking->field('id', array('viewed' => 0, 'memo_tracking_type_id' => '5c924533-db78-449d-b52a-0450c26b1ae0', 'memo_id' => $memoId));
        
        return($memoShunt);
    }
    
/**
 * alert_shunt method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
    public function delete_alert_shunt($memoTrackingId = null) {
        
        $this->loadModel('MemoAlert');
        
        $this->MemoTracking->id = $memoTrackingId;
        $this->MemoTracking->saveField('viewed', 1);
        
        $memoId = $this->MemoTracking->field('memo_id', array('id' => $memoTrackingId));
        $memoAlertId = $this->MemoAlert->field('id', array('memo_id' => $memoId, 'to' => $this->Auth->user('username'), 'alert_type_id' => '5c9245e9-fb84-4333-8d6b-0450c26b1ae0'));
        
        $this->MemoAlert->id = $memoAlertId;
        $this->MemoAlert->saveField('viewed', 1); 
        
    }
}
