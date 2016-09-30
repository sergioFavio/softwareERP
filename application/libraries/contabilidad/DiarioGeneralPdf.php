<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf/fpdf.php";
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class DiarioGeneralPdf extends FPDF {
        public function __construct() {
            parent::__construct();
        }
		
        // El encabezado del PDF
        public function Header(){
        	
         	//global $titulo;
			
            $this->Image('assets/img/logo.jpg',10,8,22);
            //$this->SetFont('Arial','B',13); // 'B' es negrita
            $this->SetFont('Arial','B',13);
            $this->Cell(30);
			
     		//$this->Cell(120,10,'Reporte de Ingreso de '.$titulo,0,0,'C');
		
			$this->Cell(215,10,utf8_decode('DIARIO GENERAL'),0,0,'C');	
			
            $this->Ln('8');
            //$this->SetFont('Arial','B',8);
            $this->SetFont('Arial','',8);
            $this->Cell(80,10,utf8_decode('Período de gestión: ').$this->gestion,0,0,'L');
			$this->Cell(41);
			 $this->Cell(80,10,utf8_decode('Expresado en bolivianos '),0,0,'L');
			$this->Cell(33);
			$this->Cell(80,10,utf8_decode('Fecha Impresión: ').date("d-m-Y"),0,0,'L');
            $this->Ln(8);
			
			/*
	         * TITULOS DE COLUMNAS
	         *
	         * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
	        */	 
	        $this->Cell(1,7,'','TBL',0,'L','0');
	        $this->Cell(3,7,utf8_decode('día'),'TB',0,'L','0');
			$this->Cell(5,7,'','TB',0,'L','0');
			$this->Cell(10,7,'comprobante','TB',0,'L','0');
			$this->Cell(12,7,'','TB',0,'L','0');
			$this->Cell(10,7,utf8_decode('No.Cuenta'),'TB',0,'L','0');
			$this->Cell(15,7,'','TB',0,'L','0');
	        $this->Cell(18,7,utf8_decode('descripción cuenta'),'TB',0,'L','0');
			$this->Cell(82,7,'','TB',0,'L','0');
			$this->Cell(22,7,'detalle - asiento','TB',0,'R','0');
			$this->Cell(50,7,'','TB',0,'L','0');
			$this->Cell(10,7,'debe','TB',0,'R','0');
			$this->Cell(23,7,'','TB',0,'L','0');
			$this->Cell(8,7,'haber','TB',0,'R','0');
			$this->Cell(5,7,'','TBR',0,'R','0');
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