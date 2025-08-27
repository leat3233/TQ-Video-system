<?php 
    if(!defined('CW')){exit('Access Denied');}

    $db = functions::db();
    $tel = CW('post/tel');
    $user = $db->query('users','',"tel='{$tel}'",'',1);
    $data = array();
    $num=0;
    $vipcards = $db->query('vipcard','','','id asc');
    foreach ($vipcards as $vipcard){
        $num++;
        array_push($data,array(
            'id'=>$num,
            'tit'=>$vipcard['btit'],
            'text1'=>$vipcard['nowprice'],
            'text2'=>$vipcard['oldprice'],
            'text3'=>$vipcard['descs'],
            'stit'=>$vipcard['stit'],
        ));
    }
    $end = $user[0]['viptime'];
    if(!$end){
        $endtime = "暂未开通VIP会员";
    }else if(time()>$end){
        $endtime = "VIP已过期";
    }else{
        $endtime = "VIP到期时间:".date('Y-m-d',$end);
    }
    echo json_encode(array(
        'nickname'=>$user[0]['nickname'],
        'endtime'=>$endtime,
        'data'=>$data,
        'avatar'=>str_replace('image','static',$user[0]['avatar']),
        'sex'=>$user[0]['sex']=='男' ? 'man' : 'woman'
    ));
    
?>


