var Edicionviajes = function(){
	this.editado=false;
	this.saveAndClose=false;
	this.configurarComboCliente=function(){
		var fk_cliente = this.configuracion.fk_cliente;	
		var tabId=this.tabId;
		
		var me=this;
		var fields=[													
			{name: 'label',mapping: 'razon_social'}, 
			{name: 'value',mapping: 'id'},
			{name: 'direccion'}, 
			{name: 'selected',defaultValue: false}
		];
		
		var myReader = new wijarrayreader(fields);
		
		var proxy = new wijhttpproxy({
			url: kore.mod_url_base+'viajes/buscarClientes',
			dataType:"json"			
		});
		
		var datasource = new wijdatasource({
			reader:  new wijarrayreader(fields),
			proxy: proxy,			
			 loaded: function (data) {
				if (fk_cliente>0)
				for (var i=0; i<data.data.length; i++){
					if ( data.data[i].id == fk_cliente) {										 
						$(me.tabId + ' [name="fk_cliente"]').wijcombobox("option","selectedIndex", -1);
						$(me.tabId + ' [name="fk_cliente"]').wijcombobox("option","selectedIndex", i); 
						
					}				
				}
				fk_cliente=0;
			 },
			loading: function (dataSource, userData) {                            								
				// dataSource.proxy.options.data=dataSource.proxy.options.data || {};				 
				// dataSource.proxy.options.data.nombre = (userData) ?  userData.label : '';				 
            }
		});
		
		datasource.reader.read= function (datasource) {			
			var totalRows=datasource.data.totalRows;			
			datasource.data = datasource.data.rows;
			datasource.data.totalRows = totalRows;
			myReader.read(datasource);
		};			
		
		
		
		var target=$( this.tabId+' [name="fk_cliente"]');
		var combo=target.wijcombobox({
			data: datasource,
			showTrigger: true,
			minLength: 1,
			 selectedIndex:0,
			forceSelectionText: false,
			autoFilter: true,			
			search: function (e, obj) {},
			// select: function (e, item) 
			// {							
				// return true;
			// }
		});		
		
		  datasource.load();	
			
	}
	this.configurarComboVehiculo=function(){
		var fk_vehiculo = this.configuracion.fk_vehiculo;	
		var tabId=this.tabId;
		
		var me=this;
		var fields=[													
			{name: 'label',mapping: 'codigo'}, 
			{name: 'value',mapping: 'id'},
			{name: 'fk_caja'}, 
			{name: 'codCaja'}, 
			{name: 'selected',defaultValue: false}
		];
		
		var myReader = new wijarrayreader(fields);
		
		var proxy = new wijhttpproxy({
			url: kore.mod_url_base+'viajes/buscarVehiculos',
			dataType:"json"			
		});
		
		var datasource = new wijdatasource({
			reader:  new wijarrayreader(fields),
			proxy: proxy,			
			 loaded: function (data) {
				if (fk_vehiculo>0)
				for (var i=0; i<data.data.length; i++){
					if ( data.data[i].id == fk_vehiculo) {										 
						$(me.tabId + ' [name="fk_vehiculo"]').wijcombobox("option","selectedIndex", -1);
						$(me.tabId + ' [name="fk_vehiculo"]').wijcombobox("option","selectedIndex", i); 
						
					}				
				}
				fk_vehiculo=0;
			 },
			loading: function (dataSource, userData) {                            								
				// dataSource.proxy.options.data=dataSource.proxy.options.data || {};				 
				// dataSource.proxy.options.data.nombre = (userData) ?  userData.label : '';				 
            }
		});
		
		datasource.reader.read= function (datasource) {			
			var totalRows=datasource.data.totalRows;			
			datasource.data = datasource.data.rows;
			datasource.data.totalRows = totalRows;
			myReader.read(datasource);
		};			
		
		
		
		var target=$( this.tabId+' [name="fk_vehiculo"]');
		var combo=target.wijcombobox({
			data: datasource,
			showTrigger: true,
			minLength: 1,
			 selectedIndex:0,
			forceSelectionText: false,
			autoFilter: true,			
			search: function (e, obj) {},
			select: function (e, item) 
			 {							
				console.log("item"); console.log(item);
				alert("Seleccionar caja del carro, si no tiene, no seleccionar ninguna");
				
				var vaja={
					id:1,
					codigo:'CODIGO DE CAJA'
				}
				
				
				return true;
			 }
		});		
		
		 datasource.load();	
			
	}
	this.configurarComboChofer=function(choferes){
		var fk_chofer = this.configuracion.fk_chofer;
		
		var tabId=this.tabId;
		
		
		var me=this;
		var fields=[										
			{name: 'nss'},
			{name: 'label',mapping: 'nombre'}, 
			{name: 'value',mapping: 'id'}, 
			{name: 'cuenta'}, 
			{name: 'selected',defaultValue: false}
		];
		
		var myReader = new wijarrayreader(fields);
		
		var proxy = new wijhttpproxy({
			url: kore.mod_url_base+'viajes/buscarChoferes',
			dataType:"json"			
		});
		
		var datasource = new wijdatasource({
			reader:  new wijarrayreader(fields),
			proxy: proxy,
			data:choferes,
			 loaded: function (data) {
				if (fk_chofer>0)
				for (var i=0; i<data.data.length; i++){
					if ( data.data[i].id == fk_chofer) {										 
						$(me.tabId + ' [name="fk_chofer"]').wijcombobox("option","selectedIndex", -1);
						$(me.tabId + ' [name="fk_chofer"]').wijcombobox("option","selectedIndex", i); 
						
					}				
				}
				fk_chofer=0;
			 },
			loading: function (dataSource, userData) {                            								
				// dataSource.proxy.options.data=dataSource.proxy.options.data || {};				 
				// dataSource.proxy.options.data.nombre = (userData) ?  userData.label : '';				 
            }
		});
		
		datasource.reader.read= function (datasource) {			
			var totalRows=datasource.data.totalRows;			
			datasource.data = datasource.data.rows;
			datasource.data.totalRows = totalRows;
			myReader.read(datasource);
		};			
		
		
		
		var target=$( this.tabId+' [name="fk_chofer"]');
		var combo=target.wijcombobox({
			data: datasource,
			showTrigger: true,
			minLength: 1,
			 selectedIndex:0,
			forceSelectionText: false,
			autoFilter: true,			
			search: function (e, obj) {},
			// select: function (e, item) 
			// {							
				// return true;
			// }
		});		
		
		  datasource.load();	
			
	}
	
	
	this.borrar=function(){		
		var r=confirm("¿Eliminar Elemento?");
		if (r==true){
		  this.eliminar();
		}
	}
	this.activate=function(){
		var tabId=this.tabId;
		
	}
	this.close=function(){
		
		if (this.editado){
			var res=confirm('¿Guardar antes de salir?');
			if (res===true){
				this.saveAndClose=true;
				this.guardar();
				return false;
			}else{
				return true
			}
		}else{
			return true;
		}
	};
	this.init=function(params){
		this.controlador=params.controlador;
		this.catalogo=params.catalogo;
		this.configuracion=params;
		
		var tabId='#'+params.tab.id;
		var objId=params.objId;
		
		this.tabId= tabId;		
		
		
		var tab=$('div'+this.tabId);
		//estas dos linas deben estar en la hoja de estilos
		tab.css('padding','0');
		tab.css('border','0 1px 1px 1px');
		
		this.agregarClase('frm'+this.controlador.nombre);		
		this.agregarClase('tab_'+this.controlador.nombre);
		
		this.configurarFormulario(this.tabId);
		this.configurarToolbar(this.tabId);		
		// this.notificarAlCerrar();			
		this.actualizarTitulo();				
		
		var me=this;
		$(this.tabId + ' .frmEdicion input').change(function(){
			me.editado=true;		
		});
		
		$(tabId+' .toolbarEdicion .boton:not(.btnPrint, .btnEmail)').mouseenter(function(){
			$(this).addClass("ui-state-hover");
		});
		
		$(tabId+' .toolbarEdicion .boton *').mouseenter(function(){						
			 $(this).parent('.boton').addClass("ui-state-hover");						
		});
		
		$(tabId+' .toolbarEdicion .boton').mouseleave(function(e){			 
				$(this).removeClass("ui-state-hover");			
		});
		
		  tab.data('tabObj',this); //Este para que?		
	};
	//esta funcion pasara al plugin
	//agrega una clase al panel del contenido y a la pesta�a relacionada.
	
	this.agregarClase=function(clase){
		var tabId=this.tabId;		
		var tab=$('div'+this.tabId);						
		tab.addClass(clase);		
		tab=$('a[href="'+tabId+'"]');
		tab.addClass(clase);
	}
	this.notificarAlCerrar=function(){
		var tabId = this.tabId;
		var me=this;
		 $('#tabs > ul a[href="'+tabId+'"] + span').click(function(e){
			e.preventDefault();
			 var tmp=$(me.tabId+' .txtIdTmp');				
			if (tmp.length==1){
				var id=$(tmp[0]).val();				
				$.ajax({
					type: "POST",
					url: '/'+me.configuracion.modulo.nombre+'/'+me.controlador.nombre+'/cerrar',
					data: { id:id }
				}).done(function( response ) {
					
				});
			}	
		 });
	}
	this.actualizarTitulo=function(){
		var tabId = this.tabId;		
		var id = $(this.tabId + ' [name="'+this.configuracion.pk+'"]').val();
		if (id>0){
			var serie=$(this.tabId + ' .lblSerie').html();
			var folio=$(this.tabId + ' .lblFolio').html();
			$('a[href="'+tabId+'"]').html(serie+' - '+folio);
		}else{
			$('a[href="'+tabId+'"]').html('Nuevo');
		}
	}
	this.nuevo=function(){
		var tabId=this.tabId;
		var tab = $('#tabs '+tabId);
		$('a[href="'+tabId+'"]').html('Nuevo');
		tab.find('.txtId').val(0);
		me.editado=false;
	};	
	this.guardar=function(){
		var tabId=this.tabId;
		var tab = $('#tabs '+tabId);
		var me=this;
	
		//-----------------------------------
		// http://stackoverflow.com/questions/2403179/how-to-get-form-data-as-a-object-in-jquery
		var paramObj = {};
		$.each($(tabId + ' .frmEdicion').serializeArray(), function(_, kv) {
		  if (paramObj.hasOwnProperty(kv.name)) {
			paramObj[kv.name] = $.makeArray(paramObj[kv.name]);
			paramObj[kv.name].push(kv.value);
		  }
		  else {
			paramObj[kv.name] = kv.value;
		  }
		});
		//-----------------------------------
		var selectedIndex = $(this.tabId+" [name='fk_chofer']").wijcombobox("option","selectedIndex");  
		var selectedItem = $(this.tabId+" [name='fk_chofer']").wijcombobox("option","data");		
		paramObj['fk_chofer']=selectedItem.data[selectedIndex]['id'];
		
		selectedIndex = $(this.tabId+" [name='fk_cliente']").wijcombobox("option","selectedIndex");  
		selectedItem = $(this.tabId+" [name='fk_cliente']").wijcombobox("option","data");
		paramObj['fk_cliente']=selectedItem.data[selectedIndex]['id'];
		
		selectedIndex = $(this.tabId+" [name='fk_vehiculo']").wijcombobox("option","selectedIndex");  
		selectedItem = $(this.tabId+" [name='fk_vehiculo']").wijcombobox("option","data");
		paramObj['fk_vehiculo']=selectedItem.data[selectedIndex]['id'];
		//-------------------------------------
		var datos=paramObj;
		
		var gastos=$(tabId+' .grid_articulos').wijgrid('data');
		datos.gastos = gastos;
		
		//Envia los datos al servidor, el servidor responde success true o false.
		
		$.ajax({
			type: "POST",
			url: kore.url_base+this.configuracion.modulo.nombre+'/'+this.controlador.nombre+'/guardar',
			data: { datos: datos}
		}).done(function( response ) {
			
			var resp = eval('(' + response + ')');
			var msg= (resp.msg)? resp.msg : '';
			var title;
			
			if ( resp.success == true	){
				if (resp.msgType!=undefined && resp.msgType == 'info'){
					icon=kore.url_base+'web/'+kore.modulo+'/images/yes.png';
				}else{
					icon=kore.url_base+'web/'+kore.modulo+'/images/info.png';
				}
				
				title= 'Success';				
				// tab.find('[name="'+me.configuracion.pk+'"]').val(resp.datos[me.configuracion.pk]);
				tab.find('[name="'+me.configuracion.pk+'"]').val(resp.datos[me.configuracion.pk]);

				tab.find('.lblFolio').html(resp.datos['folio']);
				
				me.actualizarTitulo();
				me.editado=false;
				var objId = '/'+me.configuracion.modulo.nombre+'/'+me.controlador.nombre+'/editar?id='+resp.datos.id;
				objId = objId.toLowerCase();
				$(me.tabId ).attr('objId',objId);				
				
				
				var articulos=resp.datos.gastos;
				var grid=$(me.tabId+" .grid_articulos");
				var data=grid.wijgrid('data');
				data.length=0;
				for(var i=0; i<articulos.length; i++){
					data.push(articulos[i]);
				}
				grid.wijgrid('ensureControl', true);
				
				$.gritter.add({
					position: 'bottom-left',
					title:title,
					text: msg,
					image: icon,
					class_name: 'my-sticky-class'
				});
				
				if (me.saveAndClose===true){
					//busca el indice del tab
					var idTab=$(me.tabId).attr('id');
					var tabs=$('#tabs > div');
					for(var i=0; i<tabs.length; i++){
						if ( $(tabs[i]).attr('id') == idTab ){
							$('#tabs').wijtabs('remove', i);
						}
					}
				}
			}else{
				icon= kore.url_base+'web/'+kore.modulo+'/images/error.png';
				title= 'Error';					
				$.gritter.add({
					position: 'bottom-left',
					title:title,
					text: msg,
					image: icon,
					class_name: 'my-sticky-class'
				});
			}
			
			//cuando es true, envia tambien los datos guardados.
			//actualiza los valores del formulario.
			
		});
	};	
	this.eliminar=function(){
		var id = $(this.tabId + ' [name="'+this.configuracion.pk+'"]').val();
		var me=this;		
		var params={};
		params[this.configuracion.pk]=id;
		
		$.ajax({
				type: "POST",
				url: kore.url_base+me.configuracion.modulo.nombre+'/'+me.controlador.nombre+'/eliminar',

				data: params
			}).done(function( response ) {		
				var resp = eval('(' + response + ')');
				var msg= (resp.msg)? resp.msg : '';
				var title;
				if ( resp.success == true	){					
					icon=kore.url_base+'web/'+kore.modulo+'/images/yes.png';
					title= 'Success';									
				}else{
					icon= kore.url_base+'web/'+kore.modulo+'/images/error.png';
					title= 'Error';
				}
				
				//cuando es true, envia tambien los datos guardados.
				//actualiza los valores del formulario.
				var idTab=$(me.tabId).attr('id');
				var tabs=$('#tabs > div');
				me.editado=false;
				TabManager.cerrarTab(idTab);
				
				$.gritter.add({
					position: 'bottom-left',
					title:title,
					text: msg,
					image: icon,
					class_name: 'my-sticky-class'
				});
			});
	},	
	this.configurarFormulario=function(tabId){		
		var me=this;
		$(this.tabId+' input[type="text"]').wijtextbox();		
		$(this.tabId+' textarea').wijtextbox();					
		this.configurarComboChofer(this.configuracion.choferes);
		this.configurarComboCliente();
		this.configurarComboVehiculo();
	};
	this.configurarToolbar=function(tabId){					
			var me=this;			
			$(this.tabId + ' .toolbarEdicion .btnGuardar').click( function(){
				me.guardar();
				me.editado=true;
			});
			
			$(this.tabId + ' .toolbarEdicion .btnDelete').click( function(){
				var r=confirm("¿Eliminar?");
				if (r==true){
				  me.eliminar();
				  me.editado=true;
				}
			});
			
			$(this.tabId + ' .toolbarEdicion .btnGeneral').click( function(){
				$( me.tabId + ' .frmEdicion').fadeIn();
				$( me.tabId + ' .consumo').hide();
				$( me.tabId + ' .gastos').hide();
			});
			
			$(this.tabId + ' .toolbarEdicion .btnConsumo').click( function(){
				alert("En construcción");
				// $( me.tabId + ' .frmEdicion').hide();
				// $( me.tabId + ' .consumo').fadeIn();
				// $( me.tabId + ' .gastos').hide();
				
			});
			
			$(this.tabId + ' .toolbarEdicion .btnDetalles').click( function(){
				$( me.tabId + ' .frmEdicion').hide();
				$( me.tabId + ' .consumo').hide();
				$( me.tabId + ' .gastos').fadeIn();
				$(me.tabId+' .grid_articulos').wijgrid('ensureControl',true);
				
			});			
	};	
}
