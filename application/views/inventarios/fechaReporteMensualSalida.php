<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>">

<style type="text/css" >

	.cuerpoCabeceraReporteSalida{margin: 2px;}
    
	/* Fix alignment issue of label on extra small devices in Bootstrap 3.2 */
    .form-horizontal .control-label{padding-top: 7px;}
    
    .tituloReporte{font-size:9px; margin-top:10px; }
    
	#cuerpo{margin:0 auto; padding:0; width:720px; height:140px;}
	
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
		<?php
		$generar='generarReporteMensual'.$tipoTransaccion; //...variable para determinar tipo reporte ingreso/salidad ...
		?>
	    <form class='form-horizontal' method='post' action='<?=base_url()?>materiales/<?=$generar?>' id='form_' name='form_' >
	    	<div style="height:2px;"></div>
			<p align="center" class="tituloReporte" ><span class="label label-default"> Fecha reporte mensual <?= $tipoTransaccion.' '.strtoupper($nombreDeposito) ?> </span></p>
	
		   <div class="row">
		   	
			   	<div class="col-xs-2 col-md-2"> 
					<span></span>
			   	</div>
				     
		  	   	<div class="col-lg-4">
			    	<div class="input-group input-group-sm">
			    		 <span class="input-group-addon" id="letraCabecera" >Fecha Inicial </span>
			    	 	<input type="date"  class="form-control" id="inputFechaInicial" name="inputFechaInicial" placeholder="Fecha Inicial" style="width: 135px; height:30px;" >
			    	</div>
			    </div><!-- /.col-lg-4 -->	
				     			     	
			    <div class="col-xs-6 col-md-2"> 
			    	<button type="button" id="btnGenerarReporteSalida" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-eye-open"></span> Ver Reporte</button>
			    </div>
			    
			    <div class="col-xs-6 col-md-2""> 
					<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			    
		</div><!-- /.row -->
			
			<input type="hidden"  name="nombreDeposito" value="<?= $nombreDeposito ?>" />     <!--  nombreDeposito: almacen/bodega -->
			<input type="hidden"  name="tipoTransaccion" value="<?= $tipoTransaccion ?>" />     <!-- tipoTransaccion: ingreso/salida -->
			
	    </form>
	</div>
	
</div>



