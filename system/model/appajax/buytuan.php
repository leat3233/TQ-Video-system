<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel = CW('post/tel');
    $id = CW('post/id');
    
    
    $diamcharge = $db->query('sets','diamcharge','id=1','',1);
    $price = $diamcharge[0]['diamcharge'];
    
    $diam = $db->query('users','diam',"tel='{$tel}'",'',1);
    $diam = $diam[0]['diam'];
    
    if($diam<$price){
        echo json_encode(array(
           'error'=>"金币余额不足" 
        ));return;
    }
    
    $db->exec("update users set diam='{$ndiam}' where tel='{$tel}'");
    $res = $db->exec('buyrecord','i',array(
        'tel'=>$tel,
        'paytype'=>'tuan',
        'payid'=>$id,
        'ftime'=>time()
    ));
    if($res){
        echo json_encode(array(
            'success'=>1
        ));
    }else{
         echo json_encode(array(
            'err'=>'服务器繁忙,请稍后再试!'
        ));
    }
    


?>