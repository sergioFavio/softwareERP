
<link rel="stylesheet" type="text/css"  href="<?=base_url(); ?>css/ingresoSalidaMaterial.css" />
	
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.css"/>
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery-ui-1.8.20.custom.min.js"></script>

<script type="text/javascript" src="<?=base_url(); ?>js/ingresoSalidaMaterial.js"></script>

<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>"> <!-- una de las librerias de bootstarp para manejar fecha-->

<style type="text/css" >

.pedido-dialog {width:500px; }
#pedidoModal{padding-top:30px;padding-left:420px;}  /* ... baja la ventana modal más al centro vertical ... */


	/*  inicio de scrollbar  */
thead { display:block;  margin:0px; cell-spacing:0px; left:0px; }  
tbody { display:block; overflow:auto; height:330px; }               
th { height:10px;  width:665px;}                                    
td { height:10px;  width:665px; margin:0px; cell-spacing:0px;}
/*  fin de scrollbar  */

#cuerpoSalida{margin:0 auto;  padding:0; width:669px; background:#f4f4f4;}
.cabeceraSalida{margin:10px;}

#titulo{font-size:14px;margin-top:1px;  text-align:right;font-weight : bold}
</style>

<script>

$(document).ready(function() {
	
	$('[data-toggle="tooltip"]').tooltip(); 
	
	/*  inicio de light box  pedido javascript */
	$('#inputOrden').click(function(){
  		var title = $(this).attr("title");
		$('.modal-title').html(title);
  		$('#pedidoModal').modal({show:true});
	});
	/*  fin de light box pedido javascript  */	
	

	$('#tabla1').dataTable();
    
    $('#tabla1 tbody').on('click', 'tr', function () {	
    	var codigoPedido = $('td', this).eq(0).text();
    	var secuencia = $('td', this).eq(1).text();
  		var trabajador = $('td', this).eq(2).text();
  		
  		codigoProducto = $('td', this).eq(3).text();
  		
  		var cantidad = $('td', this).eq(4).text();
  		var unidad = $('td', this).eq(5).text();
  		
  		
		$('#inputOrden').val(codigoPedido+'-'+secuencia);
		$('#inputGlosa').val(trabajador);
		
		
		
		$('#codigoProducto').val(codigoProducto);
		$('#cantidadProducto').val(cantidad);
		
//		document.form_.codigoProducto.value=codigoProducto;  	// ... codigoProducto  variable hidden formulario...
//		document.form_.producto.value=producto;  				// ... producto  variable hidden formulario...
//		document.form_.cantidad.value=cantidad;  				// ... cantidad  variable hidden formulario...
//		document.form_.unidad.value=unidad;  					// ... unidad  variable hidden formulario...
//		document.form_.secuencia.value=secuencia;  				// ... secuencia  variable hidden formulario...
		
    	$('#pedidoModal').modal('hide'); // cierra el lightBox
  
	} ); // fin #tabla1 tbody


	
}); // fin document.ready 


</script>

	

<div class="jumbotron" id="cuerpoSalida">		
		
   <form class="form-horizontal" method="post" action="<?=base_url()?>materiales/grabarSalidaAcabado" id="form_" name="form_" >
   	  <div style="height:10px;"></div>
   	   
      <div class="cabeceraSalida">
		<div class="row-fluid">
			
	    	<div class="col-xs-2">
				<div class="input-group input-group-sm" >
			    	<span class="input-group-addon" id="letraCabecera" >Salida No. </span>
	    	 		<input type="text"  class="form-control input-sm" id="inputNumero" name="inputNumero" value="<?= $salida ?>" readonly="readonly" placeholder="salida No." style="width: 70px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	<div class="col-xs-1">
	    	 	<span></span>
	    	</div>
	    	
	    	<div class="col-xs-3">
	    	 	<span  id="titulo" class="label label-default"><?= strtoupper($titulo) ?></span>
	    	</div> 
	    	
	    	<div class="col-xs-2">
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
	    	 		<input type="text"  class="form-control input-sm" id="inputGlosa" name="inputGlosa" readonly="readonly" placeholder="trabajador&hellip;" style="width: 220px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	
	    	<div class="col-xs-2 col-md-2">
	    	 	<span></span>
	    	</div>
	    	
	    	
		    <div class="col-lg-4">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" >Orden No. </span>
	    	 		<input type="text"  class="form-control input-sm" id="inputOrden" name="inputOrden" title='Seleccionar un &iacute;tem de orden de la tabla PEDIDOPRODUCTO' readonly="readonly" placeholder="orden #&hellip;" style="background-color:#d9f9ec;width:90px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	
	    	<input type="hidden"  name="codigoProducto" >
	    	<input type="hidden"  name="cantidadProducto" >

	    	
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
    	</tr>
      </thead >
    <tbody >
    		
    	<?php
        //if ciclo de impresion de filas 
       		for($x=0; $x<25; $x++){
            	echo "<tr class='detalleMaterial' >";
           
					echo"<td  class='openLightBox' title='Seleccionar material de la tabla de $titulo' style='width: 80px; background-color: #d9f9ec;' fila=$x>
					<input type='text' name='idMat_".$x."' id='idMat_".$x."'  readonly='readonly' style='width: 60px; border:none; background-color: #d9f9ec;' /></td>";
					
                    echo "<td class='letraDetalle'  style='width: 320px; background-color: #f9f9ec;' ><input type='text' id='mat_".$x."' name='mat_".$x."' size='50' readonly='readonly' style='border:none;' /></td>";
                    
                    echo "<td style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraNumero' name='existMat_".$x."' id='existMat_".$x."' size='7' readonly='readonly' style='border:none;' /></td>";
					
                    echo "<td style='width: 80px; background-color: #d9f9ec;'><input type='text' class='letraNumeroNegrita' name='cantMat_".$x."' id='cantMat_".$x."' style='width: 80px; border:none; background-color: #d9f9ec;' onChange='validarCantidad(this.value,$x);'/></td>";  
					          
                    echo "<td style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraCentreada' name='unidadMat_".$x."' id='unidadMat_".$x."' size='7' readonly='readonly' style='border:none;'/></td>";
                echo "</tr>";
             }
         ?>
      </tbody>
  
	</table>
	
	<input type="hidden"  name="numeroFilas"  />
	<input type="hidden"  name="nombreDeposito" value="<?= $nombreDeposito ?>" />     <!--  nombreDeposito: almacen/bodega -->
	<input type="hidden"  name="codigoProducto"  />
	
	<div style="text-align: right; padding-top: 3px;">   
    	<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;
        <button type="button" class="btn btn-inverse btn-sm" id="btnGrabarSalida" ><span class="glyphicon glyphicon-hdd"></span> Grabar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   </div>
   <div style="height:10px;"></div>
   </form>
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
                        <!--td style='width:45px;text-align:right' > <?= $pedido->idProducto ?></td-->
                        
                        
                        <td style='width:45px;text-align:right' >
                        	<input type="text" class="form-control input-sm"  value='<?= $pedido->idProducto ?>' readonly='readonly' data-toggle='tooltip' title='<?= $pedido->descripcion ?>' style='font-size:9px;width:65px;text-align:right;height:12px;'>
						</td>
                        
                        
   						<td style='width:40px;text-align:right' ><?= $pedido->cantidad  ?></td>
   						<td style='width:25px;text-align:right' ><?= $pedido->unidad  ?></td>
   						
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

