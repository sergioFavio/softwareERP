<link rel="stylesheet" type="text/css"  href="<?=base_url(); ?>css/comprobanteContabilidad.css" />
	
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.css"/>
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url(); ?>media/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url(); ?>media/js/jquery-ui-1.8.20.custom.min.js"></script>

<script type="text/javascript" src="<?=base_url(); ?>js/comprobanteContabilidad.js"></script>

<link rel="stylesheet" href="<?= base_url("css/bootstrap-theme.min.css")?>"> <!-- una de las librerias de bootstarp para manejar fecha-->
	
<style type="text/css" >

/*  inicio de scrollbar  */
thead { display:block;  margin:0px; cell-spacing:0px; left:0px; }  
tbody { display:block; overflow:auto; height:310px; }               
th { height:10px;  width:890px;}                                    
td { height:10px;  width:890px; margin:0px; cell-spacing:0px;}
/*  fin de scrollbar  */

#cuerpoIngreso{margin:0 auto;  padding:0; width:892px; background:#f4f4f4;}
.cabeceraIngreso{margin:5px;}
#titulo{font-size:14px;margin-top:1px;  text-align:right;font-weight : bold}   
</style>

<div class="jumbotron" id="cuerpoIngreso">	
	
   <form class="form-horizontal" method="post" action="<?=base_url()?>contabilidad/grabarComprobanteModificado" id="form_" name="form_" >
   	<div style="height:7px;"></div>
	 
	<div class="cabeceraIngreso">
		<div class="row-fluid">
			
	    	<div class="col-xs-2">
				<div class="input-group input-group-sm" >
			    	<span class="input-group-addon" id="letraCabecera" >Gesti&oacute;n </span>
	    	 		<input type="text"  class="form-control input-sm" id="inputGestion" name="inputGestion" value="<?= substr($gestion,0,4).'-'.substr($gestion,4,2) ?>" readonly="readonly" placeholder="ingreso No." style="width: 78px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	<div class="col-xs-1">
	    	 	<span></span>
	    	</div>
	    	
	    	<div class="col-xs-4">
	    	 	<span  id="titulo" class="label label-default"> <?= strtoupper($titulo).' No. '.$numComprobante ?>  </span>
	    	</div> 
	    	
	 		<div class="col-xs-2">
	    	 	<span></span>
	    	</div>
	 		
	    	<div class="col-xs-2" >
				<div class="input-group input-group-sm" >
			    	<span class="input-group-addon" id="letraCabecera">Fecha </span>
	    			<input type="text" class="form-control input-sm" id="inputFecha" name="inputFecha" readonly="readonly" value="<?= $fecha ?>"  style="width: 130px;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
		</div>
		
		<div style="height:35px;"></div>
		
		<div class="row-fluid"> <!-- segunda fila de la cabecera -->
			
			<?php if($tipoComprobante=='ingreso'){ ?>
			
		    <div class="col-xs-2">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-user"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="inputCliente" name="inputCliente" value="<?= $clienteBanco ?>" readonly="readonly" style="width: 220px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	
	    	<div class="col-xs-4">
	    	 	<span></span>
	    	</div>
	    	<?php } ?>
	    	
	    	<?php if($tipoComprobante=='egreso'){ ?>
			
		    <div class="col-xs-2">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-home"></span><span class="glyphicon glyphicon-usd"></span></span>
	    	 		<input type="text" class = "form-control input-sm" id="inputCliente" name="inputCliente" value="<?= $clienteBanco ?>" readonly="readonly" style="width:160px;font-size:11px;text-align:center;">
	    		</div>
	    	</div><!-- /.col-xs-2 -->
	    	
	    	<div class="col-xs-1">
	    	 	<span></span>
	    	</div>
	    	
	    	<div class="col-xs-2">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-tag"></span></span>
	    	 		<input type="text"  class="form-control input-sm" id="inputCheque" name="inputCheque" value="<?= $numeroCheque ?>" readonly="readonly" style="width: 120px;font-size:11px;text-align:center;">
	    		</div>
	    		
	    	</div><!-- /.col-lg-4 -->
	    	
	    	<div class="col-xs-1">
	    	 	<span></span>
	    	</div>
	    	
	    	<?php } ?>
	    	
		    <div class="col-xs-3">
				<div class="input-group input-group-sm">
			    	<span class="input-group-addon" id="letraCabecera" ><span class="glyphicon glyphicon-comment"></span> </span>
	    	 		<input type="text"  class="form-control input-sm" id="inputConcepto" name="inputConcepto" value="<?= $concepto ?>" readonly="readonly" style="width: 370px;font-size:11px;text-align:center;" >
	    		</div>
	    	</div><!-- /.col-lg-4 -->
	    	
	    	<div style="height:30px;"></div>
	    	
		</div>
	</div>

	<table width="79%" class="table table-striped table-bordered table-condensed " >
	  <thead >
    	<tr style="background-color: #b9e9ec;" class='letraDetalle'>
        	<th style="width: 180px;">Código</th>
            <th style="width: 240px;">Descripción</th>
            <th style="width: 80px;text-align:center;">Debe</th>
            <th style="width: 80px;text-align:center;">Haber</th>                              
            <th style="width: 320px;text-align:center;">Glosa</th>
    	</tr>
      </thead >
    <tbody >
    		
    	<?php
        //if ciclo de impresion de filas 
		 	$x=0;
			$totDebe=0.00;		//...acumulador DEBE para comprobante recuperado ...
			$totHaber=0.00;		//...acumulador HABER para comprobante recuperado ...
			while($regCompbte = mysql_fetch_row($regComprobante)){
				echo "<tr class='detalleMaterial' >";
					echo"<td  class='openLightBox' title='Seleccionar cuenta de la tabla de Plan de Cuentas' style='width: 80px; background-color: #b9e9ec;' fila=$x >
					<input type='text' name='idCta_".$x."' id='idCta_".$x."' value='$regCompbte[0]' readonly='readonly' style='width: 60px; border:none; background-color: #b9e9ec ;' /></td>";
					
                    echo "<td class='letraDetalle'  style='width:320px; background-color: #f9f9ec;' ><input type='text' class='letraIzquierda' id='cta_".$x."' name='cta_".$x."' value='$regCompbte[1]' readonly='readonly' style='width:320px;border:none;' /></td>";
                    
					if($regCompbte[2]=='D'){
						echo "<td style='width: 85px; background-color: #d9f9ec;' ><input type='text' class='letraNumeroNegrita' name='cantDebe_".$x."' id='cantDebe_".$x."' value='$regCompbte[3]'  style='width:80px;border:none;background-color: #d9f9ec;' onChange='validarMontoDebe(this.value,$x);' /></td>";
						$totDebe=$totDebe + $regCompbte[3];
													
						echo "<td style='width: 85px; background-color: #b9e9ec;'><input type='text' class='letraNumeroNegrita'  name='cantHaber_".$x."' id='cantHaber_".$x."'   style='width: 80px; border:none; background-color: #b9e9ec;' onChange='validarMontoHaber(this.value,$x);' /></td>";  
						
						echo "<script>";
						echo "validarMontoDebeM($regCompbte[3],$x);";
						echo "</script>";
						
					}else{
						echo "<td style='width: 85px; background-color: #d9f9ec;' ><input type='text' class='letraNumeroNegrita' name='cantDebe_".$x."' id='cantDebe_".$x."'   style='width:80px;border:none;background-color: #d9f9ec;' onChange='validarMontoDebe(this.value,$x);' /></td>";
						echo "<td style='width: 85px; background-color: #b9e9ec;'><input type='text' class='letraNumeroNegrita'  name='cantHaber_".$x."' id='cantHaber_".$x."'  value='$regCompbte[3]' style='width: 80px; border:none; background-color: #b9e9ec;' onChange='validarMontoHaber(this.value,$x);' /></td>";
						$totHaber=$totHaber + $regCompbte[3];
						echo "<script>";
						echo "validarMontoHaberM($regCompbte[3],$x);";
						echo "</script>";								  
					}
                           
                    echo "<td style='width: 330px; background-color: #d9f9ec;' ><input type='text' class='letraIzquierda' name='glosa_".$x."' id='glosa_".$x."' value='$regCompbte[4]' style='width: 272px; border:none;background-color: #d9f9ec;' /></td>";
					
                echo "</tr>";
				$x=$x+1;
			}	
  
       		for($x=$nRegistrosComprobante; $x<24; $x++){
            	echo "<tr class='detalleMaterial' >";
           
					echo"<td  class='openLightBox' title='Seleccionar cuenta de la tabla de Plan de Cuentas' style='width: 80px; background-color: #b9e9ec;' fila=$x >
					<input type='text' name='idCta_".$x."' id='idCta_".$x."'  readonly='readonly' style='width: 60px; border:none; background-color: #b9e9ec ;' /></td>";
					
                    echo "<td class='letraDetalle'  style='width:320px; background-color: #f9f9ec;' ><input type='text' class='letraIzquierda' id='cta_".$x."' name='cta_".$x."' readonly='readonly' style='width:320px;border:none;' /></td>";
                    
                    echo "<td style='width: 85px; background-color: #d9f9ec;' ><input type='text' class='letraNumeroNegrita' name='cantDebe_".$x."' id='cantDebe_".$x."'  style='width:80px;border:none;background-color: #d9f9ec;' onChange='validarMontoDebe(this.value,$x);'/></td>";
					
                    echo "<td style='width: 85px; background-color: #b9e9ec;'><input type='text' class='letraNumeroNegrita'  name='cantHaber_".$x."' id='cantHaber_".$x."' style='width: 80px; border:none; background-color: #b9e9ec;' onChange='validarMontoHaber(this.value,$x);'/></td>";  
					          
                    echo "<td style='width: 330px; background-color: #d9f9ec;' ><input type='text' class='letraIzquierda' name='glosa_".$x."' id='glosa_".$x."' style='width: 272px; border:none;background-color: #d9f9ec;' onChange='validarGlosa(this.value,$x);'/></td>";
					
                echo "</tr>";
				
             }
         ?>
   
      </tbody>
	</table>
	
	<div class="totalBs">
		
	     <span > 
	 		<input type="text"   id="inputLiteral" name="inputLiteral" readonly="readonly"   placeholder="Son: ..00/100 Bolivianos.&hellip;" style="width: 550px;font-size:11px;text-align:center;">
	    </span>&nbsp;&nbsp;
		
		<span class="label label-info">&nbsp;&nbsp;&nbsp; Total Bs.:</span>&nbsp;&nbsp;&nbsp;
		<span class="label label-info">
			<input type='text' class='letraNumero' name='detalleTotalDebe' id='detalleTotalDebe' value='<?= number_format($totDebe,2) ?>' size='9' readonly='readonly' style='border:none; background-color: #2ECCFA;'/>
		</span>&nbsp;&nbsp;&nbsp;
				
		<span class="label label-info">
			<input type='text' class='letraNumero' name='detalleTotalHaber' id='detalleTotalHaber' value='<?= number_format($totHaber,2) ?>' size='9' readonly='readonly' style='border:none; background-color: #2ECCFA;'/>
		</span>
	</div>	
		
		
	<input type="hidden"  name="numeroFilas"  />
	<input type="hidden"  name="tipoComprobante" value="<?= $tipoComprobante ?>" />     <!--  tipoComprobante: ingreso/egreso/traspaso -->
	<input type="hidden"  name="numComprobante" value="<?= $numComprobante ?>" />     	<!--  numComprobante: ingreso/egreso/traspaso -->
	
	<div style="text-align: right; padding-top: 5px;">  
    	<button type="button" id="btnSalir" class="btn btn-primary btn-sm" onClick="window.location.href='<?=base_url();?>menuController/index'"><span class="glyphicon glyphicon-eject"></span> Salir</button>&nbsp;
        <button type="button" class="btn btn-default btn-sm"  id="btnBorrarComprobante"><span class="glyphicon glyphicon-remove"></span> Borrar</button>&nbsp;
        <button type="button" class="btn btn-inverse btn-sm" id="btnGrabarComprobanteModificado" ><span class="glyphicon glyphicon-hdd"></span> Grabar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
					<th style='width:40px;'>Cuenta</th>
					<th style='width:350px;'>Descripción</th>
					<th style='width:30px;'>Nivel</th>
				</tr>
			</thead>
			<tbody>			
                <?php foreach($cuentas as $cuenta):?>
                    <tr class='letraDetalleLightBox'>
                        <td style='width:40px;'> <?= $cuenta["cuenta"] ?></td>
                        <td style='width:400px;'> <?= $cuenta["descripcion"]?></td>
                        <td style='width:30px;text-align:right;'> <?= $cuenta["nivel"]?></td>
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
