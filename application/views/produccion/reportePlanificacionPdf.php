	
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery-ui-1.8.20.custom.min.js"></script>

<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>"> <!-- una de las librerias de bootstarp para manejar fecha-->

<style type="text/css" >

/*   light box fotografia */
.fotografia-dialog {width:350px;}

 #fotografiaModal{padding-top:220px;padding-left:450px;}  /* ... baja la ventana modal más al centro vertical ... */

	/*  inicio de scrollbar  */
thead { display:block;  margin:0px; cell-spacing:0px; left:0px; }  
tbody { display:block; overflow:auto; height:330px; }               
th { height:10px;  width:890px;}                                    
td { height:10px;  width:890px; margin:0px; cell-spacing:0px;}
/*  fin de scrollbar  */

#cuerpoCabecera,#cuerpoDetalle{margin:0 auto;  padding:0; width:820px; background:#f4f4f4;}
.cabeceraSalida{margin:10px;}

</style>

<script>
$(document).ready(function() {
	
	$('#btnVerFoto').click(function(){
  		var title = $(this).attr("title");
  		var fotoP = document.getElementById('fotoProducto'); 
		var codiProducto=$("#inputCodigo").val(); 
		fotoP.src ="http://192.168.1.61/irba/assets/img/productos/"+codiProducto+".jpg";
		$('.modal-title').html($('#inputDescripcion').val());			
  		$('#fotografiaModal').modal({show:true});
	});
	
}); // fin document.ready 
</script>

<div class="jumbotron" id="cuerpoCabecera">		
		
   	  <div style="height:10px;"></div>
   	   
      <div class="cabeceraSalida">
		<div class="row-fluid">
			
	    	<div class="col-lg-1">
				<div class="input-group input-group-sm" >
			    	<span class="input-group-addon" id="letraCabecera" >C&oacute;digo </span>
	    	 		<input type="text"  class="form-control input-sm" id="inputCodigo" name="inputCodigo" value="<?= $codigoProducto ?>" readonly="readonly"  placeholder="c&oacute;digo&hellip;" style="background-color:#d9f9ec;width:90px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-1 -->
	    	
			<div class="col-xs-2 col-md-2">
				<span></span>
			</div>    	
	    	
	    	<div class="col-md-2">
	    	 	<span class="label label-default" style="font-size:14px;text-align:center;">Planificaci&oacute;n Producto <?= strtoupper($nombreDeposito) ?> </span>
	    	</div> 
	    	
	    	
			<div class="col-xs-2 col-md-2">
				<span></span>
			</div>      	
	    	
	    	
	    	<div class="col-lg-1" >
				<div class="input-group input-group-sm" >
			    	<span class="input-group-addon" id="letraCabecera">Producir </span>
	    			<input type="text" class="form-control input-sm" id="inputCantidadProducir" name="inputCantidadProducir" value="<?= number_format($cantidadProducto,0) ?>" readonly="readonly" placeholder="cantidad&hellip;" style="width: 80px;font-size:11px;text-align:center;" onChange='validarCantidadProducir(this.value);'>
	    		</div>
	    	</div><!-- /.col-lg-1 -->
	    	
	    	<div class="col-xs-2 col-md-2">
				<span></span>
			</div>
	    	
	        <div class="col-xs-1 col-md-1"> 
				<button type="button" id="btnVerFoto" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-camera"></span> Ver Fotograf&iacute;a</button>
			</div>
	    	
		</div>
		
		
		<div style="height:35px;"></div>
		
		<div class="row-fluid"> <!-- segunda fila de la cabecera -->
			
		    <div class="col-lg-4">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" >Descripci&oacute;n </span>
	    	 		<input type="text"  class="form-control input-sm" id="inputDescripcion" name="inputDescripcion" value="<?= $nombreProducto ?>" readonly='readonly' placeholder="descripci&oacute;n&hellip;" style="width: 250px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	<div class="col-xs-2 col-md-2">
	    	 	<span></span>
	    	</div>
	    	
		    <div class="col-lg-2">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" >Medidas </span>
	    	 		<input type="text"  class="form-control input-sm" id="inputMedida" name="inputMedida" value="<?= $medidaProducto ?>" readonly="readonly" placeholder="medidas&hellip;" style="width: 172px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-2 -->
	    	
	    	<div class="col-xs-2 col-md-2">
				<span></span>
			</div>
	    	
	    	<div class="col-xs-1 col-md-1"> 
				<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>
			</div>
	    	
	    	 
	    	<div style="height:37px;"></div>
	    	
		</div>
	</div>
</div>   <!-- fin cuerpo cabecera -->

<div class="jumbotron" id="cuerpoDetalle">	
	<div style="height:5px;"></div>
	<embed src="<?= base_url($documento) ?>" width="820" height="455" > <!-- documento embebido PDF -->
   <div style="height:10px;"></div>
  
</div>

<!-- ... inicio  lightbox fotografia... -->
<div id="fotografiaModal"  class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" >
  <div class="fotografia-dialog"  >
  <div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h5 class="modal-title">cabecera de caja luz</h5>
	</div>
	<div class="modal-body">
		<input type='image' id='fotoProducto' class="img-rounded" width='300' height='200'>
	</div>
	
   </div>
  </div>
</div>
<!-- ... fin  lightbox fotografia... -->

