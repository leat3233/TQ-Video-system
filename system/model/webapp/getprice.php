<?php 
    if(!defined('CW')){exit('Access Denied');}
    functions::is_ajax();
    $id = CW('post/id');
    $db = functions::db();
    $diamond = $db->query('post','diamond',"id='{$id}'",'',1);
    echo $diamond[0]['diamond'];
?>