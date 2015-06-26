<?php

class Estado_Form_Drop extends Zend_Form
{
    //protected $listaEstados = '';
    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $listaEstado = new Estado_Model_DbTable_EstadoDeCredito();
        $listaEstados = $listaEstado->Estados();
        foreach ($listaEstados as $lE) 
        {
            $lista[$lE->id_estado_credito] = '';
        }
        $this->setName('drop');
        $checkbox = new Zend_Form_Element_MultiCheckbox('check');
        $submit = new Zend_Form_Element_Submit('insertar');
        $submit->setLabel('Eliminar')
               ->setAttrib('class', 'btn btn-primary');
        $checkbox->addMultiOptions($lista);
        $this->addElements(array($checkbox,$submit));
        $this->setElementDecorators(array('ViewHelper',"Errors"));
    }
}

