<?php
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/efectivo_modelo.php';
class efectivo extends Controlador{
	var $modelo="efectivo";
	var $campos=array('id','importe','fecha','concepto','forma_deposito','fk_viaje');
	var $pk="id";
	var $nombre="efectivo";
	
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