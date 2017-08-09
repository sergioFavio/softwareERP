<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery-ui-1.8.20.custom.min.js"></script>

<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>"> <!-- una de las librerias de bootstarp para manejar fecha-->

<style type="text/css" >

	/*  inicio de scrollbar  */
thead { display:block;  margin:0px; cell-spacing:0px; left:0px; }  
tbody { display:block; overflow:auto; height:330px; }               
th { height:10px;  width:890px;}                                    
td { height:10px;  width:890px; margin:0px; cell-spacing:0px;}
/*  fin de scrollbar  */

#cuerpoSalida{margin:0 auto;  padding:0; width:658px; background:#f4f4f4;}
.cabeceraSalida{margin:10px;}

#inputFecha, #inputFechaInicial, #inputFechaFinal{font-size:11px;text-align:center;}

#letraCabecera{font-size:12px;margin-top:1px; margin-left:25px; text-align:left;}

.letraDetalle , .openLightBox{font-size:11px;text-align:left;}

.letraCentreada{font-size:11px;text-align:center;}
 			
.letraNumero{font-size:11px;text-align:right;}
        
.letraNumeroNegrita{font-size:11px;text-align:right; font-weight : bold;}


</style>


<script>

var filaActual =-100;  // fila del formulario donde se adiciona registro ..
	
$(document).ready(function() {
			
	$("#btnGrabarNotaEntrega").click(function(){
	// grabar salida [almacen/bodega]
    	grabarNotaEntrega();
	});
		
}); // fin document.ready 
		
	
function grabarNotaEntrega(){
	var registrosValidos= true;	  // ... bandera para grabar o no grabar registros ...
	
	if($("#fecha").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de FECHA está vacío");
			var registrosValidos= false;	
	}
			
	if(!registrosValidos){
		alert('Corrija los campos que están vacíos y/o registros que tienen CANTIDAD vacía.');
	}else{
		$("#form_").submit(); // ...  graba registros ...
	}
			
}	// ... fin funcion grabarNotaEntrega() ...
		
		
function separadorMiles(n){
    var rx=  /(\d+)(\d{3})/;
    return String(n).replace(/^\d+/, function(w){
        while(rx.test(w)){
            w= w.replace(rx, '$1,$2');
        }
        return w;
    });
}

</script>

<div class="jumbotron" id="cuerpoSalida">		

   <form class="form-horizontal" method="post" action="<?=base_url()?>tienda/grabarNotaEntrega" id="form_" name="form_" >
   	  <div style="height:10px;"></div>
   	   
      <div class="cabeceraSalida">
		<div class="row-fluid">
			
	    	<div class="col-lg-2">
				<div class="input-group input-group-sm" >
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-tag"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="numeroPedido" name="numeroPedido" value="<?= $numeroPedido ?>" readonly="readonly" placeholder="pedido #&hellip;" style="background-color:#d9f9ec;width:90px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-2 -->
	    	
			<div class="col-xs-1">
				<span></span>
			</div>    	
	    	
	    	<div class="col-xs-5">
	    	 	<span class="label label-default" style="font-size:14px;text-align:center;">Nota Remisi&oacute;n <?= $local.' : '.substr($remision,0,4).' / '.substr($remision,4,strlen($remision)-4) ?> </span>
	    	</div> 
	    	
			<div class="col-xs-1">
				<span></span>
			</span>
		
			<div class="col-xs-1">
				<div class="input-group input-group-sm" >
			    	<span class="input-group-addon" id="letraCabecera"><span class="glyphicon glyphicon-calendar"></span> </span>
	    			<input type="date" class="form-control input-sm" id="fecha" name="fecha" value="<?=date('d-m-Y')?>"  style="width: 130px;" >
	    		</div>
	    	</div><!-- /.col-xs-1 -->
	    	
	    </div>
		
		<div style="height:35px;"></div>
		
		<div class="row-fluid"> <!-- segunda fila de la cabecera -->
			
		    <div class="col-xs-4">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-user"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="cliente" name="cliente"  readonly='readonly' value="<?= $cliente?>" placeholder="cliente&hellip;" style="width:200px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	<div class="col-xs-2">
	    	 	<span></span>
	    	</div>
	    	
		    <div class="col-xs-4">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-globe"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="direccion" name="direccion" value="<?= $direccion ?>" placeholder="direcci&oacute;n&hellip;" style="width:250px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-2 -->
	    	
	    	<div style="height:35px;"></div>
	    	
		</div>
	</div>

	<table width="79%" class="table table-striped table-bordered table-condensed " >
	  <thead >
    	<tr style="background-color: #b9e9ec; " class='letraDetalle'>
        	<th style="width: 180px;">Pedido</th>
            <th style="width: 320px;">Material</th>
            <th style="width: 80px;">Cantidad</th>                              
            <th style="width: 80px">Unidad</th>
    	</tr>
      </thead >
    <tbody >
    		
    	<?php
    		$x=-1;
			$item='';
			while($regCompbte = mysql_fetch_row($regPedido)){
				$x=$x+1;
				$item=$regCompbte[0].'-'.$regCompbte[8];		//... item del pedido ...
            	echo "<tr class='detalleMaterial' >";
					echo"<td  class='letraDetalle' style='width: 80px; background-color: #d9f9ec;' fila=$x>
					<input type='text' name='idMat_".$x."' id='idMat_".$x."' value='$item'  readonly='readonly' style='width: 70px; border:none; background-color: #d9f9ec;' /></td>";
                    echo "<td class='letraDetalle'  style='width:390px; background-color: #f9f9ec;' ><textarea rows='5'  id='mat_".$x."' name='mat_".$x."'    style='border:none;width:380px;' />$regCompbte[2]</textarea></td>";
                    echo "<td style='width: 80px; background-color: #f9f9ec;'><input type='text' class='letraNumeroNegrita' name='cantMat_".$x."' id='cantMat_".$x."' value='$regCompbte[4]'  readonly='readonly' style='width: 80px; border:none;' /></td>";          
                    echo "<td style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraCentreada' name='unidadMat_".$x."' id='unidadMat_".$x."' value='$regCompbte[5]' size='7' readonly='readonly' style='border:none;'/></td>";
                echo "</tr>";
             }
    	
         ?>
      </tbody>
  
	</table>
	
	<input type="hidden"  name="numeroFilas"    value="<?=  $nRegistrosPedido ?>" />
	<input type="hidden"  name="local" value="<?= $local ?>" />     <!--  local: T:ienda/F:abrica/Z:uñiga -->
	<input type="hidden"  name="telefono" value="<?= $fono ?>" />     <!--  fono/celular -->
	<input type="hidden"  name="numeroRemision" value="<?= $remision ?>" />     <!--  numero notaEntrega -->

	<div style="text-align: right; padding-top: 3px;">   
    	<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;
        <button type="button" class="btn btn-inverse btn-sm" id="btnGrabarNotaEntrega" ><span class="glyphicon glyphicon-hdd"></span> Grabar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   </div>
   <div style="height:10px;"></div>
   </form>
</div>
