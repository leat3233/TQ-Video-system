<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $topicid = CW('post/topicid');
    $name = CW('post/name');
    $hot = intval(CW('post/hot'));
    $cover = CW('post/cover');
    $db = functions::db();
    $desces = CW('post/desces');
    if(!$topicid){
    	msg('ID错误,请重新登录','确定','javascript:location.reload()','error');
    }
    if(strlen($name)>15 || strlen($name)<1){
    	msg('话题名称字符要求为1~15个字符,最多5个汉字','刷新','','',true);
    }
    if($hot>100000){
    	msg('热度填写的太大了','刷新','','',true);
    }
	if(strlen($cover)>255 || strlen($cover)<11){
    	msg('封面地址字符要求为11~255','刷新','','',true);
    }
    if(strlen($desces)>255 || strlen($desces)<15){
    	msg('描述字符要求为15-255个字符','刷新','','',true);
    }
    $res = $db->exec('topic','u',array(array("name"=>$name,"cover"=>$cover,"desces"=>$desces,"hot"=>$hot),array("id"=>$topicid)));
   
    if($res){
    	msg('修改成功!','确定','','success');
    }else{
        msg('数据无变动!','重填','javascript:location.reload()','',true);
    }
?>