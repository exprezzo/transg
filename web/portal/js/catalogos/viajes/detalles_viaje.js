
var DetallesViaje=function (tabId){
	
		
	this.init=function(config){		
		
		var tabId=config.tabId, 
			padre = config.padre, 
			fk_viaje=config.fk_viaje, 
			articulos= config.articulos;
		
		// this.target= config.target;
		
		this.tmp_id=0;
		this.tabId=tabId;
		this.padre=padre;
		
		var params={
			targetSelector:tabId+' .grid_articulos',
			pageSize: 100,
			padre:this
		 };
		var nav= new NavegacionEnAgrupada();
		nav.init(params);
		
		this.configurarGrid(tabId, articulos);		
		 this.configurarToolbar(tabId);				
		return true;
		
	};
	
	this.configurarGrid=function(tabId, articulos){
		// alert(tabId);
		
		var fields=[			
			{ name: "id"},			
			{ name: "fk_concepto"},
			{ name: "nombreConcepto"},
			{ name: "costo"},
			{ name: "fechaa"},
			{ name: "eliminado",default:false}			
		];
		
		this.fields=fields;		
		var gridPedidos=$(tabId+" .grid_articulos");				
		
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
			data:articulos,	
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
				{dataKey: "nombre", headerText: "Concepto",width:"300px"},
				{dataKey: "costo", headerText: "Costo",editable:true, dataType: "currency",width:"150px"},
				{dataKey: "fecha", headerText: "Fecha",width:"100px"},
				{dataKey: "fk_viaje", headerText: "fk_viaje", visible:false},
				{dataKey: "fk_concepto", headerText: "fk_concepto", visible:false}
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
						if (me.articulo!=undefined){
							var row=args.cell.row();							
							row.data.costo=me.articulo.costo;							
							row.data.fk_concepto = me.articulo.value;						
							row.data.nombre = me.articulo.nombre;
							row.data.fecha = '2013-01-01';
							gridPedidos.wijgrid('ensureControl',true);
							
						}
						// me.padre.editado=true;
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
			
			var costo=0;
			for(var i=0; i<datos.length; i++ ){
				if ( !datos[i].eliminado ) costo+= ( datos[i].costo * 1);				
			}
			
			$(me.tabId+' [name="costo"]').val(costo);
			$(me.tabId+' .lblGasto').html(costo);
			
		}}); 

		gridPedidos.wijgrid({cancelEdit:function(){				
				$(me.tabId+' .grid_articulos').wijgrid('ensureControl',true);
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
		this.numCols=$(tabId+' .grid_articulos thead th').length;		
		
		// $(tabId + " .grid_articulos").on("blur", ".wijmo-wijgrid-innercell input" , function(){				
			// $(tabId + " .grid_articulos").wijgrid("endEdit");			
		// });
	};
	
	this.recuperar=function(){
		
		var cellInfo= $(this.tabId+" .grid_articulos").wijgrid("currentCell");
		var row = cellInfo.row();
		var container=cellInfo.container();
		$(this.tabId+" .grid_articulos 	tbody tr:eq("+cellInfo.rowIndex()+")").removeClass('eliminado');		
		row.data.eliminado=false;
		$(this.tabId+" .grid_articulos").wijgrid("ensureControl", true);
		
	}
	this.eliminar=function(){
		
		var cellInfo= $(this.tabId+" .grid_articulos").wijgrid("currentCell");
		var row = cellInfo.row();
		var container=cellInfo.container();
		$(this.tabId+" .grid_articulos 	tbody tr:eq("+cellInfo.rowIndex()+")").addClass('eliminado');		
		row.data.eliminado=true;
		$(this.tabId+" .grid_articulos").wijgrid("ensureControl", true);
		
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
		cellInfo= $(tabId+" .grid_articulos").wijgrid("currentCell");
		
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
			var data = $(tabId+" .grid_articulos").wijgrid('data');
			var pageSize = $(tabId+" .grid_articulos").wijgrid('option','pageSize');
			var pageIndex = $(tabId+" .grid_articulos").wijgrid('option','pageIndex');
			
			dataItemIndex = row.dataItemIndex;
			var fi= (pageSize * pageIndex);
						
			if ( dataItemIndex == fi){
				if (pageIndex==0){
					return false;
				}
				$(tabId+" .grid_articulos").wijgrid('option','pageIndex',pageIndex-1);
				nextCell=0;
				nextRow=pageSize*2;
			}
			
			nextCell=this.numCols-1;
			nextRow	= nextRow - 1;
			
			var cell;

			if (nextCell>-1 && nextRow>-1){
				while (true)
				 {
					cell = $(tabId+" .grid_articulos").wijgrid('currentCell',nextCell, nextRow);
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
			var data = $(tabId+" .grid_articulos").wijgrid('data');			 
			var pageSize = $(tabId+" .grid_articulos").wijgrid('option','pageSize');
			var pageIndex = $(tabId+" .grid_articulos").wijgrid('option','pageIndex');			 
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
				$(tabId+" .grid_articulos").wijgrid("ensureControl", true);
				$(tabId+" .grid_articulos").wijgrid('option','pageIndex',pageIndex+1);
			}else if ( ip==dataItemIndex ){
				//esta al final de la pagina, cambiar de página
				nextCell=0;
				nextRow=-1;
				$(tabId+" .grid_articulos").wijgrid('option','pageIndex',pageIndex+1);				
			}
						
			nextRow	= nextRow + 1;			
			var cell;
			
			while (true)
			 {
				cell = $(tabId+" .grid_articulos").wijgrid('currentCell',nextCell, nextRow);
				if (cell.column == undefined ){
					nextRow++;
				}else{						
					break;
				}
			}
			
		}
		
		
		var nuevo = $(tabId+" .grid_articulos").wijgrid("currentCell",nextCell, nextRow);
		
		if ( nuevo.column().editable===false ){
			this.seleccionarSiguiente(alreves);
		}else{			
			$(tabId+" .grid_articulos").wijgrid("beginEdit");					
		}
		
		
		
	};
	
	this.configurarComboConcepto=function(target){		
		// alert(cantidad);
		
		var tabId=this.tabId;
		var me=this;
		var fields=[										
			{name: 'costo'},
			{name: 'label',mapping: 'nombre'}, 
			{name: 'value',mapping: 'id'}, 
			{name: 'selected',defaultValue: false}
		];
		
		var myReader = new wijarrayreader(fields);
		
		var proxy = new wijhttpproxy({
			url: kore.mod_url_base+'viajes/buscarConceptos',
			dataType:"json"			
		});
		
		var datasource = new wijdatasource({
			reader:  new wijarrayreader(fields),
			proxy: proxy,
			loaded: function (data) {},
			loading: function (dataSource, userData) {                            								
				dataSource.proxy.options.data=dataSource.proxy.options.data || {};				 
				dataSource.proxy.options.data.nombre = (userData) ?  userData.value : '';				 
            }
		});
		
		datasource.reader.read= function (datasource) {			
			var totalRows=datasource.data.totalRows;			
			datasource.data = datasource.data.rows;
			datasource.data.totalRows = totalRows;
			myReader.read(datasource);
		};			
		
		datasource.load();	
		
		var combo=target.wijcombobox({
			data: datasource,
			showTrigger: true,
			minLength: 1,
			forceSelectionText: false,
			autoFilter: true,			
			search: function (e, obj) {},
			select: function (e, item) 
			{			
				var rowdom=$(me.tabId+' .grid_articulos tbody tr:eq('+me.selected.sectionRowIndex +')');								
				item.costo*=1;				
				me.articulo=item;
				
				
				rowdom.find('td:eq(1) div').html( '$'+item.costo.formatMoney(2,',','.') );
				rowdom.find('td:eq(2) div').html( 0 );
				// rowdom.find('td:eq(2) div').html(item.nombre);
								
				// rowdom.find('td:eq(4) div').html( '$'+item.costo.formatMoney(2,',','.') );
				// rowdom.find('td:eq(5) div').html( '$'+item.subtotal.formatMoney(2,',','.') );
				// rowdom.find('td:eq(6) div').html( '$'+iva.formatMoney(2,',','.') );
				// rowdom.find('td:eq(7) div').html( '$'+item.total.formatMoney(2,',','.') );
				return true;
			}
		});
		combo.focus().select();			
	};
	
	this.nuevo=function(){	
		var rec={};
		$.each( this.fields, function(indexInArray, valueOfElement){
			var campo=valueOfElement.name;
			rec[campo]='';
		
		} );
		
		var nuevo=new Array(rec);
		
		var tabId=this.tabId;		
		var data= $(tabId+" .grid_articulos").wijgrid('data');									
		this.tmp_id++;
		nuevo[0].tmp_id=this.tmp_id;
		var array3 = nuevo.concat(data); // Merges both arrays
		data.length=0;
		for(var i=0; i<array3.length; i++){
			data.push( array3[i] );
		}

		$(tabId+" .grid_articulos").wijgrid("ensureControl", true);
		$(tabId+" .grid_articulos").wijgrid('option','pageIndex',0);			 
		nuevo = $(tabId+" .grid_articulos").wijgrid("currentCell", 0, 0);
		$(tabId+" .grid_articulos").wijgrid("beginEdit");		
	};
	
	
	
	this.configurarToolbar=function(tabId){
		var me=this;				
		
		$( me.tabId +  " .btnAgregar" )
			  .button()
			  .click(function( event ) {
					me.nuevo();			
			  });
	}
}