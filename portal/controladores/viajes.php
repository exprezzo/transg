<?php
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/viaje_modelo.php';
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/chofer_modelo.php';
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/vehiculo_modelo.php';
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/caja_modelo.php';
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/cliente_modelo.php';
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/gastodeviaje_modelo.php';
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/concepto_modelo.php';
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/serie_modelo.php';
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
		$vista->gastos=array();
		
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
		
		$params=array(
			'filtros'=>array(
				array('dataKey'=>'proceso', 'filterOperator'=>'equals','filterValue'=>$this->nombre),				
				array('dataKey'=>'idsucursal', 'filterOperator'=>'equals','filterValue'=>( isset($_REQUEST['idsucursal'] ) )?  $_REQUEST['idsucursal'] : 0)
			)
		);		
		$serieMod=new serieModelo();
		$res= $serieMod->obtenerSeries($params);
		if ( !$res['success'] ){
			$vista->series=array();
			$vista->datos['folio'] = 0;
		}else{
			$vista->series=$res['datos'];
			$vista->datos['folio'] = $res['datos'][0]['sig_folio'];	
		}
		
		global $_PETICION;
		$vista->mostrar('/'.$_PETICION->controlador.'/edicion');
		
		
	}
	
	function guardar(){
		 unset($_POST['datos']['nombreSerie']);
		 unset($_POST['datos']['folio']);
		 
		 
		 $_POST['datos']['precio'] =  str_replace ( '$' , '' , $_POST['datos']['precio'] );
		 
		 $fecha=DateTime::createFromFormat ( 'd/m/Y' , $_POST['datos']['fecha_a_entregar'] );
		 // $hora=DateTime::createFromFormat ( 'H:i:s' , $_POST['datos']['hora_a_entregar'] );
		 
		 $_POST['datos']['fecha_a_entregar']=$fecha->format('Y-m-d') . ' '.$_POST['datos']['hora_a_entregar'];
		 unset($_POST['datos']['hora_a_entregar']);
		 
		
		//------------------------------------------------------
		
		if ( empty($_POST['datos']['id']) ){						
			$serieMod=new serieModelo();
			$params=array(
				'id'	=>7
			);
			$res= $serieMod->asignarFolio( $params );  //regresa el folio siguiente, y lo incrementa
			if ( !$res['success'] ){				
				return $res;
			}
			
			$_POST['datos']['folio'] = $res['sig_folio'];
		}
		
		//------------------------------------------------------
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
		
		$params=array(
			'filtros'=>array(
				array('dataKey'=>'proceso', 'filterOperator'=>'equals','filterValue'=>$this->nombre),				
				array('dataKey'=>'idsucursal', 'filterOperator'=>'equals','filterValue'=>( isset($_REQUEST['idsucursal'] ) )?  $_REQUEST['idsucursal'] : 0)
			)
		);		
		$serieMod=new serieModelo();
		$res= $serieMod->obtenerSeries($params);
		if ( !$res['success'] ){
			$vista->series=array();
			$vista->datos['folio'] = 0;
		}else{
			$vista->series=$res['datos'];
			$vista->datos['folio'] = $res['datos'][0]['sig_folio'];	
		}				
		
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
	
	function busqueda(){
		$vista = $this->getVista();
		$cliMod = new clienteModelo();
		$res = $cliMod->buscar( array() );		
		$vista->clientes=$res['datos'];
		$vista->mostrar();
	}
	function buscar(){
		if ( !empty($_GET['filtering']) )
		for($i=0; $i<sizeof($_GET['filtering']); $i++ ){
			if ( !empty($_GET['filtering'][$i]['dataKey']) )
			if ( $_GET['filtering'][$i]['dataKey']=='fechai' ){
				$fechai=DateTime::createFromFormat ( 'd/m/Y' , $_GET['filtering'][$i]['filterValue'] );
				$_GET['filtering'][$i]['filterValue']=$fechai->format('Y-m-d').' 00:00:00';
				$_GET['filtering'][$i]['field']='v.fecha_a_entregar';
			}
			
			if ( !empty($_GET['filtering'][$i]['dataKey']) )
			if ( $_GET['filtering'][$i]['dataKey']=='fechaf' ){
				$fechaf=DateTime::createFromFormat ( 'd/m/Y' , $_GET['filtering'][$i]['filterValue'] );
				$_GET['filtering'][$i]['filterValue']=$fechaf->format('Y-m-d').' 23:59:59';
				$_GET['filtering'][$i]['field']='v.fecha_a_entregar';
			}
		}
		return parent::buscar();
	}
}
?>