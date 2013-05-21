
<script src="<?php echo $MOD_WEB_PATH; ?>js/catalogos/<?php echo $_PETICION->controlador; ?>/edicion.js"></script>
<style>
	.frmCliente label {
		width: 131px;
		display: inline-block;
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
				nombre:'cliente'
			},			
			pk:"id"
			
		};				
		 var editor=new Edicionclientes();
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
		
		<form class="frmEdicion frmCliente" style="padding-top:10px;">				
			<div class="inputBox" style="margin-bottom:8px;display:none;margin-left:10px;width:100%;"  >
	<label style="">Id:</label>
	<input type="text" name="id" class="txt_id" value="<?php echo $this->datos['id']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Razon Social:</label>
	<input type="text" name="razon_social" class="txt_razon_social" value="<?php echo $this->datos['razon_social']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Rfc:</label>
	<input type="text" name="rfc" class="txt_rfc" value="<?php echo $this->datos['rfc']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Direccion:</label>
	<input type="text" name="direccion" class="txt_direccion" value="<?php echo $this->datos['direccion']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Telefonos:</label>
	<input type="text" name="telefonos" class="txt_telefonos" value="<?php echo $this->datos['telefonos']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Www:</label>
	<input type="text" name="www" class="txt_www" value="<?php echo $this->datos['www']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Contacto:</label>
	<input type="text" name="contacto" class="txt_contacto" value="<?php echo $this->datos['contacto']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">C. Bancaria:</label>
	<input type="text" name="cuenta_bancaria" class="txt_cuenta_bancaria" value="<?php echo $this->datos['cuenta_bancaria']; ?>" style="width:500px;" />
</div>

		</form>
	</div>
</div>
