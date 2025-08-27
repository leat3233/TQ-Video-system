<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $msg1 = $db->query('sysmessage','',"mtype='官方消息'",'id desc',1);
    $msg2 = $db->query('sysmessage','',"mtype='平台通知'",'id desc',1);
    $time1 = date('m-d H:i',$msg1[0]['ftime']);
    $time2 = date('m-d H:i',$msg2[0]['ftime']);
    $content1 = $msg1[0]['content'];
    $content2 = $msg2[0]['content'];
    echo json_encode(array(
           'msg1'=>$content1,
           'msg2'=>$content2
        ));
?>