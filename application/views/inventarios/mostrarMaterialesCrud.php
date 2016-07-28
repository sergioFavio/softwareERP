
<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>">

<style type="text/css" >

	/*  inicio de light box  */
	.modal-dialog {width:520px;}
	.thumbnail {margin-bottom:6px;}
	/*  fin de light box  */

	/*  inicio de scrollbar  */
	thead { display:block;  margin:0px; cell-spacing:0px; left:0px; }  
	tbody { display:block; overflow:auto; height:357px; }               
	th { height:10px;  width:850px;}                                    
	td { height:10px;  width:850px; margin:0px; cell-spacing:0px;}
	/*  fin de scrollbar  */
	
	 #crearModal,#editarModal, #borrarModal{padding-top:90px;}  /* ... baja la ventana modal más al centro vertical ... */
	
	
	.cuerpoDetalle, {margin: 2px;} 
    
	/* Fix alignment issue of label on extra small devices in Bootstrap 3.2 */
    .form-horizontal .control-label{padding-top: 7px;}
    
    .tituloReporte{font-size:9px; margin-top:10px; }
    
	#cuerpoCabecera{margin:0 auto; padding:0; width:850px; height:105px;}
	#cuerpoDetalle{margin:0 auto; padding:0; width:850px; height:410px;}
	#cuerpoPaginacion{margin:0 auto;padding:0; width:850px; height:60px;}
	
	#inputBuscarPatron, #letraCabecera{font-size:11px;text-align:center; }
	
	.letraDetalle, .letraTipoMaterial{font-size:11px;text-align:center; }
	
	.letraNumero{font-size:11px;text-align:right; }
	
</style>

<script>

$(document).ready(function() {
		
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
		var mat =$(e.relatedTarget).data('mat');
		var title = $(e.relatedTarget).data('title');
		//aca lo asignamos a un hidden dentro del form que esta en el modal
	    $(e.currentTarget).find('input[name="codigo"]').val(id);
		//esto solo pone el id pasado por tag para mostralo en el modal
		$(e.currentTarget).find('#showCodigo').html(id);
		$(e.currentTarget).find('#showMaterial').html(mat);
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
		var mat = $(e.relatedTarget).data('mat');
		var existencia = $(e.relatedTarget).data('existencia');
		var unidad = $(e.relatedTarget).data('unidad');
		var precio = $(e.relatedTarget).data('precio');
		var tipo = $(e.relatedTarget).data('tipo');
		var stockMin=$(e.relatedTarget).data('stock-min');
		var title = $(e.relatedTarget).data('title');
		//aca lo asignamos a un hidden dentro del form que esta en el modal
	    $(e.currentTarget).find('input[name="inputCodigoM"]').val(id);
		$(e.currentTarget).find('input[name="inputMaterialM"]').val(mat);
		$(e.currentTarget).find('input[name="inputExistenciaM"]').val(existencia);
		$(e.currentTarget).find('input[name="inputUnidadM"]').val(unidad);
		$(e.currentTarget).find('input[name="inputPrecioUnidadM"]').val(precio);
		$(e.currentTarget).find('input[name="inputEditarTipoMaterialM"]').val(tipo);      //.. variable falsa para tipo radio ...
		$(e.currentTarget).find('input[name="inputEstockMinimoM"]').val(stockMin);
		
		if(tipo=="C" ){
			document.getElementById('inputTipoMaterial1M').checked = true;	
		}else{
			document.getElementById('inputTipoMaterial2M').checked = true;
		}

		//esto solo pone el id pasado por tag para mostralo en el modal
		$(e.currentTarget).find('.modal-title').html(title);		
		
	});
	
	
	$('#editarModal').on("click", 'input[type="submit"], button[type="submit"]', function() {       
		var form= $('#editarModal').find("form");
		var action=form.attr("action");
		//aca recuperamos el id que paso por tag al modal
		var idele1=$(form).find('input[name="inputCodigoM"]').val();	
		var idele2=$(form).find('input[name="inputMaterialM"]').val();
		var idele3=$(form).find('input[name="inputExistenciaM"]').val();
		var idele4=$(form).find('input[name="inputUnidadM"]').val();
		var idele5=$(form).find('input[name="inputPrecioUnidadM"]').val();
		var idele6=$(form).find('input[name="inputEditarTipoMaterialM"]').val();	//.. variable falsa para tipo radio ...
		var idele7=$(form).find('input[name="inputEstockMinimoM"]').val();	
					
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
	
	
	$("#btnGrabarNuevoMaterial").click(function(){
	// grabar registro en tablas [almacen/bodega]
    	grabarNuevoMaterial();
	});
	
	
	$("#btnGrabarModificacionMaterial").click(function(){
	// grabar registro en tablas [almacen/bodega]
    	grabarModificacionMaterial();
	});
	
	  
}); // fin document.ready 


