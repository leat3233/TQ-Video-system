<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
     $id = CW('post/id');
    $db = functions::db();
    $tel = CW('post/tel');
    $title = CW('post/title');
    if(!CW('post/topic')){
        msg('至少添加一个话题','刷新','','',true);
    }
    $topic = explode('|',CW('post/topic'));
    $db = functions::db();
	foreach ($topic as $val){
		$_id = $db->query('topic','id',"name='{$val}'",'',1);
		$_ids .= $_id[0]['id'].',';
	}
	$_ids = substr($_ids,0,strlen($_ids)-1);
    $shortvidcover = CW('post/shortvidcover');
    $shortvidurl = CW('post/shortvidurl');
    $likes = intval(CW('post/likes'));
    $ishow = CW('post/ishow');
    if(strlen($title)>60 || strlen($title)<6){
    	//msg('标题字符要求为6-60','刷新','','',true);
    }
    if(strlen($tel)!=11){
    	//msg('手机号码必须为11位','刷新','','',true);
    }
    $diamond = intval(CW('post/diamond'));
    $vipdiam = intval(CW('post/vipdiam'));
     if($vipdiam>$diamond){
        msg('会员的钻石价格应低于普通钻石价格','刷新','','',true);
    }
    $res = $db->exec('post','u',array(array(
        'userid'=>$tel,
    	'title'=>$title,
    	'shortvidcover'=>$shortvidcover,
    	'shortvidurl'=>$shortvidurl,
    	'likes'=>$likes,
    	'topic'=>$_ids,
    	'diamond'=>$diamond,
    	'vipdiam'=>$vipdiam,
        'ftime'=>time(),
    	'ishow'=>$ishow=='公开' ? 1 : 0
    ),array(
        'id'=>$id
    )));
   
    if($res){
        msg('更新成功!','刷新','javascript:location.reload()','success',true);
    }else{
        msg('数据无变动!','重置','javascript:location.reload()','error',true);
    }
?>