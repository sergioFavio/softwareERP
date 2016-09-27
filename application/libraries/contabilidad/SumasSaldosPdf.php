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
            $this->Cell(40);
			
     		//$this->Cell(120,10,'Reporte de Ingreso de '.$titulo,0,0,'C');
		
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

            
/**
 * Set the styles for the advanced multicell
 */
//... $this->setStyle( "b", $oPdf->getDefaultFontName(), "B", 11, "130,0,30" );		
$sTxt = "  CUENTA                        D E S C R I P C I O N                     S U M A S    M E N S U A L E S     S U M A S    A C U M U L A D A S              SALDO                                                                                                            D E B E            H A B E R                 D E B E            H A B E R";

//create an advanced multicell
//..$this->multiCell( 0, 5, "Default line breaking characters:  ,.:;", 0 );
$this->multiCell( 188, 5, $sTxt, 1, 'L', 0, 0, 1 );
//..$this->Ln( 10 ); //new line		

	
/*			
$x = 10;
$y = 10;

$col1="PILOT REMARKS\n\n";
$this->MultiCell(100, 10, $col1, 1, 1);

$this->SetXY($x + 189, $y);

$col2="Pilot's Name and Signature\n".'Sergio Hernan Valenzuela Camara';
$this->MultiCell(53, 10, $col2, 1);
$this->Ln(0);
$col3="Date Prepared\n".date("d-m-Y");
$this->MultiCell(63, 10, $col3, 1);			
			
$this->Ln(5);		
$txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

// Multicell test
$this->MultiCell(55, 5, '[LEFT] '.$txt, 1, 'L', 1, 0, '', '', true);
$this->MultiCell(55, 5, '[RIGHT] '.$txt, 1, 'R', 0, 1, '', '', true);
$this->MultiCell(55, 5, '[CENTER] '.$txt, 1, 'C', 0, 0, '', '', true);
$this->MultiCell(55, 5, '[JUSTIFY] '.$txt."\n", 1, 'J', 1, 2, '' ,'', true);
$this->MultiCell(55, 5, '[DEFAULT] '.$txt, 1, '', 0, 1, '', '', true);			
*/			
			
			/*
	         * TITULOS DE COLUMNAS
	         *
	         * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
	        */	 
/*	        $this->Cell(16,5,'CUENTA','TBL',0,'C','0');
			$this->Cell(22,5,'','TB',0,'C','0');
	        $this->Cell(18,5,utf8_decode('D E S C R I P C I Ó N'),'TB',0,'C','0');
			$this->Cell(20,5,'','TB',0,'C','0');
			$this->Cell(28,5,utf8_decode('S U M A S    M E N S U A L E S'),'TB',0,'L','0');
			$this->Cell(16,5,'','TB',0,'C','0');
			$this->Cell(28,5,utf8_decode('S U M A S    A C U M U L A D A S'),'TB',0,'L','0');
			$this->Cell(25,5,'','TB',0,'C','0');
			$this->Cell(12,5,'SALDO','TB',0,'R','0');
			$this->Cell(3,5,'','TBR',0,'R','0');
*/	
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