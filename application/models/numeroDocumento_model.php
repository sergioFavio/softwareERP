<?php
class NumeroDocumento_model extends CI_Model{
  
  
  public function grabar($numeroSalida,$nombreTabla){
	  $this->db->update($nombreTabla, 
		  array("numero" => $numeroSalida+1)   // ... equivalente a SET campo= algo 
	  );
  }
  
  public function actualizar($numeroSalida,$nombreTabla){
	  $this->db->update($nombreTabla, 
		  array("numero" => $numeroSalida)   // ... equivalente a SET campo= algo 
	  );
  }
  
  public function getNumero($nombreTabla){
		// ... lee el número de ocumento
		$numero1 ="";
		$query = $this->db->get($nombreTabla);
		foreach($query->result() as $r){
			$numero1 .= $r->numero;
		}
		return $numero1;
   }
  
   public function getComprobante($nombreTabla){
		// ... lee el número de ocumento
		$numero1 ="";
		$query = $this->db->get($nombreTabla);
		foreach($query->result() as $r){
			$numero1 .= $r->gestion;
		}
		return $numero1;
   }
   
   
   
   
}
