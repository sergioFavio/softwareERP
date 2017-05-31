<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf/fpdf.php";
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class BalanceInicialPdf extends FPDF {
        public function __construct() {
            parent::__construct();
        }
		
        // El encabezado del PDF
        public function Header(){
        	
         	//global $titulo;
			
            $this->Image('assets/img/logo.jpg',10,8,22);
            //$this->SetFont('Arial','B',13); // 'B' es negrita
            $this->SetFont('Arial','B',13);
            $this->Cell(35);
			
     		//$this->Cell(120,10,'Reporte de Ingreso de '.$titulo,0,0,'C');
		
			$this->Cell(120,10,utf8_decode('BALANCE INICIAL'),0,0,'C');	
			
            $this->Ln('8');
     
            $this->SetFont('Arial','',8);
//			$this->Cell(60,10,utf8_decode('Período de gestión: ').$this->gestion,0,0,'L');
			$this->Cell(70);		// ... anteriror 10
			$this->Cell(20,10,utf8_decode('Al ').$this->ultimaFecha,0,0,'L');
			$this->Cell(50,10,utf8_decode('Expresado en bolivianos '),0,0,'L');	
			$this->Cell(10);
			$this->Cell(60,10,utf8_decode('Fecha Impresión: ').date("d-m-Y"),0,0,'L');
            $this->Ln(7);
            
			/*
	         * TITULOS DE COLUMNAS
	         *
	         * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
	        */	 
	        $this->Cell(100,7,'','TBL',0,'C','0');
	        $this->Cell(18,7,'A  C  T  I  V  O','TB',0,'C','0');
			$this->Cell(38,7,'','TB',0,'C','0');
			$this->Cell(22,7,'PASIVO y PATRIMONIO','TB',0,'R','0');
			$this->Cell(10,7,'','TBR',0,'R','0');
	        $this->Ln(4);
       }

       // El pie del pdf
       public function Footer(){
           $this->SetY(-15);
           $this->SetFont('Arial','I',8);
           $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
      }
    }
?>;