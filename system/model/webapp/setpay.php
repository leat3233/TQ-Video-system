<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $id = CW('post/id');
    $tel = CW('post/tel');
    $money = CW('post/money');
    $db = functions::db();
    $res = $db->exec('withdrawals','u',array(
        array(
            "state"=>1
        ),array(
            "id"=>$id
        )));
    if($res){
    	msg('设置打款已成功!','确定','javascript:location.reload()','success');
    }else{
        msg('设置失败,请联系技术人员查看!','取消','','',true);
    }
?>