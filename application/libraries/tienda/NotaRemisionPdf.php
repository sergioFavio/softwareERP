<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf/fpdf.php";
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class NotaRemisionPdf extends FPDF {
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
			
			$this->Cell(90,10,utf8_decode($this->local.' Nota de Remisión No. ').$this->secuenciaRemision.' / '.$this->anhoSistema ,0,0,'C');	
			
            $this->Ln('8');
            //$this->SetFont('Arial','B',8);
            $this->SetFont('Arial','',10);
            
            $this->Cell(80,10,utf8_decode('Cliente: '.$this->cliente),0,0,'L');
			
			$this->Cell(20,10,' ',0,0,'L');
			
			$this->Cell(80,10,utf8_decode('Dirección: '.$this->direccion),0,0,'L');
			
			
            $this->Ln('5');
//			$this->Cell(15);
			$this->Cell(80,10,utf8_decode('Fono/Celular: '). $this->fonoCelular,0,0,'L');
			$this->Cell(66,10,' ',0,0,'L');
			$this->Cell(35,10,utf8_decode('Fecha Entrega:  ').$this->fechaEntrega,0,0,'R');
			$this->Ln('9');
			
			/*
	         * TITULOS DE COLUMNAS
	         *
	         * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
	        */	
	        $this->Cell(1,7,' ','TBL',0,'C','0');
	        $this->Cell(20,7,utf8_decode('pedido item'),'TB',0,'C','0');
			$this->Cell(15,7,' ','TB',0,'L','0');
	        $this->Cell(37,7,utf8_decode('producto'),'TB',0,'C','0');
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