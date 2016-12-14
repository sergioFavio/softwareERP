<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tienda extends CI_Controller {
	
	public function registrarDeposito(){
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='ventas'){  //... valida permiso de userName ...
			$datos['mensaje']='Usuario NO autorizado para registrar depósito';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}	//... fin control de permisos de acceso ....
		else {
			$this->load->view('header');
			$this->load->view('tienda/registrarDeposito' );
			$this->load->view('footer');
		}		
	}		//... fin function: registrarPedido ...
	
	public function notaEntrega(){
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='ventas'){  //... valida permiso de userName ...
			$datos['mensaje']='Usuario NO autorizado para hacer notas de entrega';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}	//... fin control de permisos de acceso ....
		else {		//... usuario validado ...
			$local= $_GET['local']; //...  local ( T:tienfa/F:fabrica ) ...		
			
			$sql="SELECT * FROM pedidoproducto WHERE estadoItem='T'"; 
			$registros = $this->db->query($sql)->result_array();
					
			$datos['registros']=$registros;		
			$datos['local']=$local;	// ... T: tienda/ F: fabrica ...
	
			$this->load->view('header');
			$this->load->view('tienda/notaEntrega',$datos);
			$this->load->view('footer');
		}	//... fin validar acceso usuario ...
	}	//... fin notaEntrega ...
	
	public function proforma(){
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='ventas'){  //... valida permiso de userName ...
			$datos['mensaje']='Usuario NO autorizado para hacer PROFORMAS';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}	//... fin control de permisos de acceso ....
		else {		//... usuario validado ...
			$local= $_GET['local']; //...  local ( T:tienfa/F:fabrica ) ...		
			
			$sql="SELECT * FROM pedidoproducto WHERE estadoItem='T'"; 
			$registros = $this->db->query($sql)->result_array();
					
			$datos['registros']=$registros;		
			$datos['local']=$local;	// ... T: tienda/ F: fabrica ...
	
			$this->load->view('header');
			$this->load->view('tienda/proforma',$datos);
			$this->load->view('footer');
		}	//... fin validar acceso usuario ...
	}	//... fin proforma ...
	
	
	public function cotizacion(){
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='ventas'){  //... valida permiso de userName ...
			$datos['mensaje']='Usuario NO autorizado para hacer SOLICITUD DE COTIZACION';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}	//... fin control de permisos de acceso ....
		else {		//... usuario validado ...
			$this->load->model("numeroDocumento_model");
			$nombreTabla='nocotizacion'; // ... prefijoTabla
	    	$pedido = $this->numeroDocumento_model->getNumero($nombreTabla);
			///////////////////////////////////////
			///...INICIO genera nuevo numero de cotizacion ...
			//////////////////////////////////////
			$secuenciaPedido= substr($pedido, 0, 4);  // toma los caracteres ... secuencia.
			$numeroCotizacion=$secuenciaPedido +1;
			
			$datos['numeroCotizacion']=$numeroCotizacion;	
	
			$this->load->view('header');
			$this->load->view('tienda/cotizacion',$datos);
			$this->load->view('footer');
		}	//... fin validar acceso usuario ...
	}	//... fin cotizacion ...
	
	
	public function grabarCotizacion(){
			
/*		
		$target_dir = "d:ayuda/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
				
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        echo "El archivo es una imagen - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "El archivo mo es una imagen.";
		        $uploadOk = 0;
		    }
		}
		
		// Check if file already exists
		if (file_exists($target_file)) {
		    echo "Error, el archivo ya existe. ";
		    $uploadOk = 0;
		}
	
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 900000) {
		    echo "Error, el archivo es demasiado grande.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "Error, solo son permitidos los siguientes formatos JPG, JPEG, PNG & GIF.";
		    $uploadOk = 0;
		}
				
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Error, el archivo no fue subido al servidor.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		        echo "El archivo ". basename( $_FILES["fileToUpload"]["name"]). " fue subido al servidor.";
		    } else {
		        echo "Ocurrió un error al subir el archivo al servidor.";
		    }
		}
		
		
*/

		$foto=''; 		//... contador de fotos subidas al servidor ...
		
		foreach ($_FILES["fileToUpload"]["error"] as $clave => $error) {
		    if ($error == UPLOAD_ERR_OK) {
		        $nombre_tmp = $_FILES["fileToUpload"]["tmp_name"][$clave];
		        // basename() puede evitar ataques de denegación del sistema de ficheros;
		        // podría ser apropiado más validación/saneamiento del nombre de fichero
		        $nombre = basename($_FILES["fileToUpload"]["name"][$clave]);
		        move_uploaded_file($nombre_tmp, "c:respaldoBD/$nombre");
				
				$foto=$foto.$nombre.'|';
				
		    }
		}		//... fin foreach ...
		
		
		$numeroFilasValidas=$_POST['numeroFilas']; //... formulario materiales ...
		$numeroCotizacion=$_POST['numeroCotizacion'];
			
		$cotizacionCabecera = array(
	    	"numCotizacion"=>$_POST['numeroCotizacion'],
		    "fechaCotizacion"=>$_POST['inputFecha'],
		    "cliente"=>$_POST['cliente'],
		    "contacto"=>$_POST['contacto'],
		    "fonoCelular"=>$_POST['telefono'],
		    "correoElectronico"=>$_POST['correo'],
		    "usuario"=>$this->session->userdata('userName')
		);
		
		// ... inserta registro tabla solcotizcabecera ...
		$this-> load -> model("tablaGenerica_model");		//carga modelo ...
	    $this-> tablaGenerica_model -> grabar('solcotizcabecera', $cotizacionCabecera);
	    
		$secuencia=0;		//...secuencia ... para cada item ...
        for($i=0; $i<$numeroFilasValidas; $i++){     			// ... formulario material
			
        	if($_POST['cantMat_'.$i] != "0" || $_POST['cantMat_'.$i] != "0.00"){
          	    //... si cantidad mayor que cero  graba registro ... 
          	    $secuencia=$i+1;
				if($secuencia<10){
					$secuencia='0'.$secuencia;
				}
          	    //... agrega registro tabla pedidoproducto ...      
	            $plantillaDetalle = array(
		           	"numeroCotizacion"=>$_POST['numeroCotizacion'],
				    "cantidad"=>$_POST['cantMat_'.$i],
				    "unidad"=>$_POST['unidadMat_'.$i],
				    "descripcion"=>$_POST['mat_'.$i],
				    "secuencia"=>$secuencia,
				    "dCliente"=>$_POST['cliente'],
				    "dContacto"=>$_POST['contacto'],
				    "dcorreoElectronico"=>$_POST['correo']
				);
			
				// ... inserta registro tabla transacciones ... cotizacionmaterial 
				$this-> load -> model("tablaGenerica_model");		//carga modelo 
	    		$this-> tablaGenerica_model -> grabar('solcotizdetalle',$plantillaDetalle);			
				// ... fin de inserción  registro tabla transacciones ... solcotizdetalle
				
			}	// ... fin IF
			
		}  // ... fin  FOR 
		
		// ... actualizar numero de cotizacion ...		
		$this-> load -> model("numeroDocumento_model");	//... modelo numeroDocumento_model ... cotizacion
		$nombreTabla='nocotizacion'; // ... prefijoTabla
		$this-> numeroDocumento_model -> actualizar($numeroCotizacion,$nombreTabla);
		// fin actualizar numero de cotizacion ...
		
		redirect("tienda/generarSolicitudCotizacionPDF?numeroCotizacion=$numeroCotizacion&foto=$foto");
		
	}	//... fin grabarCotizacion ...
	
	
	public function realizarPedido(){
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='ventas' && $permisoMenu!='produccion'){  //... valida permiso de userName y de menu ...
			$datos['mensaje']='Usuario NO autorizado para operar Sistema de Ventas';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}
		else{		//... fin control de permisos de acceso ....
			$local= $_GET['local']; //... lee local que viene del menu principal(T: tienda/F: fabrica ) ...	
			$this->load->model("numeroDocumento_model");
			$nombreTabla='nopedido'.strtolower($local); // ... prefijoTabla
	    	$pedido = $this->numeroDocumento_model->getNumero($nombreTabla);
			
			///////////////////////////////////////
			///...INICIO genera nuevo numero de pedido ...
			//////////////////////////////////////

			if($local=="F"){
				$anhoSistema = date("Y");	//... anho del sistema
 				$anhoSistema = substr($anhoSistema, 2, 2);	//... anho del sistema
 				
				if(strlen($pedido)==2 ){
					$secuenciaPedido= 0;  // toma los caracteres ... secuencia.
					$anhoPedido= substr($pedido, 0, 2);  // toma los primeros 4 caracteres ... anho.
				}
				
				if(strlen($pedido)==3 ){
					$secuenciaPedido= substr($pedido, 0, 1);  // toma los caracteres ... secuencia.
					$anhoPedido= substr($pedido, 1, 2);  // toma los primeros 4 caracteres ... anho.
				}
				
				if(strlen($pedido)==4 ){
					$secuenciaPedido= substr($pedido, 0, 2);  // toma los caracteres ... secuencia.
					$anhoPedido= substr($pedido, 2, 2);  // toma los primeros 4 caracteres ... anho.
				}
				
				if(strlen($pedido)==5 ){
					$secuenciaPedido= substr($pedido, 0, 3);  // toma los caracteres ... secuencia.
					$anhoPedido= substr($pedido, 3, 2);  // toma los primeros 4 caracteres ... anho.
				}
				
			}else{		//...cuando el local es T:tienda ...
				$anhoSistema = date("Y");	//... anho del sistema
 				$anhoSistema = substr($anhoSistema, 0, 4);	//... anho del sistema
 					
				if(strlen($pedido)==4 ){
					$secuenciaPedido= 0;  // toma los caracteres ... secuencia.
					$anhoPedido= substr($pedido, 0, 4);  // toma 4 caracteres ... anho.
				}
				
				if(strlen($pedido)==5 ){
					$secuenciaPedido= substr($pedido, 0,1);  // toma los caracteres ... secuencia.
					$anhoPedido= substr($pedido, 1, 4);  // toma 4 caracteres ... anho.
				}
			
				if(strlen($pedido)==6 ){
					$secuenciaPedido= substr($pedido, 0,2);  // toma los caracteres ... secuencia.
					$anhoPedido= substr($pedido, 2, 4);  // toma 4 caracteres ... anho.
				}
				
				if(strlen($pedido)==7 ){
					$secuenciaPedido= substr($pedido, 0,3);  // toma los caracteres ... secuencia.
					$anhoPedido= substr($pedido, 3, 4);  // toma 4 caracteres ... anho.
				}
			
			}
		
			if($anhoPedido!=$anhoSistema){
				$secuenciaPedido="1";
			}else{		//... si anhoPedido==anhoSistema ...
		     	$secuenciaPedido=$secuenciaPedido+1;
			}
			
			$pedido=$secuenciaPedido.$anhoSistema;	
			
			///////////////////////////////////////
			///...FIN genera nuevo numero de pedido ...
			//////////////////////////////////////
		
			$this->load->model("inventarios/maestroMaterial_model");	//...carga el modelo tabla maestra[almacen/bodega]
			$insumos= $this->maestroMaterial_model->getTodos('productosfabrica'); //..una vez cargado el modelo de la tabla llama almacen/bodega..
			$datos['local']=$local;					//... T: tienda / F: fabrica ...		
			$datos['titulo']='productosfabrica';
			$datos['secuenciaPedido']=$secuenciaPedido;
			$datos['anhoSistema']=$anhoSistema;
			$datos['pedido']=$pedido;
			$datos['insumos']=$insumos;	
				
			$this->load->view('header');
			$this->load->view('tienda/pedido',$datos);
			$this->load->view('footer');
		}		//... fin IF validar usuario ...
	}	//..fin realizarPedido ...
	

	public function grabarPedido()
	{		
		$numeroFilasValidas=$_POST['numeroFilas']; //... formulario materiales ...
		$local=$_POST['local'];
		$numPedido=$_POST['numPedido'];
		$secuenciaPedido=$_POST['secuenciaPedido'];
		$anhoSistema=$_POST['anhoSistema'];
			
		$pedidoCabecera = array(
	    	"numPedido"=>$_POST['numPedido'],
	    	"local"=>$_POST['local'],
		    "fechaPedido"=>$_POST['inputFecha'],
		    "fechaEntrega"=>$_POST['inputEntrega'],
		    "cliente"=>$_POST['cliente'],
		    "contacto"=>$_POST['contacto'],
		    "direccion"=>$_POST['direccion'],
		    "telCel"=>$_POST['telCel'],
		    "localidad"=>$_POST['localidad'],
		    "cotizacionFabrica"=>$_POST['cotizacionFabrica'],
		    "ordenCompra"=>$_POST['ordenCompra'],
		    "facturarA"=>$_POST['facturarA'],
		    "nit"=>$_POST['nit'],
		    "montoTotal"=>str_replace(",","",$_POST['detalleTotalBs']), //...quita , como separador de miles ...
		    "aCuenta"=>str_replace(",","",$_POST['aCuenta']), //...quita , como separador de miles ...
		    "descuento"=>$_POST['descuento'],
		    "usuario"=>$this->session->userdata('userName'),
		    "estado"=>"I",
		    "fechaEstado"=>$_POST['inputFecha']
		);
		
		// ... inserta registro tabla pedidocabecera ...
		$this-> load -> model("tablaGenerica_model");		//carga modelo ...
	    $this-> tablaGenerica_model -> grabar('pedidocabecera', $pedidoCabecera);
		
		$secuencia=0;		//...secuencia ... para cada item ...
        for($i=0; $i<$numeroFilasValidas; $i++){     			// ... formulario material
			$codigoSinEspacio=str_replace(" ","",$_POST['idMat_'.$i]); //...quita espacio en blanco ..
			
        	if($_POST['cantMat_'.$i] != "0" || $_POST['cantMat_'.$i] != "0.00"){
          	    //... si cantidad mayor que cero  graba registro ... 
          	    $secuencia=$i+1;
				if($secuencia<10){
					$secuencia='0'.$secuencia;
				}
          	    //... agrega registro tabla pedidoproducto ...      
	            $plantillaProducto = array(
	            	"numeroPedido"=>$numPedido,
				    "idProducto"=>$codigoSinEspacio,
				    "descripcion"=>$_POST['mat_'.$i],
				    "color"=>$_POST['colorMat_'.$i],
				    "cantidad"=>$_POST['cantMat_'.$i],
				    "unidad"=>$_POST['unidadMat_'.$i],
				    "precio"=>$_POST['precioMat_'.$i],
				    "secuencia"=>$secuencia,
				    "cliente"=>$_POST['cliente'],
				    "fechaEntrega"=>$_POST['inputEntrega']
				);
			
				// ... inserta registro tabla transacciones ... cotizacionmaterial 
				$this-> load -> model("tablaGenerica_model");		//carga modelo 
	    		$this-> tablaGenerica_model -> grabar('pedidoproducto',$plantillaProducto);			
				// ... fin de inserción  registro tabla transacciones ... cotizacionmaterial
				
			}	// ... fin IF
			
		}  // ... fin  FOR 
			
		// ... actualizar numero de cotizacion ...	
		$this-> load -> model("numeroDocumento_model");	//... modelo numeroDocumento_model ... cotizacion
		$nombreTabla='nopedido'.strtolower($local); // ... prefijoTabla ... F: fabrica  T: tienda ...
		
		$this-> numeroDocumento_model -> actualizar($numPedido,$nombreTabla);
		// fin actualizar numero de cotizacion ...
		
		redirect("tienda/generarPedidoPDF?numeroPedido=$numPedido&local=$local&secuenciaPedido=$secuenciaPedido&anhoSistema=$anhoSistema");
		
	}	//... fin grabarPedido	

	
	
			
	/////////////////////////////////////////////
	//... funciones del CRUD pedidos ...//
	/////////////////////////////////////////////
	
	public function verPedidos()
	{
		//... control de permisos de acceso ....
		
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='ventas'){  //... valida permiso de userName y de menu ...
			$datos['mensaje']='Usuario NO autorizado para operar Sistema de Ventas';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
//			redirect('menuController/index');
		}			// ... fin control permiso de accesos...
		else {
			$this->load->model("tablaGenerica_model");
			
			/* URL a la que se desea agregar la paginación*/
	    	$config['base_url'] = base_url().'tienda/verPedidos';
			
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
				$this->load->view('tienda/verPedidos', $datos);
				$this->load->view('footer');
					
			}//..fin IF contador registros mayor que cero ..
		}	//... fin IF validar usuario ...
		
	} //... fin verPedidos ...
	
	 
	public function buscarPedido(){
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
	    	$config['base_url'] = base_url().'tienda/buscarPedido';
			
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
			$this->load->view('tienda/verPedidos', $datos);
			$this->load->view('footer');
		}		//... fin IF total registros encintrados ...
		
	}		//... fin funcion: buscarPedido ...

	
	public function reportePdfCrud(){
		//... recupera la variable de numePedido ...
		$numePedido=$_POST["numePedido"];

		?>
		<embed src="<?= base_url('pdfsArchivos/pedidos/pedido'.$numePedido.'.pdf') ?>" width="820" height="455" id="sergio"> <!-- documento embebido PDF -->
		<?php
	}	

		public function crudProducto(){
		
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoDeposito=$this->session->userdata('usuarioDeposito');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' ){  //... valida permiso de userName ...
			$datos['mensaje']='Usuario NO autorizado para operar CRUD de Productos';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}	//... fin control de permisos de acceso ....
		else {		//... usuario validado ...
			$nombreDeposito='productosfabrica';
			$this->load->model("tablaGenerica_model");
			
			/* URL a la que se desea agregar la paginación*/
	    	$config['base_url'] = base_url().'tienda/crudProducto';
			
			/*Obtiene el total de registros a paginar */
	    	$config['total_rows'] = $this->tablaGenerica_model->get_total_registros($nombreDeposito);
			
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
		   		$datos['listaProducto'] = $this->tablaGenerica_model->get_registros($nombreDeposito,$config['per_page'], $desde); 
		
				$datos['consultaProducto'] ='';
				
		 		/*Se llama a la vista para mostrar la información*/
				$this->load->view('header');
				$this->load->view('tienda/mostrarProductosCrud', $datos);
				$this->load->view('footer');
				
			}  // fin else cuando hay registros 
		}	//... fin IF validar usuarios...
		
	} //... fin crudProducto
	
	
	public function actualizarProductoCrud(){
		//... edita registro de la tabla [productosfabrica] ...
		$registro=array(
        	"nombreProd"=>$this->input->post("inputDescripcionM"),
        	"medidas"=>$this->input->post("inputMedidasM"),
        	"unidad"=>$this->input->post("inputUnidadM"),
        	"precioVenta"=>$this->input->post("inputPrecioVentaM"),
        	"stockMinimo"=>$this->input->post("inputEstockMinimoM")
       	);
				
		$this-> load -> model("tablaGenerica_model");
   		$this-> tablaGenerica_model -> editarRegistro('productosfabrica','idProd',$this->input->post("inputCodigoM"),$registro);
  
		$data=base_url("tienda/crudProducto");
		echo $data;
	}		//... fin actualizarProductoCrud ...
	
	
	public function eliminarProductoCrud(){
		//... elimina registro de la tabla [productosfabrica] ...
		$codigoProducto=$_POST['codigo'];
		$this-> load -> model("tablaGenerica_model");
   		$this-> tablaGenerica_model -> eliminar('productosfabrica','idProd',$codigoProducto);
		$data=base_url("tienda/crudProducto");
		echo $data;
	}	//...fin eliminarProductoCrud ...
	
	
		public function buscarProductoCrud(){
		//... buscar los registros que coincidan con el patron busqueda ingresado ...
	
		if(isset($_POST['inputBuscarPatron'])){
			$consultaProducto=$_POST['inputBuscarPatron'];
			
			// Escribimos una primera línea en consultaCrud.txt
			$fp = fopen("pdfsArchivos/consultaCrud.txt", "w");
			fputs($fp, $consultaProducto);
			fclose($fp); 

		}else{
			// Leemos la primera línea de consultaCrud.txt
			// fichero.txt es un archivo de texto normal creado con notepad, por ejemplo.
			$fp = fopen("pdfsArchivos/consultaCrud.txt", "r");
			$consultaProducto = fgets($fp);
			fclose($fp); 
		}	
				
		$this-> load -> model("tablaGenerica_model");
		
		$totalRegistrosEncontrados=0;		
		$totalRegistrosEncontrados=$this->tablaGenerica_model->getTotalRegistrosBuscar('productosfabrica','nombreProd',$consultaProducto);
		//echo"total registros econtrados".$totalRegistrosEncontrados;
		if($totalRegistrosEncontrados==0){
		//	$datos['mensaje']='No hay registros grabados en la tabla '.$nombreTabla;
		//	$this->load->view('mensaje',$datos );
		//	redirect('produccion/crudVerCotizaciones');
			redirect('menuController/index');
		}else{
			/* URL a la que se desea agregar la paginación*/
	    	$config['base_url'] = base_url().'tienda/buscarProductoCrud';
			
			/*Obtiene el total de registros a paginar */
			$config['total_rows'] = $this->tablaGenerica_model->getTotalRegistrosBuscar('productosfabrica','nombreProd',$consultaProducto);
	
		
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
			$datos['listaProducto'] = $this-> tablaGenerica_model -> buscarPaginacion('productosfabrica','nombreProd',$consultaProducto, $config['per_page'], $desde );
			
			$datos['consultaProducto'] =$consultaProducto;
			
			/*Se llama a la vista para mostrar la información*/
			$this->load->view('header');
			$this->load->view('tienda/mostrarProductosCrud', $datos);
			$this->load->view('footer');
		
		}     //... fin IF total registros encontrados ...
	}		//.. fin buscarProductoCrud ..
	
	
	function validarCodigoProductoCrud(){
		//... recupera la variable de codigoProducto ...
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
		
	}	//... fin validarCodigoProductoCrud() ...
	
	
	public function grabarNuevoProductoCrud(){
	//... graba un nuevoProducto en tabla productosfabrica ...
		$registro=array(
       		"idProd"=>$this->input->post("inputCodigo"),
        	"nombreProd"=>$this->input->post("inputDescripcion"),
        	"medidas"=>$this->input->post("inputMedidas"),
        	"existencia"=>$this->input->post("inputExistencia"),
        	"unidad"=>$this->input->post("inputUnidad"),
        	"precioVenta"=>$this->input->post("inputPrecioVenta"),
        	"stockMinimo"=>$this->input->post("inputEstockMinimo")
       	);

		$this-> load -> model("tablaGenerica_model");
   		$this-> tablaGenerica_model -> grabar('productosfabrica',$registro);
   		redirect('tienda/crudProducto');  //...vuelve a la vista: mostrarMaterialesCrud ...
	}		//... fin grabarNuevoProductoCrud ...
	
	
	
