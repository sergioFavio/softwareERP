<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf/fpdf.php";
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class PlanificarProduccionPdf extends FPDF {
        public function __construct() {
            parent::__construct();
        }
		
        // El encabezado del PDF
        public function Header(){
        	
         	//global $titulo;
			
            $this->Image('assets/img/logo.jpg',10,8,22);
            //$this->SetFont('Arial','B',13); // 'B' es negrita
            $this->SetFont('Arial','',13);
            $this->Cell(30);
			
     		//$this->Cell(120,10,'Reporte de Ingreso de '.$titulo,0,0,'C');
		
			$this->Cell(180,10,utf8_decode('Planificar Producción Producto '.$this->nombreDeposito.' de: ').$this->nombreProducto,0,0,'C');	
			
            $this->Ln('8');
            //$this->SetFont('Arial','B',8);
            $this->SetFont('Arial','',8);
            $this->Cell(30);
                
            $this->Cell(120,10,'Cantidad a Producir: '.number_format($this->cantidadProducto,0).'     Unidad: '. $this->unidadProducto,0,0,'C');
			
			$this->Cell(30,10,utf8_decode('Fecha Impresión: ').date("d-m-Y"),0,0,'C');
			
            $this->Ln(10);
			
			/*
	         * TITULOS DE COLUMNAS
	         *
	         * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
	        */	 
	        $this->Cell(13,7,utf8_decode('código'),'TBL',0,'C','0');
	        $this->Cell(58,7,'material','TB',0,'C','0');
			$this->Cell(54,7,'cant.Unitaria','TB',0,'R','0');
	        $this->Cell(13,7,'unidad','TB',0,'C','0');
	        $this->Cell(28,7,'cant.Requerida','TB',0,'C','0');
			$this->Cell(28,7,utf8_decode('cant.Almacén'),'TB',0,'C','0');
			$this->Cell(28,7,'cant.Bodega','TB',0,'C','0');
			$this->Cell(25,7,'cant.Faltante','TBR',0,'C','0');
	        $this->Ln(7);
       }

       // El pie del pdf
       public function Footer(){
           $this->SetY(-15);
           $this->SetFont('Arial','I',8);
           $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
      }
    }
?>;