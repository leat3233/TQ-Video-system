<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $id = CW('post/id');
	if(!$id){
		msg('ID不存在,请返回列表重新操作','刷新','','',true);
	}
    $title = CW('post/title');
    $diamond = CW('post/diamond');

    $hot = CW('post/hot');
    $like = CW('post/like');
    // $ftime = CW('post/ftime');
    ///////////////////////
    $topic = CW('post/topic');
    if(!$topic){
        msg('至少添加一个话题','刷新','','',true);
    }
    $userid = CW('post/userid');
    if(strlen($userid)!=11){
    	msg('手机号码必须为11位','刷新','','',true);
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
    $img1 = CW('post/img1') ? CW('post/img1').'|' : '';
    $img2 = CW('post/img2') ? CW('post/img2').'|' : '';
    $img3 = CW('post/img3') ? CW('post/img3').'|' : '';
    $img4 = CW('post/img4') ? CW('post/img4').'|' : '';
    $img5 = CW('post/img5') ? CW('post/img5').'|' : '';
    $img6 = CW('post/img6') ? CW('post/img6').'|' : '';
    $img7 = CW('post/img7') ? CW('post/img7').'|' : '';
    $img8 = CW('post/img8') ? CW('post/img8').'|' : '';
    $img9 = CW('post/img9') ? CW('post/img9').'|' : '';
    $img = $img1.$img2.$img3.$img4.$img5.$img6.$img7.$img8.$img9;
    $img = substr($img,0,-1);
    $update = array(
        'userid'=>$userid,
    	'title'=>$title,
    	'imglist'=>$img,
    	'diamond'=>$diamond,
    	'hot'=>$hot,
    	'updatetime'=>time(),
    	'likes'=>$like,
    	'topic'=>$_ids,
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