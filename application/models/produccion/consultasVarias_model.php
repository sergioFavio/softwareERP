<?php
class ConsultasVarias_model extends CI_Model{
	
	public function productoDiferencia($nombreDeposito){
		$nombreTabla='prod'.$nombreDeposito.'plantilla';
    	return $this->db->query("SELECT DISTINCT idProd,nombreProd,medidas,unidad FROM productosfabrica WHERE idProd NOT IN (SELECT DISTINCT codPro FROM ".$nombreTabla.")")->result_array();
    }
	
	public function productoReunion($nombreDeposito){
		$nombreTabla='prod'.$nombreDeposito.'plantilla';
    	return $this->db->query('SELECT DISTINCT idProd, nombreProd, medidas,unidad FROM productosfabrica P INNER JOIN '.$nombreTabla.' F ON P.idProd=F.codPro')->result_array();
    }
  
}
