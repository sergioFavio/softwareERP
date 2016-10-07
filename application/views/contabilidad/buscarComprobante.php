
<link rel="stylesheet" type="text/css"  href="<?=base_url(); ?>css/ingresoSalidaMaterial.css" />
	
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.css"/>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery-ui-1.8.20.custom.min.js"></script>

<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>"> <!-- una de las librerias de bootstarp para manejar fecha-->

<style type="text/css" >

	/*  inicio de scrollbar  */
thead { display:block;  margin:0px; cell-spacing:0px; left:0px; }  
tbody { display:block; overflow:auto; height:330px; }               
th { height:10px;  width:665px;}                                    
td { height:10px;  width:665px; margin:0px; cell-spacing:0px;}
/*  fin de scrollbar  */

#cuerpoSalida{margin:0 auto;  padding:0; width:750px; background:#f4f4f4;}
.cabeceraSalida{margin:10px;}

#titulo{font-size:14px;margin-top:1px;  text-align:right;font-weight : bold}

.cabecera-dialog {width:580px;}
#cabeceraModal{padding-left:350px;}  /* ... baja la ventana modal más al centro vertical ... */

</style>

<script>

$(document).ready(function() {
	
	/*  inicio de light box  producto javascript */
	$('#inputNumero').click(function(){
  		var title = $(this).attr("title");
		$('.modal-title').html(title);
  		$('#cabeceraModal').modal({show:true});
	});
	/*  fin de light box producto javascript  */	
	
	
	$('#tabla1').dataTable();
    
    $('#tabla1 tbody').on('click', 'tr', function () {	
    	var numeroComprobante = $('td', this).eq(0).text();
    	var fecha = $('td', this).eq(1).text();
    	var tipoComprobante = $('td', this).eq(2).text();
  		var concepto = $('td', this).eq(3).text();			
  		
  		
  		
//var clienteBanco = $('td', this).eq(4).text();   
//var numeroCheque = $('td', this).eq(5).text();
  		
//alert('clienteBanco= '+clienteBanco);  		
  		
		$('#inputNumero').val(numeroComprobante);
		$('#inputFecha').val(fecha);
		$('#inputConcepto').val(concepto);
		$('#inputTipo').val(tipoComprobante);
		
		
		
//$('#clienteBanco').val(clienteBanco);		
//document.form_.clienteBanco.value=clienteBanco;  // ... clienteBanco  variable hidden formulario...
//document.form_.numeroCheque.value=numeroCheque;  // ... numeroCheque  variable hidden formulario...


		
    	$('#cabeceraModal').modal('hide'); // cierra el lightBox
  
	} ); // fin #tabla1 tbody
	
	
	$("#btnBuscarComprobante").click(function(){
	  //...buscar salida [almacen/bodega]							
    	buscarComprobante();
	});
	
	
}); // fin document.ready 


function buscarComprobante(){
	
	var todayTime = new Date();					//... asigna fecha del sistema...
    var month = todayTime.getMonth() + 1;
    var day = todayTime.getDate();
    var year = todayTime.getFullYear();

	var fechaSalida= $("#inputFecha").val();		//... asigna fecha de salida ...
	var mesSalida = fechaSalida.substring(4, 6); 	// porcion = "ola Mun"	
	var mesSalida = parseInt( mesSalida ); 			// convierte de string to number 
	var anhoSalida = fechaSalida.substring(7, 11); 	// porcion = "ola Mun"	
	
	if($("#inputNumero").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de No. COMPROBANTE está vacío, seleccione un comprobante");	
	}
	else{
		$("#form_").submit(); // ...  busca registros ...
	}	
			
}	// ... fin funcion buscarComprobante() ...
		
		
</script>

