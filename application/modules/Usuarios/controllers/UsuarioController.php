<?php

class Usuarios_UsuarioController extends Zend_Controller_Action
{

    private $auth = null;

    private $authAdapter = null;

    public function init()
    {
        /* Initialize action controller here */
        $this->view->baseUrl = $this->_request->getBaseUrl();
        $this->initView();
    }

    public function indexAction()
    {
        
        if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            $table= new Usuarios_Model_DbTable_Usuario();
            $this->view->datos=$table->mostrarUsuarios();
        } else 
        {
            $this->_redirect('Index/index');
        }
    }

    public function crearusuarioAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            $formusuario=new Usuarios_Form_Usuarios();
            $this->view->agrega=$formusuario;
            if($this->getRequest()->isPost())
            {
                $formData=  $this->getRequest()->getPost();
                if($formusuario->isValid($formData))
                {
                    $nombreusuario=$formusuario->getValue('nombre_usuario');
                    $contrasena=$formusuario->getValue('contrasena');
                    $identificacion=$formusuario->getValue('identificacion');
                    $nombre=$formusuario->getValue('nombre_real');
                    $apellido=$formusuario->getValue('apellido_real');
                    $cargo=$formusuario->getValue('cargo');
                    $perfil=$formusuario->getValue('perfil');
                    $estado=$formusuario->getValue('estado');
                    
                    $crearBd=new Usuarios_Model_DbTable_Usuario();
                    $crearBd->crearUsuario($nombreusuario, $contrasena, $identificacion, $nombre, $apellido, $cargo, $perfil, $estado);

                    $this->_helper->redirector('index');
                }
                else
                {
                    $formusuario->populate($formData);
                }
            }
        }else 
        {
            $this->_redirect('Index/index');
        }
    }


}


