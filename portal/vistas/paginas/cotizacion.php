<script>			
	$( function(){	
		var tabid='#<?php echo $_REQUEST['tabId']; ?>';
		setTimeout(function() { 
			var ht = $('#tabs [role="tablist"]').height();		
			var hh = $(tabid + ' .ui-widget-header').height();					
			$( tabid + ' .pdfReader').height(ht - hh);
		}, 1000);		
	});
</script>
<div>
	<object class="pdfReader" data="<?php echo $_APP_PATH; ?>web/estimacion.pdf" type="application/pdf" width="100%" height="93%">
		alt : <a href="#"></a>
	</object>
</div>