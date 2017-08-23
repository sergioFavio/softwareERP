<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Materiales extends CI_Controller {
	
	public function ingresoMaterial(){
		$nombreDeposito= $_GET['nombreDeposito']; //... lee nombreDeposito que viene del menu principal(salida de  almacen/bodega ) ...		
		
		//... control de permisos de acceso ....
		
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoDeposito=$this->session->userdata('usuarioDeposito');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if( $permisoUserName!='superuser' && $permisoUserName!='developer'   &&  $permisoDeposito!=$nombreDeposito ){  //... valida permiso de userName ...

				$datos['mensaje']='Usuario NO autorizado para operar Sistema de Inventarios';
				$this->load->view('header');
				$this->load->view('mensaje',$datos );
				$this->load->view('footer');
	//			redirect('menuController/index');		
		}	//... fin control de permisos de acceso ....
		else {
			$this->load->model("inventarios/numeroIngresoSalida_model");
			$prefijoTabla='noing'; // ... prefijoTabla
	    	$ingreso = $this->numeroIngresoSalida_model->getNumero($nombreDeposito, $prefijoTabla);
			
			$this->load->model("inventarios/maestroMaterial_model");	//...carga el modelo tabla maestra[almacen/bodega]
			$insumos= $this->maestroMaterial_model->getTodos($nombreDeposito); //..una vez cargado el modelo de la tabla llama almacen/bodega..
							
			$datos['titulo']=$nombreDeposito;
			$datos['ingreso']=$ingreso;
			$datos['insumos']=$insumos;		
			$datos['nombreDeposito']=$nombreDeposito;	// ... egreso: almacen/bodega ...
	
			$this->load->view('header');
			$this->load->view('inventarios/ingreso_material',$datos);
			$this->load->view('footer');
		}	//... fin IF validar usuario...
	}	//... fin funcion ingresoMaterial ....
	
	public function salidaMaterial(){
		$nombreDeposito= $_GET['nombreDeposito']; //... lee nombreDeposito que viene del menu principal(salida de  almacen/bodega ) ...	
		
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoDeposito=$this->session->userdata('usuarioDeposito');
		$permisoProceso2=$this->session->userdata('usuarioProceso1');
		if( $permisoUserName!='superuser' && $permisoUserName!='developer'   &&  $permisoDeposito!=$nombreDeposito ){  //... valida permiso de userName ...

				$datos['mensaje']='Usuario NO autorizado para operar Sistema de Inventarios';
				$this->load->view('header');
				$this->load->view('mensaje',$datos );
				$this->load->view('footer');
	//			redirect('menuController/index');		
		}	//... fin control de permisos de acceso ....	
		else {
			$this->load->model("inventarios/numeroIngresoSalida_model");
			$prefijoTabla='nosal'; // ... prefijoTabla
	    	$salida = $this->numeroIngresoSalida_model->getNumero($nombreDeposito, $prefijoTabla);
			
			$this->load->model("inventarios/maestroMaterial_model");	//...carga el modelo tabla maestra[almacen/bodega]
			$insumos= $this->maestroMaterial_model->getTodos($nombreDeposito); //..una vez cargado el modelo de la tabla llama almacen/bodega..
							
			$datos['titulo']=$nombreDeposito;
			$datos['salida']=$salida;
			$datos['insumos']=$insumos;		
			$datos['nombreDeposito']=$nombreDeposito;	// ... salida: almacen/bodega ...
	
			$this->load->view('header');
			$this->load->view('inventarios/salida_material',$datos);
			$this->load->view('footer');
		}	//... fin validar usuario ...
	}	//... fin salidamaterial ...

		
	public function traspasoMaterial(){
		$nombreDeposito= $_GET['nombreDeposito']; //... lee nombreDeposito que viene del menu principal(salida de  almacen/bodega ) ...	
		
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoDeposito=$this->session->userdata('usuarioDeposito');
		$permisoProceso2=$this->session->userdata('usuarioProceso1');
		if( $permisoUserName!='superuser' && $permisoUserName!='developer'   &&  $permisoDeposito!=$nombreDeposito ){  //... valida permiso de userName ...

				$datos['mensaje']='Usuario NO autorizado para operar Sistema de Inventarios';
				$this->load->view('header');
				$this->load->view('mensaje',$datos );
				$this->load->view('footer');
	//			redirect('menuController/index');		
		}	//... fin control de permisos de acceso ....	
		else {
			$this->load->model("inventarios/numeroIngresoSalida_model");
			$prefijoTabla='nosal'; // ... prefijoTabla
	    	$salida = $this->numeroIngresoSalida_model->getNumero($nombreDeposito, $prefijoTabla);
			
			$prefijoTabla='noing'; // ... prefijoTabla
			$ingreso = $this->numeroIngresoSalida_model->getNumero('almacen', $prefijoTabla);		
					
			$this->load->model("inventarios/maestroMaterial_model");	//...carga el modelo tabla maestra[almacen/bodega]
			$insumos= $this->maestroMaterial_model->getTodos($nombreDeposito); //..una vez cargado el modelo de la tabla llama almacen/bodega..
							
			$datos['ingreso']=$ingreso;	
			$datos['titulo']='Traspaso a almacén ';
			$datos['salida']=$salida;
			$datos['insumos']=$insumos;		
			$datos['nombreDeposito']=$nombreDeposito;	// ... salida: almacen/bodega ...
	
			$this->load->view('header');
			$this->load->view('inventarios/traspaso_material',$datos);
			$this->load->view('footer');
		}	//... fin validar usuario ...
	}	//... fin traspasoMaterial ...
	
	
	public function buscarIngreso(){
		$nombreDeposito=str_replace(" ","",$_GET['nombreDeposito']); //... lee nombreDeposito que viene del menu principal(salida de  almacen/bodega ) ...	
		
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
	
		if($permisoUserName!='superuser' && $permisoUserName!='developer' ){  //... valida permiso de userName ...
				redirect('menuController/index');
		}
		//... fin control de permisos de acceso ....	

		$this->load->model("tablaGenerica_model");	//...carga el modelo tabla 
//		$cabeceraIngresos= $this->tablaGenerica_model->getTodos('ingresoalmacencabecera'); //..una vez cargado el modelo de la tabla llama ingresoalmacencabecera..
				
		$cabeceraIngresos= $this->tablaGenerica_model->getTodos('ingreso'.$nombreDeposito.'cabecera'); //..una vez cargado el modelo de la tabla llama ingresoalmacencabecera..
				
						
		$datos['titulo']='Modificar ingreso '.$nombreDeposito;
		$datos['cabeceraIngresos']=$cabeceraIngresos;	
		$datos['nombreDeposito']=$nombreDeposito;	// ... salida: almacen/bodega ...

		$this->load->view('header');
		$this->load->view('inventarios/buscarIngresoMaterial',$datos);
		$this->load->view('footer');
	}


	public function buscarSalida(){
		$nombreDeposito=str_replace(" ","",$_GET['nombreDeposito']); //... lee nombreDeposito que viene del menu principal(salida de  almacen/bodega ) ...	
		
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
	
		if($permisoUserName!='superuser' && $permisoUserName!='developer' ){  //... valida permiso de userName ...
				redirect('menuController/index');
		}
		//... fin control de permisos de acceso ....	

		$this->load->model("tablaGenerica_model");	//...carga el modelo tabla 
//		$cabeceraSalidas= $this->tablaGenerica_model->getTodos('salidaalmacencabecera'); //..una vez cargado el modelo de la tabla llama salidaalmacencabecera..
						
		$cabeceraSalidas= $this->tablaGenerica_model->getTodos('salida'.$nombreDeposito.'cabecera'); //..una vez cargado el modelo de la tabla llama salidaalmacencabecera..
								
						
		$datos['titulo']='Modificar salida '.$nombreDeposito;
		$datos['cabeceraSalidas']=$cabeceraSalidas;	
		$datos['nombreDeposito']=$nombreDeposito;	// ... salida: almacen/bodega ...

		$this->load->view('header');
		$this->load->view('inventarios/buscarSalidaMaterial',$datos);
		$this->load->view('footer');
	}
	
	
	public function modificarIngreso(){
		$nIngreso= $_POST['inputNumero']; //... lee numero ingreso de almacen ...	
		$fecha= $_POST['inputFecha']; //... lee fecha ...	
		$proveedor= $_POST['inputProveedor']; //... lee proveedor ...
		$nFactura= $_POST['inputFactura']; //... lee numero Factura ...
	
		$nombreDeposito=$_POST['nombreDeposito']; //... lee nombreDeposito que viene de buscarIngresoMaerial ...	
				
		$sql="SELECT idMaterial,nombreInsumo,existencia,cantidad,unidad,precioUnidad,precioCompra FROM ing".$nombreDeposito.",".$nombreDeposito." WHERE numIng='$nIngreso' AND idMaterial=codInsumo";
		$regIngresos=mysql_query($sql);        	
		$nRegistrosIngreso=mysql_num_rows($regIngresos);  	//... numero registros salida que satisfacen la consulta ...
		
		$this->load->model("inventarios/maestroMaterial_model");	//...carga el modelo tabla maestra[almacen/bodega]
		$insumos= $this->maestroMaterial_model->getTodos($nombreDeposito); //..una vez cargado el modelo de la tabla llama almacen/bodega..
						
		$datos['titulo']='Modificar Ingreso '.$nombreDeposito;

		$datos['nIngreso']=$nIngreso; 		//... dato cabecera Ingreso almacen ..
		$datos['fecha']=$fecha;				//... dato cabecera Ingreso almacen ..
		$datos['proveedor']=$proveedor;		//... dato cabecera Ingreso almacen ..
		$datos['nFactura']=$nFactura;		//... dato cabecera Ingreso almacen ..
		$datos['regIngresos']=$regIngresos;
		$datos['nRegistrosIngreso']=$nRegistrosIngreso;

		$datos['insumos']=$insumos;		
		$datos['nombreDeposito']=$nombreDeposito;	// ... salida: almacen/bodega ...

		$this->load->view('header');
		$this->load->view('inventarios/modificarIngresoMaterial',$datos);
		$this->load->view('footer');
	}		//... fin funcion: modificarIngresoAlmacen ...
	
	
	public function modificarSalida(){
		$nSalida= $_POST['inputNumero']; //... lee numerosalida de almacen ...	
		$fecha= $_POST['inputFecha']; //... lee fecha ...	
		$glosa= $_POST['inputGlosa']; //... lee glosa(trabajador) ...
		$nOrden= $_POST['inputOrden']; //... lee numeroOrden ...
	
		$nombreDeposito=$_POST['nombreDeposito']; //... lee nombreDeposito que viene de buscarSalidaMaterial ...	
				
		$sql="SELECT idMaterial, nombreInsumo, existencia, cantidad, unidad FROM sal".$nombreDeposito.",".$nombreDeposito." WHERE numSal='$nSalida' AND idMaterial=codInsumo";
		$regSalidas=mysql_query($sql);
        	
		$nRegistrosSalida=mysql_num_rows($regSalidas);  	//... numero registros salida que satisfacen la consulta ...
		
		$this->load->model("inventarios/maestroMaterial_model");	//...carga el modelo tabla maestra[almacen/bodega]
		$insumos= $this->maestroMaterial_model->getTodos($nombreDeposito); //..una vez cargado el modelo de la tabla llama almacen/bodega..
						
		$datos['titulo']='Modificar Salida '.$nombreDeposito;

		$datos['nSalida']=$nSalida; 		//... dato cabecera salida almacen ..
		$datos['fecha']=$fecha;				//... dato cabecera salida almacen ..
		$datos['glosa']=$glosa;				//... dato cabecera salida almacen ..
		$datos['nOrden']=$nOrden;			//... dato cabecera salida almacen ..
		$datos['regSalidas']=$regSalidas;
		$datos['nRegistrosSalida']=$nRegistrosSalida;

		$datos['insumos']=$insumos;		
		$datos['nombreDeposito']=$nombreDeposito;	// ... salida: almacen/bodega ...

		$this->load->view('header');
		$this->load->view('inventarios/modificarSalidaMaterial',$datos);
		$this->load->view('footer');
	}		//... fin funcion: modificarSalidaAlmacen ...
	
	
	public function grabarIngreso(){
		$nombreDeposito=$_POST['nombreDeposito']; //... formulario ingresoMaterial [almacen/bodega] ...
				
		$numeroFilasValidas=$_POST['numeroFilas']; //... formulario ingreso[almacen/bodega] ...
		
		// ... actualizar numero de ingreso de almacén/bodega ...
		$numeroSalida=$_POST['inputNumero'];	
			
		$this-> load -> model("inventarios/numeroIngresoSalida_model");	//... modelo numeroSalida[almacen/bodega]_model 
		$prefijoTabla='noing'; // ... prefijoTabla
		$this-> numeroIngresoSalida_model -> grabar($numeroSalida,$nombreDeposito, $prefijoTabla);	
		// fin actualizar numero de ingreso de almacén/bodega ...
			
		// ... inserta registro en tabla salida[almacen/bodega]cabecera ...	
		$fecha=$_POST['inputFecha'];
		
		$cabecera = array(
	    	"numero"=>$_POST['inputNumero'],
	    	"fecha"=>$_POST['inputFecha'],  
	    	"numFactura"=>$_POST['inputFactura'],
	    	"proveedor"=>$_POST['inputProveedor']
		);
		
		
	    $this-> load -> model("inventarios/ingresoSalidaCabecera_model");	//... carga modelo salidaCabecera [almacen/bodega]
	    $this-> ingresoSalidaCabecera_model -> grabar($cabecera,$nombreDeposito,'ingreso');
		// ...fin de insertar registro en tabla salida[almacen/bodega]cabecera ...	
		
        for($i=0; $i<$numeroFilasValidas; $i++){
       
			$codigoSinEspacio=str_replace(" ","",$_POST['idMat_'.$i]);  		//...quita espacio en blanco ..
			$precioMaterial=str_replace(",","",$_POST['compraMat_'.$i])*0.87; 	//... precioMaterial menos 13% iva ...
			
        	if($_POST['cantMat_'.$i] != "0" || $_POST['cantMat_'.$i] != "0.00"){
          	    //... si cantidad mayor que cero  graba registro ... 
          	    //... agrega registro tabla salalmacen ...      
	            $material = array(
	            	"numIng"=>$_POST['inputNumero'],
				    "idMaterial"=>$codigoSinEspacio,
				    "cantidad"=>str_replace(",","",$_POST['cantMat_'.$i]),
					"precioCompra"=>$precioMaterial
				);
				
				
				//... actualiza registro tabla almacen/bodega
				 $insumo = array(
				    "idMaterial"=>$codigoSinEspacio,
				    "existencia"=>$_POST['existMat_'.$i],
				    "cantidad"=>str_replace(",","",$_POST['cantMat_'.$i])
				);
				
				
				// ... inserta registro tabla transacciones[ingalmacen/ingbodega]
				$this-> load -> model("inventarios/ingresoSalidaMaterial_model");		//carga modelo ingresoSalidaMaterial[ingalmacen/ingbodega]_model
	    		$this-> ingresoSalidaMaterial_model -> grabar($material,$nombreDeposito,'ing');
					
					
				// ... actualiza registro tabla maestra[almacen/bodega]	
				$this-> load -> model("inventarios/maestroMaterial_model");
	    		$this-> maestroMaterial_model -> aumentarExistencia($insumo,$nombreDeposito);
				$this-> maestroMaterial_model -> actualizarPrecio($nombreDeposito,$codigoSinEspacio,$precioMaterial);	
	
				// ... fin de inserción  registro tabla transacciones y actualizacion tablas maestras almacen/bodega
				
			}	// ... fin IF
			
		}  // ... fin  FOR  

   		redirect("materiales/ingresoMaterial?nombreDeposito=$nombreDeposito");
	}	//... fin grabarIngreso
	
	
	public function grabarModificarIngreso(){
		$nombreDeposito=$_POST['nombreDeposito']; //... formulario ingresoMaterial [almacen/bodega] ...
				
		$numeroFilasValidas=$_POST['numeroFilas']; //... formulario ingreso[almacen/bodega] ...
		
		// ... actualizar numero de ingreso de almacén/bodega ...
		$numeroIngreso=$_POST['inputNumero'];	
			
		// ... inserta registro en tabla salida[almacen/bodega]cabecera ...	
		$fecha=$_POST['inputFecha'];
		
		$proveedor=$_POST['inputProveedor'];
		
		$factura=$_POST['inputFactura'];
		
		$sql="UPDATE ingreso".$nombreDeposito."cabecera SET numFactura='$factura', proveedor='$proveedor' WHERE numero='$numeroIngreso' ";
		$this->db->query($sql);	
		
		$sql="SELECT idMaterial, nombreInsumo, existencia, cantidad, unidad FROM ing".$nombreDeposito.",".$nombreDeposito." WHERE numIng='$numeroIngreso' AND idMaterial=codInsumo";
		$regIngresos=$this->db->query($sql);
		
		// ... borra registros en la tabla:  ingalmacen ...	
		$this-> load -> model("tablaGenerica_model");	//... modelo tablaGenerica_model
		$this-> tablaGenerica_model -> eliminar('ing'.$nombreDeposito,'numIng', $numeroIngreso);	
		// fin borrar registros de ingalmacen ...
		
		//... decrementar existencias en tabla: almacen ...
		foreach ($regIngresos->result() as $regIngreso) {
			$codigoSinEspacio=str_replace(" ","",$regIngreso->idMaterial); //...quita espacio en blanco ..
			
			// ... actualiza registro tabla maestra[almacen/bodega]	
			$this-> load -> model("inventarios/maestroMaterial_model");
			$this-> maestroMaterial_model -> disminuirExistenciaM($nombreDeposito,$codigoSinEspacio,$regIngreso->cantidad );	
	    	// fin decrementar existencias en tabla: almacen ...
		}	 
			
        for($i=0; $i<$numeroFilasValidas; $i++){
       
			$codigoSinEspacio=str_replace(" ","",$_POST['idMat_'.$i]);  //...quita espacio en blanco ..
			$precioMaterial=$_POST['compraMat_'.$i]; 					//... precioMaterial ...
			
//        	if($_POST['cantMat_'.$i] != "0" || $_POST['cantMat_'.$i] != "0.00"){
          	    //... si cantidad mayor que cero  graba registro ... 
          	    //... agrega registro tabla salalmacen ...      
	            $material = array(
	            	"numIng"=>$_POST['inputNumero'],
				    "idMaterial"=>$codigoSinEspacio,
				    "cantidad"=>str_replace(",","",$_POST['cantMat_'.$i]),
				    "precioCompra"=>str_replace(",","",$_POST['compraMat_'.$i])
				);
							
				// ... inserta registro tabla transacciones[ingalmacen/ingbodega]
				$this-> load -> model("inventarios/ingresoSalidaMaterial_model");		//carga modelo ingresoSalidaMaterial[ingalmacen/ingbodega]_model
	    		$this-> ingresoSalidaMaterial_model -> grabar($material,$nombreDeposito,'ing');
					
				// ... actualiza registro tabla maestra[almacen/bodega]	
				$this-> load -> model("inventarios/maestroMaterial_model");//	    		$this-> maestroMaterial_model -> aumentarExistencia($insumo,$nombreDeposito);
				$this-> maestroMaterial_model -> aumentarExistenciaM($nombreDeposito,$codigoSinEspacio,str_replace(",","",$_POST['cantMat_'.$i]) );	
				$this-> maestroMaterial_model -> actualizarPrecio($nombreDeposito,$codigoSinEspacio,$precioMaterial);	
	
				// ... fin de inserción  registro tabla transacciones y actualizacion tablas maestras almacen/bodega
				
//			}	// ... fin IF
			
		}  // ... fin  FOR  

   		redirect("menuController/index");
	}	//... fin grabarModificarIngreso
	
	
	public function grabarSalida(){
		$nombreDeposito=$_POST['nombreDeposito']; //... formulario salidaMaterial [almacen/bodega] ...
				
		$numeroFilasValidas=$_POST['numeroFilas']; //... formulario salida[almacen/bodega] ...
		
		// ... actualizar numero de salida de almacén/bodega ...
		$numeroSalida=$_POST['inputNumero'];		
		$this-> load -> model("inventarios/numeroIngresoSalida_model");	//... modelo numeroSalida[almacen/bodega]_model 
		$prefijoTabla='nosal'; // ... prefijoTabla
		$this-> numeroIngresoSalida_model -> grabar($numeroSalida,$nombreDeposito, $prefijoTabla);	
		
		// fin actualizar numero de salida de almacén/bodega ...
		
		
		// ... inserta registro en tabla salida[almacen/bodega]cabecera ...	
		$fecha=$_POST['inputFecha'];
		
		$cabecera = array(
	    	"numero"=>$_POST['inputNumero'],
	    	"fecha"=>$_POST['inputFecha'], 
	    	"numOrden"=>$_POST['inputOrden'],
	    	"glosa"=>$_POST['inputGlosa']
		);
		
		
	    $this-> load -> model("inventarios/ingresoSalidaCabecera_model");	//... carga modelo salidaCabecera [almacen/bodega]
	    $this-> ingresoSalidaCabecera_model -> grabar($cabecera,$nombreDeposito,'salida');
		// ...fin de insertar registro en tabla salida[almacen/bodega]cabecera ...	
		
		
        for($i=0; $i<$numeroFilasValidas; $i++){
       
			$codigoSinEspacio=str_replace(" ","",$_POST['idMat_'.$i]); //...quita espacio en blanco ..
			
        	if($_POST['cantMat_'.$i] != "0" || $_POST['cantMat_'.$i] != "0.00"){
          	    //... si cantidad mayor que cero  graba registro ... 
          	    //... agrega registro tabla salalmacen ...      
	            $material = array(
	            	"numSal"=>$_POST['inputNumero'],
				    "idMaterial"=>$codigoSinEspacio,
				    "cantidad"=>$_POST['cantMat_'.$i]
				);
				
				
				//... actualiza registro tabla almacen/bodega
				 $insumo = array(
				 	"idMaterial"=>$codigoSinEspacio,
				    "existencia"=>str_replace(",","",$_POST['existMat_'.$i]),
				    "cantidad"=>str_replace(",","",$_POST['cantMat_'.$i])
				);
				
				
				// ... inserta registro tabla transacciones[salalmacen/salbodega]
				$this-> load -> model("inventarios/ingresoSalidaMaterial_model");		//carga modelo salidaMaterial[salalmacen/salbodega]_model
	    		$this-> ingresoSalidaMaterial_model -> grabar($material,$nombreDeposito,'sal');
					
					
				// ... actualiza registro tabla maestra[almacen/bodega]	
				$this-> load -> model("inventarios/maestroMaterial_model");
	    		$this-> maestroMaterial_model -> disminuirExistencia($insumo,$nombreDeposito);
								
				// ... fin de inserción  registro tabla transacciones y actualizacion tablas maestras almacen/bodega
				
			}	// ... fin IF
			
		}  // ... fin  FOR  
		
		redirect("materiales/salidaMaterial?nombreDeposito=$nombreDeposito");
		
	}	//... fin grabarSalida
		
		
	public function grabarTraspaso(){
		$nombreDeposito=$_POST['nombreDeposito']; 	//... formulario salidaMaterial [almacen/bodega] ...
				
		$numeroFilasValidas=$_POST['numeroFilas']; 	//... formulario salida[almacen/bodega] ...
		
		$numeroIngresoAlmacen=$_POST['ingreso']; 	//... formulario salida[almacen/bodega] ...
		
		// ... actualizar numero de salida de almacén/bodega ...
		$numeroSalida=$_POST['inputNumero'];		
		$this-> load -> model("inventarios/numeroIngresoSalida_model");	//... modelo numeroSalida[almacen/bodega]_model 
		$prefijoTabla='nosal'; // ... prefijoTabla
		$this-> numeroIngresoSalida_model -> grabar($numeroSalida,$nombreDeposito, $prefijoTabla);	
		// fin actualizar numero de salida de almacén/bodega ...
		
		$this-> numeroIngresoSalida_model -> grabar($numeroIngresoAlmacen,'almacen', 'noing');		//..actualiza numero ingreso almacen ...
		
		// ... inserta registro en tabla salida[almacen/bodega]cabecera ...	
		$fecha=$_POST['inputFecha'];
		
		$cabecera = array(
	    	"numero"=>$_POST['inputNumero'],
	    	"fecha"=>$_POST['inputFecha'], 
	    	"numOrden"=>$_POST['inputOrden'],
	    	"glosa"=>$_POST['inputGlosa']
		);
		
	    $this-> load -> model("inventarios/ingresoSalidaCabecera_model");	//... carga modelo salidaCabecera [almacen/bodega]
	    $this-> ingresoSalidaCabecera_model -> grabar($cabecera,$nombreDeposito,'salida');
		// ...fin de insertar registro en tabla salida[almacen/bodega]cabecera ...	
		
		$cabeceraIngreso = array(
	    	"numero"=>$numeroIngresoAlmacen,
	    	"fecha"=>$_POST['inputFecha'],  
	    	"numFactura"=>$_POST['inputNumero'],
	    	"proveedor"=>"traspaso de Bodega"
		);
		
	    $this-> ingresoSalidaCabecera_model -> grabar($cabeceraIngreso,'almacen','ingreso');
		
        for($i=0; $i<$numeroFilasValidas; $i++){
       
			$codigoSinEspacio=str_replace(" ","",$_POST['idMat_'.$i]); //...quita espacio en blanco ..
			
        	if($_POST['cantMat_'.$i] != "0" || $_POST['cantMat_'.$i] != "0.00"){
          	    //... si cantidad mayor que cero  graba registro ... 
          	    //... agrega registro tabla salalmacen ...      
	            $material = array(
	            	"numSal"=>$_POST['inputNumero'],
				    "idMaterial"=>$codigoSinEspacio,
				    "cantidad"=>$_POST['cantMat_'.$i]
				);
				
				
				//... actualiza registro tabla almacen/bodega
				 $insumo = array(
				 	"idMaterial"=>$codigoSinEspacio,
				    "existencia"=>$_POST['existMat_'.$i],
				    "cantidad"=>str_replace(",","",$_POST['cantMat_'.$i])
				);
				
				
				// ... inserta registro tabla transacciones[salalmacen/salbodega]
				$this-> load -> model("inventarios/ingresoSalidaMaterial_model");		//carga modelo salidaMaterial[salalmacen/salbodega]_model
	    		$this-> ingresoSalidaMaterial_model -> grabar($material,$nombreDeposito,'sal');
					
					
				// ... actualiza registro tabla maestra[almacen/bodega]	
				$this-> load -> model("inventarios/maestroMaterial_model");
	    		$this-> maestroMaterial_model -> disminuirExistencia($insumo,$nombreDeposito);
				
				
				
				$materialIngreso = array(
	            	"numIng"=>$numeroIngresoAlmacen,
				    "idMaterial"=>$codigoSinEspacio,
				    "cantidad"=>str_replace(",","",$_POST['cantMat_'.$i]),
					"precioCompra"=>str_replace(",","",$_POST['precioMat_'.$i])
				);
				
				$this-> load -> model("inventarios/maestroMaterial_model");
	    		$this-> maestroMaterial_model -> aumentarExistenciaM('almacen',$codigoSinEspacio,str_replace(",","",$_POST['cantMat_'.$i]));
				$this-> ingresoSalidaMaterial_model -> grabar($materialIngreso,'almacen','ing');
								
				// ... fin de inserción  registro tabla transacciones y actualizacion tablas maestras almacen/bodega
				
			}	// ... fin IF
			
		}  // ... fin  FOR  
	
		redirect("materiales/traspasoMaterial?nombreDeposito=$nombreDeposito");
	}	//... fin grabarTraspaso
	
	
	
	public function grabarModificarSalida()	{
		$nombreDeposito=$_POST['nombreDeposito']; //... formulario salidaMaterial [almacen/bodega] ...
				
		$numeroFilasValidas=$_POST['numeroFilas']; //... formulario salida[almacen/bodega] ...
		
		$numeroSalida=$_POST['inputNumero'];
		
		$fecha=$_POST['inputFecha'];
		
		$numeroOrden=$_POST['inputOrden'];
		
		$sql="UPDATE salida".$nombreDeposito."cabecera SET numOrden='$numeroOrden' WHERE numero='$numeroSalida' ";
		$this->db->query($sql);	
		
		$sql="SELECT idMaterial, nombreInsumo, existencia, cantidad, unidad FROM sal".$nombreDeposito.",".$nombreDeposito." WHERE numSal='$numeroSalida' AND idMaterial=codInsumo";
		$regSalidas=$this->db->query($sql);

		// ... borra registros en la tabla:  salidaalmacen ...	
		$this-> load -> model("tablaGenerica_model");	//... modelo tablaGenerica_model
		$this-> tablaGenerica_model -> eliminar('sal'.$nombreDeposito,'numSal', $numeroSalida);	
		// fin borrar registros de salalmacen ...
				
		//... incrementar existencias en tabla: almacen ...
		foreach ($regSalidas->result() as $regSalida) {
			$codigoSinEspacio=str_replace(" ","",$regSalida->idMaterial); //...quita espacio en blanco ..

			$regInsumo = array(
				    "idMaterial"=>$codigoSinEspacio,
				    "existencia"=>$regSalida->existencia,
				    "cantidad"=>$regSalida->cantidad
			);
			
			// ... actualiza registro tabla maestra[almacen/bodega]	
			
			$this-> load -> model("inventarios/maestroMaterial_model");
		    	
			$this-> maestroMaterial_model -> aumentarExistencia($regInsumo,$nombreDeposito );
	    		    	
	    	
	    	// fin incrementar existencias en tabla: almacen ...
	    	
	    	$materialBitacora = array(
	            	"numSal"=>$numeroSalida,
				    "idMaterial"=>$codigoSinEspacio,
				    "cantidad"=>$regSalida->cantidad
			);
			
			// ... inserta registro tabla salmacenbitacora ...
			$this-> load -> model("tablaGenerica_model");		//carga modelo tablaGenerica_model
	    	$this-> tablaGenerica_model -> grabar('s'.$nombreDeposito.'bitacora',$materialBitacora);
	    	// ... fin inserta registro tabla salmacenbitacora ...
		}	 
				
		
        for($i=0; $i<$numeroFilasValidas; $i++){
       
			$codigoSinEspacio=str_replace(" ","",$_POST['idMat_'.$i]); //...quita espacio en blanco ..
			
//        	if($_POST['cantMat_'.$i] != "0" || $_POST['cantMat_'.$i] != "0.00"){
          	    //... si cantidad mayor que cero  graba registro ... 
          	    //... agrega registro tabla salalmacen ...      
	            $material = array(
	            	"numSal"=>$_POST['inputNumero'],
				    "idMaterial"=>$codigoSinEspacio,
				    "cantidad"=>str_replace(",","",$_POST['cantMat_'.$i]) //...quita , ..
				);
				
				// ... inserta registro tabla transacciones[salalmacen/salbodega]
				$this-> load -> model("inventarios/ingresoSalidaMaterial_model");		//carga modelo salidaMaterial[salalmacen/salbodega]_model
	    		$this-> ingresoSalidaMaterial_model -> grabar($material,$nombreDeposito,'sal');
				
				//... actualiza registro tabla almacen/bodega
				 $insumo = array(
				    "idMaterial"=>$codigoSinEspacio,
				    "existencia"=>$_POST['existMat_'.$i],
				    "cantidad"=>str_replace(",","",$_POST['cantMat_'.$i]) //...quita , ..
				);
				
				// ... actualiza registro tabla maestra[almacen/bodega]	
				$this-> maestroMaterial_model -> disminuirExistenciaM($nombreDeposito,$codigoSinEspacio,str_replace(",","",$_POST['cantMat_'.$i])  );

				// ... fin de inserción  registro tabla transacciones y actualizacion tablas maestras almacen/bodega
				
//			}	// ... fin IF
			
		}  // ... fin  FOR  
	
		redirect("menuController/index");
	}	//... fin grabarModificarSalida
	
	
	
	/////////////////////////////////////////////
	//... funciones del CRUD almacen/bodega ...//
	/////////////////////////////////////////////
		
	public function crudMaterialPorCodigo(){
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoDeposito=$this->session->userdata('usuarioDeposito');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' ){  //... valida permiso de userName ...
			$datos['mensaje']='Usuario NO autorizado para operar CRUD de Inventarios';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}	//... fin control de permisos de acceso ....
		else {		//... usuario validado ...
		
			$nombreDeposito='almacen';
			$this->load->model("inventarios/maestroMaterial_model");
			
			/* URL a la que se desea agregar la paginación*/
	    	$config['base_url'] = base_url().'materiales/crudMaterial';
			
			/*Obtiene el total de registros a paginar */
	    	$config['total_rows'] = $this->maestroMaterial_model->get_total_registros($nombreDeposito);
			
			$contador= $config['total_rows'];
			
			if($contador==0){  //...cuando NO hay registros ...
				$datos['mensaje']='No hay registros grabados en la tabla '.$nombreDeposito;
				$this->load->view('header');
				$this->load->view('mensaje',$datos );
				$this->load->view('footer');
			}
			else{      //... cuando hay registros ...
			
				/*Obtiene el numero de registros a mostrar por pagina */
		    	$config['per_page'] = '13';
				
				/*Indica que segmento de la URL tiene la paginación, por default es 3*/
		    	$config['uri_segment'] = '3';
				$desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		  
				/*Se personaliza la paginación para que se adapte a bootstrap*/
			    $config['cur_tag_open'] = '<li class="active"><a href="#">';
			    $config['cur_tag_close'] = '</a></li>';
			    $config['num_tag_open'] = '<li>';
			    $config['num_tag_close'] = '</li>';
			    $config['last_link'] = FALSE;
			    $config['first_link'] = FALSE;
			    $config['next_link'] = '&raquo;';
			    $config['next_tag_open'] = '<li>';
			    $config['next_tag_close'] = '</li>';
			    $config['prev_link'] = '&laquo;';
			    $config['prev_tag_open'] = '<li>';
			    $config['prev_tag_close'] = '</li>';
				
				/* Se inicializa la paginacion*/
		    	$this->pagination->initialize($config);
		
				/* Se obtienen los registros a mostrar*/ 
		   		$datos['listaMaterial'] = $this->maestroMaterial_model->get_materiales($nombreDeposito,$config['per_page'], $desde); 
		
				$datos['consultaMaterial'] ='';
				
				$datos['campoBusqueda'] ='codInsumo';
				
		 		/*Se llama a la vista para mostrar la información*/
				$this->load->view('header');
				$this->load->view('inventarios/mostrarMaterialesCrud', $datos);
				$this->load->view('footer');
				
			}  // fin else cuando hay registros 
		}	//... fin IF validar usuarios...
		
	} //... fin crudMaterialPorCodigo
	
	
	public function crudMaterial(){
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoDeposito=$this->session->userdata('usuarioDeposito');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' ){  //... valida permiso de userName ...
			$datos['mensaje']='Usuario NO autorizado para operar CRUD de Inventarios';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}	//... fin control de permisos de acceso ....
		else {		//... usuario validado ...
		
			$nombreDeposito='almacen';
			$this->load->model("inventarios/maestroMaterial_model");
			
			/* URL a la que se desea agregar la paginación*/
	    	$config['base_url'] = base_url().'materiales/crudMaterial';
			
			/*Obtiene el total de registros a paginar */
	    	$config['total_rows'] = $this->maestroMaterial_model->get_total_registros($nombreDeposito);
			
			$contador= $config['total_rows'];
			
			if($contador==0){  //...cuando NO hay registros ...
				$datos['mensaje']='No hay registros grabados en la tabla '.$nombreDeposito;
				$this->load->view('header');
				$this->load->view('mensaje',$datos );
				$this->load->view('footer');
			}
			else{      //... cuando hay registros ...
			
				/*Obtiene el numero de registros a mostrar por pagina */
		    	$config['per_page'] = '13';
				
				/*Indica que segmento de la URL tiene la paginación, por default es 3*/
		    	$config['uri_segment'] = '3';
				$desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		  
				/*Se personaliza la paginación para que se adapte a bootstrap*/
			    $config['cur_tag_open'] = '<li class="active"><a href="#">';
			    $config['cur_tag_close'] = '</a></li>';
			    $config['num_tag_open'] = '<li>';
			    $config['num_tag_close'] = '</li>';
			    $config['last_link'] = FALSE;
			    $config['first_link'] = FALSE;
			    $config['next_link'] = '&raquo;';
			    $config['next_tag_open'] = '<li>';
			    $config['next_tag_close'] = '</li>';
			    $config['prev_link'] = '&laquo;';
			    $config['prev_tag_open'] = '<li>';
			    $config['prev_tag_close'] = '</li>';
				
				/* Se inicializa la paginacion*/
		    	$this->pagination->initialize($config);
		
				/* Se obtienen los registros a mostrar*/ 
		   		$datos['listaMaterial'] = $this->maestroMaterial_model->get_materiales($nombreDeposito,$config['per_page'], $desde); 
		
				$datos['consultaMaterial'] ='';
				
				$datos['campoBusqueda'] ='nombreInsumo';
				
		 		/*Se llama a la vista para mostrar la información*/
				$this->load->view('header');
				$this->load->view('inventarios/mostrarMaterialesCrud', $datos);
				$this->load->view('footer');
				
			}  // fin else cuando hay registros 
		}	//... fin IF validar usuarios...
		
	} //... fin crudMaterial
	
	
	public function grabarNuevoMaterialCrud(){
	//... graba un nuevoMaterial en tablas almacen y bodega ...
		$insumo=array(
       		"codInsumo"=>$this->input->post("inputCodigo"),
        	"nombreInsumo"=>$this->input->post("inputMaterial"),
        	"existencia"=>$this->input->post("inputExistencia"),
        	"unidad"=>$this->input->post("inputUnidad"),
        	"precioUnidad"=>$this->input->post("inputPrecioUnidad"),
        	"tipoInsumo"=>$this->input->post("inputTipoMaterial"),
        	"stockMinimo"=>$this->input->post("inputEstockMinimo")
       	);

		$this-> load -> model("inventarios/maestroMaterial_model");
   		$this-> maestroMaterial_model -> grabar($insumo,'almacen');
		$this-> maestroMaterial_model -> grabar($insumo,'bodega');
		//$this-> session -> set_flashdata("success","insumo grabado con éxito");
   		redirect('materiales/crudMaterial');  //...vuelve a la vista: mostrarMaterialesCrud ...
	}
	
	public function actualizarMaterialCrud(){
		//... edita registro de las tablas [almacen/bodega] ...
			
		$insumo=array(
       		"codInsumo"=>$this->input->post("inputCodigoM"),
        	"nombreInsumo"=>$this->input->post("inputMaterialM"),
        	"existencia"=>$this->input->post("inputExistenciaM"),
        	"unidad"=>$this->input->post("inputUnidadM"),
        	"precioUnidad"=>$this->input->post("inputPrecioUnidadM"),
        	"tipoInsumo"=>$this->input->post("inputTipoMaterialM"),
        	"stockMinimo"=>$this->input->post("inputEstockMinimoM")
       	);
				
		$this-> load -> model("inventarios/maestroMaterial_model");
   		$this-> maestroMaterial_model -> editar($insumo,'almacen');
		$this-> maestroMaterial_model -> editar($insumo,'bodega');
  
		$data=base_url("materiales/crudMaterial");
		echo $data;
	}
	
	
	public function eliminarMaterialCrud(){
		//... elimina registro de las tablas [almacen/bodega] ...
		$codigoMaterial=$_POST['codigo'];
		$this-> load -> model("inventarios/maestroMaterial_model");
   		$this-> maestroMaterial_model -> eliminar($codigoMaterial,'almacen');
		$this-> maestroMaterial_model -> eliminar($codigoMaterial,'bodega');
		$data=base_url("materiales/crudMaterial");
		echo $data;
	}
	
	
		public function buscarMaterialCrudPorCodigo(){
		//... buscar los registros que coincidan con el patron busqueda ingresado ...
		$campoBusqueda="codInsumo";

		if(isset($_POST['inputBuscarPatron'])){
			$consultaMaterial=$_POST['inputBuscarPatron'];
			
			// Escribimos una primera línea en consultaCrud.txt
			$fp = fopen("pdfsArchivos/consultaCrud.txt", "w");
			fputs($fp, $consultaMaterial);
			fclose($fp); 

		}else{
			// Leemos la primera línea de consultaCrud.txt
			// fichero.txt es un archivo de texto normal creado con notepad, por ejemplo.
			$fp = fopen("pdfsArchivos/consultaCrud.txt", "r");
			$consultaMaterial = fgets($fp);
			fclose($fp); 
		}	
				
		$this-> load -> model("tablaGenerica_model");
		
		$totalRegistrosEncontrados=0;		
		$totalRegistrosEncontrados=$this->tablaGenerica_model->getTotalRegistrosBuscar('almacen',$campoBusqueda,$consultaMaterial);
		//echo"total registros econtrados".$totalRegistrosEncontrados;
		if($totalRegistrosEncontrados==0){
		//	$datos['mensaje']='No hay registros grabados en la tabla '.$nombreTabla;
		//	$this->load->view('mensaje',$datos );
		//	redirect('produccion/crudVerCotizaciones');
			redirect('menuController/index');
		}else{
			/* URL a la que se desea agregar la paginación*/
	    	$config['base_url'] = base_url().'materiales/buscarMaterialCrudPorCodigo';
			
			/*Obtiene el total de registros a paginar */
			$config['total_rows'] = $this->tablaGenerica_model->getTotalRegistrosBuscar('almacen',$campoBusqueda,$consultaMaterial);
	
		
			/*Obtiene el numero de registros a mostrar por pagina */
	    	$config['per_page'] = '13';
			
			/*Indica que segmento de la URL tiene la paginación, por default es 3*/
	    	$config['uri_segment'] = '3';
			$desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	  
			/*Se personaliza la paginación para que se adapte a bootstrap*/
		    $config['cur_tag_open'] = '<li class="active"><a href="#">';
		    $config['cur_tag_close'] = '</a></li>';
		    $config['num_tag_open'] = '<li>';
		    $config['num_tag_close'] = '</li>';
		    $config['last_link'] = FALSE;
		    $config['first_link'] = FALSE;
		    $config['next_link'] = '&raquo;';
		    $config['next_tag_open'] = '<li>';
		    $config['next_tag_close'] = '</li>';
		    $config['prev_link'] = '&laquo;';
		    $config['prev_tag_open'] = '<li>';
		    $config['prev_tag_close'] = '</li>';
			
			/* Se inicializa la paginacion*/
	    	$this->pagination->initialize($config);
	
			/* Se obtienen los registros a mostrar*/ 		
			$datos['listaMaterial'] = $this-> tablaGenerica_model -> buscarPaginacion('almacen',$campoBusqueda,$consultaMaterial, $config['per_page'], $desde );
			
			$datos['consultaMaterial'] =$consultaMaterial;
			
			$datos['campoBusqueda'] =$campoBusqueda;
			
			/*Se llama a la vista para mostrar la información*/
			$this->load->view('header');
			$this->load->view('inventarios/mostrarMaterialesCrud', $datos);
			$this->load->view('footer');
		
		}     //... fin IF total registros encontrados ...
	}		//.. fin buscarMaterialCrudPorcodigo ..
	
	
	
	
	public function buscarMaterialCrud(){
		//... buscar los registros que coincidan con el patron busqueda ingresado ...
		$campoBusqueda="nombreInsumo";

		if(isset($_POST['inputBuscarPatron'])){
			$consultaMaterial=$_POST['inputBuscarPatron'];
			
			// Escribimos una primera línea en consultaCrud.txt
			$fp = fopen("pdfsArchivos/consultaCrud.txt", "w");
			fputs($fp, $consultaMaterial);
			fclose($fp); 

		}else{
			// Leemos la primera línea de consultaCrud.txt
			// fichero.txt es un archivo de texto normal creado con notepad, por ejemplo.
			$fp = fopen("pdfsArchivos/consultaCrud.txt", "r");
			$consultaMaterial = fgets($fp);
			fclose($fp); 
		}	
				
		$this-> load -> model("tablaGenerica_model");
		
		$totalRegistrosEncontrados=0;		
		$totalRegistrosEncontrados=$this->tablaGenerica_model->getTotalRegistrosBuscar('almacen',$campoBusqueda,$consultaMaterial);
		//echo"total registros econtrados".$totalRegistrosEncontrados;
		if($totalRegistrosEncontrados==0){
		//	$datos['mensaje']='No hay registros grabados en la tabla '.$nombreTabla;
		//	$this->load->view('mensaje',$datos );
		//	redirect('produccion/crudVerCotizaciones');
			redirect('menuController/index');
		}else{
			/* URL a la que se desea agregar la paginación*/
	    	$config['base_url'] = base_url().'materiales/buscarMaterialCrud';
			
			/*Obtiene el total de registros a paginar */
			$config['total_rows'] = $this->tablaGenerica_model->getTotalRegistrosBuscar('almacen',$campoBusqueda,$consultaMaterial);
	
		
			/*Obtiene el numero de registros a mostrar por pagina */
	    	$config['per_page'] = '13';
			
			/*Indica que segmento de la URL tiene la paginación, por default es 3*/
	    	$config['uri_segment'] = '3';
			$desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	  
			/*Se personaliza la paginación para que se adapte a bootstrap*/
		    $config['cur_tag_open'] = '<li class="active"><a href="#">';
		    $config['cur_tag_close'] = '</a></li>';
		    $config['num_tag_open'] = '<li>';
		    $config['num_tag_close'] = '</li>';
		    $config['last_link'] = FALSE;
		    $config['first_link'] = FALSE;
		    $config['next_link'] = '&raquo;';
		    $config['next_tag_open'] = '<li>';
		    $config['next_tag_close'] = '</li>';
		    $config['prev_link'] = '&laquo;';
		    $config['prev_tag_open'] = '<li>';
		    $config['prev_tag_close'] = '</li>';
			
			/* Se inicializa la paginacion*/
	    	$this->pagination->initialize($config);
	
			/* Se obtienen los registros a mostrar*/ 		
			$datos['listaMaterial'] = $this-> tablaGenerica_model -> buscarPaginacion('almacen',$campoBusqueda,$consultaMaterial, $config['per_page'], $desde );
			
			$datos['consultaMaterial'] =$consultaMaterial;
			
			$datos['campoBusqueda'] =$campoBusqueda;
			
			/*Se llama a la vista para mostrar la información*/
			$this->load->view('header');
			$this->load->view('inventarios/mostrarMaterialesCrud', $datos);
			$this->load->view('footer');
		
		}     //... fin IF total registros encontrados ...
	}		//.. fin buscarMaterialCrud ..
	
		
	function validarCodigoMaterialCrud(){
		//... recupera la variable de codigoMaterial ...
		$nombreTabla=$this->input->post("nombreTabla");
		$campo=$this->input->post("campo");
		$patron=$this->input->post("patron");
		
		$sql="SELECT * FROM $nombreTabla WHERE $campo='$patron' ";	 
		$contador= $this->db->query($sql)->num_rows; //...contador de registros que satisfacen la consulta ..	
		
		if($contador==1){
			echo json_encode(true);
		}else{
			echo json_encode(false);
		}   		
		
	}	//... fin validarCodigoMaterialCrud() ...
	
	
	//... fin de funciones CRUD ...
	////////////////////////////////
	
	
	/////////////////////////////////////
	//... inicio funciones reportesPDF
	/////////////////////////////////////

	public function generarReporteingreso(){
		//... genera reporte de salida en PDF
		
		$nombreDeposito= $_POST['nombreDeposito']; //... lee nombreDeposito que viene del menu principal(salida de  almacen/bodega ) ...
		
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoDeposito=$this->session->userdata('usuarioDeposito');
		$permisoProceso3=$this->session->userdata('usuarioProceso3');
		if($permisoUserName!='superuser' ){  //... valida permiso de userName ...
			if($permisoMenu!='inventarios' || $permisoDeposito!=$nombreDeposito){	//... valida permiso de menu y de deposito ...
				redirect('menuController/index');
			}
			
			if( $permisoProceso3==false ){   //... valida permiso de proceso ...
				redirect('menuController/index');
			}
		}
		//... fin control de permisos de acceso ....
		
				
		$tipoTransaccion= $_POST['tipoTransaccion']; //... lee tipoTransaccion				
		$fechaInicial=$_POST['inputFechaInicial']; //... viene de la vista fechasReporteSalida ...
		$fechaFinal=$_POST['inputFechaFinal']; //... viene de la vista fechasReporteSalida ...
		
		// Se carga la libreria fpdf
		$this->load->library('inventarios/IngresoMaterialPdf');
		
		$ingresoMaterial='ing'.$nombreDeposito;  //... tabla[ingalmacen/ingbodega]
		$ingresoCabecera='ingreso'.$nombreDeposito.'cabecera';	//... tabla ingreso[almacen/bodega].cabecera 
		$maestroMaterial=$nombreDeposito;	//... tabla maestra  [almacen/bodega]
		 
		        // Se obtienen los registros de la base de datos
		//$salidas = $this->db->query('SELECT t1.numSal, fecha,numOrden, glosa,idMaterial,nombreInsumo, cantidad,unidad,tipoInsumo FROM '.$salidaMaterial.' t1, '.$salidaCabecera.' t2, '.$maestroMaterial.' t3 WHERE t1.numSal = t2.numero AND  t1.idMaterial=t3.codInsumo ORDER BY t1.numSal');
		$sql="SELECT numIng,fecha,numFactura,proveedor,idMaterial,nombreInsumo,cantidad,unidad,precioCompra FROM $ingresoMaterial,$ingresoCabecera,$maestroMaterial WHERE numIng=numero AND fecha>='$fechaInicial' AND fecha<='$fechaFinal' AND idMaterial=codInsumo ORDER BY numIng";
		
		$ingresos = $this->db->query($sql);
		 
		$contador= $ingresos->num_rows; //...contador de registros que satisfacen la consulta ..
		
		if($contador==0){
			$datos['mensaje']='No hay registros entre la fecha inicial '.fechaMysqlParaLatina($fechaInicial).' y la fecha final '.fechaMysqlParaLatina($fechaFinal).' seleccionadas.';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}else{
			// Creacion del PDF
		    /*
		    * Se crea un objeto de la clase SalAlmacenPdf, recordar que la clase Pdf
		    * heredó todos las variables y métodos de fpdf
		    */
		     
		    ob_clean(); // cierra si es se abrio el envio de pdf...
		    $this->pdf = new IngresoMaterialPdf();
			
			$this->pdf->nombreDeposito=strtoupper($nombreDeposito);      				//...pasando variable para el header del PDF
			$this->pdf->fechaInicial=fechaMysqlParaLatina($fechaInicial); 	//...pasando variable para el header del PDF
			$this->pdf->fechaFinal=fechaMysqlParaLatina($fechaFinal); 		//...pasando variable para el header del PDF
			
		    // Agregamos una página
		    $this->pdf->AddPage();
		    // Define el alias para el número de página que se imprimirá en el pie
		    $this->pdf->AliasNbPages();
		 
		    /* Se define el titulo, márgenes izquierdo, derecho y
		    * el color de relleno predeterminado
		    */
		         
	        $this->pdf->SetLeftMargin(10);
	        $this->pdf->SetRightMargin(10);
	        $this->pdf->SetFillColor(200,200,200);
	 
		    // Se define el formato de fuente: Arial, negritas, tamaño 9
		    //$this->pdf->SetFont('Arial', 'B', 9);
		    $this->pdf->SetFont('Arial', '', 9);
		    
		    // La variable $numeroAnterior se utiliza para hacer corte de control por número salida
		    $numeroAnterior = 0;
			$totalPorNumeroIngreso=0; //... acumula los importes de cada nota de ingreso...
		    foreach ($ingresos->result() as $ingreso) {
		        // se imprime el numero actual y despues se incrementa el valor de $x en uno
		        // Se imprimen los datos de cada registro
		        if($numeroAnterior == 0 || $numeroAnterior !=($ingreso->numIng) ){   //...corte de control numero Ingreso
		        	$this->pdf->Ln(5);  //Se agrega un salto de linea
		        	
		        	if($totalPorNumeroIngreso!=0){
		        		$this->pdf->Cell(145,5,'','',0,'L',0);
		        		$this->pdf->Cell(40,5,'Total Bs. '.number_format($totalPorNumeroIngreso,2),0,0,'R');
						$totalPorNumeroIngreso=0; //... inicializa en cero acumulador...
						//Se agrega dos saltos de linea
		        		$this->pdf->Ln(5);
						$this->pdf->Ln(5);
		        	}
					
		        	$this->pdf->Cell(12,5,$ingreso->numIng,'',0,'L',0);
		            $this->pdf->Cell(20,5,fechaMysqlParaLatina($ingreso->fecha),'',0,'L',0);
		            $this->pdf->Cell(22,5,$ingreso->numFactura,'',0,'L',0);
		       		$this->pdf->Cell(51,5,utf8_decode($ingreso->proveedor),'',0,'L',0);
		            $numeroAnterior=$ingreso->numIng;
					
					//Se agrega un salto de linea
		        	$this->pdf->Ln(5);
					
		        }
		       
		        $this->pdf->Cell(12,5,'','',0,'L',0);
				$this->pdf->Cell(15,5,$ingreso->idMaterial,'',0,'L',0);
				$this->pdf->Cell(70,5,$ingreso->nombreInsumo,'',0,'L',0);
		        $this->pdf->Cell(29,5,number_format($ingreso->cantidad,2),'',0,'R',0);
				$this->pdf->Cell(20,5,$ingreso->unidad,'',0,'C',0);
				$this->pdf->Cell(19,5,number_format($ingreso->precioCompra,2),'',0,'R',0);
				$this->pdf->Cell(20,5,number_format($ingreso->cantidad*$ingreso->precioCompra,2),'',0,'R',0);
				$totalPorNumeroIngreso=$totalPorNumeroIngreso +( $ingreso->cantidad*$ingreso->precioCompra ); //... acumula los importes de cada nota de ingreso...
		        //Se agrega un salto de linea
		        $this->pdf->Ln(5);
		    }
				$this->pdf->Ln(5);
				$this->pdf->Cell(145,5,'','',0,'L',0);
	    		$this->pdf->Cell(40,5,'Total Bs. '.number_format($totalPorNumeroIngreso,2),0,0,'R');
				$this->pdf->$totalPorNumeroIngreso=0; //... inicializa en cero acumulador...
	
			     /* PDF Output() settings
			     * Se manda el pdf al navegador
			     *
			     * $this->pdf->Output(nombredelarchivo, destino);
			     *
			     * I = Muestra el pdf en el navegador
			     * D = Envia el pdf para descarga
				 * F: save to a local file
				 * S: return the document as a string. name is ignored.
				 * $pdf->Output(); //default output to browser
				 * $pdf->Output('D:/example2.pdf','F');
				 * $pdf->Output("example2.pdf", 'D');
				 * $pdf->Output('', 'S'); //... Returning the PDF file content as a string:
			     */
			  
			  	$this->pdf->Output('pdfsArchivos/reporteIngresoPdf.pdf', 'F');
				
				$datos['documento']="pdfsArchivos/reporteIngresoPdf.pdf";	
				$datos['titulo']=$tipoTransaccion.' '.strtoupper($nombreDeposito);	// ... ingreso/salida ... almacen/bodega ...
				$datos['fechaInicial']=fechaMysqlParaLatina($fechaInicial);
				$datos['fechaFinal']=fechaMysqlParaLatina($fechaFinal);
				$this->load->view('header');
				$this->load->view('reportePdf',$datos );
				$this->load->view('footer');	
			}
	    
	} //... fin funcion: generarReporteIngreso ...


	public function fechasReporteIngresoSalida(){
		$nombreDeposito= $_GET['nombreDeposito']; //... lee nombreDeposito que viene del menu principal(salida de  almacen/bodega ) ...		
		$tipoTransaccion= $_GET['tipoTransaccion']; //... lee tipoTransaccion que viene del menu principal(salida de  almacen/bodega ) ...		
		
		$datos['nombreDeposito']=$nombreDeposito;
		$datos['tipoTransaccion']=$tipoTransaccion;
		$this->load->view('header');
		$this->load->view('inventarios/fechasReporteIngresoSalida',$datos );
		$this->load->view('footer');
	}
	
	
	public function datosKardex(){
		$this->load->model("tablaGenerica_model");	//...carga el modelo tabla 
		$materiales= $this->tablaGenerica_model->getTodos('almacen'); //..una vez cargado el modelo de la tabla llama almacen..
						
      	$datos['materiales']=$materiales;	
		$datos['titulo']='Kardex de Materiales';
		$this->load->view('header');
		$this->load->view('inventarios/capturarDatosKardex',$datos );
		$this->load->view('footer');
	}
	
	
	public function datosFisicoValorado(){
		$datos['titulo']='Inventario Físico Valorado';
		$this->load->view('header');
		$this->load->view('inventarios/capturarDatosFisicoValorado',$datos );
		$this->load->view('footer');
	}
	
	
	public function fechasReporteMaterialUsadoResponsable(){
		$nombreDeposito= $_GET['nombreDeposito']; //... lee nombreDeposito que viene del menu principal(salida de  almacen/bodega ) ...		
		$tipoTransaccion= $_GET['tipoTransaccion']; //... lee tipoTransaccion que viene del menu principal(salida de  almacen/bodega ) ...		
		
		$datos['nombreDeposito']=$nombreDeposito;
		$datos['tipoTransaccion']=$tipoTransaccion;
		$this->load->view('header');
		$this->load->view('inventarios/fechasReporteMaterialUsadoResponsable',$datos );
		$this->load->view('footer');
	}
	
	
	public function generarReportesalida(){
		//... genera reporte de salida en PDF
		
		$nombreDeposito= $_POST['nombreDeposito']; //... lee nombreDeposito que viene del menu principal(salida de  almacen/bodega ) ...
		
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoDeposito=$this->session->userdata('usuarioDeposito');
		$permisoProceso4=$this->session->userdata('usuarioProceso4');
		if($permisoUserName!='superuser' ){  //... valida permiso de userName ...	
			if($permisoMenu!='inventarios' || $permisoDeposito!=$nombreDeposito){	//... valida permiso de menu y de deposito ...
				redirect('menuController/index');
			}
			
			if( $permisoProceso4==false ){   //... valida permiso de proceso ...
				redirect('menuController/index');
			}
		}
		//... fin control de permisos de acceso ....
				
		$tipoTransaccion= $_POST['tipoTransaccion']; //... lee tipoTransaccion			
		$fechaInicial=$_POST['inputFechaInicial']; //... viene de la vista fechasReporteSalida ...
		$fechaFinal=$_POST['inputFechaFinal']; //... viene de la vista fechasReporteSalida ...
		
        // Se carga la libreria fpdf
        $this->load->library('inventarios/SalidaMaterialPdf');
		
		$salidaMaterial='sal'.$nombreDeposito;  //... tabla[salalmacen/salbodega]
		$salidaCabecera='salida'.$nombreDeposito.'cabecera';	//... tabla salida[almacen/bodega].cabecera 
		$maestroMaterial=$nombreDeposito;	//... tabla maestra  [almacen/bodega]
 
        // Se obtienen los registros de la base de datos
        //$salidas = $this->db->query('SELECT t1.numSal, fecha,numOrden, glosa,idMaterial,nombreInsumo, cantidad,unidad,tipoInsumo FROM '.$salidaMaterial.' t1, '.$salidaCabecera.' t2, '.$maestroMaterial.' t3 WHERE t1.numSal = t2.numero AND  t1.idMaterial=t3.codInsumo ORDER BY t1.numSal');
	    $sql ="SELECT numSal,fecha,numOrden,glosa,idMaterial,nombreInsumo,cantidad,unidad,tipoInsumo FROM $salidaMaterial,$salidaCabecera,$maestroMaterial WHERE numSal=numero AND fecha>='$fechaInicial' AND fecha<='$fechaFinal' AND idMaterial=codInsumo ORDER BY numSal";

 		$salidas = $this->db->query($sql);
 
 		$contador= $salidas->num_rows; //...contador de registros que satisfacen la consulta ..
 		
 		if($contador==0){
			$datos['mensaje']='No hay registros entre la fecha inicial '.fechaMysqlParaLatina($fechaInicial).' y la fecha final '.fechaMysqlParaLatina($fechaFinal).' seleccionadas.';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
 		}else{
 			// Creacion del PDF
	        /*
	        * Se crea un objeto de la clase SalAlmacenPdf, recordar que la clase Pdf
	        * heredó todos las variables y métodos de fpdf
	        */
	         
	        ob_clean(); // cierra si es se abrio el envio de pdf...
	        $this->pdf = new SalidaMaterialPdf();
			$this->pdf->tipoTransaccion=strtoupper($tipoTransaccion);      	//...pasando variable para el header del PDF
			$this->pdf->nombreDeposito=strtoupper($nombreDeposito);      	//...pasando variable para el header del PDF
			$this->pdf->fechaInicial=fechaMysqlParaLatina($fechaInicial); 	//...pasando variable para el header del PDF
			$this->pdf->fechaFinal=fechaMysqlParaLatina($fechaFinal); 		//...pasando variable para el header del PDF
			
	        // Agregamos una página
	        $this->pdf->AddPage();
	        // Define el alias para el número de página que se imprimirá en el pie
	        $this->pdf->AliasNbPages();
	 
	        /* Se define el titulo, márgenes izquierdo, derecho y
	         * el color de relleno predeterminado
	         */
	         
	        $this->pdf->SetLeftMargin(10);
	        $this->pdf->SetRightMargin(10);
	        $this->pdf->SetFillColor(200,200,200);
	 
	        // Se define el formato de fuente: Arial, negritas, tamaño 9
	        //$this->pdf->SetFont('Arial', 'B', 9);
	        $this->pdf->SetFont('Arial', '', 9);
	        
	        // La variable $numeroAnterior se utiliza para hacer corte de control por número salida
	        $numeroAnterior = 0;
	        foreach ($salidas->result() as $salida) {
	            // se imprime el numero actual y despues se incrementa el valor de $x en uno
	            // Se imprimen los datos de cada registro
	            if($numeroAnterior == 0 || $numeroAnterior !=($salida->numSal) ){   //...corte de control numero Salida
	            	$this->pdf->Ln(5);  //Se agrega un salto de linea
	            	$this->pdf->Cell(12,5,$salida->numSal,'',0,'L',0);
		            $this->pdf->Cell(20,5,fechaMysqlParaLatina($salida->fecha),'',0,'L',0);
		            $this->pdf->Cell(22,5,$salida->numOrden,'',0,'L',0);
		       		$this->pdf->Cell(51,5,utf8_decode($salida->glosa),'',0,'L',0);
		            $numeroAnterior=$salida->numSal;
					//Se agrega un salto de linea
	            	$this->pdf->Ln(5);
					
	            }
	           
	            $this->pdf->Cell(31,5,'','',0,'L',0);
				$this->pdf->Cell(15,5,$salida->idMaterial,'',0,'L',0);
				$this->pdf->Cell(70,5,$salida->nombreInsumo,'',0,'L',0);
	            $this->pdf->Cell(35,5,number_format($salida->cantidad,2),'',0,'R',0);
				$this->pdf->Cell(20,5,$salida->unidad,'',0,'C',0);
				$this->pdf->Cell(14,5,$salida->tipoInsumo,'',0,'C',0);
	            //Se agrega un salto de linea
	            $this->pdf->Ln(5);
	        }
	        
	         /* PDF Output() settings
	         * Se manda el pdf al navegador
	         *
	         * $this->pdf->Output(nombredelarchivo, destino);
	         *
	         * I = Muestra el pdf en el navegador
	         * D = Envia el pdf para descarga
			 * F: save to a local file
			 * S: return the document as a string. name is ignored.
			 * $pdf->Output(); //default output to browser
			 * $pdf->Output('D:/example2.pdf','F');
			 * $pdf->Output("example2.pdf", 'D');
			 * $pdf->Output('', 'S'); //... Returning the PDF file content as a string:
	         */
	  
	  		$this->pdf->Output('pdfsArchivos/reporteSalidaPdf.pdf', 'F');
	  		
			$datos['documento']="pdfsArchivos/reporteSalidaPdf.pdf";	
			$datos['titulo']=$tipoTransaccion.' '.strtoupper($nombreDeposito);	// ... ingreso/salida ... almacen/bodega ...
			$datos['fechaInicial']=fechaMysqlParaLatina($fechaInicial);
			$datos['fechaFinal']=fechaMysqlParaLatina($fechaFinal);
			$this->load->view('header');
			$this->load->view('reportePdf',$datos );
			$this->load->view('footer');	
 		}
        
	} //... fin funcion: generarReporteSalida ...
	

		public function generarReportesalidas_modificadas(){
		//... genera reporte de salida en PDF
		
		$nombreDeposito= $_POST['nombreDeposito']; //... lee nombreDeposito que viene del menu principal(salida de  almacen/bodega ) ...
		
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoDeposito=$this->session->userdata('usuarioDeposito');
		$permisoProceso4=$this->session->userdata('usuarioProceso4');
		if($permisoUserName!='superuser' ){  //... valida permiso de userName ...	
			if($permisoMenu!='inventarios' || $permisoDeposito!=$nombreDeposito){	//... valida permiso de menu y de deposito ...
				redirect('menuController/index');
			}
			
			if( $permisoProceso4==false ){   //... valida permiso de proceso ...
				redirect('menuController/index');
			}
		}
		//... fin control de permisos de acceso ....
				
		$tipoTransaccion= $_POST['tipoTransaccion']; //... lee tipoTransaccion			
		$fechaInicial=$_POST['inputFechaInicial']; //... viene de la vista fechasReporteSalida ...
		$fechaFinal=$_POST['inputFechaFinal']; //... viene de la vista fechasReporteSalida ...
		
        // Se carga la libreria fpdf
        $this->load->library('inventarios/SalidaMaterialPdf');
		
		$salidaMaterial='s'.$nombreDeposito.'bitacora';  //... tabla[salalmacen/salbodega]
		$salidaCabecera='salida'.$nombreDeposito.'cabecera';	//... tabla salida[almacen/bodega].cabecera 
		$maestroMaterial=$nombreDeposito;	//... tabla maestra  [almacen/bodega]
 
        // Se obtienen los registros de la base de datos
        //$salidas = $this->db->query('SELECT t1.numSal, fecha,numOrden, glosa,idMaterial,nombreInsumo, cantidad,unidad,tipoInsumo FROM '.$salidaMaterial.' t1, '.$salidaCabecera.' t2, '.$maestroMaterial.' t3 WHERE t1.numSal = t2.numero AND  t1.idMaterial=t3.codInsumo ORDER BY t1.numSal');
	    $sql ="SELECT numSal,fecha,numOrden,glosa,idMaterial,nombreInsumo,cantidad,unidad,tipoInsumo FROM $salidaMaterial,$salidaCabecera,$maestroMaterial WHERE numSal=numero AND fecha>='$fechaInicial' AND fecha<='$fechaFinal' AND idMaterial=codInsumo ORDER BY numSal";

 		$salidas = $this->db->query($sql);
 
 		$contador= $salidas->num_rows; //...contador de registros que satisfacen la consulta ..
 		
 		if($contador==0){
			$datos['mensaje']='No hay registros entre la fecha inicial '.fechaMysqlParaLatina($fechaInicial).' y la fecha final '.fechaMysqlParaLatina($fechaFinal).' seleccionadas.';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
 		}else{
 			// Creacion del PDF
	        /*
	        * Se crea un objeto de la clase SalAlmacenPdf, recordar que la clase Pdf
	        * heredó todos las variables y métodos de fpdf
	        */
	         
	        ob_clean(); // cierra si es se abrio el envio de pdf...
	        $this->pdf = new SalidaMaterialPdf();
			$this->pdf->tipoTransaccion=strtoupper($tipoTransaccion);      	//...pasando variable para el header del PDF
			$this->pdf->nombreDeposito=strtoupper($nombreDeposito);      	//...pasando variable para el header del PDF
			$this->pdf->fechaInicial=fechaMysqlParaLatina($fechaInicial); 	//...pasando variable para el header del PDF
			$this->pdf->fechaFinal=fechaMysqlParaLatina($fechaFinal); 		//...pasando variable para el header del PDF
			
	        // Agregamos una página
	        $this->pdf->AddPage();
	        // Define el alias para el número de página que se imprimirá en el pie
	        $this->pdf->AliasNbPages();
	 
	        /* Se define el titulo, márgenes izquierdo, derecho y
	         * el color de relleno predeterminado
	         */
	         
	        $this->pdf->SetLeftMargin(10);
	        $this->pdf->SetRightMargin(10);
	        $this->pdf->SetFillColor(200,200,200);
	 
	        // Se define el formato de fuente: Arial, negritas, tamaño 9
	        //$this->pdf->SetFont('Arial', 'B', 9);
	        $this->pdf->SetFont('Arial', '', 9);
	        
	        // La variable $numeroAnterior se utiliza para hacer corte de control por número salida
	        $numeroAnterior = 0;
	        foreach ($salidas->result() as $salida) {
	            // se imprime el numero actual y despues se incrementa el valor de $x en uno
	            // Se imprimen los datos de cada registro
	            if($numeroAnterior == 0 || $numeroAnterior !=($salida->numSal) ){   //...corte de control numero Salida
	            	$this->pdf->Ln(5);  //Se agrega un salto de linea
	            	$this->pdf->Cell(12,5,$salida->numSal,'',0,'L',0);
		            $this->pdf->Cell(20,5,fechaMysqlParaLatina($salida->fecha),'',0,'L',0);
		            $this->pdf->Cell(22,5,$salida->numOrden,'',0,'L',0);
		       		$this->pdf->Cell(51,5,utf8_decode($salida->glosa),'',0,'L',0);
		            $numeroAnterior=$salida->numSal;
					//Se agrega un salto de linea
	            	$this->pdf->Ln(5);
					
	            }
	           
	            $this->pdf->Cell(31,5,'','',0,'L',0);
				$this->pdf->Cell(15,5,$salida->idMaterial,'',0,'L',0);
				$this->pdf->Cell(70,5,$salida->nombreInsumo,'',0,'L',0);
	            $this->pdf->Cell(35,5,number_format($salida->cantidad,2),'',0,'R',0);
				$this->pdf->Cell(20,5,$salida->unidad,'',0,'C',0);
				$this->pdf->Cell(14,5,$salida->tipoInsumo,'',0,'C',0);
	            //Se agrega un salto de linea
	            $this->pdf->Ln(5);
	        }
	        
	         /* PDF Output() settings
	         * Se manda el pdf al navegador
	         *
	         * $this->pdf->Output(nombredelarchivo, destino);
	         *
	         * I = Muestra el pdf en el navegador
	         * D = Envia el pdf para descarga
			 * F: save to a local file
			 * S: return the document as a string. name is ignored.
			 * $pdf->Output(); //default output to browser
			 * $pdf->Output('D:/example2.pdf','F');
			 * $pdf->Output("example2.pdf", 'D');
			 * $pdf->Output('', 'S'); //... Returning the PDF file content as a string:
	         */
	  
	  		$this->pdf->Output('pdfsArchivos/reporteSalidaPdf.pdf', 'F');
	  		
			$datos['documento']="pdfsArchivos/reporteSalidaPdf.pdf";	
			$datos['titulo']=$tipoTransaccion.' '.strtoupper($nombreDeposito);	// ... ingreso/salida ... almacen/bodega ...
			$datos['fechaInicial']=fechaMysqlParaLatina($fechaInicial);
			$datos['fechaFinal']=fechaMysqlParaLatina($fechaFinal);
			$this->load->view('header');
			$this->load->view('reportePdf',$datos );
			$this->load->view('footer');	
 		}
        
	} //... fin funcion: generarReporteSalidasModificadas ...
	
	
	
	
		public function generarReporteMaterialUsadoResponsable(){
		//... genera reporte de salida en PDF
		
		$nombreDeposito= $_POST['nombreDeposito']; //... lee nombreDeposito que viene del menu principal(salida de  almacen/bodega ) ...
		
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoDeposito=$this->session->userdata('usuarioDeposito');
		$permisoProceso4=$this->session->userdata('usuarioProceso4');
		if($permisoUserName!='superuser' ){  //... valida permiso de userName ...	
			if($permisoMenu!='inventarios' || $permisoDeposito!=$nombreDeposito){	//... valida permiso de menu y de deposito ...
				redirect('menuController/index');
			}
			
			if( $permisoProceso4==false ){   //... valida permiso de proceso ...
				redirect('menuController/index');
			}
		}
		//... fin control de permisos de acceso ....
				
		$responsable= $_POST['responsable']; //... lee responsable			
		$fechaInicial=$_POST['inputFechaInicial']; //... viene de la vista fechasReporteSalida ...
		$fechaFinal=$_POST['inputFechaFinal']; //... viene de la vista fechasReporteSalida ...
		
        // Se carga la libreria fpdf
        $this->load->library('inventarios/SalidaMaterialUsado');
		
		$salidaMaterial='sal'.$nombreDeposito;  //... tabla[salalmacen/salbodega]
		$salidaCabecera='salida'.$nombreDeposito.'cabecera';	//... tabla salida[almacen/bodega].cabecera 
		$maestroMaterial=$nombreDeposito;	//... tabla maestra  [almacen/bodega]
 
        // Se obtienen los registros de la base de datos
        //$salidas = $this->db->query('SELECT t1.numSal, fecha,numOrden, glosa,idMaterial,nombreInsumo, cantidad,unidad,tipoInsumo FROM '.$salidaMaterial.' t1, '.$salidaCabecera.' t2, '.$maestroMaterial.' t3 WHERE t1.numSal = t2.numero AND  t1.idMaterial=t3.codInsumo ORDER BY t1.numSal');
	    $sql ="SELECT numSal,fecha,numOrden,glosa,idMaterial,nombreInsumo,cantidad,unidad,tipoInsumo FROM $salidaMaterial,$salidaCabecera,$maestroMaterial WHERE numSal=numero AND fecha>='$fechaInicial' AND 
	    fecha<='$fechaFinal' AND idMaterial=codInsumo AND glosa='$responsable'ORDER BY numSal";

 		$salidas = $this->db->query($sql);
 
 		$contador= $salidas->num_rows; //...contador de registros que satisfacen la consulta ..
 		
 		if($contador==0){
			$datos['mensaje']='No hay registros entre la fecha inicial '.fechaMysqlParaLatina($fechaInicial).' y la fecha final '.fechaMysqlParaLatina($fechaFinal).' seleccionadas.';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
 		}else{
 			// Creacion del PDF
	        /*
	        * Se crea un objeto de la clase SalAlmacenPdf, recordar que la clase Pdf
	        * heredó todos las variables y métodos de fpdf
	        */
	         
	        ob_clean(); // cierra si es se abrio el envio de pdf...
	        $this->pdf = new SalidaMaterialUsado();
			
			$this->pdf->responsable=strtoupper($responsable);      			//...pasando variable para el header del PDF
			$this->pdf->fechaInicial=fechaMysqlParaLatina($fechaInicial); 	//...pasando variable para el header del PDF
			$this->pdf->fechaFinal=fechaMysqlParaLatina($fechaFinal); 		//...pasando variable para el header del PDF
			
	        // Agregamos una página
	        $this->pdf->AddPage();
	        // Define el alias para el número de página que se imprimirá en el pie
	        $this->pdf->AliasNbPages();
	 
	        /* Se define el titulo, márgenes izquierdo, derecho y
	         * el color de relleno predeterminado
	         */
	         
	        $this->pdf->SetLeftMargin(10);
	        $this->pdf->SetRightMargin(10);
	        $this->pdf->SetFillColor(200,200,200);
	 
	        // Se define el formato de fuente: Arial, negritas, tamaño 9
	        //$this->pdf->SetFont('Arial', 'B', 9);
	        $this->pdf->SetFont('Arial', '', 9);
	        
	        // La variable $numeroAnterior se utiliza para hacer corte de control por número salida
	        $numeroAnterior = 0;
	        foreach ($salidas->result() as $salida) {
	            // se imprime el numero actual y despues se incrementa el valor de $x en uno
	            // Se imprimen los datos de cada registro
	            if($numeroAnterior == 0 || $numeroAnterior !=($salida->numSal) ){   //...corte de control numero Salida
	            	$this->pdf->Ln(5);  //Se agrega un salto de linea
	            	$this->pdf->Cell(12,5,$salida->numSal,'',0,'L',0);
		            $this->pdf->Cell(20,5,fechaMysqlParaLatina($salida->fecha),'',0,'L',0);
		            $this->pdf->Cell(22,5,$salida->numOrden,'',0,'L',0);
		       		$this->pdf->Cell(51,5,utf8_decode($salida->glosa),'',0,'L',0);
		            $numeroAnterior=$salida->numSal;
					//Se agrega un salto de linea
	            	$this->pdf->Ln(5);
					
	            }
	           
	            $this->pdf->Cell(31,5,'','',0,'L',0);
				$this->pdf->Cell(15,5,$salida->idMaterial,'',0,'L',0);
				$this->pdf->Cell(70,5,$salida->nombreInsumo,'',0,'L',0);
	            $this->pdf->Cell(35,5,number_format($salida->cantidad,2),'',0,'R',0);
				$this->pdf->Cell(20,5,$salida->unidad,'',0,'C',0);
				$this->pdf->Cell(14,5,$salida->tipoInsumo,'',0,'C',0);
	            //Se agrega un salto de linea
	            $this->pdf->Ln(5);
	        }
	        
	         /* PDF Output() settings
	         * Se manda el pdf al navegador
	         *
	         * $this->pdf->Output(nombredelarchivo, destino);
	         *
	         * I = Muestra el pdf en el navegador
	         * D = Envia el pdf para descarga
			 * F: save to a local file
			 * S: return the document as a string. name is ignored.
			 * $pdf->Output(); //default output to browser
			 * $pdf->Output('D:/example2.pdf','F');
			 * $pdf->Output("example2.pdf", 'D');
			 * $pdf->Output('', 'S'); //... Returning the PDF file content as a string:
	         */
	  
	  		$this->pdf->Output('pdfsArchivos/reporteMaterialUsado.pdf', 'F');
	  		
			$datos['documento']="pdfsArchivos/reporteMaterialUsado.pdf";	
			$datos['titulo']=' Material Usado por Responsable '.$responsable;	// ... titulo ...
			$datos['fechaInicial']=fechaMysqlParaLatina($fechaInicial);
			$datos['fechaFinal']=fechaMysqlParaLatina($fechaFinal);
			$this->load->view('header');
			$this->load->view('reportePdf',$datos );
			$this->load->view('footer');	
 		}
        
	} //... fin funcion: generarReporteMaterialUsadoResponsable ...
	
	
	public function generarReporteNumeroOrden(){
		//... genera reporte de salida en PDF
		
		$nombreDeposito= $_POST['nombreDeposito']; //... lee nombreDeposito que viene del menu principal(salida de  almacen/bodega ) ...
		
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoDeposito=$this->session->userdata('usuarioDeposito');
		$permisoProceso4=$this->session->userdata('usuarioProceso4');
		if($permisoUserName!='superuser' ){  //... valida permiso de userName ...	
			if($permisoMenu!='inventarios' || $permisoDeposito!=$nombreDeposito){	//... valida permiso de menu y de deposito ...
				redirect('menuController/index');
			}
			
			if( $permisoProceso4==false ){   //... valida permiso de proceso ...
				redirect('menuController/index');
			}
		}
		//... fin control de permisos de acceso ....
				
		$numeroOrden= str_replace(" ","",$_POST['numeroOrden']); //... lee numeroOrden			
		
        // Se carga la libreria fpdf
        $this->load->library('inventarios/SalidaNumeroOrden');
		
		$salidaMaterial='sal'.$nombreDeposito;  //... tabla[salalmacen/salbodega]
		$salidaCabecera='salida'.$nombreDeposito.'cabecera';	//... tabla salida[almacen/bodega].cabecera 
		$maestroMaterial=$nombreDeposito;	//... tabla maestra  [almacen/bodega]
 
        // Se obtienen los registros de la base de datos
        //$salidas = $this->db->query('SELECT t1.numSal, fecha,numOrden, glosa,idMaterial,nombreInsumo, cantidad,unidad,tipoInsumo FROM '.$salidaMaterial.' t1, '.$salidaCabecera.' t2, '.$maestroMaterial.' t3 WHERE t1.numSal = t2.numero AND  t1.idMaterial=t3.codInsumo ORDER BY t1.numSal');
	//    $sql ="SELECT numSal,fecha,numOrden,glosa,idMaterial,nombreInsumo,cantidad,unidad,tipoInsumo FROM $salidaMaterial,$salidaCabecera,$maestroMaterial WHERE numSal=numero AND idMaterial=codInsumo AND numOrden='$numeroOrden'ORDER BY numSal";
		$sql ="SELECT numSal,fecha,numOrden,glosa,idMaterial,nombreInsumo,cantidad,unidad,tipoInsumo FROM $salidaMaterial,$salidaCabecera,$maestroMaterial WHERE numSal=numero AND idMaterial=codInsumo AND numOrden LIKE'%$numeroOrden%'ORDER BY numSal";

		
 		$salidas = $this->db->query($sql);
 
 		$contador= $salidas->num_rows; //...contador de registros que satisfacen la consulta ..
 		
 		if($contador==0){
			$datos['mensaje']='No hay registros entre para la orden No. '.$numeroOrden;
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
 		}else{
 			// Creacion del PDF
	        /*
	        * Se crea un objeto de la clase SalAlmacenPdf, recordar que la clase Pdf
	        * heredó todos las variables y métodos de fpdf
	        */
	         
	        ob_clean(); // cierra si es se abrio el envio de pdf...
	        $this->pdf = new SalidaNumeroOrden();
			
			$this->pdf->numeroOrden=strtoupper($numeroOrden);      			//...pasando variable para el header del PDF
			
	        // Agregamos una página
	        $this->pdf->AddPage();
	        // Define el alias para el número de página que se imprimirá en el pie
	        $this->pdf->AliasNbPages();
	 
	        /* Se define el titulo, márgenes izquierdo, derecho y
	         * el color de relleno predeterminado
	         */
	         
	        $this->pdf->SetLeftMargin(10);
	        $this->pdf->SetRightMargin(10);
	        $this->pdf->SetFillColor(200,200,200);
	 
	        // Se define el formato de fuente: Arial, negritas, tamaño 9
	        //$this->pdf->SetFont('Arial', 'B', 9);
	        $this->pdf->SetFont('Arial', '', 9);
	        
	        // La variable $numeroAnterior se utiliza para hacer corte de control por número salida
	        $numeroAnterior = 0;
	        foreach ($salidas->result() as $salida) {
	            // se imprime el numero actual y despues se incrementa el valor de $x en uno
	            // Se imprimen los datos de cada registro
	            if($numeroAnterior == 0 || $numeroAnterior !=($salida->numSal) ){   //...corte de control numero Salida
	            	$this->pdf->Ln(5);  //Se agrega un salto de linea
	            	$this->pdf->Cell(12,5,$salida->numSal,'',0,'L',0);
		            $this->pdf->Cell(20,5,fechaMysqlParaLatina($salida->fecha),'',0,'L',0);
		            $this->pdf->Cell(22,5,$salida->numOrden,'',0,'L',0);
		       		$this->pdf->Cell(51,5,utf8_decode($salida->glosa),'',0,'L',0);
		            $numeroAnterior=$salida->numSal;
					//Se agrega un salto de linea
	            	$this->pdf->Ln(5);
					
	            }
	           
	            $this->pdf->Cell(31,5,'','',0,'L',0);
				$this->pdf->Cell(15,5,$salida->idMaterial,'',0,'L',0);
				$this->pdf->Cell(70,5,$salida->nombreInsumo,'',0,'L',0);
	            $this->pdf->Cell(35,5,number_format($salida->cantidad,2),'',0,'R',0);
				$this->pdf->Cell(20,5,$salida->unidad,'',0,'C',0);
				$this->pdf->Cell(14,5,$salida->tipoInsumo,'',0,'C',0);
	            //Se agrega un salto de linea
	            $this->pdf->Ln(5);
	        }
	        
	         /* PDF Output() settings
	         * Se manda el pdf al navegador
	         *
	         * $this->pdf->Output(nombredelarchivo, destino);
	         *
	         * I = Muestra el pdf en el navegador
	         * D = Envia el pdf para descarga
			 * F: save to a local file
			 * S: return the document as a string. name is ignored.
			 * $pdf->Output(); //default output to browser
			 * $pdf->Output('D:/example2.pdf','F');
			 * $pdf->Output("example2.pdf", 'D');
			 * $pdf->Output('', 'S'); //... Returning the PDF file content as a string:
	         */
	  
	  		$this->pdf->Output('pdfsArchivos/reporteNumeroOrden.pdf', 'F');
	  		
			$datos['documento']="pdfsArchivos/reporteNumeroOrden.pdf";	
			$datos['titulo']=' Material por Orden No. '.$numeroOrden;	// ... titulo ...
		
			$this->load->view('header');
			$this->load->view('reportePdfSinFechas',$datos );
			$this->load->view('footer');	
 		}
        
	} //... fin funcion: generarReporteNumeroOrden ...
	
	
	public function kardexMaterial(){
		//... genera reporte de kardexMaterial en PDF
		$codigoMaterial=str_replace(" ","",$_POST['inputCodigo']);  //...quita espacio en blanco ..
		$descripcionMaterial= $_POST['inputDescripcion']; 	//... lee descripcion del material ...
		$fechaInicial= $_POST['inputFechaInicial']; 		//... lee fecha inicial ...
		$fechaFinal= $_POST['inputFechaFinal']; 			//... lee fecha final ...
		$unidad= $_POST['unidad']; 							//... lee unidad ...
		$existencia= $_POST['existencia']; 					//... lee existencia ...
		$precioUnidad= $_POST['precioUnidad']; 					//... lee precio unidad ...	
		
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoDeposito=$this->session->userdata('usuarioDeposito');
		if($permisoUserName!='superuser' ){  //... valida permiso de userName ...	
			if($permisoMenu!='inventarios' || $permisoUserName!='oscar'){	//... valida permiso de menu y de deposito ...
				redirect('menuController/index');
			}
		}
		//... fin control de permisos de acceso ....
				
        // Se carga la libreria fpdf
        $this->load->library('inventarios/KardexMaterial');
 
        // Se obtienen los registros de la base de datos
        
        $sql ="DELETE FROM kardexmaterial";				//... borra los registros anteriores de KARDEXmaterial antes de cargar los de la nueva consulta... 
 		$result = $this->db->query($sql);
		
		$this-> load -> model("tablaGenerica_model");
		
		$registro=array(
	       		"codMaterial"=>$codigoMaterial,
	       		"material"=>$descripcionMaterial,
	       		"unidad"=>$unidad,
	        	"precioUnidad"=>$precioUnidad,
	        	"saldovalor"=>$precioUnidad*$existencia,
//	        	"nFactura"=>$material->numFactura,
	        	"saldo"=>$existencia,
	        	"responsable"=>"s a l d o   a n t e r i o r"
       	);
                        
        $this-> tablaGenerica_model -> grabar('kardexmaterial',$registro);	
        
		$sqlI ="SELECT idMaterial,fecha,numFactura,cantidad FROM ingalmacen,ingresoalmacencabecera WHERE idMaterial='$codigoMaterial' AND numIng=numero AND fecha>='$fechaInicial' ORDER BY fecha";
 		$resultI = $this->db->query($sqlI);
		
		$qIngreso=0;												//... acumula cantidad ingresada ...
		foreach ($resultI->result() as $material) {                 //... carga registros de la tabla ingAlmacen ...
			$qIngreso= $qIngreso + $material->cantidad;        
        };
		
		$sqlS ="SELECT idMaterial,fecha,numSal,numOrden,cantidad,glosa FROM salalmacen,salidaalmacencabecera WHERE idMaterial='$codigoMaterial' AND numSal=numero AND fecha>='$fechaInicial' ORDER BY fecha";
 		$resultS = $this->db->query($sqlS);
		
		$qSalida=0;												//... acumula cantidad salida ...
		foreach ($resultS->result() as $material) {                  //... carga registros de la tabla salAlmacen ...
			$qSalida=$qSalida + $material->cantidad;
        };
		
		$sql1 ="SELECT idMaterial,fecha,numFactura,cantidad,precioCompra FROM ingalmacen,ingresoalmacencabecera WHERE idMaterial='$codigoMaterial' AND numIng=numero AND fecha>='$fechaInicial' AND fecha<='$fechaFinal' ORDER BY fecha";
 		$result1 = $this->db->query($sql1);
														//... acumula cantidad ingresada ...
		foreach ($result1->result() as $material) {                 //... carga registros de la tabla ingAlmacen ...
			$registroI=array(
	       		"codMaterial"=>$material->idMaterial,
	       		"material"=>$descripcionMaterial,
	       		"unidad"=>$unidad,
	        	"fecha"=>$material->fecha,
	        	"nFactura"=>$material->numFactura,
	        	"ingreso"=>$material->cantidad,
	        	"precioUnidad"=>$material->precioCompra,
	        	"ingresoValor"=>$material->precioCompra*$material->cantidad
       		);
                        
            $this-> tablaGenerica_model -> grabar('kardexmaterial',$registroI);	        
        };


 		$sql2 ="SELECT idMaterial,fecha,numSal,numOrden,cantidad,glosa FROM salalmacen,salidaalmacencabecera WHERE idMaterial='$codigoMaterial' AND numSal=numero AND fecha>='$fechaInicial' AND fecha<='$fechaFinal' ORDER BY fecha";
 		$result2 = $this->db->query($sql2);
		
		foreach ($result2->result() as $material) {                  //... carga registros de la tabla salAlmacen ...
			$registroS=array(
	       		"codMaterial"=>$material->idMaterial,
	       		"material"=>$descripcionMaterial,
	       		"unidad"=>$unidad,
	        	"fecha"=>$material->fecha,
	        	"nOrden"=>$material->numOrden,
	        	"nSalida"=>$material->numSal,
	        	"salida"=>$material->cantidad,
	        	"responsable"=>$material->glosa,
	        	"precioUnidad"=>$precioUnidad,
	        	"salidaValor"=>$precioUnidad*$material->cantidad
       		);
                        
            $this-> tablaGenerica_model -> grabar('kardexmaterial',$registroS);	        
        };
 
 		$sql ="SELECT * FROM kardexmaterial  ORDER BY fecha";
 		$result = $this->db->query($sql);
 		
 		$contador= $result->num_rows; //...contador de registros que satisfacen la consulta ..
 		
		// Creacion del PDF
        /*
        * Se crea un objeto de la clase SalAlmacenPdf, recordar que la clase Pdf
        * heredó todos las variables y métodos de fpdf
        */
         
        ob_clean(); // cierra si es se abrio el envio de pdf...
        $this->pdf = new KardexMaterial();
		
		$this->pdf->codigoMaterial=$codigoMaterial;      					//...pasando variable para el header del PDF
		$this->pdf->descripcionMaterial=$descripcionMaterial;      			//...pasando variable para el header del PDF
		$this->pdf->fechaInicial=fechaMysqlParaLatina($fechaInicial); 		//...pasando variable para el header del PDF
		$this->pdf->fechaFinal=fechaMysqlParaLatina($fechaFinal); 			//...pasando variable para el header del PDF
		
        // Agregamos una página
        $this->pdf->AddPage();
        // Define el alias para el número de página que se imprimirá en el pie
        $this->pdf->AliasNbPages();
 
        /* Se define el titulo, márgenes izquierdo, derecho y
         * el color de relleno predeterminado
         */
         
        $this->pdf->SetLeftMargin(10);
        $this->pdf->SetRightMargin(10);
        $this->pdf->SetFillColor(200,200,200);
 
        // Se define el formato de fuente: Arial, negritas, tamaño 9
        //$this->pdf->SetFont('Arial', 'B', 9);
        $this->pdf->SetFont('Arial', '', 7);
        
        // La variable $numeroAnterior se utiliza para hacer corte de control por número salida
        $saldo= $existencia - ($qIngreso - $qSalida);					//... calcula el saldo anterior ...
        
        $sql ="UPDATE kardexmaterial  SET saldo=$saldo, saldoValor=$saldo*precioUnidad WHERE fecha='0000-00-00'";
 		$this->db->query($sql);
        
        $primeraLinea = 0;							//... bandera para imprimir una sola vez linea... saldo anterior 999 unidad ...
        foreach ($result->result() as $salida) {
            // se imprime el numero actual y despues se incrementa el valor de $x en uno
            // Se imprimen los datos de cada registro
            
            //$this->pdf->Cell(5,5,'','',0,'L',0);
            if($primeraLinea==0){					//... imprime... saldo anterior 999 unidad .... una sola vez
            	$this->pdf->Cell(85,5,' ','',0,'R',0);
            	$this->pdf->Cell(15,5,'Saldo anterior ...','',0,'L',0);
				$this->pdf->Cell(3,5,' ','',0,'R',0);
				$this->pdf->Cell(23,5,number_format($saldo,2),'',0,'R',0);
				$this->pdf->Cell(5,5,' ','',0,'R',0);
				$this->pdf->Cell(10,5,$unidad,'',0,'R',0);
				$primeraLinea = 1;	
				$this->pdf->Ln(5);
            }else{
				$saldo= $saldo + ( $salida->ingreso )- ( $salida->salida );
				$this->pdf->Cell(1,5,fechaMysqlParaLatina($salida->fecha),'',0,'L',0);
				$this->pdf->Cell(15,5,' ','',0,'L',0);
				$this->pdf->Cell(10,5,$salida->nFactura,'',0,'L',0);
				$this->pdf->Cell(9,5,' ','',0,'L',0);
				$this->pdf->Cell(10,5,$salida->nSalida,'',0,'L',0);
				$this->pdf->Cell(5,5,' ','',0,'L',0);
				$this->pdf->Cell(10,5,$salida->nOrden,'',0,'L',0);
	            $this->pdf->Cell(22,5,number_format($salida->ingreso,2),'',0,'R',0);
				$this->pdf->Cell(22,5,number_format($salida->salida,2),'',0,'R',0);
				$this->pdf->Cell(22,5,number_format($saldo,2),'',0,'R',0);
				$this->pdf->Cell(15,5,$unidad,'',0,'R',0);
				$this->pdf->Cell(34,5,$salida->responsable,'',0,'L',0);
	            //Se agrega un salto de linea
	            $this->pdf->Ln(5);
			}
        }
        
         /* PDF Output() settings
         * Se manda el pdf al navegador
         *
         * $this->pdf->Output(nombredelarchivo, destino);
         *
         * I = Muestra el pdf en el navegador
         * D = Envia el pdf para descarga
		 * F: save to a local file
		 * S: return the document as a string. name is ignored.
		 * $pdf->Output(); //default output to browser
		 * $pdf->Output('D:/example2.pdf','F');
		 * $pdf->Output("example2.pdf", 'D');
		 * $pdf->Output('', 'S'); //... Returning the PDF file content as a string:
         */
  
  		$this->pdf->Output('pdfsArchivos/inventarios/kardexMaterial.pdf', 'F');
  		
		$datos['documento']="pdfsArchivos/inventarios/kardexMaterial.pdf";	
		$datos['titulo']=' Kardex Material: '.$descripcionMaterial;	// ... titulo ...
		$datos['fechaInicial']=fechaMysqlParaLatina($fechaInicial);
		$datos['fechaFinal']=fechaMysqlParaLatina($fechaFinal);
		$this->load->view('header');
		$this->load->view('reporteExcelPdf',$datos );
		$this->load->view('footer');	

        
	} //... fin funcion: generarReporte kardexMaterial ...
	
	
	public function fisicoValorado(){
		//... genera reporte de kardexMaterial en PDF
//		$codigoSinEspacio=str_replace(" ","",$_POST['inputCodigo']);  //...quita espacio en blanco ..
//		$codigoMaterial= $codigoSinEspacio; 			//... lee codigo del material ...
		$fechaInicial= $_POST['inputFechaInicial']; 		//... lee fecha inicial ...
		$fechaFinal= $_POST['inputFechaFinal']; 			//... lee fecha final ...
		
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoDeposito=$this->session->userdata('usuarioDeposito');
		$permisoProceso4=$this->session->userdata('usuarioProceso4');
		if($permisoUserName!='superuser' ){  //... valida permiso de userName ...	
			if($permisoMenu!='inventarios' || $permisoDeposito!=$nombreDeposito){	//... valida permiso de menu y de deposito ...
				redirect('menuController/index');
			}
			
			if( $permisoProceso4==false ){   //... valida permiso de proceso ...
				redirect('menuController/index');
			}
		}
		//... fin control de permisos de acceso ....
		
		$this->load->model("tablaGenerica_model");	//...carga el modelo tabla 
        // Se carga la libreria fpdf
        $this->load->library('inventarios/FisicoValorado');
 
        // Se obtienen los registros de la base de datos
        
        $sql ="DELETE FROM inventarioaux";				//... borra los registros anteriores de INVENTARIOaux antes de cargar los de la nueva consulta... 
 		$result = $this->db->query($sql);
		
		$sqlSalida="SELECT T1.idMaterial AS codSalida,SUM(T1.cantidad) AS salida FROM salalmacen AS T1,salidaalmacencabecera AS T3 WHERE T1.numSal=T3.numero AND T3.fecha>='$fechaInicial' AND T3.fecha<='$fechaFinal' GROUP BY T1.idMaterial";
		$resultSalida = $this->db->query($sqlSalida);
		foreach ($resultSalida->result() as $material) {                 //... carga registros en la tabla inventarioaux ...
			$registroSalida=array(
	       		"ideMaterial"=>$material->codSalida,
	       		"ingreso"=>0.00,
	        	"salida"=>$material->salida
       		);                  
            $this-> tablaGenerica_model -> grabar('inventarioaux',$registroSalida);      
        };
		
		$sqlIngreso="SELECT T2.idMaterial AS codIngreso,SUM(T2.cantidad) AS ingreso FROM ingalmacen as T2,ingresoalmacencabecera AS T4 WHERE T2.numIng=T4.numero AND T4.fecha>='$fechaInicial' AND T4.fecha<='$fechaFinal' GROUP BY T2.idMaterial";
		$resultIngreso = $this->db->query($sqlIngreso);
		foreach ($resultIngreso->result() as $material) {                 //... carga registros en la tabla inventarioaux ...
		
			$regInventarioAux= $this->tablaGenerica_model->buscar('inventarioaux','ideMaterial',$material->codIngreso); //..una vez cargado el modelo de la tabla llama cotizacioncabecera..
		//	$codInventarioAux= $regInventarioAux["ideMaterial"];	// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
	
			$codInventarioAux= str_replace(" ","",$codInventarioAux);  //...quita espacio en blanco ..
			
			if($regInventarioAux== NULL){
				$registroIngreso=array(
	       			"ideMaterial"=>$material->codIngreso,
	       			"ingreso"=>$material->ingreso,
	        		"salida"=>0.00
       			);                  
            	$this-> tablaGenerica_model -> grabar('inventarioaux',$registroIngreso); 
			}
			else{
				$registroIngreso=array(
	       			"ideMaterial"=>$material->codIngreso,
	       			"ingreso"=>$material->ingreso
       			);
				$this-> tablaGenerica_model -> editarRegistro('inventarioaux','ideMaterial',$material->codIngreso,$registroIngreso);
			}
			  	   
        };
		
 		$sql ="SELECT * FROM inventarioaux  ORDER BY ideMaterial";
 		$result = $this->db->query($sql);
 		
 		$contador= $result->num_rows; //...contador de registros que satisfacen la consulta ..
 		
 		if($contador==0){
			$datos['mensaje']='No hay registros entre la fecha inicial '.fechaMysqlParaLatina($fechaInicial).' y la fecha final '.fechaMysqlParaLatina($fechaFinal).' seleccionadas.';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
 		}else{
 			// Creacion del PDF
	        /*
	        * Se crea un objeto de la clase SalAlmacenPdf, recordar que la clase Pdf
	        * heredó todos las variables y métodos de fpdf
	        */
	         
	        ob_clean(); // cierra si es se abrio el envio de pdf...
	        $this->pdf = new FisicoValorado();
			
			//$this->pdf->descripcionMaterial=$descripcionMaterial;      			//...pasando variable para el header del PDF
			$this->pdf->fechaInicial=fechaMysqlParaLatina($fechaInicial); 		//...pasando variable para el header del PDF
			$this->pdf->fechaFinal=fechaMysqlParaLatina($fechaFinal); 			//...pasando variable para el header del PDF
			
	        // Agregamos una página
	        $this->pdf->AddPage();
	        // Define el alias para el número de página que se imprimirá en el pie
	        $this->pdf->AliasNbPages();
	 
	        /* Se define el titulo, márgenes izquierdo, derecho y
	         * el color de relleno predeterminado
	         */
	         
	        $this->pdf->SetLeftMargin(10);
	        $this->pdf->SetRightMargin(10);
	        $this->pdf->SetFillColor(200,200,200);
	 
	        // Se define el formato de fuente: Arial, negritas, tamaño 9
	        //$this->pdf->SetFont('Arial', 'B', 9);
	        $this->pdf->SetFont('Arial', '', 7);
	        
	        // La variable $numeroAnterior se utiliza para hacer corte de control por número salida
	        $grupoAnterior ='';			// ... para hacer corte de control por diferencia de grupo ...
		    $totalGral=0; //... acumula los importes de todos los materiales...
			$totalPorGrupo=0; //... acumula los importes de cada material por grupo...
	        foreach ($result->result() as $salida) {

	            // Se imprimen los datos de cada registro
	            if(($grupoAnterior !='') &&  ($grupoAnterior !=substr( ($salida->ideMaterial),0,3 ) ) ){   //...corte de control numero Ingreso   	
		        	$this->pdf->Ln(5);  //Se agrega un salto de linea
	        		$this->pdf->Cell(147,5,'','',0,'L',0);
	        		$this->pdf->Cell(42,5,'Subtotal grupo Bs. '.number_format($totalPorGrupo,2),0,0,'R');
					$totalGral=$totalGral + $totalPorGrupo; 
					$totalPorGrupo=0; //... inicializa en cero acumulador...
					//Se agrega dos saltos de linea
	        		$this->pdf->Ln(5);
					$this->pdf->Ln(5);
	        	
					$grupoAnterior=substr( ($salida->ideMaterial),0,3 );	
					
					//Se agrega un salto de linea
		        	$this->pdf->Ln(5);
					
		        }
	            
	            			
				$sqlAlmacen="SELECT nombreInsumo, existencia, unidad, precioUnidad FROM almacen  WHERE codInsumo='$salida->ideMaterial' ";
				$resultAlmacen=$this->db->query($sqlAlmacen);
				
				foreach ($resultAlmacen->result() as $regAlmacen) {                 //... carga registros en la tabla inventarioaux ...
			       	$descripcionMaterial=$regAlmacen->nombreInsumo;
					$existenciaMaterial=$regAlmacen->existencia;
			       	$unidadMaterial=$regAlmacen->unidad;
			        $precioUnidadMaterial=$regAlmacen->precioUnidad;
		       		     
		        };
		
		
				$sqlI ="SELECT idMaterial,fecha,numFactura,cantidad FROM ingalmacen,ingresoalmacencabecera WHERE idMaterial='$salida->ideMaterial' AND numIng=numero AND fecha>='$fechaInicial' ORDER BY fecha";
		 		$resultI = $this->db->query($sqlI);
				
				$qIngreso=0;												//... acumula cantidad ingresada ...
				foreach ($resultI->result() as $material) {                 //... carga registros de la tabla ingAlmacen ...
					$qIngreso= $qIngreso + $material->cantidad;        
		        };
				
				$sqlS ="SELECT idMaterial,fecha,numSal,numOrden,cantidad,glosa FROM salalmacen,salidaalmacencabecera WHERE idMaterial='$salida->ideMaterial' AND numSal=numero AND fecha>='$fechaInicial' ORDER BY fecha";
		 		$resultS = $this->db->query($sqlS);
				
				$qSalida=0;												//... acumula cantidad salida ...
				foreach ($resultS->result() as $material) {                  //... carga registros de la tabla salAlmacen ...
					$qSalida=$qSalida + $material->cantidad;
		        };
				
				$saldoAnterior= $existenciaMaterial - ($qIngreso - $qSalida);					//... calcula el saldo anterior ...
				
				$this->pdf->Cell(1,5,$salida->ideMaterial,'',0,'L',0);
				$this->pdf->Cell(13,5,' ','',0,'L',0);
				$this->pdf->Cell(65,5,$descripcionMaterial,'',0,'L',0);
				$this->pdf->Cell(9,5,' ','',0,'L',0);
				$this->pdf->Cell(10,5,number_format($saldoAnterior,2),'',0,'R',0);
				$this->pdf->Cell(5,5,' ','',0,'L',0);
				$this->pdf->Cell(10,5,number_format($salida->ingreso,2),'',0,'R',0);
				$this->pdf->Cell(5,5,' ','',0,'L',0);
	            $this->pdf->Cell(10,5,number_format($salida->salida ,2),'',0,'R',0);
				$this->pdf->Cell(5,5,' ','',0,'L',0);
				$this->pdf->Cell(10,5,number_format($saldoAnterior +$salida->ingreso-$salida->salida ,2),'',0,'R',0);
				$this->pdf->Cell(3,5,' ','',0,'L',0);
				$this->pdf->Cell(7,5,$unidadMaterial,'',0,'L',0);
				$this->pdf->Cell(5,5,' ','',0,'L',0);
				$this->pdf->Cell(13,5,number_format($precioUnidadMaterial,2),'',0,'R',0);
				$this->pdf->Cell(5,5,' ','',0,'L',0);
				$this->pdf->Cell(13,5,number_format($precioUnidadMaterial * ($saldoAnterior +$salida->ingreso-$salida->salida),2),'',0,'R',0);

				$totalPorGrupo=$totalPorGrupo +( $precioUnidadMaterial * ($saldoAnterior +$salida->ingreso-$salida->salida) ); //... acumula los importes de cada nota de ingreso...
				$grupoAnterior=substr( ($salida->ideMaterial),0,3 );	  
	            //Se agrega un salto de linea
	            $this->pdf->Ln(5);
	        }

			$this->pdf->Ln(5);
			$this->pdf->Cell(147,5,'','',0,'L',0);
    		$this->pdf->Cell(42,5,'Subtotal por grupo Bs. '.number_format($totalPorGrupo,2),0,0,'R');
			$totalGral=$totalGral + $totalPorGrupo; 
			
			$this->pdf->Ln(5);
			$this->pdf->Ln(5);
			$this->pdf->Cell(145,5,'','',0,'L',0);
    		$this->pdf->Cell(44,5,'Total Gral. Bs. '.number_format($totalGral,2),0,0,'R');

	        
	         /* PDF Output() settings
	         * Se manda el pdf al navegador
	         *
	         * $this->pdf->Output(nombredelarchivo, destino);
	         *
	         * I = Muestra el pdf en el navegador
	         * D = Envia el pdf para descarga
			 * F: save to a local file
			 * S: return the document as a string. name is ignored.
			 * $pdf->Output(); //default output to browser
			 * $pdf->Output('D:/example2.pdf','F');
			 * $pdf->Output("example2.pdf", 'D');
			 * $pdf->Output('', 'S'); //... Returning the PDF file content as a string:
	         */
	  
	  		$this->pdf->Output('pdfsArchivos/inventarios/fisicoValorado.pdf', 'F');
	  		
			$datos['documento']="pdfsArchivos/inventarios/fisicoValorado.pdf";	
			$datos['titulo']=(' Inventarios Físico Valorado');	// ... titulo ...
			$datos['fechaInicial']=fechaMysqlParaLatina($fechaInicial);
			$datos['fechaFinal']=fechaMysqlParaLatina($fechaFinal);
			$this->load->view('header');
			$this->load->view('reportePdf',$datos );
			$this->load->view('footer');	
 		}
        
	} //... fin funcion: generarReporte fisicoValorado ...
	
	
