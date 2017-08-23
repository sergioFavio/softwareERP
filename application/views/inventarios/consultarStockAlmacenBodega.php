
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.css"/>
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery-ui-1.8.20.custom.min.js"></script>


<!--link rel="stylesheet" type="text/css" media="screen" href="media/css/jquery.dataTables.css"/>
<link rel="stylesheet" type="text/css" media="screen" href="media/css/jquery.dataTables.min.css"/>

<script type="text/javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" src="media/js/jquery.dataTables.min.js"></script-->
	
	
<style type="text/css">
	.letraDetalle{font-size:11px;text-align:center; }
	#titulo{font-size:16px;margin-top:1px;  text-align:right; font-weight:bold} 
	
	#cuerpoCabecera{margin:0 auto; padding:0; width:750px; height:50px;}
	#cuerpo{margin:2px auto; padding:1; width:750px; background:#f4f4f4; heigh:500px;}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$('#tabla1').dataTable(
			{
		        "scrollY":"250px",
		        "scrollCollapse": true,
		        "paging":         false,
		         "info":  true
		    }
		);
		
	});
</script>

<div class="jumbotron" id="cuerpoCabecera" >	<!--cuerpoCrudMaterial-->
		
	    	<div style="height:10px;"></div>
			
			<div class="row">
			   	<div class="col-xs-3"> 
					<span></span>
			   	</div>
			   	             
			   	<div class="col-xs-4"> 
					<span  id="titulo" class="label label-success"> Consultar Stock Almacén y Bodega</span>
			   	</div>
			    
			    <div class="col-xs-3"> 
					<span></span>
			   	</div>
			   			     	
			    <div class="col-xs-2"> 
			    	<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
			    
			</div>  <!-- /.row -->

	
</div> <!-- fin ... cuerpoCabecera -->

<div style="height:7px;"></div>







<div class="jumbotron" id="cuerpo" >
<div style="height:5px;"></div>
	<table cellspacing="0" cellpadding="0"   class="display"  id="tabla1">
		<thead>
			<tr  class='letraDetalle'>
				<th>c&oacute;digo</th>
				<th>material</th>
				<th>almac&eacute;n</th>
				<th>bodega</th>
				<th>unidad</th>
			</tr>
		</thead>
		<tbody class='letraDetalle'>
			 <?php foreach($listaMaterial->result() as $material):?>
                <tr class='letraDetalleLightBox'>
                    <td style='width:40px;text-align:left;'> <?= $material->codigo  ?></td>
                    <td style='width:450px;text-align:left;'> <?= $material->material?></td>
                    <td style='width:70px;text-align:right;'> <?= $material->existenciaAlmacen?></td>
                    <td style='width:70px;text-align:right;'> <?= $material->existenciaBodega?></td>
                    <td style='width:70px;text-align:left;'><?= $material->unidad?></td>
                </tr>
             <?php endforeach ?>
		</tbody>
	</table>
</div>