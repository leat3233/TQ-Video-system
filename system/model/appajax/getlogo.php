<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $sets = $db->query('sets','','','id asc',1);
    $banbens = explode(',',$sets[0]['banben']);
    $add = array();
    foreach ($banbens as $bb){
        $topic = $db->query('topic','name',"id='{$bb}'");
        array_push($add,array(
            'id'=>$bb,
            'text'=>$topic[0]['name']
        ));
    }
    echo json_encode(array(
        'logo'=>$sets[0]['logo'],
        'add'=>$add,
        'uuu'=>$sets[0]['kefu'],
        'tanchuang'=>$sets[0]['tanchuang'],
        'tanchuang1'=>$sets[0]['tanchuang1'],
        'tanchuang2'=>$sets[0]['tanchuang2'],
    ));
    
?>