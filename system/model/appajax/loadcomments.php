<?php 
    if(!defined('CW')){exit('Access Denied');}
    $tel = CW('post/tel');
    $db = functions::db();
    $id = CW('post/postid');
    $where = "postid='{$id}' and ishow=1";
    $comments = $db->query('comments','',$where,'id desc');
    $data = array();
    
    foreach($comments as $comment){
      $user = $db->query('users','',"tel='{$comment['tel']}'",'',1);
      $time = date('m-d H:i',$comment['ftime']);
      array_push($data,array(
         'id'=>$comment['id'],
        'avatar'=>$user[0]['avatar'],
        'nickname'=>$user[0]['nickname'],
        'address'=>$user[0]['address'],
        'time'=>$time,
        'comments'=>$comment['comments'],
        'sex'=>$user[0]['sex']=='男' ? 'man' : 'woman',
        'level'=>$user[0]['mylevel'],
        'u'=>$user[0]['tel']
      ));
    }
    echo json_encode(array(
            'comment'=>$data
        ));
    
?>


