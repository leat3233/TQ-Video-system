<?php 
    $db = functions::db();
    $geturl = '';
    $geturl = $db->query('sets','h5','id=1','',1);
    $geturl = $geturl[0]['h5'];
    $geturl_array = explode(',',$geturl);
    $newurl = '';
    echo json_encode(array(
        'url'=>INDEX
    ));return;
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