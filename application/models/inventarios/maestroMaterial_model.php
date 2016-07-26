<?php
class MaestroMaterial_model extends CI_Model{
  public function grabar($insumo,$nombreDeposito){
    $this->db->insert($nombreDeposito,$insumo);
  }
  
  
  function editar($id,$nombreDeposito){
    $this->db->where('codInsumo',$id['codInsumo']);
    return $this->db->update($nombreDeposito,$id);
  }
  
  
  function eliminar($id,$nombreDeposito){
    $this->db->where('codInsumo',$id);
    return $this->db->delete($nombreDeposito);
  }
 
 
  public function getTodos($nombreDeposito){
      return $this->db->get($nombreDeposito)->result_array();
  }
  
  
  function buscar($id,$nombreDeposito,$porpagina,$segmento){
	$this->db->like('nombreInsumo', $id);
    $query= $this->db->get($nombreDeposito,$porpagina,$segmento);
	if( $query->num_rows > 0 )
      return $query->result();
    else
      return FALSE;
  } 
  

  function get_materiales($nombreDeposito,$porpagina,$segmento){
    $query = $this->db->get($nombreDeposito,$porpagina,$segmento);
    if( $query->num_rows > 0 )
      return $query->result();
    else
      return FALSE;
  }
  
  function get_total_registros($nombreDeposito){
    return $this->db->count_all($nombreDeposito);
  }
  
  function getTotalRegistrosBuscar($id,$nombreDeposito){
	$sql ="SELECT * FROM $nombreDeposito WHERE nombreInsumo LIKE '%$id%' ";	
	$ingresos = $this->db->query($sql);	 
	$contador= $ingresos->num_rows; //...contador de registros que satisfacen la consulta ..
    return $contador;
  }
  	
  function actualizarPrecio($nombreDeposito,$clave,$precioMaterial){
  
    $this->db->where("codInsumo", $clave);
    $material = $this->db->get($nombreDeposito)->row_array(); 
	$precioUnidad = $material['precioUnidad'];	
	
	if($precioMaterial>$precioUnidad){		
		$sql2="UPDATE $nombreDeposito SET precioUnidad='$precioMaterial' WHERE codInsumo='$clave'";
		return $this->db->query($sql2);
	}
  }
  
  public function aumentarExistencia($insumo,$nombreDeposito){
   	   
   	   $this->db->update($nombreDeposito, 
	   		array("existencia" => floatval($insumo['existencia'])+ floatval($insumo["cantidad"]) ),   // ... equivalente a SET campo= algo
			array("codInsumo" => $insumo["idMaterial"])		 //... equivalente a WHERE id= otraTabla.id
	   );
	  
  }
  
  public function disminuirExistencia($insumo,$nombreDeposito){
   	   
   	   $this->db->update($nombreDeposito, 
	   		array("existencia" => floatval($insumo['existencia'])- floatval($insumo["cantidad"]) ),   // ... equivalente a SET campo= algo
			array("codInsumo" => $insumo["idMaterial"])		 //... equivalente a WHERE id= otraTabla.id
	   );
	  
  }
  
}
