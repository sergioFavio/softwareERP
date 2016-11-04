<link rel="stylesheet" type="text/css"  href="<?=base_url(); ?>css/ingresoSalidaMaterial.css" />
	
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery-ui-1.8.20.custom.min.js"></script>

<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>"> <!-- una de las librerias de bootstarp para manejar fecha-->
	
<style type="text/css" >
/*  inicio de light box  material x area */
.modalArea-dialog {width:940px;}
.modalManoObra-dialog {width:790px;}
.modalTrabajadores-dialog {width:500px;}
.modalValores-dialog {width:430px;}

.totalBsArea{font-size:16px;text-align:center; margin-left:700px; }   
.totalBsManoObra{font-size:16px;text-align:center; margin-left:550px; }

/*  inicio de scrollbar  */
thead { display:block;  margin:0px; cell-spacing:0px; left:0px; }  
tbody { display:block; overflow:auto; height:310px; }               
th { height:10px;  width:840px;}                                    
td { height:10px;  width:840px; margin:0px; cell-spacing:0px;}
/*  fin de scrollbar  */

#materialAreaModal{ padding-top:70px;padding-left:305px;}  /* ... baja la ventana modal más al centro vertical ... */
#trabajadoresModal{ padding-top:30px;padding-left:450px;}  /* ... baja la ventana modal más al centro vertical ... */
#manoObraModal{ padding-top:70px;padding-left:305px;}  /* ... baja la ventana modal más al centro vertical ... */
#valores{ padding-top:110px;padding-left:470px;}  /* ... baja la ventana modal más al centro vertical ... */

#cuerpoIngreso{margin:0 auto;  padding:0; width:840px; background:#f4f4f4;}
.cabeceraIngreso{margin:5px;}
#titulo{font-size:16px;margin-top:1px;  text-align:right;font-weight : bold}

.openMaterialArea, .openManoObra{font-size:11px;text-align:left;}
</style>


