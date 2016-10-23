<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>">

<style type="text/css" >

	.cuerpoCabeceraReporteSalida{margin: 2px;}
    
	/* Fix alignment issue of label on extra small devices in Bootstrap 3.2 */
    .form-horizontal .control-label{padding-top: 7px;}
    
    .tituloReporte{font-size:9px; margin-top:10px; }
    
	#cuerpo{margin:0 auto; padding:0; width:725px; height:285px;}
	
	#inputFecha, #letraCabecera{font-size:11px;text-align:center; }
	.inputFechaInicial{font-size:11px;text-align:center; }  
	 
	.fechaInicial{font-size:11px;text-align:center; }  
	
	#titulo{font-size:16px;margin-top:1px;  text-align:right; font-weight:bold} 
	
</style>

<script>

$(document).ready(function() {
	
	$("#btnGenerarReporteSalida").click(function(){
	// valida fechas y luego genera reporte de salida ...
    	validarFechaMayorQue($("#inputFechaInicial").val(), $("#inputFechaFinal").val());
	});
	  
}); // fin document.ready 
		
	
	function validarFecha(fechaInicial){
		
		if($("#inputFechaInicial").val()==""  ){
			alert("¡¡¡ E R R O R !!! ... El contenido de FECHA está vacío, seleccione una fecha");	
		}			                                	
	}   // fin ... validarFecha ...

</script>

<div class="jumbotron" id="cuerpo" >	
		
	<div class="cuerpoCabeceraReporteSalida">
	    <form class='form-horizontal' method='post' action='<?=base_url()?>materiales/generarReporteMaterialUsadoResponsable' id='form_' name='form_' >
	    	<div style="height:2px;"></div>
			<p align="center" class="tituloReporte" ><span class="label label-success"> Registrar Dep&oacute;sito No. XXXXXX - XX</span></p>
							
			<div style="height:10px;"></div>
			
			<div class="row">
		   	
			   	<div class="col-xs-1"> 
					<span></span>
			   	</div>
			   	      
			    <div class="col-xs-2"> 
					<span id="letraCabecera" >Tipo Pago: </span>
			   	</div>
			   	
			   	 <div class="col-xs-2">
				    <div class="input-group input-group-sm">
				      <span class="input-group-addon">
				        <input type="radio" id="inputTipoPago1" name="inputTipoPago" value="E" checked="checked"> 
				      </span>
				      <input type="text" class="form-control" id="letraCabecera" value="Efectivo" readonly="readonly" >
				    </div><!-- /input-group -->
				  </div><!-- /.col-xs-3 -->
				  
				   <div class="col-xs-2">
				    <div class="input-group input-group-sm">
				      <span class="input-group-addon">
				        <input type="radio" id="inputTipoPago2" name="inputTipoPago" value="C">
				      </span>
				      <input type="text" class="form-control" id="letraCabecera" value="Cheque" readonly="readonly" >
				    </div><!-- /input-group -->
				  </div><!-- /.col-xs-3 -->
				  
				  <div class="col-xs-1"> 
				  	<span></span>
				  </div>
	   			     	
		    	  <div class="col-xs-2">
			      	<div class="input-group input-group-sm">
			        	<span class="input-group-addon" id="letraCabecera" >Fecha </span>
			    	 	<input type="date"  class="form-control" id="inputFecha" name="inputFecha" placeholder="Fecha" style="width: 135px; height:30px;" >
			      	</div>
			      </div><!-- /.col-md-2 -->
				  
			</div><!-- /.row -->
			
			
			<div style="height:10px;"></div>
			
			<div class="row">
			<div class="col-xs-1"> 
				<span></span>
		   	</div>
		   	
		   	<div class="col-xs-2">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-home"></span><span class="glyphicon glyphicon-usd"></span></span>
	    	 		<select class = "form-control input-sm" id="inputCliente" name="inputCliente" style="width:160px;font-size:11px;text-align:center;">
				         <option value="BNB Caja Ahorros M.N.">BNB Caja Ahorros M.N. </option>
				         <option value="Banco Económico M.N.">Banco Económico M.N.</option>
				         <option value="Banco Económico M.E.">Banco Económico M.E.</option>
				         <option value="Banco Unión M.N.">Banco Unión M.N.</option>
		        	</select>
	    		</div>
			</div><!-- /.col-md-2 -->
			
			<div class="col-xs-2"> 
				<span></span>
		   	</div>
		   	
		   	<div class="col-xs-2">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-tag"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="responsable" name="responsable" placeholder="cheque No.&hellip;" style="width: 120px;font-size:11px;text-align:center;" >
	    		</div>
			</div><!-- /.col-md-2 -->
			
			<div class="col-xs-1"> 
				<span></span>
		   	</div>
		   	
		   	<div class="col-xs-2">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-pushpin"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="responsable" name="responsable" placeholder="dep&oacute;sito No.&hellip;" style="width: 120px;font-size:11px;text-align:center;" >
	    		</div>
			</div><!-- /.col-md-2 -->
		
		</div><!-- /.row -->
			
			<div style="height:10px;"></div>
			
			
			<div class="row">
			<div class="col-xs-1"> 
				<span></span>
		   	</div>
		   	
		   	<div class="col-xs-2">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-tag"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="responsable" name="responsable" placeholder="pedido No.&hellip;" style="width: 120px;font-size:11px;text-align:center;" >
	    		</div>
			</div><!-- /.col-md-2 -->
			
			<div class="col-xs-1"> 
				<span></span>
		   	</div>
		   	
		   	<div class="col-xs-2">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-pushpin"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="responsable" name="responsable" placeholder="factura/recibo No.&hellip;" style="width: 120px;font-size:11px;text-align:center;" >
	    		</div>
			</div><!-- /.col-md-2 -->
			
		</div><!-- /.row -->
			
		<div style="height:10px;"></div>
		
		<div class="row">
			<div class="col-xs-1"> 
				<span></span>
		   	</div>
		   	
		   	<div class="col-xs-2">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-usd"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="responsable" name="responsable" placeholder="monto Bs. &hellip;" style="width: 120px;font-size:11px;text-align:center;" >
	    		</div>
			</div><!-- /.col-md-2 -->
			
			<div class="col-xs-1"> 
				<span></span>
		   	</div>
		   	
		   	<div class="col-xs-3">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-comment"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="responsable" name="responsable" placeholder="glosa&hellip;" style="width: 330px;font-size:11px;text-align:center;" >
	    		</div>
			</div><!-- /.col-md-2 -->
		
		</div><!-- /.row -->
		
		<div style="height:15px;"></div>
		
		
			
			<!--input type="hidden"  name="nombreDeposito" value="<?= $nombreDeposito ?>" />     <!--  nombreDeposito: almacen/bodega -->
			<!--input type="hidden"  name="tipoTransaccion" value="<?= $tipoTransaccion ?>" />     <!-- tipoTransaccion: ingreso/salida -->
			
		   <div style="text-align: right; padding-top: 5px;">  
		    	<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;
		        <button type="button" class="btn btn-default btn-sm"  id="btnBorrarComprobante"><span class="glyphicon glyphicon-remove"></span> Borrar</button>&nbsp;
		        <button type="button" class="btn btn-inverse btn-sm" id="btnGrabarComprobante" ><span class="glyphicon glyphicon-hdd"></span> Grabar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		   </div>
		   <div style="height:10px;"></div>
			
	    </form>
	</div>
	
</div>



