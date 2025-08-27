<?php 
    if(!defined('CW')){exit('Access Denied');}
    $tel = CW('post/tel');
    $type = intval(CW('post/type'));
    $db = functions::db();
    if($type==1){
        $where = "tel1='{$tel}'";
    }elseif($type==2){
        $where = "tel2='{$tel}'";
    }

  
    $follows = $db->query('follow','',$where,'id desc');
    $user ='';
    $data = array();
    foreach($follows as $follow){
      if($type==1){
          $user = $db->query('users','',"tel='{$follow['tel2']}'",'',1);
      }elseif($type==2){
          $user = $db->query('users','',"tel='{$follow['tel1']}'",'',1);
      }
      array_push($data,array(
          'avatar'=>str_replace('image','static',$user[0]['avatar']),
          'sex'=>$user[0]['sex']=='男' ?  'man' : 'woman',
          'nickname'=>$user[0]['nickname'],
          'descs'=>$user[0]['descs'],
          'tel'=>$user[0]['tel']
      ));

    }
    echo json_encode(array(
        'data'=>$data
    ));
    
?>


