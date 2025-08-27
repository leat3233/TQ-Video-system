<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $selecttime = CW('post/selecttime');
    $vid = intval(CW('post/vid'));
    $num = intval(CW('post/num'));
    if($num<0 || $num>1000){
        msg('上架数量范围为1-1000!','刷新','javascript:location.reload()','notice',true);
    }
    $pricediamond = intval(CW('post/pricediamond'));
    if(!$selecttime){
        msg('请选择秒杀时间!','刷新','javascript:location.reload()','notice',true);
    }
    $db = functions::db();
    $res = $db->exec('seckill','i',array(
    	'selecttime'=>$selecttime,
    	'vid'=>$vid,
    	'pricediamond'=>$pricediamond,
    	'num'=>$num
    ));
    
   
    if($res){
        msg('添加成功!','刷新','javascript:location.reload()','success',true);
    }else{
        msg('添加失败!','重置','javascript:location.reload()','error',true);
    }

?>