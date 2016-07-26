<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.css"/>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery-ui-1.8.20.custom.min.js"></script>

<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>"> <!-- una de las librerias de bootstarp para manejar fecha-->

<style type="text/css" >
	/*   light box material */
	.pedido-dialog {width:900px;}
	#pedidoModal{padding-top:30px;padding-left:300px;}  /* ... baja la ventana modal más al centro vertical ... */
	
	.trabajador-dialog {width:500px;}
	#trabajadorModal{padding-top:20px;padding-left:400px;}  /* ... baja la ventana modal más al centro vertical ... */

	
	.cuerpoCabeceraReporteSalida{margin: 2px;}
    
	/* Fix alignment issue of label on extra small devices in Bootstrap 3.2 */
    .form-horizontal .control-label{padding-top: 7px;}
    
    .tituloReporte{font-size:9px; margin-top:10px; }
    
	#cuerpo{margin:0 auto; padding:0; width:820px; height:140px;}
	
	#inputFechaInicial, #inputFechaFinal, #letraCabecera{font-size:11px;text-align:center; }
	.inputFechaInicial, .inputFechaFinal{font-size:11px;text-align:center; }  
	 
	.fechaInicial, .fechaFinal{font-size:11px;text-align:center; }  
	
	.letraDetalleLightBox{font-size:10px;margin-top:1px;text-align:left;}
</style>

<script>

