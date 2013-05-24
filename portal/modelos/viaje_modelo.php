<?php
class viajeModelo extends Modelo{
	var $tabla="trans_viaje";
	var $campos=array('id','fecha_a_entregar','contenido','direccion_de_entrega','costo','precio','fk_chofer','fk_vehiculo','fk_caja','fk_cliente','creado');
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