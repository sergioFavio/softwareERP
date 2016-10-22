<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.css"/>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery-ui-1.8.20.custom.min.js"></script>

<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>"> <!-- una de las librerias de bootstarp para manejar fecha-->

<style type="text/css" >
	/*   light box material */
	.material-dialog {width:580px;}
	#materialModal{padding-left:350px;}  /* ... baja la ventana modal más al centro vertical ... */
	
	.cuerpoCabeceraReporteSalida{margin: 2px;}
    
	/* Fix alignment issue of label on extra small devices in Bootstrap 3.2 */
    .form-horizontal .control-label{padding-top: 7px;}
    
    .tituloReporte{font-size:9px; margin-top:10px; }
    
	#cuerpo{margin:0 auto; padding:0; width:730px; height:140px;}
	
	#inputFechaInicial, #inputFechaFinal, #letraCabecera{font-size:11px;text-align:center; }
	.inputFechaInicial, .inputFechaFinal{font-size:11px;text-align:center; }  
	 
	.fechaInicial, .fechaFinal{font-size:11px;text-align:center; }  
	
	.letraDetalleLightBox{font-size:10px;margin-top:1px;text-align:left;}
</style>

<script>

$(document).ready(function() {
	
	/*  inicio de light box  producto javascript */
	$('#inputCodigo').click(function(){
  		var title = $(this).attr("title");
		$('.modal-title').html(title);
  		$('#materialModal').modal({show:true});
	});
	/*  fin de light box producto javascript  */	
	
	
	$("#btnGenerarReporteKardex").click(function(){
	// valida fechas y luego genera reporte de salida ...
    	validarFechaMayorQue($("#inputFechaInicial").val(), $("#inputFechaFinal").val());
	});
	
	
	$('#tabla1').dataTable();
    
    $('#tabla1 tbody').on('click', 'tr', function () {	
    	var codigoProducto = $('td', this).eq(0).text();
    	var nombreProducto = $('td', this).eq(1).text();
    	var existencia = $('td', this).eq(2).text();
  		var unidad = $('td', this).eq(3).text();
  		
		$('#inputCodigo').val(codigoProducto);
		$('#inputDescripcion').val(nombreProducto);
		document.form_.existencia.value=existencia;  // ... existencia  variable hidden formulario...
		document.form_.unidad.value=unidad;  		 // ... unidad  variable hidden formulario...
		
    	$('#materialModal').modal('hide'); // cierra el lightBox
  
	} ); // fin #tabla1 tbody
	  
}); // fin document.ready 
		
	
	function validarFechaMayorQue(fechaInicial,fechaFinal){
		
		if($("#inputFechaInicial").val()=="" ||  $("#inputFechaFinal").val()=="" || $("#inputCodigo").val()==""  ){
			alert("¡¡¡ E R R O R !!! ... El contenido de FECHA está vacío, seleccione una fecha ó no se ha seleccionado ningún código de material todavía.");	
		}else{
			var fechaInicio = fechaInicial;
		 	var fechaFin = fechaFinal;
		 	
			fechaInicio = fechaInicial.split('-');
		 	fechaFin = fechaFinal.split('-');
		                    
		 	fechaInicio = new Date(fechaInicio[0], fechaInicio[1] - 1, fechaInicio[2]).valueOf();
		 	fechaFin = new Date(fechaFin[0], fechaFin[1] - 1, fechaFin[2]).valueOf();
		
	        // Verificamos que la fecha no sea posterior a la actual
	        
	        if(fechaInicio > fechaFin)
	        {	
	   			alert(" ¡¡¡... ERROR ... !!! La fecha final "+$("#inputFechaFinal").val()+" NO es superior a la fecha inicial "+$("#inputFechaInicial").val()  );   	
	        }else{
	        	$("#form_").submit(); // ...  va a la funcion generarReporteSalida ...
	        }
		}
					                                	
	}   // fin ... validarFechas ...

</script>

