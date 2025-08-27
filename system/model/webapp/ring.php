<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $num_comment = $db->query("select count(*) from pays where state=0");
    $num_comment = intval($num_comment[0]["count(*)"]);
    if($num_comment>0){
        $add_comment = "您有{$num_comment}条待充值记录";
    }
    
    
    $num_withdrawals = $db->query("select count(*) from withdrawals where state=0");
    $num_withdrawals = intval($num_withdrawals[0]["count(*)"]);
    if($num_withdrawals>0){
        $add_withdrawals = "您有{$num_withdrawals}条提现申请";
    }
    
    //$add_comment = $add_withdrawals = '';
    
    if($add_comment || $add_withdrawals){
        echo json_encode(array(
            'data'=>$add_comment.'<br />'.$add_withdrawals,
            'state'=>1
        ));
    }else{
        echo json_encode(array(
            'state'=>0
        ));
    }
    
    
?>