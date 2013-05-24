<?php
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/vehiculo_modelo.php';
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/caja_modelo.php';
class vehiculos extends Controlador{
	var $modelo="vehiculo";
	var $campos=array('id','modelo','codigo','placas','rendimiento','fk_caja','kilometraje');
	var $pk="id";
	var $nombre="vehiculos";
	
	function nuevo(){		
		$campos=$this->campos;
		$vista=$this->getVista();				
		for($i=0; $i<sizeof($campos); $i++){
			$obj[$campos[$i]]='';
		}
		$vista->datos=$obj;		
		
		$cajaMod=new cajaModelo();		
		$res = $cajaMod->buscar( array() );				
		$vista->cajas=$res['datos'];
		
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
		$cajaMod=new cajaModelo();		
		$res = $cajaMod->buscar( array() );		
		$vista=$this->getVista();
		$vista->cajas=$res['datos'];
		
		return parent::editar();
	}
	function buscar(){
		return parent::buscar();
	}
}
?>