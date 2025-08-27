<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel = CW('post/tel');
    $postid = CW('post/id');
    $res = $db->exec('post','d',"userid='{$tel}'and id='{$postid}'");
   
    if($res){
        echo json_encode(array(
            'success'=>1
        ));
    }else{
        echo json_encode(array(
            'err'=>'帖子不存在或已被删除'
        ));
    };

?>