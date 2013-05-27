<?php
class viajeModelo extends Modelo{
	var $tabla="trans_viaje";
	var $campos=array('id','fecha_a_entregar','contenido','direccion_de_entrega','costo','precio','fk_chofer','fk_vehiculo','fk_caja','fk_cliente','creado');
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
				
				if ( !empty( $art['eliminado'] ) ){
					// print_r( $art );
					$resp = $gastoMod->eliminar( $art );
					
					// print_r($resp);
				}else{
					unset( $art['eliminado'] ) ;
					// if ( !empty($art['idarticulo']) )
					$resp=$gastoMod->guardar( $art );
					
					if ( !$resp['success'] ) echo json_encode( $resp['msg'] );
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
		return parent::obtener($params);
	}
	function buscar($params){
		return parent::buscar($params);
	}
}
?>