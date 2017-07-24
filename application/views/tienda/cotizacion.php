<link rel="stylesheet" href="<?= base_url("css/bootstrap.min.css")?>"> 
<script type="text/javascript" src="<?=base_url(); ?>js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?=base_url(); ?>js/bootstrap.min.js"></script>

<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>"> <!-- una de las librerias de bootstarp para manejar fecha-->

<style type="text/css" >

/*   light box fotografia */
.fotografia-dialog {width:350px;}

#fotografiaModal{padding-top:220px;padding-left:450px;}  /* ... baja la ventana modal más al centro vertical ... */

	/*  inicio de scrollbar  */
thead { display:block;  margin:0px; cell-spacing:0px; left:0px; }  
tbody { display:block; overflow:auto; height:270px; }               
th { height:10px;  width:890px;}                                    
td { height:10px;  width:890px; margin:0px; cell-spacing:0px;}
/*  fin de scrollbar  */

#cuerpoCabecera{margin:0 auto;  padding:0; width:750px;height:140px; background:#f4f4f4;}
#cuerpoSalida{margin:0 auto;  padding:0; width:750px; background:#f4f4f4;}
.cabeceraSalida{margin:10px;}

#inputFecha, #inputFechaInicial, #inputFechaFinal{font-size:11px;text-align:center;}

#letraCabecera{font-size:12px;margin-top:1px; margin-left:25px; text-align:left;}

.letraDetalle , .openLightBox{font-size:11px;text-align:left;}

.letraCentreada{font-size:11px;text-align:center;}
 			
.letraNumero{font-size:11px;text-align:right;}
        
.letraNumeroNegrita{font-size:11px;text-align:right; font-weight : bold;}


.letraDetalleLightBox{font-size:10px;margin-top:1px;text-align:left;}

</style>


<script>

$(document).ready(function(){
	/*  inicio de light box  verFotografia javascript */
	$('#btnVerPlano').click(function(){
  		var title = $(this).attr("title");
  		var fotoP = document.getElementById('fotoProducto'); 
		var codiProducto=$("#inputCodigo").val(); 
		codiProducto=codiProducto.split(' '); //... elimina espacio en blanco ...
		codiProducto=codiProducto[0]+codiProducto[1]; 
		fotoP.src ="/assets/img/productos/"+codiProducto+".jpg";
		
  		if($("#inputCodigo").val()!="" ){
  			$('.modal-title').html($('#inputDescripcion').val());			
	  		$('#fotografiaModal').modal({show:true});
  		}else{
  			alert("¡¡¡ E R R O R !!! ... primero seleccione un CODIGO DE PRODUCTO");
  		}

	});
		
			
	$("#btnBorrarPlantillaCotizacion").click(function(){
        	borrarPlantillaCotizacion();
    });	
    			
	$("#btnGrabarCotizacion").click(function(){
	// grabar salida [almacen/bodega]
    	grabarCotizacion();
	});
	
		
}); // fin document.ready 
			

function borrarPlantillaCotizacion(){
	//...esta funcion borra los datos del formularioSalida
	var fila = document.getElementsByClassName("detalleMaterial");
	for(var i=0; i<fila.length; i++){
		$("#cantMat_"+i).val("");
		$("#unidadMat_"+i).val("");
        $("#mat_"+i).val("");
	} // fin ciclo FOR
} // fin funcion borrarPlantillaProduccion 

	
function grabarCotizacion(){
	
	var i=0;
	var registrosValidos= true;	  // ... bandera para grabar o no grabar registros ...
/*	
	if($("#fileToUpload").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... NO se han seleccionado imágenes de planos para subir");
			var registrosValidos= false;	
	}
*/
	
	if($("#inputFecha").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... NO se ha seleccionado una FECHA");
			var registrosValidos= false;	
	}
	
	if($("#cliente").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de CLIENTE está vacío");
			var registrosValidos= false;	
	}
	
	if($("#contacto").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de CONTACTO está vacío");
			var registrosValidos= false;	
	}
	
/*
	if($("#telefono").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de TELEFONO está vacío");
			var registrosValidos= false;	
	}
*/
	
	if($("#cantMat_"+i).val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de CANTIDAD está vacío");
			var registrosValidos= false;	
	}
			
	// ... valida que los registros no tengan cantidad vac�a o cantidad > existencia ...
	while($("#cantMat_"+i).val()!= ""){
		if($("#mat_"+i).val()==""){
			alert("¡¡¡ E R R O R !!! ... El valor de DESCRIPCION está vacío");
			var registrosValidos= false;	
		}
		i++;
	} // ... fin while ...
		
	document.form_.numeroFilas.value=i;  // ... numeroFilasValidas  variable hidden formulario...
		
	if(!registrosValidos){
		alert('Corrija los campos que están vacíos y/o registros que tienen DESCRIPCION vacía.');
	}else{
		$("#form_").submit(); // ...  graba registros ...
	}
			
}	// ... fin funcion grabarCotizacion() ...
		