<div class="jumbotron" id="cuerpo" >	
		
	<div class="cuerpoCabeceraReporteSalida">
		
	    <form class='form-horizontal' method='post' action='<?=base_url()?>materiales/kardexMaterial' id='form_' name='form_' >
	    	<div style="height:2px;"></div>
			<p align="center" class="tituloReporte" ><span class="label label-success"> <?= $titulo ?> </span></p>
	
		   <div class="row">
		   	
			   	<div class="col-xs-1"> 
					<span></span>
			   	</div>
				     
		  	   	<div class="col-xs-4">
			    	<div class="input-group input-group-sm">
			    		 <span class="input-group-addon" id="letraCabecera" >Fecha Inicial </span>
			    	 	<input type="date"  class="form-control" id="inputFechaInicial" name="inputFechaInicial" placeholder="Fecha Inicial" style="width: 135px; height:30px;" >
			    	</div>
			    </div><!-- /.col-lg-4 -->	
				     
				<div class="col-xs-4">    
			    	<div class="input-group input-group-sm">
			    		 <span class="input-group-addon" id="letraCabecera"  >Fecha Final </span>
			    		<input type="date" class="form-control" id="inputFechaFinal" name="inputFechaFinal" placeholder="Fecha Final" style="width: 135px; height:30px;" >
			    	</div>
			    </div><!-- /.col-lg-6 -->	
			    			     	
			    <div class="col-xs-2"> 
			    	<button type="button" id="btnGenerarReporteKardex" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-eye-open"></span> Ver Reporte</button>
			    </div>
			    
			</div><!-- /.row -->
			
			<div style="height:10px;"></div>
			
			<div class="row">
		   	
			   	<div class="col-xs-1"> 
					<span></span>
			   	</div>
				     
		  	   	<div class="col-xs-2">
					<div class="input-group input-group-sm" >
			    		<span class="input-group-addon" id="letraCabecera" >C&oacute;digo </span>
	    	 			<input type="text"  class="form-control input-sm" id="inputCodigo" name="inputCodigo" title='Seleccionar material de la tabla de ALMACEN' readonly="readonly" placeholder="c&oacute;digo&hellip;" style="background-color:#d9f9ec;width:90px;font-size:11px;text-align:center;" >
	    			</div>
	    		</div><!-- /.col-lg-2 -->	
	    		
	    		<div class="col-xs-1"> 
					<span></span>
			   	</div>
	    	    
				<div class="col-xs-4">
					<div class="input-group input-group-sm">
			    		<span class="input-group-addon" id="letraCabecera" >Descripci&oacute;n </span>
	    	 			<input type="text"  class="form-control input-sm" id="inputDescripcion" name="inputDescripcion"  readonly='readonly' placeholder="descripci&oacute;n&hellip;" style="width: 250px;font-size:11px;text-align:center;" >
	    			</div>
	    		</div><!-- /.col-lg-4 -->	
			    
			    <div class="col-xs-2"> 
					<span></span>
			   	</div>
			   				     	
			    <div class="col-xs-2"> 
					<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			    
			</div><!-- /.row -->
			
			<input type="hidden"  name="existencia"  />			<!--  existencia  -->
			<input type="hidden"  name="unidad"  />				<!--  unidad  -->
	    </form>
	</div>
	
</div>


<!-- ... inicio  lightbox material... -->

<div id="materialModal"  class="modal fade" tabindex="-1" role="dialog" >
  <div class="material-dialog"  >
  <div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h4 class="modal-title">cabecera de caja luz</h4>
	</div>
	<div class="modal-body">
		
		<table  cellspacing="0" cellpadding="0" border="0" class="display" id="tabla1">
			<thead>
				<tr class='letraDetalleLightBox'>
					<th style='width:40px;'>Cod Material</th>
					<th style='width:450px;'>Material</th>
					<th style='width:60px;'>Existencia</th>
					<th style='width:30px;'>Unidad</th>
				</tr>
			</thead>
			<tbody>			
                <?php foreach($materiales as $material):?>
                    <tr class='letraDetalleLightBox'>
                        <td style='width:40px;'> <?= $material["codInsumo"] ?></td>
                        <td style='width:450px;'> <?= $material["nombreInsumo"]?></td>
                        <td style='width:70px;'> <?= $material["existencia"]?></td>
   						<td style='width:30px;' ><?= $material['unidad']  ?></td>
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
<!-- ... fin  lightbox material... -->
