<?php
	
    require "config.inc.php";
    require "system/runtime.php";


    $mod = CW('get/modd',2);

    $isexist = file_exists(ROOT_URL.'/system/model/webapp/'.$mod.'.php');
    if(!$isexist){
    	msg('模块不存在','确定','javascript:location.reload()','error',true);
    }
    
    if($mod!='login'){
        functions::auth();
    }
    if(!$mod){ $mod = 'index';}
    file::import('system-model-webapp-'.$mod);
?>