
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
				nombre:'Vehiculos',
				modelo:'Vehiculo'
			},			
			pk:"id"
			
		};				
		 var editor=new Edicionvehiculos();
		 editor.init(config);		
		 
		 $('#'+config.tab.id +' .cerrar_tab').bind('click', function(){
			TabManager.cerrarTab( config.tab.id );
		 });
		 
		 $('#'+config.tab.id + ' [name="fk_caja"]').wijcombobox({
			select:function(){
				editor.editado=true;
			}
		 });
		 
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
			<div class="inputBox" style="margin-bottom:8px;display:none;margin-left:10px;width:100%;"  >
				<label style="">Id:</label>
				<input type="text" name="id" class="txt_id" value="<?php echo $this->datos['id']; ?>" style="width:500px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
				<label style="">Codigo:</label>
				<input type="text" name="codigo" class="txt_codigo" value="<?php echo $this->datos['codigo']; ?>" style="width:500px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
				<label style="">Modelo:</label>
				<input type="text" name="modelo" class="txt_modelo" value="<?php echo $this->datos['modelo']; ?>" style="width:500px;" />
			</div>			
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
				<label style="">Placas:</label>
				<input type="text" name="placas" class="txt_placas" value="<?php echo $this->datos['placas']; ?>" style="width:500px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
				<label style="">Rendimiento:</label>
				<input type="text" name="rendimiento" class="txt_rendimiento" value="<?php echo $this->datos['rendimiento']; ?>" style="width:500px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
				<label style="">Caja:</label>
				
				<select name="fk_caja" class="txt_fk_caja" >
					<?php 
					
					foreach($this->cajas as $caja) {						
						$selected = ($caja['id'] == $this->datos['fk_caja'] )? 'selected' : '';
						echo '<option '.$selected.' value="'.$caja['id'].'">'.$caja['codigo'].'</option>';
						
					}
					
					?>
				</select>
				
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
				<label style="">Kilometraje:</label>
				<input type="text" name="kilometraje" class="txt_kilometraje" value="<?php echo $this->datos['kilometraje']; ?>" style="width:500px;" />
			</div>

		</form>
	</div>
</div>
