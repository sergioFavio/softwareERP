<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>">
<script type="text/javascript" src="<?= base_url("js/bootstrap.min.js")?>"></script>

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
	
	#borrarModal{padding-top:90px;}  /* ... baja la ventana modal más al centro vertical ... */
	#pdfModal{padding-top:60px;padding-left:261px;}  /* ... baja la ventana modal más al centro vertical ... */
	
	.cuerpoDetalle, {margin: 2px;} 
    
	/* Fix alignment issue of label on extra small devices in Bootstrap 3.2 */
    .form-horizontal .control-label{padding-top: 7px;}
    
    .tituloReporte{font-size:9px; margin-top:10px; }
    
	#cuerpoCabecera{margin:0 auto; padding:0; width:775px; height:50px;}
	#cuerpoDetalle{margin:0 auto; padding:0; width:775px; height:410px;}
	#cuerpoPaginacion{margin:0 auto;padding:0; width:775px; height:60px;}
	
	#inputBuscarPatron, #letraCabecera{font-size:11px;text-align:center; }
	
	.letraDetalle, .letraTipoMaterial{font-size:11px;text-align:center; }
	
	.letraNumero{font-size:11px;text-align:right; }
	
	#titulo{font-size:16px;margin-top:1px;  text-align:right; font-weight:bold} 
</style>

<script>

$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip(); 
	
	$('#borrarModal').on('show.bs.modal', function(e) {  
		//aca recuperamos el id que pasaremos por tag al modal  
		var id = $(e.relatedTarget).data('item-id'); 
		var cli =$(e.relatedTarget).data('cli');
		var title = $(e.relatedTarget).data('title');
		//aca lo asignamos a un hidden dentro del form que esta en el modal
	    $(e.currentTarget).find('input[name="codigo"]').val(id);
		//esto solo pone el id pasado por tag para mostralo en el modal
		$(e.currentTarget).find('#showCodigo').html(id);
		$(e.currentTarget).find('#showCliente').html(cli);
		$(e.currentTarget).find('.modal-title').html(title);		
		
	});
	
	$('#borrarModal').on("click", 'input[type="submit"], button[type="submit"]', function() {       
		var form= $('#borrarModal').find("form");
		var action=form.attr("action");
		//aca recuperamos el id que paso por tag al modal
		var idele=$(form).find('input[name="codigo"]').val();
			
		$.ajax({
		    url: action,
		    type: "POST",
		    data: $(form).serialize(),
		
		    success: function(data){
		        //alert(data);
		       
			    //  aca deberia poner la funcion que hace el refrescado del listado
			    window.location.href=data;
			}
		});
	 });
	 		  
 }); // fin document.ready 


function proformaPdf(nProforma){
    var proforma= nProforma;
  
	$.ajax({
      url: "<?=base_url()?>tienda/proformaPdfCrud",

      type: "POST",
      data: {numeProforma: proforma},

      success: function(data){
         //alert(data);
	    //  aca deberia poner la funcion que hace el refrescado del listado	    
		$("#recargado").html(data);	   // ...etiqueta id=recargado ... en pdfModal 
	  }
	      
   });	

  $('#pdfModal').modal({show:true});
   
}  // ... fin proformaPdf ...
	
</script>

