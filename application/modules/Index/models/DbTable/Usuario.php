<?php

class Index_Model_DbTable_Usuario extends Zend_Db_Table_Abstract
{

    protected $_name = 'usuario';
    public function setLogueo ($usuario)
    {
      $db = Index_Model_DbTable_Usuario::getDefaultAdapter();//Zend_Db_Table::getDefaultAdapter();
      return $db->fetchRow($db
              ->select()
              ->from('usuario')
              ->where('nombre_usuario = ?', $usuario));
    }

}

