
<script src="<?php echo $MOD_WEB_PATH; ?>js/catalogos/<?php echo $_PETICION->controlador; ?>/edicion.js"></script>
<script src="<?php echo $MOD_WEB_PATH; ?>js/catalogos/<?php echo $_PETICION->controlador; ?>/detalles_viaje.js"></script>

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
			choferes:<?php echo json_encode($this->choferes); ?>,
			pk:"id",
			fk_chofer:<?php echo empty( $this->datos['fk_chofer'])? 0 : $this->datos['fk_chofer'] ; ?>,
			fk_vehiculo:<?php echo empty( $this->datos['fk_vehiculo'] )? 0 : $this->datos['fk_vehiculo']; ?>,
			fk_cliente:<?php echo empty( $this->datos['fk_cliente'] )? 0 : $this->datos['fk_cliente']; ?>
			
		};				
		 var editor=new Edicionviajes();
		 editor.init(config);		
		 var tabId='#'+config.tab.id;
		 
		 $('#'+config.tab.id+' [name="fk_caja"]').wijcombobox();
		 // $('#'+config.tab.id+' [name="fk_vehiculo"]').wijcombobox();
		 // $('#'+config.tab.id+' [name="fk_cliente"]').wijcombobox();
		 
		 
		 $(tabId+' [name="fecha_a_entregar"]').wijinputdate({ dateFormat: 'dd/MM/yyyy',showTrigger:true });
		 $(tabId+' [name="hora_a_entregar"]').wijinputdate({ dateFormat: 'HH:mm',showTrigger:false });
		 $(tabId+' [name="precio"]').wijinputnumber({type:'currency', decimalPlaces: 2, increment: 1, showSpinner: true});
		 
		 
		 $(tabId+' .cerrar_tab').bind('click', function(){
			TabManager.cerrarTab( config.tab.id );
		 });
		 
		 
		 var paramsDetalle={
			tabId:tabId,
			fk_padre:$('#'+config.tab.id + ' [name="'+config.pk+'"]').val(),
			articulos: <?php echo json_encode($this->gastos); ?>
		 };
		 var detalle=new DetallesViaje();
		 detalle.init(paramsDetalle);
	});	
</script>
<style>
.frmviajes.tab_viajes fieldset{
	width:645px;
}
.frmviajes.tab_viajes .txt_hora_a_entregar{
	width:94%;
}
.frmviajes.tab_viajes .datos_internos label{
	width:auto;
	bottom:3px;
	position:relative;
}


.frmviajes.tab_viajes .datos_internos label{
	vertical-align:top;				
}

.frmviajes.tab_viajes .datos_internos{
	height:61px;
}

.frmviajes.tab_viajes .caja_cliente{
	height:44px;
	margin-bottom:0px !important;
}
.frmviajes.tab_viajes .caja_cliente label{
	vertical-align:top;
}
	
.frmviajes.tab_viajes .caja_direccion_entrega label{
	position:relative;
	bottom:10px;
}

.frmviajes.tab_viajes {
	text-align:center;
}


.frmviajes.tab_viajes .pnlIzq{
	text-align:left;
	display:inline-block;
}

.frmviajes.tab_viajes .toolbarDetalles span, .tab_viajes .toolbarDetalles button {
	
	padding-top:0px !important;
}

