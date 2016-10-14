
<!--meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1"-->



<style type="text/css" >

	.cuerpoCabeceraReporteSalida{margin: 2px;}
    
    .tituloReporte{font-size:18px;font-family : Courier; margin-top:10px; font-weight : bold}
    
	#cuerpo{margin:0 auto; padding:0; width:820px; height:555px;}
	
	.letraFecha{font-size:12px;text-align:center; }  
	
</style>






<div class="jumbotron" id="cuerpo" >	
		
    <table width="99%" class="table-condensed">   		
		<thead>
    		<tr>
    			<!--td class="letraFecha">
					Desde: <?= $fechaInicial ?>
				</td-->
				<td class="tituloReporte">
				<p align="center"><span class="label label-success">Reporte <?= $titulo ?> </span></p>
				</td>
				<!--td class="letraFecha">
					Hasta: <?= $fechaFinal ?>
				</td-->
    		</tr>
 		</thead>
	</table>
	   
	   
<!--	   
<embed src="<?= base_url('pdfsArchivos/contabilidad/balancesumasysaldos.pdf') ?>" width="820" height="455" >
<embed src="<?= base_url('pdfsArchivos/contabilidad/comprobantes/cpbte201604001.pdf') ?>" width="820" height="455" >
<embed src="<?= base_url('pdfsArchivos/contabilidad/balanceGeneral.pdf') ?>" width="820" height="455" >
				
-->

	

	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	  <!-- Indicators -->
	  <ol class="carousel-indicators">
	    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
	    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
	    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
	  </ol>
	 
	  <!-- Wrapper for slides -->
	  <div class="carousel-inner">
	    <div class="item active">
	      <embed src="<?= base_url('pdfsArchivos/contabilidad/balancesumasysaldos.pdf') ?>" width="820" height="455" >
	      <div class="carousel-caption">
	      	<h3>Caption Text</h3>
	      </div>
	    </div>
	    <div class="item">
	      <!--img src="http://placehold.it/1200x315" alt="..."-->
	      <embed src="<?= base_url('pdfsArchivos/contabilidad/comprobantes/cpbte201604001.pdf') ?>" width="820" height="455" >
	      <div class="carousel-caption">
	      	<h3>Caption Text</h3>
	      </div>
	    </div>
	    <div class="item">
	      <!--img src="http://placehold.it/1200x315" alt="..."-->
	      <embed src="<?= base_url('pdfsArchivos/contabilidad/balanceGeneral.pdf') ?>" width="820" height="455" >
	      <div class="carousel-caption">
	      	<h3>Caption Text</h3>
	      </div>
	    </div>
	  </div>
	 
	  <!-- Controls -->
	  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left"></span>
	  </a>
	  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right"></span>
	  </a>
	</div> <!-- Carousel -->		
		
		
		
		
		
		
		
		
	
	<div style="text-align: right; padding-top: 5px;"> 
		<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
	
</div>



