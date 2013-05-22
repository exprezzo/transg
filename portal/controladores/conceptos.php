<?php
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/concepto_modelo.php';
class conceptos extends Controlador{
	var $modelo="concepto";
	var $campos=array('id','nombre','costo','nombre_um');
	var $pk="id";
	var $nombre="conceptos";
	
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