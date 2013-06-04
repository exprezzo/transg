<?php
class tipogastoModelo extends Modelo{
	var $tabla="trans_tipo_gasto";
	var $campos=array('id','nombre');
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