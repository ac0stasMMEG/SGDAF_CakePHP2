<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Requirements Controller
 *
 * @property Requirement $Requirement
 * @property PaginatorComponent $Paginator
 */
class RequirementsController extends AppController
{

	/**
	 * Components
	 *
	 * @var array
	 */
	var $allMemoId = NULL;

	public $components = array('Paginator', 'Session', 'Flash', 'RequestHandler');

	public function view($id = null)
	{
		if (!$this->Requirement->exists($id)) {
			throw new NotFoundException(__('Invalid requirement'));
		}
		$options = array('conditions' => array('Requirement.' . $this->Requirement->primaryKey => $id));
		$this->set('requirement', $this->Requirement->find('first', $options));
	}

	public function add()
	{
		if ($this->request->is('post')) {
			$this->Requirement->create();
			if ($this->Requirement->save($this->request->data)) {
				$this->Session->setFlash(__('The requirement has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requirement could not be saved. Please, try again.'), 'flash/error');
			}
		}
		$requirementProcesses = $this->Requirement->RequirementProcess->find('list');
		$this->set(compact('requirementProcesses'));
	}

	public function edit($id = null)
	{
		$this->Requirement->id = $id;
		if (!$this->Requirement->exists($id)) {
			throw new NotFoundException(__('Invalid requirement'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Requirement->save($this->request->data)) {
				$this->Session->setFlash(__('The requirement has been saved'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The requirement could not be saved. Please, try again.'), 'flash/error');
			}
		} else {
			$options = array('conditions' => array('Requirement.' . $this->Requirement->primaryKey => $id));
			$this->request->data = $this->Requirement->find('first', $options);
		}
		$requirementProcesses = $this->Requirement->RequirementProcess->find('list');
		$this->set(compact('requirementProcesses'));
	}

	public function delete($id = null)
	{
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Requirement->id = $id;
		if (!$this->Requirement->exists()) {
			throw new NotFoundException(__('Invalid requirement'));
		}
		if ($this->Requirement->delete()) {
			$this->Session->setFlash(__('Requirement deleted'), 'flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Requirement was not deleted'), 'flash/error');
		$this->redirect(array('action' => 'index'));
	}

	// ----------------------------
	//	INDEX
	// ----------------------------
	public function index($id = null)
	{
		$this->theme = 'Login2';

		$this->set('idRequirement', $this->Requirement->getInsertID());
		$me = $this->Auth->user('username');

		if ($this->request->is('post')) {			

			$fechasPublicacion = explode(' to ', $this->request->data['fechaPublicacion']);

			$requirement_id = $this->request->data['Requirement']['requirement_id'];
			$proccesId		= $this->request->data['Requirement']['RequirementProcess_id'];
			$proccesName	= $this->request->data['Requirement']['RequirementProcess_name'];
			$description	= $this->request->data['Requirement']['description'];
			$creator		= $me;
			
			$idRequirement = ($id) ? $id : $this->Requirement->getInsertID();

			//-----------------------------------------------------
			//	VALIDAMOS SI ES UN HITO LO QUE SE INTENTA GUARDAR
			//-----------------------------------------------------
			if ($requirement_id == '') {
				# OBTIENE EL ULTIMO REGISTROGUARDADO Y ASIGNA UNO NUEVO PARA NUEVO REQUERIMIENTO
				$numRequirement 	=  $this->Requirement->find('first', array('order' => array('requirement_number' => 'DESC')));
				$maxNumRequirement 	= ++$numRequirement['Requirement']['requirement_number'];

				//-----------------------------------------------
				//	CREA PROCESO NUEVO
				//-----------------------------------------------
				$this->Requirement->create();
				$this->request->data['Requirement']['creator'] 					= $me;
				$this->request->data['Requirement']['requirement_process_id']	= $proccesId;
				$this->request->data['Requirement']['requirement_status_id']	= 1;
				$this->request->data['Requirement']['requirement_number']		= $maxNumRequirement;
				$this->request->data['Requirement']['year']						= date('Y');
				$this->request->data['Requirement']['percentage'] 				= 1;
				$this->request->data['Requirement']['area'] 					= $this->Session->read('Auth.User.area');
				$this->Requirement->save($this->request->data['Requirement']);

				$this->Session->setFlash(__('Registro guardado con Exito.'), 'flash/success');

				$notificaCorreo = $creator;
				$this->contact_email(0, $notificaCorreo, $this->Requirement->getLastInsertId());

				$this->redirect(array('action' => 'index/' . $this->Requirement->getLastInsertId()));

			} else {

				// PREGUNTAMOS POR LAS TAREAS DEL PROCESO
				$this->loadModel('RequirementProcess');
				$conditionsProcess = array('RequirementProcess.id' => $proccesId);
				$process = $this->RequirementProcess->find('first', array('conditions' => $conditionsProcess));

				// PREGUNTAMOS SI EXISTEN TAREAS EN EL TRACKING
				$conditionsTracking = array('RequirementTracking.requirement_id' => $idRequirement);
				$this->loadModel('RequirementTracking');
				$tracking = $this->RequirementTracking->find('first', array('conditions' => $conditionsTracking));

				$numTracking	=	$this->Requirement->RequirementTracking->find('first', array('order' => array('tracking_number' => 'DESC')));
				$maxNumTracking	=	++$numTracking['RequirementTracking']['tracking_number'];

				// ----------------------------------------------
				//	ACTUALIZACIÓN DE REQUERIMIENTO
				// ----------------------------------------------
				$this->Requirement->id = $requirement_id;
				$this->request->data['Requirement']['creator'] 		= $this->Session->read('Auth.User.name');
				$this->request->data['Requirement']['area'] 		= $this->Session->read('Auth.User.area');
				if (isset($this->request->data['ordenCompra'])) :
					$this->request->data['Requirement']['task']		= $this->request->data['ordenCompra'];
				endif;
				$this->Requirement->save($this->request->data['Requirement']);

				if (!$tracking) {
					// ----------------------------------------------
					// 	GUARDAMOS INFORMACION DEL REQUERIMIENTO
					// ----------------------------------------------
					if (!empty($this->request->data['Requirement']['requirement_id'])) :
						$this->Requirement->RequirementTracking->create();
						$data['Requirement']['requirement_id'] 					= $requirement_id;
						$data['Requirement']['requirement_tracking_type_id'] 	= '65c52553-eef0-4651-9175-3df8c26b1ae0';	// INFORMACIÓN DEL TRACKING
						$data['Requirement']['requirement_process_tasks_id']	= $process['RequirementProcessTask'][0]['id'];
						$data['Requirement']['requirement_process_id']			= $process['RequirementProcess']['id'];
						$data['Requirement']['area'] 							= $this->Session->read('Auth.User.area');
						$data['Requirement']['order_traking']					= 1;
						$data['Requirement']['requirement_attachment_id']		= null;
						$data['Requirement']['tracking_number']					= $maxNumTracking;
						$data['Requirement']['to']								= 'to';
						$data['Requirement']['description']						= $description;
						$data['Requirement']['creator']							= $me;
						$this->Requirement->RequirementTracking->save($data['Requirement']);

					// ----------------------------------------------------
					// 	PORCENTAJE
					// ----------------------------------------------------
						$this->loadModel('RequirementProcessTask');
						$conditions = array('conditions' => array('RequirementProcess.id' => $proccesId));
						$percentageProcess = $this->RequirementProcessTask->find('all', $conditions);
						$percentageTotal = count($percentageProcess);
						$this->loadModel('RequirementTracking');
						$Requirement_tracking = $this->RequirementTracking->find('all', array(
							'conditions' => array(
								'RequirementTracking.requirement_id' => $requirement_id,
								'RequirementTracking.requirement_tracking_type_id' => '65c52553-eef0-4651-9175-3df8c26b1ae0',
							)
						));

					// ----------------------------------------------------
					//	CALCULO PORCENTAJE
					// ----------------------------------------------------
						$percetageCompletes = count($Requirement_tracking);
						if ($percetageCompletes == 0) {
							$percetageCompletes = 1;
						} 
						$percentageOpe = $percetageCompletes / $percentageTotal * 100 ;
						$percentage = $percentageOpe;
						if($percetageCompletes ==  $percentageTotal):
							$percentage = 100;
						endif;

					// ----------------------------------------------------
						$this->Requirement->id = $requirement_id;
						$this->request->data['Requirement']['percentage']	= $percentage;
						$this->Requirement->save($this->request->data['Requirement']);
					// ----------------------------------------------------


					// ----------------------------------------------------
					//	ENVIAMOS CORREO
					// ----------------------------------------------------
						$notificaCorreo = $creator;
						$this->contact_email(1, $notificaCorreo, $requirement_id);
					// ----------------------------------------------------

					endif;
				} else {
					$conditions = array(
						'RequirementTracking.requirement_id' => $idRequirement,
						'RequirementTracking.requirement_tracking_type_id' => '65c52553-eef0-4651-9175-3df8c26b1ae0'
					);
					$trackingTask	= $this->RequirementTracking->find('all', array(
						'recursive' 	=> -1,
						'conditions' 	=> $conditions
					));
					$tareaCount = count($trackingTask);


					//-----------------------------------------------
					//	GUARDAMOS INFORMACION DEL REQUERIMIENTO
					//-----------------------------------------------
					if (!empty($this->request->data['Requirement']['requirement_id'])) :


						$this->Requirement->RequirementTracking->create();
						$data['Requirement']['requirement_id'] 					= $requirement_id;
						$data['Requirement']['requirement_tracking_type_id'] 	= '65c52553-eef0-4651-9175-3df8c26b1ae0';	// INFORMACIÓN DEL TRACKING
						$data['Requirement']['requirement_process_tasks_id']	= $process['RequirementProcessTask'][$tareaCount]['id'];
						$data['Requirement']['requirement_process_id']			= $process['RequirementProcess']['id'];

						if (isset($this->request->data['ordenCompra'])) :
							$data['Requirement']['task']						= $this->request->data['ordenCompra'];
						endif;

						$data['Requirement']['area'] 							= $this->Session->read('Auth.User.area');
						$data['Requirement']['order_traking']					= 1;
						$data['Requirement']['requirement_attachment_id']		= null;
						$data['Requirement']['tracking_number']					= $maxNumTracking;
						$data['Requirement']['to']								= 'to';
						$data['Requirement']['description']						= $description;
						$data['Requirement']['creator']							= $me;
						$this->Requirement->RequirementTracking->save($data['Requirement']);

						#echo 'Mostramos el PROCESO Y SU TAREA:';
						#debug($process['RequirementProcessTask']);exit;	


						// ----------------------------------------------------
						// 	PORCENTAJE
						// ----------------------------------------------------
							$this->loadModel('RequirementProcessTask');
							$conditions = array('conditions' => array('RequirementProcess.id' => $proccesId));
							$percentageProcess = $this->RequirementProcessTask->find('all', $conditions);
							$percentageTotal = count($percentageProcess);

							$this->loadModel('RequirementTracking');
							$Requirement_tracking = $this->RequirementTracking->find('all', array(
								'conditions' => array(
									'RequirementTracking.requirement_id' => $requirement_id,
									'RequirementTracking.requirement_tracking_type_id' => '65c52553-eef0-4651-9175-3df8c26b1ae0',
								)
							));

					// ----------------------------------------------------
					//	CALCULO PORCENTAJE
					// ----------------------------------------------------
						$percetageCompletes = count($Requirement_tracking);
						if ($percetageCompletes == 0) {
							$percetageCompletes = 1;
						} 
						$percentageOpe = $percetageCompletes / $percentageTotal * 100 ;
						$percentage = $percentageOpe;
						if($percetageCompletes ==  $percentageTotal):
							$percentage = 100;
						endif;
					// ----------------------------------------------------

					$this->Requirement->id = $requirement_id;
					$this->request->data['Requirement']['percentage']	= $percentage;
					$this->Requirement->save($this->request->data['Requirement']);
					// ----------------------------------------------------
						$notificaCorreo = $creator;
						$this->contact_email(1, $notificaCorreo, $requirement_id);
						endif;
				}


				//-----------------------------------------------
				//	GUARDAMOS TAREA DE MEMO
				//-----------------------------------------------
				if (!empty($this->request->data['Memo'])) :
					$memo = count($this->request->data['Memo']);
					$memos = null;
					for ($i = 0; $i < $memo; $i++) {
						$memos .= $this->request->data['Memo'][$i]['memo_number'] . ',';
					}
					$data['Memo']['requirement_id'] 				= $requirement_id;
					$this->Requirement->RequirementTracking->create();
					$data['Memo']['requirement_tracking_type_id'] 	= '65b94f7c-fb7c-4c3c-a2b6-3df80a220016';	// DEBE CANBIAR EL TIPO DE MILESTONE
					$data['Memo']['requirement_process_tasks_id']	= $data['Requirement']['requirement_process_tasks_id'];
					$data['Memo']['order_traking']					= 2;
					$data['Memo']['tracking_number']				= $maxNumTracking;
					$data['Memo']['to']								= 'to';
					$data['Memo']['creator']						= $creator;
					$data['Memo']['description']					= $description;
					$data['Memo']['memo_number']					= $memos;
					$this->Requirement->RequirementTracking->save($data['Memo']);
				endif;


				//-----------------------------------------------
				//	GUARDAMOS ELEMENTO DE CARPETA OFERENTES
				//-----------------------------------------------
				if (!empty($this->request->data['carpetaOferentes'])) :
					$data['CarpetaOferentes']['requirement_id']					= $requirement_id;
					$this->Requirement->RequirementTracking->create();
					$data['CarpetaOferentes']['requirement_tracking_type_id'] 	= '66f43108-daa8-4f8e-b56f-39a40a320009';	// DEBE CANBIAR EL TIPO DE MILESTONE
					$data['CarpetaOferentes']['order_traking']					= 4;
					$data['CarpetaOferentes']['tracking_number']				= $maxNumTracking;
					$data['CarpetaOferentes']['to']								= 'to';
					$data['CarpetaOferentes']['creator']						= $creator;
					$data['CarpetaOferentes']['description']					= $this->request->data['carpetaOferentes'];
					$this->Requirement->RequirementTracking->save($data['CarpetaOferentes']);
				endif;


				//-----------------------------------------------
				// 	GUARDAMOS ELEMENTO ORDEN DE COMPRA
				//-----------------------------------------------
				if (!empty($this->request->data['ordenCompra'])) :
					$data['ordenCompra']['requirement_id']					= $requirement_id;
					$this->Requirement->RequirementTracking->create();
					$data['ordenCompra']['requirement_tracking_type_id']	= '66f430e5-6048-4d68-976c-39a50a320009';	// DEBE CANBIAR EL TIPO DE MILESTONE
					$data['ordenCompra']['order_traking']					= 5;
					$data['ordenCompra']['tracking_number']					= $maxNumTracking;
					$data['ordenCompra']['to']								= 'to';
					$data['ordenCompra']['creator']							= $creator;
					$data['ordenCompra']['description']						= $this->request->data['ordenCompra'];
					$this->Requirement->RequirementTracking->save($data['ordenCompra']);


				endif;


				//-----------------------------------------------
				// 	GUARDAMOS ELEMENTO FOLIO PRESUPUESTARIO
				//-----------------------------------------------
				if (!empty($this->request->data['folioPresupuestario'])) :
					$data['folioPresupuestario']['requirement_id']					= $requirement_id;
					$this->Requirement->RequirementTracking->create();
					$data['folioPresupuestario']['requirement_tracking_type_id']	= '66f41a32-0820-42a0-a24a-3ccc0a320009';	// DEBE CANBIAR EL TIPO DE MILESTONE
					$data['folioPresupuestario']['order_traking']					= 5;
					$data['folioPresupuestario']['tracking_number']					= $maxNumTracking;
					$data['folioPresupuestario']['to']								= 'to';
					$data['folioPresupuestario']['creator']							= $creator;
					$data['folioPresupuestario']['description']						= $this->request->data['folioPresupuestario'];
					$this->Requirement->RequirementTracking->save($data['folioPresupuestario']);
				endif;


				//-----------------------------------------------
				// 	GUARDAMOS ELEMENTO FOLIO TESORERIA
				//-----------------------------------------------
				if (!empty($this->request->data['folioTesoreria'])) :
					$data['folioTesoreria']['requirement_id']					= $requirement_id;
					$this->Requirement->RequirementTracking->create();
					$data['folioTesoreria']['requirement_tracking_type_id']		= '66f4323b-db94-4060-8361-3db10a320009';	// DEBE CANBIAR EL TIPO DE MILESTONE
					$data['folioTesoreria']['order_traking']					= 6;
					$data['folioTesoreria']['tracking_number']					= $maxNumTracking;
					$data['folioTesoreria']['to']								= 'to';
					$data['folioTesoreria']['creator']							= $creator;
					$data['folioTesoreria']['description']						= $this->request->data['folioTesoreria'];
					$this->Requirement->RequirementTracking->save($data['folioTesoreria']);
				endif;


				//-----------------------------------------------
				//	GUARDAMOS ELEMENTO FOLIO DEVENGO
				//-----------------------------------------------
				if (!empty($this->request->data['folioDevengo'])) :
					$data['folioDevengo']['requirement_id']					= $requirement_id;
					$this->Requirement->RequirementTracking->create();
					$data['folioDevengo']['requirement_tracking_type_id']	= '66f43259-8d68-4a35-b3c7-39a60a320009';	// DEBE CANBIAR EL TIPO DE MILESTONE
					$data['folioDevengo']['order_traking']					= 6;
					$data['folioDevengo']['tracking_number']				= $maxNumTracking;
					$data['folioDevengo']['to']								= 'to';
					$data['folioDevengo']['creator']						= $creator;
					$data['folioDevengo']['description']					= $this->request->data['folioDevengo'];
					$this->Requirement->RequirementTracking->save($data['folioDevengo']);
				endif;


				//-----------------------------------------------
				//	GUARDAMOS TAREA DE ADJUNTO
				//-----------------------------------------------
				if (!empty($this->request->data['Attachment'])) :
					$this->loadModel('RequirementAttachment');
					$documento = count($this->request->data['Attachment']['data']);
					for ($i = 0; $i < $documento; $i++) {
						$this->RequirementAttachment->create();
						$data['Attachment']['requirement_attachment_type_id'] = '1b5b23c2-aefa-11ee-9bfa-00505692495c';	// DEBE CANBIAR EL TIPO DE MILESTONE
						$data['Attachment']['name']		= $this->request->data['Attachment']['data'][$i]['name'];
						$data['Attachment']['type']		= $this->request->data['Attachment']['data'][$i]['type'];
						$data['Attachment']['size']		= $this->request->data['Attachment']['data'][$i]['size'];
						if ($this->RequirementAttachment->save($data['Attachment'])) {
							mkdir('../webroot/files_requirements/' . $this->RequirementAttachment->getInsertID(), 0777, true);
							if (move_uploaded_file($this->request->data['Attachment']['data'][$i]['tmp_name'], '../webroot/files_requirements/' . $this->RequirementAttachment->getInsertID() . '/' . $data['Attachment']['name'])) {
							} else {
								rmdir($this->RequirementAttachment->getInsertID());
							}
						}
						$this->Requirement->RequirementTracking->create();
						$data['Requirement']['requirement_id'] 				 	= $this->request->data['Requirement']['requirement_id'];
						$data['Requirement']['requirement_tracking_type_id'] 	= '65b951a7-c290-4159-82df-3df80a220016';
						$data['Requirement']['requirement_attachment_id'] 	 	= $this->RequirementAttachment->getLastInsertId();
						$data['Requirement']['order_traking']					= 3;
						$data['Requirement']['tracking_number']				 	= $maxNumTracking;
						$data['Requirement']['to']								= 'to';
						$data['Requirement']['creator']							= $creator;
						$data['Requirement']['description']						= $this->request->data['Requirement']['description'];
						$this->Requirement->RequirementTracking->save($data['Requirement']);
					}
				endif;
				//-----------------------------------------------


				//-----------------------------------------------
				//	GUARDAMOS TAREA DE FECHA / TAREA ESPECIFICA
				//-----------------------------------------------
				if (!empty($this->request->data['specific_task'])) :
					$this->Requirement->RequirementTracking->create();
					$data['Requirement']['requirement_id'] 					= $this->request->data['Requirement']['requirement_id'];
					$data['Requirement']['milestone_id']					= $this->request->data['Requirement']['milestone_id'];
					$data['Requirement']['tracking_number']					= $maxNumTracking;
					$data['Requirement']['requirement_tracking_type_id'] 	= '661d61cb-c97c-44f3-84aa-09c10a320009'; // DEBE CANBIAR EL TIPO DE MILESTONE
					$data['Requirement']['order_traking']					= 5;
					//------------------------------------------------------------------------------------------------------
					$data['Requirement']['creator']							= $creator;
					$data['Requirement']['description']						= $this->request->data['Requirement']['description'];
					//------------------------------------------------------------------------------------------------------
					$data['Requirement']['specific_task_date']				= $this->request->data['specific_task']['date'];
					$data['Requirement']['specific_task_person']			= $this->request->data['specific_task']['person'];
					$data['Requirement']['specific_task_description']		= $this->request->data['specific_task']['description'];
					//------------------------------------------------------------------------------------------------------
					$this->Requirement->RequirementTracking->save($data['Requirement']);
				endif;


				//-----------------------------------------------
				//	OBSOLETAS
				//-----------------------------------------------
				//	GUARDAMOS TAREA DE COLABORADOR
				//-----------------------------------------------
				if (!empty($this->request->data['Collaborator'])) :
					$colaborante = $this->request->data['Collaborator']['collaborator'];;
					$this->Requirement->RequirementTracking->create();
					$data['Requirement']['requirement_id'] 					= $this->request->data['Requirement']['requirement_id'];
					$data['Requirement']['requirement_tracking_type_id'] 	= '65b94f54-1c84-4ee4-863c-3df80a220016';
					$data['Requirement']['order_traking']					= 4;
					$data['Requirement']['tracking_number']					= $maxNumTracking;
					$data['Requirement']['to']								= 'to';
					$data['Requirement']['creator']							= $creator;
					$data['Requirement']['description']						= $this->request->data['Requirement']['description'];
					$data['Requirement']['collaborator']					= $colaborante;
					$this->Requirement->RequirementTracking->save($data['Requirement']);
					#$this->contact_email(0, $colaborante, $this->request->data['Requirement']['requirement_id']);
				endif;


				//-----------------------------------------------
				//	GUARDAMOS TAREA DE APROBRACION
				//-----------------------------------------------
				if (!empty($this->request->data['Approval'])) :
					$this->Requirement->RequirementTracking->create();
					$data['Requirement']['requirement_id'] 					= $this->request->data['Requirement']['requirement_id'];
					$data['Requirement']['tracking_number']					= $maxNumTracking;
					$data['Requirement']['requirement_tracking_type_id'] 	= '65c3a473-06c0-4bef-b594-3df8c26b1ae0'; // DEBE CANBIAR EL TIPO DE MILESTONE
					$data['Requirement']['order_traking']					= 6;
					$data['Requirement']['approver']						= $this->request->data['Approval']['approver'];
					$data['Requirement']['approval_status']					= null;
					$data['Requirement']['creator']							= $creator;
					$data['Requirement']['description']						= $this->request->data['Requirement']['description'];
					$this->Requirement->RequirementTracking->save($data['Requirement']);
				endif;
			
			}

			if ($this->request->data['continue'] == '') :
				$this->Session->setFlash(__('Requirement Added'), 'flash/success');
				return $this->redirect(
					array('controller' => 'requirements', 'action' => 'home')
				);
			endif;

		} else {

			$userArea = $this->Session->read('Auth.User.area');	
			$this->loadModel('RequirementProcessArea');
			$idArea = 	$this->RequirementProcessArea->field('id' , array('name'=>$userArea) );
			
			$this->loadModel('RequirementProcess');
			$process		= $this->RequirementProcess->find('list', array('fields' => array('id', 'name'), 'conditions' => array('requirement_process_area_id'=>$idArea) ));
			
			$requirement	= $this->Requirement->find('first', array('contain' => false, 'conditions' => array('Requirement.id' => $id)));

			$conditionsTraking	= array(
				'RequirementTracking.requirement_tracking_type_id' => '65c52553-eef0-4651-9175-3df8c26b1ae0',
				'RequirementTracking.requirement_id' => $id
			);
			$processTasks = $this->RequirementProcess->find('first', $conditionsTraking);
			$processTasksMaxCount = Count($processTasks['RequirementProcessTask']);

			$conditionsTrakingMax	= array(
				'RequirementTracking.requirement_tracking_type_id' => '65c52553-eef0-4651-9175-3df8c26b1ae0',
				'RequirementTracking.requirement_id' => $id,
				'order' => array(
					'Requirement.modified' => 'ASC'
				)
			);
			$processTasksMax = $this->Requirement->RequirementTracking->find('first', $conditionsTrakingMax);

			foreach ($processTasksMax as $key => $value) {
				if (isset($value['RequirementTracking']['requirement_process_tasks_id'])) {
					if ($value['RequirementTracking']['requirement_process_tasks_id'] != '' and $value['RequirementTracking']['requirement_id'] == $id) {
						$processTasksCount = ++$processTasksCount;
					}
				}
			}

			$this->set(compact(
				'me',
				'actuallyTasks',
				'processTasksCount',	// NUMERO DE TAREA ACTUAL
				'processTasksMaxCount',	// NUMERO DE TAREA MAXIMA
				'requirement',
				'process'
			));

		}
	}

	// ----------------------------
	//	HOME
	// ----------------------------
	public function home()
	{
		$usuario			= null;
		$requirement	 	= null;
		$nRequirement 		= null;
		$misRequerimientos 	= null;
		$collaRequirement 	= null;

		$this->theme = 'Login2';

		$usuario = $this->Auth->user('username');

		$misRequerimientos = $this->Requirement->find(
			'all',
			array(
				'recursive' => 0,
					/* 
					'conditions' => array(
						'creator' => $usuario
					), 
					*/
				#'limit' => 3,
				'order' => array(
					'Requirement.modified' => 'DESC'
				)
			)
		);

		$nRequirement = count($misRequerimientos);
		$this->set(
			compact(
				'usuario',
				'nRequirement',
				'misRequerimientos'
			)
		);

	}

	// ----------------------------
	// 	MODAL - DETALLE
	// ----------------------------
	public function homeModal($idRequirement = null)
	{
		#pr($idRequirement);
		$usuario = $this->Auth->user('username');
		
		$conditionsTraking	= array(
			'rescursive' => 0,
			'RequirementTracking.requirement_tracking_type_id' => '65c52553-eef0-4651-9175-3df8c26b1ae0',
			'RequirementTracking.requirement_id' => $idRequirement
		);
		#$requirement = $this->Requirement->find('first', $conditionsTraking);
		$this->loadModel('RequirementProcess');
		$processTasksModal = $this->RequirementProcess->find('first', $conditionsTraking);
		#pr($processTasksModal);
		$processTasksModalCount = Count($processTasksModal['RequirementProcessTask']);

		// VISTA DE REQUERIMIENTOS CREADOS POR MI
		$requi = $this->Requirement->RequirementTracking->find(
			'all',
			array(
				'conditions' => array(
					'RequirementTracking.requirement_id' => $idRequirement
				),
				'order' => array(
					'RequirementTracking.tracking_number' 	=> 'DESC',
					'RequirementTracking.order_traking' 	=> 'ASC'
				)
			)
		);
		
		$result = Hash::combine($requi, '{n}.RequirementTracking.id', '{n}', '{n}.RequirementTracking.tracking_number');

		$this->set(compact(
			'idRequirement',
			'result',
			'processTasksModal', 		// TAREA ACTUAL
			'processTasksModalCount',	// TAREA MAX
			'usuario'
		));

		$validaBoton = $this->Requirement->find('first', [
				'Conditions' => ['Requirement.id' => $idRequirement], 
								['RequirementTracking.requirement_tracking_type_id' => '65c52553-eef0-4651-9175-3df8c26b1ae0']

							]);

		$this->render('/Elements/homeModal', 'ajax');

	}


	// ----------------------------
	// 	MODAL - EXPEDIENTE
	// ----------------------------
	public function homeModalExpediente($idRequirement = null)
	{
		$usuario = $this->Auth->user('username');
		$this->loadModel('RequirementTracking');
		$conditions = array(
			'conditions' => array(
				'RequirementTracking.requirement_id' => $idRequirement
			),
			'recursive' 	=> 0
		);
		$requi = $this->Requirement->RequirementTracking->find('all', $conditions);
		$resultExpediente = Hash::combine($requi, '{n}.RequirementTracking.id', '{n}', '{n}.RequirementTracking.tracking_number');

		$this->loadModel('RequirementProcess');
		$conditionsTraking	= array(
			'RequirementTracking.requirement_tracking_type_id' => '65c52553-eef0-4651-9175-3df8c26b1ae0',
			'RequirementTracking.requirement_id' => $idRequirement,
			'recursive' 	=> 1
		);
		$processTasks = $this->RequirementProcess->find('first', $conditionsTraking);

		$this->set(compact(
			'idRequirement',
			'processTasks',
			'resultExpediente',
			'usuario'
		));
		$this->render('/Elements/homeModalExpediente', 'ajax');
	}


	// ----------------------------
	// ----------------------------
	public function searchIdMemos($memoNumber = null, $memoYear = null)
	{
		#debug($memoNumber);
		// CONSULTAMOS EL idNUMERO DEL MEMO
		$this->loadModel('Memo');
		$conditions = array(
			'conditions' => array(
				'Memo.memo_number'	=> $memoNumber,
				'Memo.year' 		=> $memoYear
			)
		);
		$idMemos = $this->Memo->find('first', $conditions);

		if (isset($idMemos['Memo']['id'])) {
			$allIdMemos = $this->parent_child_memo($idMemos['Memo']['id']);
			#debug($allIdMemos);
			$allAttachMemos = $this->Memo->Attachment->find(
				'all',
				array(
					'conditions' => array(
						'OR' => array(
							'memo_id' => $allIdMemos
						)
					)
				)
			);
			#debug($allAttachMemos);
			return $allAttachMemos;
		};
	}


	// ----------------------------
	// ----------------------------
	public function create_zip($idRequirement)
	{
		// --------------------------------------------------------------------------------------
		$zip = new ZipArchive();

		// OBTENEMOS EL NOMBRE DEL ARCHIVO EN BASE DEL ID DE REQUERIMIENTO
		$conditions = array(
			'conditions' => array(
				'Requirement.id' => $idRequirement
			)
		);
		$requi = $this->Requirement->find('first', $conditions);

		// AGREGAMOS EL NOMBRE DEL ARCHIVO AL ZIP
		$zipName = 'P' . $requi['Requirement']['requirement_number'] . '-' . $requi['Requirement']['year'] . '.zip';

		// CONSULTAMOS LA LISTA DE TAREAS ACTUALMENTE CREADAS
		$this->loadModel('RequirementTracking');
		$conditions2 = array(
			'fields' => array('requirement_process_tasks_id', 'requirement_process_tasks_id'),
			'conditions' => array('requirement_id' => $idRequirement)
		);
		$requiIds = $this->Requirement->RequirementTracking->find('list', $conditions2);

		// VALIDAMOS LAS TAREAS QUE TENEMOS EN EL TRACKING
		$allTasks = $this->Requirement->RequirementProcess->RequirementProcessTask->find('all', array('conditions' => array('OR' => array('RequirementProcessTask.id' => $requiIds))));

		if ($zip->open($zipName, ZipArchive::CREATE)) :

			// VUELTAS POR CANTIDAD DE TAREAS REGISTRADAS
			$num_folder = 0;
			$variable 	= 1;
			foreach ($allTasks as $key => $valueTareas) {

				// AGREGAMOS LAS URL AL ARCHIVO
				$urls[]	= 'https://qasgdaf.minmujeryeg.gob.cl/app/webroot/files_requirements/65d7a6a6-57b4-4285-b977-3a98c26b1ae0/chart.pdf';
				$urls[]	= 'https://digital.minmujeryeg.gob.cl/files/66c8ac7f-3118-4deb-9d71-3c490a500003/918434-327-AG24%20Y%20AUTORIZACION.pdf';
				$urls[] = 'https://qasgdaf.minmujeryeg.gob.cl/app/webroot/files_requirements/6672fd74-3208-48fa-a8e6-249cc26b1ae0/21-Entorno-de-desarrollo-seguro.pdf';

				$memo = $this->requestAction('requirements/pdf_descarga/' . '234-2024');

				$zip->addFromString('archivo.pdf', $memo);

				#$urls[] = $this->requestAction('requirements/searchIdMemos/' . $memoAttach[0] . '/' . $memoAttach[1]);

				/*
				$urls[] = $this->Html->link(__('Export Memo (PDF)'),
							array(
									'action' => 'pdf',
									$memo['Memo']['id'],
									'ext' => 'pdf'
							),
							array(
									'class' => '',
									'escape' => false,
									'data-toggle'=>'tooltip',
									'title' => 'export'
							)
						);
				*/

				$num_folder = ++$num_folder;
				foreach ($urls as $key => $url) {
					$fileName 		= basename($url);
					$folder 		= $valueTareas['RequirementProcessTask']['name'];
					$tempFilePath 	= TMP . 'requi_temp/' . $fileName;
					$fileContent 	= file_get_contents($url);
					if ($fileContent === false) {
						die("No se pudo descargar el archivo desde $url.\n");
					}
					file_put_contents($tempFilePath, $fileContent);
					$zip->addFile($tempFilePath, $num_folder . ' - ' . $folder . '/' . $fileName);
				}
				unset($urls);



				/*
				foreach ($requi['RequirementTracking'] as $key => $value) {

					# Agregamos los memos referenciados
					if( $value['requirement_tracking_type_id'] == '65b94f7c-fb7c-4c3c-a2b6-3df80a220016'):
						#echo 'tenemos memo'.'<br>';

						$memosExplode = explode(',', $value['memo_number']);

						foreach ($memosExplode as $key => $valueMemosExplode) :

							# VALIDAMOS NUMERO DE MEMO Y AÑO.
							
							if($valueMemosExplode != ''):
								$memosValidos = $valueMemosExplode;
								$memoAttach = explode('-',$memosValidos);
								$variable += $variable;
								
								// LISTA DE DOCUMENTOS A ADJUNTAR EN ARCHIVO ZIP
								$AttachMemos		= $this->requestAction('requirements/searchIdMemos/' . $memoAttach[0] . '/' . $memoAttach[1]);
								$supplierRatings	= $this->requestAction('requirements/supplierRatings/' .  $memoAttach[0] . '/' . $memoAttach[1]);
								$acceptedReception 	= $this->requestAction('requirements/acceptedReception/' . $memoAttach[0] . '/' . $memoAttach[1]);

								$url = 'https://digital.minmujeryeg.gob.cl/files/66c8ac7f-3118-4deb-9d71-3c490a500003/918434-327-AG24%20Y%20AUTORIZACION.pdf';

								// Descargar y agregar archivos al zip
								#$urls[] = 'https://qasgdaf.minmujeryeg.gob.cl/requirements/pdf/234-2024.pdf';
								
								#exit;
							endif;

						endforeach;
						
					endif;
					
				}
			*/
			}

		endif;

		$zip->close();

		header('Content-Type: application/zip');
		header('Content-disposition: attachment; filename="' . $zipName . '"');
		header('Content-Length: ' . filesize($zipName));

		readfile($zipName);
		unlink($tempFilePath);
		unlink($zipName);

		#exit;
	}



	// ----------------------------
	// ----------------------------
	public function create_zip_exp($idRequirement)
	{

		// --------------------------------------------------------------------------------------
		// CREAMOS UNA NUEVA INSTACIA DE ARCHIVO ZIP
		$zip = new ZipArchive();

		// OBTENEMOS EL NOMBRE DEL ARCHIVO EN BASE DEL ID DE REQUERIMIENTO
		$conditions = array(
			'conditions' => array(
				'Requirement.id' => $idRequirement
			)
		);
		$requi = $this->Requirement->find('first', $conditions);

		foreach ($requi['RequirementTracking'] as $key => $value) :
			if ($value['requirement_process_tasks_id'] == '66993bc2-5e48-447d-b3d9-3eab0a320009' && $value['requirement_tracking_type_id'] == '65b94f7c-fb7c-4c3c-a2b6-3df80a220016') :
				$memosExplode = explode(',', $value['memo_number']);
				foreach ($memosExplode as $key => $valueMemosExplode) :
					if ($valueMemosExplode != '') :
						$memosValidos[] = $valueMemosExplode;
					endif;
				endforeach;
			endif;
		endforeach;

		// AGREGAMOS EL NOMBRE DEL ARCHIVO AL ZIP
		$zipName = 'P' . $requi['Requirement']['requirement_number'] . '-' . $requi['Requirement']['year'] . '.zip';

		foreach ($memosValidos as $key => $valueMemosExplode) :

			// VALIDAMOS NUMERO DE MEMO Y AÑO.
			if ($valueMemosExplode != '') :
				$memosValidos = $valueMemosExplode;
				$memoAttach = explode('-', $memosValidos);

				// URL DEL MEMO DIGITAL ADJUNTO
				#$urlMemo = 'https://qasgdaf.minmujeryeg.gob.cl'. '/requirements/pdf_download/'.$valueMemosExplode.'.pdf';

				// LISTA DE DOCUMENTOS A ADJUNTAR EN ARCHIVO ZIP
				$AttachMemos		= $this->requestAction('requirements/searchIdMemos/' . $memoAttach[0] . '/' . $memoAttach[1]);
				$supplierRatings	= $this->requestAction('requirements/supplierRatings/' .  $memoAttach[0] . '/' . $memoAttach[1]);
				$acceptedReception 	= $this->requestAction('requirements/acceptedReception/' . $memoAttach[0] . '/' . $memoAttach[1]);

				// AGREGAMOS LOS ATTACHMEMOS A NUESTRO ARCHIVO URL
				foreach ($AttachMemos as $key => $value) :
					$urlAttachMemos[] = 'https://digital.minmujeryeg.gob.cl/files/' . $value['Attachment']['id'] . '/' . $value['Attachment']['name'];
				endforeach;

				//AGREGAMOS NUESTRO CALIFICACION DE PROVEEDOR
				$urlsupplierRatings = 'https://qasgdaf.minmujeryeg.gob.cl/supplier_ratings/pdf/' . $supplierRatings . '.pdf';
				//AGREGAMOS NUESTRO RECEPCION CONFORME
				$urlacceptedReception = 'https://qasgdaf.minmujeryeg.gob.cl/accepted_receptions/pdf/' . $acceptedReception . '.pdf';

				$urls = $urlAttachMemos;
				#$urls[] = $urlMemo;
				#$urls[] = $urlsupplierRatings;
				#$urls[] = $urlacceptedReception;

				if ($zip->open($zipName, ZipArchive::CREATE)) :


					// AGREGAMOS LOS ARCHIVOS ADJUNTOS A EL MEMO
					foreach ($urls as $key => $url) :
						$url = str_replace(' ', '%20', $url);
						$fileName 		= basename($url);
						$tempFilePath 	= TMP . 'requi_temp/' . $fileName;

						$fileContent 	= file_get_contents($url);
						if ($fileContent === false) {
							die("No se pudo descargar el archivo desde $url \n");
						}
						file_put_contents($tempFilePath, $fileContent);
						$zip->addFile($tempFilePath, $fileName);
					endforeach;

					unset($urls);

				endif;

				$zip->close();

				header('Content-Type: application/zip');
				header('Content-disposition: attachment; filename="' . basename($zipName) . '"');
				header('Content-Length: ' . filesize($zipName));

				readfile($zipName);
				unlink($tempFilePath);
				unlink($zipName);

			endif;

		endforeach;

		#exit;


		// CONSULTAMOS LA LISTA DE TAREAS ACTUALMENTE CREADAS
		$this->loadModel('RequirementTracking');
		$conditions2 = array(
			'fields' => array('requirement_process_tasks_id', 'requirement_process_tasks_id'),
			'conditions' => array('requirement_id' => $idRequirement)
		);
		$requiIds = $this->Requirement->RequirementTracking->find('list', $conditions2);

		// VALIDAMOS LAS TAREAS QUE TENEMOS EN EL TRACKING
		$allTasks = $this->Requirement->RequirementProcess->RequirementProcessTask->find('all', array('conditions' => array('OR' => array('RequirementProcessTask.id' => $requiIds))));

		if ($zip->open($zipName, ZipArchive::CREATE)) :

			// VUELTAS POR CANTIDAD DE TAREAS REGISTRADAS
			$num_folder = 0;
			$variable 	= 1;
			foreach ($allTasks as $key => $valueTareas) {

				// AGREGAMOS LAS URL AL ARCHIVO
				$urls[]	= 'https://qasgdaf.minmujeryeg.gob.cl/app/webroot/files_requirements/65d7a6a6-57b4-4285-b977-3a98c26b1ae0/chart.pdf';
				$urls[]	= 'https://digital.minmujeryeg.gob.cl/files/66c8ac7f-3118-4deb-9d71-3c490a500003/918434-327-AG24%20Y%20AUTORIZACION.pdf';
				$urls[] = 'https://qasgdaf.minmujeryeg.gob.cl/app/webroot/files_requirements/6672fd74-3208-48fa-a8e6-249cc26b1ae0/21-Entorno-de-desarrollo-seguro.pdf';

				$memo = $this->requestAction('requirements/pdf_descarga/' . '234-2024');

				$zip->addFromString('archivo.pdf', $memo);

				$num_folder = ++$num_folder;
				foreach ($urls as $key => $url) {
					$fileName 		= basename($url);
					$folder 		= $valueTareas['RequirementProcessTask']['name'];
					$tempFilePath 	= TMP . 'requi_temp/' . $fileName;
					$fileContent 	= file_get_contents($url);
					if ($fileContent === false) {
						die("No se pudo descargar el archivo desde $url.\n");
					}
					file_put_contents($tempFilePath, $fileContent);
					$zip->addFile($tempFilePath, $num_folder . ' - ' . $folder . '/' . $fileName);
				}
				unset($urls);
			}

		endif;

		#exit;
		$zip->close();

		header('Content-Type: application/zip');
		header('Content-disposition: attachment; filename="' . $zipName . '"');
		header('Content-Length: ' . filesize($zipName));

		readfile($zipName);
		unlink($tempFilePath);
		unlink($zipName);

		#exit;
	}


	public function acceptedReception($memoNumber = null, $memoYear = null)
	{
		// CONSULTAMOS EL idNUMERO DEL MEMO
		$this->loadModel('Memo');
		$conditions = array(
			'conditions' => array(
				'Memo.memo_number'	=> $memoNumber,
				'Memo.year' 		=> $memoYear
			)
		);
		$idMemos = $this->Memo->find('first', $conditions);
		if (isset($idMemos['Memo']['id'])) {
			$allIdMemos = $this->parent_child_memo($idMemos['Memo']['id']);

			$conditionsMemoTracking = array(
				'conditions' => array(
					'MemoTracking.memo_id' => $allIdMemos,
					#'MemoTracking.memo_tracking_type_id' => '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0'
				)
			);

			$this->loadModel('MemoTracking');
			$memoTracking = $this->MemoTracking->find('all', $conditionsMemoTracking);
			foreach ($memoTracking as $key => $value) {
				# code...
				if (count($value['AcceptedReception']) > 0) {
					#debug($value['AcceptedReception'][0]['id']);
					return $value['AcceptedReception'][0]['id'];
				}
			}
		};
	}


	public function supplierRatings($memoNumber = null, $memoYear = null)
	{
		// CONSULTAMOS EL idNUMERO DEL MEMO
		$this->loadModel('Memo');
		$conditions = array(
			'conditions' => array(
				'Memo.memo_number'	=> $memoNumber,
				'Memo.year' 		=> $memoYear
			)
		);
		$idMemos = $this->Memo->find('first', $conditions);
		if (isset($idMemos['Memo']['id'])) {
			$allIdMemos = $this->parent_child_memo($idMemos['Memo']['id']);

			$conditionsMemoTracking = array(
				'conditions' => array(
					'MemoTracking.memo_id' => $allIdMemos,
					#'MemoTracking.memo_tracking_type_id' => '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0'
				)
			);

			$this->loadModel('MemoTracking');
			$memoTracking = $this->MemoTracking->find('all', $conditionsMemoTracking);
			#debug($memoTracking);
			foreach ($memoTracking as $key => $value) {
				# code...
				#debug($value['AcceptedReception']);
				if (count($value['SupplierRating']) > 0) {
					#debug($value['AcceptedReception'][0]['id']);
					return $value['SupplierRating'][0]['id'];
				}
			}
		};
	}

	// ----------------------------
	// ----------------------------
	public function pdf($numberMemo = null, $download = false)
	{
		$this->loadModel('User');
		$this->loadModel('Memo');

		$numberMemo = explode('-', $numberMemo);

		$id = $this->Memo->field('id', array('memo_number' => $numberMemo[0], 'year' => $numberMemo[1]));

		App::import('Controller', 'Users');
		$UsersController = new UsersController;

		if (!$this->Memo->exists($id)) {
			throw new NotFoundException(__('Número de Memo invalido'));
		}

		# DOCUMENTOS ADJUNTOS DE UN MEMO
		$memosIds = $this->parent_child_memo($id);

		$leadershipMemo = $this->Memo->MemoTracking->query('SELECT * FROM memo_trackings MemoTracking
            LEFT JOIN users User ON User.username = MemoTracking.to
            LEFT JOIN memos Memo ON Memo.id = MemoTracking.memo_id
            LEFT JOIN subrogances Subrogance ON Subrogance.id = MemoTracking.subrogance_id
            WHERE
                MemoTracking.viewed = false AND
                ((User.group_id = 2) OR (MemoTracking.subrogance_id IS NOT NULL) ) AND
                MemoTracking.memo_tracking_type_id = "5ba4f0ba-ec28-471e-af3e-2630c26b1ae0" AND
                MemoTracking.memo_id IN ("' . implode('","', $memosIds) . '")
            ORDER BY MemoTracking.created DESC');

		$memosIdsLeadership = Hash::combine($leadershipMemo, '{n}.Memo.id', '{n}.Memo.id');

		$userTracking = $this->Memo->MemoTracking->query('SELECT * FROM memo_trackings MemoTracking LEFT JOIN users User ON User.username = MemoTracking.to LEFT JOIN memos Memo ON Memo.id = MemoTracking.memo_id WHERE MemoTracking.memo_id IN ("' . implode('","', $memosIdsLeadership) . '")');

		$this->pdfConfig = array(
			'download' => false,
			'filename' => (!empty($leadershipMemo)) ? $leadershipMemo[0]['Memo']['reference'] . '.pdf' : 'sin respuesta.pdf',
		);

		$this->set(compact('leadershipMemo', 'userTracking', 'existSubroganceMemo', 'leadershipMemo'));
	}

	// ----------------------------
	// ----------------------------
	public function pdf_download($numberMemo = null, $download = false)
	{
		$this->loadModel('User');
		$this->loadModel('Memo');

		$numberMemo = explode('-', $numberMemo);

		$id = $this->Memo->field('id', array('memo_number' => $numberMemo[0], 'year' => $numberMemo[1]));

		App::import('Controller', 'Users');
		$UsersController = new UsersController;

		if (!$this->Memo->exists($id)) {
			throw new NotFoundException(__('Número de Memo invalido'));
		}

		# DOCUMENTOS ADJUNTOS DE UN MEMO
		$memosIds = $this->parent_child_memo($id);

		$leadershipMemo = $this->Memo->MemoTracking->query('SELECT * FROM memo_trackings MemoTracking
            LEFT JOIN users User ON User.username = MemoTracking.to
            LEFT JOIN memos Memo ON Memo.id = MemoTracking.memo_id
            LEFT JOIN subrogances Subrogance ON Subrogance.id = MemoTracking.subrogance_id
            WHERE
                MemoTracking.viewed = false AND
                ((User.group_id = 2) OR (MemoTracking.subrogance_id IS NOT NULL) ) AND
                MemoTracking.memo_tracking_type_id = "5ba4f0ba-ec28-471e-af3e-2630c26b1ae0" AND
                MemoTracking.memo_id IN ("' . implode('","', $memosIds) . '")
            ORDER BY MemoTracking.created DESC');

		$memosIdsLeadership = Hash::combine($leadershipMemo, '{n}.Memo.id', '{n}.Memo.id');

		$userTracking = $this->Memo->MemoTracking->query('SELECT * FROM memo_trackings MemoTracking LEFT JOIN users User ON User.username = MemoTracking.to LEFT JOIN memos Memo ON Memo.id = MemoTracking.memo_id WHERE MemoTracking.memo_id IN ("' . implode('","', $memosIdsLeadership) . '")');

		$this->pdfConfig = array(
			'download' => false,
			'filename' => (!empty($leadershipMemo)) ? $leadershipMemo[0]['Memo']['reference'] . '.pdf' : 'sin respuesta.pdf',
		);

		$this->set(compact('leadershipMemo', 'userTracking', 'existSubroganceMemo', 'leadershipMemo'));
	}

	// ----------------------------
	// ----------------------------
	public function pdf_descarga($numberMemo = null, $download = true)
	{
		$this->loadModel('User');
		$this->loadModel('Memo');

		$numberMemo = explode('-', $numberMemo);

		$id = $this->Memo->field('id', array('memo_number' => $numberMemo[0], 'year' => $numberMemo[1]));

		App::import('Controller', 'Users');
		$UsersController = new UsersController;

		if (!$this->Memo->exists($id)) {
			throw new NotFoundException(__('Número de Memo invalido'));
		}

		# DOCUMENTOS ADJUNTOS DE UN MEMO
		$memosIds = $this->parent_child_memo($id);

		$leadershipMemo = $this->Memo->MemoTracking->query('SELECT * FROM memo_trackings MemoTracking
            LEFT JOIN users User ON User.username = MemoTracking.to
            LEFT JOIN memos Memo ON Memo.id = MemoTracking.memo_id
            LEFT JOIN subrogances Subrogance ON Subrogance.id = MemoTracking.subrogance_id
            WHERE
                MemoTracking.viewed = false AND
                ((User.group_id = 2) OR (MemoTracking.subrogance_id IS NOT NULL) ) AND
                MemoTracking.memo_tracking_type_id = "5ba4f0ba-ec28-471e-af3e-2630c26b1ae0" AND
                MemoTracking.memo_id IN ("' . implode('","', $memosIds) . '")
            ORDER BY MemoTracking.created DESC');

		$memosIdsLeadership = Hash::combine($leadershipMemo, '{n}.Memo.id', '{n}.Memo.id');

		$userTracking = $this->Memo->MemoTracking->query('SELECT * FROM memo_trackings MemoTracking LEFT JOIN users User ON User.username = MemoTracking.to LEFT JOIN memos Memo ON Memo.id = MemoTracking.memo_id WHERE MemoTracking.memo_id IN ("' . implode('","', $memosIdsLeadership) . '")');

		$this->pdfConfig = array(
			'download' => false,
			'filename' => (!empty($leadershipMemo)) ? $leadershipMemo[0]['Memo']['reference'] . '.pdf' : 'sin respuesta.pdf',
		);

		#return $this->response;
		$this->set(compact('leadershipMemo', 'userTracking', 'existSubroganceMemo', 'leadershipMemo'));
	}

	public function parent_child_memo($memoId = null)
	{

		$this->loadModel('Memo');

		$childMemoId = $parentMemoId = NULL;

		$childMemoId = $this->Memo->field('id', array('parent_id' => $memoId));
		$parentMemoId = $this->Memo->field('parent_id', array('id' => $memoId));

		if (($childMemoId) and empty($this->allMemoId[$childMemoId])) {
			$this->allMemoId[$childMemoId] = $childMemoId;
			$lastMemo = true;
			$this->parent_child_memo($childMemoId, true);
		}

		if (($parentMemoId) and empty($this->allMemoId[$parentMemoId])) {
			$this->allMemoId[$parentMemoId] = $parentMemoId;
			$lastMemo = true;
			$this->parent_child_memo($parentMemoId, true);
		}

		if (is_null($this->allMemoId)) $this->allMemoId[$memoId] = $memoId;

		return $this->allMemoId;
	}

	// ----------------------------
	// ----------------------------	
	public function contact_email($type = null, $username = null, $requirementId = null /*, $observation = null, $memoIdSecond = null */)
	{
		$this->loadModel('User');
		$this->loadModel('Requirement');
		$this->loadModel('Share');

		// --------------------------------------------------------
		//	VALIDAMOS AREA Y USUARIOS PARA NOTIFICACION
		// --------------------------------------------------------
		if ($username) :
			#$areaEspecifica = 'INFORMATICA';
			$areaEspecifica = $this->Session->read('Auth.User.area');
			$emailUsuarios = $this->User->find('list', [
				'conditions' => ['User.area' => $areaEspecifica],
				'fields' => ['User.username']
			]);
		endif;

		$requirement 	= $this->Requirement->find('first', array('conditions' => array('Requirement.id' => $requirementId)));
		$number 		= 'P' . $requirement['Requirement']['requirement_number'] . '-' . $requirement['Requirement']['year'];
		$name			= $requirement['Requirement']['name'];
		$creator		= $requirement['Requirement']['creator'];
		$area			= $requirement['Requirement']['area'];

		$sendMail = $this->User->field('email', array('User.username' => $username));
		$subject = $message = NULL;
		$findParentUser = $this->Share->find('first', array('conditions' => array('Share.username' => $username)));

		(!empty($findParentUser['Parent']['username']) and !($sendMail)) ? $username = $findParentUser['Parent']['username'] : NULL;

		if ($type == 0) : // Crear Proceso
			$subject = 'SGDAF - Nuevo proceso: '.$number;
			$message =
				'Estimado(a). <br><br> 
				Se ha iniciado un nuevo proceso: <b>' . $number . '</b><br>'.
				#'<b>Creado por: </b>'.'Creador'.'<br>'. 
				#'<b>Area: </b>'.'Area'.
				'Referencía: '. $name;
		elseif ($type == 1) : // Nuevo Registro
			$subject = 'SGDAF - Nuevo registro: '. $number;
			$message =
				'Estimado(a). <br><br> 
				Se ha guardado un nuevo registro del proceso: <b>' . $number . '</b><br>'.
				#'<b>Creado por: </b>'.'Creador'.'<br>'. 
				#'<b>Area: </b>'.'Area'.
				'Referencía: '. $name;
		endif;
		/*
			if (@$findParentUser['Share']['username'] == 'ipla') : // Ministr@
				$usersEmail[] = $username . '@minmujeryeg.gob.cl';
				$usersEmail[] = 'mvial@minmujeryeg.gob.cl';
			elseif (@$findParentUser['Share']['username'] == 'mzalaquett') : // Ministr@
				$usersEmail[] = $username . '@minmujeryeg.gob.cl';
				$usersEmail[] = 'psiegel@minmujeryeg.gob.cl';
			else :
				if (is_array($username)) :
					foreach ($username as $usernameEmail) :
						$usersEmail[] = $usernameEmail . '@minmujeryeg.gob.cl';
					endforeach;
				else :
					$usersEmail[] = $username . '@minmujeryeg.gob.cl';
				endif;
			endif;
		*/

		foreach ($emailUsuarios as $key => $value) {
			# code...
			$usersEmail[] = $value . '@minmujeryeg.gob.cl';
		}
		
		$Email = new CakeEmail();
		$Email->config('smtp')
		->emailFormat('html')
		->template('default')
		->to($usersEmail)
		->subject($subject);
				
		if ($Email->send($message)) {
				#debug($emailUsuarios);exit;
				// Acción
			} else {
				#debug($emailUsuarios);exit;
				// INFORMATICA
			$this->Session->setFlash(__('Problem during sending email.'), 'flash/error');
		}
		
	}


	//-------------------------------------------------------
	//	beforeFilter
	//-------------------------------------------------------
	public function beforeFilter()
	{

		// ----------------------------
		//	FORMA MULA DE DAR PERSMISOS A UNA VISTA
		// ----------------------------
		parent::beforeFilter();
		$this->Auth->allow(
			'login',
			'search',
			'pdf',
			'pdf_download',
			'home',
			'homeModalExpediente',
			'searchModal',
			'contact_email',
			'requirement_approval',
			'requirement_tracking_types',
			'homeModal',
			'parent_child_memo',
			'searchIdMemos',
			'create_zip',
			'create_zip_exp',
			'acceptedReception',
			'supplierRatings'
		);
	}
}
