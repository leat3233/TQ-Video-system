<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $id = CW('post/id');
	if(!$id){
		msg('ID不存在,请返回列表重新操作','刷新','','',true);
	}
    $title = CW('post/title');
    $videocover = CW('post/videocover');
    $videourl = CW('post/videourl');
    $diamond = intval(CW('post/diamond'));
    $vipdiam = intval(CW('post/vipdiam'));
    if($vipdiam>$diamond){
        msg('会员的钻石价格应低于普通钻石价格','刷新','','',true);
    }
    $hot = CW('post/hot');
    $like = CW('post/like');
    // $ftime = CW('post/ftime');
    ///////////////////////
    $topic = CW('post/topic');
    if(!$topic){
        msg('至少添加一个话题','刷新','','',true);
    }
    $topic = explode('|',$topic);
    $db = functions::db();
	foreach ($topic as $val){
		$_id = $db->query('topic','id',"name='{$val}'",'',1);
		$_ids .= $_id[0]['id'].',';
	}
	$_ids = substr($_ids,0,strlen($_ids)-1);
    /////////////////////////
    
    if(strlen($title)>99 || strlen($title)<3){
    	msg('标题字符要求为3~99','刷新','','',true);
    }
    $userid = CW('post/userid');
    if(!preg_match("/^1[3|4|5|8][0-9]\d{8}$/",$userid)){    
        //msg('手机号码格式错误','刷新','','',true);
    }
    $update = array(
        'userid'=>$userid,
        'ptime'=>CW('post/ptime'),
		'pnum'=>CW('post/pnum'),
    	'tags'=>CW('post/tags'),
    	'title'=>$title,
    	'videocover'=>$videocover,
    	'videourl'=>$videourl,
    	'diamond'=>$diamond,
    	'vipdiam'=>$vipdiam,
    	'hot'=>$hot,
    	'likes'=>$like,
    	'topic'=>$_ids,
    	'flag'=>CW('post/flag'),
    	'updatetime'=>time(),
    // 	'ftime'=>CW('post/ftime') ? strtotime(CW('post/ftime')) : time(),
    	'ishow'=>CW('post/ishow')=='公开' ? 1 : 0
    );
    

    
    $res = $db->exec('post','u',array($update,array(
    	'id'=>$id	
    )));
    
   
    if($res){
        msg('更新成功!','刷新','javascript:location.reload()','success',true);
    }else{
        msg('数据无变动!','重置','javascript:location.reload()','error',true);
    }
?>