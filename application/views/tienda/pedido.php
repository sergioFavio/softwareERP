<link rel="stylesheet" type="text/css"  href="<?=base_url(); ?>css/ingresoSalidaMaterial.css" />
	
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery-ui-1.8.20.custom.min.js"></script>

<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>"> <!-- una de las librerias de bootstarp para manejar fecha-->
	
<style type="text/css" >

#inputFecha, #inputEntrega{font-size:11px;text-align:center;}

/*  inicio de scrollbar  */
thead { display:block;  margin:0px; cell-spacing:0px; left:0px; }  
tbody { display:block; overflow:auto; height:310px; }               
th { height:10px;  width:840px;}                                    
td { height:10px;  width:840px; margin:0px; cell-spacing:0px;}
/*  fin de scrollbar  */

/*   light box descripcion */
.nota-dialog {width:450px;}
#notaModal{padding-top:195px;padding-left:450px;}  /* ... baja la ventana modal más al centro vertical ... */

#cuerpoIngreso{margin:0 auto;  padding:0; width:920px; background:#f4f4f4;}
.cabeceraIngreso{margin:5px;}
#titulo{font-size:16px;margin-top:1px;  text-align:right;font-weight : bold}

</style>


<script>
var filaActual =-100;  // fila del formulario donde se adiciona registro ..
var totalBs=0;      // ... calcula a partir de la suma de todos los importes formulario ..ingreso de materiales			
$(document).ready(function() {
	
	$("form").keypress(function(e) {			//... dseactiva la tecla ENTER ...
        if (e.which == 13) {
            return false;
        }
    });
		
	/*  inicio de light box  javascript */
	$('.openLightBox').click(function(){
  		var title = $(this).attr("title");
  		filaActual = $(this).attr("fila");
  		var codPrefijo='#idMat_'; // para sleccionar material
  				
  		if(!filaVacia(filaActual,codPrefijo)){
  			$('.modal-title').html(title);
	  		$('#myModal').modal({show:true});
  		}else{
  			alert('¡¡¡ A V I S O !!! ... Seleccione la primera fila vacía.');// fila vacía ...
  		}

	});
	/*  fin de light box javascript  */	
	
		 
    	$('#tabla2').dataTable();
    
    	$('#tabla2 tbody').on('click', 'tr', function () {	
        	var codigoMaterial = $('td', this).eq(0).text();
        	var nombreMaterial = $('td', this).eq(1).text();
        	var unidad = $('td', this).eq(3).text();
        	var precio = $('td', this).eq(4).text();
         
  		var limiteArreglo=document.getElementsByClassName("detalleMaterial").length;   // limiteArreglo a buscar codigoRepetido
		var codPrefijo='#idMat_'; // para sleccionar material
		var codigoRepetido =verificarCodigoRepetido(codigoMaterial,filaActual,limiteArreglo,codPrefijo);			
 			
// 		if(!codigoRepetido){
			$('#idMat_'+filaActual).val(codigoMaterial);
			$('#mat_'+filaActual).val(nombreMaterial);
			$('#unidadMat_'+filaActual).val(unidad);
			$('#precioMat_'+filaActual).val(precio);
			
			$('#colorMat_'+filaActual).val("");				//... blanquea campo ...
			$('#cantMat_'+filaActual).val("");				//... blanquea campo ...
			$('#importeMat_'+filaActual).val("");				//... blanquea campo ...
					
        	$('#myModal').modal('hide'); // cierra el lightBox
//    	}else{
//    		alert("¡¡¡ Este código" +codigoMaterial +" ya fué adicionado ...!!!");
//    		$('#myModal').modal('hide'); // cierra el lightbox
//      	}
        	
	} ); // fin #tabla2 tbody
	
			
	$("#btnBorrarIngreso").click(function(){
        	borrarFormularioIngreso();
    });	
    		
	$("#btnGrabarPedido").click(function(){
	// grabar cotizacion...
    	grabarPedido();
	});
	
	
	$('#btnNota').click(function(){	
		var title = $(this).attr("data-title");
		$('.modal-title').html(title);		
  		$('#notaModal').modal({show:true});
	});	//...fin btnNota ...
	
	$("#btnBorrarNota").click(function(){
        	$("#nota").val("");
    });
		
}); // fin document.ready 
		

