<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $type = intval(CW('post/type'));
    $tel1 = CW('post/tel1');
    $tel2 = CW('post/tel2');
    if($type==1){
        $res2 = $db->exec('follow','d',"tel1='{$tel1}' and tel2='{$tel2}'");
    }elseif($type==2){
        $res2 = $db->exec('follow','d',"tel1='{$tel2}' and tel2='{$tel1}'");
        
    }
    
    
    if($res2){
        echo json_encode(array(
            'success'=>1
        ));
    }else{
        echo json_encode(array(
            'err'=>'操作失败!'
        ));
    };

?>