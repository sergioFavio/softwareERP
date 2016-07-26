
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
	#cuerpo{margin:2px auto; padding:1; width:960px; background:#f4f4f4; heigh:500px;}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$('#tabla1').dataTable(
			{
		        "scrollY":        "200px",
		        "scrollCollapse": true,
		        "paging":         false,
		         "info":  true
		    }
		);
		
	});
</script>
<div class="jumbotron" id="cuerpo" >
<div style="height:5px;"></div>
	<table cellspacing="0" cellpadding="0"   class="display"  id="tabla1">
		<thead>
			<tr  class='letraDetalle'>
				<th>nombre</th>
				<th>direccion</th>
				<th>ciudad</th>
				<th>sexo</th>
				<th>fecha de registro</th>
			</tr>
		</thead>
		<tbody class='letraDetalle'>
			<tr>
				<th>Sergio</th>
				<th>Las Palmeras</th>
				<th>La Plata</th>
				<th>masculino</th>
				<th>25/10/2012</th>
			</tr>
			<tr>
				<th>Mauricio</th>
				<th>Los Sauces</th>
				<th>La Plata</th>
				<th>masculino</th>
				<th>25/10/2012</th>
			</tr>
			<tr>
				<th>Favio</th>
				<th>Las Palmas</th>
				<th>Cochabamba</th>
				<th>masculino</th>
				<th>25/10/2012</th>
			</tr>
			<tr>
				<th>Naomi</th>
				<th>Costanera Sur</th>
				<th>Arica</th>
				<th>femenino</th>
				<th>25/10/2012</th>
			</tr>
			<tr>
				<th>Indira</th>
				<th>Las Palmeras</th>
				<th>Cochabamba</th>
				<th>femenino</th>
				<th>25/10/2012</th>
			</tr>
			<tr>
				<th>Andrea</th>
				<th>Las Acacias</th>
				<th>Arica</th>
				<th>femenino</th>
				<th>25/10/2012</th>
			</tr>
			<tr>
				<th>Sergio</th>
				<th>Las Palmeras</th>
				<th>La Plata</th>
				<th>masculino</th>
				<th>25/10/2012</th>
			</tr>
			<tr>
				<th>Mauricio</th>
				<th>Los Sauces</th>
				<th>La Plata</th>
				<th>masculino</th>
				<th>25/10/2012</th>
			</tr>
			<tr>
				<th>Favio</th>
				<th>Las Palmas</th>
				<th>Cochabamba</th>
				<th>masculino</th>
				<th>25/10/2012</th>
			</tr>
			<tr>
				<th>Naomi</th>
				<th>Costanera Sur</th>
				<th>Arica</th>
				<th>femenino</th>
				<th>25/10/2012</th>
			</tr>
			<tr>
				<th>Indira</th>
				<th>Las Palmeras</th>
				<th>Cochabamba</th>
				<th>femenino</th>
				<th>25/10/2012</th>
			</tr>
			<tr>
				<th>Andrea</th>
				<th>Las Acacias</th>
				<th>Arica</th>
				<th>femenino</th>
				<th>25/10/2012</th>
			</tr>
			<tr>
				<th>Sergio</th>
				<th>Las Palmeras</th>
				<th>La Plata</th>
				<th>masculino</th>
				<th>25/10/2012</th>
			</tr>
			<tr>
				<th>Mauricio</th>
				<th>Los Sauces</th>
				<th>La Plata</th>
				<th>masculino</th>
				<th>25/10/2012</th>
			</tr>
			<tr>
				<th>Favio</th>
				<th>Las Palmas</th>
				<th>Cochabamba</th>
				<th>masculino</th>
				<th>25/10/2012</th>
			</tr>
			<tr>
				<th>Naomi</th>
				<th>Costanera Sur</th>
				<th>Arica</th>
				<th>femenino</th>
				<th>25/10/2012</th>
			</tr>
			<tr>
				<th>Indira</th>
				<th>Las Palmeras</th>
				<th>Cochabamba</th>
				<th>femenino</th>
				<th>25/10/2012</th>
			</tr>
			<tr>
				<th>Andrea</th>
				<th>Las Acacias</th>
				<th>Arica</th>
				<th>femenino</th>
				<th>25/10/2012</th>
			</tr>
		</tbody>
	</table>
</div>