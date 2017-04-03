<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>">

<style type="text/css" >

	.cuerpoCabeceraReporteSalida{margin: 2px;}
    
	/* Fix alignment issue of label on extra small devices in Bootstrap 3.2 */
    .form-horizontal .control-label{padding-top: 7px;}
    
    .tituloReporte{font-size:9px; margin-top:10px; }
    
	#cuerpo{margin:0 auto; padding:0; width:820px; height:140px;}
	
	#inputFechaInicial, #inputFechaFinal, #letraCabecera{font-size:11px;text-align:center; }
	.inputFechaInicial, .inputFechaFinal{font-size:11px;text-align:center; }  
	 
	.fechaInicial, .fechaFinal{font-size:11px;text-align:center; }  
	
</style>

<script>

$(document).ready(function() {
	
	$("#btnGenerarReporteSalida").click(function(){
	// valida fechas y luego genera reporte de salida ...
    	validarFechaMayorQue($("#inputFechaInicial").val(), $("#inputFechaFinal").val());
	});
	  
}); // fin document.ready 
		
	
	function validarFechaMayorQue(fechaInicial,fechaFinal){
		
		if($("#inputFechaInicial").val()=="" ||  $("#inputFechaFinal").val()==""  ){
			alert("¡¡¡ E R R O R !!! ... El contenido de FECHA está vacío, seleccione una fecha");	
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
	<?php 
		if($local=='F'){
			$reporte='generarReporteDepositos';
		}else{
			$reporte='generarReporteNumeroDeposito';
		}
	?>	
		
	<div class="cuerpoCabeceraReporteSalida">
	    <form class='form-horizontal' method='post' action='<?=base_url()?>tienda/<?=$reporte?>' id='form_' name='form_' >
	    	<div style="height:2px;"></div>
			<p align="center" class="tituloReporte" ><span class="label label-default"> Fechas reporte Dep&oacute;sitos </span></p>
	
		   <div class="row">
		   	
			   	<div class="col-xs-1 col-md-1"> 
					<span></span>
			   	</div>
				     
		  	   	<div class="col-lg-4">
			    	<div class="input-group input-group-sm">
			    		 <span class="input-group-addon" id="letraCabecera" >Fecha Inicial </span>
			    	 	<input type="date"  class="form-control" id="inputFechaInicial" name="inputFechaInicial" placeholder="Fecha Inicial" style="width: 135px; height:30px;" >
			    	</div>
			    </div><!-- /.col-lg-4 -->	
				     
				<div class="col-lg-4">    
			    	<div class="input-group input-group-sm">
			    		 <span class="input-group-addon" id="letraCabecera"  >Fecha Final </span>
			    		<input type="date" class="form-control" id="inputFechaFinal" name="inputFechaFinal" placeholder="Fecha Final" style="width: 135px; height:30px;" >
			    	</div>
			    </div><!-- /.col-lg-6 -->	
			    			     	
			    <div class="col-xs-6 col-md-2"> 
			    	<button type="button" id="btnGenerarReporteSalida" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-eye-open"></span> Ver Reporte</button>
			    </div>
			    
		</div><!-- /.row -->
			<!--input type="hidden"  name="nombreDeposito" value="<?= $nombreDeposito ?>" />     <!--  nombreDeposito: almacen/bodega -->
	    </form>
	</div>
	
	<div style="height:5px;"></div>
	
	<div style="text-align: right; padding-top: 2px;"> 
		<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
	
</div>



