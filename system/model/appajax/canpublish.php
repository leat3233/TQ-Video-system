<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel = CW('post/tel');
    $onlyvip = $db->query('sets','onlyvip','','id asc',1);
    if($onlyvip[0]['onlyvip']){
        $users = $db->query('users','viptime',"tel='{$tel}'",'',1);
        if($users[0]['viptime']>time()){
            echo json_encode(array(
                'state'=>1,
                'notvip'=>0
            ));
        }else{
            echo json_encode(array(
                'state'=>1,
                'notvip'=>1
            ));
        }
    }else{//
        echo json_encode(array(
            'state'=>1,
            'notvip'=>0
        ));
    };
?>