
<script src="<?php echo $MOD_WEB_PATH; ?>js/catalogos/<?php echo $_PETICION->controlador; ?>/busqueda.js"></script>
<style>
	[headers="Fecha"]{
		text-align:right;
	}
</style>
<script>			
	$( function(){		
		var config={
			tab:{
				id:'<?php echo $_REQUEST['tabId']; ?>'
			},
			controlador:{
				nombre:'<?php echo $_PETICION->controlador; ?>'
			},
			modulo:{
				nombre:'<?php echo $_PETICION->modulo; ?>'
			},
			catalogo:{
				nombre:'Efectivo'

			},			
			pk:"id"
			
		};				
		 var lista=new Busquedaefectivo();
		 lista.init(config);		
		
		$('#'+config.tab.id+' [name="fecha_i"]').wijinputdate({ dateFormat: 'dd/MM/yyyy',showTrigger:true});		 
		$('#'+config.tab.id+' [name="fecha_f"]').wijinputdate({ dateFormat: 'dd/MM/yyyy',showTrigger:true});		 
		
	});
</script>
<?php 	
	global $_PETICION;
	$this->mostrar('/busqueda_toolbar');
?>
<div >	
	<table class="grid_busqueda">
		<thead>
			<th>id</th>		
			<th>titulo</th>					
		</thead>  	 
		<tbody>			
		</tbody>
	</table>
</div>
</div>
