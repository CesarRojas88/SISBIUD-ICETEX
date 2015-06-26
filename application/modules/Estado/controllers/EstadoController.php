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
            //$dropFields = new Estado_Form_Drop();
            $formulario = new Estado_Form_Estado();
            $this->view->anadir = $formulario;
            //$this->view->drop = $dropFields;
            $form = $this->getRequest();
            if ($form->isPost()) {
                //$form = $form->getPost();
                //if (isset($form['Insertar'])) {
                    $campos = $this->getRequest()->getPost();
                    if(isset($campos['insertar'])) {
                        if ($formulario->isValid($campos)) {
                            $tipo = $formulario->getValue ('tipo');
                            $descripcion = $formulario->getValue('descripcion');
                            $insertar = new Estado_Model_DbTable_EstadoDeCredito();
                            $insertar->insertarEstado($tipo, $descripcion);
                            $this->_helper->redirector('index');
                        }
                    }
                    else if (isset($campos['eliminar']) && isset($campos['check']))
                    {
                            $checkbox = $campos['check'];
                            $eliminar = new Estado_Model_DbTable_EstadoDeCredito();
                            $eliminar->eliminarEstado($checkbox);
                            $this->_helper->redirector('index');
                    }
                //} else if (isset ($form['eliminar']))
                //{
                //    $this->_helper->redirector('index');        
                //}             
            }
        } else 
        {
            $this->_redirect('Index/index');
        }
    }
}

