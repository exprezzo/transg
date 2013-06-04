<?php
class viajeModelo extends Modelo{
	var $tabla="trans_viaje";
	var $campos=array('id','origen', 'fk_remitente','fecha_carga','direccion_carga','contenido', 'destino', 'fk_destinatario','direccion_de_entrega','fecha_a_entregar', 'precio', 'condiciones_de_pago','costo','fk_chofer','fk_vehiculo','fk_caja','folio','creado');
	var $pk="id";
	
	function nuevo($params){
		return parent::nuevo($params);
	}
	
	
	function guardar($params){
		$gastos = ( empty($params['gastos']) )? array() : $params['gastos'];
		
		unset( $params['gastos'] );
		
		$pdo = $this->getPdo();
		$pdo->beginTransaction( );
		
		$res = parent::guardar( $params );
		
		if ( $res['success'] ){
			$gastoMod = new gastodeviajeModelo();			
			
			foreach($gastos as $art){
				 unset( $art['nombre'] ) ;
				 unset( $art['nombreConcepto'] ) ;
				 unset( $art['fechaa'] ) ;
				 unset( $art['dataItemIndex'] ) ;
				 unset( $art['sectionRowIndex'] ) ;
				 unset( $art['tmp_id'] ) ;
				// unset( $art['codigo'] ) ;
				// $art['precio'] =$art['costo'];
				// unset( $art['costo'] ) ;
				// unset( $art['presentacion'] ) ;
				
				// unset( $art['activo'] ) ;
				// unset( $art['idarticuloclase'] ) ;				
				// unset( $art['id'] ) ;
				
				// unset( $art['inventariable'] ) ;
				// unset( $art['puntos'] ) ;
				// unset( $art['presentacionNombre'] ) ;
				
				
				$art['fk_viaje']=$res['datos']['id'];
				
				 // echo $art['fecha'];
				
				
				
				$fecha=DateTime::createFromFormat('d/m/Y', $art['fecha'] );
				if ($fecha)
				$art['fecha'] =  $fecha->format('Y-m-d');				
				
				if ( !empty( $art['eliminado'] ) ){					
					$resp = $gastoMod->eliminar( $art );	
					if ( !$resp ) {
						$pdo->rollBack( );
						$resp=array(
							'success'=>false,
							'msg'=>'error al eliminar gasto'
						);
						echo json_encode( $resp );
						exit;
					}					
				}else{
					unset( $art['eliminado'] ) ;
					if ( !empty($art['fk_concepto']) ){
						$resp=$gastoMod->guardar( $art );					
						if ( !$resp['success'] ) {
							$pdo->rollBack( );
							echo json_encode( $resp );
							exit;
						}
					}
					
				}			
			}
						
			$params=array(
				'filtros'=>array(
					array('dataKey'=>'fk_viaje', 'filterOperator'=>'equals','filterValue'=> $res['datos']['id']),
				)
			);
			
			$articulos= $gastoMod->buscar( $params );				
			$res['datos']['gastos'] =$articulos['datos'];		
		}else{
		    $pdo->rollBack( );
			echo json_encode( $res );
			exit;			
		}
		
		$consumoMod=new consumoModelo();
		
		$this->consumo['fk_viaje'] = $res['datos']['id'];		
		$resC = $consumoMod->guardar( $this->consumo );
		
		if ( !$resC['success'] ){
			$pdo->rollBack( );
			echo json_encode( $resC );
			exit;			
		}
		$this->consumo=$resC['datos'];
		
		
		$pdo->commit( );
		
		//-----------------------------------------
		
		
		return $res;
	}
	function borrar($params){
		$pdo = $this->getPdo();
		$pdo->beginTransaction( );
		$res =  parent::borrar($params);
		if ( !$res ){
			$pdo->rollBack( );
		}else{
			
			$sql='DELETE FROM trans_viaje_gasto WHERE fk_viaje=:fk_viaje';
			$sth = $pdo->prepare($sql);
			$fk_viaje=$params['id'];
			$sth->bindValue(':fk_viaje', $fk_viaje);
			$res = $sth->execute(); 
			if ( $res ){
				$pdo->commit( );
			}else{
				$pdo->rollBack( );
			}
			
		}
		return $res;
		
	}
	function editar($params){
		// echo 'asd';
		return $this->obtener($params);
	}
	
