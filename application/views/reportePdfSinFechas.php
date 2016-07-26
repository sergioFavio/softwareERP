<style type="text/css" >

	.cuerpoCabeceraReporteSalida{margin: 2px;}
    
    .tituloReporte{font-size:18px;font-family : Courier; margin-top:10px; font-weight : bold}
    
	#cuerpo{margin:0 auto; padding:0; width:820px; height:560px;}
	
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
	    
	<embed src="<?= base_url($documento) ?>" width="820" height="455" > <!-- documento embebido PDF -->
	
	<div style="text-align: right; padding-top: 5px;"> 
		<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
	
</div>



