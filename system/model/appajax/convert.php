<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $card = CW('gp/card');
    $tel = CW('gp/tel');
    $card = $db->query('card','',"card='{$card}'",'',1);
    
    if($card[0]['ishow']){
        echo json_encode(array(
            'err'=>'该兑换卡已被使用'
        ));return;
    }
    $user = $db->query('users','',"tel='{$tel}'");
    $user_diam = $user[0]['diam'];
    $viptime = $user[0]['viptime'];
    $cardtype = intval($card[0]['cardtype']);
    $res1 = $res2 = '';
    if($cardtype==1){//+金币
        $ndiam = $user_diam + $card[0]['cardnum'];
        $res1 = $db->exec("update users set diam='{$ndiam}' where tel='{$tel}'");
        if($res1){
            $db->exec('card','u',"ishow=1,card='{$card[0]['card']}'");
        }
        $res2 = $db->exec('message','i',array(
            'tel'=>$tel,
            'ftime'=>time(),
            'mtype'=>'兑换卡',
            'desces'=>'兑换卡兑换金币'.$card[0]['cardnum'].'个'
        ));
        $data = "成功兑换{$card[0]['cardnum']}个金币";
    }elseif ($cardtype==2) {
        if(!$viptime){//从来没开过会员
            $viptime = time()+$card[0]['cardnum']*24*60*60;
        }else{
            if($viptime>time()){
                $viptime = $viptime+$card[0]['cardnum']*24*60*60;
            }else{
                $viptime = time()+$card[0]['cardnum']*24*60*60;
            }
        }
        //var_dump(date('Y-m-d H:i:s'),$viptime);return;
        $mylevel = $user[0]['mylevel'];
        if($mylevel>1){
            $mylevel = $mylevel;
        }else{
            $mylevel = 1;
        }
        $res1 = $db->exec("update users set viptime='{$viptime}',mylevel='{$mylevel}' where tel='{$tel}'");
        if($res1){
            $db->exec('card','u',"ishow=1,card='{$card[0]['card']}'");
        }
        $res2 = $db->exec('message','i',array(
            'tel'=>$tel,
            'ftime'=>time(),
            'mtype'=>'兑换卡',
            'mylevel'=>1,
            'desces'=>'兑换卡兑换VIP'.$card[0]['cardnum'].'天'
        ));
        $data = "成功兑换{$card[0]['cardnum']}天VIP";
    }
    if($res1 ){
        echo json_encode(array(
            'success'=>$data
        ));
    }else{
        echo json_encode(array(
            'err'=>'兑换卡不存在'
        ));
    }
   
?>