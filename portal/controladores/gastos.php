<?php
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/gasto_modelo.php';
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/tipogasto_modelo.php';
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/vehiculo_modelo.php';
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/viaje_modelo.php';
class gastos extends Controlador{
	var $modelo="gasto";
	var $campos=array('id','fk_viaje', 'fk_vehiculo','costo','descripcion','fecha','documento','fk_tipo_gasto');
	var $pk="id";
	var $nombre="gastos";
	
	function buscarViajes(){
		$mod= $this->getModel();
		
		
		$sql="SELECT v.id, concat(se.serie,' ',v.folio, ' (', ve.codigo, ')') as viaje,concat(se.serie,' ',v.folio) as documento,v.fk_vehiculo FROM trans_viaje v
		LEFT JOIN trans_serie se ON se.id = v.fk_serie 
		LEFT JOIN trans_vehiculo ve ON ve.id = v.fk_vehiculo
		WHERE v.fk_estado=1";
		$pdo=$mod->getPdo();
		$sth = $pdo->prepare($sql);
		$exito= $sth->execute();
		if ( !$exito ){
			$error=$mod->getError( $sth ); 
			echo json_encode( $error );
			exit;
		}
		
		$viajes = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		$res=array(
			'rows'=>$viajes,
			'totalRows'=>sizeof( $viajes )
		);
		
		echo json_encode( $res );
		
	}
	
	function buscarVehiculos(){
		$mod= new vehiculoModelo();
		
		
		$sql="SELECT ve.*,if ( isnull(vi.id), codigo,  concat(codigo,' (', se.serie, ' ',vi.folio, ')' ))  as codigo FROM trans_vehiculo ve 
		LEFT JOIN trans_viaje vi ON vi.fk_vehiculo = ve.id AND vi.fk_estado =1
		LEFT JOIN trans_serie se ON se.id = vi.fk_serie";
		$pdo=$mod->getPdo();
		$sth = $pdo->prepare($sql);
		$exito= $sth->execute();
		if ( !$exito ){
			$error=$mod->getError(); 
			echo json_encode( $error );
			exit;
		}
		
		$vehiculos = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		$res=array(
			'rows'=>$vehiculos,
			'totalRows'=>sizeof( $vehiculos )
		);
		
		echo json_encode( $res );
		
	}
	function nuevo(){		
		$campos=$this->campos;
		$vista=$this->getVista();				
		for($i=0; $i<sizeof($campos); $i++){
			$obj[$campos[$i]]='';
		}
		$obj['hora']='';
		$vista->datos=$obj;		
		$vista->datos['fk_tipo_gasto']=1;		
		
		$tipMod = new tipogastoModelo();
		$tipos = $tipMod->buscar( array() );		
		$vista->tiposGasto = $tipos['datos'];
		
		$viMod = new viajeModelo();		
		$res = $viMod->buscar( 
			array('filtros'=>array(
				array(
					'filterOperator'=>'equals',
					'dataKey'		=>'fk_estado',
					'filterValue'	=>1
				)
			))
		);
		$vista->viajes=$res['datos'];		
		// print_r($res); exit;
		
		$vemod=new vehiculoModelo();
		$resp = $vemod->buscar( array() );
		$vista->vehiculos = $resp['datos'];
		
		global $_PETICION;
		$vista->mostrar('/'.$_PETICION->controlador.'/edicion');
		
		
	}
	
	function guardar(){
		$fecha=DateTime::createFromFormat ( 'd/m/Y' , $_POST['datos']['fecha'] );
		$_POST['datos']['fecha']=$fecha->format('Y-m-d') . ' '.$_POST['datos']['hora'];
		unset( $_POST['datos']['hora'] ); 
		return parent::guardar();
	}
	function borrar(){
		return parent::borrar();
	}
	function editar(){
		$vista=$this->getVista();
		$tipMod = new tipogastoModelo();
		$tipos = $tipMod->buscar( array() );		
		$vista->tiposGasto = $tipos['datos'];
		
		$viMod = new viajeModelo();		
		$res = $viMod->buscar( 
			array('filtros'=>array(
				array(
					'filterOperator'=>'equals',
					'dataKey'		=>'fk_estado',
					'filterValue'	=>1
				)
			))
		);
		$vista->viajes=$res['datos'];				
		
		$vemod=new vehiculoModelo();
		$resp = $vemod->buscar( array() );
		$vista->vehiculos = $resp['datos'];
		
		return parent::editar();
	}
	function buscar(){
		if ( !empty($_GET['filtering']) )
		for($i=0; $i<sizeof($_GET['filtering']); $i++ ){
			if ( !empty($_GET['filtering'][$i]['dataKey']) ){
				if ( $_GET['filtering'][$i]['dataKey']=='fecha_i' ){
					$fechai=DateTime::createFromFormat ( 'd/m/Y' , $_GET['filtering'][$i]['filterValue'] );
					$_GET['filtering'][$i]['filterValue']=$fechai->format('Y-m-d').' 00:00:00';
					$_GET['filtering'][$i]['field']='g.fecha';
				}
				
				if ( $_GET['filtering'][$i]['dataKey']=='fecha_f' ){
					$fechaf=DateTime::createFromFormat ( 'd/m/Y' , $_GET['filtering'][$i]['filterValue'] );
					$_GET['filtering'][$i]['filterValue']=$fechaf->format('Y-m-d').' 23:59:59';
					$_GET['filtering'][$i]['field']='g.fecha';
				}				
			}
			
		}
		
		return parent::buscar();
	}
}
?>