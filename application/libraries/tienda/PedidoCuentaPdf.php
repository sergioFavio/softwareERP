<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf/fpdf.php";
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class PedidoCuentaPdf extends FPDF {
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
		
			$this->Cell(120,10,utf8_decode('Cuenta Pedido No.: '.$this->numeroPedido),0,0,'C');	
			
            $this->Ln('8');
            //$this->SetFont('Arial','B',8);
            $this->SetFont('Arial','',8);
			 $this->Cell(1);
            $this->Cell(55,10,utf8_decode('Cliente: ').$this->cliente,0,0,'L');
			$this->Cell(10);
			$this->Cell(25,10,utf8_decode('Fecha Pedido: ').fechaMysqlParaLatina($this->fechaPedido),0,0,'L');
			$this->Cell(18);
			 $this->Cell(30,10,utf8_decode('Importe Bs.: ').number_format($this->importe,2),0,0,'L');
			$this->Cell(10);
			$this->Cell(25,10,utf8_decode('Fecha Impresión: ').date("d-m-Y"),0,0,'L');
            $this->Ln(8);
			
			/*
	         * TITULOS DE COLUMNAS
	         *
	         * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
	        */	 
	        $this->Cell(15,7,'fecha','TBL',0,'C','0');
			$this->Cell(20,7,'','TB',0,'C','0');
			$this->Cell(10,7,'banco','TB',0,'C','0');
			$this->Cell(12,7,'','TB',0,'C','0');
	        $this->Cell(15,7,'# cheque','TB',0,'C','0');
			$this->Cell(5,7,'','TB',0,'C','0');
			$this->Cell(10,7,utf8_decode('factura'),'TB',0,'C','0');
			$this->Cell(8,7,'','TB',0,'C','0');
			$this->Cell(10,7,utf8_decode('compbte.'),'TB',0,'C','0');
			$this->Cell(17,7,'','TB',0,'C','0');
			$this->Cell(15,7,'efectivo Bs.','TB',0,'C','0');
			$this->Cell(10,7,'','TB',0,'C','0');
			$this->Cell(15,7,'cheque Bs.','TB',0,'R','0');
			$this->Cell(10,7,'','TB',0,'C','0');
			$this->Cell(13,7,'saldo Bs.','TB',0,'R','0');
			$this->Cell(2,7,'','TBR',0,'R','0');
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