<?php 
    if(!defined('CW')){exit('Access Denied');}
    
    $db = functions::db();
    
    $tpl =  new Society();
    $id = CW('get/id');
	if($id){
		$user = $db->query('users','',"id='{$id}'",'',1);
		$tpl->assign('nickname',$user[0]['nickname']);
		//$dailipass = $db->query('daili',"","username='{$user[0]['tel']}'",'',1);
	//	$dailipass = $dailipass[0]['dailipass'];
 		$tpl->assign('dailipass',$user[0]['dailipass']);
		$tpl->assign('days',$user[0]['days']);
		$tpl->assign('tel',$user[0]['tel']);
		$tpl->assign('new1',$user[0]['new1']);
		$tpl->assign('usertel',$user[0]['usertel']);
		$tpl->assign('tpass',$user[0]['tpass']);
		
		$tpl->assign('card',$user[0]['card'].'[不可修改]');
		$tpl->assign('descs',$user[0]['descs']);
		$tpl->assign('mylevel',$user[0]['mylevel']);
		$tpl->assign('diam',$user[0]['diam']);
		$tpl->assign('money',$user[0]['money']);
		$tpl->assign('viptime',$user[0]['viptime'] ? date('Y-m-d H:i:s',$user[0]['viptime']) : 0);
		$tpl->assign('sex',$user[0]['sex']);
		$tpl->assign('withdrawalspass',$user[0]['withdrawalspass']);
		$tpl->assign('lockpass',$user[0]['lockpass']);
		$tpl->assign('freeze',$user[0]['freeze']=='1' ? '冻结' : '正常');
		
		$lv = $db->query('share','lv',"son='{$user[0]['tel']}'",'',1);
		
		$tpl->assign('lv',$lv[0]['lv']);
		$button = "<a href='javascript:;' class='btn submit' rel='updateuser'><i class='fa fa fa-edit'></i>更新</a>";
	}else{
	    $button = "<a href='javascript:;' class='btn submit' rel='adduser'><i class='fa fa-plus-square-o'></i>不可添加</a>";
	}
    $tpl->assign('button',$button);
    $tpl->compile('user','admin'); 
?>