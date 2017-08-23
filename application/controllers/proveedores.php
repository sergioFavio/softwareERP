<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proveedores extends CI_Controller {

	
	/////////////////////////////////////////////
	//... funciones del CRUD proveedores ...//
	/////////////////////////////////////////////
	
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
				
				$datos['campoBusqueda'] ='proveedor';
				
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
		
	
	public function buscarProveedor(){
		//... buscar los registros que coincidan con el patron busqueda ingresado ...
		$campoBusqueda="proveedor";

		if(isset($_POST['inputBuscarPatron'])){
			$consultaProveedor=$_POST['inputBuscarPatron'];
			
			// Escribimos una primera línea en consultaCrud.txt
			$fp = fopen("pdfsArchivos/consultaCrud.txt", "w");
			fputs($fp, $consultaProveedor);
			fclose($fp); 

		}else{
			// Leemos la primera línea de consultaCrud.txt
			// fichero.txt es un archivo de texto normal creado con notepad, por ejemplo.
			$fp = fopen("pdfsArchivos/consultaCrud.txt", "r");
			$consultaProveedor = fgets($fp);
			fclose($fp); 
		}	
				
		$this-> load -> model("tablaGenerica_model");
		
		$totalRegistrosEncontrados=0;		
		$totalRegistrosEncontrados=$this->tablaGenerica_model->getTotalRegistrosBuscar('proveedores',$campoBusqueda,$consultaProveedor);
		//echo"total registros econtrados".$totalRegistrosEncontrados;
		if($totalRegistrosEncontrados==0){
		//	$datos['mensaje']='No hay registros grabados en la tabla '.$nombreTabla;
		//	$this->load->view('mensaje',$datos );
		//	redirect('produccion/crudVerCotizaciones');
			redirect('menuController/index');
		}else{
			$nuevoCodigoProveedor ='';
			$rs = mysql_query("SELECT MAX(codProveedor) AS ultimoCodigoProveedor FROM proveedores");
			if ($row = mysql_fetch_row($rs)) {
				$ultimoCodigoProveedor = trim($row[0]);
			}
			
			$nuevoCodigoProveedor =substr($ultimoCodigoProveedor,3,3)+1;
			$nuevoCodigoProveedor ='prv'.$nuevoCodigoProveedor;
				
				
			/* URL a la que se desea agregar la paginación*/
	    	$config['base_url'] = base_url().'materiales/buscarMaterialCrud';
			
			/*Obtiene el total de registros a paginar */
			$config['total_rows'] = $this->tablaGenerica_model->getTotalRegistrosBuscar('proveedores',$campoBusqueda,$consultaProveedor);
	
		
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
			$datos['listaProveedor'] = $this-> tablaGenerica_model -> buscarPaginacion('proveedores',$campoBusqueda,$consultaProveedor, $config['per_page'], $desde );
			
			$datos['consultaProveedor'] =$consultaProveedor;
			
			$datos['campoBusqueda'] =$campoBusqueda;
			
			$datos['nuevoCodigoProveedor'] =$nuevoCodigoProveedor;
			
			/*Se llama a la vista para mostrar la información*/
			$this->load->view('header');
			$this->load->view('proveedores/verProveedoresCrud', $datos);
			$this->load->view('footer');
		
		}     //... fin IF total registros encontrados ...
	}		//.. fin buscarProveedor ..
	
		
	function validarCodigoProveedorCrud(){
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
		
	}	//... fin validarCodigoProveedorCrud() ...
	
	
	//... fin de funciones CRUD ...
	////////////////////////////////
	
	
	/////////////////////////////////////
	//... inicio funciones reportesPDF
	/////////////////////////////////////
		
	public function generarReporteProveedores(){
		//... genera reporte PlanDeCuentas en PDF
		
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoProceso3=$this->session->userdata('usuarioProceso3');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='proveedores' && $permisoMenu!='inventarios'){  //... valida permiso de userName y de menu...
			$datos['mensaje']='Usuario NO autorizado para operar Sistema de Proveedores';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}	//... fin control de permisos de acceso ....
		else {		//... usuario validado ...
			// Se carga la libreria fpdf
			$this->load->library('proveedores/ProveedoresPdf');
			
			// Se obtienen los registros de la base de datos
			$sql="SELECT * FROM proveedores";
			
			$registros = $this->db->query($sql);
			 
			$contador= $registros->num_rows; //...contador de registros que satisfacen la consulta ..
			
			if($contador==0){
				$datos['mensaje']='No hay registros en la tabla de PROVEEDORES';
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
			    $this->pdf = new ProveedoresPdf('L');		//... ('L') sentido horizontal de la hoja ...
				
			    // Agregamos una página
			    $this->pdf->AddPage('L');
			    // Define el alias para el número de página que se imprimirá en el pie
			    $this->pdf->AliasNbPages();
			 
			    /* Se define el titulo, márgenes izquierdo, derecho y
			    * el color de relleno predeterminado
			    */
			         
			    // Se define el formato de fuente: Arial, negritas, tamaño 9
			    //$this->pdf->SetFont('Arial', 'B', 9);
			    $this->pdf->SetFont('Arial', '', 9);
			    foreach ($registros->result() as $registro) {
			        // Se imprimen los datos de cada registro
					$this->pdf->Cell(1,5,$registro->codProveedor,'',0,'L',0);
					$this->pdf->Cell(13,5,'','',0,'L',0);
					$this->pdf->Cell(45,5,utf8_decode($registro->proveedor),'',0,'L',0);
					$this->pdf->Cell(14,5,'','',0,'L',0);
		       		$this->pdf->Cell(53,5,utf8_decode($registro->direccion),'',0,'L',0);
		            $this->pdf->Cell(12,5,'','',0,'L',0);
		       		$this->pdf->Cell(30,5,utf8_decode($registro->ciudad),'',0,'L',0);
					$this->pdf->Cell(10,5,'','',0,'L',0);
		       		$this->pdf->Cell(20,5,utf8_decode($registro->telefono),'',0,'L',0);
					$this->pdf->Cell(12,5,'','',0,'L',0);
		       		$this->pdf->Cell(55,5,utf8_decode($registro->correoElectronico),'',0,'L',0);
					
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
				  
				  	$this->pdf->Output('pdfsArchivos/proveedores.pdf', 'F');
					
					$datos['documento']="pdfsArchivos/proveedores.pdf";	
					$datos['titulo']=' Listado de Proveedores';	// ... titulo ...
					
					$this->load->view('header');
					$this->load->view('reportePdfSinFechas',$datos );
					$this->load->view('footer');	
				}
			}	//.. fin IF validar usuario ...
	    
	} //... fin funcion: generarReporteProveedores ...
		
	
	
	
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */