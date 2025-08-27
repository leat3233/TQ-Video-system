<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $vid = CW('post/vid');
    $tel = CW('post/tel');
    $exist = $db->query('buyrecord','',"tel='{$tel}' and paytype='buyvid' and payid='{$vid}'");
    if($exist){
        echo json_encode(array(
            'err'=>'请勿重复购买！'
        ));return;
    }
    
    $post = $db->query('post','',"id='{$vid}'",'',1);
    $vipdiam = $post[0]['vipdiam'];
    $diamond = $post[0]['diamond'];
    $user = $db->query('users','viptime,diam',"tel='{$tel}'",'',1);
    $user_diam = $user[0]['diam'];
    if($user[0]['viptime']>time()){
        if($user_diam>$vipdiam){
            $surplusdiam = $user_diam-$vipdiam;
            $res1 = $db->exec('users','u',"diam='{$surplusdiam}',tel='{$tel}'");
            $res2 = $db->exec('sellvideo','i',array(
                    'tel'=>$tel,
                    'vidid'=>$vid,
                    'ftime'=>time()
            ));
            if($res1 && $res2){
                $db->exec('buyrecord','i',array(
                    'tel'=>$tel,
                    'paytype'=>'buyvid',
                    'payid'=>$vid,
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
    }else{
        ///file::debug($user_diam);
        //file::debug($diamond);
        if($user_diam>=$diamond){
            $surplusdiam = $user_diam-$diamond;
            $res1 = $db->exec('users','u',"diam='{$surplusdiam}',tel='{$tel}'");
            $res2 = $db->exec('sellvideo','i',array(
                    'tel'=>$tel,
                    'vidid'=>$vid,
                    'ftime'=>time()
                ));
            $db->exec('buyrecord','i',array(
                    'tel'=>$tel,
                    'paytype'=>'buyvid',
                    'payid'=>$vid,
                    'ftime'=>time()
                ));
             /*分红*/
            $vipdiam = $post[0]['vipdiam'];
            $diamond = $post[0]['diamond'];
            $fenli_user = $post[0]['userid'];
            $user_fenlei_diam = $db->query('users','diam',"tel='{$fenli_user}'",'',1);$user_fenlei_diam = $user_fenlei_diam[0]['diam'];
            $bili = $db->query('sets','bili','id=1','',1);$bili = $bili[0]['bili']/100;
            
            $b = round($diamond*$bili,2);
            $nddd = $user_fenlei_diam+$b;
            

            
            $db->exec('users','u',"diam='{$nddd}',tel='{$post[0]['userid']}'");
            //file::debug("视频发布用户：{$fenli[0]['userid']}赚取了{$b}金币,原金币{$fenli_diamond}新金币{$nddd}");
            $db->exec('message','i',array(
                'tel'=>$fenli_user,
                'ftime'=>time(),
                'mtype'=>'视频售卖返利',
                'desces'=>date('Y-m-d H:i:s',time()).', 商品出售成功赚取'.$b.'金币'
            ));
            /*分红*/
            echo json_encode(array(
                    'success'=>1
                ));
            // if($res1 && $res2){
            //     echo json_encode(array(
            //         'success'=>1
            //     ));
            // }else{
            //     echo json_encode(array(
            //         'err'=>'购买失败！'
            //     ));
            // }
        }else{
            echo json_encode(array(
                'err'=>'您的剩余金币不足以购买本影片！'
            ));
        }
    }
?>