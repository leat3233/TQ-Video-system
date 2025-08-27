<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $db = functions::db();
    $look = CW('post/look');
    $greenhorn = CW('post/greenhorn');
    $customer = CW('post/customer');
    $pay = CW('post/pay');
    $withdrawals = CW('post/withdrawals');
    $onlyvip = CW('post/onlyvip');
    $vipcomments = CW('post/vipcomments');
    
    $r1 = CW('post/r1');
    $r2 = CW('post/r2');
    $r3 = CW('post/r3');
    $scaletype = CW('post/scaletype');
    $f1 = CW('post/f1');
    $f2 = CW('post/f2');
    $f3 = CW('post/f3');
    $p1 = CW('post/p1');
    $p2 = CW('post/p2');
    $p3 = CW('post/p3');
    $p4 = CW('post/p4');
    $p5 = CW('post/p5');
    $diamcharge = CW('post/diamcharge');
    if($r1>1 || $r1<0){
    	msg('反额比设置错误,应填写小数','刷新','javascript:location.reload()','',true);
    }
    if($r2>1 || $r2<0){
    	msg('反额比设置错误,应填写小数','刷新','javascript:location.reload()','',true);
    }
    if($r3>1 || $r3<0){
    	msg('反额比设置错误,应填写小数','刷新','javascript:location.reload()','',true);
    }
    if($f1>1 || $f1<0){
    	msg('返利比设置错误,应填写小数','刷新','javascript:location.reload()','',true);
    }
    if($f2>1 || $f2<0){
    	msg('返利比设置错误,应填写小数','刷新','javascript:location.reload()','',true);
    }
    if($f3>1 || $f3<0){
    	msg('返利比设置错误,应填写小数','刷新','javascript:location.reload()','',true);
    }
    if($p2<$p1 || $p3<$p2 || $p4<$p3 || $p5<$p4){
        msg('用户返利比设置错误, 请注意开始金额与结束金额的搭配','刷新','javascript:location.reload()','',true);
    }
    $inviteday1 = CW('post/inviteday1');
    $inviteday2 = CW('post/inviteday2');
    $inviteday3 = CW('post/inviteday3');
    $inviteday4 = CW('post/inviteday4');
    $inviteuser1 = CW('post/inviteuser1');
    $inviteuser2 = CW('post/inviteuser2');
    $inviteuser3 = CW('post/inviteuser3');
    $inviteuser4 = CW('post/inviteuser4');

    $res = $db->exec('sets','u',array(
        array(
            "look"=>$look,
            "greenhorn"=>$greenhorn,
            "customer"=>$customer,
            "pay"=>$pay,
            "withdrawals"=>$withdrawals,
            "onlyvip"=>$onlyvip,
            "r1"=>$r1,
            "r2"=>$r2,
            "r3"=>$r3,
            "p1"=>$p1,
            "p2"=>$p2,
            "p3"=>$p3,
            "p4"=>$p4,
            "p5"=>$p5,
            "f1"=>$f1,
            "f2"=>$f2,
            "vipcomments"=>$vipcomments,
            "f3"=>$f3,
            "diamcharge"=>$diamcharge,
            "inviteday1"=>$inviteday1,
            "inviteday2"=>$inviteday2,
            "inviteday3"=>$inviteday3,
            "inviteday4"=>$inviteday4,
            "inviteuser1"=>$inviteuser1,
            "inviteuser2"=>$inviteuser2,
            "inviteuser3"=>$inviteuser3,
            "inviteuser4"=>$inviteuser4,
            "scaletype"=>$scaletype,
            'set1'=>CW('post/set1'),
            'set2'=>CW('post/set2'),
            'logo'=>CW('post/logo'),
            'start1'=>CW('post/start1'),
            'start2'=>CW('post/start2'),
            'adda'=>CW('post/adda'),
            'addb'=>CW('post/addb'),
            'changnum'=>CW('post/changnum'),
            'duannum'=>CW('post/duannum'),
            'geturl'=>CW('post/geturl'),
            'new1'=>CW('post/new1'),
            'oo1'=>CW('post/oo1'),
            'oo2'=>CW('post/oo2'),
            'oo3'=>CW('post/oo3'),
            'banben'=>intval(CW('post/banben'))
        ),array(
            "id"=>1
        )));
   
    //if($res){
    	msg('设置成功!','确定','','success');
    //}else{
    //    msg('数据无变动!','重填','javascript:location.reload()','',true);
    //}
?>