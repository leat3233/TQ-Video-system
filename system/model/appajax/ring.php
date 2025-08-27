<?php 
    header('Content-Type: application/json');
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $num_comment = $db->query("select count(*) from comments where ishow=0");
    $num_comment = intval($num_comment[0]["count(*)"]);
    if($num_comment>0){
        $add_comment = "有{$num_comment}条评论待审核";
    }
    
    
    $num_withdrawals = $db->query("select count(*) from pays where state=0");
    $num_withdrawals = intval($num_withdrawals[0]["count(*)"]);
    if($num_withdrawals>0){
        $add_withdrawals = "有{$num_withdrawals}条提现申请";
    }
    
    
    $num_pays = $db->query("select count(*) from withdrawals where state=0");
    $num_pays = intval($num_pays[0]["count(*)"]);
    if($num_pays>0){
        $add_pays = "有{$num_pays}条待充值记录";
    }
    //$add_comment = $add_withdrawals = '';
    
    if($add_comment || $add_withdrawals || $add_pays){
        echo json_encode(array(
            'data'=>'您'.$add_comment.', '.$add_withdrawals.', '.$add_pays,
            'state'=>1
        ));
    }else{
        echo json_encode(array(
            'state'=>0
        ));
    }

    
?>