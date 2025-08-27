<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $sets = $db->query('sets','','','id asc',1);
    
    $tpl =  new Society();
    $tpl->assign('set1',$sets[0]['set1']);
    $tpl->assign('set2',$sets[0]['set2']);
    $tpl->compile('shortvideoset','admin'); 
?>