<?php
class IngresoSalidaCabecera_model extends CI_Model{
	
	public function grabar($cabecera,$nombreDeposito,$prefijoTabla){
		$nombreTabla=$prefijoTabla.$nombreDeposito.'cabecera';
    	$this->db->insert($nombreTabla,$cabecera);
  }
}