<div class="jumbotron" id="cuerpoCabecera" >	<!--cuerpoCrudMaterial-->
		<?php 
			if($buscarPor=="numPedido"){
				$funcionBuscar='buscarPedido';
			}else{
				$funcionBuscar='buscarPedidoPorCliente';
			}
		
		?>
	
	    <form class="form-horizontal" method="post" action="<?=base_url()?>tienda/<?= $funcionBuscar ?>" id="formBuscarRegistro_" name="formBuscarRegistro_" >
	    	<div style="height:10px;"></div>
			
			<div class="row">
			   	<div class="col-xs-1"> 
					<span></span>
			   	</div>
			   	             
				<div class="col-xs-3">
			    	<div class="input-group input-group-sm">
			    		<input type="text" class="form-control input-sm" id="inputBuscarPatron" name="inputBuscarPatron" value='<?= $consultaPedido ?>' placeholder="buscar por <?= $buscarPor ?>" data-toggle='tooltip' title="ingresar número de proforma sin ' / ' ">
						
						<div class="input-group-btn">
                        	<button type="submit" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-search"></span></button>
                    	</div>
                    </div>
			    </div>	
			    
			    			    
			    <div class="col-xs-1"> 
					<span></span>
			   	</div>
			   	
			   	<div class="col-xs-2"> 
					<span  id="titulo" class="label label-success"> V e r  &nbsp;&nbsp;&nbsp;&nbsp; P r o f o r m a s</span>
			   	</div>
			    
			    <div class="col-xs-2"> 
					<span></span>
			   	</div>
			   			     	
			    <div class="col-xs-2"> 
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
    			<th style="width: 80px;">&nbsp;&nbsp;&nbsp;Proforma</th>
    			<th style="width: 80px;">Fecha</th>
				<th style="width: 200px;">Cliente - Empresa</th>
				<th style="width: 80px;">Fono/Celular</th>
				<th style="width: 225px;text-align:center">Correo</th>
				<th style="width: 110px;text-align:center">Acciones</th>
    		</tr>
 		</thead>
 		
 		<tbody>	
			<?php  $posicionFila=-1; ?>			
	        <?php foreach($listaProforma as $proforma):?>
				<tr class='letraDetalle'>
				
					<?php  $posicionFila=$posicionFila+1;  //...posicionFila
		
					$numeroProforma = $proforma->idProforma;
					$local = $proforma->local;
					$secuenciaProforma=substr($numeroProforma,0,4);
									
					if(strlen($numeroProforma)==6){						//...si es proforma de Fabrica ... 
						$anhoSistema=substr($numeroProforma,4,2);
					}else{												//...si es proforma de Tienda ... 
						$anhoSistema=substr($numeroProforma,4,4);
					}
					
			  		$numeProformaAux=$secuenciaProforma.'/'.$anhoSistema;
								
					 echo"<td style='width:60px;'><input type='text' id='idPedido_".$posicionFila."' name='idPedido_".$posicionFila."' value='".$numeProformaAux."' readonly='readonly' style='border:none; width:60px;text-align:center;' /></td>";
						
					 echo"<td style='width: 60px;'><input type='text' id='fechaEntrega_".$posicionFila."' name='fechaEntrega_".$posicionFila."' value='".fechaMysqlParaLatina($proforma->fechaProf)."' readonly='readonly' style='border:none; width:60px;' /></td>";
							 
					 echo"<td style='width: 200px;'><input type='text' id='contactoEmpresa_".$posicionFila."' name='contactoEmpresa_".$posicionFila."' value='".$proforma->clienteProf."' readonly='readonly' style='border:none; width:200px;' /></td>";
						
					 echo"<td style='width: 80px;'><input type='text' id='telCel_".$posicionFila."' name='telCel_".$posicionFila."' value='".$proforma->fonoCel."' readonly='readonly' style='border:none; width:80px;text-align:center;' /></td>";

					 echo"<td style='width: 200px;'><input type='text' id='correo_".$posicionFila."' name='correo_".$posicionFila."' value='".$proforma->correoProf."' readonly='readonly' style='border:none; width:200px;' /></td>";
												
					 echo"<td style='width:50px;background-color:#b9e9ec;align=left;'><a href='#' onClick='proformaPdf($numeroProforma);'><span class='glyphicon glyphicon-print'></span> PDF</a></td>";
					 	
					 if($permisoUserName=='superuser'){
					 	echo"<td style='width:65px;background-color:#a5d4da;align=left;'><a href='#' data-title='Eliminar proforma' data-item-id='".$proforma->idProforma."' data-cli='".$proforma->contactoProf."' data-toggle='modal' data-target='#borrarModal'><span class='glyphicon glyphicon-trash'></span> Eliminar</a></td>"; 
					 }else{
					 	echo"<td style='width:65px;background-color:#a5d4da;align=left;'></td>"; 
					 }
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


<!-- ...  lightbox borrar proforma ... -->

<div class="modal fade" id="borrarModal" tabindex="-1" role="dialog" aria-labelledby="borrarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title" id="borrarModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
	  <form class="form-horizontal" data-async data-target="#rating-modal" action="<?=base_url()?>tienda/eliminarProforma" method="POST">
        ¿ Esta seguro de eliminar la proforma <span id="showCodigo" style="font-weight : bold;"></span> de <span id="showCliente" style="font-weight : bold;"></span> ?
		<input type="hidden" value="" name="codigo" class="itemId">
	  </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-off"></span> Cerrar</button>
        <button type="submit" id="eliminar" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-remove"></span> Eliminar</button>
      </div>
    </div>
  </div>
</div>

<!-- ... fin  lightbox borrar proforma ... -->


<!-- ... inicio  lightbox proformaPdf... -->

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

<!-- ... fin  lightbox proformaPdf ... -->


