<?php

class TipoModalidad_TipoModalidadController extends Zend_Controller_Action
{

    public function init()
    {
        $this->view->baseUrl = $this->_request->getBaseUrl();
        $this->initView();
    }

    public function indexAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            $listaTipo= new TipoModalidad_Model_DbTable_TipoModalidadCredito();
            $this->view->listar=$listaTipo->listarTipo();
        
        } else 
        {
            $this->_redirect('Index/index');
        }
    }

    public function creartipomodalidadAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            $formcrear=new TipoModalidad_Form_TipoModalidad();
            $this->view->crear=$formcrear;
            if($this->getRequest()->isPost())
            {
                $formData=  $this->getRequest()->getPost();
                if($formcrear->isValid($formData))
                {
                    $nombre=$formcrear->getValue('nombre_tipo_modalidad');
                    $descripcion=$formcrear->getValue('descripcion_tipo_modalidad');

                    $consulta=new TipoModalidad_Model_DbTable_TipoModalidadCredito();
                    $consulta->crearTipoModalidad($nombre, $descripcion);

                    $this->_helper->redirector('index');
                }
                else
                {
                    $formcrear->populate($formData);
                }
            }
        }else 
        {
            $this->_redirect('Index/index');
        }
    }

    public function editartipomodalidadAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            $this->view->title="Actualizar Tipo Modalidad - ";
            $this->view->headTitle($this->view->title);

            $formEditar=new TipoModalidad_Form_TipoModalidad();
            $this->view->form=$formEditar;
            if($this->getRequest()->isPost())
            {
                $formDatos=  $this->getRequest()->getPost();
                if($formEditar->isValid($formDatos))
                {
                    $id=$formEditar->getValue('cod_tipo_modalidad_credito');
                    $nombre=$formEditar->getValue('nombre_tipo_modalidad');
                    $descripcion=$formEditar->getValue('descripcion_tipo_modalidad');
                    $formActualiza=new TipoModalidad_Model_DbTable_TipoModalidadCredito();
                    $formActualiza->editaTipoModalidad($id, $nombre, $descripcion);
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
                    $formActualiza=new TipoModalidad_Model_DbTable_TipoModalidadCredito();
                    //var_dump($modalidadporId->get('3'));
                    $consulta=$formActualiza->get($id);
                    $formEditar->populate($consulta);
                }
            }
        }else 
        {
            $this->_redirect('Index/index');
        }
    }

    public function eliminartipomodalidadAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            $id=  $this->_getParam('id',0);
            $borrar=new TipoModalidad_Model_DbTable_TipoModalidadCredito();
            $borrar->eliminarTipoModalidad($id);
            $this->_helper->redirector('index');
        }else 
        {
            $this->_redirect('Index/index');
        }
    }


}







