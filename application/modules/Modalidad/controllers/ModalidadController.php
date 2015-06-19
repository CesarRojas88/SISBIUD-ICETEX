<?php

class Modalidad_ModalidadController extends Zend_Controller_Action
{

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
            $tablamodalidad=new Modalidad_Model_DbTable_ModalidadDeCredito();
            $this->view->mostrarmodalidad=$tablamodalidad->mostrarModalidades();
            $formadd=new Modalidad_Form_Modalidad();
           
            $this->view->add=$formadd;
                   
        } else 
        {
            $this->_redirect('Index/index');
        }
    }

    public function addmodalidadAction()
    {
        
    }


}



