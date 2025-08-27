<?php 
    if(!defined('CW')){exit('Access Denied');}
    
    $db = functions::db();
    
    $tpl =  new Society();
    $id = CW('get/id');
	if($id){
		$user = $db->query('users','',"id='{$id}'",'',1);
		$tpl->assign('nickname',$user[0]['nickname']);
 		//$tpl->assign('tel',$user[0]['tel']);
		$tpl->assign('days',$user[0]['days']);
		$tpl->assign('new1',$user[0]['new1']);
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
		$button = "<a href='javascript:;' class='btn submit' rel='updateuser'><i class='fa fa fa-edit'></i>更新</a>";
	}else{
	    $button = "<a href='javascript:;' class='btn submit' rel='adduser'><i class='fa fa-plus-square-o'></i>不可添加</a>";
	}
    $tpl->assign('button',$button);
    $tpl->compile('user','user'); 
?>