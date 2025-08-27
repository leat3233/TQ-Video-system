<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $exist = $db->query('recommend','','id=1');
    if(!$exist){
        $db->exec('recommend','i',array(
            'pak1'=>''
        ));
        $exist = $db->query('recommend','','id=1');
    }
    $tpl =  new Society();
    $tpl->assign('pak1',$exist[0]['pak1']);
    $tpl->assign('pak2',$exist[0]['pak2']);
    $tpl->assign('pak3',$exist[0]['pak3']);
    $tpl->assign('pak4',$exist[0]['pak4']);
    $tpl->assign('pak5',$exist[0]['pak5']);
    $tpl->assign('pak6',$exist[0]['pak6']);
    $tpl->assign('pak7',$exist[0]['pak7']);
    $tpl->assign('hot',$exist[0]['hot']);
    $tpl->compile('indexrecommend','admin'); 
?>