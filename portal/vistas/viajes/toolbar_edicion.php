<div class="toolbarEdicion">		
	<div style="text-align:center;" class="boton btnGuardar " >
		<div class="iconWrap">		
			<div class="icon"></div>
		</div>
		<div>
			<span>Guardar</span>
		</div>		
	</div>
	
	<div style="text-align:center;" class="boton btnDelete">
		<div class="iconWrap">		
			<div class="icon"></div>
		</div>
		<div>
			<span>Borrar</span>
		</div>		
	</div>				
	
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
				<td style="text-align:right; left:32px; position:relative; ">Costo</td>
			</tr>
			<tr>
				<td style="font-size:40px;"><?php echo $this->datos['nombreSerie']; ?></td>
				<td style="font-size:40px;"><?php echo $this->datos['folio']; ?></td>					
				<td style="font-size:40px; left:32px; position:relative; " class="lblGasto">$<?php echo $this->datos['costo']; ?></td>					
			</tr>
		</table>
	
</div>