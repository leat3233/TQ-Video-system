<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    
    $vid = CW('post/vid');
    $star1 = CW('post/star1');
    $star2= CW('post/star2');


    if(!$vid){
        msg('请设置影片ID','刷新','','',true);
    }

    
    $db = functions::db();
    $res = $db->exec('selected','i',array(
        'vid'=>$vid,
        'star1'=>$star1,
        'star2'=>$star2
    ));
    if($res){
        msg('添加成功!','刷新','javascript:location.reload()','success',true);
    }else{
        msg('添加失败!','重置','javascript:location.reload()','error',true);
    } 
?>