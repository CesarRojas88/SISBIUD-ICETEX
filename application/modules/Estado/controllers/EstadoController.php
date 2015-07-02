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
            $listaEstado=new Estado_Model_DbTable_EstadoDeCredito();
            $this->view->listaEstado=$listaEstado->Estados();
            $formCrear=new Estado_Form_Estado();
            $this->view->crear=$formCrear;
        } else 
        {
            $this->_redirect('Index/index');
        }
    }

    public function crearestadoAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            $formCrear=new Estado_Form_Estado();
            $this->view->crear=$formCrear;
            if($this->getRequest()->isPost())
            {
                $formData=  $this->getRequest()->getPost();
                //___________________________________________
          /****/if(isset($formData['insertar']))
          /****/{
                
                    if($formCrear->isValid($formData))
                    {
                        $nombre=$formCrear->getValue('nombre_estado_credito');
                        $descripcion=$formCrear->getValue('descripcion_estado_credito');

                        $consulta=new Estado_Model_DbTable_EstadoDeCredito();
                        $consulta->insertarEstado($nombre, $descripcion);

                        $this->_helper->redirector('index');
                    }else
                    {
                        $formCrear->populate($formData);
                    }
          /****/}
          /****/else if (isset($formData['eliminar']) && isset($formData['check']))
          /****/{
          /****/    $checkbox = $formData['check'];
          /****/    $eliminar = new Estado_Model_DbTable_EstadoDeCredito();
          /****/    $eliminar->eliminarEstado($checkbox);
          /****/    $this->_helper->redirector('index');
          /****/}
                
            }
        }else 
        {
            $this->_redirect('Index/index');
        }
    }

    public function actualizarestadoAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            $this->view->title="Actualizar Estado de crédito - ";
            $this->view->headTitle($this->view->title);

            $formEditar=new Estado_Form_Estado();
            $this->view->form=$formEditar;
            if($this->getRequest()->isPost())
            {
                $formDatos=  $this->getRequest()->getPost();
                if($formEditar->isValid($formDatos))
                {
                    $id=$formEditar->getValue('id_estado_credito');
                    $nombre=$formEditar->getValue('nombre_estado_credito');
                    $descripcion=$formEditar->getValue('descripcion_estado_credito');
                    $formActuali=new Estado_Model_DbTable_EstadoDeCredito();
                    $formActuali->modificarEstado($id, $nombre, $descripcion);
                    $this->_helper->redirector('index');
                }
                else
                {
                    $formEditar->populate($formDatos);
                }
            }
            else
            {
                $id=$this->_getParam('id',0);
                //var_dump($this->_getParam('id',0));
                if($id>0)
                {
                    $formActuali=new Estado_Model_DbTable_EstadoDeCredito();
                    //var_dump($modalidadporId->get('3'));
                    $aaa=$formActuali->get($id);
                    $formEditar->populate($aaa);
                }
            }
        }else 
        {
            $this->_redirect('Index/index');
        }
    }

    public function eliminarestadoAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            $id=  $this->_getParam('id',0);
            $borrar=new Estado_Model_DbTable_EstadoDeCredito();
            $borrar->borraEstado($id);
            $this->_helper->redirector('index');
        }else 
        {
            $this->_redirect('Index/index');
        }
    }


}







