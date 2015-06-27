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
        
        } else 
        {
            $this->_redirect('Index/index');
        }
    }

    public function addmodalidadAction()
    {   if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            $formadd=new Modalidad_Form_Modalidad();
            $this->view->add=$formadd;
            //$formadd->submit->setLabel('Insertar Modalidad');
            if($this->getRequest()->isPost())
            {
                $formData=  $this->getRequest()->getPost();
                if($formadd->isValid($formData))
                {
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
        }else 
        {
            $this->_redirect('Index/index');
        }
        
        
    }

    public function actualizarmodalidadAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            $this->view->title="Actualizar Modalidad - ";
            $this->view->headTitle($this->view->title);

            $formEditar=new Modalidad_Form_Modalidad();
            //$formEditar->submit->setLabel('Editar Modalidad');
            $this->view->form=$formEditar;
            if($this->getRequest()->isPost())
            {
                $formDatos=  $this->getRequest()->getPost();
                if($formEditar->isValid($formDatos))
                {
                    $id=$formEditar->getValue('cod_modalidad_credito');
                    $nombre=$formEditar->getValue('nombre_modalidad_credito');
                    $descripcion=$formEditar->getValue('descripcion_modalidad');
                    $formActuali=new Modalidad_Model_DbTable_ModalidadDeCredito();
                    $formActuali->modificarModalidad($id, $nombre, $descripcion);
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
                    $formActuali=new Modalidad_Model_DbTable_ModalidadDeCredito();
                    //var_dump($modalidadporId->get('3'));
                    $modalidad=$formActuali->get($id);
                    $formEditar->populate($modalidad);
                }
            }
        }else 
        {
            $this->_redirect('Index/index');
        }
        
    }
    public function eliminarmodalidadAction()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) 
        {
            $id=  $this->_getParam('id',0);
            $borrar=new Modalidad_Model_DbTable_ModalidadDeCredito();
            $borrar->eliminarModalidad($id);
            $this->_helper->redirector('index');
        }else 
        {
            $this->_redirect('Index/index');
        }
        
    }

}





