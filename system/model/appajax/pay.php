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
    $tpl->assign('pay_callbackurl',$http_type.$_SERVER['SERVER_NAME'].'/res.html');
    $tpl->assign('pay_notifyurl',$http_type.$_SERVER['SERVER_NAME'].'/pay/notifyUrl.php');
    $tpl->assign('descs',$get[0]['descs']);
    $tpl->assign('price',$price);
    $tpl->assign('cardname',$cardname);
    $tpl->assign('payMchOrderNo',date("YmdHis").mt_rand(100,999));
    $tpl->assign('time',date('Y-m-d H:i:s',time()));
    $tpl->assign('param1',$tel);
    $tpl->assign('param2',$id.'-'.$type);
    
    
    
    
    
    
    
    $tpl->assign('option',$option);
    $tpl->compile('pay',''); 
?>