function grabarNuevoMaterial(){
	
	var registrosValidos= true;	  // ... bandera para grabar o no grabar registros ...
	
	if($("#inputCodigo").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de CODIGO está vacío");
			var registrosValidos= false;	
	}
	
	if($("#inputMaterial").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de NOMBRE MATERIAL está vacío");
			var registrosValidos= false;	
	}
	
	if($("#inputExistencia").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de EXISTENCIA está vacío");
			var registrosValidos= false;	
	}
	
	if($("#inputPrecioUnidad").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de PRECIO UNIDAD está vacío");
			var registrosValidos= false;	
	}
	
	if($("#inputUnidad").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de UNIDAD está vacío");
			var registrosValidos= false;	
	}	
	
	if($("#inputTipoMaterial").lenght==0 ){
			alert("¡¡¡ E R R O R !!! ... El contenido de TIPO MATERIAL está vacío");
			var registrosValidos= false;	
	}
	
	if($("#inputEstockMinimo").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de ESTOCK MINIMO está vacío");
			var registrosValidos= false;	
	}
		
	if(!registrosValidos){
		alert('Corrija los campos que están vacíos');
	}else{
		$("#formGrabarNuevoRegistro_").submit(); // ...  graba registros ...
	}
			
}	// ... fin funcion grabarNuevoMaterial() ...


function grabarModificacionMaterial(){
	
	var registrosValidosM= true;	  // ... bandera para grabar o no grabar registros ...
	
	if($("#inputMaterialM").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de NOMBRE MATERIAL está vacío");
			var registrosValidosM= false;	
	}
	
	if($("#inputExistenciaM").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de EXISTENCIA está vacío");
			var registrosValidosM= false;	
	}
	
	if($("#inputPrecioUnidadM").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de PRECIO UNIDAD está vacío");
			var registrosValidosM= false;	
	}
	
	
	if($("#inputUnidadM").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de UNIDAD está vacío");
			var registrosValidosM= false;	
	}	
	
/*	
	if($("#inputEditarTipoMaterialM").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de TIPO MATERIAL está vacío");
			var registrosValidosM= false;	
	}

*/
	
	if($("#inputEstockMinimoM").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de ESTOCK MINIMO está vacío");
			var registrosValidosM= false;	
	}
	
	if(!registrosValidosM){
		alert('Corrija los campos que están vacíos');
	}else{
		$("#formEditarRegistro_").submit(); // ...  graba registros ...
	}
			
}	// ... fin funcion grabarModificacionMaterial() ...


function validarCodigoNoRepetido(numero){  
  		var codExiste='';	//... variable se guarda el resultado de si codigo esta repetido o no ...
		var codMat= numero;	
		$.ajax({
	    	url: "validarCodigoMaterialCrud",  //"convertirNumeroAliteral('1490)",
	        type:"POST",
	        data:{nombreTabla:'almacen',campo:'codInsumo',patron:codMat},
	        dataType: "json",
	        success: function(data){     
	     	   codExiste= data;	   
	     	   if(codExiste==true){
			       alert('ERROR este código '+numero+' ya existe'); 
				   $("#inputCodigo").val("");
		    	}	//..fin IF ...          
	        }  //... fin SUCESS ...
    	});	//..fin AJAX ...

}   // fin ... validarCodigoNoRepetido ...




function validarExistencia(numero){		
	var cantidad=parseFloat( numero ); // convierte de string to number 
	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
	if (!/^\d{1,7}(\.\d{1,3})?$/.test(numero)){  // ...hasta 7 digitos parte entera y hasta 3 parte decimal ...
		alert("El valor " + numero + " para EXISTENCIA no es válido");
		$("#inputExistencia").val("");   // borra celda 
	}
	    		
}   // fin ... validarExistencia ...

