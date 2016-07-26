<?php
class UsuarioPermisos_model extends CI_Model{
  public function grabar($usuario){
    $this->db->insert("usuariopermisos",$usuario);
  }
  
  
  public function buscarUsuarioPermisos($id) {
        $this->db->where("codUsuario", $id);
        return $this->db->get("usuariopermisos")->row_array();
  }
  
}
