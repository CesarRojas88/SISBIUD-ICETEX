<?php
class Index_IndexController extends Zend_Controller_Action
{
    private $authAdapter;
    private $auth;
    public function init()
    {
        /* Initialize action controller here */
        $this->view->baseUrl = $this->_request->getBaseUrl();
        $this->initView();
    }
    
    public function loginAction()
    {
        if (!Zend_Auth::getInstance()->hasIdentity())
            $this->_redirect('Index/index');
    }
    
    public function indexAction()
    {
        if(Zend_Auth::getInstance()->hasIdentity())
        {   
            $this->_redirect('Index/index/login');
        }
        $request=  $this->getRequest();
        $formulariologin= new Index_Form_Index();
        if($request->isPost())
        {
            if($formulariologin->isValid($this->_request->getPost()))
            {
                $this->authAdapter =  $this->getAuthAdapter();
                $usuario=$formulariologin->getValue('usuario');
                $contrasena=$formulariologin->getValue('contrasenia');
                $this->authAdapter->setIdentity($usuario)
                        ->setCredential($contrasena);
                $this->auth = Zend_Auth::getInstance();
                $result=$this->auth->authenticate($this->authAdapter);
                if($result->isValid()) {
	      // enviamos una consulta al modelo
		  // el modelo nos devuelve un conjunto de datos, entre ellos el nombre real y el apellido
		  // esos datos los seteamos a nav.phtml como una variable global de sesion
                    $datos2=new Index_Model_DbTable_Usuario();
		    $usuario_info=$datos2->setLogueo($usuario);
                    Zend_Session::start();
                    $authStorage=$this->auth->getStorage();
                    //var_dump($session->getNamespace());
		    $authStorage->nombre = $usuario_info[nombre_real] . " " . $usuario_info[apellido_real];
                    $authStorage->perfil = $usuario_info[perfil];
                    $identity=$this->authAdapter->getResultRowObject();
                    $authStorage->write($identity);
                    $this->_redirect('Index/index/login');//redirecciona cuando loguea*/
                    //var_dump($session);
                    var_dump($this->authAdapter);
                    //var_dump($usuario_info);
                }  else {
                    $this->view->errorMessage='El usuario o contraseña son incorrectos.';
                }
            }
        }
       $this->view->formLogin=$formulariologin;
    }

    public function logoutAction()
    {
        // action body
        Zend_Auth::getInstance()->clearIdentity();
        //destruyo todos los daots del namespace
        Zend_Session::namespaceUnset('SuperAdmin');
	Zend_Session::namespaceUnset('Admin1');
	Zend_Session::stop();
        Zend_Session::destroy();
        $this->_redirect('Index/index');
    }

    private function getAuthAdapter()
    {
        $authAdapter= new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
        $authAdapter->setTableName('usuario')
                ->setIdentityColumn('nombre_usuario')
                ->setCredentialColumn('contrasena');
        return $authAdapter;
    }

    public function insertarAction()
    {
        // action body
    }
}