function validarPrecioUnidad(numero){	
	var cantidad=parseFloat( numero ); // convierte de string to number 
	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
	if (!/^\d{1,7}(\.\d{1,3})?$/.test(numero)){  // ...hasta 7 digitos parte entera y hasta 3 parte decimal ...
		alert("El valor " + numero + " para PRECIO UNIDAD no es válido");
		$("#inputPrecioUnidad").val("");   // borra celda 
	}
	    		
}   // fin ... validarPrecioUnidad ...

function validarPrecioUnidadM(numero){	
	var cantidad=parseFloat( numero ); // convierte de string to number 
	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
	if (!/^\d{1,7}(\.\d{1,3})?$/.test(numero)){  // ...hasta 7 digitos parte entera y hasta 3 parte decimal ...
		alert("El valor " + numero + " para PRECIO UNIDAD no es válido");
		$("#inputPrecioUnidadM").val("");   // borra celda 
	}
	    		
}   // fin ... validarPrecioUnidad ...

function validarEstockMinimo(numero){		
	var cantidad=parseFloat( numero ); // convierte de string to number 
	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
	if (!/^\d{1,7}(\.\d{1,3})?$/.test(numero)){  // ...hasta 7 digitos parte entera y hasta 3 parte decimal ...
		alert("El valor " + numero + " para ESTOCK MINIMO no es válido");
		$("#inputEstockMinimo").val("");   // borra celda 
	}
	    		
}   // fin ... validarEstockMinimo ...

function validarEstockMinimoM(numero){		
	var cantidad=parseFloat( numero ); // convierte de string to number 
	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
	if (!/^\d{1,7}(\.\d{1,3})?$/.test(numero)){  // ...hasta 7 digitos parte entera y hasta 3 parte decimal ...
		alert("El valor " + numero + " para ESTOCK MINIMO no es válido");
		$("#inputEstockMinimoM").val("");   // borra celda 
	}
	    		
}   // fin ... validarEstockMinimo ...
		
</script>