function verificarCodigoRepetido(codigoMaterial,posicionFila,limiteArreglo,codPrefijo){
	var codigo = codigoMaterial;
	var posicion = parseInt( posicionFila ); // convierte de string to number 
	var limite =limiteArreglo;
	var codigoRepetido= false;  // retorna el estado de la busqueda
	var codigoPrefijo=codPrefijo;	
					
	for(var i=0; i<limiteArreglo; i++){
		var codigoTdFormulario = $(codigoPrefijo+i).val(); // asigna codigo del material actual
	    		
			if(codigo == codigoTdFormulario && i != posicion){
	       			codigoRepetido= true;
	       			break;
	       		}
	}
	return codigoRepetido;
}	// fin funcion verificarCodigoRepetido 
	

function borrarFormularioIngreso(){
	//...esta funcion borra los datos del formularioIngreso
	var fila = document.getElementsByClassName("detalleMaterial");
	for(var i=0; i<fila.length; i++){
	    $("#idMat_"+i).val("");
        $("#mat_"+i).val("");
		$("#colorMat_"+i).val("");
		$("#cantMat_"+i).val("");
		$("#unidadMat_"+i).val("");
		$("#precioMat_"+i).val("");
		$("#importeMat_"+i).val("");
	} // fin ciclo FOR
	document.form_.detalleTotalBs.value="";
	$("#saldo").val("");
} // fin funcion borrarFormularioIngreso 
			

function eliminarComa(numero){
	//...esta funcion elimina la coma(,) como separador de miles de una variable que esta string
	//... para convertirla en numerica ...
	var auxiliarMonto=numero;
	auxiliarMonto=auxiliarMonto.split(','); //... elimina ,
	auxiliarMonto=auxiliarMonto[0]+auxiliarMonto[1]+auxiliarMonto[2];
	auxiliarMonto=parseFloat( auxiliarMonto );	
	return auxiliarMonto;
} // ... fin funcion eliminarComa ... 
	

function grabarPedido(){
	var i=0;  //... cuenta numeroFilas  del formulario materiales ...
	var registrosValidos= true;	  // ... bandera para grabar o no grabar registros ...
	
	if($("#cliente").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de CLIENTE está vacío");
			registrosValidos= false;	
	}
	
	if($("#contacto").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de CONTACTO está vacío");
			registrosValidos= false;	
	}
	
	if($("#inputDireccion").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de DIRECCION está vacío");
			registrosValidos= false;	
	}
/*	
	if($("#cotizacionFabrica").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de COTIZACION FABRICA está vacío");
			registrosValidos= false;	
	}
*/	
//	if($("#telCel").val()!="" ){
/*		alert("¡¡¡ E R R O R !!! ... El contenido de TELEFONO/CELULAR está vacío");
		registrosValidos= false;	
	}
	else{
*/		
//		var numero= $('#telCel').val();
//		if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
//		{
//    		alert("El valor " + numero + " no es un número telefónico");
//    		$("#telCel").val("");   // borra celda de cantidad
//    		registrosValidos= false;
//    	}
//	}
	
	if($("#localidad").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de LOCALIDAD está vacío");
			registrosValidos= false;	
	}
	
	if($("#inputFecha").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de FECHA está vacío, seleccione una fecha");
			registrosValidos= false;	
	}
	
	if($("#inputEntrega").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de FECHA DE ENTREGA está vacío, seleccione una fecha");
			registrosValidos= false;	
	}
	
	if($("#facturarA").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de FACTURAR A está vacío");
			registrosValidos= false;	
	}
	
	if($("#aCuenta").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de A CUENTA está vacío");
			registrosValidos= false;	
	}

//	if($("#nit").val()=="" ){
//			alert("¡¡¡ E R R O R !!! ... El contenido de NIT está vacío");
//			registrosValidos= false;	
//	}

	if($("#descuento").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de DESCUENTO está vacío");
			registrosValidos= false;	
	}

	if($("#idMat_0").val()=="" ){        //... registro primer formulario... materiales
			alert("¡¡¡ E R R O R !!! ... No se ha ingresado ningún registro de materiales");
			registrosValidos= false;	
	}
	
			
	// ... valida que los registros no tengan cantidad vacia formulario materiales  ...
	while($("#idMat_"+i).val()!= ""){
		if($("#cantMat_"+i).val()==""){
			alert("¡¡¡ E R R O R !!! ... El valor de CANTIDAD está en vacío");
			registrosValidos= false;	
		}
		
		if($("#precioMat_"+i).val()=="0.00"){
			alert("¡¡¡ E R R O R !!! ... El valor de PRECIO está en cero");
			registrosValidos= false;	
		}
		
		i++;
	} // ... fin while ...
	
		
	document.form_.numeroFilas.value=i;  // ... numeroFilasValidas  variable hidden formulario materiales...
		
	if(!registrosValidos){
		alert('Corrija los campos que están vacíos');
	}else{	
		$("#form_").submit(); // ...  graba registros ...
	}
			
}	// ... fin funcion grabarPedido() ...
	

