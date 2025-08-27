<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel2 = CW('post/tel');
    $data = $db->query('level','tel',"tel2='{$tel2}' and level=1",'',1);
    if(!$data){
        return;
    }
    echo json_encode(array(
        'card'=>$data[0]['tel']
    ));
?>