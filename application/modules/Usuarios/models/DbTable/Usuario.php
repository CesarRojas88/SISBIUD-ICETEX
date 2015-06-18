<?php

class Usuarios_Model_DbTable_Usuario extends Zend_Db_Table_Abstract
{

    protected $_name = 'usuario';
    public function mostrarUsuarios()
    {
        return $this->fetchAll();
    }

}

