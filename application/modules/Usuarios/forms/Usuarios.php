<?php

class Usuarios_Form_Usuarios extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setName('usuarios');
        
        $usuario=new Zend_Form_Element_Text('nombre_usuario');
        $usuario->setLabel('Usuario: ')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        $modulo=new Zend_Form_Element_Hidden('cod_modulo');
        $modulo->setValue('2');
        
        $contrasena=new Zend_Form_Element_Password('contrasena');
        $contrasena->setLabel('Contraseña: ')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        $perfil=new Zend_Form_Element_Select('perfil');
        $perfil->setLabel('Perfil: ')
                ->setRequired(true)
                ->addMultiOption('','Seleccione...')
                ->addMultiOption('Administrador','Administrador')
                ->addMultiOption('Secretaria','Secretaria');
        $estado=new Zend_Form_Element_Select('estado');
        $estado->setLabel('Estado: ')
                ->setRequired(true)
                ->addMultiOption('','Seleccione...')
                ->addMultiOption('Activo','Activo')
                ->addMultiOption('Inactivo','Inactivo');
        
        $submit=new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Insertar Usuario');
        
        $this->addElements(array($usuario,$modulo,$contrasena,$perfil,$estado,$submit));
    }


}

