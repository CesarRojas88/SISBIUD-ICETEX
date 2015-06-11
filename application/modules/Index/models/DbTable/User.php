<?php

class Index_Model_DbTable_User extends Zend_Db_Table_Abstract
{

    protected $_name = 'user';
    public function setLogueo ($usuario)
    {
      $db = Index_Model_DbTable_User::getDefaultAdapter();//Zend_Db_Table::getDefaultAdapter();
      return $db->fetchRow($db
              ->select()
              ->from('user')
              ->where('nombre_usuario = ?', $usuario));
    }

}

