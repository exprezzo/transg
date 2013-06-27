<div class="toolbarEdicion">		
	<div style="text-align:center;" class="boton btnGuardar " >
		<div class="iconWrap">		
			<div class="icon"></div>
		</div>
		<div>
			<span>Guardar</span>
		</div>		
	</div>
	
	<div style="text-align:center;" class="boton <?php echo ( $this->datos['fk_estado']==2 )? 'disabled' : '';  ?> btnCerrar">
		<div class="iconWrap">				
			<div class="icon"></div>
		</div>
		<div>
			<span style="color:black;"><?php echo ( $this->datos['fk_estado']==2 )? 'cerrado' : 'cerrar';  ?></span>
		</div>		
	</div>			
	
	<div style="text-align:center;" class="boton btnDelete">
		<div class="iconWrap">		
			<div class="icon"></div>
		</div>
		<div>
			<span >Borrar</span>
		</div>		
	</div>				
	<div style="display:inline-block; ">-</div>
	<div style="text-align:center;" class="boton btnGeneral">
		<div class="iconWrap">		
			<div class="icon" style="background-size:16px; background-image:url(http://png.findicons.com/files/icons/1581/silk/16/application_form.png)"></div>
		</div>
		<div>
			<span style="color:black;">General</span>
		</div>		
	</div>
	
	<div style="text-align:center;" class="boton btnDetalles">
		<div class="iconWrap">
			<div class="icon" style="background-size:16px; background-image:url(http://png.findicons.com/files/icons/1581/silk/16/money_dollar.png)"></div>
		</div>
		<div>
			<span style="color:black;" >Gastos</span>
		</div>
	</div>
	<div style="text-align:center;" class="boton btnDepositos">
		<div class="iconWrap">		
			<div class="icon" style="background-size:16px; background-image:url(http://png.findicons.com/files/icons/1156/fugue/16/money_coin.png)"></div>
		</div>
		<div>
			<span style="color:black;" >Dep&oacute;sitos</span>
		</div>
	</div>
	
	<div style="text-align:center;" class="boton btnConsumo">
		<div class="iconWrap">		
			<div class="icon" style="background-size:16px; background-image:url(http://png-1.findicons.com/files/icons/2448/wpzoom_developer/48/gas.png)"></div>
		</div>
		<div>
			<span style="color:black;">Consumo</span>
		</div>		
	</div>	
		<table style="display:inline-block; position:absolute; margin-left:13px;">
			<tr>
				<td>Serie</td>
				<td>Folio</td>					
				<td style="text-align:right; position:relative; ">Costo</td>
			</tr>
			<tr>
				<td>
				<select name="fk_serie" style="font-size:30px;">
					<?php
						$elMes=date('m');
						$idx=1;
						foreach($this->series as $serie){
							
							if ( empty($this->datos['id']) && $idx==$elMes ){
								$selected="selected";
							}else if ( $this->datos['fk_serie'] == $serie['id'] ){
								$selected="selected";
							}else{
								$selected="";
							}							
							echo '<option '.$selected.' value="'.$serie['id'].'">'.$serie['serie'].'</option>';
							$idx++;
						}
					?>
				</select>				
				</td>
				<td style="font-size:30px;" class="lblFolio"><?php echo $this->datos['folio']; ?></td>					
				
			</tr>
		</table>
</div>