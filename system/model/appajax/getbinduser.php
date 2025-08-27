<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel1 = CW('post/tel1');
    $tel2 = CW('post/tel2');
    $exist = $db->query('level','',"tel='{$tel1}' and tel2='{$tel2}' and level=1",'',1);
    
    if($exist){
        echo json_encode(array(
            'err'=>'该推荐码已绑定'
        ));return;
    }
    $card = $db->query('users','',"tel='{$tel1}'",'',1);
    if(!$card[0]['card']){
        echo json_encode(array(
            'err'=>"绑定的用户不存在"
        ));return;
        
    }
    $res = functions::intobroker($tel1,$tel2,time(),0);
    if($res){
        echo json_encode(array(
            'success'=>1
        ));
    }else{
        echo json_encode(array(
           'err'=>'数据异常,绑定失败!'
        ));
    };
?>