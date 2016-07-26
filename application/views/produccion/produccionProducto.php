	
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.css"/>
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery-ui-1.8.20.custom.min.js"></script>

<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>"> <!-- una de las librerias de bootstarp para manejar fecha-->

<style type="text/css" >

/*  inicio de light box material */
.modal-dialog {width:620px;}
.thumbnail {margin-bottom:6px;}
/*  fin de light box material */

/*   light box material */
.producto-dialog {width:580px;}

#productoModal{padding-left:350px;}  /* ... baja la ventana modal más al centro vertical ... */

	/*  inicio de scrollbar  */
thead { display:block;  margin:0px; cell-spacing:0px; left:0px; }  
tbody { display:block; overflow:auto; height:330px; }               
th { height:10px;  width:890px;}                                    
td { height:10px;  width:890px; margin:0px; cell-spacing:0px;}
/*  fin de scrollbar  */

#cuerpoCabecera{margin:0 auto;  padding:0; width:820px; background:#f4f4f4;}
.cabeceraSalida{margin:10px;}

#letraCabecera{font-size:12px;margin-top:1px; margin-left:25px; text-align:left;}

.letraDetalle , .openLightBox{font-size:11px;text-align:left;}

.letraDetalleLightBox{font-size:10px;margin-top:1px;text-align:left;}

</style>


<script>	
$(document).ready(function() {
	
	/*  inicio de light box  producto javascript */
	$('#inputCodigo').click(function(){
  		var title = $(this).attr("title");
		$('.modal-title').html(title);
  		$('#productoModal').modal({show:true});
	});
	/*  fin de light box producto javascript  */	
	
	
	$('#tabla3').dataTable();
    
    $('#tabla3 tbody').on('click', 'tr', function () {	
    	var codigoProducto = $('td', this).eq(0).text();
    	var nombreProducto = $('td', this).eq(1).text();
    	var medidas = $('td', this).eq(2).text();
    	
		$('#inputCodigo').val(codigoProducto);
		$('#inputDescripcion').val(nombreProducto);
		$('#inputMedida').val(medidas);
				
    	$('#productoModal').modal('hide'); // cierra el lightBox
	  	
	} ); // fin #tabla3 tbody
	
	$("#btnGenerarReporteProduccion").click(function(){
    	if($("#inputCodigo").val()=="" ){
  			alert("¡¡¡ E R R O R !!! ... primero seleccione un CODIGO DE PRODUCTO");
  		}else{
  			if($("#inputCantidadProducir").val()=="" ){
  			alert("¡¡¡ E R R O R !!! ... ingrese una CANTIDAD a producir");
  			}else{
  				//... vuelve como dato numerico #inputCantidadProducir  ...
  				var cantidadProducir=$("#inputCantidadProducir").val();
				cantidadProducir=cantidadProducir.split(','); //... elimina ,
				cantidadProducir=cantidadProducir[0]+cantidadProducir[1];	
				cantidadProducir=parseFloat(cantidadProducir);
				$("#inputCantidadProducir").val(cantidadProducir);
				//... fin vuelve como dato numerico #inputCantidadProducir  ... 
  				$("#form_").submit(); // ...  ejecuta el formulario ...
  			}
  		}
    });
	
		
}); // fin document.ready 
				
		
function validarCantidadProducir(numero){
	
	if (!/^([0-9])*$/.test(numero)){  // ... solo numeros enteros ...  
	//if (!/^\d{1,7}(\.\d{1,3})?$/.test(numero)){  // ...hasta 4 digitos parte entera y hasta 3 parte decimal ...
		alert("El valor " + numero + " no es una cantidad válida");
		$("#inputCantidadProducir").val("");   // borra celda de cantidad
	}else{
		 $("#inputCantidadProducir").val( separadorMiles(numero) );    //... pone separador de miles ...
	}
	    		

}   // fin ... validarCantidad ...

		
function separadorMiles(n){
    var rx=  /(\d+)(\d{3})/;
    return String(n).replace(/^\d+/, function(w){
        while(rx.test(w)){
            w= w.replace(rx, '$1,$2');
        }
        
        return w;
    });
}


</script>

