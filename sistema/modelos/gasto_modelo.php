<?php
class gastoModelo extends Modelo{
	var $tabla="trans_gasto";
	var $campos=array('id','costo','descripcion','fecha','documento','fk_tipo_gasto','fk_viaje','fk_vehiculo');
	var $pk="id";
	
	function nuevo($params){
		return parent::nuevo($params);
	}
	function guardar($params, $actualizarViaje=true){
		switch ($params['fk_tipo_gasto'] ){
			case 1:	
				// 'VIAJE';
				// print_r( $params );
				 $params['fk_vehiculo'] =  ( isset( $params['vehicle'] ) )? $params['fk_vehiculo'] : 0;				
				 
			break;
			case 2:
				// echo 'VE';
				 $params['fk_viaje'] =0;
			break;
			case 3:
			default:	
				// echo 'OtRO';
				 $params['fk_vehiculo'] =0;
				 $params['fk_viaje'] = 0;
			break;
		}
		unset( $params['vehicle'] );
		if ( !empty($params['id']) ){
			//revisa que solo el admin pueda modificar gastos
			if ( !( $_SESSION['userInfo']['rol']==2) ){
			// if ( !($_SESSION['userInfo']['rol']==1 || $_SESSION['userInfo']['rol']==2) ){
				$res=array(
					'success'=>false,
					'msg'=>'No tiene privilegios para modificar gastos'
				);
				echo json_encode( $res ); exit;
			}
		}
		
		$res =  parent::guardar($params);
		
		if ( $params['fk_tipo_gasto'] == 1 && !empty( $params['fk_viaje'] ) && $actualizarViaje ){
			// echo 'AKI ESTA EL BOLETO';
			$paramsFind=array(
				'filtros'=>array(
					array('dataKey'=>'fk_viaje', 'filterOperator'=>'equals','filterValue'=>$params['fk_viaje'] ),
				)
			);
			$gastosDelViaje = $this->buscar( $paramsFind );
			
			// print_r( $gastosDelViaje ); 
			
			if ( !$gastosDelViaje['success'] ) return $gastosDelViaje;
			
			$total=0;
			foreach($gastosDelViaje['datos'] as $gasto){
				$total = $total + ($gasto['costo'] * 1);
			}
			
			// echo 'total: '.$total;
			
			$viajeMod=new ViajeModelo();
			$viaje=array('id'=>$params['fk_viaje'], 'costo'=>$total );
			
			// print_r( $viaje );
			$resSave = $viajeMod->guardar( $viaje );
			// echo 'resSave:'.$resSave['success'];
			if ( !$resSave['success'] ) return $resSave;			
		}
		return $res;
	}
	function borrar($params){
		if ( !( $_SESSION['userInfo']['rol']==2) ){
		// if ( !($_SESSION['userInfo']['rol']==1 || $_SESSION['userInfo']['rol']==2) ){
			$res=array(
				'success'=>false,
				'msg'=>'No tiene privilegios para eliminar gastos'
			);
			echo json_encode( $res ); exit;
		}
		$res =  parent::borrar($params);
		if ( !$res ) return $res;
		
		
		if ( !empty($params['fk_tipo_gasto']) && $params['fk_tipo_gasto'] == 1 && !empty( $params['fk_viaje'] ) ){
			$paramsFind=array(
				'filtros'=>array(
					array('dataKey'=>'fk_viaje', 'filterOperator'=>'equals','filterValue'=>$params['fk_viaje'] ),
				)
			);
			$gastosDelViaje = $this->buscar( $paramsFind );
			
			// print_r( $gastosDelViaje ); 
			
			if ( !$gastosDelViaje['success'] ) return $gastosDelViaje;
			
			$total=0;
			foreach($gastosDelViaje['datos'] as $gasto){
				$total = $total + ($gasto['costo'] * 1);
			}
			
			// echo 'total: '.$total;
			
			$viajeMod=new ViajeModelo();
			$viaje=array('id'=>$params['fk_viaje'], 'costo'=>$total );
			
			// print_r( $viaje );
			$resSave = $viajeMod->guardar( $viaje );
			// echo 'resSave:'.$resSave['success'];
			if ( !$resSave['success'] ) return $resSave;			
		}
		return $res;
	}
	function editar($params){
		return parent::obtener($params);
	}
	function buscar($params){
		
		$con = $this->getConexion();
		
		$filtros='';
		if ( isset($params['filtros']) )
			$filtros=$this->cadenaDeFiltros($params['filtros']);
			
		
		$sql = 'SELECT COUNT(g.id) as total FROM '.$this->tabla.' g '.$filtros;				
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
			$sql = 'SELECT g.*,t.nombre as tipo_gasto, c.nombre, DATE_FORMAT(g.fecha, "%d/%m/%Y") as fecha,ve.codigo 
			FROM '.$this->tabla.' g 
			LEFT JOIN trans_tipo_gasto t ON t.id = g.fk_tipo_gasto 
			LEFT JOIN trans_concepto c ON c.id = g.fk_concepto 
			LEFT JOIN trans_vehiculo ve ON ve.id = g.fk_vehiculo
			'.$filtros.'
			ORDER BY t.nombre ASC, fecha DESC  limit :start,:limit ';
		}else{			
			$sql = 'SELECT g.*,t.nombre as tipo_gasto,c.nombre,DATE_FORMAT(g.fecha, "%d/%m/%Y") as fecha,ve.codigo FROM '.$this->tabla.' g
			LEFT JOIN trans_tipo_gasto t ON t.id = g.fk_tipo_gasto
			LEFT JOIN trans_concepto c ON c.id = g.fk_concepto
			LEFT JOIN trans_vehiculo ve ON ve.id = g.fk_vehiculo
			'.$filtros.' ORDER BY t.nombre ASC, fecha DESC ';
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
			echo $sql; exit;
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