<?php 
    if(!defined('CW')){exit('Access Denied');}
    
    $db = functions::db();
    
    $tpl =  new Society();
    $id = CW('get/id');
	if($id){
	    if($adv[0]['endtime']){
	        $time = date('Y-m-d H:i:s',$adv[0]['endtime']);   
	    }else{
	        $time = '';
	    }
		$adv = $db->query('adv','',"id='{$id}'",'',1);
		$tpl->assign('tel',$adv[0]['tel']);
		$tpl->assign('imgcover',$adv[0]['cover']);
        $tpl->assign('remarks',$adv[0]['remarks']);
        $tpl->assign('endtime',$time);
        $tpl->assign('position',$adv[0]['position']);$tpl->assign('click',$adv[0]['click']);
        $tpl->assign('pos1',$adv[0]['pos1']);
        $tpl->assign('content1',$adv[0]['content1']);
        $tpl->assign('content2',$adv[0]['content2']);
        $tpl->assign('content3',$adv[0]['content3']);
        $tpl->assign('content4',$adv[0]['content4']);
        $tpl->assign('content5',$adv[0]['content5']);
        
		$button = "<a href='javascript:;' class='btn submit' rel='updateadv'><i class='fa fa fa-edit'></i>更新</a>";
	}else{

	    $button = "<a href='javascript:;' class='btn submit' rel='addadv'><i class='fa fa-plus-square-o'></i>添加</a>";
	}
    $tpl->assign('button',$button);
    $tpl->assign('data',$data);
    $tpl->compile('addadv','admin'); 
?>