
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
			viajes:<?php echo json_encode( $this->viajes ); ?>,
			fk_viaje:'<?php echo  empty( $this->datos['fk_viaje'] )? 0 : $this->datos['fk_viaje']; ?>',
			conceptos:<?php echo json_encode( $this->conceptos ); ?>,
			fk_vehiculo:'<?php echo  empty( $this->datos['fk_vehiculo'] )? 0 : $this->datos['fk_vehiculo']; ?>',
			
			fk_concepto:'<?php echo  empty( $this->datos['fk_concepto'] )? 0 : $this->datos['fk_concepto']; ?>',
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
			// print_r( $this->datos ); exit;
			// print_r($this->vehiculos ); exit;
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
			<div class="divEspecial">
				<div class="viaje" style="<?php if ($this->datos['fk_tipo_gasto']!=1 )  echo 'display:none;'; ?> ">
					<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
						<label style="">Viaje:</label>	
						<select name="fk_viaje" style="width:500px;">
							<?php																
								foreach($this->viajes as $obj){
									$selected = ( intval($this->datos['fk_viaje']) == intval($obj['id']) )? 'selected' : '';
									echo '<option value='.$obj['id'].' '.$selected.' >'.$obj['serie'].' '.$obj['folio'].'</option>';
								}
							?>
						</select>
					</div>	
					<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
						<label style=""></label>	
						<input type="checkbox" name="vehicle" value="ambos" <?php if ($this->datos['vehicle']) echo 'checked'; ?> > Agregar al veh&iacute;culo
					</div>	
					
				</div>
				<div class="vehiculo" style="<?php if ($this->datos['fk_tipo_gasto']!=2 ) echo 'display:none;'; ?>">				
					<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
						<label style="">Vehiculo:</label>	
						<select name="fk_vehiculo" style="width:500px;">
							<?php																
								foreach($this->vehiculos as $obj){
									$selected = ( intval($this->datos['fk_vehiculo']) == intval($obj['id']) )? 'selected' : '';
									echo '<option value='.$obj['id'].' '.$selected.' >'.$obj['codigo'].'</option>';
								}
							?>
						</select>
					</div>										
				</div>
				<div class="otros" style="<?php if ($this->datos['fk_tipo_gasto']!=3 )  echo 'display:none;'; ?>">
					
				</div>
			</div>
			<div class="inputBox documento" style="margin-bottom:8px;display:block;margin-left:10px;width:100%; <?php if ($this->datos['fk_tipo_gasto']==1 ) echo 'display:none;'; ?>"  >
					<label style="">Documento:</label>
					<input type="text" name="documento" class="txt_documento" value="<?php echo $this->datos['documento']; ?>" style="width:500px;" />
			</div>
			<div class="concepto" style="">				
				<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
					<label style="">Concepto:</label>	
					<select name="fk_concepto" style="width:500px;">
						<?php																
							foreach($this->conceptos as $obj){
								$selected = ( intval($this->datos['fk_concepto']) == intval($obj['id']) )? 'selected' : '';
								echo '<option value='.$obj['id'].' '.$selected.' >'.$obj['nombre'].'</option>';
							}
						?>
					</select>
				</div>										
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
				<label style="">Cantidad:</label>
				<input type="text" name="costo" class="txt_cantidad" value="<?php echo $this->datos['costo']; ?>" style="width:500px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
				<label style="">Descripcion:</label>
				<input type="text" name="descripcion" class="txt_descripcion" value="<?php echo $this->datos['descripcion']; ?>" style="width:500px;" />
			</div>
			


		</form>
	</div>
</div>
