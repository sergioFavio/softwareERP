<?php
class Productos_model extends CI_Model{
  public function grabar($insumo,$nombreDeposito){
    $this->db->insert($nombreDeposito,$insumo);
  }
  
  
  function editar($id,$nombreDeposito){
    $this->db->where('idProd',$id['idProd']);
    return $this->db->update($nombreDeposito,$id);
 }
  
  
 function eliminar($id,$nombreDeposito){
    $this->db->where('idProd',$id);
    return $this->db->delete($nombreDeposito);
 }
 
 
  function buscar($id,$nombreDeposito){
	$this->db->like('nombreProd', $id);
    return $this->db->get($nombreDeposito)->result_array();
 }  
  
  
  public function getTodos($nombreDeposito){
      return $this->db->get($nombreDeposito)->result_array();
  }
  
  
  public function aumentarExistencia($insumo,$nombreDeposito){
   	   
   	   $this->db->update($nombreDeposito, 
	   		array("existencia" => floatval($insumo['existencia'])+ floatval($insumo["cantidad"]) ),   // ... equivalente a SET campo= algo
			array("idProd" => $insumo["idProducto"])		 //... equivalente a WHERE id= otraTabla.id
	   );
	  
  }
  
  
  
   public function disminuirExistencia($insumo,$nombreDeposito){
   	   
   	   $this->db->update($nombreDeposito, 
	   		array("existencia" => floatval($insumo['existencia'])- floatval($insumo["cantidad"]) ),   // ... equivalente a SET campo= algo
			array("idProd" => $insumo["idProducto"])		 //... equivalente a WHERE id= otraTabla.id
	   );
	  
  }
  
}
