<?php

class Modalidad_Model_DbTable_ModalidadDeCredito extends Zend_Db_Table_Abstract
{

    protected $_name = 'modalidad_de_credito';
    function mostrarModalidades()
    {
        return $this->fetchAll();
    }
    function insertarModalidad($nombre,$descripcion)
    {
        $data=array('nombre_modalidad_credito'=>$nombre,'descripcion_modalidad'=>$descripcion);
        $this->insert($data);
    }
    function mostrarporId($id)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = Zend_Db_Table::getDefaultAdapter()->select();
        $select->from('modalidad_de_credito')
                ->where('cod_modalidad_credito=?',$id);
        return Zend_Db_Table::getDefaultAdapter()->fetchRow($select);
        
        return $select;
        //$consulta="SELECT* FROM modalidad_de_credito WHERE cod_modalidad_credito= ?".$id;
    }
}

