<?php
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/consumo_modelo.php';
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/efectivo_modelo.php';
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/gasto_modelo.php';
class viajeModelo extends Modelo{
	var $tabla="trans_viaje";
	var $campos=array('id','origen','fk_serie', 'fk_remitente','fecha_carga','direccion_carga','contenido', 'destino', 'fk_destinatario','direccion_de_entrega','fecha_a_entregar', 'precio', 'condiciones_de_pago','costo','fk_chofer','fk_vehiculo','fk_caja','folio','creado','fk_estado','efectivo','comision');
	var $pk="id";
	
	function nuevo($params){
		return parent::nuevo($params);
	}
	
	
	function guardar($params){
		$gastos = ( empty($params['gastos']) )? array() : $params['gastos'];
		$depositos = ( empty($params['depositos']) )? array() : $params['depositos'];
		
		unset( $params['gastos'] );
		unset( $params['depositos'] );
		
		$pdo = $this->getPdo();
		
		$pdo->beginTransaction( );
		
		
		if ( !empty($params['id']) ){
			unset( $params['fk_serie'] );
			unset( $params['folio'] );
		}
		
		//si el viaje esta cerrado impedir guardar
		if ( !empty($params['id']) ){
			$viajeOld=$this->obtener($params);
			if ($viajeOld['fk_estado']==2){
				$pdo->rollBack( );
				return array(
					'success'=>false,
					'msg'=>'Un viaje cerrado no puede modificarse',					
				);
			}
		}
		
		$res = parent::guardar( $params );
		
		
		if ( $res['success'] ){
			$gastoMod = new gastoModelo();			
			
			foreach($gastos as $art){
				 // if ( !empty($art['nombre']) )  $art['descripcion'] = $art['nombre'];
				 unset( $art['nombre'] ) ;
				 unset( $art['nombreConcepto'] ) ;
				 unset( $art['fechaa'] ) ;
				 unset( $art['dataItemIndex'] ) ;
				 unset( $art['sectionRowIndex'] ) ;
				 unset( $art['tmp_id'] ) ;
				 unset( $art['tipo_gasto'] ) ;				 
				 unset( $art['codigo'] ) ;				 
				 $art['fk_tipo_gasto']=1; //VIAJE
				 $art['documento'] = $res['datos']['nombreSerie'].' '.$res['datos']['folio'];				
				$art['fk_viaje']=$res['datos']['id'];

				$fecha=DateTime::createFromFormat('d/m/Y', $art['fecha'] );
				if ($fecha)
				$art['fecha'] =  $fecha->format('Y-m-d');				
				
				if ( !empty($art['eliminado']) && !empty($art['id']) ){	
					unset ( $art['fk_viaje'] ); //esta linea es necesaria, esta variable afecta a la funcion GastoModelo->eliminar();
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
					if ( !empty($art['fk_concepto']) || !empty($art['descripcion']) ){
						
						$resp=$gastoMod->guardar( $art, false );					
						
						if ( !$resp['success'] ) {
							$pdo->rollBack( );
							echo json_encode( $resp );
							exit;
						}
					}					
				}			
			}
			
			$depositoMod = new efectivoModelo();
			foreach($depositos as $art){	
				unset( $art['dataItemIndex'] ) ;
				unset( $art['sectionRowIndex'] ) ;
				unset( $art['tmp_id'] );
				unset( $art['viaje'] ) ;
				 
				$art['fk_viaje']=$res['datos']['id'];
				
				$fecha=DateTime::createFromFormat('d/m/Y', $art['fecha'] );
				if ($fecha)
				$art['fecha'] =  $fecha->format('Y-m-d');				
				
				if ( !empty($art['eliminado']) && !empty($art['id']) ){			
					// echo 'AKI'; exit;
					$resp = $depositoMod->borrar( $art, false );	
					if ( !$resp ) {
						$pdo->rollBack( );
						$resp=array(
							'success'=>false,
							'msg'=>'error al eliminar deposito'
						);
						echo json_encode( $resp );
						exit;
					}
				}else{
					unset( $art['eliminado'] ) ;
					if ( !empty($art['importe'])  ){
						
						$resp=$depositoMod->guardar( $art, false );					
						
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
			
			//_--------------------------						
			$depositos= $depositoMod->buscar( $params );				
			$res['datos']['depositos'] =$depositos['datos'];		
			
		}else{
		    $pdo->rollBack( );
			echo json_encode( $res );
			exit;			
		}
		
		if ( !empty($this->consumo) ){
			$consumoMod=new consumoModelo();		
			$this->consumo['fk_viaje'] = $res['datos']['id'];				
			$resC = $consumoMod->guardar( $this->consumo );		
			if ( !$resC['success'] ){
				$pdo->rollBack( );
				echo json_encode( $resC );
				exit;			
			}
			$this->consumo=$resC['datos'];
		}
		
		$pdo->commit( );
		
		//-----------------------------------------
		
		
		return $res;
	}
	function borrar($params){
		$pdo = $this->getPdo();
		$pdo->beginTransaction( );
		
		if ( !empty( $params['id'] )  ){
			
			$viajeOld=$this->obtener(array('id'=>$params['id'] ) );
			
			if ($viajeOld['fk_estado']==2){
				$pdo->rollBack( );
				echo json_encode( array(
					'success'=>false,
					'msg'=>'Un viaje cerrado no puede eliminarse',					
				) ); exit;
			}
		}
		$res =  parent::borrar($params);
		if ( !$res ){
			$pdo->rollBack( );
		}else{
			//Obtener los gastos, si el viaje tiene gastos ,revisa que solo el admin pueda borrarlos			
			$sql='SELECT * FROM trans_gasto WHERE fk_viaje=:fk_viaje';
			$sth = $pdo->prepare($sql);
			$fk_viaje=$params['id'];
			$sth->bindValue(':fk_viaje', $fk_viaje);
			$res = $sth->execute(); 
			if ( !$res ){ 
				$pdo->rollBack( ); 
				$res= array(
					'success'=>false,
					'msg'=>'error al intentar obtenre los gastos para borrarlos'
				);
				echo json_encode($res); exit;
			}
			$gastos = $sth->fetchAll(PDO::FETCH_ASSOC);
			if ( sizeof($gastos)>0 && $_SESSION['userInfo']['rol']!=2 ){
				$pdo->rollBack( );
				$res=array(
					'success'=>false,
					'msg'=>'No tiene privilegios para eliminar gastos'
				);
				
				echo json_encode( $res ); exit;
			}
			
			$sql='DELETE FROM trans_gasto WHERE fk_viaje=:fk_viaje';
			$sth = $pdo->prepare($sql);
			$fk_viaje=$params['id'];
			$sth->bindValue(':fk_viaje', $fk_viaje);
			$res = $sth->execute(); 
			if ( !$res ){ 
				$pdo->rollBack( ); 
				$res= array(
					'success'=>false,
					'msg'=>'error al intentar borrar los gastos'
				);
				echo json_encode($res); exit;
			}
			
			$sql='DELETE FROM trans_consumo WHERE fk_viaje=:fk_viaje';						
			$sth = $pdo->prepare($sql);
			$fk_viaje=$params['id'];
			$sth->bindValue(':fk_viaje', $fk_viaje);
			$res = $sth->execute(); 
			if ( !$res ){ 
				$pdo->rollBack( ); 
				$res =  array(
					'success'=>false,
					'msg'=>'error al intentar borrar el consumo'
				);
				echo json_encode($res); exit;
			}
			
			$sql='DELETE FROM trans_efectivo_de_viaje WHERE fk_viaje=:fk_viaje';						
			$sth = $pdo->prepare($sql);
			$fk_viaje=$params['id'];
			$sth->bindValue(':fk_viaje', $fk_viaje);
			$res = $sth->execute(); 
			if ( !$res ){ 
				$pdo->rollBack( ); 
				$res =  array(
					'success'=>false,
					'msg'=>'error al intentar borrar los deposito'
				);
				echo json_encode($res); exit;
			}
			$pdo->commit( ); 
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
		c.kilometraje_recorrido,c.consumo_diesel_calculado_lt,c.consumo_diesel_calculado_pesos,c.consumo_diesel_real_pesos,c.diferencia_calculado,  
		c.diferencia_medido, v.efectivo, v.comision FROM '.$this->tabla.' v
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
			// echo $sql;
			return array('success'=>false,'error'=>'no encontrado','msg'=>'elemento no encontrado '.$this->pk.':'.$id);
		}
		
		if ( sizeof($modelos) > 1 ){
			
			// echo $sql."id: $id pk: ".$this->pk;
			throw new Exception("El identificador est� duplicado"); //TODO: agregar numero de error, crear una exception MiEscepcion
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