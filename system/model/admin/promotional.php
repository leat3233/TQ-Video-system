<?php 
    if(!defined('CW')){exit('Access Denied');}
    
    $db = functions::db();

    $tpl =  new Society();
    $id = CW('get/id');
	if($id){
		$gooddeal = $db->query('gooddeal','',"id='{$id}'",'',1);
		$tpl->assign('btit',$gooddeal[0]['btit']);
        $tpl->assign('descs',$gooddeal[0]['descs']);
        $tpl->assign('cover',$gooddeal[0]['cover']);
        $tpl->assign('diamond',$gooddeal[0]['diamond']);
        $tpl->assign('stit',$gooddeal[0]['stit']);
        $tpl->assign('hot',$gooddeal[0]['hot']);
        $tpl->assign('star1',$gooddeal[0]['star1']);
        $tpl->assign('star2',$gooddeal[0]['star2']);
        $tpl->assign('star3',$gooddeal[0]['star3']);
        $tpl->assign('vidlist',$gooddeal[0]['vidlist']);
		$button = "<a href='javascript:;' class='btn submit' rel='updateprom'><i class='fa fa fa-edit'></i>更新</a>";
	}else{
	    $tpl->assign('diamond',0);
	    $tpl->assign('hot',0);
	    $button = "<a href='javascript:;' class='btn submit' rel='addprom'><i class='fa fa-plus-square-o'></i>添加</a>";
	}
    $tpl->assign('button',$button);
    $tpl->assign('data',$data);
    $tpl->compile('promotional','admin'); 
?>