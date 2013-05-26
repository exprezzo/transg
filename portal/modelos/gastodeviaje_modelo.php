<?php
class gastodeviajeModelo extends Modelo{
	var $tabla="trans_viaje_gasto";
	var $campos=array('id','fk_viaje','fk_concepto','costo','fecha');
	var $pk="id";
	
	function nuevo($params){
		return parent::nuevo($params);
	}
	
	function guardar($params){
		return parent::guardar($params);
	}
	
	function borrar($params){
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
			$sql = 'SELECT c.nombre, vd.* FROM '.$this->tabla.' vd LEFT JOIN trans_concepto c ON c.id = vd.fk_concepto '.$filtros.' limit :start,:limit';
		}else{			
			$sql = 'SELECT c.nombre, vd.* FROM '.$this->tabla.' vd LEFT JOIN trans_concepto c ON c.id = vd.fk_concepto '.$filtros;
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
			
			$error =  $this->getError( $sth );			
			return $error;
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