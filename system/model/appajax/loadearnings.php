<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel = CW('post/tel');
    $where = "parent='{$tel}'";
    
    $earnings = $db->query('earnings','',$where,'id desc');
    $data = array();
    foreach($earnings as $earning){
        $time = date('Y-m-d h:i:s',$earning['ftime']);
          $tel  = substr($earning['currtel'],0,3).'******'.substr($earning['currtel'],-2);
        array_push($data,array(
            'msg'=>"我的{$earning['level']}级代理({$tel})充值{$earning['price']}元, 盈利{$earning['earnings']}元"
        ));
    }
    $money = $db->query('users','money',"tel='{$tel}'",'',1);
    echo json_encode(array(
        'data'=>$data,
        'money'=>$money[0]['money']
    ));
    
?>


