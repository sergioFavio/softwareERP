var filaActual =-100;  // fila del formulario donde se adiciona registro ..

var totalDebe=0;      // ... calcula a partir de la suma de todos los DEBE formulario ..
var totalHaber=0;      // ... calcula a partir de la suma de todos los HABER formulario ..	

var totalDebeHaber=0;		//...controla totalDebe==totalHaber  para hacer la traduccion de numeral a literal...

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
        	var codigoCuenta = $('td', this).eq(0).text();
        	var nombreCuenta = $('td', this).eq(1).text();
        	var nivel = $('td', this).eq(2).text();

         
  		var limiteArreglo=document.getElementsByClassName("detalleMaterial").length;   // limiteArreglo a buscar codigoRepetido
		var codigoRepetido =verificarCodigoRepetido(codigoCuenta,filaActual,limiteArreglo);			
 			
// 		if(!codigoRepetido){
			$('#idCta_'+filaActual).val(codigoCuenta);
			$('#cta_'+filaActual).val(nombreCuenta);
			$("#cantDebe_"+filaActual).val("");
			$("#cantHaber_"+filaActual).val("");
			$('#glosa_'+filaActual).val("");
					
        	$('#myModal').modal('hide'); // cierra el lightBox
//    	}else{
//    		alert("¡¡¡ Este código" +codigoCuenta +" ya fué adicionado ...!!!");
//    		$('#myModal').modal('hide'); // cierra el lightbox
//      	}
        	
	} ); // fin #tabla2 tbody

			
	$("#btnBorrarComprobante").click(function(){
        	borrarFormularioComprobante();
    });	
    		
	$("#btnGrabarComprobante").click(function(){
	// grabar ingreso [almacen/bodega]
    	grabarComprobante();
	});
				
}); // fin document.ready 
		

function verificarCodigoRepetido(codigoCuenta,posicionFila,limiteArreglo){
	var codigo = codigoCuenta;
	var posicion = parseInt( posicionFila ); // convierte de string to number 
	var limite =limiteArreglo;
	var codigoRepetido= false;  // retorna el estado de la busqueda
					
	for(var i=0; i<limiteArreglo; i++){
		var codigoTdFormulario = $('#idCta_'+i).val(); // asigna codigo del material actual
	    		
			if(codigo == codigoTdFormulario && i != posicion){
	       			codigoRepetido= true;
	       			break;
	       		}
	}
	return codigoRepetido;
}	// fin funcion verificarCodigoRepetido 
	
function borrarFormularioComprobante(){
	//...esta funcion borra los datos del formularioIngreso
	var fila = document.getElementsByClassName("detalleMaterial");
	for(var i=0; i<fila.length; i++){
	    $("#idCta_"+i).val("");
        $("#cta_"+i).val("");
		$("#cantDebe_"+i).val("");
		$("#cantHaber_"+i).val("");
		$("#glosa_"+i).val("");
		$("#detalleTotalHaber").val("");
	} // fin ciclo FOR
} // fin funcion borrarFormularioComprobante
	 
