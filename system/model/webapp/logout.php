<?php
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    functions::set_cookie('__secret','',time()-3600);

    msg('系统已被成功注销!','关闭','javascript:window.location.reload()','success');
?>