<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $set = $db->query('sets','banben,oo2,oo3','id=1','',1);
    echo json_encode($set[0]); 

?>