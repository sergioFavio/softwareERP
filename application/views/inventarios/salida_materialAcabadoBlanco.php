
<link rel="stylesheet" type="text/css"  href="<?=base_url(); ?>css/ingresoSalidaMaterial.css" />
	
<!--link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.css"/-->
<!--script type="text/javascript" src="<?=base_url(); ?>media/js/jquery.dataTables.min.js"></script-->
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery-ui-1.8.20.custom.min.js"></script>

<!--script type="text/javascript" src="<?=base_url(); ?>js/ingresoSalidaMaterial.js"></script-->

<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>"> <!-- una de las librerias de bootstarp para manejar fecha-->

<style type="text/css" >

.pedido-dialog {width:500px; }
#pedidoModal{padding-top:30px;padding-left:420px;}  /* ... baja la ventana modal más al centro vertical ... */


	/*  inicio de scrollbar  */
thead { display:block;  margin:0px; cell-spacing:0px; left:0px; }  
tbody { display:block; overflow:auto; height:330px; }               
th { height:10px;  width:665px;}                                    
td { height:10px;  width:665px; margin:0px; cell-spacing:0px;}
/*  fin de scrollbar  */

#cuerpoSalida{margin:0 auto;  padding:0; width:669px; background:#f4f4f4;}
.cabeceraSalida{margin:10px;}

#titulo{font-size:14px;margin-top:1px;  text-align:right;font-weight : bold}
</style>

<script>

$(document).ready(function(){
			
	$("#btnGrabar").click(function(){
		// grabar salida [almacen]
    	grabarSalida();
	});
	

}); // fin document.ready 


function grabarSalida(){
	var i=0;
	var registrosValidos= true;	  // ... bandera para grabar o no grabar registros ...
	
	if($("#inputFecha").val()=="" ){
			alert("¡¡¡ E R R O R !!! ... El contenido de FECHA está vacío, seleccione una fecha");
			var registrosValidos= false;	
	}
	
	if($("#inputGlosa").val()==null ){
			alert("¡¡¡ E R R O R !!! ... El contenido de GLOSA está vacío");
			var registrosValidos= false;	
	}
	
	if( $("#inputOrden").val()==null ){
			alert("¡¡¡ E R R O R !!! ... El contenido de NUMERO de ORDEN está vacío");
			var registrosValidos= false;	
	}
	
	if($("#idMat_0").val()==null ){
			alert("¡¡¡ E R R O R !!! ... No se ha ingresado ningún registro de materiales");
			var registrosValidos= false;	
	}
		
	// ... valida que los registros no tengan cantidad vacia o cantidad > existencia ...
	while($("#idMat_"+i).val()!= null){
		
		var cantidad=$("#cantMat_"+i).val();
		cantidad=cantidad.split(','); //... elimina ,
		cantidad=cantidad[0]+cantidad[1]+cantidad[2];	
		cantidad=parseFloat(cantidad);
		
		var existencia=$("#existMat_"+i).val();
		existencia=existencia.split(','); //... elimina ,
		existencia=existencia[0]+existencia[1]+existencia[2];	
		existencia=parseFloat(existencia);

		if($("#cantMat_"+i).val()==null){
			alert("¡¡¡ E R R O R !!! ... El valor de CANTIDAD está vacío");
			var registrosValidos= false;	
		}else{	
			if(cantidad > existencia ){
				alert("¡¡¡ E R R O R !!! ... El codigo: "+ $("#idMat_"+i).val()  +" tiene CANTIDAD: " +cantidad +" mayor que EXISTENCIA: "+existencia);
				var registrosValidos= false;	
			}
		}
	
		i++;
	} // ... fin while ...

	document.form_.numeroFilas.value=i;  // ... numeroFilasValidas  variable hidden formulario...
		
	if(!registrosValidos){
		alert('Corrija los campos que están vacíos y/o registros que tienen CANTIDAD vacía o mayor que EXISTENCIA');
	}else{
		$("#form_").submit(); // ...  graba registros ...
	}
			
}	// ... fin funcion grabarSalida() ...


function separadorMilesExistencia(numero, filaExistencia){		//...validarMontoHaberM ... modificar comprobante ...
	var cantidad=$("#existMat_"+filaExistencia).val();
	cantidad=parseFloat(cantidad);
	$("#existMat_"+filaExistencia).val( separadorMiles( cantidad.toFixed(2) ) );   //... actualiza cantHaber
}   // fin ... validarMontoHaberM(odificacion) ...

