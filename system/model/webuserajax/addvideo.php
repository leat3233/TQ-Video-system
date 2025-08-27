<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    
//  require_once  ROOT_URL.'/system/model/autoload.php';
// 	use Qiniu\Auth;
// 	use Qiniu\Storage\UploadManager;
// 	$auth = new Auth('GcjjSafVyxPrVGuTiDj4SMgZbRj8YEG7ewnw5KeI', 'pmJsVaB01lKeKlrLmJNYkFW-O7M_VgRmGjXnyrd9');
// 	$token = $auth->uploadToken(QJN);
// 	$uploadMgr = new UploadManager();
    
    
    
    $db = functions::db();
    $title = CW('post/title');
    $videocover = CW('post/videocover');
    $videourl = CW('post/videourl');
    $diamond = intval(CW('post/diamond'));
    $vipdiam = intval(CW('post/vipdiam'));
    if($vipdiam>$diamond){
        msg('会员钻石价格应低于普通钻石价格','刷新','','',true);
    }
    $hot = CW('post/hot');
    $like = CW('post/like');
    // $ftime = CW('post/ftime');
    ///////////////////////
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
    /////////////////////////
    
    if(strlen($title)>99 || strlen($title)<3){
    	msg('标题字符要求为3~99','刷新','','',true);
    }
    $userid = CW('post/userid');
    if(!preg_match("/^1[3|4|5|8][0-9]\d{8}$/",$userid)){    
        //msg('手机号码格式错误','刷新','','',true);
    }
    $ishow = CW('post/ishow')=='公开' ? 1 : 0;
    $res = $db->exec('post','i',array(
        'userid'=>$userid,
    	'title'=>$title,
    	'videocover'=>$videocover,
    	'videourl'=>$videourl,
    	'diamond'=>$diamond,
    	'vipdiam'=>$vipdiam,
    	'hot'=>$hot,
    	'likes'=>$like,
    	'topic'=>$_ids,
    	'flag'=>CW('post/flag'),
        'ftime'=>time(),
    	'ishow'=>$ishow,
    	'ptime'=>CW('post/ptime'),
    	'pnum'=>CW('post/pnum'),
    	'tags'=>CW('post/tags')
    	
    ));
    
   
    if($res){
        // if($ishow){
        //     $array = explode(',',$_ids);
        //     foreach ($array as $val){
        //         $num = $db->query('topic','num',"id='{$val}'",'',1);
        //         $num = intval($num[0]['num'])+1;
        //         $db->exec('topic','u',"num='{$num}',id='{$val}'");
        //     }
        // }
        msg('添加成功!','刷新','javascript:location.reload()','success',true);
    }else{
        msg('添加失败!','重置','javascript:location.reload()','error',true);
    }
?>