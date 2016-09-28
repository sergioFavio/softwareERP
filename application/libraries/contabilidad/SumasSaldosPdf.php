<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf/fpdf.php";
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class SumasSaldosPdf extends FPDF {
        public function __construct() {
            parent::__construct();
        }
		
        // El encabezado del PDF
        public function Header(){
        	
         	//global $titulo;
			
            $this->Image('assets/img/logo.jpg',10,8,22);
            //$this->SetFont('Arial','B',13); // 'B' es negrita
            $this->SetFont('Arial','B',13);
            $this->Cell(45);
			
			$this->Cell(100,10,utf8_decode('BALANCE DE SUMAS Y SALDOS'),0,0,'C');	
			
            $this->Ln('8');
            //$this->SetFont('Arial','B',8);
            $this->SetFont('Arial','',8);
			
			$this->Cell(60,10,utf8_decode('Período de gestión: ').$this->gestion,0,0,'L');
			$this->Cell(20);
			 $this->Cell(60,10,utf8_decode('Expresado en bolivianos '),0,0,'L');
			$this->Cell(10);
			$this->Cell(60,10,utf8_decode('Fecha Impresión: ').date("d-m-Y"),0,0,'L');
            $this->Ln(7);
	
			$sTxt1 = "  CUENTA                        D E S C R I P C I O N                     S U M A S    M E N S U A L E S     S U M A S    A C U M U L A D A S              ";
			$sTxt2 = "SALDO                                                                                                            D E B E            H A B E R                 D E B E            H A B E R";
			//create an advanced multicell
			$this->multiCell( 188, 5, $sTxt1.$sTxt2, 1, 'L', 0, 0, 1 );
			
	        $this->Ln(1);
       }

       // El pie del pdf
       public function Footer(){
           $this->SetY(-15);
           $this->SetFont('Arial','I',8);
           $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
      }
    }
?>;