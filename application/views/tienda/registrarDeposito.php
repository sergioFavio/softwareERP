<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>">

<style type="text/css" >

	.cuerpoCabeceraReporteSalida{margin: 2px;}
    
	/* Fix alignment issue of label on extra small devices in Bootstrap 3.2 */
    .form-horizontal .control-label{padding-top: 7px;}
    
    .tituloReporte{font-size:9px; margin-top:10px; }
    
	#cuerpo{margin:0 auto; padding:0; width:725px; height:285px;}
	
	#inputFecha, #letraCabecera{font-size:11px;text-align:center; }
	
	#titulo{font-size:16px;margin-top:1px;  text-align:right; font-weight:bold} 
	
</style>

<script>

$(document).ready(function() {
	
	$("#btnBorrarDeposito").click(function(){
        	borrarFormularioDeposito();
    });	
    
    $("#btnGrabarDeposito").click(function(){
		//... grabar comprobante ...
    	grabarDeposito();
	});
	  
}); // fin document.ready 

	function borrarFormularioDeposito(){
	//...esta funcion borra los datos del formularioDeposito
		document.getElementById("inputTipoPago1").checked = true;		//... resetea el button radio al primer valor ...
		$("#inputFecha").val("");
	    $("#inputBanco").val("");
	    $("#numCheque").val("");
	    $("#numDeposito").val("");
	    $("#numPedido").val("");
		$("#tipoDocumento").val("");
		$("#facturaRecibo").val("");
		$("#montoDeposito").val("");
		$("#glosaDeposito").val("");
	} // fin funcion borrarFormularioDeposito
	
	
	function validarNumero(numero,campo){	
		// ... valida ingreso de numeros para telefono/celular y NIT 
		if($("#numPedido").val()==""){
			alert("¡¡¡ ERROR !!! Primero registre un NÚMERO DE PEDIDO");
			$("#"+campo).val("");   // borra celda de glosa			
		}else{
	    	if (!/^([0-9])*$/.test(numero)){  // ... solo numeros enteros ...  
	    	//if (!/^\d{1,7}(\.\d{1,2})?$/.test(numero)){  // ...hasta 5 digitos parte entera y hasta 2 parte decimal ...
	    		alert("El valor " + numero + " no es válido");
	    		$("#"+campo).val("");   // borra celda de aCuenta
	    	}	//...fin IF ...
    	}	//... fin IF numPediddo ...
	}   // fin ... validarNumero ...
	
	function validarGlosa(numero, campo){
			
	if($("#numPedido").val()==""){
		alert("¡¡¡ ERROR !!! Primero registre un NÚMERO DE PEDIDO para ingresar glosa.");
		$("#"+campo).val("");   // borra celda de glosa			
	}
}   // fin ... validarGlosa ...
		
	
	function validarMonto(numero,campo){	
		if($("#numPedido").val()==""){
			alert("¡¡¡ ERROR !!! Primero registre NÚMERO DE PEDIDO para ingresar monto.");
			$("#"+campo).val("");   // borra celda de cantidad
						
		}else{
	    	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
	    	if (!/^\d{1,9}(\.\d{1,3})?$/.test(numero)){  // ...hasta 4 digitos parte entera y hasta 3 parte decimal ...
	    		alert("El valor " + numero + " no es válido");
	    		$("#"+campo).val("");   // borra celda de cantidad
	    	}else{
	    		var cantidad=$("#"+campo).val();
		   		cantidad=parseFloat(cantidad);
	    		$("#"+campo).val( separadorMiles( cantidad.toFixed(2) ) );   //... actualiza cantHaber
	    	}
		    		
		}
	}   // fin ... validarMonto ...
	
	function separadorMiles(n){
	    var rx=  /(\d+)(\d{3})/;
	    return String(n).replace(/^\d+/, function(w){
	        while(rx.test(w)){
	            w= w.replace(rx, '$1,$2');
	        }
	        return w;
	    });
	}
	
	function grabarDeposito(){
		var i=0;
		var registrosValidos= true;	  // ... bandera para grabar o no grabar registros ...
		
		if($("#inputFecha").val()=="" ){
				alert("¡¡¡ E R R O R !!! ... El contenido de FECHA está vacío, seleccione una fecha");
				var registrosValidos= false;	
		}
		
		if($("#numPedido").val()=="" ){
				alert("¡¡¡ E R R O R !!! ... El contenido de NÚMERO PEDIDO está vacío");
				var registrosValidos= false;	
		}
		
		if($("#facturaRecibo").val()=="" ){
				alert("¡¡¡ E R R O R !!! ... El contenido de NÚMERO FACTURA/RECIBO está vacío");
				var registrosValidos= false;	
		}
		
		if($("#montoDeposito").val()=="" ){
				alert("¡¡¡ E R R O R !!! ... El contenido de MONTO está vacío");
				var registrosValidos= false;	
		}
		
		if($("#glosaDeposito").val()=="" ){
				alert("¡¡¡ E R R O R !!! ... El contenido de GLOSA está vacío");
				var registrosValidos= false;	
		}
					
		if(!registrosValidos){
			alert('Corrija los campos que están vacíos');
		}else{
			$("#form_").submit(); // ...  graba registros ...
		}
				
	}	// ... fin funcion grabarDeposito() ...

