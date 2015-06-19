<?php

class Modalidad_Model_DbTable_ModalidadDeCredito extends Zend_Db_Table_Abstract
{

    protected $_name = 'modalidad_de_credito';
    function mostrarModalidades()
    {
        return $this->fetchAll();
    }

}

