<?php
	require "config.inc.php";
    require "system/runtime.php";
    $mod = CW('get/mod',2);
    if(!$mod){ $mod = 'index';}
    file::import('system-model-appajax-'.$mod);
    
    // require "config.inc.php";
    // require "system/runtime.php";
   
    
    // $db = functions::db();
    // $geturl = $db->query('sets','geturl','id=1','',1);
    // $geturl = $geturl[0]['geturl'];
    // $geturl_array = explode(',',$geturl);
    // $newurl = '';
    // foreach ($geturl_array as $geturl){
    //     $newurl = $geturl;
    //     $geturl2 = $geturl.'/webajax.php';//
    //     $newurl2 = get_headers($geturl2,1);
    //     if(!preg_match('/200/',$newurl2[0])){
    //         continue;
    //     }
    //     $param = http_build_query($_REQUEST);
    // $url = $newurl.'/appajax.php?'.$param;
    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($ch, CURLOPT_URL, $url);
    // curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // curl_setopt($ch, CURLOPT_HEADER, 0);
    // $data = curl_exec($ch);
    // curl_close($ch);
    // echo $data;
    // }
  
    
    
?>