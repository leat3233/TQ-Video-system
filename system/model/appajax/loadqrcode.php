<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel = CW('post/tel');
    $users = $db->query('users','',"tel='{$tel}'");
    $set = $db->query('sets','geturl','id=1','',1);
    echo json_encode(array(
        'user'=>$users,
        'geturl'=>$set[0]['geturl']
    )); 


        


?>