	function obtener($params){
	 
		
		$id=$params[$this->pk];			
		$sql = 'SELECT s.serie as nombreSerie, v.*,v.id as fk_viaje,
		c.id as fk_consumo, c.distancia,c.rendimiento,c.consumo_diesel_lt,c.precio_por_litro,c.consumo_en_pesos,c.kilometraje_inicial,c.kilometraje_final,
		c.kilometraje_recorrido,c.consumo_diesel_calculado_lt,c.consumo_diesel_calculado_pesos,c.consumo_diesel_real_pesos,c.diferencia
		FROM '.$this->tabla.' v
		LEFT JOIN trans_consumo c ON c.fk_viaje= v.id
		LEFT JOIN trans_serie s ON s.id = v.fk_serie WHERE v.'.$this->pk.'=:id';				
		
		// echo $sql; exit;
		$con = $this->getConexion();
		$sth = $con->prepare($sql);		
		$sth->bindValue(':id',$id);		
		$sth->execute();
		$modelos = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		if ( empty($modelos) ){
			//throw new Exception(); //TODO: agregar numero de error, crear una exception MiEscepcion
			echo $sql;
			return array('success'=>false,'error'=>'no encontrado','msg'=>'no encontrado '.$this->pk.':'.$id);
		}
		
		if ( sizeof($modelos) > 1 ){
			throw new Exception("El identificador está duplicado"); //TODO: agregar numero de error, crear una exception MiEscepcion
		}
		// echo '<pre>'; 
		// print_r($modelos); 
		// echo '</pre>';
		return $modelos[0];			
	}
	
	function buscar($params){		
		$con = $this->getConexion();
		
		$filtros='';
		$agregarLJcliente=false;
		if ( isset($params['filtros']) ){				
			$filtros=$this->cadenaDeFiltros($params['filtros']);						
		}

		$sql = 'SELECT COUNT(v.id) as total FROM '.$this->tabla.' v 
		LEFT JOIN trans_cliente rem ON rem.id = v.fk_remitente  
		LEFT JOIN trans_cliente dest ON dest.id = v.fk_destinatario  
		LEFT JOIN trans_vehiculo ve ON ve.id = v.fk_vehiculo '.$filtros;
		
				
		$sth = $con->prepare($sql);
		if ( isset($params['filtros']) ){
			$this->bindFiltros($sth, $params['filtros']);
		}
		
		$exito = $sth->execute();
		    // echo $sth->debugDumpParams();
		if ( !$exito ){
			$arr = $sth->errorInfo();
			echo $sth->debugDumpParams();
			print_r($arr);
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
			$sql = 'SELECT s.serie, dest.razon_social as destinatario, rem.razon_social as remitente, ve.codigo as vehiculo, v.*,DATE_FORMAT(v.fecha_carga, "%d/%m/%Y %H:%i:%s") as human_fecha_c ,
			DATE_FORMAT(v.fecha_a_entregar, "%d/%m/%Y %H:%i:%s") as human_fecha FROM '.$this->tabla.' v 
			LEFT JOIN trans_cliente rem ON rem.id = v.fk_remitente 
			LEFT JOIN trans_cliente dest ON dest.id = v.fk_destinatario 
			LEFT JOIN trans_vehiculo ve ON ve.id = v.fk_vehiculo 
			LEFT JOIN trans_serie s ON s.id = v.fk_serie 
			'.$filtros.' ORDER by fecha_a_entregar DESC limit :start,:limit;';
		}else{			
			$sql = 'SELECT s.serie, dest.razon_social as destinatario, rem.razon_social as remitente, ve.codigo as vehiculo, v.*, DATE_FORMAT(v.fecha_carga, "%d/%m/%Y %H:%i:%s") as human_fecha_c ,
			DATE_FORMAT(v.fecha_a_entregar, "%d/%m/%Y %H:%i:%s") as human_fecha FROM '.$this->tabla.' v 
			LEFT JOIN trans_cliente rem ON rem.id = v.fk_remitente 
			LEFT JOIN trans_cliente dest ON dest.id = v.fk_destinatario 
			LEFT JOIN trans_vehiculo ve ON ve.id = v.fk_vehiculo 
			LEFT JOIN trans_serie s ON s.id = v.fk_serie 
			'.$filtros.' ORDER by fecha_a_entregar DESC';
		}
		
		// echo $sql;
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