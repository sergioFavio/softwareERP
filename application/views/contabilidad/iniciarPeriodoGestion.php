<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>">

<style type="text/css" >    
	#cuerpo{margin:0 auto; padding:0; width:530px; height:140px;}
	  
</style>

<div class="panel panel-primary" id="cuerpo">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-info-sign"></span> Iniciar Nuevo período de Gestión abril 2017</h3>
    </div>
    <div class="panel-body" >
        <?= $mensaje ?> 
    </div>
     
	<div style="text-align: right; padding-top: 2px;"> 
		
		<button type="button" class="btn btn-success btn-sm" id="btnContinuar"  onClick="window.location.href='<?=base_url();?>contabilidad/iniciarPeriodoGestion'"><span class="glyphicon glyphicon-ok"></span> Continuar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		
		<button type="button" class="btn btn-primary btn-sm" id="btnSalir"  onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
	
      
</div>





