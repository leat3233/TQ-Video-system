<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel = CW('post/tel');
    $sex = CW('post/sex');
    $descs = CW('post/descs');
    $nickname = CW('post/nickname');
    $res = '';
    if($sex){
        $res = $db->exec("update users set sex='{$sex}' where tel='{$tel}'");
    }else if($descs){
        $res = $db->exec("update users set descs='{$descs}' where tel='{$tel}'");
    }else if($nickname){
        $res = $db->exec("update users set nickname='{$nickname}' where tel='{$tel}'");
    }
    
    
    if($res){
        echo json_encode(array(
           'success'=>'成功' ,
        ));
    }else{
        echo json_encode(array(
           'err'=>'操作失败' 
        ));
    }
    
        

?>


