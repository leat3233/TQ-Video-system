<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $advs = $db->query('indexapp','');
    $show = array();
    foreach ($advs as $adv){
        
        array_push($show,array(
            'id'=>$adv['id'],
            'name'=>$adv['name'],
            'cover'=>$adv['cover'],
            'downloadurl'=>$adv['downloadurl'],
        ));
    }
    echo json_encode(array(
        'data'=>$show,
    )); 
?>