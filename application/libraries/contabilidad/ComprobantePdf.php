<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf/fpdf.php";
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class ComprobantePdf extends FPDF {
        public function __construct() {
            parent::__construct();
        }
		
        // El encabezado del PDF
        public function Header(){
         	//global $titulo;
			
            $this->Image('assets/img/logo.jpg',10,8,22);
            //$this->SetFont('Arial','B',13); // 'B' es negrita
            
		    $this->SetFont('Arial','',8);
		    $this->Cell(335,8,utf8_decode('Fecha Impresión: ').date("d-m-Y"),0,0,'C');
		             
  			$this->Ln('7');        
            $this->SetFont('Arial','',13);
            $this->Cell(50);
			
			$this->Cell(90,10,utf8_decode(' Comprobante de '.strtoupper($this->tipoComprobante).' No.: ').substr($this->numeroComprobante,0,6).'-'.substr($this->numeroComprobante,6,3),0,0,'C');	
			
            $this->Ln('8');
            //$this->SetFont('Arial','B',8);
            $this->SetFont('Arial','',8);
            if($this->tipoComprobante=='Egreso'){
				$this->Cell(40,10,utf8_decode('Banco: '.$this->clienteBanco),0,0,'L');
				$this->Cell(4);
				$this->Cell(35,10,utf8_decode('Cheque No.: '.$this->numeroCheque),0,0,'L');
				$this->Cell(5);
				$this->Cell(80,10,'Concepto: '. utf8_decode($this->concepto),0,0,'L');
				$this->Cell(4);
				$this->Cell(20,10,utf8_decode('Fecha:  ').$this->fechaComprobante,0,0,'R');
            }

			if($this->tipoComprobante=='Ingreso'){
            	$this->Cell(50,10,utf8_decode('Cliente: '.$this->clienteBanco),0,0,'L');
				$this->Cell(10);
				$this->Cell(88,10,'Concepto: '. utf8_decode($this->concepto),0,0,'L');
				$this->Cell(20);
				$this->Cell(20,10,utf8_decode('Fecha:  ').$this->fechaComprobante,0,0,'R');
            }
			
			if($this->tipoComprobante=='Diario'){
				$this->Cell(88,10,'Concepto: '. utf8_decode($this->concepto),0,0,'L');
				$this->Cell(80);
				$this->Cell(20,10,utf8_decode('Fecha:  ').$this->fechaComprobante,0,0,'R');
            }
			
			$this->Ln('8');
			
			/*
	         * TITULOS DE COLUMNAS
	         *
	         * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
	        */	 
	        $this->Cell(15,7,utf8_decode('cuenta'),'TBL',0,'C','0');
	        $this->Cell(37,7,utf8_decode('descripción'),'TB',0,'C','0');
			$this->Cell(78,7,' ','TB',0,'R','0');
	        $this->Cell(14,7,'debe','TB',0,'C','0');
			$this->Cell(27,7,' ','TB',0,'R','0');
			$this->Cell(14,7,'haber','TB',0,'C','0');
			$this->Cell(3,7,' ','TBR',0,'R','0');
			
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