function validarFechaMayor(){
		
	if($("#inputFecha").val()=="" ||  $("#inputEntrega").val()==""  ){
		alert("¡¡¡ E R R O R !!! ... El contenido de FECHA ó FECHA ENTREGA está vacío, seleccione una fecha");	
	}else{
		var fechaInicio =$("#inputFecha").val();
	 	var fechaFin = $("#inputEntrega").val();
	 	
		fechaInicio = fechaInicio.split('-');
	 	fechaFin = fechaFin.split('-');
	                    
	 	fechaInicio = new Date(fechaInicio[0], fechaInicio[1] - 1, fechaInicio[2]).valueOf();
	 	fechaFin = new Date(fechaFin[0], fechaFin[1] - 1, fechaFin[2]).valueOf();
	
        // Verificamos que la fecha no sea posterior a la actual
        
        if(fechaInicio > fechaFin)
        {	
   			alert(" ¡¡¡... ERROR ... !!! La fecha final "+$("#inputEntrega").val()+" NO es superior a la fecha inicial "+$("#inputFecha").val()  );   
   			value="<?=date('d-m-Y')?>"
   			$("#inputFecha").val("<?=date('d-m-Y')?>");
   			$("#inputEntrega").val("<?=date('d-m-Y')?>");	
        }
	}
					                                	
}   // fin ... validarFechas ...


function validarIngresoColor(filaExistencia){
   
	if($("#idMat_"+filaExistencia).val()==""){
		alert("¡¡¡ ERROR !!! Primero seleccione un registro para ingresar color.");
		$("#colorMat_"+filaExistencia).val("");   // borra celda de color
					
	}
}   // fin ... validarIngresoColor ...

		
function validarCantidadIngreso(numero, filaExistencia){
   
	if($("#idMat_"+filaExistencia).val()==""){
		alert("¡¡¡ ERROR !!! Primero seleccione un registro para ingresar cantidad.");
		$("#cantMat_"+filaExistencia).val("");   // borra celda de cantidad
					
	}else{
			
		var cantidad=parseFloat( numero ); // convierte de string to number 
    	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
    	if (!/^\d{1,7}(\.\d{1,2})?$/.test(numero)){  // ...hasta 5 digitos parte entera y hasta 2 parte decimal ...
    		alert("El valor " + numero + " no es válido");
    		$("#cantMat_"+filaExistencia).val("");   // borra celda de cantidad
    	}else{
    		var cantidad=$("#cantMat_"+filaExistencia).val();
    		var precioCompra=$("#precioMat_"+filaExistencia).val();
    		$("#importeMat_"+filaExistencia).val( separadorMiles( (cantidad*precioCompra).toFixed(2) ) );   //... actualiza importe
    		calcularTotalBs('_');   //... actualiza totalBs formualrio ingreso materiales
    	}
	    		
	}
}   // fin ... validarCantidadIngreso ...


function validarPrecio(numero, filaExistencia){
   
	if($("#idMat_"+filaExistencia).val()==""){
		alert("¡¡¡ ERROR !!! Primero seleccione un registro para ingresar precio.");
		$("#precioMat_"+filaExistencia).val("");   // borra celda de cantidad
					
	}else{	
	    //var precio=parseFloat( numero ); // convierte de string to number 
    	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
    	if (!/^\d{1,7}(\.\d{1,2})?$/.test(numero)){  // ...hasta 5 digitos parte entera y hasta 2 parte decimal ...
    		alert("El valor " + numero + " no es válido");
    		$("#cantMat_"+filaExistencia).val("");   // borra celda de cantidad
    	}else{
    		var cantidad=$("#cantMat_"+filaExistencia).val();
    		var precioCompra=$("#precioMat_"+filaExistencia).val();
    		$("#importeMat_"+filaExistencia).val( separadorMiles( (cantidad*precioCompra).toFixed(2) ) );   //... actualiza importe
    		calcularTotalBs('_');   //... actualiza totalBs formualrio ingreso materiales
    	}
	    		
	}
}   // fin ... validarPrecio ...


