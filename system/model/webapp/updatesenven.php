<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $db = functions::db();
    $accesskey = CW('post/accesskey');
    $secretkey = CW('post/secretkey');
    $spacename = CW('post/spacename');
    $url = CW('post/url');
    $ishow = CW('post/ishow');

    $res = $db->exec('apimessage','u',array(
        array(
            "accesskey"=>$accesskey,
            "secretkey"=>$secretkey,
            "url"=>$url,
            "spacename"=>$spacename,
            "ishow"=>$ishow,
        ),array(
            "id"=>1
        )));
   
    if($res){
    	msg('七牛存储对象设置成功!','确定','','success');
    }else{
        msg('数据无变动!','重填','javascript:location.reload()','',true);
    }
?>