function validarTelefono(numero){
	if (!/^([0-9])*$/.test(numero)){  			// ... solo numeros enteros ...  
		alert("El valor " + numero + " no es un NUMERO TELEFONICO");
		$("#telefono").val("");   // borra celda de cantidad
    }
}	//... fin validarTelefono ...


function validarEmail(cadenaEmail){
//	var cadenaEmail= $('#inputEmail').val();
	if (cadenaEmail.indexOf('@')==-1 || cadenaEmail.indexOf('.')==-1) {				//... si no se encuentra la subcadena en la cadena ...
		alert("¡¡¡ E R R O R !!! ... El contenido de CORREO ELECTRONICO no es válido");
		$("#correo").val("");   // borra celda de correo elctronico ...
	}
}	//... fin validarEmail ...


function validarDescripcion(filaExistencia){
	if($("#cantMat_"+filaExistencia).val()==""){
		alert("¡¡¡ ERROR !!! Primero ingrese la cantidad.");
		$("#mat_"+filaExistencia).val("");   // borra celda de cantidad		
	}
}   // fin ... validarDescripcion ...

		
function validarCantidad(numero, filaExistencia){
	var cantidad=parseInt( numero ); // convierte de string to number 
			
	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
	if (!/^\d{1,7}(\.\d{1,3})?$/.test(numero)){  // ...hasta 4 digitos parte entera y hasta 3 parte decimal ...
		alert("El valor " + numero + " no es una cantidad válida");
		$("#cantMat_"+filaExistencia).val("");   // borra celda de cantidad
	}else{					//... cantidad validada ...
		if(!filaVacia(filaExistencia)){
	    	$("#cantMat_"+filaExistencia).val( separadorMiles( cantidad.toFixed(0) ) );   //... actualiza cantHaber
			$("#unidadMat_"+filaExistencia).val("pza");   // escribe celda de unidad ...
  		}else{
  			alert('¡¡¡ A V I S O !!! ... Seleccione la primera fila vacía.');// fila vacía ...
  			$("#cantMat_"+filaExistencia).val("");
			$("#unidadMat_"+filaExistencia).val("");
	        $("#mat_"+filaExistencia).val("");
  		}			
	}
}   // fin ... validarCantidad ...
	
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
				
	if($("#cantMat_"+ filaAnterior).val()==""  && filaAnterior >=0 ){
		return true;  // fila vac�a ...
	}else{
		return false; // fila llena ...
	}
}  // ... fin validarFilaSeleccionada ...

</script>

