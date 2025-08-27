<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $db = functions::db();
    $cardtype = CW('post/cardtype',1);
    $cardnum = intval(CW('post/cardnum'));
    $num = intval(CW('post/num'));
    $count = $db->get_count('card');
    if($count>50){
        msg('卡库最多存储50张(含已使用),请先删除部分兑换卡','刷新','','',true);
    }
    if($cardnum<1){
        msg('钻石数或者VIP天数必须为大于0的整数','刷新','','',true);
    }
    if($num>10 || $num<1){
    	msg('兑换卡的数目范围是1-10','刷新','','',true);
    }
    
    
    for($i=0;$i<$num;$i++){
        $db->exec('card','i',array(
        	'cardtype'=>$cardtype,
        	'cardnum'=>$cardnum,
        	'card'=>md5(uniqid(microtime(true),true))
        ));
    }
    
   msg('兑换卡生成完毕!','刷新','javascript:location.reload()','success',true);
?>