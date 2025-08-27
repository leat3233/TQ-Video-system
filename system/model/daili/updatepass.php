<?php 
    if(!defined('CW')){exit('Access Denied');}
    $tpl =  new Society();
    $tpl->assign('tel',functions::getuser());
    $tpl->compile('updatepass','daili'); 
?>