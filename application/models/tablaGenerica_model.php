<?php
class TablaGenerica_model extends CI_Model{
  public function grabar($nombreTabla,$registro){
    $this->db->insert($nombreTabla,$registro);
  }
 
 /* 
  public function buscarPorNombreYContraSenha($nombre, $contraSenha) {
  	
    $this->db->where("nombre", $nombre);
    $this->db->where("contrasenha", $contraSenha);
    $usuario = $this->db->get("usuarios")->row_array();
    return $usuario;
  }

  */ 
  
  
  function editar($nombreTabla,$campo,$patron){
    $this->db->where($campo,$patron);
    return $this->db->update($nombreTabla,$campo);
  }
 
  
  function editarRegistro($nombreTabla,$clave,$patron,$registro){
    $this->db->where($clave,$patron);
    return $this->db->update($nombreTabla,$registro);
  }
  
  
  function eliminar($nombreTabla,$campo,$patron){
    $this->db->where($campo,$patron);
    return $this->db->delete($nombreTabla);
  }
   
  
  public function buscar($nombreTabla,$campo,$patron) {
    $this->db->where($campo, $patron);
    return $this->db->get($nombreTabla)->row_array();
  }
  
   
  function get_total_registros($nombreTabla){
    return $this->db->count_all($nombreTabla);
  }
  
  
  function get_registros($nombreTabla,$porpagina,$segmento){
    $query = $this->db->get($nombreTabla,$porpagina,$segmento);
    if( $query->num_rows > 0 )
      return $query->result();
    else
      return FALSE;
  }
  
  
  function getTotalRegistrosBuscar($nombreTabla,$campo1,$patron){
	$sql ="SELECT * FROM $nombreTabla WHERE $campo1 LIKE '%$patron%' ";	
	$ingresos = $this->db->query($sql);	 
	$contador= $ingresos->num_rows; //...contador de registros que satisfacen la consulta ..
    return $contador;
  }
  
  public function getTodos($nombreTabla){
      return $this->db->get($nombreTabla)->result_array();
  }
  
  
  function buscarPaginacion($nombreTabla,$campo1,$patron,$porpagina,$segmento){
	$this->db->like($campo1, $patron);
    $query= $this->db->get($nombreTabla,$porpagina,$segmento);
	if( $query->num_rows > 0 )
      return $query->result();
    else
      return FALSE;
  }
  
  public function aumentarSaldosContables($nombreTabla,$clave,$debeMonto,$haberMonto){
  	$sql="UPDATE $nombreTabla SET debeacumulado=debeacumulado + $debeMonto, haberacumulado=haberacumulado + $haberMonto,debemes=debemes + $debeMonto, habermes=habermes + $haberMonto WHERE cuenta=$clave";
  	return $this->db->query($sql);
  }
  
  public function disminuirSaldosContables($nombreTabla,$clave,$debeMonto,$haberMonto){
  	$sql="UPDATE $nombreTabla SET debeacumulado=debeacumulado - $debeMonto, haberacumulado=haberacumulado - $haberMonto,debemes=debemes - $debeMonto, habermes=habermes - $haberMonto WHERE cuenta=$clave";
  	return $this->db->query($sql);
  }
  
  
}
