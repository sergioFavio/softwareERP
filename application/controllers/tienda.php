<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tienda extends CI_Controller {
	
		
	public function cuentasPorCobrarZ(){
		//... control de permisos de acceso ....
		
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='ventas' && $permisoMenu!='contabilidad'){  //... valida permiso de userName y de menu ...
			$datos['mensaje']='Usuario NO autorizado para operar Sistema de Ventas';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}			// ... fin control permiso de accesos...
		else{
//			$local= $_GET['local']; //... lee local que viene del menu principal(T: tienda/F: fabrica/Z:zuñiga ) ...	
			$local='Z';	
		
			$this->load->model("tablaGenerica_model");
			
			/* URL a la que se desea agregar la paginación*/
			
	    	$config['base_url'] = base_url().'tienda/cuentasPorCobrarZ';
					
			/*Obtiene el total de registros a paginar */
			if($local=='Z'){									//.. cuando local es Z:Zúñiga ...		
	    		$config['total_rows'] = $this->tablaGenerica_model->get_total_registros('pedidocabeceraz');
				$contador= $this->tablaGenerica_model->get_total_registros('pedidocabeceraz'); //...contador de registros  ...	
			}else{												//.. cuando local es tienda o Fabrica ...	
	    		$config['total_rows'] = $this->tablaGenerica_model->get_total_registros('pedidocabecera');
				$contador= $this->tablaGenerica_model->get_total_registros('pedidocabecera'); //...contador de registros  ...	
			}
			
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
				if($local=='Z'){									//.. cuando local es Z:Zúñiga ...		
					$datos['listaPedido'] = $this->tablaGenerica_model->get_registros('pedidocabeceraz',$config['per_page'], $desde); 
				}else{												//.. cuando local es tienda o Fabrica ...	
					$datos['listaPedido'] = $this->tablaGenerica_model->get_registros('pedidocabecera',$config['per_page'], $desde); 
				}
			
				$datos['consultaPedido'] ='';
				$datos['local'] =$local;
				/*Se llama a la vista para mostrar la información*/
				$this->load->view('header');
				$this->load->view('tienda/verCuentasPorCobrar', $datos);
				$this->load->view('footer');
					
			}//..fin IF contador registros mayor que cero ..
		}	//... fin IF validar usuario ...
		
	} //... fin cuentasPorCobrarZ...
	
	
	
	public function cuentasPorCobrar(){
		//... control de permisos de acceso ....
		
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='ventas' && $permisoMenu!='contabilidad'){  //... valida permiso de userName y de menu ...
			$datos['mensaje']='Usuario NO autorizado para operar Sistema de Ventas';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}			// ... fin control permiso de accesos...
		else{
//			$local= $_GET['local']; //... lee local que viene del menu principal(T: tienda/F: fabrica/Z:zuñiga ) ...	
			$local='O';	
		
			$this->load->model("tablaGenerica_model");
			
			/* URL a la que se desea agregar la paginación*/
			
	    	$config['base_url'] = base_url().'tienda/cuentasPorCobrar';
					
			/*Obtiene el total de registros a paginar */
			if($local=='Z'){									//.. cuando local es Z:Zúñiga ...		
	    		$config['total_rows'] = $this->tablaGenerica_model->get_total_registros('pedidocabeceraz');
				$contador= $this->tablaGenerica_model->get_total_registros('pedidocabeceraz'); //...contador de registros  ...	
			}else{												//.. cuando local es tienda o Fabrica ...	
	    		$config['total_rows'] = $this->tablaGenerica_model->get_total_registros('pedidocabecera');
				$contador= $this->tablaGenerica_model->get_total_registros('pedidocabecera'); //...contador de registros  ...	
			}
			
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
				if($local=='Z'){									//.. cuando local es Z:Zúñiga ...		
					$datos['listaPedido'] = $this->tablaGenerica_model->get_registros('pedidocabeceraz',$config['per_page'], $desde); 
				}else{												//.. cuando local es tienda o Fabrica ...	
					$datos['listaPedido'] = $this->tablaGenerica_model->get_registros('pedidocabecera',$config['per_page'], $desde); 
				}
			
				$datos['consultaPedido'] ='';
				$datos['local'] =$local;
				/*Se llama a la vista para mostrar la información*/
				$this->load->view('header');
				$this->load->view('tienda/verCuentasPorCobrar', $datos);
				$this->load->view('footer');
					
			}//..fin IF contador registros mayor que cero ..
		}	//... fin IF validar usuario ...
		
	} //... fin cuentasPorCobrar...
	
		
	public function buscarPedidoCtasPorCobrarZ(){
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
		$totalRegistrosEncontrados=$this->tablaGenerica_model->getTotalRegistrosBuscar('pedidocabeceraz',$campo1,$consultaPedido);
		//echo"total registros econtrados".$totalRegistrosEncontrados;
		if($totalRegistrosEncontrados==0){
			redirect('menuController/index');
		}else{
			/* URL a la que se desea agregar la paginación*/
	    	$config['base_url'] = base_url().'tienda/buscarPedidoCtasPorCobrarZ';
			
			/*Obtiene el total de registros a paginar */
	    	$config['total_rows'] = $this->tablaGenerica_model->getTotalRegistrosBuscar('pedidocabeceraz',$campo1,$consultaPedido);
		
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
			$datos['listaPedido'] = $this-> tablaGenerica_model -> buscarPaginacion('pedidocabeceraz',$campo1,$consultaPedido, $config['per_page'], $desde );
			$datos['consultaPedido'] =$consultaPedido;
			$datos['local'] ='Z';
			
			/*Se llama a la vista para mostrar la información*/
			$this->load->view('header');
			$this->load->view('tienda/verCuentasPorCobrar', $datos);
			$this->load->view('footer');
		}		//... fin IF total registros encintrados ...
		
	}		//... fin funcion: buscarPedidoCtasPorCobrarZ ...
	
	
	public function buscarPedidoCtasPorCobrar(){
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
			redirect('menuController/index');
		}else{
			/* URL a la que se desea agregar la paginación*/
	    	$config['base_url'] = base_url().'tienda/buscarPedidoCtasPorCobrar';
			
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
			$datos['local'] ='O';
			
			/*Se llama a la vista para mostrar la información*/
			$this->load->view('header');
			$this->load->view('tienda/verCuentasPorCobrar', $datos);
			$this->load->view('footer');
		}		//... fin IF total registros encintrados ...
		
	}		//... fin funcion: buscarPedidoCtasPorCobrar ...
	
			
	public function cuentasPorCobrarPdf(){
		//... recupera la variable de numePedido ...
//		$numePedido=$_POST["numePedido"];
		$local=$_POST["local"];
		
		// Se obtienen los registros de la base de datos
		if($local=='Z'){								//... si local es Z:Zúñiga ...
			$sql="SELECT numPedido,fechaPedido,cliente,telCel,montoTotal,abono,local FROM pedidocabeceraz WHERE montoTotal != abono ORDER BY fechaPedido,numPedido ASC";
		}else{											//... si local es O: otro Tienda o Fabrica ...
			$sql="SELECT numPedido,fechaPedido,cliente,telCel,montoTotal,abono,local FROM pedidocabecera WHERE montoTotal != abono ORDER BY fechaPedido,numPedido ASC";
		}
		
		$registros = $this->db->query($sql);
		 
		$contador= $registros->num_rows; //...contador de registros que satisfacen la consulta ..
		
		if($contador==0){
			$datos['mensaje']='No hay registros en la tabla de PEDIDOS CABECERA.';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}else{
			// Se carga la libreria fpdf
			if($local=='Z'){								//... si local es Z:Zúñiga ...
				$this->load->library('tienda/CuentasPorCobrarZPdf');
			}else{											//... si local es O: otro Tienda o Fabrica ...
				$this->load->library('tienda/CuentasPorCobrarPdf');
			}	
		
			// Creacion del PDF
		    /*
		    * Se crea un objeto de la clase SalAlmacenPdf, recordar que la clase Pdf
		    * heredó todos las variables y métodos de fpdf
		    */
		     
		    ob_clean(); // cierra si es se abrio el envio de pdf...
		    if($local=='Z'){								//... si local es Z:Zúñiga ...
		    	$this->pdf = new CuentasPorCobrarZPdf();
		    }else{											//... si local es O: otro Tienda o Fabrica ...
		    	$this->pdf = new CuentasPorCobrarPdf();
			}
			
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
		    $totalImporte=0.00;			//... acumula el total de importes ...
		    $totalAbono=0.00;			//... acumula el total de abonos ...
		    foreach ($registros->result() as $registro) {
	    		$numeroPedido = $registro->numPedido;
				$local = $registro->local;							
				if(strlen($numeroPedido)==3){
					$secuenciaPedido=substr($numeroPedido,0,1);
					$anhoSistema=substr($numeroPedido,1,2);
				}
				
				if(strlen($numeroPedido)==4){
					$secuenciaPedido=substr($numeroPedido,0,2);
					$anhoSistema=substr($numeroPedido,2,2);
				}
				
				if(strlen($numeroPedido)==5){
					if($local=='F'){		//..local:Fabrica ..
						$secuenciaPedido=substr($numeroPedido,0,3);
						$anhoSistema=substr($numeroPedido,3,2);
					}else{					//..local:tienda ..
						$secuenciaPedido=substr($numeroPedido,0,1);
						$anhoSistema=substr($numeroPedido,1,4);
					}
				}
				
				if(strlen($numeroPedido)==6){
					$secuenciaPedido=substr($numeroPedido,0,2);
					$anhoSistema=substr($numeroPedido,2,4);
				}
				
				if(strlen($numeroPedido)==7){
					$secuenciaPedido=substr($numeroPedido,0,3);
					$anhoSistema=substr($numeroPedido,3,4);
				}
				
				if(strlen($numeroPedido)==8){
					$secuenciaPedido=substr($numeroPedido,0,4);
					$anhoSistema=substr($numeroPedido,4,4);
				}
				
		  		$numePedidoAux=$secuenciaPedido.'/'.$anhoSistema;
				
		        // Se imprimen los datos de cada registro
				$this->pdf->Cell($espacio,5,'','',0,'L',0);
				$this->pdf->Cell(10,5,$numePedidoAux,'',0,'L',0);
				$this->pdf->Cell(7,5,'','',0,'L',0);
				$this->pdf->Cell(10,5,fechaMysqlParaLatina($registro->fechaPedido),'',0,'L',0);
				$this->pdf->Cell(10,5,'','',0,'L',0);
				$this->pdf->Cell(43,5,utf8_decode($registro->cliente),'',0,'L',0);
				$this->pdf->Cell(10,5,'','',0,'L',0);
	       		$this->pdf->Cell(22,5,utf8_decode($registro->telCel),'',0,'L',0);
				$this->pdf->Cell(10,5,'','',0,'L',0);
				$this->pdf->Cell(15,5,number_format($registro->montoTotal,2),'',0,'R',0);
				$this->pdf->Cell(10,5,'','',0,'L',0);
				$this->pdf->Cell(15,5,number_format($registro->abono,2),'',0,'R',0);
				$this->pdf->Cell(10,5,'','',0,'L',0);
				$this->pdf->Cell(15,5,number_format($registro->montoTotal - $registro->abono,2),'',0,'R',0);
				$totalImporte=$totalImporte+ $registro->montoTotal;
				$totalAbono=$totalAbono+ $registro->abono;
				//Se agrega un salto de linea
	        	$this->pdf->Ln(5);	
		    }

			$this->pdf->Ln(5);
			
			$this->pdf->Cell(93,5,'','',0,'L',0);
			$this->pdf->Cell(30,5,'Totales Bs.','',0,'L',0);
			$this->pdf->Cell(15,5,number_format($totalImporte,2),'',0,'R',0);
			$this->pdf->Cell(10,5,'','',0,'L',0);
			$this->pdf->Cell(15,5,number_format($totalAbono,2),'',0,'R',0);
			$this->pdf->Cell(10,5,'','',0,'L',0);
			$this->pdf->Cell(15,5,number_format($totalImporte - $totalAbono,2),'',0,'R',0);
		
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
		  
		  	$this->pdf->Output('pdfsArchivos/ventas/cuentasPorCobrar.pdf', 'F');

		}	//... fin IF contador registros		

		?>
		<embed src="<?= base_url('pdfsArchivos/ventas/cuentasPorCobrar.pdf') ?>" width="820" height="455" id="cargarpdf"> <!-- documento embebido PDF -->
		<?php
	}			//... fin reporte PDF cuentas por cobrar ....
	
	
	public function pedidoCuentaPdf(){
		//... recupera la variable de numePedido ...
		$numeroPedido=str_replace(" ","",$_POST['numePedido']); //...quita espacios en blanco ...
		$localAux=str_replace(" ","",$_POST['local']); //...quita espacios en blanco ...
		
		$importe=0.00;			//... montoTotal ...
		$fechaPedido='';
		$cliente='';
		$telCel='';
		$abono=0.00;
		$local='';
		
		// Se obtienen los registros de la base de datos
		if($localAux=='Z'){									//... si local es Z:Zúñiga ...
			$sql="SELECT numPedido,fechaPedido,cliente,telCel,montoTotal,abono,local FROM pedidocabeceraz WHERE numPedido= '$numeroPedido' ";
		}else{												//... si local es O: otro Tienda o Fabrica ...
			$sql="SELECT numPedido,fechaPedido,cliente,telCel,montoTotal,abono,local FROM pedidocabecera WHERE numPedido= '$numeroPedido' ";
		}
		$registros = $this->db->query($sql);
		
		$sql="SELECT * FROM pagospedido WHERE pedido='$numeroPedido' ";
		$regPagos = $this->db->query($sql);
		
		foreach ($registros->result() as $registro) {
			$importe=$registro->montoTotal;			
			$fechaPedido=$registro->fechaPedido;
			$cliente=$registro->cliente;
			$telCel=$registro->telCel;
			$abono=$registro->abono;
			$tipoCambio=$registro->tipoCambio;
			$local=$registro->local;
		}
	
 
		if(strlen($numeroPedido)==3){
			$secuenciaPedido=substr($numeroPedido,0,1);
			$anhoSistema=substr($numeroPedido,1,2);
		}
		
		if(strlen($numeroPedido)==4){
			$secuenciaPedido=substr($numeroPedido,0,2);
			$anhoSistema=substr($numeroPedido,2,2);
		}
		
		if(strlen($numeroPedido)==5){
			if($local=='F'){		//..local:Fabrica ..
				$secuenciaPedido=substr($numeroPedido,0,3);
				$anhoSistema=substr($numeroPedido,3,2);
			}else{					//..local:tienda ..
				$secuenciaPedido=substr($numeroPedido,0,1);
				$anhoSistema=substr($numeroPedido,1,4);
			}
		}
		
		if(strlen($numeroPedido)==6){
			$secuenciaPedido=substr($numeroPedido,0,2);
			$anhoSistema=substr($numeroPedido,2,4);
		}
		
		if(strlen($numeroPedido)==7){
			$secuenciaPedido=substr($numeroPedido,0,3);
			$anhoSistema=substr($numeroPedido,3,4);
		}
		
		if(strlen($numeroPedido)==8){
			$secuenciaPedido=substr($numeroPedido,0,4);
			$anhoSistema=substr($numeroPedido,4,4);
		}
		
  		$numePedidoAux=$secuenciaPedido.'/'.$anhoSistema;
		
		 
		// Se carga la libreria fpdf
		$this->load->library('tienda/PedidoCuentaPdf');
		
		// Creacion del PDF
	    /*
	    * Se crea un objeto de la clase SalAlmacenPdf, recordar que la clase Pdf
	    * heredó todos las variables y métodos de fpdf
	    */
	     
	    ob_clean(); // cierra si es se abrio el envio de pdf...
	    $this->pdf = new PedidoCuentaPdf();
		
		$this->pdf->numeroPedido=$numePedidoAux;      		//...pasando variable para el header del PDF
		$this->pdf->cliente=$cliente;      					//...pasando variable para el header del PDF
		$this->pdf->fechaPedido=$fechaPedido;      			//...pasando variable para el header del PDF
		$this->pdf->importe=$importe;      					//...pasando variable para el header del PDF
		
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
	    $totalEfectivo=0.00;		//... acumula el total de efectivo ...
	    $totalCheque=0.00;			//... acumula el total de cheques ...
	    $saldo=$importe;			//...saldo de cuenta pedido...
	    foreach ($regPagos->result() as $registro) {
	        // Se imprimen los datos de cada registro
			$this->pdf->Cell(1,5,'','',0,'L',0);
			$this->pdf->Cell(10,5,fechaMysqlParaLatina($registro->fechaAbono),'',0,'L',0);
			$this->pdf->Cell(10,5,'','',0,'L',0);
			$this->pdf->Cell(30,5,utf8_decode($registro->banco),'',0,'L',0);
			$this->pdf->Cell(7,5,'','',0,'L',0);
       		$this->pdf->Cell(10,5,utf8_decode($registro->nCheque),'',0,'L',0);
			
			if($registro->tipoDocumento=='F'){			//... para el espaciado ...
				$this->pdf->Cell(8,5,'','',0,'L',0);
				$this->pdf->Cell(12,5,utf8_decode($registro->facturaRecibo),'',0,'L',0);
				$this->pdf->Cell(17,5,'','',0,'L',0);
			}else{
				$this->pdf->Cell(25,5,'','',0,'L',0);
				$this->pdf->Cell(12,5,utf8_decode($registro->facturaRecibo),'',0,'L',0);
			}
			
			if($registro->tipoPago=='E'){
				$this->pdf->Cell(16,5,'','',0,'L',0);
				if($registro->tipoCambio==0.00){
					$this->pdf->Cell(17,5,number_format($registro->montoAbono,2),'',0,'R',0);
					$totalEfectivo=$totalEfectivo+$registro->montoAbono;
				}else{														//... cuando el deposito es en dolares ...
					$this->pdf->Cell(17,5,number_format($registro->montoAbono*$registro->tipoCambio,2),'',0,'R',0);
					$totalEfectivo=$totalEfectivo+($registro->montoAbono*$registro->tipoCambio);
				}
				
				$this->pdf->Cell(34,5,'','',0,'L',0);
				
			}else{
				$this->pdf->Cell(40,5,'','',0,'L',0);
				if($registro->tipoCambio==0.00){
					$this->pdf->Cell(17,5,number_format($registro->montoAbono,2),'',0,'R',0);
					$totalCheque=$totalCheque+$registro->montoAbono ;
				}else{														//... cuando el deposito es en dolares ...
					$this->pdf->Cell(17,5,number_format($registro->montoAbono*$registro->tipoCambio,2),'',0,'R',0);
					$totalCheque=$totalCheque+($registro->montoAbono*$registro->tipoCambio) ;
				}
				
				$this->pdf->Cell(10,5,'','',0,'L',0);
				
			}
			
			if($registro->tipoCambio==0.00){
				$saldo= $saldo - $registro->montoAbono;
			}else{															//... cuando el deposito es en dolares ...	
				$saldo= $saldo - ($registro->montoAbono*$registro->tipoCambio);
			}
			
			$this->pdf->Cell(15,5,number_format($saldo,2),'',0,'R',0);
			
			//Se agrega un salto de linea
        	$this->pdf->Ln(5);	
	    }

		$this->pdf->Ln(5);
		$this->pdf->Cell(105,5,'','',0,'L',0);
		$this->pdf->Cell(16,5,'Totales','',0,'L',0);
		$this->pdf->Cell(17,5,number_format($totalEfectivo,2),'',0,'R',0);
		$this->pdf->Cell(7,5,'','',0,'L',0);
		$this->pdf->Cell(17,5,number_format($totalCheque,2),'',0,'R',0);		
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
	  
	  	$this->pdf->Output('pdfsArchivos/ventas/pedidoCuenta.pdf', 'F');

		

		?>
		<embed src="<?= base_url('pdfsArchivos/ventas/pedidoCuenta.pdf') ?>" width="820" height="455" id="pedidocuenta"> <!-- documento embebido PDF -->
		<?php
	}			//... fin reporte PDF pedidoCuentaPdf ....
		

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
			$local= $_GET['local']; //... lee local que viene del menu principal(T: tienda/F: fabrica/Z:zuñiga ) ...	
			$this->load->model("numeroDocumento_model");
			$nombreTabla='nodeposito'; // ... nombreTabla
	    	$deposito = $this->numeroDocumento_model->getNumero($nombreTabla);
			
			$anhoSistema = date("Y");	//... anho del sistema
 			$anhoSistema = substr($anhoSistema, 0, 4);	//... anho del sistema