<div class="jumbotron" id="cuerpoCabecera" >	<!--cuerpoCrudMaterial-->
		
	    <form class="form-horizontal" method="post" action="<?=base_url()?>materiales/buscarMaterialCrud" id="formBuscarRegistro_" name="formBuscarRegistro_" >
	    	<div style="height:2px;"></div>
			<p align="center" class="tituloReporte" ><span class="label label-default"> CRUD material </span></p>
	
		   <div class="row">
		   	
			   	<div class="col-xs-1 col-md-1"> 
					<span></span>
			   	</div>
			   	
			   	<div class="col-xs-2 col-md-2"> 
			    	<button type="button"  class="btn btn-success btn-sm" id="openLightBox" title='Crea registro de nuevo material en almacén y bodega'><span class="glyphicon glyphicon-plus-sign"></span> Añadir material</button>
			    </div>
			   	     
				<div class="col-lg-6">    
			    	<div class="input-group input-group-sm">
			    		<input type="text" class="form-control input-sm" id="inputBuscarPatron" name="inputBuscarPatron" value='<?= $consultaMaterial ?>' placeholder="buscar ...">
						
						
						<div class="input-group-btn">
                        	<button type="submit" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-search"></span></button>
                    	</div>
			    	</div>
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
	
	<table width="99%" class="table table-striped table-bordered table-condensed" id="tabla1">   		
		<thead>
    		<tr style="background-color: #b9e9ec;" class='letraDetalle'>
    			<th style="width: 60px;">C&oacute;digo</th>
				<th style="width: 356px;">Material</th>
				<th style="width: 99px;">Existencia</th>
				<th style="width: 60px;">Unidad</th>
				<th style="width: 80px;">Precio Unidad Bs.</th>
				<th style="width: 40px;">Tipo Material</th>
				<th style="width: 140px;" colspan="2">Acciones</th>
    		</tr>
 		</thead>
 		
 		<tbody>	
			<?php  $posicionFila=-1; ?>			
	        <?php foreach($listaMaterial as $material):?>
				<tr class='letraDetalle'>
				
					<?php  $posicionFila=$posicionFila+1;  //...posicionFila
					
					 echo"<td style='width:50px;'><input type='text' id='idMat_".$posicionFila."' name='idMat_".$posicionFila."' value='".$material->codInsumo."' readonly='readonly' style='border:none; width:50px;' /></td>";
						
					 echo"<td style='width: 360px;'><input type='text' id='mat_".$posicionFila."' name='mat_".$posicionFila."' value='".$material->nombreInsumo."' readonly='readonly' style='border:none; width:360px;' /></td>";
							 
					 echo"<td style='width: 80px;'><input type='text' class='letraNumero' id='existMat_".$posicionFila."' name='existMat_".$posicionFila."' value='".number_format($material->existencia,2)."' readonly='readonly' style='border:none; width:80px;' /></td>";
						
					 echo"<td style='width: 40px;'><input type='text' id='unidadMat_".$posicionFila."' name='unidadMat_".$posicionFila."' value='".$material->unidad."' readonly='readonly' style='border:none; width:40px;' /></td>";
						
					 echo"<td style='width: 80px;'><input type='text' class='letraNumero' id='precioMat_".$posicionFila."' name='precioMat_".$posicionFila."' value='".number_format($material->precioUnidad,3)."' readonly='readonly' style='border:none; width:80px;' /></td>";
							
					 echo"<td style='width: 20px;'><input type='text' class='letraTipoMaterial' id='tipoMat_".$posicionFila."' name='tipoMat_".$posicionFila."' value='".$material->tipoInsumo."' readonly='readonly' style='border:none; width:20px;' /></td>";
						
					 echo"<td style='width:70px;background-color:#b9e9ec;' width='40' align='left'>
					 <a href='#' data-title='Editar registro' data-item-id='".$material->codInsumo."' data-mat='".$material->nombreInsumo."' data-existencia='".$material->existencia."' 
					 data-unidad='".$material->unidad."' data-precio='".$material->precioUnidad."' data-tipo='".$material->tipoInsumo."' data-stock-min='".$material->stockMinimo."' data-toggle='modal' data-target='#editarModal'><span class='glyphicon glyphicon-pencil'></span> Editar</a></td>";
				
					 echo"<td style='width:70px;background-color:#a5d4da;' width='40' align='left'><a href='#' data-title='Mensaje:' data-item-id='".$material->codInsumo."' data-mat='".$material->nombreInsumo."' data-toggle='modal' data-target='#borrarModal'><span class='glyphicon glyphicon-trash'></span> Eliminar</a></td>"; 
		
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


<!-- ... inicio  lightbox crear nuevo material... -->

<div class="modal fade" id="crearModal" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
      	
      	 <form class="form-horizontal" method="post" action="<?=base_url()?>materiales/grabarNuevoMaterialCrud" id="formGrabarNuevoRegistro_" name="formGrabarNuevoRegistro_" >
	 
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Código: </span>
			  	<input type='text' class='form-control input-sm' id='inputCodigo' name='inputCodigo' placeholder='codigo&hellip;' onChange='validarCodigoNoRepetido(this.value);' > 
			</div>
        
        	<div style="height:5px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Nombre material: </span>
			  <input type="text" class="form-control input-sm" id="inputMaterial" name="inputMaterial" placeholder="nombre del material &hellip;">
			</div>
			
			<div style="height:5px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Existencia: </span>
			  <input type="text" class="form-control input-sm" id="inputExistencia" name="inputExistencia" readonly='readonly' value=0.00 placeholder="cantidad en existencia &hellip;" onChange='validarExistencia(this.value);'>
			</div>
			
			<div style="height:5px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Unidad: </span>
			  <input type="text" class="form-control input-sm" id="inputUnidad" name="inputUnidad" placeholder="unidad &hellip;">
			</div>
			
			<div style="height:5px;"></div>
			
			<div class="input-group input-group-sm">
			  <span class="input-group-addon">Precio Unidad: </span>
			  <input type="text" class="form-control input-sm" id="inputPrecioUnidad" name="inputPrecioUnidad" placeholder="precio unidad &hellip;" onChange='validarPrecioUnidad(this.value);'>
			</div>
			
			<div style="height:10px;"></div>
			
			<div class="input-group" style="font-size:12px;">
	            <label class="control-label col-xs-4">Tipo Mat.:</label>
	            <div class="col-xs-4">
	                <label class="radio-inline">
	                    <input type="radio" id="inputTipoMaterial1" name="inputTipoMaterial" value="C" checked="checked"> Comprado
	                </label>
	            </div>
	            <div class="col-xs-4">
	                <label class="radio-inline">
	                    <input type="radio" id="inputTipoMaterial2" name="inputTipoMaterial" value="F"> Fabricado
	                </label>
	            </div>
        	</div>
			
			<div style="height:10px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Estock mínimo: </span>
			  <input type="text" class="form-control input-sm" id="inputEstockMinimo" name="inputEstockMinimo" placeholder="estock mínimo &hellip;" onChange='validarEstockMinimo(this.value);'>
			</div>
        
      	</form>
      	
      			        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-off"></span> Cerrar</button>
        <button type="submit" class="btn btn-primary btn-sm" id="btnGrabarNuevoMaterial"><span class="glyphicon glyphicon-hdd"></span> Grabar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- ... fin  lightbox crear nuevo material ... -->


