<script type="text/javascript" src="<?= base_url("js/bootstrap.min.js")?>"></script>
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
	
	#editarModal{padding-top:190px;}  					/* ... baja la ventana modal más al centro vertical ... */
	#pdfModal{padding-top:60px;padding-left:261px;}  	/* ... baja la ventana modal más al centro vertical ... */
	
	.cuerpoDetalle, {margin: 2px;} 
    
	/* Fix alignment issue of label on extra small devices in Bootstrap 3.2 */
    .form-horizontal .control-label{padding-top: 7px;}
    
    .tituloReporte{font-size:9px; margin-top:10px; }
    
	#cuerpoCabecera{margin:0 auto; padding:0; width:850px; height:105px;} 					
	#cuerpoDetalle{margin:0 auto; padding:0; width:850px; height:410px; }					
	#cuerpoPaginacion{margin:0 auto;padding:0;  width:850px; height:60px;}					
	
	#inputBuscarPatron, #letraCabecera{font-size:11px;text-align:center; }
	
	.letraDetalle, .letraTipoMaterial{font-size:11px;text-align:center; }
	
	.letraNumero{font-size:11px;text-align:right; }
	
</style>

<script>

$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip(); 
		
	/*	
	// Select all elements with data-toggle="tooltips" in the document
	$('[data-toggle="tooltip"]').tooltip(); 
	
	// Select a specified element
	$('#myTooltip').tooltip();	
		
	*/	
	
	$('#editarModal').on('show.bs.modal', function(e) {  
		//aca recuperamos el id que pasaremos por tag al modal  
		var id = $(e.relatedTarget).data('item-id'); 
		var producto = $(e.relatedTarget).data('producto');
		var color = $(e.relatedTarget).data('color');
		var estado = $(e.relatedTarget).data('estado');
		var numeropedido = $(e.relatedTarget).data('numeropedido');
		var secuencia = $(e.relatedTarget).data('secuencia');
		var title = $(e.relatedTarget).data('title');
		
		document.formEditarRegistro_.numeroPedido.value=numeropedido;  	// ... numeropedido  variable hidden formulario...
		document.formEditarRegistro_.secuencia.value=secuencia;  			// ... secuencia  variable hidden formulario...
		
		//aca lo asignamos a un hidden dentro del form que esta en el modal
	    $(e.currentTarget).find('input[name="inputCodigoM"]').val(id);
		$(e.currentTarget).find('input[name="inputProductoM"]').val(producto);
		$(e.currentTarget).find('input[name="inputColorM"]').val(color);
		$(e.currentTarget).find('input[name="inputEditarEstadoM"]').val(estado);      //.. variable falsa para tipo estado ...
		$(e.currentTarget).find('input[name="inputFechaAcabadoM"]').val();
		
		if(estado=="P" ){
			document.getElementById('inputEstado1M').checked = true;	
		}else{
			document.getElementById('inputEstado2M').checked = true;
		}

		//esto solo pone el id pasado por tag para mostralo en el modal
		$(e.currentTarget).find('.modal-title').html(title);		
		
	});
	
	
	$('#editarModal').on("click", 'input[type="submit"], button[type="submit"]', function() {       
		var form= $('#editarModal').find("form");
		var action=form.attr("action");
		//aca recuperamos el id que paso por tag al modal
		var idele1=$(form).find('input[name="inputCodigoM"]').val();	
		var idele2=$(form).find('input[name="inputProductoM"]').val();
		var idele3=$(form).find('input[name="inputColorM"]').val();
		var idele4=$(form).find('input[name="inputEditarEstadoM"]').val();	//.. variable falsa para estado ...
		var idele5=$(form).find('input[name="inputFechaAcabadoM"]').val();	
					
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


	 $("#btnTerminarOrdenTrabajo").click(function(){
	// actualizar estado  orden de trabajo a T: terminado..
    	terminarOrdenTrabajo();
	});
	
	
}); // fin document.ready 


function reportePdf(nOrdenTrabajo){
    var ordenTrabajo= nOrdenTrabajo;
    
	$.ajax({
      url: "<?=base_url()?>produccion/ordenTrabajoPdf",

      type: "POST",
      data: {numeOrdenTrabajo: ordenTrabajo},

      success: function(data){
         //alert(data);
	    //  aca deberia poner la funcion que hace el refrescado del listado	    
		$("#recargado").html(data);	   // ...etiqueta id=recargado ... en pdfModal 
	  }
	      
   });	

  $('#pdfModal').modal({show:true});
   
}  // ... fin reportePdf ...


function terminarOrdenTrabajo(){
	
	var registrosValidosM= true;	  // ... bandera para grabar o no grabar registros ...
	
	if($("#inputFechaAcabadoM").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de FECHA ACABADO está vacío");
			var registrosValidosM= false;	
	}
	
	if(document.getElementById('inputEstado2M').checked == false ){
			alert("¡¡¡ E R R O R !!! ... El contenido de ESTADO no se ha modificado a TERMINADO");
			var registrosValidosM= false;	
	}
		
	if(registrosValidosM){
		$("#formEditarRegistro_").submit(); // ...  graba registros ...
	}
			
}	// ... fin funcion terminaOrdenTrabajo() ...
	
</script>

<div class="jumbotron" id="cuerpoCabecera" >	<!--cuerpoCrudMaterial-->
		
	    <form class="form-horizontal" method="post" action="<?=base_url()?>produccion/buscarOrdenTrabajo" id="formBuscarRegistro_" name="formBuscarRegistro_" >
	    	<div style="height:2px;"></div>
			<p align="center" class="tituloReporte" ><span class="label label-default"> Ver Órdenes de Stock</span></p>
	
		   <div class="row">
		   	
			   	<div class="col-xs-2 col-md-2"> 
					<span></span>
			   	</div>
			   	     
				<div class="col-lg-6">    
			    	<div class="input-group input-group-sm">
			    		<input type="text" class="form-control input-sm" id="inputBuscarPatron" name="inputBuscarPatron" value='<?= $consultaOrdenStock ?>' placeholder="buscar ...">
						
						
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
    			<th style="width: 75px;">&nbsp;&nbsp;&nbsp;Orden</th>
    			<th style="width: 55px;">CodTrab.</th>
				<th style="width: 308px;">Descripción</th>
				<th style="width: 25px;">Cant.</th>
				<th style="width: 40px;">Unidad</th>
				<th style="width: 70px;">Fecha Inicial</th>
				<th style="width: 70px;">Fecha Final</th>
				<th style="width: 53px;">Estado</th>
				<th style="width: 125px;text-align:center">Acciones</th>
    		</tr>
 		</thead>
 		
 		<tbody>	
			<?php  $posicionFila=-1; ?>			
	        <?php foreach($listaOrdenStock as $ordenStock):?>
				<tr class='letraDetalle'>
				
					<?php  $posicionFila=$posicionFila+1;  //...posicionFila
		
					$numeOrdenStock = $ordenStock->stock;	
							
					 echo"<td style='width:65px;' ><input type='text' id='idOrdenT_".$posicionFila."' name='idOrdenT_".$posicionFila."' value='".$ordenStock->stock."-".$ordenStock->stock."' readonly='readonly' style='border:none; width:65px;text-align:center;' data-toggle='tooltip' title='$ordenStock->trabajador'  /></td>";
						
					 echo"<td style='width: 45px;'  ><input type='text' id='codTrab_".$posicionFila."' name='codTrab_".$posicionFila."' value='".$ordenStock->codTrabajador."' readonly='readonly' style='border:none; width:45px;'  data-toggle='tooltip' title='$ordenStock->trabajador'  /></td>";
							 
					 echo"<td style='width: 300px;'><input type='text' id='producto_".$posicionFila."' name='producto_".$posicionFila."' value='".$ordenStock->descripcion."' readonly='readonly' style='border:none; width:300px;' data-toggle='tooltip' title='$ordenStock->descripcion'  /></td>";
						
					 echo"<td style='width: 25px;'><input type='text' id='cant_".$posicionFila."' name='cant_".$posicionFila."' value='".$ordenStock->cantidad."' readonly='readonly' style='border:none; width:25px;text-align:right;' /></td>";
					
					 echo"<td style='width: 40px;'><input type='text' id='estado_".$posicionFila."' name='estado_".$posicionFila."' value='".$ordenStock->unidad."' readonly='readonly' style='border:none; width:40px;' /></td>";
					
					 echo"<td style='width: 60px;'><input type='text' id='fechaInicial_".$posicionFila."' name='fechaInicial_".$posicionFila."' value='".$ordenStock->fInicio."' readonly='readonly' style='border:none; width:60px;' /></td>";
					
					 echo"<td style='width: 60px;'><input type='text' id='fechaFinal_".$posicionFila."' name='fechaFinal_".$posicionFila."' value='".$ordenStock->fEntrega."' readonly='readonly' style='border:none; width:60px;' /></td>";
					 					 
					 echo"<td style='width: 40px;'><input type='text' id='estadoItem_".$posicionFila."' name='estadoItem_".$posicionFila."' value='".$ordenStock->estado."' readonly='readonly' style='border:none; width:40px;text-align:center;' /></td>";
						 
					 echo"<td style='width:50px;background-color:#b9e9ec;' align='left'><a href='#' onClick='reportePdf($numeOrdenStock);'><span class='glyphicon glyphicon-print'></span> PDF</a></td>";

					 
//					 if($ordenStock->estado=='P'){		//... solo ordenes ya signadas ...		 
//					 	echo"<td style='width:50px;background-color:#b9e9ec;' align='left'><a href='#' onClick='reportePdf($numeOrdenStock);'><span class='glyphicon glyphicon-print'></span> PDF</a></td>";
					 
					 	echo"<td style='width:75px;background-color:#a5d4da;align=left;'><a href='#' data-title='Terminar orden de trabajo' data-item-id='".$ordenStock->stock."-".$ordenStock->stock."' data-producto='".$ordenStock->descripcion."'
					    data-numeropedido='".$ordenStock->stock."' data-secuencia='".$ordenStock->stock."' data-color='".$ordenStock->descripcion."' data-estado='".$ordenStock->estado."' data-toggle='modal' data-target='#editarModal'><span class='glyphicon glyphicon-ok'></span> Terminar</a></td>";
//					 }
					 				
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


<!-- ... inicio  lightbox editar orden trabajo... -->

<div class="modal fade" id="editarModal" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
      	
      	
      	 <form class="form-horizontal"   data-async data-target="#rating-modal" action="<?=base_url()?>produccion/actualizarOrdenTrabajo" id="formEditarRegistro_" name="formEditarRegistro_" method="POST">
      	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Orden Trabajo #: </span>
			  	<input type='text' class='form-control input-sm' id='inputCodigoM' name='inputCodigoM' value='' readonly='readonly' placeholder='codigo&hellip;' onChange='validarCodigo(this.value);' > 
			</div>
        
        	<div style="height:10px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Producto: </span>
			  <input type="text" class="form-control input-sm" id="inputProductoM" name="inputProductoM" value='' readonly='readonly' placeholder="producto &hellip;">
			</div>
			
			<div style="height:10px;"></div>
			
			<div class="input-group input-group-sm">
			  <span class="input-group-addon">Color: </span>
			  <input type="text" class="form-control input-sm" id="inputColorM" name="inputColorM" value='' readonly='readonly' placeholder="color &hellip;">
			</div>
			
			<div style="height:10px;"></div>
			
			<div class="input-group" style="font-size:12px;">
	            <label class="control-label col-xs-3">Estado:</label>
	            <div class="col-xs-4">
	                <label class="radio-inline">
	                    <input type="radio" id="inputEstado1M" name="inputEstadoM" value="P"> Proceso
	                </label>
	            </div>
	            <div class="col-xs-4">
	                <label class="radio-inline">
	                    <input type="radio" id="inputEstado2M" name="inputEstadoM" value="T"> Terminado
	                </label>
	            </div>
        	</div>
			
			<div style="height:10px;"></div>
			
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Fecha Acabado: </span>
			  <input type="date" class="form-control input-sm" id="inputFechaAcabadoM" name="inputFechaAcabadoM" value='' placeholder="nota entrega &hellip;" style='width:140px;'>
			</div>
        	
        	<input type="hidden"  name="numeroPedido"  />
        	<input type="hidden"  name="secuencia"  />
      	</form>
  		        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-off"></span> Cerrar</button>
        <button type="submit" id="btnTerminarOrdenTrabajo" class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-hdd"></span> Grabar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- ... fin  lightbox editar orden trabajo ... -->

