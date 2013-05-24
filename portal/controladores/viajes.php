<?php
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/viaje_modelo.php';
class viajes extends Controlador{
	var $modelo="viaje";
	var $campos=array('id','fecha_a_entregar','contenido','direccion_de_entrega','costo','precio','fk_chofer','fk_vehiculo','fk_caja','fk_cliente');
	var $pk="id";
	var $nombre="viajes";
	
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