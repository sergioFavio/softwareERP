
<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>">

<style type="text/css" >

	/*  inicio de light box  */
	.modal-dialog {width:520px;}
	.modalEditar-dialog {width:843px;}
	.thumbnail {margin-bottom:6px;}
	/*  fin de light box  */

	/*  inicio de scrollbar  */
	thead { display:block;  margin:0px; cell-spacing:0px; left:0px; }  
	tbody { display:block; overflow:auto; height:357px; }               
	th { height:10px;  width:850px;}                                    
	td { height:10px;  width:850px; margin:0px; cell-spacing:0px;}
	/*  fin de scrollbar  */
	
	#pdfModal{padding-top:60px;padding-left:261px;}  /* ... baja la ventana modal más al centro vertical ... */
	
	.cuerpoDetalle, {margin: 2px;} 
    
	/* Fix alignment issue of label on extra small devices in Bootstrap 3.2 */
    .form-horizontal .control-label{padding-top: 7px;}
    
    .tituloReporte{font-size:9px; margin-top:10px; }
    
	#cuerpoCabecera{margin:0 auto; padding:0; width:755px; height:105px;}
	#cuerpoDetalle{margin:0 auto; padding:0; width:755px; height:410px;}
	#cuerpoPaginacion{margin:0 auto;padding:0; width:755px; height:60px;}
	
	#inputBuscarPatron, #letraCabecera{font-size:11px;text-align:center; }
	
	.letraDetalle, .letraTipoMaterial{font-size:11px;text-align:center; }
	
	.letraNumero{font-size:11px;text-align:right; }
	
</style>

<script>

$(document).ready(function() {
			 	  
}); // fin document.ready 


function reportePdf(nPedido){
    var pedido= nPedido;
    
	$.ajax({
      url: "<?=base_url()?>tienda/reportePdfCrud",

      type: "POST",
      data: {numePedido: pedido},

      success: function(data){
         //alert(data);
	    //  aca deberia poner la funcion que hace el refrescado del listado	    
		$("#recargado").html(data);	   // ...etiqueta id=recargado ... en pdfModal 
	  }
	      
   });	

  $('#pdfModal').modal({show:true});
   
}  // ... fin reportePdf ...
	
</script>

<div class="jumbotron" id="cuerpoCabecera" >	<!--cuerpoCrudMaterial-->
		
	    <form class="form-horizontal" method="post" action="<?=base_url()?>tienda/buscarPedido" id="formBuscarRegistro_" name="formBuscarRegistro_" >
	    	<div style="height:2px;"></div>
			<p align="center" class="tituloReporte" ><span class="label label-default"> Ver Pedidos Tienda</span></p>
	
		   <div class="row">
		   	
			   	<div class="col-xs-2 col-md-2"> 
					<span></span>
			   	</div>
			   	     
				<div class="col-lg-6">    
			    	<div class="input-group input-group-sm">
			    		<input type="text" class="form-control input-sm" id="inputBuscarPatron" name="inputBuscarPatron" value='<?= $consultaPedido ?>' placeholder="buscar ...">
						
						
						<div class="input-group-btn">
                        	<button type="submit" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-search"></span></button>
                    	</div>
			    	</div>
			    </div><!-- /.col-lg-6 -->	
			    
			    <div class="col-xs-1 col-md-1"> 
					<span></span>
			   	</div>
			    
			    			     	
			    <div class="col-xs-2 col-md-2"> 
			    	<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			    
		</div>  <!-- /.row -->
			
	   </form>  <!--/div-->
	
</div> <!-- fin ... cuerpoCabecera -->



<div style="height:7px;"></div>

