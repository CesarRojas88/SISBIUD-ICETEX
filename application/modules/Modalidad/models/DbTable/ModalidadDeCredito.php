<?php

class Modalidad_Model_DbTable_ModalidadDeCredito extends Zend_Db_Table_Abstract
{

    protected $_name = 'modalidad_de_credito';
    public function get($id)
    {
        $id = (int) $id;
        //$this->fetchRow devuelve fila donde id = $id
        $row = $this->fetchRow('cod_modalidad_credito = ' . $id);
        if (!$row)
        {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
        
    }
    function mostrarModalidades()
    {
        return $this->fetchAll();
    }
    function insertarModalidad($nombre,$descripcion)
    {
        $data=array('nombre_modalidad_credito'=>$nombre,'descripcion_modalidad'=>$descripcion);
        $this->insert($data);
    }
    function modificarModalidad($id,$nombre,$descripcion)
    {
        $data=array('cod_modalidad_credito'=>$id,'nombre_modalidad_credito'=>$nombre,'descripcion_modalidad'=>$descripcion);
        $this->update($data, 'cod_modalidad_credito = '.(int)$id);
    }
    function eliminarModalidad($id)
    {
        $this->delete('cod_modalidad_credito = '.(int)$id);
    }
}

