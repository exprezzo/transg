<?php
class efectivoModelo extends Modelo{
	var $tabla="trans_efectivo_de_viaje";
	var $campos=array('id','importe','fecha','concepto','forma_deposito','fk_viaje');
	var $pk="id";
	
	function nuevo($params){
		return parent::nuevo($params);
	}
	function guardar($params, $actualizarViaje=true){
		//si el viaje esta cerrado impedir guardar
		if ( !empty( $params['fk_viaje'] ) && $actualizarViaje  ){
			$viajeMod=new ViajeModelo();
			$viajeOld=$viajeMod->obtener(array('id'=>$params['fk_viaje'] ) );
			
			if ($viajeOld['fk_estado']==2){
				// $pdo->rollBack( );
				return array(
					'success'=>false,
					'msg'=>'Un viaje cerrado no puede modificarse',					
				);
			}
		}
		
		
		$res = parent::guardar($params);
		if (  !empty( $params['fk_viaje'] ) && $actualizarViaje ){
			
			$paramsFind=array(
				'filtros'=>array(
					array('dataKey'=>'fk_viaje', 'filterOperator'=>'equals','filterValue'=>$params['fk_viaje'] ),
				)
			);
			$efecttivoDelViaje = $this->buscar( $paramsFind );
			
			if ( !$efecttivoDelViaje['success'] ) return $efecttivoDelViaje;
			
			$total=0;
			foreach($efecttivoDelViaje['datos'] as $obj){
				$total = $total + ($obj['importe'] * 1);
			}
			
			
			
			$viaje=array('id'=>$params['fk_viaje'], 'efectivo'=>$total );
			$resSave = $viajeMod->guardar( $viaje );
			if ( !$resSave['success'] ) return $resSave;
		}
		return $res;
		
	}
	function borrar($params, $actualizarViaje=true){
		//antes de eliminar, obtiene el viaje asociado
		$efectivo = $this->obtener($params);
		
		if ( !empty( $efectivo['fk_viaje'] ) && $actualizarViaje  ){
			$viajeMod=new ViajeModelo();
			$viajeOld=$viajeMod->obtener(array('id'=>$efectivo['fk_viaje'] ) );
			
			if ($viajeOld['fk_estado']==2){
				// $pdo->rollBack( );
				echo json_encode( array(
					'success'=>false,
					'msg'=>'Un viaje cerrado no puede modificarse',					
				) ); exit;
			}
		}
		
		$res = parent::borrar($params);
		if (  !empty( $efectivo['fk_viaje'] ) && $actualizarViaje ){
			
			$paramsFind=array(
				'filtros'=>array(
					array('dataKey'=>'fk_viaje', 'filterOperator'=>'equals','filterValue'=>$efectivo['fk_viaje'] ),
				)
			);
			$efecttivoDelViaje = $this->buscar( $paramsFind );
			
			if ( !$efecttivoDelViaje['success'] ) return $efecttivoDelViaje;
			
			$total=0;
			foreach($efecttivoDelViaje['datos'] as $obj){
				$total = $total + ($obj['importe'] * 1);
			}
			
			// $viajeMod=new ViajeModelo();
			
			$viaje=array('id'=>$efectivo['fk_viaje'], 'efectivo'=>$total );
			$resSave = $viajeMod->guardar( $viaje );
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
			
		
		$sql = 'SELECT COUNT(d.id) as total FROM '.$this->tabla.' d '.$filtros;				
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
			$sql = 'SELECT d.id, d.importe,DATE_FORMAT(d.fecha, "%d/%m/%Y") fecha, d.concepto, d.forma_deposito, d.fk_viaje,
			CONCAT(s.serie," ",v.folio) viaje
			FROM '.$this->tabla.' d 
			LEFT JOIN trans_viaje v ON v.id = d.fk_viaje 
			LEFT JOIN trans_serie s ON s.id = v.fk_serie 
			'.$filtros.' ORDER BY v.fk_serie DESC,v.folio DESC  limit :start,:limit ';
		}else{			
			$sql = 'SELECT d.id, d.importe,DATE_FORMAT(d.fecha, "%d/%m/%Y") fecha, d.concepto, d.forma_deposito, d.fk_viaje, 
			CONCAT(s.serie," ",v.folio) viaje
			FROM '.$this->tabla.' d 
			LEFT JOIN trans_viaje v ON v.id = d.fk_viaje 
			LEFT JOIN trans_serie s ON s.id = v.fk_serie 
			'.$filtros. ' ORDER BY v.fk_serie DESC,v.folio DESC ';
		}
		// echo $sql; exit;
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