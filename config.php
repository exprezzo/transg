<?php
if ( !isset($APP_CONFIG) ) $APP_CONFIG = array();
$APP_CONFIG['main_app']='sistema';	//ME GUSTARIA USARLO ASI, pERO SE USA ASI |	
$_DEFAULT_APP='sistema';				//                                  <- 
include_once('../'.$_DEFAULT_APP.'/config.php');
?>