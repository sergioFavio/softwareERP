<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery-ui-1.8.20.custom.min.js"></script>

<style type="text/css" >
	/*  inicio de scrollbar  */
	thead { display:block;  margin:0px; cell-spacing:0px; left:0px; }  
	tbody { display:block; overflow:auto;  }               
	th { height:10px;  width:850px;}                                    
	td { height:10px;  width:850px; margin:0px; cell-spacing:0px;}
	/*  fin de scrollbar  */
	
	.cuerpoDetalle, {margin: 2px;} 
    
	/* Fix alignment issue of label on extra small devices in Bootstrap 3.2 */
    .form-horizontal .control-label{padding-top: 7px;}
    
    .tituloReporte{font-size:9px; margin-top:0px; }
    
	#cuerpoCabecera{margin:0 auto; padding:0; width:600px; height:50px;background:#f4f4f4}
	#cuerpoDetalle{margin:2px auto; padding:10px; width:600px; background:#f4f4f4 }

	.letraDetalle, .letraTipoMaterial{font-size:11px;text-align:center; }
	.letraNumero{font-size:11px;text-align:right; }
	
</style>

<script>
$(document).ready(function(){
	
	$('#tabla1').dataTable(
		{
	        "scrollY":        "320px",
	        "scrollCollapse": true,
	        "paging":         false,
	         "info":  true
	    }
	);
		  
}); // fin document.ready 	
</script>

<div class="jumbotron" id="cuerpoCabecera" >	<!--cuerpoCrudManoObra-->
	    <form class="form-horizontal" method="post" action="<?=base_url()?>produccion/buscarManoObraCrud" id="formBuscarRegistro_" name="formBuscarRegistro_" >
	       <div style="height:10px;"></div>
		   <div class="row">
		   	
			   	<div class="col-xs-3"> 
					<span></span>
			   	</div>
			   	     
				<div class="col-lg-6">    
			    	<p align="center" class="tituloReporte"><span class="label label-default"> Consultar Stock </span></p>
			    </div><!-- /.col-lg-6 -->	
			    			     	
			    <div class="col-xs-2 col-md-2"> 
			    	<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			    
		</div>  <!-- /.row -->
			
	   </form>  <!--/div-->
</div> <!-- fin ... cuerpoCabecera -->

<div style="height:7px;"></div>

<div class="jumbotron" id="cuerpoDetalle" >

	<div style="height:5px;"></div>
	<table cellspacing="0" cellpadding="0"   class="display compact"  id="tabla1">		
		<thead>
    		<tr style="background-color: #b9e9ec;" class='letraDetalle'>
    			<th style="width: 50px;">C&oacute;digo</th>
				<th style="width: 600px;text-align:center;">Producto</th>
				<th style="width: 45px;">Existencia</th>
				<th style="width: 45px;">Unidad</th>
				<!--th style="width: 90px;" colspan="2"><?= nbs(1);?>Acciones</th-->
    		</tr>
 		</thead>
 		
 		<tbody>	
			<?php  $posicionFila=-1; ?>			
	        <?php foreach($registros->result() as $reg):?>
				<tr class='letraDetalle'>
					<?php  $posicionFila=$posicionFila+1;  //...posicionFila
						 echo"<td style='width:50px;'><input type='text' id='idEmpleado_".$posicionFila."' name='idEmpleado_".$posicionFila."' value='".$reg->codInsumo."' readonly='readonly' style='border:none; width:50px;' /></td>";
						 echo"<td style='width: 360px;'><input type='text' id='empleado_".$posicionFila."' name='empleado_".$posicionFila."' value='".$reg->nombreInsumo."' readonly='readonly' style='border:none; width:360px;' /></td>";
						 echo"<td style='width: 60px;'><input type='text' class='letraNumero' id='categoria_".$posicionFila."' name='categoria_".$posicionFila."' value='".$reg->existencia."' readonly='readonly' style='border:none; width:60px;' /></td>";
						 echo"<td style='width: 50px;'><input type='text' class='letraNumero' id='categoria_".$posicionFila."' name='categoria_".$posicionFila."' value='".$reg->unidad."' readonly='readonly' style='border:none; width:50px;' /></td>";
				   ?>						
				</tr>
	        <?php endforeach ?>   
		</tbody>
	</table>
	
</div> <!-- fin ... cuerpoDetalle -->

<div style="height:5px;"></div>