<!-- ...  lightbox borrar material ... -->
<div class="modal fade" id="borrarModal" tabindex="-1" role="dialog" aria-labelledby="borrarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title" id="borrarModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
	  <form class="form-horizontal" data-async data-target="#rating-modal" action="<?=base_url()?>materiales/eliminarMaterialCrud" method="POST">
        ¿ Esta seguro de eliminar el código <span id="showCodigo" style="font-weight : bold;"></span> <span id="showMaterial" style="font-weight : bold;"></span> ?
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

<!-- ... fin  lightbox borrar material ... -->


<!-- ... inicio  lightbox editar material... -->

<div class="modal fade" id="editarModal" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
      	
      	
      	 <form class="form-horizontal"   data-async data-target="#rating-modal" action="<?=base_url()?>materiales/actualizarMaterialCrud" id="formEditarRegistro_" name="formEditarRegistro_" method="POST">
      	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Código: </span>
			  	<input type='text' class='form-control input-sm' id='inputCodigoM' name='inputCodigoM' value='' readonly='readonly' placeholder='codigo&hellip;' onChange='validarCodigo(this.value);' > 
			</div>
        
        	<div style="height:5px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Nombre material: </span>
			  <input type="text" class="form-control input-sm" id="inputMaterialM" name="inputMaterialM" value='' placeholder="nombre del material &hellip;">
			</div>
			
			<div style="height:5px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Existencia: </span>
			  <input type="text" class="form-control input-sm" id="inputExistenciaM" name="inputExistenciaM" value='' readonly='readonly' placeholder="cantidad en existencia &hellip;" onChange='validarExistenciaM(this.value);'>
			</div>
			
			<div style="height:5px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Unidad: </span>
			  <input type="text" class="form-control input-sm" id="inputUnidadM" name="inputUnidadM" value='' placeholder="unidad &hellip;">
			</div>
			
			<div style="height:5px;"></div>
			
			<div class="input-group input-group-sm">
			  <span class="input-group-addon">Precio Unidad: </span>
			  <input type="text" class="form-control input-sm" id="inputPrecioUnidadM" name="inputPrecioUnidadM" value='' placeholder="precio unidad &hellip;" onChange='validarPrecioUnidadM(this.value);'>
			</div>
			
			<div style="height:10px;"></div>
			
			<div class="input-group" style="font-size:12px;">
	            <label class="control-label col-xs-4">Tipo Mat.:</label>
	            <div class="col-xs-4">
	                <label class="radio-inline">
	                    <input type="radio" id="inputTipoMaterial1M" name="inputTipoMaterialM" value="C"> Comprado
	                </label>
	            </div>
	            <div class="col-xs-4">
	                <label class="radio-inline">
	                    <input type="radio" id="inputTipoMaterial2M" name="inputTipoMaterialM" value="F"> Fabricado
	                </label>
	            </div>
        	</div>
			
			<div style="height:10px;"></div>

			
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Estock mínimo: </span>
			  <input type="text" class="form-control input-sm" id="inputEstockMinimoM" name="inputEstockMinimoM" value='' placeholder="estock mínimo &hellip;" onChange='validarEstockMinimoM(this.value);'>
			</div>
        
      	</form>
  		        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-off"></span> Cerrar</button>
        <button type="submit" id="btnGrabarModificacionMaterial" class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-hdd"></span> Grabar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- ... fin  lightbox editar material ... -->

