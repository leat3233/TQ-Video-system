<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $hot = intval(CW('post/hot'));
    $name = CW('post/name');
    $cover = CW('post/cover');
    $desces = CW('post/desces');
    $db = functions::db();
    if(strlen($name)>12 || strlen($name)<1){
    	msg('话题名称字符要求为1~12个字符,最多4个汉字','刷新','','',true);
    }
	if(strlen($cover)>255 || strlen($cover)<11){
    	msg('封面地址字符要求为11~255','刷新','','',true);
    }
    if($hot>100000){
    	msg('热度填写的太大了','刷新','','',true);
    }
    if(strlen($desces)>255 || strlen($desces)<15){
    	msg('描述字符要求为3-85个汉字','刷新','','',true);
    }
	$exist = $db->query('topic','id',"name='{$name}'",'',1);
	if($exist){
		msg('该名称已存在','刷新','','',true);
	}
    $res = $db->exec('topic','i',array(
    	'name'=>$name,
    	'cover'=>$cover,
    	"hot"=>$hot,
    	'desces'=>$desces,
    	'num'=>0
    ));
    
   
    if($res){
        msg('添加成功!','刷新','javascript:location.reload()','success',true);
    }else{
        msg('添加失败!','重置','javascript:location.reload()','error',true);
    }
?>