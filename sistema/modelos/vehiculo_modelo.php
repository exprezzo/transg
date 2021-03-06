<?php
class vehiculoModelo extends Modelo{
	var $tabla="trans_vehiculo";
	var $campos=array('id','modelo','codigo','placas','rendimiento','fk_caja','kilometraje');
	var $pk="id";
	
	function nuevo($params){
		return parent::nuevo($params);
	}
	function guardar($params){
		return parent::guardar($params);
	}
	function borrar($params){
		//Obtener los gastos, si el viaje tiene gastos ,revisa que solo el admin pueda borrarlos			
		$sql='SELECT * FROM trans_gasto WHERE fk_vehiculo=:fk_vehiculo';
		$pdo=$this->getPdo();
		$sth = $pdo->prepare($sql);
		$fk_vehiculo=$params['id'];
		$sth->bindValue(':fk_vehiculo', $fk_vehiculo);
		$res = $sth->execute(); 
		if ( !$res ){ 			
			$res= array(
				'success'=>false,
				'msg'=>'error al intentar obtener los gastos del vehiculo'
			);
			echo json_encode($res); exit;
		}
		$gastos = $sth->fetchAll(PDO::FETCH_ASSOC);
		if ( sizeof($gastos)>0 && $_SESSION['userInfo']['rol']!=2 ){			
			$res=array(
				'success'=>false,
				'msg'=>'El vehiculo tiene gastos asociados, primero debe borrar los gastos asociados'
			);
			
			echo json_encode( $res ); exit;
		}
		return parent::borrar($params);
	}
	function editar($params){
		return parent::obtener($params);
	}
	
	function buscar($params){
		
		$con = $this->getConexion();
		
		$filtros='';
		if ( isset($params['filtros']) )
			$filtros=$this->cadenaDeFiltros($params['filtros']);
			
		
		$sql = 'SELECT COUNT(*) as total FROM '.$this->tabla.$filtros;				
		$sth = $con->prepare($sql);
		
		if ( isset($params['filtros']) ){
			$this->bindFiltros($sth, $params['filtros']);
		}
		
		
		
		$exito = $sth->execute();
		
		
		
		if ( !$exito ){
			return $this->getError( $sth );
			throw new Exception("Error listando: ".$sql); //TODO: agregar numero de error, crear una exception MiEscepcion
		}		
		// $sth = $con->query($sql); // Simple, but has several drawbacks		
		
		
		$tot = $sth->fetchAll(PDO::FETCH_ASSOC);
		$total = $tot[0]['total'];
		
		$paginar=false;
		if ( isset($params['limit']) && isset($params['start']) ){
			$paginar=true;
		}
		
		
		
		
		if ($paginar){
			$limit=$params['limit'];
			$start=$params['start'];		
			$sql = 'SELECT v.*,c.codigo as codCaja FROM '.$this->tabla.' v LEFT JOIN trans_caja c ON c.id=v.fk_caja '.$filtros.' limit :start,:limit';
		}else{			
			$sql = 'SELECT v.*,c.codigo as codCaja FROM '.$this->tabla.' v LEFT JOIN trans_caja c ON c.id=v.fk_caja '.$filtros;
		}
		
		$sth = $con->prepare($sql);
		if ($paginar){
			$sth->bindValue(':limit',$limit,PDO::PARAM_INT);
			$sth->bindValue(':start',$start,PDO::PARAM_INT);
		}
				
		if ( isset($params['filtros']) ){
			$this->bindFiltros($sth, $params['filtros']);
		}
		
		$exito = $sth->execute();

		
		if ( !$exito ){
		
			return $this->getError( $sth );
			// throw new Exception("Error listando: ".$sql); //TODO: agregar numero de error, crear una exception MiEscepcion
		}
		
		$modelos = $sth->fetchAll(PDO::FETCH_ASSOC);				
		
		return array(
			'success'=>true,
			'total'=>$total,
			'datos'=>$modelos
		);
	}
}
?>