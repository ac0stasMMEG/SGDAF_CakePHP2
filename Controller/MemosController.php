<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Memos Controller
 *
 * @property Memo $Memo
 * @property PaginatorComponent $Paginator
 */
class MemosController extends AppController
{

    var $allMemoId = NULL;

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'RequestHandler');

    public $actsAs = array('Containable');

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {

        $this->loadModel('Share');
        $this->loadModel('User');

        if ($this->request->is('post')) : //debug($this->request->data); exit;
            if (!empty($this->request->data['Memo']['changeUser'])) :
                $this->Session->write('Auth.User.username', $this->request->data['Memo']['changeUser']);
            else :
                $this->Session->write('Auth.User.startDate', $this->request->data['Memo']['startDate']);
                $this->Session->write('Auth.User.endDate', $this->request->data['Memo']['endDate']);
                $this->Session->write('Auth.User.read', ($this->request->data['Memo']['read'] == '') ? array(0 => 0, 1 => 1) : $this->request->data['Memo']['read']);
            endif;
        endif;

        $startDate = empty($this->Session->read('Auth.User.startDate')) ? date('Y-m-d', strtotime(date('Y-m-d') . ' - 30 days')) : $this->Session->read('Auth.User.startDate');
        $endDate = empty($this->Session->read('Auth.User.endDate')) ? date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days')) : $this->Session->read('Auth.User.endDate');
        $read = is_array($this->Session->read('Auth.User.read')) ? array(0 => 0, 1 => 1) : $this->Session->read('Auth.User.read');
        $merge = $this->User->field('merge', array('username' => $this->Auth->user('username')));

        if (is_null($read)) {
            $read = array(0 => 0, 1 => 1);
        }

        $sharesDraft = $this->Share->find('all', array('conditions' => array('Share.username' => $this->Auth->user('username')))); //debug($sharesDraft);

        if (!empty($sharesDraft[0]['Share'])) :
            $sharesAddressee = $this->Share->find('list', array('fields' => array('username', 'username'), 'conditions' => array('parent_id' => $sharesDraft[0]['Share']['id']))); //debug($sharesAddressee);
        endif;

        $sharesDraft = Hash::combine($sharesDraft, '{n}.Parent.username', '{n}.Parent.username'); //debug($sharesDraft);

        if ($sharesDraft) :
            $usersParent = array_merge($sharesDraft, array($this->Auth->user('username') => $this->Auth->user('username'))); //debug($users);
        else :
            $usersParent = $this->Auth->user('username');
        endif;

        if (!empty($sharesAddressee)) :
            $usersChild = array_merge($sharesAddressee, array($this->Auth->user('username') => $this->Auth->user('username'))); //debug($users);
        else :
            $usersChild = $this->Auth->user('username');
        endif;

        $this->Memo->MemoTracking->recursive = 0;

        $addresseeMemos = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.read' => $read, 'MemoTracking.to' => $usersChild, 'Memo.state_id IS NULL', 'OR' => array(array('MemoTracking.memo_tracking_type_id' => '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0'), array('MemoTracking.memo_tracking_type_id' => '5c924533-db78-449d-b52a-0450c26b1ae0')), 'MemoTracking.viewed' => 0, 'Memo.memo_number IS NOT NULL', 'MemoTracking.created BETWEEN ? and ?' => array($startDate, $endDate)), 'group' => array('MemoTracking.memo_id'), 'order' => array('Memo.created DESC'))); //debug($addresseeMemos[0]);

        $myMemos = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.read' => $read, 'MemoTracking.to' => $usersChild, 'MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0', 'MemoTracking.viewed' => 0, 'Memo.memo_number IS NOT NULL', 'MemoTracking.created BETWEEN ? and ?' => array($startDate, $endDate)), 'group' => array('MemoTracking.memo_id'), 'order' => array('Memo.created DESC'))); //debug($myMemos);

        $notifyMemos = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.read' => $read, 'MemoTracking.to' => $this->Auth->user('username'), 'MemoTracking.memo_tracking_type_id' => '5b8588ba-ef8c-49e1-8592-1f68c26b1ae0', 'MemoTracking.viewed' => 0, 'Memo.memo_number IS NOT NULL', 'MemoTracking.created BETWEEN ? and ?' => array($startDate, $endDate)), 'group' => array('MemoTracking.memo_id'), 'order' => array('Memo.created DESC')));

        $draftMemos = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.read' => $read, 'MemoTracking.to' => $usersParent, 'MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0', 'MemoTracking.viewed' => 0, 'Memo.memo_number IS NULL', 'Memo.state_id IS NULL', 'MemoTracking.created BETWEEN ? and ?' => array($startDate, $endDate)), 'group' => array('MemoTracking.memo_id'), 'order' => array('Memo.modified DESC')));

        $completeMemos = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.read' => $read, 'MemoTracking.to' => $usersChild, 'OR' => array(array('MemoTracking.memo_tracking_type_id' => '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0'), array('MemoTracking.memo_tracking_type_id' => '5c924533-db78-449d-b52a-0450c26b1ae0')), 'MemoTracking.viewed' => 0, 'Memo.memo_number IS NOT NULL', 'Memo.state_id IS NOT NULL', 'MemoTracking.created BETWEEN ? and ?' => array($startDate, $endDate)), 'group' => array('MemoTracking.memo_id'), 'order' => array('Memo.created DESC'))); //debug($addresseeMemos[0]);

        /*$myMemos = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0', 'MemoTracking.viewed' => 0, 'Memo.memo_number IS NOT NULL'), 'group' => array('MemoTracking.memo_id'), 'order' => array('Memo.modified DESC'), 'limit' => 20));
        
        $addresseeMemos = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.memo_tracking_type_id' => '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0', 'MemoTracking.viewed' => 0), 'group' => array('MemoTracking.memo_id'), 'order' => array('Memo.modified DESC'), 'limit' => 20));
        
        $notifyMemos = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.memo_tracking_type_id' => '5b8588ba-ef8c-49e1-8592-1f68c26b1ae0', 'MemoTracking.viewed' => 0), 'group' => array('MemoTracking.memo_id'), 'order' => array('Memo.modified DESC'), 'limit' => 20));
        
        $draftMemos = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0', 'MemoTracking.viewed' => 0, 'Memo.memo_number IS NULL'), 'group' => array('MemoTracking.memo_id'), 'order' => array('Memo.modified DESC'), 'limit' => 20));*/

        $reads = array(1 => __('Leídos'), 0 => _('No Leídos'));

        $this->set(compact('read', 'reads', 'completeMemos', 'myMemos', 'addresseeMemos', 'notifyMemos', 'draftMemos', 'endDate', 'startDate', 'merge'));
    }

    /**
     * parts_office method
     *
     * @return void
     */
    public function parts_office()
    {

        $this->loadModel('User');

        $usersNames = $this->User->find('list', array('conditions' => array('group_id' => 4), 'fields' => array('username', 'username')));
        $startDate = date('Y-m-d', strtotime(date('Y-m-d') . ' - 30 days'));
        $endDate = date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days'));
        $reference = null;

        if ($this->request->is('post')) :
            $startDate = $this->request->data['Memo']['startDate'];
            $endDate = $this->request->data['Memo']['endDate'];
            $reference = @$this->request->data['Memo']['reference'];
        endif;

        $memos = $this->Memo->MemoTracking->find(
            'all',
            array(
                'conditions' => array(
                    'MemoTracking.to IN' => $usersNames,
                    'MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0',
                    'Memo.memo_number IS NOT NULL',
                    'MemoTracking.created BETWEEN ? and ?' => array($startDate, $endDate), 'OR' => array(
                        array('Memo.memo_number LIKE' => '%' . $reference . '%'),
                        array('Memo.reference LIKE' => '%' . $reference . '%'),
                        array('Memo.description LIKE' => '%' . $reference . '%'),
                        array('Memo.external_office LIKE' => '%' . $reference . '%'),
                        array('Memo.internal_office LIKE' => '%' . $reference . '%')
                    )
                ),
                'group' => array('MemoTracking.memo_id'),
                'order' => array('Memo.created DESC'),
            )
        ); //debug($memos); exit;

        $this->set(compact('memos', 'endDate', 'startDate', 'reference'));
    }

    /**
     * parts_office_excel method
     *
     * @return void
     */
    public function parts_office_excel($year = null)
    {

        $this->layout = false;

        $this->loadModel('User');

        $usersNames = $this->User->find('list', array('conditions' => array('group_id' => 4), 'fields' => array('username', 'username')));


        $memos = $this->Memo->MemoTracking->find(
            'all',
            array(
                'conditions' => array(
                    'MemoTracking.to IN' => $usersNames,
                    'MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0',
                    'Memo.memo_number IS NOT NULL',
                    'Memo.created LIKE' => $year . '%',
                ),
                'group' => array('MemoTracking.memo_id'),
                'order' => array('Memo.created DESC'),
            )
        ); //debug($memos); exit;

        $this->set(compact('memos', 'year'));
    }

    /**
     * office_number method
     *
     * @return void
     */
    public function office_number($id = null, $external = null, $number = null)
    {

        $this->autoRender = false;

        if ($external == '1') :
            $this->request->data['Memo']['external_office'] = $number;
        else :
            $this->request->data['Memo']['internal_office'] = $number;
        endif;

        $this->Memo->id = $id;
        $this->Memo->save($this->request->data['Memo']);
    }

    /**
     * index method
     *
     * @return void
     */
    public function index_modern()
    {

        $this->loadModel('Share');

        if ($this->request->is('post')) : //debug($this->request->data); exit;
            if (!empty($this->request->data['Memo']['changeUser'])) :
                $this->Session->write('Auth.User.username', $this->request->data['Memo']['changeUser']);
            else :
                $this->Session->write('Auth.User.startDate', $this->request->data['Memo']['startDate']);
                $this->Session->write('Auth.User.endDate', $this->request->data['Memo']['endDate']);
                $this->Session->write('Auth.User.read', ($this->request->data['Memo']['read'] == '') ? array(0 => 0, 1 => 1) : $this->request->data['Memo']['read']);
            endif;
        endif;

        $startDate = empty($this->Session->read('Auth.User.startDate')) ? date('Y-m-d', strtotime(date('Y-m-d') . ' - 10 days')) : $this->Session->read('Auth.User.startDate');
        $endDate = empty($this->Session->read('Auth.User.endDate')) ? date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days')) : $this->Session->read('Auth.User.endDate');
        $read = is_array($this->Session->read('Auth.User.read')) ? array(0 => 0, 1 => 1) : $this->Session->read('Auth.User.read');

        $sharesDraft = $this->Share->find('all', array('conditions' => array('Share.username' => $this->Auth->user('username')))); //debug($sharesDraft);

        if (!empty($sharesDraft[0]['Share'])) :
            $sharesAddressee = $this->Share->find('list', array('fields' => array('username', 'username'), 'conditions' => array('parent_id' => $sharesDraft[0]['Share']['id']))); //debug($sharesAddressee);
        endif;

        $sharesDraft = Hash::combine($sharesDraft, '{n}.Parent.username', '{n}.Parent.username'); //debug($sharesDraft);

        if ($sharesDraft) :
            $usersParent = array_merge($sharesDraft, array($this->Auth->user('username') => $this->Auth->user('username'))); //debug($users);
        else :
            $usersParent = $this->Auth->user('username');
        endif;

        if (!empty($sharesAddressee)) :
            $usersChild = array_merge($sharesAddressee, array($this->Auth->user('username') => $this->Auth->user('username'))); //debug($users);
        else :
            $usersChild = $this->Auth->user('username');
        endif;

        $this->Memo->MemoTracking->recursive = 0;

        $addresseeMemos = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.read' => $read, 'MemoTracking.to' => $usersChild, 'OR' => array(array('MemoTracking.memo_tracking_type_id' => '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0'), array('MemoTracking.memo_tracking_type_id' => '5c924533-db78-449d-b52a-0450c26b1ae0')), 'MemoTracking.viewed' => 0, 'Memo.memo_number IS NOT NULL', 'Memo.state_id IS NULL', 'MemoTracking.created BETWEEN ? and ?' => array($startDate, $endDate)), 'group' => array('MemoTracking.memo_id'), 'order' => array('Memo.created DESC'))); //debug($addresseeMemos[0]);

        $myMemos = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.read' => $read, 'MemoTracking.to' => $usersChild, 'MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0', 'MemoTracking.viewed' => 0, 'Memo.memo_number IS NOT NULL', 'Memo.state_id IS NULL', 'MemoTracking.created BETWEEN ? and ?' => array($startDate, $endDate)), 'group' => array('MemoTracking.memo_id'), 'order' => array('Memo.created DESC'))); //debug($myMemos);

        $notifyMemos = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.read' => $read, 'MemoTracking.to' => $this->Auth->user('username'), 'MemoTracking.memo_tracking_type_id' => '5b8588ba-ef8c-49e1-8592-1f68c26b1ae0', 'MemoTracking.viewed' => 0, 'Memo.memo_number IS NOT NULL', 'Memo.state_id IS NULL', 'MemoTracking.created BETWEEN ? and ?' => array($startDate, $endDate)), 'group' => array('MemoTracking.memo_id'), 'order' => array('Memo.created DESC')));

        $draftMemos = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.read' => $read, 'MemoTracking.to' => $usersParent, 'MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0', 'MemoTracking.viewed' => 0, 'Memo.memo_number IS NULL', 'Memo.state_id IS NULL', 'MemoTracking.created BETWEEN ? and ?' => array($startDate, $endDate)), 'group' => array('MemoTracking.memo_id'), 'order' => array('Memo.modified DESC')));

        $completeMemos = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.read' => $read, 'MemoTracking.to' => $usersChild, 'OR' => array(array('MemoTracking.memo_tracking_type_id' => '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0'), array('MemoTracking.memo_tracking_type_id' => '5c924533-db78-449d-b52a-0450c26b1ae0')), 'MemoTracking.viewed' => 0, 'Memo.memo_number IS NOT NULL', 'Memo.state_id IS NOT NULL', 'MemoTracking.created BETWEEN ? and ?' => array($startDate, $endDate)), 'group' => array('MemoTracking.memo_id'), 'order' => array('Memo.created DESC'))); //debug($addresseeMemos[0]);

        /*$myMemos = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0', 'MemoTracking.viewed' => 0, 'Memo.memo_number IS NOT NULL'), 'group' => array('MemoTracking.memo_id'), 'order' => array('Memo.modified DESC'), 'limit' => 20));
        
        $addresseeMemos = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.memo_tracking_type_id' => '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0', 'MemoTracking.viewed' => 0), 'group' => array('MemoTracking.memo_id'), 'order' => array('Memo.modified DESC'), 'limit' => 20));
        
        $notifyMemos = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.memo_tracking_type_id' => '5b8588ba-ef8c-49e1-8592-1f68c26b1ae0', 'MemoTracking.viewed' => 0), 'group' => array('MemoTracking.memo_id'), 'order' => array('Memo.modified DESC'), 'limit' => 20));
        
        $draftMemos = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0', 'MemoTracking.viewed' => 0, 'Memo.memo_number IS NULL'), 'group' => array('MemoTracking.memo_id'), 'order' => array('Memo.modified DESC'), 'limit' => 20));*/

        $reads = array(1 => __('Leídos'), 0 => _('No Leídos'));

        $this->set(compact('read', 'reads', 'completeMemos', 'myMemos', 'addresseeMemos', 'notifyMemos', 'draftMemos', 'endDate', 'startDate'));
    }

    /**
     * index method
     *
     * @return void
     */
    public function time_line($id = null, $short = null)
    {
        $this->Memo->MemoTracking->recursive = -1;
        $memosIds = $this->parent_child_memo($id);
        $allMemos = $this->Memo->find('all', array('contain' => array('Matter', 'MemoType', 'Attachment' => array('conditions' => array('disable' => 0)), 'MemoTracking' => array('conditions' => array('viewed' => 0))), 'fields' => array('*'), 'conditions' => array('Memo.id' => $memosIds, 'Memo.memo_number IS NOT NULL'), 'order' => array('Memo.created DESC'))); //debug($allMemos);

        $this->set(compact('allMemos', 'short'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {

        $this->loadModel('User');
        $this->loadModel('Subrogance');
        $this->loadModel('Share');

        App::import('Controller', 'Users');
        $UsersController = new UsersController;

        if (!$this->Memo->exists($id)) {
            throw new NotFoundException(__('Invalid memo'));
        }

        $memo = $this->Memo->find('first', array('contain' => array('ParentMemo', 'Matter', 'MemoTracking' => array('conditions' => array('viewed' => 0, 'memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0'))), 'conditions' => array('Memo.id' => $id))); //debug($memo);

        $from = $this->Auth->user('username');
        $memosIds = $this->parent_child_memo($id);
        $allMemos = $this->Memo->find('all', array('conditions' => array('Memo.id' => $memosIds), 'order' => array('Memo.created DESC')));
        $allAttachMemos = $this->Memo->Attachment->find('all', array('conditions' => array('memo_id' => $memosIds, 'disable' => 0)));
        $memoAddressee = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.viewed' => 0, 'MemoTracking.memo_id' => $id, 'MemoTracking.memo_tracking_type_id' => '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0')));
        $memoNotify = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.viewed' => 0, 'MemoTracking.memo_id' => $id, 'MemoTracking.memo_tracking_type_id' => '5b8588ba-ef8c-49e1-8592-1f68c26b1ae0')));
        $myMemoTrackings = $this->Memo->MemoTracking->find('list', array('fields' => array('id', 'id'), 'conditions' => array('memo_id' => $memosIds)));
        $idformAcceptedReception = $this->Memo->MemoTracking->AcceptedReception->field('id', array('memo_tracking_id' => $myMemoTrackings));
        $idformSupplierRating = $this->Memo->MemoTracking->SupplierRating->field('id', array('memo_tracking_id' => $myMemoTrackings));
        $shuntMemoObservation = $this->Memo->MemoTracking->field('observation', array('memo_tracking_type_id' => '5c924533-db78-449d-b52a-0450c26b1ae0', 'viewed' => 0, 'memo_id' => $id, 'to' => $from));

        $userChild = $this->Share->find('first', array('conditions' => array('Share.username' => $this->Auth->user('username'))));

        if (!empty($userChild['Child'][0]['username'])) :
            $users = array($this->Auth->user('username') => $this->Auth->user('username'), $userChild['Child'][0]['username'] => $userChild['Child'][0]['username']); //debug($users);
        else :
            $users = $this->Auth->user('username');
        endif;

        $refused = $this->Memo->MemoTracking->field('approved', array('MemoTracking.memo_id' => $id, 'MemoTracking.viewed' => 0, 'MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0', 'MemoTracking.to' => $users)); // Tipo Propietario 
        $refusedParent = ($memo['ParentMemo']['id']) ? $this->Memo->MemoTracking->field('approved', array('MemoTracking.memo_id' => $memo['ParentMemo']['id'], 'MemoTracking.viewed' => 0, 'MemoTracking.memo_tracking_type_id' => '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0', 'MemoTracking.to' => $users)) : NULL; // Tipo Aprobación
        $approved = $this->Memo->MemoTracking->field('approved', array('MemoTracking.memo_id' => $id, 'MemoTracking.viewed' => 0, 'MemoTracking.memo_tracking_type_id' => '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0', 'MemoTracking.to' => $users)); // Tipo Aprobador 
        $countMemoTrackings = $this->Memo->MemoTracking->field('count(id)', array('MemoTracking.memo_id' => $id, 'MemoTracking.viewed' => 0)); // Tipo Propietario
        $subrogances = $this->Subrogance->find('list', array('fields' => array('id', 'foot_signature'), 'conditions' => array('to' => $users)));

        $this->set(compact('memo', 'from', 'initialResponsibility', 'allMemos', 'memoAddressee', 'memoNotify', 'allAttachMemos', 'myMemoTracking', 'matterName', 'refused', 'approved', 'countMemoTrackings', 'idformAcceptedReception', 'idformSupplierRating', 'subrogances', 'shuntMemoObservation', 'refusedParent'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view_detail()
    {

        $this->loadModel('User');
        $this->loadModel('Subrogance');
        $this->loadModel('Share');

        App::import('Controller', 'Users');
        $UsersController = new UsersController;

        $postMemoNumber = @$this->params['data']['memo_number'];
        $menu = @$this->params['data']['menu'];

        $memoNumber = explode('-', $postMemoNumber);
        $id2 = $this->Memo->field('id', array('memo_number' => @$memoNumber[0], 'year' => @$memoNumber[1]));

        $id = (@$this->params['data']['memo_detail_id']) ?: (($id2) ? $id2 : NULL); //debug($id); //exit;

        $box = (@$this->params['data']['box']) ?: NULL; //debug($box); //exit;

        $memo = $this->Memo->find('first', array('contain' => array('ParentMemo', 'Matter', 'MemoTracking' => array('conditions' => array('viewed' => 0, 'memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0'))), 'conditions' => array('Memo.id' => $id))); //debug($memo);

        $from = $this->Auth->user('username');
        $memosIds = $this->parent_child_memo($id);
        $allMemos = $this->Memo->find('all', array('conditions' => array('Memo.id' => $memosIds), 'order' => array('Memo.created DESC'))); //debug($allMemos);
        $allAttachMemos = $this->Memo->Attachment->find('all', array('conditions' => array('memo_id' => $memosIds, 'disable' => 0)));
        $memoAddressee = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.viewed' => 0, 'MemoTracking.memo_id' => $id, 'MemoTracking.memo_tracking_type_id' => '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0')));
        $memoNotify = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.viewed' => 0, 'MemoTracking.memo_id' => $id, 'MemoTracking.memo_tracking_type_id' => '5b8588ba-ef8c-49e1-8592-1f68c26b1ae0')));
        $myMemoTrackings = $this->Memo->MemoTracking->find('list', array('fields' => array('id', 'id'), 'conditions' => array('memo_id' => $memosIds)));
        $idformAcceptedReception = $this->Memo->MemoTracking->AcceptedReception->field('id', array('memo_tracking_id' => $myMemoTrackings));
        $idformSupplierRating = $this->Memo->MemoTracking->SupplierRating->field('id', array('memo_tracking_id' => $myMemoTrackings));
        $shuntMemoObservation = $this->Memo->MemoTracking->field('observation', array('memo_tracking_type_id' => '5c924533-db78-449d-b52a-0450c26b1ae0', 'viewed' => 0, 'memo_id' => $id, 'to' => $from));

        $userChild = $this->Share->find('first', array('conditions' => array('Share.username' => $this->Auth->user('username')))); //debug($userChild);

        if (!empty($userChild['Child'])) :
            $count = count($userChild['Child']) - 1;
            $users = array($this->Auth->user('username') => $this->Auth->user('username'), $userChild['Child'][$count]['username'] => $userChild['Child'][$count]['username']); //debug($users);
        else :
            $users = $this->Auth->user('username');
        endif;

        $refused = $this->Memo->MemoTracking->field('approved', array('MemoTracking.memo_id' => $id, 'MemoTracking.viewed' => 0, 'MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0', 'MemoTracking.to' => $users)); // Tipo Propietario
        $refusedParent = !empty($memo['ParentMemo']['id']) ? $this->Memo->MemoTracking->field('approved', array('MemoTracking.memo_id' => $memo['ParentMemo']['id'], 'MemoTracking.viewed' => 0, 'MemoTracking.memo_tracking_type_id' => '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0', 'MemoTracking.to' => $users)) : NULL; // Tipo Aprobación
        $approved = $this->Memo->MemoTracking->field('approved', array('MemoTracking.memo_id' => $id, 'MemoTracking.viewed' => 0, 'MemoTracking.memo_tracking_type_id' => '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0', 'MemoTracking.to' => $users)); // Tipo Aprobador 

        $subrogances = $this->Subrogance->find('list', array('fields' => array('id', 'foot_signature'), 'conditions' => array('to' => $users)));

        $this->set(compact('memo', 'from', 'initialResponsibility', 'allMemos', 'memoAddressee', 'memoNotify', 'allAttachMemos', 'myMemoTracking', 'matterName', 'refused', 'approved', 'subrogances', 'idformAcceptedReception', 'idformSupplierRating', 'shuntMemoObservation', 'refusedParent', 'box', 'menu', 'id2'));

        $this->render('/Elements/detail', 'ajax');
    }

    /**
     * pdf method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function pdf($id = null, $download = true)
    {

        $this->loadModel('User');

        App::import('Controller', 'Users');
        $UsersController = new UsersController;

        if (!$this->Memo->exists($id)) {
            throw new NotFoundException(__('Invalid memo'));
        }

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
            'download' => $download,
            'filename' => (!empty($leadershipMemo)) ? $leadershipMemo[0]['Memo']['reference'] . '.pdf' : 'sin respuesta.pdf',
        );

        $this->set(compact('leadershipMemo', 'userTracking', 'existSubroganceMemo', 'leadershipMemo'));
    }

    /**
     * all_files method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function all_files($id = null)
    {

        $this->loadModel('User');
        $this->loadModel('AcceptedReception');
        $this->loadModel('SupplierRating');

        App::import('Controller', 'Users');
        $UsersController = new UsersController;

        if (!$this->Memo->exists($id)) {
            throw new NotFoundException(__('Invalid memo'));
        }

        $memosIds = $this->parent_child_memo($id);
        $leadershipMemo = $this->Memo->MemoTracking->query('SELECT * FROM memo_trackings MemoTracking 
            LEFT JOIN users User ON User.username = MemoTracking.to 
            LEFT JOIN memos Memo ON Memo.id = MemoTracking.memo_id 
            LEFT JOIN subrogances Subrogance ON Subrogance.id = MemoTracking.subrogance_id 
            WHERE 
                MemoTracking.viewed = false AND 
                ((User.group_id = 2) OR (MemoTracking.subrogance_id IS NOT NULL) ) AND 
                MemoTracking.memo_tracking_type_id = "5ba4f0ba-ec28-471e-af3e-2630c26b1ae0" AND 
                MemoTracking.memo_id IN ("' . implode('","', $memosIds) . '")');

        $memosIdsLeadership = Hash::combine($leadershipMemo, '{n}.Memo.id', '{n}.Memo.id');
        $allAttachMemos = $this->Memo->Attachment->find('all', array('conditions' => array('memo_id' => $memosIds, 'disable' => 0)));
        $userTracking = $this->Memo->MemoTracking->query('SELECT * FROM memo_trackings MemoTracking LEFT JOIN users User ON User.username = MemoTracking.to LEFT JOIN memos Memo ON Memo.id = MemoTracking.memo_id WHERE MemoTracking.memo_id IN ("' . implode('","', $memosIdsLeadership) . '")');

        $allMemoTrackingOwner = $this->Memo->MemoTracking->find('list', array('fields' => array('id', 'id'), 'conditions' => array('memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0', 'memo_id' => $memosIds))); //debug($allMemoTrackingOwner); exit;
        $options = array('conditions' => array('AcceptedReception.memo_tracking_id' => $allMemoTrackingOwner));
        $acceptedReception = $this->AcceptedReception->find('first', $options);
        $active = $this->active;

        $options = array('conditions' => array('SupplierRating.memo_tracking_id' => $allMemoTrackingOwner));
        $supplierRating = $this->SupplierRating->find('first', $options);
        $purchaseMethods = $this->purchaseMethods;
        $active = $this->active;
        $evaluations = $this->evaluations;

        $this->set(compact('supplierRating', 'purchaseMethods', 'evaluations', 'acceptedReception', 'active', 'allAttachMemos', 'leadershipMemo', 'userTracking', 'existSubroganceMemo', 'leadershipMemo'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add($parentMemoId = null)
    { //debug($box); exit;

        $this->loadModel('User');
        $this->loadModel('SupplierRating');
        $this->loadModel('AcceptedReception');
        $this->loadModel('Subrogance');
        $this->loadModel('Milestone');

        $subrogances = $this->Subrogance->find('list', array('fields' => array('id', 'foot_signature'), 'conditions' => array('to' => $this->Auth->user('username'))));

        ///////////////////
        // Bloquear Memo //
        ///////////////////
        /*
            if($parentMemoId):
                $this->Memo->id = $parentMemoId ;
                $this->Memo->saveField('state_id', '61114fa2-ba9c-462d-84ce-4d34c26b1ae0'); 
            endif;
        */
        ///////////////////

        if ($this->request->is('post')) {

            //////////////////////////////////
            // Aca se crea el requerimeinto //
            //////////////////////////////////
            if ($this->request->data['Memo']['requirements'] == '1') :


                #debug($this->request->data['Memo']);
                #exit;

                /////////////////////////////////////////////
                //  GUARDAMOS REGISTROS EN REQUIREMENT     //
                /////////////////////////////////////////////
                $requirement = $this->Requirement->create();
                $requirement['Requirement']['name']                     =   $this->request->data['Memo']['reference'];
                #$requirement['Requirement']['amount']                   =   100;
                $requirement['Requirement']['percentage']               =   1;
                $requirement['Requirement']['id_requirement_status']    =   1;


                $numRequirement     =  $this->Requirement->find('first', array('order' => array('requirement_number' => 'DESC')));
                $maxNumRequirement  = ++$numRequirement['Requirement']['requirement_number'];
                $requirement['Requirement']['requirement_number']       =   $maxNumRequirement;


                $this->Requirement->save($requirement);


            #debug($requirement);
            #exit;


            //////////////////////////////////
            endif;
            //////////////////////////////////


            // Comprobar si usuario existe //
            $usersExistTo   = $this->users_exist($this->request->data['Data']['to']);
            $usersExistNotify = $this->users_exist($this->request->data['Data']['notify']);

            if (($usersExistTo[0] === false) or ($usersExistNotify[0] === false)) :

                $this->Session->write('DataMemo', $this->request->data);

                if (!empty($usersExistTo[1])) :
                    foreach ($usersExistTo[1] as $wrongNames) :
                        $message .= "<br><li>" . $wrongNames . "</li>";
                    endforeach;
                endif;

                if (!empty($usersExistNotify[1])) :
                    foreach ($usersExistNotify[1] as $wrongNames) :
                        $message .= "<li>" . $wrongNames . "</li>";
                    endforeach;
                endif;

                $this->Session->setFlash(__('The user or users entered are not valid. Please revise.') . $message, 'flash/error');
                $this->redirect(array('action' => 'add'));

            endif;


            ////////////////////////////////
            // Crear Materia si no existe //
            ///////////////////////////////   
            $this->request->data['Memo']['matter_id'] = ($this->request->data['Memo']['matter_id'] == '5bfff4ce-6954-416b-a357-2048c26b1ae0') ? $this->request->data['Memo']['matter_text'] : $this->request->data['Memo']['matter_id']; // Otro                            
            $matterId = $this->if_uuid($this->request->data['Memo']['matter_id']);
            $this->request->data['Memo']['matter_id'] = $matterId;
            /////////////////////////////// 

            if ($parentMemoId) {

                $this->Memo->MemoTracking->updateAll(array('viewed' => 1), array('memo_id' => $parentMemoId, 'memo_tracking_type_id' => '5c924533-db78-449d-b52a-0450c26b1ae0')); // Derivación

                $this->Memo->MemoTracking->updateAll(array('viewed' => 1), array('memo_id' => $parentMemoId, 'memo_tracking_type_id' => '5c9245e9-fb84-4333-8d6b-0450c26b1ae0')); // Derivación

                $MemoChildId = $this->Memo->field('id', array('parent_id' => $parentMemoId));
            }

            if (@$MemoChildId) {
                $this->Memo->id = $MemoChildId;

                $this->Memo->MemoTracking->updateAll(array('viewed' => 1), array('memo_id' => $MemoChildId));
                $this->Memo->MemoAlert->updateAll(array('viewed' => 1), array('memo_id' => $MemoChildId));
            } else {
                $this->Memo->create();
            }

            if (isset($this->request->data['send'])) : //debug($this->request->data); //exit;
                if (is_null($parentMemoId)) {
                    $countMemos = $this->Memo->field('MAX(memo_number)', array('year' => date('Y')));
                    $this->request->data['Memo']['memo_number'] = ++$countMemos;
                    $this->request->data['Memo']['year'] = date('Y');
                } else {
                    if (empty($MemoChildId)) { //debug('aca 2.1'); //exit();
                        $memosIds = $this->parent_child_memo($parentMemoId);
                        $groupId = $this->User->field('group_id', array('username' => $this->Auth->user('username')));

                        $existLeadershipMemo = $this->Memo->MemoTracking->find('all', array(
                            'fields' => array('*'),
                            'conditions' => array(
                                'MemoTracking.memo_id' => $memosIds,
                                'MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0',
                                'MemoTracking.viewed' => 0
                            ),
                            'joins' => array(
                                array(
                                    'alias' => 'User',
                                    'table' => 'users',
                                    'type' => 'right',
                                    'conditions' => array(
                                        'User.username = MemoTracking.to',
                                        'User.group_id = 2'
                                    )
                                )
                            )
                        ));

                        $existSubroganceMemo = $this->Memo->MemoTracking->find('all', array(
                            'fields' => array('*'),
                            'conditions' => array(
                                'MemoTracking.memo_id' => $memosIds,
                                'MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0',
                                'MemoTracking.viewed' => 0,
                                'MemoTracking.subrogance_id IS NOT NULL'
                            )
                        ));

                        if (@$subrogances[$this->request->data['send']]) :
                            if (!empty($existLeadershipMemo)) : // Grupo Jefatura o Subrogante 
                                $countMemos = $this->Memo->field('MAX(memo_number)', array('year' => date('Y'))) + 1;
                                $this->request->data['Memo']['year'] = date('Y');
                            else :
                                $countMemos = $this->Memo->field('memo_number', array('id' => $parentMemoId));
                                $yearCountMemos = $this->Memo->field('year', array('id' => $parentMemoId));
                                $this->request->data['Memo']['year'] = $yearCountMemos;
                            endif;
                        else : //debug('aca 2.1.2'); exit();
                            if (!empty($existLeadershipMemo) and ($groupId == 2)) : // Grupo Jefatura
                                $countMemos = $this->Memo->field('MAX(memo_number)', array('year' => date('Y'))) + 1;
                                $this->request->data['Memo']['year'] = date('Y');
                            elseif (empty($existLeadershipMemo) and ($groupId == 2)) :
                                $countMemos = $this->Memo->field('memo_number', array('id' => $parentMemoId));
                                $yearCountMemos = $this->Memo->field('year', array('id' => $parentMemoId));
                                $this->request->data['Memo']['year'] = $yearCountMemos;
                            elseif (!empty($existSubroganceMemo) and ($groupId == 2)) :
                                $countMemos = $this->Memo->field('MAX(memo_number)', array('year' => date('Y'))) + 1;
                                $this->request->data['Memo']['year'] = date('Y');
                            else : //debug($existSubroganceMemo);
                                $countMemos = $this->Memo->field('memo_number', array('id' => $parentMemoId));
                                $yearCountMemos = $this->Memo->field('year', array('id' => $parentMemoId));
                                $this->request->data['Memo']['year'] = $yearCountMemos;
                            endif;
                        endif;

                        $this->request->data['Memo']['memo_number'] = $countMemos;
                    } else { //debug('aca 2.2'); exit();
                        $countMemos = $this->Memo->field('memo_number', array('id' => $parentMemoId));
                        $this->request->data['Memo']['memo_number'] = $countMemos;
                        $yearCountMemos = $this->Memo->field('year', array('id' => $parentMemoId));
                        $this->request->data['Memo']['year'] = $yearCountMemos;
                    }
                }
            endif;   //debug($this->request->data); exit;

            //////////////////////////                                         



            if ($this->Memo->save($this->request->data['Memo'])) {

                if (@$MemoChildId) {
                    $getInsertId = $MemoChildId;
                } else {
                    $getInsertId = $this->Memo->getInsertID();
                }



                foreach ($this->request->data['Attachment'] as $dataAttachments) :
                    if ($dataAttachments['filename']['type'] == 'application/pdf') :
                        $this->Memo->Attachment->create();
                        $dataAttachments['filename']['memo_id'] = $getInsertId;
                        $dataAttachments['filename']['attachment_type_id'] = '5b8588e3-f660-426b-8121-1f68c26b1ae0'; // Tipo Anexos Memos

                        if ($this->Memo->Attachment->save($dataAttachments['filename'])) {
                            mkdir('../webroot/files/' . $this->Memo->Attachment->getInsertID(), 0777, true);
                            if (move_uploaded_file($dataAttachments['filename']['tmp_name'], '../webroot/files/' . $this->Memo->Attachment->getInsertID() . '/' . $dataAttachments['filename']['name'])) {
                            } else {
                                rmdir($this->Memo->Attachment->getInsertID());
                            }
                        }
                    endif;
                endforeach;


                if ($parentMemoId) {
                    $this->Memo->MemoTracking->updateAll(array('approved' => 1), array('memo_id' => $parentMemoId));
                }

                $this->Memo->MemoTracking->create();
                $this->request->data['MemoTracking']['memo_id'] = $getInsertId;
                $this->request->data['MemoTracking']['memo_tracking_type_id'] = '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0'; // Tipo Propietario
                $this->request->data['MemoTracking']['to'] = $this->request->data['Data']['from'];
                $this->request->data['MemoTracking']['read'] = '1';



                if (!empty(@$subrogances[$this->request->data['send']])) {
                    $this->request->data['MemoTracking']['subrogance_id'] = $this->request->data['send'];
                }


                $this->Memo->MemoTracking->save($this->request->data['MemoTracking']);

                $memoTrackingId = $this->Memo->MemoTracking->getLastInsertID();

                $dataTos = explode(',',  $this->request->data['Data']['to']);

                if ($this->request->data['Data']['to'] <> '') :
                    foreach ($dataTos as $dataTo) :

                        $this->Memo->MemoTracking->create();

                        $to = explode('@',  $dataTo);

                        $this->request->data['MemoTracking']['memo_id'] = $getInsertId;
                        $this->request->data['MemoTracking']['memo_tracking_type_id'] = '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0'; // Tipo Aprobación
                        $this->request->data['MemoTracking']['to'] = $to[0];
                        $this->request->data['MemoTracking']['read'] = '0';
                        $this->request->data['MemoTracking']['subrogance_id'] = NULL;
                        $this->Memo->MemoTracking->save($this->request->data['MemoTracking']);

                        $this->Memo->MemoAlert->create();

                        $this->request->data['MemoAlert']['memo_id'] = $getInsertId;
                        $this->request->data['MemoAlert']['alert_type_id'] = '5b85887b-3868-41cf-a365-1f68c26b1ae0'; // Tipo Aprobación
                        $this->request->data['MemoAlert']['to'] = $to[0];
                        $this->Memo->MemoAlert->save($this->request->data['MemoAlert']);

                        if (isset($this->request->data['send'])) :
                            $this->contact_email(0, $to[0], $getInsertId);
                        endif;

                    endforeach;
                endif;

                $this->Memo->MemoAlert->create();
                $this->request->data['MemoAlert']['memo_id'] = $getInsertId;
                $this->request->data['MemoAlert']['alert_type_id'] = '5b85888d-1698-443c-a502-1f68c26b1ae0'; // Tipo Notificación
                $this->request->data['MemoAlert']['to']   = $this->request->data['Data']['from'];
                $this->Memo->MemoAlert->save($this->request->data);


                $dataNotifies = explode(',',  $this->request->data['Data']['notify']);

                if ($this->request->data['Data']['notify'] <> '') :
                    foreach ($dataNotifies as $dataNotify) :

                        $this->Memo->MemoTracking->create();

                        $notify = explode('@',  $dataNotify);

                        $this->request->data['MemoTracking']['memo_id'] = $getInsertId;
                        $this->request->data['MemoTracking']['memo_tracking_type_id'] = '5b8588ba-ef8c-49e1-8592-1f68c26b1ae0'; // Tipo Notificación
                        $this->request->data['MemoTracking']['to'] = $notify[0];
                        $this->request->data['MemoTracking']['read'] = '0';
                        $this->request->data['MemoTracking']['subrogance_id'] = NULL;
                        $this->Memo->MemoTracking->save($this->request->data['MemoTracking']);

                        $this->Memo->MemoAlert->create();

                        $this->request->data['MemoAlert']['memo_id'] = $getInsertId;
                        $this->request->data['MemoAlert']['alert_type_id'] = '5b85888d-1698-443c-a502-1f68c26b1ae0'; // Tipo Notificación
                        $this->request->data['MemoAlert']['to'] = $notify[0];
                        $this->Memo->MemoAlert->save($this->request->data['MemoAlert']);

                        $usersNotify[] = $notify[0];

                    endforeach;

                    if (isset($this->request->data['send'])) :
                        $this->contact_email(0, $usersNotify, $getInsertId);
                    endif;

                endif;

                $this->Session->delete('DataMemo');

                if (isset($this->request->data['send'])) :
                    $memoNumber = 'D' . $this->request->data['Memo']['memo_number'] . '-' . $this->request->data['Memo']['year'];

                    $this->Session->setFlash(__('The memo ') . $memoNumber . __(' has been sended'), 'flash/success');
                else :
                    $this->Session->setFlash(__('Draft successfully generated.'), 'flash/success');
                endif;

                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The memo could not be saved. Please, try again.'), 'flash/error');
            }
        }

        $memoTypes = $this->Memo->MemoType->find('list');
        $initialResponsibility = $this->initial_responsibility($this->Auth->user('username'), $parentMemoId);
        $parentReference = $this->Memo->field('reference', array('id' => $parentMemoId));
        $parentDescription = $this->Memo->field('description', array('id' => $parentMemoId));
        $parentMatterId = $this->Memo->field('matter_id', array('id' => $parentMemoId));
        $matters = $this->Memo->Matter->find('list', array('conditions' => array('id' => array('630fb62f-ccfc-4367-9e50-647cc26b1ae0', '5bfff4ce-6954-416b-a357-2048c26b1ae0', '5c052106-ebbc-417d-83de-2048c26b1ae0', '5c052111-6b14-419c-9ae8-2048c26b1ae0', '5c05214d-40e8-4263-b92d-2048c26b1ae0', '5c052159-cbac-448b-848f-2048c26b1ae0', '5c052172-3ff0-4bcd-b673-2048c26b1ae0', '5c052183-8c8c-4d96-a141-2048c26b1ae0', '5c05218e-5844-43d4-bda4-2048c26b1ae0', '5c05219d-a118-46ae-b807-2048c26b1ae0', '5c0521a7-d9dc-4d31-b356-2048c26b1ae0', '5cd033ed-2294-4e30-bf29-37160a500003', '5cd033f3-5be4-4b58-9382-37800a500003', '5cd03402-a36c-4b0e-9dc1-37760a500003', '5cd0340b-ede0-4e65-84c6-34790a500003')), 'order' => array('case when name= "Otro" then 1 else 0 End, id')));
        $active = $this->active;
        $purchaseMethods = $this->purchaseMethods;
        $evaluations = $this->evaluations;
        $memosIds = $this->parent_child_memo($parentMemoId);
        $allAttachMemos = $this->Memo->Attachment->find('all', array('conditions' => array('memo_id' => $memosIds, 'disable' => 0)));

        $this->set(compact('memoTypes', 'from', 'initialResponsibility', 'parentMemoId', 'parentReference', 'parentDescription', 'matters', 'parentMatterId', 'matters', 'active', 'purchaseMethods', 'evaluations', 'subrogances', 'allAttachMemos'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null, $shunt = null)
    {

        $this->loadModel('Subrogance');

        $this->Memo->id = $id;

        if ($this->request->is('post') || $this->request->is('put')) { //debug($this->request->data); exit;

            // Crear Materia si no existe //

            $this->request->data['Memo']['matter_id'] = ($this->request->data['Memo']['matter_id'] == '5bfff4ce-6954-416b-a357-2048c26b1ae0') ? $this->request->data['Memo']['matter_text'] : $this->request->data['Memo']['matter_id']; // Otro    

            $matterId = $this->if_uuid($this->request->data['Memo']['matter_id']);

            $this->request->data['Memo']['matter_id'] = $matterId;
            $this->request->data['Memo']['state_id'] = NULL;

            ///////////////////////////////   

            if (isset($this->request->data['send'])) :

                $numberMemo = $this->Memo->field('memo_number', array('id' => $id));
                $yearMemo = $this->Memo->field('year', array('id' => $id));

                $this->request->data['Memo']['year'] = $yearMemo;

                if (is_null($numberMemo)) :
                    $countMemos = $this->Memo->field('MAX(memo_number)', array('year' => date('Y')));
                    $this->request->data['Memo']['memo_number'] = ++$countMemos;
                    $this->request->data['Memo']['year'] = date('Y');
                    $yearMemo = date('Y');
                endif;
            endif;

            if ($this->Memo->save($this->request->data['Memo'])) {

                // Comprobar si usuario existe //

                $usersExistTo = $this->users_exist($this->request->data['Data']['to']);
                $usersExistNotify = $this->users_exist($this->request->data['Data']['notify']);

                if (($usersExistTo[0] === false) or ($usersExistNotify[0] === false)) :

                    $this->Session->write('DataMemo', $this->request->data);

                    if (!empty($usersExistTo[1])) :
                        foreach ($usersExistTo[1] as $wrongNames) :
                            $message .= "<br><li>" . $wrongNames . "</li>";
                        endforeach;
                    endif;

                    if (!empty($usersExistNotify[1])) :
                        foreach ($usersExistNotify[1] as $wrongNames) :
                            $message .= "<li>" . $wrongNames . "</li>";
                        endforeach;
                    endif;

                    $this->Session->setFlash(__('The user or users entered are not valid. Please revise.') . $message, 'flash/error');

                    $this->redirect(array('action' => 'edit', $id));

                endif;

                ////////////////////////////////

                if (!isset($this->request->data['shunt'])) :

                    $dataTos = explode(',',  $this->request->data['Data']['to']);
                    $subroganceValue = (@$this->request->data['send'] <> '') ? $this->request->data['send'] : $this->Memo->MemoTracking->field('subrogance_id', array('memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0', 'viewed' => 0, 'memo_id' => $id));

                    $this->Memo->MemoTracking->updateAll(array('viewed' => 1), array('memo_id' => $id));
                    $this->Memo->MemoAlert->updateAll(array('viewed' => 1), array('memo_id' => $id));

                endif;
                //////////////////// Propietario //////////////////////

                if (!isset($this->request->data['shunt'])) :
                    $this->Memo->MemoTracking->create();

                    $this->request->data['MemoTracking']['memo_id'] = $id;
                    $this->request->data['MemoTracking']['memo_tracking_type_id'] = '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0'; // Tipo Propietario
                    $this->request->data['MemoTracking']['to'] = $this->request->data['Data']['from'];
                    $this->request->data['MemoTracking']['subrogance_id'] = $subroganceValue;
                    $this->Memo->MemoTracking->save($this->request->data);

                    $this->Memo->MemoAlert->create();

                    $this->request->data['MemoAlert']['memo_id'] = $id;
                    $this->request->data['MemoAlert']['alert_type_id'] = '5b85887b-3868-41cf-a365-1f68c26b1ae0'; // Tipo Notificación
                    $this->request->data['MemoAlert']['to'] = $this->request->data['Data']['from'];
                    $this->Memo->MemoAlert->save($this->request->data);

                    //////////////////////////////////////////////////////   

                    if ($this->request->data['Data']['to'] <> '') :

                        foreach ($dataTos as $dataTo) :

                            $to = explode('@',  $dataTo);

                            $this->Memo->MemoTracking->updateAll(
                                array('MemoTracking.viewed' => 1),
                                array('MemoTracking.memo_id' => $id, 'MemoTracking.viewed' => 0, 'MemoTracking.to' => $to[0])
                            );

                            $this->Memo->MemoTracking->create();

                            $this->request->data['MemoTracking']['memo_id'] = $id;
                            $this->request->data['MemoTracking']['memo_tracking_type_id'] = '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0'; // Tipo Aprobación
                            $this->request->data['MemoTracking']['to'] = $to[0];
                            $this->request->data['MemoTracking']['subrogance_id'] = NULL;
                            $this->Memo->MemoTracking->save($this->request->data);

                            $this->Memo->MemoAlert->updateAll(
                                array('MemoAlert.viewed' => 1),
                                array('MemoAlert.memo_id' => $id, 'MemoAlert.viewed' => 0, 'MemoAlert.to' => $to[0])
                            );

                            $this->Memo->MemoAlert->create();

                            $this->request->data['MemoAlert']['memo_id'] = $id;
                            $this->request->data['MemoAlert']['alert_type_id'] = '5b85887b-3868-41cf-a365-1f68c26b1ae0'; // Tipo Aprobación
                            $this->request->data['MemoAlert']['to'] = $to[0];
                            $this->Memo->MemoAlert->save($this->request->data);

                            if (isset($this->request->data['send'])) :
                                $this->contact_email(3, $to[0], $id);
                            endif;

                        endforeach;
                    endif;

                    $dataNotifies = explode(',',  $this->request->data['Data']['notify']);

                    if ($this->request->data['Data']['notify'] <> '') :
                        foreach ($dataNotifies as $dataNotify) :

                            $notify = explode('@',  $dataNotify);

                            $this->Memo->MemoTracking->updateAll(
                                array('MemoTracking.viewed' => 1),
                                array('MemoTracking.memo_id' => $id, 'MemoTracking.viewed' => 0, 'MemoTracking.to' => $notify[0])
                            );

                            $this->Memo->MemoTracking->create();

                            $this->request->data['MemoTracking']['memo_id'] = $id;
                            $this->request->data['MemoTracking']['memo_tracking_type_id'] = '5b8588ba-ef8c-49e1-8592-1f68c26b1ae0'; // Tipo Notificación
                            $this->request->data['MemoTracking']['to'] = $notify[0];
                            $this->request->data['MemoTracking']['subrogance_id'] = NULL;
                            $this->Memo->MemoTracking->save($this->request->data);

                            $this->Memo->MemoAlert->updateAll(
                                array('MemoAlert.viewed' => 1),
                                array('MemoAlert.memo_id' => $id, 'MemoAlert.viewed' => 0, 'MemoAlert.to' => $notify[0])
                            );

                            $this->Memo->MemoAlert->create();

                            $this->request->data['MemoAlert']['memo_id'] = $id;
                            $this->request->data['MemoAlert']['alert_type_id'] = '5b85888d-1698-443c-a502-1f68c26b1ae0'; // Tipo Notificación
                            $this->request->data['MemoAlert']['to'] = $notify[0];
                            $this->Memo->MemoAlert->save($this->request->data);

                            $usersNotify[] = $notify[0];

                        endforeach;

                        if (isset($this->request->data['send'])) :
                            $this->contact_email(3, $usersNotify, $id);
                        endif;

                    endif;
                else :
                    $this->Memo->MemoTracking->updateAll(array('read' => 1, 'MemoTracking.modified' => "'" . date('Y-m-d H:i:s') . "'"), array('memo_id' => $id, 'memo_tracking_type_id' => '5c924533-db78-449d-b52a-0450c26b1ae0', 'MemoTracking.to' => $this->request->data['Data']['from']));
                endif;

                foreach ($this->request->data['Attachment'] as $attachments) :
                    if (@$attachments['filename']['delete'] == 'true') :
                        $attachmentId = $attachments['filename']['id'];
                        $nameFile = $attachments['filename']['name'];
                        $this->Memo->Attachment->id = $attachmentId;

                        if ($this->Memo->Attachment->delete()) :
                            unlink('../webroot/files/' . $attachmentId . '/' . $nameFile);
                            rmdir('../webroot/files/' . $attachmentId);
                        endif;
                    elseif (empty($attachments['filename']['delete'])) :
                        if ($attachments['filename']['type'] == 'application/pdf') {
                            $this->Memo->Attachment->create();
                            $attachments['filename']['memo_id'] = $id;
                            $attachments['filename']['attachment_type_id'] = '5b8588e3-f660-426b-8121-1f68c26b1ae0'; // Tipo Anexos Memos

                            if ($this->Memo->Attachment->save($attachments['filename'])) {
                                mkdir('../webroot/files/' . $this->Memo->Attachment->getInsertID(), 0777, true);
                                if (move_uploaded_file($attachments['filename']['tmp_name'], '../webroot/files/' . $this->Memo->Attachment->getInsertID() . '/' . $attachments['filename']['name'])) {
                                } else {
                                    rmdir($this->Memo->Attachment->getInsertID());
                                }
                            }
                        }
                    endif;
                endforeach;

                if (isset($this->request->data['send'])) :
                    if (is_null($numberMemo)) :
                        $numberMemo = 'D' . $countMemos . '-' . $yearMemo;

                        $this->Session->setFlash(__('The memo ') . $numberMemo . __(' has been sended'), 'flash/success');
                    else :
                        $this->Session->setFlash(__('The memo has been sended'), 'flash/success');
                    endif;
                elseif (isset($this->request->data['shunt'])) :
                    $this->Session->setFlash(__('Memo successfully edited.'), 'flash/success');
                else :
                    $this->Session->setFlash(__('Draft successfully edited.'), 'flash/success');
                endif;

                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The memo could not be saved. Please, try again.'), 'flash/error');
            }
        } else {
            $options = array('conditions' => array('Memo.' . $this->Memo->primaryKey => $id));
            $this->request->data = $this->Memo->find('first', $options);
            //$this->request->data['Memo']['matter_id'] = NULL;
        }

        $memo = $this->Memo->find('first', $options); //debug($memo);
        $memoAddressee = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.viewed' => 0, 'MemoTracking.memo_id' => $id, 'MemoTracking.memo_tracking_type_id' => '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0')));
        $memoNotify = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.viewed' => 0, 'MemoTracking.memo_id' => $id, 'MemoTracking.memo_tracking_type_id' => '5b8588ba-ef8c-49e1-8592-1f68c26b1ae0')));
        $matters = $this->Memo->Matter->find('list', array('conditions' => array('id' => array('630fb62f-ccfc-4367-9e50-647cc26b1ae0', '5bfff4ce-6954-416b-a357-2048c26b1ae0', '5c052106-ebbc-417d-83de-2048c26b1ae0', '5c052111-6b14-419c-9ae8-2048c26b1ae0', '5c05214d-40e8-4263-b92d-2048c26b1ae0', '5c052159-cbac-448b-848f-2048c26b1ae0', '5c052172-3ff0-4bcd-b673-2048c26b1ae0', '5c052183-8c8c-4d96-a141-2048c26b1ae0', '5c05218e-5844-43d4-bda4-2048c26b1ae0', '5c05219d-a118-46ae-b807-2048c26b1ae0', '5c0521a7-d9dc-4d31-b356-2048c26b1ae0', '5cd033ed-2294-4e30-bf29-37160a500003', '5cd033f3-5be4-4b58-9382-37800a500003', '5cd03402-a36c-4b0e-9dc1-37760a500003', '5cd0340b-ede0-4e65-84c6-34790a500003')), 'order' => array('case when name= "Otro" then 1 else 0 End, id')));
        $subrogances = $this->Subrogance->find('list', array('fields' => array('id', 'foot_signature'), 'conditions' => array('to' => $this->Auth->user('username'))));

        $this->set(compact('memo', 'memoAddressee', 'memoNotify', 'matters', 'subrogances', 'shunt'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Memo->id = $id;
        if (!$this->Memo->exists()) {
            throw new NotFoundException(__('Invalid memo'));
        }
        if ($this->Memo->delete()) {
            $this->Session->setFlash(__('Memo deleted'), 'flash/success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Memo was not deleted'), 'flash/error');
        $this->redirect(array('action' => 'index'));
    }

    /**
     * initial_responsibility method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function initial_responsibility($username = null, $parentMemoId = null)
    {

        $nameParts = explode(' ', $this->find_user_username($username));

        $countPart = count($nameParts);

        if ($countPart > 2) {
            $initialResponsibility = $nameParts[0][0] . $nameParts[$countPart - 2][0] . $nameParts[$countPart - 1][0];
        } else {
            $initialResponsibility = $nameParts[0][0] . $nameParts[$countPart - 1][0];
        }

        if ($parentMemoId) {
            $parentInitialResponsibility = $this->Memo->field('initial_responsibility', array('id' => $parentMemoId));
            $initialResponsibility = $initialResponsibility . $parentInitialResponsibility;
        }

        return is_null($parentMemoId) ? strtolower('/' . $initialResponsibility) : '/' . $initialResponsibility;
    }

    /**
     * find_user_username method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function find_user_username($userNames = null)
    {

        $fullNames = NULL;
        $LDAP_HOST = $this->ldap['LDAP_HOST']; //ldap://violeta.mmeg.cl
        $LDAP_HOST_2 = $this->ldap['LDAP_HOST_2']; //ldap://amanda.mmeg.cl
        $LDAP_PORT = $this->ldap['LDAP_PORT']; //3268 o 389
        $LDAP_ADMIN_DN = $this->ldap['LDAP_ADMIN_DN'];
        $LDAP_ADMIN_PASSWORD = $this->ldap['LDAP_ADMIN_PASSWORD'];
        $LDAP_SEARCH_OU = $this->ldap['LDAP_SEARCH_OU'];

        if (!is_null($userNames) && $userNames != '') {

            $ds = (ldap_connect($LDAP_HOST, $LDAP_PORT)) ? ldap_connect($LDAP_HOST, $LDAP_PORT) : ldap_connect($LDAP_HOST_2, $LDAP_PORT);

            if (ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3)) {
                if (ldap_bind($ds, $LDAP_ADMIN_DN, $LDAP_ADMIN_PASSWORD)) {
                    $sr = ldap_search($ds, $LDAP_SEARCH_OU, "samaccountname=" . $userNames);
                    $infos = ldap_get_entries($ds, $sr);

                    if (!empty($infos[0]["distinguishedname"][0])) {
                        $organizationName = explode(',OU=', $infos[0]["distinguishedname"][0]);
                        //if($organizationName[1] <> 'ELIMINAR'){ 
                        $fullNames = $infos[0]["name"][0];
                        return $fullNames;
                        //}
                    } else {
                        return __('No information');
                    }
                }
            }
            ldap_close($ds);
        }
    }

    /**
     * find_user_username method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function find_addressees($memoId = null)
    {

        $users = $this->Memo->MemoTracking->find('list', array('fields' => array('to', 'to'), 'conditions' => array('memo_id' => $memoId, 'memo_tracking_type_id' => '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0'))); // Aprobador

        $listUsers = null;

        foreach ($users as $users) :
            $listUsers = $this->find_user_username($users);
        endforeach;

        return ($listUsers);
    }

    /**
     * parent_child_memo method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function parent_child_memo($memoId = null)
    {

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

    /**
     * create_zip method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */

    function create_zip($id)
    {

        //create the archive
        $zip = new ZipArchive();

        $memosIds = $this->parent_child_memo($id);
        $options = array('conditions' => array('Memo.id' => $memosIds), 'order' => array('Memo.created' => 'DESC'));
        $memos = $this->Memo->find('all', $options);

        $files = array();
        $url = WWW_ROOT . 'files';
        foreach ($memos as $memo) :
            $numberMemo = 'D' . $memo['Memo']['memo_number'] . '-' . date('Y', strtotime($memo['Memo']['created']));
            foreach ($memo['Attachment'] as $attachId => $attachment) :
                $files[$attachId]['url'] = $url . '/' . $attachment['id'] . '/' . $attachment['name'];
                $files[$attachId]['name'] = $attachment['name'];
                $files[$attachId]['folder'] = $numberMemo;
            endforeach;
        endforeach;

        if (!empty($files)) :
            $zipName = substr($memos[0]['Memo']['reference'], 0, 15) . '.zip';
        //$this->create_zip($files, $zipName);
        endif;

        if ($zipName) {
            if ($zip->open($zipName, ZipArchive::CREATE)) {
                //add the files
                foreach ($files as $file) {
                    $zip->addFile($file['url'], $file['folder'] . '/' . $file['name']);
                }
            }

            $zip->close();

            header('Content-Type: application/zip');
            header('Content-disposition: attachment; filename="' . $zipName . '"');
            header('Content-Length: ' . filesize($zipName));

            readfile($zipName);

            unlink($zipName);
        } else {
            $this->Session->setFlash(__('this memo does not contain associated attachments'), 'flash/error');
            $this->redirect(array('action' => 'index'));
        }
    }

    /**
     * memo_read method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */

    function memo_read($id)
    {

        $this->autoRender = false;

        $memoId = $this->Memo->MemoTracking->field('memo_id', array('MemoTracking.id' => $id));
        $userApprove = $this->Memo->MemoTracking->field('memo_tracking_type_id', array('MemoTracking.id' => $id));
        $read = $this->Memo->MemoTracking->field('read', array('MemoTracking.id' => $id));
        $read = ($read) ? 0 : 1;

        $this->Memo->MemoTracking->updateAll(
            array('MemoTracking.read' => $read),
            array('MemoTracking.id' => $id)
        );

        /*if($userApprove == '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0'):
            $this->Memo->id = $memoId;
            ($read) ? $this->Memo->saveField('state_id', '61114fa2-ba9c-462d-84ce-4d34c26b1ae0') : $this->Memo->saveField('state_id', NULL);
        endif;*/
    }

    /**
     * recover method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */

    function recover($id)
    {

        $stateMemo = $this->Memo->field('state_id', array('Memo.id' => $id)); //debug($stateMemo); exit;

        $notify = $this->Memo->MemoTracking->find('list', array('fields' => array('to', 'to'), 'conditions' => array('viewed' => 0, 'memo_id' => $id)));

        if ($stateMemo == '61114fa2-ba9c-462d-84ce-4d34c26b1ae0') : // Bloquear

            $this->Session->setFlash(__('Lo sentimos, en este momento el memorándum esta siendo editado.'), 'flash/error');
            $this->redirect(array('action' => 'index'));

        else :

            $this->Memo->id = $id;
            $this->Memo->saveField('state_id', '60ef08b2-e448-4759-9e42-32b8c26b1ae0'); // Recuperado

            foreach ($notify as $to) :
                $this->contact_email(6, $to, $id);
            endforeach;

            $this->Session->setFlash(__('El memorándum ha sido recuperado.'), 'flash/success');
            $this->redirect(array('action' => 'index'));

        endif;
    }

    /**
     * find_title_username method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function find_title_username($userNames = null)
    {

        $fullNames = NULL;
        $LDAP_HOST = $this->ldap['LDAP_HOST']; //ldap://violeta.mmeg.cl
        $LDAP_HOST_2 = $this->ldap['LDAP_HOST_2']; //ldap://amanda.mmeg.cl
        $LDAP_PORT = $this->ldap['LDAP_PORT']; //3268 o 389
        $LDAP_ADMIN_DN = $this->ldap['LDAP_ADMIN_DN'];
        $LDAP_ADMIN_PASSWORD = $this->ldap['LDAP_ADMIN_PASSWORD'];
        $LDAP_SEARCH_OU = $this->ldap['LDAP_SEARCH_OU'];

        if (!is_null($userNames) && $userNames != '') {

            $ds = (ldap_connect($LDAP_HOST, $LDAP_PORT)) ? ldap_connect($LDAP_HOST, $LDAP_PORT) : ldap_connect($LDAP_HOST_2, $LDAP_PORT);

            if (ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3)) {
                if (ldap_bind($ds, $LDAP_ADMIN_DN, $LDAP_ADMIN_PASSWORD)) {
                    $sr = ldap_search($ds, $LDAP_SEARCH_OU, "samaccountname=" . $userNames);
                    $infos = ldap_get_entries($ds, $sr);

                    $title = (!empty($infos[0]["title"][0])) ? $infos[0]["title"][0] : __('No information');
                    return $title;
                }
            }
        }
        ldap_close($ds);
    }

    /**
     * find_department_username method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function find_department_username($userNames = null)
    {

        $fullNames = NULL;
        $LDAP_HOST = $this->ldap['LDAP_HOST']; //ldap://violeta.mmeg.cl
        $LDAP_HOST_2 = $this->ldap['LDAP_HOST_2']; //ldap://amanda.mmeg.cl
        $LDAP_PORT = $this->ldap['LDAP_PORT']; //3268 o 389
        $LDAP_ADMIN_DN = $this->ldap['LDAP_ADMIN_DN'];
        $LDAP_ADMIN_PASSWORD = $this->ldap['LDAP_ADMIN_PASSWORD'];
        $LDAP_SEARCH_OU = $this->ldap['LDAP_SEARCH_OU'];

        if (!is_null($userNames) && $userNames != '') {

            $ds = (ldap_connect($LDAP_HOST, $LDAP_PORT)) ? ldap_connect($LDAP_HOST, $LDAP_PORT) : ldap_connect($LDAP_HOST_2, $LDAP_PORT);

            if (ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3)) {
                if (ldap_bind($ds, $LDAP_ADMIN_DN, $LDAP_ADMIN_PASSWORD)) {
                    $sr = ldap_search($ds, $LDAP_SEARCH_OU, "samaccountname=" . $userNames);
                    $infos = ldap_get_entries($ds, $sr);

                    $department = !empty($infos[0]["department"][0]) ? $infos[0]["department"][0] : __('No information');
                    return $department;
                }
            }
        }
        ldap_close($ds);
    }

    /**
     * contact_email method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */

    public function contact_email($type = null, $username = null, $memoId = null, $observation = null, $memoIdSecond = null)
    {
        $this->loadModel('User');
        $this->loadModel('Share');

        $memo = $this->Memo->find('first', array('conditions' => array('Memo.id' => $memoId)));
        $number = 'D' . $memo['Memo']['memo_number'] . '-' . $memo['Memo']['year'];
        $rejectedObservation = $this->Memo->MemoTracking->field('MemoTracking.observation', array('MemoTracking.memo_id' => $memoId, 'MemoTracking.viewed' => 0, 'MemoTracking.approved' => 0));
        $sendMail = $this->User->field('email', array('User.username' => $username));
        $subject = $message = NULL;
        $findParentUser = $this->Share->find('first', array('conditions' => array('Share.username' => $username)));
        (!empty($findParentUser['Parent']['username']) and !($sendMail)) ? $username = $findParentUser['Parent']['username'] : NULL;

        if ($type == 0) : // Crear 
            $subject = 'Nuevo memorándum creado.';
            $message = 'Estimado(a). <br><br> Un nuevo memorándum <b>' . $number . '</b> ha sido creado. <br><br> <b>Referencia:</b> ' . $memo['Memo']['reference'] . '<br><b>Creado por: </b>' . $this->find_owner($memoId) . '<br><b>Destinatario: </b>' . $this->find_recipient($memoId) . '<br><b>Descripción: </b>' . strip_tags($memo['Memo']['description']);
        elseif ($type == 1) : // Rechazar
            $subject = 'Memorándum devuelto.';
            $message = 'Estimado(a). <br><br> El memorándum <b>' . $number . '</b> ha sido devuelto. <br><br> <b>Referencia:</b> ' . $memo['Memo']['reference'] . '<br><b>Motivo:</b> ' . $rejectedObservation;
        elseif ($type == 3) : // Editar 
            $subject = 'Edición de memorándum.';
            $message = 'Estimado(a). <br><br> El memorándum <b>' . $number . '</b> ha sido editado. <br><br> <b>Referencia:</b> ' . $memo['Memo']['reference'] . '<br><b>Descripción: </b>' . strip_tags($memo['Memo']['description']);
        elseif ($type == 4) : // Derivar 
            $subject = 'Derivación de memorándum.';
            $message = 'Estimado(a). <br><br> El memorándum <b>' . $number . '</b> ha sido derivado. <br><br> <b>Referencia:</b> ' . $memo['Memo']['reference'] . '<br><b>Observación: </b>' . $observation;
        elseif ($type == 5) : // Recordatorio Derivar 
            $subject = 'Recordatorio de Derivación de memorándum.';
            $message = 'Estimado(a). <br><br> Recuerde que el memorándum <b>' . $number . '</b> ha sido derivado.';
        elseif ($type == 6) : // Recuperar 
            $subject = 'Memorándum recuperado.';
            $message = 'Estimado(a). <br><br> El memorándum <b>' . $number . '</b> ha sido recuperado.';
        elseif ($type == 7) : // Unir 
            $memoSecond = $this->Memo->find('first', array('conditions' => array('Memo.id' => $memoIdSecond)));
            $numberSecond = 'D' . $memoSecond['Memo']['memo_number'] . '-' . $memoSecond['Memo']['year'];
            $nameUser = $this->find_user_username($this->Session->read('Auth.User.username'));
            $subject = 'Unir memorándums.';
            $message = 'Estimado(a). <br><br> El usuario <b>' . $nameUser . '</b>, ha unido el memorándum <b>' . $number . '</b> y el <b>' . $numberSecond . '</b>.';
        endif;

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

        $Email = new CakeEmail();
        $Email->config('smtp')
            ->emailFormat('html')
            ->template('default')
            ->to($usersEmail)
            ->subject($subject);
        if ($Email->send($message)) {
            // Acción
        } else { //debug('no enviado');
            $this->Session->setFlash(__('Problem during sending email.'), 'flash/error');
        }
    }

    /**
     * find_owner method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function find_owner($memoId = null, $thumbnailphoto = null)
    {

        $userName = $this->Memo->MemoTracking->find('first', array('conditions' => array('MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0', 'MemoTracking.memo_id' => $memoId, 'MemoTracking.viewed' => 0), 'order' => array('MemoTracking.created' => 'DESC'))); // Tipo propietario

        $userName = $userName['MemoTracking']['to'];

        $fullNamesOrPicture = NULL;
        $LDAP_HOST = $this->ldap['LDAP_HOST']; //ldap://violeta.mmeg.cl
        $LDAP_HOST_2 = $this->ldap['LDAP_HOST_2']; //ldap://amanda.mmeg.cl
        $LDAP_PORT = $this->ldap['LDAP_PORT']; //3268 o 389
        $LDAP_ADMIN_DN = $this->ldap['LDAP_ADMIN_DN'];
        $LDAP_ADMIN_PASSWORD = $this->ldap['LDAP_ADMIN_PASSWORD'];
        $LDAP_SEARCH_OU = $this->ldap['LDAP_SEARCH_OU'];

        if (!is_null($userName) && $userName != '') {

            $ds = (ldap_connect($LDAP_HOST, $LDAP_PORT)) ? ldap_connect($LDAP_HOST, $LDAP_PORT) : ldap_connect($LDAP_HOST_2, $LDAP_PORT);

            if (ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3)) {
                if (ldap_bind($ds, $LDAP_ADMIN_DN, $LDAP_ADMIN_PASSWORD)) {
                    $sr = ldap_search($ds, $LDAP_SEARCH_OU, "samaccountname=" . $userName);
                    $infos = ldap_get_entries($ds, $sr);

                    $organizationName = explode(',OU=', $infos[0]["distinguishedname"][0]);
                    //if($organizationName[1] <> 'ELIMINAR'){ 
                    $fullNamesOrPicture = ($thumbnailphoto) ? @$infos[0]['thumbnailphoto'][0] : $infos[0]["name"][0];

                    return (($fullNamesOrPicture) ? $fullNamesOrPicture : __('No information'));
                    //}
                }
            }
            ldap_close($ds);
        }
    }

    /**
     * users_exist method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function users_exist($usersNames = null)
    {

        $usersNames = str_replace("@minmujeryeg.gob.cl", "", $usersNames);
        $userName = explode(',',  $usersNames);
        $wrongNames = NULL;

        $LDAP_HOST = $this->ldap['LDAP_HOST']; //ldap://violeta.mmeg.cl
        $LDAP_HOST_2 = $this->ldap['LDAP_HOST_2']; //ldap://amanda.mmeg.cl
        $LDAP_PORT = $this->ldap['LDAP_PORT']; //3268 o 389
        $LDAP_ADMIN_DN = $this->ldap['LDAP_ADMIN_DN'];
        $LDAP_ADMIN_PASSWORD = $this->ldap['LDAP_ADMIN_PASSWORD'];
        $LDAP_SEARCH_OU = $this->ldap['LDAP_SEARCH_OU'];

        if (!empty($userName[0])) {
            foreach ($userName as $user) :

                if (!empty($userName)) {

                    $ds = (ldap_connect($LDAP_HOST, $LDAP_PORT)) ? ldap_connect($LDAP_HOST, $LDAP_PORT) : ldap_connect($LDAP_HOST_2, $LDAP_PORT);

                    if (ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3)) {
                        if (ldap_bind($ds, $LDAP_ADMIN_DN, $LDAP_ADMIN_PASSWORD)) {
                            $sr = ldap_search($ds, $LDAP_SEARCH_OU, "samaccountname=" . $user);
                            $sr2 = ldap_search($ds, $LDAP_SEARCH_OU, "mail=" . $user . "@minmujeryeg.gob.cl");
                            $infos = ldap_get_entries($ds, $sr); //var_dump($infos);
                            $infos2 = ldap_get_entries($ds, $sr2); //var_dump($infos2);
                            $organizationName = explode(',OU=', $infos[0]["distinguishedname"][0]);

                            (is_null($infos[0]["name"][0])) ? $wrongNames[] = $user . "@minmujeryeg.gob.cl" : NULL;

                            //if($organizationName[1] <> 'ELIMINAR'){ 

                            $fullNames = $infos[0]["name"][0]; //debug($fullNames);
                            $fullNames2 = $infos2[0]["name"][0]; //debug($fullNames2);

                            if (is_null($fullNames) and is_null($fullNames2)) :
                                return array(false, $wrongNames);
                            endif;
                            //}

                        }
                    }
                    ldap_close($ds);
                }
            endforeach;
        } else {
            return array(NULL, $wrongNames);
        }
    }

    /**
     * find_recipient method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function find_recipient($memoId = null)
    {

        $userName = $this->Memo->MemoTracking->find('first', array('conditions' => array('MemoTracking.memo_tracking_type_id' => '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0', 'MemoTracking.memo_id' => $memoId, 'MemoTracking.viewed' => 0), 'order' => array('MemoTracking.created' => 'DESC'))); // Tipo aprobación
        $userName = @$userName['MemoTracking']['to'];

        $fullNames = NULL;
        $LDAP_HOST = $this->ldap['LDAP_HOST']; //ldap://violeta.mmeg.cl
        $LDAP_HOST_2 = $this->ldap['LDAP_HOST_2']; //ldap://amanda.mmeg.cl
        $LDAP_PORT = $this->ldap['LDAP_PORT']; //3268 o 389
        $LDAP_ADMIN_DN = $this->ldap['LDAP_ADMIN_DN'];
        $LDAP_ADMIN_PASSWORD = $this->ldap['LDAP_ADMIN_PASSWORD'];
        $LDAP_SEARCH_OU = $this->ldap['LDAP_SEARCH_OU'];

        if (!is_null($userName) && $userName != '') {

            $ds = (ldap_connect($LDAP_HOST, $LDAP_PORT)) ? ldap_connect($LDAP_HOST, $LDAP_PORT) : ldap_connect($LDAP_HOST_2, $LDAP_PORT);

            if (ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3)) {
                if (ldap_bind($ds, $LDAP_ADMIN_DN, $LDAP_ADMIN_PASSWORD)) {
                    $sr = ldap_search($ds, $LDAP_SEARCH_OU, "samaccountname=" . $userName);
                    $sr2 = ldap_search($ds, $LDAP_SEARCH_OU, "mail=*" . $userName . "*");
                    $infos = ldap_get_entries($ds, $sr);
                    $infos2 = ldap_get_entries($ds, $sr2);

                    $organizationName = explode(',OU=', @$infos[0]["distinguishedname"][0]);
                    //if(@$organizationName[1] <> 'ELIMINAR'){ 
                    $fullNames = (@$infos[0]["name"][0]) ? $infos[0]["name"][0] : @$infos2[0]["displayname"][0];
                    return ($fullNames) ?: __('No information');
                    //}
                }
            }
            ldap_close($ds);
        } else {
            return __('No information');
        }
    }

    /**
     * find_recipient method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function traceability($year = NULL)
    {

        $this->layout = false;

        $memos = $this->Memo->MemoTracking->find('all', array('conditions' => array('MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0', 'MemoTracking.viewed' => 0, 'Memo.created LIKE' => $year . '%'), 'order' => array('Memo.memo_number' => 'DESC'))); // Tipo Propietario

        $matters = $this->Memo->Matter->find('list');

        $this->set(compact('memos', 'matters'));
    }

    /**
     * reception_date method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function reception_date($memoId = NULL)
    {

        $this->layout = false;

        $receptionDate = $this->Memo->MemoTracking->field('created', array('MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0', 'MemoTracking.memo_id' => $memoId));

        return ($receptionDate);
    }

    /**
     * if_uuid method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function if_uuid($uuid = NULL)
    {

        if (!is_string($uuid) || (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $uuid) !== 1)) {

            $this->Memo->Matter->create();
            $this->request->data['Matter']['name'] = $uuid;
            if ($this->Memo->Matter->save($this->request->data['Matter'])) {
                return $this->Memo->Matter->getInsertID();
            } else {
                return false;
            }
        }
        return $uuid;
    }

    /**
     * find_form method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function find_form($memoId = NULL)
    {

        $this->Memo->MemoTracking->recursive = 1;
        $form = $this->Memo->MemoTracking->find('first', array('conditions' => array('MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0', 'MemoTracking.memo_id' => $memoId)));

        return $form;
    }

    /**
     * send method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function send($memoId = NULL, $idSubrogance = NULL)
    {

        $this->Memo->id = $memoId;

        $addressees = $this->Memo->MemoTracking->find('first', array('conditions' => array('MemoTracking.memo_tracking_type_id' => '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0', 'MemoTracking.viewed' => 0, 'Memo.id' => $memoId))); //Tipo Aprobación

        $memoTrackingId = $this->Memo->MemoTracking->field('id', array('MemoTracking.memo_id' => $memoId, 'MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0', 'MemoTracking.viewed' => 0));

        $this->Memo->MemoTracking->updateAll(array('MemoTracking.to' => "'" . $this->Auth->user('username') . "'"), array('MemoTracking.id' => $memoTrackingId));
        //debug($memoTrackingId); exit;
        if ($addressees) :
            $countMemos = $this->Memo->field('MAX(memo_number)', array('year' => date('Y')));
            $this->request->data['Memo']['memo_number'] = ++$countMemos;
            $this->request->data['Memo']['year'] = date('Y');

            if ($this->Memo->save($this->request->data['Memo'])) {

                $this->Memo->MemoTracking->id = $memoTrackingId;
                $this->Memo->MemoTracking->saveField('subrogance_id', $idSubrogance);

                $memoNumber = 'D' . $countMemos . '-' . date('Y');

                $this->contact_email(0, $addressees['MemoTracking']['to'], $memoId);

                $this->Session->setFlash(__('The memo ') . $memoNumber . __(' has been saved'), 'flash/success');
            } else {
                $this->Session->setFlash(__('The memo could not be saved. Please, try again.'), 'flash/error');
            }
        else :
            $this->Session->setFlash(__('The memorandum is missing the addressees. Please, try again.'), 'flash/error');
        endif;

        $this->redirect(array('action' => 'index'));
    }

    /**
     * send method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function count_memo($box = NULL, $startDate = NULL, $endDate = NULL)
    {

        $this->loadModel('Share');

        $sharesDraft = $this->Share->find('all', array('conditions' => array('Share.username' => $this->Auth->user('username')))); //debug($sharesDraft);
        if (!empty($sharesDraft[0]['Share'])) :
            $sharesAddressee = $this->Share->find('list', array('fields' => array('username', 'username'), 'conditions' => array('parent_id' => $sharesDraft[0]['Share']['id']))); //debug($sharesAddressee);
        endif;
        $sharesDraft = Hash::combine($sharesDraft, '{n}.Parent.username', '{n}.Parent.username'); //debug($sharesDraft);
        //$sharesDraft = null;
        //$sharesAddressee = null;

        if ($sharesDraft) :
            $usersParent = array_merge($sharesDraft, array($this->Auth->user('username') => $this->Auth->user('username'))); //debug($users);
        else :
            $usersParent = $this->Auth->user('username');
        endif;
        //debug($usersParent);

        if (!empty($sharesAddressee)) :
            $usersChild = array_merge($sharesAddressee, array($this->Auth->user('username') => $this->Auth->user('username'))); //debug($users);
        else :
            $usersChild = $this->Auth->user('username');
        endif;
        //debug($usersChild);

        if ($box == 1) : //Recibidos
            $count = $this->Memo->MemoTracking->find('count', array('conditions' => array('MemoTracking.to' => $usersChild, 'Memo.state_id IS NULL', 'OR' => array(array('MemoTracking.memo_tracking_type_id' => '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0'), array('MemoTracking.memo_tracking_type_id' => '5c924533-db78-449d-b52a-0450c26b1ae0')), 'MemoTracking.viewed' => 0, 'MemoTracking.read' => 0, 'Memo.memo_number IS NOT NULL', 'Memo.created BETWEEN ? and ?' => array($startDate, $endDate)), 'group' => array('MemoTracking.memo_id'), 'order' => array('Memo.created DESC')));
        elseif ($box == 2) :  //Enviados
            $count = $this->Memo->MemoTracking->find('count', array('conditions' => array('MemoTracking.to' => $this->Auth->user('username'), 'MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0', 'MemoTracking.viewed' => 0, 'MemoTracking.read' => 0, 'Memo.memo_number IS NOT NULL', 'Memo.created BETWEEN ? and ?' => array($startDate, $endDate)), 'group' => array('MemoTracking.memo_id'), 'order' => array('Memo.created DESC')));
        elseif ($box == 3) :  //Notificación
            $count = $this->Memo->MemoTracking->find('count', array('conditions' => array('MemoTracking.to' => $this->Auth->user('username'), 'MemoTracking.memo_tracking_type_id' => '5b8588ba-ef8c-49e1-8592-1f68c26b1ae0', 'MemoTracking.viewed' => 0, 'MemoTracking.read' => 0, 'Memo.memo_number IS NOT NULL', 'Memo.created BETWEEN ? and ?' => array($startDate, $endDate)), 'group' => array('MemoTracking.memo_id'), 'order' => array('Memo.created DESC')));
        elseif ($box == 4) : // Borradores
            $count = $this->Memo->MemoTracking->find('count', array('conditions' => array('MemoTracking.to' => $usersParent, 'MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0', 'MemoTracking.viewed' => 0, 'MemoTracking.read' => 0, 'Memo.memo_number IS NULL', 'Memo.state_id IS NULL', 'Memo.created BETWEEN ? and ?' => array($startDate, $endDate)), 'group' => array('MemoTracking.memo_id'), 'order' => array('Memo.modified DESC')));
        elseif ($box == 5) : // Gestionados
            $count = $this->Memo->MemoTracking->find('count', array('conditions' => array('MemoTracking.to' => $usersChild, 'OR' => array(array('MemoTracking.memo_tracking_type_id' => '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0'), array('MemoTracking.memo_tracking_type_id' => '5c924533-db78-449d-b52a-0450c26b1ae0')), 'MemoTracking.viewed' => 0, 'MemoTracking.read' => 0, 'Memo.memo_number IS NOT NULL', 'Memo.state_id IS NOT NULL', 'Memo.created BETWEEN ? and ?' => array($startDate, $endDate)), 'group' => array('MemoTracking.memo_id'), 'order' => array('Memo.created DESC')));
        endif;

        return ($count) ? $count : 0;
    }

    /**
     * search method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function search()
    {

        $searchs = null;

        if ($this->request->is('post')) { //debug($this->request->data); exit;

            $dataSearch = $this->request->data['Memo']['search'];
            $dataYear = $this->request->data['Memo']['year']['year'];

            if ($this->request->data['Memo']['from']) :
                $searchs = $this->Memo->MemoTracking->find(
                    'all',
                    array(
                        'conditions' => array(
                            'MemoTracking.memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0', // Propietario
                            'MemoTracking.to' => $this->Auth->user('username'),
                            'Memo.created LIKE' => $dataYear . '%',
                            'Memo.memo_number IS NOT NULL', 'OR' => array(
                                array('Memo.memo_number LIKE' => '%' . $dataSearch . '%'),
                                array('Memo.reference LIKE' => '%' . $dataSearch . '%'),
                                array('Memo.description LIKE' => '%' . $dataSearch . '%'),
                                array('Memo.description LIKE' => '%' . $dataSearch . '%'),
                                array('Memo.external_office LIKE' => '%' . $dataSearch . '%'),
                                array('Memo.internal_office LIKE' => '%' . $dataSearch . '%')
                            )
                        )
                    )
                ); //debug($searchs); exit;
            elseif ($this->request->data['Memo']['to']) :
                $searchs = $this->Memo->MemoTracking->find(
                    'all',
                    array(
                        'conditions' => array(
                            'MemoTracking.memo_tracking_type_id' => '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0', // Aprobación
                            'MemoTracking.to' => $this->Auth->user('username'),
                            'Memo.created LIKE' => $dataYear . '%',
                            'Memo.memo_number IS NOT NULL', 'OR' => array(
                                array('Memo.memo_number LIKE' => '%' . $dataSearch . '%'),
                                array('Memo.reference LIKE' => '%' . $dataSearch . '%'),
                                array('Memo.description LIKE' => '%' . $dataSearch . '%'),
                                array('Memo.external_office LIKE' => '%' . $dataSearch . '%'),
                                array('Memo.internal_office LIKE' => '%' . $dataSearch . '%')
                            )
                        )
                    )
                ); //debug($searchs); exit;
            else :
                $searchs = $this->Memo->find(
                    'all',
                    array(
                        'conditions' => array(
                            'Memo.memo_number IS NOT NULL',
                            'Memo.created LIKE' => $dataYear . '%',
                            'OR' => array(
                                array('Memo.memo_number LIKE' => '%' . $dataSearch . '%'),
                                array('Memo.reference LIKE' => '%' . $dataSearch . '%'),
                                array('Memo.description LIKE' => '%' . $dataSearch . '%'),
                                array('Memo.external_office LIKE' => '%' . $dataSearch . '%'),
                                array('Memo.internal_office LIKE' => '%' . $dataSearch . '%')
                            )
                        )
                    )
                ); //debug($searchs[0]);
            endif;
        }

        $this->set(compact('searchs'));
    }

    /**
     * search_report method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function search_report()
    {

        $reference = $description = $searchs = $excel = null;

        if ($this->request->is('post')) { //debug($this->request->data); exit;

            $excel = (@$this->request->data['excel'] == '') ? true : false;

            if ($excel) :
                $this->layout = false;
                $this->autoRender = false;
            endif;

            $startDate = $this->request->data['Memo']['startDate'];
            $endDate = $this->request->data['Memo']['endDate'];
            $reference = $this->request->data['Memo']['header'];
            $description = $this->request->data['Memo']['description'];
            $keyword = $this->request->data['Memo']['keyword'];

            $searchs = $this->Memo->MemoTracking->find('all', array(
                'conditions' => array(
                    'OR' => array(
                        array('Memo.memo_number LIKE' => '%' . $keyword . '%'),
                        ($reference) ? array('Memo.reference LIKE' => '%' . $keyword . '%') : NULL,
                        ($description) ? array('Memo.description LIKE' => '%' . $keyword . '%') : NULL,
                    ),
                    'MemoTracking.created BETWEEN ? and ?' => array($startDate, $endDate),
                    'MemoTracking.to' => $this->Session->read('Auth.User.username')
                ),
                'group' => array('MemoTracking.memo_id')
            ));
        }

        $startDate = date('Y-m-d', strtotime(date('Y-m-d') . ' - 10 days'));
        $endDate =  date('Y-m-d', strtotime(date('Y-m-d') . ' + 1 days'));

        $this->set(compact('startDate', 'endDate', 'searchs', 'excel'));

        /*$searchs = $this->Memo->find('all', array(
                'contain' => array('Matter', 'MemoTracking' => array('conditions' => array('MemoTracking.memo_tracking_type_id' => '5b8588b3-667c-4f97-a1ec-1f68c26b1ae0'))),
                'conditions' => array(
                    'OR' => array(
                        array('Memo.initial_responsibility' => '/gmf',
                              //'Memo.initial_responsibility' => '/hs'
                        )
                    )
                ),
                //'limit' => 100
            )); 
        //debug($searchs);
        $this->set(compact('searchs'));*/
    }

    /**
     * disable_attach method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function disable_attach($attachmentId = NULL)
    {

        $this->autoRender = false;

        $this->Memo->Attachment->id = $attachmentId;
        $this->Memo->Attachment->saveField('disable', 1);
    }

    /**
     * disable_attach method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function list_shunt($memoId = NULL)
    {

        $this->autoRender = false;

        $listShuntUsers = $this->Memo->MemoTracking->find('list', array('fields' => array('to', 'to'), 'conditions' => array('MemoTracking.memo_tracking_type_id' => '5c924533-db78-449d-b52a-0450c26b1ae0', 'MemoTracking.memo_id' => $memoId)));

        return ($listShuntUsers);
    }

    /**
     * disable_attach method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function return_memo($memoId = NULL)
    {

        $this->autoRender = false;

        $listShuntUsers = $this->Memo->MemoTracking->find('list', array('fields' => array('to', 'to'), 'conditions' => array('MemoTracking.memo_tracking_type_id' => '5c924533-db78-449d-b52a-0450c26b1ae0', 'MemoTracking.memo_id' => $memoId)));

        return ($listShuntUsers);
    }

    /**
     * disable_attach method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function merge()
    {

        if ($this->request->is('post')) : //debug($this->request->data); exit;

            $memoFirst = $this->request->data['Memo']['first'];
            $memoSecond = $this->request->data['Memo']['second'];

            $memoNumberFirst = explode('-', $memoFirst);
            $memoNumberSecond = explode('-', $memoSecond);

            $memoFirstId = $this->Memo->field('id', array('memo_number' => $memoNumberFirst[0], 'year' => $memoNumberFirst[1]));
            $memoSecondId = $this->Memo->field('id', array('memo_number' => $memoNumberSecond[0], 'year' => $memoNumberSecond[1]));

            if (!empty($memoFirstId) and !empty($memoSecondId)) :
                $memoFirstLastId = $this->recursive_memo($memoFirstId);
                $memoSecondLastId = $this->recursive_memo($memoSecondId);

                if ($memoFirstLastId === $memoSecondLastId) :
                    $this->Session->setFlash(__('Los memorándums seleccionados no se puede unir. Por favor, inténtelo nuevamente con otro.'), 'flash/error');
                else :
                    $this->Memo->id = $memoFirstLastId;
                    if ($this->Memo->saveField('parent_id', $memoSecondLastId)) :

                        /*$this->Memo->Historial->create();
                        $data['Historial']['owner'] = $this->Auth->user('username');
                        $data['Historial']['memo_one'] = $memoFirstLastId;
                        $data['Historial']['memo_two'] = $memoSecondLastId;
                        $this->Memo->Historial->save($data);*/

                        $userOwnerFirst = $this->Memo->MemoTracking->field('to', array('memo_id' => $memoFirstLastId, 'memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0'));  // Propietario
                        $userOwnerSecond = $this->Memo->MemoTracking->field('to', array('memo_id' => $memoSecondLastId, 'memo_tracking_type_id' => '5ba4f0ba-ec28-471e-af3e-2630c26b1ae0'));  // Propietario

                        $this->contact_email(7, $userOwnerFirst, $memoFirstLastId, null, $memoSecondLastId);
                        $this->contact_email(7, $userOwnerSecond, $memoSecondLastId, null, $memoFirstLastId);

                        $this->Session->setFlash(__('Los memorándums han sido unidos de manera correcta.'), 'flash/success');
                        $this->redirect(array('action' => 'time_line', $memoFirstLastId));

                    else :
                        $this->Session->setFlash(__('No se pudo unir los memorándums. Por favor, inténtelo nuevamente.'), 'flash/error');
                    endif;
                endif;
            else :
                $this->Session->setFlash(__('Se ha ingreso un número de memorándum incorrecto. Por favor, inténtelo nuevamente.'), 'flash/error');
            endif;
        endif;
    }

    /**
     * disable_attach method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */

    public function recursive_memo($id = null)
    {

        $memoParentId = $this->Memo->field('parent_id', array('id' => $id));

        if (!empty($memoParentId)) :
            return $this->recursive_memo($memoParentId);
        else :
            return $id;
        endif;
    }
}
