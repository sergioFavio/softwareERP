<link rel="stylesheet" type="text/css"  href="<?=base_url(); ?>css/ingresoSalidaMaterial.css" />
	
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.css"/>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery-ui-1.8.20.custom.min.js"></script>

<script type="text/javascript" src="<?=base_url(); ?>js/ingresoSalidaMaterial.js"></script>

<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>"> <!-- una de las librerias de bootstarp para manejar fecha-->

<style type="text/css" >

	/*  inicio de scrollbar  */
thead { display:block;  margin:0px; cell-spacing:0px; left:0px; }  
tbody { display:block; overflow:auto; height:330px; }               
th { height:10px;  width:665px;}                                    
td { height:10px;  width:665px; margin:0px; cell-spacing:0px;}
/*  fin de scrollbar  */

#cuerpoSalida{margin:0 auto;  padding:0; width:669px; background:#f4f4f4;}
.cabeceraSalida{margin:10px;}

#titulo{font-size:14px;margin-top:1px;  text-align:right;font-weight : bold}

.cabecera-dialog {width:580px;}
#cabeceraModal{padding-left:350px;}  /* ... baja la ventana modal más al centro vertical ... */

</style>

<script>

$(document).ready(function() {
	
	
	  
}); // fin document.ready 
		
</script>

<div class="jumbotron" id="cuerpoSalida">		
		
   <form class="form-horizontal" method="post" action="<?=base_url()?>materiales/grabarModificarSalida" id="form_" name="form_" >
   	  <div style="height:10px;"></div>
   	   
      <div class="cabeceraSalida">
		<div class="row-fluid">
			
	    	<div class="col-md-3">
				<div class="input-group input-group-sm" >
			    	<span class="input-group-addon" id="letraCabecera" >Salida No. </span>
	    	 		<input type="text"  class="form-control input-sm" id="inputNumero" name="inputNumero" title='Seleccionar NUMERO SALIDA' readonly="readonly" value="<?= $nSalida ?>" placeholder="salida No." style="width:70px;font-size:11px;text-align:center;">
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	<div class="col-md-5">
	    	 	<span  id="titulo" class="label label-default"><?= strtoupper($titulo) ?></span>
	    	</div> 
	    	
	    	<div class="col-md-2" >
				<div class="input-group input-group-sm" >
			    	<span class="input-group-addon" id="letraCabecera">Fecha </span>
	    			<input type="text" class="form-control input-sm" id="inputFecha" name="inputFecha" readonly="readonly" value="<?= $fecha ?>" style="width: 135px;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
		</div>
		
		
		<div style="height:35px;"></div>
		
		<div class="row-fluid"> <!-- segunda fila de la cabecera -->
			
		    <div class="col-lg-4">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" >Trabajador </span>
	    	 		<input type="text"  class="form-control input-sm" id="inputGlosa" name="inputGlosa" readonly="readonly" value="<?= $glosa ?>" placeholder="trabajador&hellip;" style="width: 220px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	
	    	<div class="col-xs-2 col-md-2">
	    	 	<span></span>
	    	</div>
	    	
	    	
		    <div class="col-lg-4">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" >Orden No. </span>
	    	 		<input type="text"  class="form-control input-sm" id="inputOrden" name="inputOrden" readonly="readonly" value="<?= $nOrden ?>" placeholder="orden No.&hellip;" style="width: 90px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	<div style="height:25px;"></div>
	    	
		</div>
	</div>

	<table width="79%" class="table table-striped table-bordered table-condensed " >
	  <thead >
    	<tr style="background-color: #b9e9ec; " class='letraDetalle'>
        	<th style="width: 180px;">Código</th>
            <th style="width: 235px;">Material</th>
            <th style="width: 85px;">Existencia</th>
            <th style="width: 82px;">Cantidad</th>                              
            <th style="width: 85px">Unidad</th>
    	</tr>
      </thead >
    <tbody >
    		
    	<?php
        //if ciclo de impresion de filas 
        	$x=0;
			while($regSalida = mysql_fetch_row($regSalidas)){   		
				echo "<tr class='detalleMaterial' >";
           
					echo"<td  class='openLightBox' title='Seleccionar material de la tabla de $titulo' style='width: 80px; background-color: #d9f9ec;' fila=$x>
					<input type='text' name='idMat_".$x."' id='idMat_".$x."'  value='$regSalida[0]' readonly='readonly' style='width: 60px; border:none; background-color: #d9f9ec;' /></td>";
					
                    echo "<td class='letraDetalle'  style='width: 320px; background-color: #f9f9ec;' ><input type='text' id='mat_".$x."' name='mat_".$x."' size='50' value='$regSalida[1]' readonly='readonly' style='border:none;' /></td>";
                    
                    echo "<td style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraNumero' name='existMat_".$x."' id='existMat_".$x."' size='7' value='$regSalida[2]' readonly='readonly' style='border:none;' /></td>";
					
                    echo "<td style='width: 80px; background-color: #d9f9ec;'><input type='text' class='letraNumeroNegrita' name='cantMat_".$x."' id='cantMat_".$x."' value='$regSalida[3]' style='width: 80px; border:none; background-color: #d9f9ec;' onChange='validarCantidad(this.value,$x);'/></td>";  
					          
                    echo "<td style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraCentreada' name='unidadMat_".$x."' id='unidadMat_".$x."' size='7' value='$regSalida[4]' readonly='readonly' style='border:none;'/></td>";
                echo "</tr>";
        		$x=$x+1;
			}
			
        
       		for($x=$nRegistrosSalida; $x<25; $x++){
            	echo "<tr class='detalleMaterial' >";
           
					echo"<td  class='openLightBox' title='Seleccionar material de la tabla de $titulo' style='width: 80px; background-color: #d9f9ec;' fila=$x>
					<input type='text' name='idMat_".$x."' id='idMat_".$x."'  readonly='readonly' style='width: 60px; border:none; background-color: #d9f9ec;' /></td>";
					
                    echo "<td class='letraDetalle'  style='width: 320px; background-color: #f9f9ec;' ><input type='text' id='mat_".$x."' name='mat_".$x."' size='50' readonly='readonly' style='border:none;' /></td>";
                    
                    echo "<td style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraNumero' name='existMat_".$x."' id='existMat_".$x."' size='7' readonly='readonly' style='border:none;' /></td>";
					
                    echo "<td style='width: 80px; background-color: #d9f9ec;'><input type='text' class='letraNumeroNegrita' name='cantMat_".$x."' id='cantMat_".$x."' style='width: 80px; border:none; background-color: #d9f9ec;' onChange='validarCantidad(this.value,$x);'/></td>";  
					          
                    echo "<td style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraCentreada' name='unidadMat_".$x."' id='unidadMat_".$x."' size='7' readonly='readonly' style='border:none;'/></td>";
                echo "</tr>";
             }
         ?>
      </tbody>
  
	</table>
	
	<input type="hidden"  name="numeroFilas"  />
	<input type="hidden"  name="nombreDeposito" value="<?= $nombreDeposito ?>" />     <!--  nombreDeposito: almacen/bodega -->
	
	
	<div style="text-align: right; padding-top: 3px;">   
    	<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;
        <button type="button" class="btn btn-default btn-sm"  id="btnBorrarSalida"><span class="glyphicon glyphicon-remove"></span> Borrar</button>&nbsp;
        <button type="button" class="btn btn-inverse btn-sm" id="btnGrabarSalida" ><span class="glyphicon glyphicon-hdd"></span> Grabar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   </div>
   <div style="height:10px;"></div>
   </form>
