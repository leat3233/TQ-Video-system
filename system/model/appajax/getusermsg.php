<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $tel = CW('post/tel1');
    $tel2 = CW('post/tel2');
    $users = $db->query('users','',"tel='{$tel2}'");
    $follow1 = $db->get_count('follow',"tel2='{$tel2}'");
    $follow2 = $db->get_count('follow',"tel1='{$tel2}'");
    $follow = $db->query('follow','',"tel1='{$tel}' and tel2='{$tel2}'");
    $num = $db->get_count('post',"userid='{$tel2}'");
    echo json_encode(array(
        
        'follow1'=>functions::hot($follow1),
        'follow2'=>functions::hot($follow2),
        'follow'=>$follow ? '取消关注' : '关注',
        'num'=>$num,
        'level'=>$users[0]['mylevel'],
        'nickname'=>$users[0]['nickname'],
        'address'=>$users[0]['address'],
        'descs'=>$users[0]['descs'],
        
        'sex'=>$users[0]['sex'],
        'tel'=>$users[0]['tel'],
        
        
        'avatar'=>str_replace('image','static',$users[0]['avatar']),
    )); 


        


?>