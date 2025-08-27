<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();

    $tpl =  new Society();
    $set = $db->query('sets','g1,g2,g3,g4','id=1');
    $tpl->assign('g1',$set[0]['g1']);
    $tpl->assign('g2',$set[0]['g2']);
    $tpl->assign('g3',$set[0]['g3']);$tpl->assign('g4',$set[0]['g4']);
    $tpl->compile('piliang','admin'); 
?>