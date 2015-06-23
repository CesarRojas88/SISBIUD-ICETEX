<?php

class Estado_EstadoController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->view->baseUrl = $this->_request->getBaseUrl();
        $this->initView();
    }

    public function indexAction()
    {
        // action body
        if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            //$formulario = new Estado_Form_Estado();
            //$this->view->anadir=$formulario;
        } else 
        {
            $this->_redirect('Index/index');
        }
    }


}