function grabarComprobante(){
	
	var i=0;
	var registrosValidos= true;	  // ... bandera para grabar o no grabar registros ...
	
	if($("#inputFecha").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de FECHA está vacío, seleccione una fecha");
			var registrosValidos= false;	
	}
	
	if($("#inputCliente").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de CLIENTE está vacío");
			var registrosValidos= false;	
	}
	
	if($("#inputConcepto").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de CONCEPTO está vacío");
			var registrosValidos= false;	
	}
	
	if($("#idCta_0").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... No se ha ingresado ningún registro de cuentas");
			var registrosValidos= false;	
	}
	
	
	if($("#inputLiteral").val()==""){
			alert("¡¡¡ E R R O R !!! ... El valor de NUMERO a LITERAL está vacío");
			var registrosValidos= false;	
	}
			
	// ... valida que los registros no tengan glosa vac�a  ...

	while($("#idCta_"+i).val()!= ""){
		
		if($("#glosa_"+i).val()==""){
			alert("¡¡¡ E R R O R !!! ... El valor de GLOSA está vacío");
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

		
function validarMontoDebe(numero, filaExistencia){
			
	if($("#idCta_"+filaExistencia).val()==""){
		alert("¡¡¡ ERROR !!! Primero seleccione un registro para ingresar monto.");
		$("#cantDebe_"+filaExistencia).val("");   // borra celda de cantidad
					
	}else{
    	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
    	if (!/^\d{1,9}(\.\d{1,3})?$/.test(numero)){  // ...hasta 4 digitos parte entera y hasta 3 parte decimal ...
    		alert("El valor " + numero + " no es válido");
    		$("#cantDebe_"+filaExistencia).val("");   // borra celda de cantidad
    	}else{
    		if($("#cantHaber_"+filaExistencia).val()!=""){
				alert("¡¡¡ ERROR !!! La celda del HABER ya esta llenada.");
				$("#cantDebe_"+filaExistencia).val("");   // borra celda de DEBE
    		}else{
	    		var cantidad=$("#cantDebe_"+filaExistencia).val();
		   		cantidad=parseFloat(cantidad);
	    		$("#cantDebe_"+filaExistencia).val( separadorMiles( cantidad.toFixed(2) ) );   //... actualiza cantHaber
	    		calcularTotalDebe();   //... actualiza totalDebe formulario 
	    	}
    	}
	    		
	}
}   // fin ... validarMontoDebe ...


function validarMontoDebeM(numero, filaExistencia){		//...validarMontoDebeM ... modificar comprobante ...
	if (!/^\d{1,9}(\.\d{1,3})?$/.test(numero)){  // ...hasta 4 digitos parte entera y hasta 3 parte decimal ...
    		alert("El valor " + numero + " no es válido");
    		$("#cantDebe_"+filaExistencia).val("");   // borra celda de cantidad
    	}else{
    		if($("#cantHaber_"+filaExistencia).val()!=''){
				alert("¡¡¡ ERROR !!! La celda del HABER ya esta llenada.");
				$("#cantDebe_"+filaExistencia).val("");   // borra celda de DEBE
    		}else{
	    		var cantidad=$("#cantDebe_"+filaExistencia).val();
		   		cantidad=parseFloat(cantidad);
	    		$("#cantDebe_"+filaExistencia).val( separadorMiles( cantidad.toFixed(2) ) );   //... actualiza cantHaber
	    		calcularTotalDebeM();   //... actualiza totalDebe formulario 
	    	}
    	}
}   // fin ... validarMontoDebeM(odificacion) ...


function validarMontoHaber(numero, filaExistencia){
	if($("#idCta_"+filaExistencia).val()==""){
		alert("¡¡¡ ERROR !!! Primero seleccione un registro para ingresar monto.");
		$("#cantHaber_"+filaExistencia).val("");   // borra celda de HABER
					
	}else{
    	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
    	if (!/^\d{1,9}(\.\d{1,3})?$/.test(numero)){  // ...hasta 4 digitos parte entera y hasta 3 parte decimal ...
    		alert("El valor " + numero + " no es válido");
    		$("#cantHaber_"+filaExistencia).val("");   // borra celda de cantidad
    	}else{
    		if($("#cantDebe_"+filaExistencia).val()!=""){
				alert("¡¡¡ ERROR !!! La celda del DEBE ya esta llenada.");
				$("#cantHaber_"+filaExistencia).val("");   // borra celda de cantidad
    		}else{
		   		var cantidad=$("#cantHaber_"+filaExistencia).val();
		   		cantidad=parseFloat(cantidad);
	    		$("#cantHaber_"+filaExistencia).val( separadorMiles( cantidad.toFixed(2) ) );   //... actualiza cantHaber
	    		calcularTotalHaber();   //... actualiza totalHaber formulario
	    	}
    	}
	    		
	}
}   // fin ... validarMontoHaber ...

function validarMontoHaberM(numero, filaExistencia){		//...validarMontoHaberM ... modificar comprobante ...
	if (!/^\d{1,9}(\.\d{1,3})?$/.test(numero)){  // ...hasta 4 digitos parte entera y hasta 3 parte decimal ...
    		alert("El valor " + numero + " no es válido");
    		$("#cantHaber_"+filaExistencia).val("");   // borra celda de cantidad
    	}else{
    		if($("#cantDebe_"+filaExistencia).val()!=""){
				alert("¡¡¡ ERROR !!! La celda del DEBE ya esta llenada.");
				$("#cantHaber_"+filaExistencia).val("");   // borra celda de cantidad
    		}else{
		   		var cantidad=$("#cantHaber_"+filaExistencia).val();
		   		cantidad=parseFloat(cantidad);
	    		$("#cantHaber_"+filaExistencia).val( separadorMiles( cantidad.toFixed(2) ) );   //... actualiza cantHaber
	    		calcularTotalHaberM();   //... actualiza totalHaber formulario
	    	}
    	}
}   // fin ... validarMontoHaberM(odificacion) ...


function validarGlosa(numero, filaExistencia){
			
	if($("#idCta_"+filaExistencia).val()==""){
		alert("¡¡¡ ERROR !!! Primero seleccione un registro para ingresar glosa.");
		$("#glosa_"+filaExistencia).val("");   // borra celda de glosa			
	}
}   // fin ... validarGlosa ...


function calcularTotalDebe(){
	//...suma los importes del formularioIngreso
	var i=0;
	totalDebe=0;
	totalDebe=parseFloat(totalDebe);
		
	while($("#idCta_"+i).val()!= null){
		if( $("#cantDebe_"+i).val()!= "" ){		//...toma los DEBE distintos de vacio ...
			var cantidad=$("#cantDebe_"+i).val();
			cantidad=cantidad.split(','); //... elimina ,
			cantidad=cantidad[0]+cantidad[1]+cantidad[2];	
			cantidad=parseFloat( cantidad	);
	
			totalDebe= totalDebe +  cantidad ;
		}
		i++;
	} // fin ciclo WHILE
	
	totalDebeHaber=parseInt(totalDebe);
	
	totalDebe=separadorMiles(totalDebe.toFixed(2) ); 
	
	document.form_.detalleTotalDebe.value=totalDebe;  // ... totalDebe  variable formulario...
	
	verLiteralNumerica();				//... muestra literalNumerica ...
		
} // fin funcion ... calcularTotalDebe


function calcularTotalDebeM(){			//...calculartotalDebeM ... modificar comprobante ...
	//...suma los importes del formularioIngreso
	var i=0;
	totalDebe=0;
	totalDebe=parseFloat(totalDebe);
				
	while($("#idCta_"+i).val()!=null){
		if( $("#cantDebe_"+i).val()!= null ){		//...toma los DEBE distintos de vacio ...
			var cantidad=$("#cantDebe_"+i).val();
			cantidad=cantidad.split(','); //... elimina ,
			cantidad=cantidad[0]+cantidad[1]+cantidad[2];	
			cantidad=parseFloat( cantidad	);
			totalDebe= totalDebe +  cantidad ;				
		}
		i++;
	} // fin ciclo WHILE
	
	totalDebeHaber=parseInt(totalDebe);
	
	totalDebe=separadorMiles(totalDebe.toFixed(2) ); 
	
	if($("#detalleTotalDebe").val()==$("#detalleTotalHaber").val() && $("#detalleTotalDebe").val()!="" ){
		var posicionDecimal=totalDebe.lastIndexOf('.');   //... devuelve posicion donde se encuentra el punto .
		var parteDecimal=totalDebe.substring(posicionDecimal+1);  //... devuelve parte decimal del numero ...
		
		$.ajax({
	    	url: "convertirNumeroAliteral",  //"convertirNumeroAliteral('1490)",
	        type:"POST",
	        data:{ cadena:totalDebeHaber},
	        dataType: "json",
	        success: function(data){    
	//      	   console.log(data);               
	 		   document.form_.inputLiteral.value="Son: "+ data["literal"] + parteDecimal +"/100 Bolivianos";
	        }
    	});
		
		/*
		 $('#detalleTotalHaber').on("change", 'input[type="text"]', function() {  
		 console.log("test")
		});
		*/
	}else{
		$("#inputLiteral").val("");			//... blanquea campo donde se muestra la lietarlnumerica...
	}		//...fin IF totalDebe == totalhaber ....
	
} // fin funcion ... calcularTotalDebeM(odificado)


function calcularTotalHaber(){
	//...suma los importes del formulario
	var i=0;
	totalHaber=0;
	totalHaber=parseFloat(totalHaber);
		
	while($("#idCta_"+i).val()!= null){
		if( $("#cantHaber_"+i).val()!= "" ){ 		//...toma los HABER distintos de vacio ...
			var cantidad=$("#cantHaber_"+i).val();
			cantidad=cantidad.split(','); //... elimina ,
			cantidad=cantidad[0]+cantidad[1]+cantidad[2];	
			cantidad=parseFloat( cantidad	);
	
			totalHaber= totalHaber +  cantidad ;
		}
		
		i++;
	} // fin ciclo WHILE
	
	totalDebeHaber=parseInt(totalHaber);
	
	totalHaber=separadorMiles(totalHaber.toFixed(2) ); 
	
	document.form_.detalleTotalHaber.value=totalHaber;  // ... totalHaber  variable formulario...
	
	verLiteralNumerica();		//... muestra literalNumerica ...
		
} // fin funcion ... calcularTotalHaber 

function calcularTotalHaberM(){			//...calculartotalHaberM ... modificar comprobante ...
	//...suma los importes del formulario
	var i=0;
	totalHaber=0;
	totalHaber=parseFloat(totalHaber);
				
	while($("#idCta_"+i).val()!=null){
		if( $("#cantHaber_"+i).val()!= null ){		//...toma los DEBE distintos de vacio ...
			var cantidad=$("#cantHaber_"+i).val();
			cantidad=cantidad.split(','); //... elimina ,
			cantidad=cantidad[0]+cantidad[1]+cantidad[2];	
			cantidad=parseFloat( cantidad	);
			totalHaber= totalHaber +  cantidad ;				
		}
		i++;
	} // fin ciclo WHILE
	
	totalDebeHaber=parseInt(totalHaber);
	
	totalHaber=separadorMiles(totalHaber.toFixed(2) ); 
	
	if($("#detalleTotalDebe").val()==$("#detalleTotalHaber").val() && $("#detalleTotalHaber").val()!="" ){
		var posicionDecimal=totalHaber.lastIndexOf('.');   //... devuelve posicion donde se encuentra el punto .
		var parteDecimal=totalHaber.substring(posicionDecimal+1);  //... devuelve parte decimal del numero ...
		
		$.ajax({
	    	url: "convertirNumeroAliteral",  //"convertirNumeroAliteral('1490)",
	        type:"POST",
	        data:{ cadena:totalDebeHaber},
	        dataType: "json",
	        success: function(data){    
	//      	   console.log(data);               
	 		   document.form_.inputLiteral.value="Son: "+ data["literal"] + parteDecimal +"/100 Bolivianos";
	        }
    	});
		
		/*
		 $('#detalleTotalHaber').on("change", 'input[type="text"]', function() {  
		 console.log("test")
		});
		*/
	}else{
		$("#inputLiteral").val("");			//... blanquea campo donde se muestra la lietarlnumerica...
	}		//...fin IF totalDebe == totalhaber ....
		
} // fin funcion ... calcularTotalHaberM(odificado)

function verLiteralNumerica(){
	//... si los totales DEBE y HABER son iguales muestra la literalNumerica...
	if($("#detalleTotalDebe").val()==$("#detalleTotalHaber").val() && $("#detalleTotalDebe").val()!="" ){
		var posicionDecimal=totalHaber.lastIndexOf('.');   //... devuelve posicion donde se encuentra el punto .
		var parteDecimal=totalHaber.substring(posicionDecimal+1);  //... devuelve parte decimal del numero ...
		
		$.ajax({
	    	url: "convertirNumeroAliteral",  //"convertirNumeroAliteral('1490)",
	        type:"POST",
	        data:{ cadena:totalDebeHaber},
	        dataType: "json",
	        success: function(data){    
	//      	   console.log(data);               
	 		   document.form_.inputLiteral.value="Son: "+ data["literal"] + parteDecimal +"/100 Bolivianos";
	        }
    	});
		
		/*
		 $('#detalleTotalHaber').on("change", 'input[type="text"]', function() {  
		 console.log("test")
		});
		*/
	}else{
		$("#inputLiteral").val("");			//... blanquea campo donde se muestra la lietarlnumerica...
	}
}		//...fin funcion: verLiteralNumerica ...


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
				
	if($("#idCta_"+ filaAnterior).val()==""  && filaAnterior >=0 ){
		return true;  // fila vacia ...
	}else{
		return false; // fila llena ...
	}
}  // ... fin validarFilaSeleccionada ...

function validarFecha(){
	var anhoMesComprobante =$("#inputFecha").val();
 	var anhoMesGestion = $("#inputGestion").val();
 	
	anhoMesComprobante = anhoMesComprobante.split('-');
 	anhoMesGestion = anhoMesGestion.split('-');
 	
 	anhoMesComprobante = anhoMesComprobante[0]+anhoMesComprobante[1];
 	anhoMesGestion = anhoMesGestion[0]+anhoMesGestion[1];
 	                
    if(anhoMesComprobante != anhoMesGestion){	// Verificamos si la fechaGestion es diferente a la fechaComprobante ...
		alert(" ¡¡¡... ERROR ... !!! La fecha del comprobante "+$("#inputFecha").val()+" es distinta a la fecha de gestión "+$("#inputGestion").val()  );   
		$("#inputFecha").val("<?=date('d-m-Y')?>");
    }				                                	
}   // fin ... validarFecha ...