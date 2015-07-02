<?php

class Estado_Model_DbTable_EstadoDeCredito extends Zend_Db_Table_Abstract
{

    protected $_name = 'estado_de_credito';
    public function get($id)
    {
        $id = (int) $id;
        //$this->fetchRow devuelve fila donde id = $id
        $row = $this->fetchRow('id_estado_credito = ' . $id);
        if (!$row)
        {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
        
    }
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
    function modificarEstado($id,$nombre,$descripcion)
    {
        $data=array('id_estado_credito'=>$id,'nombre_estado_credito'=>$nombre,'descripcion_estado_credito'=>$descripcion);
        $this->update($data, 'id_estado_credito = '.(int)$id);
    }
    function borraEstado($id)
    {
        $this->delete('id_estado_credito = '.(int)$id);
    }
}

