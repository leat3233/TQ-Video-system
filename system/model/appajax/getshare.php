<?php 
    if(!defined('CW')){exit('Access Denied');}
    $ip = CW('post/ip');
    $cid = CW('post/cid');
    $cname = CW('post/cname');
    $card = CW('post/card');
    $db = functions::db();
    $exist = $db->query('share','',"ip='{$ip}'  and card='{$card}'",'',1);
    if(!$exist){
        $res = $db->exec('share','i',array(
            'ip'=>$ip,
            'cid'=>'',
            'cname'=>'',
            'card'=>$card,
            'ftime'=>time()
        ));
        if($res){
            echo 'true';
        }else{
            echo 'false';
        }
    }else{
        echo 'false';
    }
    
?>