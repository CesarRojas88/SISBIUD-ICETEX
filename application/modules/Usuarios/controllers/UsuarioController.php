<?php

class Usuarios_UsuarioController extends Zend_Controller_Action
{
    private $auth;
    private $authAdapter;
    public function init()
    {
        /* Initialize action controller here */
        $this->view->baseUrl = $this->_request->getBaseUrl();
        $this->initView();
    }

    public function indexAction()
    {
        // action body
        if (Zend_Auth::getInstance()->hasIdentity()) {
            $table= new Usuarios_Model_DbTable_Usuario();
            $this->view->datos=$table->mostrarUsuarios();
        } else {
            $this->_redirect('Index/index');
        }
    }
}