.frmviajes.tab_viajes .toolbarDetalles .btnAgregar span{
	background-image: url(http://png.findicons.com/files/icons/573/must_have/24/add.png);
	width: 31px;
	height: 27px;
	padding-top: 3px !important;
	padding: 3px !important;
	background-repeat: no-repeat;
	background-position: 7px 5px;	
}

@-moz-document url-prefix()
{
	/*
  .tab_viajes .datos_internos label{
		vertical-align:top;				
	}
	
	.tab_viajes .datos_internos{
		height:61px;
	}
	
	.tab_viajes .caja_cliente{
		height:44px;
		margin-bottom:0px !important;
	}
	.tab_viajes .caja_cliente label{
		vertical-align:top;
	}
	*/
}

@media screen and (-webkit-min-device-pixel-ratio:0) {
    
}


</style>	
	<div class="pnlIzq">
		<div style="" class="cerrar_tab"></div>
		<?php 	
			global $_PETICION;
			
			
			if (!isset($this->datos)){		
				$this->datos=array();		
			}
			$this->datos['hora_a_entregar']=$this->datos['fecha_a_entregar'];
			
			if ( empty($this->datos['id']) ){
				$this->datos['nombreSerie']=$this->series[0]['serie'];
				$this->datos['folio']=$this->datos['folio'];
			}			
			$this->mostrar('/toolbar_edicion');	
		?>
		
		<form class="frmEdicion" style="padding-top:10px;">	
			
			<div class="inputBox" style="margin-bottom:8px;display:none;margin-left:10px;width:100%;"  >
				<label style="">Id:</label>
				<input type="text" name="id" class="txt_id" value="<?php echo $this->datos['id']; ?>" style="width:500px;" />
			</div>			
			<input type="hidden" name="nombreSerie" class="txt_nombreSerie" value="<?php echo $this->datos['nombreSerie']; ?>" style="width:500px;" />
			<input type="hidden" name="folio" class="txt_folio" value="<?php echo $this->datos['folio']; ?>" style="width:500px;" />	
			<input type="hidden" name="costo" class="txt_costo" value="<?php echo $this->datos['costo']; ?>" style="width:500px;" />										

			<fieldset>
				<legend>Datos de entrega:</legend>				
					<div class="inputBox caja_cliente" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
						<label style="">Cliente:</label>	
						<select name="fk_cliente" class="txt_fk_cliente" style="width:500px;">
							<?php
							foreach($this->clientes as $cliente){
								$selected = ($this->datos['fk_cliente'] == $cliente['id'] )? 'selected' : '';
								echo '<option '.$selected.' value="'.$cliente['id'].'">'.$cliente['razon_social'].'</option>';
							}
							?>
						</select>
					</div>					
					<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
						
						<label style="">Fecha:</label>
						<input type="text" name="fecha_a_entregar" class="txt_fecha_a_entregar" value="<?php echo $this->datos['fecha_a_entregar']; ?>" style="width:143px;" />
					</div>
					<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
						<label style="">Hora:</label>
						<input type="text" name="hora_a_entregar" class="txt_hora_a_entregar" value="<?php echo $this->datos['hora_a_entregar']; ?>" style="width:143px;" />
					</div>
					<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
						<label style="">Contenido:</label>
						<input type="text" name="contenido" class="txt_contenido" value="<?php echo $this->datos['contenido']; ?>" style="width:500px;" />
					</div>
					<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
						<label style="">Precio:</label>
						<input type="text" name="precio" class="txt_precio" value="<?php echo $this->datos['precio']; ?>" style="width:200px;" />
					</div>
					<div class="inputBox caja_direccion_entrega" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
						<label style="">Direccion de entrega:</label>
						<textarea  name="direccion_de_entrega" class="txt_direccion_de_entrega"  style="width:500px;" ><?php 
								echo htmlentities( $this->datos['direccion_de_entrega'],ENT_QUOTES | ENT_IGNORE, "UTF-8");?></textarea>
					</div>
			</fieldset>
			<fieldset class="datos_internos">
				<legend>Datos internos:</legend>
				<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
					<label style="">Chofer:</label>
					<select name="fk_chofer" class="txt_fk_chofer" style="width:135px;" >
						<?php
						foreach($this->choferes as $chofer){
							$selected = ($this->datos['fk_chofer'] == $chofer['id'] )? 'selected' : '';
							echo '<option '.$selected.' value="'.$chofer['id'].'">'.$chofer['nombre'].'</option>';
						}
						?>
					</select>
					
				</div>
				<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
					<label style="">Vehiculo:</label>	
					<select name="fk_vehiculo" class="txt_fk_chofer" style="width:100px;">
						<?php
						foreach($this->vehiculos as $vehiculo){
							$selected = ($this->datos['fk_vehiculo'] == $vehiculo['id'] )? 'selected' : '';
							echo '<option '.$selected.' value="'.$vehiculo['id'].'">'.$vehiculo['codigo'].'</option>';
						}
						?>
					</select>
				</div>
				<div class="inputBox" style="margin-bottom:8px;display:inline-block; margin-left:10px;"  >
					<label style="">Caja:</label>	
					<select name="fk_caja" class="txt_fk_caja" style="width:100px;">
						<?php
						foreach($this->cajas as $caja){
							$selected = ($this->datos['fk_caja'] == $caja['id'] )? 'selected' : '';
							echo '<option '.$selected.' value="'.$caja['id'].'">'.$caja['codigo'].'</option>';
						}
						?>
					</select>
				</div>
				
			</fieldset>			
		</form>
		<div class="consumo" style="display:none;"><h1>CONSUMO EN CONSTRUCCI&Oacute;N</h1></div>
		<div class="gastos" style="display:none;width:682px;">
			<div class="toolbarDetalles" style="padding:none; margin-bottom:5px; ">
				<button class="btnAgregar" style="padding:none;"></button>
			</div>
			<table class="grid_articulos">
				<thead><th>col0</th></thead>
				<tbody>				
				</tbody>			
			</table>
		</div>
	</div>
</div>

