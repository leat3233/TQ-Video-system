<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $sets = $db->query('sets','start1,start2,changnum,duannum','','id asc',1);
    
    $sole = CW('post/sole');
    $data = $db->query('users','ftime',"sole='{$sole}'",'id asc',1);

        echo json_encode(array(
            'start1'=>$sets[0]['start1'],
            'start2'=>$sets[0]['start2'],
            'sole'=>$sole
        ));
    

?>