function validarNumero(numero,campo){	
		// ... valida ingreso de numeros para telefono/celular y NIT 
    	if (!/^([0-9])*$/.test(numero)){  // ... solo numeros enteros ...  
    	//if (!/^\d{1,7}(\.\d{1,2})?$/.test(numero)){  // ...hasta 5 digitos parte entera y hasta 2 parte decimal ...
    		alert("El valor " + numero + " no es válido");
    		$("#"+campo).val("");   // borra celda de aCuenta
    	}
}   // fin ... validarNumero ...


function validarAcuenta(numero){	
		var aCuenta=parseFloat( numero ); // convierte de string to number 
    	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
    	if (!/^\d{1,7}(\.\d{1,2})?$/.test(numero)){  // ...hasta 5 digitos parte entera y hasta 2 parte decimal ...
    		alert("El valor " + numero + " no es válido");
    		$("#aCuenta").val("");   // borra celda de aCuenta
    	}else{
    		$("#aCuenta").val( separadorMiles( aCuenta.toFixed(2) ));   //... actualiza aCuenta
    		calcularTotalBs('_');   //... actualiza totalBs formulario
    	}
	    		
}   // fin ... validarAcuenta ...


function validarDescuento(numero){
   		
	var descuento=parseFloat( numero ); // convierte de string to number 
//	if (!/^([0-9])*$/.test(numero) || $("#descuento").val()>19 ){  // ... solo numeros enteros ...  
	if (!/^\d{1,2}(\.\d{1,2})?$/.test(numero) || $("#descuento").val()>19   ){  // ...hasta 2 digitos parte entera y hasta 2 parte decimal ...
		alert("El valor " + numero + " no es válido");
		$("#descuento").val("");   // borra celda de descuento
	}else{
		calcularTotalBs('_');   //... actualiza totalBs formulario
	}
}   // fin ... validarDescuento ...


function calcularTotalBs(sufijo){
	//...suma los importes del formularioIngreso
	var i=0;
	totalBs=0.00;
	totalBs=parseFloat(totalBs);
	saldo=0.00;
	descuento=0.00;
	aCuenta=0.00;
	while($("#idMat"+sufijo+i).val()!= ""){
		var importe=$("#importeMat"+sufijo+i).val();

		importe=eliminarComa(importe);   //... elimina ,

		totalBs= totalBs +  importe ;
		i++;
	} // fin ciclo WHILE
	
	aCuenta=$("#aCuenta").val();
	
	aCuenta=eliminarComa(aCuenta);   //... elimina ,
	
	descuento=$("#descuento").val();
	
	saldo= totalBs*(1 -(1*descuento/100) )- aCuenta; 
	
	aCuenta=separadorMiles(aCuenta.toFixed(2) );
	saldo=separadorMiles(saldo.toFixed(2) );
	
	totalBs=separadorMiles(totalBs.toFixed(2) ); 
	
	document.form_.detalleTotalBs.value=totalBs;  // ... totalBs  variable formulario materiales ...
	
	$("#aCuenta").val(aCuenta);
	$("#saldo").val(saldo);
} // fin funcion ... calcularTotalBs 

		
function separadorMiles(n){
    var rx=  /(\d+)(\d{3})/;
    return String(n).replace(/^\d+/, function(w){
        while(rx.test(w)){
            w= w.replace(rx, '$1,$2');
        }
        
        return w;
    });
}

		
function filaVacia(posicionFila, codPrefijo){
	var filaAnterior= parseInt( posicionFila )-1;
	var codigoPrefijo=codPrefijo;	
			
	if($(codigoPrefijo+ filaAnterior).val()==""  && filaAnterior >=0 ){
		return true;  // fila vac�a ...
	}else{
		return false; // fila llena ...
	}
}  // ... fin validarFilaSeleccionada ...

</script>

