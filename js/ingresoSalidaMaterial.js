var filaActual =-100;  // fila del formulario donde se adiciona registro ..

var totalBs=0;      // ... calcula a partir de la suma de todos los importes formulario ..ingreso de materiales			
$(document).ready(function() {
			
	/*  inicio de light box  javascript */
	$('.openLightBox').click(function(){
  		var title = $(this).attr("title");
  		filaActual = $(this).attr("fila");
  				
  		if(!filaVacia(filaActual)){
  			$('.modal-title').html(title);
	  		$('#myModal').modal({show:true});
  		}else{
  			alert('¡¡¡ A V I S O !!! ... Seleccione la primera fila vacía.')// fila vacía ...
  		}

	});
	/*  fin de light box javascript  */	
			
		 
    	$('#tabla2').dataTable();
    
    	$('#tabla2 tbody').on('click', 'tr', function () {	
        	var codigoMaterial = $('td', this).eq(0).text();
        	var nombreMaterial = $('td', this).eq(1).text();
        	var existencia = $('td', this).eq(2).text();
        	var unidad = $('td', this).eq(3).text();
        	var precio = $('td', this).eq(5).text();
         
  		var limiteArreglo=document.getElementsByClassName("detalleMaterial").length;   // limiteArreglo a buscar codigoRepetido
		var codigoRepetido =verificarCodigoRepetido(codigoMaterial,filaActual,limiteArreglo);			
 			
 		if(!codigoRepetido){
			$('#idMat_'+filaActual).val(codigoMaterial);
			$('#mat_'+filaActual).val(nombreMaterial);
			$('#existMat_'+filaActual).val(existencia);
			$('#unidadMat_'+filaActual).val(unidad);
			$('#precioMat_'+filaActual).val(precio);
			
			$('#cantMat_'+filaActual).val("");				//... blanquea campo...
			$('#compraMat_'+filaActual).val("");			//... blanquea campo...
			$('#importeMat_'+filaActual).val("");			//... blanquea campo...
					
        	$('#myModal').modal('hide'); // cierra el lightBox
    	}else{
    		alert("¡¡¡ Este código" +codigoMaterial +" ya fué adicionado ...!!!");
    		$('#myModal').modal('hide'); // cierra el lightbox
      	}
        	
	} ); // fin #tabla2 tbody

			
	$("#btnBorrarIngreso").click(function(){
        	borrarFormularioIngreso();
    });	
    		

	$("#btnBorrarSalida").click(function(){
        	borrarFormularioSalida();
    });	


	$("#btnGrabarIngreso").click(function(){
	// grabar ingreso [almacen/bodega]
    	grabarIngreso();
	});
	
	
	$("#btnGrabarSalida").click(function(){
	// grabar salida [almacen/bodega]
    	grabarSalida();
	});
	
		
}); // fin document.ready 
		

function verificarCodigoRepetido(codigoMaterial,posicionFila,limiteArreglo){
	var codigo = codigoMaterial;
	var posicion = parseInt( posicionFila ); // convierte de string to number 
	var limite =limiteArreglo;
	var codigoRepetido= false;  // retorna el estado de la busqueda
					
	for(var i=0; i<limiteArreglo; i++){
		var codigoTdFormulario = $('#idMat_'+i).val(); // asigna codigo del material actual
	    		
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
		$("#existMat_"+i).val("");
		$("#cantMat_"+i).val("");
		$("#unidadMat_"+i).val("");
		$("#precioMat_"+i).val("");
		$("#compraMat_"+i).val("");
		$("#importeMat_"+i).val("");
	} // fin ciclo FOR
} // fin funcion borrarFormularioIngreso 
	


function borrarFormularioSalida(){
	//...esta funcion borra los datos del formularioSalida
	var fila = document.getElementsByClassName("detalleMaterial");
	for(var i=0; i<fila.length; i++){
	        $("#idMat_"+i).val("");
        	$("#mat_"+i).val("");
		$("#existMat_"+i).val("");
		$("#cantMat_"+i).val("");
		$("#unidadMat_"+i).val("");
	} // fin ciclo FOR
} // fin funcion borrarFormularioSalida 

		

