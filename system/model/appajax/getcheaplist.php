<?php 
    if(!defined('CW')){exit('Access Denied');}
    $db = functions::db();
    $vidlist = explode(',',CW('post/vidlist'));
    $data = array();
    $id = CW('post/id');
    $gooddeal = $db->query('gooddeal','',"id='{$id}'",'',1);
    foreach($vidlist as $val){
      $post = $db->query('post','',"id='{$val}'",'',1);
      $tips = functions::gettips($post[0]['vipdiam'],$post[0]['diamond'],2);
      $user =  $db->query('users','nickname,avatar,tel',"tel='{$post[0]['userid']}'",'',1);
      array_push($data,array(
          'id'=>$post[0]['id'],
          'tit'=>$post[0]['title'],
          'src'=>$post[0]['videocover'],
          'tag'=>$tips,
          'diam'=>$post[0]['diamond'],
          'avatar'=>str_replace('image','static',$user[0]['avatar']),
          'nickname'=>$user[0]['nickname'],
          'uid'=>$user[0]['tel'],
      ));
    }//
    echo json_encode(array(
       'data'=>$data,
       'btit'=>$gooddeal[0]['btit'],
       'descs'=>$gooddeal[0]['descs'],
       'cover'=>$gooddeal[0]['cover'],
       'diamond'=>$gooddeal[0]['diamond'],
       'vidlist'=>$vidlist,
       'hot'=>functions::hot($gooddeal[0]['hot'])
    ));
?>