<div class="jumbotron" id="cuerpoIngreso">	
	
   <form class="form-horizontal" method="post" action="<?=base_url()?>tienda/grabarPedido" id="form_" name="form_" >
   	<div style="height:7px;"></div>
	 
	<div class="cabeceraIngreso">
		<div class="row-fluid">
			
	    	<div class="col-md-2">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-user"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="cliente" name="cliente" placeholder="cliente&hellip;" style="width: 220px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-md-2 -->
	    	
	    	<div class="col-xs-2">
	    	 	<span></span>
	    	</div>
	    	
	    	<div class="col-md-2">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-home"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="direccion" name="direccion" placeholder="dirección&hellip;" style="width: 220px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-md-2 -->
	    	
	    	<div class="col-xs-2">
	    	 	<span></span>
	    	</div>
	    	
	    	<div class="col-xs-2">
	    	 	<span id="titulo" class="label label-default">Pedido: <?= $secuenciaPedido.'/'.$anhoSistema ?> </span>
	    	</div> 
	    	
	    	<div class="col-xs-1">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-tags"></span> </span>
	    	 		<input type="text"  class="form-control input-sm" id="cotizacionFabrica" name="cotizacionFabrica" placeholder="# cotiz.Fab. &hellip;" style="width: 100px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-md-1 --> 
	    	
		</div>
		
		<div style="height:35px;"></div>
		
		<div class="row-fluid"> <!-- segunda fila de la cabecera -->
			
		    <div class="col-md-1">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-earphone"></span> </span>
	    	 		<input type="text" class="form-control input-sm" id="telCel" name="telCel" placeholder="telf./cel.&hellip;" style="width:110px;font-size:11px;text-align:center;" );'>
	    		</div>
	    	</div><!-- /.col-md-1 -->
	    	
	    	
	    	<div class="col-md-1">
	    	 	<span></span>
	    	</div>
	    	
	    	<div class="col-md-1">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-globe"></span> </span>
	    	 		<input type="text"  class="form-control input-sm" id="localidad" name="localidad" placeholder="localidad&hellip;" style="width: 100px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-md-1 -->
	    	
	    	<div class="col-md-1">
	    	 	<span></span>
	    	</div>
	    	
	    	
		    <div class="col-md-1">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-tag"></span> </span>
	    	 		<input type="text"  class="form-control input-sm" id="ordenCompra" name="ordenCompra" placeholder="orden compra&hellip;" style="width: 100px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-md-1 -->
	    	
	    	<div class="col-md-1">
	    	 	<span></span>
	    	</div>
	    	
	    	<div class="col-xs-1" >
				<div class="input-group input-group-sm" >
			    	<span class="input-group-addon" id="letraCabecera"><span class="glyphicon glyphicon-calendar"></span> </span>
	    			<input type="date" class="form-control input-sm" id="inputFecha" name="inputFecha" value="<?=date('d-m-Y')?>"  style="width: 130px;" >
	    		</div>
	    	</div><!-- /.col-xs-1 -->
	    	
	    	<div class="col-md-2">
	    	 	<span></span>
	    	</div>
	    	
	    	<div class="col-xs-1" >
				<div class="input-group input-group-sm" >
			    	<span class="input-group-addon" id="letraCabecera"><span class="glyphicon glyphicon-calendar" > entrega</span> </span>
	    			<input type="date" class="form-control input-sm" id="inputEntrega" name="inputEntrega" value="<?=date('d-m-Y')?>"  style="width: 130px;" onChange='validarFechaMayor();'>
	    		</div>
	    	</div><!-- /.col-xs-1 -->
	    	
	    	
	    	<div style="height:30px;"></div>
	    	
		</div>
	</div>

	<table width="79%" class="table table-striped table-bordered table-condensed " >
	  <thead >
    	<tr style="background-color: #b9e9ec;" class='letraDetalle'>
    		<th style="width: 10px;"></th>
        	<th style="width: 180px;">Código</th>
            <th style="width: 220px;">Producto</th>
            <th style="width: 40px;"></th>
            <th style="width: 100px;">Color</th>
            <th style="width: 30px;"></th>
            <th style="width: 90px;">Cantidad</th>                              
            <th style="width: 90px">Unidad</th>
            <th style="width: 90px">Precio Bs.</th>
            <th style="width: 80px">Importe Bs.</th>
    	</tr>
      </thead >
    <tbody >
    		
    	<?php
        //if ciclo de impresion de filas 
       		for($x=0; $x<25; $x++){
            	echo "<tr class='detalleMaterial' >";
           			
					echo"<td  class='openLightBox' title='Seleccione producto de la tabla de $titulo' style='width: 80px; background-color: #d9f9ec;' fila=$x >
					<input type='text' name='idMat_".$x."' id='idMat_".$x."'  readonly='readonly' style='width: 60px; border:none; background-color: #d9f9ec;' /></td>";
					
                    echo "<td class='letraDetalle'  style='width: 320px; background-color: #f9f9ec;' ><textarea rows='5' class='letraCentreada' id='mat_".$x."' name='mat_".$x."' readonly='readonly' style='width:300px;border:none;' /></textarea></td>";
                    
					echo "<td  style='width: 80px; background-color: #c9e9ec;' ><textarea rows='5' class='letraDetalle' name='colorMat_".$x."' id='colorMat_".$x."'  style='width: 140px;border:none;background-color: #c9e9ec;' onChange='validarIngresoColor($x);' > </textarea></td>";
								
                    echo "<td style='width: 100px; background-color: #d9f9ec;'><input type='text' class='letraNumeroNegrita' class='letraCantidad' name='cantMat_".$x."' id='cantMat_".$x."' style='width:70px; border:none; background-color: #d9f9ec;' onChange='validarCantidadIngreso(this.value,$x);'/></td>";  
					          
                    echo "<td  style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraCentreada' name='unidadMat_".$x."' id='unidadMat_".$x."' readonly='readonly' style='width:80px;border:none;'/></td>";
					
					echo "<td style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraNumeroNegrita' name='precioMat_".$x."' id='precioMat_".$x."' readonly='readonly' style='width:70px;border:none;' onChange='validarPrecio(this.value,$x);' /></td>";
					  
					echo "<td  style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraNumeroNegrita' name='importeMat_".$x."' id='importeMat_".$x."' readonly='readonly' style='width:80px;border:none;'/></td>";
					
                echo "</tr>";
				
             }
         ?>
   
      </tbody>
	</table>
	
	<div class="col-md-2">
		<div class="input-group input-group-sm">
	    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-user"></span></span>
	 		<input type="text"  class="form-control input-sm" id="facturarA" name="facturarA" placeholder="facturar a&hellip;" style="width: 180px;font-size:11px;text-align:center;" >
		</div>
	</div><!-- /.col-md-2 -->
	
	<div class="col-md-1">
	 	<span></span>
	</div>
	
	<div class="col-md-2">
		<div class="input-group input-group-sm">
	    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-user"></span></span>
	 		<input type="text"  class="form-control input-sm" id="contacto" name="contacto" placeholder="contacto&hellip;" style="width: 185px;font-size:11px;text-align:center;" >
		</div>
	</div><!-- /.col-md-2 -->
	
	<div class="col-md-1">
	 	<span></span>
	</div>
	
	<div class="col-md-1">
		<div class="input-group input-group-sm">
	    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-usd"> A/cta</span> </span>
	 		<input type="text"  class="form-control input-sm" id="aCuenta" name="aCuenta" placeholder="a cuenta Bs. &hellip;" style="width: 100px;font-size:11px;text-align:center;" onChange='validarAcuenta(this.value);'>
		</div>
	</div><!-- /.col-md-1 -->
	    	
	   	
	<div class="totalBs">
		<span class="label label-info">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Bs.:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span class="label label-info">
			<input type='text' class='letraNumero' name='detalleTotalBs' id='detalleTotalBs' size='7' readonly='readonly' style='border:none; background-color: #2ECCFA;'/>
		</span>
	</div>	
		
		
	<input type="hidden"  name="numeroFilas"  />
	<input type="hidden"  name="numPedido" value="<?= $pedido ?>" />     				<!--  numero pedido -->
	<input type="hidden"  name="local" value="<?= $local ?>" />     					<!--  local  F: fabrica  T: tienda -->
	<input type="hidden"  name="secuenciaPedido" value="<?= $secuenciaPedido ?>" />     <!--  secuenciaPedido -->
	<input type="hidden"  name="anhoSistema" value="<?= $anhoSistema ?>" />     		<!--  anhoSistema -->
	
	<div style="text-align: right; padding-top: 15px;"> 
		
		<div class="col-xs-1">
			<div class="input-group input-group-sm">
	    		<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-tag"> Nit</span> </span>
	 			<input type="text"  class="form-control input-sm" id="nit" name="nit" placeholder="nit&hellip;" style="width: 100px;font-size:11px;text-align:center;" onChange='validarNumero(this.value,"nit");'>
			</div>
		</div><!-- /.col-md-1 --> 
		
		<div class="col-xs-1">
		 	<span></span>
		</div>
		<div class="col-xs-2">
			<button type="button" class="btn btn-warning btn-sm" data-title='Nota' id="btnNota"><span class="glyphicon glyphicon-comment"></span> Nota</button>&nbsp;
		</div>
			
		<div class="col-xs-1">
			<div class="input-group input-group-sm">
		    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-minus"></span> </span>
    	 		<input type="text"  class="form-control input-sm" id="descuento" name="descuento" placeholder="% descuento&hellip;" style="width: 100px;font-size:11px;text-align:center;" onChange='validarDescuento(this.value);'>
    		</div>
    	</div><!-- /.col-md-1 --> 
		
		<div class="col-xs-1">
		 	<span></span>
		</div>
		
    	<div class="col-xs-1">
			<div class="input-group input-group-sm">
		    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-usd"> Saldo</span> </span>
    	 		<input type="text"  class="form-control input-sm" id="saldo" name="saldo" placeholder="saldo Bs. &hellip;" style="width: 100px;font-size:11px;text-align:center;" >
    		</div>
    	</div><!-- /.col-md-1 -->
		
    	<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;
        <button type="button" class="btn btn-default btn-sm"  id="btnBorrarIngreso"><span class="glyphicon glyphicon-remove"></span> Borrar</button>&nbsp;
        <button type="button" class="btn btn-inverse btn-sm" id="btnGrabarPedido" ><span class="glyphicon glyphicon-hdd"></span> Grabar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>
   <div style="height:10px;"></div>
