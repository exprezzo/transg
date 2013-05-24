
<script src="<?php echo $MOD_WEB_PATH; ?>js/catalogos/<?php echo $_PETICION->controlador; ?>/edicion.js"></script>

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
				nombre:'Viajes',
				modelo:'Viaje'
			},			
			pk:"id"
			
		};				
		 var editor=new Edicionviajes();
		 editor.init(config);		
	});
</script>

	<div class="pnlIzq">
		<?php 	
			global $_PETICION;
			$this->mostrar('/backend/componentes/toolbar');	
			if (!isset($this->datos)){		
				$this->datos=array();		
			}
		?>
		
		<form class="frmEdicion" style="padding-top:10px;">				
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Id:</label>
	<input type="text" name="id" class="txt_id" value="<?php echo $this->datos['id']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Fecha_a_entregar:</label>
	<input type="text" name="fecha_a_entregar" class="txt_fecha_a_entregar" value="<?php echo $this->datos['fecha_a_entregar']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Contenido:</label>
	<input type="text" name="contenido" class="txt_contenido" value="<?php echo $this->datos['contenido']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Direccion_de_entrega:</label>
	<input type="text" name="direccion_de_entrega" class="txt_direccion_de_entrega" value="<?php echo $this->datos['direccion_de_entrega']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Costo:</label>
	<input type="text" name="costo" class="txt_costo" value="<?php echo $this->datos['costo']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Precio:</label>
	<input type="text" name="precio" class="txt_precio" value="<?php echo $this->datos['precio']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Fk_chofer:</label>
	<input type="text" name="fk_chofer" class="txt_fk_chofer" value="<?php echo $this->datos['fk_chofer']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Fk_vehiculo:</label>
	<input type="text" name="fk_vehiculo" class="txt_fk_vehiculo" value="<?php echo $this->datos['fk_vehiculo']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Fk_caja:</label>
	<input type="text" name="fk_caja" class="txt_fk_caja" value="<?php echo $this->datos['fk_caja']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Fk_cliente:</label>
	<input type="text" name="fk_cliente" class="txt_fk_cliente" value="<?php echo $this->datos['fk_cliente']; ?>" style="width:500px;" />
</div>

		</form>
	</div>
</div>
