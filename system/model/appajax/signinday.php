<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel = CW('post/tel');
    $users = $db->query('users','money,diam,days,daystime',"tel='{$tel}'",'',1);
    $money = $users[0]['money'];
    $diam = $users[0]['diam'];
    $daystime = $users[0]['daystime'];
    
    if(date('Ymd',time())==date('Ymd',$daystime)){
        echo json_encode(array(
            'err'=>'今日您已签到, 请明日再来!',
        ));return;
    }
    $days = $users[0]['days']+1;
    $days = $days>7 ? 1: $days;
    $signinset = $db->query('signinset','',"day='{$days}'");
    
    
    
    if($signinset[0]['rewardtype']=='1'){//金币
        $_diam = $signinset[0]['reward'];
        $_money = 0;
        $text = '获得金币'.$_diam.'个';
    }elseif ($signinset[0]['rewardtype']=='2') {//红包
        $_money = $signinset[0]['reward'];
        $_diam = 0;
        $text = '获得红包'.$_money.'元';
    }else{
        $_money = $_diam = 0;
        $text = '';
    }
    $allmoney = $money+$_money;
    $alldiam = $diam+$_diam;
    $res = $db->exec('users','u',array(array(
        'money'=>$allmoney,
        'diam'=>$alldiam,
        'days'=>$days,
        'daystime'=>time()
    ),array(
        'tel'=>$tel
    )));
    if($res){
        $db->exec('message','i',array(
            'tel'=>$tel,
            'ftime'=>time(),
            'mtype'=>'每日签到',
            'desces'=>'每日签到, '.$text
        ));
        echo json_encode(array(
            'success'=>1,
            'allmoney'=>$allmoney,
            'alldiam'=>$alldiam,
            'data'=>$text,
            'state'=>1
        ));
    }else{
        echo json_encode(array(
            'data'=>'签到失败, 请稍后重试!',
        ));
    }
?>