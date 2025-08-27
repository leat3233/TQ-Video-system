<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $db = functions::db();
    $tel = CW('post/tel');
    $paytype = CW('post/paytype');
    $paymsg = CW('post/paymsg');
    if(!$tel ){
        msg('账号异常, 无法提现, 请联系管理员！','每项必填',false,'error');
    }
    
    $exist = $db->query('dluser','',"tel='{$tel}'",'',1);
    if(!$exist){
        msg('当前账号非代理商账号,无法提现！','每项必填');
    }
    
    if(!$paytype || !$paymsg){
       msg('每项必填！','确定',false,'error');
    }
    $istx = $db->query("withdrawals",'',"tel='{$tel}' and state=0",'',1);
    if($istx){
        msg('您有未处理的提现订单,请等待处理完毕再操作！','确定');
    }
    $cardmsg = CW('post/cardmsg');
    $money = $db->query('users','money',"tel='{$tel}'",'',1);
    $money = $money[0]['money'];
    
    $withdrawals = $db->query('sets','withdrawals','id=1','',1);
    $a = $withdrawals[0]['withdrawals'];
    if($money<$a){
        msg("最低提现{$a}元",'确定');
    }
    $res = $db->exec('withdrawals','i',array(
        'tel'=>$tel,
        'ftime'=>time(),
        'money'=>$money,
        'paytype'=>$paytype,
        'cardmsg'=>$paymsg,
        'state'=>0
    ));

    
    if($res){
        $db->exec("update users set money=0 where tel='{$tel}'");
        msg('提现成功,请等待管理员审核!','确定','','success');
    }else{
        msg('提现失败!','确定','');
    };
    
   
?>