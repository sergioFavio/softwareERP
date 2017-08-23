
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
	
	$('[data-toggle="tooltip"]').tooltip();
		
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
		var proveedor =$(e.relatedTarget).data('proveedor');
		var title = $(e.relatedTarget).data('title');
		//aca lo asignamos a un hidden dentro del form que esta en el modal
	    $(e.currentTarget).find('input[name="codigo"]').val(id);
		//esto solo pone el id pasado por tag para mostralo en el modal
		$(e.currentTarget).find('#showCodigo').html(id);
		$(e.currentTarget).find('#showMaterial').html(proveedor);
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

	
	$('#editarModal').on('show.bs.modal', function(e){  
		//aca recuperamos el id que pasaremos por tag al modal  
		var id = $(e.relatedTarget).data('item-id'); 
		var proveedor = $(e.relatedTarget).data('proveedor');
		var direccion = $(e.relatedTarget).data('direccion');
		var ciudad = $(e.relatedTarget).data('ciudad');
		var telefono = $(e.relatedTarget).data('telefono');
		var correo = $(e.relatedTarget).data('correo');
		var sitioWeb=$(e.relatedTarget).data('sitio-web');
		var title = $(e.relatedTarget).data('title');
		//aca lo asignamos a un hidden dentro del form que esta en el modal
	    $(e.currentTarget).find('input[name="inputCodigoM"]').val(id);
		$(e.currentTarget).find('input[name="inputProveedorM"]').val(proveedor);
		$(e.currentTarget).find('input[name="inputDireccionM"]').val(direccion);
		$(e.currentTarget).find('input[name="inputCiudadM"]').val(ciudad);
		$(e.currentTarget).find('input[name="inputTelefonoM"]').val(telefono);
		$(e.currentTarget).find('input[name="inputCorreoM"]').val(correo);     
		$(e.currentTarget).find('input[name="inputWebM"]').val(sitioWeb);
		
		//esto solo pone el id pasado por tag para mostralo en el modal
		$(e.currentTarget).find('.modal-title').html(title);		
		
	});
	
	
	$('#editarModal').on("click", 'input[type="submit"], button[type="submit"]', function() {       
		var form= $('#editarModal').find("form");
		var action=form.attr("action");
		//aca recuperamos el id que paso por tag al modal
		var idele1=$(form).find('input[name="inputCodigoM"]').val();	
		var idele2=$(form).find('input[name="inputProveedorM"]').val();
		var idele3=$(form).find('input[name="inputDireccionM"]').val();
		var idele4=$(form).find('input[name="inputCiudadM"]').val();
		var idele5=$(form).find('input[name="inputTelefonoM"]').val();
		var idele6=$(form).find('input[name="inputCorreoM"]').val();	
		var idele7=$(form).find('input[name="inputWebM"]').val();	
					
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
	
	
	$("#btnGrabarNuevoProveedor").click(function(){
	// grabar registro en tablas [almacen/bodega]
    	grabarNuevoProveedor();
	});
	
	
	$("#btnGrabarModificacionProveedor").click(function(){
	// grabar registro en tabla [proveedores]
    	grabarModificacionProveedor();
	});
	
}); // fin document.ready 


function grabarNuevoProveedor(){
	
	var registrosValidos= true;	  // ... bandera para grabar o no grabar registros ...
	
	if($("#inputCodigo").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de CODIGO está vacío");
			var registrosValidos= false;	
	}
	
	if($("#inputProveedor").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de NOMBRE PROVEEDOR está vacío");
			var registrosValidos= false;	
	}
	
	if($("#inputDireccion").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de DIRECCION está vacío");
			var registrosValidos= false;	
	}
	
	if($("#inputTelefono").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de TELEFONO está vacío");
			var registrosValidos= false;	
	}
	
	if($("#inputCiudad").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de CIUDAD está vacío");
			var registrosValidos= false;	
	}	
	
//	if($("#inputCorreo").lenght==0 ){
//			alert("¡¡¡ E R R O R !!! ... El contenido de CORREO ELECTRONICO está vacío");
//			var registrosValidos= false;	
//	}
	
//	if($("#inputWeb").val()=="" ){
//			alert("¡¡¡ E R R O R !!! ... El contenido de SITIO WEB está vacío");
//			var registrosValidos= false;	
//	}
		
	if(!registrosValidos){
		alert('Corrija los campos que están vacíos');
	}else{
		$("#formGrabarNuevoRegistro_").submit(); // ...  graba registros ...
	}
			
}	// ... fin funcion grabarNuevoMaterial() ...


