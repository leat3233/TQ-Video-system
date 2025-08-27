<?php 
    if(!defined('CW')){exit('Access Denied');}
    
    $db = functions::db();
    $tds = $db->query('sets','td','id=1','',1);
    $tds = explode(',',$tds[0]['td']);
    $data = array();
    foreach  ($tds as $val) {
         $v = explode('|',$val);
         array_push($data,array(
            'name'=>$v[0],
            'num'=>$v[1]
         ));
    }
    echo json_encode(array(
        'data'=>$data    
    ));
?>