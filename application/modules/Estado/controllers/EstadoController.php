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
            $listaEstado = new Estado_Model_DbTable_EstadoDeCredito();
            $this->view->listaEstado = $listaEstado->Estados();
            $formulario = new Estado_Form_Estado();
            $this->view->anadir=$formulario;
            if ($this->getRequest()->isPost()) {
                $campos = $this->getRequest()->getPost();
                if ($formulario->isValid($campos)) {
                    $tipo = $formulario->getValue ('tipo');
                    $descripcion = $formulario->getValue('descripcion');
                    $insertar = new Estado_Model_DbTable_EstadoDeCredito();
                    $insertar->insertarEstado($tipo, $descripcion);
                    $this->_helper->redirector('index');
                }
            }
        } else 
        {
            $this->_redirect('Index/index');
        }
    }


}

