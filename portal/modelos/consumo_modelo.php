<?php
class consumoModelo extends Modelo{
	var $tabla="trans_consumo";
	var $campos=array('id','fk_viaje','distancia','rendimiento','consumo_diesel_lt','precio_por_litro','consumo_en_pesos','kilometraje_inicial','kilometraje_final','kilometraje_recorrido','consumo_diesel_calculado_lt','consumo_diesel_calculado_pesos','consumo_diesel_real_pesos','diferencia_calculado','diferencia_medido','hora_trabajo_i','hora_trabajo_f','horas_esperadas','horas_trabajo','horas_diferencia');
	var $pk="id";
	
	function nuevo($params){
		return parent::nuevo($params);
	}
	function guardar($params){
		return parent::guardar($params);
	}
	function borrar($params){
		return parent::borrar($params);
	}
	function editar($params){
		return parent::obtener($params);
	}
	function buscar($params){
		return parent::buscar($params);
	}
}
?>