<div class="jumbotron" id="cuerpoCabecera">		
		
   <form class="form-horizontal" method="post" action="<?=base_url()?>tienda/grabarCotizacion" id="form_" name="form_" enctype="multipart/form-data" >
   	  <div style="height:10px;"></div>
   	   
      <div class="cabeceraSalida">
		<div class="row-fluid">
	    	<div class="col-xs-4">
				<div class="input-group input-group-sm" >
					<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-export"></span></span> 
					<input type="file" id="fileToUpload" name="fileToUpload[]"  class="form-control input-sm" style="background-color:#d9f9ec;width:280px;font-size:11px;text-align:center;" multiple="multiple" >
	    		</div>
	    	</div><!-- /.col-lg-2 -->
	    	
			<div class="col-xs-2">
				<span></span>
			</div>    	
	    	
	    	<div class="col-xs-2">
	    	 	<span class="label label-default" style="font-size:14px;text-align:center;">Cotización No.: <?= strtoupper($numeroCotizacion) ?> </span>
	    	</div> 
	    	
			<div class="col-xs-1">
				<span></span>
			</div>      	
	    	
	    	<div class="col-xs-1" >
				<div class="input-group input-group-sm" >
			    	<span class="input-group-addon" id="letraCabecera"><span class="glyphicon glyphicon-calendar"></span> </span>
	    			<input type="date" class="form-control input-sm" id="inputFecha" name="inputFecha" value="<?=date('d-m-Y')?>"  style="width: 130px;" >
	    		</div>
	    	</div><!-- /.col-xs-1 -->
	    
		</div>		<!--fin de la fila -->
		
		<div style="height:38px;"></div>
		
		<div class="row-fluid"> <!-- segunda fila de la cabecera -->
			
		    <div class="col-lg-4">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-tag"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="cliente" name="cliente" placeholder="cliente&hellip;" style="width: 250px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	<div class="col-xs-3 col-md-2">
	    	 	<span></span>
	    	</div>
	    	
		    <div class="col-lg-6">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-user"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="contacto" name="contacto"  placeholder="contacto&hellip;" style="font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-2 -->
	    	
		</div>  <!--fin de la fila -->
		
		<div style="height:38px;"></div>
		
		<div class="row-fluid"> <!-- tercera fila de la cabecera -->
			
		    <div class="col-xs-2">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-phone-alt"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="telefono" name="telefono"  placeholder="tel&eacute;fono/celular&hellip;" style="width: 200px;font-size:11px;text-align:center;" onChange='validarTelefono(this.value);' >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	<div class="col-xs-4">
	    	 	<span></span>
	    	</div>
	    	
		    <div class="col-xs-6">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-envelope"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="correo" name="correo"  placeholder="correo electr&oacute;nico&hellip;" style="font-size:11px;text-align:center;" onChange='validarEmail(this.value);'>
	    		</div>
	    	</div><!-- /.col-lg-2 -->
	    	
		</div>  <!--fin de la fila -->
			
	</div>		<!--fin de la cabecera -->
	
</div>		<!--fin de cuerpoCabecera -->

<div style="height:7px;"></div>
	
<div class="jumbotron" id="cuerpoSalida">		
	<div style="height:4px;"></div>

	<table width="79%" class="table table-striped table-bordered table-condensed " >
	  <thead >
    	<tr style="background-color: #b9e9ec; " class='letraDetalle'>
        	<th style="width: 80px;text-align:center;">Cantidad</th>
        	<th style="width: 80px;text-align:center;">Unidad</th>
            <th style="width: 587px;text-align:center;">Descripci&oacute;n</th>
    	</tr>
      </thead >
    <tbody >
    		
    	<?php
        //if ciclo de impresion de filas 
       		for($x=0; $x<13; $x++){
            	echo "<tr class='detalleMaterial' >";
					echo "<td style='width: 70px; background-color: #d9f9ec;'><input type='text' class='letraNumeroNegrita' name='cantMat_".$x."' id='cantMat_".$x."' style='width: 70px; border:none; background-color: #d9f9ec;' onChange='validarCantidad(this.value,$x);'/></td>";          
                    echo "<td style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraCentreada' name='unidadMat_".$x."' id='unidadMat_".$x."' readonly='readonly' style='width: 70px;border:none;'/></td>";
					echo "<td class='letraDetalle'  style='width: 557px; background-color: #d9f9ec;'' ><textarea rows='6' id='mat_".$x."' name='mat_".$x."'  style='width:557px;border:none;background-color: #d9f9ec;' onChange='validarDescripcion($x);' /></textarea></td>";
                echo "</tr>";
             }
         ?>
      </tbody>
  
	</table>
	
	<input type="hidden"  name="numeroFilas"  />
	<input type="hidden"  name="numeroCotizacion" value="<?= $numeroCotizacion ?>" />     <!--  nombreDeposito: almacen/bodega -->
	
	<div style="text-align: right; padding-top: 3px;">   
    	<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;
        <button type="button" class="btn btn-default btn-sm"  id="btnBorrarPlantillaCotizacion" ><span class="glyphicon glyphicon-remove"></span> Borrar</button>&nbsp;
        <button type="button" class="btn btn-inverse btn-sm" id="btnGrabarCotizacion" ><span class="glyphicon glyphicon-hdd"></span> Grabar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   </div>
   <div style="height:10px;"></div>
   </form>
</div>




<!-- ... inicio  lightbox fotografia... -->
<div id="fotografiaModal"  class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" >
  <div class="fotografia-dialog"  >
  <div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h5 class="modal-title">cabecera de caja luz</h5>
	</div>
	<div class="modal-body">
		<input type='image' id='fotoProducto' class="img-rounded" width='300' height='200'>
	</div>
	
   </div>
  </div>
</div>
<!-- ... fin  lightbox fotografia... -->

