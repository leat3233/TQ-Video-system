<?php 
    if(!defined('CW')){exit('Access Denied');}
    
    $db = functions::db();
    $tel = functions::getuser();
    $lvs = $db->query('share','lv',"son='{$tel}'");
    $tpl =  new Society();
    $tpl->assign('lvs',$lvs[0]['lv'] ? $lvs[0]['lv'].'%' : '该用户为顶级用户不参与分润');
    $tpl->assign('father',$tel);
    $id = CW('get/id');
    $tpl->assign('url',INDEX.'/share.php?card='.functions::autocode('v'.$tel));
	if($id){
	    $share = $db->query('share','',"id='{$id}'");
	    $tpl->assign('tel',$share[0]['son']);
	    $tpl->assign('lv',$share[0]['lv']);
		$button = "<a href='javascript:;' class='btn submit' rel='addshare'><i class='fa fa fa-edit'></i>更新</a>";
	}else{
	    $button = "<a href='javascript:;' class='btn submit' rel='addshare'><i class='fa fa-plus-square-o'></i>添加</a>";
	}
	$tpl->assign('button',$button);
    $tpl->compile('open','daili'); 
?>