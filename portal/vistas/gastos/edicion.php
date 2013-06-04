
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
				nombre:'Gasto',
				modelo:'Gasto'
			},			
			pk:"id"
			
		};				
		 var editor=new Ediciongastos();
		 editor.init(config);		
		 
		 $('#'+config.tab.id+' [name="fecha"]').wijinputdate({ dateFormat: 'dd/MM/yyyy',showTrigger:true,
			dateChanged: function(e, arg){
				editor.editado=true;
			}
		 });
		 
		 $('#'+config.tab.id+' [name="hora"]').wijinputdate({ dateFormat: 'HH:mm:ss',showTrigger:false,
			dateChanged: function(e, arg){
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
			<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
				<label style="">Fecha:</label>
				<input type="text" name="fecha" class="txt_fecha" value="<?php echo $this->datos['fecha']; ?>" style="width:150px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
				<label style="">Hora:</label>
				<input type="text" name="hora" class="" value="<?php echo $this->datos['fecha']; ?>" style="width:150px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
				<label style="">Tipo de Gasto:</label>	
				<select name="fk_tipo_gasto" style="width:500px;">
					<?php
						
						foreach($this->tiposGasto as $tipo){
							$selected = ($this->datos['fk_tipo_gasto'] == $tipo['id'] )? 'selected' : '';
							echo '<option value='.$tipo['id'].' '.$selected.' >'.$tipo['nombre'].'</option>';
						}
					?>
				</select>
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
				<label style="">Documento:</label>
				<input type="text" name="documento" class="txt_documento" value="<?php echo $this->datos['documento']; ?>" style="width:500px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
				<label style="">Cantidad:</label>
				<input type="text" name="cantidad" class="txt_cantidad" value="<?php echo $this->datos['cantidad']; ?>" style="width:500px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
				<label style="">Descripcion:</label>
				<input type="text" name="descripcion" class="txt_descripcion" value="<?php echo $this->datos['descripcion']; ?>" style="width:500px;" />
			</div>
			


		</form>
	</div>
</div>
