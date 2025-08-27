<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel = CW('post/tel');
    $usertel = CW('post/usertel');

    
   
    $exist = $db->query('users','usertel,viptime,mylevel',"tel='{$tel}'",'',1);
    if($exist[0]['usertel']){
        echo json_encode(array(
            'err'=>'该手机号已被绑定'
        ));return;
    }
    $uviptime = $exist[0]['viptime'];
    $viptime = $uviptime>time() ? $uviptime+5*24*60*60 : time()+5*24*60*60;
    $mylevel = $exist[0]['mylevel']>0 ? $exist[0]['mylevel'] : 1;
    $res = $db->exec('users','u',array(array(
        'usertel'=>$usertel,
        'viptime'=>$viptime,
        'mylevel'=>$mylevel
    ),array(
        'tel'=>$tel
    )));
    if($res){
        echo json_encode(array(
            'success'=>'绑定成功,获赠5天VIP'
        ));
    }else{
        echo json_encode(array(
            'err'=>'绑定失败!'
        ));
    };

?>