<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    
    $hotsearch = CW('post/hotsearch');
    
    $db = functions::db();
    $res = $db->exec('sets','u',array(array(
       'hotsearch'=>$hotsearch
    ),array(
        'id'=>1 
    )));
    
   
    if($res){
    	msg('关键词更新成功!','确定','','success');
    }else{
        msg('数据无变动!','重填','javascript:location.reload()','',true);
    }
?>