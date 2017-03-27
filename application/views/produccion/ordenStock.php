	
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.css"/>
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery-ui-1.8.20.custom.min.js"></script>

<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>"> <!-- una de las librerias de bootstarp para manejar fecha-->

<style type="text/css" >

/*   light box material */
.empleado-dialog {width:530px;}
#empleadoModal{padding-left:440px;}  /* ... baja la ventana modal más al centro vertical ... */

	/*  inicio de scrollbar  */
thead { display:block;  margin:0px; cell-spacing:0px; left:0px; }  
tbody { display:block; overflow:auto; height:330px; }               
th { height:10px;  width:500px;}                                    
td { height:10px;  width:500px; margin:0px; cell-spacing:0px;}
/*  fin de scrollbar  */

#cuerpoSalida{margin:0 auto;  padding:0; width:450px; background:#f4f4f4;}
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

$(document).ready(function() {
	
	/*  inicio de light box  producto javascript */
	$('#empleado').click(function(){
  		var title = $(this).attr("title");
		$('.modal-title').html(title);
  		$('#empleadoModal').modal({show:true});
	});
	/*  fin de light box producto javascript  */	
	
	
	$('#tabla3').dataTable();
    
    $('#tabla3 tbody').on('click', 'tr', function () {	
    	var codigoEmpleado = $('td', this).eq(0).text();
    	var nombreEmpleado = $('td', this).eq(1).text();

		$('#empleado').val(nombreEmpleado);

    	$('#empleadoModal').modal('hide'); // cierra el lightBox
  
	} ); // fin #tabla3 tbody
	
					
	$("#btnBorrar").click(function(){
        	borrarOrdenStock();
    });	
    			
	$("#btnGrabarPlantilla").click(function(){
	// grabar salida [almacen/bodega]
    	grabarPlantilla();
	});
	
		
}); // fin document.ready 
		

function borrarOrdenStock(){
	//...esta funcion borra los datos del formularioSalida
    $("#empleado").val("");
    $("#cantidad").val("");
	$("#unidad").val("");
	$("#descripcion").val("");
} // fin funcion borrarOrdenStock

	
function grabarPlantilla(){
	var registrosValidos= true;	  // ... bandera para grabar o no grabar registros ...
	
	if($("#inputCodigo").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de CODIGO DE PRODUCTO está vacío");
			var registrosValidos= false;	
	}
			
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

</script>

<div class="jumbotron" id="cuerpoSalida">		
		
   <form class="form-horizontal" method="post" action="<?=base_url()?>produccion/grabarOrdenStock" id="form_" name="form_" >
   	  <div style="height:10px;"></div>
   	   
      <div class="cabeceraSalida">
		<div class="row-fluid">
			
			<div class="col-xs-2 col-md-4">
				<span></span>
			</div>    	
	    	
	    	<div class="col-md-4">
	    	 	<span class="label label-default" style="font-size:14px;text-align:center;">Orden Stock <?= strtoupper('No. ....') ?> </span>
	    	</div> 
	    		
		</div>
		
		<div style="height:40px;"></div>
		
				<div class="row-fluid">
			
	    	<div class="col-xs-4">
				<div class="input-group input-group-sm" >
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-user"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="empleado" name="empleado" title='Seleccionar trabajador' readonly="readonly" placeholder="trabajador&hellip;" style="background-color:#d9f9ec;width:365px;font-size:11px;text-align:center;width: 365px;" >
	    		</div>
	    	</div><!-- /.col-lg-2 -->
	    	
			<div class="col-xs-2 col-md-2">
				<span></span>
			</div>    	
	    	
		</div>
		
		<div style="height:40px;"></div>
		
		<div class="row-fluid"> <!-- segunda fila de la cabecera -->
			
		    <div class="col-xs-2">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-sound-5-1"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="cantidad" name="cantidad"  placeholder="cantidad&hellip;" style="width: 150px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	<div class="col-xs-4">
	    	 	<span></span>
	    	</div>
	    	
		    <div class="col-xs-2">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-tag"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="unidad" name="unidad" placeholder="unidad&hellip;" style="width:150px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-2 -->
	    	
		</div>
		
		<div style="height:40px;"></div>
		
		<div class="row-fluid"> <!-- tercera fila de la cabecera -->
			
		    <div class="col-xs-3">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-comment"></span></span>
	    	 		<textarea rows='6'   id="descripcion" name="descripcion"  placeholder="descripci&oacute;n&hellip;" style="width:365px;font-size:11px;text-align:center;" ></textarea>
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
		</div>
		
		<div style="height:25px;"></div>
		
	</div>

	<!--input type="hidden"  name="nombreDeposito" value="<?= $nombreDeposito ?>" />     <!--  nombreDeposito: almacen/bodega -->
	<div style="height:80px;"></div>
	<div style="text-align: right; padding-top: 3px;">   
    	<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;
        <button type="button" class="btn btn-default btn-sm"  id="btnBorrar" ><span class="glyphicon glyphicon-remove"></span> Borrar</button>&nbsp;
        <button type="button" class="btn btn-inverse btn-sm" id="btnGrabarPlantilla" ><span class="glyphicon glyphicon-hdd"></span> Grabar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   </div>
   <div style="height:10px;"></div>
   </form>
</div>


<!-- ... inicio  lightbox trabajadores... -->

<div id="empleadoModal"  class="modal fade" tabindex="-1" role="dialog" >
  <div class="empleado-dialog"  >
  <div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h4 class="modal-title">cabecera de caja luz</h4>
	</div>
	<div class="modal-body">
		
		<table  cellspacing="0" cellpadding="0" border="0" class="display" id="tabla3">
			<thead>
				<tr class='letraDetalleLightBox'>
					<th style='width:40px;'>Código</th>
					<th style='width:450px;'>Trabajador</th>
				</tr>
			</thead>
			<tbody>			
                <?php foreach($empleados as $empleado):?>
                    <tr class='letraDetalleLightBox'>
                        <td style='width:40px;'> <?= $empleado["idEmpleado"] ?></td>
                        <td style='width:450px;'> <?= $empleado["empleado"]?></td>
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
<!-- ... fin  lightbox trabajadores ... -->


