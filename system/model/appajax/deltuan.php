<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();

    $postid = CW('post/id');
    $res = $db->exec('tuan','d',"id='{$postid}'");
   
    if($res){
        echo json_encode(array(
            'success'=>1
        ));
    }else{
        echo json_encode(array(
            'err'=>'数据不存在'
        ));
    };

?>