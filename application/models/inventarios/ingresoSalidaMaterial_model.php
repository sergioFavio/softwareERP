<?php
class IngresoSalidaMaterial_model extends CI_Model{
	
	public function grabar($material,$nombreDeposito,$prefijoTabla){
		$nombreTabla=$prefijoTabla.$nombreDeposito;
    	$this->db->insert($nombreTabla,$material);
    }
	
	public function getTodos($nombreDeposito,$prefijoTabla){
		$nombreTabla=$prefijoTabla.$nombreDeposito;
		return $this->db->get($nombreTabla)->result_array();
    }
	
}


