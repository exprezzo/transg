<?php
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/consumo_modelo.php';
class consumos extends Controlador{
	var $modelo="consumo";
	var $campos=array('id','fk_viaje','distancia','rendimiento','consumo_diesel_lt','precio_por_litro','consumo_en_pesos','kilometraje_inicial','kilometraje_final','kilometraje_recorrido','consumo_diesel_calculado_lt','consumo_diesel_calculado_pesos','consumo_diesel_real_pesos','diferencia');
	var $pk="id";
	var $nombre="consumos";
	
	function nuevo(){		
		$campos=$this->campos;
		$vista=$this->getVista();				
		for($i=0; $i<sizeof($campos); $i++){
			$obj[$campos[$i]]='';
		}
		$vista->datos=$obj;		
		
		global $_PETICION;
		$vista->mostrar('/'.$_PETICION->controlador.'/edicion');
		
		
	}
	
	function guardar(){
		return parent::guardar();
	}
	function borrar(){
		return parent::borrar();
	}
	function editar(){
		return parent::editar();
	}
	function buscar(){
		return parent::buscar();
	}
}
?>