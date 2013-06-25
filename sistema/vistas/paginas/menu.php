

<script type="text/javascript">
    $(document).ready(function () {
        $("#accordion").wijaccordion();
		// iniciarLinkTabs();
    });
</script>

<style>
	#accordion  .submenu a{
		display:inline-block;
		text-decoration:none;
		margin:15px;
		
	}
	
	#accordion div{
		text-align:center;
	}
	
	
</style>

<div id="menuPrincipal" style="position: absolute; width: 430px;margin-left: 20px;z-index: 6;background-color: white;display: block;right: 0px;top: 35px; display:none; ">
	<div id="accordion">		
		<?php 
			if ( $_SESSION['userInfo']['rol']==1 || $_SESSION['userInfo']['rol']==2  ){
		?>
		<h3>Operaci&oacute;n</h3>		 
		<div class="submenu">			
			<a tablink="true" href="/diario/busqueda" titulo="Diario" class="link">
				<img src="http://png.findicons.com/files/icons/1681/siena/48/currency_dollar_blue.png">		 
				<div>Diario</div>
			</a>				
			<a tablink="true" href="/viajes/busqueda" titulo="Viajes" class="link">
				<img src="http://png.findicons.com/files/icons/52/cargo_boxes/48/shipping1.png">		 
				<div>Viajes</div>
			</a>								
		</div>
		<h3>Catalogos</h3>		 
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
		
		<h3>Sistema</h3>
		<div class="submenu">
			<a tablink="true" href="/backend/usuarios/busqueda" titulo="Usuarios" class="link">
				<img src="http://png.findicons.com/files/icons/2332/super_mono/64/user_card.png">		 
				<div>Usuarios</div>
			</a>
			<a tablink="true" href="/paginas/ayuda" titulo="Ayuda" class="link">
				<img src="http://png.findicons.com/files/icons/2166/oxygen/48/help_contents.png">		 
				<div>Ayuda</div>
			</a>
			<a tablink="true" href="/paginas/home" titulo="Inicio" class="link">
				<img src="http://png.findicons.com/files/icons/1197/agua/32/home_badge.png">		 
				<div>Menu</div>
			</a>
		</div>
		<?php 
			}
		?>
	</div>
</div>