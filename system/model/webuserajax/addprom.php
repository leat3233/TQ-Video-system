<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    
    $btit = CW('post/btit');
    $descs = CW('post/descs');
    $stit = CW('post/stit');
    $db = functions::db();
    if(strlen($btit)>30 || strlen($btit)<1){
    	msg('大标题最多为30个字符, 10个字','刷新','','',true);
    }
    if(strlen($descs)>180 || strlen($descs)<1){
    	msg('描述最多为180个字符, 60个字','刷新','','',true);
    }
    if(strlen($stit)>21 || strlen($stit)<1){
    	msg('描述最多为21个字符, 7个字','刷新','','',true);
    }
    $res = $db->exec('gooddeal','i',array(
    	'btit'=>$btit,
    	'descs'=>$descs,
    	'cover'=>CW('post/cover'),
    	'diamond'=>intval(CW('post/diamond')),
    	'stit'=>$stit,
    	'hot'=>intval(CW('post/hot')),
    	'star1'=>CW('post/star1'),
    	'star2'=>CW('post/star2'),
    	'star3'=>CW('post/star3'),
    	'ftime'=>time(),
    	'vidlist'=>CW('post/vidlist')
    ));
    
   
    if($res){
        msg('添加成功!','刷新','javascript:location.reload()','success',true);
    }else{
        msg('添加失败!','重置','javascript:location.reload()','error',true);
    }
?>