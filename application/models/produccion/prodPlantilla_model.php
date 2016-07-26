<?php
class ProdPlantilla_model extends CI_Model{
  public function grabar($insumo,$nombreDeposito){
  	$nombreTabla='prod'.$nombreDeposito.'plantilla';
    $this->db->insert($nombreTabla,$insumo);
  }
  
  
  function editar($id,$nombreDeposito){
  	$nombreTabla='prod'.$nombreDeposito.'plantilla';
    $this->db->where('codInsumo',$id['codInsumo']);
    return $this->db->update($nombreTabla,$id);
 }
  
  
 function eliminar($id,$nombreDeposito){
 	$nombreTabla='prod'.$nombreDeposito.'plantilla';
    $this->db->where('codPro',$id);
    return $this->db->delete($nombreTabla);
 }
 
 
  function buscar($id,$nombreDeposito){
  	$nombreTabla='prod'.$nombreDeposito.'plantilla';
	$this->db->like('codPro', $id);
    return $this->db->get($nombreTabla)->result_array();
 }  
  
  
  public function getTodos($nombreDeposito){
  	$nombreTabla='prod'.$nombreDeposito.'plantilla';
    return $this->db->get($nombreTabla)->result_array();
  }
  
  
}
