<?php
	require "config.inc.php";
    require "system/runtime.php";
    $mod = CW('get/mod',2);
    if(!$mod){ $mod = 'index';}
    file::import('system-model-'.$mod);
?>