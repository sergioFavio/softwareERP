<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf/fpdf.php";
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class KardexMaterial extends FPDF {
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
			
     		//$this->Cell(120,10,'Reporte de Salida de '.$titulo,0,0,'C');
		
			$this->Cell(120,10,utf8_decode('Kardex Material: ').$this->descripcionMaterial,0,0,'C');	
			
            $this->Ln('8');
            //$this->SetFont('Arial','B',8);
            $this->SetFont('Arial','',8);
            $this->Cell(30);
            //$this->Cell(120,10,'Desde 26/09/2014 al 30/09/2014',0,0,'C');
            
    		$this->Cell(120,10,'Desde: '.$this->fechaInicial.'     Hasta: '. $this->fechaFinal,0,0,'C');
			
			$this->Cell(30,10,utf8_decode('Fecha Impresión: ').date("d-m-Y"),0,0,'C');
			
            $this->Ln(10);
			
			/*
	         * TITULOS DE COLUMNAS
	         *
	         * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
	        */	 
	        $this->Cell(15,7,'fecha','TBL',0,'C','0');
	        $this->Cell(15,7,'factura No.','TB',0,'C','0');
			$this->Cell(18,7,'salida No.','TB',0,'R','0');
	        $this->Cell(18,7,'orden No.','TB',0,'C','0');
	        $this->Cell(19,7,'ingreso','TB',0,'R','0');
			$this->Cell(19,7,'salida','TB',0,'R','0');
			$this->Cell(22,7,'saldo','TB',0,'R','0');
			$this->Cell(20,7,'unidad','TB',0,'C','0');
			$this->Cell(39,7,'responsable','TBR',0,'C','0');
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