<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $id = CW('post/id');
    $tel = CW('post/tel');
    $selecttime = intval(CW('post/selecttime'));
    $day0 =  strtotime(date('Y-m-d',time()))+intval($selecttime)*60*60;
    
    if(time()>$day0 && time()<($day0+600)){
        ///////////////////
        $exist = $db->query('buyrecord','',"tel='{$tel}' and paytype='buyseckill' and payid='{$id}'");
        if($exist){
            echo json_encode(array(
                'notice'=>'请勿重复购买！',
                'state'=>1
            ));return;
        }
        $user = $db->query('users','diam',"tel='{$tel}'",'',1);
        $seckill = $db->query('seckill','',"id='{$id}'",'',1);
        $nnum = $seckill[0]['num']-1;
        if($nnum<1){
            echo json_encode(array(
                'notice'=>'本轮秒杀已结束, 请关注其他场次！',
                'state'=>1
            ));return;
        }
        
        $diam = $seckill[0]['pricediamond']; 
        $user_diam = $user[0]['diam'];
    
        if($user_diam>$diam){
            $surplusdiam = $user_diam-$diam;
            $res1 = $db->exec('users','u',"diam='{$surplusdiam}',tel='{$tel}'");
            $res2 = $db->exec('seckill','u',"num='{$nnum}',id='{$id}'");
            $res3 = $db->exec('sellvideo','i',array(
                        'tel'=>$tel,
                        'vidid'=>$seckill[0]['vid'],
                        'ftime'=>time()
                ));
            if($res1 && $res2 && $res3){
                $db->exec('buyrecord','i',array(
                    'tel'=>$tel,
                    'paytype'=>'buyseckill',
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
        //////////////////
    }else if(time()>($day0+601)){
        echo json_encode(array(
            'notice'=>'秒杀已结束, 请关注其他场次！',
        ));
    }
?>