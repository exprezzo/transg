PantallaConsumo=function(){
	this.init=function(params){
		this.tabId=params.tabId;		
		var me=this;		
		
		$(this.tabId + ' [name="distancia"]').bind('change', function(){			
			me.actualizarConsumoLitros();
		});
		
		$(this.tabId + ' [name="rendimiento"]').bind('change', function(){			
			me.actualizarConsumoLitros();
			me.calcularDieselMedido();
		});
		
		$(this.tabId + ' [name="precio_por_litro"]').bind('change', function(){						
			me.actualizarConsumoPesos();
			me.calcularDieselMedido();
		});
		
		$(this.tabId + ' [name="kilometraje_inicial"]').bind('change', function(){						
			me.actualizarRecorrido();
			me.calcularDieselMedido();
		});
		
		$(this.tabId + ' [name="kilometraje_final"]').bind('change', function(){						
			me.actualizarRecorrido();
			me.calcularDieselMedido();
		});
		
		$(this.tabId + ' [name="consumo_diesel_real_pesos"]').bind('change', function(){									
			me.compararConsumos();
		});
		
		$(this.tabId + ' [name="hora_trabajo_i"]').bind('change', function(){									
			me.calcularHorasDeTrabajo();
		});
		
		$(this.tabId + ' [name="hora_trabajo_f"]').bind('change', function(){									
			me.calcularHorasDeTrabajo();
		});
		
		$(this.tabId + ' [name="horas_esperadas"]').bind('change', function(){									
			me.calcularHorasDeTrabajo();
		});
		
		
	}
	this.actualizarConsumoLitros=function(){
		var distancia=$(this.tabId + ' .frmConsumo [name="distancia"]').val();
		var rendimiento=$(this.tabId + ' .frmConsumo [name="rendimiento"]').val();
		
		var consumoLt=distancia / rendimiento;
		$(this.tabId + ' .frmConsumo [name="consumo_diesel_lt"]').val(consumoLt );
		$(this.tabId + ' .frmConsumo .calculo.consumo_diesel_lt').html( consumoLt.formatMoney(2,',','.') );
		this.actualizarConsumoPesos();
	}
	this.actualizarConsumoPesos=function(){
		var precio=$(this.tabId + ' .frmConsumo [name="precio_por_litro"]').val();
		var consumoLt=$(this.tabId + ' .frmConsumo [name="consumo_diesel_lt"]').val();
		
		var total= precio * consumoLt;
		$(this.tabId + ' .frmConsumo [name="consumo_en_pesos"]').val( total );
		$(this.tabId + ' .frmConsumo .calculo.consumo_en_pesos').html( total.formatMoney(2,',','.') );		
		
		this.compararConsumos();
	}
	this.actualizarRecorrido=function(){
		var ki=$(this.tabId + ' .frmConsumo [name="kilometraje_inicial"]').val();
		var kf=$(this.tabId + ' .frmConsumo [name="kilometraje_final"]').val();
		
		var total= kf - ki;
		$(this.tabId + ' .frmConsumo [name="kilometraje_recorrido"]').val( total );
		$(this.tabId + ' .frmConsumo .calculo.kilometraje_recorrido').html( total.formatMoney(2,',','.') );		
	}
	
	this.calcularDieselMedido=function(){
		var k=$(this.tabId + ' .frmConsumo [name="kilometraje_recorrido"]').val();
		var r=$(this.tabId + ' .frmConsumo [name="rendimiento"]').val();
		
		var consumoLt= k / r;
		
		$(this.tabId + ' .frmConsumo [name="consumo_diesel_calculado_lt"]').val( consumoLt );
		$(this.tabId + ' .frmConsumo .calculo.consumo_diesel_calculado_lt').html( consumoLt.toFixed(2) );		
		
		var p=$(this.tabId + ' .frmConsumo [name="precio_por_litro"]').val();
		var consumoPesos = consumoLt * p;
		
		$(this.tabId + ' .frmConsumo [name="consumo_diesel_calculado_pesos"]').val( consumoPesos );
		$(this.tabId + ' .frmConsumo .calculo.consumo_diesel_calculado_pesos').html( consumoPesos.formatMoney(2,',','.') );				
		
		this.compararConsumos();
	}
	
	this.compararConsumos=function(){
		// alert('compararConsumos');
		var cr=$(this.tabId + ' .frmConsumo [name="consumo_diesel_real_pesos"]').val();
		var cc=$(this.tabId + ' .frmConsumo [name="consumo_en_pesos"]').val();
		
		var calculado= cc - cr;
		
		$(this.tabId + ' .frmConsumo [name="diferencia_calculado"]').val( calculado );
		$(this.tabId + ' .frmConsumo .calculo.diferencia_calculado').html( calculado.formatMoney(2,',','.') );		
		
		var cm=$(this.tabId + ' .frmConsumo [name="consumo_diesel_calculado_pesos"]').val();
		var medido = cm - cr;
		
		$(this.tabId + ' .frmConsumo [name="diferencia_medido"]').val( medido );
		$(this.tabId + ' .frmConsumo .calculo.diferencia_medido').html( medido.formatMoney(2,',','.') );
	}
	
	this.calcularHorasDeTrabajo=function(){
		var hi=$(this.tabId + ' .frmConsumo [name="hora_trabajo_i"]').val() *1;
		var hf=$(this.tabId + ' .frmConsumo [name="hora_trabajo_f"]').val() *1;
		// alert("hi: "  + hi + " hf: " + hf);
		var horas= hf - hi;
		
		$(this.tabId + ' .frmConsumo [name="horas_trabajo"]').val( horas );
		$(this.tabId + ' .frmConsumo .calculo.horas_trabajo').html( horas.formatMoney(2,',','.') );		
		
		var he=$(this.tabId + ' .frmConsumo [name="horas_esperadas"]').val();
		var diferencia = horas - he;
		
		$(this.tabId + ' .frmConsumo [name="horas_diferencia"]').val( diferencia );
		$(this.tabId + ' .frmConsumo .calculo.horas_diferencia').html( diferencia.formatMoney(2,',','.') );
	}
}