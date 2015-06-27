<?php

class Usuarios_Model_DbTable_Usuario extends Zend_Db_Table_Abstract
{

    protected $_name = 'usuario';
    public function mostrarUsuarios()
    {
        return $this->fetchAll();
    }
    function crearUsuario($nombreUsuario,$contrasena,$id,$nombre,$apellido,$cargo,$perfil,$estado)
    {
        $data=array('nombre_usuario'=>$nombreUsuario,'contrasena'=>$contrasena,'identificacion'=>$id,'nombre_real'=>$nombre,'apellido_real'=>$apellido,'cargo'=>$cargo,'perfil'=>$perfil,'estado'=>$estado);
        $this->insert($data);
    }

}

