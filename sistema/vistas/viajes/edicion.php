
<script src="<?php echo $MOD_WEB_PATH; ?>js/catalogos/<?php echo $_PETICION->controlador; ?>/edicion.js"></script>
<script src="<?php echo $MOD_WEB_PATH; ?>js/catalogos/<?php echo $_PETICION->controlador; ?>/detalles_viaje.js"></script>
<script src="<?php echo $MOD_WEB_PATH; ?>js/catalogos/<?php echo $_PETICION->controlador; ?>/consumo.js"></script>
<script src="<?php echo $MOD_WEB_PATH; ?>js/catalogos/<?php echo $_PETICION->controlador; ?>/efectivo_viaje.js"></script>

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
			fk_destinatario:<?php echo empty( $this->datos['fk_destinatario'] )? 0 : $this->datos['fk_destinatario']; ?>,
			fk_remitente:<?php echo empty( $this->datos['fk_remitente'] )? 0 : $this->datos['fk_remitente']; ?>
			
		};				
		var tabId='#'+config.tab.id;
		 $(tabId+' [name="precio"]').wijinputnumber({type:'currency', decimalPlaces: 2, increment: 1, showSpinner: true});
		 
		 var editor=new Edicionviajes();
		 editor.init(config);		
		 
		 
		 $('#'+config.tab.id+' [name="fk_caja"]').wijcombobox();
		 // $('#'+config.tab.id+' [name="fk_vehiculo"]').wijcombobox();
		 // $('#'+config.tab.id+' [name="fk_cliente"]').wijcombobox();
		 
		 
		 $(tabId+' [name="fecha_carga"]').wijinputdate({ dateFormat: 'dd/MM/yyyy',showTrigger:true,
			dateChanged: function(e, arg){
				editor.editado=true;
			}
		 });
		 $(tabId+' [name="hora_carga"]').wijinputdate({ dateFormat: 'HH:mm',showTrigger:false,
			dateChanged: function(e, arg){
				editor.editado=true;
			} 
		});
		 
		 $(tabId+' [name="fecha_a_entregar"]').wijinputdate({ dateFormat: 'dd/MM/yyyy',showTrigger:true,
			dateChanged: function(e, arg){
				editor.editado=true;
			}
		 });
		 $(tabId+' [name="hora_a_entregar"]').wijinputdate({ dateFormat: 'HH:mm',showTrigger:false,
			dateChanged: function(e, arg){
				editor.editado=true;
			} 
		});
		
		 
		 
		 $(tabId+' .cerrar_tab').bind('click', function(){
			TabManager.cerrarTab( config.tab.id );
		 });
		 
		 
		 var paramsDetalle={
			tabId:tabId,
			padre:editor,
			fk_padre:$('#'+config.tab.id + ' [name="'+config.pk+'"]').val(),
			articulos: <?php echo json_encode($this->gastos); ?>
		 };
		 var detalle=new DetallesViaje();
		 detalle.init(paramsDetalle);
		 
		  var paramsDepositos={
			tabId:tabId,
			padre:editor,
			fk_padre:$('#'+config.tab.id + ' [name="'+config.pk+'"]').val(),
			depositos: <?php echo json_encode($this->depositos); ?>
		 };
		 var detalleDepositos=new EfectivoViaje();
		 detalleDepositos.init(paramsDepositos);
		 
		 
		 consumo=new PantallaConsumo();
		 
		 var paramsConsumo={
			tabId: tabId
		 }
		 consumo.init(paramsConsumo);
	});	
</script>
<style>
.frmviajes.tab_viajes fieldset{
	width:744px;
}

