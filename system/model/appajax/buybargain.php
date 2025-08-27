<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $msg = CW('gp/msg');
    $tel = CW('post/tel');
    
    $diam = CW('post/diam');
    
    $ids =$idss= substr($msg,strpos($msg,'/')+1);
    $diam = substr($msg,0,strripos($msg,'/'));

    if(!$ids){
        echo json_encode(array(
            'err'=>'影片ID异常, 无法完成购买！'
        ));return;
    }
    file::debug($tel.'----------'.$ids);
    $exist = $db->query('buyrecord','',"tel='{$tel}' and paytype='buybargain' and payid='{$ids}'");
    if($exist){
        echo json_encode(array(
            'err'=>'请勿重复购买！'
        ));return;
    }
    $user = $db->query('users','diam',"tel='{$tel}'",'',1);
    $user_diam = $user[0]['diam'];
  
    if($user_diam>$diam){
        $surplusdiam = $user_diam-$diam;
        $res1 = $db->exec('users','u',"diam='{$surplusdiam}',tel='{$tel}'");

        $ids = explode(',',$ids);
        foreach ($ids as $vid){
            $albuy = $db->query('sellvideo','',"vidid='{$vid}'",'',1);
            if($albuy){
                continue;
            }
            $db->exec('sellvideo','i',array(
                'tel'=>$tel,
                'vidid'=>$vid,
                'ftime'=>time()
            ));
        }
        if($res1){
            $db->exec('buyrecord','i',array(
                'tel'=>$tel,
                'paytype'=>'buybargain',
                'payid'=>$idss,
                'ftime'=>time()
            ));
            echo json_encode(array(
                'success'=>1
            ));
        }else{
            echo json_encode(array(
                'err'=>'购买失败！'
            ));
        }
    }else{
        echo json_encode(array(
            'err'=>'您的剩余金币不足以购买本影片！'
        ));
    }

?>