//... fin de funciones CRUD ...
////////////////////////////////
  

/////////////////////////////////////
//... inicio funciones reportesPDF
/////////////////////////////////////

	public function generarSolicitudCotizacionPDF(){
		//... genera reporte de salida en PDF

		$numeroCotizacion= $_GET['numeroCotizacion']; 	//... lee numeroCotizacion que viene de grabarCotizacion ...
		$foto= $_GET['foto']; 							//... lee foto que viene de grabarCotizacion ...
		
		// Se carga la libreria fpdf
		$this->load->library('tienda/SolicitudCotizacionPdf');
		
		// Se obtienen los registros de la base de datos
		$sql ="SELECT cantidad,unidad,descripcion FROM solcotizdetalle WHERE numeroCotizacion='$numeroCotizacion' ";
		$regDetalles = $this->db->query($sql);
						
		$this->load->model("tablaGenerica_model");	//...carga el modelo tabla generica ...
		$registroCabecera= $this->tablaGenerica_model->buscar('solcotizcabecera','numCotizacion',$numeroCotizacion); //..una vez cargado el modelo de la tabla llama cotizacioncabecera..
		
		$fechaCotizacion= $registroCabecera["fechaCotizacion"];		// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$cliente= $registroCabecera["cliente"];						// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$contacto= $registroCabecera["contacto"];					// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$fonoCelular= $registroCabecera["fonoCelular"];				// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$correoElectronico= $registroCabecera["correoElectronico"];	// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$usuario= $registroCabecera["usuario"];						// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
					
		$sql ="SELECT * FROM solcotizcabecera WHERE numCotizacion='$numeroCotizacion' ";
		$contador = $this->db->query($sql);	
 		$contador= $contador->num_rows; //...contador de registros que satisfacen la consulta ..

		if($contador==0){
			$datos['mensaje']='No hay registro grabado con el n&uacute;mero de  cotización '.$numeroCotizacion.' en la tabla SOLCOTIZCABECERA.';
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
		    $this->pdf = new SolicitudCotizacionPdf();
			
			$this->pdf->numeCotizacion=$numeroCotizacion;      					//...pasando variable para el header del PDF
			$this->pdf->fechaCotizacion=fechaMysqlParaLatina($fechaCotizacion); 	//...pasando variable para el header del PDF
			$this->pdf->cliente=$cliente; 											//...pasando variable para el header del PDF
			$this->pdf->contacto=$contacto; 										//...pasando variable para el header del PDF
			$this->pdf->fonoCelular=$fonoCelular; 									//...pasando variable para el header del PDF
			$this->pdf->correoElectronico=$correoElectronico; 						//...pasando variable para el header del PDF
			$this->pdf->usuario=$usuario; 											//...pasando variable para el header del PDF
			
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
		    
		    foreach ($regDetalles->result() as $registroDetalle) {
		        // se imprime el numero actual y despues se incrementa el valor de $x en uno
		        // Se imprimen los datos de cada registro
				$this->pdf->Cell(1);
				$this->pdf->Cell(10,5,number_format($registroDetalle->cantidad,0),'',0,'R',0);
				$this->pdf->Cell(9,5,$registroDetalle->unidad,'',0,'C',0);
				$this->pdf->Cell(94,5,utf8_decode(substr($registroDetalle->descripcion,0,115) ),'',0,'L',0);
				
				if(substr($registroDetalle->descripcion,115,115)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(20);
					$this->pdf->Cell(85,5,utf8_decode(substr($registroDetalle->descripcion,115,115) ),0,0,'L');
				}
				
				if(substr($registroDetalle->descripcion,230,115)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(20);
					$this->pdf->Cell(85,5,utf8_decode(substr($registroDetalle->descripcion,230,115) ),0,0,'L');
				}
				
				if(substr($registroDetalle->descripcion,345,115)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(20);
					$this->pdf->Cell(85,5,utf8_decode(substr($registroDetalle->descripcion,345,115) ),0,0,'L');
				}
				
				if(substr($registroDetalle->descripcion,460,115)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(20);
					$this->pdf->Cell(85,5,utf8_decode(substr($registroDetalle->descripcion,460,115) ),0,0,'L');
				}
				
				if(substr($registroDetalle->descripcion,575,115)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(20);
					$this->pdf->Cell(85,5,utf8_decode(substr($registroDetalle->descripcion,575,115) ),0,0,'L');
				}
				
				if(substr($registroDetalle->descripcion,690,115)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(20);
					$this->pdf->Cell(85,5,utf8_decode(substr($registroDetalle->descripcion,690,115) ),0,0,'L');
				}
				
				$this->pdf->Ln(5);
				$this->pdf->Ln(5);
		    }

			$plano='';
			while(strlen($foto) > 0) {
				$pos = strpos($foto, '|');
			    $plano=substr($foto,0,$pos);
				
				$this->pdf->Ln(5);
				$this->pdf->Image('c:respaldoBD/'.$plano,20,96,176);
				$foto=substr($foto,$pos+1,strlen($foto)-$pos);
				for($x=0; $x<50; $x++){
					$this->pdf->Ln(5);
					$this->pdf->Cell(10,5,number_format($x,0),'',0,'R',0);
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
			  
			 $this->pdf->Output('pdfsArchivos/cotizaciones/solCotiz'.$numeroCotizacion.'.pdf', 'F');
			 
			 $datos['documento']='pdfsArchivos/cotizaciones/solCotiz'.$numeroCotizacion.'.pdf';	
			 $datos['titulo']=' Solicitud de Cotización No. '.$numeroCotizacion;	// ... titulo ...		
			 $this->load->view('header');
			 $this->load->view('reportePdfSinFechas',$datos );
			 $this->load->view('footer');			
		}
	    
	} //... fin funcion: generarSolicitudCotizacionPDF ...
	

	public function generarPedidoPDF(){
		//... genera reporte de salida en PDF

		$numeroPedido= $_GET['numeroPedido']; 			//... lee numeroPedido que viene de grabarPedido ...
		$local= $_GET['local']; 						//... lee local que viene de grabarPedido ...
		$secuenciaPedido= $_GET['secuenciaPedido'];		//... lee local que viene de grabarPedido ...
		$anhoSistema= $_GET['anhoSistema']; 			//... lee local que viene de grabarPedido ...
		
		$nombreLocal='';
		if($local=='T'){
			$nombreLocal='Tienda';
		}else{
			$nombreLocal='Fábrica';
		}
		
		// Se carga la libreria fpdf
		$this->load->library('tienda/EstructuraPedidoPdf');
		
 
		// Se obtienen los registros de la base de datos
		//$salidas = $this->db->query('SELECT t1.numSal, fecha,numOrden, glosa,idMaterial,nombreInsumo, cantidad,unidad,tipoInsumo FROM '.$salidaMaterial.' t1, '.$salidaCabecera.' t2, '.$maestroMaterial.' t3 WHERE t1.numSal = t2.numero AND  t1.idMaterial=t3.codInsumo ORDER BY t1.numSal');
		$sql ="SELECT numeroPedido,idProducto,descripcion,color,cantidad,unidad,precio FROM pedidoproducto WHERE numeroPedido='$numeroPedido' ";
		$productos = $this->db->query($sql);
						
		$this->load->model("tablaGenerica_model");	//...carga el modelo tabla generica ...
		$pedidoCabecera= $this->tablaGenerica_model->buscar('pedidocabecera','numPedido',$numeroPedido); //..una vez cargado el modelo de la tabla llama cotizacioncabecera..
		
		$fechaPedido= $pedidoCabecera["fechaPedido"];		// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$fechaEntrega= $pedidoCabecera["fechaEntrega"];		// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$cliente= $pedidoCabecera["cliente"];				// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$contacto= $pedidoCabecera["contacto"];				// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$direccion= $pedidoCabecera["direccion"];			// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$fono= $pedidoCabecera["telCel"];					// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$localidad= $pedidoCabecera["localidad"];			// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$cotizacionFabrica= $pedidoCabecera["cotizacionFabrica"];	// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$ordenCompra= $pedidoCabecera["ordenCompra"];				// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$facturarA= $pedidoCabecera["facturarA"];					// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$nit= $pedidoCabecera["nit"];								// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$aCuenta= $pedidoCabecera["aCuenta"];						// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$descuento= $pedidoCabecera["descuento"];					// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$usuario= $pedidoCabecera["usuario"];						// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
					
		$sql ="SELECT * FROM pedidocabecera WHERE numPedido='$numeroPedido' ";
		$contador = $this->db->query($sql);	
 		$contador= $contador->num_rows; //...contador de registros que satisfacen la consulta ..

		if($contador==0){
			$datos['mensaje']='No hay registro grabado con el n&uacute;mero de  pedido '.$numeroPedido.' en la tabla PEDIDOcabecera.';
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
		    $this->pdf = new EstructuraPedidoPdf();
			
			$this->pdf->local=$nombreLocal;   			   					//...pasando variable para el header del PDF
			$this->pdf->numeroPedido=strtoupper($numeroPedido);      		//...pasando variable para el header del PDF
			$this->pdf->fechaPedido=fechaMysqlParaLatina($fechaPedido); 	//...pasando variable para el header del PDF
			$this->pdf->fechaEntrega=fechaMysqlParaLatina($fechaEntrega); 	//...pasando variable para el header del PDF
			$this->pdf->cliente=$cliente; 									//...pasando variable para el header del PDF
			$this->pdf->contacto=$contacto; 								//...pasando variable para el header del PDF
			$this->pdf->direccion=$direccion; 								//...pasando variable para el header del PDF
			$this->pdf->fonoCelular=$fono; 									//...pasando variable para el header del PDF
			$this->pdf->localidad=$localidad; 								//...pasando variable para el header del PDF
			$this->pdf->cotizacionFabrica=$cotizacionFabrica; 				//...pasando variable para el header del PDF
			$this->pdf->ordenCompra=$ordenCompra; 							//...pasando variable para el header del PDF
			$this->pdf->facturarA=$facturarA; 								//...pasando variable para el header del PDF
			$this->pdf->nit=$nit; 											//...pasando variable para el header del PDF
			$this->pdf->usuario=$usuario; 									//...pasando variable para el header del PDF
			
			$this->pdf->secuenciaPedido=$secuenciaPedido; 					//...pasando variable para el header del PDF
			$this->pdf->anhoSistema=$anhoSistema; 							//...pasando variable para el header del PDF
			
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
			$totalPorNumeroPedido=0; //... acumula los importes de cada nota de ingreso...
		    foreach ($productos->result() as $producto) {
		        // se imprime el numero actual y despues se incrementa el valor de $x en uno
		        // Se imprimen los datos de cada registro

				$this->pdf->Cell(15,5,$producto->idProducto,'',0,'L',0);
				$this->pdf->Cell(94,5,utf8_decode(substr($producto->descripcion,0,56) ),'',0,'L',0);
				$this->pdf->Cell(20,5,number_format($producto->cantidad,2),'',0,'R',0);
				$this->pdf->Cell(20,5,$producto->unidad,'',0,'C',0);
				$this->pdf->Cell(19,5,number_format($producto->precio,2),'',0,'R',0);
				$this->pdf->Cell(21,5,number_format($producto->cantidad*$producto->precio,2),'',0,'R',0);
				
				if(substr($producto->descripcion,56,120)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($producto->descripcion,56,120) ),0,0,'L');
				}
				
				if(substr($producto->descripcion,176,120)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($producto->descripcion,176,120) ),0,0,'L');
				}
				
				if(substr($producto->descripcion,296,120)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($producto->descripcion,296,120) ),0,0,'L');
				}
				
				if(substr($producto->descripcion,416,120)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($producto->descripcion,416,120) ),0,0,'L');
				}
				
				if(substr($producto->descripcion,536,120)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($producto->descripcion,536,120) ),0,0,'L');
				}
				
				if(substr($producto->descripcion,656,120)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($producto->descripcion,656,120) ),0,0,'L');
				}
				
				$this->pdf->Ln('5');
				$this->pdf->Cell(15,5,'','',0,'L',0);
				$this->pdf->Cell(32,5,utf8_decode($producto->color),'',0,'L',0);
				
				
				$totalPorNumeroPedido=$totalPorNumeroPedido +( $producto->cantidad*$producto->precio ); //... acumula los importes de cada nota de ingreso...
		        //Se agrega un salto de linea
		        $this->pdf->Ln('5');
		    }

			$this->pdf->Ln('5');
			$this->pdf->Cell(147,5,'','',0,'L',0);
    		$this->pdf->Cell(42,5,'Total Bs. '.number_format($totalPorNumeroPedido,2),0,0,'R');
	
			$this->pdf->Ln('5');
			$this->pdf->Cell(147,5,'','',0,'L',0);
    		$this->pdf->Cell(42,5,'A Cuenta Bs.    '.number_format($aCuenta,2),0,0,'R');
			
			$this->pdf->Ln('5');
			$this->pdf->Cell(147,5,'','',0,'L',0);
    		$this->pdf->Cell(42,5,'Descuento  '.$descuento.'% Bs.    '.number_format($totalPorNumeroPedido*$descuento/100,2),0,0,'R');

			$this->pdf->Ln('5');
			$this->pdf->Cell(147,5,'','',0,'L',0);
    		$this->pdf->Cell(42,5,'Saldo Bs. '.number_format($totalPorNumeroPedido*(1-($descuento/100))-$aCuenta,2),0,0,'R');
			
			
			
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
			  
			 $this->pdf->Output('pdfsArchivos/pedidos/pedido'.$numeroPedido.'.pdf', 'F');
	
			 redirect("menuController/index");			
					
		}
	    
	} //... fin funcion: generarPedidoPDF ...

	
	public function listaPreciosProductos(){
		//... genera listaPreciosProductos en PDF
		
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoProceso3=$this->session->userdata('usuarioProceso3');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='ventas'){  //... valida permiso de userName y de menu...
			$datos['mensaje']='Usuario NO autorizado para ver la lista de precios de productos';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}	//... fin control de permisos de acceso ....
		else {		//... usuario validado ...
			// Se carga la libreria fpdf
			$this->load->library('tienda/ListaPreciosProductosPdf');
			
			// Se obtienen los registros de la base de datos
			$sql="SELECT idProd,nombreProd,medidas,unidad,precioVenta FROM productosfabrica";
			
			$registros = $this->db->query($sql);
			 
			$contador= $registros->num_rows; //...contador de registros que satisfacen la consulta ..
			
			if($contador==0){
				$datos['mensaje']='No hay registros en la tabla de PRODUCTOS FABRICA.';
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
			    $this->pdf = new ListaPreciosProductosPdf();
				
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
					$this->pdf->Cell(2,5,$registro->idProd,'',0,'L',0);
					$this->pdf->Cell(20,5,'','',0,'L',0);
					$this->pdf->Cell(95,5,utf8_decode(substr($registro->nombreProd,0,55)),'',0,'L',0);
		       		$this->pdf->Cell(30,5,utf8_decode($registro->medidas),'',0,'L',0);
					$this->pdf->Cell(20,5,'','',0,'L',0);
					$this->pdf->Cell(20,5,number_format($registro->precioVenta,2),'',0,'R',0);
					
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
				  
				  	$this->pdf->Output('pdfsArchivos/ventas/listaPrecios.pdf', 'F');
					
					$datos['documento']="pdfsArchivos/ventas/listaPrecios.pdf";	
					$datos['titulo']=' Lista de Precios';	// ... titulo ...
					
					$this->load->view('header');
					$this->load->view('reportePdfSinFechas',$datos );
					$this->load->view('footer');
				}
			}	//.. fin IF validar usuario ...
	    
	} //... fin funcion: listaPreciosProductos ...
	
	
