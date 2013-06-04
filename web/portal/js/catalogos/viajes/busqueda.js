var Busquedaviajes=function(){
	this.tituloNuevo='Nueva';
	this.buscar=function(){
		var gridBusqueda=$(this.tabId+" .grid_busqueda");				
		gridBusqueda.wijgrid('ensureControl', true);
	}
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
		 
		  // tab.data('tabObj',this); //Este para que?		
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
						$(me.tabId + ' [name="fk_remitente"]').wijcombobox("repaint");
						$(me.tabId + ' [name="fk_destinatario"]').wijcombobox("repaint");
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
		
		
		$(this.tabId + ' [name="fecha_c_i"]').wijinputdate({showTrigger:true,dateFormat:'dd/MM/yyyy'});
		$(this.tabId + ' [name="fecha_c_f"]').wijinputdate({showTrigger:true,dateFormat:'dd/MM/yyyy'});
		
		$(this.tabId + ' [name="fecha_e_i"]').wijinputdate({showTrigger:true,dateFormat:'dd/MM/yyyy'});
		$(this.tabId + ' [name="fecha_e_f"]').wijinputdate({showTrigger:true,dateFormat:'dd/MM/yyyy'});
		
		// $(this.tabId + ' [name="folioi"]').wijinputnumber({decimalPlaces: 0});
		// $(this.tabId + ' [name="foliof"]').wijinputnumber({decimalPlaces: 0});
		// $(this.tabId + ' [name="folioi"]').wijtextbox();
		// $(this.tabId + ' [name="foliof"]').wijtextbox();
		
		// $(this.tabId + ' [name="idserie"]').wijcombobox();
		$(this.tabId + ' [name="fk_remitente"]').wijcombobox();
		$(this.tabId + ' [name="fk_destinatario"]').wijcombobox();
		
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
				
				// var folioi=$(me.tabId + ' [name="folioi"]').val();
				// var foliof=$(me.tabId + ' [name="foliof"]').val();
				 // var idserie=$(me.tabId + ' [name="idserie"]').val();
								
				//----------------------
				var fk_remitente=$(me.tabId + ' [name="fk_remitente"]').val();
				var fk_destinatario=$(me.tabId + ' [name="fk_destinatario"]').val();
				
				// if (folioi!='')
				// data.data.filtering.push({
					// field: 'folio',
					// dataKey:'folioi',
					// filterOperator:'greaterorequal',
					// filterValue:folioi
				// });
				
				// if (foliof!='')
				// data.data.filtering.push({
					// field: 'folio',
					// dataKey:'foliof',
					// filterOperator:'lessorequal',
					// filterValue:foliof
				// });
				
				data.data.filtering.push({
					field: 'fecha_carga',
					dataKey:'fecha_c_i',
					filterOperator:'greaterorequal',
					filterValue:$(me.tabId + ' [name="fecha_c_i"]').val()
				});
				
				data.data.filtering.push({
					field: 'fecha_carga',
					dataKey:'fecha_c_f',
					filterOperator:'lessorequal',
					filterValue:$(me.tabId + ' [name="fecha_c_f"]').val()
				});
				
				data.data.filtering.push({
					field: 'fecha_de_entrega',
					dataKey:'fecha_e_i',
					filterOperator:'greaterorequal',
					filterValue:$(me.tabId + ' [name="fecha_e_i"]').val()
				});
				
				data.data.filtering.push({
					field: 'fecha_de_entrega',
					dataKey:'fecha_e_f',
					filterOperator:'lessorequal',
					filterValue:$(me.tabId + ' [name="fecha_e_f"]').val()
				});
				
				if (fk_remitente!=0)
				data.data.filtering.push({
					 dataKey: 'fk_remitente',
					 field:'v.fk_remitente',
					filterOperator:'equals',
					filterValue:fk_remitente
				});
				
				if (fk_destinatario!=0)
				data.data.filtering.push({
					 dataKey: 'fk_destinatario',
					 field:'v.fk_destinatario',
					filterOperator:'equals',
					filterValue:fk_destinatario
				});
				
				
				// if (idserie!=0)
				// data.data.filtering.push({
					// dataKey: 'serie',
					// field:'v.serie',
					// filterOperator:'equals',
					// filterValue:idserie
				// });
				
				
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
{ dataKey: "origen", visible:false, headerText: "Origen"},
{ dataKey: "remitente", visible:true, headerText: "Remitente", width:100},
{ dataKey: "fk_remitente", visible:false, headerText: "Remitente"},
{ dataKey: "fecha_a_entregar", visible:false, headerText: "Fecha E.", width:120},
{ dataKey: "human_fecha_c", visible:true, headerText: "F. Carga", width:120},
{ dataKey: "fecha_carga", visible:false, headerText: "F. Carga"},
{ dataKey: "contenido", visible:true, headerText: "Contenido" },
{ dataKey: "direccion_carga", visible:false, headerText: "Direccion de Carga" },
{ dataKey: "destino", visible:false, headerText: "Destino" },
{ dataKey: "destinatario", visible:true, headerText: "Destinatario", width:100},
{ dataKey: "fk_destinatario", visible:false, headerText: "Destinatario"},
{ dataKey: "human_fecha", visible:true, headerText: "F. Entrega", width:120},
{ dataKey: "direccion_de_entrega", visible:false, headerText: "Direccion_de_entrega" },
{ dataKey: "costo", visible:true, headerText: "Costo",dataType:'currency' },
{ dataKey: "precio", visible:true, headerText: "Precio",dataType:'currency' },
{ dataKey: "fk_chofer", visible:false, headerText: "Fk_chofer" },
{ dataKey: "fk_vehiculo", visible:false, headerText: "Vehiculo" },
{ dataKey: "vehiculo", visible:true, headerText: "Vehiculo" },
{ dataKey: "fk_caja", visible:false, headerText: "Fk_caja" },
{ dataKey: "fk_serie", visible:false, headerText: "folio" },
{ dataKey: "condiciones_de_pago", visible:false, headerText: "Condiciones" },
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