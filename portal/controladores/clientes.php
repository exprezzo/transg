<?php
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/cliente_modelo.php';
class clientes extends Controlador{
	var $modelo="cliente";
	var $campos=array('id','razon_social','rfc','direccion','telefonos','www','contacto','cuenta_bancaria');
	var $pk="id";
	var $nombre="clientes";
	
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