function grabarIngreso(){
	
	var i=0;
	var registrosValidos= true;	  // ... bandera para grabar o no grabar registros ...
	
	if($("#inputFecha").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de FECHA está vacío, seleccione una fecha");
			var registrosValidos= false;	
	}
	
	if($("#inputProveedor").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de PROVEEDOR está vacío");
			var registrosValidos= false;	
	}
	
	if($("#inputFactura").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de FACTURA está vacío");
			var registrosValidos= false;	
	}
	
	if($("#idMat_0").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... No se ha ingresado ningún registro de materiales");
			var registrosValidos= false;	
	}
	
			
	// ... valida que los registros no tengan cantidad vac�a  ...
	while($("#idMat_"+i).val()!= ""){
		if($("#cantMat_"+i).val()==""){
			alert("¡¡¡ E R R O R !!! ... El valor de CANTIDAD está vacío");
			var registrosValidos= false;	
		}
		
		if($("#compraMat_"+i).val()==""){
			alert("¡¡¡ E R R O R !!! ... El valor de COMPRA Bs. está vacío");
			var registrosValidos= false;	
		}
	
		i++;
	} // ... fin while ...
		
	document.form_.numeroFilas.value=i;  // ... numeroFilasValidas  variable hidden formulario...
		
	if(!registrosValidos){
		alert('Corrija los campos que están vacíos');
	}else{
		$("#form_").submit(); // ...  graba registros ...
	}
			
}	// ... fin funcion grabarIngreso() ...


	
function grabarSalida(){
	
	var i=0;
	var registrosValidos= true;	  // ... bandera para grabar o no grabar registros ...
	
	if($("#inputFecha").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de FECHA está vacío, seleccione una fecha");
			var registrosValidos= false;	
	}
	
	
	if($("#inputGlosa").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de GLOSA está vacío");
			var registrosValidos= false;	
	}
	
	
	if( $("#inputOrden").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de NUMERO de ORDEN está vacío");
			var registrosValidos= false;	
	}
	
	
	if($("#idMat_0").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... No se ha ingresado ningún registro de materiales");
			var registrosValidos= false;	
	}
	
			
	// ... valida que los registros no tengan cantidad vac�a o cantidad > existencia ...
	while($("#idMat_"+i).val()!= ""){
		if($("#cantMat_"+i).val()==""){
			alert("¡¡¡ E R R O R !!! ... El valor de CANTIDAD está vacío");
			var registrosValidos= false;	
		}else{
				
			if(parseFloat($("#cantMat_"+i).val() )> parseFloat($("#existMat_"+i).val() ) ){
				alert("¡¡¡ E R R O R !!! ... El valor de CANTIDAD es mayor que EXISTENCIA");
				var registrosValidos= false;	
			}
		}
	
		i++;
	} // ... fin while ...
		
	document.form_.numeroFilas.value=i;  // ... numeroFilasValidas  variable hidden formulario...
		
	if(!registrosValidos){
		alert('Corrija los campos que están vacíos y/o registros que tienen CANTIDAD vacía o mayor que EXISTENCIA');
	}else{
		$("#form_").submit(); // ...  graba registros ...
	}
			
}	// ... fin funcion grabarSalida() ...
		
		
function validarCantidad(numero, filaExistencia){
			
	if($("#idMat_"+filaExistencia).val()==""){
		alert("¡¡¡ ERROR !!! Primero seleccione un registro para ingresar cantidad.");
		$("#cantMat_"+filaExistencia).val("");   // borra celda de cantidad
				
	}else{
			
		var existenciaAlmacen=parseFloat($('#existMat_'+filaExistencia).val()   );
		var cantidad=parseFloat( numero ); // convierte de string to number 
				
	    	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
	    	if (!/^\d{1,7}(\.\d{1,3})?$/.test(numero)){  // ...hasta 4 digitos parte entera y hasta 3 parte decimal ...
	    		alert("El valor " + numero + " no es una cantidad válida");
	    		$("#cantMat_"+filaExistencia).val("");   // borra celda de cantidad
	    	}else{
	    		
	    		if (cantidad > existenciaAlmacen){	
	    		  	alert("¡¡¡ ERROR !!!  cantidad= " + numero+" NO PUEDE SER MAYOR que existencia= "+existenciaAlmacen );
				$("#cantMat_"+filaExistencia).val("");   // borra celda de cantidad
	    		}else{
	    			var cantidad=$("#cantMat_"+filaExistencia).val();
		    		cantidad=parseFloat(cantidad);
		    		$("#cantMat_"+filaExistencia).val( separadorMiles( cantidad.toFixed(2) ) );   //... actualiza cantidad... 
		    		cantidad=$("#cantMat_"+filaExistencia).val();
					cantidad=cantidad.split(','); //... elimina ,
					cantidad=cantidad[0]+cantidad[1];	
					cantidad=parseFloat( cantidad	);
	    		}
	    	}
	    		
	}
}   // fin ... validarCantidad ...


