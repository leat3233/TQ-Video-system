<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $id = CW('post/id');
    if(!$id){
    	msg('ID错误,请重新登录','确定','javascript:location.reload()','error');
    }
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
    	msg('标签最多为21个字符, 8个字','刷新','','',true);
    }
    $res = $db->exec('gooddeal','u',array(array(
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
    ),array(
        'id'=>$id    
    )));
   
    if($res){
        msg('更新改成功!','确定','','success');
    }else{
        msg('操作失败!','刷新','javascript:location.reload()','error',true);
    }
?>