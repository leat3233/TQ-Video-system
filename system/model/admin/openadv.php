<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $sets = $db->query('sets','openadvimg,openadvremarks,openadvurl,openadvishow','id=1','',1);
    $tpl =  new Society();
    $tpl->assign('openadvimg',$sets[0]['openadvimg']);
    $tpl->assign('openadvremarks',$sets[0]['openadvremarks']);
    $tpl->assign('openadvurl',$sets[0]['openadvurl']);
    $tpl->assign('openadvishow',$sets[0]['openadvishow']);
    $tpl->compile('openadv','admin'); 
?>