<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $ment1 = CW('post/ment1');
    $ment2 = CW('post/ment2');
    
    if(!$ment1 || !$ment2){
        msg('至少填写一项!','重填','javascript:location.reload()','',true);
    }
    $db = functions::db();
	$res = $db->exec('sets','u',array(array(
		'ment1'=>$ment1,
		'ment2'=>$ment2
	),array(
		'id'=>1
	)));
   
    if($res){
        msg('设置成功!','确定','','success');
    }else{
        msg('数据无变动!','刷新','javascript:location.reload()','error',true);
    }
?>