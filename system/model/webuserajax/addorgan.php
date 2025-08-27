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

    $diamond = CW('post/diamond');
    $hot = CW('post/hot');
    $like = CW('post/like');
    // $ftime = CW('post/ftime');
    ///////////////////////
    if(!CW('post/topic')){
        msg('至少添加一个话题','刷新','','',true);
    }
    $topic = explode('|',CW('post/topic'));
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
    if(strlen($userid)!=11){
    	msg('手机号码必须为11位','刷新','','',true);
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
    $ishow = CW('post/ishow')=='公开' ? 1 : 0;
    $res = $db->exec('post','i',array(
        'userid'=>$userid,
    	'title'=>$title,
    	'imglist'=>$img,
    	'diamond'=>$diamond,
    	'hot'=>$hot,
    	'likes'=>$like,
    	'topic'=>$_ids,
        'ftime'=>time(),
    	'ishow'=>$ishow
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