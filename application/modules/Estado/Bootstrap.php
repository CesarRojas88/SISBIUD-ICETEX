<?php
class Estado_Bootstrap extends Zend_Application_Module_Bootstrap
{
      protected function _initView(){
            //Inicializamos la vista  
            $view=new Zend_View();
            $view->setEncoding('UTF-8');
            $view->doctype('XHTML1_STRICT');
            $view->headMeta()
                 ->appendHttpEquiv('Content-Type','text/html;charset=utf-8');
      
            //renderizamos la vista  
            $viewRenderer=
            Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
            $viewRenderer->setView($view);
              
            return$view;
        }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

