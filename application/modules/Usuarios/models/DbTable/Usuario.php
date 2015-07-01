<?php

class Usuarios_Model_DbTable_Usuario extends Zend_Db_Table_Abstract
{

    protected $_name = 'usuario';
    
    public function get($id)
    {
        $id = (String) $id;
        //$this->fetchRow devuelve fila donde id = $id
        $row = $this->fetchRow('nombre_usuario = "'.$id.'"' );
        if (!$row)
       {
         throw new Exception("Could not find row $id");
       }
       return $row->toArray();
    }
    
    public function mostrarUsuarios()
    {
        return $this->fetchAll();
    }
    
    function crearUsuario($nombreUsuario,$contrasena,$id,$nombre,$apellido,$cargo,$perfil,$estado)
    {
        $data=array('nombre_usuario'=>$nombreUsuario,'contrasena'=>$contrasena,'identificacion'=>$id,'nombre_real'=>$nombre,'apellido_real'=>$apellido,'cargo'=>$cargo,'perfil'=>$perfil,'estado'=>$estado);
        $this->insert($data);
    }
    
    function modificarUsuario($usuario,$contrasena,$iden,$nombre,$apellido,$cargo,$perfil,$estado)
    {
        $data=array('nombre_usuario'=>$usuario,'contrasena'=>$contrasena,'identificacion'=>$iden,'nombre_real'=>$nombre,'apellido_real'=>$apellido,'cargo'=>$cargo,'perfil'=>$perfil,'estado'=>$estado);
        $where["nombre_usuario = ?"]=$usuario;
        var_dump($where);
        $this->update($data, $where);
//update($data, "nombre_usuario = '".$usuario."'");
    }
    
    /*function eliminarUsuario($usuario)
    {
        $this->delete('nombre_usuario = "'.$usuario.'"');
    }*/
    

}

