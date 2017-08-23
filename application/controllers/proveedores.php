<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proveedores extends CI_Controller {

/*	
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
	
 */
 
 /*
  * 
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

*/
	
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
	
	
	public function crudProveedores(){
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoDeposito=$this->session->userdata('usuarioDeposito');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='proveedores' ){  //... valida permiso de userName ...
			$datos['mensaje']='Usuario NO autorizado para operar CRUD de Proveedores';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}	//... fin control de permisos de acceso ....
		else {		//... usuario validado ...
			$this->load->model("tablaGenerica_model");
			
			/* URL a la que se desea agregar la paginación*/
	    	$config['base_url'] = base_url().'proveedores/crudProveedores';
			
			/*Obtiene el total de registros a paginar */
	    	$config['total_rows'] = $this->tablaGenerica_model->get_total_registros('proveedores');
			
			$contador= $config['total_rows'];
			
			if($contador==0){  //...cuando NO hay registros ...
				$datos['mensaje']='No hay registros grabados en la tabla PROVEEDORES';
				$this->load->view('header');
				$this->load->view('mensaje',$datos );
				$this->load->view('footer');
			}
			else{      //... cuando hay registros ...
			
				$nuevoCodigoProveedor ='';
				$rs = mysql_query("SELECT MAX(codProveedor) AS ultimoCodigoProveedor FROM proveedores");
				if ($row = mysql_fetch_row($rs)) {
					$ultimoCodigoProveedor = trim($row[0]);
				}
				
				$nuevoCodigoProveedor =substr($ultimoCodigoProveedor,3,3)+1;
				$nuevoCodigoProveedor ='prv'.$nuevoCodigoProveedor;
			
			
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
				
				$datos['listaProveedor'] = $this->tablaGenerica_model->get_registros('proveedores',$config['per_page'], $desde); 
			
				$datos['consultaProveedor'] ='';
				
				$datos['campoBusqueda'] ='codProveedor';
				
				$datos['nuevoCodigoProveedor'] =$nuevoCodigoProveedor;
				
		 		/*Se llama a la vista para mostrar la información*/
				$this->load->view('header');
				$this->load->view('proveedores/verProveedoresCrud', $datos);
				$this->load->view('footer');
				
			}  // fin else cuando hay registros 
		}	//... fin IF validar usuarios...
		
	} //... fin crudProveedores
	
	
	public function grabarNuevoProveedor(){
	//... graba un nuevoMaterial en tablas almacen y bodega ...
		$registro=array(
       		"codProveedor"=>$this->input->post("inputCodigo"),
        	"proveedor"=>$this->input->post("inputProveedor"),
        	"direccion"=>$this->input->post("inputDireccion"),
        	"ciudad"=>$this->input->post("inputCiudad"),
        	"telefono"=>$this->input->post("inputTelefono"),
        	"correoElectronico"=>$this->input->post("inputCorreo"),
        	"sitioWeb"=>$this->input->post("inputWeb")
       	);

		$this-> load -> model("tablaGenerica_model");
   		$this-> tablaGenerica_model -> grabar('proveedores',$registro);
	
   		redirect('proveedores/crudProveedores');  //...vuelve a la vista: verProveedoresCrud ...
	}	//... fin: grabarNuevoProveedor ...
	 
	
	public function actualizarProveedor(){
		//... edita registro de la tabla [proveedores] ...
		$codigoProveedor=$this->input->post("inputCodigoM");
		
		$registro=array(
        	"proveedor"=>$this->input->post("inputProveedorM"),
        	"direccion"=>$this->input->post("inputDireccionM"),
        	"ciudad"=>$this->input->post("inputCiudadM"),
        	"telefono"=>$this->input->post("inputTelefonoM"),
        	"correoElectronico"=>$this->input->post("inputCorreoM"),
        	"sitioWeb"=>$this->input->post("inputWebM")
       	);
				
		$this-> load -> model("tablaGenerica_model");
   		$this-> tablaGenerica_model -> editarRegistro('proveedores','codProveedor',$codigoProveedor,$registro);
 
//		$data=base_url("proveedores/crudProveedores");
//		echo $data;
	}
	
	
	public function eliminarProveedor(){
		//... elimina registro de las tablas [almacen/bodega] ...
		$codigo=$_POST['codigo'];
		$this-> load -> model("tablaGenerica_model");
   		$this-> tablaGenerica_model -> eliminar('proveedores','codProveedor',$codigo);
		$data=base_url("proveedores/crudProveedores");
		echo $data;
	}		//... fin: eliminarProveedor ...
	
	
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

		
		
	
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */