<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery-ui-1.8.20.custom.min.js"></script>


<style type="text/css" >

	/*  inicio de light box  */
	.modal-dialog {width:520px;}
	.thumbnail {margin-bottom:6px;}
	/*  fin de light box  */

	/*  inicio de scrollbar  */
	thead { display:block;  margin:0px; cell-spacing:0px; left:0px; }  
	tbody { display:block; overflow:auto;  }               
	th { height:10px;  width:850px;}                                    
	td { height:10px;  width:850px; margin:0px; cell-spacing:0px;}
	/*  fin de scrollbar  */
	
	#crearModal,#editarModal, #borrarModal{padding-top:180px;}  /* ... baja la ventana modal más al centro vertical ... */
	
	.cuerpoDetalle, {margin: 2px;} 
    
	/* Fix alignment issue of label on extra small devices in Bootstrap 3.2 */
    .form-horizontal .control-label{padding-top: 7px;}
    
    .tituloReporte{font-size:9px; margin-top:0px; }
    
	#cuerpoCabecera{margin:0 auto; padding:0; width:700px; height:50px;background:#f4f4f4}
	#cuerpoDetalle{margin:2px auto; padding:10px; width:700px; background:#f4f4f4 }

	.letraDetalle, .letraTipoMaterial{font-size:11px;text-align:center; }
	.letraNumero{font-size:11px;text-align:right; }
	
</style>

<script>

$(document).ready(function(){
	
	$('#tabla1').dataTable(
		{
	        "scrollY":        "320px",
	        "scrollCollapse": true,
	        "paging":         false,
	         "info":  true
	    }
	);
		
	/*  inicio de light box crearMaterial javascript */
	$('#openLightBox').click(function(){
  		var title = $(this).attr("title");
		$('.modal-title').html(title);
		$('#crearModal').modal({show:true});
	});
	/*  fin de light box crearMaterialjavascript  */	
	
	
	$('#borrarModal').on('show.bs.modal', function(e) {  
		//aca recuperamos el id que pasaremos por tag al modal  
		var id = $(e.relatedTarget).data('item-id'); 
		var empleado =$(e.relatedTarget).data('empleado');
		var title = $(e.relatedTarget).data('title');
		//aca lo asignamos a un hidden dentro del form que esta en el modal
	    $(e.currentTarget).find('input[name="codigo"]').val(id);
		//esto solo pone el id pasado por tag para mostralo en el modal
		$(e.currentTarget).find('#showCodigo').html(id);
		$(e.currentTarget).find('#showDescripcion').html(empleado);
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

	
	$('#editarModal').on('show.bs.modal', function(e) {  
		//aca recuperamos el id que pasaremos por tag al modal  
		var id = $(e.relatedTarget).data('item-id'); 
		var empleado = $(e.relatedTarget).data('empleado');
		var  categoria= $(e.relatedTarget).data('categoria');
		var  horaBs= $(e.relatedTarget).data('horabs');
		var title = $(e.relatedTarget).data('title');
		//aca lo asignamos a un hidden dentro del form que esta en el modal
	    $(e.currentTarget).find('input[name="inputCodigoM"]').val(id);
		$(e.currentTarget).find('input[name="inputEmpleadoM"]').val(empleado);
//		$(e.currentTarget).find('input[name="inputEditarCategoriaM"]').val(categoria);	
		$(e.currentTarget).find('input[name="inputHoraBsM"]').val(horaBs);
			

		if(categoria=="A" ){
			document.getElementById('inputCategoria1M').checked = true;		
		}else{
			document.getElementById('inputCategoria2M').checked = true;
		}	

		//esto solo pone el id pasado por tag para mostralo en el modal
		$(e.currentTarget).find('.modal-title').html(title);		
		
	});
	
	
	$('#editarModal').on("click", 'input[type="submit"], button[type="submit"]', function() {       
		var form= $('#editarModal').find("form");
		var action=form.attr("action");
		//aca recuperamos el id que paso por tag al modal
		var idele1=$(form).find('input[name="inputCodigoM"]').val();	
		var idele2=$(form).find('input[name="inputEmpleadoM"]').val();
//		var idele3=$(form).find('input[name="inputEditarCategoriaM"]').val();
		var idele4=$(form).find('input[name="inputHoraBsM"]').val();
						
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
	
	
	$("#btnGrabarNuevoManoObra").click(function(){
	// grabar registro en tablas [almacen/bodega]
    	grabarNuevoManoObra();
	});
	
	
	$("#btnGrabarModificacionManoObra").click(function(){
	// grabar registro en tablas [almacen/bodega]
    	grabarModificacionManoObra();
	});
	
	  
}); // fin document.ready 


function grabarNuevoManoObra(){
	
	var registrosValidos= true;	  // ... bandera para grabar o no grabar registros ...
	
	if($("#inputCodigo").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de CODIGO está vacío");
			var registrosValidos= false;	
	}
	
	if($("#inputEmpleado").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de NOMBRE EMPLEADO está vacío");
			var registrosValidos= false;	
	}
	
	if($("#inputCategoria").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de CATEGORIA está vacío");
			var registrosValidos= false;	
	}
	
	if($("#inputHoraBs").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de HORA BS. está vacío");
			var registrosValidos= false;	
	}
	
		
	if(!registrosValidos){
		alert('Corrija los campos que están vacíos');
	}else{
		$("#formGrabarNuevoRegistro_").submit(); // ...  graba registros ...
	}
			
}	// ... fin funcion grabarNuevoMaterial() ...


function grabarModificacionManoObra(){
	
	var registrosValidosM= true;	  // ... bandera para grabar o no grabar registros ...
	
	if($("#inputEmpleadoM").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de NOMBRE EMPLEADO está vacío");
			var registrosValidosM= false;	
	}
	
	if($("#inputCategoriaM").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de  está vacío");
			var registrosValidosM= false;	
	}
	
	if($("#inputHoraBsM").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de HORA BS. está vacío");
			var registrosValidosM= false;	
	}
	
	
	if(!registrosValidosM){
		alert('Corrija los campos que están vacíos');
	}else{
		$("#formEditarRegistro_").submit(); // ...  graba registros ...
	}
			
}	// ... fin funcion grabarModificacionManoObra() ...

function validarCodigo(numero){
	if(!validarCodigoNoRepetido(numero)){
		alert('ERROR este código '+numero+' ya existe'); 
		$("#inputCodigo").val("");
	}else{
		validarTamanhoCodigo(numero);
	}
}

function validarTamanhoCodigo(numero){
	var tamanhoCodigo=numero.toString();
	if(tamanhoCodigo.length !=5 ){
		alert('ERROR este código '+numero+' es inválido'); 
		$("#inputCodigo").val("");	
	}
}

function validarCodigoNoRepetido(numero){
	// la valiacion del codigo se la hace con una busqueda binaria ...		
	var centro=0; 
	var inf=0;
	var numeroRegistros = document.getElementsByClassName("letraDetalle").length; //...obtiene numeroRegistros
	var sup=numeroRegistros-1;
    while(inf<=sup){
    	centro=parseInt( (sup+inf)/2 );
         
	     if( $("#idEmpleado_"+centro).val()==numero){
	     	 return false;
	     }
	     else if(numero < $("#idEmpleado_"+centro).val() ){
			sup=centro-1;
	     }
	     else {
	       inf=centro+1;
	     }
	} // ...fin while
    return true;	
}   // fin ... validarCodigoNoRepetido ...


function validarHoraBs(numero,sufijo){	
	var cantidad=parseFloat( numero ); // convierte de string to number 
	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
	if (!/^\d{1,7}(\.\d{1,3})?$/.test(numero)){  // ...hasta 7 digitos parte entera y hasta 3 parte decimal ...
		alert("El valor " + numero + " para HORA Bs. "+ sufijo+ " no es válido");
		$("#inputHoraBs"+sufijo).val("");   // borra celda 
	}
	    		
}   // fin ... validarHoraBs ...
		
</script>

<div class="jumbotron" id="cuerpoCabecera" >	<!--cuerpoCrudManoObra-->
		
	    <form class="form-horizontal" method="post" action="<?=base_url()?>produccion/buscarManoObraCrud" id="formBuscarRegistro_" name="formBuscarRegistro_" >
	       <div style="height:10px;"></div>
		   <div class="row">
		   	
			   	<div class="col-xs-1 col-md-1"> 
					<span></span>
			   	</div>
			   	
			   	<div class="col-xs-2 col-md-2"> 
			    	<button type="button"  class="btn btn-success btn-sm" id="openLightBox" title='Crea nuevo registro de mano de obra'><span class="glyphicon glyphicon-plus-sign"></span> Añadir empleado</button>
			    </div>
			   	     
				<div class="col-lg-6">    
			    	<p align="center" class="tituloReporte"><span class="label label-default"> CRUD Mano de Obra </span></p>
			    </div><!-- /.col-lg-6 -->	
			    			     	
			    <div class="col-xs-2 col-md-2"> 
			    	<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			    
		</div>  <!-- /.row -->
			
	   </form>  <!--/div-->
	
</div> <!-- fin ... cuerpoCabecera -->



<div style="height:7px;"></div>

<div class="jumbotron" id="cuerpoDetalle" >

	<div style="height:5px;"></div>
	<table cellspacing="0" cellpadding="0"   class="display compact"  id="tabla1">		
		<thead>
    		<tr style="background-color: #b9e9ec;" class='letraDetalle'>
    			<th style="width: 50px;">C&oacute;digo</th>
				<th style="width: 350px;">Empleado</th>
				<th style="width: 58px;">Categor&iacute;a</th>
				<th style="width: 55px;">Hora Bs.</th>
				<th style="width: 90px;" colspan="2"><?= nbs(1);?>Acciones</th>
    		</tr>
 		</thead>
 		
 		<tbody>	
			<?php  $posicionFila=-1; ?>			
	        <?php foreach($listaManoObra as $manoObra):?>
				<tr class='letraDetalle'>
				
					<?php  $posicionFila=$posicionFila+1;  //...posicionFila
					
					 echo"<td style='width:50px;'><input type='text' id='idEmpleado_".$posicionFila."' name='idEmpleado_".$posicionFila."' value='".$manoObra['idEmpleado']."' readonly='readonly' style='border:none; width:50px;' /></td>";
						
					 echo"<td style='width: 360px;'><input type='text' id='empleado_".$posicionFila."' name='empleado_".$posicionFila."' value='".$manoObra['empleado']."' readonly='readonly' style='border:none; width:360px;' /></td>";
							 
					 echo"<td style='width: 60px;'><input type='text' class='letraNumero' id='categoria_".$posicionFila."' name='categoria_".$posicionFila."' value='".$manoObra['categoria']."' readonly='readonly' style='border:none; width:60px;' /></td>";
					
			 		 echo"<td style='width:150px;'><input type='text' class='letraNumero' id='horaBs_".$posicionFila."' name='horaBs_".$posicionFila."' value='".$manoObra['horaBs']."' readonly='readonly' style='border:none; width:50px;' />  <a href='#' data-title='Editar registro de mano de obra' data-item-id='".$manoObra['idEmpleado']."' data-empleado='".$manoObra['empleado']."' data-categoria='".$manoObra['categoria']."' data-horabs='".$manoObra['horaBs']."'
					 data-toggle='modal' data-target='#editarModal' ><span class='glyphicon glyphicon-pencil'></span> Editar</a><a href='#' data-title='Mensaje:' data-item-id='".$manoObra['idEmpleado']."' data-empleado='".$manoObra['empleado']."' data-toggle='modal' data-target='#borrarModal'><span class='glyphicon glyphicon-trash'></span> Eliminar</a> </td>";
		
				   ?>						
				</tr>
	        <?php endforeach ?>
                
			</tbody>
	</table>
	
</div> <!-- fin ... cuerpoDetalle -->

<div style="height:5px;"></div>

<!-- ... inicio  lightbox crear nuevo empleado... -->

<div class="modal fade" id="crearModal" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
      	
      	 <form class="form-horizontal" method="post" action="<?=base_url()?>produccion/grabarNuevoManoObraCrud" id="formGrabarNuevoRegistro_" name="formGrabarNuevoRegistro_" >
	 
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Código: </span>
			  	<input type='text' class='form-control input-sm' id='inputCodigo' name='inputCodigo' placeholder='codigo&hellip;' onChange='validarCodigo(this.value);' > 
			</div>
        
        	<div style="height:5px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Nombre empleado: </span>
			  <input type="text" class="form-control input-sm" id="inputEmpleado" name="inputEmpleado" placeholder="nombre empleado &hellip;">
			</div>
			
			<div style="height:10px;"></div>
			
			<div class="input-group" style="font-size:12px;">
	            <label class="control-label col-xs-4">Categor&iacute;a:</label>
	            <div class="col-xs-4">
	                <label class="radio-inline">
	                    <input type="radio" id="inputCategoria1" name="inputCategoria" value="A" checked="checked"> Ayudante
	                </label>
	            </div>
	            <div class="col-xs-4">
	                <label class="radio-inline">
	                    <input type="radio" id="inputCategoria2" name="inputCategoria" value="M"> Maestro
	                </label>
	            </div>
        	</div>
			
			<div style="height:10px;"></div>
			
			<div class="input-group input-group-sm">
			  <span class="input-group-addon">Hora Bs.: </span>
			  <input type="text" class="form-control input-sm" id="inputHoraBs" name="inputHoraBs"  placeholder=" 0.00 &hellip;" onChange='validarHoraBs(this.value,"");'>
			</div>
			
      	</form>
      	
      			        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-off"></span> Cerrar</button>
        <button type="submit" class="btn btn-primary btn-sm" id="btnGrabarNuevoManoObra"><span class="glyphicon glyphicon-hdd"></span> Grabar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- ... fin  lightbox crear nuevo material ... -->

<!-- ...  lightbox borrar empleado ... -->
<div class="modal fade" id="borrarModal" tabindex="-1" role="dialog" aria-labelledby="borrarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title" id="borrarModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
	  <form class="form-horizontal" data-async data-target="#rating-modal" action="<?=base_url()?>produccion/eliminarManoObraCrud" method="POST">
        ¿ Esta seguro de eliminar el código <span id="showCodigo" style="font-weight : bold;"></span> <span id="showDescripcion" style="font-weight : bold;"></span> ?
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

<!-- ... fin  lightbox borrar empleado ... -->


<!-- ... inicio  lightbox editar empleado... -->
<div class="modal fade" id="editarModal" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
      	
      	
      	 <form class="form-horizontal"   data-async data-target="#rating-modal" action="<?=base_url()?>produccion/actualizarManoObraCrud" id="formEditarRegistro_" name="formEditarRegistro_" method="POST">
      	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Código: </span>
			  	<input type='text' class='form-control input-sm' id='inputCodigoM' name='inputCodigoM' value='' readonly='readonly' placeholder='codigo&hellip;' onChange='validarCodigo(this.value);' > 
			</div>
        
        	<div style="height:5px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Nombre empleado: </span>
			  <input type="text" class="form-control input-sm" id="inputEmpleadoM" name="inputEmpleadoM" value='' placeholder="nombre empleado &hellip;">
			</div>
			
			<div style="height:10px;"></div>
			
			<div class="input-group input-group-sm" style="font-size:12px;">
	            <label class="control-label col-xs-4">Categor&iacute;a:</label>
	            <div class="col-xs-4">
	                <label class="radio-inline">
	                    <input type="radio" id="inputCategoria1M" name="inputCategoriaM" value="A"> Ayudante
	                </label>
	            </div>
	            <div class="col-xs-4">
	                <label class="radio-inline">
	                    <input type="radio" id="inputCategoria2M" name="inputCategoriaM" value="M"> Maestro
	                </label>
	            </div>
        	</div>
			
			<div style="height:10px;"></div>			
			
			<div class="input-group input-group-sm">
			  <span class="input-group-addon">Hora Bs.: </span>
			  <input type="text" class="form-control input-sm" id="inputHoraBsM" name="inputHoraBsM"  placeholder="0.00 &hellip;" onChange='validarHoraBs(this.value,"M");'>
			</div>
				
      	</form>
  		        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-off"></span> Cerrar</button>
        <button type="submit" id="btnGrabarModificacionManoObra" class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-hdd"></span> Grabar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- ... fin  lightbox editar material ... -->