</div>


<!-- ... inicio  lightbox ... -->

<div id="myModal"  class="modal fade" tabindex="-1" role="dialog" >
  <div class="modal-dialog"  >
  <div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h4 class="modal-title">cabecera de caja luz</h4>
	</div>
	<div class="modal-body">
		
		<table  cellspacing="0" cellpadding="0" border="0" class="display" id="tabla2">
			<thead>
				<tr class='letraDetalleLightBox'>
					<th style='width:40px;'>cod Insumo</th>
					<th style='width:450px;'>Material</th>
					<th style='width:60px;'>Existencia</th>
					<th style='width:30px;'>Unidad</th>
					<th style='width:30px;'>Tipo Insumo</th>
				</tr>
			</thead>
			<tbody>			
                <?php foreach($insumos as $insumo):?>
                    <tr class='letraDetalleLightBox'>
                        <td style='width:40px;'> <?= $insumo["codInsumo"] ?></td>
                        <td style='width:450px;'> <?= $insumo["nombreInsumo"]?></td>
                        <td style='width:70px;'> <?= $insumo["existencia"]?></td>
                        <td style='width:70px;'><?= $insumo["unidad"]?></td>
                        <td style='width:30px;'><?= $insumo["tipoInsumo"]?></td>
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
<!-- ... fin  lightbox ... -->
