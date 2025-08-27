<?php 
    $db = functions::db();
    $geturl = '';
    $type = $_REQUEST['type'];
    if($type=='app'){
        $geturl = $db->query('sets','geturl','id=1','',1);
    }else{
        $geturl = $db->query($type);
    }
    $geturl = $geturl[0]['geturl'];
    $geturl_array = explode(',',$geturl);
    $newurl = '';
    foreach ($geturl_array as $geturl){
        //$newurl = $geturl;
        $geturl2 = $geturl.'/webajax.php';//
        $newurl2 = get_headers($geturl2,1);
        if(!preg_match('/200/',$newurl2[0])){
            continue;
        }
        
    }
    //var_dump($geturl);return;
    echo json_encode(array(
        'url'=>$geturl
    ));
?>