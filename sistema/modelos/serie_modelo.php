<?php
class serieModelo extends Modelo{
	var $tabla="trans_serie";
	var $campos=array('id','serie','folio_i','folio_f','sig_folio','es_default','idalmacen','proceso','idsucursal');
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
		return parent::buscar($params);
	}
	
	function obtenerSeries( $params ){
		
		$res=$this->buscar( $params ); //buscar con todos los parametros
		
		if ( empty($res['datos']) ){
			unset ( $params['idalmacen'] );
			$res=$this->buscar( $params );
		}
		
		if ( empty($res['datos']) ){
			unset ( $params['idsucursal'] );
			$res=$this->buscar( $params );
		}
		
		if ( empty($res['datos']) ){
			return array(
				'success'=>false,
				'msg'=>'No hay series disponibles'
			);
		}
		return $res;				
	}
	function asignarFolio( $params ){
		//obtiene el siguiente folio para la serie, para regresarlo al usuario, y lo incrementa
		  // print_r($params); exit;
		$con = $this->getConexion();
		
		$sql='SELECT * FROM '.$this->tabla.' WHERE '.$this->pk.'=:'.$this->pk;
		$sth = $con->prepare($sql);		
		
		$sth->bindValue(':'.$this->pk, $params[$this->pk], PDO::PARAM_INT);		
		
		$exito = $sth->execute();
		
		if ( !$exito ){			
			return $this->getError( $sth );
		}
		
		$datos = $sth->fetchAll(PDO::FETCH_ASSOC);
		$sig_folio = $datos[0]['sig_folio'] ; 

		//actualiza
		$sql='UPDATE '.$this->tabla.'  SET sig_folio=:sig_folio WHERE '.$this->pk.'=:'.$this->pk;
		$sth = $con->prepare($sql);		
		$sth->bindValue(':sig_folio', $sig_folio+1, PDO::PARAM_INT);
		$sth->bindValue(':'.$this->pk,  $params[$this->pk], PDO::PARAM_INT);
		$exito = $sth->execute();
		if ( !$exito ){			
			return $this->getError( $sth );
		}
		
		return array(
			'success'=>true,
			'sig_folio'=>$sig_folio
		);
	}
}
?>