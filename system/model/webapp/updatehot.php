<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $hot = CW('post/hot');
    if(!$hot){
        msg('影片ID必填!','重填','javascript:location.reload()','',true);
    }
   
    $db = functions::db();
    $array = explode(',',$hot);
    foreach ($array as $val){
        
        $accord = $db->query('post','',"id='{$val}' and videocover!=''",'',1);
        if(!$accord){
             msg('ID:'.$val.' 非影片','重填','javascript:location.reload()','',true);
            
        }
    }
	$res = $db->exec('recommend','u',array(array(
		'hot'=>$hot
	),array(
		'id'=>1
	)));
   
    if($res){
        msg('设置成功!','确定','','success');
    }else{
        msg('数据无变动!','刷新','javascript:location.reload()','',true);
    }
?>