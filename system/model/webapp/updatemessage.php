<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $db = functions::db();
    $apiid = CW('post/apiid');
    $apikey = CW('post/apikey');

    $res = $db->exec('apimessage','u',array(
        array(
            "apiid"=>$apiid,
            "apikey"=>$apikey,
        ),array(
            "id"=>1
        )));
   
    if($res){
    	msg('短信设置成功!','确定','','success');
    }else{
        msg('数据无变动!','重填','javascript:location.reload()','',true);
    }
?>