</script>

<div class="jumbotron" id="cuerpo" >	
		
	<div class="cuerpoCabeceraReporteSalida">
	    <form class='form-horizontal' method='post' action='<?=base_url()?>tienda/grabarDeposito' id='form_' name='form_' >
	    	<div style="height:2px;"></div>
			<p align="center" class="tituloReporte" ><span class="label label-success"> Registrar Dep&oacute;sito No. <?= $secuenciaDeposito.' / '.$anhoSistema ?></span></p>
							
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
				  
				  <div class="col-xs-0"> 
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
	    	 		<select class = "form-control input-sm" id="inputBanco" name="inputBanco" style="width:160px;font-size:11px;text-align:center;">
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
	    	 		<input type="text"  class="form-control input-sm" id="numCheque" name="numCheque" placeholder="cheque No.&hellip;" style="width: 120px;font-size:11px;text-align:center;" onChange='validarNumero(this.value,"numCheque");'>
	    		</div>
			</div><!-- /.col-md-2 -->
			
			<div class="col-xs-1"> 
				<span></span>
		   	</div>
		   	
		   	<div class="col-xs-2">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-pushpin"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="numDeposito" name="numDeposito" placeholder="dep&oacute;sito No.&hellip;" style="width: 120px;font-size:11px;text-align:center;" onChange='validarNumero(this.value,"numDeposito");' >
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
	    	 		<input type="text"  class="form-control input-sm" id="numPedido" name="numPedido" placeholder="pedido No.&hellip;" style="width: 120px;font-size:11px;text-align:center;" onChange='validarNumero(this.value,"numPedido");' >
	    		</div>
			</div><!-- /.col-md-2 -->
			
			<div class="col-xs-2"> 
				<span></span>
		   	</div>
		   	
		   		<div class="col-xs-1">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-tags"></span></span>
	    	 		<select class = "form-control input-sm" id="tipoDocumento" name="tipoDocumento" style="width:90px;font-size:11px;text-align:center;">
				         <option value="F">Factura </option>
				         <option value="R">Recibo</option>
		        	</select>
	    		</div>
			</div><!-- /.col-md-2 -->
			
			<div class="col-xs-2"> 
				<span></span>
		   	</div>
		   	
		   	<div class="col-xs-2">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-pushpin"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="facturaRecibo" name="facturaRecibo" placeholder="factura/recibo No.&hellip;" style="width: 120px;font-size:11px;text-align:center;" onChange='validarNumero(this.value,"facturaRecibo");' >
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
	    	 		<input type="text"  class="form-control input-sm" id="montoDeposito" name="montoDeposito" placeholder="monto Bs. &hellip;" style="width: 120px;font-size:11px;text-align:center;" onChange='validarMonto(this.value,"montoDeposito");' >
	    		</div>
			</div><!-- /.col-md-2 -->
			
			<div class="col-xs-2"> 
				<span></span>
		   	</div>
		   	
		   	<div class="col-xs-3">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-comment"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="glosaDeposito" name="glosaDeposito" placeholder="glosa&hellip;" style="width: 308px;font-size:11px;text-align:center;" onChange='validarGlosa(this.value,"glosaDeposito");' >
	    		</div>
			</div><!-- /.col-md-2 -->
		
		</div><!-- /.row -->
		
		<div style="height:15px;"></div>
		
		   <input type="hidden"  name="numDeposito" value="<?= $deposito ?>" />     				<!--  numero deposito -->
			
		   <div style="text-align: right; padding-top: 5px;">  
		    	<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;
		        <button type="button" class="btn btn-default btn-sm"  id="btnBorrarDeposito"><span class="glyphicon glyphicon-remove"></span> Borrar</button>&nbsp;
		        <button type="button" class="btn btn-inverse btn-sm" id="btnGrabarDeposito" ><span class="glyphicon glyphicon-hdd"></span> Grabar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		   </div>
		   <div style="height:10px;"></div>
			
	    </form>
	</div>
	
</div>