<div class="jumbotron" id="cuerpoDetalle" >

	<div style="height:5px;"></div>
	
	<table width="99%" class="table table-striped table-bordered table-condensed" id="tabla1">   		
		<thead>
    		<tr style="background-color: #b9e9ec;" class='letraDetalle'>
    			<th style="width: 80px;">&nbsp;&nbsp;&nbsp;Pedido</th>
    			<th style="width: 80px;">Fecha Entrega</th>
				<th style="width: 200px;">Cliente - Empresa</th>
				<th style="width: 80px;">Fono/Celular</th>
				<th style="width: 75px;">Fecha Pedido</th>
				<th style="width: 40px;">Estado</th>
				<th style="width: 75px;">Fecha Estado</th>
				<th style="width: 30px;">Nota Entrega</th>
				<th style="width: 62px;"></th>
    		</tr>
 		</thead>
 		
 		<tbody>	
			<?php  $posicionFila=-1; ?>			
	        <?php foreach($listaPedido as $pedido):?>
				<tr class='letraDetalle'>
				
					<?php  $posicionFila=$posicionFila+1;  //...posicionFila
		
					$numePedido = $pedido->numPedido;	
							
					 echo"<td style='width:60px;'><input type='text' id='idPedido_".$posicionFila."' name='idPedido_".$posicionFila."' value='".$pedido->numPedido."' readonly='readonly' style='border:none; width:60px;text-align:center;' /></td>";
						
					 echo"<td style='width: 60px;'><input type='text' id='fechaEntrega_".$posicionFila."' name='fechaEntrega_".$posicionFila."' value='".fechaMysqlParaLatina($pedido->fechaEntrega)."' readonly='readonly' style='border:none; width:60px;' /></td>";
							 
					 echo"<td style='width: 200px;'><input type='text' id='contactoEmpresa_".$posicionFila."' name='contactoEmpresa_".$posicionFila."' value='".$pedido->cliente."' readonly='readonly' style='border:none; width:200px;' /></td>";
						
					 echo"<td style='width: 80px;'><input type='text' id='telCel_".$posicionFila."' name='telCel_".$posicionFila."' value='".$pedido->telCel."' readonly='readonly' style='border:none; width:80px;text-align:center;' /></td>";

					 echo"<td style='width: 60px;'><input type='text' id='fechaPedido_".$posicionFila."' name='fechaPedido_".$posicionFila."' value='".fechaMysqlParaLatina($pedido->fechaPedido)."' readonly='readonly' style='border:none; width:60px;' /></td>";
					
					 echo"<td style='width: 40px;'><input type='text' id='estado_".$posicionFila."' name='estado_".$posicionFila."' value='".$pedido->estado."' readonly='readonly' style='border:none; width:40px;' /></td>";
					
					 echo"<td style='width: 60px;'><input type='text' id='fechaEstado_".$posicionFila."' name='fechaEstado_".$posicionFila."' value='".fechaMysqlParaLatina($pedido->fechaEstado)."' readonly='readonly' style='border:none; width:60px;' /></td>";
					
					 echo"<td style='width: 40px;'><input type='text' id='notaEntrega_".$posicionFila."' name='notaEntrega_".$posicionFila."' value='".$pedido->notaEntrega."' readonly='readonly' style='border:none; width:40px;' /></td>";

					 echo"<td style='width:50px;background-color:#b9e9ec;' align='left'><a href='#' onClick='reportePdf($numePedido);'><span class='glyphicon glyphicon-print'></span> PDF</a></td>";
	
				   ?>						
				</tr>
	        <?php endforeach ?>
                
			</tbody>
	</table>
	
</div> <!-- fin ... cuerpoDetalle -->

<div style="height:5px;"></div>

<div class="jumbotron" id="cuerpoPaginacion" style='font-size:11px;text-align:center;'>
	<ul class="pagination">
    <?php
      /* Se imprimen los números de página */           
      echo $this->pagination->create_links();
    ?>
    </ul>
</div>


<!-- ... inicio  lightbox reportePdf... -->

<div class="modal fade" id="pdfModal" >
  <div class="modalEditar-dialog">
    <div class="modal-content">
      <!--div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div-->
      <div class="modal-body" >
      	
			<div id="recargado">Mi texto/variable sin recargar</div> <!--  se actualiza variable en la funcion php que llama el url de ajax-->
	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-off"></span> Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- ... fin  lightbox reportePdf ... -->