<script>
var filaActual =-100;  // fila del formulario donde se adiciona registro ..
var filaActualArea =-100;  // fila del formulario donde se adiciona registro de Material x Area..
var filaActualManoObra =-100;  // fila del formulario donde se adiciona registro de trabajador..
var totalBs=0;      // ... calcula a partir de la suma de todos los importes formulario ..ingreso de materiales			
$(document).ready(function() {
	$("form").keypress(function(e) {			//... dseactiva la tecla ENTER ...
        if (e.which == 13) {
            return false;
        }
    });
    
    $("#materialAreaModal").keypress(function(e) {			//... dseactiva la tecla ENTER ...
        if (e.which == 13) {
            return false;
        }
    });
    
    $("#manoObraModal").keypress(function(e) {			//... dseactiva la tecla ENTER ...
        if (e.which == 13) {
            return false;
        }
    });
    
    $("#valores").keypress(function(e) {			//... dseactiva la tecla ENTER ...
        if (e.which == 13) {
            return false;
        }
    });
    
	$('#btnValores').click(function(){   //... mano de obra ..
		var title = $(this).attr("data-title");
		$('.modal-title').html(title);
		borrarFormularioIngresoValores();
		calcularTotalBsEmpleado();   //... actualiza totalBs formualario mano de obra, material y material X area ...
	});
	
	$('#btnMaterialArea').click(function(){   //... materialArea ..
		var title = $(this).attr("data-title");
		$('.modal-title').html(title);
	});
	
	$('#btnManoObra').click(function(){   //... mano de obra ..
		var title = $(this).attr("data-title");
		$('.modal-title').html(title);
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
	
	$('.openMaterialArea').click(function(){
//  	var titleM = $(this).attr("titleM");
  		filaActualArea = $(this).attr("filaA");
  		var codPrefijo='#idMatArea_'; // para sleccionar Material x Area ...
  				
  		if(!filaVacia(filaActualArea,codPrefijo)){
//  		$('.modal-title').html(titleM);
	  		$('#areaModal').modal({show:true});
  		}else{
  			alert('¡¡¡ A V I S O !!! ... Seleccione la primera fila vacía.');// fila vacía ...
  		}

	});
	
	
	$('.openManoObra').click(function(){
//  	var titleM = $(this).attr("titleM");
  		filaActualManoObra = $(this).attr("filaB");
  		var codPrefijo='#idEmpleado_'; // para seleccionar empleado ...
  				
  		if(!filaVacia(filaActualManoObra,codPrefijo)){
//  		$('.modal-title').html(title);
	  		$('#trabajadoresModal').modal({show:true});
  		}else{
  			alert('¡¡¡ A V I S O !!! ... Seleccione la primera fila vacía.');// fila vacía ...
  		}

	});
	
			
		 
	$('#tabla2').dataTable();

	$('#tabla2 tbody').on('click', 'tr', function () {	
    	var codigoMaterial = $('td', this).eq(0).text();
    	var nombreMaterial = $('td', this).eq(1).text();
    	var existencia = $('td', this).eq(2).text();
    	var unidad = $('td', this).eq(3).text();
    	var precio = $('td', this).eq(5).text();
     
  		var limiteArreglo=document.getElementsByClassName("detalleMaterial").length;   // limiteArreglo a buscar codigoRepetido
		var codPrefijo='#idMat_'; // para sleccionar material
		var codigoRepetido =verificarCodigoRepetido(codigoMaterial,filaActual,limiteArreglo,codPrefijo);			
 			
// 		if(!codigoRepetido){
			$('#idMat_'+filaActual).val(codigoMaterial);
			$('#mat_'+filaActual).val(nombreMaterial);
			$('#existMat_'+filaActual).val(existencia);
			$('#unidadMat_'+filaActual).val(unidad);
			$('#precioMat_'+filaActual).val(precio);
			
			$('#cantMat_'+filaActual).val("");				//... blanquea campo...
			$('#importeMat_'+filaActual).val("");			//... blanquea campo...
			
        	$('#myModal').modal('hide'); // cierra el lightBox
//    	}else{
//    		alert("¡¡¡ Este código" +codigoMaterial +" ya fué adicionado ...!!!");
//    		$('#myModal').modal('hide'); // cierra el lightbox
//      }
        	
	} ); // fin #tabla2 tbody
	
	
	$('#tabla4').dataTable();
    
	$('#tabla4 tbody').on('click', 'tr', function () {	
    	var codigoMaterial = $('td', this).eq(0).text();
    	var nombreMaterial = $('td', this).eq(1).text();
    	var largo = $('td', this).eq(2).text();
    	var ancho = $('td', this).eq(3).text();
    	var unidad = $('td', this).eq(4).text();
    	var precioM2 = $('td', this).eq(5).text();
     
  		var limiteArregloArea=document.getElementsByClassName("detalleMaterialArea").length;   // limiteArreglo a buscar codigoRepetido
		var codPrefijo='#idMatArea_';  // para sleccionar Material x Area
		var codigoRepetido =verificarCodigoRepetido(codigoMaterial,filaActualArea,limiteArregloArea,codPrefijo);			
 			
 //		if(!codigoRepetido){
			$('#idMatArea_'+filaActualArea).val(codigoMaterial);
			$('#matArea_'+filaActualArea).val(nombreMaterial);
			$('#unidadMatArea_'+filaActualArea).val(unidad);
			$('#precioMatAreaM2_'+filaActualArea).val(precioM2);
			
			$('#largoMatArea_'+filaActualArea).val("");				//... blanquea campo...
			$('#anchoMatArea_'+filaActualArea).val("");				//... blanquea campo...
			$('#cantMatArea_'+filaActualArea).val("");				//... blanquea campo...
			$('#importeMatArea_'+filaActualArea).val("");			//... blanquea campo...
					
        	$('#areaModal').modal('hide'); // cierra el lightBox
//    	}
/*    	else{
    		alert("¡¡¡ Este código" +codigoMaterial +" ya fué adicionado ...!!!");
    		$('#areaModal').modal('hide'); // cierra el lightbox
      	}
*/
        	
	} ); // fin #tabla4 tbody
	
	
    $('#tabla6').dataTable();

	$('#tabla6 tbody').on('click', 'tr', function () {	
    	var codigoEmpleado = $('td', this).eq(0).text();
    	var nombreEmpleado = $('td', this).eq(1).text();
    	var categoria = $('td', this).eq(2).text();
    	var horaBs = $('td', this).eq(3).text();
    	
  		var limiteArregloManoObra=document.getElementsByClassName("detalleManoObra").length;   // limiteArreglo a buscar codigoRepetido
		var codPrefijo='#idEmpleado_'; // para sleccionar material
		var codigoRepetido =verificarCodigoRepetido(codigoEmpleado,filaActualManoObra,limiteArregloManoObra,codPrefijo);			
	 			
 		if(!codigoRepetido){
			$('#idEmpleado_'+filaActualManoObra).val(codigoEmpleado);
			$('#empleado_'+filaActualManoObra).val(nombreEmpleado);
			$('#categoria_'+filaActualManoObra).val(categoria);
			$('#horaBs_'+filaActualManoObra).val(horaBs);
			
			$('#cantHoras_'+filaActualManoObra).val("");				//... blanquea campo...
			$('#importeEmpleado_'+filaActualManoObra).val("");			//... blanquea campo...
					
        	$('#trabajadoresModal').modal('hide'); // cierra el lightBox
    	}else{
    		alert("¡¡¡ Este código" +codigoEmpleado +" ya fué adicionado ...!!!");
    		$('#trabajadoresModal').modal('hide'); // cierra el lightbox
      }
        	
	} ); // fin #tabla6 tbody
	

			
	$("#btnBorrarIngreso").click(function(){
        	borrarFormularioIngreso();
    });	
    
    $("#btnBorrarIngresoMatArea").click(function(){
        	borrarFormularioIngresoMatArea();
    });	
    
    $("#btnBorrarIngresoManoObra").click(function(){
        	borrarFormularioIngresoManoObra();
    });
    
    $("#btnBorrarIngresoValores").click(function(){
        	borrarFormularioIngresoValores();
    });	
    		
	$("#btnGrabarCotizacion").click(function(){
	// grabar cotizacion...
    	grabarCotizacion();
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
	var borrar= prompt('¿ Estás seguro de borrar ? [S/N]')
	if(borrar=='S'){
		var fila = document.getElementsByClassName("detalleMaterial");
		for(var i=0; i<fila.length; i++){
		    $("#idMat_"+i).val("");
	        $("#mat_"+i).val("");
			$("#existMat_"+i).val("");
			$("#cantMat_"+i).val("");
			$("#unidadMat_"+i).val("");
			$("#precioMat_"+i).val("");
			$("#importeMat_"+i).val("");
		} // fin ciclo FOR
		$("#detalleTotalBs").val("");
	}	//fin IF borrar ..
	
} // fin funcion borrarFormularioIngreso 
			

function borrarFormularioIngresoMatArea(){
	//...esta funcion borra los datos del formularioIngreso
	var borrar= prompt('¿ Estás seguro de borrar ? [S/N]')
	if(borrar=='S'){
		var fila = document.getElementsByClassName("detalleMaterialArea");
		for(var i=0; i<fila.length; i++){
		    $("#idMatArea_"+i).val("");
	        $("#matArea_"+i).val("");
			$("#largoMatArea_"+i).val("");
			$("#anchoMatArea_"+i).val("");
			$("#cantMatArea_"+i).val("");
			$("#unidadMatArea_"+i).val("");
			$("#precioMatAreaM2_"+i).val("");
			$("#importeMatArea_"+i).val("");
		} // fin ciclo FOR
		
		$("#detalleTotalBsArea").val("");
	} // fin IF borrar ..
} // fin funcion borrarFormularioIngresoMatArea 

function borrarFormularioIngresoManoObra(){
	//...esta funcion borra los datos del formularioIngreso
	var borrar= prompt('¿ Estás seguro de borrar ? [S/N]')
	if(borrar=='S'){
		var fila = document.getElementsByClassName("detalleManoObra");
		for(var i=0; i<fila.length; i++){
		    $("#idEmpleado_"+i).val("");
	        $("#empleado_"+i).val("");
			$("#categoria_"+i).val("");
			$("#horaBs_"+i).val("");
			$("#cantHoras_"+i).val("");
			$("#importeEmpleado_"+i).val("");
		} // fin ciclo FOR
		
		$("#detalleTotalBsManoObra").val("");
	} // fin IF borrar ...
} // fin funcion borrarFormularioIngresoManoObra 

function borrarFormularioIngresoValores(){
	//...esta funcion borra los datos del formularioIngresoValores
	$("#utilidad").val("");
	$("#comision").val("");
	$("#totalGral").val("");
	
} // fin funcion borrarFormularioIngresoManoObra 


function eliminarComa(numero){
	//...esta funcion elimina la coma(,) como separador de miles de una variable que esta string
	//... para convertirla en numerica ...
	var auxiliarMonto=numero;
	auxiliarMonto=auxiliarMonto.split(','); //... elimina ,
	auxiliarMonto=auxiliarMonto[0]+auxiliarMonto[1]+auxiliarMonto[2];
	auxiliarMonto=parseFloat( auxiliarMonto );	
	return auxiliarMonto;
} // ... fin funcion eliminarComa ... 
	

function grabarCotizacion(){
	
	var i=0;  //... cuenta numeroFilas  del formulario materiales ...
	var j=0;  //... cuenta numeroFilasArea  del formulario materiales  X area...
	var k=0;  //... cuenta numeroFilasManoObra  del formulario mano de obra...
	var registrosValidos= true;	  // ... bandera para grabar o no grabar registros ...
	
	if($("#inputFecha").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de FECHA está vacío, seleccione una fecha");
			registrosValidos= false;	
	}
	
	if($("#inputCliente").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de CLIENTE está vacío");
			registrosValidos= false;	
	}
	
	if($("#inputEmail").val()!="" ){
		var cadenaEmail= $('#inputEmail').val();
		if (cadenaEmail.indexOf('@')==-1 || cadenaEmail.indexOf('.')==-1) {				//... si no se encuentra la subcadena en la cadena ...
			alert("¡¡¡ E R R O R !!! ... El contenido de EMAIL no es válido");
			$("#inputEmail").val("");   // borra celda de email
			registrosValidos= false;
		}
	}

	if($("#inputTelCel").val()=="" ){
		alert("¡¡¡ E R R O R !!! ... El contenido de TELEFONO/CELULAR está vacío");
		registrosValidos= false;	
	}
	else{
		var numero= $('#inputTelCel').val();
		if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
		{
    		alert("El valor " + numero + " no es un número telefónico");
    		$("#inputTelCel").val("");   // borra celda de cantidad
    		registrosValidos= false;
    	}
	}
	
	if($("#idMat_0").val()=="" ){        //... registro primer formulario... materiales
			alert("¡¡¡ E R R O R !!! ... No se ha ingresado ningún registro de materiales");
			registrosValidos= false;	
	}
	
	if($("#idMatArea_0").val()=="" ){        //... registro segundo formulario... materiales X area 
			alert("¡¡¡ E R R O R !!! ... No se ha ingresado ningún registro de materiales X area");
			registrosValidos= false;	
	}
	
	if($("#idEmpleado_0").val()=="" ){        //... registro segundo formulario... materiales X area 
			alert("¡¡¡ E R R O R !!! ... No se ha ingresado ningún registro de mano de obra");
			registrosValidos= false;	
	}
	
			
	// ... valida que los registros no tengan cantidad vacia formulario materiales  ...
	while($("#idMat_"+i).val()!= ""){
		if($("#cantMat_"+i).val()==""){
			alert("¡¡¡ E R R O R !!! ... El valor de CANTIDAD está vacío");
			registrosValidos= false;	
		}
		
		i++;
	} // ... fin while ...
	
	
	// ... valida que los registros no tengan cantidad vacia formulario materiales X area ...
	while($("#idMatArea_"+j).val()!= ""){
		if($("#cantMatArea_"+j).val()==""){
			alert("¡¡¡ E R R O R !!! ... El valor de CANTIDAD formulario materiales X area, está vacío");
			registrosValidos= false;	
		}
		
		j++;
	} // ... fin while ...
	
	
	while($("#idEmpleado_"+k).val()!= ""){
		if($("#cantHoras_"+k).val()==""){
			alert("¡¡¡ E R R O R !!! ... El valor de CANTIDAD DE HORAS formulario mano de obra, está vacío");
			registrosValidos= false;	
		}
		
		k++;
	} // ... fin while ...
	
	
	
	if($("#utilidad").val()=="" ){        //... tercer formulario... manoObra
			alert("¡¡¡ E R R O R !!! ... El valor de UTILIDAD formulario mano de obra, está vacío");
			registrosValidos= false;	
	}
	
	
	if($("#comision").val()=="" ){        //... tercer formulario... manoObra
			alert("¡¡¡ E R R O R !!! ... El valor de COMISIONES formulario mano de obra, está vacío");
			registrosValidos= false;	
	}
	
	document.form_.numeroFilas.value=i;  // ... numeroFilasValidas  variable hidden formulario materiales...
	
	document.form_.numeroFilasArea.value=j;  // ... numeroFilasValidasArea  variable hidden formulario materiales X area ...
	
	document.form_.numeroFilasManoObra.value=k;  // ... numeroFilasValidasManoObra  variable hidden formulario mano de obra ...
		
	if(!registrosValidos){
		alert('Corrija los campos que están vacíos');
	}else{
		var numAux=$("#totalManoObraDirecta").val();
		$("#totalManoObraDirecta").val( eliminarComa(numAux) );   //... actualiza manoObraDirecta ...

		var numAux=$("#totalManoObraIndirecta").val();
		$("#totalManoObraIndirecta").val( eliminarComa(numAux) );   //... actualiza manoObraIndirecta ...

		var numAux=$("#totalManoObra").val();	
		$("#totalManoObra").val( eliminarComa(numAux) );   //... actualiza totalManoObra ...
	
		var numAux=$("#totalMateriales").val();
		$("#totalMateriales").val( eliminarComa(numAux) );   //... actualiza totalMateriales ...
		
		var numAux=$("#subTotalGral").val();
		$("#subTotalGral").val( eliminarComa(numAux) );   //... actualiza subTotalGral ...
		
		var numAux=$("#totalGral").val();	
		$("#totalGral").val( eliminarComa(numAux) );   //... actualiza totalGral ...
		
		$("#form_").submit(); // ...  graba registros ...
	}
			
}	// ... fin funcion grabarCotizacion() ...
	
		
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


function validarCantidadIngresoManoObra(numero, filaExistencia){
   
	if($("#idEmpleado_"+filaExistencia).val()==""){
		alert("¡¡¡ ERROR !!! Primero seleccione un registro en empleados para ingresar cantidad.");
		$("#cantHoras_"+filaExistencia).val("");   // borra celda de cantidad
					
	}else{
			
		var cantidad=parseFloat( numero ); // convierte de string to number 
    	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
    	if (!/^\d{1,7}(\.\d{1,2})?$/.test(numero)){  // ...hasta 5 digitos parte entera y hasta 2 parte decimal ...
    		alert("El valor " + numero + " no es válido");
    		$("#cantHoras_"+filaExistencia).val("");   // borra celda de cantidad
    	}else{
    		var cantidad=$("#cantHoras_"+filaExistencia).val();
    		var horaBs=$("#horaBs_"+filaExistencia).val();
    		$("#importeEmpleado_"+filaExistencia).val( separadorMiles( (cantidad*horaBs).toFixed(2) ) );   //... actualiza importe
    		calcularTotalBsEmpleado();   //... actualiza totalBs formualrio mano de obra ...
    	}
	    		
	}
}   // fin ... validarCantidadIngresoManoObra ...


function validarPrecioMaterial(numero, filaExistencia){
   
	if($("#idMat_"+filaExistencia).val()==""){
		alert("¡¡¡ ERROR !!! Primero seleccione un registro para ingresar precio.");
		$("#precioMat_"+filaExistencia).val("");   // borra celda de cantidad
					
	}else{
    	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
    	if (!/^\d{1,7}(\.\d{1,2})?$/.test(numero)){  // ...hasta 5 digitos parte entera y hasta 2 parte decimal ...
    		alert("El valor " + numero + " no es válido");
    		$("#precioMat_"+filaExistencia).val("");   // borra celda de cantidad
    	}else{
    		var cantidad=$("#cantMat_"+filaExistencia).val();
    		var precioCompra=$("#precioMat_"+filaExistencia).val();
  
			precioCompra=eliminarComa(precioCompra);   //... elimina ,
	    	$("#precioMat_"+filaExistencia).val( separadorMiles( (precioCompra).toFixed(2) ) );	
	    		
    		$("#importeMat_"+filaExistencia).val( separadorMiles( (cantidad*precioCompra).toFixed(2) ) );   //... actualiza importe
    		calcularTotalBs('_');   //... actualiza totalBs formualrio ingreso materiales
    	}
	    		
	}
}   // fin ... validarPrecioMaterial ...



function validarPrecioMaterialM2(numero, filaExistencia){
   
	if($("#idMatArea_"+filaExistencia).val()==""){
		alert("¡¡¡ ERROR !!! Primero seleccione un registro para ingresar precio.");
		$("#precioMatAreaM2_"+filaExistencia).val("");   // borra celda de cantidad
					
	}else{
    	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
    	if (!/^\d{1,7}(\.\d{1,2})?$/.test(numero)){  // ...hasta 5 digitos parte entera y hasta 2 parte decimal ...
    		alert("El valor " + numero + " no es válido");
    		$("#precioMatAreaM2_"+filaExistencia).val("");   // borra celda de precioM2 ...
    		$("#importeMatArea_"+filaExistencia).val("");   // borra celda de importe ...
    	}else{
    		var cantidad=$("#cantMatArea_"+filaExistencia).val();
    		var largo=$("#largoMatArea_"+filaExistencia).val();
    		var ancho=$("#anchoMatArea_"+filaExistencia).val();
    		var precioM2=$("#precioMatAreaM2_"+filaExistencia).val();
    		$("#importeMatArea_"+filaExistencia).val( separadorMiles( (cantidad*precioM2*largo*ancho).toFixed(2) ) );   //... actualiza importe
    		calcularTotalBs('Area_');   //... actualiza totalBs formualrio ingreso materiales
    	}
	    		
	}
}   // fin ... validarPrecioMaterialM2 ...


function validarCantidadIngresoArea(numero, filaExistencia){
   
	if($("#idMatArea_"+filaExistencia).val()==""){
		alert("¡¡¡ ERROR !!! Primero seleccione un registro para ingresar cantidad.");
		$("#cantMatArea_"+filaExistencia).val("");   // borra celda de cantidad
					
	}else{
			
		var cantidad=parseFloat( numero ); // convierte de string to number 
    	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
    	if (!/^\d{1,7}(\.\d{1,2})?$/.test(numero)){  // ...hasta 5 digitos parte entera y hasta 2 parte decimal ...
    		alert("El valor " + numero + " no es válido");
    		$("#cantMatArea_"+filaExistencia).val("");   // borra celda de cantidad
    	}else{
    		var cantidad=$("#cantMatArea_"+filaExistencia).val();
    		var largo=$("#largoMatArea_"+filaExistencia).val();
    		var ancho=$("#anchoMatArea_"+filaExistencia).val();
    		var precioM2=$("#precioMatAreaM2_"+filaExistencia).val();
    		$("#importeMatArea_"+filaExistencia).val( separadorMiles( (cantidad*precioM2*largo*ancho).toFixed(2) ) );   //... actualiza importe
    		calcularTotalBs('Area_');   //... actualiza totalBs formualrio ingreso materiales
    	}
	    		
	}
}   // fin ... validarCantidadIngresoArea ...


function validarMedida(numero, filaExistencia){
   
	if($("#idMatArea_"+filaExistencia).val()==""){
		alert("¡¡¡ ERROR !!! Primero seleccione un registro para ingresar medidas.");
		$("#largoMatArea_"+filaExistencia).val("");   // borra celda de largo
		$("#anchoMatArea_"+filaExistencia).val("");   // borra celda de ancho			
	}else{
			
		var cantidad=parseFloat( numero ); // convierte de string to number 
    	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
    	if (!/^\d{1,2}(\.\d{1,2})?$/.test(numero)){  // ...hasta 2 digitos parte entera y hasta 2 parte decimal ...
    		alert("El valor " + numero + " no es válido");
    		$("#largoMatArea_"+filaExistencia).val("");   // borra celda de largo
    		$("#anchoMatArea_"+filaExistencia).val("");   // borra celda de ancho
    	}else{
    		var cantidad=$("#cantMatArea_"+filaExistencia).val();
    		var largo=$("#largoMatArea_"+filaExistencia).val();
    		var ancho=$("#anchoMatArea_"+filaExistencia).val();
    		var precioM2=$("#precioMatAreaM2_"+filaExistencia).val();
    		$("#importeMatArea_"+filaExistencia).val( separadorMiles( (cantidad*precioM2*largo*ancho).toFixed(2) ) );   //... actualiza importe
    		calcularTotalBs('Area_');   //... actualiza totalBs formualrio ingreso materiales
    	}
	    		
	}
}   // fin ... validarMedida ...


function calcularTotalBs(sufijo){
	//...suma los importes del formularioIngreso
	var i=0;
	totalBs=0;
	totalBs=parseFloat(totalBs);
		
	while($("#idMat"+sufijo+i).val()!= ""){
		var importe=$("#importeMat"+sufijo+i).val();
		
		importe=eliminarComa(importe);   //... elimina ,

		totalBs= totalBs +  importe ;
		i++;
	} // fin ciclo WHILE
	
	totalBs=separadorMiles(totalBs.toFixed(2) ); 
	
	if(sufijo=='_'){
		document.form_.detalleTotalBs.value=totalBs;  // ... totalBs  variable formulario materiales ...
	}
	else{
		document.form_.detalleTotalBsArea.value=totalBs;  // ... totalBs  variable formulario Materiales x Area ...
	}
	
} // fin funcion ... calcularTotalBs 


function calcularTotalBsEmpleado(){
	//...suma los importes del formulario ManoObra
	var i=0;
	totalBs=0;
	totalBs=parseFloat(totalBs);
		
	while($("#idEmpleado_"+i).val()!= ""){
		var importe=$("#importeEmpleado_"+i).val();
		
		importe=eliminarComa(importe);   //... elimina ,

		totalBs= totalBs +  importe ;
		i++;
	} // fin ciclo WHILE
	
	var totManoObra=parseFloat(totalBs);
	
	totalBs=separadorMiles(totalBs.toFixed(2) ); 
	
	document.form_.detalleTotalBsManoObra.value=totalBs;  // ... totalBs  variable formulario materiales ...
	
	$("#totalManoObraDirecta").val( separadorMiles( (totManoObra*1.30).toFixed(2) ) );   //... actualiza total mano obra directa
	$("#totalManoObraIndirecta").val( separadorMiles( (totManoObra*0.575).toFixed(2) ) );   //... actualiza total mano obra indirecta
	$("#totalManoObra").val( separadorMiles( (totManoObra*1.875).toFixed(2) ) );   //... actualiza total mano obra
	
	var totMaterial=$("#detalleTotalBs").val();
	
	totMaterial=eliminarComa(totMaterial);   //... elimina ,
	
	var totMaterialArea=$("#detalleTotalBsArea").val();

	totMaterialArea=eliminarComa(totMaterialArea);   //... elimina ,
	
	
	$("#totalMateriales").val( separadorMiles( (totMaterial+totMaterialArea).toFixed(2) ) );   //... actualiza total materiales
  
  	var totManoObra=$("#totalManoObra").val();
	
	totManoObra=eliminarComa(totManoObra);   //... elimina ,
	
	
	var totMateriales=$("#totalMateriales").val();
	
	totMateriales=eliminarComa(totMateriales);   //... elimina ,
	
	$("#subTotalGral").val( separadorMiles( ((totManoObra + totMateriales) ).toFixed(2) ) );   //... actualiza sub total gral

} // fin funcion ... calcularTotalBsEmpleado ... 

		
function separadorMiles(n){
    var rx=  /(\d+)(\d{3})/;
    return String(n).replace(/^\d+/, function(w){
        while(rx.test(w)){
            w= w.replace(rx, '$1,$2');
        }
        
        return w;
    });
}

function validarComision(numero,sufijoManoObra){
   		
	var cantidad=parseFloat( numero ); // convierte de string to number 
	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
	if (!/^\d{1,2}(\.\d{1,2})?$/.test(numero) || $("#comision").val()>15   ){  // ...hasta 2 digitos parte entera y hasta 2 parte decimal ...
		alert("El valor " + numero + " no es válido");
		$("#"+sufijoManoObra).val("");   // borra celda de comision
		$("#totalGral").val("");   // borra celda de totalGral
	}else{
		
  		var subTotGral=$("#subTotalGral").val();
  		
		subTotGral=eliminarComa(subTotGral);  //... elimina ,
		
		var comision=parseFloat($("#comision").val() );
		comision=comision/100;
		
		var utilidad=parseFloat($("#utilidad").val() );
		utilidad=utilidad/100;
		
		var impuestos=0.18;        //... impuestos 18% ...
		
		$("#totalGral").val( separadorMiles( (subTotGral* ( 1.00 + comision+ utilidad+ impuestos) ).toFixed(2) ) );   //... actualiza total gral
    		
	}
}   // fin ... validarComision ...

		
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
	
   <form class="form-horizontal" method="post" action="<?=base_url()?>produccion/grabarCotizacion" id="form_" name="form_" >
   	<div style="height:7px;"></div>
	 
	<div class="cabeceraIngreso">
		<div class="row-fluid">
			
	    	<div class="col-xs-1">
	    	 	<span id="titulo" class="label label-default">Cotización No.: <?= $ingreso ?></span>
	    	</div> 
	    	
			<div class="col-xs-2">
			 	<span></span>
			</div>	    	
	    	
	    	<div class="col-xs-2" >
				<div class="input-group input-group-sm" >
			    	<span class="input-group-addon" id="letraCabecera"><span class="glyphicon glyphicon-calendar"></span> </span>
	    			<input type="date" class="form-control input-sm" id="inputFecha" name="inputFecha" value="<?=date('d-m-Y')?>"  style="width: 135px;" >
	    		</div>
	    	</div><!-- /.col-xs-2 -->
	    	
	    	
	    	<div class="col-xs-1">
	    	 	<span></span>
	    	</div>
	  	
	    	<div class="col-xs-2"> 
				<button type="button" id="btnMaterialArea" class="btn btn-primary btn-sm" data-title='Materiales por Area/m2' data-toggle='modal' data-target='#materialAreaModal'><span class="glyphicon glyphicon-list"></span> Material x Area</button>
			</div>
			
			<div class="col-xs-2"> 
				<button type="button" id="btnManoObra" class="btn btn-primary btn-sm" data-title='Mano de Obra' data-toggle='modal' data-target='#manoObraModal'><span class="glyphicon glyphicon-list"></span> Mano de Obra</button>
			</div>			
			
			<div class="col-xs-2"> 
				<button type="button" id="btnValores" class="btn btn-primary btn-sm" data-title='Valores' data-toggle='modal' data-target='#valores'><span class="glyphicon glyphicon-list"></span> Valores</button>
			</div>
	    	
		</div>
		
		<div style="height:35px;"></div>
		
		<div class="row-fluid"> <!-- segunda fila de la cabecera -->
			
		    <div class="col-md-2">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-user"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="inputCliente" name="inputCliente" placeholder="cliente&hellip;" style="width: 220px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-md-2 -->
	    	
	    	
	    	<div class="col-md-2">
	    	 	<span></span>
	    	</div>
	    	
	    	<div class="col-md-2">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-envelope"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="inputEmail" name="inputEmail" placeholder="email&hellip;" style="width: 220px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-md-2 -->
	    	
	    	<div class="col-md-2">
	    	 	<span></span>
	    	</div>
	    	
	    	
		    <div class="col-md-2">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-earphone"></span> </span>
	    	 		<input type="text"  class="form-control input-sm" id="inputTelCel" name="inputTelCel" placeholder="telf./cel.&hellip;" style="width: 100px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-md-2 -->
	    	
	    	<div class="col-xs-2"> 
				<button type="button" id="btnImagen" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-picture"></span> Imagen</button>
			</div>
	    	
	    	<div style="height:30px;"></div>
	    	
		</div>
	</div>

	<table width="79%" class="table table-striped table-bordered table-condensed " >
	  <thead >
    	<tr style="background-color: #b9e9ec;" class='letraDetalle'>
        	<th style="width: 180px;">Código</th>
            <th style="width: 220px;">Material</th>
            <th style="width: 80px;">Existencia</th>
            <th style="width: 90px;">Cantidad</th>                              
            <th style="width: 90px">Unidad</th>
            <th style="width: 80px">Precio Bs.</th>
            <th style="width: 80px">Importe Bs.</th>
    	</tr>
      </thead >
    <tbody >
    		
    	<?php
        //if ciclo de impresion de filas 
       		for($x=0; $x<25; $x++){
            	echo "<tr class='detalleMaterial' >";
           			
					echo"<td  class='openLightBox' title='Seleccionar material de la tabla de $titulo' style='width: 80px; background-color: #d9f9ec;' fila=$x >
					<input type='text' name='idMat_".$x."' id='idMat_".$x."'  readonly='readonly' style='width: 60px; border:none; background-color: #d9f9ec;' /></td>";
					
                    echo "<td class='letraDetalle'  style='width: 320px; background-color: #f9f9ec;' ><input type='text' class='letraCentreada' id='mat_".$x."' name='mat_".$x."' size='50' readonly='readonly' style='border:none;' /></td>";
                    
                    echo "<td  style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraNumero' name='existMat_".$x."' id='existMat_".$x."' size='7' readonly='readonly' style='border:none;' /></td>";
					
                    echo "<td style='width: 100px; background-color: #d9f9ec;'><input type='text' class='letraNumeroNegrita' class='letraCantidad' name='cantMat_".$x."' id='cantMat_".$x."' style='width: 80px; border:none; background-color: #d9f9ec;' onChange='validarCantidadIngreso(this.value,$x);'/></td>";  
					          
                    echo "<td  style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraCentreada' name='unidadMat_".$x."' id='unidadMat_".$x."' size='7' readonly='readonly' style='border:none;'/></td>";
					
					echo "<td style='width: 80px; background-color: #d9f9ec;' ><input type='text' class='letraNumeroNegrita' name='precioMat_".$x."' id='precioMat_".$x."' size='7' style='border:none; background-color: #d9f9ec;' onChange='validarPrecioMaterial(this.value,$x);' /></td>";
					  
					echo "<td  style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraNumeroNegrita' name='importeMat_".$x."' id='importeMat_".$x."' size='7' readonly='readonly' style='border:none;'/></td>";
					
                echo "</tr>";
				
             }
         ?>
   
      </tbody>
	</table>
	
	
	<div class="totalBs">
		<span class="label label-info">Total Bs.:</span>&nbsp;&nbsp;
		<span class="label label-info">
			<input type='text' class='letraNumero' name='detalleTotalBs' id='detalleTotalBs' size='7' readonly='readonly' style='border:none; background-color: #2ECCFA;'/>
		</span>
	</div>	
		
		
	<input type="hidden"  name="numeroFilas"  />
	<input type="hidden"  name="numeroCotizacion" value="<?= $ingreso ?>"/>
	
	<div style="text-align: right; padding-top: 5px;">  
    	<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;
        <button type="button" class="btn btn-default btn-sm"  id="btnBorrarIngreso"><span class="glyphicon glyphicon-remove"></span> Borrar</button>&nbsp;
        <button type="button" class="btn btn-inverse btn-sm" id="btnGrabarCotizacion" ><span class="glyphicon glyphicon-hdd"></span> Grabar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>
   <div style="height:10px;"></div>
</div>


<!-- ... inicio  lightbox  material x areas ... -->

<div class="modal fade" id="materialAreaModal" >
  <div class="modalArea-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"> Cerrar</span></button>
        <h4 class="modal-title">Material X Area</h4>
      </div>
      <div class="modal-body">
      	
      	
      	 <table width="79%" class="table table-striped table-bordered table-condensed " >
	  <thead >
    	<tr style="background-color: #b9e9ec;" class='letraDetalle'>
        	<th style="width: 180px;">Código</th>
            <th style="width: 220px;">Material x Area</th>
            <th style="width: 80px;">Largo m.</th>
            <th style="width: 80px;">Ancho m.</th>
            <th style="width: 90px;">Cantidad</th>                              
            <th style="width: 90px">Unidad</th>
            <th style="width: 80px">m2 Bs.</th>
            <th style="width: 80px">Importe Bs.</th>
    	</tr>
      </thead >
    <tbody >
    		
    	<?php
        //if ciclo de impresion de filas 
       		for($y=0; $y<25; $y++){
            	echo "<tr class='detalleMaterialArea' >";
           
					echo"<td  class='openMaterialArea' titleM='Seleccionar material de la tabla de Material x Area' style='width: 80px; background-color: #d9f9ec;' filaA=$y >
					<input type='text' name='idMatArea_".$y."' id='idMatArea_".$y."'  readonly='readonly' style='width: 55px; border:none; background-color: #d9f9ec;' /></td>";
					
                    echo "<td class='letraDetalle'  style='width: 320px; background-color: #f9f9ec;' ><input type='text' class='letraCentreada' id='matArea_".$y."' name='matArea_".$y."' size='50' readonly='readonly' style='border:none;' /></td>";
                    
                    echo "<td  style='width: 80px; background-color: #d9f9ec;' ><input type='text' class='letraNumero' name='largoMatArea_".$y."' id='largoMatArea_".$y."' style='width: 60px; border:none; background-color: #d9f9ec;' onChange='validarMedida(this.value,$y);' /></td>";
					
					echo "<td  style='width: 80px; background-color: #d9f9ec;' ><input type='text' class='letraNumero' name='anchoMatArea_".$y."' id='anchoMatArea_".$y."' style='width: 60px; border:none; background-color: #d9f9ec;' onChange='validarMedida(this.value,$y);' /></td>";
					
                    echo "<td style='width: 100px; background-color: #d9f9ec;'><input type='text' class='letraNumeroNegrita' class='letraCantidad' name='cantMatArea_".$y."' id='cantMatArea_".$y."' style='width: 80px; border:none; background-color: #d9f9ec;' onChange='validarCantidadIngresoArea(this.value,$y);'/></td>";  
					          
                    echo "<td  style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraCentreada' name='unidadMatArea_".$y."' id='unidadMatArea_".$y."' size='7' readonly='readonly' style='border:none;'/></td>";
					
					echo "<td style='width: 80px; background-color: #d9f9ec;' ><input type='text' class='letraNumeroNegrita' name='precioMatAreaM2_".$y."' id='precioMatAreaM2_".$y."' size='7' style='border:none;background-color: #d9f9ec;'  onChange='validarPrecioMaterialM2(this.value,$y);'  /></td>";
					  
					echo "<td  style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraNumeroNegrita' name='importeMatArea_".$y."' id='importeMatArea_".$y."' size='7' readonly='readonly' style='border:none;'/></td>";
					
                echo "</tr>";
				
             }
         ?>
   
      </tbody>
	</table>
	
	
	<div class="totalBsArea">
		<span class="label label-info">Total Bs.:</span>&nbsp;&nbsp;
		<span class="label label-info">
			<input type='text' class='letraNumero' name='detalleTotalBsArea' id='detalleTotalBsArea' size='7' readonly='readonly' style='border:none; background-color: #2ECCFA;'/>
		</span>
	</div>	
		
	<input type="hidden"  name="numeroFilasArea"  />
	
    <!--/form-->
  		        
	  </div>
	  <div class="modal-footer">
	   <button type="button" class="btn btn-default btn-sm"  id="btnBorrarIngresoMatArea"><span class="glyphicon glyphicon-remove"></span> Borrar</button>&nbsp;
	   <button class="btn btn-default btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-off"></span> Cerrar</button>&nbsp;&nbsp;&nbsp;
	  </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- ... fin  lightbox  material x areas ... -->

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
					<th style='width:30px;'>Tipo Insumo</th>
					<th style='width:30px;'>Precio Unidad Bs.</th>
				</tr>
			</thead>
			<tbody>			
                <?php foreach($insumos as $insumo):?>
                    <tr class='letraDetalleLightBox'>
                        <td style='width:40px;'> <?= $insumo["codInsumo"] ?></td>
                        <td style='width:450px;'> <?= $insumo["nombreInsumo"]?></td>
                        <td style='width:70px;'> <?= $insumo["existencia"]?></td>
                        <td style='width:70px;'><?= $insumo["unidad"]?></td>
                        <td style='width:30px;'><?= $insumo["tipoInsumo"]?></td>
                        <td style='width:40px;'><?= $insumo["precioUnidad"]?></td>
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


<!-- ... inicio  lightbox tabla material area... -->

<div id="areaModal"  class="modal fade" tabindex="-1" role="dialog" >
  <div class="modal-dialog"  >
  <div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h4 class="modal-titleM">Seleccionar material de la tabla de Material x Area</h4>
	</div>
	<div class="modal-body">
		
		<table  cellspacing="0" cellpadding="0" border="0" class="display" id="tabla4">
			<thead>
				<tr class='letraDetalleLightBox'>
					<th style='width:40px;'>C&oacute;digo</th>
					<th style='width:450px;'>Material</th>
					<th style='width:60px;'>Largo m.</th>
					<th style='width:30px;'>Ancho m.</th>
					<th style='width:30px;'>Unidad</th>
					<th style='width:30px;'>m2 Bs.</th>
					<th style='width:30px;'>Unidad Bs.</th>
				</tr>
			</thead>
			<tbody>			
                <?php foreach($materialesArea as $materialA):?>
                    <tr class='letraDetalleLightBox'>
                        <td style='width:40px;'> <?= $materialA["codMaterial"] ?></td>
                        <td style='width:450px;'> <?= $materialA["nombreMaterial"]?></td>
                        <td style='width:70px;'> <?= $materialA["largo"]?></td>
                        <td style='width:70px;'><?= $materialA["ancho"]?></td>
                        <td style='width:30px;'><?= $materialA["unidadMaterial"]?></td>
                        <td style='width:40px;'><?= $materialA["precioMetro2"]?></td>
                        <td style='width:40px;'><?= $materialA["precioUnidad"]?></td>
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
<!-- ... fin  lightbox tabla material area... -->


<!-- ... inicio  lightbox manoObra... -->
<div class="modal fade" id="manoObraModal" >
  <div class="modalManoObra-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"> Cerrar</span></button>
        <h4 class="modal-title">Mano de Obra</h4>
      </div>
      <div class="modal-body">
      	
      	
      	 <table width="79%" class="table table-striped table-bordered table-condensed " >
	  <thead >
    	<tr style="background-color: #b9e9ec;" class='letraDetalle'>
        	<th style="width: 180px;">Código</th>
            <th style="width: 220px;">Trabajador</th>
            <th style="width: 80px;">Categoría</th>
            <th style="width: 80px;">Hora Bs.</th>
            <th style="width: 90px;">Cantidad</th>                              
            <th style="width: 95px">Importe Bs.</th>
    	</tr>
      </thead >
    <tbody >
    		
    	<?php
        //if ciclo de impresion de filas 
       		for($z=0; $z<25; $z++){
            	echo "<tr class='detalleManoObra' >";
           
					echo"<td  class='openManoObra' titleO='Seleccionar trabajador de la tabla de Mano de Obra' style='width: 80px; background-color: #d9f9ec;' filaB=$z >
					<input type='text' name='idEmpleado_".$z."' id='idEmpleado_".$z."'  readonly='readonly' style='width: 55px; border:none; background-color: #d9f9ec;' /></td>";
					
                    echo "<td class='letraDetalle'  style='width: 320px; background-color: #f9f9ec;' ><input type='text' class='letraCentreada' id='empleado_".$z."' name='empleado_".$z."' size='50' readonly='readonly' style='border:none;' /></td>";
                    
                    echo "<td  style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraNumero' name='categoria_".$z."' id='categoria_".$z."' readonly='readonly' style='width: 60px; border:none;'  /></td>";
					
					echo "<td  style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraNumero' name='horaBs_".$z."' id='horaBs_".$z."' readonly='readonly' style='width: 60px; border:none;'  /></td>";
					
                    echo "<td style='width: 90px; background-color: #d9f9ec;'><input type='text' class='letraNumeroNegrita' class='letraCantidad' name='cantHoras_".$z."' id='cantHoras_".$z."' style='width: 80px; border:none; background-color: #d9f9ec;' onChange='validarCantidadIngresoManoObra(this.value,$z);'/></td>";  
					          				  
					echo "<td  style='width: 90px; background-color: #f9f9ec;' ><input type='text' class='letraNumeroNegrita' name='importeEmpleado_".$z."' id='importeEmpleado_".$z."' readonly='readonly' style='width: 80px;border:none;'/></td>";
					
                echo "</tr>";
				
             }
         ?>
   
      </tbody>
	</table>
	
	
	<div class="totalBsManoObra">
		<span class="label label-info">Total Bs.:</span>&nbsp;&nbsp;
		<span class="label label-info">
			<input type='text' class='letraNumero' name='detalleTotalBsManoObra' id='detalleTotalBsManoObra' size='7' readonly='readonly' style='border:none; background-color: #2ECCFA;'/>
		</span>
	</div>	
		
	<input type="hidden"  name="numeroFilasManoObra"  />
	
    <!--/form-->
  		        
	  </div>
	  <div class="modal-footer">
	   <button type="button" class="btn btn-default btn-sm"  id="btnBorrarIngresoManoObra"><span class="glyphicon glyphicon-remove"></span> Borrar</button>&nbsp;
	   <button class="btn btn-default btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-off"></span> Cerrar</button>&nbsp;&nbsp;&nbsp;
	  </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- ... fin  lightbox manoObra... -->


<!-- ... inicio  lightbox tabla prodmanoobra: trabajadores ... -->

<div id="trabajadoresModal"  class="modal fade" tabindex="-1" role="dialog" >
  <div class="modalTrabajadores-dialog">
  <div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h4 class="modal-titleO">Seleccionar empleado de la tabla de Mano de Obra</h4>
	</div>
	<div class="modal-body">
		
		<table  cellspacing="0" cellpadding="0" border="0" class="display" id="tabla6">
			<thead>
				<tr class='letraDetalleLightBox'>
					<th style='width:40px;'>cod Empleado</th>
					<th style='width:450px;'>Empleado</th>
					<th style='width:60px;'>Categoría</th>
					<th style='width:30px;'>Hora Bs</th>
				</tr>
			</thead>
			<tbody>			
                <?php foreach($trabajadores as $trabajador):?>
                    <tr class='letraDetalleLightBox'>
                        <td style='width:40px;'> <?= $trabajador["idEmpleado"] ?></td>
                        <td style='width:450px;'> <?= $trabajador["empleado"]?></td>
                        <td style='width:70px;'> <?= $trabajador["categoria"]?></td>
                        <td style='width:70px;'><?= $trabajador["horaBs"]?></td>
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
<!-- ... fin  lightbox tabla prodmanoobra: trabajadores... -->


<!-- ... inicio  lightbox  valores ... -->
<div class="modal fade" id="valores" >
  <div class="modalValores-dialog">
    <div class="modal-content">
      <div class="modal-header" >
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"> Cerrar</span></button>
        <h4 class="modal-title"><center>Valores</center></h4>
      </div>
      <div class="modal-body">
      	<div class="row-fluid"> <!-- primera fila de la cabecera -->
	      	<div class="col-md-2">
		    	<span id="titulo" class="label label-success">Mano de obra directa </span>
		    </div>
		    
		    <div class="col-md-8">
		    	<span> </span>
		    </div>
      	</div>   <!-- fin primera fila de la cabecera -->
      	
		<div class="row-fluid"> <!-- cuarta fila de la cabecera -->
			<div class="col-md-4">
		    	<span> </span>
		    </div>
		    
		    <div class="col-md-2">
		      	<div class="input-group input-group-sm">
				    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-usd"></span></span>
		    	 		<input type="text"  class="form-control input-sm" id="totalManoObraDirecta" name="totalManoObraDirecta" readonly='readonly' placeholder="Total Bs.&hellip;" style="width: 100px;font-size:11px;text-align:center;" >
		    	</div>
	    	</div>
		    
      	</div>   <!-- fin cuarta fila de la cabecera -->
      	
      	<div style="height:40px;"></div>
      	
      	<div class="row-fluid"> <!-- quinta fila de la cabecera -->
	      	<div class="col-md-2">
		    	<span id="titulo" class="label label-success">Mano de obra indirecta </span>
		    </div>
		    
      	</div>   <!-- fin quinta fila de la cabecera -->
      	
      	<div class="row-fluid"> <!-- sexta fila de la cabecera -->
			<div class="col-md-4">
		    	<span> </span>
		    </div>
		    
		    <div class="col-md-2">
		      	<div class="input-group input-group-sm">
				    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-usd"></span></span>
		    	 		<input type="text"  class="form-control input-sm" id="totalManoObraIndirecta" name="totalManoObraIndirecta" readonly='readonly' placeholder="Total Bs.&hellip;" style="width: 100px;font-size:11px;text-align:center;" >
		    	</div>
	    	</div>
		    
      	</div>   <!-- fin sexta fila de la cabecera -->
      	
      	<div style="height:40px;"></div>
      	
      	<div class="row-fluid"> <!-- septima fila de la cabecera -->
	      	<div class="col-md-2">
		    	<span id="titulo" class="label label-default">Total mano de obra </span>
		    </div>
		    
      	</div>   <!-- fin septima fila de la cabecera -->
      	
      	<div class="row-fluid"> <!-- octava fila de la cabecera -->
			<div class="col-md-5">
		    	<span> </span>
		    </div>
		    
		    <div class="col-md-2">
		      	<div class="input-group input-group-sm">
				    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-usd"></span></span>
		    	 		<input type="text"  class="form-control input-sm" id="totalManoObra" name="totalManoObra" readonly='readonly' placeholder="Total Bs.&hellip;" style="width: 100px;font-size:11px;text-align:center;" >
		    	</div>
	    	</div>
		    
      	</div>   <!-- fin octava fila de la cabecera -->
      	
      	<div style="height:40px;"></div>
      
      	<div class="row-fluid"> <!-- novena fila de la cabecera -->
	      	<div class="col-md-2">
		    	<span id="titulo" class="label label-default">Total materiales </span>
		    </div>
		    
      	</div>   <!-- fin novena fila de la cabecera -->
      	
      	<div class="row-fluid"> <!-- decima fila de la cabecera -->
			<div class="col-md-5">
		    	<span> </span>
		    </div>
		    
		    <div class="col-md-2">
		      	<div class="input-group input-group-sm">
				    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-usd"></span></span>
		    	 		<input type="text"  class="form-control input-sm" id="totalMateriales" name="totalMateriales" readonly='readonly' placeholder="Total Bs.&hellip;" style="width: 100px;font-size:11px;text-align:center;" >
		    	</div>
	    	</div>
		    
      	</div>   <!-- fin decima fila de la cabecera -->
      	
      	<div style="height:40px;"></div>
      	
      	<div class="row-fluid"> <!-- decima primera fila de la cabecera -->
	      	<div class="col-md-2">
		    	<span id="titulo" class="label label-default"> Sub Total </span>
		    </div>
		    
      	</div>   <!-- fin decima primera fila de la cabecera -->
      	
      	<div class="row-fluid"> <!-- decima segunda fila de la cabecera -->
			<div class="col-md-5">
		    	<span> </span>
		    </div>
		    
		    <div class="col-md-2">
		      	<div class="input-group input-group-sm">
				    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-usd"></span></span>
		    	 		<input type="text"  class="form-control input-sm" id="subTotalGral" name="subTotalGral" readonly='readonly' placeholder="sub total Bs.&hellip;" style="width: 100px;font-size:11px;text-align:center;" >
		    	</div>
	    	</div>
		    
      	</div>   <!-- fin decima segunda fila de la cabecera -->
      	
      	<div style="height:40px;"></div>
		
		<div class="row-fluid"> <!-- decima tercera  fila de la cabecera -->
	      	<div class="col-md-2">
		    	<span id="titulo" class="label label-default"> Utilidad </span>
		    </div>
		    
      	</div>   <!-- fin decima tercera fila de la cabecera -->
      	
      	<div class="row-fluid"> <!-- decima cuarta fila de la cabecera -->
			<div class="col-md-5">
		    	<span> </span>
		    </div>
		    
		    <div class="col-md-2">
		      	<div class="input-group input-group-sm">
				    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-usd"></span></span>
		    	 		<input type="text"  class="form-control input-sm" id="utilidad" name="utilidad"  placeholder="Porcentaje %.&hellip;" style="width: 100px;font-size:11px;text-align:center;" onChange='validarComision(this.value,"utilidad");' >
		    	</div>
	    	</div>
		    
      	</div>   <!-- fin decima cuarta fila de la cabecera -->
      	
      	<div style="height:40px;"></div>
		
		<div class="row-fluid"> <!-- decima quinta  fila de la cabecera -->
	      	<div class="col-md-2">
		    	<span id="titulo" class="label label-default"> Comisiones </span>
		    </div>
		    
      	</div>   <!-- fin decima quinta fila de la cabecera -->
      	
      	<div class="row-fluid"> <!-- decima sexta fila de la cabecera -->
			<div class="col-md-5">
		    	<span> </span>
		    </div>
		    
		    <div class="col-md-2">
		      	<div class="input-group input-group-sm">
				    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-usd"></span></span>
		    	 		<input type="text"  class="form-control input-sm" id="comision" name="comision"  placeholder="Porcentaje %.&hellip;" style="width: 100px;font-size:11px;text-align:center;" onChange='validarComision(this.value,"comision");' >
		    	</div>
	    	</div>
		    
      	</div>   <!-- fin decima sexta fila de la cabecera -->
      	
      	<div style="height:40px;"></div>
      	
		<div class="row-fluid"> <!-- decima septima  fila de la cabecera -->
	      	<div class="col-md-2">
		    	<span id="titulo" class="label label-default"> Total General </span>
		    </div>
		    
      	</div>   <!-- fin decima septima de la cabecera -->
      	
      	<div class="row-fluid"> <!-- decima octava fila de la cabecera -->
			<div class="col-md-5">
		    	<span> </span>
		    </div>
		    
		    <div class="col-md-2">
		      	<div class="input-group input-group-sm">
				    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-usd"></span></span>
		    	 		<input type="text"  class="form-control input-sm" id="totalGral" name="totalGral" readonly='readonly' placeholder="Total Bs.&hellip;" style="width: 100px;font-size:11px;text-align:center;" >
		    	</div>
	    	</div>
		    
      	</div>   <!-- fin decima octava fila de la cabecera -->
	
    </form>
  		        
	  </div>
	  <div class="modal-footer">
	   <button type="button" class="btn btn-default btn-sm"  id="btnBorrarIngresoValores"><span class="glyphicon glyphicon-remove"></span> Borrar</button>&nbsp;
	   <button class="btn btn-default btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-off"></span> Cerrar</button>&nbsp;&nbsp;&nbsp;
	  </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- ... fin  lightbox  valores ... -->


