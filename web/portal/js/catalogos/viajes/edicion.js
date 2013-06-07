var Edicionviajes = function(){
	this.editado=false;
	this.saveAndClose=false;
	this.configurarComboDestinatario=function(){
		var fk_destinatario = this.configuracion.fk_destinatario;	
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
			url: kore.mod_url_base+'viajes/buscarDestinatarios',
			dataType:"json"			
		});
		
		var datasource = new wijdatasource({
			reader:  new wijarrayreader(fields),
			proxy: proxy,			
			 loaded: function (data) {
				if (fk_destinatario>0)
				for (var i=0; i<data.data.length; i++){
					if ( data.data[i].id == fk_destinatario) {										 
						$(me.tabId + ' [name="fk_destinatario"]').wijcombobox("option","selectedIndex", -1);
						$(me.tabId + ' [name="fk_destinatario"]').wijcombobox("option","selectedIndex", i); 
						
					}				
				}
				fk_destinatario=0;
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
		
		
		
		var target=$( this.tabId+' [name="fk_destinatario"]');
		var combo=target.wijcombobox({
			data: datasource,
			showTrigger: true,
			minLength: 1,
			 selectedIndex:0,
			forceSelectionText: false,
			autoFilter: true,			
			search: function (e, obj) {},
			select: function (e, item) {							
				me.editado=true;
			}
		});		
		
		  datasource.load();	
			
	}
	this.configurarComboRemitente=function(){
		var fk_remitente = this.configuracion.fk_remitente;	
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
			url: kore.mod_url_base+'viajes/buscarRemitentes',
			dataType:"json"			
		});
		
		var datasource = new wijdatasource({
			reader:  new wijarrayreader(fields),
			proxy: proxy,			
			 loaded: function (data) {
				if (fk_remitente>0)
				for (var i=0; i<data.data.length; i++){
					if ( data.data[i].id == fk_remitente) {										 
						$(me.tabId + ' [name="fk_remitente"]').wijcombobox("option","selectedIndex", -1);
						$(me.tabId + ' [name="fk_remitente"]').wijcombobox("option","selectedIndex", i); 
						
					}				
				}
				fk_remitente=0;
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
		
		
		
		var target=$( this.tabId+' [name="fk_remitente"]');
		var combo=target.wijcombobox({
			data: datasource,
			showTrigger: true,
			minLength: 1,
			 selectedIndex:0,
			forceSelectionText: false,
			autoFilter: true,			
			search: function (e, obj) {},
			select: function (e, item) {							
				me.editado=true;
			}
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
			{name:'rendimiento'},
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
				me.editado=true;
				
				// console.log("item"); console.log(item);
				// alert(item.rendimiento);
				$(me.tabId + ' .frmConsumo [name="rendimiento"]').val(item.rendimiento);
				
				
				var cajas=new Array();
				cajas.push({
					value:item.fk_caja,
					label:item.codCaja
				});
				
				$(me.tabId + ' [name="fk_caja"]').wijcombobox('option','data',cajas);
				$(me.tabId + ' [name="fk_caja"]').wijcombobox('option','selectedIndex',0);
				
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
			select: function (e, item) 
			{							
				me.editado=true;
			}
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
		$(this.tabId + ' .frmEdicion textarea').change(function(){
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
			var serie=$(this.tabId + ' [name="fk_serie"] option:selected').text()			
			var folio=$(this.tabId + ' .lblFolio').html();
			$('a[href="'+tabId+'"]').html(serie+' - '+folio);
			
			$(this.tabId +' [name="fk_serie"]').attr('disabled','disabled')			
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
		$.each($(tabId + ' .frmGeneral').serializeArray(), function(_, kv) {
		  if (paramObj.hasOwnProperty(kv.name)) {
			paramObj[kv.name] = $.makeArray(paramObj[kv.name]);
			paramObj[kv.name].push(kv.value);
		  }
		  else {
			paramObj[kv.name] = kv.value;
		  }
		});
		
		paramObj['fk_serie'] = $(this.tabId+' [name="fk_serie"]').val();
		
		//-----------------------------------
		// alert("chofer");
		var selectedIndex = $(this.tabId+" [name='fk_chofer']").wijcombobox("option","selectedIndex");  
		var selectedItem = $(this.tabId+" [name='fk_chofer']").wijcombobox("option","data");		
		paramObj['fk_chofer']=selectedItem.data[selectedIndex]['id'];
		
		// alert("remitente");
		selectedIndex = $(this.tabId+" [name='fk_remitente']").wijcombobox("option","selectedIndex");  
		selectedItem = $(this.tabId+" [name='fk_remitente']").wijcombobox("option","data");
		paramObj['fk_remitente']=selectedItem.data[selectedIndex]['id'];
		
		// alert("destinatario");
		selectedIndex = $(this.tabId+" [name='fk_destinatario']").wijcombobox("option","selectedIndex");  
		selectedItem = $(this.tabId+" [name='fk_destinatario']").wijcombobox("option","data");
		paramObj['fk_destinatario']=selectedItem.data[selectedIndex]['id'];
		
		// alert("vehiculo");
		selectedIndex = $(this.tabId+" [name='fk_vehiculo']").wijcombobox("option","selectedIndex");  
		selectedItem = $(this.tabId+" [name='fk_vehiculo']").wijcombobox("option","data");
		paramObj['fk_vehiculo']=selectedItem.data[selectedIndex]['id'];
		
		selectedIndex = $(this.tabId+" [name='fk_caja']").wijcombobox("option","selectedIndex");  
		selectedItem = $(this.tabId+" [name='fk_caja']").wijcombobox("option","data");
		paramObj['fk_caja']=selectedItem[selectedIndex]['value'];
		//-------------------------------------
		var datos=paramObj;
		
		var gastos=$(tabId+' .grid_articulos').wijgrid('data');
		datos.gastos = gastos;
		
		//==================================================================
		paramObj = {};
		$.each($(tabId + ' .frmConsumo').serializeArray(), function(_, kv) {
		  if (paramObj.hasOwnProperty(kv.name)) {
			paramObj[kv.name] = $.makeArray(paramObj[kv.name]);
			paramObj[kv.name].push(kv.value);
		  }
		  else {
			paramObj[kv.name] = kv.value;
		  }
		});
		//-----------------------------------
		datosConsumo=paramObj;
		//==================================================================
		//Envia los datos al servidor, el servidor responde success true o false.
		
		$.ajax({
			type: "POST",
			url: kore.url_base+this.configuracion.modulo.nombre+'/'+this.controlador.nombre+'/guardar',
			data: { datos: datos, consumo:datosConsumo}
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
				tab.find('.frmGeneral [name="'+me.configuracion.pk+'"]').val(resp.datos[me.configuracion.pk]);
				tab.find('.frmConsumo [name="id"]').val(resp.consumo[me.configuracion.pk]);
				
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
					TabManager.cerrarTab(idTab);					
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
		this.configurarComboRemitente();
		this.configurarComboDestinatario();
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
				$( me.tabId + ' .frmEdicion.frmGeneral').fadeIn();
				$( me.tabId + ' .consumo').hide();
				$( me.tabId + ' .gastos').hide();
			});
			
			$(this.tabId + ' .toolbarEdicion .btnConsumo').click( function(){
				$( me.tabId + ' .frmEdicion.frmGeneral').hide();
				$( me.tabId + ' .consumo').fadeIn();
				$( me.tabId + ' .gastos').hide();
				// $(me.tabId+' .grid_articulos').wijgrid('ensureControl',true);
				
			});
			
			$(this.tabId + ' .toolbarEdicion .btnDetalles').click( function(){
				$( me.tabId + ' .frmEdicion.frmGeneral').hide();
				$( me.tabId + ' .consumo').hide();
				$( me.tabId + ' .gastos').fadeIn();
				$(me.tabId+' .grid_articulos').wijgrid('ensureControl',true);
				
			});			
	};	
}
