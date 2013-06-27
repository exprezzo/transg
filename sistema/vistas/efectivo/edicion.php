
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
				nombre:'Efectivo',
				modelo:'Efectivo'
			},			
			pk:"id",
			viajes:<?php echo json_encode( $this->viajes ); ?>,
			fk_viaje:'<?php echo  empty( $this->datos['fk_viaje'] )? 0 : $this->datos['fk_viaje']; ?>'
			
		};				
		 var editor=new Edicionefectivo();
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
		<div style="display:inline-block;">
		<?php 	
			global $_PETICION;
			$this->mostrar('/backend/componentes/toolbar');	
			if (!isset($this->datos)){		
				$this->datos=array();		
			}
		?>
		</div><h2 style="display:inline-block; padding:0; margin:0;">Dep&oacute;sitos</h2>
		<form class="frmEdicion" style="padding-top:10px;">				
			<input type="hidden" name="id" class="txt_id" value="<?php echo $this->datos['id']; ?>" style="width:500px;" />
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
				<label style="">Importe:</label>
				<input type="text" name="importe" class="txt_importe" value="<?php echo $this->datos['importe']; ?>" style="width:500px;" />
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
				<label style="">Concepto:</label>
				<input type="text" name="concepto" class="txt_concepto" value="<?php echo $this->datos['concepto']; ?>" style="width:500px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
				<label style="">Forma dep:</label>
				<input type="text" name="forma_deposito" class="txt_forma_deposito" value="<?php echo $this->datos['forma_deposito']; ?>" style="width:500px;" />
			</div>
			
		</form>
	</div>
</div>
