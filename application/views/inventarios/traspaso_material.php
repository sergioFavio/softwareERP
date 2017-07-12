<link rel="stylesheet" type="text/css"  href="<?=base_url(); ?>css/ingresoSalidaMaterial.css" />
	
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.css"/>
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery-ui-1.8.20.custom.min.js"></script>

<!--script type="text/javascript" src="<?=base_url(); ?>js/ingresoSalidaMaterial.js"></script-->

<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>"> <!-- una de las librerias de bootstarp para manejar fecha-->

<style type="text/css" >

	/*  inicio de scrollbar  */
thead { display:block;  margin:0px; cell-spacing:0px; left:0px; }  
tbody { display:block; overflow:auto; height:330px; }               
th { height:10px;  width:665px;}                                    
td { height:10px;  width:665px; margin:0px; cell-spacing:0px;}
/*  fin de scrollbar  */

#cuerpoSalida{margin:0 auto;  padding:0; width:770px; background:#f4f4f4;}
.cabeceraSalida{margin:10px;}

#titulo{font-size:14px;margin-top:1px;  text-align:right;font-weight : bold}
</style>

<script>
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
        	var precio = $('td', this).eq(4).text();
         
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
    		
	$("#btnBorrarSalida").click(function(){
        	borrarFormularioSalida();
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
	
function borrarFormularioSalida(){
	//...esta funcion borra los datos del formularioSalida
	var fila = document.getElementsByClassName("detalleMaterial");
	for(var i=0; i<fila.length; i++){
	        $("#idMat_"+i).val("");
        	$("#mat_"+i).val("");
		$("#existMat_"+i).val("");
		$("#cantMat_"+i).val("");
		$("#unidadMat_"+i).val("");
		$("#precioMat_"+i).val("");
	} // fin ciclo FOR
} // fin funcion borrarFormularioSalida 


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
					cantidad=cantidad[0]+cantidad[1]+cantidad[2];	
					cantidad=parseFloat(cantidad);
	    		}
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
		
   <form class="form-horizontal" method="post" action="<?=base_url()?>materiales/grabarTraspaso" id="form_" name="form_" >
   	  <div style="height:10px;"></div>
   	   
      <div class="cabeceraSalida">
		<div class="row-fluid">
			
	    	<div class="col-xs-2">
				<div class="input-group input-group-sm" >
			    	<span class="input-group-addon" id="letraCabecera" >Salida No. </span>
	    	 		<input type="text"  class="form-control input-sm" id="inputNumero" name="inputNumero" value="<?= $salida ?>" readonly="readonly" placeholder="salida No." style="width: 70px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	<div class="col-xs-2">
	    	 	<span></span>
	    	</div>
	    	
	    	<div class="col-xs-3">
	    	 	<span  id="titulo" class="label label-default"><?= strtoupper($titulo) ?></span>
	    	</div> 
	    	
	    	<div class="col-xs-1">
	    	 	<span></span>
	    	</div>
	    	
	    	<div class="col-xs-2" >
				<div class="input-group input-group-sm" >
			    	<span class="input-group-addon" id="letraCabecera">Fecha </span>
	    			<input type="date" class="form-control input-sm" id="inputFecha" name="inputFecha" value="<?=date('d-m-Y')?>"  style="width: 135px;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
		</div>
		
		
		<div style="height:35px;"></div>
		
		<div class="row-fluid"> <!-- segunda fila de la cabecera -->
			
		    <div class="col-lg-4">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" >Trabajador </span>
	    	 		<input type="text"  class="form-control input-sm" id="inputGlosa" name="inputGlosa" value="Traspaso a almacén" readonly="readonly" placeholder="trabajador&hellip;" style="width: 220px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	
	    	<div class="col-xs-2 col-md-2">
	    	 	<span></span>
	    	</div>
	    	
	    	
		    <div class="col-lg-4">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" >Orden No. </span>
	    	 		<input type="text"  class="form-control input-sm" id="inputOrden" name="inputOrden" value="<?=$ingreso?>" readonly="readonly" placeholder="orden No.&hellip;" style="width: 90px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	<div style="height:25px;"></div>
	    	
		</div>
	</div>

	<table width="79%" class="table table-striped table-bordered table-condensed " >
	  <thead >
    	<tr style="background-color: #b9e9ec; " class='letraDetalle'>
        	<th style="width: 180px;">Código</th>
            <th style="width: 235px;">Material</th>
            <th style="width: 85px;">Existencia</th>
            <th style="width: 82px;">Cantidad</th>                              
            <th style="width: 85px">Unidad</th>
            <th style="width: 100px">Precio Bs.</th>
    	</tr>
      </thead >
    <tbody >
    		
    	<?php  	
        //.. ciclo de impresion de filas 
       		for($x=0; $x<25; $x++){
            	echo "<tr class='detalleMaterial' >";
           
					echo"<td  class='openLightBox' title='Seleccionar material de la tabla de $titulo' style='width: 80px; background-color: #d9f9ec;' fila=$x>
					<input type='text' name='idMat_".$x."' id='idMat_".$x."'  readonly='readonly' style='width: 60px; border:none; background-color: #d9f9ec;' /></td>";
					
                    echo "<td class='letraDetalle'  style='width: 320px; background-color: #f9f9ec;' ><input type='text' id='mat_".$x."' name='mat_".$x."' size='50' readonly='readonly' style='border:none;' /></td>";
                    
                    echo "<td style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraNumero' name='existMat_".$x."' id='existMat_".$x."' size='7' readonly='readonly' style='border:none;' /></td>";
					
                    echo "<td style='width: 80px; background-color: #d9f9ec;'><input type='text' class='letraNumeroNegrita' name='cantMat_".$x."' id='cantMat_".$x."' style='width: 80px; border:none; background-color: #d9f9ec;' onChange='validarCantidad(this.value,$x);'/></td>";  
					          
                    echo "<td style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraCentreada' name='unidadMat_".$x."' id='unidadMat_".$x."' size='7' readonly='readonly' style='border:none;'/></td>";
                    
					echo "<td style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraNumeroNegrita' name='precioMat_".$x."' id='precioMat_".$x."' size='7' readonly='readonly' style='border:none;'/></td>";
					
                echo "</tr>";
             }
         ?>
      </tbody>
  
	</table>
	
	<input type="hidden"  name="numeroFilas"  />
	<input type="hidden"  name="nombreDeposito" value="<?= $nombreDeposito ?>" />     <!--  nombreDeposito: almacen/bodega -->
	<input type="hidden"  name="ingreso" value="<?= $ingreso ?>" />     <!--  numero ingreso almacen -->
	
	
	<div style="text-align: right; padding-top: 3px;">   
    	<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;
        <button type="button" class="btn btn-default btn-sm"  id="btnBorrarSalida"><span class="glyphicon glyphicon-remove"></span> Borrar</button>&nbsp;
        <button type="button" class="btn btn-inverse btn-sm" id="btnGrabarSalida" ><span class="glyphicon glyphicon-hdd"></span> Grabar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   </div>
   <div style="height:10px;"></div>
   </form>
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
					<th style='width:30px;'>Precio Unidad</th>
				</tr>
			</thead>
			<tbody>			
                <?php foreach($insumos as $insumo):?>
                    <tr class='letraDetalleLightBox'>
                        <td style='width:40px;'> <?= $insumo["codInsumo"] ?></td>
                        <td style='width:450px;'> <?= $insumo["nombreInsumo"]?></td>
                        <td style='width:70px;'> <?= $insumo["existencia"]?></td>
                        <td style='width:70px;'><?= $insumo["unidad"]?></td>
                        <td style='width:30px;'><?= number_format($insumo["precioUnidad"],2)?></td>
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
