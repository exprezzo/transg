<?php
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/caja_modelo.php';
class cajas extends Controlador{
	var $modelo="caja";
	var $campos=array('id','modelo','codigo','horas_de_trabajo');
	var $pk="id";
	var $nombre="cajas";
	
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