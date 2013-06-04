<style>
	.frmConsumo label{ display:block;  width:auto; }
</style>

		
		<form class="frmEdicion frmConsumo" style="padding-top:10px;">				
			<fieldset>
				<div class="inputBox" style="margin-bottom:8px;display:none;margin-left:10px;width:100%;"  >
					<label style="">Id:</label>
					<input type="text" name="id" class="txt_id" value="<?php echo $this->consumo['id']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox" style="margin-bottom:8px;display:none;margin-left:10px;width:100%;"  >
					<label style="">Fk_viaje:</label>
					<input type="text" name="fk_viaje" class="txt_fk_viaje" value="<?php echo $this->consumo['fk_viaje']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
					<label style="">Distancia:</label>
					<input type="text" name="distancia" class="txt_distancia" value="<?php echo $this->consumo['distancia']; ?>" style="width:115px;" />
				</div>
				<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
					<label style="">Rendimiento:</label>
					<input type="text" name="rendimiento" class="txt_rendimiento" value="<?php echo $this->consumo['rendimiento']; ?>" style="width:115px;" />
				</div>
				<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
					<label style="width:auto;">Consumo en Litros</label>
					<input type="text" name="consumo_diesel_lt" class="txt_consumo_diesel_lt" value="<?php echo $this->consumo['consumo_diesel_lt']; ?>" style="width:166px;" />
				</div>
				<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
					<label style="">Precio x lt</label>
					<input type="text" name="precio_por_litro" class="txt_precio_por_litro" value="<?php echo $this->consumo['precio_por_litro']; ?>" style="width:100px;" />
				</div>
				<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
					<label style="width:auto;">Consumo $</label>
					<input type="text" name="consumo_en_pesos" class="txt_consumo_en_pesos" value="<?php echo $this->consumo['consumo_en_pesos']; ?>" style="width:100px;" />
				</div>
			</fieldset>
			<fieldset>
			
			<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
				<label style="">Kilometraje inicial</label>
				<input type="text" name="kilometraje_inicial" class="txt_kilometraje_inicial" value="<?php echo $this->consumo['kilometraje_inicial']; ?>" style="width:150px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
				<label style="">Kilometraje final</label>
				<input type="text" name="kilometraje_final" class="txt_kilometraje_final" value="<?php echo $this->consumo['kilometraje_final']; ?>" style="width:150px;" />
			</div>
			<br>
			<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
				<label style="">Kilometraje recorrido</label>
				<input type="text" name="kilometraje_recorrido" class="txt_kilometraje_recorrido" value="<?php echo $this->consumo['kilometraje_recorrido']; ?>" style="width:150px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
				<label style="">diesel calculado (lt)</label>
				<input type="text" name="consumo_diesel_calculado_lt" class="txt_consumo_diesel_calculado_lt" value="<?php echo $this->consumo['consumo_diesel_calculado_lt']; ?>" style="width:150px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
				<label style="">diesel calculado ($)</label>
				<input type="text" name="consumo_diesel_calculado_pesos" class="txt_consumo_diesel_calculado_pesos" value="<?php echo $this->consumo['consumo_diesel_calculado_pesos']; ?>" style="width:150px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
				<label style="">Consumo_diesel_real_pesos:</label>
				<input type="text" name="consumo_diesel_real_pesos" class="txt_consumo_diesel_real_pesos" value="<?php echo $this->consumo['consumo_diesel_real_pesos']; ?>" style="width:500px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
				<label style="">Diferencia:</label>
				<input type="text" name="diferencia" class="txt_diferencia" value="<?php echo $this->consumo['diferencia']; ?>" style="width:500px;" />
			</div>
		</fieldset>

		</form>
	