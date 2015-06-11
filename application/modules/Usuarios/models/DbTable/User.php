<?php

class Usuarios_Model_DbTable_User extends Zend_Db_Table_Abstract
{

    protected $_name = 'user';

    public function mostrarUsuarios()
    {
        return $this->fetchAll();
    }
}

