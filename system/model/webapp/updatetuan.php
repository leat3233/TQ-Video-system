<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $id = CW('post/id');
    $db = functions::db();
	if(!$id){
		msg('ID不存在,请返回列表重新操作','刷新','','',true);
	}
    $nickname = CW('post/nickname');
    $tel = CW('post/tel');
   
//         $tpl->assign('shengao',$user[0]['shengao']);
// 		$tpl->assign('zhiye',$user[0]['zhiye']);
// 		$tpl->assign('tizhong',$user[0]['tizhong']);
// 		$tpl->assign('city',$user[0]['city']);
// 		$tpl->assign('nianling',$user[0]['nianling']);
// 		$tpl->assign('xingbie',$user[0]['xingbie']);
// 		$tpl->assign('wx',$user[0]['wx']);
    
    $update = array(
    	'nickname'=>$nickname,
    
    	'shengao'=>CW('post/shengao'),
    	'zhiye'=>CW('post/zhiye'),
    	'tizhong'=>CW('post/tizhong'),
    	'city'=>CW('post/city'),
    	'nianling'=>CW('post/nianling'),
    	'xingbie'=>CW('post/xingbie'),
    	'wx'=>CW('post/wx'),
    );

    $res = $db->exec('tuan','u',array($update,array(
    	'id'=>$id	
    )));
    
   
    if($res){
        msg('更新成功!','刷新','javascript:location.reload()','success',true);
    }else{
        msg('数据无变动!','重置','javascript:location.reload()','error',true);
    }
?>