<style>
	.frmConsumo label{ display:block;  width:auto; text-align:right;}
	.frmConsumo input{ text-align:right; }
	.frmConsumo .inputBox .calculo{
		color:blue;font-size: 32px; text-align:right;
	}
</style>
	<?php 
		foreach($this->consumo as $key=> $value ){
			
			if ( empty($value) && $key!='id' ){
				
				$this->consumo[$key] = '0.00';
			}
		}
		// $this->consumo['diferencia_calculado'] = empty( $this->consumo['diferencia_calculado'] )? '0.00' : $this->consumo['diferencia_calculado'];
		// $this->consumo['diferencia_medido'] = empty( $this->consumo['diferencia_medido'] )? '0.00' : $this->consumo['diferencia_medido'];
		// $this->consumo['kilometraje_recorrido'] = empty( $this->consumo['kilometraje_recorrido'] )? '0.00' : $this->consumo['kilometraje_recorrido'];
		// $this->consumo['consumo_diesel_lt'] = empty( $this->consumo['consumo_diesel_lt'] )? '0.00' : $this->consumo['consumo_diesel_lt'];
		// $this->consumo['consumo_en_pesos'] = empty( $this->consumo['consumo_en_pesos'] )? '0.00' : $this->consumo['consumo_en_pesos'];
		// $this->consumo['consumo_diesel_calculado_lt'] = empty( $this->consumo['consumo_diesel_calculado_lt'] )? '0.00' : $this->consumo['consumo_diesel_calculado_lt'];				
		// $this->consumo['consumo_diesel_calculado_pesos'] = empty( $this->consumo['consumo_diesel_calculado_pesos'] )? '0.00' : $this->consumo['consumo_diesel_calculado_pesos'];
		
		// $this->consumo['hora_trabajo_i'] = empty( $this->consumo['hora_trabajo_i'] )? '0.00' : $this->consumo['hora_trabajo_i'];
		// $this->consumo['hora_trabajo_f'] = empty( $this->consumo['hora_trabajo_f'] )? '0.00' : $this->consumo['hora_trabajo_f'];
		// $this->consumo['horas_trabajo'] = empty( $this->consumo['horas_trabajo'] )? '0.00' : $this->consumo['horas_trabajo'];
		// $this->consumo['horas_esperadas'] = empty( $this->consumo['horas_esperadas'] )? '0.00' : $this->consumo['horas_esperadas'];
		// $this->consumo['horas_diferencia'] = empty( $this->consumo['horas_diferencia'] )? '0.00' : $this->consumo['horas_diferencia'];
		
		   
	?>
		
		<form class="frmEdicion frmConsumo" style="padding-top:10px;">				
			<fieldset>
				<legend>Consumo Calculado</legend>
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
					<label style="">Rendimiento</label>
					<input type="text" name="rendimiento" class="txt_rendimiento" value="<?php echo $this->consumo['rendimiento']; ?>" style="width:115px;" />
				</div>
				<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
					<label style="width:auto;">Consumo en Litros</label>
					<label class="calculo consumo_diesel_lt" style=""><?php echo number_format($this->consumo['consumo_diesel_lt'],2,'.',','); ?></label>
					<input type="hidden" name="consumo_diesel_lt" class="txt_consumo_diesel_lt" value="<?php echo $this->consumo['consumo_diesel_lt']; ?>" style="width:166px;" />
				</div>
				
				<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
					<label style="width:auto;">Consumo $</label>
					<label class="calculo consumo_en_pesos"><?php echo number_format($this->consumo['consumo_en_pesos'],2,'.',','); ?></label>
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
					<label style="">diesel calculado (lt)</label>
					<label class="calculo consumo_diesel_calculado_lt"><?php echo number_format($this->consumo['consumo_diesel_calculado_lt'],2,'.',','); ?></label>
					<input type="hidden" name="consumo_diesel_calculado_lt" class="txt_consumo_diesel_calculado_lt" value="<?php echo $this->consumo['consumo_diesel_calculado_lt']; ?>" style="width:150px;" />
				</div>
				<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
					<label style="">diesel calculado ($)</label>
					<label class="calculo consumo_diesel_calculado_pesos"><?php echo number_format($this->consumo['consumo_diesel_calculado_pesos'],2,'.',','); ?></label>
					<input type="hidden" name="consumo_diesel_calculado_pesos" class="txt_consumo_diesel_calculado_pesos" value="<?php echo $this->consumo['consumo_diesel_calculado_pesos']; ?>" style="width:150px;" />
				</div>
				
				<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
					<label style="">Kilometraje recorrido</label>
					<label class="calculo kilometraje_recorrido"><?php echo number_format($this->consumo['kilometraje_recorrido'],0,'.',','); ?></label>
					<input type="hidden" name="kilometraje_recorrido" class="txt_kilometraje_recorrido" value="<?php echo $this->consumo['kilometraje_recorrido']; ?>" style="width:150px;" />
				</div>
			</fieldset>
		<fieldset>
			<legend>Real</legend>
			<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
				<label style="">Consumo real ($)</label>
				<input type="text" name="consumo_diesel_real_pesos" class="txt_consumo_diesel_real_pesos" value="<?php echo $this->consumo['consumo_diesel_real_pesos']; ?>" style="width:150px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
				<label style="">Real Vs Calculado:</label>
				<label class="calculo diferencia_calculado"><?php echo number_format($this->consumo['diferencia_calculado'],2,'.',','); ?></label>
				<input type="hidden" name="diferencia_calculado" class="" value="<?php echo $this->consumo['diferencia_calculado']; ?>" style="width:150px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
				<label style="">Real Vs Medido:</label>
				<label class="calculo diferencia_medido"><?php echo number_format($this->consumo['diferencia_medido'],2,'.',','); ?></label>
				<input type="hidden" name="diferencia_medido" class="" value="<?php echo $this->consumo['diferencia_medido']; ?>" style="width:150px;" />
			</div>
		</fieldset>
		
		<fieldset>
			<legend>Caja</legend>
			<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
				<label style="">Hora Trabajo I</label>
				<input type="text" name="hora_trabajo_i" class="txt_consumo_diesel_real_pesos" value="<?php echo $this->consumo['hora_trabajo_i']; ?>" style="width:150px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
				<label style="">Hora Trabajo F</label>				
				<input type="text" name="hora_trabajo_f" class="" value="<?php echo $this->consumo['hora_trabajo_f']; ?>" style="width:150px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
				<label style="">Horas Esperadas</label>				
				<input type="text" name="horas_esperadas" class="" value="<?php echo $this->consumo['horas_esperadas']; ?>" style="width:150px;" />
			</div>
			<br>
			<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
				<label style="">Horas Trabajo</label>				
				<label class="calculo horas_trabajo"><?php echo $this->consumo['horas_trabajo']; ?></label>								
				<input type="hidden" name="horas_trabajo" class="" value="<?php echo $this->consumo['horas_trabajo']; ?>" style="width:150px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:inline-block;margin-left:10px;"  >
				<label style="">Diferencia</label>				
				<label class="calculo horas_diferencia"><?php echo $this->consumo['horas_diferencia']; ?></label>								
				<input type="hidden" name="horas_diferencia" class="" value="<?php echo $this->consumo['horas_diferencia']; ?>" style="width:150px;" />
			</div>
		</fieldset>

		</form>
	