//... fin funciones reportes PDF ...
////////////////////////////////////


	public function grabarDeposito(){		
		$numeroFilasValidas=$_POST['numeroFilas']; //... formulario materiales ...
		$local=$_POST['local'];
		$numPedido=$_POST['numPedido'];
			
		$pedidoCabecera = array(
	    	"numPedido"=>$_POST['numPedido'],
	    	"local"=>$_POST['local'],
		    "fechaPedido"=>$_POST['inputFecha'],
		    "fechaEntrega"=>$_POST['inputEntrega'],
		    "cliente"=>$_POST['cliente'],
		    "contacto"=>$_POST['contacto'],
		    "direccion"=>$_POST['direccion'],
		    "telCel"=>$_POST['telCel'],
		    "localidad"=>$_POST['localidad'],
		    "cotizacionFabrica"=>$_POST['cotizacionFabrica'],
		    "ordenCompra"=>$_POST['ordenCompra'],
		    "facturarA"=>$_POST['facturarA'],
		    "nit"=>$_POST['nit'],
		    "montoTotal"=>str_replace(",","",$_POST['detalleTotalBs'])*(1-($_POST['descuento']/100)), //...quita , como separador de miles ...
		    "aCuenta"=>str_replace(",","",$_POST['aCuenta']), //...quita , como separador de miles ...
		    "descuento"=>$_POST['descuento'],
		    "usuario"=>$this->session->userdata('userName'),
		    "estado"=>"I",
		    "fechaEstado"=>$_POST['inputFecha']
		);
		
		// ... inserta registro tabla pedidocabecera ...
		$this-> load -> model("tablaGenerica_model");		//carga modelo ...
	    $this-> tablaGenerica_model -> grabar('pedidocabecera', $pedidoCabecera);
		
		$secuencia=0;		//...secuencia ... para cada item ...
        for($i=0; $i<$numeroFilasValidas; $i++){     			// ... formulario material
			$codigoSinEspacio=str_replace(" ","",$_POST['idMat_'.$i]); //...quita espacio en blanco ..
			
        	if($_POST['cantMat_'.$i] != "0" || $_POST['cantMat_'.$i] != "0.00"){
          	    //... si cantidad mayor que cero  graba registro ... 
          	    $secuencia=$i+1;
				if($secuencia<10){
					$secuencia='0'.$secuencia;
				}
          	    //... agrega registro tabla pedidoproducto ...      
	            $plantillaProducto = array(
	            	"numeroPedido"=>$numPedido,
				    "idProducto"=>$codigoSinEspacio,
				    "descripcion"=>$_POST['mat_'.$i],
				    "color"=>$_POST['colorMat_'.$i],
				    "cantidad"=>$_POST['cantMat_'.$i],
				    "unidad"=>$_POST['unidadMat_'.$i],
				    "precio"=>$_POST['precioMat_'.$i],
				    "secuencia"=>$secuencia,
				    "cliente"=>$_POST['cliente'],
				    "fechaEntrega"=>$_POST['inputEntrega']
				);
			
				// ... inserta registro tabla transacciones ... cotizacionmaterial 
				$this-> load -> model("tablaGenerica_model");		//carga modelo 
	    		$this-> tablaGenerica_model -> grabar('pedidoproducto',$plantillaProducto);			
				// ... fin de inserción  registro tabla transacciones ... cotizacionmaterial
				
			}	// ... fin IF
			
		}  // ... fin  FOR 
			
		// ... actualizar numero de cotizacion ...	
		$this-> load -> model("numeroDocumento_model");	//... modelo numeroDocumento_model ... cotizacion
		$nombreTabla='nopedido'.strtolower($local); // ... prefijoTabla ... F: fabrica  T: tienda ...
		
		$this-> numeroDocumento_model -> actualizar($numPedido,$nombreTabla);
		// fin actualizar numero de cotizacion ...
		
		redirect("tienda/generarPedidoPDF?numeroPedido=$numPedido&local=$local");
		
	}	//... fin grabarDeposito ...	
 
}


/* End of file produccion.php */