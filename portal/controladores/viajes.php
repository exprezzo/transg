<?php
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/viaje_modelo.php';
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/chofer_modelo.php';
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/vehiculo_modelo.php';
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/caja_modelo.php';
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/cliente_modelo.php';
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/gastodeviaje_modelo.php';
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/concepto_modelo.php';
class viajes extends Controlador{
	var $modelo="viaje";
	var $campos=array('id','fecha_a_entregar','contenido','direccion_de_entrega','costo','precio','fk_chofer','fk_vehiculo','fk_caja','fk_cliente','creado');
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
		 unset($_POST['datos']['nombreSerie']);
		 unset($_POST['datos']['folio']);
		 unset($_POST['datos']['hora_a_entregar']);
		 
		 $_POST['datos']['precio'] =  str_replace ( '$' , '' , $_POST['datos']['precio'] );
		return parent::guardar();
	}
	function borrar(){
		return parent::borrar();
	}
	function editar(){
		
		
	
		$vista=$this->getVista();
		
		$choMod = new choferModelo();
		$res = $choMod->buscar( array() );		
		$vista->choferes=$res['datos'];
		
		$vMod = new vehiculoModelo();
		$res = $vMod->buscar( array() );		
		$vista->vehiculos=$res['datos'];
		
		$cMod = new cajaModelo();
		$res = $cMod->buscar( array() );		
		$vista->cajas=$res['datos'];
		
		$cliMod = new clienteModelo();
		$res = $cliMod->buscar( array() );		
		$vista->clientes=$res['datos'];
		
		$gastoMod = new gastodeviajeModelo();
		$res = $gastoMod->buscar(
			array('filtros'=>array(
				array(
					'filterOperator'=>'equals',
					'dataKey'=>'fk_viaje',
					'filterValue'=>$_POST['id']
				)
			))
		);		
		$vista->gastos=$res['datos'];
		
		return parent::editar();
	}
	
	function buscarConceptos(){
		$concepto=new conceptoModelo();
		
		
		$params=array(
			'filtros'=>array(
				array('dataKey'=>'nombre', 'filterOperator'=>'contains','filterValue'=>$_REQUEST['nombre'])
			)				
		);
		$res = $concepto->buscar( $params );
		
		$respuesta=array(
			'rows'=>$res['datos']
		);
		echo json_encode($respuesta);	
	}
	
	function buscar(){
		return parent::buscar();
	}
}
?>