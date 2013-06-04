<style>
	.home{text-align:center;}
	ul.ui-tabs-nav li a.tab_home{ background-image:url(http://png.findicons.com/files/icons/1197/agua/32/home_badge.png); }
	
	
	.menu > div{
		display:inline-block;
		
		vertical-align:top;
		margin-bottom:10px; 
	}
	
	.menu{
		width: 790px;
		position: absolute;
		margin-left: -390px;
		left: 50%;
	}
	
	.menu h3{margin:0px; padding:0px;}
	.menu .submenu{
		border-style: solid;
		border-color:red;
		border-width:4px 4px 0 4px;
		border-radius:24px;
	}
	
	.menu .submenu a{
		text-decoration:none;
		padding:24px;
		display:inline-block;
	}
	
	
	.menu .catalogos  a{
		
		display:inline-block;
		
	}
	.menu .sistema{
	
	}
</style>
<script>
	
	var tabId='#'+'<?php echo $_REQUEST['tabId']; ?>';				
	var pestana=$('a[href="'+tabId+'"]');
	pestana.addClass('tab_home');
	iniciarLinkTabs();
</script>

<div class="home">
	
	<img style="height: 230px;
position: absolute;
opacity: .2;
right: 0;" src='http://www.sistemassacsa.com/images/trailer.png' />
	<div class="menu">
		<div class="operacion"> 
			<h3>Operaci&oacute;n</h3>		 
			<div class="submenu">			
				<a tablink="true" href="/diario/busqueda" titulo="Diario" class="link">
					<img src="http://png.findicons.com/files/icons/1681/siena/48/currency_dollar_blue.png">		 
					<div>Diario</div>
				</a>				
				<a tablink="true" href="/viajes/nuevo" titulo="Viajes" class="link">
					<img src="http://png.findicons.com/files/icons/52/cargo_boxes/48/shipping1.png">		 
					<div>Nuevo</div>
				</a>
				<a tablink="true" href="/viajes/busqueda" titulo="Viajes" class="link">
					<img src="http://png.findicons.com/files/icons/52/cargo_boxes/48/shipping1.png">		 
					<div>Buscar</div>
				</a>				
			</div>
		</div>
		<div class="catalogos">
			<h3>Cat&aacute;logos auxiliares</h3>		 
			<div class="submenu">			
				<a tablink="true" href="/vehiculos/busqueda" titulo="Vehiculos" class="link">
					<img src="http://png.findicons.com/files/icons/1789/large_business/48/trailer.png">		 
					<div>Vehiculos</div>
				</a>				
				<a tablink="true" href="/cajas/busqueda" titulo="Cajas" class="link">
					<img src="http://png.findicons.com/files/icons/2206/austerity/59/com_saurik_winterboard.png" style="height:48px; width:48px;">		 
					<div>Cajas</div>
				</a>				
				<a tablink="true" href="/conceptos/busqueda" titulo="Conceptos" class="link">
					<img src="http://png.findicons.com/files/icons/2165/office/48/marked_price.png">
					<div>Conceptos</div>
				</a>			
				
				<a tablink="true" href="/clientes/busqueda" titulo="Clientes" class="link">
					<img src="http://png.findicons.com/files/icons/117/radium/48/user.png">
					<div>Clientes</div>
				</a>			
				
				<a tablink="true" href="/choferes/busqueda" titulo="Choferes" class="link">
					<img src="http://png.findicons.com/files/icons/180/urban_ppl/48/xp_ppl02.png">
					<div>Choferes</div>
				</a>			
				
				<a tablink="true" href="/rutas/busqueda" titulo="Rutas" class="link">
					<img src="http://png.findicons.com/files/icons/2283/upojenie/60/maps.png">
					<div>Rutas</div>
				</a>			
				
				
				
			</div>
		</div>
		<div class="sistema">
			<h3>Sistema</h3>
			<div class="submenu">
				<a tablink="true" href="/backend/usuarios/busqueda" titulo="Usuarios" class="link">
					<img src="http://png.findicons.com/files/icons/2332/super_mono/64/user_card.png">		 
					<div>Usuarios</div>
				</a>
				
				<a tablink="true" href="/portal/paginas/ayuda" titulo="Ayuda" class="link">
					<img src="http://png.findicons.com/files/icons/2166/oxygen/48/help_contents.png">		 
					<div>Ayuda</div>
				</a>
			</div>
		</div>
	</div>
	<h1 style="text-align: left; width: 100px; padding: 20px;"><?php echo $APP_CONFIG['nombre']; ?></h1>
</div>