function separadorMilesCantidad(numero, filaExistencia){		//...validarMontoHaberM ... modificar comprobante ...
	var cantidad=$("#cantMat_"+filaExistencia).val();
	cantidad=parseFloat(cantidad);
	$("#cantMat_"+filaExistencia).val( separadorMiles( cantidad.toFixed(2) ) );   //... actualiza cantHaber
}   // fin ... validarMontoHaberM(odificacion) ...

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
		
   <form class="form-horizontal" method="post" action="<?=base_url()?>materiales/grabarSalida" id="form_" name="form_" >
   	  <div style="height:10px;"></div>
   	   
      <div class="cabeceraSalida">
		<div class="row-fluid">
			
	    	<div class="col-xs-2">
				<div class="input-group input-group-sm" >
			    	<span class="input-group-addon" id="letraCabecera" >Salida No. </span>
	    	 		<input type="text"  class="form-control input-sm" id="inputNumero" name="inputNumero" value="<?= $salida ?>" readonly="readonly" placeholder="salida No." style="width: 70px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	<div class="col-xs-1">
	    	 	<span></span>
	    	</div>
	    	
	    	<div class="col-xs-3">
	    	 	<span  id="titulo" class="label label-default"><?= strtoupper($titulo) ?></span>
	    	</div> 
	    	
	    	<div class="col-xs-2">
	    	 	<span></span>
	    	</div>
	    	
	    	<div class="col-xs-2" >
				<div class="input-group input-group-sm" >
			    	<span class="input-group-addon" id="letraCabecera">Fecha </span>
	    			<input type="date" class="form-control input-sm" id="inputFecha" name="inputFecha" value="<?=date('d-m-Y')?>"  style="width: 135px;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
		</div>
		
		
		<div style="height:35px;"></div>
		
		<div class="row-fluid"> <!-- segunda fila de la cabecera -->
			
		    <div class="col-lg-4">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" >Trabajador </span>
	    	 		<input type="text"  class="form-control input-sm" id="inputGlosa" name="inputGlosa" readonly="readonly" value="<?= $trabajador ?>" style="width: 220px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	
	    	<div class="col-xs-2 col-md-2">
	    	 	<span></span>
	    	</div>
	    	
	    	
		    <div class="col-lg-4">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" >Orden No. </span>
	    	 		<input type="text"  class="form-control input-sm" id="inputOrden" name="inputOrden"  readonly="readonly" value="<?= $orden ?>" style="background-color:#d9f9ec;width:90px;font-size:11px;text-align:center;" >
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
    <tbody>
    	
    	<?php
    	
    	$x=-1;
		while($plantilla = mysql_fetch_row($regPlantilla)){
			echo "<tr class='detalleMaterial' >";
           
		   		$x=$x+1;
				
				echo"<td  class='letraDetalle' style='width: 80px; background-color: #d9f9ec;' fila=$x>
				<input type='text' name='idMat_".$x."' id='idMat_".$x."' value='$plantilla[0]'  readonly='readonly' style='width: 60px; border:none; background-color: #d9f9ec;' /></td>";
				
                echo "<td class='letraDetalle'  style='width: 320px; background-color: #f9f9ec;' ><input type='text' id='mat_".$x."' name='mat_".$x."' size='50' value='$plantilla[1]' readonly='readonly' style='border:none;' /></td>";
                
                echo "<td style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraNumero' name='existMat_".$x."' id='existMat_".$x."' value='$plantilla[2]' size='7' readonly='readonly' style='border:none;' /></td>";
				echo "<script>";
				echo "separadorMilesExistencia($plantilla[2],$x);";
				echo "</script>";

				$cantidadMaterial=$plantilla[3]*$cantidadProducto;
                echo "<td style='width: 80px; background-color: #d9f9ec;'><input type='text' class='letraNumeroNegrita' name='cantMat_".$x."' id='cantMat_".$x."' value='$cantidadMaterial,2)' readonly='readonly' style='width: 80px; border:none; background-color: #d9f9ec;' /></td>";  
				echo "<script>";
				echo "separadorMilesCantidad($cantidadMaterial,$x);";
				echo "</script>";		 
				          
                echo "<td style='width: 80px; background-color: #f9f9ec;' ><input type='text' class='letraCentreada' name='unidadMat_".$x."' id='unidadMat_".$x."' value='$plantilla[4]' size='7' readonly='readonly' style='border:none;'/></td>";

	        echo "</tr>";
			
		}
    	
    	?>
    	
      </tbody>
  
	</table>
	
	<input type="hidden"  name="numeroFilas" />
	<input type="hidden"  name="nombreDeposito" value="<?= $nombreDeposito ?>" />     <!--  nombreDeposito: almacen -->
	
	<div style="text-align: right; padding-top: 3px;">   
    	<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;
        <button type="button" class="btn btn-inverse btn-sm" id="btnGrabar" ><span class="glyphicon glyphicon-hdd"></span> Grabar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   </div>
   <div style="height:10px;"></div>
   </form>
</div>
