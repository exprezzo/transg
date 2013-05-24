<style>
	.home{text-align:center;}
	ul.ui-tabs-nav li a.tab_home{ background-image:url(http://png.findicons.com/files/icons/1197/agua/32/home_badge.png); }
</style>
<script>
	
	var tabId='#'+'<?php echo $_REQUEST['tabId']; ?>';				
	var pestana=$('a[href="'+tabId+'"]');
	pestana.addClass('tab_home');
	
</script>
<div class="home">
	<h1>Bienvenid@ al sistema</h1>
	<img style="height:230px;" src='http://www.sistemassacsa.com/images/trailer.png' />
	<h1><?php echo $APP_CONFIG['nombre']; ?></h1>
</div>