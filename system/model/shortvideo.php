<?php 
    if(!defined('CW')){exit('Access Denied');}
    $tpl =  new Society();
    $shortvidcover = CW('gp/shortvidcover');
    $shortvidurl = CW('gp/shortvidurl');
    $tpl->assign('shortvidcover',$shortvidcover);
    $tpl->assign('shortvidurl',$shortvidurl);
    $tpl->compile('shortvideo',''); 
?>