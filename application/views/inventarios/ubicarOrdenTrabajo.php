<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.css"/>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery-ui-1.8.20.custom.min.js"></script>

<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>"> <!-- una de las librerias de bootstarp para manejar fecha-->

<style type="text/css" >
	/*   light box material */
	.pedido-dialog {width:500px; }
	#pedidoModal{padding-top:30px;padding-left:420px;}  /* ... baja la ventana modal más al centro vertical ... */
	
	.cuerpoCabeceraReporteSalida{margin: 2px;}
    
	/* Fix alignment issue of label on extra small devices in Bootstrap 3.2 */
    .form-horizontal .control-label{padding-top: 7px;}
    
    .tituloReporte{font-size:9px; margin-top:10px; }
    
	#cuerpo{margin:0 auto; padding:0; width:700px; height:140px;}
	
	.letraDetalleLightBox{font-size:10px;margin-top:1px;text-align:left;}
</style>

<script>

$(document).ready(function(){
	/*  inicio de light box  pedido javascript */
	$('#inputOrden').click(function(){
  		var title = $(this).attr("title");
		$('.modal-title').html(title);
  		$('#pedidoModal').modal({show:true});
	});
	/*  fin de light box pedido javascript  */	
		
		
	$("#btnAsignar").click(function(){
		if($("#inputOrden").val()==""){
    		alert("¡¡¡ E R R O R !!! ... El contenido de ORDEN está vacío, seleccione una orden de trabajo");	
    	}else{
    		$("#form_").submit(); // ...  va a la funcion generarReporteSalida ...
    	}
	});
	
	$('#tabla1').dataTable();
    
     $('#tabla1 tbody').on('click', 'tr', function () {	
    	var codigoPedido = $('td', this).eq(0).text();
    	var secuencia = $('td', this).eq(1).text();
  		var trabajador = $('td', this).eq(2).text();
  		
  		var codigoProducto = $('td', this).eq(3).text();
  		
  		var cantidadProducto = $('td', this).eq(4).text();
  		var unidad = $('td', this).eq(5).text();
  		
		$('#inputOrden').val(codigoPedido+'-'+secuencia);
		$('#inputTrabajador').val(trabajador);
		$('#codigoProducto').val(codigoProducto);	
		$('#cantidadProducto').val(cantidadProducto);
		
    	$('#pedidoModal').modal('hide'); // cierra el lightBox
    	   	
	} ); // fin #tabla1 tbody

	
}); // fin document.ready 


</script>

<div class="jumbotron" id="cuerpo" >	
		
	<div class="cuerpoCabeceraReporteSalida">
		
	    <form class='form-horizontal' method='post' action='<?=base_url()?>materiales/salidaMaterialProductoAcabado' id='form_' name='form_' >
	    	<div style="height:2px;"></div>
			<p align="center" class="tituloReporte" ><span class="label label-default"> <?= $titulo ?> </span></p>
	
		   <div class="row">
		   	
			   	<div class="col-xs-1 col-md-1"> 
					<span></span>
			   	</div>
				     
		  	   	<div class="col-xs-2">
					<div class="input-group input-group-sm" >
			    		<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-tag"></span></span>
	    	 			<input type="text"  class="form-control input-sm" id="inputOrden" name="inputOrden" title='Seleccionar un &iacute;tem de pedido de la tabla PEDIDOPRODUCTO' readonly="readonly" placeholder="orden #&hellip;" style="background-color:#d9f9ec;width:90px;font-size:11px;text-align:center;" >
	    			</div>
	    		</div><!-- /.col-lg-2 -->
	    		
    			<div class="col-xs-1"> 
					<span></span>
			   	</div>	
			     
				<div class="col-xs-4">
					<div class="input-group input-group-sm">
			    		<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-user"></span></span>
	    	 			<input type="text"  class="form-control input-sm" id="inputTrabajador" name="inputTrabajador"  readonly='readonly' placeholder="trabajador&hellip;" style="width:250px;font-size:11px;text-align:center;" >
	    			</div>
	    		</div><!-- /.col-lg-4 -->	
	    		
	    		<div class="col-xs-1"> 
					<span></span>
			   	</div>		
			    			     	
			    <div class="col-xs-6 col-md-2"> 
			    	<button type="button" id="btnAsignar" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-tag"></span> Asignar</button>
			    </div>
			    
			</div><!-- /.row -->
			
			<div style="height:10px;"></div>
			<div class="row">
		   	
			   	<div class="col-xs-1"> 
					<span></span>
			   	</div>
				     
		  	   	<div class="col-xs-3">
					<div class="input-group input-group-sm" >	
			    		<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-tags"></span></span>
	    	 			<input type="text" class="form-control input-sm" id="codigoProducto" name="codigoProducto" readonly="readonly" placeholder="c&oacute;digo producto&hellip;" style="font-size:11px;text-align:center;">
	    			</div>
	    		</div><!-- /.col-lg-2 -->	
	    		
	    		<div class="col-xs-1"> 
					<span></span>
			   	</div>
	    	    
				<div class="col-xs-3">
					<div class="input-group input-group-sm">
			    		<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-sound-5-1"></span></span>
	    	 			<input type="text"  class="form-control input-sm" id="cantidadProducto" name="cantidadProducto" readonly='readonly' placeholder="cantidad &hellip;" style="font-size:11px;text-align:center;" >
	    			</div>
	    		</div><!-- /.col-lg-4 -->	
			    
			    <div class="col-xs-1 col-md-1"> 
					<span></span>
			   	</div>
			   				     	
			    <div class="col-xs-2"> 
					<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			    
			</div><!-- /.row -->
			
			<!--input type="hidden"  name="codTrabajador"  /-->				<!--  codTrabajador  -->
			
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
					<th style='width:48px;'># Orden</th>
					<th style='width:8px;text-align:left'>Item</th>
					<th style='width:160px;'>Trabajador</th>
					<th style='width:10px;'>C&oacute;digo</th>
					<th style='width:15px;'>Cantidad</th>
					<th style='width:5px;'>Unidad</th>
				</tr>
			</thead>
			<tbody>		
				<!--?php foreach($pedidos as $pedido):?-->	
                <?php foreach($pedidos->result() as $pedido){?>
                    <tr class='letraDetalleLightBox'>
                        <td style='width:50px;text-align:right'> <?= $pedido->numeroPedido ?></td>
                        <td style='width:25px;text-align:left' ><?= $pedido->secuencia  ?></td>
                        <td style='width:165px;'> <?= $pedido->trabajador ?></td>
                        <td style='width:45px;text-align:right' > <?= $pedido->idProducto ?></td>                       
   						<td style='width:55px;text-align:right' ><?= $pedido->cantidad  ?></td>
   						<td style='width:35px;text-align:right' ><?= $pedido->unidad  ?></td>
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
