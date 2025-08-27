<?php 
    if(!defined('CW')){exit('Access Denied');}
    
    $db = functions::db();
    
    $tpl =  new Society();
    $id = CW('get/id');
	if($id){
		$user = $db->query('tuan','',"id='{$id}'",'',1);
		$tpl->assign('nickname',$user[0]['nickname']);
 		$tpl->assign('tel',$user[0]['tel']);
		$tpl->assign('shengao',$user[0]['shengao']);
		$tpl->assign('zhiye',$user[0]['zhiye']);
		$tpl->assign('tizhong',$user[0]['tizhong']);
		$tpl->assign('city',$user[0]['city']);
		$tpl->assign('nianling',$user[0]['nianling']);
		$tpl->assign('xingbie',$user[0]['xingbie']);
		$tpl->assign('wx',$user[0]['wx']);
		$imglists = explode('|',$user[0]['imglist']);
		$imglist = '';
		foreach ($imglists as $img){
		   
		    $imglist .= "<img style='width: 200px;height: 200px;border-radius: 8px;object-fit: cover;margin-bottom:10px;margin-right: 10px;' src='{$img}' />";
		}
		
    	$tpl->assign('imglist',$imglist);
		$button = "<a href='javascript:;' class='btn submit' rel='updatetuan'><i class='fa fa fa-edit'></i>更新</a>";
	}else{
	    $imglist = '';
	    $button = "<a href='javascript:;' class='btn submit' rel='adduser'><i class='fa fa-plus-square-o'></i>不可添加</a>";
	}
    $tpl->assign('button',$button);
    $tpl->compile('t','admin'); 
?>