<?php
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/efectivo_modelo.php';
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/viaje_modelo.php';
class efectivo extends Controlador{
	var $modelo="efectivo";
	var $campos=array('id','importe','fecha','concepto','forma_deposito','fk_viaje');
	var $pk="id";
	var $nombre="efectivo";
	
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
	
	function nuevo(){		
		$campos=$this->campos;
		$vista=$this->getVista();				
		for($i=0; $i<sizeof($campos); $i++){
			$obj[$campos[$i]]='';
		}
		$vista->datos=$obj;		
		
		
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
		
		// print_r($res['datos']); exit;
		$vista->viajes=$res['datos'];				
		
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
		$id=empty( $_REQUEST['id'])? 0 : $_REQUEST['id'];
		$model=$this->getModel();
		$params=array(
			$this->pk=>$id
		);		
		
		$obj=$model->obtener( $params );	
		//-------------
		
		$viMod = new viajeModelo();		
		$res = $viMod->buscar( 
			array('filtros'=>array(
				array(
					'filterOperator'=>'equals',
					'dataKey'		=>'vid',
					'field'			=>'v.id',
					'filterValue'	=>$obj['fk_viaje']
				)
			))
		);
		
		// print_r( $res ); exit;
		$vista->viajes=$res['datos'];
		
		// print_r($vista->viajes); exit;
		//-----------
		
		$vista=$this->getVista();				
		$vista->datos=$obj;		
		
		
		
		global $_PETICION;		
		$vista->mostrar('/'.$_PETICION->controlador.'/edicion');
		
		
	}
	function buscar(){
		if ( !empty($_GET['filtering']) )
		for($i=0; $i<sizeof($_GET['filtering']); $i++ ){
			if ( !empty($_GET['filtering'][$i]['dataKey']) ){
				if ( $_GET['filtering'][$i]['dataKey']=='fecha_i' ){
					$fechai=DateTime::createFromFormat ( 'd/m/Y' , $_GET['filtering'][$i]['filterValue'] );
					$_GET['filtering'][$i]['filterValue']=$fechai->format('Y-m-d').' 00:00:00';
					$_GET['filtering'][$i]['field']='d.fecha';
				}
				
				if ( $_GET['filtering'][$i]['dataKey']=='fecha_f' ){
					$fechaf=DateTime::createFromFormat ( 'd/m/Y' , $_GET['filtering'][$i]['filterValue'] );
					$_GET['filtering'][$i]['filterValue']=$fechaf->format('Y-m-d').' 23:59:59';
					$_GET['filtering'][$i]['field']='d.fecha';
				}				
			}
			
		}
		return parent::buscar();
	}
}
?>