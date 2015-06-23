<?php

class Estado_Form_Estado extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setName('estado');
        $tipo = new Zend_Form_Element_Text('tipo');
        $descripcion = new Zend_Form_Element_Text('descripcion');
        $submit = new Zend_Form_Element_Submit('insertar');
        $submit->setLabel('Insertar')
               ->setAttrib('class', 'btn btn-primary');
        $tipo->setAttrib('required', 'required')
             ->setRequired(true)
             ->setAttrib('class', 'form-control')
             ->addValidator('notEmpty');
        $descripcion->setAttrib('required', 'required')
                    ->addValidator('notEmpty')
                    ->setAttrib('class', 'form-control');
        $this->addElements(array($tipo,$descripcion,$submit));
        $this->setElementDecorators(array('ViewHelper',"Errors"));
    }


}

