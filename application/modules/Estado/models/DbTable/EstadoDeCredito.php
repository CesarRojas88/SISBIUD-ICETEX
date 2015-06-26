<?php

class Estado_Model_DbTable_EstadoDeCredito extends Zend_Db_Table_Abstract
{

    protected $_name = 'estado_de_credito';
    function Estados()
    {
        return $this->fetchAll();
    }
    function insertarEstado($tipo,$descripcion)
    {
        $campo=array('nombre_estado_credito'=>$tipo,'descripcion_estado_credito'=>$descripcion);
        $this->insert($campo);
    }
    function eliminarEstado($campos)
    {
        foreach ($campos as $campo)
        {
            $where = $this->getAdapter()->quoteInto('id_estado_credito = ?', $campo);
            $this->delete($where);
        }
    }
}

