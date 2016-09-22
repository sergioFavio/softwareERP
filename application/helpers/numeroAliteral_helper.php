<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('convertirNumeroAliteral'))
{
    function convertirNumeroAliteral($cadena = '')
    {
        $digito="";
		$literal="";
		$indice=-1;
		$unidades[0]="";
		$unidades[1]="un ";
		$unidades[2]="dos ";
		$unidades[3]="tres ";
		$unidades[4]="cuatro ";
		$unidades[5]="cinco ";
		$unidades[6]="seis ";
		$unidades[7]="siete ";
		$unidades[8]="ocho ";
		$unidades[9]="nueve ";
		
		$dieces[0]="";
		$dieces[1]="once ";
		$dieces[2]="doce ";
		$dieces[3]="trece ";
		$dieces[4]="catorce ";
		$dieces[5]="quince ";
		$dieces[6]="dieciseis ";
		$dieces[7]="diecisiete ";
		$dieces[8]="dieciocho ";
		$dieces[9]="diecinueve ";
		
		$decenas[0]="";
		$decenas[1]="diez ";
		$decenas[2]="veinte ";
		$decenas[3]="treinta ";
		$decenas[4]="cuarenta ";
		$decenas[5]="cincuenta ";
		$decenas[6]="sesenta ";
		$decenas[7]="setenta ";
		$decenas[8]="ochenta ";
		$decenas[9]="noventa ";
		
		$centenas[0]="";
		$centenas[1]="ciento ";
		$centenas[2]="doscientos ";
		$centenas[3]="trescientos ";
		$centenas[4]="cuatrocientos ";
		$centenas[5]="quinientos ";
		$centenas[6]="seiscientos ";
		$centenas[7]="setecientos ";
		$centenas[8]="ochocientos ";
		$centenas[9]="novecientos ";
		
		for(  $i=0;$i<strlen($cadena);$i++){
	         $digito = substr($cadena,$i,1);
	         $indice= $digito;
	
			 if((strlen($cadena) - $i == 1) || (strlen($cadena) - $i == 4) || (strlen($cadena) - $i == 7) ){   // ... unidades ...
				if((strlen($cadena)>1) && (strlen($cadena)!=strlen($cadena) - $i) && ($digito !='0')){        // ... agrega y
					$literal=$literal."y ";
	            }
				$literal=$literal.$unidades[$indice];
	         }
	
			 if((strlen($cadena) - $i == 2) || (strlen($cadena) - $i == 5) || (strlen($cadena) - $i == 8) ){   // ... decenas y dieces ...
			 	if(($digito=='1') && (substr($cadena,$i+1,1)!='0')   ){	// ... dieces ...
					$digito = substr($cadena,$i+1,1);
	                $indice= $digito;
					$literal=$literal.$dieces[$indice];
	   				$i++;
				} else{										//... decenas ...
	   				$literal=$literal.$decenas[$indice];
	            }
	         }
	
	         if((strlen($cadena) - $i == 3) || (strlen($cadena) - $i == 6) || (strlen($cadena) - $i == 9)){   // ... centenas ...
			 	if(($digito=='1') && (substr($cadena,$i+1,1)=='0') && (substr($cadena,$i+2,1)=='0')){	// ... cien ...
					$literal=$literal." cien ";
				}
	            else{							//...centenas distintas de 100...
	   				$literal=$literal.$centenas[$indice];
				}
	         }
	
			 if((strlen($cadena)-$i  == 4)    ){   // ... mil ...
				if(strlen($cadena)  == 7 && substr($cadena,1,3)!='000' ){
					$literal=$literal."mil ";
				}
				if(strlen($cadena)  == 8 && substr($cadena,2,3)!='000' ){
					$literal=$literal."mil ";
				}
				if(strlen($cadena)  == 9 && substr($cadena,3,3)!='000' ){
					$literal=$literal."mil ";
				}
				if(strlen($cadena)<= 6 ){
					$literal=$literal."mil ";
				}
	         }
	
			 if((strlen($cadena)-$i  == 7) && ($digito=='1') && (strlen($cadena)  == 7)){   // ... millon  ...
	   			$literal=$literal."millon ";
	         }
	                  	 
			 if((strlen($cadena)-$i  == 7) && ($digito!='1') ){   // ... millones  ...
	   			$literal=$literal."millones ";
			 }	
	
			 if((strlen($cadena)-$i  == 7) && ($digito=='1') && (strlen($cadena)  > 7)){   // ... millones  ...
	   			$literal=$literal."millones ";
	         }
			
		  }		//... fin FOR ...
		return $literal;
    }   
}
