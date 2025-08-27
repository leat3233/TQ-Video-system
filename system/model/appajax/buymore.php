<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $id = CW('post/id');
    $tel = CW('post/tel');
    $user = $db->query('users','viptime,diam',"tel='{$tel}'",'',1);
    if($user[0]['viptime']<time()){
        echo json_encode(array(
            'notice'=>'权限不足, 请升级VIP！',
            'state'=>1
        ));return;
    }
    $gooddeal = $db->query('gooddeal','',"id='{$id}'",'',1);
    $diam = $gooddeal[0]['diamond'];
    $vidlist = $gooddeal[0]['vidlist'];
    if(!$vidlist){
        echo json_encode(array(
            'notice'=>'影片ID异常, 无法完成购买！',
            'state'=>1
        ));return;
    }
    $exist = $db->query('buyrecord','',"tel='{$tel}' and paytype='buymore' and payid='{$id}'");
    if($exist){
        echo json_encode(array(
            'notice'=>'请勿重复购买！',
            'state'=>1
        ));return;
    }
    $user = $db->query('users','diam',"tel='{$tel}'",'',1);
    $user_diam = $user[0]['diam'];
    if($user_diam>$diam){
        $surplusdiam = $user_diam-$diam;
        $res1 = $db->exec('users','u',"diam='{$surplusdiam}',tel='{$tel}'");

        $vidlist = explode(',',$vidlist);
        foreach ($vidlist as $vid){
            $db->exec('sellvideo','i',array(
                'tel'=>$tel,
                'vidid'=>$vid,
                'ftime'=>time()
            ));
        }
        if($res1){
            $db->exec('buyrecord','i',array(
                'tel'=>$tel,
                'paytype'=>'buymore',
                'payid'=>$id,
                'ftime'=>time()
            ));
            echo json_encode(array(
                'success'=>1,
                'state'=>1
            ));
        }else{
            echo json_encode(array(
                'notice'=>'购买失败！',
                'state'=>1
            ));
        }
    }else{
        echo json_encode(array(
            'notice'=>'您的剩余金币不足以购买本影片！',
            'state'=>1
        ));
    }

?>