$(document).ready(function() {
	
	/*  inicio de light box  pedido javascript */
	$('#inputCodigo').click(function(){
  		var title = $(this).attr("title");
		$('.modal-title').html(title);
  		$('#pedidoModal').modal({show:true});
	});
	/*  fin de light box pedido javascript  */	
	
	$('#inputTrabajador').click(function(){
  		var title = $(this).attr("title");
		$('.modal-title').html(title);
  		$('#trabajadorModal').modal({show:true});
	});
	
	$("#btnAsignar").click(function(){
	// valida fechas y luego genera reporte de salida ...
    	validarFechaMayorQue($("#inputFechaInicial").val(), $("#inputFechaFinal").val());
	});
	
	$('#tabla1').dataTable();
    
    $('#tabla1 tbody').on('click', 'tr', function () {	
    	var codigoPedido = $('td', this).eq(0).text();
    	var codigoProducto = $('td', this).eq(1).text();
  		var producto = $('td', this).eq(2).text();
  		var color = $('td', this).eq(3).text();
  		var cantidad = $('td', this).eq(4).text();
  		var unidad = $('td', this).eq(5).text();
  		var secuencia = $('td', this).eq(6).text();
  		
		$('#inputCodigo').val(codigoPedido);
		document.form_.codigoProducto.value=codigoProducto;  	// ... codigoProducto  variable hidden formulario...
		document.form_.producto.value=producto;  				// ... producto  variable hidden formulario...
		document.form_.color.value=color;  						// ... color  variable hidden formulario...
		document.form_.cantidad.value=cantidad;  				// ... cantidad  variable hidden formulario...
		document.form_.unidad.value=unidad;  					// ... unidad  variable hidden formulario...
		document.form_.secuencia.value=secuencia;  				// ... secuencia  variable hidden formulario...
		
    	$('#pedidoModal').modal('hide'); // cierra el lightBox
  
	} ); // fin #tabla1 tbody
	
	
	$('#tabla2').dataTable();
    
    $('#tabla2 tbody').on('click', 'tr', function () {	
    	var codigoTrabajador = $('td', this).eq(0).text();
    	var nombreTrabajador = $('td', this).eq(1).text();
  		
		$('#inputTrabajador').val(nombreTrabajador);
		document.form_.codTrabajador.value=codigoTrabajador;  // ... codTrabajador  variable hidden formulario...
    	$('#trabajadorModal').modal('hide'); // cierra el lightBox
  
	} ); // fin #tabla2 tbody
	
	
}); // fin document.ready 
	
	function validarFechaMayorQue(fechaInicial,fechaFinal){
		
		if($("#inputFechaInicial").val()=="" ||  $("#inputFechaFinal").val()=="" || $("#inputCodigo").val()==""  ){
			alert("¡¡¡ E R R O R !!! ... El contenido de FECHA está vacío, seleccione una fecha ó no se ha seleccionado ningún número de pedido todavía.");	
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
		
	    <form class='form-horizontal' method='post' action='<?=base_url()?>produccion/ordenTrabajo' id='form_' name='form_' >
	    	<div style="height:2px;"></div>
			<p align="center" class="tituloReporte" ><span class="label label-default"> <?= $titulo ?> </span></p>
	
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
			    	<button type="button" id="btnAsignar" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-tag"></span> Asignar</button>
			    </div>
			    
			</div><!-- /.row -->
			
			<div style="height:7px;"></div>
			<div class="row">
		   	
			   	<div class="col-xs-1 col-md-1"> 
					<span></span>
			   	</div>
				     
		  	   	<div class="col-lg-2">
					<div class="input-group input-group-sm" >
			    		<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-tag"></span></span>
	    	 			<input type="text"  class="form-control input-sm" id="inputCodigo" name="inputCodigo" title='Seleccionar un &iacute;tem de pedido de la tabla PEDIDOPRODUCTO' readonly="readonly" placeholder="# pedido&hellip;" style="background-color:#d9f9ec;width:90px;font-size:11px;text-align:center;" >
	    			</div>
	    		</div><!-- /.col-lg-2 -->	
	    		
	    		<div class="col-xs-1 col-md-1"> 
					<span></span>
			   	</div>
	    	    
				<div class="col-lg-4">
					<div class="input-group input-group-sm">
			    		<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-user"></span></span>
	    	 			<input type="text"  class="form-control input-sm" id="inputTrabajador" name="inputTrabajador" title='Seleccionar trabajador de la tabla de PRODMANOOBRA' readonly='readonly' placeholder="trabajador&hellip;" style="background-color:#d9f9ec;width: 250px;font-size:11px;text-align:center;" >
	    			</div>
	    		</div><!-- /.col-lg-4 -->	
			    
			    <div class="col-xs-1 col-md-1"> 
					<span></span>
			   	</div>
			   				     	
			    <div class="col-xs-2"> 
					<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			    
			</div><!-- /.row -->
			
			<input type="hidden"  name="codTrabajador"  />				<!--  codTrabajador  -->
			<input type="hidden"  name="codigoProducto"  />				<!--  codigoProducto  -->
			<input type="hidden"  name="producto"  />					<!--  producto  -->
			<input type="hidden"  name="color"  />						<!--  color  -->
			<input type="hidden"  name="cantidad"  />					<!--  cantidad  -->
			<input type="hidden"  name="unidad"  />						<!--  unidad  -->
			<input type="hidden"  name="secuencia"  />					<!--  secuencia  -->
			
	    </form>
	</div>
	
</div>


<!-- ... inicio  lightbox pedidos... -->

<div id="pedidoModal"  class="modal fade" tabindex="-1" role="dialog" >
  <div class="pedido-dialog"  >
  <div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h4 class="modal-title">cabecera de caja luz</h4>
	</div>
	<div class="modal-body">
		
		<table  cellspacing="0" cellpadding="0" border="0" class="display compact" id="tabla1">
			<thead>
				<tr class='letraDetalleLightBox'>
					<th style='width:10px;'># Pedido</th>
					<th style='width:10px;'>C&oacute;digo</th>
					<th style='width:160px;'>Producto</th>
					<th style='width:80px;'>Color</th>
					<th style='width:15px;'>Cantidad</th>
					<th style='width:5px;'>Unidad</th>
					<th style='width:5px;'>Item</th>
				</tr>
			</thead>
			<tbody>		
				<!--?php foreach($pedidos as $pedido):?-->	
                <?php foreach($pedidos->result() as $pedido){?>
                    <tr class='letraDetalleLightBox'>
                        <td style='width:10px;'> <?= $pedido->numeroPedido ?></td>
                        <td style='width:10px;'> <?= $pedido->idProducto ?></td>
                        <td style='width:165px;'> <?= $pedido->descripcion ?></td>
                        <td style='width:80px;'> <?= $pedido->color ?></td>
   						<td style='width:15px;' ><?= $pedido->cantidad  ?></td>
   						<td style='width:5px;' ><?= $pedido->unidad  ?></td>
   						<td style='width:5px;' ><?= $pedido->secuencia  ?></td>
                    </tr>
                <?php } ?>
                <!--?php endforeach ?-->
			</tbody>
		</table>
		
	</div>
	<div class="modal-footer">
		<button class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-off"></span> Cerrar</button>
	</div>
   </div>
  </div>
</div>
<!-- ... fin  lightbox pedidos... -->

<!-- ... inicio  lightbox trabajadores... -->

<div id="trabajadorModal"  class="modal fade" tabindex="-1" role="dialog" >
  <div class="trabajador-dialog"  >
  <div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h4 class="modal-title">cabecera de caja luz</h4>
	</div>
	<div class="modal-body">
		
		<table  cellspacing="0" cellpadding="0" border="0" class="display" id="tabla2">
			<thead>
				<tr class='letraDetalleLightBox'>
					<th style='width:20px;'>C&oacute;digo</th>
					<th style='width:150px;'>Trabajador</th>
					<th style='width:20px;'>categor&iacute;a</th>
				</tr>
			</thead>
			<tbody>			
                <?php foreach($trabajadores as $trabajador):?>
                    <tr class='letraDetalleLightBox'>
                        <td style='width:20px;'> <?= $trabajador["idEmpleado"] ?></td>
                        <td style='width:150px;'> <?= $trabajador["empleado"]?></td>
                        <td style='width:20px;'> <?= $trabajador["categoria"]?></td>
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
<!-- ... fin  lightbox trabajadores... -->
