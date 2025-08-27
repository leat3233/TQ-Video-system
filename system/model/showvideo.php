<?php 
    if(!defined('CW')){exit('Access Denied');}
    $tpl =  new Society();
    $videourl = CW('gp/videourl');
    $videocover = CW('gp/videocover');
    $tpl->assign('videourl',$videourl);
    $tpl->assign('videocover',$videocover);
    $tpl->compile('showvideo',''); 
?>