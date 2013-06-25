var Ediciongastos = function(){
	this.editado=false;
	this.saveAndClose=false;
	this.configurarComboConcepto=function(){		
		var fk_concepto = this.configuracion.fk_concepto;	
		
		var tabId=this.tabId;
		var me=this;
		var fields=[										
			{name: 'costo'},
			{name: 'label', mapping: 'nombre'}, 
			{name: 'value'}, 
			{name: 'fecha'}, 
			{name: 'selected',defaultValue: false}
		];
		
		var myReader = new wijarrayreader(fields);
		
		var proxy = new wijhttpproxy({
			url: kore.mod_url_base+'gastos/buscarConceptos',
			dataType:"json"			
		});
		
		var datasource = new wijdatasource({
			reader:  new wijarrayreader(fields),
			proxy: proxy,
			loaded: function (data) {
				var id=$(me.tabId+' [name="id"]').val();				
				id = parseInt( id );
				
				if ( id==0 || isNaN(id) && me.configuracion.conceptos && me.configuracion.viajes.conceptos > 0 ){
						
					$(me.tabId + ' [name="fk_concepto"]').wijcombobox("option","selectedIndex", -1);
					$(me.tabId + ' [name="fk_concepto"]').wijcombobox("option","selectedIndex", 0);
					var sel =$(me.tabId + ' [name="fk_concepto"]').wijcombobox("option","data").data[0];
				}else if ( id > 0 && fk_concepto>0 ){
					for (var i=0; i<data.data.length; i++){
						if ( data.data[i].id == fk_concepto) {
							$(me.tabId + ' [name="fk_concepto"]').wijcombobox("option","selectedIndex", -1);
							$(me.tabId + ' [name="fk_concepto"]').wijcombobox("option","selectedIndex", i); 
							console.log('selectedIndex: '+i);
						}				
					}
					fk_concepto=0;
				}
				me.configuracion.viajes.conceptos=new Array();
			},
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
		
		var combo=$(this.tabId + ' [name="fk_concepto"]').wijcombobox({
			data: datasource,
			showTrigger: true,
			minLength: 0,
			forceSelectionText: false,
			autoFilter: false,			
			search: function (e, obj) {},
			select: function (e, item) 
			{		
				me.editado=true;
				$(me.tabId + ' [name="costo"]').val( item.costo );
				
				// me.articulo=item;
				
				// console.log("item"); console.log(item);
				
				// rowdom.find('td:eq(1) div').html( '$'+item.costo.formatMoney(2,',','.') );
				// rowdom.find('td:eq(2) div').html( item.fecha );
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
			url: kore.mod_url_base+'gastos/buscarVehiculos',
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
				// $(me.tabId + ' .frmConsumo [name="rendimiento"]').val(item.rendimiento);
				
				
				// var cajas=new Array();
				// cajas.push({
					// value:item.fk_caja,
					// label:item.codCaja
				// });
				
				// $(me.tabId + ' [name="fk_caja"]').wijcombobox('option','data',cajas);
				// $(me.tabId + ' [name="fk_caja"]').wijcombobox('option','selectedIndex',0);
				
				return true;
			 }
		});		
		
		 datasource.load();	
			
	}
	this.configurarComboViajes=function(){
		
		var fk_viaje = this.configuracion.fk_viaje;	
		var tabId=this.tabId;
		
		var me=this;
		var fields=[													
			{name: 'label',mapping: 'viaje'}, 
			{name: 'value',mapping: 'id'},			
			{name: 'fk_vehiculo'},			
			{name: 'documento'},
			{name: 'selected',defaultValue: false}
		];
		
		var myReader = new wijarrayreader(fields);
		
		var proxy = new wijhttpproxy({
			url: kore.mod_url_base+'gastos/buscarViajes',
			dataType:"json"			
		});
		
		var datasource = new wijdatasource({
			reader:  new wijarrayreader(fields),
			proxy: proxy,			
			 loaded: function (data) {
				// return true;
				var id=$(me.tabId+' [name="id"]').val();				
				id = parseInt( id );
				
				if ( id==0 || isNaN(id) && me.configuracion.viajes && me.configuracion.viajes.length > 0 ){
						
					$(me.tabId + ' [name="fk_viaje"]').wijcombobox("option","selectedIndex", -1);
					$(me.tabId + ' [name="fk_viaje"]').wijcombobox("option","selectedIndex", 0); 
					var sel =$(me.tabId + ' [name="fk_viaje"]').wijcombobox("option","data").data[0]; 
					
					$(me.tabId + ' [name="documento"]').val(sel.documento); 
					
				}else if ( id > 0 && fk_viaje>0 ){				
					for (var i=0; i<data.data.length; i++){
						if ( data.data[i].id == fk_viaje) {										 
							$(me.tabId + ' [name="fk_viaje"]').wijcombobox("option","selectedIndex", -1);
							$(me.tabId + ' [name="fk_viaje"]').wijcombobox("option","selectedIndex", i); 
							
						}				
					}
					fk_viaje=0;
				}
				me.configuracion.viajes=new Array();
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
		
		
		
		var target=$( this.tabId+' [name="fk_viaje"]');
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
				// alert(item.documento);
				$(me.tabId + ' [name="documento"]').val(item.documento);
				
				
				// var cajas=new Array();
				// cajas.push({
					// value:item.fk_caja,
					// label:item.codCaja
				// });
				
				// $(me.tabId + ' [name="fk_caja"]').wijcombobox('option','data',cajas);
				// $(me.tabId + ' [name="fk_caja"]').wijcombobox('option','selectedIndex',0);
				
				return true;
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
		
		$(tabId+' .cerrar_tab').bind('click', function(){
			TabManager.cerrarTab( params.tab.id );
		 });
		
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
		
		this.configurarComboViajes();
		
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
			$('a[href="'+tabId+'"]').html(this.configuracion.catalogo.modelo +':'+id);
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
		//----------------------------------
		var selectedIndex = $(this.tabId+" [name='fk_vehiculo']").wijcombobox("option","selectedIndex");  
		var selectedItem = $(this.tabId+" [name='fk_vehiculo']").wijcombobox("option","data");		
		paramObj['fk_vehiculo']=selectedItem.data[selectedIndex]['id'];
		
		var selectedIndex = $(this.tabId+" [name='fk_viaje']").wijcombobox("option","selectedIndex");  
		var selectedItem = $(this.tabId+" [name='fk_viaje']").wijcombobox("option","data");		
		paramObj['fk_viaje']=selectedItem.data[selectedIndex]['id'];
		
		selectedIndex = $(this.tabId+" [name='fk_concepto']").wijcombobox("option","selectedIndex");  
		if (selectedIndex==-1){
			paramObj['fk_concepto']=0;
		}else{
			selectedItem = $(this.tabId+" [name='fk_concepto']").wijcombobox("option","data");		
			if (selectedItem.data.length > 0)
			paramObj['fk_concepto']=selectedItem.data[selectedIndex]['id'];
		}
		
		
		//-----------------------------------
		var datos=paramObj;
		
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
				
				me.actualizarTitulo();
				me.editado=false;
				var objId = '/'+me.configuracion.modulo.nombre+'/'+me.controlador.nombre+'/editar?id='+resp.datos.id;
				objId = objId.toLowerCase();
				$(me.tabId ).attr('objId',objId);				
				
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
					
					var idTab=$(me.tabId).attr('id');
					var tabs=$('#tabs > div');
					me.editado=false;
					for(var i=0; i<tabs.length; i++){
						if ( $(tabs[i]).attr('id') == idTab ){
							$('#tabs').wijtabs('remove', i);
						}
					}
				}else{
					icon= kore.url_base+'web/'+kore.modulo+'/images/error.png';
					title= 'Error';
				}
				
					
				$.gritter.add({
					position: 'bottom-left',
					title:title,
					text: msg,
					image: icon,
					class_name: 'my-sticky-class'
				});
			});
	},
	

	this.mostrarDivOtros=function(){
		$( this.tabId + ' [name="documento"]').val('');
		$( this.tabId + ' .divEspecial .otros').fadeIn();
		$( this.tabId + ' .divEspecial .vehiculo').hide();
		$( this.tabId + ' .divEspecial .viaje').hide();				
		$( this.tabId + ' .inputBox.documento').fadeIn();
	};
	this.mostrarDivVehiculo=function(){
		$( this.tabId + ' [name="documento"]').val('');
		
		
		$( this.tabId + ' .divEspecial .vehiculo').fadeIn();
		$( this.tabId + ' .divEspecial .viaje').hide();		
		$( this.tabId + ' .divEspecial .otros').hide();
		$(this.tabId + ' [name="fk_vehiculo"]').wijcombobox("repaint");
		
		$( this.tabId + ' .inputBox.documento').fadeIn();
		
	};
	this.mostrarDivViaje=function(){
		$( this.tabId + ' .divEspecial .viaje').fadeIn();
		$( this.tabId + ' .divEspecial .vehiculo').hide();
		$( this.tabId + ' .divEspecial .otros').hide();
		$( this.tabId + ' .inputBox.documento').hide();
	};
	this.configurarFormulario=function(tabId){		
		var me=this;
		$(this.tabId+' input[type="text"]').wijtextbox();		
		$(this.tabId+' textarea').wijtextbox();		
	
		this.configurarComboVehiculo();
		this.configurarComboConcepto();
		
		$(this.tabId+' [name="fk_tipo_gasto"]').wijcombobox({select:function(e, item){
			// console.log("item"); console.log(item);
			switch (parseInt (item.value) ){
			case 1:
				me.mostrarDivViaje();
				// alert("Tipo viaje");
			break;
			case 2:
				me.mostrarDivVehiculo();
				// alert("Tipo vehiculo");
			break;
			case 3:				
			default:
				me.mostrarDivOtros();
				// alert("Otro Tipo ");
			break;
			}
		}});		
		
	
		
		
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
	};	
}
