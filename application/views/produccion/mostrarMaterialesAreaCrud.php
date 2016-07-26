
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery-ui-1.8.20.custom.min.js"></script>
	
<style type="text/css">
	.letraDetalle{font-size:11px;text-align:center; }
	.letraNumero{font-size:11px;text-align:right; }

	#cuerpoCabecera{margin:0 auto; padding:0; width:990px; height:50px; background:#f4f4f4;}
	#cuerpoDetalle{margin:2px auto; padding:10px; width:990px; background:#f4f4f4; }
	
	#crearModal,#editarModal, #borrarModal{padding-top:90px;}  /* ... baja la ventana modal más al centro vertical ... */

	
</style>
<script type="text/javascript">
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
		var  largo= $(e.relatedTarget).data('largo');
		var  ancho= $(e.relatedTarget).data('ancho');
		var unidad = $(e.relatedTarget).data('unidad');
		var precio = $(e.relatedTarget).data('precio');
		var precioM2 = $(e.relatedTarget).data('precio-m2');
		var title = $(e.relatedTarget).data('title');
		//aca lo asignamos a un hidden dentro del form que esta en el modal
	    $(e.currentTarget).find('input[name="inputCodigoM"]').val(id);
		$(e.currentTarget).find('input[name="inputMaterialM"]').val(mat);
		$(e.currentTarget).find('input[name="inputLargoM"]').val(largo);
		$(e.currentTarget).find('input[name="inputAnchoM"]').val(ancho);
		$(e.currentTarget).find('input[name="inputUnidadM"]').val(unidad);
		$(e.currentTarget).find('input[name="inputPrecioUnidadM"]').val(precio);
		$(e.currentTarget).find('input[name="inputPrecioM2M"]').val(precioM2);
		//$(e.currentTarget).find('input[name="inputEstockMinimoM"]').val(0.00);

		//esto solo pone el id pasado por tag para mostralo en el modal
		$(e.currentTarget).find('.modal-title').html(title);		
		
	});
	
	
	$('#editarModal').on("click", 'input[type="submit"], button[type="submit"]', function() {       
		var form= $('#editarModal').find("form");
		var action=form.attr("action");
		//aca recuperamos el id que paso por tag al modal
		var idele1=$(form).find('input[name="inputCodigoM"]').val();	
		var idele2=$(form).find('input[name="inputMaterialM"]').val();
		var idele3=$(form).find('input[name="inputLargoM"]').val();
		var idele4=$(form).find('input[name="inputAnchoM"]').val();
		var idele5=$(form).find('input[name="inputUnidadM"]').val();
		var idele6=$(form).find('input[name="inputPrecioUnidadM"]').val();
		var idele7=$(form).find('input[name="inputPrecioM2M"]').val();	
					
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
	
	if($("#input").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de  está vacío");
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
	
	if($("#inputM").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de  está vacío");
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
	
	
	if(!registrosValidosM){
		alert('Corrija los campos que están vacíos');
	}else{
		$("#formEditarRegistro_").submit(); // ...  graba registros ...
	}
			
}	// ... fin funcion grabarModificacionMaterial() ...

function validarCodigo(numero){
	if(!validarCodigoNoRepetido(numero)){
		alert('ERROR este código '+numero+' ya existe'); 
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
       
	     if( $("#idMat_"+centro).val()==numero){
	     	 return false;
	     }
	     else if(numero < $("#idMat_"+centro).val() ){
			sup=centro-1;
	     }
	     else {
	       inf=centro+1;
	     }
	} // ...fin while
    return true;	
}   // fin ... validarCodigoNoRepetido ...

function validarMedida(numero,sufijo){		
	var cantidad=parseFloat( numero ); // convierte de string to number 
	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
	if (!/^\d{1,7}(\.\d{1,3})?$/.test(numero)){  // ...hasta 7 digitos parte entera y hasta 3 parte decimal ...
		alert("El valor " + numero + " para "+ sufijo+ " no es válido");
		$("#input"+sufijo).val("");   // borra celda 
	}
	    		
}   // fin ... validar ...

function validarPrecio(numero,sufijo){	
	var cantidad=parseFloat( numero ); // convierte de string to number 
	//if (!/^([0-9])*$/.test(numero))  // ... solo numeros enteros ...  
	if (!/^\d{1,7}(\.\d{1,3})?$/.test(numero)){  // ...hasta 7 digitos parte entera y hasta 3 parte decimal ...
		alert("El valor " + numero + " para PRECIO "+ sufijo+ " no es válido");
		$("#inputPrecio"+sufijo).val("");   // borra celda 
	}
	    		
}   // fin ... validarPrecioUnidad ...
</script>

<div class="jumbotron" id="cuerpoCabecera" >	<!--cuerpoCrudMaterial-->
   <div style="height:10px;"></div>
   <div class="row">
   	
	   	<div class="col-xs-1 col-md-1"> 
			<span></span>
	   	</div>
	   	
	   	<div class="col-xs-2 col-md-2"> 
	    	<button type="button"  class="btn btn-success btn-sm" id="openLightBox" title='Crea registro de nuevo material X m2'><span class="glyphicon glyphicon-plus-sign"></span> Añadir material</button>
	    </div>
	   	     
		<div class="col-lg-6">    
            <p align="center" ><span class="label label-default"> CRUD material X área </span></p>
	    </div><!-- /.col-lg-6 -->	
	    			     	
	    <div class="col-xs-2 col-md-2"> 
	    	<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</div>
	    
</div>  <!-- /.row -->
			
</div> <!-- fin ... cuerpoCabecera -->

<div style="height:5px;"></div>

<div class="jumbotron" id="cuerpoDetalle" >
<div style="height:5px;"></div>
	<table cellspacing="0" cellpadding="0"   class="display compact"  id="tabla1">
		<thead>
			<tr  class='letraDetalle'>
				<th>c&oacute;digo</th>
				<th>material</th>
				<th>largo m.</th>
				<th>ancho m.</th>
				<th>unidad</th>
				<th>Bs./m2</th>
				<th>unid. Bs.</th>
			</tr>
		</thead>
		<tbody>	
			<?php  $posicionFila=-1; ?>			
	        <?php foreach($listaMaterial as $material):?>
				<tr class='letraDetalle'>
				
					<?php  $posicionFila=$posicionFila+1;  //...posicionFila
					
					 echo"<td style='width:35px;'><input type='text' id='idMat_".$posicionFila."' name='idMat_".$posicionFila."' value='".$material['codMaterial']."' readonly='readonly' style='border:none; width:45px;' /></td>";
						
					 echo"<td style='width: 280px;'><input type='text' id='mat_".$posicionFila."' name='mat_".$posicionFila."' value='".$material['nombreMaterial']."' readonly='readonly' style='border:none; width:280px;' /></td>";
							 
					 echo"<td style='width: 50px;'><input type='text' class='letraNumero' id='Mat_".$posicionFila."' name='Mat_".$posicionFila."' value='".number_format($material['largo'],2)."' readonly='readonly' style='border:none; width:50px;' /></td>";
					
			 		 echo"<td style='width: 50px;'><input type='text' class='letraNumero' id='anchoMat_".$posicionFila."' name='anchoMat_".$posicionFila."' value='".number_format($material['ancho'],2)."' readonly='readonly' style='border:none; width:50px;' /></td>";
							
					 echo"<td style='width: 35px;'><input type='text' id='unidadMat_".$posicionFila."' name='unidadMat_".$posicionFila."' value='".$material['unidadMaterial']."' readonly='readonly' style='border:none; width:35px;' /></td>";
						
					 echo"<td style='width: 50px;'><input type='text' class='letraNumero' id='precioM2Mat_".$posicionFila."' name='precioM2Mat_".$posicionFila."' value='".number_format($material['precioMetro2'],2)."' readonly='readonly' style='border:none; width:50px;' /></td>";
					
					 echo"<td style='width: 100px;'><input type='text' class='letraNumero' id='precioMat_".$posicionFila."' name='precioMat_".$posicionFila."' value='".number_format($material['precioUnidad'],2)."' readonly='readonly' style='border:none; width:43px;' />  <a href='#' data-title='Editar registro' data-item-id='".$material['codMaterial']."' data-mat='".$material['nombreMaterial']."' data-largo='".$material['largo']."' data-ancho='".$material['ancho']."'
					 data-unidad='".$material['unidadMaterial']."' data-precio-m2='".$material['precioMetro2']."' data-precio='".$material['precioUnidad']."' data-toggle='modal' data-target='#editarModal'><span class='glyphicon glyphicon-pencil'></span> Editar</a> <a href='#' data-title='Eliminar registro' data-item-id='".$material['codMaterial']."' data-mat='".$material['nombreMaterial']."' data-toggle='modal' data-target='#borrarModal'><span class='glyphicon glyphicon-trash' ></span> Eliminar </a>  </td>";
		
				   ?>						
				</tr>
	        <?php endforeach ?>
                
			</tbody>
	</table>
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
      	
      	 <form class="form-horizontal" method="post" action="<?=base_url()?>produccion/grabarNuevoMaterialCrud" id="formGrabarNuevoRegistro_" name="formGrabarNuevoRegistro_" >
	 
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Código: </span>
			  	<input type='text' class='form-control input-sm' id='inputCodigo' name='inputCodigo' placeholder='codigo&hellip;' onChange='validarCodigo(this.value);' > 
			</div>
        
        	<div style="height:5px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Nombre material: </span>
			  <input type="text" class="form-control input-sm" id="inputMaterial" name="inputMaterial" placeholder="nombre del material &hellip;">
			</div>
			
			<div style="height:5px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Largo: </span>
			  <input type='text' class='form-control input-sm' id='inputLargo' name='inputLargo'  placeholder=' 0.00 m. &hellip;' onChange='validarMedida(this.value,"Largo");'>
			</div>
			
			<div style="height:5px;"></div>
			
			<div class="input-group input-group-sm">
			  <span class="input-group-addon">Ancho: </span>
			  <input type="text" class="form-control input-sm" id="inputAncho" name="inputAncho"  placeholder=" 0.00 m. &hellip;" onChange='validarMedida(this.value,"Ancho");'>
			</div>
			
			<div style="height:5px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Unidad: </span>
			  <input type="text" class="form-control input-sm" id="inputUnidad" name="inputUnidad" placeholder="unidad &hellip;">
			</div>
			
			<div style="height:5px;"></div>
			
			<div class="input-group input-group-sm">
			  <span class="input-group-addon">Precio metro2: </span>
			  <input type="text" class="form-control input-sm" id="inputPrecioM2" name="inputPrecioM2" placeholder="0.00 &hellip;" onChange='validarPrecio(this.value,"M2");'>
			</div>
			
			<div style="height:5px;"></div>
			
			<div class="input-group input-group-sm">
			  <span class="input-group-addon">Precio unidad: </span>
			  <input type="text" class="form-control input-sm" id="inputPrecioUnidad" name="inputPrecioUnidad" placeholder="0.00 &hellip;" onChange='validarPrecio(this.value,"Unidad");'>
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
	  <form class="form-horizontal" data-async data-target="#rating-modal" action="<?=base_url()?>produccion/eliminarMaterialCrud" method="POST">
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
      	
      	
      	 <form class="form-horizontal"   data-async data-target="#rating-modal" action="<?=base_url()?>produccion/actualizarMaterialCrud" id="formEditarRegistro_" name="formEditarRegistro_" method="POST">
      	
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
			  <span class="input-group-addon">Largo: </span>
			  <input type="text" class="form-control input-sm" id="inputLargoM" name="inputLargoM" value=''  placeholder="0.00 m. &hellip;" onChange='validarMedida(this.value,"LargoM");'>
			</div>
			
			<div style="height:5px;"></div>
			
			<div class="input-group input-group-sm">
			  <span class="input-group-addon">Ancho: </span>
			  <input type="text" class="form-control input-sm" id="inputAnchoM" name="inputAnchoM" value=''  placeholder="0.00 m. &hellip;" onChange='validarMedida(this.value,"AnchoM");'>
			</div>
			
			<div style="height:5px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Unidad: </span>
			  <input type="text" class="form-control input-sm" id="inputUnidadM" name="inputUnidadM" value='' placeholder="unidad &hellip;">
			</div>
			
			<div style="height:5px;"></div>
			
			<div class="input-group input-group-sm">
			  <span class="input-group-addon">Precio metro2: </span>
			  <input type="text" class="form-control input-sm" id="inputPrecioM2M" name="inputPrecioM2M" value='' placeholder="0.00 &hellip;" onChange='validarPrecio(this.value,"M2M");'>
			</div>
			
			<div style="height:5px;"></div>
			
			<div class="input-group input-group-sm">
			  <span class="input-group-addon">Precio unidad: </span>
			  <input type="text" class="form-control input-sm" id="inputPrecioUnidadM" name="inputPrecioUnidadM" value='' placeholder="0.00 &hellip;" onChange='validarPrecio(this.value,"UnidadM");'>
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


