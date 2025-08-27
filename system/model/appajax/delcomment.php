<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel = CW('post/tel');
    $id = CW('post/id');
    $res = $db->exec('comments','d',"tel='{$tel}'and id='{$id}'");
    if($res){
        echo json_encode(array(
            'success'=>1
        ));
    }else{
        echo json_encode(array(
            'err'=>'评论不存在或已被删除'
        ));
    };

?>