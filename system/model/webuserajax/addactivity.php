<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $db = functions::db();
    
    $title = CW('post/title');
    if(strlen($title)>90 || strlen($title)<3){
    	msg('标题字符要求为3~90','刷新','','',true);
    }
    $time1 = strtotime(CW('post/time1'));
    $time2 = strtotime(CW('post/time2'));
    if($time1>$time2){
        msg('活动时间填写错误, 结束时间应该大于开始时间','刷新','','',true);
    }
    $content5 = str_replace("\"","'",$_POST['content5']);
    $res = $db->exec('activity','i',array(
    	'title'=>$title,
    	'cover'=>CW('post/activitycover'),
    	'time1'=>$time1,
    	'time2'=>$time2,
    	'ftime'=>time(),
    	'click'=>CW('post/select'),
    	'content1'=>CW('post/content1'),
    	'content2'=>CW('post/content2'),
    	'content3'=>CW('post/content3') ? CW('post/content3') : 1,
    	'content4'=>CW('post/content4'),
    	'content5'=>$content5 ? $content5 : '无内容'
    ));
    if($res){
        msg('添加成功!','刷新','javascript:location.reload()','success',true);
    }else{
        msg('添加失败!','重置','javascript:location.reload()','error',true);
    }
?>