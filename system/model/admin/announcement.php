<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $isexist = $db->query('sets','','id=1');
    if(!$isexist){
        $db->exec('sets','i',array(
            'ment1'=>'白间公告未设置',
            'ment2'=>'晚间公告未设置',
            'look'=>10,
            'pay'=>200
        ));
    }
    $sets = $db->query('sets','','id=1');
    $tpl =  new Society();
    $tpl->assign('ment1',$sets[0]['ment1']);
    $tpl->assign('ment2',$sets[0]['ment2']);
    $tpl->compile('announcement','admin'); 
?>