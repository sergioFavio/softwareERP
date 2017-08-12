<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf/fpdf.php";
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class PlantillaProductoPdf extends FPDF {
        public function __construct() {
            parent::__construct();
        }
		
        // El encabezado del PDF
        public function Header(){
        	
         	//global $titulo;
			
            $this->Image('assets/img/logo.jpg',10,8,22);
            //$this->SetFont('Arial','B',13); // 'B' es negrita
                      
  			$this->Ln('7');        
            $this->SetFont('Arial','',14);
            $this->Cell(50);
			
			$this->Cell(90,10,utf8_decode(' Plantilla Producto ').$this->tipoProducto.': '.$this->descripcion ,0,0,'C');	
			
            $this->Ln('8');
            //$this->SetFont('Arial','B',8);
            $this->SetFont('Arial','',10);
            
            $this->Ln('5');
			$this->Cell(80,10,utf8_decode('Código Producto: '). $this->codigoProducto,0,0,'L');

			$this->Ln('9');
			
			/*
	         * TITULOS DE COLUMNAS
	         *
	         * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
	        */	
	        $this->Cell(1,7,' ','TBL',0,'C','0');
	        $this->Cell(16,7,utf8_decode('código'),'TB',0,'C','0');
			$this->Cell(19,7,' ','TB',0,'L','0');
	        $this->Cell(37,7,utf8_decode('material'),'TB',0,'C','0');
			$this->Cell(60,7,' ','TB',0,'R','0');
	        $this->Cell(18,7,'cantidad','TB',0,'C','0');
			$this->Cell(10,7,' ','TB',0,'L','0');
			$this->Cell(14,7,'unidad','TB',0,'C','0');
			$this->Cell(5,7,' ','TBR',0,'R','0');
	        $this->Ln(8);
       }

       // El pie del pdf
       public function Footer(){
           $this->SetY(-15);
           $this->SetFont('Arial','I',8);
           $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
       }
    }
?>;