<?php
class IndexController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
        $this->initView();
    }

    public function indexAction()
    {
        // action body  
        $this->view->baseUrl = $this->_request->getBaseUrl();
        //$formulariologin= new Default_Form_Login();
        //$formulariologin->submit->setLabel('Iniciar sesion');
        //$this->view->formlogin=$formulariologin;
    }

    public function loginAction()
    {
        $this->view->baseUrl = $this->_request->getBaseUrl();
        if(Zend_Auth::getInstance()->hasIdentity())
        {
            $this->_redirect('sistema/index');
        }
        $request=  $this->getRequest();
        $formulariologin= new Form_Login();
        if($request->isPost())
        {
            if($formulariologin->isValid($this->_request->getPost()))
            {
                $authAdapter=  $this->getAuthAdapter();
                $usuario=$formulariologin->getValue('usuario');
                $contrasena=$formulariologin->getValue('contrasenia');
                $authAdapter->setIdentity($usuario)
                        ->setCredential($contrasena);
                $auth=  Zend_Auth::getInstance();
                $result=$auth->authenticate($authAdapter);
                if($result->isValid()) {
	      // enviamos una consulta al modelo
		  // el modelo nos devuelve un conjunto de datos, entre ellos el nombre real y el apellido
		  // esos datos los seteamos a nav.phtml como una variable global de sesion
                    $datos2=new Model_DbTable_Usuario();
		    $usuario_info=$datos2->setLogueo($usuario);
		    
                    Zend_Session::start();
		    if ($usuario_info->perfil == 'Admin')
		      $session = new Zend_Session_Namespace('Admin1');
		    else
		      $session = new Zend_Session_Namespace('SuperAdmin');
                    $session->usuario_id = $usuario;
		    $session->nombre = $usuario_info->nombre_real . " " . $usuario_info->apellido_real;
		    $session->perfil = $usuario_info->perfil;
                    $identity=$authAdapter->getResultRowObject();
                    $authStorage=$auth->getStorage();
                    $authStorage->write($identity);
                    $this->_redirect('sistema/index');//redirecciona cuando loguea
                }  else {
                    $this->view->errorMessage='El usuario o contraseña son incorrectos.';
                }
            }
        }
       $this->view->formlogin=$formulariologin;
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
        $this->_redirect('index/login');
    }

    private function getAuthAdapter()
    {
        $authAdapter= new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
        $authAdapter->setTableName('user')
                ->setIdentityColumn('nombre_usuario')
                ->setCredentialColumn('contrasena');
        return $authAdapter;
    }

    public function insertarAction()
    {
        // action body
    }
}
