<?php
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/serie_modelo.php';
class series extends Controlador{
	var $modelo="serie";
	var $campos=array('id','serie','folio_i','folio_f','sig_folio','es_default','idalmacen','proceso','idsucursal');
	var $pk="id";
	var $nombre="series";
	
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