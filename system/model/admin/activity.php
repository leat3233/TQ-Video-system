<?php 
    if(!defined('CW')){exit('Access Denied');}
    
    $db = functions::db();
    $tpl =  new Society();
    $id = CW('get/id');
	if($id){
	    $activity = $db->query('activity','',"id='{$id}'",'',1);
	    $time1 = date('Y-m-d H:i:s',$activity[0]['time1']);
    	$time2 = date('Y-m-d H:i:s',$activity[0]['time2']);
		$tpl->assign('title',$activity[0]['title']);
		$tpl->assign('activitycover',$activity[0]['cover']);
		$tpl->assign('ftime',$activity[0]['ftime']);
		$tpl->assign('time1',$time1);
		$tpl->assign('time2',$time2);
		$tpl->assign('click',$activity[0]['click']);
		$tpl->assign('content1',$activity[0]['content1']);
		$tpl->assign('content2',$activity[0]['content2']);
		$tpl->assign('content3',$activity[0]['content3']);
		$tpl->assign('content4',$activity[0]['content4']);
		$tpl->assign('content5',$activity[0]['content5']);

		$button = "<a href='javascript:;' class='btn submit' rel='updateactivity'><i class='fa fa fa-edit'></i>更新</a>";
	}else{
	    $button = "<a href='javascript:;' class='btn submit' rel='addactivity'><i class='fa fa-plus-square-o'></i>添加</a>";
	}
    $tpl->assign('button',$button);
    $tpl->compile('activity','admin'); 
?>