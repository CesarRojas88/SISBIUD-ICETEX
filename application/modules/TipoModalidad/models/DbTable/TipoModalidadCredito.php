<?php

class TipoModalidad_Model_DbTable_TipoModalidadCredito extends Zend_Db_Table_Abstract
{

    protected $_name = 'tipo_modalidad_credito';
    
    function listarTipo()
    {
       return $this->fetchAll();
       
    }
    function crearTipoModalidad($nombre,$descripcion)
    {
        $data=array('nombre_tipo_modalidad'=>$nombre,'descripcion_tipo_modalidad'=>$descripcion);
        $this->insert($data);
    }
    
    function editaTipoModalidad($id,$nombre,$descripcion)
    {
        $data=array('cod_tipo_modalidad_credito'=>$id,'nombre_tipo_modalidad'=>$nombre,'descripcion_tipo_modalidad'=>$descripcion);
        $this->update($data, 'cod_tipo_modalidad_credito = '.(int)$id);
    }
    public function get($id)
    {
        $id = (int) $id;
        //$this->fetchRow devuelve fila donde id = $id
        $row = $this->fetchRow('cod_tipo_modalidad_credito = ' . $id);
        if (!$row)
        {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }
    function eliminarTipoModalidad($id)
    {
        $this->delete('cod_tipo_modalidad_credito = '.(int)$id);
    }
}

