<?php
class clienteModelo extends Modelo{
	var $tabla="trans_cliente";
	var $campos=array('id','razon_social','rfc','direccion','telefonos','www','contacto','cuenta_bancaria');
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