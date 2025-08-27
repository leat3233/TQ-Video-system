<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $sole = CW('post/sole');
    $data = $db->query('users','ftime',"sole='{$sole}'",'id asc',1);
    if($data && ($data[0]['ftime']+5000*60*60)<time()){
        echo json_encode(array(
            'allow'=>false,
            'show'=>""
        ));
    }else{
        echo json_encode(array(
            'allow'=>true    
        ));
    }
?>