<div class="jumbotron" id="cuerpoCabecera">		
		
	<form class="form-horizontal" method="post" action="<?=base_url()?>produccion/reporteProduccion" id="form_" name="form_" >
   	  <div style="height:10px;"></div>
   	   
      <div class="cabeceraSalida">
		<div class="row-fluid">
			
	    	<div class="col-lg-1">
				<div class="input-group input-group-sm" >
			    	<span class="input-group-addon" id="letraCabecera" >C&oacute;digo </span>
	    	 		<input type="text"  class="form-control input-sm" id="inputCodigo" name="inputCodigo" title='Seleccionar material de la tabla de PRODUCTOS' readonly="readonly" placeholder="c&oacute;digo&hellip;" 
	    	 		style="background-color:#d9f9ec;width:90px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-1 -->
	    	
			<div class="col-xs-2 col-md-2">
				<span></span>
			</div>    	
	    	
	    	<div class="col-md-2">
	    	 	<span class="label label-default" style="font-size:14px;text-align:center;">Producci&oacute;n Producto <?= strtoupper($nombreDeposito) ?> </span>
	    	</div> 
	    	
	    	
			<div class="col-xs-2 col-md-2">
				<span></span>
			</div>      	
	    	
	    	
	    	<div class="col-lg-1" >
				<div class="input-group input-group-sm" >
			    	<span class="input-group-addon" id="letraCabecera">Producir </span>
	    			<input type="text" class="form-control input-sm" id="inputCantidadProducir" name="inputCantidadProducir"  placeholder="cantidad&hellip;" style="width: 80px;font-size:11px;text-align:center;" onChange='validarCantidadProducir(this.value);'>
	    		</div>
	    	</div><!-- /.col-lg-1 -->
	    	
	    	<div class="col-xs-2 col-md-2">
				<span></span>
			</div>
	    	
	        <div class="col-xs-1 col-md-1"> 
				<button type="button" id="btnGenerarReporteProduccion" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-list"></span> Ver Reporte</button>
			</div>
	    	
		</div>
		
		
		<div style="height:35px;"></div>
		
		<div class="row-fluid"> <!-- segunda fila de la cabecera -->
			
		    <div class="col-lg-4">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" >Descripci&oacute;n </span>
	    	 		<input type="text"  class="form-control input-sm" id="inputDescripcion" name="inputDescripcion"  readonly='readonly' placeholder="descripci&oacute;n&hellip;" style="width: 250px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	<div class="col-xs-2 col-md-2">
	    	 	<span></span>
	    	</div>
	    	
		    <div class="col-lg-2">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" >Medidas </span>
	    	 		<input type="text"  class="form-control input-sm" id="inputMedida" name="inputMedida" readonly='readonly' placeholder="medidas&hellip;" style="width: 172px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-2 -->
	    	
	    	<div class="col-xs-2 col-md-2">
				<span></span>
			</div>
	    	
	    	<div class="col-xs-1 col-md-1"> 
				<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>
			</div>
			
			<input type="hidden"  name="nombreDeposito" value="<?= $nombreDeposito ?>" />     <!--  nombreDeposito: blanco/acabado -->
	    	
	</form>
	    	 
	    	<div style="height:37px;"></div>
	    	
		</div>
	</div>
</div>   <!-- fin cuerpo cabecera -->


<!-- ... inicio  lightbox productos... -->

<div id="productoModal"  class="modal fade" tabindex="-1" role="dialog" >
  <div class="producto-dialog"  >
  <div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h4 class="modal-title">cabecera de caja luz</h4>
	</div>
	<div class="modal-body">
		
		<table  cellspacing="0" cellpadding="0" border="0" class="display" id="tabla3">
			<thead>
				<tr class='letraDetalleLightBox'>
					<th style='width:40px;'>Cod Producto</th>
					<th style='width:450px;'>Producto</th>
					<th style='width:60px;'>Medidas</th>
					<th style='width:30px;'>Unidad</th>
				</tr>
			</thead>
			<tbody>			 
                <?php foreach($productos as $producto):?>
                    <tr class='letraDetalleLightBox'>
                        <td style='width:40px;'> <?= $producto["idProd"] ?></td>
                        <td style='width:450px;'> <?= $producto["nombreProd"]?></td>
                        <td style='width:70px;'> <?= $producto["medidas"]?></td>
   						<td style='width:30px;'><?= $producto["unidad"] ?></td>
                    </tr>
                <?php endforeach ?>
			</tbody>
		</table>
		
	</div>
	<div class="modal-footer">
		<button class="btn btn-default" data-dismiss="modal">Cerrar</button>
	</div>
   </div>
  </div>
</div>
<!-- ... fin  lightbox productos... -->
