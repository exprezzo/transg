var Busquedaviajes=function(){
	this.tituloNuevo='Nueva';
	this.eliminar=function(){
	
	var me=this;
	
	var id = this.selected[this.configuracion.pk];
	var me=this;	
	var params={};
	params[this.configuracion.pk]=id;
	
	$.ajax({
			type: "POST",
			url: kore.url_base+this.configuracion.modulo.nombre+'/'+this.controlador.nombre+'/eliminar',

			data: params
		}).done(function( response ) {		
			var resp = eval('(' + response + ')');
			var msg= (resp.msg)? resp.msg : '';
			var title;
			if ( resp.success == true	){
				icon='/web/'+kore.modulo+'/images/yes.png';
				title= 'Success';				
				var gridBusqueda=$(me.tabId+" .grid_busqueda");				
				gridBusqueda.wijgrid('ensureControl', true);
			}else{
				icon= '/web/'+kore.modulo+'/images/error.png';
				title= 'Error';
			}
			
			//cuando es true, envia tambien los datos guardados.
			//actualiza los valores del formulario.
			$.gritter.add({
				position: 'bottom-left',
				title:title,
				text: msg,
				image: icon,
				class_name: 'my-sticky-class'
			});
		});
}
	this.nuevo=function(){		
		TabManager.add(kore.url_base+this.configuracion.modulo.nombre+'/'+this.controlador.nombre+'/nuevo',this.tituloNuevo);
	};
	this.activate=function(){
		// vuelve a renderear estos elementos que presentaban problemas. (correccion de bug)		
		$(this.tabId+" .lista_toolbar").removeClass('ui-tabs-hide');
		$(this.tabId+" .lista_toolbar  ~ .wijmo-wijribbon-panel").removeClass('ui-tabs-hide');		
		
	}
	this.borrar=function(){
		if (this.selected==undefined) return false;
		var r=confirm("¿Eliminar Elemento?");
		if (r==true){
		  this.eliminar();
		}
	}
	
	this.agregarClase=function(clase){
		var tabId=this.tabId;		
		var tab=$('div'+this.tabId);						
		tab.addClass(clase);		
		tab=$('a[href="'+tabId+'"]');
		tab.addClass(clase);
	}
	this.init=function(config){		
		//-------------------------------------------Al nucleo		*/		
		this.controlador=config.controlador;
		this.catalogo=config.catalogo;
		this.configuracion=config;
		//-------------------------------------------
		var tab=config.tab;		
		tabId = '#' + tab.id;
		this.tabId = tabId;
		var jTab=$('div'+tabId);				
		jTab.data('tabObj',this);		
				
		var jTab=$('a[href="'+tabId+'"]');		//// this.agregarClase('busqueda_'+this.controlador.nombre);
	    jTab.html(this.catalogo.nombre);		 
		 jTab.addClass('busqueda_'+this.controlador.nombre); 
		 this.agregarClase('tab_'+this.controlador.nombre);
		//-------------------------------------------
		$('div'+tabId).css('padding','0px 0 0 0');
		$('div'+tabId).css('margin-top','0px');
		$('div'+tabId).css('border','0 1px 1px 1px');			
		//-------------------------------------------				
		this.configurarToolbar(tabId);		
		 this.configurarGrid(tabId);
	};
	this.configurarToolbar=function(tabId){
		var me=this;
		
		$(this.tabId+ " > .lista_toolbar").wijribbon({
			click: function (e, cmd) {
				switch(cmd.commandName){
					case 'nuevo':						
						me.nuevo();
					break;
					case 'editar':
						if (me.selected!=undefined){													
							var id=me.selected[me.configuracion.pk];							
							TabManager.add(kore.url_base+me.configuracion.modulo.nombre+'/'+me.controlador.nombre+'/editar','Editar '+me.catalogo.nombre,id);
						}
					break;
					case 'eliminar':
						if (me.selected==undefined) return false;
						var r=confirm("¿Eliminar?");
						if (r==true){
						  me.eliminar();
						}
					break;
					case 'refresh':
						
						var gridBusqueda=$(me.tabId+" .grid_busqueda");
						gridBusqueda.wijgrid('ensureControl', true);
					break;
					case 'imprimir':
						alert("Imprimir en construcción");
					break;
					case 'filtros':
						$(me.tabId+" .filtros").toggle({duration:400});
						$(me.tabId + ' [name="idserie"]').wijcombobox("repaint");
						$(me.tabId + ' [name="idcliente"]').wijcombobox("repaint");
						// alert("mostrar filtros");
					break;		
					default:						 
						$.gritter.add({
							position: 'bottom-left',
							title:cmd.commandName,
							text: "Acciones del toolbar en construcci&oacute;n",
							image: '/web/'+kore.modulo+'/images/info.png',
							class_name: 'my-sticky-class'
						});
						
					break;
					
				}
				
			}
		});
		
		
		$(this.tabId + ' [name="fechai"]').wijinputdate({showTrigger:true,dateFormat:'dd/MM/yyyy'});
		$(this.tabId + ' [name="fechaf"]').wijinputdate({showTrigger:true,dateFormat:'dd/MM/yyyy'});
		// $(this.tabId + ' [name="folioi"]').wijinputnumber({decimalPlaces: 0});
		// $(this.tabId + ' [name="foliof"]').wijinputnumber({decimalPlaces: 0});
		$(this.tabId + ' [name="folioi"]').wijtextbox();
		$(this.tabId + ' [name="foliof"]').wijtextbox();
		
		$(this.tabId + ' [name="idserie"]').wijcombobox();
		$(this.tabId + ' [name="idcliente"]').wijcombobox();
		
	};
	this.configurarGrid=function(tabId){
		pageSize=10;
		
		var campos=[
			// { name: "id"  }
		];
		var dataReader = new wijarrayreader(campos);
			
		var dataSource = new wijdatasource({
			proxy: new wijhttpproxy({
				url: kore.url_base+this.configuracion.modulo.nombre+'/'+this.controlador.nombre+'/buscar',
				dataType: "json"
			}),
			dynamic:true,
			reader:new wijarrayreader(campos),
			loading: function(e, data) { 
				
				var folioi=$(me.tabId + ' [name="folioi"]').val();
				var foliof=$(me.tabId + ' [name="foliof"]').val();
				 var idserie=$(me.tabId + ' [name="idserie"]').val();
								
				//----------------------
				var idcliente=$(me.tabId + ' [name="idcliente"]').val();
				
				if (folioi!='')
				data.data.filtering.push({
					field: 'folio',
					dataKey:'folioi',
					filterOperator:'greaterorequal',
					filterValue:folioi
				});
				
				if (foliof!='')
				data.data.filtering.push({
					field: 'folio',
					dataKey:'foliof',
					filterOperator:'lessorequal',
					filterValue:foliof
				});
				
				data.data.filtering.push({
					field: 'fecha_a_entregar',
					dataKey:'fechai',
					filterOperator:'greaterorequal',
					filterValue:$(me.tabId + ' [name="fechai"]').val()
				});
				
				data.data.filtering.push({
					field: 'fecha_a_entregar',
					dataKey:'fechaf',
					filterOperator:'lessorequal',
					filterValue:$(me.tabId + ' [name="fechaf"]').val()
				});
				
				if (idcliente!=0)
				data.data.filtering.push({
					 dataKey: 'idcliente',
					 field:'v.fk_cliente',
					filterOperator:'equals',
					filterValue:idcliente
				});
				
				if (idserie!=0)
				data.data.filtering.push({
					dataKey: 'serie',
					field:'v.serie',
					filterOperator:'equals',
					filterValue:idserie
				});
				
				
			}
		});
				
		dataSource.reader.read= function (datasource) {						
			var totalRows=datasource.data.totalRows;						
			datasource.data = datasource.data.rows;
			datasource.data.totalRows = totalRows;
			dataReader.read(datasource);
		};				
		this.dataSource=dataSource;
		var gridBusqueda=$(this.tabId+" .grid_busqueda");

		var me=this;		 
		gridBusqueda.wijgrid({
			dynamic: true,
			allowColSizing:true,			
			allowKeyboardNavigation:true,
			allowPaging: true,
			pageSize:pageSize,
			selectionMode:'singleRow',
			data:dataSource,
			 showFilter:false,
			columns: [ 
			    // { dataKey: "id", hidden:true, visible:true, headerText: "ID" }						
				
{ dataKey: "id", visible:false, headerText: "Id" },
{ dataKey: "serie", visible:true, headerText: "Serie",showFilter:false,
	cellFormatter: function (args) {
		if (args.row.type & $.wijmo.wijgrid.rowType.data) {
			args.$container
				.css("text-align", "center")
				.empty()
				.append($("<div>").html( args.row.data.serie+'-'+args.row.data.folio ));
			return true; 
		} 
	} 					
					
},
{ dataKey: "fecha_a_entregar", visible:false, headerText: "Fecha E.", width:120},
{ dataKey: "human_fecha", visible:true, headerText: "Fecha E.", width:120},
{ dataKey: "fk_cliente", visible:false, headerText: "Cliente" },
{ dataKey: "cliente", visible:true, headerText: "Cliente",showFilter:false },
{ dataKey: "contenido", visible:true, headerText: "Contenido" },
{ dataKey: "direccion_de_entrega", visible:false, headerText: "Direccion_de_entrega" },
{ dataKey: "costo", visible:true, headerText: "Costo",dataType:'currency' },
{ dataKey: "precio", visible:true, headerText: "Precio",dataType:'currency' },
{ dataKey: "fk_chofer", visible:false, headerText: "Fk_chofer" },
{ dataKey: "fk_vehiculo", visible:false, headerText: "Vehiculo" },
{ dataKey: "vehiculo", visible:true, headerText: "Vehiculo" },
{ dataKey: "fk_caja", visible:false, headerText: "Fk_caja" },
{ dataKey: "fk_serie", visible:false, headerText: "folio" },

{ dataKey: "folio", visible:false, headerText: "serie" },
{ dataKey: "creado", visible:false, headerText: "Creado" }
			]
		});
		
		var me=this;
		
		gridBusqueda.wijgrid({ selectionChanged: function (e, args) { 					
			var item=args.addedCells.item(0);
			var row=item.row();
			var data=row.data;			
			me.selected=data;			
		} });
		
		gridBusqueda.wijgrid({ loaded: function (e) { 
			$(me.tabId + ' .grid_busqueda tr').bind('dblclick', function (e) { 							
				var pedidoId=me.selected[me.configuracion.pk];
				TabManager.add(kore.url_base+me.configuracion.modulo.nombre+'/'+me.controlador.nombre+'/editar','Editar '+me.catalogo.nombre,pedidoId);				
			});			
		} });
	};
};