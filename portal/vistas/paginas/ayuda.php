
<script>
	
	var tabId='#'+'<?php echo $_REQUEST['tabId']; ?>';			
	var id=	'<?php echo $_REQUEST['tabId']; ?>';
	var pestana=$('a[href="'+tabId+'"]');
	// alert(tabId);
	 pestana.addClass('tab_ayuda');
	panel=$(tabId);
	// panel.addClass('tab_ayuda');
	// iniciarLinkTabs();
	$(tabId+' .cerrar_tab').bind('click', function(){
		TabManager.cerrarTab( id );
	 });
</script>

<style>
	ul.ui-tabs-nav li a.tab_ayuda{ background-image:url(http://png.findicons.com/files/icons/2166/oxygen/32/help_contents.png); }
	[role="tabpanel"].tab_ayuda {
		padding:28px;
		position:relative !important; 
	}
	
	.tab_ayuda table td:first-child{
		font-size:13px;
	}
	
	.tab_ayuda table .titulo{
		text-align:center; font-size:20px !important;
		border-bottom: 2px black solid;position: relative; bottom: 5px;
	}
</style>
<div style="" class="cerrar_tab"></div>
<div class="tab_ayuda" style="padding:14px;">
	<h1>Teclas r&aacute;pidas</h1>
	<table>
		<tr>
			<td colspan="2" class="titulo">Accesos personales</td>		
		</tr>
		<tr>
			<td>Nuevo Viaje</td>
			<td>Ctrl + Alt + V</td>
		</tr>
		<tr>
			<td>Buscar Viajes</td>
			<td>Ctrl + Alt + SHIFT + V</td>
		</tr>	
	</table>

	<br /><br />

	<table>
		<tr>
			<td colspan="2" class="titulo">Accesos generales</td>		
		</tr>
		<tr>
			<td>Men&uacute; principal</td>
			<td>Ctrl + Alt + M</td>
		</tr>
		<tr>
			<td>Ayuda</td>
			<td>Ctrl + Alt + A</td>
		</tr>
		<tr>
			<td>Cerrar pesta&ntilde;a</td>
			<td>Ctrl + Alt + X</td>
		</tr>
		<tr>
			<td>Guardar</td>
			<td>Ctrl + Alt + G</td>
		</tr>
		<tr>
			<td>Borrar</td>
			<td>Ctrl + Alt + B</td>
		</tr>
		<tr>
			<td>Actualizar b&uacute;squeda</td>
			<td></td>
		</tr>
		
		<tr>
			<td>Nuevo</td>
			<td>Ctrl + Alt + N</td>
		</tr>
		
		
			
		
	</table>    

	<br>
	 <span>Se recomiendo usar google chrome para obtener las mejores caracter&iacute;sticas del sistema.</span>
</div>