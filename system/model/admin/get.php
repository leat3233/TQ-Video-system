<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tpl =  new Society();
    $cstate = $db->query('sets','cstate','id=1','',1);
    $cstate = $cstate[0]['cstate'];
    $tpl->assign('cstate',$cstate);
    $tpl->compile('get','admin');  
?>