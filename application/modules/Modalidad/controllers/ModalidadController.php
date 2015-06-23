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
        if($this->getRequest()->isPost())
        {
            $formData=  $this->getRequest()->getPost();
            if($formadd->isValid($formData))
            {
                //$idMod=$formadd->getValue('cod_modalidad_credito');
                $nombreMod=$formadd->getValue('nombre_modalidad_credito');
                $descripcionMod=$formadd->getValue('descripcion_modalidad');

                $bdMod=new Modalidad_Model_DbTable_ModalidadDeCredito();
                $bdMod->insertarModalidad($nombreMod, $descripcionMod);

                $this->_helper->redirector('index');
            }
            else
            {
                $formadd->populate($formData);
            }
            
        }
        
        } else 
        {
            $this->_redirect('Index/index');
        }
    }

    public function addmodalidadAction()
    {
        
        
        
    }


}



