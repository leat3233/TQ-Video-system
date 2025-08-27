<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel = CW('post/tel');
    $tel2 = CW('post/tel2');
    if($tel==$tel2){
        echo json_encode(array(
            'notice'=>'不能赠送给自己！',
        ));return;
    }
    $diam = intval(CW('post/diam',1));
    $tel_diam = $db->query('users','diam',"tel='{$tel}'",'',1);$tel_diam = $tel_diam[0]['diam'];
    $tel2_diam = $db->query('users','diam',"tel='{$tel2}'",'',1);$tel2_diam = $tel2_diam[0]['diam'];
    if($tel_diam<$diam){
        echo json_encode(array(
            'notice'=>'您的剩余钻石不足！',
        ));return;
    }
    $tel_diam_new = $tel_diam - $diam;
    $tel2_diam_new = $tel2_diam + $diam;
    $res1 = $db->exec('users','u',"diam='{$tel_diam_new}',tel='{$tel}'");
    $res2 = $db->exec('users','u',"diam='{$tel2_diam_new}',tel='{$tel2}'");
    if($res1 && $res2){
        $db->exec('message','i',array(
            'tel'=>$tel,
            'ftime'=>time(),
            'mtype'=>'钻石赠送',
            'desces'=>'赠送'.$diam.'钻石给用户:'.$tel2
        ));
        $db->exec('message','i',array(
            'tel'=>$tel2,
            'ftime'=>time(),
            'mtype'=>'钻石赠送',
            'desces'=>'收到用户'.$tel.'打赏'.$diam.'钻石'
        ));
        echo json_encode(array(
            'success'=>1,
        ));return;
    }else{
        echo json_encode(array(
            'notice'=>'赠送失败！',
        ));return;
    }
?>