.frmviajes.tab_viajes [role="combobox"]{
	vertical-align:top;
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

.frmviajes.tab_viajes .toolbarDetalles .btnAgregar span, .frmviajes.tab_viajes .toolbarDetalles .btnAgregarDeposito span{
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

button[name="estado_viaje"] span{
	background-image: url(http://png.findicons.com/files/icons/1681/siena/24/lock_green.png);
	background-repeat: no-repeat;background-position-y: 7px;padding-left: 28px !important;
}

.toolbarEdicion .boton.btnCerrar .icon{
	background-image: url(http://png.findicons.com/files/icons/1681/siena/24/lock_green.png);
}

.toolbarEdicion .boton.btnCerrar.disabled .icon{
	background-image: url(http://png.findicons.com/files/icons/1681/siena/24/lock_red.png);
}

h2.lblGasto{display: inline-block;float: right;padding: 0;margin: 0;}
</style>	
	<div class="pnlIzq">
		<div style="" class="cerrar_tab"></div>
		<?php 	
			global $_PETICION;
			
			
			if (!isset($this->datos)){		
				$this->datos=array();		
			}
			$this->datos['hora_a_entregar']=$this->datos['fecha_a_entregar'];
			$this->datos['hora_carga']=$this->datos['fecha_carga'];
			
			if ( empty($this->datos['id']) ){
				// $this->datos['nombreSerie']=$this->series[0]['serie'];
				// $this->datos['folio']=$this->datos['folio'];
			}			
			$this->mostrar('/toolbar_edicion');	
		?>
		
		<form class="frmEdicion frmGeneral" style="padding-top:10px; width:754px;">	
			
			<div class="inputBox" style="margin-bottom:8px;display:none;margin-left:10px;width:100%;"  >
				<label style="">Id:</label>
				<input type="text" name="id" class="txt_id" value="<?php echo $this->datos['id']; ?>" style="width:500px;" />
			</div>
			
			<input type="hidden" name="folio" class="txt_folio" value="<?php echo $this->datos['folio']; ?>" style="width:500px;" />	
			<input type="hidden" name="costo" class="txt_costo" value="<?php echo $this->datos['costo']; ?>" style="width:500px;" />										
			<input type="hidden" name="fk_estado" class="fk_estado" value="<?php echo $this->datos['fk_estado']; ?>" style="width:500px;" />										
			<input type="hidden" name="efectivo"  value="<?php echo $this->datos['efectivo']; ?>" />
			<input type="hidden" name="comision"  value="<?php echo $this->datos['comision']; ?>"  />
			
			<fieldset>
				<legend>Origen</legend>				
					<div class="inputBox caja_remitente" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
						<label style="width:100px; ">Remitente:</label>	
						<select name="fk_remitente" class="" style="width:607px;">
							<?php
							foreach($this->remitentes as $cliente){
								$selected = ($this->datos['fk_remitente'] == $cliente['id'] )? 'selected' : '';
								echo '<option '.$selected.' value="'.$cliente['id'].'">'.$cliente['razon_social'].'</option>';
							}
							?>
						</select>
					</div>					
					<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >						
						<label style="">Origen:</label>
						<input type="text" name="origen" class="" value="<?php echo $this->datos['origen']; ?>" style="width:143px;" />
					</div>
					<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:0px;"  >						
						<label style="width:80px; ">Fecha:</label>
						<input type="text" name="fecha_carga" class="" value="<?php echo $this->datos['fecha_carga']; ?>" style="width:143px;" />
					</div>
					<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:0px;"  >
						<label style="width:50px; ">Hora:</label>
						<input type="text" name="hora_carga" class="" value="<?php echo $this->datos['hora_carga']; ?>" style="width:143px;" />
					</div>
					<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;"  >
						<label style="">Dir. Carga:</label>
						<input type="text" name="direccion_carga" class="" value="<?php echo $this->datos['direccion_carga']; ?>" style="width:607px;" />
					</div>
					<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
						<label style="">Contenido:</label>
						<input type="text" name="contenido" class="txt_contenido" value="<?php echo $this->datos['contenido']; ?>" style="width:500px;" />
					</div>
			</fieldset>
			
			<fieldset>
				<legend>Destino</legend>				
					<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
						<label style="">Destinatario:</label>	
						<select name="fk_destinatario" class="" style="width:607px;">
							<?php
							foreach($this->destinatarios as $cliente){
								$selected = ($this->datos['fk_destinatario'] == $cliente['id'] )? 'selected' : '';
								echo '<option '.$selected.' value="'.$cliente['id'].'">'.$cliente['razon_social'].'</option>';
							}
							?>
						</select>
					</div>					
					<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >						
						<label style="">Destino:</label>
						<input type="text" name="destino" class="" value="<?php echo $this->datos['destino']; ?>" style="width:143px;" />
					</div>
					<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:0px;"  >						
						<label style="width:98px; ">F. Entrega:</label>
						<input type="text" name="fecha_a_entregar" class="txt_fecha_a_entregar" value="<?php echo $this->datos['fecha_a_entregar']; ?>" style="width:143px;" />
					</div>
					<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:0px;"  >
						<label style="width:50px; ">Hora:</label>
						<input type="text" name="hora_a_entregar" class="txt_hora_a_entregar" value="<?php echo $this->datos['hora_a_entregar']; ?>" style="width:143px;" />
					</div>
					<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;"  >
						<label style="">Direcci&oacute;n:</label>
						<input type="text" name="direccion_de_entrega" class="" value="<?php echo $this->datos['direccion_de_entrega']; ?>" style="width:607px;" />
					</div>					
			</fieldset>
			
			<fieldset>
					<legend>Pago</legend>
					<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
						<label style="width: 150px; ">Precio:</label>
						<input type="text" name="precio" class="txt_precio" value="<?php echo $this->datos['precio']; ?>" style="width:200px;" />
					</div>
					<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
						<label style="width: 150px; ">Cond. de pago:</label>
						<input type="text" name="condiciones_de_pago" class="" value="<?php echo $this->datos['condiciones_de_pago']; ?>" style="width:557px;" />
						
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
		<div class="consumo" style="display:none;width:754px;">			
			<?php $this->mostrar('/consumo') ; ?>
		
		</div>
		<div class="gastos" style="display:none;width:754px;">
			<div class="toolbarDetalles" style="padding:none; margin-bottom:5px; ">
				<button class="btnAgregar" style="padding:none;"></button><h2 style="display: inline-block;padding: 0 0 0 10px;margin: 0;">GASTOS</h2><h2 class="lblGasto"></h2>
			</div>
			<table class="grid_articulos">
				<thead><th>col0</th></thead>
				<tbody>				
				</tbody>			
			</table>
		</div>
		<div class="depositos" style="display:none;width:754px;">
			<div class="toolbarDetalles" style="padding:none; margin-bottom:5px; ">
				<button class="btnAgregarDeposito" style="padding:none;"></button><h2 style="display: inline-block;padding: 0 0 0 10px;margin: 0;">DEPOSITOS</h2>
			</div>
			<div>
				<table>
					<tr>
						<td style="width:127px;">Efectivo</td><td class="lblDepositos" style="text-align:right;">0</td>
					</tr>
					<tr>
						<td>Gastos</td><td class="lblGasto" style="text-align:right;">0</td>
					</tr>
					<tr>
						<td>Diferencia</td><td class="lblDiferencia" style="text-align:right;">0</td>
					</tr>
					<tr>
						<td>Comision</td><td class="lblComision" style="text-align:right;">$<?php echo number_format($this->datos['comision'],2,'.',',') ?></td>
					</tr>
					<tr>
						<?php 
						$diferencia = $this->datos['efectivo'] - $this->datos['costo'];
						$pagar = $this->datos['comision'] - $diferencia; 						
						?>
						<td>Por Pagar</td><td class="lblPagar" style="text-align:right;">$<?php echo number_format($pagar,2,'.',',') ?></td>						
					</tr>
				</table>
			</div>
			<table class="grid_depositos">
				<thead><th>col0</th></thead>
				<tbody>				
				</tbody>			
			</table>
		</div>
	</div>
</div>

