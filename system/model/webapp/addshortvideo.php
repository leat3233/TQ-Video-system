<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    
    $db = functions::db();
    $tel = CW('post/tel');
    
    $db = functions::db();
    $ex = $db->query('users','',"tel='{$tel}'",'',1);
    if(!$ex){
        msg('该用户不存在,请更换','刷新','','notice',true);
    }
    
    
    $title = CW('post/title');
    if(!CW('post/topic')){
        msg('至少添加一个话题','刷新','','',true);
    }
    $topic = explode('|',CW('post/topic'));
    
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
    	msg('标题字符要求为6-60','刷新','','',true);
    }
    
    if(CW('post/diamond')=='VIP'){
	    $diamond = 1;
	}else{
	    $diamond = 0;
	}
    
    
    $res = $db->exec('post','i',array(
        'userid'=>$tel,
    	'title'=>$title,
    	'shortvidcover'=>$shortvidcover,
    	'shortvidurl'=>$shortvidurl,
    	'likes'=>$likes,
    	'diamond'=>$diamond,
    	'topic'=>$_ids,
        'ftime'=>time(),
    	'ishow'=>$ishow=='公开' ? 1 : 0
    ));
   
    if($res){
        msg('添加成功!','刷新','javascript:location.reload()','success',true);
    }else{
        msg('添加失败!','重置','javascript:location.reload()','error',true);
    }
?>