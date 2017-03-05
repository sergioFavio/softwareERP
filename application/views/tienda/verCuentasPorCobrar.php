<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>">
<script type="text/javascript" src="<?= base_url("js/bootstrap.min.js")?>"></script>

<style type="text/css" >

	/*  inicio de light box  */
	.modal-dialog {width:520px;}
	.modalEditar-dialog {width:843px;}
	.thumbnail {margin-bottom:6px;}
	/*  fin de light box  */

	/*  inicio de scrollbar  */
	thead{ display:block;  margin:0px; cell-spacing:0px; left:0px; }  
	tbody{ display:block; overflow:auto; height:357px; }               
	th{ height:10px;  width:780px;}                                    
	td{ height:10px;  width:780px; margin:0px; cell-spacing:0px;}
	/*  fin de scrollbar  */
	
	#pdfModal{padding-top:60px;padding-left:261px;}  /* ... baja la ventana modal más al centro vertical ... */
	
	.cuerpoDetalle, {margin: 2px;} 
    
	/* Fix alignment issue of label on extra small devices in Bootstrap 3.2 */
    .form-horizontal .control-label{padding-top: 7px;}
    
    .tituloReporte{font-size:9px; margin-top:10px; }
    
	#cuerpoCabecera{margin:0 auto; padding:0; width:780px; height:50px;}
	#cuerpoDetalle{margin:0 auto; padding:0; width:780px; height:410px;}
	#cuerpoPaginacion{margin:0 auto;padding:0; width:780px; height:60px;}
	
	#inputBuscarPatron, #letraCabecera{font-size:11px;text-align:center; }
	
	.letraDetalle, .letraTipoMaterial{font-size:11px;text-align:center; }
	
	.letraNumero{font-size:11px;text-align:right; }
	
	#titulo{font-size:16px;margin-top:1px;  text-align:right; font-weight:bold} 
</style>

<script>

$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip(); 
	 		  
 }); // fin document.ready 


function ctasCobrarPdf(nPedido){
    var pedido= nPedido;
  
	$.ajax({
      url: "<?=base_url()?>tienda/cuentasPorCobrarPdf",

      type: "POST",
      data: {numePedido: pedido},

      success: function(data){
         //alert(data);
	    //  aca deberia poner la funcion que hace el refrescado del listado	    
		$("#cargarpdf").html(data);	   // ...etiqueta id=recargado ... en pdfModal 
	  }
	      
   });	

  $('#pdfModal').modal({show:true});
   
}  // ... fin pedidoPdf ...


function pedidoCtaCobrarPdf(nPedido){
    var pedido= nPedido;
  
	$.ajax({
      url: "<?=base_url()?>tienda/pedidoCuentaPdf",

      type: "POST",
      data: {numePedido: pedido},

      success: function(data){
         //alert(data);
	    //  aca deberia poner la funcion que hace el refrescado del listado	    
		$("#cargarpdf").html(data);	   // ...etiqueta id=recargado ... en pdfModal 
	  }     
   });	

  $('#pdfModal').modal({show:true});
   
}  // ... fin pedidoPdf ...
	
</script>

