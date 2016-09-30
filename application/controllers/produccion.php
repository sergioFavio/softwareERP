<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produccion extends CI_Controller {
	
	public function cotizar()
	{
		//$nombreDeposito= $_GET['nombreDeposito']; //... lee nombreDeposito que viene del menu principal(salida de  almacen/bodega ) ...		
		$nombreDeposito="almacen";
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='produccion'){  //... valida permiso de userName ...
			$datos['mensaje']='Usuario NO autorizado para operar Sistema de Producción';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
//			redirect('menuController/index');
		}	//... fin control de permisos de acceso ....
		else {		//... usuario validado ...
			$this->load->model("numeroDocumento_model");
			$nombreTabla='nocotizacion'; // ... prefijoTabla
	    	$pedido = $this->numeroDocumento_model->getNumero($nombreTabla);
			///////////////////////////////////////
			///...INICIO genera nuevo numero de pedido ...
			//////////////////////////////////////
			$anhoSistema = date("Y");	//... anho del sistema
			$mesSistema = date("m");	//... mes del sistema
			
			$anhoPedido= substr($pedido, 0, 4);  // toma los primeros 4 caracteres ... anho.
			$mesPedido= substr($pedido, 4, 2);  // toma los  caracteres ... mes.
			$secuenciaPedido= substr($pedido, 6, 2);  // toma los caracteres ... secuencia.
			if($anhoPedido==$anhoSistema){
				if($mesPedido==$mesSistema){
			        $secuenciaPedido=$secuenciaPedido +1;
					if(strlen($secuenciaPedido)==1){
						 $secuenciaPedido="0". $secuenciaPedido;
					}
			     		$pedido=$anhoSistema.$mesSistema.$secuenciaPedido;
				}
			                  else{
					$pedido=$anhoSistema.$mesSistema."01";
				}
			}
			else{
				$pedido=$anhoSistema.$mesSistema."01";
			}
			
			$ingreso=$pedido;  //... numero de comprobante ...
			
			$this->load->model("tablaGenerica_model");	//...carga el modelo tablaGenerica
			$insumos= $this->tablaGenerica_model->getTodos($nombreDeposito); //..una vez cargado el modelo de la tabla llama almacen/bodega..	
			$materialesArea= $this->tablaGenerica_model->getTodos('materialarea'); //..una vez cargado el modelo de la tabla llama materialArea..
			$trabajadores= $this->tablaGenerica_model->getTodos('prodmanoobra'); //..una vez cargado el modelo de la tabla llama prodmanoobra..
							
			$datos['titulo']=$nombreDeposito;
			$datos['ingreso']=$ingreso;
			$datos['insumos']=$insumos;	
			$datos['materialesArea']=$materialesArea;
			$datos['trabajadores']=$trabajadores;
			
			$datos['nombreDeposito']=$nombreDeposito;	// ... egreso: almacen/bodega ...
	
			$this->load->view('header');
			$this->load->view('produccion/cotizacion',$datos);
			$this->load->view('footer');
		}	//... fin IF validar usuario ...
	}	//... fin cotizar ...
	
	
	public function crearPlantillaProducto(){
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='produccion'){  //... valida permiso de userName ...
			$datos['mensaje']='Usuario NO autorizado para operar Sistema de Producción';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}	//... fin control de permisos de acceso ....
		else {		//... usuario validado ...
			$nombreDeposito= $_GET['nombreDeposito']; //...  nombreDeposito ( blanco/acabado ) ...		
			
			$this->load->model("produccion/consultasVarias_model");	
			$productos= $this->consultasVarias_model->productoDiferencia($nombreDeposito); 
			
			
			$this->load->model("inventarios/maestroMaterial_model");	//...carga el modelo tabla maestra[almacen/bodega]
			$insumos= $this->maestroMaterial_model->getTodos('almacen'); //..una vez cargado el modelo de la tabla llama almacen/bodega..
							
	      	$datos['productos']=$productos;	
			$datos['insumos']=$insumos;		
			$datos['nombreDeposito']=$nombreDeposito;	// ... egreso: almacen/bodega ...
	
			$this->load->view('header');
			$this->load->view('produccion/plantillaProducto',$datos);
			$this->load->view('footer');
		}	//... fin validar acceso usuario ...
	}	//... fin crearPlantillaProducto ...
	
	
	public function consultarProduccionProducto(){
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='produccion'){  //... valida permiso de userName ...
			$datos['mensaje']='Usuario NO autorizado para operar Sistema de Producción';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
//			redirect('menuController/index');
		}	//... fin control de permisos de acceso ....
		else {		//... usuario validado ...
			$nombreDeposito= $_GET['nombreDeposito']; //...  nombreDeposito ( blanco/acabado ) ...		
			
			$this->load->model("produccion/consultasVarias_model");	
			$productos= $this->consultasVarias_model->productoReunion($nombreDeposito); 
							
	      	$datos['productos']=$productos;		
			$datos['nombreDeposito']=$nombreDeposito;	// ... egreso: almacen/bodega ...
			$this->load->view('header');
			$this->load->view('produccion/produccionProducto',$datos);
			$this->load->view('footer');
		}	//... fin IF validar acceso usuario ...
	}	//... fin consultarproduccionProducto ...
	
	
	public function grabarPlantilla()
	{
		$nombreDeposito=$_POST['nombreDeposito']; //... formulario salidaMaterial [blanco/acabado] ...
				
		$numeroFilasValidas=$_POST['numeroFilas']; //... formulario salidaMaterial [blanco/acabado] ...
		
        for($i=0; $i<$numeroFilasValidas; $i++){
       		$codigoProductoSinEspacio=str_replace(" ","",$_POST['inputCodigo']); //...quita espacio en blanco ..
			$codigoSinEspacio=str_replace(" ","",$_POST['idMat_'.$i]); //...quita espacio en blanco ..
			
        	if($_POST['cantMat_'.$i] != "0" || $_POST['cantMat_'.$i] != "0.00"){
          	    //... si cantidad mayor que cero  graba registro ... 
          	    //... agrega registro tabla salalmacen ...      
	            $plantilla = array(
	            	"codPro"=>$codigoProductoSinEspacio,
				    "codMat"=>$codigoSinEspacio,
				    "cantidad"=>$_POST['cantMat_'.$i]
				);
				
				// ... inserta registro tabla transacciones[prodBlancoPlantilla/prodAcabadoPlantilla]
				$this-> load -> model("produccion/prodPlantilla_model");		//carga modelo [prodBlancoPlantilla/prodAcabadoPlantilla]
	    		$this-> prodPlantilla_model -> grabar($plantilla,$nombreDeposito);
					
								
				// ... fin de inserción  registro tabla transacciones y actualizacion tablas maestras almacen/bodega
				
			}	// ... fin IF
			
		}  // ... fin  FOR  
	
		redirect("produccion/crearPlantillaProducto?nombreDeposito=$nombreDeposito");
	}	//... fin grabarPlantilla
	
	
	
	public function grabarCotizacion()
	{		
		$numeroFilasValidas=$_POST['numeroFilas']; //... formulario materiales ...
		$numeroFilasValidasArea=$_POST['numeroFilasArea']; //... formulario materiales X area ...
		$numeroFilasValidasManoObra=$_POST['numeroFilasManoObra']; //... formulario mano de obra ...
		
		$numeroCotizacion=$_POST['numeroCotizacion'];
		
		$cotizacionCabecera = array(
	    	"numCotizacion"=>$numeroCotizacion,
		    "fecha"=>$_POST['inputFecha'],
		    "cliente"=>$_POST['inputCliente'],
		    "email"=>$_POST['inputEmail'],
		    "fonoCel"=>$_POST['inputTelCel']
		);
		
		// ... inserta registro tabla cotizacioncabecera ...
		$this-> load -> model("tablaGenerica_model");		//carga modelo ...
	    $this-> tablaGenerica_model -> grabar('cotizacioncabecera', $cotizacionCabecera);
		
        for($i=0; $i<$numeroFilasValidas; $i++){     			// ... formulario material
			$codigoSinEspacio=str_replace(" ","",$_POST['idMat_'.$i]); //...quita espacio en blanco ..
			
        	if($_POST['cantMat_'.$i] != "0" || $_POST['cantMat_'.$i] != "0.00"){
          	    //... si cantidad mayor que cero  graba registro ... 
          	    //... agrega registro tabla salalmacen ...      
	            $plantillaMaterial = array(
	            	"numeroCotizacion"=>$numeroCotizacion,
				    "codigoMaterial"=>$codigoSinEspacio,
				    "cantidadMaterial"=>$_POST['cantMat_'.$i],
				    "precioMaterial"=>$_POST['precioMat_'.$i]
				);
				
				// ... inserta registro tabla transacciones ... cotizacionmaterial 
				$this-> load -> model("tablaGenerica_model");		//carga modelo 
	    		$this-> tablaGenerica_model -> grabar('cotizacionmaterial',$plantillaMaterial);			
				// ... fin de inserción  registro tabla transacciones ... cotizacionmaterial
				
			}	// ... fin IF
			
		}  // ... fin  FOR 
		
		
		 for($i=0; $i<$numeroFilasValidasArea; $i++){     // ... formulario material X area
			$codigoSinEspacio=str_replace(" ","",$_POST['idMatArea_'.$i]); //...quita espacio en blanco ..
			
        	if($_POST['cantMatArea_'.$i] != "0" || $_POST['cantMatArea_'.$i] != "0.00"){
          	    //... si cantidad mayor que cero  graba registro ... 
          	    //... agrega registro tabla salalmacen ...      
	            $plantillaMaterial = array(
	            	"nuCotizacion"=>$numeroCotizacion,
				    "codMaterialArea"=>$codigoSinEspacio,
				    "largo"=>$_POST['largoMatArea_'.$i],
					"ancho"=>$_POST['anchoMatArea_'.$i],
				    "cantidadHoja"=>$_POST['cantMatArea_'.$i]
				);
				
				// ... inserta registro tabla transacciones ... cotizacionmaterial 
				$this-> load -> model("tablaGenerica_model");		//carga modelo 
	    		$this-> tablaGenerica_model -> grabar('cotizacionareamaterial',$plantillaMaterial);			
				// ... fin de inserción  registro tabla transacciones ... cotizacionareamaterial
				
			}	// ... fin IF
			
		}  // ... fin  FOR 
		
		
		for($i=0; $i<$numeroFilasValidasManoObra; $i++){     // ... formulario mano de obra
			$codigoSinEspacio=str_replace(" ","",$_POST['idEmpleado_'.$i]); //...quita espacio en blanco ..
			
        	if($_POST['cantHoras_'.$i] != "0" || $_POST['cantHoras_'.$i] != "0.00"){
          	    //... si cantidad mayor que cero  graba registro ... 
          	    //... agrega registro tabla salalmacen ...      
	            $plantillaManoObra = array(
	            	"numCotizacion"=>$numeroCotizacion,
				    "codEmpleado"=>$codigoSinEspacio,
				    "cantidadHoras"=>$_POST['cantHoras_'.$i],
				    "precioHora"=>$_POST['horaBs_'.$i]
				);
				
				// ... inserta registro tabla transacciones ... cotizacionmaterial 
				$this-> load -> model("tablaGenerica_model");		//carga modelo 
	    		$this-> tablaGenerica_model -> grabar('cotizacionmanoobra',$plantillaManoObra);			
				// ... fin de inserción  registro tabla transacciones ... cotizacionmanoobra
				
			}	// ... fin IF
			
		}  // ... fin  FOR 
		
		
		$plantillaValores = array(
        	"idCotizacion"=>$numeroCotizacion,
		    "manoObraDirecta"=>$_POST['totalManoObraDirecta'],
		    "manoObraIndirecta"=>$_POST['totalManoObraIndirecta'],
		    "totalManoObra"=>$_POST['totalManoObra'],
		    "totalMateriales"=>$_POST['totalMateriales'],
		    "subTotal"=>$_POST['subTotalGral'],
		    "utilidad"=>$_POST['utilidad'],
		    "comision"=>$_POST['comision'],
		    "totalGeneral"=>$_POST['totalGral']
		);
		
		// ... inserta registro tabla ... cotizacioValores 
		$this-> load -> model("tablaGenerica_model");		//carga modelo 
		$this-> tablaGenerica_model -> grabar('cotizacionvalores',$plantillaValores);			
		// ... fin de inserción  registro tabla ... cotizacionManoObra
		
		// ... actualizar numero de cotizacion ...		
		$this-> load -> model("numeroDocumento_model");	//... modelo numeroDocumento_model ... cotizacion
		$nombreTabla='nocotizacion'; // ... prefijoTabla
		$this-> numeroDocumento_model -> actualizar($numeroCotizacion,$nombreTabla);
		// fin actualizar numero de cotizacion ...
		
		redirect("produccion/generarCotizacionPDF?numeroCotizacion=$numeroCotizacion");
		
	}	//... fin grabarCotizacion	

	
		
			
	/////////////////////////////////////////////
	//... funciones del CRUD cotizaciones ...//
	/////////////////////////////////////////////
	
	public function crudVerCotizaciones(){
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='produccion'){  //... valida permiso de userName ...
			$datos['mensaje']='Usuario NO autorizado para operar Sistema de Producción';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
//			redirect('menuController/index');
		}	//... fin control de permisos de acceso ....
		else {		//... usuario validado ...
			$nombreDeposito='almacen';
			$this->load->model("tablaGenerica_model");
			$contador= $this->tablaGenerica_model->get_total_registros('cotizacioncabecera');
			
			if($contador==0){  //...cuando NO hay registros ...
				$datos['mensaje']='No hay registros grabados en la tabla COTIZACIONcabecera.';
				$this->load->view('header');
				$this->load->view('mensaje',$datos );
				$this->load->view('footer');
			}
			else{      //... cuando hay registros ...
				
				/* URL a la que se desea agregar la paginación*/
		    	$config['base_url'] = base_url().'produccion/crudVerCotizaciones';
				
				/*Obtiene el total de registros a paginar */
		    	$config['total_rows'] = $this->tablaGenerica_model->get_total_registros('cotizacioncabecera');
				
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
		   		$datos['listaCotizacion'] = $this->tablaGenerica_model->get_registros('cotizacioncabecera',$config['per_page'], $desde); 
		
				$datos['consultaCotizacion'] ='';
				
		 		/*Se llama a la vista para mostrar la información*/
				$this->load->view('header');
				$this->load->view('produccion/verCotizacionesCrud', $datos);
				$this->load->view('footer');
			}  // fin else cuando hay registros 
		}	//... fin IF validar acceso usuario...
	} //... fin crudVerCotizaciones ...
	



	public function eliminarCotizacionCrud(){
		//... elimina cotizacion de las tablas cotizacion[areamaterial/cabecera/manoobra/material] ...
		$codigoCotizacion=$_POST['codigo'];
		$this-> load -> model("tablaGenerica_model");
   		$this-> tablaGenerica_model -> eliminar('cotizacionareamaterial','nuCotizacion',$codigoCotizacion);
		$this-> tablaGenerica_model -> eliminar('cotizacioncabecera','numCotizacion',$codigoCotizacion);
		$this-> tablaGenerica_model -> eliminar('cotizacionmaterial','numeroCotizacion',$codigoCotizacion);

		$archivoPDF='cotizacion'.$codigoCotizacion.'PDF.pdf';
		//$archivoPDF='cotizacion10077PDF.pdf';
		$archivo ='pdfsArchivos/cotizacion'.$codigoCotizacion.'PDF.pdf';
		//$archivo ='pdfsArchivos/cotizacion10077PDF.pdf';
		$hacer = unlink($archivo);
 
		if($hacer != true){
 			echo "Ocurrió un error tratando de borrar el archivo" .$archivoPDF. "<br />";
 		}

		$data=base_url("produccion/crudVerCotizaciones");
		echo $data;
	}

 
	public function buscarCotizacionCrud(){
		//... buscar los registros que coincidan con el patron busqueda ingresado ...
		$campo1='cliente';   //... el campo por elcual se va hacer la búsqueda ...
	 
		if(isset($_POST['inputBuscarPatron'])){
			$consultaCotizacion=$_POST['inputBuscarPatron'];
			
			// Escribimos una primera línea en consultaCrud.txt
			$fp = fopen("pdfsArchivos/consultaCrud.txt", "w");
			fputs($fp, $consultaCotizacion);
			fclose($fp); 

		}else{
			// Leemos la primera línea de consultaCrud.txt
			// fichero.txt es un archivo de texto normal creado con notepad, por ejemplo.
			$fp = fopen("pdfsArchivos/consultaCrud.txt", "r");
			$consultaCotizacion = fgets($fp);
			fclose($fp); 
		}	
		
		$this-> load -> model("tablaGenerica_model");
		
		$totalRegistrosEncontrados=0;		
		$totalRegistrosEncontrados=$this->tablaGenerica_model->getTotalRegistrosBuscar('cotizacioncabecera',$campo1,$consultaCotizacion);
		//echo"total registros econtrados".$totalRegistrosEncontrados;
		if($totalRegistrosEncontrados==0){
		//	$datos['mensaje']='No hay registros grabados en la tabla '.$nombreTabla;
		//	$this->load->view('mensaje',$datos );
		//	redirect('produccion/crudVerCotizaciones');
			redirect('menuController/index');
		}else{
			/* URL a la que se desea agregar la paginación*/
	    	$config['base_url'] = base_url().'produccion/buscarCotizacionCrud';
			
			/*Obtiene el total de registros a paginar */
	    	$config['total_rows'] = $this->tablaGenerica_model->getTotalRegistrosBuscar('cotizacioncabecera',$campo1,$consultaCotizacion);
		
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
			$datos['listaCotizacion'] = $this-> tablaGenerica_model -> buscarPaginacion('cotizacioncabecera',$campo1,$consultaCotizacion, $config['per_page'], $desde );
			$datos['consultaCotizacion'] =$consultaCotizacion;
			
			/*Se llama a la vista para mostrar la información*/
			$this->load->view('header');
			$this->load->view('produccion/verCotizacionesCrud', $datos);
			$this->load->view('footer');
		}		//... fin IF total registros encontrados ...
	}


	public function reportePdfCrud(){
		//... recupera la variable de numeCotizcion ...
		$numeCotizacion=$_POST["numeCotizacion"];
  		
		?>
		<embed src="<?= base_url('pdfsArchivos/cotizacion'.$numeCotizacion.'PDF.pdf') ?>" width="820" height="455" id="sergio"> <!-- documento embebido PDF -->
		<?php
	
	}	

	
	