</div>


<!-- ... inicio  lightbox ... -->
<div id="myModal"  class="modal fade" tabindex="-1" role="dialog" >
  <div class="modal-dialog"  >
  <div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h4 class="modal-title">cabecera de caja luz</h4>
	</div>
	<div class="modal-body">
		
		<table  cellspacing="0" cellpadding="0" border="0" class="display" id="tabla2">
			<thead>
				<tr class='letraDetalleLightBox'>
					<th style='width:40px;'>cod Insumo</th>
					<th style='width:450px;'>Material</th>
					<th style='width:60px;'>Existencia</th>
					<th style='width:30px;'>Unidad</th>
					<th style='width:30px;'>Precio Venta Bs.</th>
					<th style='width:30px;'>Stock M&iacute;nimo</th>
				</tr>
			</thead>
			<tbody>			
                <?php foreach($insumos as $insumo):?>
                    <tr class='letraDetalleLightBox'>
                        <td style='width:40px;'> <?= $insumo["idProd"] ?></td>
                        <td style='width:450px;'> <?= $insumo["nombreProd"]?></td>
                        <td style='width:70px;'> <?= $insumo["existencia"]?></td>
                        <td style='width:70px;'><?= $insumo["unidad"]?></td>
                        <td style='width:30px;'><?= $insumo["precioVenta"]?></td>
                        <td style='width:40px;'><?= $insumo["stockMinimo"]?></td>
                    </tr>
                <?php endforeach ?>
			</tbody>
		</table>
		
	</div>
	<div class="modal-footer">
		<button class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-off"></span> Cerrar</button>
	</div>
   </div>
  </div>
</div>
<!-- ... fin  lightbox ... -->

<!-- ... inicio  lightbox nota... -->
<div id="notaModal"  class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" >
  <div class="nota-dialog"  >
  <div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h5 class="modal-title">cabecera de caja luz</h5>
	</div>
	<div class="modal-body">
		<div class="input-group input-group-sm">
	 		<textarea rows='10'  id='nota' name='nota' placeholder="nota&hellip;" style="width:410px;font-size:11px;text-align:center;" ></textarea>
		</div>
	</div>
	
	<div class="modal-footer">
	   <button type="button" class="btn btn-default btn-sm"  id="btnBorrarNota"><span class="glyphicon glyphicon-remove"></span> Borrar</button>&nbsp;
	   <button class="btn btn-default btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-off"></span> Cerrar</button>&nbsp;&nbsp;&nbsp;
	</div>
	
   </div>
  </div>
</div>
<!-- ... fin  lightbox descripcion... -->
