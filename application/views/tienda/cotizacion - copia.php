<link rel="stylesheet" href="<?= base_url("css/bootstrap.min.css")?>"> 



<script type="text/javascript" src="<?=base_url(); ?>js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?=base_url(); ?>js/bootstrap.min.js"></script>

<link rel="stylesheet" href="<?= base_url("css/fileinput.css")?>">					<!-- archivo .css para subir archivos -->
<script type="text/javascript" src="<?=base_url(); ?>js/fileinput.min.js"></script>		<!-- archivo .js para subir archivos -->

<style type="text/css" >

/*   light box fotografia */
.fotografia-dialog {width:350px;}

#fotografiaModal{padding-top:220px;padding-left:450px;}  /* ... baja la ventana modal más al centro vertical ... */


	/*  inicio de scrollbar  */
thead { display:block;  margin:0px; cell-spacing:0px; left:0px; }  
tbody { display:block; overflow:auto; height:330px; }               
th { height:10px;  width:890px;}                                    
td { height:10px;  width:890px; margin:0px; cell-spacing:0px;}
/*  fin de scrollbar  */

#cuerpoSalida{margin:0 auto;  padding:0; width:658px; background:#f4f4f4;}
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


//	$("#file-1").fileinput({'showUpload':true, 'previewFileType':'any'});
/*
	$("#file-1").fileinput({
		showUpload: true,
		showCaption: true,
		
        uploadUrl:"D:/naomi.jpg", // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['jpg', 'png','gif'],
        overwriteInitial: false,
        maxFileSize: 1000,
        maxFilesNum: 10,
        //allowedFileTypes: ['image', 'video', 'flash'],
        slugCallback: function(filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
	});


*/



