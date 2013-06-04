<?php
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/tipogasto_modelo.php';
class tipogastos extends Controlador{
	var $modelo="tipogasto";
	var $campos=array('id','nombre');
	var $pk="id";
	var $nombre="tipogastos";
	
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