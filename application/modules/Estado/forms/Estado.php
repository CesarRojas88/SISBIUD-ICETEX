<?php

class Estado_Form_Estado extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setName('estado');
        $id = new Zend_Form_Element_Hidden('id_estado_credito');
        $id->addFilter('Int');
        $nombre = new Zend_Form_Element_Text('nombre_estado_credito');
        $nombre->setAttrib('required', 'required')
             ->setRequired(true)
             ->setAttrib('class', 'form-control')
             ->addValidator('notEmpty');
        $descripcion = new Zend_Form_Element_Textarea('descripcion_estado_credito');
        $descripcion->setAttrib('required', 'required')
                    ->addValidator('notEmpty')
                    ->setAttrib('cols', 50)
                    ->setAttrib('rows', 6)
                    ->setAttrib('class', 'form-control')
                    ->addFilter('StripTags')
                    ->addFilter('StringTrim');
        $submit = new Zend_Form_Element_Submit('insertar');
        $submit->setLabel('Insertar')
               ->setAttrib('class', 'btn btn-primary');
       
        
        $listaEstado = new Estado_Model_DbTable_EstadoDeCredito();
        $listaEstados = $listaEstado->Estados();
        foreach ($listaEstados as $lE) 
        {
            $lista[$lE->id_estado_credito] = '';
        }
        $this->setName('drop');
        $checkbox = new Zend_Form_Element_MultiCheckbox('check');
        $submit2 = new Zend_Form_Element_Submit('eliminar');
        $submit2->setLabel('Eliminar')
               ->setAttrib('class', 'btn btn-danger');
        $checkbox->addMultiOptions($lista);
        //$this->addElements(array($tipo,$descripcion,$submit,$submit2,$checkbox));
        $this->addElements(array($id,$nombre,$descripcion,$submit,$submit2,$checkbox));
        $this->setElementDecorators(array('ViewHelper',"Errors"));
    }


}