$(document).ready(function(){
	
//	$("#file-1").fileinput({'showUpload':true, 'previewFileType':'any'});

	$("#file-1").fileinput({
		showUpload: true,
		showCaption: true,
		
		
        uploadUrl:"htpp://192.168.1.75/borrador/", // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['jpg', 'png','gif'],
        overwriteInitial: false,
        maxFileSize: 1000,
        maxFilesNum: 10,
        //allowedFileTypes: ['image', 'video', 'flash'],
        slugCallback: function(filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
	});
	

	
	
	

	
	/*  inicio de light box  javascript */
	$('.openLightBox').click(function(){
  		var title = $(this).attr("title");
  		filaActual = $(this).attr("fila");
  				
  		if(!filaVacia(filaActual)){
  			$('.modal-title').html(title);
	  		$('#materialModal').modal({show:true});
  		}else{
  			alert('¡¡¡ A V I S O !!! ... Seleccione la primera fila vacía.')// fila vacía ...
  		}

	});
	/*  fin de light box javascript  */	
			
		 
    	
	
	
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
		
			
	$("#btnBorrarPlantillaProduccion").click(function(){
        	borrarPlantillaProduccion();
    });	
    			
	$("#btnGrabarPlantilla").click(function(){
	// grabar salida [almacen/bodega]
    	grabarPlantilla();
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
	

function borrarPlantillaProduccion(){
	//...esta funcion borra los datos del formularioSalida
	var fila = document.getElementsByClassName("detalleMaterial");
	for(var i=0; i<fila.length; i++){
	    $("#idMat_"+i).val("");
        $("#mat_"+i).val("");
		$("#cantMat_"+i).val("");
		$("#unidadMat_"+i).val("");
	} // fin ciclo FOR
} // fin funcion borrarPlantillaProduccion 

	
function grabarPlantilla(){
	
	var i=0;
	var registrosValidos= true;	  // ... bandera para grabar o no grabar registros ...
	
	if($("#inputCodigo").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de CODIGO DE PRODUCTO está vacío");
			var registrosValidos= false;	
	}
			
	// ... valida que los registros no tengan cantidad vac�a o cantidad > existencia ...
	while($("#idMat_"+i).val()!= ""){
		if($("#cantMat_"+i).val()==""){
			alert("¡¡¡ E R R O R !!! ... El valor de CANTIDAD está vacío");
			var registrosValidos= false;	
		}
	
		i++;
	} // ... fin while ...
		
	document.form_.numeroFilas.value=i;  // ... numeroFilasValidas  variable hidden formulario...
		
	if(!registrosValidos){
		alert('Corrija los campos que están vacíos y/o registros que tienen CANTIDAD vacía.');
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
				
	if($("#idMat_"+ filaAnterior).val()==""  && filaAnterior >=0 ){
		return true;  // fila vac�a ...
	}else{
		return false; // fila llena ...
	}
}  // ... fin validarFilaSeleccionada ...


</script>

<div class="jumbotron" id="cuerpoSalida">		
		
   <!--form class="form-horizontal" method="post" action="<?=base_url()?>tienda/grabarCotizacion" id="form_" name="form_" -->
   	  <div style="height:10px;"></div>
   	   
      <div class="cabeceraSalida">
		<div class="row-fluid">
			
	    	<div class="col-xs-4">
				<div class="input-group input-group-sm" >
					
					 <form  enctype="multipart/form-data">
					 	<!-- input id="file-1" type="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="1" style="background-color:#d9f9ec;width:350px;font-size:11px;text-align:center;" -->
						<input id="file-1" type="file" class="file" data-preview-file-type="text" style="background-color:#d9f9ec;width:350px;font-size:11px;text-align:center;" >                
					 </form>
					
			    	
	    		</div>
	    	</div><!-- /.col-lg-2 -->
	    	
			<div class="col-xs-2">
				<span></span>
			</div>    	
	    	
	    	
	    	<!--form class="form-horizontal" method="post" action="<?=base_url()?>tienda/grabarCotizacion" id="form_" name="form_" -->
	    	
	    	
	    	
	    	<div class="col-xs-4">
	    	 	<span class="label label-default" style="font-size:14px;text-align:center;">Cotización #: <?= strtoupper($local) ?> </span>
	    	</div> 
	    	
	    	
	<div class="col-xs-1">
		<span></span>
	</div>      	
	    	
	    	
	    	<div class="col-xs-2" >
				<div class="input-group input-group-sm" >
					<button type="button" class="btn btn-info btn-sm"  title="Foto: " id="btnVerFoto"><span class="glyphicon glyphicon-camera"></span> &nbsp;Ver &nbsp;Plano</button>
	    		</div>
	    	</div><!-- /.col-lg-2 -->
	    	
		</div>
		
		
		<div style="height:40px;"></div>
		
		<div class="row-fluid"> <!-- segunda fila de la cabecera -->
			
		    <div class="col-lg-4">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-user"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="inputDescripcion" name="inputDescripcion"  readonly='readonly' placeholder="cliente&hellip;" style="width: 250px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	<div class="col-xs-3 col-md-2">
	    	 	<span></span>
	    	</div>
	    	
		    <div class="col-lg-6">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-comment"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="inputMedida" name="inputMedida"  placeholder="observaci&oacute;n&hellip;" style="font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-2 -->
	    	
	    	<div style="height:25px;"></div>
	    	
		</div>
	</div>

	<table width="79%" class="table table-striped table-bordered table-condensed " >
	  <thead >
    	<tr style="background-color: #b9e9ec; " class='letraDetalle'>
        	<th style="width: 180px;">Código</th>
            <th style="width: 320px;">Material</th>
            <th style="width: 80px;">Cantidad</th>                              
            <th style="width: 80px">Unidad</th>
    	</tr>
      </thead >
    <tbody >
    		
    	<?php
        //if ciclo de impresion de filas 
       		for($x=0; $x<20; $x++){
            	echo "<tr class='detalleMaterial' >";
					echo"<td  class='openLightBox' title='Seleccionar producto de la tabla de pedidoproducto' style='width: 80px; background-color: #d9f9ec;' fila=$x>
					<input type='text' name='idMat_".$x."' id='idMat_".$x."'  readonly='readonly' style='width: 60px; border:none; background-color: #d9f9ec;' /></td>";
                    echo "<td class='letraDetalle'  style='width: 400px; background-color: #f9f9ec;' ><input type='text' id='mat_".$x."' name='mat_".$x."' size='50' readonly='readonly' style='border:none;' /></td>";
                    echo "<td style='width: 80px; background-color: #d9f9ec;'><input type='text' class='letraNumeroNegrita' name='cantMat_".$x."' id='cantMat_".$x."' style='width: 80px; border:none; background-color: #d9f9ec;' onChange='validarCantidad(this.value,$x);'/></td>";          
                    echo "<td style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraCentreada' name='unidadMat_".$x."' id='unidadMat_".$x."' size='7' readonly='readonly' style='border:none;'/></td>";
                echo "</tr>";
             }
         ?>
      </tbody>
  
	</table>
	
	<input type="hidden"  name="numeroFilas"  />
	<input type="hidden"  name="local" value="<?= $local ?>" />     <!--  nombreDeposito: almacen/bodega -->
	
	<div style="text-align: right; padding-top: 3px;">   
    	<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;
        <button type="button" class="btn btn-default btn-sm"  id="btnBorrarPlantillaProduccion" ><span class="glyphicon glyphicon-remove"></span> Borrar</button>&nbsp;
        <button type="button" class="btn btn-inverse btn-sm" id="btnGrabarPlantilla" ><span class="glyphicon glyphicon-hdd"></span> Grabar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   </div>
   <div style="height:10px;"></div>
   <!--/form-->
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

