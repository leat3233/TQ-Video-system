<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $id = CW('post/id');

    $db = functions::db();
    $res = $db->exec("update withdrawals set state=2 where id='{$id}'");
    if($res){
        $withdrawals = $db->query('withdrawals','tel,money',"id='{$id}'",'',1);
       
        $money = $db->query('users','money',"tel='{$withdrawals[0]['tel']}'",'',1);
        $money = $money[0]['money']+$withdrawals[0]['money'];
        $db->exec('users','u',array(array(
            'money'=>$money
        ),array(
            'tel'=>$withdrawals[0]['tel']
        )));
     msg('操作成功!','刷新','javascript:location.reload()','success',true);
    }else{
        msg('数据库繁忙, 请稍后再试!');
    }
?>