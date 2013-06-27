
var EfectivoViaje=function (tabId){
	
		
	this.init=function(config){		
		
		var tabId=config.tabId, 
			padre = config.padre, 
			fk_viaje=config.fk_viaje, 
			datos= config.depositos;
		
		this.target = tabId + ' .grid_depositos';
		
		this.tmp_id=0;
		this.tabId=tabId;
		this.padre=padre;
		
		
		var params={
			targetSelector:this.target,
			pageSize: 100,
			padre:this
		 };
		var nav= new NavegacionEnAgrupada();
		nav.init(params);
		
		this.configurarGrid(tabId, datos);		
		 this.configurarToolbar(tabId);				
		return true;
		
	};
	
	this.configurarGrid=function(tabId, datos){
		// alert(tabId);
		
		var fields=[			
			{ name: "id",default:0},			
			{ name: "importe"},
			{ name: "fecha"},
			{ name: "concepto"},
			{ name: "forma_deposito"},
			{ name: "eliminado",default:false}			
		];
		
		this.fields=fields;		
		var gridPedidos=$(this.target);				
		
		var me=this;
		
		gridPedidos.bind('keydown', function(e) {
			var code = e.keyCode || e.which;
			code=parseInt( code );						
			if(e.keyCode==46 && e.shiftKey){
				me.recuperar();
			}else if(e.keyCode==46){
				me.eliminar();
			}
		});
		
		gridPedidos.wijgrid({			
			allowColSizing:true,
			allowPaging: true,
			pageSize:100,
			allowEditing:true,
			allowColMoving: false,			
			allowKeyboardNavigation:true,
			selectionMode:'singleRow',
			data:datos,	
			rowStyleFormatter: function (args) {				
				if (args.data && args.data.eliminado){
					$(args.$rows).addClass("eliminado");
				}
				// if ((args.state === $.wijmo.wijgrid.renderState.rendering) && (args.type & $.wijmo.wijgrid.rowType.dataAlt)) {
				  // args.$rows.find("td").css("font-style", "italic");
				// }
			},
			columns: [
				{dataKey: "id", visible:false, headerText: "ID"},
				{dataKey: "importe", headerText: "Importe",width:"300px", valueRequired: true, dataType: "currency"},
				{dataKey: "fecha", headerText: "Fecha",width:"300px", valueRequired: true},
				{dataKey: "concepto", headerText: "Concepto",width:"300px", valueRequired: true},
				{dataKey: "forma_deposito", headerText: "Forma Deposito",width:"300px", valueRequired: true},
				{dataKey: "fk_viaje", headerText: "fk_viaje", visible:false},
				{dataKey: "viaje", headerText: "Viaje", visible:false}
			]
		});
		var me=this;
		
		gridPedidos.wijgrid({ beforeCellEdit: function(e, args) {
				var row = args.cell.row() ;
				var index = args.cell.rowIndex();
				var sel=gridPedidos.wijgrid('selection');
				sel.addRows(index);
				
				if (args.cell.column().editable === false){
					return false;
				}

				switch (args.cell.column().dataKey) {
					case "nombre":
						var combo=
						$("<input />")
							.val(args.cell.value())
							.appendTo(args.cell.container().empty());
						args.handled = true;
						
						var domCel = args.cell.tableCell();
						combo.css('width',	$(domCel).width()-10 );
						combo.css('height',	$(domCel).height()-10 );
						me.configurarComboConcepto(combo);						
					break;
					case 'fecha':
						
						var fechaField= $("<input />")
							.val(args.cell.value())
							.appendTo(args.cell.container().empty());
						args.handled = true;
						
						var domCel = args.cell.tableCell();
						fechaField.css('width',	$(domCel).width()-10 );
						fechaField.css('height',	$(domCel).height()-10 );
						
						$(fechaField).wijinputdate({ dateFormat: 'dd/MM/yyyy',showTrigger:true });
						$(fechaField).focus().select();
					break;
					default:
						var input=$("<input />")
							.val(args.cell.value())
							.appendTo(args.cell.container().empty()).focus().select();
						var domCel = args.cell.tableCell();
						input.css('width',	$(domCel).width()  -10 );
						input.css('height',	$(domCel).height() -10 );
						args.handled = true;
						return true;
					break;
				}
			}
		});
		gridPedidos.wijgrid({beforeCellUpdate:function(e, args) {
				switch (args.cell.column().dataKey) {					
					case "nombre":
						args.value = args.cell.container().find("input").val();
						me.padre.editado=true;
						if (me.articulo!=undefined){
							var row=args.cell.row();							
							row.data.costo=me.articulo.costo;							
							row.data.fk_concepto = me.articulo.value;						
							row.data.nombre = me.articulo.nombre;
							row.data.fecha = me.articulo.fecha;
							gridPedidos.wijgrid('ensureControl',true);
							
						}
						// me.padre.editado=true;
						break;	
					case 'fecha':	
						me.padre.editado=true;
						args.value = args.cell.container().find("input").val();
						var row=args.cell.row();							
						row.data.fecha =args.value;						
						gridPedidos.wijgrid('ensureControl',true);
						
					break;
					case 'costo':
						me.padre.editado=true;
						args.value = args.cell.container().find("input").val();
						var row=args.cell.row();							
						row.data.costo =args.value;												
						gridPedidos.wijgrid('ensureControl',true);
						
					break;
					default:						
						args.value = args.cell.container().find("input").val();	
						var row=args.cell.row();						
						gridPedidos.wijgrid('ensureControl',true);						
						
				}
				me.articulo=undefined;		
			}			
		});
		
		gridPedidos.wijgrid({loaded: function () {
			var datos=gridPedidos.wijgrid('data');
			
			var depositos=0;
			for(var i=0; i<datos.length; i++ ){
				if ( !datos[i].eliminado ) depositos+= ( datos[i].importe * 1);				
			}
			
			
			// $(me.tabId+' [name="costo"]').val(costo);
			$(me.tabId+' .lblDepositos').html( "$" +depositos.formatMoney(2,',','.') );
			$(me.tabId+' [name="efectivo"]').val( depositos );
			
			me.padre.depositos=depositos;
			if ( me.padre.gastos != undefined){
				
				me.padre.diferencia = depositos - me.padre.gastos ;
				$(me.tabId+' .lblDiferencia').html( "$" +me.padre.diferencia.formatMoney(2,',','.') );
			}
			
			if ( me.padre.diferencia != undefined && me.padre.comision != undefined ){
				me.padre.pagar = me.padre.comision - me.padre.diferencia;
				$(me.tabId + ' .lblPagar').html( "$" +me.padre.pagar.formatMoney(2,',','.') );
			} 
			
			style="text-align:right;"
			
		}}); 

		gridPedidos.wijgrid({cancelEdit:function(){				
				$(me.target).wijgrid('ensureControl',true);
			}
		});
		gridPedidos.wijgrid({ selectionChanged: function (e, args) { 								
			var item=args.addedCells.item(0);						
			var row=item.row();
			var data=row.data;			
			me.selected=data;			
			me.selected.dataItemIndex=row.dataItemIndex;			
			me.selected.sectionRowIndex=row.sectionRowIndex;
			
		} });
		
		//corregir bug al expandir/colapsar
		gridPedidos.click(function(){
			
                if($(this).hasClass("ui-icon-triangle-1-e"))
                {
				   gridPedidos.wijgrid('endEdit');
					var selectionObj = gridPedidos.wijgrid("selection");
				   selectionObj.clear();
                   gridPedidos.wijgrid('doRefresh');
				   
                }
				
                else if($(this).hasClass("ui-icon-triangle-1-se"))
                {
					gridPedidos.wijgrid('endEdit');
					var selectionObj = gridPedidos.wijgrid("selection");
					selectionObj.clear();
                   gridPedidos.wijgrid('doRefresh');                   
                }
            });	
		this.numCols=$(this.target+' thead th').length;						
	};
	
	this.recuperar=function(){
		
		var cellInfo= $(this.target).wijgrid("currentCell");
		var row = cellInfo.row();
		var container=cellInfo.container();
		$(this.target+" tbody tr:eq("+cellInfo.rowIndex()+")").removeClass('eliminado');		
		row.data.eliminado=false;
		$(this.target).wijgrid("ensureControl", true);
		
	}
	this.eliminar=function(){
		
		var cellInfo= $(this.target).wijgrid("currentCell");
		var row = cellInfo.row();
		var container=cellInfo.container();
		$(this.target+" tbody tr:eq("+cellInfo.rowIndex()+")").addClass('eliminado');		
		row.data.eliminado=true;
		$(this.target).wijgrid("ensureControl", true);
		
	}
	this.navegarEnter=function(){		
		this.seleccionarSiguiente(false, true, true);		
	}
	this.seleccionarSiguiente = function(alreves, saltar, mantenerColumna){
		//dos direcciones, hacia atras y hacia adelante.
		//de la ultima caja editable de la fila, pasa a la siguiente fila.
		//si se esta navegando alreves, del primer registro editable, pasa al registro anterior.
		//si no hay otra fila, agrega un nuevo elemento.
		//si está ubicado en el ultimo elemento de la pagina, pasar a la pagina siguiente .
		//si está nvegando alrevés, y está ubicado en el primer elemento de la pagina, pasar a la pagina anterior.
		
		//Obtengo la celda seleccionada
		var tabId, cellInfo, cellIndex, rowIndex,  row, nextCell, nextRow; 
		tabId=this.tabId;
		cellInfo= $(this.target).wijgrid("currentCell");
		
		var direccion=	(alreves)? -1 : 1;
		cellIndex=cellInfo.cellIndex();
		rowIndex = cellInfo.rowIndex();
		nextRow=rowIndex;
		nextCell = cellIndex + direccion;
		
		
		if (saltar){
			nextCell=(alreves)? -1 : this.numCols + 1			
		}
		
		if ( nextCell<0 ){
			//ir al registro anterior, cambiar de pagina
			row=cellInfo.row();
			var data = $(this.target).wijgrid('data');
			var pageSize = $(this.target).wijgrid('option','pageSize');
			var pageIndex = $(this.target).wijgrid('option','pageIndex');
			
			dataItemIndex = row.dataItemIndex;
			var fi= (pageSize * pageIndex);
						
			if ( dataItemIndex == fi){
				if (pageIndex==0){
					return false;
				}
				$(this.target).wijgrid('option','pageIndex',pageIndex-1);
				nextCell=0;
				nextRow=pageSize*2;
			}
			
			nextCell=this.numCols-1;
			nextRow	= nextRow - 1;
			
			var cell;

			if (nextCell>-1 && nextRow>-1){
				while (true)
				 {
					cell = $(this.target).wijgrid('currentCell',nextCell, nextRow);
					if (cell.column == undefined ){
						nextRow--;
					}else{					
						break;
					}
				}			
			}else{
				return false;
			}
		} else if ( nextCell>=this.numCols || saltar){
			nextCell=0;
			if (mantenerColumna){
				// alert(' mantenerColumna: '+ cellIndex);
				nextCell=cellIndex;
			}
			//ir al registro siguiente, cambiar de pagina o agregar nuevo registro,
			row=cellInfo.row();			
			var data = $(this.target).wijgrid('data');			 
			var pageSize = $(this.target).wijgrid('option','pageSize');
			var pageIndex = $(this.target).wijgrid('option','pageIndex');			 
			//voy a ver si es el ultimo registro de la pagina
			dataItemIndex = row.dataItemIndex;
			var ip= (pageSize * (pageIndex+1) )-1;
			// var index = collection.indexOf(0, 0);
			// alert(index);
			//alert("pageSize: "+pageSize+" pageIndex:" + pageIndex + " dataItemIndex: " + dataItemIndex + ' ip:' + ip);			
			if ( (dataItemIndex+1) == data.length ){
				//esta en el ultimo registro de la ultima pagina
				//agregar nuevo, si esta al final de la pagina, despues de agregar registro, mover a la siguiente pagina
				var rec={};
				$.each( this.fields, function(indexInArray, valueOfElement){
					var campo=valueOfElement.name;
					rec[campo]='';				
				} );
				data.push(rec);
				//
				$(this.target).wijgrid("ensureControl", true);
				$(this.target).wijgrid('option','pageIndex',pageIndex+1);
			}else if ( ip==dataItemIndex ){
				//esta al final de la pagina, cambiar de página
				nextCell=0;
				nextRow=-1;
				$(this.target).wijgrid('option','pageIndex',pageIndex+1);				
			}
						
			nextRow	= nextRow + 1;			
			var cell;
			
			while (true)
			 {
				cell = $(this.target).wijgrid('currentCell',nextCell, nextRow);
				if (cell.column == undefined ){
					nextRow++;
				}else{						
					break;
				}
			}
			
		}
		
		
		var nuevo = $(this.target).wijgrid("currentCell",nextCell, nextRow);
		
		if ( nuevo.column().editable===false ){
			this.seleccionarSiguiente(alreves);
		}else{			
			$(this.target).wijgrid("beginEdit");					
		}
		
		
		
	};
	
	
	
	this.nuevo=function(){	
		this.padre.editado=true;
		var rec={};
		$.each( this.fields, function(indexInArray, valueOfElement){
			var campo=valueOfElement.name;
			rec[campo]='';
		
		} );
		
		var nuevo=new Array(rec);
		
		var tabId=this.tabId;		
		var data= $(this.target).wijgrid('data');									
		this.tmp_id++;
		nuevo[0].tmp_id=this.tmp_id;
		var array3 = nuevo.concat(data); // Merges both arrays
		data.length=0;
		for(var i=0; i<array3.length; i++){
			data.push( array3[i] );
		}

		$(this.target).wijgrid("ensureControl", true);
		$(this.target).wijgrid('option','pageIndex',0);			 
		nuevo = $(this.target).wijgrid("currentCell", 0, 0);
		$(this.target).wijgrid("beginEdit");		
	};
	
	
	
	this.configurarToolbar=function(tabId){
		var me=this;				
		
		$( me.tabId +  " .btnAgregarDeposito" )
			  .button()
			  .click(function( event ) {
					me.nuevo();			
			  });
	}
}