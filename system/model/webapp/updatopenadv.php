<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $openadvimg = CW('post/openadvimg');
    $openadvremarks = CW('post/openadvremarks');
    $openadvurl = CW('post/openadvurl');
    $openadvishow = CW('post/openadvishow');
    $db = functions::db();
	$res = $db->exec('sets','u',array(array(
		'openadvimg'=>$openadvimg,
		'openadvremarks'=>$openadvremarks,
		'openadvurl'=>$openadvurl,
		'openadvishow'=>$openadvishow,
	),array(
		'id'=>1
	)));
   
    if($res){
        msg('设置成功!','确定','','success');
    }else{
        msg('数据无变动!','刷新','javascript:location.reload()','',true);
    }
?>