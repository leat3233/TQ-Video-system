<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $db = functions::db();
    $db->query("truncate table card");
    msg('清除完毕!','确定','','success');
?>