function validarCantidadIngreso(numero, filaExistencia){
			
	if($("#idMat_"+filaExistencia).val()==""){
		alert("¡¡¡ ERROR !!! Primero seleccione un registro para ingresar cantidad.");
		$("#cantMat_"+filaExistencia).val("");   // borra celda de cantidad
					
	}else{
			
		var cantidad=parseFloat( numero ); // convierte de string to number 
    	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
    	if (!/^\d{1,7}(\.\d{1,3})?$/.test(numero)){  // ...hasta 4 digitos parte entera y hasta 3 parte decimal ...
    		alert("El valor " + numero + " no es válido");
    		$("#cantMat_"+filaExistencia).val("");   // borra celda de cantidad
    	}else{    		
    		var cantidad=$("#cantMat_"+filaExistencia).val();
    		cantidad=parseFloat(cantidad);
    		$("#cantMat_"+filaExistencia).val( separadorMiles( cantidad.toFixed(2) ) );   //... actualiza cantidad... 
    		cantidad=$("#cantMat_"+filaExistencia).val();
			cantidad=cantidad.split(','); //... elimina ,
			cantidad=cantidad[0]+cantidad[1];	
			cantidad=parseFloat( cantidad	);
    		
    		 
    		var precioCompra=$("#compraMat_"+filaExistencia).val();
    		precioCompra=precioCompra.split(','); //... elimina ,
			precioCompra=precioCompra[0]+precioCompra[1];	
			precioCompra=parseFloat(precioCompra);
    		
    		$("#importeMat_"+filaExistencia).val( separadorMiles( (cantidad*precioCompra).toFixed(2) ) );   //... actualiza importe
    		calcularTotalBs();   //... actualiza totalBs formualrio ingreso materiales
    	}
	    		
	}
}   // fin ... validarCantidadIngreso ...



function validarPrecioCompra(numero, filaExistencia){
			
	if($("#idMat_"+filaExistencia).val()==""){
		alert("¡¡¡ ERROR !!! Primero seleccione un registro para ingresar precio de compra.");
		$("#compraMat_"+filaExistencia).val("");   // borra celda de cantidad
				
	}else{
		
		var cantidad=parseFloat( numero ); // convierte de string to number 
    	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
    	if (!/^\d{1,5}(\.\d{1,3})?$/.test(numero)){  // ...hasta 4 digitos parte entera y hasta 3 parte decimal ...
    		alert("El valor " + numero + " no es válido");
    		$("#compraMat_"+filaExistencia).val("");   // borra celda de precioCompra
    	}else{
    		var cantidad=$("#cantMat_"+filaExistencia).val();
			cantidad=cantidad.split(','); //... elimina ,
			cantidad=cantidad[0]+cantidad[1];	
			cantidad=parseFloat(cantidad);
    		
    		var precioCompra=$("#compraMat_"+filaExistencia).val();
    		precioCompra=parseFloat( precioCompra	);
    		$("#compraMat_"+filaExistencia).val(separadorMiles( precioCompra.toFixed(2) ));
			
    		$("#importeMat_"+filaExistencia).val( separadorMiles((cantidad*precioCompra).toFixed(2)) );   //... actualiza importe
    		calcularTotalBs();   //... actualiza totalBs formualrio ingreso materiales
    	}
	    		
	}
}   // fin ... validarPrecioCompra ...


function calcularTotalBs(){
	//...suma los importes del formularioIngreso
	var i=0;
	totalBs=0;
	totalBs=parseFloat(totalBs);
		
	while($("#idMat_"+i).val()!= ""){
		//var importe= parseFloat( $("#importeMat_"+i).val() );
		var importe=$("#importeMat_"+i).val();
		
		importe=importe.split(','); //... elimina ,
		importe=importe[0]+importe[1]+importe[2];	
		importe=parseFloat( importe	);

		totalBs= totalBs +  importe ;
		i++;
	} // fin ciclo WHILE
	
	totalBs=separadorMiles(totalBs.toFixed(2) ); 
	
	document.form_.detalleTotalBs.value=totalBs;  // ... totalBs  variable formulario...
		
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

		
function filaVacia(posicionFila){
	var filaAnterior= parseInt( posicionFila )-1;
				
	if($("#idMat_"+ filaAnterior).val()==""  && filaAnterior >=0 ){
		return true;  // fila vac�a ...
	}else{
		return false; // fila llena ...
	}
}  // ... fin validarFilaSeleccionada ...