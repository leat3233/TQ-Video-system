<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel = CW('post/tel');
    $users = $db->query('users','money,diam,days,daystime',"tel='{$tel}'",'',1);
    $daystime = $users[0]['daystime'];
    
    if(date('Ymd',time())==date('Ymd',$daystime)){
        echo json_encode(array(
            'is'=>1
        ));
    }else{
        echo json_encode(array(
            'writesomethingcasually'=>1
        ));
    }
    
?>