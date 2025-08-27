<?php 
    if(!defined('CW')){exit('Access Denied');}
    $tel1 = CW('post/tel1');
    $tel2 = CW('post/tel2');
    
    $where = "tel1='{$tel1}' and tel2='{$tel2}'";
    $db = functions::db();

  
    $follows = $db->query('follow','',$where,'id desc');
    $type = '';
    if($follows){
        $db->exec('follow','d',$where);
        $type = '关注';
    }else{
        $db->exec('follow','i',array(
            'tel1'=>$tel1,
            'tel2'=>$tel2,
            'ftime'=>time()
        ));
        $type = '取消关注';
    }
    
    echo json_encode(array(
        'type'=>$type
    ));
    
?>


