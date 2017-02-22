<?php
function fechaLatinaParaMysql($fechaLatina){
  	$fechaMysql=substr($fechaLatina,6,4).substr($fechaLatina,2,3).'-'.substr($fechaLatina,0,2);
	return $fechaMysql;
}

function fechaMysqlParaLatina($fechaMysql){
	$data = new DateTime($fechaMysql);
	return $data-> format("d-m-Y");
}

function mesLiteral($mesNum){
	$mes[0]="-";
	$mes[1]="Enero";
	$mes[2]="Febrero";
	$mes[3]="Marzo";
	$mes[4]="Abril";
	$mes[5]="Mayo";
	$mes[6]="Junio";
	$mes[7]="Julio";
	$mes[8]="Agosto";
	$mes[9]="Septiembre";
	$mes[10]="Octubre";
	$mes[11]="Noviembre";
	$mes[12]="Deciembre";
	return $mes[$mesNum];
}

function ultimaFechaPeriodoGestion($mesGestion,$anhoGestion){ 	//...sistema de contabilidad ...
	$sql="SELECT MAX(fechaComprobante) AS ultimaFecha FROM comprobantedetalle WHERE MONTH(fechaComprobante)='$mesGestion' AND YEAR(fechaComprobante)='$anhoGestion'";		
	$regFechas= mysql_query($sql);	
	while ($fila = mysql_fetch_assoc($regFechas)) {
	    $ultimaFecha=$fila["ultimaFecha"];
	}
	$ultimaFecha= substr($ultimaFecha,8,2).substr($ultimaFecha,4,4).substr($ultimaFecha,0,4);
	return $ultimaFecha;		
}
