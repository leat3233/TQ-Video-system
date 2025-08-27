<?php

	require "config.inc.php";
    require "system/runtime.php";
    $mod = CW('get/mod',2);


    
    //functions::sethandler(); 
    if(!$mod){
        functions::url(INDEX);
    }

    if($mod!='login'){
        logincheck();
    }
    file::import('system-model-admin-'.$mod);
?>