<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $id = CW('post/id');
    $table = CW('post/table');
    $db = functions::db();
    if(!$id){
    	msg('ID错误,请重新登录','确定','javascript:location.reload()','error');
    }else{
        $res = $db->exec($table,'d',array(
	    	'id'=>$id
	    ));
    }
    if($res){
        msg('删除成功!','确定','','success');
    }else{
        msg('删除失败!','重填','javascript:location.reload()','error',true);
    }
?>