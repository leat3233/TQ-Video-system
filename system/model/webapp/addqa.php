<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $db = functions::db();
    $q = CW('post/q');
    $a = CW('post/a');

    $res = $db->exec('question','i',array(
    	'question'=>$q,
    	'answer'=>$a
    ));
    if($res){
        msg('添加成功!','刷新','javascript:location.reload()','success',true);
    }else{
        msg('添加失败!','重置','javascript:location.reload()','error',true);
    }
?>