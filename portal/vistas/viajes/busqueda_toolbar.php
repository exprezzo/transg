<script>
	$().ready(function(){
		
	});
</script>
<style type="text/css">		
	.crud_tb li{
		display:inline-block !important;
	}
	.crud_tb span{
		text-align:center !important;
	}	
	.tbCompra .btnFiltros{
		background-image:url(http://png.findicons.com/files/icons/1684/ravenna/48/filter_list.png) !important;
	}
	
	.cmbAlmacen , .cmbSeries div[role="combobox"], .cmbProveedor div[role="combobox"]{
		top:8px;
	}
	
	.tab_viajes .filtros .cmbSeries, .tab_viajes .filtros .cmbSeries div[role="combobox"]{
		vertical-align:bottom;
	}
	
	.tab_viajes .filtros .cmbCliente, .tab_viajes .filtros .cmbCliente div[role="combobox"]{
		vertical-align:bottom;
	}
</style>

<?php 	
	$tabId=$_REQUEST['tabId']; 	
	$domId = 'tb_'.$_PETICION->controlador.'_'.$tabId;	
?>

<div class="ribbon lista_toolbar tbCompra">
	<ul>
		 <li><a href="#<?php echo $domId; ?>">Basic Toolbar</a></li>
	</ul>
	<div id="<?php echo $domId; ?>" class="">
		<div style="vertical-align:top;"> 
			<div  style="display:inline-block;">
				<div title="Acciones" class="wijmo-wijribbon-dropdownbutton">					
					<button title="Nuevo" class="" name="nuevo">
							<span class="btnNuevo"></span>
							<span>Nuevo</span>
					</button>				
				
					<button title="Editar" class="" name="editar">
						<span class="btnEditar"></span>
						<span>Editar</span>
					</button>
				
					<button title="Eliminar" class="" name="eliminar">
						<span class="btnEliminar"></span>
						<span>Eliminar</span>
					</button>
				
					<button title="Imprimir" class="" name="imprimir">
						<div class="btnImprimir"></div>
						<span>Imprimir</span>
					</button>									
				</div>							
			</div>
			<div style="display:inline-block;">
				<button title="Filtros" class="" name="filtros">
						<div class="btnFiltros"></div>
						<span>Filtros</span>
				</button>
			</div>
			
			<button title="Refresh" class="" name="refresh" style="position:absolute;;right:0;">
				<span class="btnRefresh"></span>
				<span>Actualizar</span>
			</button>	
		</div>
	</div>
</div>
<?php
	$elMes=date('m');
	$elAnio=date('Y');
	$ultimoDia=date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
?>
<div class="filtros" style="display:none;">
	<div>
		<div class="inputBox cmbSeries" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
			<label style="">Serie:</label>
			<select name='idserie'>					
				<?php 
					$seleccionado=false;
					foreach($this->series as $serie){
						// if ($prov['idproveedor'] == $this->datos['idproveedor'] ){
							// $selected='selected';
							// $seleccionado=true;
						// } 
						echo '<option '.$selected.' value='.$serie['id'].'>'.$serie['serie'].'</option>';
						$selected='';
					}
					if ( !$seleccionado ){
						echo '<option value="0" selected>Todas</option>';
					}					
				?>
			</select>				
		</div>
		<div class="inputBox" style="display:inline-block;margin-left:10px;"  >
			<label style="">Folio Inicial:</label>
			<input type="text" name="folioi" class="txt_folioi" value="" style="width:50px;" />
		</div>
		<div class="inputBox" style="display:inline-block;margin-left:10px;"  >
			<label style="">Folio Final:</label>
			<input type="text" name="foliof" class="txt_foliof" value="" style="width:50px;" />
		</div>		
	</div>
	<div>
		<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
			<label style="">Fecha Inicial:</label>
			<input type="text" name="fechai" class="txt_fecha" value="<?php echo '1/'.$elMes.'/'.$elAnio; ?>" style="width:150px;" />
		</div>
		<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
			<label style="">Fecha Final:</label>
			<input type="text" name="fechaf" class="txt_fechaf" value="<?php echo $ultimoDia.'/'.$elMes.'/'.$elAnio; ?>" style="width:150px;" />
		</div>
		<div class="inputBox cmbCliente" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
			<label style="">Cliente:</label>
			<select name='idcliente' style="vertical-align:bottom;">					
				<?php 
					$seleccionado=false;
					foreach($this->clientes as $cli){
						// if ($prov['idproveedor'] == $this->datos['idproveedor'] ){
							// $selected='selected';
							// $seleccionado=true;
						// } 
						echo '<option '.$selected.' value='.$cli['id'].'>'.$cli['razon_social'].'</option>';
						$selected='';
					}
					if ( !$seleccionado ){
						echo '<option value="0" selected>Todos</option>';
					}
					
				?>
			</select>				
		</div>
	</div>
	
	
	
</div>
