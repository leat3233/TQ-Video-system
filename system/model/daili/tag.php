<?php 
    if(!defined('CW')){exit('Access Denied');}
    $mode = CW('get/mod');
    
    $tpl =  new Society();
    $tpl->assign('show',$show);
    $tpl->compile('tag','daili'); 
?>