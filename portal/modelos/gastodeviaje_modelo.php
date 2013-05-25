<?php
class gastodeviajeModelo extends Modelo{
	var $tabla="trans_viaje_gasto";
	var $campos=array('id','fk_viaje','fk_concepto','costo','fecha');
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