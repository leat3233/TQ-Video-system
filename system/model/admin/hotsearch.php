<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $isexist = $db->query('sets','','id=1');
    if(!$isexist){
        $db->exec('sets','i',array(
            'hotsearch'=>''
        ));
    }
    $sets = $db->query('sets','','id=1');
    $tpl =  new Society();
    $tpl->assign('hotsearch',$sets[0]['hotsearch']);
    $tpl->compile('hotsearch','admin'); 
?>