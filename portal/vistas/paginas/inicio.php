<?php
if ( !isset($_SESSION['isLoged'])|| $_SESSION['isLoged']!=true ){	
	header ('Location: /portal/usuarios/login'); exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="us">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title><?php echo $APP_CONFIG['nombre']; ?></title>
	<!--jQuery References-->
	
	<script src="<?php echo $_APP_PATH; ?>web/libs/jquery-1.8.3.js"></script>
	<script src="<?php echo $_APP_PATH; ?>web/libs/jquery-ui-1.9.2.custom/jquery-ui-1.9.2.custom.js"></script>  
	
	
	<!--Theme-->
	
	<?php 
		global $_TEMAS;
		//$rutaTema=$_TEMAS[TEMA];
		
		$rutaTema=getUrlTema('artic');
		$rutaTema=getUrlTema($APP_CONFIG['tema']);
		
		$rutaMod=$APP_URL_BASE.'web/<?php echo $_PETICION->modulo; ?>/css/mods/black-tie/black-tie.css';
	?>
	
	<link href="<?php echo $rutaTema; ?>" rel="stylesheet" type="text/css" />
	
	<!--Wijmo Widgets CSS-->	
	<link href="<?php echo $_APP_PATH; ?>web/libs/Wijmo.2.3.2/Wijmo-Complete/css/jquery.wijmo-complete.2.3.2.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $_APP_PATH; ?>web/libs/Wijmo.2.3.2/Wijmo-Open/css/jquery.wijmo-open.2.3.2.css" rel="stylesheet" type="text/css" />			
	<!--link href="/css/themes/blitzer/jquery-ui-1.9.2.custom.css" rel="stylesheet"-->	
	<!--Wijmo Widgets JavaScript-->
	<script src="<?php echo $_APP_PATH; ?>web/libs/Wijmo.2.3.2/Wijmo-Complete/js/jquery.wijmo-complete.all.2.3.2.js" type="text/javascript"></script>
	<script src="<?php echo $_APP_PATH; ?>web/libs/Wijmo.2.3.2/Wijmo-Open/js/jquery.wijmo-open.all.2.3.2.js" type="text/javascript"></script>		
	<!-- Gritter -->
	<link href="<?php echo $_APP_PATH; ?>web/libs/Gritter-master/css/jquery.gritter.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo $_APP_PATH; ?>web/libs/Gritter-master/js/jquery.gritter.min.js" type="text/javascript"></script>
	
	<link href="<?php echo $_APP_PATH; ?>backend/backend/cssmenu" rel="stylesheet" type="text/css" />
	
	<link href="<?php echo $MOD_WEB_PATH; ?>css/estilos.css" rel="stylesheet" type="text/css" />	
	<script src="<?php echo $_APP_PATH; ?>web/libs/shortcut.js"></script>  
	
	<script src="<?php echo $_APP_PATH; ?>web/modulos/backend/js/funciones.js" type="text/javascript"></script>
	<script src="<?php echo $_APP_PATH; ?>web/modulos/backend/js/navegacion_en_tabla_agrupada.js" type="text/javascript"></script>
	<script src="<?php echo $_APP_PATH; ?>web/portal/js/TabManager.js" type="text/javascript"></script>
	
	<script type="text/javascript">		
		kore={
			modulo:'<?php echo $_PETICION->modulo; ?>',
			controlador:'<?php echo $_PETICION->controlador; ?>',
			accion:'<?php echo $_PETICION->accion; ?>',
			url_base:'<?php echo $APP_URL_BASE; ?>',
			mod_url_base:'<?php echo $APP_URL_BASE.$_PETICION->modulo.'/'; ?>',
			decimalPlacesMoney:2
			// dafault:{
				// modulo:
				// controlador:
				// accion:
			// }			
		};
		
		salir=function(){		
			window.location=kore.mod_url_base+'usuarios/logout';
		}
		$(function () {						
		
			shortcut.add("Ctrl+Alt+V", 
				function() { 
					TabManager.add(kore.mod_url_base+'viajes/nuevo','Viajes',0);
					
				}, 
				{ 'type':'keydown', 'propagate':false, 'target':document}
			);
			
			shortcut.add("Ctrl+Alt+SHIFT+V", 
				function() { 
					TabManager.add(kore.mod_url_base+'viajes/busqueda','Viajes',1);
					
				}, 
				{ 'type':'keydown', 'propagate':false, 'target':document}
			);
			
			shortcut.add("Ctrl+Alt+D", 
				function() { 
					TabManager.add(kore.mod_url_base+'gastos/nuevo','Nuevo Gasto',0);
					
				}, 
				{ 'type':'keydown', 'propagate':false, 'target':document}
			);
			
			shortcut.add("Ctrl+Alt+SHIFT+D", 
				function() { 
					TabManager.add(kore.mod_url_base+'gastos/busqueda','Gastos',1);
					
				}, 
				{ 'type':'keydown', 'propagate':false, 'target':document}
			);
			
			
			
			shortcut.add("Ctrl+Alt+A", 
				function() { 
					TabManager.add(kore.mod_url_base+'paginas/ayuda','Ayuda',1);
					
				}, 
				{ 'type':'keydown', 'propagate':false, 'target':document}
			);
			
			shortcut.add("Ctrl+Alt+M", 
				function() { 
					TabManager.add(kore.mod_url_base+'paginas/home','Menu',1);
					
				}, 
				{ 'type':'keydown', 'propagate':false, 'target':document}
			);
			
			shortcut.add("Ctrl+Alt+X", 
				function() { 
					//busca el tab seleccionado
					var tab=$('#tabs > .wijmo-wijtabs-content > div[aria-hidden="false"]');
					if (tab.length ==0) tab=$('#tabs > div[aria-hidden="false"]');					
					var idTab=tab.attr('id');					
					var tabs=$('#tabs > div');
					if (idTab != undefined) TabManager.cerrarTab(idTab);					
				},
				{ 'type':'keydown', 'propagate':false, 'target':document} 
			); 
			
			shortcut.add("Ctrl+Alt+G", 
				function() { 
					//busca el tab seleccionado
					var tab=$('#tabs > .wijmo-wijtabs-content > div[aria-hidden="false"]');
					if (tab.length ==0) tab=$('#tabs > div[aria-hidden="false"]');										
					var tabObj = tab.data('tabObj');
					if (tabObj!=undefined && tabObj.guardar!=undefined){
						tabObj.guardar();
					}
					
				}, 
				{ 'type':'keydown', 'propagate':false, 'target':document}
			);
			
			shortcut.add("Ctrl+Alt+R", 
				function() { 
					//busca el tab seleccionado
					var tab=$('#tabs > .wijmo-wijtabs-content > div[aria-hidden="false"]');
					if (tab.length ==0) tab=$('#tabs > div[aria-hidden="false"]');										
					var tabObj = tab.data('tabObj');
					if (tabObj!=undefined && tabObj.buscar!=undefined){
						tabObj.buscar();
					}
					
				}, 
				{ 'type':'keydown', 'propagate':false, 'target':document}
			);
			
			shortcut.add("Ctrl+Alt+B", 
				function() { 
					var tab=$('#tabs > .wijmo-wijtabs-content > div[aria-hidden="false"]');
					if (tab.length ==0) tab=$('#tabs > div[aria-hidden="false"]');										
					var tabObj = tab.data('tabObj');					
					if (tabObj!=undefined && tabObj.borrar!=undefined){
						tabObj.borrar();
					}
					
					if (tabObj!=undefined && tabObj.eliminar!=undefined){						
					}
					
				}, 
				{ 'type':'keydown', 'propagate':false, 'target':document} 
			); 
			
			
			shortcut.add("Ctrl+Alt+L", 
				function() { 
					TabManager.add(kore.mod_url_base+'clientes/busqueda','Clientes', 1);
					
				}, 
				{ 'type':'keydown', 'propagate':false, 'target':document}
			);
			
			shortcut.add("Ctrl+Alt+C", 
				function() { 
					TabManager.add(kore.mod_url_base+'conceptos/busqueda','Conceptos',1);
					
				}, 
				{ 'type':'keydown', 'propagate':false, 'target':document}
			);
			
			shortcut.add("Ctrl+Alt+J", 
				function() { 
					TabManager.add(kore.mod_url_base+'cajas/busqueda','Cajas',1);
					
				}, 
				{ 'type':'keydown', 'propagate':false, 'target':document}
			);
			
			
			shortcut.add("Ctrl+Alt+T", 
				function() { 
					TabManager.add(kore.mod_url_base+'vehiculos/busqueda','Vehiculos',1);
					
				}, 
				{ 'type':'keydown', 'propagate':false, 'target':document}
			);
			
			shortcut.add("Ctrl+Alt+F", 
				function() { 
					TabManager.add(kore.mod_url_base+'choferes/busqueda','Choferes', 1);
					
				}, 
				{ 'type':'keydown', 'propagate':false, 'target':document}
			);
			
			
			
			
			
			
			shortcut.add("Ctrl+Alt+N", 
				function() { 
					var tab=$('#tabs > div[aria-hidden="false"]');
					var tabObj = tab.data('tabObj');
					if (tabObj!=undefined && tabObj.nuevo!=undefined){
						tabObj.nuevo();
					}
					
				}, 
				{ 'type':'keydown', 'propagate':false, 'target':document} 
			); 
			
			$.extend($.gritter.options, { 
				position: 'bottom-right', // defaults to 'top-right' but can be 'bottom-left', 'bottom-right', 'top-left', 'top-right' 
				fade_in_speed: 'medium', // how fast notifications fade in (string or int)
				fade_out_speed: 2000, // how fast the notices fade out
				time: 6000 // hang on the screen for...
			});
			
			TabManager.init('#tabs');
			
			//Agregar opcion para salir
			
			ajustarTab(); //Ajusta la altura al tamaño en relacion al tamaño de la pantalla
			iniciarLinkTabs(); //A los objetos con atributo linkTab=true,  se les agrega comportamiento ajax para abrir tabs.
			
		     TabManager.add(kore.mod_url_base+'paginas/home','Menu',1);
			  // TabManager.add(kore.mod_url_base+'viajes/busqueda','Viajes',1);
			 // TabManager.add(kore.mod_url_base+'paginas/entregas','Entregas',1);
			 // TabManager.add(kore.mod_url_base+'paginas/cotizacion','Cotizaci&oacute;n',1);
		  // TabManager.add(kore.mod_url_base+'ordencompra/busqueda','Ordenes',1);
		  // TabManager.add(kore.mod_url_base+'pedidoint/busqueda','Pedidos',1);
			
			
			$(window).resize( function() {
			  ajustarTab();
			});
			
			$('.user_widget a').mouseenter(function(){
				$(this).addClass('ui-state-hover');
			});			
			$('.user_widget a').mouseleave(function(){
				$(this).removeClass('ui-state-hover');
			});
			
			$('.header_empresa').mouseenter(function(){
				$(this).addClass('ui-state-hover');
			});
			$('.header_empresa').mouseleave(function(){
				$(this).removeClass('ui-state-hover');
			});			
			
			$('.link-salir').mouseenter(function(){
				// $(this).addClass('ui-state-hover');
			});
			$('.link-salir').mouseleave(function(){
				// $(this).removeClass('ui-state-hover');
			});
			
			$('#btnMenu').click(function(){
				$('#menuPrincipal').toggle( 100 );
			});
						
		});
		
		
	</script>
	<style type="text/css">				
		
		.eliminado td{
			background-color:#F9DADA !important;
		}		
		
		.lista_toolbar > ul[role="tablist"]{
			display:none;
		}
		
		span.ui-icon-close{
			position: absolute;
			top: 0;
			right: 0;
			cursor: pointer;
		}
		
		#tabs > ul.ui-tabs-nav{
			width:13% !important;
			padding:0;
		}
		
		#tabs > .wijmo-wijtabs-content > div[role="tabpanel"], #tabs > div[role="tabpanel"]{
			width:87%;
			position:absolute;
			right:-2px;
		}
		
		.lista_toolbar > div[role="tabpanel"]{
			padding:0;
		}
		
		.ui-tabs-left .ui-tabs-panel {
			padding:0;
		}
		
		.ui-tabs{
			padding:0;
		}
		#tabs > .wijmo-wijtabs-content{
			float:left;
		}
		
		ul.ui-tabs-nav li a.tab_usuarios2, .busqueda_usuarios2{ background-image:url("http://png.findicons.com/files/icons/1620/crystal_project/64/personal.png"); } 
		body{
			background-color:black;
		}
		
		#btnMenu{
			cursor:pointer;
		}
		
		.wijmo-wijgrid-filter .wijmo-wijinput{
			background:black ;
			color:white;
		}
		
		.wijmo-wijgrid-filter-trigger{
			background:black !important;
		}
		
		.eliminado,  .eliminado .ui-state-highlight{
			color:red;
		}
		
		li[role="tab"]{
			overflow:hidden;
		}
		img {
			border: none;
		}
		.cerrar_tab{ 
			position:absolute; top:14px; right: 14px; cursor:pointer; width: 32px; height: 32px;
			background-image: url(http://png.findicons.com/files/icons/753/gnome_desktop/32/gnome_window_close.png);		
		}
	</style>	
</head>
<body style="padding:0; margin:0;" class="" >	
		<div>
			<div style="display:inline-block; padding:10px; background-color:black; color:white;"><?php echo $APP_CONFIG['nombre']; ?></div>
			
			
			<div style="padding:10px; display: inline-block; float:right; right: 0;top: 0;">
				<div style="padding-right: 5px; display: inline-block;color:white;"><?php print_r( $_SESSION['userInfo']['name'] ); ?></div>
				<div style="display: inline-block; color:white;" class=" link-salir" ><a onclick="salir()" href="#" style="color:white;" >Salir</a></div>			
			</div>			
			
			<div style="display:inline-block;margin-top: 3px;float:right;margin-left: 112px;"> 
				<!-- ******************************************+ -->
				
				<!-- ******************************************+ -->			
				<div id="btnMenu" href="#" titulo="Menu Principal">
					<img src="http://png.findicons.com/files/icons/756/ginux/32/run.png" style="cursor: ponter;">
				</div>
				
				<div><?php $this->mostrar('/menu'); ?></div>
			</div>
		</div>
				
		<div id="tabs">
			<ul>			
			</ul>		
		</div>					
</body>
</html>