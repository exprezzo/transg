<?php
class viajeModelo extends Modelo{
	var $tabla="trans_viaje";
	var $campos=array('id','folio','fecha_a_entregar','contenido','direccion_de_entrega','costo','precio','fk_chofer','fk_vehiculo','fk_caja','fk_cliente','creado');
	var $pk="id";
	
	function nuevo($params){
		return parent::nuevo($params);
	}
	
	
	function guardar($params){
		$gastos = ( empty($params['gastos']) )? array() : $params['gastos'];
		
		unset( $params['gastos'] );
		
		$res = parent::guardar( $params );
		
		if ( $res['success'] ){
			$gastoMod = new gastodeviajeModelo();
			// echo 'procesar detalles';
			// print_r($gastos);
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
				}else{
					unset( $art['eliminado'] ) ;
					if ( !empty($art['fk_concepto']) ){
						$resp=$gastoMod->guardar( $art );
					
						if ( !$resp['success'] ) echo json_encode( $resp['msg'] );
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
		}
		return $res;
	}
	function borrar($params){
		return parent::borrar($params);
	}
	function editar($params){
		echo 'asd';
		return $this->obtener($params);
	}
	
	function obtener($params){
	 
		
		$id=$params[$this->pk];			
		$sql = 'SELECT s.serie as nombreSerie, v.* FROM '.$this->tabla.' v LEFT JOIN trans_serie s ON s.id = v.fk_serie WHERE v.'.$this->pk.'=:id';				
		
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
		LEFT JOIN trans_cliente c ON c.id = v.fk_cliente  
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
			$sql = 'SELECT s.serie, c.razon_social as cliente,ve.codigo as vehiculo, v.*,DATE_FORMAT(v.fecha_a_entregar, "%d/%m/%Y %H:%i:%s") as human_fecha FROM '.$this->tabla.' v 
			LEFT JOIN trans_cliente c ON c.id = v.fk_cliente 
			LEFT JOIN trans_vehiculo ve ON ve.id = v.fk_vehiculo 
			LEFT JOIN trans_serie s ON s.id = v.fk_serie 
			'.$filtros.' ORDER by fecha_a_entregar DESC limit :start,:limit;';
		}else{			
			$sql = 'SELECT s.serie, c.razon_social as cliente,ve.codigo as vehiculo, v.*,DATE_FORMAT(v.fecha_a_entregar, "%d/%m/%Y %H:%i:%s") as human_fecha FROM '.$this->tabla.' v 
			LEFT JOIN trans_cliente c ON c.id = v.fk_cliente 
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