//$anhoSistema ='2016'; 
 				 					
			if(strlen($deposito)==4 ){
				$secuenciaDeposito= 0;  // toma los caracteres ... secuencia.
				$anhoDeposito= substr($deposito, 0, 4);  // toma 4 caracteres ... anho.
			}
			
			if(strlen($deposito)==5 ){
				$secuenciaDeposito= substr($deposito, 0,1);  // toma los caracteres ... secuencia.
				$anhoDeposito= substr($deposito, 1, 4);  // toma 4 caracteres ... anho.
			}
		
			if(strlen($deposito)==6 ){
				$secuenciaDeposito= substr($deposito, 0,2);  // toma los caracteres ... secuencia.
				$anhoDeposito= substr($deposito, 2, 4);  // toma 4 caracteres ... anho.
			}
			
			if(strlen($deposito)==7 ){
				$secuenciaDeposito= substr($deposito, 0,3);  // toma los caracteres ... secuencia.
				$anhoDeposito= substr($deposito, 3, 4);  // toma 4 caracteres ... anho.
			}
			
			if($anhoDeposito!=$anhoSistema){
				$secuenciaDeposito="1";
			}else{		//... si anhoPedido==anhoSistema ...
		     	$secuenciaDeposito=$secuenciaDeposito+1;
			}
			
			$deposito=$secuenciaDeposito.$anhoSistema;	
			
			///////////////////////////////////////
			///...FIN genera nuevo numero de Deposito ...
			//////////////////////////////////////
		    if($local=='Z'){							//... depositos de Z:Zúñiga ...
		    	$sql ="SELECT * FROM pedidocabeceraz";	
		    }else{										//... depositos de O:otros Tienda o Fabrica ...
		    	$sql ="SELECT * FROM pedidocabecera";	
		    }
		
			$cabeceraPedido = $this->db->query($sql)->result_array();
			
			$datos['local']=$local;
			$datos['cabeceraPedido']=$cabeceraPedido;
			$datos['secuenciaDeposito']=$secuenciaDeposito;
			$datos['anhoSistema']=$anhoSistema;
			$datos['deposito']=$deposito;
			
			$this->load->view('header');
			$this->load->view('tienda/registrarDeposito',$datos);
			$this->load->view('footer');
		}		
	}		//... fin function: registrarDeposito ...
	
	
			
	public function modificarDeposito(){
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
			$local=$_GET['local']; //... lee local que viene del menu principal(T: tienda/F: fabrica/Z:zuñiga ) ...	
			
			$sql ="SELECT * FROM pagospedido";	
			$pagosPedido = $this->db->query($sql)->result_array();
			$datos['pagosPedido']=$pagosPedido;
			$datos['local']=$local;
					
			$this->load->view('header');
			$this->load->view('tienda/modificarDeposito',$datos);
			$this->load->view('footer');
		}		
	}		//... fin function: modificarDeposito ...
	
	
	public function fechasReporteDepositos(){
		$local=$_GET['local'];
		$datos['local']=$local;
		
		$this->load->view('header');
		$this->load->view('tienda/fechasReporteDepositos',$datos );
		$this->load->view('footer');
	}
	
	public function fechasReporteVentasPedido(){
		$atributo=$_GET['atributo'];
		$datos['atributo']=$atributo;
		
		$this->load->view('header');
		$this->load->view('tienda/fechasReporteVentasPedido',$datos );
		$this->load->view('footer');
	}
	
		
	public function generarReporteDepositos(){
		//... genera reporte de depositos en PDF
		$fechaInicial=$_POST['inputFechaInicial']; //... viene de la vista fechasReporteSalida ...
		$fechaFinal=$_POST['inputFechaFinal']; //... viene de la vista fechasReporteSalida ...
		
        // Se carga la libreria fpdf
        $this->load->library('tienda/ReporteDepositosPdf');

        // Se obtienen los registros de la base de datos
        //$salidas = $this->db->query('SELECT t1.numSal, fecha,numOrden, glosa,idMaterial,nombreInsumo, cantidad,unidad,tipoInsumo FROM '.$salidaMaterial.' t1, '.$salidaCabecera.' t2, '.$maestroMaterial.' t3 WHERE t1.numSal = t2.numero AND  t1.idMaterial=t3.codInsumo ORDER BY t1.numSal');
	    $sql ="SELECT fechaAbono,pedido,banco,montoAbono,tipoDocumento,facturaRecibo,tipoPago,nCheque,glosaDeposito FROM pagospedido WHERE fechaAbono>='$fechaInicial' AND fechaAbono<='$fechaFinal' ORDER BY banco,fechaAbono";

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
	        $this->pdf = new ReporteDepositosPdf();
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
	        
	        // La variable $bancoAnterior se utiliza para hacer corte de control por banco ...
	        $bancoAnterior = 'X';
			$totalBanco=0.00;
			$totalGeneralBancos=0.00;
	        foreach ($salidas->result() as $salida) {
	            // se imprime el numero actual y despues se incrementa el valor de $x en uno
	            // Se imprimen los datos de cada registro
	            if($bancoAnterior != 'X' && $bancoAnterior !=($salida->banco) ){   //...corte de control numero Salida
	            	$this->pdf->Ln(5);  //Se agrega un salto de linea
	            	$this->pdf->Cell(40,5,'','',0,'L',0);
	            	$this->pdf->Cell(29,5,'Total Banco Bs. ','',0,'L',0);
		            $this->pdf->Cell(25,5,number_format($totalBanco,2),'',0,'R',0);
					$totalGeneralBancos= $totalGeneralBancos + $totalBanco;
					$totalBanco=0.00;
					//Se agrega un salto de linea
	            	$this->pdf->Ln(5);
					$this->pdf->Ln(5);
	            }
				
	       		$this->pdf->Cell(1,5,'','',0,'L',0);
				$this->pdf->Cell(13,5,fechaMysqlParaLatina($salida->fechaAbono),'',0,'L',0);
				$this->pdf->Cell(10,5,'','',0,'L',0);
				$this->pdf->Cell(10,5,$salida->pedido,'',0,'R',0);
				$this->pdf->Cell(5,5,'','',0,'L',0);
				$this->pdf->Cell(15,5,utf8_decode($salida->banco),'',0,'L',0);
				$this->pdf->Cell(15,5,'','',0,'L',0);
	            $this->pdf->Cell(25,5,number_format($salida->montoAbono,2),'',0,'R',0);
				$this->pdf->Cell(5,5,'','',0,'L',0);
				if($salida->tipoDocumento=='F'){
					$this->pdf->Cell(10,5,$salida->facturaRecibo,'',0,'L',0);
					$this->pdf->Cell(5,5,'','',0,'L',0);
					$this->pdf->Cell(10,5,'','',0,'L',0);
				}else{
					$this->pdf->Cell(10,5,'','',0,'L',0);
					$this->pdf->Cell(5,5,'','',0,'L',0);
					$this->pdf->Cell(10,5,$salida->facturaRecibo,'',0,'L',0);
				}
				
				$this->pdf->Cell(5,5,'','',0,'L',0);
				$this->pdf->Cell(30,5,utf8_decode($salida->glosaDeposito),'',0,'L',0);
	            //Se agrega un salto de linea
	            $this->pdf->Ln(5); 

 				$bancoAnterior=$salida->banco;
				$totalBanco= $totalBanco + $salida->montoAbono;
	        }

			$this->pdf->Ln(5);  //Se agrega un salto de linea
        	$this->pdf->Cell(40,5,'','',0,'L',0);
        	$this->pdf->Cell(29,5,'Total Banco Bs. ','',0,'L',0);
            $this->pdf->Cell(25,5,number_format($totalBanco,2),'',0,'R',0);
			$totalGeneralBancos= $totalGeneralBancos + $totalBanco;
			$totalBanco=0.00;
			//Se agrega un salto de linea
        	$this->pdf->Ln(5);
			$this->pdf->Ln(5);
			
        	$this->pdf->Cell(40,5,'','',0,'L',0);
        	$this->pdf->Cell(29,5,'Total Gral. Bs. ','',0,'L',0);
            $this->pdf->Cell(25,5,number_format($totalGeneralBancos,2),'',0,'R',0);
			
	        
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
	  
	  		$this->pdf->Output('pdfsArchivos/reporteDepositosPdf.pdf', 'F');
	  		
			$datos['documento']="pdfsArchivos/reporteDepositosPdf.pdf";	
			$datos['titulo']=' de Depósitos ';	// ... ingreso/salida ... almacen/bodega ...
			$datos['fechaInicial']=fechaMysqlParaLatina($fechaInicial);
			$datos['fechaFinal']=fechaMysqlParaLatina($fechaFinal);
			$this->load->view('header');
			$this->load->view('reportePdf',$datos );
			$this->load->view('footer');	
 		}
        
	} //... fin funcion: generarReporteDepositos ...
	
		
	public function generarReporteNumeroDeposito(){
		//... genera reporte de depositos en PDF
		$fechaInicial=$_POST['inputFechaInicial']; //... viene de la vista fechasReporteSalida ...
		$fechaFinal=$_POST['inputFechaFinal']; //... viene de la vista fechasReporteSalida ...
		
        // Se carga la libreria fpdf
        $this->load->library('tienda/ReporteNumeroDepositoPdf');

        // Se obtienen los registros de la base de datos
        //$salidas = $this->db->query('SELECT t1.numSal, fecha,numOrden, glosa,idMaterial,nombreInsumo, cantidad,unidad,tipoInsumo FROM '.$salidaMaterial.' t1, '.$salidaCabecera.' t2, '.$maestroMaterial.' t3 WHERE t1.numSal = t2.numero AND  t1.idMaterial=t3.codInsumo ORDER BY t1.numSal');
	    $sql ="SELECT deposito,fechaAbono,pedido,banco,montoAbono,tipoPago,nCheque,glosaDeposito FROM pagospedido WHERE fechaAbono>='$fechaInicial' AND fechaAbono<='$fechaFinal' ORDER BY fechaAbono,pedido";

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
	        $this->pdf = new ReporteNumeroDepositoPdf();
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
	        
	        // La variable $bancoAnterior se utiliza para hacer corte de control por banco ...
	        $fechaAnterior = 'X';
			$totalDia=0.00;
			$totalGeneral=0.00;
	        foreach ($salidas->result() as $salida) {
	            // se imprime el numero actual y despues se incrementa el valor de $x en uno
	            // Se imprimen los datos de cada registro
/*	            if($fechaAnterior != 'X' && $fechaAnterior !=($salida->fechaAbono) ){   //...corte de control por dia ...
	            	$this->pdf->Ln(5);  //Se agrega un salto de linea
	            	$this->pdf->Cell(55,5,'','',0,'L',0);
	            	$this->pdf->Cell(29,5,utf8_decode('Total Día Bs. '),'',0,'L',0);
		            $this->pdf->Cell(25,5,number_format($totalDia,2),'',0,'R',0);
					$totalGeneral= $totalGeneral + $totalDia;
					$totalDia=0.00;
					//Se agrega un salto de linea
	            	$this->pdf->Ln(5);
					$this->pdf->Ln(5);
	            }
*/				
	       		$this->pdf->Cell(1,5,'','',0,'L',0);
				$this->pdf->Cell(13,5,fechaMysqlParaLatina($salida->fechaAbono),'',0,'L',0);
				$this->pdf->Cell(10,5,'','',0,'L',0);
				$this->pdf->Cell(10,5,$salida->pedido,'',0,'R',0);
				$this->pdf->Cell(5,5,'','',0,'L',0);
				$this->pdf->Cell(10,5,$salida->deposito,'',0,'R',0);
				$this->pdf->Cell(5,5,'','',0,'L',0);			
				$this->pdf->Cell(15,5,utf8_decode($salida->banco),'',0,'L',0);
				$this->pdf->Cell(15,5,'','',0,'L',0);
	            $this->pdf->Cell(25,5,number_format($salida->montoAbono,2),'',0,'R',0);
				$this->pdf->Cell(5,5,'','',0,'L',0);				
				$this->pdf->Cell(5,5,'','',0,'L',0);
				$this->pdf->Cell(30,5,utf8_decode($salida->glosaDeposito),'',0,'L',0);
	            //Se agrega un salto de linea
	            $this->pdf->Ln(5); 

 				$fechaAnterior=$salida->fechaAbono;
				$totalDia= $totalDia + $salida->montoAbono;
	        }

			$this->pdf->Ln(5);  //Se agrega un salto de linea
        	$this->pdf->Cell(55,5,'','',0,'L',0);
        	$this->pdf->Cell(29,5,utf8_decode('Total Día Bs. '),'',0,'L',0);
            $this->pdf->Cell(25,5,number_format($totalDia,2),'',0,'R',0);
			$totalGeneral= $totalGeneral + $totalDia;
			$totalDia=0.00;
			//Se agrega un salto de linea
        	$this->pdf->Ln(5);
			$this->pdf->Ln(5);
			
        	$this->pdf->Cell(55,5,'','',0,'L',0);
        	$this->pdf->Cell(29,5,'Total Gral. Bs. ','',0,'L',0);
            $this->pdf->Cell(25,5,number_format($totalGeneral,2),'',0,'R',0);
			
	        
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
	  
	  		$this->pdf->Output('pdfsArchivos/reporteNumeroDepositoPdf.pdf', 'F');
	  		
			$datos['documento']="pdfsArchivos/reporteNumeroDepositoPdf.pdf";	
			$datos['titulo']=' de Depósitos ';	// ... ingreso/salida ... almacen/bodega ...
			$datos['fechaInicial']=fechaMysqlParaLatina($fechaInicial);
			$datos['fechaFinal']=fechaMysqlParaLatina($fechaFinal);
			$this->load->view('header');
			$this->load->view('reportePdf',$datos );
			$this->load->view('footer');	
 		}
        
	} //... fin funcion: generarReporteNumeroDeposito ...
	
		
	public function generarReporteMasVendidos(){
		//... genera reporte de depositos en PDF
		$fechaInicial=$_POST['inputFechaInicial']; //... viene de la vista fechasReporteSalida ...
		$fechaFinal=$_POST['inputFechaFinal']; //... viene de la vista fechasReporteSalida ...
		
        // Se carga la libreria fpdf
        $this->load->library('tienda/ReporteMasVendidosPdf');

        // Se obtienen los registros de la base de datos
		$sql ="SELECT idProducto,descripcion,SUM(cantidad)AS cantidadTotal,precio FROM pedidoproducto,pedidocabecera WHERE fechaPedido>='$fechaInicial' AND fechaPedido<='$fechaFinal' AND numeroPedido=numPedido GROUP BY idproducto ORDER BY cantidadTotal DESC LIMIT 30";
		
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
	        $this->pdf = new ReporteMasVendidosPdf();
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
	        
			$totalMonto=0.00;
			$totalItems=0.00;
	        foreach ($salidas->result() as $salida) {
	            // se imprime el numero actual y despues se incrementa el valor de $x en uno
	            // Se imprimen los datos de cada registro
			
	       		$this->pdf->Cell(1,5,'','',0,'L',0);
				$this->pdf->Cell(13,5,$salida->idProducto,'',0,'L',0);
				$this->pdf->Cell(10,5,'','',0,'L',0);
				$this->pdf->Cell(65,5,$salida->descripcion,'',0,'L',0);
				$this->pdf->Cell(10,5,'','',0,'L',0);
				$this->pdf->Cell(15,5,number_format($salida->cantidadTotal,0),'',0,'R',0);

				$this->pdf->Cell(15,5,'','',0,'L',0);
	            $this->pdf->Cell(25,5,number_format($salida->cantidadTotal * $salida->precio,2),'',0,'R',0);

	            //Se agrega un salto de linea
	            $this->pdf->Ln(5); 
				
				$totalItems= $totalItems + $salida->cantidadTotal;
				$totalMonto= $totalMonto + ($salida->cantidadTotal*$salida->precio);
	        }

			$this->pdf->Ln(5);  //Se agrega un salto de linea
        	$this->pdf->Cell(60,5,'','',0,'L',0);
        	$this->pdf->Cell(29,5,utf8_decode('Totales '),'',0,'L',0);
            $this->pdf->Cell(25,5,number_format($totalItems,0),'',0,'R',0);
			$this->pdf->Cell(15,5,'','',0,'L',0);
            $this->pdf->Cell(25,5,number_format($totalMonto,2),'',0,'R',0);
			
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
	  
	  		$this->pdf->Output('pdfsArchivos/reporteNumeroDepositoPdf.pdf', 'F');
	  		
			$datos['documento']="pdfsArchivos/reporteNumeroDepositoPdf.pdf";	
			$datos['titulo']=' de Productos Mas Vendidos ';	// ... ingreso/salida ... almacen/bodega ...
			$datos['fechaInicial']=fechaMysqlParaLatina($fechaInicial);
			$datos['fechaFinal']=fechaMysqlParaLatina($fechaFinal);
			$this->load->view('header');
			$this->load->view('reportePdf',$datos );
			$this->load->view('footer');	
 		}
        
	} //... fin funcion: generarReporteMasVendidos ...
	
			
	public function generarReporteVentasAnhoMes(){
		//... genera reporte de ventas por meses del anho en PDF
        //... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='ventas'){  //... valida permiso de userName y de menu...
			$datos['mensaje']='Usuario NO autorizado para operar Sistema de Ventas';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}	//... fin control de permisos de acceso ....
		else {		//... usuario validado ...
			// Se carga la libreria fpdf
			$this->load->library('tienda/ReporteVentasAnhoMesPdf');
			
			// Se obtienen los registros de la base de datos
			$sql="SELECT YEAR(fechaPedido)AS anho,MONTH(fechaPedido) AS mes,SUM(montoTotal) AS montoMensual FROM pedidocabecera GROUP BY YEAR(fechaPedido),MONTH(fechaPedido)";
			$registros = $this->db->query($sql);
			$contador= $registros->num_rows; //...contador de registros que satisfacen la consulta ..
			
			if($contador==0){
				$datos['mensaje']='No hay registros seleccionados para el REPORTE DE VENTAS POR AÑO-MES '.$contador;
				$this->load->view('header');
				$this->load->view('mensaje',$datos );
				$this->load->view('footer');
			}else{
				// Creacion del PDF
			    /*
			    * Se crea un objeto de la clase VentasAnhoMesPdf, recordar que la clase Pdf
			    * heredó todos las variables y métodos de fpdf
			    */
			     
			    ob_clean(); // cierra si es se abrio el envio de pdf...
			    $this->pdf = new ReporteVentasAnhoMesPdf();
//				$this->pdf->fechaGestion=$fechaGestion;      											 //...pasando variable para el header del PDF
						
			    // Agregamos una página
			    $this->pdf->AddPage();
			    // Define el alias para el número de página que se imprimirá en el pie
			    $this->pdf->AliasNbPages();
			 
			    /* Se define el titulo, márgenes izquierdo, derecho y
			    * el color de relleno predeterminado
			    */
				     
				// Se define el formato de fuente: Arial, negritas, tamaño 9
				//$this->pdf->SetFont('Arial', 'B', 9);
				$this->pdf->SetFont('Arial', '', 9);
				
				$contadorRegistros=2; 	//...numero de lineas de impresion ...
				
				foreach ($registros->result() as $registro) {
				    // Se imprimen los datos de cada registro
				    $contadorRegistros = $contadorRegistros +1;
					
					if($contadorRegistros==3){
						$contadorRegistros=1;
						$this->pdf->Ln(5);
					}
					
				    $this->pdf->Cell(5,5,'','',0,'L',0);
				   	$this->pdf->Cell(10,5,mesLiteral($registro->mes),'',0,'L',0);
					$this->pdf->Cell(10,5,'','',0,'L',0);
				    $this->pdf->Cell(10,5,$registro->anho,'',0,'L',0);
					$this->pdf->Cell(10,5,'','',0,'L',0);
					$this->pdf->Cell(20,5,number_format($registro->montoMensual,2),'',0,'R',0);	
					$this->pdf->Cell(30,5,'','',0,'L',0);   
				}			//... fin foreach ....
				
					
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
			  
				  	$this->pdf->Output('pdfsArchivos/ventas/reporteVentasAnhoMes.pdf', 'F');
					
					$datos['documento']="pdfsArchivos/ventas/reporteVentasAnhoMes.pdf";	
					$datos['titulo']=' de VENTAS por Mes-Año ';	// ... titulo ...
					
					$this->load->view('header');
					$this->load->view('reportePdfSinFechas',$datos );
					$this->load->view('footer');	
				}
			}	//.. fin IF validar usuario ...
        
	} //... fin funcion: generarReporteVentasAnhoMes ...
	
	
	
	
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
		        move_uploaded_file($nombre_tmp, "d:respaldoBD/$nombre");
				
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
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='ventas' && $permisoMenu!='produccion'){  //... valida permiso de userName y de menu ...
			$datos['mensaje']='Usuario NO autorizado para operar Sistema de Ventas';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}
		else{		//... fin control de permisos de acceso ....
			$local= $_GET['local']; //... lee local que viene del menu principal(T: tienda/F: fabrica/Z:zuñiga ) ...	
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
				
			}
			
			if($local=="T"){		//...cuando el local es T:tienda ...
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
			
			
			if($local=="Z"){		//...cuando el local es Z:Zuñiga...
				$anhoSistema = date("Y");	//... anho del sistema
				$anhoSistema = substr($anhoSistema, 0, 4);	//... anho del sistema
				 				
				if(strlen($pedido)==8 ){
					$secuenciaPedido= substr($pedido, 0,4);  // toma los caracteres ... secuencia.
					$anhoPedido= substr($pedido, 4, 4);  // toma 4 caracteres ... anho.
				}
			
			}
			
			
			if($anhoPedido!=$anhoSistema){
				$secuenciaPedido="1";
				if($local=="Z"){
					$secuenciaPedido="1001";
				}
				
			}else{		//... si anhoPedido==anhoSistema ...
		     	$secuenciaPedido=$secuenciaPedido+1;
			}
			
			$pedido=$secuenciaPedido.$anhoSistema;	
			
			///////////////////////////////////////
			///...FIN genera nuevo numero de pedido ...
			//////////////////////////////////////
			
			if($local=="Z"){		//...cuando el local es Z:Zuñiga...
				$sql="SELECT * FROM productosfabrica WHERE idProd LIKE 'Z%'";	
				$insumos = $this->db->query($sql)->result_array();
			}else{						//.. cuando local es T:tienda o F:fabrica ...
				$this->load->model("inventarios/maestroMaterial_model");	//...carga el modelo tabla maestra[almacen/bodega]
				$insumos= $this->maestroMaterial_model->getTodos('productosfabrica'); //..una vez cargado el modelo de la tabla llama almacen/bodega..
			}
			
			$datos['local']=$local;					//... T: tienda / F: fabrica / Z:zuñiga...		
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
	

	public function ubicarPedido(){
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='ventas' && $permisoMenu!='produccion'){  //... valida permiso de userName y de menu ...
			$datos['mensaje']='Usuario NO autorizado para operar Sistema de Ventas';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}
		else{		//... fin control de permisos de acceso ....
			$local= $_GET['local']; //... lee local que viene del menu principal(T: tienda/F: fabrica ) ...	
			if($local=='Z'){					//.. cuando local es Z:Zúñiga ...
				$sql ="SELECT * FROM pedidocabeceraz WHERE local='$local'";	
			}else{								//.. cuando local es T:tienda o F.fábrica ...
				$sql ="SELECT * FROM pedidocabecera WHERE local='$local'";	
			}
				
			$cabeceraPedido = $this->db->query($sql)->result_array();
			 	
			$datos['titulo']='Modificar PEDIDO';
			$datos['cabeceraPedido']=$cabeceraPedido;	
			$datos['local']=$local;
	
			$this->load->view('header');
			$this->load->view('tienda/buscarPedido',$datos);
			$this->load->view('footer');
		}		//... fin IF validar usuario ...
	}	//..fin ubicarPedido ...
	
	
	public function modificarPedido(){
		$localAux= $_POST['localAux']; //... lee local que viene del menu principal(T: tienda/F: fabrica ) ...	
		
		$numeroPedido= str_replace(" ","",$_POST['inputNumero']); //... lee tipoComprobante y quita espacio en blanco ..

		$this->load->model("tablaGenerica_model");	//...carga el modelo tabla generica ...
		
		if($localAux=='Z'){			//...cuando el local es Z:Zúñiga ...
			$pedidoCabecera= $this->tablaGenerica_model->buscar('pedidocabeceraz','numPedido',$numeroPedido); //..una vez cargado el modelo de la tabla llama cotizacioncabecera..
		}else{						//...cuando el local es T:Tienda o f:Fábrica ...
			$pedidoCabecera= $this->tablaGenerica_model->buscar('pedidocabecera','numPedido',$numeroPedido); //..una vez cargado el modelo de la tabla llama cotizacioncabecera..
		} 
		
		$local= $pedidoCabecera["local"];							// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$fechaPedido= $pedidoCabecera["fechaPedido"];				// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$fechaEntrega= $pedidoCabecera["fechaEntrega"];				// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$cliente= $pedidoCabecera["cliente"];						// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$contacto= $pedidoCabecera["contacto"];						// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$direccion= $pedidoCabecera["direccion"];					// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$fono= $pedidoCabecera["telCel"];							// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$localidad= $pedidoCabecera["localidad"];					// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$cotizacionFabrica= $pedidoCabecera["cotizacionFabrica"];	// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$ordenCompra= $pedidoCabecera["ordenCompra"];				// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$facturarA= $pedidoCabecera["facturarA"];					// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$nit= $pedidoCabecera["nit"];								// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$aCuenta= $pedidoCabecera["aCuenta"];						// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$descuento= $pedidoCabecera["descuento"];					// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$embalaje= $pedidoCabecera["embalaje"];					// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$usuario= $pedidoCabecera["usuario"];						// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$notaComentario= $pedidoCabecera["notaComentario"];			// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		
		
		if(strlen($numeroPedido)==3){
			$secuenciaPedido=substr($numeroPedido,0,1);
			$anhoSistema=substr($numeroPedido,1,2);
		}
		
		if(strlen($numeroPedido)==4){
			$secuenciaPedido=substr($numeroPedido,0,2);
			$anhoSistema=substr($numeroPedido,2,2);
		}
		
		if(strlen($numeroPedido)==5){
			if($local=='F'){		//..local:Fabrica ..
				$secuenciaPedido=substr($numeroPedido,0,3);
				$anhoSistema=substr($numeroPedido,3,2);
			}else{					//..local:tienda ..
				$secuenciaPedido=substr($numeroPedido,0,1);
				$anhoSistema=substr($numeroPedido,1,4);
			}
		}
		
		if(strlen($numeroPedido)==6){
			$secuenciaPedido=substr($numeroPedido,0,2);
			$anhoSistema=substr($numeroPedido,2,4);
		}
		
		if(strlen($numeroPedido)==7){
			$secuenciaPedido=substr($numeroPedido,0,3);
			$anhoSistema=substr($numeroPedido,3,4);
		}
		
		if(strlen($numeroPedido)==8){
			$secuenciaPedido=substr($numeroPedido,0,4);
			$anhoSistema=substr($numeroPedido,4,4);
		}
		
		
		if($localAux=='Z'){			//...cuando el local es Z:Zúñiga ...
			$sql="SELECT * FROM pedidoproductoz WHERE numeroPedido='$numeroPedido'";
		}else{						//...cuando el local es T:Tienda o f:Fábrica ...
			$sql="SELECT * FROM pedidoproducto WHERE numeroPedido='$numeroPedido'";
		}
		
		$regPedido=mysql_query($sql);
		$nRegistrosPedido= mysql_num_rows($regPedido); 	//... numero registros salida que satisfacen la consulta ...
		
		if($localAux=='Z'){			//...cuando el local es Z:Zúñiga ...
			$sql="SELECT * FROM productosfabrica WHERE idProd LIKE 'Z%'";	
			$insumos = $this->db->query($sql)->result_array();
		}else{						//...cuando el local es T:Tienda o F:Fábrica ...
			$this->load->model("tablaGenerica_model");	//...carga el modelo tabla maestra[almacen/bodega]
			$insumos= $this->tablaGenerica_model->getTodos('productosfabrica'); //..una vez cargado el modelo de la tabla llama productosfabrica..
		}	
					
		$datos['titulo']='mPedido:';
		$datos['secuenciaPedido']=$secuenciaPedido;		//... dato cabecera pedido ..
		$datos['anhoSistema']=$anhoSistema;				//... dato cabecera pedido ..
		$datos['numPedido']=$numeroPedido; 				//... dato cabecera pedido ..
		$datos['local']=$local;							//... dato cabecera pedido ..
		$datos['fechaPedido']=$fechaPedido;				//... dato cabecera pedido ..
		$datos['fechaEntrega']=$fechaEntrega;			//... dato cabecera pedido ..
		$datos['cliente']=$cliente;						//... dato cabecera pedido ..
		$datos['contacto']=$contacto;					//... dato cabecera pedido ..
		$datos['direccion']=$direccion;					//... dato cabecera pedido ..
		$datos['fono']=$fono;							//... dato cabecera pedido ..
		$datos['localidad']=$localidad;					//... dato cabecera pedido ..
		$datos['cotizacionFabrica']=$cotizacionFabrica;	//... dato cabecera pedido ..
		$datos['ordenCompra']=$ordenCompra;				//... dato cabecera pedido ..
		$datos['facturarA']=$facturarA;					//... dato cabecera pedido ..
		$datos['nit']=$nit;								//... dato cabecera pedido ..
		$datos['aCuenta']=$aCuenta;						//... dato cabecera pedido ..
		$datos['descuento']=$descuento;					//... dato cabecera pedido ..
		$datos['embalaje']=$embalaje;					//... dato cabecera pedido ..
		$datos['usuario']=$usuario;						//... dato cabecera pedido ..
		$datos['notaComentario']=$notaComentario;		//... dato cabecera pedido ..	
		
		$datos['nRegistrosPedido']=$nRegistrosPedido;	
		$datos['regPedido']=$regPedido;	
		$datos['insumos']=$insumos;	

		$this->load->view('header');
		$this->load->view('tienda/modificarPedido',$datos);
		$this->load->view('footer');
	}		//... fin funcion: modificarPedido ...
	
	
	public function grabarPedido(){		
		$numeroFilasValidas=$_POST['numeroFilas']; //... formulario materiales ...
		$local=$_POST['local'];
		$numPedido=$_POST['numPedido'];
		$secuenciaPedido=$_POST['secuenciaPedido'];
		$anhoSistema=$_POST['anhoSistema'];
		
		// ... actualizar numero de cotizacion ...	
		$nombreTabla='nopedido'.strtolower($local); // ... prefijoTabla ... F: fabrica  T: tienda ...
		$this-> load -> model("numeroDocumento_model");	//... modelo numeroDocumento_model ... cotizacion		
		$this-> numeroDocumento_model -> actualizar($numPedido,$nombreTabla);
		// fin actualizar numero de cotizacion ...
		
		$descuento= $_POST['descuento'];
		$embalaje= $_POST['embalaje'];
		$montoConDescto=str_replace(",","",$_POST['detalleTotalBs']);
		$montoConDescto=$montoConDescto -$descuento + $embalaje;

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
		    "montoTotal"=>$montoConDescto, //...quita , como separador de miles ...
		    "aCuenta"=>str_replace(",","",$_POST['aCuenta']), //...quita , como separador de miles ...
		    "descuento"=>str_replace(",","",$_POST['descuento']),
		    "embalaje"=>str_replace(",","",$_POST['embalaje']),
		    "usuario"=>$this->session->userdata('userName'),
		    "estado"=>"I",
		    "fechaEstado"=>$_POST['inputFecha'],
		    "notaComentario"=>$_POST['nota']
		);
		
		// ... inserta registro tabla pedidocabecera ...
		$this-> load -> model("tablaGenerica_model");		//carga modelo ...
		if($local=='Z'){			//... si es pedido de Z:Zúñiga ...
			$this-> tablaGenerica_model -> grabar('pedidocabeceraZ', $pedidoCabecera);
		}else{							//... si es pedido de T:tienda o F:fábrica... ...
	    	$this-> tablaGenerica_model -> grabar('pedidocabecera', $pedidoCabecera);
		}
		
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
				if($local=='Z'){			//... si es pedido de Z:Zúñiga ...
	    			$this-> tablaGenerica_model -> grabar('pedidoproductoZ',$plantillaProducto);
				}else{							//... si es pedido de T:tienda o F:fábrica... ...
					$this-> tablaGenerica_model -> grabar('pedidoproducto',$plantillaProducto);
				}
							
				// ... fin de inserción  registro tabla transacciones ... cotizacionmaterial
				
			}	// ... fin IF
			
		}  // ... fin  FOR 
		
		redirect("tienda/generarPedidoPDF?numeroPedido=$numPedido&local=$local&secuenciaPedido=$secuenciaPedido&anhoSistema=$anhoSistema");
	
	}	//... fin grabarPedido ...
		

	public function grabarPedidoModificado(){		
		$numeroFilasValidas=$_POST['numeroFilas']; //... formulario materiales ...
		$local=$_POST['local'];
		$numPedido=$_POST['numPedido'];
		$secuenciaPedido=$_POST['secuenciaPedido'];
		$anhoSistema=$_POST['anhoSistema'];
		
		$descuento= $_POST['descuento'];
		
		$embalaje= $_POST['embalaje'];
		
		$montoConDescto=str_replace(",","",$_POST['detalleTotalBs']);
		
		$montoConDescto=$montoConDescto -$descuento + $embalaje;
			
		$pedidoCabecera = array(
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
		    "montoTotal"=>$montoConDescto, //...quita , como separador de miles ...
		    "aCuenta"=>str_replace(",","",$_POST['aCuenta']), //...quita , como separador de miles ...
		    "descuento"=>str_replace(",","",$_POST['descuento']),
		    "embalaje"=>str_replace(",","",$_POST['embalaje']),
		    "usuario"=>$this->session->userdata('userName'),
		    "estado"=>"I",
		    "fechaEstado"=>$_POST['inputFecha'],
		    "notaComentario"=>$_POST['nota']
		);
		
		// ... edita registro tabla pedidocabecera ...
		$this-> load -> model("tablaGenerica_model");		//carga modelo ...
		if($local=='Z'){						//... cuando local es Z:Zúñiga ...
			$this-> tablaGenerica_model -> editarRegistro('pedidocabeceraz','numPedido',$numPedido,$pedidoCabecera);
		}else{									//... cuando local es T:tienda o F:Fábrica ...
			$this-> tablaGenerica_model -> editarRegistro('pedidocabecera','numPedido',$numPedido,$pedidoCabecera);
		}
	    
	    // ... borra registros en la tabla: pedidoproducto ...	
		$this-> load -> model("tablaGenerica_model");	//... modelo tablaGenerica_model
		if($local=='Z'){						//... cuando local es Z:Zúñiga ...
			$this-> tablaGenerica_model -> eliminar('pedidoproductoz','numeroPedido',$numPedido);	
		}else{									//... cuando local es T:tienda o F:Fábrica ...
			$this-> tablaGenerica_model -> eliminar('pedidoproducto','numeroPedido',$numPedido);	
		}
		// fin borrar registros de pedidoproducto ...
		
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
				if($local=='Z'){						//... cuando local es Z:Zúñiga ...
					$this-> tablaGenerica_model -> grabar('pedidoproductoz',$plantillaProducto);			
				}else{									//... cuando local es T:tienda o F:Fábrica ...
	    			$this-> tablaGenerica_model -> grabar('pedidoproducto',$plantillaProducto);
				}	
				// ... fin de inserción  registro tabla transacciones ... cotizacionmaterial
				
			}	// ... fin IF
			
		}  // ... fin  FOR 
			
		redirect("tienda/generarPedidoPDF?numeroPedido=$numPedido&local=$local&secuenciaPedido=$secuenciaPedido&anhoSistema=$anhoSistema");
		
	}	//... fin grabarPedidoModificado ...	
	
			
	/////////////////////////////////////////////
	//... funciones del CRUD pedidos ...//
	/////////////////////////////////////////////
		
			
	public function verPedidosZ(){
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='ventas'){  //... valida permiso de userName y de menu ...
			$datos['mensaje']='Usuario NO autorizado para operar Sistema de Ventas';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}			// ... fin control permiso de accesos...
		else {
			$this->load->model("tablaGenerica_model");
			
			/* URL a la que se desea agregar la paginación*/
	    	$config['base_url'] = base_url().'tienda/verPedidosZ';
			
			/*Obtiene el total de registros a paginar */
	    	$config['total_rows'] = $this->tablaGenerica_model->get_total_registros('pedidocabeceraz');
		
			$contador= $this->tablaGenerica_model->get_total_registros('pedidocabeceraz'); //...contador de registros  ...		
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
				
				$datos['listaPedido'] = $this->tablaGenerica_model->get_registros('pedidocabeceraz',$config['per_page'], $desde); 
				$datos['consultaPedido'] ='';
				$datos['permisoUserName'] =$permisoUserName;
				
				/*Se llama a la vista para mostrar la información*/
				$this->load->view('header');
				$this->load->view('tienda/verPedidosZ', $datos);
				$this->load->view('footer');
					
			}//..fin IF contador registros mayor que cero ..
		}	//... fin IF validar usuario ...
		
	} //... fin verPedidosZ ...
		
		
		
	public function verPedidos(){
			//... control de permisos de acceso ....
			$permisoUserName=$this->session->userdata('userName');
			$permisoMenu=$this->session->userdata('usuarioMenu');
			$permisoProceso1=$this->session->userdata('usuarioProceso1');
			if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='ventas'){  //... valida permiso de userName y de menu ...
				$datos['mensaje']='Usuario NO autorizado para operar Sistema de Ventas';
				$this->load->view('header');
				$this->load->view('mensaje',$datos );
				$this->load->view('footer');
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
					$datos['permisoUserName'] =$permisoUserName;
					
					/*Se llama a la vista para mostrar la información*/
					$this->load->view('header');
					$this->load->view('tienda/verPedidos', $datos);
					$this->load->view('footer');
						
				}//..fin IF contador registros mayor que cero ..
			}	//... fin IF validar usuario ...
			
		} //... fin verPedidos ...
	
	public function eliminarPedido(){
		//... elimina pedido de las tablas pedidocabecera, pedidoproducto ...
		$codigoPedido=$_POST['codigo'];
		$this-> load -> model("tablaGenerica_model");
   		$this-> tablaGenerica_model -> eliminar('pedidocabecera','numPedido',$codigoPedido);
		$this-> tablaGenerica_model -> eliminar('pedidoproducto','numeroPedido',$codigoPedido);
		
		$numePedidoSinGuion =str_replace("-","",$codigoPedido); //...quita - como separador de codigo ...	

		$archivoPDF='pedido'.$numePedidoSinGuion.'.pdf';
		//$archivoPDF='pedido1002017.pdf';
		$archivo ='pdfsArchivos/pedidos/pedido'.$numePedidoSinGuion.'.pdf';
		$hacer = unlink($archivo);
 
		if($hacer != true){
 			echo "Ocurrió un error tratando de borrar el archivo" .$archivoPDF. "<br />";
 		}

		$data=base_url("tienda/verPedidos");
		echo $data;
	}
	
	
	public function eliminarPedidoZ(){
		//... elimina pedido de las tablas pedidocabecera, pedidoproducto ...
		$codigoPedido=$_POST['codigo'];
		$this-> load -> model("tablaGenerica_model");
   		$this-> tablaGenerica_model -> eliminar('pedidocabeceraz','numPedido',$codigoPedido);
		$this-> tablaGenerica_model -> eliminar('pedidoproductoz','numeroPedido',$codigoPedido);
		
		$numePedidoSinGuion =str_replace("-","",$codigoPedido); //...quita - como separador de codigo ...	

		$archivoPDF='pedidoZ'.$numePedidoSinGuion.'.pdf';
		//$archivoPDF='pedido1002017.pdf';
		$archivo ='pdfsArchivos/pedidos/pedidoZ'.$numePedidoSinGuion.'.pdf';
		$hacer = unlink($archivo);
 
		if($hacer != true){
 			echo "Ocurrió un error tratando de borrar el archivo" .$archivoPDF. "<br />";
 		}

		$data=base_url("tienda/verPedidosZ");
		echo $data;
	}
		 
	public function buscarPedidoZ(){
		//... buscar los registros que coincidan con el patron busqueda ingresado ...
	    $campo1='numPedido';   //... el campo por elcual se va hacer la búsqueda ...
		$permisoUserName=$this->session->userdata('userName');
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
		$totalRegistrosEncontrados=$this->tablaGenerica_model->getTotalRegistrosBuscar('pedidocabeceraz',$campo1,$consultaPedido);
		//echo"total registros econtrados".$totalRegistrosEncontrados;
		if($totalRegistrosEncontrados==0){
		//	$datos['mensaje']='No hay registros grabados en la tabla '.$nombreTabla;
		//	$this->load->view('mensaje',$datos );
		//	redirect('produccion/crudVerCotizaciones');
			redirect('menuController/index');
		}else{
			/* URL a la que se desea agregar la paginación*/
	    	$config['base_url'] = base_url().'tienda/buscarPedidoZ';
			
			/*Obtiene el total de registros a paginar */
	    	$config['total_rows'] = $this->tablaGenerica_model->getTotalRegistrosBuscar('pedidocabeceraz',$campo1,$consultaPedido);
		
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
			$datos['listaPedido'] = $this-> tablaGenerica_model -> buscarPaginacion('pedidocabeceraz',$campo1,$consultaPedido, $config['per_page'], $desde );
			$datos['consultaPedido'] =$consultaPedido;
			$datos['permisoUserName'] =$permisoUserName;
			
			/*Se llama a la vista para mostrar la información*/
			$this->load->view('header');
			$this->load->view('tienda/verPedidosZ', $datos);
			$this->load->view('footer');
		}		//... fin IF total registros encintrados ...
		
	}		//... fin funcion: buscarPedidoZ ...
	
	
	public function buscarPedido(){
		//... buscar los registros que coincidan con el patron busqueda ingresado ...
	    $campo1='numPedido';   //... el campo por elcual se va hacer la búsqueda ...
		$permisoUserName=$this->session->userdata('userName');
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
			$datos['permisoUserName'] =$permisoUserName;
			
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
	
	
	public function reporteSolicitudesCotizacionPdf(){
		//... recupera la variable de numeCotizcion ...
		$numeCotizacion=$_POST["numeCotizacion"];
		?>
		<embed src="<?= base_url('pdfsArchivos/cotizaciones/solcotiz'.$numeCotizacion.'.pdf') ?>" width="820" height="455" id="sergio"> <!-- documento embebido PDF -->
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
		    
			$contadorLineas=1;		//.. para controlar la impresión de las imagenes de los planos ...
		    foreach ($regDetalles->result() as $registroDetalle) {
		        // Se imprimen los datos de cada registro
		        
		        $contadorLineas=$contadorLineas+1;
				
				$this->pdf->Cell(1);
				$this->pdf->Cell(10,5,number_format($registroDetalle->cantidad,0),'',0,'R',0);
				$this->pdf->Cell(9,5,$registroDetalle->unidad,'',0,'C',0);
				$this->pdf->Cell(94,5,utf8_decode(substr($registroDetalle->descripcion,0,115) ),'',0,'L',0);
				
				if(substr($registroDetalle->descripcion,115,115)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(20);
					$this->pdf->Cell(85,5,utf8_decode(substr($registroDetalle->descripcion,115,115) ),0,0,'L');
					$contadorLineas=$contadorLineas+1;
				}
				
				if(substr($registroDetalle->descripcion,230,115)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(20);
					$this->pdf->Cell(85,5,utf8_decode(substr($registroDetalle->descripcion,230,115) ),0,0,'L');
					$contadorLineas=$contadorLineas+1;
				}
				
				if(substr($registroDetalle->descripcion,345,115)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(20);
					$this->pdf->Cell(85,5,utf8_decode(substr($registroDetalle->descripcion,345,115) ),0,0,'L');
					$contadorLineas=$contadorLineas+1;
				}
				
				if(substr($registroDetalle->descripcion,460,115)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(20);
					$this->pdf->Cell(85,5,utf8_decode(substr($registroDetalle->descripcion,460,115) ),0,0,'L');
					$contadorLineas=$contadorLineas+1;
				}
				
				if(substr($registroDetalle->descripcion,575,115)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(20);
					$this->pdf->Cell(85,5,utf8_decode(substr($registroDetalle->descripcion,575,115) ),0,0,'L');
				 	$contadorLineas=$contadorLineas+1;
				}
				
				if(substr($registroDetalle->descripcion,690,115)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(20);
					$this->pdf->Cell(85,5,utf8_decode(substr($registroDetalle->descripcion,690,115) ),0,0,'L');
					$contadorLineas=$contadorLineas+1;
				}
				
				$this->pdf->Ln(5);
				$this->pdf->Ln(5);
				$contadorLineas=$contadorLineas+2;
		    }

			while($contadorLineas<48){					//... rellena con lineas vacías la primera hoja ...
				$this->pdf->Ln(5);
//				$this->pdf->Cell(10,5,number_format($contadorLineas,0),'',0,'R',0);
				$this->pdf->Cell(10,5,' ','',0,'R',0);
				$contadorLineas=$contadorLineas+1;
			}

			$plano='';
			while(strlen($foto) > 0) {
				$pos = strpos($foto, '|');
			    $plano=substr($foto,0,$pos);
				
				for($x=2; $x<47; $x++){
					$this->pdf->Ln(5);
//					$this->pdf->Cell(10,5,number_format($x,0),'',0,'R',0);
					$this->pdf->Cell(10,5,' ','',0,'R',0);
				}
				
				$this->pdf->Ln(5);
				$this->pdf->Image('d:respaldoBD/'.$plano,20,52,176);
				$foto=substr($foto,$pos+1,strlen($foto)-$pos);				
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
	
	
	/////////////////////////////////////////////////////
	//... funciones del visor solicitudesCotizacion ...//
	////////////////////////////////////////////////////
	
	public function verSolicitudesCotizacion(){
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='produccion' && $permisoMenu!='ventas'){  //... valida permiso de userName ...
			$datos['mensaje']='Usuario NO autorizado para operar Sistema de Producción';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
		}	//... fin control de permisos de acceso ....
		else {		//... usuario validado ...
			$this->load->model("tablaGenerica_model");
			$contador= $this->tablaGenerica_model->get_total_registros('solcotizcabecera');
			
			if($contador==0){  //...cuando NO hay registros ...
				$datos['mensaje']='No hay registros grabados en la tabla de SOLICITUD DE COTIZACIONES.';
				$this->load->view('header');
				$this->load->view('mensaje',$datos );
				$this->load->view('footer');
			}
			else{      //... cuando hay registros ...
				
				/* URL a la que se desea agregar la paginación*/
		    	$config['base_url'] = base_url().'tienda/verSolicitudesCotizacion';
				
				/*Obtiene el total de registros a paginar */
		    	$config['total_rows'] = $this->tablaGenerica_model->get_total_registros('solcotizcabecera');
				
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
		   		$datos['listaCotizacion'] = $this->tablaGenerica_model->get_registros('solcotizcabecera',$config['per_page'], $desde); 
		
				$datos['consultaCotizacion'] ='';
				
		 		/*Se llama a la vista para mostrar la información*/
				$this->load->view('header');
				$this->load->view('tienda/verSolicitudesCotizacion', $datos);
				$this->load->view('footer');
			}  // fin else cuando hay registros 
		}	//... fin IF validar acceso usuario...
	} //... fin verSolicitudesCotizacion ...
	
	
	public function buscarSolicitudesCotizacion(){
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
		$totalRegistrosEncontrados=$this->tablaGenerica_model->getTotalRegistrosBuscar('solcotizcabecera',$campo1,$consultaCotizacion);
		//echo"total registros econtrados".$totalRegistrosEncontrados;
		if($totalRegistrosEncontrados==0){
			redirect('menuController/index');		//.. si no encuentra registros vuelve menu principal
		}else{
			/* URL a la que se desea agregar la paginación*/
	    	$config['base_url'] = base_url().'tienda/buscarSolicitudesCotizacion';
			
			/*Obtiene el total de registros a paginar */
	    	$config['total_rows'] = $this->tablaGenerica_model->getTotalRegistrosBuscar('solcotizcabecera',$campo1,$consultaCotizacion);
		
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
			$datos['listaCotizacion'] = $this-> tablaGenerica_model -> buscarPaginacion('solcotizcabecera',$campo1,$consultaCotizacion, $config['per_page'], $desde );
			$datos['consultaCotizacion'] =$consultaCotizacion;
			
			/*Se llama a la vista para mostrar la información*/
			$this->load->view('header');
			$this->load->view('tienda/verSolicitudesCotizacion', $datos);
			$this->load->view('footer');
		}		//... fin IF total registros encontrados ...
	}		//... fin buscarSolicitudesCotizacion ...
	
	
	public function eliminarSolicitudCotizacion(){
		//... elimina cotizacion de las tablas cotizacion[areamaterial/cabecera/manoobra/material] ...
		$codigoCotizacion=$_POST['codigo'];
		$this-> load -> model("tablaGenerica_model");
		$this-> tablaGenerica_model -> eliminar('solcotizcabecera','numCotizacion',$codigoCotizacion);
		$this-> tablaGenerica_model -> eliminar('solcotizdetalle','numeroCotizacion',$codigoCotizacion);
		$archivoPDF='solCotiz'.$codigoCotizacion.'.pdf';
		//$archivoPDF='cotizacion10077PDF.pdf';
		$archivo ='pdfsArchivos/cotizaciones/solCotiz'.$codigoCotizacion.'.pdf';
		$hacer = unlink($archivo);
 
		if($hacer != true){
 			echo "Ocurrió un error tratando de borrar el archivo" .$archivoPDF. "<br />";
 		}

		$data=base_url("tienda/verSolicitudesCotizacion");
		echo $data;
	}		//...fin eliminarSolicitudCotizacion ...
	
	
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
			if($local=='Z'){
				$nombreLocal='Zúñiga';
			}else{
				$nombreLocal='Fábrica';
			}	
		}
		
		// Se carga la libreria fpdf
		$this->load->library('tienda/EstructuraPedidoPdf');
		
 
		// Se obtienen los registros de la base de datos
		if($local=='Z'){									//... cuando pedido es Z:Zúñiga ...
			$sql ="SELECT numeroPedido,idProducto,descripcion,color,cantidad,unidad,precio FROM pedidoproductoz WHERE numeroPedido='$numeroPedido' ";
		}else{												//... cuando pedido es T:tienda o F:fábrica ...
			$sql ="SELECT numeroPedido,idProducto,descripcion,color,cantidad,unidad,precio FROM pedidoproducto WHERE numeroPedido='$numeroPedido' ";
		}	
		
		$productos = $this->db->query($sql);
						
		$this->load->model("tablaGenerica_model");	//...carga el modelo tabla generica ...
		if($local=='Z'){									//... cuando pedido es Z:Zúñiga ...
			$pedidoCabecera= $this->tablaGenerica_model->buscar('pedidocabeceraz','numPedido',$numeroPedido); //..una vez cargado el modelo de la tabla llama cotizacioncabecera..
		}else{												//... cuando pedido es T:tienda o F:fábrica ...
			$pedidoCabecera= $this->tablaGenerica_model->buscar('pedidocabecera','numPedido',$numeroPedido); //..una vez cargado el modelo de la tabla llama cotizacioncabecera..
		}
		
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
		$embalaje= $pedidoCabecera["embalaje"];						// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$usuario= $pedidoCabecera["usuario"];						// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
		$nota= $pedidoCabecera["notaComentario"];					// ... forma de asignar cuando se utliza funcion ...buscar ... de tablaGenerica_model ...
							
		if($local=='Z'){									//... cuando pedido es Z:Zúñiga ...
			$sql ="SELECT * FROM pedidocabeceraz WHERE numPedido='$numeroPedido' ";
		}else{												//... cuando pedido es T:tienda o F:fábrica ...
			$sql ="SELECT * FROM pedidocabecera WHERE numPedido='$numeroPedido' ";
		}
		
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
		    //$this->pdf->SetFont('Arial', '', 9);
		    $this->pdf->SetFont('Arial', '', 10);
			
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
				
				if(substr($producto->descripcion,56,56)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($producto->descripcion,56,56) ),0,0,'L');
				}
				
				if(substr($producto->descripcion,112,56)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($producto->descripcion,112,56) ),0,0,'L');
				}
				
				if(substr($producto->descripcion,178,56)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($producto->descripcion,178,56) ),0,0,'L');
				}
				
				if(substr($producto->descripcion,234,56)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($producto->descripcion,234,56) ),0,0,'L');
				}
				
				if(substr($producto->descripcion,290,56)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($producto->descripcion,290,56) ),0,0,'L');
				}
				
				if(substr($producto->descripcion,346,56)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($producto->descripcion,346,56) ),0,0,'L');
				}
				
				if(substr($producto->descripcion,402,56)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($producto->descripcion,402,56) ),0,0,'L');
				}
				
				if(substr($producto->descripcion,458,56)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($producto->descripcion,458,56) ),0,0,'L');
				}
				
				if(substr($producto->descripcion,514,56)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($producto->descripcion,514,56) ),0,0,'L');
				}
				
				if(substr($producto->descripcion,570,56)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($producto->descripcion,570,56) ),0,0,'L');
				}
				
				if(substr($producto->descripcion,626,56)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($producto->descripcion,626,56) ),0,0,'L');
				}
				
				if(substr($producto->descripcion,682,56)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($producto->descripcion,682,56) ),0,0,'L');
				}
				
				if(substr($producto->descripcion,738,56)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($producto->descripcion,738,56) ),0,0,'L');
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
    		$this->pdf->Cell(42,5,'Descuento Bs. '.number_format($descuento,2),0,0,'R');
			
			$this->pdf->Ln('5');
			$this->pdf->Cell(147,5,'','',0,'L',0);
    		$this->pdf->Cell(42,5,'Embalaje Bs.    '.number_format($embalaje,2),0,0,'R');
			

			$this->pdf->Ln('5');
			$this->pdf->Cell(147,5,'','',0,'L',0);
    		$this->pdf->Cell(42,5,'Saldo Bs. '.number_format($totalPorNumeroPedido -$descuento - $aCuenta + $embalaje,2),0,0,'R');
			
			if($nota!=""){
				$this->pdf->Ln('5');
				$this->pdf->Ln('5');
				$this->pdf->Cell(1,5,'N O T A :','',0,'L',0);
				
				if(substr($nota,0,124)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($nota,0,124) ),0,0,'L');
				}
				
				if(substr($nota,124,124)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($nota,124,124) ),0,0,'L');
				}
				
				if(substr($nota,248,124)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($nota,248,124) ),0,0,'L');
				}
				
				if(substr($nota,372,124)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($nota,372,124) ),0,0,'L');
				}
				
				if(substr($nota,496,124)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($nota,496,124) ),0,0,'L');
				}
				
				if(substr($nota,620,124)!=""){
					$this->pdf->Ln(5);
					$this->pdf->Cell(15,5,'','',0,'L',0);
					$this->pdf->Cell(85,5,utf8_decode(substr($nota,620,124) ),0,0,'L');
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
			 
			 if($local=='Z'){									//... cuando pedido es Z:Zúñiga ...
			 	$this->pdf->Output('pdfsArchivos/pedidos/pedidoZ'.$numeroPedido.'.pdf', 'F');
			}else{												//... cuando pedido es T:tienda o F:fábrica ...
				$this->pdf->Output('pdfsArchivos/pedidos/pedido'.$numeroPedido.'.pdf', 'F');
			}
	
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
		$local=$_POST['local'];		
		$numDeposito=$_POST['numDeposito'];
		$numPedido=str_replace(" ","",$_POST['numPedido']);
		$montoDeposito= str_replace(",","",$_POST['montoDeposito']);
		$tipoCambio= str_replace(",","",$_POST['cambioDolar']);
		
		
		$regDeposito = array(
			"deposito"=>$_POST['numDeposito'],
	    	"pedido"=>str_replace(" ","",$_POST['numPedido']), //...quita los espacios en blanco ...
		    "fechaAbono"=>$_POST['inputFecha'],
		    "tipoPago"=>$_POST['inputTipoPago'],
		    "banco"=>$_POST['inputBanco'],
		    "nCheque"=>$_POST['numCheque'],
		    "nDeposito"=>$_POST['nDeposito'],
		    "tipoDocumento"=>$_POST['tipoDocumento'],
		    "facturaRecibo"=>$_POST['facturaRecibo'], 
		    "montoAbono"=>str_replace(",","",$_POST['montoDeposito']), 	//...quita , como separador de miles ...
		    "tipoCambio"=>str_replace(",","",$_POST['cambioDolar']), 	//...quita , como separador de miles ...
		    "glosaDeposito"=>$_POST['glosaDeposito']
		);
		
		// ... inserta registro tabla pedidocabecera ...
		$this-> load -> model("tablaGenerica_model");		//carga modelo ...
	    $this-> tablaGenerica_model -> grabar('pagospedido', $regDeposito);
		
		if($tipoCambio!=0.00){		//... cuando el deposito es en $us.
			$montoDeposito=$montoDeposito * $tipoCambio;
		}
		
		// ... actualiza registro pedidocabecera ....	
		$this-> load -> model("tablaGenerica_model");
		if($local=='Z'){									//... local es Z:Zúñiga ...
			$this-> tablaGenerica_model ->aumentarValorFloat('pedidocabeceraz','numPedido',$numPedido,'abono',$montoDeposito);
		}else{												//... local es otro Tienda o Fabrica ...
			$this-> tablaGenerica_model ->aumentarValorFloat('pedidocabecera','numPedido',$numPedido,'abono',$montoDeposito);
		}
		
		// ... actualizar numero de cotizacion ...	
		$this-> load -> model("numeroDocumento_model");	//... modelo numeroDocumento_model ... cotizacion
		$nombreTabla='nodeposito'; 	
		
		$this-> numeroDocumento_model -> actualizar($numDeposito,$nombreTabla);
		// fin actualizar numero de cotizacion ...
		
		 redirect("menuController/index");	
		
	}	//... fin grabarDeposito ...
	
	
	public function grabarDepositoModificado(){
		$local=$_POST['local'];		
		$numDeposito=str_replace(" ","",$_POST['deposito']);
		$numPedido=str_replace(" ","",$_POST['numPedido']);
		$montoDeposito= str_replace(",","",$_POST['montoDeposito']);
		$tipoCambio= str_replace(",","",$_POST['cambioDolar']);
		$montoAbonoAnterior= str_replace(",","",$_POST['montoAbonoAnterior']);
		$cambioDolarAnterior= str_replace(",","",$_POST['cambioDolarAnterior']);

		$regDeposito = array(
			"deposito"=>$_POST['deposito'],
	    	"pedido"=>str_replace(" ","",$_POST['numPedido']), //...quita los espacios en blanco ...
		    "tipoPago"=>$_POST['inputTipoPago'],
		    "banco"=>$_POST['inputBanco'],
		    "nCheque"=>$_POST['numCheque'],
		    "nDeposito"=>$_POST['numDeposito'],
		    "tipoDocumento"=>$_POST['tipoDocumento'],
		    "facturaRecibo"=>$_POST['facturaRecibo'], 
		    "montoAbono"=>str_replace(",","",$_POST['montoDeposito']), 					//...quita , como separador de miles ...
		    "tipoCambio"=>str_replace(",","",$_POST['cambioDolar']), 						//...quita , como separador de miles ...
		    "glosaDeposito"=>$_POST['glosaDeposito']
		);
		
		// ... actualiza registro tabla pedidocabecera ...
		$this-> load -> model("tablaGenerica_model");		//carga modelo ...
		$this-> tablaGenerica_model ->editarRegistro('pagospedido','deposito',$numDeposito,$regDeposito);
		
		if($cambioDolarAnterior!=0.00){		//... cuando el deposito es en $us.
			$montoAbonoAnterior=$montoAbonoAnterior * $cambioDolarAnterior;
		}
		
		if($tipoCambio!=0.00){		//... cuando el deposito es en $us.
			$montoDeposito=$montoDeposito * $tipoCambio;
		}
		
		// ... actualiza registro pedidocabecera ....	
		$this-> load -> model("tablaGenerica_model");
		
		if($local=='Z'){								//.... cuando local es Z:Zúñiga ...
			$this-> tablaGenerica_model ->disminuirValorFloat('pedidocabeceraz','numPedido',$numPedido,'abono',$montoAbonoAnterior);
			$sql="UPDATE pedidocabeceraz set abono= abono+ $montoDeposito WHERE numPedido='$numPedido' ";
			$this->db->query($sql);
		}else{											//.... cuando local es Tienda o Fabrica ...
			$this-> tablaGenerica_model ->disminuirValorFloat('pedidocabecera','numPedido',$numPedido,'abono',$montoAbonoAnterior);
			$sql="UPDATE pedidocabecera set abono= abono+ $montoDeposito WHERE numPedido='$numPedido' ";
			$this->db->query($sql);
		}
		
		redirect("menuController/index");	
		
	}	//... fin grabarDepositoModificado ...
	
	
	public function consultarStock(){
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='ventas' ){  //... valida permiso de userName ...
			$datos['mensaje']='Usuario NO autorizado para CONSULTAR STOCK';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
//			redirect('menuController/index');
		}	//... fin control de permisos de acceso ....
		else {		//... usuario validado ...
			$sql="SELECT codInsumo,nombreInsumo,unidad,existencia FROM almacen WHERE codInsumo LIKE 'P%' AND unidad!='' ";
			$registros = $this->db->query($sql);
			$contador= $registros->num_rows; //...contador de registros que satisfacen la consulta ..
			
			if($contador==0){  //...cuando NO hay registros ...
				$datos['mensaje']='No hay registros de productos semi terminados en la tabla ALMACÉN';
				$this->load->view('header');
				$this->load->view('mensaje',$datos );
				$this->load->view('footer');
			}
			else{      //... cuando hay registros ...
				/* Se obtienen los registros a mostrar*/ 
				$this->load->model("tablaGenerica_model");
		   		$datos['registros'] = $registros;
				
		 		/*Se llama a la vista para mostrar la información*/
				$this->load->view('header');
				$this->load->view('tienda/consultarStock', $datos);
				$this->load->view('footer');
				
			}  // fin else cuando hay registros 
		}	//... fin IF validar usuario ...
	} //... fin consultarStock ...	
	
	
	public function verCotizaciones(){
		//... control de permisos de acceso ....
		$permisoUserName=$this->session->userdata('userName');
		$permisoMenu=$this->session->userdata('usuarioMenu');
		$permisoProceso1=$this->session->userdata('usuarioProceso1');
		if($permisoUserName!='superuser' && $permisoUserName!='developer' && $permisoMenu!='ventas'){  //... valida permiso de userName ...
			$datos['mensaje']='Usuario NO autorizado para operar Sistema de Producción';
			$this->load->view('header');
			$this->load->view('mensaje',$datos );
			$this->load->view('footer');
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
		    	$config['base_url'] = base_url().'tienda/verCotizaciones';
				
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
				$this->load->view('tienda/verCotizaciones', $datos);
				$this->load->view('footer');
			}  // fin else cuando hay registros 
		}	//... fin IF validar acceso usuario...
	} //... fin crudVerCotizaciones ...
	
	 
	public function buscarCotizacion(){
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
	    	$config['base_url'] = base_url().'tienda/buscarCotizacion';
			
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
			$this->load->view('tienda/verCotizaciones', $datos);
			$this->load->view('footer');
		}		//... fin IF total registros encontrados ...
	}		//..fin buscarCotizaciones ...
 
}


/* End of file tienda.php */