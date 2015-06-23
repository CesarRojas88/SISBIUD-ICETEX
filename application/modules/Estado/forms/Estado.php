<?php

class Estado_Form_Estado extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setName('Estado');
        $tipo = new Zend_Form_Element_Text('tipo');
        $descripcion = new Zend_Form_Element_Text('descripcion');
        $submit = new Zend_Form_Element_Submit('insertar');
        $submit->setLabel('Insertar');
        $tipo->setAttrib('required', 'required')
             ->setRequired(true)
             ->setValidators('noEmpty');
        $this->addElements(array($tipo,$descripcion,$submit));
        $this->setElementDecorators(array('ViewHelper',"Errors")) ;
    }


}

