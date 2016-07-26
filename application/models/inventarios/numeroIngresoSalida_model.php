<?php
class NumeroIngresoSalida_model extends CI_Model{
  
  
  public function grabar($numeroSalida,$nombreDeposito,$prefijoTabla){
  	  $nombreTabla=$prefijoTabla.$nombreDeposito;
	  $this->db->update($nombreTabla, 
		  array("numero" => $numeroSalida+1)   // ... equivalente a SET campo= algo 
	  );
  }
  
  
  public function getNumero($nombreDeposito,$prefijoTabla){
		// ... lee el número de ingreso/salida  
		// ... de la tabla [noingalmacen/noingbodega/nosalalmacen/nosalbodega] ...
		
		$nombreTabla=$prefijoTabla.$nombreDeposito;
		$numero1 ="";
		$query = $this->db->get($nombreTabla);
		foreach($query->result() as $r){
			$numero1 .= $r->numero;
		}
		
		return $numero1;
	}	
  
  

}
