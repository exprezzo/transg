
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
				nombre:'Consumo',
				modelo:'Consumo'
			},			
			pk:"id"
			
		};				
		 var editor=new Edicionconsumos();
		 editor.init(config);		
	});
</script>

	<div class="pnlIzq">
		<div style="" class="cerrar_tab"></div>
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
	<label style="">Fk_viaje:</label>
	<input type="text" name="fk_viaje" class="txt_fk_viaje" value="<?php echo $this->datos['fk_viaje']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Distancia:</label>
	<input type="text" name="distancia" class="txt_distancia" value="<?php echo $this->datos['distancia']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Rendimiento:</label>
	<input type="text" name="rendimiento" class="txt_rendimiento" value="<?php echo $this->datos['rendimiento']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Consumo_diesel_lt:</label>
	<input type="text" name="consumo_diesel_lt" class="txt_consumo_diesel_lt" value="<?php echo $this->datos['consumo_diesel_lt']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Precio_por_litro:</label>
	<input type="text" name="precio_por_litro" class="txt_precio_por_litro" value="<?php echo $this->datos['precio_por_litro']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Consumo_en_pesos:</label>
	<input type="text" name="consumo_en_pesos" class="txt_consumo_en_pesos" value="<?php echo $this->datos['consumo_en_pesos']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Kilometraje_inicial:</label>
	<input type="text" name="kilometraje_inicial" class="txt_kilometraje_inicial" value="<?php echo $this->datos['kilometraje_inicial']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Kilometraje_final:</label>
	<input type="text" name="kilometraje_final" class="txt_kilometraje_final" value="<?php echo $this->datos['kilometraje_final']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Kilometraje_recorrido:</label>
	<input type="text" name="kilometraje_recorrido" class="txt_kilometraje_recorrido" value="<?php echo $this->datos['kilometraje_recorrido']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Consumo_diesel_calculado_lt:</label>
	<input type="text" name="consumo_diesel_calculado_lt" class="txt_consumo_diesel_calculado_lt" value="<?php echo $this->datos['consumo_diesel_calculado_lt']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Consumo_diesel_calculado_pesos:</label>
	<input type="text" name="consumo_diesel_calculado_pesos" class="txt_consumo_diesel_calculado_pesos" value="<?php echo $this->datos['consumo_diesel_calculado_pesos']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Consumo_diesel_real_pesos:</label>
	<input type="text" name="consumo_diesel_real_pesos" class="txt_consumo_diesel_real_pesos" value="<?php echo $this->datos['consumo_diesel_real_pesos']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Diferencia:</label>
	<input type="text" name="diferencia" class="txt_diferencia" value="<?php echo $this->datos['diferencia']; ?>" style="width:500px;" />
</div>

		</form>
	</div>
</div>
