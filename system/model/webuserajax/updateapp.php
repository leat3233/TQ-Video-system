<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $num = intval(CW('post/num'));
    $name = CW('post/name');
    $appid = CW('post/appid');
    $cover = CW('post/cover');
    $desces = CW('post/desces');
    $downloadurl = CW('post/downloadurl');
    $db = functions::db();
    if(strlen($name)>24 || strlen($name)<6){
    	msg('APP应用名称字符要求为6~24个字符,最多8个汉字','刷新','','',true);
    }
	if(strlen($cover)>255 || strlen($cover)<5){
    	msg('APP应用地址字符要求为5~255','刷新','','',true);
    }
    if($num>50 || $num<1){
    	msg('下载次数范围填写1-50','刷新','','',true);
    }
    if(strlen($desces)>36 || strlen($desces)<18){
    	msg('描述字符要求为18-36个汉字','刷新','','',true);
    }

	if(strlen($downloadurl)>255 || strlen($downloadurl)<5){
    	msg('APP下载页面地址字符要求为5~255','刷新','','',true);
    }
    $res = $db->exec('app','u',array(array("name"=>$name,"cover"=>$cover,"desces"=>$desces,"num"=>$num,"downloadurl"=>$downloadurl,),array("id"=>$appid)));
   
    if($res){
    	msg('修改成功!','确定','','success');
    }else{
        msg('数据无变动!','重填','javascript:location.reload()','',true);
    }
?>