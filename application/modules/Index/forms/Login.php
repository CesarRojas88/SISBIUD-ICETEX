<?php

class Index_Form_Login extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setName('login');
        $this->setMethod('post');
        
        
        $usuario= new Zend_Form_Element_Text('usuario');
        $usuario//->setLabel('Usuario: ')
                ->addFilter('StringTrim')// Quita los espacios izqu o derecha
                //->addFilter('StringToLower')//Convierte el texto minuscula
                //->addValidator('Alpha')//advierte valores solo alfabeticos
                ->setRequired(true)
                ->setAttrib('placeholder', 'Usuario')
                ->setAttrib('class', 'form-control');

        $contrasenia = new Zend_Form_Element_Password('contrasenia');
        $contrasenia//->setLabel('Contraseña:')
                ->addFilter('StringTrim')
                //->addValidator('Alnum')//Adverte que texto tiene espacios
                ->setRequired(true)
                ->setAttrib('placeholder', 'Contraseña')
                ->setAttrib('class', 'form-control');
        
        $submit=new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn btn-lg btn-primary btn-block')
                ->setLabel('Iniciar sesion');
        // We want to display a 'failed authentication' message if necessary;
        // we'll do that with the form 'description', so we need to add that
        // decorator.
        
        $this->addElements(array($usuario,$contrasenia,$submit));
        $this->setAction(Zend_Controller_Front::getInstance()->getBaseUrl().'/default/index/login');
        $this->setElementDecorators(array('ViewHelper',"Errors")) ;
    }


}

