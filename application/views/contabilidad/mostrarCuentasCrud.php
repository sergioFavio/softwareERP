
<style type="text/css" >
.tree {
    min-height:20px;
    padding:19px;
    margin-bottom:20px;
    background-color:#fbfbfb;
    border:1px solid #999;
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
    border-radius:4px;
    -webkit-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
    -moz-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
    box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05)
}
.tree li {
    list-style-type:none;
    margin:0;
    padding:10px 5px 0 5px;
    position:relative
}
.tree li::before, .tree li::after {
    content:'';
    left:-20px;
    position:absolute;
    right:auto
}
.tree li::before {
    border-left:1px solid #999;
    bottom:50px;
    height:100%;
    top:0;
    width:1px
}
.tree li::after {
    border-top:1px solid #999;
    height:20px;
    top:25px;
    width:25px
}
.tree li span {
    -moz-border-radius:5px;
    -webkit-border-radius:5px;
    border:1px solid #999;
    border-radius:5px;
    display:inline-block;
    padding:3px 8px;
    text-decoration:none
}
.tree li.parent_li>span {
    cursor:pointer
}
.tree>ul>li::before, .tree>ul>li::after {
    border:0
}
.tree li:last-child::before {
    height:30px
}
.tree li.parent_li>span:hover, .tree li.parent_li>span:hover+ul li span {
    background:#eee;
    border:1px solid #94a0b4;
    color:#000
}

	
#cuerpoCabecera{margin:0 auto; padding:0; width:865px; height:50px;}
#cuerpoDetalle{margin:0 auto; padding:0; width:865px; }
/*  #cuerpoPaginacion{margin:0 auto;padding:0; width:850px; height:60px;}
*/
#crearModal,#editarModal, #borrarModal{padding-top:180px;}  /* ... baja la ventana modal más al centro vertical ... */

.letraDetalle{font-size:11px;text-align:center; }

</style>


<script type="text/javascript" src="<?= base_url("js/jquery-1.11.3.min.js")?>"></script> <!-- para el arbol bootstrap javascript-->
<script type="text/javascript" src="<?= base_url("js/bootstrap.js")?>"></script>


<script>
$(function () {
    $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Colapsar esta rama');
    $('.tree li.parent_li > span').on('click', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
            children.hide('fast');
            $(this).attr('title', 'Expandir esta rama').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
        } else {
            children.show('fast');
            $(this).attr('title', 'Colapsar esta rama').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
        }
        e.stopPropagation();
    });
});

