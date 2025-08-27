<?php 
    if(!defined('CW')){exit('Access Denied');}
    $tel = CW('post/tel');
    $db = functions::db();
    $where = "tel='{$tel}'";
   
    $comments = $db->query('comments','',$where,'id desc');
    $data = array();
    $user = $db->query('users','',"tel='{$tel}'",'',1);
    foreach($comments as $comment){
      $time = date('m-d H:i',$comment['ftime']);
      array_push($data,array(
         'id'=>$comment['id'],
        'avatar'=>$user[0]['avatar'],
        'nickname'=>$user[0]['nickname'],
        'address'=>$user[0]['address'],
        'time'=>$time,
        'comments'=>$comment['comments'],
        'sex'=>$user[0]['sex']=='男' ? 'man' : 'woman',
        'level'=>$user[0]['mylevel']
      ));
    }
    echo json_encode(array(
            'data'=>$data
        ));
    
?>


