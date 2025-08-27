<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $sets = $db->query('sets','','','id asc',1);
    echo json_encode($sets[0]);
?>