//... fin funciones reportes PDF ...
////////////////////////////////////


	public function fechaReporteMensualSalida(){
		$nombreDeposito= $_GET['nombreDeposito']; //... lee nombreDeposito que viene del menu principal(salida de  almacen/bodega ) ...		
		$tipoTransaccion= $_GET['tipoTransaccion']; //... lee tipoTransaccion que viene del menu principal(salida de  almacen/bodega ) ...		
		
		$datos['nombreDeposito']=$nombreDeposito;
		$datos['tipoTransaccion']=$tipoTransaccion;
		$this->load->view('header');
		$this->load->view('inventarios/fechaReporteMensualSalida',$datos );
		$this->load->view('footer');
	}

	public function materialPorNumeroOrden(){
		$nombreDeposito= $_GET['nombreDeposito']; //... lee nombreDeposito que viene del menu principal(salida de  almacen/bodega ) ...		
		$tipoTransaccion= $_GET['tipoTransaccion']; //... lee tipoTransaccion que viene del menu principal(salida de  almacen/bodega ) ...		
		
		$datos['nombreDeposito']=$nombreDeposito;
		$datos['tipoTransaccion']=$tipoTransaccion;
		$this->load->view('header');
		$this->load->view('inventarios/materialPorNumeroOrden',$datos );
		$this->load->view('footer');
	}
	
	public function generarReporteMensualsalida(){
		//... genera reporte de salida mensual de materiales en PDF
		
		$nombreDeposito= $_POST['nombreDeposito']; //... lee nombreDeposito que viene del menu principal(salida de  almacen/bodega ) ...
		
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoDeposito=$this->session->userdata('usuarioDeposito');
		$permisoProceso3=$this->session->userdata('usuarioProceso3');
		if($permisoUserName!='superuser' ){  //... valida permiso de userName ...
			if($permisoMenu!='inventarios' || $permisoDeposito!=$nombreDeposito){	//... valida permiso de menu y de deposito ...
				redirect('menuController/index');
			}
			
			if( $permisoProceso3==false ){   //... valida permiso de proceso ...
				redirect('menuController/index');
			}
		}
		//... fin control de permisos de acceso ....
		
				
		$tipoTransaccion= $_POST['tipoTransaccion']; //... lee tipoTransaccion				
		$fechaInicial=$_POST['inputFechaInicial']; //... viene de la vista fechasReporteSalida ...
		
		// Se carga la libreria fpdf
		$this->load->library('inventarios/ReporteMensualSalidaPdf');
 
		// Se obtienen los registros de la base de datos
		//$salidas = $this->db->query('SELECT t1.numSal, fecha,numOrden, glosa,idMaterial,nombreInsumo, cantidad,unidad,tipoInsumo FROM '.$salidaMaterial.' t1, '.$salidaCabecera.' t2, '.$maestroMaterial.' t3 WHERE t1.numSal = t2.numero AND  t1.idMaterial=t3.codInsumo ORDER BY t1.numSal');
		$parteFecha=explode("-",$fechaInicial); // ... Esto da un arreglo en el que $parteFecha[0] es el año, $parteFecha[1] el mes y $parteFecha[2] el día...formato yyyy-mm-dd
		$mes=$parteFecha[1];
		$anho=$parteFecha[0];
		
		
		$sql="SELECT idMaterial,nombreInsumo,SUM(cantidad) AS cantidadSumada,unidad,precioUnidad FROM salalmacen,salidaalmacencabecera,almacen WHERE numSal=numero AND YEAR(fecha)= '$anho' AND MONTH(fecha)='$mes' AND idMaterial=codInsumo GROUP BY idMaterial";
		
 		$salidas = $this->db->query($sql);

 		$contador= $salidas->num_rows; //...contador de registros que satisfacen la consulta ..
 		

		if($contador==0){
			$datos['mensaje']='No hay registros en el mes de '.mesLiteral((int)$parteFecha[1]).' del año '.$parteFecha[0].' de la fecha seleccionada.';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}else{
			// Creacion del PDF
		    /*
		    * Se crea un objeto de la clase SalAlmacenPdf, recordar que la clase Pdf
		    * heredó todos las variables y métodos de fpdf
		    */
		     
		    ob_clean(); // cierra si es se abrio el envio de pdf...
		    $this->pdf = new ReporteMensualSalidaPdf();
			
			$this->pdf->nombreDeposito=strtoupper($nombreDeposito);      	//...pasando variable para el header del PDF
			$this->pdf->fechaInicial=fechaMysqlParaLatina($fechaInicial); 	//...pasando variable para el header del PDF
			$this->pdf->mes=mesLiteral((int)$parteFecha[1]);						//...pasando variable para el header del PDF funcion helper
			$this->pdf->anho=$parteFecha[0];								//...pasando variable para el header del PDF
			
		    // Agregamos una página
		    $this->pdf->AddPage();
		    // Define el alias para el número de página que se imprimirá en el pie
		    $this->pdf->AliasNbPages();
		 
		    /* Se define el titulo, márgenes izquierdo, derecho y
		    * el color de relleno predeterminado
		    */
		         
	        $this->pdf->SetLeftMargin(10);
	        $this->pdf->SetRightMargin(10);
	        $this->pdf->SetFillColor(200,200,200);
	 
		    // Se define el formato de fuente: Arial, negritas, tamaño 9
		    //$this->pdf->SetFont('Arial', 'B', 9);
		    $this->pdf->SetFont('Arial', '', 9);
		    
		    // La variable $numeroAnterior se utiliza para hacer corte de control por número salida
		    $grupoAnterior ='';			// ... para hacer corte de control por diferencia de grupo ...
		    $totalGral=0; //... acumula los importes de todos los materiales...
			$totalPorGrupo=0; //... acumula los importes de cada material...
		    foreach ($salidas->result() as $salida) {
		        // se imprime el numero actual y despues se incrementa el valor de $x en uno
		        // Se imprimen los datos de cada registro
		        
	        	if(($grupoAnterior !='') &&  ($grupoAnterior !=substr( ($salida->idMaterial),0,3 ) ) ){   //...corte de control numero Ingreso   	
		        	$this->pdf->Ln(5);  //Se agrega un salto de linea
	        		$this->pdf->Cell(147,5,'','',0,'L',0);
	        		$this->pdf->Cell(40,5,'Subtotal grupo Bs. '.number_format($totalPorGrupo,2),0,0,'R');
					$totalGral=$totalGral + $totalPorGrupo; 
					$totalPorGrupo=0; //... inicializa en cero acumulador...
					//Se agrega dos saltos de linea
	        		$this->pdf->Ln(5);
					$this->pdf->Ln(5);
	        	
					$grupoAnterior=substr( ($salida->idMaterial),0,3 );	
					
					//Se agrega un salto de linea
		        	$this->pdf->Ln(5);
					
		        }
		          
		        //$this->pdf->Cell(12,5,'','',0,'L',0);
				$this->pdf->Cell(15,5,$salida->idMaterial,'',0,'L',0);
				$this->pdf->Cell(73,5,$salida->nombreInsumo,'',0,'L',0);
		        $this->pdf->Cell(39,5,number_format($salida->cantidadSumada,2),'',0,'R',0);
				$this->pdf->Cell(20,5,$salida->unidad,'',0,'C',0);
				$this->pdf->Cell(19,5,number_format($salida->precioUnidad,2),'',0,'R',0);
				$this->pdf->Cell(21,5,number_format($salida->cantidadSumada*$salida->precioUnidad,2),'',0,'R',0);
				
				$totalPorGrupo=$totalPorGrupo +( $salida->cantidadSumada*$salida->precioUnidad ); //... acumula los importes de cada nota de ingreso...
				$grupoAnterior=substr( ($salida->idMaterial),0,3 );	        
		        
		        //Se agrega un salto de linea
		        $this->pdf->Ln(5);
		    }
				$this->pdf->Ln(5);
				$this->pdf->Cell(145,5,'','',0,'L',0);
	    		$this->pdf->Cell(42,5,'Subtotal por grupo Bs. '.number_format($totalPorGrupo,2),0,0,'R');
				$totalGral=$totalGral + $totalPorGrupo; 
				
				$this->pdf->Ln(5);
				$this->pdf->Ln(5);
				$this->pdf->Cell(145,5,'','',0,'L',0);
	    		$this->pdf->Cell(42,5,'Total Gral. Bs. '.number_format($totalGral,2),0,0,'R');
	
	
			     /* PDF Output() settings
			     * Se manda el pdf al navegador
			     *
			     * $this->pdf->Output(nombredelarchivo, destino);
			     *
			     * I = Muestra el pdf en el navegador
			     * D = Envia el pdf para descarga
				 * F: save to a local file
				 * S: return the document as a string. name is ignored.
				 * $pdf->Output(); //default output to browser
				 * $pdf->Output('D:/example2.pdf','F');
				 * $pdf->Output("example2.pdf", 'D');
				 * $pdf->Output('', 'S'); //... Returning the PDF file content as a string:
			     */
			  
			  	$this->pdf->Output('pdfsArchivos/reporteMensualSalida.pdf', 'F');
				
				$datos['documento']="pdfsArchivos/reporteMensualSalida.pdf";	
				$datos['nombreDeposito']=$nombreDeposito;	// ...  almacen/bodega ...
				$datos['tipoTransaccion']=$tipoTransaccion;	// ... ingreso/salida ...
				$datos['mes']=mesLiteral((int)$parteFecha[1]);
				$datos['anho']=$anho;
				$this->load->view('header');
				$this->load->view('inventarios/reporteMensualSalidaPdf',$datos );
				$this->load->view('footer');	
			}
	    
	} //... fin funcion: generarReporteMensualsalida ...
	
	
	public function listadoExistencias(){
		$sql="SELECT codInsumo, nombreInsumo FROM almacen WHERE unidad=''"; //... selecciona grupo para listado de existencias ...		
		$grupos=$this->db->query($sql);	
		
		$datos['grupos']=$grupos;
		$this->load->view('header');
		$this->load->view('inventarios/listadoExistenciasGrupo',$datos );
		$this->load->view('footer');
	}		//... fin  listadoExistencias ...
	
	
	public function generarListadoExistencias(){
		//... genera listadoExistencias por grupo en PDF
		$posicionSeparador = strpos($_POST['grupo'], '|');
		$codGrupo= substr($_POST['grupo'],0,$posicionSeparador); //... lee codigo de grupo ...
		$nombreGrupo= substr($_POST['grupo'],$posicionSeparador+1,strlen($_POST['grupo'])); //... lee nombre de grupo ...
		
		// Se carga la libreria fpdf
		$this->load->library('inventarios/ListadoExistenciasGrupoPdf');
		
		// Se obtienen los registros de la base de datos
		$sql="SELECT codInsumo,nombreInsumo,unidad,existencia FROM almacen  WHERE codInsumo LIKE '$codGrupo%'";
		
		$registros = $this->db->query($sql);
		 
		$contador= $registros->num_rows; //...contador de registros que satisfacen la consulta ..
		
		if($contador==0){
			$datos['mensaje']='No hay registros en la tabla ALMACEN';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}else{
			// Creacion del PDF
		    /*
		    * Se crea un objeto de la clase SalAlmacenPdf, recordar que la clase Pdf
		    * heredó todos las variables y métodos de fpdf
		    */
		     
		    ob_clean(); // cierra si es se abrio el envio de pdf...
		    $this->pdf = new ListadoExistenciasGrupoPdf();
			$this->pdf->nombreGrupo=$nombreGrupo; 										//...pasando variable para el header del PDF
		    // Agregamos una página
		    $this->pdf->AddPage();
		    // Define el alias para el número de página que se imprimirá en el pie
		    $this->pdf->AliasNbPages();
		 
		    /* Se define el titulo, márgenes izquierdo, derecho y
		    * el color de relleno predeterminado
		    */
		         
		    // Se define el formato de fuente: Arial, negritas, tamaño 9
		    //$this->pdf->SetFont('Arial', 'B', 9);
		    $this->pdf->SetFont('Arial', '', 8);
		    $espacio=1; 			//... epacio variable para imprimir ...
		    foreach ($registros->result() as $registro) {
		        // Se imprimen los datos de cada registro
		       	
	        	//$this->pdf->Cell(12,5,$registro->cuenta,'',0,'L',0);
				$this->pdf->Cell($espacio,2,'','',0,'L',0);
				$this->pdf->Cell(10,5,$registro->codInsumo,'',0,'L',0);
				$this->pdf->Cell(5,5,'','',0,'L',0);
				$this->pdf->Cell(85,5,utf8_decode(substr($registro->nombreInsumo,0,55)),'',0,'L',0);
	       		$this->pdf->Cell(15,5,utf8_decode($registro->unidad),'',0,'L',0);
				$this->pdf->Cell(5,5,'','',0,'L',0);
				$this->pdf->Cell(15,5,number_format($registro->existencia,2),'',0,'R',0);
				$this->pdf->Cell(15,5,'','',0,'L',0);
				$this->pdf->Cell(5,5,'__________','',0,'L',0);
				//Se agrega un salto de linea
	        	$this->pdf->Ln(5);	
		    }
				
			     /* PDF Output() settings
			     * Se manda el pdf al navegador
			     *
			     * $this->pdf->Output(nombredelarchivo, destino);
			     *
			     * I = Muestra el pdf en el navegador
			     * D = Envia el pdf para descarga
				 * F: save to a local file
				 * S: return the document as a string. name is ignored.
				 * $pdf->Output(); //default output to browser
				 * $pdf->Output('D:/example2.pdf','F');
				 * $pdf->Output("example2.pdf", 'D');
				 * $pdf->Output('', 'S'); //... Returning the PDF file content as a string:
			     */
			  
			  	$this->pdf->Output('pdfsArchivos/inventarios/listadoExistenciasGrupo.pdf', 'F');
				
				$datos['documento']="pdfsArchivos/inventarios/listadoExistenciasGrupo.pdf";	
				$datos['titulo']=' Listado Existencias por Grupo: '.$nombreGrupo;	// ... titulo ...
				
				$this->load->view('header');
				$this->load->view('reportePdfSinFechas',$datos );
				$this->load->view('footer');
			}
			 
	} //... fin funcion: generarListadoexistencias ...
	
	
	public function reponerMateriales(){
		//... genera reporte de reposicion de maetriales en PDF
		
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoProceso3=$this->session->userdata('usuarioProceso3');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='inventarios'){  //... valida permiso de userName y de menu...
			$datos['mensaje']='Usuario NO autorizado para operar el sistema de Inventarios';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}	//... fin control de permisos de acceso ....
		else {		//... usuario validado ...
			// Se carga la libreria fpdf
			$this->load->library('inventarios/ReposicionMaterialesPdf');
			
			// Se obtienen los registros de la base de datos
			$sql="SELECT codInsumo,nombreInsumo,existencia,unidad,stockMinimo FROM almacen WHERE stockMinimo>0 AND existencia<=(stockMinimo*1.20)";
			
			$registros = $this->db->query($sql);
			 
			$contador= $registros->num_rows; //...contador de registros que satisfacen la consulta ..
			
			if($contador==0){
				$datos['mensaje']='No hay registros en la tabla de ALMACEN.';
				$this->load->view('header');
				$this->load->view('mensaje',$datos );
				$this->load->view('footer');
			}else{
				// Creacion del PDF
			    /*
			    * Se crea un objeto de la clase SalAlmacenPdf, recordar que la clase Pdf
			    * heredó todos las variables y métodos de fpdf
			    */
			     
			    ob_clean(); // cierra si es se abrio el envio de pdf...
			    $this->pdf = new ReposicionMaterialesPdf();
				
			    // Agregamos una página
			    $this->pdf->AddPage();
			    // Define el alias para el número de página que se imprimirá en el pie
			    $this->pdf->AliasNbPages();
			 
			    /* Se define el titulo, márgenes izquierdo, derecho y
			    * el color de relleno predeterminado
			    */
			         
			    // Se define el formato de fuente: Arial, negritas, tamaño 9
			    //$this->pdf->SetFont('Arial', 'B', 9);
			    $this->pdf->SetFont('Arial', '', 8);
			    $espacio=1; 			//... epacio variable para imprimir ...
			    foreach ($registros->result() as $registro) {
			        // Se imprimen los datos de cada registro
			       	
		        	//$this->pdf->Cell(12,5,$registro->cuenta,'',0,'L',0);
					$this->pdf->Cell($espacio,5,'','',0,'L',0);
					$this->pdf->Cell(2,5,$registro->codInsumo,'',0,'L',0);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(80,5,utf8_decode($registro->nombreInsumo),'',0,'L',0);
					$this->pdf->Cell(10,5,'','',0,'L',0);
		       		$this->pdf->Cell(20,5,number_format($registro->existencia,2),'',0,'R',0);
					$this->pdf->Cell(10,5,'','',0,'L',0);
					$this->pdf->Cell(20,5,number_format($registro->stockMinimo,2),'',0,'R',0);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(15,5,utf8_decode($registro->unidad),'',0,'L',0);
					//Se agrega un salto de linea
		        	$this->pdf->Ln(5);	
			    }
					
				     /* PDF Output() settings
				     * Se manda el pdf al navegador
				     *
				     * $this->pdf->Output(nombredelarchivo, destino);
				     *
				     * I = Muestra el pdf en el navegador
				     * D = Envia el pdf para descarga
					 * F: save to a local file
					 * S: return the document as a string. name is ignored.
					 * $pdf->Output(); //default output to browser
					 * $pdf->Output('D:/example2.pdf','F');
					 * $pdf->Output("example2.pdf", 'D');
					 * $pdf->Output('', 'S'); //... Returning the PDF file content as a string:
				     */
				  
				  	$this->pdf->Output('pdfsArchivos/inventarios/reposicionMateriales.pdf', 'F');
					
					$datos['documento']="pdfsArchivos/inventarios/reposicionMateriales.pdf";	
					$datos['titulo']=' Reposición de Materiales';	// ... titulo ...
					
					$this->load->view('header');
					$this->load->view('reportePdfSinFechas',$datos );
					$this->load->view('footer');
				}
			}	//.. fin IF validar usuario ...
	    
	} //... fin funcion: reponerMateriales ...
	
	
	public function archivoExcel(){
		$this->load->model("TablaGenerica_model");
		to_excel($this->TablaGenerica_model->getParaExcel('kardexmaterial'),"archivoexcel" );
	}
	
	
	public function salidaMaterialProducto(){
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoDeposito=$this->session->userdata('usuarioDeposito');
		$permisoProceso2=$this->session->userdata('usuarioProceso1');
		if( $permisoUserName!='superuser' && $permisoUserName!='developer'   &&  $permisoDeposito!=$nombreDeposito ){  //... valida permiso de userName ...
			$datos['mensaje']='Usuario NO autorizado para operar Sistema de Inventarios';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');	
		}	//... fin control de permisos de acceso ....	
		else{
			$tipoProducto= $_POST['tipoProducto']; 			//... lee tipoProducto ...
			$orden= $_POST['inputOrden']; 					//... lee inputOrden ...	
			$trabajador= $_POST['inputTrabajador']; 		//... lee inputTrabajador ...	
			$codigoProducto= str_replace(" ","",$_POST['codigoProducto']); 		//... lee codigoProducto ...	
			$cantidadProducto= $_POST['cantidadProducto']; 	//... lee cantidadProducto ...	
			$nombreDeposito='almacen'; //... nombreDeposito ...	
				
			$this->load->model("inventarios/numeroIngresoSalida_model");
			$prefijoTabla='nosal'; // ... prefijoTabla
	    	$salida = $this->numeroIngresoSalida_model->getNumero('almacen', $prefijoTabla);
					
			if($tipoProducto=='acabado'){			//... tipoProducto=='acabado' ...
				$sql="SELECT codMat,nombreInsumo,existencia,cantidad,unidad FROM prodacabadoplantilla,almacen WHERE codPro='$codigoProducto' AND codMat=codInsumo";
			}else{									//... tipoProducto=='blanco' ...
				$sql="SELECT codMat,nombreInsumo,existencia,cantidad,unidad FROM prodblancoplantilla,almacen WHERE codPro='$codigoProducto' AND codMat=codInsumo";
			}
			
			$regPlantilla=mysql_query($sql);
			$nRegistrosPlantilla= mysql_num_rows($regPlantilla); 	//... numero registros salida que satisfacen la consulta ...
					
			$datos['regPlantilla']=$regPlantilla;
			$datos['nRegistrosPlantilla']=$nRegistrosPlantilla;	
	
			$datos['orden']=$orden;		
			$datos['trabajador']=$trabajador;
			$datos['cantidadProducto']=$cantidadProducto;	
			$datos['nombreDeposito']=$nombreDeposito;
			$datos['titulo']='Almacén Prod. '.$tipoProducto;
			$datos['salida']=$salida;
	
			$this->load->view('header');
			$this->load->view('inventarios/salida_materialAcabadoBlanco',$datos);
			$this->load->view('footer');
		}	//... fin validar usuario ...
	}	//... fin salidamaterialProducto ...

	 
	public function ubicarOrden(){
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		$permisoDeposito=$this->session->userdata('usuarioDeposito');
		
		if( $permisoUserName!='superuser' && $permisoUserName!='developer'   &&  $permisoDeposito!=$nombreDeposito ){  //... valida permiso de userName ...
			$datos['mensaje']='Usuario NO autorizado para operar Sistema de Inventarios';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}	//... fin control de permisos de acceso ....	
		else{
			$tipoProducto=$_GET['tipoProducto']; //... lee tipoProducto ...
			
			$this->load->model("tablaGenerica_model");	//...carga el modelo tabla 
	
			if($tipoProducto=='acabado'){				//... cuando tipoProducto=acabado ...
				$sql ="SELECT * FROM pedidoproducto WHERE estadoItem='P'";		//...selecciona registros que  han sido asignados ..
				$restoTitulo='Trabajo';
			}else{																//... cuando tipoProducto=blanco ...
				$sql ="SELECT * FROM ordenstock WHERE estado='P'";		//...selecciona registros que  han sido asignados ..
				$restoTitulo='Stock';
			}
			
			
//			$sql ="SELECT * FROM pedidoproducto WHERE estadoItem='P'";		//...selecciona registros que  han sido asignados ..


	 		$pedidos = $this->db->query($sql);
			
			
			$datos['tipoProducto']=$tipoProducto;
	      	$datos['pedidos']=$pedidos;
		
			$datos['titulo']='Datos Orden de '.$restoTitulo;
			$this->load->view('header');
			$this->load->view('inventarios/ubicarOrdenTrabajo',$datos );
			$this->load->view('footer');
		}	//..fin IF validar usuario...
	}	//... fin ubicarOrden ...
		
	
 	public function consultarStockAlmacenBodega(){
		$sql="SELECT a.codInsumo AS codigo,a.nombreInsumo AS material,a.existencia AS existenciaAlmacen,b.existencia AS existenciaBodega,a.unidad AS unidad FROM almacen AS a,bodega AS b WHERE a.codInsumo=b.codInsumo";
		$registros = $this->db->query($sql);
 		$contador= $registros->num_rows; //...contador de registros que satisfacen la consulta ..
		
		if($contador==0){  //...cuando NO hay registros ...
			$datos['mensaje']='No hay registros grabados en las tablas ALMACEN y BODEGA ';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}
		else{      //... cuando hay registros ...
			/* Se obtienen los registros a mostrar*/ 
	   		$datos['listaMaterial'] = $registros;
			
	 		/*Se llama a la vista para mostrar la información*/
			$this->load->view('header');
			$this->load->view('inventarios/consultarStockAlmacenBodega', $datos);
			$this->load->view('footer');
			
		}  // fin else cuando hay registros 
		
	} //... fin consultarStockAlmacenBodega
 
	
	
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */