<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>">

<style type="text/css" >

	/*  inicio de light box  */
	.modal-dialog {width:520px;}
	.modalEditar-dialog {width:843px;}
	.thumbnail {margin-bottom:6px;}
	/*  fin de light box  */

	/*  inicio de scrollbar  */
	thead { display:block;  margin:0px; cell-spacing:0px; left:0px; }  
	tbody { display:block; overflow:auto; height:357px; }               
	th { height:10px;  width:850px;}                                    
	td { height:10px;  width:850px; margin:0px; cell-spacing:0px;}
	/*  fin de scrollbar  */
	
	.cuerpoDetalle, {margin: 2px;} 
    
	/* Fix alignment issue of label on extra small devices in Bootstrap 3.2 */
    .form-horizontal .control-label{padding-top: 7px;}
    
    .tituloReporte{font-size:9px; margin-top:10px; }
    
	#cuerpoCabecera{margin:0 auto; padding:0; width:850px; height:50px;}
	#cuerpoDetalle{margin:0 auto; padding:0; width:850px; height:410px;}
	#cuerpoPaginacion{margin:0 auto;padding:0; width:850px; height:60px;}
	
	#inputBuscarPatron, #letraCabecera{font-size:11px;text-align:center; }
	
	.letraDetalle, .letraTipoMaterial{font-size:11px;text-align:center; }
	.letraNumero{font-size:11px;text-align:right; }
	#titulo{font-size:16px;margin-top:1px;  text-align:right;font-weight : bold}
</style>

<script>

$(document).ready(function() {
					  
}); // fin document.ready 
		
</script>

<div class="jumbotron" id="cuerpoCabecera" >	<!--cuerpoCrudMaterial-->
		
	    <form class="form-horizontal" method="post" action="<?=base_url()?>tienda/buscarCotizacion" id="formBuscarRegistro_" name="formBuscarRegistro_" >
	    	<div style="height:10px;"></div>
		    <div class="row">
			   	<div class="col-xs-1"> 
					<span></span>
			   	</div>
			   	     
				<div class="col-xs-4">    
			    	<div class="input-group input-group-sm">
			    		<input type="text" class="form-control input-sm" id="inputBuscarPatron" name="inputBuscarPatron" value='<?= $consultaCotizacion ?>' placeholder="buscar por cliente...">
						<div class="input-group-btn">
                        	<button type="submit" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-search"></span></button>
                    	</div>
			    	</div>
			    </div><!-- /.col-lg-6 -->	
			    
			    <div class="col-xs-1"> 
					<span></span>
			   	</div>
			   	
			   	<div class="col-xs-2">
	    	 		<span  id="titulo" class="label label-success">Ver Cotizaciones</span>
	    		</div>
			   	
			    <div class="col-xs-1"> 
					<span></span>
			   	</div>
			    			     	
			    <div class="col-xs-2 col-md-2"> 
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
    			<th style="width: 80px;">Cotizaci&oacute;n</th>
    			<th style="width: 80px;">Fecha</th>
				<th style="width: 250px;">Cliente</th>
				<th style="width: 250px;">Descripci&oacute;n</th>
				<th style="width: 100px;">Fono/Celular</th>
				<th style="width: 100px;" colspan="2">Importe Bs.</th>
    		</tr>
 		</thead>
 		
 		<tbody>	
			<?php  $posicionFila=-1; ?>			
	        <?php foreach($listaCotizacion as $cotizacion):?>
				<tr class='letraDetalle'>
				
					<?php  $posicionFila=$posicionFila+1;  //...posicionFila
								
					 echo"<td style='width:60px;'><input type='text' id='idMat_".$posicionFila."' name='idMat_".$posicionFila."' value='".$cotizacion->numCotizacion."' readonly='readonly' style='border:none; width:60px;text-align:center;' /></td>";
						
					 echo"<td style='width: 60px;'><input type='text' id='fechaMat_".$posicionFila."' name='fechaMat_".$posicionFila."' value='".fechaMysqlParaLatina($cotizacion->fecha)."' readonly='readonly' style='border:none; width:60px;' /></td>";
							 
					 echo"<td style='width: 200px;'><input type='text' id='clienteMat_".$posicionFila."' name='clienteMat_".$posicionFila."' value='".$cotizacion->cliente."' readonly='readonly' style='border:none; width:200px;' /></td>";
						
					 echo"<td style='width: 300px;'><input type='text' id='descripcionMat_".$posicionFila."' name='descripcionMat_".$posicionFila."' value='".$cotizacion->descripcion."' readonly='readonly' style='border:none; width:300px;' /></td>";
						
					 echo"<td style='width: 80px;'><input type='text' id='fonoMat_".$posicionFila."' name='fonoMat_".$posicionFila."' value='".$cotizacion->fonoCel."' readonly='readonly' style='border:none; width:80px;text-align:center;' /></td>";

					 echo"<td style='width: 80px;'><input type='text' id='totalMat_".$posicionFila."' name='totalMat_".$posicionFila."' value='".$cotizacion->totalCotizacion."' readonly='readonly' style='border:none; width:80px;text-align:right;' /></td>";
		
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

