<?php 
    if(!defined('CW')){exit('Access Denied');}
    
    $db = functions::db();
    
    $tpl =  new Society();
    $id = CW('get/id');
	if($id){
	  
		$dluser = $db->query('dluser','',"id='{$id}'",'',1);
		$tpl->assign('tel',$dluser[0]['tel']);
	    $tpl->assign('dailipass',$dluser[0]['dailipass']);
        $tpl->assign('bili',$dluser[0]['bili']);
        $tpl->assign('state',$dluser[0]['state']);
        
		$button = "<a href='javascript:;' class='btn submit' rel='updatedl'><i class='fa fa fa-edit'></i>更新</a>";
	}else{

	    $button = "<a href='javascript:;' class='btn submit' rel='dlopen'><i class='fa fa-plus-square-o'></i>添加</a>";
	}
    $tpl->assign('button',$button);
    $tpl->assign('data',$data);
    $tpl->compile('dlopen','admin'); 
?>