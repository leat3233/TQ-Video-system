<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tpl =  new Society();
    $id = CW('get/id');
    $type = CW('get/type');
    $cardname = CW('get/cardname');
    $tel = CW('get/tel');
    if($type=='diam'){
        $get = $db->query('diamcard','',"id='{$id}'",'',1);
        $price = $get[0]['price'];
    }else if($type=='vip'){
        $get = $db->query('vipcard','',"id='{$id}'",'',1);
        $price = $get[0]['nowprice'];
    }

    $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
    $tpl->assign('returnUrl',$http_type.$_SERVER['SERVER_NAME'].'/res.html');
    $tpl->assign('notifyUrl',$http_type.$_SERVER['SERVER_NAME'].'/pay/api/pay/notify.php');
    $tpl->assign('body',$get[0]['descs']);
    $tpl->assign('money',$price);
    $tpl->assign('subject',$cardname);
    $tpl->assign('payMchOrderNo',md5(uniqid()));
    $tpl->assign('time',date('Y-m-d H:i:s',time()));
    $tpl->assign('param1',$tel);
    $tpl->assign('param2',$id.'-'.$type);
    $tpl->compile('pay',''); 
?>