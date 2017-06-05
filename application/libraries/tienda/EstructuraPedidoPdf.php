<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf/fpdf.php";
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class EstructuraPedidoPdf extends FPDF {
        public function __construct() {
            parent::__construct();
        }
		
        // El encabezado del PDF
        public function Header(){
        	
         	//global $titulo;
			
            $this->Image('assets/img/logo.jpg',10,8,22);
            //$this->SetFont('Arial','B',13); // 'B' es negrita
            
		    $this->SetFont('Arial','',9);
		    $this->Cell(335,9,utf8_decode('Fecha Impresión: ').date("d-m-Y"),0,0,'C');
		             
  			$this->Ln('7');        
            $this->SetFont('Arial','',13);
            $this->Cell(50);
			
			$this->Cell(90,10,utf8_decode($this->local.' Pedido No. ').$this->secuenciaPedido.' / '.$this->anhoSistema ,0,0,'C');	
			
            $this->Ln('8');
            //$this->SetFont('Arial','B',8);
            $this->SetFont('Arial','B',10);
           
		    $this->Ln('10');
		    $this->Cell(50,10,utf8_decode('CLIENTE: '.$this->cliente),0,0,'L');
            $this->Ln('6');
			
			$this->Cell(50,10,utf8_decode('FECHA PEDIDO: ').$this->fechaPedido,0,0,'L');
            $this->Ln('6');
			
			$this->Cell(50,10,utf8_decode('FECHA ENTREGA: ').$this->fechaEntrega,0,0,'L');
            $this->Ln('6');
			
			$this->Cell(50,10,utf8_decode('ORDEN DE COMPRA: ').$this->ordenCompra,0,0,'L');
            $this->Ln('6');
			
			$this->Cell(50,10,utf8_decode('PERSONA CONTACTO: '.$this->contacto),0,0,'L');
            $this->Ln('6');
			
			$this->Cell(50,10,utf8_decode('TELÉFONO: ').$this->fonoCelular,0,0,'L');
            $this->Ln('6');
			
			$this->Cell(50,10,utf8_decode('FACTURAR A NOMBRE DE: '.$this->facturarA),0,0,'L');
            $this->Ln('6');
			
			$this->Cell(50,10,utf8_decode('NÚMERO DE NIT: ').$this->nit,0,0,'L');
            $this->Ln('6');
			
			$this->Cell(50,10,utf8_decode('DIRECCIÓN: '.$this->direccion),0,0,'L');
            $this->Ln('6');
			
			$this->Cell(50,10,utf8_decode('LOCALIDAD: '.$this->localidad),0,0,'L');
            $this->Ln('8');
			
			$this->SetFont('Arial','',8);
			/*
	         * TITULOS DE COLUMNAS
	         *
	         * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
	        */	 
	        $this->Cell(15,7,utf8_decode('código'),'TBL',0,'C','0');
	        $this->Cell(37,7,utf8_decode('producto'),'TB',0,'C','0');
			$this->Cell(30,7,' ','TB',0,'R','0');
			$this->Cell(30,7,' ','TB',0,'R','0');
	        $this->Cell(18,7,'cantidad','TB',0,'C','0');
			$this->Cell(14,7,'unidad','TB',0,'C','0');
			$this->Cell(10,7,' ','TB',0,'R','0');
			$this->Cell(15,7,'precio Bs.','TB',0,'C','0');
			$this->Cell(19,7,'importe Bs.','TBR',0,'R','0');
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