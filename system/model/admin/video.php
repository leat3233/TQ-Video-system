<?php 
    if(!defined('CW')){exit('Access Denied');}
    
    $db = functions::db();
    $topics = $db->query('topic','name');
    $data = '';
    foreach ($topics as $topic){
    	$data .="<li>{$topic['name']}</li>";
    }
    $tpl =  new Society();
    $id = CW('get/id');
	if($id){
		$video = $db->query('post','',"id='{$id}'",'',1);
		$tpl->assign('title',$video[0]['title']);
		$tpl->assign('ptime',$video[0]['ptime']);
		$tpl->assign('pnum',$video[0]['pnum']);
		$tpl->assign('flag',$video[0]['flag']);
		$tpl->assign('userid',$video[0]['userid']);
		$tpl->assign('videocover',$video[0]['videocover']);
		$tpl->assign('videourl',$video[0]['videourl']);
		$tpl->assign('diamond',$video[0]['diamond'] ? $video[0]['diamond'] : 0);
		$tpl->assign('vipdiam',$video[0]['vipdiam'] ? $video[0]['vipdiam'] : 0);
		$tpl->assign('hot',$video[0]['hot'] ? $video[0]['hot'] : 0);
		$tpl->assign('like',$video[0]['likes'] ? $video[0]['likes'] : 0);
		$tpl->assign('tags',$video[0]['tags']);
		
		$topic = explode(',',$video[0]['topic']);
		$d = '';
		foreach ($topic as $val){
			$name = $db->query('topic','name',"id='{$val}'",'',1);
			$d .= $name[0]['name'].'|';
		}
		$d = substr($d,0,strlen($d)-1);
		
		
		$tpl->assign('topic',$d);
        $tpl->assign('ishow',$video[0]['ishow']=='1' ? '公开' : '审核');
		$button = "<a href='javascript:;' class='btn submit' rel='updatevideo'><i class='fa fa fa-edit'></i>更新</a>";
	}else{
	    /******/
	   // $tpl->assign('userid','18888888888');
	   // $tpl->assign('videourl','http://demo-videos.qnsdk.com/movies/qiniu.mp4');
	   // $tpl->assign('diamond',mt_rand(2,50));
	    /******/
	    $tpl->assign('vipdiam',0);
	    $tpl->assign('hot',mt_rand(200,50000));
	    $tpl->assign('pnum',mt_rand(200,50000));
		$tpl->assign('like',mt_rand(200,50000));
	    $button = "<a href='javascript:;' class='btn submit' rel='addvideo'><i class='fa fa-plus-square-o'></i>添加</a>";
	}
    $tpl->assign('button',$button);
    $tpl->assign('data',$data);
    $tpl->compile('video','admin'); 
?>