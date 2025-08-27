<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel = CW('post/tel',3);
    $res = $db->exec("history",'d',"dev='{$tel}'");
    if($res){
        echo json_encode(array(
            'success'=>1    
        ));
    }else{
        echo json_encode(array(
            'fail'=>1    
        ));
    }
?>