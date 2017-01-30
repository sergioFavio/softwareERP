<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>">

<style type="text/css" >

	.cuerpoCabeceraReporteSalida{margin: 2px;}
    
	/* Fix alignment issue of label on extra small devices in Bootstrap 3.2 */
    .form-horizontal .control-label{padding-top: 7px;}
    
    .tituloReporte{font-size:9px; margin-top:10px; }
    
	#cuerpo{margin:0 auto; padding:0; width:700px; height:85px;}
	
	#inputFechaInicial, #letraCabecera{font-size:11px;text-align:center; }
	.inputFechaInicial{font-size:11px;text-align:center; }  
	 
	.fechaInicial{font-size:11px;text-align:center; }  
	
</style>

<script>

$(document).ready(function() {
	
	$("#btnGenerarReporteSalida").click(function(){
	// valida fechas y luego genera reporte de salida ...
    	$("#form_").submit(); // ...  va a la funcion generarReporteMensualsalida ...
	});
	  
}); // fin document.ready 
		

</script>

<div class="jumbotron" id="cuerpo" >	
		
	<div class="cuerpoCabeceraReporteSalida">
	    <form class='form-horizontal' method='post' action='<?=base_url()?>materiales/generarListadoExistencias' id='form_' name='form_' >
			<p align="center" class="tituloReporte" ><span class="label label-success"> Seleccionar grupo Listado Existencias </span></p>
	
		    <div class="row">
			   	<div class="col-xs-1"> 
					<span></span>
			   	</div>
				     
		  	   	<div class="col-xs-4">
			    	<div class="input-group input-group-sm">
			    		<span class="input-group-addon" id="letraCabecera" >Grupo </span>
				    	<select class = "form-control input-sm" id="grupo" name="grupo" style="width:300px;font-size:11px;text-align:center;">
				    	<?php foreach($grupos->result() as $grupo){?>	
							<option value="<?= $grupo->codInsumo.'|'.$grupo->nombreInsumo; ?>"><?= $grupo->nombreInsumo; ?> </option>
						<?php } ?>         	
		        	</select>
		        	
			    	</div>
			    </div><!-- /.col-xs-4 -->	
			    
			    <div class="col-xs-3"> 
					<span></span>
			   	</div>
				     			     	
			    <div class="col-xs-1"> 
			    	<button type="button" id="btnGenerarReporteSalida" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-eye-open"></span> Ver Reporte</button>
			    </div>
			    
			    <div class="col-xs-1"> 
					<span></span>
			   	</div>
			    
			    <div class="col-xs-1""> 
					<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			    
		</div><!-- /.row -->
			
			<!--input type="hidden"  name="nombreGrupo" value="<?= $nombreGrupo ?>" />       <!--  nombreDeposito: almacen/bodega -->
			
	    </form>
	</div>
	
</div>



