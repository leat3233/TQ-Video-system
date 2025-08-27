<?php 
    if(!defined('CW')){exit('Access Denied');}
    $tel = CW('post/tel');
    $id = CW('post/postid',1);
    $message = CW('post/message');
    $db = functions::db();
    $comtime = $db->query('users','comtime',"tel='{$tel}'",'',1);
    $comtime = $comtime[0]['comtime'];

    if(($comtime+300)>time()){
        echo json_encode(array(
            'err'=>'两次评论时间过短'
        ));return;
    }
    $ntime = time();
    $db->exec('users','u',"comtime='{$ntime}',tel='{$tel}'");
    if(strlen($message)>240){
        echo json_encode(array(
            'err'=>'评论字数超过限制'
        ));return;
    }
    
    $isexist = $db->query('post','',"id='{$id}'",'',1);
    if(!$isexist){
        echo json_encode(array(
            'err'=>'帖子ID异常, 无法评论'
        ));return;
    }
    $vipcomments = $db->query('sets','vipcomments','','id asc',1);
    if($vipcomments[0]['vipcomments']){
        $users = $db->query('users','viptime',"tel='{$tel}'",'',1);
        if($users[0]['viptime']<time()){
            echo json_encode(array(
                'err'=>'成为VIP才可以评论'
            ));return;
        }
    }
    $time = time();
    $res = $db->exec('comments','i',array(
        'postid'=>$id,
        'tel'=>$tel,
        'comments'=>$message,
        'ftime'=>$time,
        'ishow'=>0
    ));
    if($res){
        echo json_encode(array(
            'success'=>1
        ));
    }else{
        echo json_encode(array(
            'err'=>'评论失败!'
        ));
    }
?>