//... fin de funciones CRUD ...
////////////////////////////////
  

/////////////////////////////////////
//... inicio funciones reportesPDF
/////////////////////////////////////

	public function reporteProduccion(){
		//... genera reporte de salida en PDF
		$nombreDeposito= $_POST['nombreDeposito']; //... lee nombreDeposito que viene del menu principal(blanco/acabado ) ...			
		$codigoProducto= str_replace(" ","",$_POST['inputCodigo']); //... lee codigoProducto	y quita espacio en blanco ..
		$descripcionProducto=$_POST['inputDescripcion']; 
		$cantidadProducto=$_POST['inputCantidadProducir']; 
		$medidaProducto=$_POST['inputMedida']; 
		
		// Se carga la libreria fpdf
		$this->load->library('produccion/PlanificarProduccionPdf');
		
		 // Se obtienen los registros de la base de datos
		//$salidas = $this->db->query('SELECT t1.numSal, fecha,numOrden, glosa,idMaterial,nombreInsumo, cantidad,unidad,tipoInsumo FROM '.$salidaMaterial.' t1, '.$salidaCabecera.' t2, '.$maestroMaterial.' t3 WHERE t1.numSal = t2.numero AND  t1.idMaterial=t3.codInsumo ORDER BY t1.numSal');
		$sql ="SELECT  idProd, nombreProd, medidas,P.unidad, codPro, codMat,A.nombreInsumo,cantidad,A.unidad, A.existencia as qAlmacen ,B.existencia as qBodega FROM productosfabrica P INNER JOIN prod".$nombreDeposito.
		"plantilla F ON idProd = F.codPro INNER JOIN almacen A ON F.codMat=A.codInsumo INNER JOIN bodega B ON F.codMat=B.codInsumo WHERE F.codPro='$codigoProducto'";
		
 		$ingresos = $this->db->query($sql);
 
 		$contador= $ingresos->num_rows; //...contador de registros que satisfacen la consulta ...

		if($contador==0){
			$datos['mensaje']='No hay registros que coincidan con el producto '.$descripcionProducto;
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
		    $this->pdf = new PlanificarProduccionPdf('L');	//...sentido Horizontal de la hoja new PlanificarProduccionPdf('L') ....
			
			$this->pdf->nombreDeposito=strtoupper($nombreDeposito);      			//...pasando variable para el header del PDF
			$this->pdf->nombreProducto=$descripcionProducto; 			//...pasando variable para el header del PDF
			$this->pdf->cantidadProducto=$cantidadProducto; 			//...pasando variable para el header del PDF
			$this->pdf->unidadProducto='unidades'; 						//...pasando variable para el header del PDF
		    // Agregamos una página
		    $this->pdf->AddPage('L');
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
		    
		    foreach ($ingresos->result() as $ingreso) {
		       	        
				$this->pdf->Cell(15,5,$ingreso->codMat,'',0,'L',0);
				$this->pdf->Cell(82,5,$ingreso->nombreInsumo,'',0,'L',0);
		        $this->pdf->Cell(29,5,number_format($ingreso->cantidad,2),'',0,'R',0);
				$this->pdf->Cell(20,5,$ingreso->unidad,'',0,'L',0);
				$this->pdf->Cell(20,5,number_format($ingreso->cantidad*$cantidadProducto,2),'',0,'R',0);
				$this->pdf->Cell(25,5,number_format($ingreso->qAlmacen,2),'',0,'R',0);
				$this->pdf->Cell(28,5,number_format($ingreso->qBodega,2),'',0,'R',0);
				$this->pdf->Cell(28,5,number_format(($ingreso->cantidad*$cantidadProducto)-$ingreso->qAlmacen-$ingreso->qBodega,2),'',0,'R',0);

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
			     			  
			  	$this->pdf->Output('pdfsArchivos/reportePlanificacionPdf.pdf', 'F');
				
				$datos['documento']="pdfsArchivos/reportePlanificacionPdf.pdf";	
				$datos['nombreDeposito']=$nombreDeposito;
				$datos['codigoProducto']=$codigoProducto;
				$datos['nombreProducto']=$descripcionProducto;	
				$datos['cantidadProducto']=$cantidadProducto;
				$datos['medidaProducto']=$medidaProducto;
				
				$this->load->view('header');
				$this->load->view('produccion/reportePlanificacionPdf',$datos );
				$this->load->view('footer');	
			}
	    
	} //... fin funcion: reporteProduccion ...


	public function generarCotizacionPDF(){
		//... genera reporte de salida en PDF

		$numeroCotizacion= $_GET['numeroCotizacion']; //... lee numeroCotizacion que viene de grabarCotizacion ...
		
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoDeposito=$this->session->userdata('usuarioDeposito');
		$permisoProceso3=$this->session->userdata('usuarioProceso3');
		if($permisoUserName!='superuser' ){  //... valida permiso de userName ...
			if($permisoMenu!='produccion' ){	//... valida permiso de menu  ...
				redirect('menuController/index');
			}
			
			if( $permisoProceso3==false ){   //... valida permiso de proceso ...
				redirect('menuController/index');
			}
		}
		//... fin control de permisos de acceso ....
		
		// Se carga la libreria fpdf
		$this->load->library('produccion/EstructuraCotizacionPdf');
		
		// Se obtienen los registros de la base de datos
		$sql ="SELECT numeroCotizacion,codigoMaterial,nombreInsumo,cantidadMaterial,unidad,precioMaterial FROM cotizacionmaterial,almacen WHERE numeroCotizacion='$numeroCotizacion' AND codigoMaterial=codInsumo";
		$materiales = $this->db->query($sql);
		
		$sql2 ="SELECT t1.codMaterialArea,t2.nombreMaterial,t1.largo, t1.ancho,t1.cantidadHoja,t2.unidadMaterial,t2.precioMetro2 FROM cotizacionareamaterial as t1,materialarea as t2 WHERE nuCotizacion='$numeroCotizacion' AND t1.codMaterialArea=t2.codMaterial";
		$areaMateriales = $this->db->query($sql2);
		
		$sql3 ="SELECT numCotizacion,codEmpleado,empleado,categoria,cantidadHoras,precioHora FROM cotizacionmanoobra,prodmanoobra WHERE numCotizacion='$numeroCotizacion' AND codEmpleado=idEmpleado";
		$manoObras = $this->db->query($sql3);
					
		$this->load->model("tablaGenerica_model");	//...carga el modelo tabla generica ...
		$cotizacionCabecera= $this->tablaGenerica_model->buscar('cotizacioncabecera','numCotizacion',$numeroCotizacion); //..una vez cargado el modelo de la tabla llama cotizacioncabecera..
		
		$fechaCotizacion= $cotizacionCabecera["fecha"];	// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$cliente= $cotizacionCabecera["cliente"];			// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$email= $cotizacionCabecera["email"];				// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$fono= $cotizacionCabecera["fonoCel"];				// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
				
	   $valores = $this->tablaGenerica_model->buscar('cotizacionvalores','idCotizacion',$numeroCotizacion); //..una vez cargado el modelo de la tabla llama cotizacionvalores..
	   $manoObraDirecta= $valores["manoObraDirecta"];	// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
	   $manoObraIndirecta= $valores["manoObraIndirecta"];// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
	   $totalManoObra= $valores["totalManoObra"];		// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
	   $totalMateriales= $valores["totalMateriales"];	// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
	   $subTotal= $valores["subTotal"];					// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
	   $utilidad= $valores["utilidad"];					// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
	   $comision= $valores["comision"];					// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
	   $totalGeneral= $valores["totalGeneral"];			// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
					
							
		$sql ="SELECT * FROM cotizacioncabecera WHERE numCotizacion='$numeroCotizacion' ";
		$contador = $this->db->query($sql);	
 		$contador= $contador->num_rows; //...contador de registros que satisfacen la consulta ..

		if($contador==0){
			$datos['mensaje']='No hay registro grabado con el n&uacute;mero de  cotizaci&oacute;n '.$numeroCotizacion.' en la tabla COTIZACIONcabecera.';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}else{
			

			// Creacion del PDF
		    /*
		    * Se crea un objeto de la clase EstructuraCotizacionPdf, recordar que la clase Pdf
		    * heredó todos las variables y métodos de fpdf
		    */
		     
		    ob_clean(); // cierra si es se abrio el envio de pdf...
		    $this->pdf = new EstructuraCotizacionPdf();  
			
			$this->pdf->numeroCotizacion=strtoupper($numeroCotizacion);      //...pasando variable para el header del PDF
			$this->pdf->fecha=fechaMysqlParaLatina($fechaCotizacion); 		 //...pasando variable para el header del PDF
			$this->pdf->cliente=$cliente; 								     //...pasando variable para el header del PDF
			$this->pdf->email=$email; 								     	 //...pasando variable para el header del PDF
			$this->pdf->fonoCelular=$fono; 									 //...pasando variable para el header del PDF
			
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
		    $this->pdf->SetFont('Arial', '', 8);
		    
			$totalMaterial=0; //... acumula los importes de cada material...
			$totalAreaMaterial=0; //... acumula los importes de cada material por area...
			$totalEmpleado=0; //... acumula los importes de cada empleado ...
		    foreach ($materiales->result() as $material) {
		        // se imprime el numero actual y despues se incrementa el valor de $x en uno
		        // Se imprimen los datos de cada registro
 				
		        //$this->pdf->Cell(1,5,'','',0,'L',0);
				$this->pdf->Cell(15,5,$material->codigoMaterial,'',0,'L',0);
				$this->pdf->Cell(84,5,utf8_decode($material->nombreInsumo),'',0,'L',0);
				$this->pdf->Cell(26,5,'','',0,'L',0); // ... espacios en blanco ...
		        $this->pdf->Cell(15,5,number_format($material->cantidadMaterial,2),'',0,'R',0);
				$this->pdf->Cell(15,5,$material->unidad,'',0,'L',0);
				$this->pdf->Cell(15,5,number_format($material->precioMaterial,2),'',0,'R',0);
				$this->pdf->Cell(17,5,number_format($material->cantidadMaterial*$material->precioMaterial,2),'',0,'R',0);
				$totalMaterial=$totalMaterial +( $material->cantidadMaterial*$material->precioMaterial ); //... acumula los importes de cada nota de ingreso...
		        //Se agrega un salto de linea
		        $this->pdf->Ln(5);
		    }

			$this->pdf->Ln(5);
			$this->pdf->Cell(145,5,'','',0,'L',0);
    		$this->pdf->Cell(42,5,'Subtotal Bs. '.number_format($totalMaterial,2),0,0,'R');
	
			$this->pdf->Ln(5);
			$this->pdf->Ln(5);
			
			foreach ($areaMateriales->result() as $areaMaterial) {
		        // se imprime el numero actual y despues se incrementa el valor de $x en uno
		        // Se imprimen los datos de cada registro
 				
		        //$this->pdf->Cell(1,5,'','',0,'L',0);
				$this->pdf->Cell(15,5,$areaMaterial->codMaterialArea,'',0,'L',0);
				$this->pdf->Cell(84,5,utf8_decode($areaMaterial->nombreMaterial),'',0,'L',0);
	 			$this->pdf->Cell(13,5,number_format($areaMaterial->largo,2),'',0,'R',0);			
	 			$this->pdf->Cell(13,5,number_format($areaMaterial->ancho,2),'',0,'R',0);			
		        $this->pdf->Cell(15,5,number_format($areaMaterial->cantidadHoja,2),'',0,'R',0);
				$this->pdf->Cell(15,5,$areaMaterial->unidadMaterial,'',0,'L',0);
				$this->pdf->Cell(15,5,number_format($areaMaterial->precioMetro2,2),'',0,'R',0);
				$this->pdf->Cell(17,5,number_format($areaMaterial->largo*$areaMaterial->ancho*$areaMaterial->cantidadHoja*$areaMaterial->precioMetro2,2),'',0,'R',0);
				$totalAreaMaterial=$totalAreaMaterial +( $areaMaterial->largo*$areaMaterial->ancho*$areaMaterial->cantidadHoja*$areaMaterial->precioMetro2 ); //... acumula los importes de cada nota de ingreso...
		        //Se agrega un salto de linea
		        $this->pdf->Ln(5);
		    }

			$this->pdf->Ln(5);
			$this->pdf->Cell(145,5,'','',0,'L',0);
    		$this->pdf->Cell(42,5,'Subtotal Bs. '.number_format($totalAreaMaterial,2),0,0,'R');
			$this->pdf->Ln(5);
			$this->pdf->Ln(5);
			
			foreach ($manoObras->result() as $manoObra) {
		        // se imprime el numero actual y despues se incrementa el valor de $x en uno
		        // Se imprimen los datos de cada registro
 				
		        //$this->pdf->Cell(1,5,'','',0,'L',0);
				$this->pdf->Cell(15,5,$manoObra->codEmpleado,'',0,'L',0);
				$this->pdf->Cell(84,5,utf8_decode($manoObra->empleado),'',0,'L',0);
				$this->pdf->Cell(26,5,'','',0,'L',0); // ... espacios en blanco ...
		        $this->pdf->Cell(15,5,number_format($manoObra->cantidadHoras,2),'',0,'R',0);
				$this->pdf->Cell(15,5,utf8_decode($manoObra->categoria),'',0,'L',0);
				$this->pdf->Cell(15,5,number_format($manoObra->precioHora,2),'',0,'R',0);
				$this->pdf->Cell(17,5,number_format($manoObra->cantidadHoras*$manoObra->precioHora,2),'',0,'R',0);
				$totalEmpleado=$totalEmpleado +( $manoObra->cantidadHoras*$manoObra->precioHora ); //... acumula los importes de cada nota de ingreso...
		        //Se agrega un salto de linea
		        $this->pdf->Ln(5);
		    }

			$this->pdf->Ln(5);
			$this->pdf->Cell(145,5,'','',0,'L',0);
    		$this->pdf->Cell(42,5,'Subtotal Bs. '.number_format($totalEmpleado,2),0,0,'R');
	
			$this->pdf->Ln(5);
			
			
			$this->pdf->Ln(5);
			// Se define el formato de fuente: Arial, negritas, tamaño 9
		    //$this->pdf->SetFont('Arial', 'B', 9);
		    $this->pdf->SetFont('Arial', 'B', 8);
			$this->pdf->Cell(15,5,'Mano de Obra Directa','',0,'L',0);
			$this->pdf->SetFont('Arial', '', 8);
			$this->pdf->Ln(5);
			
			$this->pdf->Cell(95,5,'',0,0,'R');
			$this->pdf->Cell(92,5,'Subtotal Bs.: '.number_format($manoObraDirecta,2),0,0,'R');
		
			$this->pdf->Ln(5);
			$this->pdf->Ln(5);
			$this->pdf->SetFont('Arial', 'B', 8);
			$this->pdf->Cell(15,5,'Mano de Obra Indirecta','',0,'L',0);
			$this->pdf->SetFont('Arial', '', 8);
			
			$this->pdf->Ln(5);
			$this->pdf->Cell(95,5,'',0,0,'R');
			$this->pdf->Cell(92,5,'Subtotal Bs.: '.number_format($manoObraIndirecta,2),0,0,'R');
		
			$this->pdf->Ln(5);
			$this->pdf->Ln(5);
			$this->pdf->SetFont('Arial', 'B', 8);
			$this->pdf->Cell(15,5,'Mano de Obra','',0,'L',0);
			$this->pdf->SetFont('Arial', '', 8);
			
			$this->pdf->Ln(5);
			$this->pdf->Cell(95,5,'',0,0,'R');
			$this->pdf->Cell(92,5,'Total Mano de Obra Bs.: '.number_format($totalManoObra,2),0,0,'R');
		
			$this->pdf->Ln(5);
			$this->pdf->Ln(5);
			$this->pdf->SetFont('Arial', 'B', 8);
			$this->pdf->Cell(15,5,'Materiales','',0,'L',0);
			$this->pdf->SetFont('Arial', '', 8);
			
			$this->pdf->Ln(5);
			$this->pdf->Cell(95,5,'',0,0,'R');
			$this->pdf->Cell(92,5,'Total Materiales Bs.: '.number_format($totalMateriales,2),0,0,'R');
		
			$this->pdf->Ln(5);
			$this->pdf->Ln(5);
			$this->pdf->SetFont('Arial', 'B', 8);
			$this->pdf->Cell(15,5,'SubTotal','',0,'L',0);
			$this->pdf->SetFont('Arial', '', 8);
			
			$this->pdf->Ln(5);
			$this->pdf->Cell(95,5,'',0,0,'R');
			$this->pdf->Cell(92,5,'Subtotal acumulado Bs.: '.number_format($subTotal,2),0,0,'R');
		
			$this->pdf->Ln(5);
			$this->pdf->Ln(5);
			$this->pdf->SetFont('Arial', 'B', 8);
			$this->pdf->Cell(15,5,'Utilidad','',0,'L',0);
			$this->pdf->SetFont('Arial', '', 8);
			
			$this->pdf->Ln(5);
			$this->pdf->Cell(92,5,'Utilidad: '.number_format($utilidad,2).' %',0,0,'R');
			
			$this->pdf->Ln(5);
			$this->pdf->Ln(5);
			$this->pdf->SetFont('Arial', 'B', 8);
			$this->pdf->Cell(15,5,utf8_decode('Comisión'),'',0,'L',0);
			$this->pdf->SetFont('Arial', '', 8);
			
			$this->pdf->Ln(5);
			$this->pdf->Cell(92,5,utf8_decode('Comisión: ').number_format($comision,2).' %',0,0,'R');
			
			$this->pdf->Ln(5);
			$this->pdf->Ln(5);
			$this->pdf->SetFont('Arial', 'B', 8);
			$this->pdf->Cell(15,5,'Total General','',0,'L',0);
			$this->pdf->SetFont('Arial', '', 8);
			
			$this->pdf->Ln(5);
			$this->pdf->Cell(95,5,'',0,0,'R');
			$this->pdf->Cell(92,5,'Total General Acumulado Bs.: '.number_format($totalGeneral,2),0,0,'R');
			
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
			  
			 $this->pdf->Output('pdfsArchivos/cotizacion'.$numeroCotizacion.'PDF.pdf', 'F');
	
			 redirect("menuController/index");			
					
		}
	    
	} //... fin funcion: generarCotizacionPDF ...

//... fin funciones reportes PDF ...
////////////////////////////////////


	/////////////////////////////////////////////
	//... funciones del CRUD materalarea  ...//
	/////////////////////////////////////////////
	
	public function crudMaterialArea(){
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' ){  //... valida permiso de userName ...
			$datos['mensaje']='Usuario NO autorizado para operar CRUD de materiales X área';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
//			redirect('menuController/index');
		}	//... fin control de permisos de acceso ....
		else {		//... usuario validado ...
			$nombreTabla='materialarea';
			$this->load->model("tablaGenerica_model");
			
			/*Obtiene el total de registros a paginar */
	    	
			$contador= $this->tablaGenerica_model->get_total_registros($nombreTabla);
			
			if($contador==0){  //...cuando NO hay registros ...
				$datos['mensaje']='No hay registros grabados en la tabla '.$nombreTabla;
				$this->load->view('header');
				$this->load->view('mensaje',$datos );
				$this->load->view('footer');
			}
			else{      //... cuando hay registros ...
				/* Se obtienen los registros a mostrar*/ 
				$this->load->model("tablaGenerica_model");
		   		$datos['listaMaterial'] = $this->tablaGenerica_model->getTodos($nombreTabla);
				
		 		/*Se llama a la vista para mostrar la información*/
				$this->load->view('header');
				$this->load->view('produccion/mostrarMaterialesAreaCrud', $datos);
				$this->load->view('footer');
				
			}  // fin else cuando hay registros 
		}	//... fin IF validar usuario ...
	} //... fin crudMaterialArea
	
	
	public function grabarNuevoMaterialCrud(){
	//... graba un nuevoMaterial en tablas almacen y bodega ...
		$insumo=array(
       		"codMaterial"=>$this->input->post("inputCodigo"),
        	"nombreMaterial"=>$this->input->post("inputMaterial"),
        	"largo"=>$this->input->post("inputLargo"),
        	"ancho"=>$this->input->post("inputAncho"),
        	"unidadMaterial"=>$this->input->post("inputUnidad"),
        	"precioMetro2"=>$this->input->post("inputPrecioM2"),
        	"precioUnidad"=>$this->input->post("inputPrecioUnidad")
       	);

		$this-> load -> model("tablaGenerica_model");
   		$this-> tablaGenerica_model -> grabar('materialarea',$insumo);
		//$this-> session -> set_flashdata("success","insumo grabado con éxito");
   		redirect('produccion/crudMaterialArea');  //...vuelve a la vista: mostrarMaterialesCrud ...
	}
	
	public function actualizarMaterialCrud(){
		//... edita registro de la tabla: materialarea ...
			
		$insumo=array(
       		"codMaterial"=>$this->input->post("inputCodigoM"),
        	"nombreMaterial"=>$this->input->post("inputMaterialM"),
        	"largo"=>$this->input->post("inputLargoM"),
        	"ancho"=>$this->input->post("inputAnchoM"),
        	"unidadMaterial"=>$this->input->post("inputUnidadM"),
        	"precioMetro2"=>$this->input->post("inputPrecioM2M"),
        	"precioUnidad"=>$this->input->post("inputPrecioUnidadM")
       	);
				
		$this-> load -> model("tablaGenerica_model");
   		$this-> tablaGenerica_model -> editarRegistro('materialarea','codMaterial',$insumo['codMaterial'],$insumo);
  
		$data=base_url("produccion/crudMaterialArea");
		echo $data;
	}
	
	
	public function eliminarMaterialCrud(){
		//... elimina registro de las tablas [almacen/bodega] ...
		$codigoMaterial=$_POST['codigo'];
		$this-> load -> model("tablaGenerica_model");
   		$this-> tablaGenerica_model -> eliminar('materialarea','codMaterial',$codigoMaterial);
		$data=base_url("produccion/crudMaterialArea");
		echo $data;
	}
	
		
	public function crudManoObra(){
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' ){  //... valida permiso de userName ...
			$datos['mensaje']='Usuario NO autorizado para operar CRUD de mano de obra';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
//			redirect('menuController/index');
		}	//... fin control de permisos de acceso ....
		else {		//... usuario validado ...
			$nombreTabla='prodmanoobra';
			$this->load->model("tablaGenerica_model");
			
			/*Obtiene el total de registros a paginar */
	    	
			$contador= $this->tablaGenerica_model->get_total_registros($nombreTabla);
			
			if($contador==0){  //...cuando NO hay registros ...
				$datos['mensaje']='No hay registros grabados en la tabla '.$nombreTabla;
				$this->load->view('header');
				$this->load->view('mensaje',$datos );
				$this->load->view('footer');
			}
			else{      //... cuando hay registros ...
				/* Se obtienen los registros a mostrar*/ 
				$this->load->model("tablaGenerica_model");
		   		$datos['listaManoObra'] = $this->tablaGenerica_model->getTodos($nombreTabla);
				
		 		/*Se llama a la vista para mostrar la información*/
				$this->load->view('header');
				$this->load->view('produccion/mostrarManoObraCrud', $datos);
				$this->load->view('footer');
				
			}  // fin else cuando hay registros 
		}	//... fin IF validar usuario ...
	} //... fin crudManoObra
	
	
	public function grabarNuevoManoObraCrud(){
	//... graba un nuevoMaterial en tablas almacen y bodega ...
		$registro=array(
       		"idEmpleado"=>$this->input->post("inputCodigo"),
        	"empleado"=>$this->input->post("inputEmpleado"),
        	"categoria"=>$this->input->post("inputCategoria"),
        	"horaBs"=>$this->input->post("inputHoraBs")
       	);

		$this-> load -> model("tablaGenerica_model");
   		$this-> tablaGenerica_model -> grabar('prodmanoobra',$registro);
		//$this-> session -> set_flashdata("success","insumo grabado con éxito");
   		redirect('produccion/crudManoObra');  //...vuelve a la vista: mostrarManoObraCrud ...
	}
	
	public function actualizarManoObraCrud(){
		//... edita registro de la tabla: materialarea ...
		
 //$categoriaAux=$_POST['tipoEmpleado'];		
							
		$registro=array(
       		"idEmpleado"=>$this->input->post("inputCodigoM"),
        	"empleado"=>$this->input->post("inputEmpleadoM"),
        	"categoria"=>$this->input->post("inputCategoriaM"),
        	"horaBs"=>$this->input->post("inputHoraBsM")
       	);

		$this-> load -> model("tablaGenerica_model");
   		$this-> tablaGenerica_model -> editarRegistro('prodmanoobra','idEmpleado',$registro['idEmpleado'],$registro);

		$data=base_url("produccion/crudManoObra");
		echo $data;
	}
	
	
	public function eliminarManoObraCrud(){
		//... elimina registro de la tabla [prodmanoobra] ...
		$codigo=$_POST['codigo'];
		$this-> load -> model("tablaGenerica_model");
   		$this-> tablaGenerica_model -> eliminar('prodmanoobra','idEmpleado',$codigo);
		$data=base_url("produccion/crudManoObra");
		echo $data;
	}
	
			
	//... fin de funciones CRUD ...
	////////////////////////////////

 
 		public function dataTable(){
 			
		$nombreTabla='materialarea';
		$this->load->model("tablaGenerica_model");
		
		/*Obtiene el total de registros a paginar */
    	
		$contador= $this->tablaGenerica_model->get_total_registros($nombreTabla);
		
		if($contador==0){  //...cuando NO hay registros ...
			$datos['mensaje']='No hay registros grabados en la tabla '.$nombreTabla;
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}
		else{      //... cuando hay registros ...
			/* Se obtienen los registros a mostrar*/ 
			$this->load->model("tablaGenerica_model");
	   		$datos['listaMaterial'] = $this->tablaGenerica_model->getTodos($nombreTabla);
			
	 		/*Se llama a la vista para mostrar la información*/
			$this->load->view('header');
			$this->load->view('produccion/dataTable', $datos);
			$this->load->view('footer');
			
		}  // fin else cuando hay registros 
		
	} //... fin dataTable
 
 
	public function datosOrdenTrabajo(){
			
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' ){  //... valida permiso de userName ...
			$datos['mensaje']='Usuario NO autorizado para operar Sistema de Producci&oacute;n';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
//			redirect('menuController/index');
		}	//... fin control de permisos de acceso ....	
		else{
			$this->load->model("tablaGenerica_model");	//...carga el modelo tabla 
	//		$pedidos= $this->tablaGenerica_model->getTodos('pedidoproducto'); //..una vez cargado el modelo de la tabla pedidocabecera..
			
			$sql ="SELECT * FROM pedidoproducto WHERE codTrabajador=''";		//...selecciona registros que NO han sido asignados ..
	 		$pedidos = $this->db->query($sql);
			
			$trabajadores= $this->tablaGenerica_model->getTodos('prodmanoobra'); //..una vez cargado el modelo de la tabla prodmanoobra..
							
	      	$datos['pedidos']=$pedidos;	
			$datos['trabajadores']=$trabajadores;	
			$datos['titulo']='Datos Orden de Trabajo';
			$this->load->view('header');
			$this->load->view('produccion/datosOrdenTrabajo',$datos );
			$this->load->view('footer');
		}	//..fin IF validar usuario...
	}	//... fin datosOrdenTrabajo ...
		
		
		public function ordenTrabajo(){
		//... genera reporte de ordenTrabajo en PDF
		$codigoPedido=str_replace(" ","",$_POST['inputCodigo']); 		//...lee y quita espacio en blanco a codigoPedido..
		$codigoProducto=str_replace(" ","",$_POST['codigoProducto']); 	//...lee y quita espacio en blanco a codigoProducto..
		$codigoTrabajador=str_replace(" ","",$_POST['codTrabajador']); 	//...lee y quita espacio en blanco a codTrabajador..
		$nombreTrabajador= $_POST['inputTrabajador']; 					//... lee nombre del trabajador ...
		$fechaInicial= $_POST['inputFechaInicial']; 					//... lee fecha inicial ...
		$fechaFinal= $_POST['inputFechaFinal']; 						//... lee fecha final ...
		$producto= $_POST['producto']; 									//... lee producto ...
		$color= $_POST['color']; 										//... lee color ...
		$cantidad= $_POST['cantidad']; 									//... lee cantidad ...
		$unidad= $_POST['unidad']; 										//... lee unidad ...
		$secuencia= $_POST['secuencia']; 								//... lee secuencia ...
				
        // Se carga la libreria fpdf
        $this->load->library('produccion/OrdenTrabajo');
 
        // Se obtienen los registros de la base de datos
        $sql ="SELECT estado FROM pedidocabecera WHERE numPedido='$codigoPedido' ";
		$estado = $this->db->query($sql);
        if($estado=="I"){
        	$fechaSistema=date('Y-m-d');
			$sql ="UPDATE pedidocabecera SET estado='P', fechaEstado='$fechaSistema' WHERE numPedido='$codigoPedido' "; //..tabla pedidocabecera..
 			$result = $this->db->query($sql);
        }
        
 		$sql ="UPDATE pedidoproducto SET codTrabajador='$codigoTrabajador', trabajador='$nombreTrabajador', fechaInicial='$fechaInicial', fechaFinal='$fechaFinal',estadoItem='P' WHERE numeroPedido='$codigoPedido' AND secuencia='$secuencia' "; //..tabla pedidoproducto..
 		$result = $this->db->query($sql);
	
		// Creacion del PDF
        /*
        * Se crea un objeto de la clase OrdenTrabajoPdf, recordar que la clase Pdf
        * heredó todos las variables y métodos de fpdf
        */
         
        ob_clean(); // cierra si es se abrio el envio de pdf...
        $this->pdf = new OrdenTrabajo();
		
		$this->pdf->numero=$codigoPedido.'-'.$secuencia;      				//...pasando variable para el header del PDF
		$this->pdf->nombreTrabajador=$nombreTrabajador;      				//...pasando variable para el header del PDF
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
        $this->pdf->SetFont('Arial', '', 9);
        
        //... lineq de detalle ...		
		$this->pdf->Cell(1,7,$codigoProducto,'',0,'L',0);
		$this->pdf->Cell(10,7,' ','',0,'L',0);
		$this->pdf->Cell(60,7,utf8_decode($producto),'',0,'L',0);
		$this->pdf->Cell(7,7,' ','',0,'L',0);
		$this->pdf->Cell(75,7,' ','',0,'L',0);
		$this->pdf->Cell(15,7,number_format($cantidad,2),'',0,'R',0);
		$this->pdf->Cell(10,7,' ','',0,'L',0);
        $this->pdf->Cell(15,7,$unidad,'',0,'L',0);
        //Se agrega un salto de linea
        $this->pdf->Ln(7);
		$this->pdf->Cell(10,7,' ','',0,'L',0);
        $this->pdf->Cell(90,7,utf8_decode($color),'',0,'L',0);
		
        
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
  
  		$this->pdf->Output('pdfsArchivos/ordenesTrabajo/ordenTrabajo'.$codigoPedido.$secuencia.'.pdf', 'F');
  		
		$datos['documento']="pdfsArchivos/ordenesTrabajo/ordenTrabajo".$codigoPedido.$secuencia.".pdf";
		$datos['titulo']=' Orden de Trabajo No.: '.$codigoPedido.'-'.$secuencia;	// ... titulo ...
		$datos['fechaInicial']=fechaMysqlParaLatina($fechaInicial);
		$datos['fechaFinal']=fechaMysqlParaLatina($fechaFinal);
		$this->load->view('header');
		$this->load->view('reportePdf',$datos );
		$this->load->view('footer');	
 		
	} //... fin funcion: generarReporte OrdenTrabajo ...	
	
	
	
		/////////////////////////////////////////////
	//... funciones del CRUD pedidos ...//
	/////////////////////////////////////////////
	
	public function crudVerPedidos()
	{
		//... control de permisos de acceso ....
		
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='produccion'){  //... valida permiso de userName y de menu ...
			$datos['mensaje']='Usuario NO autorizado para operar Sistema de Producción';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
//			redirect('menuController/index');
		}			// ... fin control permiso de accesos...
		else {
			$this->load->model("tablaGenerica_model");
			
			/* URL a la que se desea agregar la paginación*/
	    	$config['base_url'] = base_url().'produccion/crudVerPedidos';
			
			/*Obtiene el total de registros a paginar */
	    	$config['total_rows'] = $this->tablaGenerica_model->get_total_registros('pedidocabecera');
		
			$contador= $this->tablaGenerica_model->get_total_registros('pedidocabecera'); //...contador de registros  ...		
			if($contador==0){
				$datos['mensaje']='No hay registros para mostrar ';
				$this->load->view('header');
				$this->load->view('mensaje',$datos );
				$this->load->view('footer');
			}else{
				
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
				$datos['listaPedido'] = $this->tablaGenerica_model->get_registros('pedidocabecera',$config['per_page'], $desde); 
			
				$datos['consultaPedido'] ='';
				
				/*Se llama a la vista para mostrar la información*/
				$this->load->view('header');
				$this->load->view('produccion/verPedidosCrud', $datos);
				$this->load->view('footer');
					
			}//..fin IF contador registros mayor que cero ..
		}	//... fin IF validar usuario ...
		
	} //... fin crudVerPedidos ...
	

	public function eliminarPedidoCrud(){
		//... elimina pedido de las tablas cotizacion[cabecera/producto] ...
		$codigoPedido=$_POST['codigo'];
		$this-> load -> model("tablaGenerica_model");
   		$this-> tablaGenerica_model -> eliminar('pedidoproducto','numeroPedido',$codigoPedido);
		$this-> tablaGenerica_model -> eliminar('pedidocabecera','numPedido',$codigoPedido);

		$archivoPDF='pedido'.$codigoPedido.'.pdf';
		$archivo ='pdfsArchivos/pedidos/pedido'.$codigoPedido.'.pdf';
		$hacer = unlink($archivo);
 
		if($hacer != true){
 			echo "Ocurrió un error tratando de borrar el archivo" .$archivoPDF. "<br />";
 		}

		$data=base_url("produccion/crudVerPedidos");
		echo $data;
	}
	
 
	public function buscarPedidoCrud(){
		//... buscar los registros que coincidan con el patron busqueda ingresado ...
	    $campo1='numPedido';   //... el campo por elcual se va hacer la búsqueda ...
		
		if(isset($_POST['inputBuscarPatron'])){
			$consultaPedido=$_POST['inputBuscarPatron'];
			
			// Escribimos una primera línea en consultaCrud.txt
			$fp = fopen("pdfsArchivos/consultaCrud.txt", "w");
			fputs($fp, $consultaPedido);
			fclose($fp); 

		}else{
			// Leemos la primera línea de consultaCrud.txt
			// fichero.txt es un archivo de texto normal creado con notepad, por ejemplo.
			$fp = fopen("pdfsArchivos/consultaCrud.txt", "r");
			$consultaPedido = fgets($fp);
			fclose($fp); 
		}	
		
		$this-> load -> model("tablaGenerica_model");
		
		$totalRegistrosEncontrados=0;		
		$totalRegistrosEncontrados=$this->tablaGenerica_model->getTotalRegistrosBuscar('pedidocabecera',$campo1,$consultaPedido);
		//echo"total registros econtrados".$totalRegistrosEncontrados;
		if($totalRegistrosEncontrados==0){
		//	$datos['mensaje']='No hay registros grabados en la tabla '.$nombreTabla;
		//	$this->load->view('mensaje',$datos );
		//	redirect('produccion/crudVerCotizaciones');
			redirect('menuController/index');
		}else{
			/* URL a la que se desea agregar la paginación*/
	    	$config['base_url'] = base_url().'produccion/buscarPedidoCrud';
			
			/*Obtiene el total de registros a paginar */
	    	$config['total_rows'] = $this->tablaGenerica_model->getTotalRegistrosBuscar('pedidocabecera',$campo1,$consultaPedido);
		
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
			$datos['listaPedido'] = $this-> tablaGenerica_model -> buscarPaginacion('pedidocabecera',$campo1,$consultaPedido, $config['per_page'], $desde );
			$datos['consultaPedido'] =$consultaPedido;
			
			/*Se llama a la vista para mostrar la información*/
			$this->load->view('header');
			$this->load->view('produccion/verPedidosCrud', $datos);
			$this->load->view('footer');
		}		//... fin IF total registros encintrados ...
	}

	
	public function pedidoPdfCrud(){
		//... recupera la variable de numePedido ...
		$numePedido=$_POST["numePedido"];

		?>
		<embed src="<?= base_url('pdfsArchivos/pedidos/pedido'.$numePedido.'.pdf') ?>" width="820" height="455" id="sergio"> <!-- documento embebido PDF -->
		<?php
	}	
	
 		public function verOrdenesTrabajo()
	{
		//... control de permisos de acceso ....
		
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='produccion'){  //... valida permiso de userName y de menu ...
			$datos['mensaje']='Usuario NO autorizado para operar Sistema de producción';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
//			redirect('menuController/index');
		}			// ... fin control permiso de accesos...
		else {
			$this->load->model("tablaGenerica_model");
			
			/* URL a la que se desea agregar la paginación*/
	    	$config['base_url'] = base_url().'produccion/verOrdenesTrabajo';
			
			/*Obtiene el total de registros a paginar */
	    	$config['total_rows'] = $this->tablaGenerica_model->get_total_registros('pedidoproducto');
		
			$contador= $this->tablaGenerica_model->get_total_registros('pedidoproducto'); //...contador de registros  ...		
			if($contador==0){
				$datos['mensaje']='No hay registros para mostrar ';
				$this->load->view('header');
				$this->load->view('mensaje',$datos );
				$this->load->view('footer');
			}else{
				
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
				$datos['listaOrdenTrabajo'] = $this->tablaGenerica_model->get_registros('pedidoproducto',$config['per_page'], $desde); 
			
				$datos['consultaOrdenTrabajo'] ='';
				
				/*Se llama a la vista para mostrar la información*/
				$this->load->view('header');
				$this->load->view('produccion/verOrdenesTrabajo', $datos);
				$this->load->view('footer');
					
			}//..fin IF contador registros mayor que cero ..
		}	//... fin IF validar usuario ...
		
	} //... fin verOrdenestrabajo ...
	
	public function ordenTrabajoPdf(){
		//... recupera la variable de numeCotizcion ...
		$numeOrdenTrabajo=$_POST["numeOrdenTrabajo"];
		
		?>
		<embed src="<?= base_url('pdfsArchivos/ordenesTrabajo/ordenTrabajo'.$numeOrdenTrabajo.'.pdf') ?>" width="820" height="455" id="sergio"> <!-- documento embebido PDF -->
		<?php
	}


	public function actualizarOrdenTrabajo(){
		//... edita registro de la tabla: pedidoproducto ...	
		$numeroPedido=$_POST['numeroPedido']; 	//... formulario actualizarOrdenTrabajo ...
		$secuencia=$_POST['secuencia']; 		//... formulario actualizarOrdenTrabajo ...
		if($secuencia<10){
			$secuencia = '0'.$secuencia;
		}
		$fechaAcabado = $this->input->post("inputFechaAcabadoM");
		$estado = $this->input->post("inputEstadoM");

		$sql="UPDATE pedidoproducto SET estadoItem='$estado', fechaAcabado='$fechaAcabado' WHERE numeroPedido='$numeroPedido' AND secuencia='$secuencia'";
		$this->db->query($sql);

		$data=base_url().'produccion/verOrdenesTrabajo';
		echo $data;
	}
	
	
		public function buscarOrdenTrabajo(){
		//... buscar los registros que coincidan con el patron busqueda ingresado ...
	
		if(isset($_POST['inputBuscarPatron'])){
			$consultaOrdenTrabajo=$_POST['inputBuscarPatron'];
			
			// Escribimos una primera línea en consultaCrud.txt
			$fp = fopen("pdfsArchivos/consultaOrdenTrabajo.txt", "w");
			fputs($fp, $consultaOrdenTrabajo);
			fclose($fp); 

		}else{
			// Leemos la primera línea de consultaCrud.txt
			// fichero.txt es un archivo de texto normal creado con notepad, por ejemplo.
			$fp = fopen("pdfsArchivos/consultaOrdenTrabajo.txt", "r");
			$consultaOrdenTrabajo = fgets($fp);
			fclose($fp); 
		}	
				
		$this-> load -> model("tablaGenerica_model");
		
		$totalRegistrosEncontrados=0;		
		$totalRegistrosEncontrados=$this->tablaGenerica_model->getTotalRegistrosBuscar('pedidoproducto','numeroPedido',$consultaOrdenTrabajo);
		//echo"total registros econtrados".$totalRegistrosEncontrados;
		if($totalRegistrosEncontrados==0){
		//	$datos['mensaje']='No hay registros grabados en la tabla '.$nombreTabla;
		//	$this->load->view('mensaje',$datos );
		//	redirect('produccion/crudVerCotizaciones');
			redirect('menuController/index');
		}else{
			/* URL a la que se desea agregar la paginación*/
	    	$config['base_url'] = base_url().'produccion/buscarOrdenTrabajo';
			
			/*Obtiene el total de registros a paginar */
			$config['total_rows'] = $this->tablaGenerica_model->getTotalRegistrosBuscar('pedidoproducto','numeroPedido',$consultaOrdenTrabajo);
	
		
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
			$datos['listaOrdenTrabajo'] = $this-> tablaGenerica_model -> buscarPaginacion('pedidoproducto','numeroPedido',$consultaOrdenTrabajo, $config['per_page'], $desde );
			
			$datos['consultaOrdenTrabajo'] =$consultaOrdenTrabajo;
			
			/*Se llama a la vista para mostrar la información*/
			$this->load->view('header');
			$this->load->view('produccion/verOrdenesTrabajo', $datos);
			$this->load->view('footer');
		
		}     //... fin IF total registros encontrados ...
	}	//..fin buscarOrdenTrabajo ...

}


/* End of file produccion.php */