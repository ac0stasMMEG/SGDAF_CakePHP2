<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    var $name = 'Users';
    var $uses = array('User');

    public $components = array('Paginator', 'Captcha.Captcha' => array('field' => 'security_code'));

    /**
     * captcha method
     *
     * @return void
     */
    public function captcha()
    {
        $this->autoRender = false;
        $this->layout = 'ajax';
        if (!isset($this->Captcha)) { //if you didn't load in the header
            $this->Captcha = $this->Components->load('Captcha.Captcha'); //load it
        }
        $this->Captcha->create();
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {

        $users = $this->User->find('all');
        $active = $this->active;

        $this->set(compact('active', 'users'));
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
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) { //debug($this->request->data); exit;

            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'), 'flash/success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'flash/error');
            }
        }

        $active = $this->active;
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups', 'active'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) { //debug($this->request->data); exit;
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'), 'flash/success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'flash/error');
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }

        $active = $this->active;
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups', 'active'));
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
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'), 'flash/success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'), 'flash/error');
        $this->redirect(array('action' => 'index'));
    }

    /**
     * login method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function login()
    {

        $this->theme = 'Login2';

        if ($this->Auth->user('username')) :
            return $this->redirect(array('controller' => 'requirements', 'action' => 'home'));
        endif;

        if ($this->request->is('post')) {

            $username = explode("@", $this->request->data['User']['username']);
            $this->request->data['User']['username'] = $username[0];
            $captchaCode = $this->Captcha->getCode('Signup.security_code');
            $captchaInsert = strtolower($this->request->data['Signup']['security_code']);

            if (($this->Auth->login()) and ($captchaCode == $captchaInsert)) {

                $this->Session->write('groupDB_id', $this->find_group(@$this->request->data['User']['username']));
                $userArea = $this->User->find('first', array(
                    'conditions' => array('User.username' => $username)
                ));
                $this->Session->write('Auth.User.area', $userArea['User']['area']); 
                // Asigna el área correspondiente
                #debug($this->Session->read('Auth.User.area'));

                return $this->redirect(array('controller' => 'requirements', 'action' => 'home'));
            }
            $this->Session->setFlash(__('Your username, password or code was incorrect.'), 'flash/error');
        }
    }

    /**
     * find_user_fullname method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function find_user_fullname()
    {

        $this->autoRender = false;

        $username = $this->params['url']['term'];
        //$username = 'iva';
        $memo = $this->params['url']['memo'];
        //$memo = true;

        $LDAP_HOST = $this->ldap['LDAP_HOST']; //ldap://violeta.mmeg.cl
        $LDAP_HOST_2 = $this->ldap['LDAP_HOST_2']; //ldap://amanda.mmeg.cl
        $LDAP_PORT = $this->ldap['LDAP_PORT']; //3268 o 389
        $LDAP_ADMIN_DN = $this->ldap['LDAP_ADMIN_DN'];
        $LDAP_ADMIN_PASSWORD = $this->ldap['LDAP_ADMIN_PASSWORD'];
        $LDAP_SEARCH_OU = $this->ldap['LDAP_SEARCH_OU'];

        if (!empty($username)) {

            $ds = (ldap_connect($LDAP_HOST, $LDAP_PORT)) ? ldap_connect($LDAP_HOST, $LDAP_PORT) : ldap_connect($LDAP_HOST_2, $LDAP_PORT);

            if (ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3)) {
                if (ldap_bind($ds, $LDAP_ADMIN_DN, $LDAP_ADMIN_PASSWORD)) {

                    $sr = ldap_search($ds, $LDAP_SEARCH_OU, "displayname=*" . $username . "*");
                    $infos = ldap_get_entries($ds, $sr);
                    //var_dump($infos);
                    $i = 0;
                    foreach ($infos as $info) //debug($info["name"][0]);
                    {
                        if (!empty($info["name"][0])) {
                            $organizationName = explode(',OU=', $info["distinguishedname"][0]); //debug($organizationName);

                            if (($organizationName[1] <> 'ELIMINAR') and ($info["mail"][0])) { //debug($infos[$i]["samaccountname"][0]);
                                if ($info["samaccountname"][0] <> 'antonia.orellana') { //debug($infos[$i]["samaccountname"][0]);
                                    $response[$i]['label'] = $info["displayname"][0] . ' -  ' . @$info["department"][0];
                                    $response[$i]['value'] = ($memo) ? $info["mail"][0] : $info["name"][0];
                                    $response[$i]['userName'] = $info["samaccountname"][0];
                                }
                                $i++;
                            }
                        }
                    }
                    echo json_encode($response);
                    ldap_close($ds);
                }
            }
        } //debug($response);
    }

    /**
     * logout method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function logout($renew = false)
    {

        $this->autoRender = false;

        if ($renew) :
            $this->Session->renew();
            $this->Session->setFlash(__('Sessión Reactivada'), 'flash/success');

            return false;
        else :
            $this->Session->destroy();

            $this->Session->setFlash(__('Good-Bye.'), 'flash/error');

            $this->redirect($this->Auth->logout());
        endif;
    }

    /**
     * find_group method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function find_group($userName = null)
    {

        $userGroupId = $this->User->field('group_id', array('User.username' => $userName));

        return $userGroupId;
    }

    /**
     * beforeFilter method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('initDB', 'captcha');

        /*$groupUser = $this->User->field('group_id', array('User.username' => $this->Auth->user('username')));

        $this->request->data['User']['group_id'] = $groupUser;
        $this->Auth->user = array('group_id' => $groupUser);*/
        //debug($this->find_group($this->request->data['User']['username'])); exit; 

        $this->Auth->authenticate = array('Ldap');
    }

    /**
     * initDB method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function initDB()
    {
        $group = $this->User->Group;

        // Allow administrador to everything
        $group->id = 1;
        $this->Acl->allow($group, 'controllers');

        // Allow Jefatura
        $group->id = 2;
        $this->Acl->deny($group, 'controllers');

        $this->Acl->allow($group, 'controllers/accepted_receptions/add');
        $this->Acl->allow($group, 'controllers/accepted_receptions/edit');
        $this->Acl->allow($group, 'controllers/accepted_receptions/view');
        $this->Acl->allow($group, 'controllers/accepted_receptions/pdf');

        $this->Acl->allow($group, 'controllers/holidays/subtracted_days');

        $this->Acl->allow($group, 'controllers/memos/index');
        $this->Acl->allow($group, 'controllers/memos/index_modern');
        $this->Acl->allow($group, 'controllers/memos/add');
        $this->Acl->allow($group, 'controllers/memos/edit');
        $this->Acl->allow($group, 'controllers/memos/find_owner');
        $this->Acl->allow($group, 'controllers/memos/find_group');
        $this->Acl->allow($group, 'controllers/memos/recipient');
        $this->Acl->allow($group, 'controllers/memos/users_exist');
        $this->Acl->allow($group, 'controllers/memos/find_recipient');
        $this->Acl->allow($group, 'controllers/memos/reception_date');
        $this->Acl->allow($group, 'controllers/memos/pdf');
        $this->Acl->allow($group, 'controllers/memos/all_files');
        $this->Acl->allow($group, 'controllers/memos/find_form');
        $this->Acl->allow($group, 'controllers/memos/view_detail');
        $this->Acl->allow($group, 'controllers/memos/send');
        $this->Acl->allow($group, 'controllers/memos/count_memo');
        $this->Acl->allow($group, 'controllers/memos/captcha');
        $this->Acl->allow($group, 'controllers/memos/search');
        $this->Acl->allow($group, 'controllers/memos/search_report');
        $this->Acl->allow($group, 'controllers/memos/disable_attach');
        $this->Acl->allow($group, 'controllers/memos/list_shunt');
        $this->Acl->allow($group, 'controllers/memos/return_memo');
        $this->Acl->allow($group, 'controllers/memos/recover');

        $this->Acl->allow($group, 'controllers/memoTrackings/shunt');
        $this->Acl->allow($group, 'controllers/memoTrackings/refuse');
        $this->Acl->allow($group, 'controllers/memoTrackings/alert_shunt');
        $this->Acl->allow($group, 'controllers/memoTrackings/memo_shunt');
        $this->Acl->allow($group, 'controllers/memoTrackings/delete_alert_shunt');

        $this->Acl->allow($group, 'controllers/pages/home');

        $this->Acl->allow($group, 'controllers/supplier_ratings/add');
        $this->Acl->allow($group, 'controllers/supplier_ratings/edit');
        $this->Acl->allow($group, 'controllers/supplier_ratings/view');
        $this->Acl->allow($group, 'controllers/supplier_ratings/pdf');

        $this->Acl->allow($group, 'controllers/states/complete');

        $this->Acl->allow($group, 'controllers/users/login');
        $this->Acl->allow($group, 'controllers/users/find_group');
        $this->Acl->allow($group, 'controllers/users/logout');
        $this->Acl->allow($group, 'controllers/users/find_user_fullname');
        $this->Acl->allow($group, 'controllers/users/list_users');

        $this->Acl->allow($group, 'controllers/requirements/home');
        $this->Acl->allow($group, 'controllers/requirements/index');
        $this->Acl->allow($group, 'controllers/requirements/view');
        $this->Acl->allow($group, 'controllers/requirements/search');

        
        // Allow Secretaria
        /*$group->id = 5;
        $this->Acl->deny($group, 'controllers');
        
        $this->Acl->allow($group, 'controllers/accepted_receptions/add');
        $this->Acl->allow($group, 'controllers/accepted_receptions/edit');
        $this->Acl->allow($group, 'controllers/accepted_receptions/view');
        $this->Acl->allow($group, 'controllers/accepted_receptions/pdf');
        
        $this->Acl->allow($group, 'controllers/holidays/subtracted_days');
        
        $this->Acl->allow($group, 'controllers/memos/index');
        $this->Acl->allow($group, 'controllers/memos/index_modern');
        $this->Acl->allow($group, 'controllers/memos/add');
        $this->Acl->allow($group, 'controllers/memos/edit');
        $this->Acl->allow($group, 'controllers/memos/find_owner');
        $this->Acl->allow($group, 'controllers/memos/find_group');
        $this->Acl->allow($group, 'controllers/memos/recipient');
        $this->Acl->allow($group, 'controllers/memos/users_exist');
        $this->Acl->allow($group, 'controllers/memos/find_recipient');
        $this->Acl->allow($group, 'controllers/memos/reception_date');
        $this->Acl->allow($group, 'controllers/memos/pdf');
        $this->Acl->allow($group, 'controllers/memos/all_files');
        $this->Acl->allow($group, 'controllers/memos/find_form');
        $this->Acl->allow($group, 'controllers/memos/view_detail');
        $this->Acl->allow($group, 'controllers/memos/send');
        $this->Acl->allow($group, 'controllers/memos/count_memo');
        $this->Acl->allow($group, 'controllers/memos/captcha');
        $this->Acl->allow($group, 'controllers/memos/search');
        $this->Acl->allow($group, 'controllers/memos/search_report');
        $this->Acl->allow($group, 'controllers/memos/disable_attach');
        $this->Acl->allow($group, 'controllers/memos/list_shunt');
        $this->Acl->allow($group, 'controllers/memos/return_memo');
        $this->Acl->allow($group, 'controllers/memos/recover');
        
        $this->Acl->allow($group, 'controllers/memoTrackings/shunt');
        $this->Acl->allow($group, 'controllers/memoTrackings/refuse');
        $this->Acl->allow($group, 'controllers/memoTrackings/alert_shunt');
        $this->Acl->allow($group, 'controllers/memoTrackings/memo_shunt');
        $this->Acl->allow($group, 'controllers/memoTrackings/delete_alert_shunt');
        
        $this->Acl->allow($group, 'controllers/pages/home');
        
        $this->Acl->allow($group, 'controllers/supplier_ratings/add');
        $this->Acl->allow($group, 'controllers/supplier_ratings/edit');
        $this->Acl->allow($group, 'controllers/supplier_ratings/view');
        $this->Acl->allow($group, 'controllers/supplier_ratings/pdf');
        
        $this->Acl->allow($group, 'controllers/states/complete');
        
        $this->Acl->allow($group, 'controllers/users/login');
        $this->Acl->allow($group, 'controllers/users/find_group');
        $this->Acl->allow($group, 'controllers/users/logout');
        $this->Acl->allow($group, 'controllers/users/find_user_fullname');
        $this->Acl->allow($group, 'controllers/users/list_users');*/

        // Allow Oficina de Partes
        $group->id = 4;
        $this->Acl->deny($group, 'controllers');

        $this->Acl->allow($group, 'controllers/attachments/add_files');

        $this->Acl->allow($group, 'controllers/accepted_receptions/add');
        $this->Acl->allow($group, 'controllers/accepted_receptions/edit');
        $this->Acl->allow($group, 'controllers/accepted_receptions/view');
        $this->Acl->allow($group, 'controllers/accepted_receptions/pdf');

        $this->Acl->allow($group, 'controllers/holidays/subtracted_days');

        $this->Acl->allow($group, 'controllers/memos/index');
        $this->Acl->allow($group, 'controllers/memos/index_modern');
        $this->Acl->allow($group, 'controllers/memos/add');
        $this->Acl->allow($group, 'controllers/memos/edit');
        $this->Acl->allow($group, 'controllers/memos/find_owner');
        $this->Acl->allow($group, 'controllers/memos/find_group');
        $this->Acl->allow($group, 'controllers/memos/recipient');
        $this->Acl->allow($group, 'controllers/memos/users_exist');
        $this->Acl->allow($group, 'controllers/memos/find_recipient');
        $this->Acl->allow($group, 'controllers/memos/reception_date');
        $this->Acl->allow($group, 'controllers/memos/pdf');
        $this->Acl->allow($group, 'controllers/memos/all_files');
        $this->Acl->allow($group, 'controllers/memos/find_form');
        $this->Acl->allow($group, 'controllers/memos/view_detail');
        $this->Acl->allow($group, 'controllers/memos/send');
        $this->Acl->allow($group, 'controllers/memos/count_memo');
        $this->Acl->allow($group, 'controllers/memos/captcha');
        $this->Acl->allow($group, 'controllers/memos/search');
        $this->Acl->allow($group, 'controllers/memos/search_report');
        $this->Acl->allow($group, 'controllers/memos/disable_attach');
        $this->Acl->allow($group, 'controllers/memos/list_shunt');
        $this->Acl->allow($group, 'controllers/memos/return_memo');
        $this->Acl->allow($group, 'controllers/memos/recover');
        $this->Acl->allow($group, 'controllers/memos/parts_office');
        $this->Acl->allow($group, 'controllers/memos/parts_office_excel');
        $this->Acl->allow($group, 'controllers/memos/find_addressees');

        $this->Acl->allow($group, 'controllers/memoTrackings/shunt');
        $this->Acl->allow($group, 'controllers/memoTrackings/refuse');
        $this->Acl->allow($group, 'controllers/memoTrackings/alert_shunt');
        $this->Acl->allow($group, 'controllers/memoTrackings/memo_shunt');
        $this->Acl->allow($group, 'controllers/memoTrackings/delete_alert_shunt');

        $this->Acl->allow($group, 'controllers/pages/home');

        $this->Acl->allow($group, 'controllers/supplier_ratings/add');
        $this->Acl->allow($group, 'controllers/supplier_ratings/edit');
        $this->Acl->allow($group, 'controllers/supplier_ratings/view');
        $this->Acl->allow($group, 'controllers/supplier_ratings/pdf');

        $this->Acl->allow($group, 'controllers/states/complete');

        $this->Acl->allow($group, 'controllers/users/login');
        $this->Acl->allow($group, 'controllers/users/find_group');
        $this->Acl->allow($group, 'controllers/users/logout');
        $this->Acl->allow($group, 'controllers/users/find_user_fullname');
        $this->Acl->allow($group, 'controllers/users/list_users');

        // we add an exit to avoid an ugly "missing views" error message
        echo "all done";
        exit;
    }
}