<div class="jumbotron" id="cuerpoCabecera" >	<!--cuerpoCrudMaterial-->
		
	    <form class="form-horizontal" method="post" action="<?=base_url()?>tienda/buscarPedidoCtasPorCobrar" id="formBuscarRegistro_" name="formBuscarRegistro_" >
	    	<div style="height:10px;"></div>
			
			<div class="row">
			   	<div class="col-xs-1"> 
					<span></span>
			   	</div>
			   	     
				<div class="col-xs-3">    
			    	<div class="input-group input-group-sm">
			    		<input type="text" class="form-control input-sm" id="inputBuscarPatron" name="inputBuscarPatron" value='<?= $consultaPedido ?>' placeholder="buscar No. pedido&hellip;" data-toggle='tooltip' title="ingresar número de pedido sin ' / ' ">
						
						<div class="input-group-btn">
                        	<button type="submit" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-search"></span></button>
                    	</div>
			    	</div>
			    </div><!-- /.col-xs-3 -->	
			    
			    <div class="col-xs-1"> 
					<span></span>
			   	</div>
			     	
			   	<div class="col-xs-2"> 
					<span  id="titulo" class="label label-success"> Cuentas por Cobrar</span>
			   	</div>
			    
			    <div class="col-xs-1"> 
					<span></span>
			   	</div>
			   			     	
			    <div class="col-xs-1"> 
			    	<button type="button" id="btnSalir" class="btn btn-default btn-sm" onClick="ctasCobrarPdf('1002016')"><span class="glyphicon glyphicon-print"></span> PDF</button>
				</div>
				
				<div class="col-xs-1"> 
					<span></span>
			   	</div>
			   			     	
			    <div class="col-xs-1"> 
			    	<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>
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
    			<th style="width: 80px;">Fecha</th>
				<th style="width: 200px;">Cliente - Empresa</th>
				<th style="width: 90px;">Fono/Celular</th>
				<th style="width: 85px;text-align:center;">Importe Bs.</th>
				<th style="width: 85px;text-align:center;">Abono Bs.</th>
				<th style="width: 85px;text-align:center;">Saldo Bs.</th>
				<th style="width: 90px;text-align:center;">Acciones</th>
    		</tr>
 		</thead>
 		
 		<tbody>	
			<?php  $posicionFila=-1; ?>			
	        <?php foreach($listaPedido as $pedido):?>
				<tr class='letraDetalle'>
				
					<?php  $posicionFila=$posicionFila+1;  //...posicionFila
		
					$numeroPedido = $pedido->numPedido;
					$local= $pedido->numPedido;
								
					if(strlen($numeroPedido)==3){
						$secuenciaPedido=substr($numeroPedido,0,1);
						$anhoSistema=substr($numeroPedido,1,2);
					}
					
					if(strlen($numeroPedido)==4){
						$secuenciaPedido=substr($numeroPedido,0,2);
						$anhoSistema=substr($numeroPedido,2,2);
					}
					
					if(strlen($numeroPedido)==5){
						if($local=='F'){		//..local:Fabrica ..
							$secuenciaPedido=substr($numeroPedido,0,3);
							$anhoSistema=substr($numeroPedido,3,2);
						}else{					//..local:tienda ..
							$secuenciaPedido=substr($numeroPedido,0,1);
							$anhoSistema=substr($numeroPedido,1,4);
						}
					}
					
					if(strlen($numeroPedido)==6){
						$secuenciaPedido=substr($numeroPedido,0,2);
						$anhoSistema=substr($numeroPedido,2,4);
					}
					
					if(strlen($numeroPedido)==7){
						$secuenciaPedido=substr($numeroPedido,0,3);
						$anhoSistema=substr($numeroPedido,3,4);
					}
					
			  		$numePedidoAux=$secuenciaPedido.'/'.$anhoSistema;
 
					 echo"<td style='width:60px;'><input type='text' id='idPedido_".$posicionFila."' name='idPedido_".$posicionFila."' value='".$numePedidoAux."' readonly='readonly' style='border:none; width:60px;text-align:center;' /></td>";
						
					 echo"<td style='width: 60px;'><input type='text' id='fechaPedido_".$posicionFila."' name='fechaPedido_".$posicionFila."' value='".fechaMysqlParaLatina($pedido->fechaPedido)."' readonly='readonly' style='border:none; width:60px;' /></td>";
							 
					 echo"<td style='width: 200px;'><input type='text' id='cliente_".$posicionFila."' name='cliente_".$posicionFila."' value='".$pedido->cliente."' readonly='readonly' style='border:none; width:200px;' /></td>";
						
					 echo"<td style='width: 80px;'><input type='text' id='telCel_".$posicionFila."' name='telCel_".$posicionFila."' value='".$pedido->telCel."' readonly='readonly' style='border:none; width:80px;text-align:center;' /></td>";

					 echo"<td style='width: 70px;'><input type='text' id='importe_".$posicionFila."' name='importe_".$posicionFila."' value='".number_format($pedido->montoTotal,2)."' readonly='readonly' style='border:none; width:70px;' class='letraNumero'/></td>";
					
					 echo"<td style='width: 70px;'><input type='text' id='abono_".$posicionFila."' name='abono_".$posicionFila."' value='".number_format($pedido->abono,2)."' readonly='readonly' style='border:none; width:70px;' class='letraNumero'/></td>";
					
					 echo"<td style='width: 70px;'><input type='text' id='saldo_".$posicionFila."' name='saldo_".$posicionFila."' value='".number_format($pedido->montoTotal - $pedido->abono,2)."' readonly='readonly' style='border:none; width:70px;' class='letraNumero'/></td>";
													
					 echo"<td style='width:75px;background-color:#b9e9ec;align=left;'><a href='#' onClick='pedidoCtaCobrarPdf($numeroPedido);'><span class='glyphicon glyphicon-info-sign'></span> + detalle </a></td>";
	
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

<!-- ... inicio  lightbox Pdf... -->

<div class="modal fade" id="pdfModal" >
  <div class="modalEditar-dialog">
    <div class="modal-content">
      <!--div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div-->
      <div class="modal-body" >
      	
			<div id="cargarpdf">Mi texto/variable sin recargar</div> <!--  se actualiza variable en la funcion php que llama el url de ajax-->
	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-off"></span> Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- ... fin  lightbox Pdf ... -->