<div class="jumbotron" id="cuerpoSalida">		
		
   <form class="form-horizontal" method="post" action="<?=base_url()?>contabilidad/modificarComprobante" id="form_" name="form_" >
   	  <div style="height:10px;"></div>
   	   
      <div class="cabeceraSalida">
		<div class="row-fluid">
			
	    	<div class="col-md-2">
				<div class="input-group input-group-sm" >
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-tag"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="inputNumero" name="inputNumero" title='Seleccione un NUMERO DE COMPROBANTE' readonly="readonly" placeholder="No. Compbte.&hellip;"  style="background-color:#d9f9ec;width:100px;font-size:11px;text-align:center;">
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	<div class="col-xs-2 col-md-2">
	    	 	<span></span>
	    	</div>
	    	
	    	<div class="col-xs-2 col-md-2">
	    	 	<span  id="titulo" class="label label-default"><?= $titulo ?></span>
	    	</div> 
	    	
	    	<div class="col-xs-2 col-md-2">
	    	 	<span></span>
	    	</div>
	    	
	    	<div class="col-md-2" >
				<div class="input-group input-group-sm" >
			    	<span class="input-group-addon" id="letraCabecera"><span class="glyphicon glyphicon-calendar"></span></span>
	    			<input type="text" class="form-control input-sm" id="inputFecha" name="inputFecha" readonly="readonly" placeholder="fecha&hellip;" style="width: 135px;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
		</div>
		
		
		<div style="height:35px;"></div>
		
		<div class="row-fluid"> <!-- segunda fila de la cabecera -->
			
		    <div class="col-md-4">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-comment"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="inputConcepto" name="inputConcepto" readonly="readonly" placeholder="concepto&hellip;" style="width: 370px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	
	    	<div class="col-xs-4 col-md-4">
	    	 	<span></span>
	    	</div>
	    	
	    	
		    <div class="col-md-2">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-list-alt"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="inputTipo" name="inputTipo" readonly="readonly" placeholder="tipo compbte&hellip;" style="width: 90px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	<div style="height:25px;"></div>
	    	
		</div>
	</div>

	<input type="hidden"  name="gestion" value="<?= $gestion ?>" />
	<input type="hidden"  name="clienteBanco"  id="clienteBanco" />
	<input type="hidden"  name="numeroCheque"  />
		
	<div style="text-align: right; padding-top: 3px;"> 
		
		<div class="col-xs-2">
			<div class="input-group input-group-sm">
		    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-pushpin"></span></span>
		 		<input type="text" class = "form-control input-sm" id="inputCliente" name="inputCliente" readonly="readonly" placeholder="cliente / banco&hellip;" style="width:160px;font-size:11px;text-align:center;">
			</div>
    	</div><!-- /.col-xs-2 -->
		
		<div class="col-xs-2">
	    	<span></span>
	    </div>
	    	
	    	<div class="col-xs-2">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-tag"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="inputCheque" name="inputCheque" readonly="readonly" placeholder="cheque No&hellip;" style="width: 120px;font-size:11px;text-align:center;">
	    		</div>
	    		
	    	</div><!-- /.col-lg-4 -->
		
		
		
		
		
		  
    	<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;
        <button type="button" class="btn btn-inverse btn-sm" id="btnBuscarComprobante" name="btnBuscarComprobante" ><span class="glyphicon glyphicon-search"></span> Buscar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   </div>
   <div style="height:10px;"></div>
 </form>
</div>



<!-- ... inicio  lightbox cabeceracomprobante... -->

<div id="cabeceraModal"  class="modal fade" tabindex="-1" role="dialog" >
  <div class="cabecera-dialog"  >
  <div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h4 class="modal-title">cabecera de caja luz</h4>
	</div>
	<div class="modal-body">
		
		<table  cellspacing="0" cellpadding="0" border="0" class="display" id="tabla1">
			<thead>
				<tr class='letraDetalleLightBox'>
					<th style='width:55px;'>No.Compbte.</th>
					<th style='width:45px;'>Fecha</th>
					<th style='width:50px;'>Tipo Compbte.</th>
					<th style='width:250px;'>Concepto</th>
				</tr>
			</thead>
			<tbody>			
                <?php foreach($cabeceraComprobante as $cabecera):?>
                    <tr class='letraDetalleLightBox'>
                        <td style='width:70px;'> <?= $cabecera["numComprobante"] ?></td>
                        <td style='width:60px;'> <?= fechaMysqlParaLatina($cabecera["fecha"])?></td>
                        <td style='width:80px;'> <?= $cabecera["tipoComprobante"]?></td>
   						<td style='width:250px;' ><?= $cabecera['concepto']  ?></td>
   						<!--td style='width:200px;' ><?= $cabecera['clienteBanco']  ?></td-->
                    </tr>
                <?php endforeach ?>
			</tbody>
		</table>
		
	</div>
	<div class="modal-footer">
		<button class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-off"></span> Cerrar</button>
	</div>
   </div>
  </div>
</div>
<!-- ... fin  lightbox cabeceracomprobante... -->