function grabarModificacionProveedor(){
	
	var registrosValidosM= true;	  // ... bandera para grabar o no grabar registros ...
	
	if($("#inputProveedorM").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de NOMBRE PROVEEDOR está vacío");
			var registrosValidosM= false;	
	}
	
	if($("#inputDireccionM").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de DIRECCION está vacío");
			var registrosValidosM= false;	
	}
	
	if($("#inputTelefonoM").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de TELEFONO está vacío");
			var registrosValidosM= false;	
	}
	
	
	if($("#inputCiudadM").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de CIUDAD está vacío");
			var registrosValidosM= false;	
	}	
	
//	if($("#inputWebM").val()=="" ){
//		alert("¡¡¡ E R R O R !!! ... El contenido de SITIO WEB está vacío");
//		var registrosValidosM= false;	
//	}
	
	if(!registrosValidosM){
		alert('Corrija los campos que están vacíos');
	}else{
		$("#formEditarRegistro_").submit(); // ...  graba registros ...
	}
			
}	// ... fin funcion grabarModificacionProveedor() ...


function validarCodigoNoRepetido(numero){  
  		var codExiste='';	//... variable se guarda el resultado de si codigo esta repetido o no ...
		var codMat= numero;	
		$.ajax({
	    	url: "validarCodigoProveedorCrud",  //"convertirNumeroAliteral('1490)",
	        type:"POST",
	        data:{nombreTabla:'proveedores',campo:'codProveedor',patron:codMat},
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

function validarCorreoElectronico(cadenaEmail){
	if (cadenaEmail.indexOf('@')==-1 || cadenaEmail.indexOf('.')==-1) {				//... si no se encuentra la subcadena en la cadena ...
		alert("¡¡¡ E R R O R !!! ... El contenido de CORREO ELECTRONICO no es válido");
		$("#inputCorreo").val("");   // borra celda de correo elctronico ...
	}
}	//... fin validarCorreoElectronico ...

function validarCorreoElectronicoM(cadenaEmail){
	if (cadenaEmail.indexOf('@')==-1 || cadenaEmail.indexOf('.')==-1) {				//... si no se encuentra la subcadena en la cadena ...
		alert("¡¡¡ E R R O R !!! ... El contenido de CORREO ELECTRONICO no es válido");
		$("#inputCorreoM").val("");   // borra celda de correo elctronico ...
	}
}	//... fin validarCorreoElectronicoM ...

function validarSitioWeb(cadenaEmail){
	if (cadenaEmail.indexOf('w')==-1 || cadenaEmail.indexOf('.')==-1) {				//... si no se encuentra la subcadena en la cadena ...
		alert("¡¡¡ E R R O R !!! ... El contenido de SITIO WEB no es válido");
		$("#inputWeb").val("");   // borra celda de correo elctronico ...
	}
}	//... fin validarCorreoElectronico ...

function validarSitioWebM(cadenaEmail){
	if (cadenaEmail.indexOf('w')==-1 || cadenaEmail.indexOf('.')==-1) {				//... si no se encuentra la subcadena en la cadena ...
		alert("¡¡¡ E R R O R !!! ... El contenido de SITIO WEB no es válido");
		$("#inputWebM").val("");   // borra celda de correo elctronico ...
	}
}	//... fin validarCorreoElectronico ...

		
</script>

<div class="jumbotron" id="cuerpoCabecera" >	<!--cuerpoCrudMaterial-->
	
		<?php
			if($campoBusqueda=="proveedor"){
				$buscaPor="buscarProveedor";
			}else{
				$buscaPor="buscarProveedorPorCodigo";
			}
		?>
	
	    <form class="form-horizontal" method="post" action="<?=base_url()?>proveedores/<?= $buscaPor ?>" id="formBuscarRegistro_" name="formBuscarRegistro_" >
	    	<div style="height:2px;"></div>
			<p align="center" class="tituloReporte" ><span class="label label-default"> CRUD Proveedores </span></p>
	
		   <div class="row">
		   	
			   	<div class="col-xs-1"> 
					<span></span>
			   	</div>
			   	
			   	<div class="col-xs-1"> 
			    	<button type="button"  class="btn btn-success btn-sm" id="openLightBox" title='Crea registro de nuevo proveedor'><span class="glyphicon glyphicon-plus-sign"></span> Añadir proveedor</button>
			    </div>
			    
				<div class="col-xs-2"> 
					<span></span>
			   	</div>
						   			      
				<div class="col-xs-4">    
			    	<div class="input-group input-group-sm">
			    		<input type="text" class="form-control input-sm" id="inputBuscarPatron" name="inputBuscarPatron" value='<?= $consultaProveedor ?>' placeholder="buscar por ...<?= $campoBusqueda ?>">
						
						<div class="input-group-btn">
                        	<button type="submit" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-search"></span></button>
                    	</div>
			    	</div>
			    </div><!-- /.col-lg-6 -->	
			        
				<div class="col-xs-1"> 
					<span></span>
			   	</div>	
			   	
			   	<input type="hidden"  name="campoBusqueda" value="<?= $campoBusqueda ?>" />     <!--  campoBusqueda: nombreInsumo/codInsumo -->
	    	     	
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
    			<th style="width:60px;text-align:center">C&oacute;digo</th>
				<th style="width:200px;text-align:center">Proveedor</th>
				<th style="width:200px;text-align:center">Direcci&oacute;n</th>
				<th style="width:156px;text-align:center">Ciudad</th>
				<th style="width:60px;text-align:center">Tel&eacute;fono</th>
				<th style="width:170px;text-align:center">Acciones</th>
    		</tr>
 		</thead>
 		
 		<tbody>	
			<?php  $posicionFila=-1; ?>			
	        <?php foreach($listaProveedor as $proveedor):?>
				<tr class='letraDetalle'>
				
					<?php  $posicionFila=$posicionFila+1;  //...posicionFila
					
					 echo"<td style='width:50px;'><input type='text' id='id_".$posicionFila."' name='id_".$posicionFila."' value='".$proveedor->codProveedor."' readonly='readonly' style='border:none; width:50px;' /></td>";
						
					 echo"<td style='width: 200px;'><input type='text' id='proveedor_".$posicionFila."' name='proveedor_".$posicionFila."' value='".$proveedor->proveedor."' readonly='readonly' style='border:none; width:200px;' data-toggle='tooltip' title='$proveedor->correoElectronico'/></td>";
							 
					 echo"<td style='width: 200px;'><input type='text' id='direccion_".$posicionFila."' name='direccion_".$posicionFila."' value='".$proveedor->direccion."' readonly='readonly' style='border:none; width:200px;' data-toggle='tooltip' title='$proveedor->sitioWeb'/></td>";
						
					 echo"<td style='width: 120px;'><input type='text' id='ciudad_".$posicionFila."' name='ciudad_".$posicionFila."' value='".$proveedor->ciudad."' readonly='readonly' style='border:none; width:120px;' /></td>";
						
					 echo"<td style='width: 80px;'><input type='text' class='letraNumero' id='telefono_".$posicionFila."' name='telefono_".$posicionFila."' value='".$proveedor->telefono."' readonly='readonly' style='border:none; width:80px;' /></td>";
										
					 echo"<td style='width:70px;background-color:#b9e9ec;' width='40' align='left'>
					 <a href='#' data-title='Editar registro de proveedor' data-item-id='".$proveedor->codProveedor."' data-proveedor='".$proveedor->proveedor."' data-direccion='".$proveedor->direccion."' 
					 data-ciudad='".$proveedor->ciudad."' data-telefono='".$proveedor->telefono."' data-correo='".$proveedor->correoElectronico."' data-sitio-web='".$proveedor->sitioWeb."' data-toggle='modal' data-target='#editarModal'><span class='glyphicon glyphicon-pencil'></span> Editar</a></td>";
				
					 echo"<td style='width:70px;background-color:#a5d4da;' width='40' align='left'><a href='#' data-title='Eliminar proveedor' data-item-id='".$proveedor->codProveedor."' data-proveedor='".$proveedor->proveedor."' data-toggle='modal' data-target='#borrarModal'><span class='glyphicon glyphicon-trash'></span> Eliminar</a></td>"; 
		
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


<!-- ... inicio  lightbox crear nuevo proveedor ... -->

<div class="modal fade" id="crearModal" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
      	
      	 <form class="form-horizontal" method="post" action="<?=base_url()?>proveedores/grabarNuevoProveedor" id="formGrabarNuevoRegistro_" name="formGrabarNuevoRegistro_" >
	 
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Código: </span>
			  	<input type='text' class='form-control input-sm' id='inputCodigo' name='inputCodigo' value='<?= $nuevoCodigoProveedor  ?>' readonly='readonly' placeholder='codigo&hellip;' onChange='validarCodigoNoRepetido(this.value);' > 
			</div>
        
        	<div style="height:5px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Proveedor: </span>
			  <input type="text" class="form-control input-sm" id="inputProveedor" name="inputProveedor" placeholder="nombre del proveedor &hellip;">
			</div>
			
			<div style="height:5px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Direcci&oacute;n: </span>
			  <input type="text" class="form-control input-sm" id="inputDireccion" name="inputDireccion" placeholder="direcci&oacute;n &hellip;" >
			</div>
			
			<div style="height:5px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Ciudad: </span>
			  <input type="text" class="form-control input-sm" id="inputCiudad" name="inputCiudad" placeholder="ciudad &hellip;">
			</div>
			
			<div style="height:5px;"></div>
			
			<div class="input-group input-group-sm">
			  <span class="input-group-addon">Tel&eacute;fono: </span>
			  <input type="text" class="form-control input-sm" id="inputTelefono" name="inputTelefono" placeholder="tel&eacute;fono &hellip;" >
			</div>
			
			<div style="height:10px;"></div>
			
			<div class="input-group input-group-sm">
			  <span class="input-group-addon">Correo Electr&oacute;nico: </span>
			  <input type="text" class="form-control input-sm" id="inputCorreo" name="inputCorreo" placeholder="correo electr&oacute;nico &hellip;" onChange='validarCorreoElectronico(this.value);'>
			</div>
			
			<div style="height:10px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Sitio Web: </span>
			  <input type="text" class="form-control input-sm" id="inputWeb" name="inputWeb" placeholder="sitio web &hellip;" onChange='validarSitioWeb(this.value);'>
			</div>
        
      	</form>
      	
      			        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-off"></span> Cerrar</button>
        <button type="submit" class="btn btn-primary btn-sm" id="btnGrabarNuevoProveedor"><span class="glyphicon glyphicon-hdd"></span> Grabar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- ... fin  lightbox crear nuevo proveedor ... -->


<!-- ...  lightbox borrar proveedor ... -->
<div class="modal fade" id="borrarModal" tabindex="-1" role="dialog" aria-labelledby="borrarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title" id="borrarModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
	  <form class="form-horizontal" data-async data-target="#rating-modal" action="<?=base_url()?>proveedores/eliminarProveedor" method="POST">
        ¿ Esta seguro de eliminar el proveedor con código <span id="showCodigo" style="font-weight : bold;"></span> <span id="showMaterial" style="font-weight : bold;"></span> ?
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

<!-- ... fin  lightbox borrar proveedor ... -->


<!-- ... inicio  lightbox editar proveedor... -->

<div class="modal fade" id="editarModal" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
      	
      	
      	 <form class="form-horizontal"   data-async data-target="#rating-modal" action="<?=base_url()?>proveedores/actualizarProveedor" id="formEditarRegistro_" name="formEditarRegistro_" method="POST">
      	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Código: </span>
			  	<input type='text' class='form-control input-sm' id='inputCodigoM' name='inputCodigoM'  readonly='readonly' placeholder='codigo&hellip;' onChange='validarCodigo(this.value);' > 
			</div>
        
        	<div style="height:5px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Proveedor: </span>
			  <input type="text" class="form-control input-sm" id="inputProveedorM" name="inputProveedorM"  placeholder="nombre del proveedor &hellip;">
			</div>
			
			<div style="height:5px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Direcci&oacute;n: </span>
			  <input type="text" class="form-control input-sm" id="inputDireccionM" name="inputDireccionM"  placeholder="direcci&oacute;n &hellip;" >
			</div>
			
			<div style="height:5px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Ciudad: </span>
			  <input type="text" class="form-control input-sm" id="inputCiudadM" name="inputCiudadM"  placeholder="ciudad &hellip;">
			</div>
			
			<div style="height:5px;"></div>
			
			<div class="input-group input-group-sm">
			  <span class="input-group-addon">Tel&eacute;fono: </span>
			  <input type="text" class="form-control input-sm" id="inputTelefonoM" name="inputTelefonoM"  placeholder="tel&eacute;fono &hellip;" >
			</div>
			
			<div style="height:10px;"></div>
			
            <div class="input-group input-group-sm">
			  <span class="input-group-addon">Correo Electr&oacute;nico: </span>
			  <input type="text" class="form-control input-sm" id="inputCorreoM" name="inputCorreoM"  placeholder="correo electr&oacute;nico &hellip;" onChange='validarCorreoElectronicoM(this.value);'>
			</div>
		
			<div style="height:10px;"></div>

			
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Sitio Web: </span>
			  <input type="text" class="form-control input-sm" id="inputWebM" name="inputWebM"  placeholder="sitio web &hellip;" onChange='validarSitioWebM(this.value);'>
			</div>
        
      	</form>
  		        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-off"></span> Cerrar</button>
        <button type="submit" id="btnGrabarModificacionProveedor" class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-hdd"></span> Grabar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- ... fin  lightbox editar proveedor ... -->

