<?php

class Usuarios_Form_Usuarios extends Zend_Form
{

    public function init()
    {
        $this->setName('usuarios');
        
        
        $usuario=new Zend_Form_Element_Text('nombre_usuario');
        $usuario->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('required', 'required')
                ->setAttrib('class', 'form-control');
        
        $contrasena=new Zend_Form_Element_Password('contrasena');
        $contrasena->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('required', 'required')
                ->setAttrib('class', 'form-control');
        
        $identificacion=new Zend_Form_Element_Text('identificacion');
        $identificacion->setRequired(true)
                ->addFilter('StripTags')
                ->setAttrib('required', 'required')
                ->setAttrib('class', 'form-control');
        
        $nombre=new Zend_Form_Element_Text('nombre_real');
        $nombre->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttrib('required', 'required')
                ->setAttrib('class', 'form-control');
        
        $apellido=new Zend_Form_Element_Text('apellido_real');
        $apellido->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttrib('required', 'required')
                ->setAttrib('class', 'form-control');
        
        $cargo=new Zend_Form_Element_Text('cargo');
        $cargo->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttrib('required', 'required')
                ->setAttrib('class', 'form-control');
        
        $perfil=new Zend_Form_Element_Select('perfil');
        $perfil->setRequired(true)
                ->addMultiOption('','Seleccione...')
                ->addMultiOption('Director','Director')
                ->addMultiOption('Administrador','Administrador')
                ->setAttrib('required', 'required')
                ->setAttrib('class', 'form-control');
        
        $estado=new Zend_Form_Element_Select('estado');
        $estado ->setRequired(true)
                ->addMultiOption('','Seleccione...')
                ->addMultiOption('Activo','Activo')
                ->addMultiOption('Inactivo','Inactivo')
                ->setAttrib('required', 'required')
                ->setAttrib('class', 'form-control');
        
        $submit=new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Insertar')
                ->setAttrib('class', 'btn btn-primary');
        
        $this->addElements(array($usuario,$contrasena,$identificacion,$nombre,$apellido,$cargo,$perfil,$estado,$submit));
        $this->setElementDecorators(array('ViewHelper',"Errors")) ;
    }
}