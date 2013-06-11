<?php
class tipogastoModelo extends Modelo{
	var $tabla="trans_tipo_gasto";
	var $campos=array('id','nombre');
	var $pk="id";
	
	function nuevo($params){
		return parent::nuevo($params);
	}
	function guardar($params){
		$id = $params['id'];
		if ( $id ==1 || $id==2 || $id==3 ) return array('success'=>false, 'msg'=>'Este registro no puede editarse, est&aacute; protegido' );
		
		return parent::guardar($params);
	}
	function borrar($params){
		$id = $params['id'];
		if ( $id ==1 || $id==2 || $id==3 ) return array('success'=>'false', 'msg'=>'Este registro no puede eliminarse, est&aacute; protegido');
		
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