<style>
	.frmConsumo label{ display:block;  width:auto; }
	.frmConsumo .inputBox .calculo{
		color:blue;font-size: 32px; text-align:right;
	}
</style>
	<?php 
		$this->consumo['diferencia'] = empty( $this->consumo['diferencia'] )? '0.00' : $this->consumo['diferencia'];
		$this->consumo['kilometraje_recorrido'] = empty( $this->consumo['kilometraje_recorrido'] )? '0.00' : $this->consumo['kilometraje_recorrido'];
		$this->consumo['consumo_diesel_lt'] = empty( $this->consumo['consumo_diesel_lt'] )? '0.00' : $this->consumo['consumo_diesel_lt'];
		$this->consumo['consumo_en_pesos'] = empty( $this->consumo['consumo_en_pesos'] )? '0.00' : $this->consumo['consumo_en_pesos'];
		$this->consumo['consumo_diesel_calculado_lt'] = empty( $this->consumo['consumo_diesel_calculado_lt'] )? '0.00' : $this->consumo['consumo_diesel_calculado_lt'];				
		$this->consumo['consumo_diesel_calculado_pesos'] = empty( $this->consumo['consumo_diesel_calculado_pesos'] )? '0.00' : $this->consumo['consumo_diesel_calculado_pesos'];
		
		
		   
	?>
		
		<form class="frmEdicion frmConsumo" style="padding-top:10px;">				
			<fieldset>
				<legend>Calculado</legend>
				<div class="inputBox" style="margin-bottom:8px;display:none;margin-left:10px;width:100%;"  >
					<label style="">Id:</label>
					<input type="text" name="id" class="txt_id" value="<?php echo $this->consumo['id']; ?>" style="width:500px;" />
				</div>
				<div class="inputBox" style="margin-bottom:8px;display:none;margin-left:10px;width:100%;"  >
					<label style="">Fk_viaje:</label>
					<input type="text" name="fk_viaje" class="txt_fk_viaje" value="<?php echo $this->consumo['fk_viaje']; ?>" style="width:500px;" />
				</div>				
				<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
					<label style="">Precio x lt</label>
					<input type="text" name="precio_por_litro" class="txt_precio_por_litro" value="<?php echo $this->consumo['precio_por_litro']; ?>" style="width:100px;" />
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
					<label class="calculo" style=""><?php echo $this->consumo['consumo_diesel_lt']; ?></label>
					<input type="hidden" name="consumo_diesel_lt" class="txt_consumo_diesel_lt" value="<?php echo $this->consumo['consumo_diesel_lt']; ?>" style="width:166px;" />
				</div>
				
				<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
					<label style="width:auto;">Consumo $</label>
					<label class="calculo"><?php echo $this->consumo['consumo_en_pesos']; ?></label>
					<input type="hidden" name="consumo_en_pesos" class="txt_consumo_en_pesos" value="<?php echo $this->consumo['consumo_en_pesos']; ?>" style="width:100px;" />
				</div>
			</fieldset>
			<fieldset>
				<legend>Medido</legend>
				<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
					<label style="">Kilometraje inicial</label>
					<input type="text" name="kilometraje_inicial" class="txt_kilometraje_inicial" value="<?php echo $this->consumo['kilometraje_inicial']; ?>" style="width:150px;" />
				</div>
				<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
					<label style="">Kilometraje final</label>
					<input type="text" name="kilometraje_final" class="txt_kilometraje_final" value="<?php echo $this->consumo['kilometraje_final']; ?>" style="width:150px;" />
				</div>
				
				<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
					<label style="">Kilometraje recorrido</label>
					<label class="calculo"><?php echo $this->consumo['kilometraje_recorrido']; ?></label>
					<input type="hidden" name="kilometraje_recorrido" class="txt_kilometraje_recorrido" value="<?php echo $this->consumo['kilometraje_recorrido']; ?>" style="width:150px;" />
				</div>
				<br>
				<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
					<label style="">diesel calculado (lt)</label>
					<label class="calculo"><?php echo $this->consumo['consumo_diesel_calculado_lt']; ?></label>
					<input type="hidden" name="consumo_diesel_calculado_lt" class="txt_consumo_diesel_calculado_lt" value="<?php echo $this->consumo['consumo_diesel_calculado_lt']; ?>" style="width:150px;" />
				</div>
				<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
					<label style="">diesel calculado ($)</label>
					<label class="calculo"><?php echo $this->consumo['consumo_diesel_calculado_pesos']; ?></label>
					<input type="hidden" name="consumo_diesel_calculado_pesos" class="txt_consumo_diesel_calculado_pesos" value="<?php echo $this->consumo['consumo_diesel_calculado_pesos']; ?>" style="width:150px;" />
				</div>
			</fieldset>
		<fieldset>
			<legend>Real</legend>
			<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
				<label style="">Consumo real ($)</label>
				<input type="text" name="consumo_diesel_real_pesos" class="txt_consumo_diesel_real_pesos" value="<?php echo $this->consumo['consumo_diesel_real_pesos']; ?>" style="width:150px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
				<label style="">Diferencia:</label>
				<label class="calculo"><?php echo $this->consumo['diferencia']; ?></label>
				<input type="hidden" name="diferencia" class="" value="<?php echo $this->consumo['diferencia']; ?>" style="width:150px;" />
			</div>
		</fieldset>
		
		<fieldset>
			<legend>Caja</legend>
			<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
				<label style="">Horas Trabajo I</label>
				<input type="text" name="consumo_diesel_real_pesos" class="txt_consumo_diesel_real_pesos" value="<?php echo $this->consumo['consumo_diesel_real_pesos']; ?>" style="width:150px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
				<label style="">Horas Trabajo F</label>
				
				<input type="text" name="diferencia" class="" value="<?php echo $this->consumo['diferencia']; ?>" style="width:150px;" />
			</div>
		</fieldset>

		</form>
	