<?php
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/chofer_modelo.php';
class choferes extends Controlador{
	var $modelo="chofer";
	var $campos=array('id','nombre','nss','telefonos','cuenta_bancaria');
	var $pk="id";
	var $nombre="choferes";
	
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