var saldoacumulado=0.00;		//... variable para determinar la eliminacion de una cuenta ...
var cuenta='';					//... asignar cuenta a eliminar ...
var descripcion='';				//... asigna la descripcion de la cuenta a eleiminar ...
$(document).ready(function() {
			
	/*  inicio de light box crearCuenta javascript */
	$('#openLightBox').click(function(){
  		var title = $(this).attr("title");
		$('.modal-title').html(title);
		$('#crearModal').modal({show:true});
	});
	/*  fin de light box crearCuenta javascript  */
	
	$('#borrarModal').on('show.bs.modal', function(e) {  
		//aca recuperamos el id que pasaremos por tag al modal  
		cuenta = $(e.relatedTarget).data('cuenta'); 
		descripcion =$(e.relatedTarget).data('descripcion');
		var title = $(e.relatedTarget).data('title');
		
		saldoacumulado = $(e.relatedTarget).data('saldoacumulado');
		
		//aca lo asignamos a un hidden dentro del form que esta en el modal
	    $(e.currentTarget).find('input[name="codigo"]').val(cuenta);
		//esto solo pone el id pasado por tag para mostralo en el modal
		$(e.currentTarget).find('#showCodigo').html(cuenta);
		$(e.currentTarget).find('#showCuenta').html(descripcion);
		$(e.currentTarget).find('.modal-title').html(title);
	});
	
	$('#borrarModal').on("click", 'input[type="submit"], button[type="submit"]', function() { 
		saldoacumulado=parseFloat(saldoacumulado);
		if(saldoacumulado!=0.00 ){
			alert("¡¡¡ E R R O R !!! ... Saldo acumulado "+saldoacumulado+" es distinto de cero, no se puede eliminar la cuenta "+cuenta + " "+descripcion);
			//$('#borrarModal').modal('hide'); // cierra el lightbox
			//window.history.back();		//...vuelve a la pagina anterior ...
			//window.location;	//...vuelve a la pagina actual...
		}else{
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
		}	//... fin IF saldoacumulado!=0.00 ...
	 });
	 
	 
	 $('#editarModal').on('show.bs.modal', function(e) {  
		//aca recuperamos el id que pasaremos por tag al modal  
		var cuenta = $(e.relatedTarget).data('cuenta'); 
		var descripcion = $(e.relatedTarget).data('descripcion');
		var nivel = $(e.relatedTarget).data('nivel');
		var title = $(e.relatedTarget).data('title');
		//aca lo asignamos a un hidden dentro del form que esta en el modal
	    $(e.currentTarget).find('input[name="inputCodigoC"]').val(cuenta);
		$(e.currentTarget).find('input[name="inputDescripcionC"]').val(descripcion);
		$(e.currentTarget).find('input[name="inputNivelC"]').val(nivel);
		//$(e.currentTarget).find('input[name="inputEstockMinimoM"]').val(0.00);

		//esto solo pone el id pasado por tag para mostralo en el modal
		$(e.currentTarget).find('.modal-title').html(title);		
		
	});
	
	
	$('#editarModal').on("click", 'input[type="submit"], button[type="submit"]', function() {       
		var form= $('#editarModal').find("form");
		var action=form.attr("action");
		//aca recuperamos el id que paso por tag al modal
		var idele1=$(form).find('input[name="inputCodigoC"]').val();	
		var idele2=$(form).find('input[name="inputDescripcionC"]').val();
		var idele3=$(form).find('input[name="inputNivelC"]').val();	
					
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

	 
	 $("#btnGrabarNuevaCuenta").click(function(){
		// grabar registro en tablas [almacen/bodega]
    	grabarNuevaCuenta();
	 });
	 
	 
	 $("#btnGrabarModificacionCuenta").click(function(){
		// grabar registro en tablas [almacen/bodega]
    	grabarModificacionCuenta();
	 });
	 
}); // fin document.ready 


function grabarNuevaCuenta(){
	
	var registrosValidos= true;	  // ... bandera para grabar o no grabar registros ...
	
	if($("#inputCodigo").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de CUENTA está vacío");
			var registrosValidos= false;	
	}
	
	if($("#inputDescripcion").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de DESCRIPCION está vacío");
			var registrosValidos= false;	
	}
	
	if($("#inputNivel").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de NIVEL está vacío");
			var registrosValidos= false;	
	}	
	
		
	if(!registrosValidos){
		alert('Corrija los campos que están vacíos');
	}else{
		$("#formGrabarNuevoRegistro_").submit(); // ...  graba registros ...
	}
			
}	// ... fin funcion grabarNuevaCuenta() ...


function grabarModificacionCuenta(){
	
	var registrosValidosM= true;	  // ... bandera para grabar o no grabar registros ...
	
	if($("#inputDescripcionC").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de DESCRIPCIÓN está vacío");
			var registrosValidosM= false;	
	}
			
	if(!registrosValidosM){
		alert('Corrija los campos que están vacíos');
	}else{
		$("#formEditarRegistro_").submit(); // ...  graba registros ...
	}
			
}	// ... fin funcion grabarModificacionCuenta() ...

function validarCodigo(numero){	
	if(!validarCodigoNoRepetido(numero)){
		alert('ERROR este código '+numero+' ya existe'); 
		$("#inputCodigo").val("");
	}
	
	validarNivel(numero);
}


function validarNivel(numero){
	var cuenta= numero.toString();
	if(cuenta=='00000000' || cuenta.substring(0,1)=='0' ){
		alert('ERROR este código '+numero+' es inválido'); 
		$("#inputCodigo").val("");
	}
	
	if(cuenta.length!=8 || ( (cuenta.substr(0,1)!='0'&& cuenta.substr(1,1)=='0'&& cuenta.substring(2) )!='000000' ) || ( (cuenta.substr(2,1)=='0'&& cuenta.substr(3,1)=='0'&& cuenta.substring(4) )!='0000' )  || ( (cuenta.substr(4,1)=='0'&& cuenta.substr(5,1)=='0'&& cuenta.substring(6) )!='00' )  ){
		alert('ERROR este código '+numero+' es inválido'); 
		$("#inputCodigo").val("");
	}
	else{
		$(document).ready(function() {
				
		//... nivel 1 ...
		if( (cuenta.substr(0,1)!='0') && (cuenta.substr(1)=='0000000') ){
			document.getElementById('inputNivel1').checked = true;
			document.formGrabarNuevoRegistro_.nivelCuenta.value='1';  // ... nivelCuenta  variable hidden formulario...
			return
		}
		
		//... nivel 2 ...
		if( (cuenta.substr(0,1)!='0') && (cuenta.substr(1,1)!='0') && (cuenta.substr(2)=='000000') ){
			document.getElementById('inputNivel2').checked = true;
			document.formGrabarNuevoRegistro_.nivelCuenta.value='2';  // ... nivelCuenta  variable hidden formulario...
			return
		}
		
		//... nivel 3 ...
		if( (cuenta.substr(0,1)!='0') && (cuenta.substr(1,1)!='0') &&  (cuenta.substr(2,2)!='00') && (cuenta.substr(4)=='0000') ){
			document.getElementById('inputNivel3').checked = true;
			document.formGrabarNuevoRegistro_.nivelCuenta.value='3';  // ... nivelCuenta  variable hidden formulario...
			return
		}
		
		//... nivel 4 ...
		if( (cuenta.substr(0,1)!='0') && (cuenta.substr(1,1)!='0') &&  (cuenta.substr(2,2)!='00') && (cuenta.substr(4,2)!='00') && (cuenta.substr(6)=='00')  ){
			document.getElementById('inputNivel4').checked = true;
			document.formGrabarNuevoRegistro_.nivelCuenta.value='4';  // ... nivelCuenta  variable hidden formulario...
			return
		}
		
		//... nivel 5 ...
		if( (cuenta.substr(0,1)!='0') && (cuenta.substr(1,1)!='0') &&  (cuenta.substr(2,2)!='00') && (cuenta.substr(4,2)!='00') && (cuenta.substr(6)!='00')  ){
			document.getElementById('inputNivel5').checked = true;
			document.formGrabarNuevoRegistro_.nivelCuenta.value='5';  // ... nivelCuenta  variable hidden formulario...
			return
		}
		
		}); // fin document.ready 
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

</script>
<!--/head>
<body-->

<div class="jumbotron" id="cuerpoCabecera" >	<!--cuerpoCrudMaterial-->
		
	    <form class="form-horizontal" method="post" action="<?=base_url()?>materiales/buscarMaterialCrud" id="formBuscarRegistro_" name="formBuscarRegistro_" >
	       <div style="height:7px;"></div>

		   <div class="row">
		   	
			   	<div class="col-xs-2 col-md-2"> 
					<span></span>
			   	</div>
			   	
			   	<div class="col-xs-1 col-md-1"> 
			    	<button type="button"  class="btn btn-success btn-sm" id="openLightBox" title='Crear nueva cuenta'><span class="glyphicon glyphicon-plus"></span> Agregar</button>
			    </div>
			    
			    <div class="col-xs-2 col-md-6"> 
					<p align="center" class="tituloReporte" ><span class="label label-default" style="font-size:18px;"> CRUD cuentas </span></p>
			   	</div>
			   	    		     	
			    <div class="col-xs-1 col-md-1"> 
			    	<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			    
		</div>  <!-- /.row -->
			
	   </form>  <!--/div-->
	
</div> <!-- fin ... cuerpoCabecera -->

<div style="height:7px;"></div>

<div class="tree well" id="cuerpoDetalle" style="height:430px; overflow: auto;">
 
<table> 	<!-- estructura dentro de tabla para cargar las cuentas de contabilidad en un arreglo y hacer busqueda binaria posterior -->
	<?php  
	$posicionFila=-1;
	foreach($listaMaterial as $material):
		echo"<tr class='letraDetalle'>";
			$posicionFila=$posicionFila+1;  //...posicionFila
			echo"<input type='hidden' id='idMat_".$posicionFila."' name='idMat_".$posicionFila."' value='".$material->cuenta."' />";			
		echo"</tr>";
	endforeach;
echo"</table>";

	 $posicionFila=-1;
	 $nivelAnterior=0; 	
	 
	 foreach($listaMaterial as $material):
		 $posicionFila=$posicionFila+1;  //...posicionFila
		 $codigo= $material->cuenta;
		 $descripcion= $material->descripcion;
		 
		 $saldoAcumulado= $material->debeacumulado - $material->haberacumulado;		//... para controlar el saldoacumulado =0 para borrar cuenta ...
		 
		 
		 $largoDescripcion=strlen($descripcion);
		 $nivel= $material->nivel;
		 $diferenciaNivel=$nivel - $nivelAnterior;
		 
		 if($nivel>$nivelAnterior)							
		 {
		 	echo"<ul><li>";
			echo"<span>";
			if($nivel==1)
			{
				echo"<i class='glyphicon glyphicon-folder-close'></i>";
				$espacio=(105-$largoDescripcion);
			}
			
			if($nivel==2)
			{
				echo"<i class='glyphicon glyphicon-play-circle'></i>";
				$espacio=(85-$largoDescripcion);
			}
			
			if($nivel==3)
			{
				echo"<i class='glyphicon glyphicon-collapse-down'></i>";
				$espacio=(70-$largoDescripcion);
			}
			
			if($nivel==4)
			{
				echo"<i class='glyphicon glyphicon-collapse-up'></i>";
				$espacio=(58-$largoDescripcion);
			}
			
			if($nivel==5)
			{
				echo"<i class='glyphicon glyphicon-leaf'></i>";
				$espacio=(40-$largoDescripcion);
			} 
			
			echo "&nbsp; $codigo </span> &nbsp; $descripcion &nbsp;&nbsp;". nbs($espacio) ."<a href='#' data-title='Editar Cuenta' data-cuenta='".$codigo."' data-descripcion='".$descripcion."' 
			   data-nivel='".$nivel."' data-toggle='modal' data-target='#editarModal' ><button type='button' class='btn btn-warning btn-xs' ><span class='glyphicon glyphicon-edit'></span> Modificar</button></a>&nbsp;&nbsp;<a href='#' data-title='Eliminar Cuenta' data-cuenta='".$codigo."' data-descripcion='".$descripcion."' 
			   data-saldoacumulado='".$saldoAcumulado."' data-toggle='modal' data-target='#borrarModal'><button type='button' class='btn btn-danger btn-xs' ><span class='glyphicon glyphicon-remove'></span> Eliminar</button></a>";		
		 }
		 
		 if($nivel==$nivelAnterior)
		 {
		 	echo"</li><li>";
			echo"<span>";
			if($nivel==1)
			{
				echo"<i class='glyphicon glyphicon-folder-close'></i>";
				$espacio=(105-$largoDescripcion);
			}
			
			if($nivel==2)
			{
				echo"<i class='glyphicon glyphicon-play-circle'></i>";
				$espacio=(85-$largoDescripcion);
			}
			
			if($nivel==3)
			{
				echo"<i class='glyphicon glyphicon-collapse-down'></i>";
				$espacio=(70-$largoDescripcion);
			}
			
			if($nivel==4)
			{
				echo"<i class='glyphicon glyphicon-collapse-up'></i>";
				$espacio=(58-$largoDescripcion);
			}
			
			if($nivel==5)
			{
				echo"<i class='glyphicon glyphicon-leaf'></i>";
				$espacio=(40-$largoDescripcion);
			}
			
			echo "&nbsp; $codigo </span> &nbsp; $descripcion &nbsp;&nbsp;". nbs($espacio) ."<a href='#' data-title='Editar Cuenta' data-cuenta='".$codigo."' data-descripcion='".$descripcion."' 
				data-nivel='".$nivel."' data-toggle='modal' data-target='#editarModal' ><button type='button' class='btn btn-warning btn-xs' ><span class='glyphicon glyphicon-edit'></span> Modificar</button></a>&nbsp;&nbsp;<a href='#'  data-title='Eliminar Cuenta' data-cuenta='".$codigo."' data-descripcion='".$descripcion."' 
			    data-saldoacumulado='".$saldoAcumulado."' data-toggle='modal' data-target='#borrarModal'><button type='button' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span> Eliminar</button></a>";
		 }
		 
		  if($nivel<$nivelAnterior)
		  {
			for($x=1; $x<=($diferenciaNivel*(-1)); $x++){
				echo"</li></ul>";
			}
			echo"</li><li>";
			echo"<span>";
			if($nivel==1)
			{
				echo"<i class='glyphicon glyphicon-folder-close'></i>";
				$espacio=(105-$largoDescripcion);
			}
			
			if($nivel==2)
			{
				echo"<i class='glyphicon glyphicon-play-circle'></i>";
				$espacio=(85-$largoDescripcion);
			}
			
			if($nivel==3)
			{
				echo"<i class='glyphicon glyphicon-collapse-down'></i>";
				$espacio=(70-$largoDescripcion);
			}
			
			if($nivel==4)
			{
				echo"<i class='glyphicon glyphicon-collapse-up'></i>";
				$espacio=(58-$largoDescripcion);
			}
			
			if($nivel==5)
			{
				echo"<i class='glyphicon glyphicon-leaf'></i>";
				$espacio=(40-$largoDescripcion);
			}
			
			echo "&nbsp; $codigo </span> &nbsp; $descripcion &nbsp;&nbsp;". nbs($espacio) ."<a href='#' data-title='Editar Cuenta' data-cuenta='".$codigo."' data-descripcion='".$descripcion."' 
				data-nivel='".$nivel."' data-toggle='modal' data-target='#editarModal' ><button type='button' class='btn btn-warning btn-xs' ><span class='glyphicon glyphicon-edit'></span> Modificar</button></a>&nbsp;&nbsp;<a href='#'  data-title='Eliminar Cuenta' data-cuenta='".$codigo."' data-descripcion='".$descripcion."' 
			    data-saldoacumulado='".$saldoAcumulado."' data-toggle='modal' data-target='#borrarModal' ><button type='button' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span> Eliminar</button></a>";
		  }
		 
	      $nivelAnterior=$nivel; 
		  $largoDescripcion=0;
	     
	endforeach; 
	
	if($diferenciaNivel==0){
		echo"</li></ul>";
	}

	if($diferenciaNivel<0){
		for($x=1; $x<=($diferenciaNivel*(-1)); $x++){
			echo"</li></ul>";
		}
		echo"</li></ul>";
	}
		
   ?>
	
</div>


<!-- ... inicio  lightbox crear nueva cuenta... -->
<div class="modal fade" id="crearModal" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
      	
      	 <form class="form-horizontal" method="post" action="<?=base_url()?>contabilidad/grabarNuevaCuentaCrud" id="formGrabarNuevoRegistro_" name="formGrabarNuevoRegistro_" >
	 
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Código: </span>
			  	<input type='text' class='form-control input-sm' id='inputCodigo' name='inputCodigo' placeholder='código&hellip;' onChange='validarCodigo(this.value);' > 
			</div>
        
        	<div style="height:5px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Descripción: </span>
			  <input type="text" class="form-control input-sm" id="inputDescripcion" name="inputDescripcion" placeholder="descripción&hellip;">
			</div>
			
			<div style="height:10px;"></div>
       		
			<div class="form-group" style="font-size:11px;">
	            <label class="control-label col-xs-2">Nivel:</label>
	            <div class="col-xs-2">
	                <label class="radio-inline" for="inputNivel1">
	                    <input type="radio" id="inputNivel1" name="inputNivel" value="1" disabled> 1
	                </label>
	            </div>
	           <div class="col-xs-2">
	                <label class="radio-inline" for="inputNivel2">
	                    <input type="radio" id="inputNivel2" name="inputNivel" value="2" disabled> 2
	                </label>
	            </div>
	            <div class="col-xs-2">
	                <label class="radio-inline" for="inputNivel3">
	                    <input type="radio" id="inputNivel3" name="inputNivel" value="3" disabled> 3
	                </label>
	            </div>
	            <div class="col-xs-2">
	                <label class="radio-inline" for="inputNivel4">
	                    <input type="radio" id="inputNivel4" name="inputNivel" value="4" disabled> 4
	                </label>
	            </div>
	            <div class="col-xs-2">
	                <label class="radio-inline" for="inputNivel5">
	                    <input type="radio" id="inputNivel5" name="inputNivel" value="5" disabled> 5
	                </label>
	            </div>
        	</div>
			
			<input type="hidden"  name="nivelCuenta"  />
      	</form>
      	
      			        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-off"></span> Cerrar</button>
        <button type="submit" class="btn btn-primary btn-sm" id="btnGrabarNuevaCuenta"><span class="glyphicon glyphicon-hdd"></span> Grabar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- ... fin  lightbox crear nueva cuenta ... -->


<!-- ... inicio  lightbox editar cuenta... -->
<div class="modal fade" id="editarModal" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
      	
      	 <form class="form-horizontal" method="post" action="<?=base_url()?>contabilidad/actualizarCuentaCrud" id="formEditarRegistro_" name="formEditarRegistro_" >
	 
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Código: </span>
			  	<input type='text' class='form-control input-sm' id='inputCodigoC' name='inputCodigoC' value='' readonly='readonly' placeholder='código&hellip;' onChange='validarCodigo(this.value);' > 
			</div>
        
        	<div style="height:5px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Descripción: </span>
			  <input type="text" class="form-control input-sm" id="inputDescripcionC" name="inputDescripcionC" value='' placeholder="descripción&hellip;">
			</div>
			
			<div style="height:5px;"></div>
        	
        	<div class="input-group input-group-sm">
			  <span class="input-group-addon">Nivel: </span>
			  <input type="text" class="form-control input-sm" id="inputNivelC" name="inputNivelC" value=''readonly='readonly' placeholder="descripción&hellip;">
			</div>
			
      	</form>
      	
      			        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-off"></span> Cerrar</button>
        <button type="submit" class="btn btn-primary btn-sm" id="btnGrabarModificacionCuenta"><span class="glyphicon glyphicon-hdd"></span> Grabar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- ... fin  lightbox editar cuenta ... -->

<!-- ...  lightbox borrar cuenta ... -->

<div class="modal fade" id="borrarModal" tabindex="-1" role="dialog" aria-labelledby="borrarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title" id="borrarModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
	  <form class="form-horizontal" data-async data-target="#rating-modal" action="<?=base_url()?>contabilidad/eliminarCuentaCrud" method="POST">
        ¿ Esta seguro de eliminar la cuenta <span id="showCodigo" style="font-weight : bold;"></span> <span id="showCuenta" style="font-weight : bold;"></span> ?
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

<!-- ... fin  lightbox borrar cuenta ... -->
