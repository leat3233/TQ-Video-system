<?php 
    require "config.inc.php";
    require "system/runtime.php";
    if(!defined('CW')){exit('Access Denied');}
    $card = CW('gp/card') ? functions::autocode(CW('gp/card'),'-') : '';
    $db = functions::db();
    $set = $db->query('sets','oo1,oo2,oo3','id=1','',1);
    $tpl =  new Society();
    $tpl->assign('card',$card);
    $tpl->assign('oo1',$set[0]['oo1']);
    $tpl->assign('oo2',$set[0]['oo2']);
    $tpl->assign('oo3',$set[0]['oo3']);

    $tpl->assign('qrcode',INDEX.$_SERVER["REQUEST_URI"]);
    $tpl->compile('t',''); 
    
   
?>