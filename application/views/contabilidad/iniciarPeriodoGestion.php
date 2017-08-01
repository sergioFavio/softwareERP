<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>">

<style type="text/css" >    
	#cuerpo{margin:0 auto; padding:0; width:540px; height:140px;}
	  
</style>

<div class="panel panel-primary" id="cuerpo">
	<form class="form-horizontal" method="post" action="<?=base_url()?>contabilidad/iniciarPeriodoGestion" id="formIniciarGestion_" name="formIniciarGestion_" >

    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-info-sign"></span> Iniciar Nuevo período de Gestión <?= mesLiteral((int)$mesSiguiente).' '.substr($gestionSiguiente,0,4) ?> </h3>
    </div>
    <div class="panel-body" >
        <?= $mensaje ?> 
    </div>
    
    <input type="hidden"  name="gestion" value="<?= $gestion ?>">
    <input type="hidden"  name="mesSiguiente" value="<?= $mesSiguiente ?>">
    <input type="hidden"  name="gestionSiguiente" value="<?= $gestionSiguiente ?>">
     
	<div style="text-align: right; padding-top: 2px;"> 
		<button type="submit" class="btn btn-success btn-sm" id="btnContinuar"><span class="glyphicon glyphicon-ok"></span> Iniciar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<button type="button" class="btn btn-primary btn-sm" id="btnSalir"  onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
	
    </form>  <!--/div-->
</div>





