<?php
class Usuarios_model extends CI_Model{
  public function grabar($usuario){
    $this->db->insert("usuarios",$usuario);
  }
  
  public function buscarPorNombreYContraSenha($nombre, $contraSenha) {
  	
    $this->db->where("nombre", $nombre);
    $this->db->where("contrasenha", $contraSenha);
    $usuario = $this->db->get("usuarios")->row_array();
    return $usuario;
  }

  
  public function buscarUsuario($id) {
        $this->db->where("id", $id);
        return $this->db->get("usuarios")->row_array();
  }
  
}
