<?php

class TipoModalidad_Form_TipoModalidad extends Zend_Form
{

    public function init()
    {
        $this->setName('tipomodalidad');
        //campo hidden para guardar id de album
        $id = new Zend_Form_Element_Hidden('cod_tipo_modalidad_credito');
        $id->addFilter('Int');
        
        $nombre=new Zend_Form_Element_Text('nombre_tipo_modalidad');
        $nombre ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty')
                ->setAttrib('required', 'required')
                ->setAttrib('class', 'form-control');
        $descripcion=new Zend_Form_Element_Textarea('descripcion_tipo_modalidad');
        $descripcion->setAttrib('cols', 50)
                ->setAttrib('rows', 6)
                ->setAttrib('class', 'form-control')
                ->addFilter('StripTags')
                ->addFilter('StringTrim');
        $submit=new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn btn-primary')
                ->setLabel('Insertar');
                
        
        $this->addElements(array($id,$nombre,$descripcion,$submit));
        $this->setElementDecorators(array('ViewHelper',"Errors")) ;
    }


}

