<?php
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/gastodeviaje_modelo.php';
class gastosdeviaje extends Controlador{
	var $modelo="gastodeviaje";
	var $campos=array('id','fk_viaje','fk_concepto','costo','fecha');
	var $pk="id";
	var $nombre="gastosdeviaje";
	
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