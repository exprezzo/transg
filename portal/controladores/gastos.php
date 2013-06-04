<?php
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/gasto_modelo.php';
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/tipogasto_modelo.php';
class gastos extends Controlador{
	var $modelo="gasto";
	var $campos=array('id','cantidad','descripcion','fecha','documento','fk_tipo_gasto');
	var $pk="id";
	var $nombre="gastos";
	
	function nuevo(){		
		$campos=$this->campos;
		$vista=$this->getVista();				
		for($i=0; $i<sizeof($campos); $i++){
			$obj[$campos[$i]]='';
		}
		$obj['hora']='';
		$vista->datos=$obj;		
		
		$tipMod = new tipogastoModelo();
		$tipos = $tipMod->buscar( array() );		
		$vista->tiposGasto = $tipos['datos'];
		
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