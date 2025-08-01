<?php
App::uses('BaseAuthenticate', 'Controller/Component/Auth');

class LdapAuthenticate extends BaseAuthenticate {

    public $components = array('Session');
    
	var $helpers = array('Html', 'Form','Session');

	public function authenticate(CakeRequest $request, CakeResponse $response) {
     
		$user = $this->_ldapAuth($request['data']['User']);

		return $user;
	}


	function _ldapAuth($request) {

        $clearUser = explode("@", $request['username']);
        
		$username = $clearUser[0]; 
		$password = $request['password'];  
        $group_id = '1'; 

		if ($password == "") return false;

        $LDAP_HOST = "10.50.0.2"; //ldap://violeta.mmeg.cl
        $LDAP_HOST_2 = "10.50.0.6"; //ldap://amanda.mmeg.cl
		$LDAP_PORT = 389; //3268 o 389
		$LDAP_ADMIN_DN = "memo";
		$LDAP_ADMIN_PASSWORD = "Ksjn23_12";
		$LDAP_SEARCH_OU = "OU=USUARIOS,OU=MMEG,DC=mmeg,DC=cl";

		$ds = (ldap_connect($LDAP_HOST, $LDAP_PORT)) ? ldap_connect($LDAP_HOST, $LDAP_PORT) : ldap_connect($LDAP_HOST_2, $LDAP_PORT);
		if (!$ds) return false;

		if (ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3))
		{
			if (ldap_bind($ds, $LDAP_ADMIN_DN, $LDAP_ADMIN_PASSWORD))
			{ 
				$sr = ldap_search($ds, $LDAP_SEARCH_OU, "samaccountname=".$username); 
				$info = ldap_get_entries($ds, $sr);  
                
                if(!empty($info[0]["dn"]))
                {
                    if (ldap_bind($ds, $info[0]["dn"], $password))
                    { 
                        $ret = array("name" => $username);

                        $ret["fullname"] = $info[0]["name"][0];
                        $ret["group_id"] = $group_id;
                        $ret["username"] = $username;
                        $ret['thumbnailphoto'] = @$info[0]['thumbnailphoto'][0];

                        //$ret["id"] = $info[0]["initials"][0];

                        $ret["groups"] = array();
                        foreach ($info[0]["memberof"] as $val) {

                            if (preg_match("/CN=(\w+)/", $val, $matches))
                            {
                                $ret["groups"][] = $matches[1];
                            }
                        }

                        return $ret;
                    }
                }
			}
		}
        
		ldap_close($ds);
        
		$this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'login');
		return false;
	}
}
?>
